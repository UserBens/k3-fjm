<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataSafetySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badge = 'K.210050';
        $nama = 'RAHMAT BUDI PRASETYO';
        $area = 'PERGUDANGAN';
        $unitKerja = 'Dep. Pergudangan';
        $waktuSubmit = Carbon::create(2026, 8, 5, 8, 0, 0); // Diset waktu berjalan Agustus 2026

        $data = [
            // ── 1. Laporan Temuan UA/UC (C.2) ──
            [
                'waktu_submit' => $waktuSubmit->copy()->subDays(3),
                'tanggal_pelaksanaan' => '2026-08-02',
                'badge_tenaga' => $badge,
                'nama_tenaga' => $nama,
                'area_kerja' => $area,
                'sub_area' => 'Gudang Utama A',
                'unit_kerja' => $unitKerja,
                'jenis_aktifitas_kpi' => 'C.2',
                'kategori_form' => 'C.2',

                // Field Khusus C.2
                'item_temuan' => 'Pekerja tidak menggunakan rompi pantul (High-Visibility Vest) saat berada di area lalu lintas forklift.',
                'jenis_penyebab' => 'Unsafe Action',
                'deskripsi_temuan' => 'Ditemukan 1 orang pekerja helper bongkar muat sedang berjalan di jalur lintasan alat berat tanpa menggunakan rompi.',
                'rekomendasi_tindakan_temuan' => 'Memberikan teguran langsung dan menginstruksikan pekerja untuk memakai APD lengkap sebelum melanjutkan pekerjaan.',
                'status_temuan' => 'CLOSED',
                'foto_temuan_uauc_path' => 'uploads/safety/c2/foto_temuan_1.jpg',
                'formulir_kegiatan_inspeksi_area_kerja_path' => 'uploads/safety/c2/form_inspeksi_1.pdf',

                'keputusan' => 'APPROVED',
                'direview_oleh' => 'Admin K3',
                'direview_at' => current_time_for_seeder(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ── 2. Laporan OBSERI (C.4) ──
            [
                'waktu_submit' => $waktuSubmit->copy()->subDays(2),
                'tanggal_pelaksanaan' => '2026-08-03',
                'badge_tenaga' => $badge,
                'nama_tenaga' => $nama,
                'area_kerja' => $area,
                'sub_area' => 'Loading Dock B',
                'unit_kerja' => $unitKerja,
                'jenis_aktifitas_kpi' => 'C.4',
                'kategori_form' => 'C.4',

                // Field Khusus C.4
                'nama_subject_observasi' => 'Tim Operator Forklift Gudang',
                'proses_kerja' => 'Proses pemindahan pallet pupuk dari truk ekspedisi ke rak susun.',
                'formulir_observi_path' => 'uploads/safety/c4/form_observasi_1.pdf',
                'formulir_kegiatan_observi_path' => 'uploads/safety/c4/dokumen_observasi_1.pdf',

                'keputusan' => 'PENDING',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ── 3. Laporan Safety Briefing (D.2) ──
            [
                'waktu_submit' => $waktuSubmit->copy()->subDays(1),
                'tanggal_pelaksanaan' => '2026-08-04',
                'badge_tenaga' => $badge,
                'nama_tenaga' => $nama,
                'area_kerja' => $area,
                'sub_area' => 'Halaman Depan Gudang',
                'unit_kerja' => $unitKerja,
                'jenis_aktifitas_kpi' => 'D.2',
                'kategori_form' => 'D.2',

                // Field Khusus D.2
                'foto_pelaksanaan_safety_briefing_path' => 'uploads/safety/d2/foto_briefing_1.jpg',
                'foto_daftar_hadir_briefing_path' => 'uploads/safety/d2/absensi_briefing_1.jpg',
                'formulir_kegiatan_safety_briefing_path' => 'uploads/safety/d2/form_briefing_1.pdf',

                'keputusan' => 'APPROVED',
                'direview_oleh' => 'Admin K3',
                'direview_at' => current_time_for_seeder(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ── 4. Laporan Evaluasi Fatigue / Tes Keseimbangan Romberg (E.4) ──
            [
                'waktu_submit' => $waktuSubmit->copy(),
                'tanggal_pelaksanaan' => '2026-08-05',
                'badge_tenaga' => $badge,
                'nama_tenaga' => $nama,
                'area_kerja' => $area,
                'sub_area' => 'Pos Security Gudang',
                'unit_kerja' => $unitKerja,
                'jenis_aktifitas_kpi' => 'E.4',
                'kategori_form' => 'E.4',

                // Field Khusus E.4 (Romberg Test)
                'nama_pekerja_romberg' => 'Budi Santoso (Supir Truk)',
                'foto_kegiatan_tes_keseimbangan_path' => 'uploads/safety/e4/foto_romberg_1.jpg',
                'formulir_hasil_pemeriksaan_romberg_path' => 'uploads/safety/e4/hasil_romberg_1.pdf',
                'formulir_kegiatan_tes_keseimbangan_path' => 'uploads/safety/e4/form_kegiatan_romberg_1.pdf',

                'keputusan' => 'PENDING',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $row) {
            DB::table('data_safety')->insert($row);
        }
    }
}

// Helper function simulasi waktu
function current_time_for_seeder()
{
    return Carbon::create(2026, 8, 5, 9, 30, 0);
}
