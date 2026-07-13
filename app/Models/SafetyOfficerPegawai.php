<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafetyOfficerPegawai extends Model
{
    protected $guarded = ['id'];

    protected $casts = ['assigned_at' => 'datetime'];

    public function safetyOfficer()
    {
        return $this->belongsTo(Pegawai::class, 'badge_safety_officer', 'badge');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_api');
    }
}
