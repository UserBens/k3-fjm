<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class KodeOk extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'boolean',
        'is_manual' => 'boolean',
        'last_sync' => 'datetime',
    ];

    // relasi ke pegawai berdasarkan kolom kode_ok (bukan FK id, karena pegawai
    // menyimpan kode_ok sebagai string langsung dari API)
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'kode_ok', 'kode_ok');
    }

    public function pegawaiRelasi()
    {
        return $this->belongsToMany(Pegawai::class, 'kode_ok_pegawai')->withTimestamps();
    }

    public function unitKerjaRelasi()
    {
        return $this->belongsToMany(UnitKerja::class, 'kode_ok_unit_kerja')->withTimestamps();
    }

    public function kualifikasiRelasi()
    {
        return $this->belongsToMany(Kualifikasi::class, 'kode_ok_kualifikasi')->withTimestamps();
    }
}
