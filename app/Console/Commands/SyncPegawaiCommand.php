<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

// #[Signature('app:sync-pegawai-command')]
// #[Description('Command description')]

class SyncPegawaiCommand extends Command
{
    // Nama perintah yang akan dijalankan di terminal
    protected $signature = 'sync:pegawai';

    // Deskripsi perintah
    protected $description = 'Sinkronisasi data master pegawai dari API ERP ke database lokal K3';

    public function handle()
    {
        $this->info('Memulai sinkronisasi data pegawai dari API...');

        $apiUrl = config('services.pegawai.url') ?? env('PEGAWAI_API_URL');
        $apiKey = config('services.pegawai.key') ?? env('PEGAWAI_API_KEY');

        try {
            // Ambil data dari API ERP menggunakan key yang Anda miliki
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
                // Tentukan unique key, utamakan ID dari API atau gunakan NIK/Badge jika ID tidak ada
                $idApi = $item['id'] ?? $item['id_api'] ?? null;
                $nik = $item['nik'] ?? $item['NIK'] ?? $item['badge'] ?? $item['no_ktp'] ?? null;

                if (!$idApi && !$nik) {
                    continue; // Lewati jika data rusak/tidak memiliki identifier
                }

                // Gunakan updateOrCreate agar data lama diperbarui dan data baru ditambahkan
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

                        // --- TAMBAHAN DATA BARU YANG DIAMBIL DARI API ---
                        'tempat_lahir' => $item['tempat_lahir'] ?? null,
                        'tanggal_lahir' => $item['tanggal_lahir'] ?? null,
                        'alamat' => $item['alamat'] ?? null,
                        'no_bpjs_kesehatan' => $item['no_bpjs_kesehatan'] ?? null,
                        'no_bpjs_ketenagakerjaan' => $item['no_bpjs_ketenagakerjaan'] ?? null,
                        'kode_ok' => $item['kode_ok'] ?? null,
                        'nomor_ok' => $item['nomor_ok'] ?? null,
                        // ------------------------------------------------

                        'last_sync' => Carbon::now(),
                    ]
                );

                $count++;
            }

            $this->info("Sinkronisasi Berhasil! {$count} data pegawai telah diperbarui/ditambahkan ke database K3.");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat sinkronisasi: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
