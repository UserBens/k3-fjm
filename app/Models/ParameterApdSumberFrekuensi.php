<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterApdSumberFrekuensi extends Model
{
    protected $table = 'parameter_apd_sumber_frekuensi';

    protected $guarded = ['id'];

    protected $casts = [
        'bisa_dipertahankan' => 'boolean',
        'urutan'             => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'AKTIF');
    }
}
