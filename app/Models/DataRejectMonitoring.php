<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DataRejectMonitoring extends Model
{
    protected $table = 'data_reject_monitoring';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_reject' => 'date',
        'waktu_submit_form' => 'datetime',
        'tanggal_pelaksanaan' => 'date',
    ];

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!$term = trim((string) $term)) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('nama_pelapor', 'ilike', "%{$term}%")
                ->orWhere('badge_pelapor', 'ilike', "%{$term}%")
                ->orWhere('jenis_aktifitas_kpi', 'ilike', "%{$term}%");
        });
    }
}
