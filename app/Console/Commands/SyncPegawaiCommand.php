<?php

namespace App\Console\Commands;

use App\Models\LokasiKerja;
use App\Models\Pegawai;
use App\Models\PengawasIntraUser;
use App\Models\PengawasPekerjaan;
use App\Models\Subkon;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncPegawaiCommand extends Command
{
    protected array $safetyOfficerBadges = [
        'K.202737', // ARI ANGGI WICAKSONO
        'K.240394', // GLADIOL QUEEN DANATAMA
        'K.210050', // RAHMAT BUDI PRASETYO
        'K.230218', // YOGA PRASETYA BHASKARA
        'K.210838', // A. SULTHONI MAHFUD
        'K.210283', // ABDUL HAMID JUNAIDI
        'K.240385', // ERINA AVIDAH AULIA
        'K.250351', // AYU PUSPA ARUM M.K.W
        'K.210112', // M FARIZ ALEXFAN
        'K.210282', // FUADUR ZAKKI KURNIAWAN
        'K.210837', // MUHAMMAD SYAMSUL HUDA
        'K.230219', // RICKO ADISETYO
        'K.210835', // ADITYA PRADANA PUTRA
        'K.200384', // MUKHLISIN
        'K.230229', // GIGIH PRILLA ADITAMA
        'K.202860', // SYAFRIZAL FIRDAUS
    ];
    protected $signature = 'sync:pegawai';
    protected $description = 'Sinkronisasi data master pegawai (beserta unit kerja) dari API ERP ke database lokal K3';

    public function handle()
    {
        // ── STEP 1: Sync Unit Kerja dulu (karena pegawai butuh referensi ini) ──
        if (!$this->syncUnitKerja()) {
            $this->error('Sinkronisasi dibatalkan karena gagal sync unit kerja.');
            return Command::FAILURE;
        }

        // ── STEP 1b: Sync Master Lokasi Kerja ──
        if (!$this->syncLokasiKerja()) {
            $this->error('Sinkronisasi dibatalkan karena gagal sync lokasi kerja.');
            return Command::FAILURE;
        }

        // ── STEP 1c: Sync Master Subkon ──
        if (!$this->syncSubkon()) {
            $this->error('Sinkronisasi dibatalkan karena gagal sync subkon.');
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

        if (!$this->assignSafetyOfficers()) {
            $this->error('Sinkronisasi dilanjutkan, tapi gagal menetapkan status Safety Officer.');
            // sengaja TIDAK return FAILURE di sini — kegagalan tagging Safety Officer
            // tidak perlu membatalkan sync pegawai/pengawas yang sudah berhasil.
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

    protected function syncLokasiKerja(): bool
    {
        $this->info('Memulai sinkronisasi data lokasi kerja dari API...');
        $url = 'https://mobile.fokusjasamitra.com/api/erp/api/lokasi-kerja?api_key=VXME9exqyx7j77rbAmlSPw8UjuJpRHjsLH0cm7zTF64VjU19mhXqkdxbExTvQRME';

        try {
            $response = Http::timeout(30)->get($url);

            if (!$response->successful()) {
                $this->error('Gagal mengambil data lokasi kerja. Status: ' . $response->status());
                return false;
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                $this->error('Format data respons API lokasi kerja tidak dikenali.');
                return false;
            }

            $count = 0;
            foreach ($items as $item) {
                $idApi = $item['id'] ?? null;
                if (!$idApi) continue;

                LokasiKerja::updateOrCreate(
                    ['id_api' => $idApi],
                    [
                        'nama_lokasi' => $item['nama_lokasi'] ?? null,
                        'kode_lokasi' => $item['kode_lokasi'] ?? null,
                    ]
                );
                $count++;
            }

            $this->info("Sinkronisasi lokasi kerja berhasil! {$count} data diperbarui/ditambahkan.");
            return true;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat sinkronisasi lokasi kerja: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sinkronisasi Master Subkon.
     */
    protected function syncSubkon(): bool
    {
        $this->info('Memulai sinkronisasi data subkon dari API...');
        $url = 'https://mobile.fokusjasamitra.com/api/erp/api/lokasi-kerja-subkon?api_key=VXME9exqyx7j77rbAmlSPw8UjuJpRHjsLH0cm7zTF64VjU19mhXqkdxbExTvQRME';

        try {
            $response = Http::timeout(30)->get($url);

            if (!$response->successful()) {
                $this->error('Gagal mengambil data subkon. Status: ' . $response->status());
                return false;
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                $this->error('Format data respons API subkon tidak dikenali.');
                return false;
            }

            $count = 0;
            foreach ($items as $item) {
                $idApi = $item['id'] ?? null;
                if (!$idApi) continue;

                Subkon::updateOrCreate(
                    ['id_api' => $idApi],
                    [
                        'nama_subkon' => $item['nama_subkon'] ?? null,
                        'kode_subkon' => $item['kode_subkon'] ?? null,
                    ]
                );
                $count++;
            }

            $this->info("Sinkronisasi subkon berhasil! {$count} data diperbarui/ditambahkan.");
            return true;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat sinkronisasi subkon: ' . $e->getMessage());
            return false;
        }
    }

    protected function assignSafetyOfficers(): bool
    {
        $this->info('Menetapkan status Safety Officer berdasarkan daftar badge (mode tambah saja, tidak mereset)...');

        try {
            // BARU — TIDAK ADA LAGI reset ke false di sini.
            // Penghapusan status SO sekarang murni dikelola manual lewat halaman Manajemen Safety Officer.

            $existing = Pegawai::where('is_safety_officer', true)->pluck('badge')->all();
            $toActivate = array_diff($this->safetyOfficerBadges, $existing);

            $count = 0;
            if (!empty($toActivate)) {
                $count = Pegawai::whereIn('badge', $toActivate)->update([
                    'is_safety_officer' => true,
                    'safety_officer_since' => Carbon::now(),
                ]);
            }

            $matchedBadges = Pegawai::whereIn('badge', $this->safetyOfficerBadges)->pluck('badge');
            $notFound = collect($this->safetyOfficerBadges)->diff($matchedBadges);

            if ($notFound->isNotEmpty()) {
                $this->warn('Badge berikut ada di daftar whitelist tapi TIDAK ditemukan di tabel pegawai: '
                    . $notFound->implode(', '));
            }

            $this->info("Status Safety Officer baru ditambahkan untuk {$count} pegawai (yang belum berstatus SO sebelumnya).");
            return true;
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat menetapkan Safety Officer: ' . $e->getMessage());
            return false;
        }
    }
}
