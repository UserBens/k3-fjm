<?php

namespace App\Http\Controllers;

use App\Models\AktivitasKpiK3;
use App\Models\KehadiranKpiK3;
use App\Models\PengaturanKpiK3;
use App\Models\SafetyOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KpiK3MatriksController extends Controller
{
    /** Halaman utama (shell). Data tabel + pengaturan diambil lewat endpoint api(). */
    public function index()
    {
        return view('matriks-kpi.index');
    }

    /**
     * Endpoint JSON: daftar aktivitas (dengan skor & bobot % otomatis)
     * + rekap total skor per tim + data pengaturan aktif.
     */
    public function api(Request $request)
    {
        $query = AktivitasKpiK3::with('safetyOfficers.pegawai:badge,nama');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                    ->orWhere('nama_aktivitas', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($tim = $request->get('tim')) {
            // tim = safety | pengawas | medis
            if (in_array($tim, ['safety', 'pengawas', 'medis'])) {
                $query->where($tim, true);
            }
        }

        $rows = $query->orderBy('kode')->get();

        // Total skor per tim, HANYA aktivitas berstatus AKTIF (dasar pembagian bobot %)
        $totalSkorSafety   = AktivitasKpiK3::aktif()->where('safety', true)->sum('skor');
        $totalSkorPengawas = AktivitasKpiK3::aktif()->where('pengawas', true)->sum('skor');
        $totalSkorMedis    = AktivitasKpiK3::aktif()->where('medis', true)->sum('skor');

        $data = $rows->map(function (AktivitasKpiK3 $row) use ($totalSkorSafety, $totalSkorPengawas, $totalSkorMedis) {

            $aktif = $row->status === 'AKTIF';

            return [
                'id'                => $row->id,
                'kode'              => $row->kode,
                'nama_aktivitas'    => $row->nama_aktivitas,
                'kompleksitas'      => $row->kompleksitas,
                'label_kompleksitas' => $row->label_kompleksitas,
                'frekuensi'         => $row->frekuensi,
                'label_frekuensi'   => $row->label_frekuensi,
                'skor'              => $row->skor,
                'target_per_bulan'  => $row->target_per_bulan,
                'ikut_hari_kerja'   => $row->ikut_hari_kerja,
                'maks_per_hari'     => $row->maks_per_hari,
                'mulai_berlaku'     => $row->mulai_berlaku,
                'akhir_berlaku'     => $row->akhir_berlaku,
                'safety'            => $row->safety,
                'pengawas'          => $row->pengawas,
                'medis'             => $row->medis,
                'status'            => $row->status,
                // Bobot % dihitung on-the-fly = skor baris / total skor tim (aktif) x 100
                'bobot_safety'      => ($aktif && $row->safety && $totalSkorSafety > 0)
                    ? round($row->skor / $totalSkorSafety * 100, 1) : 0,
                'bobot_pengawas'    => ($aktif && $row->pengawas && $totalSkorPengawas > 0)
                    ? round($row->skor / $totalSkorPengawas * 100, 1) : 0,
                'bobot_medis'       => ($aktif && $row->medis && $totalSkorMedis > 0)
                    ? round($row->skor / $totalSkorMedis * 100, 1) : 0,

                'safety_officers' => $row->safetyOfficers->map(fn($so) => [
                    'badge' => $so->badge,
                    'nama'  => $so->pegawai->nama ?? $so->badge,
                ])->values(),
            ];
        });

        return response()->json([
            'data' => $data,
            'summary' => [
                'total_skor'          => $rows->sum('skor'),
                'total_target'        => $rows->sum('target_per_bulan'),
                'total_skor_safety'   => $totalSkorSafety,
                'total_skor_pengawas' => $totalSkorPengawas,
                'total_skor_medis'    => $totalSkorMedis,
            ],
            'pengaturan' => PengaturanKpiK3::forPeriode(now()->year, now()->month),
        ]);
    }

    /** Simpan aktivitas baru (dari modal Tambah). */
    public function store(Request $request)
    {
        $validated = $this->validateAktivitas($request);
        $row = AktivitasKpiK3::create($validated);
        $this->syncSafetyOfficers($row, $request->input('safety_officer_badges', []));

        return response()->json([
            'message' => "Aktivitas {$row->kode} berhasil ditambahkan.",
            'data' => $row->load('safetyOfficers.pegawai'),
        ]);
    }

    public function update(Request $request, AktivitasKpiK3 $aktivitasKpiK3)
    {
        $validated = $this->validateAktivitas($request, $aktivitasKpiK3->id);
        $aktivitasKpiK3->update($validated);
        $this->syncSafetyOfficers($aktivitasKpiK3, $request->input('safety_officer_badges', []));

        return response()->json([
            'message' => "Aktivitas {$aktivitasKpiK3->kode} berhasil diperbarui.",
            'data' => $aktivitasKpiK3->load('safetyOfficers.pegawai'),
        ]);
    }

    private function syncSafetyOfficers(AktivitasKpiK3 $row, array $badges): void
    {
        if (! $row->safety) {
            $row->safetyOfficers()->sync([]);
            return;
        }
        $row->safetyOfficers()->sync($badges);
    }

    /** Hapus aktivitas. */
    public function destroy(AktivitasKpiK3 $aktivitasKpiK3)
    {
        $kode = $aktivitasKpiK3->kode;
        $aktivitasKpiK3->delete();

        return response()->json(['message' => "Aktivitas {$kode} berhasil dihapus."]);
    }

    /** Update panel Pengaturan (bagian 1-6). */
    /** GET pengaturan utk periode tertentu (default: bulan berjalan). */
    public function pengaturanShow(Request $request)
    {
        $tahun = (int) $request->query('tahun', now()->year);
        $bulan = (int) $request->query('bulan', now()->month);

        $pengaturan = PengaturanKpiK3::forPeriode($tahun, $bulan);

        return response()->json([
            'data'   => $pengaturan,
            'exists' => $pengaturan->exists, // false = belum pernah disimpan utk periode ini (masih draft/salinan)
        ]);
    }

    /** GET daftar periode yang sudah pernah disimpan (utk dropdown histori). */
    public function pengaturanPeriodeList()
    {
        return response()->json(PengaturanKpiK3::daftarPeriodeTersimpan());
    }

    /** Simpan/Update pengaturan utk periode (tahun_aktif, bulan_aktif) yang dikirim. */
    public function updatePengaturan(Request $request)
    {
        $validated = $request->validate([
            'tahun_aktif' => 'required|integer|min:2000|max:2100',
            'bulan_aktif' => 'required|integer|min:1|max:12',
            'tanggal_cutoff_manajer' => 'required|integer|min:1|max:31',
            'periode_manajer_mulai' => 'required|date',
            'periode_manajer_selesai' => 'required|date|after_or_equal:periode_manajer_mulai',
            'periode_p2k3_mulai' => 'required|date',
            'periode_p2k3_selesai' => 'required|date|after_or_equal:periode_p2k3_mulai',
            'hari_kerja_efektif_manajer' => 'required|integer|min:0|max:31',
            'hari_kerja_efektif_p2k3' => 'required|integer|min:0|max:31',
            'jumlah_hari_kalender_manajer' => 'required|integer|min:0|max:31',
            'jumlah_hari_kalender_p2k3' => 'required|integer|min:0|max:31',
            'batas_terlambat_lapor' => 'required|integer|min:0',
            'batas_lapor_lebih_awal' => 'required|integer|min:0',
            'porsi_capaian_aktivitas' => 'required|numeric|min:0|max:100',
            'porsi_ketepatan_waktu' => 'required|numeric|min:0|max:100',
            'tunjangan_safety' => 'required|integer|min:0',
            'tunjangan_pengawas' => 'required|integer|min:0',
            'tunjangan_medis' => 'required|integer|min:0',
            'skor_minimum_tunjangan' => 'required|numeric|min:0|max:100',
            'skor_maksimum_tunjangan' => 'required|numeric|min:0|max:100',
            'tim_safety_dapat_tunjangan' => 'required|boolean',
            'tim_pengawas_dapat_tunjangan' => 'required|boolean',
            'tim_medis_dapat_tunjangan' => 'required|boolean',
            'ambang_merah' => 'required|numeric|min:0|max:100',
            'ambang_kuning' => 'required|numeric|min:0|max:100',
        ]);

        $pengaturan = PengaturanKpiK3::updateOrCreate(
            ['tahun_aktif' => $validated['tahun_aktif'], 'bulan_aktif' => $validated['bulan_aktif']],
            $validated
        );

        return response()->json([
            'message' => "Pengaturan KPI K3 periode {$validated['bulan_aktif']}/{$validated['tahun_aktif']} berhasil disimpan.",
            'data' => $pengaturan->fresh(),
        ]);
    }

    private function validateAktivitas(Request $request, ?int $ignoreId = null): array
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:aktivitas_kpi_k3,kode' . ($ignoreId ? ",{$ignoreId}" : ''),
            'nama_aktivitas' => 'required|string|max:255',
            'kompleksitas' => 'required|integer|in:1,2,3',
            'frekuensi' => 'required|integer|in:1,2,3',
            'target_per_bulan' => 'required|integer|min:0',
            'ikut_hari_kerja' => 'required|boolean',
            'maks_per_hari' => 'required|integer|min:0',
            'mulai_berlaku' => 'required|integer|min:2000|max:2100',
            'akhir_berlaku' => 'nullable|integer|min:2000|max:2100',
            'safety' => 'required|boolean',
            'pengawas' => 'required|boolean',
            'medis' => 'required|boolean',
            'status' => 'required|in:AKTIF,NONAKTIF',
            'safety_officer_badges'   => 'nullable|array',
            'safety_officer_badges.*' => 'string|exists:safety_officers,badge',
        ]);

        return $validator->validate();
    }

    public function safetyOfficerOptions()
    {
        $officers = SafetyOfficer::where('is_active', true)
            ->with('pegawai:badge,nama')
            ->get()
            ->map(fn($so) => [
                'badge' => $so->badge,
                'nama'  => $so->pegawai->nama ?? $so->badge,
            ])
            ->values();

        return response()->json($officers);
    }

    public function rekapSafetyOfficer()
    {
        $aktivitasList = AktivitasKpiK3::aktif()->where('safety', true)->orderBy('kode')->get();
        $totalSkorTim  = $aktivitasList->sum('skor');

        $officers = SafetyOfficer::where('is_active', true)
            ->with([
                'pegawai:badge,nama',
                'aktivitasKpi' => fn($q) => $q->where('status', 'AKTIF')->where('safety', true),
            ])
            ->get();

        $data = $officers->map(function (SafetyOfficer $so) use ($aktivitasList, $totalSkorTim) {
            $assignedIds = $so->aktivitasKpi->pluck('id')->all();
            $skorTugas   = $so->aktivitasKpi->sum('skor');

            return [
                'badge'            => $so->badge,
                'nama'             => $so->pegawai->nama ?? $so->badge,
                'checklist'        => $aktivitasList->mapWithKeys(
                    fn($a) => [$a->kode => in_array($a->id, $assignedIds)]
                ),
                'skor_tugas'       => $skorTugas,
                'bobot_ditugaskan' => $totalSkorTim > 0 ? round($skorTugas / $totalSkorTim * 100, 1) : 0,
                'jumlah_tugas'     => count($assignedIds),
            ];
        })->sortByDesc('skor_tugas')->values();

        return response()->json([
            'aktivitas'      => $aktivitasList->map(fn($a) => [
                'kode' => $a->kode,
                'nama' => $a->nama_aktivitas,
                'skor' => $a->skor,
            ]),
            'officers'       => $data,
            'total_skor_tim' => $totalSkorTim,
        ]);
    }
    
    public function kehadiranIndex(Request $request)
    {
        $tahun = (int) $request->query('tahun', now()->year);
        $bulan = (int) $request->query('bulan', now()->month);

        $officers = SafetyOfficer::where('is_active', true)
            ->with('pegawai:badge,nama')
            ->orderBy('badge')
            ->get();

        $kehadiranMap = KehadiranKpiK3::where('tahun_aktif', $tahun)
            ->where('bulan_aktif', $bulan)
            ->get()
            ->keyBy('badge');

        $data = $officers->map(function (SafetyOfficer $so) use ($kehadiranMap) {
            $k = $kehadiranMap->get($so->badge);
            return [
                'badge'                     => $so->badge,
                'nama'                      => $so->pegawai->nama ?? $so->badge,
                'hari_cuti_izin_sakit_alfa' => $k->hari_cuti_izin_sakit_alfa ?? 0,
                'hari_standby'              => $k->hari_standby ?? 0,
            ];
        })->values();

        return response()->json(['data' => $data, 'tahun' => $tahun, 'bulan' => $bulan]);
    }

    public function kehadiranUpdate(Request $request)
    {
        $validated = $request->validate([
            'tahun_aktif' => 'required|integer|min:2000|max:2100',
            'bulan_aktif' => 'required|integer|min:1|max:12',
            'items' => 'required|array|min:1',
            'items.*.badge' => 'required|string|exists:safety_officers,badge',
            'items.*.hari_cuti_izin_sakit_alfa' => 'required|integer|min:0|max:31',
            'items.*.hari_standby' => 'required|integer|min:0|max:31',
        ]);

        foreach ($validated['items'] as $item) {
            KehadiranKpiK3::updateOrCreate(
                [
                    'badge' => $item['badge'],
                    'tahun_aktif' => $validated['tahun_aktif'],
                    'bulan_aktif' => $validated['bulan_aktif'],
                ],
                [
                    'hari_cuti_izin_sakit_alfa' => $item['hari_cuti_izin_sakit_alfa'],
                    'hari_standby' => $item['hari_standby'],
                ]
            );
        }

        return response()->json(['message' => 'Data kehadiran berhasil disimpan.']);
    }
}
