<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianKibApd extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_kib_apds';

    protected $fillable = [
        'no_dokumen',
        'tanggal',
        'nomor_badge',
        'nama_lengkap',
        'jabatan',
        'unit_kerja',
        'status_fisik_kib',
        'nomor_kib_dikembalikan',
        'foto_kib',
        'apd_dikembalikan',
        'foto_apd',
        'keterangan',
    ];

    protected $casts = [
        'tanggal'           => 'date',
        'apd_dikembalikan'  => 'array',
    ];

    // Status fisik KIB saat dikembalikan
    public const STATUS_FISIK_KIB = [
        'OK/BAIK',
        'RUSAK/BURAM/TIDAK LAYAK',
    ];

    public const FALLBACK_KARYAWAN = 'Data Tidak Ditemukan';

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('no_dokumen', 'ilike', "%{$term}%")
                ->orWhere('nomor_badge', 'ilike', "%{$term}%")
                ->orWhere('nama_lengkap', 'ilike', "%{$term}%")
                ->orWhere('nomor_kib_dikembalikan', 'ilike', "%{$term}%")
                ->orWhere('unit_kerja', 'ilike', "%{$term}%");
        });
    }

    public static function generateNoDokumen(): string
    {
        $prefix = 'PKA/' . now()->format('Ymd') . '/';

        $lastSeq = static::query()
            ->where('no_dokumen', 'like', "{$prefix}%")
            ->orderByDesc('no_dokumen')
            ->value('no_dokumen');

        $nextNumber = 1;
        if ($lastSeq) {
            $lastNumber = (int) substr($lastSeq, strrpos($lastSeq, '/') + 1);
            $nextNumber = $lastNumber + 1;
        }

        return $prefix . str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
