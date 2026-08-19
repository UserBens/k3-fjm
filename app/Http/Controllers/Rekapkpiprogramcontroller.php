<?php

namespace App\Http\Controllers;

use App\Models\AktivitasKpiK3;
use App\Models\PengaturanKpiK3;
use App\Models\SafetyOfficer;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Halaman "REKAP KPI PROGRAM (LEADING)".
 *
 * Berbeda dengan DashboardKpiK3Controller (yang menghitung KPI PER PERSONIL),
 * controller ini menghitung KPI PER AKTIVITAS — capaian digabung dari SEMUA
 * personil yang ditugaskan pada aktivitas tsb — plus rekap temuan Unsafe
 * Action / Unsafe Condition per area kerja. Persis seperti dua tabel pada
 * contoh gambar yang diberikan.
 *
 * CATATAN ASUMSI (mohon disesuaikan bila keliru dengan aturan bisnis Anda):
 * 1. TARGET PERIODE = target_per_bulan x jumlah petugas yang ditugaskan pada
 *    aktivitas tsb. (Tidak memperhitungkan `target_ikut_hari_kerja_personil`
 *    di level rekap gabungan ini, karena tiap personil bisa punya hari kerja
 *    efektif berbeda — silakan sesuaikan bila ingin akurasi per-personil.)
 * 2. Jumlah "petugas ditugaskan":
 *    - SAFETY  : dihitung dari pivot aktivitas_kpi_k3_safety_officer (hanya
 *                safety officer yang is_active = true).
 *    - PENGAWAS: seluruh pengawas aktif (semua aktivitas berflag pengawas=1
 *                otomatis berlaku untuk semua pengawas — mengikuti pola
 *                DashboardKpiK3Controller::aktivitasDitugaskan()).
 *    - MEDIS   : sementara mengikuti daftar hardcode yang sama dipakai pada
 *                DashboardKpiK3Controller. Ganti jumlahPersonilTim('MEDIS')
 *                begitu Anda punya tabel master tenaga medis.
 * 3. TERKIRIM = seluruh laporan (apapun statusnya) pada aktivitas tsb dalam
 *    periode terpilih. DISETUJUI = yang berstatus APPROVE.
 * 4. Tabel B (Temuan UA/UC) hanya menghitung baris `data_unsafe` yang
 *    `keputusan` = APPROVE. Hapus filter ini bila Anda ingin menghitung
 *    seluruh temuan tanpa memandang status persetujuan.
 */
class RekapKpiProgramController extends Controller
{
    // ─────────────────────────────────────────────────────────────
    // HALAMAN
    // ─────────────────────────────────────────────────────────────

    public function index()
    {
        return view('rekap-kpi.index');
    }

    // ─────────────────────────────────────────────────────────────
    // ENDPOINT JSON
    // ─────────────────────────────────────────────────────────────

