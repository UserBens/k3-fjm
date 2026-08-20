<?php

namespace App\Services;

use App\Models\HariLiburNasional;
use Carbon\Carbon;

/**
 * Service untuk men-generate hari libur yang SECARA MATEMATIS pasti (tidak butuh
 * SKB / penetapan pemerintah): tanggal Masehi tetap, dan hari libur Kristen yang
 * dihitung dari Hari Paskah (Easter Sunday) memakai algoritma Gauss/Meeus.
 *
 * Kategori lain (HIJRIAH, IMLEK, NYEPI, WAISAK) TIDAK digenerate di sini karena
 * penetapan resminya mengikuti SKB 3 Menteri / rukyat, bukan rumus matematis murni.
 * Gunakan HariLiburGeneratorService::cekKelengkapanTahun() untuk mengetahui kategori
 * mana yang masih perlu diinput manual pada tahun tertentu.
 */
class HariLiburGeneratorService
{
    /**
     * Daftar hari libur Masehi dengan tanggal tetap tiap tahun.
     * format: [bulan, tanggal, nama, jenis]
     */
    private const MASEHI_TETAP = [
        [1, 1, 'Tahun Baru Masehi', 'LIBUR_NASIONAL'],
        [5, 1, 'Hari Buruh Internasional', 'LIBUR_NASIONAL'],
        [6, 1, 'Hari Lahir Pancasila', 'LIBUR_NASIONAL'],
        [8, 17, 'Proklamasi Kemerdekaan Republik Indonesia', 'LIBUR_NASIONAL'],
        [12, 25, 'Hari Raya Natal', 'LIBUR_NASIONAL'],
    ];

    /**
     * Generate & simpan seluruh hari libur AUTO (Masehi tetap + Paskah) untuk satu tahun.
     * Aman dipanggil berkali-kali (idempotent) berkat unique constraint tanggal+nama.
     */
    public function generateTahun(int $tahun): array
    {
        $dibuat = [];

        foreach (self::MASEHI_TETAP as [$bulan, $tanggal, $nama, $jenis]) {
            $dibuat[] = $this->simpanJikaBelumAda(
                Carbon::create($tahun, $bulan, $tanggal),
                $nama,
                $jenis,
                'MASEHI_TETAP'
            );
        }

        foreach ($this->hitungLiburPaskah($tahun) as [$tanggal, $nama, $jenis]) {
            $dibuat[] = $this->simpanJikaBelumAda($tanggal, $nama, $jenis, 'PASKAH');
        }

        return array_values(array_filter($dibuat));
    }

    /**
     * Hitung tanggal Hari Paskah (Easter Sunday) memakai algoritma Anonymous
     * Gregorian / Meeus, lalu turunkan 3 hari libur yang mengacu padanya.
     */
    private function hitungLiburPaskah(int $tahun): array
    {
        $paskah = $this->easterSunday($tahun);

        return [
            [$paskah->copy()->subDays(2), 'Wafat Yesus Kristus', 'LIBUR_NASIONAL'],   // Jumat Agung
            [$paskah->copy(),             'Hari Paskah (Kebangkitan Yesus Kristus)', 'LIBUR_NASIONAL'],
            [$paskah->copy()->addDays(39), 'Kenaikan Isa Almasih', 'LIBUR_NASIONAL'],
        ];
    }

    private function easterSunday(int $tahun): Carbon
    {
        // Algoritma Anonymous Gregorian (Meeus/Jones/Butcher)
        $a = $tahun % 19;
        $b = intdiv($tahun, 100);
        $c = $tahun % 100;
        $d = intdiv($b, 4);
        $e = $b % 4;
        $f = intdiv($b + 8, 25);
        $g = intdiv($b - $f + 1, 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = intdiv($c, 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = intdiv($a + 11 * $h + 22 * $l, 451);
        $bulan = intdiv($h + $l - 7 * $m + 114, 31);
        $tanggal = (($h + $l - 7 * $m + 114) % 31) + 1;

        return Carbon::create($tahun, $bulan, $tanggal);
    }

    private function simpanJikaBelumAda(Carbon $tanggal, string $nama, string $jenis, string $kategori): ?HariLiburNasional
    {
        $existing = HariLiburNasional::whereDate('tanggal', $tanggal->toDateString())
            ->where('nama_libur', $nama)
            ->first();

        if ($existing) {
            return null; // sudah ada, tidak perlu dibuat ulang
        }

        return HariLiburNasional::create([
            'tanggal' => $tanggal->toDateString(),
            'nama_libur' => $nama,
            'jenis' => $jenis,
            'kategori' => $kategori,
            'tahun' => $tanggal->year,
            'sumber' => 'AUTO',
        ]);
    }

    /**
     * Cek kategori mana saja yang belum punya data untuk tahun tertentu —
     * dipakai untuk menampilkan alert "perlu input manual" di halaman admin.
     */
    public function cekKelengkapanTahun(int $tahun): array
    {
        $adaKategori = HariLiburNasional::tahun($tahun)
            ->pluck('kategori')
            ->unique()
            ->values()
            ->all();

        $belumAda = array_values(array_diff(HariLiburNasional::KATEGORI_MANUAL, $adaKategori));

        return [
            'tahun' => $tahun,
            'kategori_lengkap' => $adaKategori,
            'kategori_belum_diinput' => $belumAda,
            'lengkap' => empty($belumAda),
        ];
    }
}
