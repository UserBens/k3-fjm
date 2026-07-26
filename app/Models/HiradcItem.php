<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class HiradcItem extends Model
{
    use HasFactory;

    protected $table = 'hiradc_items';

    protected $fillable = [
        'hiradc_group_id',
        'no',
        'aktivitas',
        'kesimpulan_apd',
        'urutan',
    ];

    public function group()
    {
        return $this->belongsTo(HiradcGroup::class, 'hiradc_group_id');
    }

    public function hazards()
    {
        return $this->hasMany(HiradcHazard::class)->orderBy('urutan');
    }

    /**
     * Risiko tertinggi di antara semua hazard pada item ini,
     * berguna untuk badge ringkasan di tabel utama.
     */
    public function getRisikoTertinggiAwalAttribute(): ?array
    {
        return $this->hazards
            ->map(fn($h) => $h->risiko_awal)
            ->filter()
            ->sortByDesc('nilai')
            ->first();
    }
}
