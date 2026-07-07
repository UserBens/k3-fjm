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
}
