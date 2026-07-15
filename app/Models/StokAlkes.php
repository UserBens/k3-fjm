<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokAlkes extends Model
{
    use HasFactory;

    protected $table = 'stok_alkes'; // BENAR — samakan dengan migration

    protected $guarded = ['id'];

    protected $casts = [
        'stok_awal'                  => 'integer',
        'digunakan'                  => 'integer',
        'rusak'                      => 'integer',
        'reorder_point'              => 'integer',
        'harga_satuan'               => 'decimal:2',

        'tanggal_kalibrasi'          => 'date',
        'jadwal_kalibrasi_berikut'   => 'date',
        'masa_garansi'               => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    protected $appends = [
        'stok_tersedia',
        'status_stok',
    ];

    public function getStokTersediaAttribute(): int
    {
        return $this->stok_awal
            - $this->digunakan
            - $this->rusak;
    }

    public function getStatusStokAttribute(): string
    {
        return $this->stok_tersedia <= $this->reorder_point
            ? 'REORDER'
            : 'OK';
    }

    /*
    |--------------------------------------------------------------------------
    | Scope Search
    |--------------------------------------------------------------------------
    */

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {

            $q->where('jenis_alat', 'like', "%{$term}%")
                ->orWhere('fungsi_pemeriksaan', 'like', "%{$term}%")
                ->orWhere('merk', 'like', "%{$term}%")
                ->orWhere('type', 'like', "%{$term}%")
                ->orWhere('nomor_seri', 'like', "%{$term}%")
                ->orWhere('supplier', 'like', "%{$term}%");
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function penggunaan()
    {
        return $this->hasMany(
            AlatKesehatanPenggunaan::class,
            'stok_alkes_id' // BENAR — samakan dengan kolom FK di migration
        );
    }
}
