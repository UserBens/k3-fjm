<?php

namespace Database\Seeders;

use App\Models\PengaturanKpiK3;
use Illuminate\Database\Seeder;

class PengaturanKpiK3Seeder extends Seeder
{
    public function run(): void
    {
        PengaturanKpiK3::updateOrCreate(
            ['id' => 1], // baris pengaturan bersifat tunggal
            [
                // 1 · PERIODE AKTIF
                'tahun_aktif' => 2026,
                'bulan_aktif' => 7,
                'tanggal_cutoff_manajer' => 26,
                'periode_manajer_mulai' => '2026-06-26',
                'periode_manajer_selesai' => '2026-07-25',
                'periode_p2k3_mulai' => '2026-07-01',
                'periode_p2k3_selesai' => '2026-07-31',
                'hari_kerja_efektif_manajer' => 21,
                'hari_kerja_efektif_p2k3' => 23,
                'jumlah_hari_kalender_manajer' => 30,
                'jumlah_hari_kalender_p2k3' => 31,

                // 2 · KETEPATAN WAKTU
                'batas_terlambat_lapor' => 7,
                'batas_lapor_lebih_awal' => 1,

                // 3 · BOBOT PENILAIAN
                'porsi_capaian_aktivitas' => 90,
                'porsi_ketepatan_waktu' => 10,

                // 4 · TUNJANGAN
                'tunjangan_penuh' => 600000,
                'skor_minimum_tunjangan' => 0,
                'skor_maksimum_tunjangan' => 100,
                'tim_safety_dapat_tunjangan' => true,
                'tim_pengawas_dapat_tunjangan' => false,
                'tim_medis_dapat_tunjangan' => false,

                // 6 · AMBANG WARNA
                'ambang_merah' => 75,
                'ambang_kuning' => 90,
            ]
        );
    }
}