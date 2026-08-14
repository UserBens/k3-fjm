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
use Illuminate\Support\Facades\DB;

class LaporanCapaianKpiController extends Controller
{
    private array $medisBadges = [
        'K.250455', // MUHAMMAD HAFIZ MAULANA
    ];

    private array $pengawasRoster = [
        'K.202287'    => 'ABD. RAHMAN',
        'K.201352'    => 'ACHMAT NAIM',
        'K.200702'    => 'AGUNG RUDYANTO',
        'LJ.23301024' => 'ACHMAD ANDI BURHANSYAH',
        'K.201613'    => 'ANWAR EDI SANTOSO',
        'K.250625'    => 'SURATMAN',
        'K.200266'    => 'BACHTIAR EFENDI',
        'K.201340'    => 'H. SUNANDAR',
        'K.250257'    => 'GUNTARA SETIAWAN',
        'K.210011'    => 'INDARTO',
        'K.202191'    => 'M. DHAMIRI LATHIF',
        'K.230080'    => 'KHOIRUDDIN',
        'K.200438'    => 'M. SYARIFUDDIN',
        'K.201549'    => 'MITOHADI',
        'K.200771'    => 'MUNIF',
        'K.250229'    => 'MOH. MIFTACHUL FADLI',
        'K.200425'    => 'NANANG QOSIM',
        'K.201356'    => 'RAUF ADE ARIEF',
        'K.022104'    => 'SUSANTO',
        'K.201328'    => 'SYARONI',
        'K.202573'    => 'FERRY ARDIANSYAH',
        'K.250364'    => 'M. ABIDZAN ZAHID',
        'K.250470'    => 'BERNARD ADERIANUS NESIMNASI',
        'K.201044'    => 'M. SUBAKTI',
        'K.200765'    => 'SLAMET ARIYADI',
        'K.201544'    => 'AGUS PRASETYO',
        'K.202092'    => 'ACHMAD ROFI A.',
        'K.210031'    => 'SYAFIK',
        'K.230251'    => 'M. MUZAYYIN',
        'K.202037'    => 'MOCH. LUCKY WICAKSONO',
        'K.200915'    => 'SUGIONO',
        'K.200919'    => 'SYAIFUL ROMADANI',
        'K.250143'    => 'MOH. AMIRUDIN RIFAI',
    ];

    private function normalisasiTeksPersonil(?string $s): string
    {
        if (!$s) return '';
        return strtolower(preg_replace('/[^a-z0-9]/i', '', $s));
    }

    private function cocokDenganAktivitasPersonil(?string $nilaiKolom, AktivitasKpiK3 $aktivitas): bool
    {
        if (!$nilaiKolom) return false;
        $nilaiNorm = $this->normalisasiTeksPersonil($nilaiKolom);
        $kodeNorm  = $this->normalisasiTeksPersonil($aktivitas->kode);
        $namaNorm  = $this->normalisasiTeksPersonil($aktivitas->nama_aktivitas);
        return $nilaiNorm === $kodeNorm || $nilaiNorm === $namaNorm;
    }

    private function aktivitasDitugaskanPersonil(array $personil): Collection
    {
        $tim = strtolower($personil['tim']);

        if ($tim === 'safety') {
            $so = \App\Models\SafetyOfficer::with(['aktivitasKpi' => function ($q) {
                $q->where('status', 'AKTIF');
            }])->where('badge', $personil['badge'])->first();
            return $so ? $so->aktivitasKpi : collect();
        }

        if ($tim === 'pengawas') {
            return AktivitasKpiK3::aktif()->where('pengawas', true)->orderBy('kode')->get();
        }

        if ($tim === 'medis') {
            return AktivitasKpiK3::aktif()->where('medis', true)->orderBy('kode')->get();
        }

        return collect();
    }

