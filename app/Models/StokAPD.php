<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class StokAPD extends Model
{
    use HasFactory;
    protected $table = 'stok_apd';
    protected $guarded = ['id'];

    protected $casts = [
        'stok_awal'          => 'integer',
        'digunakan'          => 'integer',
        'rusak'              => 'integer',
        'reorder_point'      => 'integer',
        'harga_satuan'       => 'decimal:2',
        'terakhir_pengadaan' => 'date',
    ];

    // Ditambahkan otomatis setiap kali model di-serialize ke array/json (dipakai di modal detail)
    protected $appends = ['stok_tersedia', 'status'];

    public function getStokTersediaAttribute(): int
    {
        return $this->stok_awal - $this->digunakan - $this->rusak;
    }

    public function getStatusAttribute(): string
    {
        return $this->stok_tersedia <= $this->reorder_point ? 'REORDER' : 'OK';
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('kode_apd', 'like', "%{$term}%")
                ->orWhere('jenis_apd', 'like', "%{$term}%")
                ->orWhere('merk_rekomendasi', 'like', "%{$term}%");
        });
    }

    public static function generateKode(string $jenisApd): string
    {
        $inisial = strtoupper(substr(trim($jenisApd), 0, 1));
        $inisial = $inisial ?: 'X';

        $prefix = "FJM-{$inisial}-";

        // Ambil nomor urut tertinggi yang sudah dipakai untuk inisial ini.
        // SUBSTRING ... FROM '[0-9]+$' mengambil digit di ujung kode (Postgres).
        $lastNumber = static::where('kode_apd', 'like', "{$prefix}%")
            ->selectRaw("MAX(CAST(SUBSTRING(kode_apd FROM '[0-9]+$') AS INTEGER)) as max_num")
            ->value('max_num');

        $next = ((int) $lastNumber) + 1;

        return $prefix . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }

    public function kodeOk()
    {
        return $this->hasMany(StokApdKode::class, 'stok_apd_id');
    }
}
