<?php

namespace App\Traits;

use Carbon\Carbon;

trait GeneratesUploadFileName
{
    /**
     * Bangun nama file upload dengan format:
     * {tanggal:Ymd}_{badge}-{NAMA}_{jenis_aktivitas}_{label file}_{urutan}.{ext}
     *
     * Contoh:
     * 20260805_K.210835-ADITYA PRADANA PUTRA_Laporan Inspeksi Peralatan_Formulir Inspeksi Peralatan_1.pdf
     */
    protected function buildUploadFileName(
        ?string $tanggal,
        ?string $badge,
        ?string $nama,
        ?string $jenisAktivitas,
        string $label,
        int $urutan,
        string $extension
    ): string {
        $tanggalPart = $tanggal ? Carbon::parse($tanggal)->format('Ymd') : now()->format('Ymd');
        $badgePart   = $this->sanitizeFileNamePart($badge ?: '-');
        $namaPart    = $this->sanitizeFileNamePart(strtoupper($nama ?: '-'));
        $jenisPart   = $this->sanitizeFileNamePart($jenisAktivitas ?: '-');
        $labelPart   = $this->sanitizeFileNamePart($label);

        $base = "{$tanggalPart}_{$badgePart}-{$namaPart}_{$jenisPart}_{$labelPart}_{$urutan}";

        // Batasi panjang nama file (tanpa ekstensi) agar aman di semua filesystem
        $base = mb_substr($base, 0, 200);

        return $base . '.' . strtolower($extension);
    }

    /**
     * Hilangkan karakter yang tidak aman untuk nama file (terutama "/"),
     * tapi tetap biarkan spasi & tanda hubung supaya tetap mudah dibaca.
     */
    protected function sanitizeFileNamePart(string $value): string
    {
        // Hilangkan karakter tidak aman untuk nama file/URL
        $value = preg_replace('/[\/\\\\:\*\?"<>\|]/', ' ', $value);
        $value = preg_replace('/\s+/', ' ', $value);
        $value = trim($value);

        // Ganti spasi menjadi underscore supaya URL tidak berisi %20
        $value = str_replace(' ', '_', $value);

        return $value;
    }
}
