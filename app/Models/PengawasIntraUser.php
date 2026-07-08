<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class PengawasIntraUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengawasPekerjaans()
    {
        return $this->hasMany(PengawasPekerjaan::class, 'pengguna_id', 'id_api');
    }

    // BARU — relasi ke data pegawai milik pengawas itu sendiri, via matching username = badge
    public function dataPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'username', 'badge');
    }
}
