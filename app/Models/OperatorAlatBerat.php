<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatorAlatBerat extends Model
{
    protected $table = 'operator_alat_berat';

    protected $guarded = ['id'];

    protected $casts = [
        'masa_berlaku_kib'   => 'date',
        'masa_berlaku_sio_1' => 'date',
        'masa_berlaku_sio_2' => 'date',
        'tanggal_lahir'      => 'date',
    ];
}
