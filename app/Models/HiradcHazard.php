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
        'dampak_kategori',
        'detail',
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
     * Hitung RR (Risk Rating) = L x C, dan kategorikan sesuai matriks K3:
     *   L (Low)      : skor 1–4   → Hijau        → pemantauan rutin
     *   M (Moderate) : skor 5–9   → Kuning        → perlu pengendalian tambahan
     *   H (High)     : skor 10–16 → Merah Gelap   → mitigasi ketat & pengawasan langsung
     *   E (Extreme)  : skor 20–25 → Merah Terang  → pekerjaan tidak boleh dilakukan / harus dihentikan
     */
    public static function tingkatRisiko(?int $l, ?int $c): ?array
    {
        if (is_null($l) || is_null($c)) {
            return null;
        }
        $rr = $l * $c;

        return match (true) {
            $rr >= 20 => [
                'nilai' => $rr,
                'kode' => 'E',
                'label' => 'Extreme',
                'class' => 'hx-cat-e',
                'intervensi' => 'Pekerjaan tidak boleh dilakukan atau harus segera dihentikan sampai tingkat bahaya diturunkan secara signifikan.',
            ],
            $rr >= 10 => [
                'nilai' => $rr,
                'kode' => 'H',
                'label' => 'High',
                'class' => 'hx-cat-h',
                'intervensi' => 'Pekerjaan berisiko tinggi. Diperlukan mitigasi ketat dan pengawasan langsung sebelum pekerjaan dimulai.',
            ],
            $rr >= 5 => [
                'nilai' => $rr,
                'kode' => 'M',
                'label' => 'Moderate',
                'class' => 'hx-cat-m',
                'intervensi' => 'Diperlukan tindakan pengendalian tambahan untuk menurunkan risiko hingga ke batas yang dapat diterima.',
            ],
            default => [
                'nilai' => $rr,
                'kode' => 'L',
                'label' => 'Low',
                'class' => 'hx-cat-l',
                'intervensi' => 'Risiko dapat diterima. Pengendalian yang ada sudah memadai, cukup lakukan pemantauan rutin.',
            ],
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
