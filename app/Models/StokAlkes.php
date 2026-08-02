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
        'kode_ok', // ← baru
        'dapat_digunakan',        // ← BARU
        'alasan_tidak_bisa',      // ← BARU
    ];

    public function getDapatDigunakanAttribute(): bool
    {
        if ($this->kondisi === 'Perlu Kalibrasi') {
            return false;
        }

        if (in_array($this->status_kalibrasi, ['SEGERA', 'LEWAT'], true)) {
            return false;
        }

        return true;
    }

    public function getAlasanTidakBisaAttribute(): ?string
    {
        if ($this->kondisi === 'Perlu Kalibrasi') {
            return 'Kondisi alat ditandai Perlu Kalibrasi';
        }

        if ($this->status_kalibrasi === 'LEWAT') {
            return 'Jadwal kalibrasi sudah lewat';
        }

        if ($this->status_kalibrasi === 'SEGERA') {
            return 'Jadwal kalibrasi akan segera jatuh tempo (≤30 hari)';
        }

        return null;
    }

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

    public function getKodeOkAttribute()
    {
        // Hindari query N+1: kalau relasi belum di-load, load dulu.
        if (!$this->relationLoaded('kodeOkRelasi')) {
            $this->load('kodeOkRelasi');
        }

        return $this->kodeOkRelasi->pluck('kode_ok')->values();
    }

    public function kodeOkRelasi()
    {
        return $this->belongsToMany(KodeOk::class, 'alkes_kode_ok', 'stok_alkes_id', 'kode_ok_id')
            ->withTimestamps();
    }
}
