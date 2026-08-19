<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterApdJenisTransaksi extends Model
{
    protected $table = 'parameter_apd_jenis_transaksi';

    protected $guarded = ['id'];

    protected $casts = [
        'menjadi_limbah' => 'boolean',
        'urutan'         => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'AKTIF');
    }
}