    private function queryLaporanPersonilLaporan(array $personil, Carbon $mulai, Carbon $selesai): array
    {
        return match ($personil['tim']) {
            'SAFETY' => [
                DB::table('data_safety')
                    ->where('badge_tenaga', $personil['badge'])
                    ->whereBetween('tanggal_pelaksanaan', [$mulai->toDateTimeString(), $selesai->toDateTimeString()]),
                'keputusan',
                'jenis_aktifitas_kpi',
            ],
            'MEDIS' => [
                DB::table('datamedis')
                    ->where('badge_tenaga', $personil['badge'])
                    ->whereBetween('tanggal_pelaksanaan', [$mulai->toDateTimeString(), $selesai->toDateTimeString()]),
                'keputusan',
                'jenis_aktifitas_kpi',
            ],
            default => [
                DB::table('pelaporan_pengawas')
                    ->where('badge_pengawas', $personil['badge'])
                    ->whereBetween('tanggal_pelaksanaan', [$mulai->toDateTimeString(), $selesai->toDateTimeString()]),
                'status',
                null,
            ],
        };
    }

    private function kategoriPenilaianPersonil(float $skor, PengaturanKpiK3 $pengaturan): string
    {
        if ($skor >= $pengaturan->ambang_kuning) return 'BAIK';
        if ($skor >= $pengaturan->ambang_merah) return 'CUKUP';
        return 'PERLU PERBAIKAN';
    }

    public function index()
    {
        return view('laporan-capaian-kpi.index');
    }

    public function api(Request $request): JsonResponse
    {
        $tahun = (int) ($request->query('tahun') ?: PengaturanKpiK3::current()->tahun_aktif);
        $bulan = (int) ($request->query('bulan') ?: PengaturanKpiK3::current()->bulan_aktif);

        return response()->json($this->hitungLaporan($tahun, $bulan));
    }

