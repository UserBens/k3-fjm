<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterApdKonversiSimbol extends Model
{
    protected $table = 'parameter_apd_konversi_simbol';

    protected $guarded = ['id'];

    protected $casts = [
        'nilai'  => 'integer',
        'urutan' => 'integer',
    ];
}
