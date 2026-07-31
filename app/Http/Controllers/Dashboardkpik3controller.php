<?php

namespace App\Http\Controllers;

use App\Models\AktivitasKpiK3;
use App\Models\Datamedis;
use App\Models\DataSafety;
use App\Models\PelaporanPengawas;
use App\Models\PengaturanKpiK3;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Dashboard KPI Keselamatan & Kesehatan Kerja.
 *
 * Menyatukan 3 sumber laporan (Data Medis, Data Safety, Pelaporan Pengawas) dan master
 * `aktivitas_kpi_k3` + `pengaturan_kpi_k3` menjadi satu tampilan ringkas, mengikuti
 * "Panel Saklar" (Periode/Tahun/Bulan/Tim/Area/Tampilkan Rupiah) persis seperti sheet Excel
 * referensi.
 *
 * CATATAN ASUMSI PENTING (karena beberapa hal tidak eksplisit ada di skema DB kamu saat ini):
 *
 * 1) "Personil" tidak punya tabel master tersendiri untuk KPI ini — daftar personil dibentuk
 *    dari badge+nama unik yang muncul di data_safety (tim SAFETY), datamedis (tim MEDIS),
 *    dan pelaporan_pengawas (tim PENGAWAS). Tim seorang personil ditentukan dari tabel mana
 *    dia paling banyak melapor pada periode berjalan.
 *
 * 2) "Jumlah Tugas" & "Bobot Ditugaskan (%)" per personil: karena belum ada tabel penugasan
 *    aktivitas->personil, dihitung dari aktivitas AKTIF milik tim personil tsb yang PERNAH
 *    ia laporkan (sepanjang waktu). Kalau nanti ada tabel penugasan eksplisit
 *    (misal `penugasan_aktivitas_kpi`), ganti method `aktivitasDitugaskan()` supaya akurat.
 *
 * 3) "Hari Kerja Efektif" & periode memakai kolom *_manajer dari pengaturan_kpi_k3 sebagai
 *    default umum (bisa disesuaikan per tim kalau nanti dipisah).
 *
 * 4) "Tepat Waktu" = laporan APPROVE yang disubmit tidak lebih cepat dari
 *    (periode_mulai - batas_lapor_lebih_awal hari) dan tidak lebih lambat dari
 *    (tanggal_cutoff_manajer + batas_terlambat_lapor hari) pada bulan periode berjalan.
 *
 * Semua angka % dibulatkan 1 desimal di response JSON, perhitungan internal pakai float penuh
 * supaya rumus turunan (Nilai KPI Final, dsb) tetap presisi seperti di sheet Excel.
 */
class DashboardKpiK3Controller extends Controller
{
    public function index()
    {
        return view('dashboard-kpi.index');
    }

