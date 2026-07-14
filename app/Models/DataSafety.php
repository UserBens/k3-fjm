<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSafety extends Model
{
    protected $table = 'data_safety';
    protected $guarded = ['id'];

    protected $casts = [
        'waktu_submit' => 'datetime',
        'tanggal_pelaksanaan' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'badge_tenaga', 'badge');
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('nama_tenaga', 'ilike', "%{$term}%")
                ->orWhere('badge_tenaga', 'ilike', "%{$term}%");
        });
    }
}
