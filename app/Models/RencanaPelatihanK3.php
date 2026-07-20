<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaPelatihanK3 extends Model
{
    protected $table = 'rencana_pelatihan_k3';

    protected $guarded = ['id'];

    protected $casts = [

        'bulan' => 'integer',
        'peserta' => 'integer',
        'durasi' => 'integer',
        'anggaran' => 'decimal:2'

    ];
}
