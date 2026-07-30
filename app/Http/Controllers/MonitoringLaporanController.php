<?php

namespace App\Http\Controllers;

use App\Models\Datamedis;
use App\Models\DataSafety;
use App\Models\PelaporanPengawas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MonitoringLaporanController extends Controller
{
    private const SUMBER_LABEL = [
        'MEDIS'    => 'Data Medis',
        'SAFETY'   => 'Data Safety',
        'PENGAWAS' => 'Pelaporan Pengawas',
    ];

    private const STATUS_LIST = ['PENDING', 'APPROVE', 'REJECT', 'CANCEL'];

    public function index()
    {
        return view('monitoring-laporan.index');
    }

    /**
     * Menggabungkan 3 sumber laporan (Data Medis, Data Safety, Pelaporan Pengawas)
     * menjadi satu daftar terpadu via UNION ALL, lalu difilter & dipaginasi di level DB.
     */
    public function data(Request $request): JsonResponse
    {
        try {
            $search    = trim((string) $request->query('search', ''));
            $sumber    = strtoupper((string) $request->query('sumber', ''));
            $status    = strtoupper((string) $request->query('status', ''));
            $areaKerja = $request->query('area_kerja');
            $tahun     = $request->query('tahun');
            $bulan     = $request->query('bulan');

            $medis = DB::table('datamedis')->select([
                DB::raw("'MEDIS' as sumber"),
                'id',
                'tanggal_pelaksanaan',
                'nama_tenaga as nama_petugas',
                'badge_tenaga as badge',
                'area_kerja',
                'unit_kerja',
                'jenis_aktifitas_kpi',
                'keputusan as status',
                'created_at',
            ]);

            $safety = DB::table('data_safety')->select([
                DB::raw("'SAFETY' as sumber"),
                'id',
                'tanggal_pelaksanaan',
                'nama_tenaga as nama_petugas',
                'badge_tenaga as badge',
                'area_kerja',
                'unit_kerja',
                'jenis_aktifitas_kpi',
                'keputusan as status',
                'created_at',
            ]);

            $pengawas = DB::table('pelaporan_pengawas as pp')
                ->leftJoin('aktivitas_kpi_k3 as ak', 'ak.id', '=', 'pp.aktivitas_kpi_k3_id')
                ->select([
                    DB::raw("'PENGAWAS' as sumber"),
                    'pp.id',
                    'pp.tanggal_pelaksanaan',
                    'pp.nama_pengawas as nama_petugas',
                    'pp.badge_pengawas as badge',
                    'pp.area_kerja',
                    'pp.unit_kerja',
                    DB::raw("COALESCE(ak.nama_aktivitas, '-') as jenis_aktifitas_kpi"),
                    'pp.status',
                    'pp.created_at',
                ]);

            // Filter per-sub-query (biar bisa manfaatkan index kolom masing-masing tabel)
            $applyCommonFilters = function ($q, string $tglCol, string $areaCol, string $namaCol, string $badgeCol) use ($search, $areaKerja, $tahun, $bulan) {
                if ($areaKerja) {
                    $q->where($areaCol, $areaKerja);
                }
                if ($tahun) {
                    $q->whereYear($tglCol, $tahun);
                }
                if ($bulan) {
                    $q->whereMonth($tglCol, $bulan);
                }
                if ($search) {
                    $q->where(function ($qq) use ($namaCol, $badgeCol, $search) {
                        $qq->where($namaCol, 'ilike', "%{$search}%")
                            ->orWhere($badgeCol, 'ilike', "%{$search}%");
                    });
                }
            };

            $applyCommonFilters($medis, 'tanggal_pelaksanaan', 'area_kerja', 'nama_tenaga', 'badge_tenaga');
            $applyCommonFilters($safety, 'tanggal_pelaksanaan', 'area_kerja', 'nama_tenaga', 'badge_tenaga');
            $applyCommonFilters($pengawas, 'pp.tanggal_pelaksanaan', 'pp.area_kerja', 'pp.nama_pengawas', 'pp.badge_pengawas');

            // Filter sumber -> tentukan sub-query mana saja yang ikut di-UNION
            $parts = [];
            if (!$sumber || $sumber === 'MEDIS') $parts[] = $medis;
            if (!$sumber || $sumber === 'SAFETY') $parts[] = $safety;
            if (!$sumber || $sumber === 'PENGAWAS') $parts[] = $pengawas;

            if (empty($parts)) {
                return response()->json([
                    'data' => [],
                    'meta' => ['current_page' => 1, 'last_page' => 1, 'per_page' => 10, 'total' => 0, 'from' => null, 'to' => null],
                    'filter_options' => $this->filterOptions(),
                ]);
            }

            $union = array_shift($parts);
            foreach ($parts as $p) {
                $union->unionAll($p);
            }

            $query = DB::query()->fromSub($union, 'gabungan');

            if ($status) {
                $query->where('status', $status);
            }

            $query->orderByDesc('tanggal_pelaksanaan')->orderByDesc('created_at');

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $data = collect($paginator->items())->map(fn($row) => [
                'sumber'              => $row->sumber,
                'sumber_label'        => self::SUMBER_LABEL[$row->sumber] ?? $row->sumber,
                'id'                  => $row->id,
                'tanggal_pelaksanaan' => $row->tanggal_pelaksanaan,
                'nama_petugas'        => $row->nama_petugas,
                'badge'               => $row->badge,
                'area_kerja'          => $row->area_kerja,
                'unit_kerja'          => $row->unit_kerja,
                'jenis_aktifitas_kpi' => $row->jenis_aktifitas_kpi,
                'status'              => $row->status ?: 'PENDING',
            ]);

            return response()->json([
                'data' => $data,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page'    => max($paginator->lastPage(), 1),
                    'per_page'     => $paginator->perPage(),
                    'total'        => $paginator->total(),
                    'from'         => $paginator->firstItem(),
                    'to'           => $paginator->lastItem(),
                ],
                'filter_options' => $this->filterOptions(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data monitoring laporan: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data monitoring laporan.'], 500);
        }
    }

    /**
     * Detail lengkap satu laporan (dipakai modal detail) — sumber & id datang dari baris tabel gabungan.
     */
    public function detail(string $sumber, int $id): JsonResponse
    {
        $sumber = strtoupper($sumber);

        try {
            switch ($sumber) {
                case 'MEDIS':
                    $item = Datamedis::findOrFail($id);
                    $data = [
                        'sumber' => 'MEDIS',
                        'sumber_label' => self::SUMBER_LABEL['MEDIS'],
                        'id' => $item->id,
                        'waktu_submit' => optional($item->waktu_submit)->toDateTimeString(),
                        'tanggal_pelaksanaan' => optional($item->tanggal_pelaksanaan)->toDateString(),
                        'nama_petugas' => $item->nama_tenaga,
                        'badge' => $item->badge_tenaga,
                        'area_kerja' => $item->area_kerja,
                        'unit_kerja' => $item->unit_kerja,
                        'jenis_aktifitas_kpi' => $item->jenis_aktifitas_kpi,
                        'status' => $item->keputusan,
                        'status_pindah' => $item->status_pindah,
                        'dokumen' => array_filter([
                            'Foto Evidence' => $item->foto_evidence_path ? asset('storage/' . $item->foto_evidence_path) : null,
                            'Formulir Kegiatan' => $item->formulir_kegiatan_path ? asset('storage/' . $item->formulir_kegiatan_path) : null,
                            'Arsip' => $item->arsip_path ? asset('storage/' . $item->arsip_path) : null,
                        ]),
                    ];
                    break;

                case 'SAFETY':
                    $item = DataSafety::findOrFail($id);
                    $data = [
                        'sumber' => 'SAFETY',
                        'sumber_label' => self::SUMBER_LABEL['SAFETY'],
                        'id' => $item->id,
                        'waktu_submit' => optional($item->waktu_submit)->toDateTimeString(),
                        'tanggal_pelaksanaan' => optional($item->tanggal_pelaksanaan)->toDateString(),
                        'nama_petugas' => $item->nama_tenaga,
                        'badge' => $item->badge_tenaga,
                        'area_kerja' => $item->area_kerja,
                        'unit_kerja' => $item->unit_kerja,
                        'jenis_aktifitas_kpi' => $item->jenis_aktifitas_kpi,
                        'status' => $item->keputusan,
                        'status_pindah' => $item->status_pindah,
                        'indikasi_duplikat' => $item->indikasi_duplikat,
                        'dokumen' => array_filter([
                            'Arsip' => $item->arsip_path ? asset('storage/' . $item->arsip_path) : null,
                        ]),
                    ];
                    break;

                case 'PENGAWAS':
                    $item = PelaporanPengawas::with('aktivitas')->findOrFail($id);
                    $data = [
                        'sumber' => 'PENGAWAS',
                        'sumber_label' => self::SUMBER_LABEL['PENGAWAS'],
                        'id' => $item->id,
                        'tanggal_pelaksanaan' => optional($item->tanggal_pelaksanaan)->toDateString(),
                        'nama_petugas' => $item->nama_pengawas,
                        'badge' => $item->badge_pengawas,
                        'area_kerja' => $item->area_kerja,
                        'unit_kerja' => $item->unit_kerja,
                        'jenis_aktifitas_kpi' => $item->aktivitas?->nama_aktivitas ?? '-',
                        'status' => $item->status,
                        'id_laporan' => $item->id_laporan,
                        'diperiksa_oleh' => $item->diperiksa_oleh,
                        'keterangan_bahaya' => $item->keterangan_bahaya,
                        'materi_safety_briefing' => $item->materi_safety_briefing,
                        'dokumen' => array_filter([
                            'Foto Temuan Bahaya' => $item->foto_temuan_bahaya ? asset('storage/' . $item->foto_temuan_bahaya) : null,
                            'Foto Kegiatan Briefing' => $item->foto_kegiatan_safety_briefing ? asset('storage/' . $item->foto_kegiatan_safety_briefing) : null,
                            'Formulir Presensi' => $item->formulir_presensi_pdf ? asset('storage/' . $item->formulir_presensi_pdf) : null,
                        ]),
                    ];
                    break;

                default:
                    return response()->json(['message' => 'Sumber laporan tidak dikenali.'], 422);
            }

            return response()->json(['data' => $data]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat detail monitoring laporan: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil detail laporan.'], 500);
        }
    }

    /**
     * Mengubah status keputusan (APPROVE/REJECT/CANCEL/PENDING) laporan,
     * ke tabel manapun sumbernya (MEDIS, SAFETY, atau PENGAWAS).
     */
    public function updateStatus(Request $request, string $sumber, int $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', self::STATUS_LIST),
        ]);

        $sumber = strtoupper($sumber);

        try {
            $nama = null;

            switch ($sumber) {
                case 'MEDIS':
                    $model = Datamedis::findOrFail($id);
                    $model->update(['keputusan' => $validated['status']]);
                    $nama = $model->nama_tenaga;
                    break;

                case 'SAFETY':
                    $model = DataSafety::findOrFail($id);
                    $model->update(['keputusan' => $validated['status']]);
                    $nama = $model->nama_tenaga;
                    break;

                case 'PENGAWAS':
                    $model = PelaporanPengawas::findOrFail($id);
                    $model->update([
                        'status' => $validated['status'],
                        'diperiksa_oleh' => $request->user()->email ?? auth()->user()?->email,
                    ]);
                    $nama = $model->nama_pengawas;
                    break;

                default:
                    return response()->json(['message' => 'Sumber laporan tidak dikenali.'], 422);
            }

            return response()->json([
                'status' => 'success',
                'message' => "Status laporan {$nama} berhasil diperbarui menjadi {$validated['status']}.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui status monitoring laporan: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan sistem saat memperbarui status.'], 500);
        }
    }

    private function filterOptions(): array
    {
        $areaMedis    = Datamedis::whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $areaSafety   = DataSafety::whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $areaPengawas = PelaporanPengawas::whereNotNull('area_kerja')->distinct()->pluck('area_kerja');

        return [
            'sumber' => self::SUMBER_LABEL,
            'status' => self::STATUS_LIST,
            'area_kerja' => $areaMedis->merge($areaSafety)->merge($areaPengawas)
                ->filter()->unique()->sort(SORT_STRING)->values(),
        ];
    }
}