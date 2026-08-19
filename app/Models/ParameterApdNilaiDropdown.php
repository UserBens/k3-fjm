<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterApdNilaiDropdown extends Model
{
    protected $table = 'parameter_apd_nilai_dropdown';

    protected $guarded = ['id'];

    protected $casts = [
        'urutan' => 'integer',
    ];

    /** Daftar kategori sah, sesuai kolom D pada sheet Parameter Sistem. Dipakai utk validasi & urutan tab UI. */
    public const KATEGORI = [
        'ZONA',
        'STATUS_KARYAWAN',
        'STATUS_OK',
        'KLASIFIKASI_OK',
        'JENIS_NONRUTIN',
        'KONDISI_LIMBAH',
        'KLAS_LIMBAH',
        'SIFAT_PAKAI',
        'TIPE_NONRUTIN',
        'YA_TIDAK',
        'STATUS_ITEM',
        'ANGKA_KATA',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'AKTIF');
    }

    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
