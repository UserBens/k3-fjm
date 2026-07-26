<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class HiradcHazard extends Model
{
    use HasFactory;

    protected $table = 'hiradc_hazards';

    protected $fillable = [
        'hiradc_item_id',
        'hazard_register',
        'sub_hazard_register',
        'na_e',
        'deskripsi',
        'dampak',
        'l_awal',
        'c_awal',
        'pengendalian_existing',
        'l_sisa',
        'c_sisa',
        'r_o',
        'additional_control',
        'pic',
        'due_date',
        'urutan',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function item()
    {
        return $this->belongsTo(HiradcItem::class, 'hiradc_item_id');
    }

    /**
     * Hitung RR (Risk Rating) = L x C, dan kategorikan LOW/MEDIUM/HIGH.
     * Ambang berdasarkan contoh dokumen: <=4 LOW, 5-9 MEDIUM, >=10 HIGH.
     */
    public static function tingkatRisiko(?int $l, ?int $c): ?array
    {
        if (is_null($l) || is_null($c)) {
            return null;
        }
        $rr = $l * $c;

        return match (true) {
            $rr >= 10 => ['nilai' => $rr, 'label' => 'HIGH', 'emoji' => '🔴', 'class' => 'sp-red'],
            $rr >= 5 => ['nilai' => $rr, 'label' => 'MEDIUM', 'emoji' => '⚠️', 'class' => 'sp-amber'],
            default => ['nilai' => $rr, 'label' => 'LOW', 'emoji' => '✅', 'class' => 'sp-green'],
        };
    }

    public function getRisikoAwalAttribute(): ?array
    {
        return self::tingkatRisiko($this->l_awal, $this->c_awal);
    }

    public function getRisikoSisaAttribute(): ?array
    {
        return self::tingkatRisiko($this->l_sisa, $this->c_sisa);
    }
}
