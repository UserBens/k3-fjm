<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LpiKejadian extends Model
{
    protected $table = 'lpi_kejadian';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_insiden' => 'date',
        'pica_due_date' => 'date',
        'nominal_kerugian_material' => 'decimal:2',
        'total_cost_lost' => 'decimal:2',
    ];

    public function korban()
    {
        return $this->hasMany(LpiKorban::class, 'kejadian_id');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!$term = trim((string) $term)) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('id_lpi', 'ilike', "%{$term}%")
                ->orWhere('owner_user', 'ilike', "%{$term}%")
                ->orWhere('uraian_kejadian', 'ilike', "%{$term}%");
        });
    }
}
