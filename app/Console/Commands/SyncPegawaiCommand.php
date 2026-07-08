<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use App\Models\PengawasIntraUser;
use App\Models\PengawasPekerjaan;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

// #[Signature('app:sync-pegawai-command')]
// #[Description('Command description')]

// class SyncPegawaiCommand extends Command
// {
//     // Nama perintah yang akan dijalankan di terminal
//     protected $signature = 'sync:pegawai';

//     // Deskripsi perintah
//     protected $description = 'Sinkronisasi data master pegawai dari API ERP ke database lokal K3';

//     public function handle()
//     {
//         $this->info('Memulai sinkronisasi data pegawai dari API...');

//         $apiUrl = config('services.pegawai.url') ?? env('PEGAWAI_API_URL');
//         $apiKey = config('services.pegawai.key') ?? env('PEGAWAI_API_KEY');

//         try {
//             // Ambil data dari API ERP menggunakan key yang Anda miliki
//             $response = Http::withHeaders([
//                 'X-API-KEY' => $apiKey,
//             ])->timeout(30)->get($apiUrl);

//             if (!$response->successful()) {
//                 $this->error('Gagal mengambil data dari API. Status: ' . $response->status());
//                 return Command::FAILURE;
//             }

//             $json = $response->json();
//             $items = $json['data'] ?? $json;

//             if (!is_array($items)) {
//                 $this->error('Format data respons API tidak dikenali atau bukan array.');
//                 return Command::FAILURE;
//             }

//             $count = 0;

//             foreach ($items as $item) {
//                 // Tentukan unique key, utamakan ID dari API atau gunakan NIK/Badge jika ID tidak ada
//                 $idApi = $item['id'] ?? $item['id_api'] ?? null;
//                 $nik = $item['nik'] ?? $item['NIK'] ?? $item['badge'] ?? $item['no_ktp'] ?? null;

//                 if (!$idApi && !$nik) {
//                     continue; // Lewati jika data rusak/tidak memiliki identifier
//                 }

//                 // Gunakan updateOrCreate agar data lama diperbarui dan data baru ditambahkan
//                 Pegawai::updateOrCreate(
//                     ['id_api' => $idApi ?? $nik],
//                     [
//                         'badge' => $nik,
//                         'no_ktp' => $item['no_ktp'] ?? null,
//                         'nama' => $item['nama'] ?? $item['name'] ?? $item['nama_pegawai'] ?? '-',
//                         'jenis_kelamin' => $item['jenis_kelamin'] ?? $item['gender'] ?? null,
//                         'jabatan' => $item['jabatan'] ?? $item['posisi'] ?? null,
//                         'unit_kerjaid' => $item['unit_kerjaid'] ?? null,
//                         'lokasi_kerjaid' => $item['lokasi_kerjaid'] ?? null,
//                         'is_active' => $item['is_active'] ?? true,

//                         // --- TAMBAHAN DATA BARU YANG DIAMBIL DARI API ---
//                         'tempat_lahir' => $item['tempat_lahir'] ?? null,
//                         'tanggal_lahir' => $item['tanggal_lahir'] ?? null,
//                         'alamat' => $item['alamat'] ?? null,
//                         'no_bpjs_kesehatan' => $item['no_bpjs_kesehatan'] ?? null,
//                         'no_bpjs_ketenagakerjaan' => $item['no_bpjs_ketenagakerjaan'] ?? null,
//                         'kode_ok' => $item['kode_ok'] ?? null,
//                         'nomor_ok' => $item['nomor_ok'] ?? null,
//                         // ------------------------------------------------

//                         'last_sync' => Carbon::now(),
//                     ]
//                 );

//                 $count++;
//             }

//             $this->info("Sinkronisasi Berhasil! {$count} data pegawai telah diperbarui/ditambahkan ke database K3.");
//             return Command::SUCCESS;
//         } catch (\Exception $e) {
//             $this->error('Terjadi kesalahan saat sinkronisasi: ' . $e->getMessage());
//             return Command::FAILURE;
//         }
//     }
// }
class SyncPegawaiCommand extends Command
{
    protected $signature = 'sync:pegawai';
    protected $description = 'Sinkronisasi data master pegawai (beserta unit kerja) dari API ERP ke database lokal K3';

