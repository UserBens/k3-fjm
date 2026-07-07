<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

// #[Signature('app:tetapkan-pengawas-awal')]
// #[Description('Command description')]
class TetapkanPengawasAwal extends Command
{
    protected $signature = 'pengawas:tetapkan-awal';
    protected $description = 'Menetapkan status pengawas awal berdasarkan daftar badge & nama yang sudah ditentukan';

    /**
     * Daftar tetap: badge => nama (untuk verifikasi kecocokan nama)
     */
    protected array $daftarPengawas = [
        'K.201613' => 'ANWAR EDI SANTOSO',
        'K.201044' => 'M. SUBAKTI',
        'K.200438' => 'M. SYARIFUDDIN',
        'K.200266' => 'BACHTIAR EFENDI',
        'K.230080' => 'KHOIRUDDIN',
        'K.200765' => 'SLAMET ARIYADI',
        'K.201352' => 'ACHMAT NAIM',
        'K.202191' => 'M. DHAMIRI LATHIF',
        'K.250143' => 'MOH. AMIRUDIN RIFAI',
        'K.201328' => 'SYARONI',
        'K.202092' => 'ACHMAD ROFI A.',
        'K.201544' => 'AGUS PRASETYO',
        'K.200702' => 'AGUNG RUDYANTO',
        'K.210031' => 'SYAFIK',
        'K.202573' => 'FERRY ARDIANSYAH',
        'K.210011' => 'INDARTO',
        'K.250364' => 'M. ABIDZAN ZAHID',
        'K.200425' => 'NANANG QOSIM',
        'K.200919' => 'SYAIFUL ROMADANI',
        'K.201340' => 'H. SUNANDAR',
    ];

    public function handle(): int
    {
        $ditemukan = 0;
        $tidakDitemukan = [];
        $namaTidakCocok = [];

        foreach ($this->daftarPengawas as $badge => $namaDiList) {
            $pegawai = Pegawai::where('badge', $badge)->first();

            if (!$pegawai) {
                $tidakDitemukan[] = "{$badge} - {$namaDiList}";
                continue;
            }

            // Verifikasi nama (jaga-jaga kalau badge sama tapi ternyata beda orang)
            $namaDb = strtoupper(trim($pegawai->nama));
            $namaList = strtoupper(trim($namaDiList));

            if ($namaDb !== $namaList) {
                $namaTidakCocok[] = "{$badge}: DB=\"{$pegawai->nama}\" vs List=\"{$namaDiList}\"";
            }

            $pegawai->update([
                'is_pengawas' => true,
                'tanggal_jadi_pengawas' => $pegawai->tanggal_jadi_pengawas ?? now(),
            ]);

            $ditemukan++;
        }

        $this->info("Berhasil menetapkan {$ditemukan} dari " . count($this->daftarPengawas) . " pengawas.");

        if (!empty($namaTidakCocok)) {
            $this->warn("Peringatan, nama tidak cocok persis (tetap ditandai pengawas berdasarkan badge):");
            foreach ($namaTidakCocok as $item) {
                $this->line("  - {$item}");
            }
        }

        if (!empty($tidakDitemukan)) {
            $this->error("Badge berikut TIDAK ditemukan di database (pastikan sudah sync data tenaga kerja):");
            foreach ($tidakDitemukan as $item) {
                $this->line("  - {$item}");
            }
        }

        return Command::SUCCESS;
    }
}