    private function hitungLaporan(int $tahun, int $bulan): array
    {
        $pengaturan = PengaturanKpiK3::forPeriode($tahun, $bulan);
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

            // Akumulator tim — semua diisi di DALAM 1 loop personil di bawah
            $terkirimTim = 0;
            $disetujuiTim = 0;
            $tepatWaktuTim = 0;
            $sumCapaianPersenTim = 0.0;
            $jumlahPetugasTim = 0;
            $sumTunjanganTim = 0;
            $agregatAktivitas = []; // [aktivitas_id => ['target_sum','disetujui_raw_sum','disetujui_capped_sum']]
            $targetLaporanTim = 0; // <--- 1. Tambahkan akumulator ini
            $sumKpiFinalTim = 0.0;
            $sumTunjanganTimRaw = 0.0;

            foreach ($roster as $pegawai) {
                $hasilPersonil = $this->hitungKpiPersonilLaporan(
                    [
                        'badge' => $pegawai->badge,
                        'nama' => $pegawai->nama,
                        'tim' => $timLabel,
                    ],
                    $pengaturan,
                    $periodeMulai,
                    $periodeSelesai,
                    $tahun,
                    $bulan
                );

                $petugasRows[] = [
                    'badge' => $pegawai->badge,
                    'nama' => $pegawai->nama,
                    'terkirim' => $hasilPersonil['terkirim'],
                    'disetujui' => $hasilPersonil['disetujui'],
                    'capaian_persen' => $hasilPersonil['capaian_persen'],
                    'ketepatan_waktu_persen' => $hasilPersonil['ketepatan_waktu_persen'],
                    'nilai_kpi_final' => $hasilPersonil['nilai_kpi_final'],
                    'standby' => $hasilPersonil['standby'], // <--- 2. Gunakan nilai dinamis                    
                    'hari_kerja_efektif' => $hasilPersonil['hari_kerja_efektif'],
                    'tunjangan' => $hasilPersonil['tunjangan'],
                ];

                $targetLaporanTim += $hasilPersonil['target_laporan'];
                $terkirimTim += $hasilPersonil['terkirim'];
                $disetujuiTim += $hasilPersonil['disetujui'];
                $tepatWaktuTim += $hasilPersonil['tepat_waktu'];
                $sumCapaianPersenTim += $hasilPersonil['capaian_persen'];
                $jumlahPetugasTim++;
                $sumTunjanganTimRaw += $hasilPersonil['tunjangan_raw'];
                $sumKpiFinalTim += $hasilPersonil['nilai_kpi_final'];

                // Section B: agregasi per aktivitas, dikumpulkan sekalian di loop yang sama
                foreach ($hasilPersonil['per_aktivitas'] as $aktivitasId => $data) {
                    if (!isset($agregatAktivitas[$aktivitasId])) {
                        $agregatAktivitas[$aktivitasId] = [
                            'target_sum' => 0,
                            'disetujui_raw_sum' => 0,
                            'disetujui_capped_sum' => 0,
                        ];
                    }
                    $agregatAktivitas[$aktivitasId]['target_sum'] += $data['target'];
                    $agregatAktivitas[$aktivitasId]['disetujui_raw_sum'] += $data['disetujui_raw'];
                    $agregatAktivitas[$aktivitasId]['disetujui_capped_sum'] += $data['disetujui_capped'];
                }
            }

            // ── Ringkasan tim (Section A) ──
            $pencapaianTimPersen = $jumlahPetugasTim > 0 ? round($sumCapaianPersenTim / $jumlahPetugasTim, 1) : 0.0;
            $ketepatanTimPersen = $disetujuiTim > 0 ? round($tepatWaktuTim / $disetujuiTim * 100, 1) : null;
            // $nilaiKpiFinalTim = round(
            //     ($pencapaianTimPersen * (float) $pengaturan->porsi_capaian_aktivitas
            //         + ($ketepatanTimPersen ?? 0) * (float) $pengaturan->porsi_ketepatan_waktu) / 100,
            //     1
            // );

            $nilaiKpiFinalTim = $jumlahPetugasTim > 0 ? round($sumKpiFinalTim / $jumlahPetugasTim, 1) : 0.0;
            $kategori = $this->kategoriTim($pencapaianTimPersen, $pengaturan);

            // ── Section B: langsung pakai $agregatAktivitas yang sudah lengkap dari loop di atas ──
            // ── Section B: langsung pakai $agregatAktivitas yang sudah lengkap dari loop di atas ──
            $rincianAktivitas = $aktivitasTim->map(function (AktivitasKpiK3 $akt) use ($agregatAktivitas, $totalSkorTim) {

                // 1. Ambil data akumulasi dari loop anggota tim sebelumnya
                $agregat = $agregatAktivitas[$akt->id] ?? [
                    'target_sum' => 0,
                    'disetujui_raw_sum' => 0,
                    'disetujui_capped_sum' => 0,
                ];

                $targetTim = $agregat['target_sum'];
                $disetujuiTim = $agregat['disetujui_raw_sum'];

                // 2. Batasi rasio maksimal 1 (100%)
                $rasioAktual = $targetTim > 0
                    ? min(1.0, $disetujuiTim / $targetTim)
                    : ($disetujuiTim > 0 ? 1.0 : 0.0);

                return [
                    'kode' => $akt->kode,
                    'nama_aktivitas' => $akt->nama_aktivitas,
                    'bobot_persen' => $totalSkorTim > 0 ? round($akt->skor / $totalSkorTim * 100, 1) : 0,

                    // 3. Gunakan total akumulasi untuk target dan disetujui level tim
                    'target_periode' => $targetTim,
                    'disetujui' => $disetujuiTim,

                    'aktual_pencapaian_persen' => $targetTim > 0
                        ? round($rasioAktual * 100, 1)
                        : null,
                ];
            })->values();

            $targetTimAktual = collect($agregatAktivitas)->sum('target_sum');

            $hasil[$flag] = [
                'label' => $timLabel,
                'target_laporan' => $targetLaporanTim, // <--- 4. Gunakan variabel dinamis ini (akan menghasilkan ~1.220)
                'laporan_disetujui' => $disetujuiTim,
                'pencapaian_persen' => $pencapaianTimPersen,
                'ketepatan_target_persen' => 100.0,
                'ketepatan_realisasi_persen' => $ketepatanTimPersen,
                'nilai_kpi_final_persen' => $nilaiKpiFinalTim,
                'tunjangan_tim' => (int) round($sumTunjanganTimRaw),
                'kategori' => $kategori,
                'rincian_aktivitas' => $rincianAktivitas,
                'petugas' => $petugasRows,
                'standby' => $hasilPersonil['standby'],
            ];
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

    private function hitungKpiPersonilLaporan(array $personil, PengaturanKpiK3 $pengaturan, Carbon $mulai, Carbon $selesai, int $tahun, int $bulan): array
    {
        $aktivitasDitugaskan = $this->aktivitasDitugaskanPersonil($personil);

        $kolomFlagTim = strtolower($personil['tim']) === 'medis'
            ? 'medis'
            : (strtolower($personil['tim']) === 'pengawas' ? 'pengawas' : 'safety');
        $totalSkorTim = AktivitasKpiK3::aktif()->where($kolomFlagTim, true)->sum('skor');

        [$laporanQuery, $kolomStatus, $kolomAktivitas] = $this->queryLaporanPersonilLaporan($personil, $mulai, $selesai);
        $semuaLaporanPersonil = $laporanQuery->get();
        $terkirimPersonil = $semuaLaporanPersonil->count();

        $batasTerlambatLapor = (int) $pengaturan->batas_terlambat_lapor;
        $cekTepatWaktu = function ($r) use ($batasTerlambatLapor) {
            $waktuSubmit = $r->waktu_submit ?? $r->created_at ?? null;
            $tanggalPelaksanaan = $r->tanggal_pelaksanaan ?? null;
            if (!$waktuSubmit || !$tanggalPelaksanaan) return false;
            $tglSubmit = Carbon::parse($waktuSubmit)->startOfDay();
            $tglPelaksanaan = Carbon::parse($tanggalPelaksanaan)->startOfDay();
            $selisihHari = $tglPelaksanaan->diffInDays($tglSubmit, false);
            return $selisihHari >= 0 && $selisihHari <= $batasTerlambatLapor;
        };

        $laporanDisetujui = $semuaLaporanPersonil->where($kolomStatus, 'APPROVE')->count();
        $laporanTepatWaktu = $semuaLaporanPersonil->where($kolomStatus, 'APPROVE')->filter($cekTepatWaktu)->count();

        $kehadiran = \App\Models\KehadiranKpiK3::where('badge', $personil['badge'])
            ->where('tahun_aktif', $tahun)->where('bulan_aktif', $bulan)->first();

        $hariCuti    = $kehadiran->hari_cuti_izin_sakit_alfa ?? 0;
        $hariStandby = $kehadiran->hari_standby ?? 0;
        $hariKerjaDasar = (int) $pengaturan->hari_kerja_efektif_manajer;
        $hariKerjaEfektifPersonil = max(0, $hariKerjaDasar - $hariCuti + $hariStandby);

        $capaianAktivitasTotalRaw = 0.0;
        $totalTargetDinamis = 0.0;
        $perAktivitas = []; // 🆕 dipakai buat agregasi Section B (level tim) yang akurat

        foreach ($aktivitasDitugaskan as $aktivitas) {
            if ($personil['tim'] === 'PENGAWAS') {
                $rows = $semuaLaporanPersonil->where('aktivitas_kpi_k3_id', '==', $aktivitas->id);
            } else {
                $rows = $semuaLaporanPersonil->filter(
                    fn($r) => $this->cocokDenganAktivitasPersonil($r->{$kolomAktivitas} ?? null, $aktivitas)
                );
            }

            $disetujuiAktivitas = $rows->where($kolomStatus, 'APPROVE')->count();
            $bobotItemRaw = ($totalSkorTim > 0) ? ($aktivitas->skor / $totalSkorTim * 100) : 0.0;

            $target = $aktivitas->target_ikut_hari_kerja_personil
                ? min($hariKerjaEfektifPersonil, (int) $aktivitas->target_per_bulan)
                : (int) $aktivitas->target_per_bulan;
            $totalTargetDinamis += $target;

            $rasioCapaian = $target > 0 ? min($disetujuiAktivitas / $target, 1) : ($disetujuiAktivitas > 0 ? 1 : 0);
            $capaianAktivitasTotalRaw += ($rasioCapaian * $bobotItemRaw);

            // 🆕 simpan target, disetujui mentah (buat tampilan), dan disetujui yang SUDAH dibatasi
            // maksimal sebesar target orang ini (buat hitung persentase yang tidak bisa > 100%)
            $perAktivitas[$aktivitas->id] = [
                'target' => $target,
                'disetujui_raw' => $disetujuiAktivitas,
                'disetujui_capped' => min($disetujuiAktivitas, $target),
            ];
        }

        $persentaseKetepatanWaktuRaw = $laporanDisetujui > 0 ? ($laporanTepatWaktu / $laporanDisetujui * 100) : 0.0;

        $bobotDitugaskanRaw = $totalSkorTim > 0 ? ($aktivitasDitugaskan->sum('skor') / $totalSkorTim) : 0.0;
        $persentaseCapaianAktivitasRaw = $capaianAktivitasTotalRaw;

        $nilaiKpiFinalRaw = ($pengaturan->porsi_capaian_aktivitas / 100 * $persentaseCapaianAktivitasRaw)
            + ($pengaturan->porsi_ketepatan_waktu / 100 * $persentaseKetepatanWaktuRaw);

        $skorUntukTunjangan = max($pengaturan->skor_minimum_tunjangan, min($nilaiKpiFinalRaw, $pengaturan->skor_maksimum_tunjangan));

        $timDapatTunjangan = match ($personil['tim']) {
            'SAFETY' => (bool) $pengaturan->tim_safety_dapat_tunjangan,
            'PENGAWAS' => (bool) $pengaturan->tim_pengawas_dapat_tunjangan,
            'MEDIS' => (bool) $pengaturan->tim_medis_dapat_tunjangan,
            default => false,
        };
        $nominalTunjanganTim = match ($personil['tim']) {
            'SAFETY'   => (int) $pengaturan->tunjangan_safety,
            'PENGAWAS' => (int) $pengaturan->tunjangan_pengawas,
            'MEDIS'    => (int) $pengaturan->tunjangan_medis,
            default    => 0,
        };



        $tunjanganRaw = $timDapatTunjangan
            ? ($nominalTunjanganTim * ($skorUntukTunjangan / 100))
            : 0.0;

        $tunjangan = (int) round($tunjanganRaw);

        $nilaiKpiFinal = round($nilaiKpiFinalRaw, 1);

        return [
            'terkirim' => $terkirimPersonil,
            'disetujui' => $laporanDisetujui,
            'tepat_waktu' => $laporanTepatWaktu,               // 🆕 dipakai buat agregasi tim
            'target_laporan' => (int) round($totalTargetDinamis), // 🆕 dipakai buat agregasi tim
            'capaian_persen' => round($persentaseCapaianAktivitasRaw, 1),
            'ketepatan_waktu_persen' => $laporanDisetujui > 0 ? $persentaseKetepatanWaktuRaw : null,
            'nilai_kpi_final' => $nilaiKpiFinal,
            'hari_kerja_efektif' => $hariKerjaEfektifPersonil,
            'tunjangan' => $tunjangan ?: null,
            'tunjangan_raw' => $tunjanganRaw,
            'kategori' => $this->kategoriPenilaianPersonil($nilaiKpiFinal, $pengaturan),
            'per_aktivitas' => $perAktivitas, // 🆕
            'standby' => $hariStandby > 0 ? 'Y' : 'N',
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
        if ((int) $pengaturan->tahun_aktif === $tahun && (int) $pengaturan->bulan_aktif === $bulan) {
            if ($pengaturan->periode_manajer_mulai && $pengaturan->periode_manajer_selesai) { // ← diperbaiki
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

    private function rosterUntukTim(string $flag): Collection
    {
        return match ($flag) {
            'safety' => Pegawai::where('is_safety_officer', true)->where('is_active', true)
                ->orderBy('nama')->get(),

            'pengawas' => collect($this->pengawasRoster)->map(function ($nama, $badge) {
                return (object) ['badge' => $badge, 'nama' => $nama];
            })->sortBy('nama')->values(),

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
