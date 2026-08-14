<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengawasPegawai extends Model
{
    protected $guarded = ['id'];

    protected $casts = ['assigned_at' => 'datetime'];

    public function pengawas()
    {
        return $this->belongsTo(Pegawai::class, 'badge_pengawas', 'badge');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_api');
    }
}
