<?php

namespace Database\Seeders;

use App\Models\ParameterApdBasisFrekuensi;
use App\Models\ParameterApdJenisTransaksi;
use App\Models\ParameterApdKonversiSimbol;
use App\Models\ParameterApdNilaiDropdown;
use App\Models\ParameterApdSumberFrekuensi;
use Illuminate\Database\Seeder;

class ParameterApdSeeder extends Seeder
{
    public function run(): void
    {
        // ══════ B · BASIS FREKUENSI ══════
        $basis = [
            ['kode' => 'MASA_PAKAI_BULAN', 'basis_frekuensi' => 'MASA PAKAI (BULAN)', 'rumus_per_tahun' => '12 ÷ nilai', 'arti_nilai_basis' => 'Satu unit dipakai N bulan', 'contoh' => 'Helm 12 → 1×/tahun'],
            ['kode' => 'PER_HARI_KERJA', 'basis_frekuensi' => 'PER HARI KERJA', 'rumus_per_tahun' => 'hari kerja Kode OK ÷ nilai', 'arti_nilai_basis' => 'Satu unit habis tiap N hari kerja', 'contoh' => 'Masker debu 1 → 250×/tahun'],
            ['kode' => 'PER_SHIFT', 'basis_frekuensi' => 'PER SHIFT', 'rumus_per_tahun' => 'hari kerja × shift/hari ÷ nilai', 'arti_nilai_basis' => 'Satu unit habis tiap N shift', 'contoh' => 'Sarung tangan 1 → 365×/tahun bila 1 shift'],
            ['kode' => 'TETAP_PER_TAHUN', 'basis_frekuensi' => 'TETAP PER TAHUN', 'rumus_per_tahun' => 'nilai', 'arti_nilai_basis' => 'N unit per orang per tahun, apa pun pola kerjanya', 'contoh' => 'Seragam 2 → 2×/tahun'],
        ];
        foreach ($basis as $i => $row) {
            ParameterApdBasisFrekuensi::updateOrCreate(
                ['kode' => $row['kode']],
                $row + ['urutan' => $i + 1, 'status' => 'AKTIF']
            );
        }

        // ══════ B2 · SUMBER FREKUENSI ══════
        $sumber = [
            ['kode' => 'KONTRAK', 'sumber_frekuensi' => 'KONTRAK', 'bisa_dipertahankan' => true, 'keterangan' => 'Tertulis di memo tender / aanwijzing'],
            ['kode' => 'PABRIKAN', 'sumber_frekuensi' => 'PABRIKAN', 'bisa_dipertahankan' => true, 'keterangan' => 'Umur pakai dari lembar data produk'],
            ['kode' => 'REGULASI', 'sumber_frekuensi' => 'REGULASI', 'bisa_dipertahankan' => true, 'keterangan' => 'Permenaker / SNI menyebut angkanya'],
            ['kode' => 'UJI_LAPANGAN', 'sumber_frekuensi' => 'UJI LAPANGAN', 'bisa_dipertahankan' => true, 'keterangan' => 'Terukur dari 60_LOG_APD minimal 3 bulan'],
            ['kode' => 'ASUMSI', 'sumber_frekuensi' => 'ASUMSI', 'bisa_dipertahankan' => false, 'keterangan' => 'Belum ada dasar — muncul sebagai peringatan di lembar RAB'],
        ];
        foreach ($sumber as $i => $row) {
            ParameterApdSumberFrekuensi::updateOrCreate(
                ['kode' => $row['kode']],
                $row + ['urutan' => $i + 1, 'status' => 'AKTIF']
            );
        }

        // ══════ C · KONVERSI SIMBOL MATRIKS ══════
        $simbol = [
            ['simbol' => '✔', 'nilai' => 1, 'keterangan' => 'WAJIB — selalu dihitung'],
            ['simbol' => 'O', 'nilai' => 1, 'keterangan' => 'KONDISIONAL — dihitung bila HITUNG_TANDA_O = YA'],
            ['simbol' => '–', 'nilai' => 0, 'keterangan' => 'Tidak diperlukan'],
        ];
        foreach ($simbol as $i => $row) {
            ParameterApdKonversiSimbol::updateOrCreate(
                ['simbol' => $row['simbol']],
                $row + ['urutan' => $i + 1]
            );
        }

        // ══════ D · DAFTAR NILAI SAH (per kategori, sesuai kolom di sheet) ══════
        $dropdown = [
            'ZONA' => ['HIJAU', 'PUTIH', 'KUNING', 'MERAH'],
            'STATUS_KARYAWAN' => ['AKTIF', 'NONAKTIF'],
            'STATUS_OK' => ['AKTIF', 'SELESAI', 'BATAL'],
            'KLASIFIKASI_OK' => ['RUTIN', 'NON-RUTIN', 'CAMPURAN'],
            'JENIS_NONRUTIN' => ['Turn Around', 'Shutdown', 'Spot Proyek', 'Pemeliharaan Non-Rutin', 'Tanggap Darurat'],
            'KONDISI_LIMBAH' => ['Layak Pakai Ulang', 'Rusak', 'Kadaluarsa', 'Terkontaminasi B3', 'Hilang Sebagian'],
            'KLAS_LIMBAH' => ['B3', 'Non-B3'],
            'SIFAT_PAKAI' => ['Personal', 'Pool'],
            'TIPE_NONRUTIN' => ['SEKALI PAKAI', 'DURABLE'],
            'YA_TIDAK' => ['YA', 'TIDAK'],
            'STATUS_ITEM' => ['AKTIF', 'NONAKTIF'],
            'ANGKA_KATA' => ['satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'Sembilan'],
        ];
        foreach ($dropdown as $kategori => $nilaiList) {
            foreach ($nilaiList as $i => $nilai) {
                ParameterApdNilaiDropdown::updateOrCreate(
                    ['kategori' => $kategori, 'nilai' => $nilai],
                    ['urutan' => $i + 1, 'status' => 'AKTIF']
                );
            }
        }

        // ══════ E · JENIS TRANSAKSI 60_LOG_APD ══════
        $transaksi = [
            ['jenis_transaksi' => 'SERAH TERIMA BARU', 'arah_stok' => 'KELUAR', 'menjadi_limbah' => false, 'keterangan' => 'APD baru diserahkan ke pekerja'],
            ['jenis_transaksi' => 'PENGGANTIAN - RUSAK', 'arah_stok' => 'KELUAR', 'menjadi_limbah' => true, 'keterangan' => 'Tukar: unit baru keluar, unit rusak masuk sebagai limbah'],
            ['jenis_transaksi' => 'PENGGANTIAN - KADALUARSA', 'arah_stok' => 'KELUAR', 'menjadi_limbah' => true, 'keterangan' => 'Tukar karena masa berlaku habis'],
            ['jenis_transaksi' => 'PENGGANTIAN - HABIS MASA PAKAI', 'arah_stok' => 'KELUAR', 'menjadi_limbah' => true, 'keterangan' => 'Tukar rutin sesuai siklus frekuensi'],
            ['jenis_transaksi' => 'PENGEMBALIAN - LAYAK PAKAI ULANG', 'arah_stok' => 'MASUK', 'menjadi_limbah' => false, 'keterangan' => 'Dikembalikan, lolos uji kelayakan, jadi stok reuse'],
            ['jenis_transaksi' => 'PENGEMBALIAN - TANPA GANTI', 'arah_stok' => 'NETRAL', 'menjadi_limbah' => true, 'keterangan' => 'Dikembalikan tanpa unit pengganti'],
            ['jenis_transaksi' => 'KEHILANGAN', 'arah_stok' => 'NETRAL', 'menjadi_limbah' => false, 'keterangan' => 'Hilang, tidak menghasilkan limbah fisik'],
        ];
        foreach ($transaksi as $i => $row) {
            ParameterApdJenisTransaksi::updateOrCreate(
                ['jenis_transaksi' => $row['jenis_transaksi']],
                $row + ['urutan' => $i + 1, 'status' => 'AKTIF']
            );
        }
    }
}
