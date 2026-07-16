<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogApd extends Model
{
    use HasFactory;

    protected $table = 'log_apd';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal'    => 'date',
        'qty_keluar' => 'integer',
        'qty_masuk'  => 'integer',
    ];

    // Daftar jenis transaksi baku, dipakai di dropdown form & filter
    const JENIS_TRANSAKSI = [
        'JATAH BARU',
        'TUKAR LAMA',
        'TUKAR RUSAK',
        'MASUK (PP/PO)',
        'HILANG',
        'LAINNYA',
    ];

    // Teks placeholder utk kolom terkait karyawan yang kosong (mis. transaksi MASUK gudang)
    const FALLBACK_KARYAWAN = 'Data Tidak Ditemukan';

    public function stokApd()
    {
        return $this->belongsTo(StokAPD::class, 'stok_apd_id');
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('no_dokumen', 'like', "%{$term}%")
                ->orWhere('id_karyawan', 'like', "%{$term}%")
                ->orWhere('nama_karyawan', 'like', "%{$term}%")
                ->orWhere('jenis_apd', 'like', "%{$term}%")
                ->orWhere('kode_apd', 'like', "%{$term}%")
                ->orWhere('kode_ok', 'like', "%{$term}%");
        });
    }

    public static function generateNoDokumen(): string
    {
        $prefix = 'APD-LOG-';

        // Ambil nomor urut tertinggi yang sudah dipakai (Postgres)
        $lastNumber = static::where('no_dokumen', 'like', "{$prefix}%")
            ->selectRaw("MAX(CAST(SUBSTRING(no_dokumen FROM '[0-9]+$') AS INTEGER)) as max_num")
            ->value('max_num');

        $next = ((int) $lastNumber) + 1;

        return $prefix . str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