    public function handle()
    {
        // ── STEP 1: Sync Unit Kerja dulu (karena pegawai butuh referensi ini) ──
        if (!$this->syncUnitKerja()) {
            $this->error('Sinkronisasi dibatalkan karena gagal sync unit kerja.');
            return Command::FAILURE;
        }

        // ── STEP 2: Sync Pegawai ──
        $pegawaiResult = $this->syncPegawai();
        if ($pegawaiResult !== Command::SUCCESS) {
            $this->error('Sinkronisasi dihentikan karena gagal sync pegawai.');
            return $pegawaiResult;
        }

        // ── STEP 3: Sync Intra User (Pengawas) ──
        if (!$this->syncIntraUser()) {
            $this->error('Sinkronisasi dibatalkan karena gagal sync intra user.');
            return Command::FAILURE;
        }

        // ── STEP 4: Sync Pengawas Pekerjaan (relasi pengawas ↔ pegawai) ──
        if (!$this->syncPengawasPekerjaan()) {
            $this->error('Sinkronisasi dibatalkan karena gagal sync pengawas pekerjaan.');
            return Command::FAILURE;
        }

        $this->info('Semua sinkronisasi (unit kerja, pegawai, pengawas, pengawas pekerjaan) selesai!');
        return Command::SUCCESS;
    }

