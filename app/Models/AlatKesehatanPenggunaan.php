<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatKesehatanPenggunaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_digunakan' => 'integer',
    ];

    public function alatKesehatan()
    {
        return $this->belongsTo(StokAlkes::class, 'stok_alkes_id');
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('nama_pengguna', 'ilike', "%{$term}%")
                ->orWhere('id_karyawan', 'ilike', "%{$term}%");
        });
    }
}