    public function api(Request $request): JsonResponse
    {
        try {
            $tahun       = (int) $request->query('tahun', now()->year);
            $bulan       = (int) $request->query('bulan', now()->month);
            $periodeType = (string) $request->query('periode_type', '26_25');
            $area        = (string) $request->query('area', 'SEMUA');
            $tim         = strtoupper((string) $request->query('tim', 'SEMUA'));

            $pengaturan = PengaturanKpiK3::forPeriode($tahun, $bulan);
            [$periodeMulai, $periodeSelesai] = $this->hitungRentangPeriode($pengaturan, $tahun, $bulan, $periodeType);

            $filters = [
                'periode_mulai'   => $periodeMulai,
                'periode_selesai' => $periodeSelesai,
                'area'            => $area,
                'tim'             => $tim,
            ];

            $capaianAktivitas = $this->rekapCapaianAktivitas($filters);
            $temuanUaUc       = $this->rekapTemuanUaUc($filters);

            return response()->json([
                'periode' => [
                    'periode_mulai'   => $periodeMulai->toDateString(),
                    'periode_selesai' => $periodeSelesai->toDateString(),
                    'bulan_label'     => $periodeSelesai->translatedFormat('F Y'),
                    'tahun'           => $tahun,
                    'bulan'           => $bulan,
                    'tim'             => $tim,
                    'area'            => $area,
                ],
                'capaian_aktivitas' => $capaianAktivitas,
                'temuan_ua_uc'      => $temuanUaUc,
                'area_options'      => $this->areaOptions(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat Rekap KPI Program: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data rekap KPI program.'], 500);
        }
    }

    // ─────────────────────────────────────────────────────────────
    // TABEL A · CAPAIAN KPI PER AKTIVITAS
    // ─────────────────────────────────────────────────────────────

    private function rekapCapaianAktivitas(array $filters): array
    {
        $mulai = $filters['periode_mulai'];
        $selesai = $filters['periode_selesai'];
        $area = $filters['area'];
        $timFilter = $filters['tim'];

        $aktivitasAktif = AktivitasKpiK3::aktif()->orderBy('kode')->get();

        $totalSkorTim = [
            'SAFETY'   => (float) AktivitasKpiK3::aktif()->where('safety', true)->sum('skor'),
            'PENGAWAS' => (float) AktivitasKpiK3::aktif()->where('pengawas', true)->sum('skor'),
            'MEDIS'    => (float) AktivitasKpiK3::aktif()->where('medis', true)->sum('skor'),
        ];

        // Ambil mentah laporan per tim sekali saja (dipakai untuk semua baris aktivitas)
        $laporanSafety   = $this->ambilLaporanTim('SAFETY', $mulai, $selesai, $area);
        $laporanPengawas = $this->ambilLaporanTim('PENGAWAS', $mulai, $selesai, $area);
        $laporanMedis    = $this->ambilLaporanTim('MEDIS', $mulai, $selesai, $area);

        $jumlahPengawasAktif = $this->jumlahPersonilTim('PENGAWAS');
        $jumlahMedisAktif    = $this->jumlahPersonilTim('MEDIS');

        $hasil = [];
        $no = 1;

        foreach ($aktivitasAktif as $aktivitas) {
            $timList = [];
            if ($aktivitas->safety)   $timList[] = 'SAFETY';
            if ($aktivitas->pengawas) $timList[] = 'PENGAWAS';
            if ($aktivitas->medis)    $timList[] = 'MEDIS';

            foreach ($timList as $tim) {
                if ($timFilter && $timFilter !== 'SEMUA' && $timFilter !== $tim) {
                    continue;
                }

                $bobot = $totalSkorTim[$tim] > 0
                    ? ($aktivitas->skor / $totalSkorTim[$tim] * 100)
                    : 0.0;

                if ($tim === 'SAFETY') {
                    // Pakai relasi belongsToMany yang sudah ada di model AktivitasKpiK3,
                    // difilter hanya safety officer yang masih aktif.
                    $jmlPetugas = $aktivitas->safetyOfficers()
                        ->where('safety_officers.is_active', true)
                        ->count();

                    $rows = $laporanSafety->filter(
                        fn($r) => $this->cocokDenganAktivitas($r->jenis_aktifitas_kpi ?? null, $aktivitas)
                    );
                } elseif ($tim === 'PENGAWAS') {
                    $jmlPetugas = $jumlahPengawasAktif;
                    $rows = $laporanPengawas->where('aktivitas_kpi_k3_id', $aktivitas->id);
                } else { // MEDIS
                    $jmlPetugas = $jumlahMedisAktif;
                    $rows = $laporanMedis->filter(
                        fn($r) => $this->cocokDenganAktivitas($r->jenis_aktifitas_kpi ?? null, $aktivitas)
                    );
                }

                $targetPeriode = (int) $aktivitas->target_per_bulan * (int) $jmlPetugas;
                $terkirim  = $rows->count();
                $disetujui = $rows->where('status', 'APPROVE')->count();
                $persenCapai = $targetPeriode > 0 ? round($disetujui / $targetPeriode * 100, 1) : 0.0;

                $hasil[] = [
                    'no'                      => $no++,
                    'sumber'                  => $tim,
                    'kode'                    => $aktivitas->kode,
                    'nama_aktivitas'          => $aktivitas->nama_aktivitas,
                    'bobot'                   => round($bobot, 1),
                    'target_per_bulan'        => (int) $aktivitas->target_per_bulan,
                    'jml_petugas_ditugaskan'  => (int) $jmlPetugas,
                    'target_periode'          => $targetPeriode,
                    'terkirim'                => $terkirim,
                    'disetujui'               => $disetujui,
                    'persen_capai'            => $persenCapai,
                ];
            }
        }

        return $hasil;
    }

    private function ambilLaporanTim(string $tim, Carbon $mulai, Carbon $selesai, string $area): Collection
    {
        $table = match ($tim) {
            'SAFETY'   => 'data_safety',
            'MEDIS'    => 'datamedis',
            default    => 'pelaporan_pengawas',
        };

        $query = DB::table($table);

        if ($tim === 'PENGAWAS') {
            $query->select('aktivitas_kpi_k3_id', 'status', 'area_kerja', 'tanggal_pelaksanaan');
        } else {
            $query->select(
                'jenis_aktifitas_kpi',
                DB::raw('keputusan as status'),
                'area_kerja',
                'tanggal_pelaksanaan'
            );
        }

        $query->whereBetween('tanggal_pelaksanaan', [$mulai->toDateTimeString(), $selesai->toDateTimeString()]);

        if ($area && strtoupper($area) !== 'SEMUA') {
            $query->where('area_kerja', $area);
        }

        return $query->get();
    }

    private function jumlahPersonilTim(string $tim): int
    {
        if ($tim === 'PENGAWAS') {
            return Pegawai::where('is_active', true)
                ->whereIn('badge', function ($q) {
                    $q->select('username')
                        ->from('pengawas_intra_users')
                        ->whereNotNull('username')
                        ->whereIn('id_api', function ($q2) {
                            $q2->select('pengguna_id')
                                ->from('pengawas_pekerjaans')
                                ->whereNotNull('pengguna_id');
                        });
                })
                ->count();
        }

        if ($tim === 'MEDIS') {
            // TODO: ganti dengan query ke tabel master tenaga medis bila sudah tersedia.
            // Untuk sekarang mengikuti jumlah daftar hardcode di DashboardKpiK3Controller.
            return 2;
        }

        return SafetyOfficer::where('is_active', true)->count();
    }

    // ─────────────────────────────────────────────────────────────
    // TABEL B · TEMUAN UNSAFE ACTION / UNSAFE CONDITION PER AREA
    // ─────────────────────────────────────────────────────────────

    private function rekapTemuanUaUc(array $filters): array
    {
        $mulai = $filters['periode_mulai'];
        $selesai = $filters['periode_selesai'];
        $area = $filters['area'];

        // Modul Unsafe Action/Condition tidak memakai alur approval (keputusan),
        // jadi semua temuan pada rentang periode & area dihitung — tidak
        // difilter berdasarkan status_temuan (OPEN/CLOSE) juga, karena rekap
        // ini menghitung SEMUA temuan yang dilaporkan pada periode tsb.
        $query = DB::table('data_unsafe')
            ->whereBetween('tanggal_temuan', [$mulai->toDateString(), $selesai->toDateString()]);

        if ($area && strtoupper($area) !== 'SEMUA') {
            $query->where('area_kerja', $area);
        }

        $rows = $query->select('area_kerja', 'jenis_penyebab')->get();

        $grouped = $rows->groupBy(fn($r) => $r->area_kerja ?: 'TANPA AREA');

        $hasil = [];
        foreach ($grouped as $areaKerja => $items) {
            $totalTemuan = $items->count();
            $unsafeAction = $items->filter(
                fn($r) => $this->normalisasiTeks($r->jenis_penyebab) === $this->normalisasiTeks('Unsafe Action')
            )->count();
            $unsafeCondition = $items->filter(
                fn($r) => $this->normalisasiTeks($r->jenis_penyebab) === $this->normalisasiTeks('Unsafe Condition')
            )->count();
            $persenUc = $totalTemuan > 0 ? round($unsafeCondition / $totalTemuan * 100, 1) : 0.0;

            $hasil[] = [
                'area_kerja'              => $areaKerja,
                'total_temuan'            => $totalTemuan,
                'unsafe_action'           => $unsafeAction,
                'unsafe_condition'        => $unsafeCondition,
                'persen_unsafe_condition' => $persenUc,
            ];
        }

        usort($hasil, fn($a, $b) => strcmp($a['area_kerja'], $b['area_kerja']));

        return $hasil;
    }


    private function areaOptions(): Collection
    {
        $a1 = DB::table('data_safety')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $a2 = DB::table('datamedis')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $a3 = DB::table('pelaporan_pengawas')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $a4 = DB::table('data_unsafe')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');

        return $a1->merge($a2)->merge($a3)->merge($a4)->filter()->unique()->sort(SORT_STRING)->values();
    }

    // ─────────────────────────────────────────────────────────────
    // PERIODE (identik dengan DashboardKpiK3Controller supaya konsisten)
    // ─────────────────────────────────────────────────────────────

    private function hitungRentangPeriode(PengaturanKpiK3 $pengaturan, int $tahun, int $bulan, string $periodeType = '26_25'): array
    {
        if ($periodeType === '1_31') {
            $mulai = Carbon::create($tahun, $bulan, 1)->startOfDay();
            $selesai = Carbon::create($tahun, $bulan, 1)->endOfMonth()->endOfDay();
            return [$mulai, $selesai];
        }

        // NB: PengaturanKpiK3 menyimpan periode manajer di kolom
        // `periode_manajer_mulai` / `periode_manajer_selesai` (bukan `periode_mulai`/`periode_selesai`).
        if ((int) $pengaturan->tahun_aktif === $tahun && (int) $pengaturan->bulan_aktif === $bulan) {
            if ($pengaturan->periode_manajer_mulai && $pengaturan->periode_manajer_selesai) {
                return [
                    Carbon::parse($pengaturan->periode_manajer_mulai)->startOfDay(),
                    Carbon::parse($pengaturan->periode_manajer_selesai)->endOfDay(),
                ];
            }
        }

        $cutoff = max(1, min(28, (int) $pengaturan->tanggal_cutoff_manajer));

        $selesai = Carbon::create($tahun, $bulan, $cutoff - 1)->endOfDay();
        $mulai = Carbon::create($tahun, $bulan, $cutoff)->subMonthNoOverflow()->startOfDay();

        return [$mulai, $selesai];
    }

    // ─────────────────────────────────────────────────────────────
    // HELPER PENCOCOKAN NAMA AKTIVITAS (identik dengan DashboardKpiK3Controller)
    // ─────────────────────────────────────────────────────────────

    private function normalisasiTeks(?string $s): string
    {
        if (!$s) return '';
        return strtolower(preg_replace('/[^a-z0-9]/i', '', $s));
    }

    private function cocokDenganAktivitas(?string $nilaiKolom, AktivitasKpiK3 $aktivitas): bool
    {
        if (!$nilaiKolom) return false;

        $nilaiNorm = $this->normalisasiTeks($nilaiKolom);
        $kodeNorm  = $this->normalisasiTeks($aktivitas->kode);
        $namaNorm  = $this->normalisasiTeks($aktivitas->nama_aktivitas);

        return $nilaiNorm === $kodeNorm || $nilaiNorm === $namaNorm;
    }
}