    /**
     * Sinkronisasi data unit kerja.
     */
    protected function syncUnitKerja(): bool
    {
        $this->info('Memulai sinkronisasi data unit kerja dari API...');

        $apiUrl = config('services.unit_kerja.url');
        $apiKey = config('services.unit_kerja.key');

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
            ])->timeout(30)->get($apiUrl);

            if (!$response->successful()) {
                $this->error('Gagal mengambil data unit kerja. Status: ' . $response->status() . ' - ' . $response->body());
                return false;
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                $this->error('Format data respons API unit kerja tidak dikenali.');
                return false;
            }

            $count = 0;
            foreach ($items as $item) {
                $idApi = $item['id'] ?? null;
                if (!$idApi) {
                    continue;
                }

                UnitKerja::updateOrCreate(
                    ['id_api' => $idApi],
                    [
                        'nama_unit_kerja' => $item['nama_unit_kerja'] ?? null,
                        'bagian' => $item['bagian'] ?? null,
                        'kode_unit_kerja' => $item['kode_unit_kerja'] ?? null,
                        'is_active' => $item['is_active'] ?? true,
                        'jam_masuk' => $item['jam_masuk'] ?? null,
                        'jam_pulang' => $item['jam_pulang'] ?? null,
                    ]
                );
                $count++;
            }

            $this->info("Sinkronisasi unit kerja berhasil! {$count} data diperbarui/ditambahkan.");
            return true;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat sinkronisasi unit kerja: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sinkronisasi data pegawai (kode asli Anda, tidak diubah).
     */
    protected function syncPegawai(): int
    {
        $this->info('Memulai sinkronisasi data pegawai dari API...');

        $apiUrl = config('services.pegawai.url') ?? env('PEGAWAI_API_URL');
        $apiKey = config('services.pegawai.key') ?? env('PEGAWAI_API_KEY');

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
            ])->timeout(30)->get($apiUrl);

            if (!$response->successful()) {
                $this->error('Gagal mengambil data dari API. Status: ' . $response->status());
                return Command::FAILURE;
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                $this->error('Format data respons API tidak dikenali atau bukan array.');
                return Command::FAILURE;
            }

            $count = 0;

            foreach ($items as $item) {
                $idApi = $item['id'] ?? $item['id_api'] ?? null;
                $nik = $item['nik'] ?? $item['NIK'] ?? $item['badge'] ?? $item['no_ktp'] ?? null;

                if (!$idApi && !$nik) {
                    continue;
                }

                Pegawai::updateOrCreate(
                    ['id_api' => $idApi ?? $nik],
                    [
                        'badge' => $nik,
                        'no_ktp' => $item['no_ktp'] ?? null,
                        'nama' => $item['nama'] ?? $item['name'] ?? $item['nama_pegawai'] ?? '-',
                        'jenis_kelamin' => $item['jenis_kelamin'] ?? $item['gender'] ?? null,
                        'jabatan' => $item['jabatan'] ?? $item['posisi'] ?? null,
                        'unit_kerjaid' => $item['unit_kerjaid'] ?? null,
                        'lokasi_kerjaid' => $item['lokasi_kerjaid'] ?? null,
                        'is_active' => $item['is_active'] ?? true,

                        'tempat_lahir' => $item['tempat_lahir'] ?? null,
                        'tanggal_lahir' => $item['tanggal_lahir'] ?? null,
                        'alamat' => $item['alamat'] ?? null,
                        'no_bpjs_kesehatan' => $item['no_bpjs_kesehatan'] ?? null,
                        'no_bpjs_ketenagakerjaan' => $item['no_bpjs_ketenagakerjaan'] ?? null,
                        'kode_ok' => $item['kode_ok'] ?? null,
                        'nomor_ok' => $item['nomor_ok'] ?? null,

                        'last_sync' => Carbon::now(),
                    ]
                );

                $count++;
            }

            $this->info("Sinkronisasi Berhasil! {$count} data pegawai telah diperbarui/ditambahkan ke database K3.");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat sinkronisasi pegawai: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    protected function syncIntraUser(): bool
    {
        $this->info('Memulai sinkronisasi data intra user (pengawas)...');

        $apiUrl = config('services.pengawas.url');
        $apiKey = config('services.pengawas.key');

        try {
            $response = Http::withHeaders(['X-API-KEY' => $apiKey])->timeout(30)->get($apiUrl);

            if (!$response->successful()) {
                $this->error('Gagal mengambil data intra user. Status: ' . $response->status());
                return false;
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                $this->error('Format data respons API intra user tidak dikenali.');
                return false;
            }

            $count = 0;
            foreach ($items as $item) {
                $idApi = $item['id_intra_user'] ?? null;
                if (!$idApi) continue;

                PengawasIntraUser::updateOrCreate(
                    ['id_api' => $idApi],
                    [
                        'username' => $item['username'] ?? null,
                        'nama_lengkap' => $item['nama_lengkap'] ?? null,
                        'email' => $item['email'] ?? null,
                        'is_active' => $item['is_active'] ?? true,
                        'role_user' => $item['role_user'] ?? null,
                        'kode_ok_tagihan' => $item['kode_ok_tagihan'] ?? null,
                        'kode_ok_pekerjaan' => $item['kode_ok_pekerjaan'] ?? null,
                        'unit_kerja_pekerjaan' => $item['unit_kerja_pekerjaan'] ?? null,
                        'unit_kerja_tagihan' => $item['unit_kerja_tagihan'] ?? null,
                        'last_sync' => Carbon::now(),
                    ]
                );
                $count++;
            }

            $this->info("Sinkronisasi intra user berhasil! {$count} data.");
            return true;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat sinkronisasi intra user: ' . $e->getMessage());
            return false;
        }
    }

    protected function syncPengawasPekerjaan(): bool
    {
        $this->info('Memulai sinkronisasi data pengawas pekerjaan...');

        $apiUrl = config('services.pengawas_pekerjaan.url');
        $apiKey = config('services.pengawas_pekerjaan.key');

        try {
            $response = Http::withHeaders(['X-API-KEY' => $apiKey])->timeout(30)->get($apiUrl);

            if (!$response->successful()) {
                $this->error('Gagal mengambil data pengawas pekerjaan. Status: ' . $response->status());
                return false;
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                $this->error('Format data respons API pengawas pekerjaan tidak dikenali.');
                return false;
            }

            $count = 0;
            foreach ($items as $item) {
                $idApi = $item['id'] ?? null;
                if (!$idApi) continue;

                PengawasPekerjaan::updateOrCreate(
                    ['id_api' => $idApi],
                    [
                        'pengguna_id' => $item['penggunaid'] ?? null,
                        'pegawai_id' => $item['pegawaiid'] ?? null,
                        'last_sync' => Carbon::now(),
                    ]
                );
                $count++;
            }

            $this->info("Sinkronisasi pengawas pekerjaan berhasil! {$count} data.");
            return true;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat sinkronisasi pengawas pekerjaan: ' . $e->getMessage());
            return false;
        }
    }
}