    /**
     * Endpoint JSON utama. Semua panel di halaman (ringkasan status, indikator KPI,
     * monitoring per personil, rincian per aktivitas) dipasok dari sini supaya konsisten
     * dengan "Panel Saklar" yang sama.
     */
    public function api(Request $request): JsonResponse
    {
        try {
            $pengaturan = PengaturanKpiK3::current();

            $tahun = (int) $request->query('tahun', $pengaturan->tahun_aktif);
            $bulan = (int) $request->query('bulan', $pengaturan->bulan_aktif);
            $tim = strtoupper((string) $request->query('tim', 'SEMUA'));   // SEMUA | SAFETY | PENGAWAS | MEDIS
            $area = (string) $request->query('area', 'SEMUA');
            $tampilkanRupiah = filter_var($request->query('tampilkan_rupiah', true), FILTER_VALIDATE_BOOLEAN);
            $personilKey = $request->query('personil'); // format: "{tim}|{badge}|{nama}"

            [$periodeMulai, $periodeSelesai] = $this->hitungRentangPeriode($pengaturan, $tahun, $bulan);

            $filters = [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'tim' => $tim,
                'area' => $area,
                'periode_mulai' => $periodeMulai,
                'periode_selesai' => $periodeSelesai,
            ];

            $daftarPersonil = $this->daftarPersonil($filters);

            $personilTerpilih = null;
            if ($personilKey) {
                $personilTerpilih = $daftarPersonil->firstWhere('key', $personilKey) ?? $daftarPersonil->first();
            } else {
                $personilTerpilih = $daftarPersonil->first();
            }

            $monitoring = null;
            $rincianAktivitas = [];
            if ($personilTerpilih) {
                $hasil = $this->hitungKpiPersonil($personilTerpilih, $pengaturan, $filters, $tampilkanRupiah);
                $monitoring = $hasil['monitoring'];
                $rincianAktivitas = $hasil['rincian'];
            }

            return response()->json([
                'periode' => [
                    'tanggal_cutoff_manajer' => $pengaturan->tanggal_cutoff_manajer,
                    'periode_mulai' => $periodeMulai->toDateString(),
                    'periode_selesai' => $periodeSelesai->toDateString(),
                    'bulan_label' => $periodeSelesai->translatedFormat('F Y'),
                    'tahun' => $tahun,
                    'bulan' => $bulan,
                    'tim' => $tim,
                    'area' => $area,
                    'tampilkan_rupiah' => $tampilkanRupiah,
                ],
                'ringkasan_status_dokumen' => $this->ringkasanStatusDokumen($filters),
                'indikator_kpi' => $this->indikatorKpi($daftarPersonil, $pengaturan, $filters, $tampilkanRupiah),
                'personil_options' => $daftarPersonil->map(fn ($p) => [
                    'key' => $p['key'],
                    'label' => "{$p['badge']}-{$p['nama']}",
                    'tim' => $p['tim'],
                ])->values(),
                'personil_terpilih' => $personilTerpilih['key'] ?? null,
                'monitoring_personil' => $monitoring,
                'rincian_aktivitas' => $rincianAktivitas,
                'area_options' => $this->areaOptions(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data Dashboard KPI K3: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data dashboard KPI K3.'], 500);
        }
    }

    // ─────────────────────────────────────────────────────────────
    // PERIODE
    // ─────────────────────────────────────────────────────────────

    /**
     * Rentang periode "Tanggal {cutoff-1} bulan lalu s/d {cutoff-1}" mengikuti pola
     * `tanggal_cutoff_manajer` (contoh sheet: 26/05 s/d 25/06 untuk periode Juni).
     */
    private function hitungRentangPeriode(PengaturanKpiK3 $pengaturan, int $tahun, int $bulan): array
    {
        $cutoff = max(1, min(28, (int) $pengaturan->tanggal_cutoff_manajer));

        $selesai = Carbon::create($tahun, $bulan, $cutoff)->endOfDay();
        $mulai = (clone $selesai)->subMonthNoOverflow()->addDay()->startOfDay();

        return [$mulai, $selesai];
    }

    // ─────────────────────────────────────────────────────────────
    // RINGKASAN STATUS DOKUMEN (Approve/Reject/Pending/Cancel + Total)
    // ─────────────────────────────────────────────────────────────

    private function ringkasanStatusDokumen(array $filters): array
    {
        $union = $this->queryGabunganLaporan($filters);

        $rows = DB::query()->fromSub($union, 'gabungan')
            ->select('status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        $approve = (int) ($rows['APPROVE'] ?? 0);
        $reject = (int) ($rows['REJECT'] ?? 0);
        $pending = (int) ($rows['PENDING'] ?? 0);
        $cancel = (int) ($rows['CANCEL'] ?? 0);

        return [
            'approve' => $approve,
            'reject' => $reject,
            'pending' => $pending,
            'cancel' => $cancel,
            'total' => $approve + $reject + $pending + $cancel,
        ];
    }

    /**
     * Query gabungan (UNION ALL) 3 sumber laporan, sudah difilter periode/tim/area,
     * dipakai bareng oleh ringkasan status & indikator KPI.
     */
    private function queryGabunganLaporan(array $filters)
    {
        $mulai = $filters['periode_mulai'];
        $selesai = $filters['periode_selesai'];
        $tim = $filters['tim'];
        $area = $filters['area'];

        $medis = DB::table('datamedis')->select([
            DB::raw("'MEDIS' as sumber"),
            'id', 'tanggal_pelaksanaan', 'nama_tenaga as nama_petugas', 'badge_tenaga as badge',
            'area_kerja', 'unit_kerja', 'keputusan as status', 'waktu_submit',
        ])->whereBetween('tanggal_pelaksanaan', [$mulai->toDateString(), $selesai->toDateString()]);

        $safety = DB::table('data_safety')->select([
            DB::raw("'SAFETY' as sumber"),
            'id', 'tanggal_pelaksanaan', 'nama_tenaga as nama_petugas', 'badge_tenaga as badge',
            'area_kerja', 'unit_kerja', 'keputusan as status', 'waktu_submit',
        ])->whereBetween('tanggal_pelaksanaan', [$mulai->toDateString(), $selesai->toDateString()]);

        $pengawas = DB::table('pelaporan_pengawas')->select([
            DB::raw("'PENGAWAS' as sumber"),
            'id', 'tanggal_pelaksanaan', 'nama_pengawas as nama_petugas', 'badge_pengawas as badge',
            'area_kerja', 'unit_kerja', 'status', DB::raw('created_at as waktu_submit'),
        ])->whereBetween('tanggal_pelaksanaan', [$mulai->toDateString(), $selesai->toDateString()]);

        if ($area && strtoupper($area) !== 'SEMUA') {
            $medis->where('area_kerja', $area);
            $safety->where('area_kerja', $area);
            $pengawas->where('area_kerja', $area);
        }

        $parts = [];
        if (!$tim || $tim === 'SEMUA' || $tim === 'MEDIS') $parts[] = $medis;
        if (!$tim || $tim === 'SEMUA' || $tim === 'SAFETY') $parts[] = $safety;
        if (!$tim || $tim === 'SEMUA' || $tim === 'PENGAWAS') $parts[] = $pengawas;

        $union = array_shift($parts);
        foreach ($parts as $p) {
            $union->unionAll($p);
        }

        return $union;
    }

    // ─────────────────────────────────────────────────────────────
    // DAFTAR PERSONIL (dibentuk dari 3 sumber laporan)
    // ─────────────────────────────────────────────────────────────

    private function daftarPersonil(array $filters): Collection
    {
        $mulai = $filters['periode_mulai']->toDateString();
        $selesai = $filters['periode_selesai']->toDateString();
        $tim = $filters['tim'];
        $area = $filters['area'];

        $out = collect();

        $ambil = function (string $table, string $badgeCol, string $namaCol, string $timLabel) use (&$out, $mulai, $selesai, $area) {
            $q = DB::table($table)
                ->select($badgeCol . ' as badge', $namaCol . ' as nama')
                ->whereNotNull($badgeCol)
                ->where($badgeCol, '!=', '')
                ->whereBetween('tanggal_pelaksanaan', [$mulai, $selesai])
                ->distinct();

            if ($area && strtoupper($area) !== 'SEMUA') {
                $q->where('area_kerja', $area);
            }

            foreach ($q->get() as $row) {
                $key = "{$timLabel}|{$row->badge}|{$row->nama}";
                $out->put($key, ['key' => $key, 'badge' => $row->badge, 'nama' => $row->nama, 'tim' => $timLabel]);
            }
        };

        if (!$tim || $tim === 'SEMUA' || $tim === 'SAFETY') {
            $ambil('data_safety', 'badge_tenaga', 'nama_tenaga', 'SAFETY');
        }
        if (!$tim || $tim === 'SEMUA' || $tim === 'MEDIS') {
            $ambil('datamedis', 'badge_tenaga', 'nama_tenaga', 'MEDIS');
        }
        if (!$tim || $tim === 'SEMUA' || $tim === 'PENGAWAS') {
            $ambil('pelaporan_pengawas', 'badge_pengawas', 'nama_pengawas', 'PENGAWAS');
        }

        return $out->values()->sortBy('nama')->values();
    }

    private function areaOptions(): Collection
    {
        $a1 = DB::table('data_safety')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $a2 = DB::table('datamedis')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');
        $a3 = DB::table('pelaporan_pengawas')->whereNotNull('area_kerja')->distinct()->pluck('area_kerja');

        return $a1->merge($a2)->merge($a3)->filter()->unique()->sort(SORT_STRING)->values();
    }

    // ─────────────────────────────────────────────────────────────
    // AKTIVITAS YANG "DITUGASKAN" KE PERSONIL (lihat asumsi #2 di atas)
    // ─────────────────────────────────────────────────────────────

    private function aktivitasDitugaskan(array $personil): Collection
    {
        $tim = strtolower($personil['tim']); // safety | medis | pengawas
        $timKolom = $tim === 'medis' ? 'medis' : ($tim === 'pengawas' ? 'pengawas' : 'safety');

        $semuaAktivitasTim = AktivitasKpiK3::aktif()->where($timKolom, true)->orderBy('kode')->get();

        $tabel = match ($personil['tim']) {
            'SAFETY' => ['data_safety', 'badge_tenaga', 'jenis_aktifitas_kpi'],
            'MEDIS' => ['datamedis', 'badge_tenaga', 'jenis_aktifitas_kpi'],
            default => ['pelaporan_pengawas', 'badge_pengawas', null],
        };

        if ($personil['tim'] === 'PENGAWAS') {
            // Pelaporan Pengawas relasi ke aktivitas via FK aktivitas_kpi_k3_id, bukan string nama.
            $idAktivitasPernahDilaporkan = DB::table('pelaporan_pengawas')
                ->where('badge_pengawas', $personil['badge'])
                ->distinct()
                ->pluck('aktivitas_kpi_k3_id');

            return $semuaAktivitasTim->whereIn('id', $idAktivitasPernahDilaporkan)->values();
        }

        [$table, $badgeCol, $namaKol] = $tabel;
        $namaAktivitasPernahDilaporkan = DB::table($table)
            ->where($badgeCol, $personil['badge'])
            ->whereNotNull($namaKol)
            ->distinct()
            ->pluck($namaKol)
            ->map(fn ($n) => strtolower(trim($n)))
            ->all();

        return $semuaAktivitasTim
            ->filter(fn (AktivitasKpiK3 $a) => in_array(strtolower(trim($a->nama_aktivitas)), $namaAktivitasPernahDilaporkan))
            ->values();
    }

    // ─────────────────────────────────────────────────────────────
    // MONITORING KPI PER PERSONIL + RINCIAN PER AKTIVITAS
    // ─────────────────────────────────────────────────────────────

    private function hitungKpiPersonil(array $personil, PengaturanKpiK3 $pengaturan, array $filters, bool $tampilkanRupiah): array
    {
        $mulai = $filters['periode_mulai'];
        $selesai = $filters['periode_selesai'];

        $aktivitasDitugaskan = $this->aktivitasDitugaskan($personil);
        $totalSkorTim = AktivitasKpiK3::aktif()->where(strtolower($personil['tim']) === 'medis' ? 'medis' : (strtolower($personil['tim']) === 'pengawas' ? 'pengawas' : 'safety'), true)->sum('skor');
        $totalAktivitasAktifTim = AktivitasKpiK3::aktif()->where(strtolower($personil['tim']) === 'medis' ? 'medis' : (strtolower($personil['tim']) === 'pengawas' ? 'pengawas' : 'safety'), true)->count();

        [$laporanQuery, $kolomStatus, $kolomAktivitas] = $this->queryLaporanPersonil($personil, $mulai, $selesai);

        $laporanDisetujui = 0;
        $laporanTepatWaktu = 0;
        $rincian = [];
        $capaianAktivitasTotal = 0.0;

        $batasAwal = (clone $mulai)->subDays((int) $pengaturan->batas_lapor_lebih_awal);
        $batasAkhir = (clone $selesai)->addDays((int) $pengaturan->batas_terlambat_lapor);

        foreach ($aktivitasDitugaskan as $aktivitas) {
            /** @var AktivitasKpiK3 $aktivitas */
            $q = (clone $laporanQuery);

            if ($personil['tim'] === 'PENGAWAS') {
                $q->where('aktivitas_kpi_k3_id', $aktivitas->id);
            } else {
                $q->whereRaw('LOWER(TRIM(' . $kolomAktivitas . ')) = ?', [strtolower(trim($aktivitas->nama_aktivitas))]);
            }

            $rows = $q->get();
            $disetujuiAktivitas = $rows->where($kolomStatus, 'APPROVE')->count();
            $laporanDisetujui += $disetujuiAktivitas;

            $tepatWaktuAktivitas = $rows->where($kolomStatus, 'APPROVE')
                ->filter(function ($r) use ($batasAwal, $batasAkhir) {
                    $waktu = Carbon::parse($r->waktu_submit ?? $r->created_at ?? $r->tanggal_pelaksanaan);
                    return $waktu->betweenIncluded($batasAwal, $batasAkhir);
                })->count();
            $laporanTepatWaktu += $tepatWaktuAktivitas;

            $bobotItem = ($totalSkorTim > 0) ? round($aktivitas->skor / $totalSkorTim * 100, 1) : 0.0;
            $target = (int) $aktivitas->target_per_bulan;
            $rasioCapaian = $target > 0 ? min($disetujuiAktivitas / $target, 1) : ($disetujuiAktivitas > 0 ? 1 : 0);
            $kontribusi = round($rasioCapaian * $bobotItem, 1);
            $capaianAktivitasTotal += $rasioCapaian * $bobotItem;

            $rincian[] = [
                'kode' => $aktivitas->kode,
                'nama_aktivitas' => $aktivitas->nama_aktivitas,
                'target_per_bulan' => $target,
                'laporan_disetujui' => $disetujuiAktivitas,
                'bobot_item' => $bobotItem,
                'kontribusi' => $kontribusi,
                'status_capaian' => $rasioCapaian >= 1 ? 'TERCAPAI' : 'BELUM TERCAPAI',
            ];
        }

        $persentaseKetepatanWaktu = $laporanDisetujui > 0 ? round($laporanTepatWaktu / $laporanDisetujui * 100, 1) : 0.0;
        $persentaseCapaianAktivitas = round($capaianAktivitasTotal, 1);

        $nilaiKpiFinal = round(
            ($pengaturan->porsi_capaian_aktivitas / 100 * $persentaseCapaianAktivitas)
            + ($pengaturan->porsi_ketepatan_waktu / 100 * $persentaseKetepatanWaktu),
            1
        );

        $bobotDitugaskan = $totalAktivitasAktifTim > 0
            ? round($aktivitasDitugaskan->count() / $totalAktivitasAktifTim * 100, 1)
            : 0.0;

        $skorUntukTunjangan = max($pengaturan->skor_minimum_tunjangan, min($nilaiKpiFinal, $pengaturan->skor_maksimum_tunjangan));
        $timDapatTunjangan = match ($personil['tim']) {
            'SAFETY' => (bool) $pengaturan->tim_safety_dapat_tunjangan,
            'PENGAWAS' => (bool) $pengaturan->tim_pengawas_dapat_tunjangan,
            'MEDIS' => (bool) $pengaturan->tim_medis_dapat_tunjangan,
            default => false,
        };
        $tunjangan = $timDapatTunjangan ? round($pengaturan->tunjangan_penuh * ($skorUntukTunjangan / 100)) : 0;

        $kategori = $this->kategoriPenilaian($nilaiKpiFinal, $pengaturan);

        return [
            'monitoring' => [
                'badge' => $personil['badge'],
                'nama' => $personil['nama'],
                'tim' => $personil['tim'],
                'hari_kerja_efektif' => (float) $pengaturan->hari_kerja_efektif_manajer,
                'total_target_laporan' => (float) $aktivitasDitugaskan->sum('target_per_bulan'),
                'jumlah_laporan_disetujui' => $laporanDisetujui,
                'jumlah_laporan_tepat_waktu' => $laporanTepatWaktu,
                'persentase_capaian_aktivitas' => $persentaseCapaianAktivitas,
                'persentase_ketepatan_waktu' => $persentaseKetepatanWaktu,
                'nilai_kpi_final' => $nilaiKpiFinal,
                'bobot_ditugaskan' => $bobotDitugaskan,
                'jumlah_tugas' => $aktivitasDitugaskan->count(),
                'tunjangan' => $tampilkanRupiah ? $tunjangan : null,
                'kategori_penilaian' => $kategori,
            ],
            'rincian' => $rincian,
        ];
    }

    private function queryLaporanPersonil(array $personil, Carbon $mulai, Carbon $selesai): array
    {
        return match ($personil['tim']) {
            'SAFETY' => [
                DB::table('data_safety')
                    ->where('badge_tenaga', $personil['badge'])
                    ->whereBetween('tanggal_pelaksanaan', [$mulai->toDateString(), $selesai->toDateString()]),
                'keputusan',
                'jenis_aktifitas_kpi',
            ],
            'MEDIS' => [
                DB::table('datamedis')
                    ->where('badge_tenaga', $personil['badge'])
                    ->whereBetween('tanggal_pelaksanaan', [$mulai->toDateString(), $selesai->toDateString()]),
                'keputusan',
                'jenis_aktifitas_kpi',
            ],
            default => [
                DB::table('pelaporan_pengawas')
                    ->where('badge_pengawas', $personil['badge'])
                    ->whereBetween('tanggal_pelaksanaan', [$mulai->toDateString(), $selesai->toDateString()]),
                'status',
                null,
            ],
        };
    }

    private function kategoriPenilaian(float $skor, PengaturanKpiK3 $pengaturan): string
    {
        if ($skor >= $pengaturan->ambang_kuning) return 'BAIK';
        if ($skor >= $pengaturan->ambang_merah) return 'CUKUP';
        return 'PERLU PERBAIKAN';
    }

    // ─────────────────────────────────────────────────────────────
    // INDIKATOR KPI (ringkasan atas semua personil sesuai filter)
    // ─────────────────────────────────────────────────────────────

    private function indikatorKpi(Collection $daftarPersonil, PengaturanKpiK3 $pengaturan, array $filters, bool $tampilkanRupiah): array
    {
        $ringkasan = $this->ringkasanStatusDokumen($filters);

        $skorList = [];
        $totalTunjangan = 0;
        $jumlahBaik = 0;

        foreach ($daftarPersonil as $p) {
            $hasil = $this->hitungKpiPersonil($p, $pengaturan, $filters, true)['monitoring'];
            $skorList[] = $hasil['nilai_kpi_final'];
            $totalTunjangan += (int) $hasil['tunjangan'];
            if ($hasil['kategori_penilaian'] === 'BAIK') {
                $jumlahBaik++;
            }
        }

        $rataSkor = count($skorList) > 0 ? round(array_sum($skorList) / count($skorList), 1) : 0.0;

        return [
            'total_laporan_disetujui' => $ringkasan['approve'],
            'rata_rata_skor_akhir' => $rataSkor,
            'total_tunjangan' => $tampilkanRupiah ? $totalTunjangan : null,
            'jumlah_personil_baik' => $jumlahBaik,
        ];
    }
}