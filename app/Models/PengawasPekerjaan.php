<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengawasPekerjaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengawas()
    {
        return $this->belongsTo(PengawasIntraUser::class, 'pengguna_id', 'id_api');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_api');
    }
}
