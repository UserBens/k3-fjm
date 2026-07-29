<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasKpiK3 extends Model
{
    protected $table = 'aktivitas_kpi_k3';

    protected $guarded = ['id'];

    protected $casts = [
        'kompleksitas'    => 'integer',
        'frekuensi'       => 'integer',
        'skor'            => 'integer',
        'target_per_bulan' => 'integer',
        'ikut_hari_kerja' => 'boolean',
        'maks_per_hari'   => 'integer',
        'mulai_berlaku'   => 'integer',
        'akhir_berlaku'   => 'integer',
        'safety'          => 'boolean',
        'pengawas'        => 'boolean',
        'medis'           => 'boolean',
    ];

    protected static function booted(): void
    {
        // Skor = Kompleksitas x Frekuensi, selalu dihitung ulang otomatis
        static::saving(function (AktivitasKpiK3 $row) {
            $row->skor = (int) $row->kompleksitas * (int) $row->frekuensi;
        });
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'AKTIF');
    }

    /** Label kompleksitas: 1 Sederhana / 2 Sedang / 3 Kompleks */
    public function getLabelKompleksitasAttribute(): string
    {
        return match ((int) $this->kompleksitas) {
            1 => 'Sederhana',
            2 => 'Sedang',
            3 => 'Kompleks',
            default => '-',
        };
    }

    /** Label frekuensi: 1 Jarang / 2 Berkala / 3 Sering */
    public function getLabelFrekuensiAttribute(): string
    {
        return match ((int) $this->frekuensi) {
            1 => 'Jarang',
            2 => 'Berkala',
            3 => 'Sering',
            default => '-',
        };
    }
}
