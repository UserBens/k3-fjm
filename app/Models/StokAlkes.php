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
        'tanggal_exp'                => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    protected $appends = [
        'stok_tersedia',
        'status_stok',
        'status_kalibrasi',
        'status_kadaluarsa',
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

    /**
     * Status kalibrasi berdasarkan jadwal_kalibrasi_berikut.
     * Meniru kolom W di sheet '06_Master_Alkes' (SEGERA / LEWAT / AMAN).
     * Ambang "SEGERA" = sisa ≤ 30 hari.
     * Return null kalau jadwal kalibrasi belum diisi (alat tidak butuh kalibrasi rutin).
     */
    public function getStatusKalibrasiAttribute(): ?string
    {
        if (!$this->jadwal_kalibrasi_berikut) {
            return null;
        }

        $sisaHari = now()->startOfDay()->diffInDays(
            $this->jadwal_kalibrasi_berikut->copy()->startOfDay(),
            false
        );

        if ($sisaHari < 0) {
            return 'LEWAT';
        }

        if ($sisaHari <= 30) {
            return 'SEGERA';
        }

        return 'AMAN';
    }

    /**
     * Status kadaluarsa berdasarkan tanggal_exp.
     * Meniru kolom Z di sheet '06_Master_Alkes' (SEGERA / KADALUARSA / AMAN).
     * Ambang "SEGERA" = sisa ≤ 30 hari.
     * Return null kalau alat tidak punya tanggal exp (mis. alat non-consumable).
     */
    public function getStatusKadaluarsaAttribute(): ?string
    {
        if (!$this->tanggal_exp) {
            return null;
        }

        $sisaHari = now()->startOfDay()->diffInDays(
            $this->tanggal_exp->copy()->startOfDay(),
            false
        );

        if ($sisaHari < 0) {
            return 'KADALUARSA';
        }

        if ($sisaHari <= 30) {
            return 'SEGERA';
        }

        return 'AMAN';
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
