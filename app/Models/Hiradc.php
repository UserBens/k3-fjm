<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Hiradc extends Model
{
    use HasFactory;
    protected $table = 'hiradc';

    protected $fillable = [
        'kode_ok',
        'area_lokasi',
        'aktivitas_pekerjaan',
        'potensi_bahaya',
        'jenis_bahaya',
        'konsekuensi_dampak',
        'l_awal',
        's_awal',
        'pengendalian_ada',
        'apd_wajib',
        'pengendalian_tambahan',
        'l_sesudah',
        's_sesudah',
        'pic',
        'status',
    ];

    public const STATUS = ['Open', 'Close'];

    /**
     * Hitung tingkat risiko berdasar Matriks Risiko FJM:
     * 1-4 RENDAH | 5-12 SEDANG | 15-25 TINGGI | >25 EKSTRIM
     */
    public static function tingkatRisiko(?int $l, ?int $s): ?array
    {
        if (is_null($l) || is_null($s)) {
            return null;
        }
        $nilai = $l * $s;

        return match (true) {
            $nilai > 25 => ['nilai' => $nilai, 'label' => 'EKSTRIM', 'emoji' => '🚨', 'class' => 'sp-red'],
            $nilai >= 15 => ['nilai' => $nilai, 'label' => 'TINGGI', 'emoji' => '🔴', 'class' => 'sp-red'],
            $nilai >= 5 => ['nilai' => $nilai, 'label' => 'SEDANG', 'emoji' => '⚠️', 'class' => 'sp-amber'],
            default => ['nilai' => $nilai, 'label' => 'RENDAH', 'emoji' => '✅', 'class' => 'sp-green'],
        };
    }

    public function getRisikoAwalAttribute(): ?array
    {
        return self::tingkatRisiko($this->l_awal, $this->s_awal);
    }

    public function getRisikoSesudahAttribute(): ?array
    {
        return self::tingkatRisiko($this->l_sesudah, $this->s_sesudah);
    }

    public function matriksApd()
    {
        return $this->hasMany(MatriksApdJabatan::class);
    }
}
