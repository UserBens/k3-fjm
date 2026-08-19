<?php

namespace Database\Seeders;

use App\Models\ProfilKerjaApd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilKerjaApdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sumber = 'PENILAIAN K3 PT FJM — perlu divalidasi Ahli K3';

        $rows = [
            ['P00', '(BELUM DIPETAKAN)', [0, 0, 0, 0, 0, 0, 0, 0], 'Jabatan kosong / belum dipetakan — wajib ditinjau K3', '—', 'Belum dipetakan — wajib ditinjau K3 sebelum dipakai menghitung', '—', 740],
            ['P01', 'Administrasi & Perkantoran', [0, 0, 0, 0, 0, 0, 0, 0], 'Ergonomi statis, slip-trip-fall ringan; tanpa paparan proses', 'ADMINISTRASI, SEKRETARIS, AKUNTANSI, PROGRAMMER, DRAFTER, LOKET', 'Tanpa paparan proses. Slip-trip-fall dikendalikan housekeeping, bukan APD', $sumber, 532],
            ['P02', 'Pengawasan & Inspeksi Lapangan', [1, 1, 1, 2, 1, 1, 0, 0], 'Paparan singkat lintas area proses; kebisingan, kimia dosis rendah, lalu lintas alat', 'PENGAWAS, INSPECTOR, SAFETY OFFICER, ADVISOR, LEADMAN', 'Paparan singkat lintas area proses; kebisingan rutin saat inspeksi', $sumber, 119],
            ['P03', 'Keamanan & Patroli', [0, 0, 1, 1, 1, 0, 0, 0], 'Cuaca, lalu lintas kendaraan, patroli lintas zona, kerja malam', 'SATPAM, PAM, KEAMANAN LAUT, PROTOKOL', 'Patroli lintas zona, lalu lintas kendaraan, kerja malam', $sumber, 294],
            ['P04', 'Housekeeping & Cleaning', [2, 1, 2, 1, 2, 1, 0, 0], 'Debu pupuk, bahan kimia pembersih, limbah, ergonomi angkat-angkut, benda tajam', 'HOUSEKEEPING, CLEANING SERVICE, CLEANING AREA, PENGHIJAUAN', 'Debu pupuk & bahan kimia pembersih rutin; benda tajam pada penanganan limbah', $sumber, 586],
            ['P05', 'Operator Produksi & Panel', [3, 3, 2, 3, 2, 1, 2, 1], 'Amoniak/urea/asam, tekanan & suhu tinggi, kebisingan, debu kimia', 'OPERATOR PRODUKSI, PEMBANTU OPERATOR, OPERATOR PANEL, OPERATOR PURIFIKASI', 'Amoniak/urea/asam dan kebisingan terus-menerus di area proses utama (kompleks zona MERAH)', $sumber, 395],
            ['P06', 'Operator Alat Berat & Angkut', [0, 1, 2, 2, 2, 1, 0, 0], 'Tertabrak-terjepit, getaran seluruh tubuh, debu, kebisingan mesin', 'OPERATOR FORKLIFT, WHEEL LOADER, CRANE, EXCAVATOR, BULLDOZER', 'Tertabrak-terjepit alat berat, getaran, debu curah, kebisingan mesin', $sumber, 187],
            ['P07', 'Mekanik & Fitter', [1, 1, 1, 2, 3, 2, 2, 1], 'Hand tool, energi tersimpan, terjepit, minyak/pelumas, kerja ketinggian sedang', 'TUKANG MEKANIK, FITTER, MEKANIK ALAT BERAT, MEKANIKAL POMPA, HELPER', 'Energi tersimpan & benda tajam terus-menerus; kerja ketinggian sedang', $sumber, 262],
            ['P08', 'Pengelasan & Kerja Panas', [0, 2, 3, 2, 2, 2, 4, 1], 'Radiasi UV/IR, fume logam, percikan api, luka bakar, risiko kebakaran', 'TUKANG LAS, TUKANG BUBUT, MESIN FABRIKASI, LAS ALAT BERAT', 'Radiasi UV/IR, fume logam, percikan api — bahaya panas pada tingkat tertinggi', $sumber, 134],
            ['P09', 'Listrik & Instrument', [0, 0, 1, 1, 2, 2, 1, 3], 'Sengatan listrik, arc flash, kerja pada panel bertegangan', 'TUKANG LISTRIK, TUKANG INSTRUMENT, LISTMEN, REWINDING MOTOR', 'Arc flash & pekerjaan pada panel bertegangan — bahaya listrik tingkat tertinggi', $sumber, 101],
            ['P10', 'Sipil, Ketinggian & Pelapisan', [2, 0, 3, 1, 2, 4, 1, 1], 'Jatuh dari ketinggian, debu silika, cat/solvent, ruang terbatas', 'TUKANG ANDANG, TUKANG SIPIL, TUKANG CAT, SANDBLASTING, FRP, RUBBER LINING, ISOLASI', 'Jatuh dari ketinggian sebagai bahaya pengendali; debu silika & solvent', $sumber, 93],
            ['P11', 'Laboratorium & Sampling', [2, 2, 1, 0, 1, 0, 1, 0], 'Reagen kimia, uap asam, sampling produk & gas proses', 'ANALIS LABORATORIUM, ANALIS, PEMBANTU ANALIS, PETUGAS SAMPLING, IQC', 'Reagen kimia dan uap asam dalam jumlah kecil, ditangani di lemari asam — bukan paparan skala proses', $sumber, 127],
            ['P12', 'Bongkar Muat & Pelabuhan', [1, 1, 3, 2, 3, 3, 0, 0], 'Debu curah, jatuh ke air, alat angkat, conveyor, cuaca terbuka', 'CHECKER, OPERATOR CSU, OPERATOR CONVEYOR, PERAMBUAN, JEMBATAN TIMBANG', 'Debu curah, alat angkat, dan risiko jatuh ke air di dermaga', $sumber, 110],
            ['P13', 'Tanggap Darurat & Pemadam', [3, 3, 2, 2, 2, 3, 4, 1], 'Kebakaran, gas beracun, penyelamatan, suhu ekstrem', 'PEMADAM KEBAKARAN, SAFETY MAN, SAFETY KOORDINATOR', 'Kebakaran, gas beracun, dan penyelamatan — paparan gabungan tingkat tertinggi', $sumber, 19],
            ['P14', 'Driver & Transportasi', [0, 0, 1, 1, 1, 0, 0, 0], 'Lalu lintas, getaran, bongkar muat ringan', 'DRIVER, KOORDINATOR DRIVER, DRIVER TRUCK SOLAR', 'Lalu lintas kendaraan; bongkar muat ringan tanpa alat angkat', $sumber, 88],
        ];

        foreach ($rows as [$kode, $nama, $b, $deskripsi, $contoh, $dasar, $sumberSkor, $jmlKaryawan]) {
            ProfilKerjaApd::updateOrCreate(
                ['kode_profil' => $kode],
                [
                    'nama_profil' => $nama,
                    'b1' => $b[0],
                    'b2' => $b[1],
                    'b3' => $b[2],
                    'b4' => $b[3],
                    'b5' => $b[4],
                    'b6' => $b[5],
                    'b7' => $b[6],
                    'b8' => $b[7],
                    'deskripsi_paparan' => $deskripsi,
                    'contoh_jabatan'    => $contoh,
                    'dasar_penilaian'   => $dasar,
                    'sumber_skor'       => $sumberSkor,
                    'jml_karyawan'      => $jmlKaryawan,
                    'status'            => 'AKTIF',
                ]
            );
        }
    }
}
