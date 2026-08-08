<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranKpiK3 extends Model
{
    protected $table = 'kehadirankpik3';
    protected $guarded = ['id'];

    public static function forPeriode(string $badge, int $tahun, int $bulan): self
    {
        return static::firstOrNew([
            'badge' => $badge,
            'tahun_aktif' => $tahun,
            'bulan_aktif' => $bulan,
        ], [
            'hari_cuti_izin_sakit_alfa' => 0,
            'hari_standby' => 0,
        ]);
    }
}
