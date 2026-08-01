<?php

namespace App\Http\Controllers;

use App\Models\AktivitasKpiK3;
use App\Models\Datamedis;
use App\Models\DataSafety;
use App\Models\Pegawai;
use App\Models\PelaporanPengawas;
use App\Models\PengaturanKpiK3;
use App\Models\PengawasPekerjaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class LaporanCapaianKpiController extends Controller
{
    /**
     * ============================================================
     * CATATAN ASUMSI PERHITUNGAN (harap divalidasi ke Excel asli)
     * ============================================================
     * 1. ROSTER PER TIM diambil dari MASTER, bukan dari tabel laporan,
     *    supaya petugas yang belum pernah lapor tetap muncul (0%):
     *      - SAFETY   : pegawais.is_safety_officer = true & is_active = true
     *      - PENGAWAS : pegawais yg id_api-nya ada di pengawas_pekerjaans.pegawai_id (distinct) & is_active
     *      - MEDIS    : daftar badge tetap di $this->medisBadges (hanya 1 org saat ini)
     *
     * 2. TARGET TIM (Section A) = SUM(target_per_bulan) aktivitas_kpi_k3
     *    yang AKTIF & flag tim = true & berlaku di tahun aktif.
     *
     * 3. KONTRIBUSI/CAPAIAN PER PETUGAS (Section C) TIDAK dibagi rata,
     *    tapi dihitung dari bobot aktivitas yang benar-benar ia laporkan (disetujui):
     *
     *      kontribusi_petugas% = Σ [ (disetujui_orang_ini_utk_aktivitas_X / target_per_bulan_X) × bobot_X% ]
     *
     *    dimana bobot_X% = skor_X / total_skor_tim × 100 (persis logic AktivitasKpiK3 yang sudah ada).
     *    Jumlah seluruh kontribusi_petugas% dalam satu tim = Pencapaian% tim (Section A).
     *
     * 4. KETEPATAN WAKTU per petugas = laporan disetujui yang tepat waktu / total disetujui.
     *    "Tepat waktu" = selisih hari (tanggal submit vs tanggal_pelaksanaan) berada dalam
     *    batas_terlambat_lapor & batas_lapor_lebih_awal (pengaturan_kpi_k3). Sesuaikan arah
     *    perbandingan jika definisi "terlambat/lebih awal" di lapangan berbeda.
     *
     * 5. NILAI KPI FINAL = (kontribusi% × porsi_capaian_aktivitas + ketepatan% × porsi_ketepatan_waktu) / 100
     *
     * 6. TUNJANGAN = tunjangan_penuh × clamp(nilai_kpi_final, skor_min, skor_max) / skor_maksimum_tunjangan
     *    hanya jika tim_{safety|pengawas|medis}_dapat_tunjangan = true.
     *
     * 7. KATEGORI (BAIK/CUKUP/PERLU PERBAIKAN) ada di LEVEL TIM (Section A), berdasarkan
     *    Pencapaian% tim dibanding ambang_kuning / ambang_merah (bukan nilai KPI final):
     *      >= ambang_kuning  -> BAIK
     *      >= ambang_merah   -> CUKUP
     *      < ambang_merah    -> PERLU PERBAIKAN
     * ============================================================
     */

    // TODO: pindahkan ke tabel/config kalau tenaga medis lebih dari satu.
    private array $medisBadges = [
        'K.250455', // MUHAMMAD HAFIZ MAULANA
    ];

    public function index()
    {
        return view('laporan-capaian-kpi.index');
    }

    public function api(Request $request): JsonResponse
    {
        $pengaturan = PengaturanKpiK3::current();

        $tahun = (int) ($request->query('tahun') ?: $pengaturan->tahun_aktif);
        $bulan = (int) ($request->query('bulan') ?: $pengaturan->bulan_aktif);

        // Periode cut-off: default pakai periode_manajer_* pada pengaturan aktif.
        // Kalau user pilih tahun/bulan lain, kita rekonstruksi periode secara sederhana
        // (26 bulan lalu s/d 25 bulan berjalan) mengikuti tanggal_cutoff_manajer.
        [$periodeMulai, $periodeSelesai] = $this->resolvePeriode($pengaturan, $tahun, $bulan);

        $aktivitasAktif = AktivitasKpiK3::aktif()
            ->where('mulai_berlaku', '<=', $tahun)
            ->where(function ($q) use ($tahun) {
                $q->whereNull('akhir_berlaku')->orWhere('akhir_berlaku', '>=', $tahun);
            })
            ->get();

        $hasil = [];
        foreach (['safety' => 'SAFETY', 'pengawas' => 'PENGAWAS', 'medis' => 'MEDIS'] as $flag => $timLabel) {
            $aktivitasTim = $aktivitasAktif->where($flag, true)->values();
            $totalSkorTim = (int) $aktivitasTim->sum('skor');
            $targetTim = (int) $aktivitasTim->sum('target_per_bulan');

            $roster = $this->rosterUntukTim($flag);

            $petugasRows = [];
            $disetujuiTim = 0;
            $terkirimTim = 0;
            $kontribusiTimPersen = 0.0;
            $tepatWaktuTim = 0;

            foreach ($roster as $pegawai) {
                $laporan = $this->laporanUntukPegawai($flag, $pegawai, $periodeMulai, $periodeSelesai);

                $terkirim = $laporan->count();
                $disetujui = $laporan->where('is_approved', true)->count();
                $tepatWaktu = $laporan->where('is_approved', true)->where('tepat_waktu', true)->count();

                // Kontribusi% berbasis bobot aktivitas yang benar-benar dilaporkan (lihat catatan #3)
                $kontribusiPersen = 0.0;
                if ($totalSkorTim > 0) {
                    $grup = $laporan->where('is_approved', true)->groupBy('aktivitas_id');
                    foreach ($grup as $aktivitasId => $items) {
                        $akt = $aktivitasTim->firstWhere('id', $aktivitasId);
                        if (!$akt || (int) $akt->target_per_bulan <= 0) {
                            continue;
                        }
                        $bobotAktivitas = $akt->skor / $totalSkorTim * 100;
                        $kontribusiPersen += ($items->count() / $akt->target_per_bulan) * $bobotAktivitas;
                    }
                }

                $ketepatanPersen = $disetujui > 0 ? round($tepatWaktu / $disetujui * 100, 1) : null;
                $nilaiKpiFinal = round(
                    ($kontribusiPersen * (float) $pengaturan->porsi_capaian_aktivitas
                        + ($ketepatanPersen ?? 0) * (float) $pengaturan->porsi_ketepatan_waktu) / 100,
                    1
                );

                $dapatTunjangan = match ($flag) {
                    'safety' => $pengaturan->tim_safety_dapat_tunjangan,
                    'pengawas' => $pengaturan->tim_pengawas_dapat_tunjangan,
                    'medis' => $pengaturan->tim_medis_dapat_tunjangan,
                };
                $tunjangan = null;
                if ($dapatTunjangan) {
                    $clamped = min(
                        max($nilaiKpiFinal, (float) $pengaturan->skor_minimum_tunjangan),
                        (float) $pengaturan->skor_maksimum_tunjangan
                    );
                    $tunjangan = (int) round(
                        (float) $pengaturan->tunjangan_penuh * $clamped / (float) $pengaturan->skor_maksimum_tunjangan
                    );
                }

                $petugasRows[] = [
                    'badge' => $pegawai->badge,
                    'nama' => $pegawai->nama,
                    'terkirim' => $terkirim,
                    'disetujui' => $disetujui,
                    'capaian_persen' => round($kontribusiPersen, 1),
                    'ketepatan_waktu_persen' => $ketepatanPersen,
                    'nilai_kpi_final' => $nilaiKpiFinal,
                    'standby' => 'N', // tidak ada sumber datanya di skema saat ini
                    'hari_kerja_efektif' => $flag === 'pengawas'
                        ? $pengaturan->hari_kerja_efektif_p2k3
                        : $pengaturan->hari_kerja_efektif_manajer,
                    'tunjangan' => $tunjangan,
                ];

                $terkirimTim += $terkirim;
                $disetujuiTim += $disetujui;
                $tepatWaktuTim += $tepatWaktu;
                $kontribusiTimPersen += $kontribusiPersen;
            }

            $ketepatanTimPersen = $disetujuiTim > 0 ? round($tepatWaktuTim / $disetujuiTim * 100, 1) : null;
            $pencapaianTimPersen = round($kontribusiTimPersen, 1);
            $nilaiKpiFinalTim = round(
                ($pencapaianTimPersen * (float) $pengaturan->porsi_capaian_aktivitas
                    + ($ketepatanTimPersen ?? 0) * (float) $pengaturan->porsi_ketepatan_waktu) / 100,
                1
            );

            $kategori = $this->kategoriTim($pencapaianTimPersen, $pengaturan);

            $rincianAktivitas = $aktivitasTim->map(function (AktivitasKpiK3 $akt) use ($flag, $roster, $periodeMulai, $periodeSelesai, $totalSkorTim) {
                $disetujui = $this->hitungDisetujuiAktivitas($flag, $akt, $roster, $periodeMulai, $periodeSelesai);
                return [
                    'kode' => $akt->kode,
                    'nama_aktivitas' => $akt->nama_aktivitas,
                    'bobot_persen' => $totalSkorTim > 0 ? round($akt->skor / $totalSkorTim * 100, 1) : 0,
                    'target_periode' => $akt->target_per_bulan,
                    'disetujui' => $disetujui,
                    'aktual_pencapaian_persen' => $akt->target_per_bulan > 0
                        ? round($disetujui / $akt->target_per_bulan * 100, 1)
                        : null,
                ];
            })->values();

            $hasil[$flag] = [
                'label' => $timLabel,
                'target_laporan' => $targetTim,
                'laporan_disetujui' => $disetujuiTim,
                'pencapaian_persen' => $pencapaianTimPersen,
                'ketepatan_target_persen' => 100.0, // konstan sesuai contoh sheet Anda
                'ketepatan_realisasi_persen' => $ketepatanTimPersen,
                'nilai_kpi_final_persen' => $nilaiKpiFinalTim,
                'tunjangan_tim' => collect($petugasRows)->sum('tunjangan'),
                'kategori' => $kategori,
                'rincian_aktivitas' => $rincianAktivitas,
                'petugas' => $petugasRows,
            ];
        }

        $totalRow = $this->hitungTotalTim($hasil, $pengaturan);

        return response()->json([
            'periode' => [
                'mulai' => $periodeMulai->format('d/m/Y'),
                'selesai' => $periodeSelesai->format('d/m/Y'),
                'bulan_label' => Carbon::create($tahun, $bulan, 1)->translatedFormat('F Y'),
            ],
            'tim' => $hasil,
            'total' => $totalRow,                                          // ⬅️ baru
            'total_tunjangan_seluruh_tim' => collect($hasil)->sum('tunjangan_tim'),
        ]);
    }

    private function hitungTotalTim(array $hasil, PengaturanKpiK3 $pengaturan): array
    {
        $timList = collect($hasil);
        $jumlahTim = $timList->count();

        if ($jumlahTim === 0) {
            return [
                'target_laporan' => 0,
                'laporan_disetujui' => 0,
                'pencapaian_persen' => 0.0,
                'ketepatan_target_persen' => 100.0,
                'ketepatan_realisasi_persen' => 0.0,
                'nilai_kpi_final_persen' => 0.0,
                'tunjangan_tim' => 0,
                'kategori' => 'PERLU PERBAIKAN',
            ];
        }

        $rataPencapaian = round($timList->avg('pencapaian_persen'), 1);
        $rataKetepatanTarget = round($timList->avg('ketepatan_target_persen'), 1);
        $rataKetepatanRealisasi = round($timList->avg(fn($t) => $t['ketepatan_realisasi_persen'] ?? 0), 1);
        $rataNilaiKpiFinal = round($timList->avg('nilai_kpi_final_persen'), 1);

        return [
            'target_laporan' => (int) $timList->sum('target_laporan'),
            'laporan_disetujui' => (int) $timList->sum('laporan_disetujui'),
            'pencapaian_persen' => $rataPencapaian,
            'ketepatan_target_persen' => $rataKetepatanTarget,
            'ketepatan_realisasi_persen' => $rataKetepatanRealisasi,
            'nilai_kpi_final_persen' => $rataNilaiKpiFinal,
            'tunjangan_tim' => (int) $timList->sum('tunjangan_tim'),
            'kategori' => $this->kategoriTim($rataPencapaian, $pengaturan),
        ];
    }

    private function resolvePeriode(PengaturanKpiK3 $pengaturan, int $tahun, int $bulan): array
    {
        if ($tahun === (int) $pengaturan->tahun_aktif && $bulan === (int) $pengaturan->bulan_aktif) {
            return [$pengaturan->periode_manajer_mulai, $pengaturan->periode_manajer_selesai];
        }

        $cutoff = (int) $pengaturan->tanggal_cutoff_manajer;
        $selesai = Carbon::create($tahun, $bulan, $cutoff - 1);
        $mulai = (clone $selesai)->subMonthNoOverflow()->addDay();

        return [$mulai, $selesai];
    }

    private function rosterUntukTim(string $flag): Collection
    {
        return match ($flag) {
            'safety' => Pegawai::where('is_safety_officer', true)->where('is_active', true)
                ->orderBy('nama')->get(),

            // ⬇️ diperbaiki: roster pengawas diambil dari pengguna_id (si pemeriksa),
            // bukan pegawai_id (pegawai yang diperiksa)
            'pengawas' => Pegawai::where('is_active', true)
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
                ->orderBy('nama')->get(),

            'medis' => Pegawai::where('is_active', true)
                ->whereIn('badge', $this->medisBadges)
                ->orderBy('nama')->get(),

            default => collect(),
        };
    }

    /**
     * Ambil laporan milik satu pegawai untuk satu tim, dinormalisasi ke bentuk
     * seragam: aktivitas_id, is_approved, tepat_waktu.
     */
    private function laporanUntukPegawai(string $flag, Pegawai $pegawai, Carbon $mulai, Carbon $selesai): Collection
    {
        $pengaturan = PengaturanKpiK3::current();
        $batasTerlambat = (int) $pengaturan->batas_terlambat_lapor;
        $batasAwal = (int) $pengaturan->batas_lapor_lebih_awal;

        $normalisasi = function ($tanggalPelaksanaan, $createdAt, $aktivitasId, $statusApprove) use ($batasTerlambat, $batasAwal) {
            $selisih = $createdAt && $tanggalPelaksanaan
                ? Carbon::parse($createdAt)->startOfDay()->diffInDays(Carbon::parse($tanggalPelaksanaan)->startOfDay(), false)
                : null;
            // selisih negatif = submit setelah tanggal pelaksanaan (terlambat)
            $tepatWaktu = $selisih === null
                ? false
                : ($selisih >= -$batasTerlambat && $selisih <= $batasAwal);

            return [
                'aktivitas_id' => $aktivitasId,
                'is_approved' => $statusApprove,
                'tepat_waktu' => $tepatWaktu,
            ];
        };

        if ($flag === 'pengawas') {
            return PelaporanPengawas::where('badge_pengawas', $pegawai->badge)
                ->whereBetween('tanggal_pelaksanaan', [$mulai, $selesai])
                ->get()
                ->map(fn(PelaporanPengawas $p) => $normalisasi(
                    $p->tanggal_pelaksanaan,
                    $p->created_at,
                    $p->aktivitas_kpi_k3_id,
                    $p->status === 'APPROVE'
                ));
        }

        $model = $flag === 'safety' ? DataSafety::class : Datamedis::class;
        $aktivitasByNama = AktivitasKpiK3::pluck('id', 'nama_aktivitas');

        return $model::where('badge_tenaga', $pegawai->badge)
            ->whereBetween('tanggal_pelaksanaan', [$mulai, $selesai])
            ->get()
            ->map(fn($d) => $normalisasi(
                $d->tanggal_pelaksanaan,
                $d->created_at,
                $aktivitasByNama[$d->jenis_aktifitas_kpi] ?? null,
                $d->keputusan === 'APPROVE'
            ));
    }

    private function hitungDisetujuiAktivitas(string $flag, AktivitasKpiK3 $akt, Collection $roster, Carbon $mulai, Carbon $selesai): int
    {
        $badges = $roster->pluck('badge')->filter()->all();
        if (empty($badges)) {
            return 0;
        }

        if ($flag === 'pengawas') {
            return PelaporanPengawas::where('aktivitas_kpi_k3_id', $akt->id)
                ->where('status', 'APPROVE')
                ->whereIn('badge_pengawas', $badges)
                ->whereBetween('tanggal_pelaksanaan', [$mulai, $selesai])
                ->count();
        }

        $model = $flag === 'safety' ? DataSafety::class : Datamedis::class;

        return $model::where('jenis_aktifitas_kpi', $akt->nama_aktivitas)
            ->where('keputusan', 'APPROVE')
            ->whereIn('badge_tenaga', $badges)
            ->whereBetween('tanggal_pelaksanaan', [$mulai, $selesai])
            ->count();
    }

    private function kategoriTim(float $pencapaianPersen, PengaturanKpiK3 $pengaturan): string
    {
        if ($pencapaianPersen >= (float) $pengaturan->ambang_kuning) {
            return 'BAIK';
        }
        if ($pencapaianPersen >= (float) $pengaturan->ambang_merah) {
            return 'CUKUP';
        }
        return 'PERLU PERBAIKAN';
    }
}
