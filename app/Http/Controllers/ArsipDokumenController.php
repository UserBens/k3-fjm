<?php

namespace App\Http\Controllers;

use App\Models\DataSafety;
use App\Models\Datamedis;
use App\Models\PelaporanPengawas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArsipDokumenController extends Controller
{
    /**
     * Peta kolom dokumen per sumber: kolom => label tampilan.
     * Dipakai untuk (1) menghitung jumlah dokumen ter-upload per baris (jumlah kolom yang tidak null),
     * dan (2) menampilkan daftar file di modal detail (skip kolom yang null).
     */
    private array $dokumenKolomSafety = [
        'foto_alat_path' => 'Foto Alat',
        'formulir_inspeksi_peralatan_path' => 'Formulir Inspeksi Peralatan',
        'formulir_kegiatan_inspeksi_peralatan_path' => 'Formulir Kegiatan Inspeksi Peralatan',
        'foto_temuan_uauc_path' => 'Foto Temuan UA/UC',
        'formulir_kegiatan_inspeksi_area_kerja_path' => 'Formulir Kegiatan Inspeksi Area Kerja',
        'formulir_observi_path' => 'Formulir Observasi',
        'formulir_kegiatan_observi_path' => 'Formulir Kegiatan Observasi',
        'safety_permit_path' => 'Safety Permit',
        'formulir_kegiatan_verifikasi_safety_permit_path' => 'Formulir Kegiatan Verifikasi Safety Permit',
        'foto_temuan_bahaya_nearmiss_path' => 'Foto Temuan Bahaya Nearmiss',
        'foto_pelaksanaan_safety_briefing_path' => 'Foto Pelaksanaan Safety Briefing',
        'foto_daftar_hadir_briefing_path' => 'Foto Daftar Hadir Briefing',
        'formulir_kegiatan_safety_briefing_path' => 'Formulir Kegiatan Safety Briefing',
        'foto_evidence_reward_path' => 'Foto Evidence Reward/Punishment',
        'formulir_kegiatan_reward_path' => 'Formulir Kegiatan Reward/Punishment',
        'foto_kegiatan_sosialisasi_keselamatan_path' => 'Foto Kegiatan Sosialisasi Keselamatan',
        'formulir_presensi_sosialisasi_keselamatan_path' => 'Formulir Presensi Sosialisasi Keselamatan',
        'formulir_kegiatan_sosialisasi_keselamatan_path' => 'Formulir Kegiatan Sosialisasi Keselamatan',
        'foto_kegiatan_dcu_path' => 'Foto Kegiatan DCU',
        'formulir_hasil_pemeriksaan_dcu_path' => 'Formulir Hasil Pemeriksaan DCU',
        'formulir_kegiatan_pemeriksaan_dcu_path' => 'Formulir Kegiatan Pemeriksaan DCU',
        'foto_kegiatan_bugar_sehat_path' => 'Foto Kegiatan Bugar Sehat',
        'formulir_presensi_bugar_sehat_path' => 'Formulir Presensi Bugar Sehat',
        'formulir_kegiatan_bugar_sehat_path' => 'Formulir Kegiatan Bugar Sehat',
        'foto_kegiatan_tes_keseimbangan_path' => 'Foto Kegiatan Tes Keseimbangan',
        'formulir_hasil_pemeriksaan_romberg_path' => 'Formulir Hasil Pemeriksaan Romberg',
        'formulir_kegiatan_tes_keseimbangan_path' => 'Formulir Kegiatan Tes Keseimbangan',
        'foto_kegiatan_sosialisasi_kesehatan_path' => 'Foto Kegiatan Sosialisasi Kesehatan',
        'formulir_presensi_sosialisasi_kesehatan_path' => 'Formulir Presensi Sosialisasi Kesehatan',
        'formulir_kegiatan_sosialisasi_kesehatan_path' => 'Formulir Kegiatan Sosialisasi Kesehatan',
        'kesesuaian_isi_p3k_path' => 'Kesesuaian Isi P3K',
        'formulir_kegiatan_inspeksi_p3k_path' => 'Formulir Kegiatan Inspeksi P3K',
    ];

    private array $dokumenKolomMedis = [
        'foto_evidence_path' => 'Foto Evidence',
        'formulir_kegiatan_path' => 'Formulir Kegiatan',
        'arsip_path' => 'Arsip',
    ];

    private array $dokumenKolomPengawas = [
        'foto_temuan_bahaya' => 'Foto Temuan Bahaya (Nearmiss)',
        'foto_kegiatan_safety_briefing' => 'Foto Kegiatan Safety Briefing',
        'formulir_presensi_pdf' => 'Formulir Presensi (PDF)',
    ];

    public function index()
    {
        return view('arsip-dokumen.index');
    }

    /**
     * Endpoint listing utama — mengembalikan dokumen sesuai tab status (approve/pending/reject/cancel),
     * paginated, dilengkapi hitungan per-tab supaya badge angka di tab selalu akurat mengikuti filter aktif.
     */
    public function data(Request $request): JsonResponse
    {
        $status = strtoupper($request->query('status', 'APPROVE'));
        $search = trim((string) $request->query('search', ''));
        $sumber = strtoupper((string) $request->query('sumber', 'SEMUA'));
        $area = (string) $request->query('area', 'SEMUA');
        $tglDari = $request->query('tanggal_dari');
        $tglSampai = $request->query('tanggal_sampai');
        $perPage = (int) $request->query('per_page', 10);

        $union = $this->queryGabungan($status, $sumber, $area, $tglDari, $tglSampai, $search);

        $paginated = DB::query()
            ->fromSub($union, 'gabungan')
            ->orderByDesc('tanggal_pelaksanaan')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        $rows = $paginated->getCollection()->values()->map(function ($row, $idx) use ($paginated) {
            return [
                'no' => $paginated->firstItem() + $idx,
                'sumber' => $row->sumber,
                'id' => $row->id,
                'tanggal_pelaksanaan' => $row->tanggal_pelaksanaan,
                'nama_petugas' => $row->nama_petugas,
                'badge' => $row->badge,
                'area_kerja' => $row->area_kerja,
                'unit_kerja' => $row->unit_kerja,
                'jenis_aktifitas_kpi' => $row->jenis_aktifitas_kpi,
                'status' => $row->status,
                'waktu_submit' => $row->waktu_submit,
                'jumlah_dokumen' => (int) $row->jumlah_dokumen,
            ];
        });

        return response()->json([
            'data' => $rows,
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'total' => $paginated->total(),
                'from' => $paginated->firstItem() ?? 0,
                'to' => $paginated->lastItem() ?? 0,
            ],
            'tab_counts' => $this->hitungTabCounts($sumber, $area, $tglDari, $tglSampai, $search),
            'area_options' => $this->areaOptions(),
        ]);
    }

    /**
     * Detail satu dokumen — ambil record asli sesuai sumber, lalu bentuk daftar file
     * ter-upload (skip kolom yang null) beserta URL storage-nya.
     */
    public function detail(string $sumber, int $id): JsonResponse
    {
        $sumber = strtoupper($sumber);

        [$row, $kolomDokumen] = match ($sumber) {
            'SAFETY' => [DataSafety::find($id), $this->dokumenKolomSafety],
            'MEDIS' => [Datamedis::find($id), $this->dokumenKolomMedis],
            'PENGAWAS' => [PelaporanPengawas::with('aktivitas')->find($id), $this->dokumenKolomPengawas],
            default => [null, []],
        };

        if (!$row) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        $dokumen = [];
        foreach ($kolomDokumen as $kolom => $label) {
            $path = $row->{$kolom} ?? null;
            if (!$path) {
                continue;
            }
            $dokumen[] = [
                'label' => $label,
                'url' => Str::startsWith($path, ['http://', 'https://']) ? $path : asset('storage/' . $path),
            ];
        }

        return response()->json([
            'data' => [
                'sumber' => $sumber,
                'id' => $row->id,
                'tanggal_pelaksanaan' => optional($row->tanggal_pelaksanaan)->format('d/m/Y'),
                'nama_petugas' => $row->nama_tenaga ?? $row->nama_pengawas ?? '-',
                'badge' => $row->badge_tenaga ?? $row->badge_pengawas ?? '-',
                'area_kerja' => $row->area_kerja ?? '-',
                'unit_kerja' => $row->unit_kerja ?? '-',
                'jenis_aktifitas_kpi' => $row->jenis_aktifitas_kpi ?? optional($row->aktivitas)->nama_aktivitas ?? '-',
                'status' => $row->keputusan ?? $row->status ?? '-',
                'waktu_submit' => optional($row->waktu_submit ?? $row->created_at)->format('d/m/Y H:i'),
                'komentar_admin' => $row->komentar_admin ?? null,
                'direview_oleh' => $row->direview_oleh ?? $row->diperiksa_oleh ?? null,
                'dokumen' => $dokumen,
            ],
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // QUERY GABUNGAN (UNION ALL 3 sumber, mirip queryGabunganLaporan di DashboardKpiK3Controller)
    // ─────────────────────────────────────────────────────────────

    private function queryGabungan(string $status, string $sumber, string $area, ?string $tglDari, ?string $tglSampai, string $search)
    {
        $jumlahDokSafety = $this->ekspresiJumlahDokumen($this->dokumenKolomSafety);
        $jumlahDokMedis = $this->ekspresiJumlahDokumen($this->dokumenKolomMedis);
        $jumlahDokPengawas = $this->ekspresiJumlahDokumen($this->dokumenKolomPengawas, 'pelaporan_pengawas');

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
            'waktu_submit',
            DB::raw("({$jumlahDokSafety}) as jumlah_dokumen"),
        ])->where('keputusan', $status);

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
            'waktu_submit',
            DB::raw("({$jumlahDokMedis}) as jumlah_dokumen"),
        ])->where('keputusan', $status);

        $pengawas = DB::table('pelaporan_pengawas')
            ->join('aktivitas_kpi_k3', 'aktivitas_kpi_k3.id', '=', 'pelaporan_pengawas.aktivitas_kpi_k3_id')
            ->select([
                DB::raw("'PENGAWAS' as sumber"),
                'pelaporan_pengawas.id',
                'pelaporan_pengawas.tanggal_pelaksanaan',
                'pelaporan_pengawas.nama_pengawas as nama_petugas',
                'pelaporan_pengawas.badge_pengawas as badge',
                'pelaporan_pengawas.area_kerja',
                'pelaporan_pengawas.unit_kerja',
                'aktivitas_kpi_k3.nama_aktivitas as jenis_aktifitas_kpi',
                'pelaporan_pengawas.status',
                DB::raw('pelaporan_pengawas.created_at as waktu_submit'),
                DB::raw("({$jumlahDokPengawas}) as jumlah_dokumen"),
            ])->where('pelaporan_pengawas.status', $status);

        if ($area && strtoupper($area) !== 'SEMUA') {
            $safety->where('area_kerja', $area);
            $medis->where('area_kerja', $area);
            $pengawas->where('pelaporan_pengawas.area_kerja', $area);
        }

        if ($tglDari) {
            $safety->whereDate('tanggal_pelaksanaan', '>=', $tglDari);
            $medis->whereDate('tanggal_pelaksanaan', '>=', $tglDari);
            $pengawas->whereDate('pelaporan_pengawas.tanggal_pelaksanaan', '>=', $tglDari);
        }
        if ($tglSampai) {
            $safety->whereDate('tanggal_pelaksanaan', '<=', $tglSampai);
            $medis->whereDate('tanggal_pelaksanaan', '<=', $tglSampai);
            $pengawas->whereDate('pelaporan_pengawas.tanggal_pelaksanaan', '<=', $tglSampai);
        }

        if ($search !== '') {
            $safety->where(fn($q) => $q->where('nama_tenaga', 'ilike', "%{$search}%")->orWhere('badge_tenaga', 'ilike', "%{$search}%"));
            $medis->where(fn($q) => $q->where('nama_tenaga', 'ilike', "%{$search}%")->orWhere('badge_tenaga', 'ilike', "%{$search}%"));
            $pengawas->where(fn($q) => $q->where('pelaporan_pengawas.nama_pengawas', 'ilike', "%{$search}%")->orWhere('pelaporan_pengawas.badge_pengawas', 'ilike', "%{$search}%"));
        }

        $parts = [];
        if ($sumber === 'SEMUA' || $sumber === 'SAFETY') $parts[] = $safety;
        if ($sumber === 'SEMUA' || $sumber === 'MEDIS') $parts[] = $medis;
        if ($sumber === 'SEMUA' || $sumber === 'PENGAWAS') $parts[] = $pengawas;

        if (empty($parts)) {
            $parts[] = $safety->whereRaw('1 = 0');
        }

        $union = array_shift($parts);
        foreach ($parts as $p) {
            $union->unionAll($p);
        }

        return $union;
    }

    /**
     * Bentuk ekspresi SQL "jumlah kolom dokumen yang terisi" — dipakai sebagai kolom jumlah_dokumen.
     * $tablePrefix diperlukan untuk pelaporan_pengawas karena query-nya pakai JOIN (kolom bisa ambigu).
     */
    private function ekspresiJumlahDokumen(array $kolomList, ?string $tablePrefix = null): string
    {
        $parts = array_map(function ($kolom) use ($tablePrefix) {
            $ref = $tablePrefix ? "{$tablePrefix}.{$kolom}" : $kolom;
            return "(CASE WHEN {$ref} IS NOT NULL AND {$ref} != '' THEN 1 ELSE 0 END)";
        }, array_keys($kolomList));

        return implode(' + ', $parts);
    }

    private function hitungTabCounts(string $sumber, string $area, ?string $tglDari, ?string $tglSampai, string $search): array
    {
        $hasil = [];
        foreach (['APPROVE', 'PENDING', 'REJECT', 'CANCEL'] as $st) {
            $union = $this->queryGabungan($st, $sumber, $area, $tglDari, $tglSampai, $search);
            $hasil[strtolower($st)] = DB::query()->fromSub($union, 'g')->count();
        }
        return $hasil;
    }

    private function areaOptions(): \Illuminate\Support\Collection
    {
        $a1 = DB::table('data_safety')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $a2 = DB::table('datamedis')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $a3 = DB::table('pelaporan_pengawas')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');

        return $a1->merge($a2)->merge($a3)->filter()->unique()->sort(SORT_STRING)->values();
    }
}
