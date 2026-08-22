<?php

namespace Database\Seeders;

use App\Models\LeadingInput;
use Illuminate\Database\Seeder;

class LeadingInputSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            // [tahun, no_urut, kategori, nama_kegiatan, satuan, target, [bulan01..12], bulan_mulai, setiap_n_bulan]
            [
                2026,
                1,
                'Safety Training',
                'Pemenuhan Matriks Pelatihan K3',
                '%',
                100,
                [null, null, 50, 50, 50, 50, 50, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                2,
                'Safety Training',
                'Safety Leadership Training (Pengawas)',
                'Kali/Tahun',
                1,
                array_fill(0, 12, null),
                12,
                12
            ],
            [
                2026,
                3,
                'Safety Training',
                'Induksi Karyawan Baru',
                '%',
                80,
                [null, null, 0, 0, 0, 0, 0, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                4,
                'Safety Training',
                'Refreshment Training Basic Safety',
                'Kali/Tahun',
                1,
                array_fill(0, 12, null),
                12,
                12
            ],
            [
                2026,
                5,
                'Safety Meeting',
                'Safety Management Walkthrough',
                'Kali/Tahun',
                3,
                [null, null, null, 1, null, 1, 1, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                6,
                'Safety Meeting',
                'P2K3 Bulanan',
                'Kali/Bulan',
                1,
                [null, null, 0, 0, 1, 1, 1, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                7,
                'Safety Meeting',
                'General Safety Talk',
                'Kali/Bulan',
                1,
                [null, null, 0, 0, 0, 0, 0, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                8,
                'Safety Inspection',
                'Inspeksi Kotak P3K',
                'Kali/Bulan/Safety',
                76,
                [null, null, 0, 0, 18, 45, 44, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                9,
                'Safety Inspection',
                'Inspeksi Kepatuhan Izin Kerja (PTW)',
                'Kali/Bulan/Safety',
                18,
                [null, null, 0, 0, 58, 82, 65, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                10,
                'Safety Inspection',
                'Inspeksi Unit (Vehicle Commissioning)',
                'Kali/Tahun',
                4,
                [null, null, 1, null, null, 1, 1, null, null, null, null, null],
                3,
                3
            ],
            [
                2026,
                11,
                'Safety Inspection',
                'Inspeksi Area Kerja',
                'Kali/Bulan/Safety',
                216,
                [null, null, 0, 0, 67, 150, 135, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                12,
                'Safety Inspection',
                'Inspeksi Peralatan Kerja',
                'Kali/Bulan/Safety',
                36,
                [null, null, 0, 0, 38, 39, 40, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                13,
                'Health Program',
                'Pemantauan Higiene Industri',
                'Kali/Tahun',
                2,
                [null, null, null, null, null, 0, 0, null, null, null, null, null],
                6,
                6
            ],
            [
                2026,
                14,
                'Health Program',
                'Promotive Health',
                'Kegiatan',
                19,
                [null, null, 0, 0, 2, 17, 14, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                15,
                'Health Program',
                'Evaluasi Fatigue',
                'Kali/Bulan/Petugas',
                19,
                [null, null, 0, 0, 0, 1, 1, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                16,
                'Health Program',
                'Fatigue Check',
                'Kali/Bulan',
                1,
                [null, null, 0, 0, 0, 1, 1, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                17,
                'Health Program',
                'Bugar Sehat',
                'Kali/Bulan/Petugas',
                19,
                [null, null, 0, 0, 7, 18, 11, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                18,
                'Health Program',
                'Daily Check Up (DCU)',
                'Kali/Bulan/Safety',
                380,
                [null, null, 0, 0, 125, 252, 275, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                19,
                'CAPA',
                'Persentase Penyelesaian CAPA (PICA)',
                '%',
                100,
                [null, null, 0, 0, 0, 100, 100, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                20,
                'BBS & Promotion',
                'Emergency Drill',
                'Kali/Tahun',
                1,
                array_fill(0, 12, null),
                12,
                12
            ],
            [
                2026,
                21,
                'BBS & Promotion',
                'Safety Campaign',
                'Kali/Bulan/Safety',
                18,
                [null, null, 0, 0, 4, 14, 13, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                22,
                'BBS & Promotion',
                'Safety Reward',
                'Kali/Bulan/Safety',
                72,
                [null, null, 0, 0, 30, 13, 38, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                23,
                'BBS & Promotion',
                'Safety Briefing',
                'Kali/Bulan/Petugas',
                204,
                [null, null, 0, 0, 51, 84, 66, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                24,
                'BBS & Promotion',
                'BBS (Behavior Based Safety)',
                'Kali/Bulan/Safety',
                360,
                [null, null, 0, 0, 288, 290, 282, null, null, null, null, null],
                null,
                null
            ],
            [
                2026,
                25,
                'BBS & Promotion',
                'Pelaporan Near Miss',
                'Kali/Bulan/Petugas',
                102,
                [null, null, 0, 0, 18, 22, 26, null, null, null, null, null],
                null,
                null
            ],

            // 2025 — tahun sebelumnya, belum ada realisasi sama sekali
            [2025, 1, 'Safety Training', 'Pemenuhan Matriks Pelatihan K3', '%', 100, array_fill(0, 12, null), null, null],
            [2025, 2, 'Safety Training', 'Safety Leadership Training (Pengawas)', 'Kali/Tahun', 1, array_fill(0, 12, null), null, null],
            [2025, 3, 'Safety Training', 'Induksi Karyawan Baru', '%', 80, array_fill(0, 12, null), null, null],
            [2025, 4, 'Safety Training', 'Refreshment Training Basic Safety', 'Kali/Tahun', 1, array_fill(0, 12, null), null, null],
            [2025, 5, 'Safety Meeting', 'Safety Management Walkthrough', 'Kali/Tahun', 3, array_fill(0, 12, null), null, null],
            [2025, 6, 'Safety Meeting', 'P2K3 Bulanan', 'Kali/Bulan', 1, array_fill(0, 12, null), null, null],
            [2025, 7, 'Safety Meeting', 'General Safety Talk', 'Kali/Bulan', 1, array_fill(0, 12, null), null, null],
            [2025, 8, 'Safety Inspection', 'Inspeksi Kotak P3K', 'Kali/Bulan/Petugas', 72, array_fill(0, 12, null), null, null],
            [2025, 9, 'Safety Inspection', 'Inspeksi Kepatuhan Izin Kerja (PTW)', 'Kali/Bulan/Safety', 18, array_fill(0, 12, null), null, null],
            [2025, 10, 'Safety Inspection', 'Inspeksi Unit (Vehicle Commissioning)', 'Kali/Tahun', 4, array_fill(0, 12, null), null, null],
            [2025, 11, 'Safety Inspection', 'Inspeksi Area Kerja', 'Kali/Bulan/Safety', 216, array_fill(0, 12, null), null, null],
            [2025, 12, 'Safety Inspection', 'Inspeksi Peralatan Kerja', 'Kali/Bulan/Safety', 36, array_fill(0, 12, null), null, null],
            [2025, 13, 'Health Program', 'Pemantauan Higiene Industri', 'Kali/Tahun', 2, array_fill(0, 12, null), null, null],
            [2025, 14, 'Health Program', 'Promotive Health', 'Kegiatan', 19, array_fill(0, 12, null), null, null],
            [2025, 15, 'Health Program', 'Evaluasi Fatigue', 'Kali/Bulan', 1, array_fill(0, 12, null), null, null],
            [2025, 16, 'Health Program', 'Fatigue Check', 'Kali/Bulan', 18, array_fill(0, 12, null), null, null],
            [2025, 17, 'Health Program', 'Bugar Sehat', 'Kali/Bulan', 18, array_fill(0, 12, null), null, null],
            [2025, 18, 'Health Program', 'Daily Check Up (DCU)', 'Kali/Bulan/Safety', 360, array_fill(0, 12, null), null, null],
            [2025, 19, 'CAPA', 'Persentase Penyelesaian CAPA (PICA)', '%', 100, array_fill(0, 12, null), null, null],
            [2025, 20, 'BBS & Promotion', 'Emergency Drill', 'Kali/Tahun', 1, array_fill(0, 12, null), null, null],
            [2025, 21, 'BBS & Promotion', 'Safety Campaign', 'Kali/Bulan/Safety', 18, array_fill(0, 12, null), null, null],
            [2025, 22, 'BBS & Promotion', 'Safety Reward', 'Kali/Bulan/Safety', 72, array_fill(0, 12, null), null, null],
            [2025, 23, 'BBS & Promotion', 'Safety Briefing', 'Kali/Bulan/Safety', 72, array_fill(0, 12, null), null, null],
            [2025, 24, 'BBS & Promotion', 'BBS (Behavior Based Safety)', 'Kali/Bulan/Safety', 360, array_fill(0, 12, null), null, null],
            [2025, 25, 'BBS & Promotion', 'Pelaporan Near Miss', 'Kali/Bulan/Safety', 36, array_fill(0, 12, null), null, null],
        ];

        foreach ($rows as [$tahun, $no, $kategori, $nama, $satuan, $target, $bulan, $bulanMulai, $setiapN]) {
            $payload = [
                'tahun' => $tahun,
                'no_urut' => $no,
                'kategori' => $kategori,
                'nama_kegiatan' => $nama,
                'satuan' => $satuan,
                'target' => $target,
                'aktif' => true,
                'bulan_mulai' => $bulanMulai,
                'setiap_n_bulan' => $setiapN,
            ];
            foreach ($bulan as $i => $v) {
                $payload['bulan_' . str_pad($i + 1, 2, '0', STR_PAD_LEFT)] = $v;
            }

            LeadingInput::updateOrCreate(
                ['tahun' => $tahun, 'no_urut' => $no],
                $payload
            );
        }
    }
}
