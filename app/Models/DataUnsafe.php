<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DataUnsafe extends Model
{
    protected $table = 'data_unsafe';
    protected $guarded = ['id'];

    protected $casts = [
        'waktu_submit' => 'datetime',
        'tanggal_temuan' => 'date',
    ];

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!$term = trim((string) $term)) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('nama_so', 'ilike', "%{$term}%")
                ->orWhere('badge_so', 'ilike', "%{$term}%")
                ->orWhere('item_temuan', 'ilike', "%{$term}%");
        });
    }
}
