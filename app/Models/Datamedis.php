<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datamedis extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'waktu_submit' => 'datetime',
        'tanggal_pelaksanaan' => 'date',
    ];
}
