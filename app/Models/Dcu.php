<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dcu extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_lahir'   => 'date',
        'tanggal_periksa' => 'date',   // ← INI YANG HILANG, penyebab error kemarin
        'self_check'      => 'boolean',
        'consult_dr'      => 'boolean',
        'danger'          => 'boolean',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'badge', 'badge');
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('nama', 'ilike', "%{$term}%")
                ->orWhere('badge', 'ilike', "%{$term}%")
                ->orWhere('nik', 'ilike', "%{$term}%");
        });
    }
}
