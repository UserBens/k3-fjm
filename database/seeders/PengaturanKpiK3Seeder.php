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
                // 1 · PERIODE AKTIF (Berdasarkan waktu berjalan Agustus 2026)
                'tahun_aktif' => 2026,
                'bulan_aktif' => 8, // Agustus
                'tanggal_cutoff_manajer' => 26,
                'periode_manajer_mulai' => '2026-07-26',
                'periode_manajer_selesai' => '2026-08-25',
                'periode_p2k3_mulai' => '2026-08-01',
                'periode_p2k3_selesai' => '2026-08-31',

                // Hari Kerja Efektif disesuaikan dari data Sheet
                'hari_kerja_efektif_manajer' => 20,
                'hari_kerja_efektif_p2k3' => 19,

                // Jumlah hari kalender dari tanggal mulai - selesai di atas
                'jumlah_hari_kalender_manajer' => 31,
                'jumlah_hari_kalender_p2k3' => 31,

                // 2 · KETEPATAN WAKTU
                'batas_terlambat_lapor' => 7,
                'batas_lapor_lebih_awal' => 0, // Sesuai sheet ("-")

                // 3 · BOBOT PENILAIAN
                'porsi_capaian_aktivitas' => 90,
                'porsi_ketepatan_waktu' => 10,

                // 4 · TUNJANGAN
                // Nominal dipecah per skema baru, semua diset 600.000
                'tunjangan_safety' => 600000,
                'tunjangan_pengawas' => 600000,
                'tunjangan_medis' => 600000,

                'skor_minimum_tunjangan' => 0, // Sesuai sheet ("-")
                'skor_maksimum_tunjangan' => 100,

                // Status berhak dapat tunjangan sesuai sheet
                'tim_safety_dapat_tunjangan' => true,
                'tim_pengawas_dapat_tunjangan' => false,
                'tim_medis_dapat_tunjangan' => false,

                // 6 · AMBANG WARNA
                // Standar minimal "Baik" = 80. Ambang merah dipertahankan di 75.
                'ambang_merah' => 75,
                'ambang_kuning' => 80,
            ]
        );
    }
}
