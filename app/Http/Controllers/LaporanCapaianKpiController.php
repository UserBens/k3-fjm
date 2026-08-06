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
     * 6. TUNJANGAN = tunjangan_{safety|pengawas|medis} (sesuai tim) × clamp(nilai_kpi_final, skor_min, skor_max) / skor_maksimum_tunjangan
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

    // public function api(Request $request): JsonResponse
    // {
    //     $pengaturan = PengaturanKpiK3::current();

    //     $tahun = (int) ($request->query('tahun') ?: $pengaturan->tahun_aktif);
    //     $bulan = (int) ($request->query('bulan') ?: $pengaturan->bulan_aktif);

    //     // Periode cut-off: default pakai periode_manajer_* pada pengaturan aktif.
    //     // Kalau user pilih tahun/bulan lain, kita rekonstruksi periode secara sederhana
    //     // (26 bulan lalu s/d 25 bulan berjalan) mengikuti tanggal_cutoff_manajer.
    //     [$periodeMulai, $periodeSelesai] = $this->resolvePeriode($pengaturan, $tahun, $bulan);

    //     $aktivitasAktif = AktivitasKpiK3::aktif()
    //         ->where('mulai_berlaku', '<=', $tahun)
    //         ->where(function ($q) use ($tahun) {
    //             $q->whereNull('akhir_berlaku')->orWhere('akhir_berlaku', '>=', $tahun);
    //         })
    //         ->get();

    //     $hasil = [];
    // foreach (['safety' => 'SAFETY', 'pengawas' => 'PENGAWAS', 'medis' => 'MEDIS'] as $flag => $timLabel) {
    //     $aktivitasTim = $aktivitasAktif->where($flag, true)->values();
    //     $totalSkorTim = (int) $aktivitasTim->sum('skor');
    //     $targetTim = (int) $aktivitasTim->sum('target_per_bulan');

    //     $roster = $this->rosterUntukTim($flag);

    //     $petugasRows = [];
    //     $disetujuiTim = 0;
    //     $terkirimTim = 0;
    //     $kontribusiTimPersen = 0.0;
    //     $tepatWaktuTim = 0;

    //     foreach ($roster as $pegawai) {
    //         $laporan = $this->laporanUntukPegawai($flag, $pegawai, $periodeMulai, $periodeSelesai);

    //         $terkirim = $laporan->count();
    //         $disetujui = $laporan->where('is_approved', true)->count();
    //         $tepatWaktu = $laporan->where('is_approved', true)->where('tepat_waktu', true)->count();

    //         $kontribusiPersen = 0.0;
    //         if ($totalSkorTim > 0) {
    //             $grup = $laporan->where('is_approved', true)->groupBy('aktivitas_id');
    //             foreach ($grup as $aktivitasId => $items) {
    //                 $akt = $aktivitasTim->firstWhere('id', $aktivitasId);
    //                 if (!$akt || (int) $akt->target_per_bulan <= 0) {
    //                     continue;
    //                 }
    //                 $bobotAktivitas = $akt->skor / $totalSkorTim * 100;
    //                 $rasioCapaian = min($items->count() / $akt->target_per_bulan, 1);
    //                 $kontribusiPersen += $rasioCapaian * $bobotAktivitas;
    //             }
    //         }

    //         // 1. Samakan pembulatan komponen dengan di Dashboard
    //         $persentaseCapaianAktivitas = round($kontribusiPersen, 1);
    //         $persentaseKetepatanWaktu = $disetujui > 0 ? round($tepatWaktu / $disetujui * 100, 1) : 0.0;
    //         $ketepatanPersenTampil = $disetujui > 0 ? ($tepatWaktu / $disetujui * 100) : null;

    //         // 2. Hitung nilai akhir dan langsung bulatkan 1 desimal persis seperti di Dashboard
    //         $nilaiKpiFinal = round(
    //             ($persentaseCapaianAktivitas * (float) $pengaturan->porsi_capaian_aktivitas / 100)
    //                 + ($persentaseKetepatanWaktu * (float) $pengaturan->porsi_ketepatan_waktu / 100),
    //             1
    //         );

    //         $dapatTunjangan = match ($flag) {
    //             'safety' => $pengaturan->tim_safety_dapat_tunjangan,
    //             'pengawas' => $pengaturan->tim_pengawas_dapat_tunjangan,
    //             'medis' => $pengaturan->tim_medis_dapat_tunjangan,
    //         };

    //         $nominalTunjanganTim = match ($flag) {
    //             'safety'   => (float) $pengaturan->tunjangan_safety,
    //             'pengawas' => (float) $pengaturan->tunjangan_pengawas,
    //             'medis'    => (float) $pengaturan->tunjangan_medis,
    //             default    => 0.0,
    //         };

    //         $tunjangan = null;
    //         if ($dapatTunjangan) {
    //             // 3. Gunakan $nilaiKpiFinal (yang SUDAH DIBULATKAN) untuk clamp & hitung tunjangan
    //             $skorUntukTunjangan = max(
    //                 (float) $pengaturan->skor_minimum_tunjangan,
    //                 min($nilaiKpiFinal, (float) $pengaturan->skor_maksimum_tunjangan)
    //             );

    //             $tunjangan = (int) round(
    //                 $nominalTunjanganTim * ($skorUntukTunjangan / 100)
    //             );
    //         }

    //         $petugasRows[] = [
    //             'badge' => $pegawai->badge,
    //             'nama' => $pegawai->nama,
    //             'terkirim' => $terkirim,
    //             'disetujui' => $disetujui,
    //             'capaian_persen' => $persentaseCapaianAktivitas,
    //             'ketepatan_waktu_persen' => $ketepatanPersenTampil,
    //             'nilai_kpi_final' => $nilaiKpiFinal,
    //             'standby' => 'N',
    //             'hari_kerja_efektif' => $flag === 'pengawas'
    //                 ? $pengaturan->hari_kerja_efektif_p2k3
    //                 : $pengaturan->hari_kerja_efektif_manajer,
    //             'tunjangan' => $tunjangan,
    //         ];

    //         $terkirimTim += $terkirim;
    //         $disetujuiTim += $disetujui;
    //         $tepatWaktuTim += $tepatWaktu;
    //         $kontribusiTimPersen += $kontribusiPersen;
    //     }

    //     $ketepatanTimPersen = $disetujuiTim > 0 ? round($tepatWaktuTim / $disetujuiTim * 100, 1) : null;
    //     $pencapaianTimPersen = round($kontribusiTimPersen, 1);
    //     $nilaiKpiFinalTim = round(
    //         ($pencapaianTimPersen * (float) $pengaturan->porsi_capaian_aktivitas
    //             + ($ketepatanTimPersen ?? 0) * (float) $pengaturan->porsi_ketepatan_waktu) / 100,
    //         1
    //     );

    //     $kategori = $this->kategoriTim($pencapaianTimPersen, $pengaturan);

    //     $rincianAktivitas = $aktivitasTim->map(function (AktivitasKpiK3 $akt) use ($flag, $roster, $periodeMulai, $periodeSelesai, $totalSkorTim) {
    //         $disetujui = $this->hitungDisetujuiAktivitas($flag, $akt, $roster, $periodeMulai, $periodeSelesai);
    //         return [
    //             'kode' => $akt->kode,
    //             'nama_aktivitas' => $akt->nama_aktivitas,
    //             'bobot_persen' => $totalSkorTim > 0 ? round($akt->skor / $totalSkorTim * 100, 1) : 0,
    //             'target_periode' => $akt->target_per_bulan,
    //             'disetujui' => $disetujui,
    //             'aktual_pencapaian_persen' => $akt->target_per_bulan > 0
    //                 ? round($disetujui / $akt->target_per_bulan * 100, 1)
    //                 : null,
    //         ];
    //     })->values();

    //     $hasil[$flag] = [
    //         'label' => $timLabel,
    //         'target_laporan' => $targetTim,
    //         'laporan_disetujui' => $disetujuiTim,
    //         'pencapaian_persen' => $pencapaianTimPersen,
    //         'ketepatan_target_persen' => 100.0, // konstan sesuai contoh sheet Anda
    //         'ketepatan_realisasi_persen' => $ketepatanTimPersen,
    //         'nilai_kpi_final_persen' => $nilaiKpiFinalTim,
    //         'tunjangan_tim' => collect($petugasRows)->sum('tunjangan'),
    //         'kategori' => $kategori,
    //         'rincian_aktivitas' => $rincianAktivitas,
    //         'petugas' => $petugasRows,
    //     ];
    // }

    //     $totalRow = $this->hitungTotalTim($hasil, $pengaturan);

    //     return response()->json([
    //         'periode' => [
    //             'mulai' => $periodeMulai->format('d/m/Y'),
    //             'selesai' => $periodeSelesai->format('d/m/Y'),
    //             'bulan_label' => Carbon::create($tahun, $bulan, 1)->translatedFormat('F Y'),
    //         ],
    //         'tim' => $hasil,
    //         'total' => $totalRow,                                          // ⬅️ baru
    //         'total_tunjangan_seluruh_tim' => collect($hasil)->sum('tunjangan_tim'),
    //     ]);
    // }

    public function api(Request $request): JsonResponse
    {
        $tahun = (int) ($request->query('tahun') ?: PengaturanKpiK3::current()->tahun_aktif);
        $bulan = (int) ($request->query('bulan') ?: PengaturanKpiK3::current()->bulan_aktif);

        return response()->json($this->hitungLaporan($tahun, $bulan));
    }

    private function hitungLaporan(int $tahun, int $bulan): array
    {
        $pengaturan = PengaturanKpiK3::forPeriode(now()->year, now()->month);

        [$periodeMulai, $periodeSelesai] = $this->resolvePeriode($pengaturan, $tahun, $bulan);

        $aktivitasAktif = AktivitasKpiK3::aktif()
            ->where('mulai_berlaku', '<=', $tahun)
            ->where(function ($q) use ($tahun) {
                $q->whereNull('akhir_berlaku')->orWhere('akhir_berlaku', '>=', $tahun);
            })
            ->get();

        $hasil = [];
        foreach (['safety' => 'SAFETY', 'pengawas' => 'PENGAWAS', 'medis' => 'MEDIS'] as $flag => $timLabel) {
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

                    $kontribusiPersen = 0.0;
                    if ($totalSkorTim > 0) {
                        $grup = $laporan->where('is_approved', true)->groupBy('aktivitas_id');
                        foreach ($grup as $aktivitasId => $items) {
                            $akt = $aktivitasTim->firstWhere('id', $aktivitasId);
                            if (!$akt || (int) $akt->target_per_bulan <= 0) {
                                continue;
                            }
                            $bobotAktivitas = $akt->skor / $totalSkorTim * 100;
                            $rasioCapaian = min($items->count() / $akt->target_per_bulan, 1);
                            $kontribusiPersen += $rasioCapaian * $bobotAktivitas;
                        }
                    }

                    // 1. Samakan pembulatan komponen dengan di Dashboard
                    $persentaseCapaianAktivitas = round($kontribusiPersen, 1);
                    $persentaseKetepatanWaktu = $disetujui > 0 ? round($tepatWaktu / $disetujui * 100, 1) : 0.0;
                    $ketepatanPersenTampil = $disetujui > 0 ? ($tepatWaktu / $disetujui * 100) : null;

                    // 2. Hitung nilai akhir dan langsung bulatkan 1 desimal persis seperti di Dashboard
                    $nilaiKpiFinal = round(
                        ($persentaseCapaianAktivitas * (float) $pengaturan->porsi_capaian_aktivitas / 100)
                            + ($persentaseKetepatanWaktu * (float) $pengaturan->porsi_ketepatan_waktu / 100),
                        1
                    );

                    $dapatTunjangan = match ($flag) {
                        'safety' => $pengaturan->tim_safety_dapat_tunjangan,
                        'pengawas' => $pengaturan->tim_pengawas_dapat_tunjangan,
                        'medis' => $pengaturan->tim_medis_dapat_tunjangan,
                    };

                    $nominalTunjanganTim = match ($flag) {
                        'safety'   => (float) $pengaturan->tunjangan_safety,
                        'pengawas' => (float) $pengaturan->tunjangan_pengawas,
                        'medis'    => (float) $pengaturan->tunjangan_medis,
                        default    => 0.0,
                    };

                    $tunjangan = null;
                    if ($dapatTunjangan) {
                        // 3. Gunakan $nilaiKpiFinal (yang SUDAH DIBULATKAN) untuk clamp & hitung tunjangan
                        $skorUntukTunjangan = max(
                            (float) $pengaturan->skor_minimum_tunjangan,
                            min($nilaiKpiFinal, (float) $pengaturan->skor_maksimum_tunjangan)
                        );

                        $tunjangan = (int) round(
                            $nominalTunjanganTim * ($skorUntukTunjangan / 100)
                        );
                    }

                    $petugasRows[] = [
                        'badge' => $pegawai->badge,
                        'nama' => $pegawai->nama,
                        'terkirim' => $terkirim,
                        'disetujui' => $disetujui,
                        'capaian_persen' => $persentaseCapaianAktivitas,
                        'ketepatan_waktu_persen' => $ketepatanPersenTampil,
                        'nilai_kpi_final' => $nilaiKpiFinal,
                        'standby' => 'N',
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
        }

        $totalRow = $this->hitungTotalTim($hasil, $pengaturan);

        return [
            'periode' => [
                'mulai' => $periodeMulai->format('d/m/Y'),
                'selesai' => $periodeSelesai->format('d/m/Y'),
                'bulan_label' => Carbon::create($tahun, $bulan, 1)->translatedFormat('F Y'),
            ],
            'tim' => $hasil,
            'total' => $totalRow,
            'total_tunjangan_seluruh_tim' => collect($hasil)->sum('tunjangan_tim'),
        ];
    }

    public function export(Request $request)
    {
        $pengaturan = PengaturanKpiK3::forPeriode(now()->year, now()->month);
        $tahun = (int) ($request->query('tahun') ?: $pengaturan->tahun_aktif);
        $bulan = (int) ($request->query('bulan') ?: $pengaturan->bulan_aktif);

        $data = $this->hitungLaporan($tahun, $bulan);
        $filename = 'laporan-capaian-kpi-k3-' . now()->format('Ymd-His');

        return $this->exportXlsx($data, $filename);
    }

    // ─────────────────────────────────────────────────────────────
    // EXPORT EXCEL
    // ─────────────────────────────────────────────────────────────

    private function exportXlsx(array $data, string $filename)
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Capaian KPI');

        $TEAM_ORDER = [
            ['safety', 'SAFETY', '1A7A3C'],   // hijau — samakan dengan --green di dashboard
            ['pengawas', 'PENGAWAS', 'B7860B'], // gold — samakan dengan --gold
            ['medis', 'MEDIS', '2D4B9E'],     // biru — samakan dengan --blue
        ];
        $PURPLE = '3B1F6E'; // header utama & total (samakan nuansa dgn contoh sheet)
        $BLUE   = '2D4B9E';

        $row = 1;

        // ══════ HEADER PERUSAHAAN ══════
        $sheet->mergeCells('A1:C2');
        $sheet->setCellValue('A1', "PT. FOKUS JASA MITRA\nMitra Alih Daya Profesional");
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A1')->getAlignment()->setWrapText(true)->setVertical('center');

        $sheet->mergeCells('D1:J1');
        $sheet->setCellValue('D1', 'LAPORAN CAPAIAN KPI K3 - DEPARTEMEN K3 & OPERASIONAL');
        $sheet->getStyle('D1')->getFont()->setBold(true)->setSize(13);
        $sheet->getStyle('D1')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('D2:J2');
        $sheet->setCellValue('D2', "Periode Cut Off: {$data['periode']['mulai']} s/d {$data['periode']['selesai']}   |   Bulan: {$data['periode']['bulan_label']}");
        $sheet->getStyle('D2')->getFont()->setItalic(true)->setSize(10);
        $sheet->getStyle('D2')->getAlignment()->setHorizontal('center');

        $row = 4;

        // ══════ SECTION A ══════
        $colsA = ['NO', 'JENIS TIM', 'TARGET LAPORAN', 'LAPORAN DISETUJUI', 'PENCAPAIAN (%)', 'KETEPATAN TARGET', 'KETEPATAN REALISASI', 'NILAI KPI FINAL (%)', 'TUNJANGAN TIM (Rp)', 'KATEGORI'];
        $lastColA = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colsA));

        $sheet->mergeCells("A{$row}:{$lastColA}{$row}");
        $sheet->setCellValue("A{$row}", 'A. RINGKASAN CAPAIAN KPI PER TIM (petugas aktif)');
        $this->styleSectionBar($sheet, "A{$row}:{$lastColA}{$row}", $PURPLE);
        $row++;

        $sheet->fromArray($colsA, null, "A{$row}");
        $this->styleHeaderRow($sheet, "A{$row}:{$lastColA}{$row}", $PURPLE);
        $row++;

        $no = 1;
        foreach ($TEAM_ORDER as [$key, $label, $color]) {
            $t = $data['tim'][$key] ?? null;
            if (!$t) continue;

            $sheet->fromArray([
                $no++,
                $label,
                $t['target_laporan'],
                $t['laporan_disetujui'],
                $t['pencapaian_persen'] / 100,
                $t['ketepatan_target_persen'] / 100,
                $t['ketepatan_realisasi_persen'] !== null ? $t['ketepatan_realisasi_persen'] / 100 : null,
                $t['nilai_kpi_final_persen'] / 100,
                $t['tunjangan_tim'],
                $t['kategori'],
            ], null, "A{$row}");

            $sheet->getStyle("E{$row}:H{$row}")->getNumberFormat()->setFormatCode('0.0%');
            $sheet->getStyle("I{$row}")->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle("B{$row}")->getFont()->setBold(true);
            $row++;
        }

        $sheet->mergeCells("A{$row}:B{$row}");
        $sheet->setCellValue("A{$row}", 'HASIL PENCAPAIAN TIM (rata²)');
        $sheet->fromArray([
            $data['total']['target_laporan'],
            $data['total']['laporan_disetujui'],
            $data['total']['pencapaian_persen'] / 100,
            $data['total']['ketepatan_target_persen'] / 100,
            $data['total']['ketepatan_realisasi_persen'] / 100,
            $data['total']['nilai_kpi_final_persen'] / 100,
            $data['total']['tunjangan_tim'],
            $data['total']['kategori'],
        ], null, "C{$row}");
        $sheet->getStyle("E{$row}:H{$row}")->getNumberFormat()->setFormatCode('0.0%');
        $sheet->getStyle("I{$row}")->getNumberFormat()->setFormatCode('#,##0');
        $this->styleTotalRow($sheet, "A{$row}:{$lastColA}{$row}", $PURPLE);
        $row += 2;

        // ══════ SECTION B ══════
        $colsB = ['TIM', 'KODE LAPORAN', 'NAMA AKTIFITAS', 'BOBOT (%)', 'TARGET PERIODE', 'DISETUJUI', 'AKTUAL PENCAPAIAN (%)'];
        $lastColB = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colsB));

        $sheet->mergeCells("A{$row}:{$lastColB}{$row}");
        $sheet->setCellValue("A{$row}", 'B. RINCIAN CAPAIAN PER AKTIVITAS KPI (hanya program aktif — seluruh tim)');
        $this->styleSectionBar($sheet, "A{$row}:{$lastColB}{$row}", $BLUE);
        $row++;

        $sheet->fromArray($colsB, null, "A{$row}");
        $this->styleHeaderRow($sheet, "A{$row}:{$lastColB}{$row}", $BLUE);
        $row++;

        foreach ($TEAM_ORDER as [$key, $label, $color]) {
            $t = $data['tim'][$key] ?? null;
            if (!$t) continue;

            foreach ($t['rincian_aktivitas'] as $r) {
                $kosong = $r['disetujui'] === 0;
                $sheet->fromArray([
                    $label,
                    $r['kode'],
                    $r['nama_aktivitas'],
                    $r['bobot_persen'] / 100,
                    $r['target_periode'],
                    $kosong ? '-' : $r['disetujui'],
                    $r['aktual_pencapaian_persen'] !== null ? $r['aktual_pencapaian_persen'] / 100 : '-',
                ], null, "A{$row}");

                $sheet->getStyle("D{$row}")->getNumberFormat()->setFormatCode('0.0%');
                if (!$kosong) $sheet->getStyle("G{$row}")->getNumberFormat()->setFormatCode('0.0%');
                if ($kosong) {
                    $sheet->getStyle("F{$row}:G{$row}")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('FBD5D5'); // pink highlight, sama seperti di sheet contoh
                }
                $row++;
            }
        }
        $row += 1;

        // ══════ SECTION C ══════
        $colsC = ['NO', 'NAMA PETUGAS', 'TERKIRIM', 'DISETUJUI', 'CAPAIAN (%)', 'KETEPATAN WAKTU (%)', 'NILAI KPI FINAL (%)', 'STANDBY (Y/N)', 'HARI KERJA EFEKTIF', 'TUNJANGAN (Rp)'];
        $lastColC = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($colsC));

        $sheet->mergeCells("A{$row}:{$lastColC}{$row}");
        $sheet->setCellValue("A{$row}", 'C. LAPORAN PER PETUGAS & JENIS (hanya aktif · termasuk tunjangan)');
        $this->styleSectionBar($sheet, "A{$row}:{$lastColC}{$row}", $PURPLE);
        $row++;

        $sheet->fromArray($colsC, null, "A{$row}");
        $this->styleHeaderRow($sheet, "A{$row}:{$lastColC}{$row}", $PURPLE);
        $row++;

        foreach ($TEAM_ORDER as [$key, $label, $color]) {
            $t = $data['tim'][$key] ?? null;
            if (!$t) continue;

            $sheet->mergeCells("A{$row}:{$lastColC}{$row}");
            $sheet->setCellValue("A{$row}", "TIM {$label}");
            $this->styleGroupHeader($sheet, "A{$row}:{$lastColC}{$row}", $color);
            $row++;

            $terkirimTim = 0;
            $no = 1;
            foreach ($t['petugas'] as $p) {
                $kosong = $p['disetujui'] === 0;
                $sheet->fromArray([
                    $no++,
                    "{$p['nama']} ({$p['badge']})",
                    $kosong ? '-' : $p['terkirim'],
                    $kosong ? '-' : $p['disetujui'],
                    $kosong ? '-' : $p['capaian_persen'] / 100,
                    $p['ketepatan_waktu_persen'] !== null ? $p['ketepatan_waktu_persen'] / 100 : '-',
                    $kosong ? '-' : $p['nilai_kpi_final'] / 100,
                    $p['standby'],
                    $p['hari_kerja_efektif'],
                    $p['tunjangan'] ?: '-',
                ], null, "A{$row}");

                foreach (['E', 'F', 'G'] as $col) {
                    if ($sheet->getCell("{$col}{$row}")->getValue() !== '-') {
                        $sheet->getStyle("{$col}{$row}")->getNumberFormat()->setFormatCode('0.0%');
                    }
                }
                $sheet->getStyle("J{$row}")->getNumberFormat()->setFormatCode('#,##0');
                if ($kosong) {
                    $sheet->getStyle("C{$row}:G{$row}")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('FBD5D5');
                }
                $terkirimTim += $p['terkirim'];
                $row++;
            }

            $sheet->mergeCells("A{$row}:B{$row}");
            $sheet->setCellValue("A{$row}", "SUBTOTAL {$label} (aktif)");
            $sheet->fromArray([
                $terkirimTim,
                $t['laporan_disetujui'],
                $t['pencapaian_persen'] / 100,
                '',
                $t['nilai_kpi_final_persen'] / 100,
                '',
                '',
                $t['tunjangan_tim'],
            ], null, "C{$row}");
            $sheet->getStyle("E{$row}")->getNumberFormat()->setFormatCode('0.0%');
            $sheet->getStyle("G{$row}")->getNumberFormat()->setFormatCode('0.0%');
            $sheet->getStyle("J{$row}")->getNumberFormat()->setFormatCode('#,##0');
            $this->styleSubtotalRow($sheet, "A{$row}:{$lastColC}{$row}", $color);
            $row++;
        }

        $sheet->mergeCells("A{$row}:I{$row}");
        $sheet->setCellValue("A{$row}", 'TOTAL TUNJANGAN SELURUH PETUGAS AKTIF (periode ini)');
        $sheet->setCellValue("J{$row}", $data['total_tunjangan_seluruh_tim']);
        $sheet->getStyle("J{$row}")->getNumberFormat()->setFormatCode('#,##0');
        $this->styleTotalRow($sheet, "A{$row}:{$lastColC}{$row}", $PURPLE);
        $row += 3;

        // ══════ BLOK TANDA TANGAN ══════
        $sheet->mergeCells("A{$row}:C{$row}");
        $sheet->mergeCells("D{$row}:G{$row}");
        $sheet->mergeCells("H{$row}:J{$row}");
        $sheet->setCellValue("A{$row}", 'Disusun oleh,');
        $sheet->setCellValue("D{$row}", 'Diperiksa oleh,');
        $sheet->setCellValue("H{$row}", 'Disetujui oleh,');
        $sheet->getStyle("A{$row}:J{$row}")->getAlignment()->setHorizontal('center');
        $row += 4;

        $sheet->mergeCells("A{$row}:C{$row}");
        $sheet->mergeCells("D{$row}:G{$row}");
        $sheet->mergeCells("H{$row}:J{$row}");
        $sheet->setCellValue("A{$row}", '( ___________________ )');
        $sheet->setCellValue("D{$row}", '( ___________________ )');
        $sheet->setCellValue("H{$row}", '( ___________________ )');
        $sheet->getStyle("A{$row}:J{$row}")->getAlignment()->setHorizontal('center');

        // ══════ FINALISASI ══════
        foreach (range('A', $lastColC) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getColumnDimension('B')->setWidth(30); // nama tim/petugas jangan kepotong

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, "{$filename}.xlsx", [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // HELPER STYLE (dipakai bareng oleh Section A/B/C)
    // ─────────────────────────────────────────────────────────────

    private function styleSectionBar($sheet, string $range, string $hex): void
    {
        $sheet->getStyle($range)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB($hex);
        $sheet->getStyle($range)->getAlignment()->setHorizontal('left')->setVertical('center');
    }

    private function styleHeaderRow($sheet, string $range, string $hex): void
    {
        $sheet->getStyle($range)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB($hex);
        $sheet->getStyle($range)->getAlignment()->setHorizontal('center')->setVertical('center')->setWrapText(true);
        $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    private function styleGroupHeader($sheet, string $range, string $hex): void
    {
        $sheet->getStyle($range)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB($hex);
    }

    private function styleSubtotalRow($sheet, string $range, string $hex): void
    {
        $sheet->getStyle($range)->getFont()->setBold(true);
        $sheet->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33' . $hex); // versi terang
    }

    private function styleTotalRow($sheet, string $range, string $hex): void
    {
        $sheet->getStyle($range)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet->getStyle($range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB($hex);
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
        $pengaturan = PengaturanKpiK3::forPeriode(now()->year, now()->month);
        $batasTerlambat = (int) $pengaturan->batas_terlambat_lapor;
        $batasAwal = (int) $pengaturan->batas_lapor_lebih_awal;

        $normalisasi = function ($tanggalPelaksanaan, $createdAt, $aktivitasId, $statusApprove) use ($batasTerlambat, $batasAwal) {
            $selisih = $createdAt && $tanggalPelaksanaan
                ? Carbon::parse($createdAt)->startOfDay()->diffInDays(Carbon::parse($tanggalPelaksanaan)->startOfDay(), false)
                : null;

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

        // Ambil pemetaan aktivitas berdasarkan KODE dan NAMA AKTIVITAS
        $aktivitasAktif = AktivitasKpiK3::all();
        $mapKodeId = $aktivitasAktif->pluck('id', 'kode');
        $mapNamaId = $aktivitasAktif->pluck('id', 'nama_aktivitas');

        return $model::where('badge_tenaga', $pegawai->badge)
            ->whereBetween('tanggal_pelaksanaan', [$mulai, $selesai])
            ->get()
            ->map(function ($d) use ($mapKodeId, $mapNamaId, $normalisasi) {
                $aktId = $mapKodeId[$d->jenis_aktifitas_kpi] ?? ($mapNamaId[$d->jenis_aktifitas_kpi] ?? null);

                return $normalisasi(
                    $d->tanggal_pelaksanaan,
                    $d->created_at,
                    $aktId,
                    $d->keputusan === 'APPROVE'
                );
            });
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

        // Mendukung pencarian berdasarkan kode aktivitas (misal: C.2) atau nama aktivitas
        return $model::where(function ($query) use ($akt) {
            $query->where('jenis_aktifitas_kpi', $akt->kode)
                ->orWhere('jenis_aktifitas_kpi', $akt->nama_aktivitas);
        })
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
