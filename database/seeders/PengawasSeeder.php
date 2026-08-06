<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengawasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Definisikan ID API unik sebagai Kunci Relasi (bisa disesuaikan formatnya)
        $idApiPegawai  = 'PEG-K26307';
        $idApiUser     = 'USR-K26307';
        $idApiPengawas = 'PNG-K26307';

        // 2. Tambah / Update Data Master Pegawai
        DB::table('pegawais')->updateOrInsert(
            ['badge' => 'K.26307'], // Pengecekan berdasarkan badge agar tidak duplikat
            [
                'id_api'     => $idApiPegawai,
                'badge'      => 'K.26307',
                'nama'       => 'HELMI ALIF SAIFFUDIN',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 3. Tambah / Update Data Intra User Pengawas
        DB::table('pengawas_intra_users')->updateOrInsert(
            ['id_api' => $idApiUser], // Pengecekan berdasarkan id_api
            [
                'username'     => 'helmi.alif',
                'nama_lengkap' => 'HELMI ALIF SAIFFUDIN',
                'email'        => 'helmi.alif@example.com',
                'is_active'    => true,
                'role_user'    => 'PENGAWAS',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]
        );

        // 4. Hubungkan di Tabel pengawas_pekerjaans
        DB::table('pengawas_pekerjaans')->updateOrInsert(
            ['id_api' => $idApiPengawas],
            [
                'pengguna_id' => $idApiUser,    // Relasi ke pengawas_intra_users.id_api
                'pegawai_id'  => $idApiPegawai, // Relasi ke pegawais.id_api
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );
    }
}
