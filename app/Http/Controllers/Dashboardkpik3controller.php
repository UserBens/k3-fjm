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
    /**
     * Normalisasi teks untuk pencocokan yang toleran terhadap perbedaan
     * spasi, tanda garis miring, tanda hubung, dsb.
     * "Laporan / Pelaporan Nearmiss" dan "Laporan Nearmiss" akan TETAP beda
     * (karena memang beda kata), tapi "Reward / Punishment" vs "Reward/Punishment"
     * akan dianggap SAMA.
     */
    private function normalisasiTeks(?string $s): string
    {
        if (!$s) return '';
        // lowercase, buang semua karakter selain huruf & angka
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

    public function index()
    {
        $userRole = session('auth_user.role');
        $username = session('auth_user.username'); // sesuaikan key session hasil login kamu

        // super_admin tetap bebas lihat semua tim & personil
        $lockedTim = in_array($userRole, ['safety', 'pengawas', 'medis'], true)
            ? strtoupper($userRole)
            : null;

        return view('dashboard-kpi.index', [
            'lockedTim'   => $lockedTim,
            'lockedBadge' => $lockedTim ? $username : null,
        ]);
    }

    /**
     * Endpoint JSON utama. Semua panel di halaman (ringkasan status, indikator KPI,
     * monitoring per personil, rincian per aktivitas) dipasok dari sini supaya konsisten
     * dengan "Panel Saklar" yang sama.
     */
    public function api(Request $request): JsonResponse
    {
        try {
            $userRole   = session('auth_user.role');
            $username   = session('auth_user.username');
            $isTerbatas = in_array($userRole, ['safety', 'pengawas', 'medis'], true);

            $tahun = (int) $request->query('tahun', now()->year);
            $bulan = (int) $request->query('bulan', now()->month);
            $pengaturan = PengaturanKpiK3::forPeriode($tahun, $bulan);
            $periodeType = (string) $request->query('periode_type', '26_25'); // ⬅️ Baca pilihan periode
            $tim         = strtoupper((string) $request->query('tim', 'SEMUA'));
            $area        = (string) $request->query('area', 'SEMUA');
            $tampilkanRupiah = filter_var($request->query('tampilkan_rupiah', true), FILTER_VALIDATE_BOOLEAN);
            $personilKey = $request->query('personil');

            if ($isTerbatas) {
                $tim = strtoupper($userRole);
                $personilKey = null;
            }

            [$periodeMulai, $periodeSelesai] = $this->hitungRentangPeriode($pengaturan, $tahun, $bulan, $periodeType);

            $filters = [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'tim' => $tim,
                'area' => $area,
                'periode_mulai' => $periodeMulai,
                'periode_selesai' => $periodeSelesai,
            ];

            $daftarPersonil = $this->daftarPersonil($filters);

            // 🔒 Non-admin: potong daftar personil supaya cuma berisi dirinya sendiri
            if ($isTerbatas) {
                $daftarPersonil = $daftarPersonil
                    ->filter(fn($p) => $p['badge'] === $username)
                    ->values();
            }

            $personilTerpilih = null;
            if ($personilKey) {
                $personilTerpilih = $daftarPersonil->firstWhere('key', $personilKey) ?? $daftarPersonil->first();
            } else {
                $personilTerpilih = $daftarPersonil->first();
            }

            $filters['personil_terpilih'] = $personilTerpilih;

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
                'personil_options' => $daftarPersonil->map(fn($p) => [
                    'key' => $p['key'],
                    'label' => "{$p['badge']}-{$p['nama']}",
                    'tim' => $p['tim'],
                ])->values(),
                'personil_terpilih' => $personilTerpilih['key'] ?? null,
                'monitoring_personil' => $monitoring,
                'rincian_aktivitas' => $rincianAktivitas,
                'area_options' => $this->areaOptions(),
                'locked' => $isTerbatas, // ⬅️ beri tahu frontend bahwa ini mode terkunci
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
    private function hitungRentangPeriode(PengaturanKpiK3 $pengaturan, int $tahun, int $bulan, string $periodeType = '26_25'): array
    {
        // Jika memilih mode kalender normal (1 - Akhir Bulan)
        if ($periodeType === '1_31') {
            $mulai = Carbon::create($tahun, $bulan, 1)->startOfDay();
            $selesai = Carbon::create($tahun, $bulan, 1)->endOfMonth()->endOfDay();
            return [$mulai, $selesai];
        }

        // Prioritaskan tanggal yang tersimpan langsung di tabel pengaturan jika periode match
        if ((int)$pengaturan->tahun_aktif === $tahun && (int)$pengaturan->bulan_aktif === $bulan) {
            if ($pengaturan->periode_mulai && $pengaturan->periode_selesai) {
                return [
                    Carbon::parse($pengaturan->periode_mulai)->startOfDay(),
                    Carbon::parse($pengaturan->periode_selesai)->endOfDay(),
                ];
            }
        }

        // Fallback kalkulasi dinamis berdasarkan tanggal cutoff
        $cutoff = max(1, min(28, (int) $pengaturan->tanggal_cutoff_manajer));

        $selesai = Carbon::create($tahun, $bulan, $cutoff - 1)->endOfDay();
        $mulai = Carbon::create($tahun, $bulan, $cutoff)->subMonthNoOverflow()->startOfDay();

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
        $personil = $filters['personil_terpilih'] ?? null;

        $medis = DB::table('datamedis')->select([
            DB::raw("'MEDIS' as sumber"),
            'id',
            'tanggal_pelaksanaan',
            'nama_tenaga as nama_petugas',
            'badge_tenaga as badge',
            'area_kerja',
            'unit_kerja',
            'keputusan as status',
            'waktu_submit',
        ])->whereBetween('tanggal_pelaksanaan', [$mulai->toDateTimeString(), $selesai->toDateTimeString()]);

        $safety = DB::table('data_safety')->select([
            DB::raw("'SAFETY' as sumber"),
            'id',
            'tanggal_pelaksanaan',
            'nama_tenaga as nama_petugas',
            'badge_tenaga as badge',
            'area_kerja',
            'unit_kerja',
            'keputusan as status',
            'waktu_submit',
        ])->whereBetween('tanggal_pelaksanaan', [$mulai->toDateTimeString(), $selesai->toDateTimeString()]);

        $pengawas = DB::table('pelaporan_pengawas')->select([
            DB::raw("'PENGAWAS' as sumber"),
            'id',
            'tanggal_pelaksanaan',
            'nama_pengawas as nama_petugas',
            'badge_pengawas as badge',
            'area_kerja',
            'unit_kerja',
            'status',
            DB::raw('created_at as waktu_submit'),
        ])->whereBetween('tanggal_pelaksanaan', [$mulai->toDateTimeString(), $selesai->toDateTimeString()]);

        // ... Sisa blok kondisi $area dan $personil biarkan sama seperti aslinya
        if ($area && strtoupper($area) !== 'SEMUA') {
            $medis->where('area_kerja', $area);
            $safety->where('area_kerja', $area);
            $pengawas->where('area_kerja', $area);
        }

        if ($personil) {
            if ($personil['tim'] === 'MEDIS') {
                $medis->where('badge_tenaga', $personil['badge']);
            } elseif ($personil['tim'] === 'SAFETY') {
                $safety->where('badge_tenaga', $personil['badge']);
            } elseif ($personil['tim'] === 'PENGAWAS') {
                $pengawas->where('badge_pengawas', $personil['badge']);
            }
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
        $tim = $filters['tim'];
        $out = collect();

        // ── 1. TIM SAFETY (Master Table: safety_officers) ──
        if (!$tim || $tim === 'SEMUA' || $tim === 'SAFETY') {
            $safetyOfficers = \App\Models\SafetyOfficer::with('pegawai')
                ->where('is_active', true)
                ->get();

            foreach ($safetyOfficers as $so) {
                $nama = $so->pegawai ? $so->pegawai->nama : 'Tanpa Nama';
                $badge = $so->badge;

                if ($badge) {
                    $key = "SAFETY|{$badge}|{$nama}";
                    $out->put($key, [
                        'key' => $key,
                        'badge' => $badge,
                        'nama' => $nama,
                        'tim' => 'SAFETY',
                    ]);
                }
            }
        }

        // ── 2. TIM PENGAWAS (Meniru Logic Subquery LaporanCapaianKpiController) ──
        if (!$tim || $tim === 'SEMUA' || $tim === 'PENGAWAS') {
            $pengawasList = \App\Models\Pegawai::where('is_active', true)
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
                ->orderBy('nama')
                ->get();

            foreach ($pengawasList as $p) {
                $key = "PENGAWAS|{$p->badge}|{$p->nama}";
                $out->put($key, [
                    'key' => $key,
                    'badge' => $p->badge,
                    'nama' => $p->nama,
                    'tim' => 'PENGAWAS',
                ]);
            }
        }

        // ── 3. TIM MEDIS (Hardcode 1 Personil Utama) ──
        if (!$tim || $tim === 'SEMUA' || $tim === 'MEDIS') {
            $daftarMedis = [
                ['badge' => 'K.250455', 'nama' => 'MUHAMMAD HAFIZ MAULANA'],
                ['badge' => 'K.26305', 'nama' => 'UTSNA ROSALINA MAULIDYA'], // ⬅️ BARU
            ];

            foreach ($daftarMedis as $m) {
                $key = "MEDIS|{$m['badge']}|{$m['nama']}";
                $out->put($key, [
                    'key' => $key,
                    'badge' => $m['badge'],
                    'nama' => $m['nama'],
                    'tim' => 'MEDIS',
                ]);
            }
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
        $tim = strtolower($personil['tim']);

        // ── SAFETY: Ambil dari relasi pivot (aktivitasKpi) milik SafetyOfficer ──
        if ($tim === 'safety') {
            $so = \App\Models\SafetyOfficer::with(['aktivitasKpi' => function ($q) {
                $q->where('status', 'AKTIF');
            }])->where('badge', $personil['badge'])->first();

            return $so ? $so->aktivitasKpi : collect();
        }

        // ── PENGAWAS: Ambil semua Aktivitas KPI Aktif untuk Tim Pengawas ──
        if ($tim === 'pengawas') {
            return AktivitasKpiK3::aktif()
                ->where('pengawas', true)
                ->orderBy('kode')
                ->get();
        }

        // ── MEDIS: Ambil semua Aktivitas KPI Aktif untuk Tim Medis ──
        if ($tim === 'medis') {
            return AktivitasKpiK3::aktif()
                ->where('medis', true)
                ->orderBy('kode')
                ->get();
        }

        return collect();
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

        [$laporanQuery, $kolomStatus, $kolomAktivitas] = $this->queryLaporanPersonil($personil, $mulai, $selesai);

        // 🆕 Ambil SEMUA laporan personil pada periode ini SEKALI saja (dipakai untuk total & per-aktivitas)
        $semuaLaporanPersonil = $laporanQuery->get();

        $batasTerlambatLapor = (int) $pengaturan->batas_terlambat_lapor;

        // 🆕 Closure tepat waktu dipisah supaya bisa dipakai dua kali (total & nanti kalau perlu)
        $cekTepatWaktu = function ($r) use ($batasTerlambatLapor) {
            $waktuSubmit = $r->waktu_submit ?? $r->created_at ?? null;
            $tanggalPelaksanaan = $r->tanggal_pelaksanaan ?? null;
            if (!$waktuSubmit || !$tanggalPelaksanaan) {
                return false;
            }
            $tglSubmit = Carbon::parse($waktuSubmit)->startOfDay();
            $tglPelaksanaan = Carbon::parse($tanggalPelaksanaan)->startOfDay();
            $selisihHari = $tglPelaksanaan->diffInDays($tglSubmit, false);
            return $selisihHari >= 0 && $selisihHari <= $batasTerlambatLapor;
        };

        // 🆕 Total disetujui & tepat waktu dihitung dari SELURUH laporan personil di periode ini —
        // termasuk laporan yang aktivitasnya TIDAK/TIDAK LAGI ditugaskan ke personil ini —
        // supaya konsisten dengan Ringkasan Status Dokumen (ringkasanStatusDokumen)
        $laporanDisetujui = $semuaLaporanPersonil->where($kolomStatus, 'APPROVE')->count();
        $laporanTepatWaktu = $semuaLaporanPersonil->where($kolomStatus, 'APPROVE')
            ->filter($cekTepatWaktu)
            ->count();

        $rincian = [];
        $capaianAktivitasTotalRaw = 0.0;

        // Ambil data kehadiran (cuti/standby) personil untuk periode ini
        $kehadiran = \App\Models\KehadiranKpiK3::where('badge', $personil['badge'])
            ->where('tahun_aktif', $filters['tahun'])
            ->where('bulan_aktif', $filters['bulan'])
            ->first();

        $hariCuti    = $kehadiran->hari_cuti_izin_sakit_alfa ?? 0;
        $hariStandby = $kehadiran->hari_standby ?? 0;

        // Basis hari kerja efektif SAMA untuk semua tim: pakai Hari Kerja Efektif Manajer
        $hariKerjaDasar = (int) $pengaturan->hari_kerja_efektif_manajer;
        $hariKerjaEfektifPersonil = max(0, $hariKerjaDasar - $hariCuti + $hariStandby);

        $totalTargetDinamis = 0.0;

        foreach ($aktivitasDitugaskan as $aktivitas) {
            /** @var AktivitasKpiK3 $aktivitas */

            // 🆕 Filter di memori dari $semuaLaporanPersonil, bukan query ulang ke DB
            if ($personil['tim'] === 'PENGAWAS') {
                $rows = $semuaLaporanPersonil->where('aktivitas_kpi_k3_id', $aktivitas->id);
            } else {
                $rows = $semuaLaporanPersonil->filter(
                    fn($r) => $this->cocokDenganAktivitas($r->{$kolomAktivitas} ?? null, $aktivitas)
                );
            }

            $disetujuiAktivitas = $rows->where($kolomStatus, 'APPROVE')->count();
            // 🆕 TIDAK lagi diakumulasi ke $laporanDisetujui / $laporanTepatWaktu di sini —
            // dua variabel itu sudah dihitung dari total di atas, terlepas dari hasil loop ini

            $bobotItemRaw = ($totalSkorTim > 0) ? ($aktivitas->skor / $totalSkorTim * 100) : 0.0;

            $target = $aktivitas->target_ikut_hari_kerja_personil
                ? $hariKerjaEfektifPersonil
                : (int) $aktivitas->target_per_bulan;
            $totalTargetDinamis += $target;

            $rasioCapaian = $target > 0 ? min($disetujuiAktivitas / $target, 1) : ($disetujuiAktivitas > 0 ? 1 : 0);

            $capaianAktivitasTotalRaw += ($rasioCapaian * $bobotItemRaw);

            $rincian[] = [
                'kode' => $aktivitas->kode,
                'nama_aktivitas' => $aktivitas->nama_aktivitas,
                'target_per_bulan' => $target,
                'laporan_disetujui' => $disetujuiAktivitas,
                'bobot_item' => round($bobotItemRaw, 1),
                'kontribusi' => round($rasioCapaian * $bobotItemRaw, 1),
                'status_capaian' => $rasioCapaian >= 1 ? 'TERCAPAI' : 'BELUM TERCAPAI',
            ];
        }

        $persentaseKetepatanWaktuRaw = $laporanDisetujui > 0 ? ($laporanTepatWaktu / $laporanDisetujui * 100) : 0.0;

        $bobotDitugaskanRaw = $totalSkorTim > 0
            ? ($aktivitasDitugaskan->sum('skor') / $totalSkorTim)
            : 0.0;

        $persentaseCapaianAktivitasRaw = $bobotDitugaskanRaw > 0
            ? ($capaianAktivitasTotalRaw / $bobotDitugaskanRaw)
            : 0.0;

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

        $tunjangan = $timDapatTunjangan
            ? round($nominalTunjanganTim * ($skorUntukTunjangan / 100))
            : 0;

        $persentaseCapaianAktivitas = round($persentaseCapaianAktivitasRaw, 1);
        $persentaseKetepatanWaktu = round($persentaseKetepatanWaktuRaw, 1);
        $nilaiKpiFinal = round($nilaiKpiFinalRaw, 1);

        $bobotDitugaskan = round($bobotDitugaskanRaw * 100, 1);

        $kategori = $this->kategoriPenilaian($nilaiKpiFinal, $pengaturan);

        return [
            'monitoring' => [
                'badge' => $personil['badge'],
                'nama' => $personil['nama'],
                'tim' => $personil['tim'],
                'hari_kerja_efektif' => $hariKerjaEfektifPersonil,
                'total_target_laporan' => $totalTargetDinamis,
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
        $personil = $filters['personil_terpilih'] ?? null;

        // Ada personil terpilih (kondisi normal di tab Safety/Pengawas/Medis) -> indikator hanya untuk orang itu
        if ($personil) {
            $hasil = $this->hitungKpiPersonil($personil, $pengaturan, $filters, true)['monitoring'];
            return [
                'total_laporan_disetujui' => $ringkasan['approve'],
                'rata_rata_skor_akhir' => $hasil['nilai_kpi_final'],
                'total_tunjangan' => $tampilkanRupiah ? (int) $hasil['tunjangan'] : null,
                'jumlah_personil_baik' => $hasil['kategori_penilaian'] === 'BAIK' ? 1 : 0,
            ];
        }

        // Fallback: tidak ada personil (mis. daftar kosong) -> agregat semua personil di filter ini
        $skorList = [];
        $totalTunjangan = 0;
        $jumlahBaik = 0;

        foreach ($daftarPersonil as $p) {
            $hasilP = $this->hitungKpiPersonil($p, $pengaturan, $filters, true)['monitoring'];
            $skorList[] = $hasilP['nilai_kpi_final'];
            $totalTunjangan += (int) $hasilP['tunjangan'];
            if ($hasilP['kategori_penilaian'] === 'BAIK') {
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
