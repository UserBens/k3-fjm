<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanPengawas extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_pengawas';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];

    public function aktivitas()
    {
        return $this->belongsTo(AktivitasKpiK3::class, 'aktivitas_kpi_k3_id');
    }

    /**
     * Helper: apakah aktivitas terkait tergolong "Nearmiss" berdasarkan nama_aktivitas.
     * Dipakai controller utk memutuskan field mana yang wajib divalidasi.
     */
    public function isNearmiss(): bool
    {
        return str_contains(strtolower($this->aktivitas->nama_aktivitas ?? ''), 'nearmiss');
    }

    public function isSafetyBriefing(): bool
    {
        return str_contains(strtolower($this->aktivitas->nama_aktivitas ?? ''), 'safety briefing');
    }
}
