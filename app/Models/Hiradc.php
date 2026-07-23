<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hiradc extends Model
{
    use HasFactory;

    protected $table = 'hiradcs';

    protected $fillable = [
        'no_hiradc',
        'judul_pekerjaan',
        'kategori_pekerjaan',
        'potensi_bahaya',
        'konsekuensi_dampak',
        'l_awal',
        's_awal',
        'apd_wajib',
        'apd_khusus',
        'pengendalian_utama',
        'l_sesudah',
        's_sesudah',
        'pic',
        'status',
        'dokumen',
        'dokumen_hiradc',
    ];

    public const STATUS = ['Open', 'Close'];

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

    public function getDokumenUrlAttribute(): ?string
    {
        return $this->dokumen ? Storage::disk('public')->url($this->dokumen) : null;
    }

    public function matriksApd()
    {
        return $this->hasMany(MatriksApdJabatan::class);
    }
}
