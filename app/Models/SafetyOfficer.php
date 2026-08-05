<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SafetyOfficer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'assigned_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Data pegawai si Safety Officer ini
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'badge', 'badge');
    }

    // Daftar tenaga binaan (relasi ke pivot yang sudah ada)
    public function tenagaBinaan()
    {
        return $this->hasMany(SafetyOfficerPegawai::class, 'badge_safety_officer', 'badge');
    }

    // SafetyOfficer.php
    public function aktivitasKpi()
    {
        return $this->belongsToMany(
            AktivitasKpiK3::class,
            'aktivitas_kpi_k3_safety_officer',
            'badge_safety_officer',
            'aktivitas_kpi_k3_id',
            'badge',
            'id'
        )->withTimestamps();
    }

    /** Σ Skor Tugas — total skor dari semua aktivitas AKTIF tim SAFETY yang ditugaskan ke SO ini. */
    public function getTotalSkorTugasAttribute(): int
    {
        return $this->aktivitasKpi()
            ->where('status', 'AKTIF')
            ->where('safety', true)
            ->sum('skor');
    }

    /** Bobot Ditugaskan (%) — Σ Skor Tugas SO ini dibagi total skor tim Safety (aktif) x 100. */
    public function getBobotDitugaskanAttribute(): float
    {
        $totalTim = AktivitasKpiK3::where('status', 'AKTIF')->where('safety', true)->sum('skor');
        return $totalTim > 0 ? round($this->total_skor_tugas / $totalTim * 100, 1) : 0;
    }

    /** Jumlah Tugas — banyaknya aktivitas AKTIF tim SAFETY yang ditugaskan ke SO ini. */
    public function getJumlahTugasAttribute(): int
    {
        return $this->aktivitasKpi()->where('status', 'AKTIF')->where('safety', true)->count();
    }
}
