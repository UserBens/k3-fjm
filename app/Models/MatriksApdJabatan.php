<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class MatriksApdJabatan extends Model
{
    use HasFactory;

    public const APD_COLUMNS = [
        'helm_safety' => 'Helm Safety',
        'sepatu_safety' => 'Sepatu Safety',
        'rompi_hivis' => 'Rompi Hi-Vis',
        'sarung_tangan_kulit' => 'Sarung Tangan Kulit',
        'kacamata_safety' => 'Kacamata Safety',
        'masker_n95' => 'Masker N95',
        'masker_respirator' => 'Masker Respirator',
        'earplug_earmuff' => 'Earplug/Earmuff',
        'full_body_harness' => 'Full Body Harness',
        'wearpack' => 'Wearpack',
        'scba' => 'SCBA',
        'pakaian_fr' => 'Pakaian FR',
        'chemical_suit' => 'Chemical Suit',
        'sarung_tangan_listrik' => 'Sarung Tangan Listrik',
        'face_shield' => 'Face Shield',
        'kacamata_las' => 'Kacamata Las',
        'knee_pad' => 'Knee Pad',
    ];

    public const APD_STATUS = ['WAJIB', 'KONDISIONAL', 'TIDAK'];

    public const STATUS = ['Open', 'Close'];

    protected $guarded = ['id'];

    public function hiradc()
    {
        return $this->belongsTo(Hiradc::class);
    }

    public function getJumlahApdWajibAttribute(): int
    {
        return collect(self::APD_COLUMNS)
            ->keys()
            ->filter(fn($col) => $this->{$col} === 'WAJIB')
            ->count();
    }

    public function getRisikoAwalAttribute(): ?array
    {
        return Hiradc::tingkatRisiko($this->l_awal, $this->s_awal);
    }

    public function getRisikoResidualAttribute(): ?array
    {
        return Hiradc::tingkatRisiko($this->l_res, $this->s_res);
    }
}
