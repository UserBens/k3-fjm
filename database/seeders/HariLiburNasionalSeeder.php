<?php

namespace Database\Seeders;

use App\Models\HariLiburNasional;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HariLiburNasionalSeeder extends Seeder
{
    /**
     * Data mentah sesuai master yang sudah ada (2025 & 2026).
     * format: [tanggal d/m/Y, nama]
     * Kategori & jenis (LIBUR_NASIONAL vs CUTI_BERSAMA) ditentukan otomatis
     * dari nama saat proses import (lihat resolveJenis() & resolveKategori()).
     */
    private const DATA = [
        ['01/01/2026', 'Tahun Baru 2026 Masehi'],
        ['16/01/2026', 'Isra Mikraj Nabi Muhammad SAW'],
        ['16/02/2026', 'Cuti Bersama Tahun Baru Imlek'],
        ['17/02/2026', 'Tahun Baru Imlek 2577 Kongzili'],
        ['18/03/2026', 'Cuti Bersama Hari Suci Nyepi'],
        ['19/03/2026', 'Hari Suci Nyepi (Tahun Baru Saka 1948)'],
        ['20/03/2026', 'Cuti Bersama Idul Fitri 1447 H'],
        ['21/03/2026', 'Hari Raya Idul Fitri 1447 H'],
        ['22/03/2026', 'Hari Raya Idul Fitri 1447 H'],
        ['23/03/2026', 'Cuti Bersama Idul Fitri 1447 H'],
        ['24/03/2026', 'Cuti Bersama Idul Fitri 1447 H'],
        ['03/04/2026', 'Wafat Yesus Kristus'],
        ['05/04/2026', 'Hari Paskah (Kebangkitan Yesus Kristus)'],
        ['01/05/2026', 'Hari Buruh Internasional'],
        ['14/05/2026', 'Kenaikan Isa Almasih'],
        ['15/05/2026', 'Cuti Bersama Kenaikan Isa Almasih'],
        ['27/05/2026', 'Hari Raya Idul Adha 1447 H'],
        ['28/05/2026', 'Cuti Bersama Idul Adha 1447 H'],
        ['31/05/2026', 'Hari Raya Waisak 2570 BE'],
        ['01/06/2026', 'Hari Lahir Pancasila'],
        ['16/06/2026', 'Tahun Baru Islam 1448 Hijriah'],
        ['17/08/2026', 'Proklamasi Kemerdekaan RI'],
        ['25/08/2026', 'Maulid Nabi Muhammad SAW'],
        ['24/12/2026', 'Cuti Bersama Hari Raya Natal'],
        ['25/12/2026', 'Hari Raya Natal'],
        ['01/01/2025', 'Tahun Baru 2025 Masehi'],
        ['28/01/2025', 'Tahun Baru Imlek'],
        ['27/01/2025', 'Isra Mikraj Nabi Muhammad SAW'],
        ['29/01/2025', 'Tahun Baru Imlek Kongzili'],
        ['28/03/2025', 'Cuti Bersama Hari Suci Nyepi'],
        ['29/03/2025', 'Hari Raya Suci Nyepi'],
        ['31/03/2025', 'Hari Raya Idul Fitri'],
        ['01/04/2025', 'Hari Raya Idul Fitri'],
        ['02/04/2025', 'Cuti Bersama Idul Fitri'],
        ['03/04/2025', 'Cuti Bersama Idul Fitri'],
        ['04/04/2025', 'Cuti Bersama Idul Fitri'],
        ['07/04/2025', 'Cuti Bersama Idul Fitri'],
        ['18/04/2025', 'Wafat Yesus Kristus'],
        ['01/05/2025', 'Hari Buruh Internasional'],
        ['29/05/2025', 'Kenaikan Isa Almasih'],
        ['30/05/2025', 'Cuti Bersama Kenaikan Isa Almasih'],
        ['01/06/2025', 'Hari Lahir Pancasila'],
        ['06/06/2025', 'Hari Raya Idul Adha'],
        ['27/06/2025', 'Tahun Baru Islam'],
        ['05/09/2025', 'Maulid Nabi Muhammad SAW'],
        ['25/12/2025', 'Hari Raya Natal'],
        ['26/12/2025', 'Cuti Bersama Hari Raya Natal'],
    ];

    public function run(): void
    {
        foreach (self::DATA as [$tanggalStr, $nama]) {
            $tanggal = Carbon::createFromFormat('d/m/Y', $tanggalStr);

            HariLiburNasional::updateOrCreate(
                ['tanggal' => $tanggal->toDateString(), 'nama_libur' => $nama],
                [
                    'jenis' => $this->resolveJenis($nama),
                    'kategori' => $this->resolveKategori($nama),
                    'tahun' => $tanggal->year,
                    'sumber' => 'MANUAL', // data historis, dianggap hasil input manual/SKB
                ]
            );
        }
    }

    private function resolveJenis(string $nama): string
    {
        return str_contains(strtolower($nama), 'cuti bersama') ? 'CUTI_BERSAMA' : 'LIBUR_NASIONAL';
    }

    private function resolveKategori(string $nama): string
    {
        $n = strtolower($nama);

        return match (true) {
            str_contains($n, 'tahun baru masehi') => 'MASEHI_TETAP',
            str_contains($n, 'buruh') => 'MASEHI_TETAP',
            str_contains($n, 'pancasila') => 'MASEHI_TETAP',
            str_contains($n, 'proklamasi') => 'MASEHI_TETAP',
            str_contains($n, 'natal') => 'MASEHI_TETAP',
            str_contains($n, 'wafat yesus') || str_contains($n, 'paskah') || str_contains($n, 'kenaikan isa') => 'PASKAH',
            str_contains($n, 'imlek') => 'IMLEK',
            str_contains($n, 'nyepi') || str_contains($n, 'saka') => 'NYEPI',
            str_contains($n, 'waisak') => 'WAISAK',
            str_contains($n, 'idul fitri') || str_contains($n, 'idul adha') || str_contains($n, 'isra mikraj') || str_contains($n, 'maulid') || str_contains($n, 'islam hijriah') || str_contains($n, 'tahun baru islam') => 'HIJRIAH',
            default => 'LAINNYA',
        };
    }
}
