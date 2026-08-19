<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterApdBasisFrekuensi extends Model
{
    protected $table = 'parameter_apd_basis_frekuensi';

    protected $guarded = ['id'];

    protected $casts = [
        'urutan' => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'AKTIF');
    }
}
