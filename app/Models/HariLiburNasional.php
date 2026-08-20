<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HariLiburNasional extends Model
{
    use HasFactory;

    protected $table = 'hari_libur_nasionals';

    protected $fillable = [
        'tanggal',
        'nama_libur',
        'jenis',
        'kategori',
        'tahun',
        'sumber',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tahun' => 'integer',
    ];

    // Kategori yang bisa dihitung otomatis oleh sistem tanpa perlu input admin
    public const KATEGORI_AUTO = ['MASEHI_TETAP', 'PASKAH'];

    // Kategori yang WAJIB diinput manual tiap tahun (mengikuti SKB 3 Menteri / penanggalan lokal)
    public const KATEGORI_MANUAL = ['HIJRIAH', 'IMLEK', 'NYEPI', 'WAISAK', 'LAINNYA'];

    public function scopeTahun(Builder $q, int $tahun): Builder
    {
        return $q->where('tahun', $tahun);
    }

    public function scopeKategori(Builder $q, string $kategori): Builder
    {
        return $q->where('kategori', $kategori);
    }

    public static function isTanggalLibur(\DateTimeInterface|string $tanggal): bool
    {
        $t = $tanggal instanceof \DateTimeInterface ? $tanggal->format('Y-m-d') : date('Y-m-d', strtotime($tanggal));
        return static::whereDate('tanggal', $t)->exists();
    }
}
