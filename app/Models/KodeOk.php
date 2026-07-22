<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class KodeOk extends Model
{
    use HasFactory;

    protected $table = 'kode_oks';

    protected $fillable = [
        'kode_ok',
        'pengawas',
        'unit_kerja',
        'uraian_pekerjaan',
        'status',
        'synced_at',
    ];

    protected $casts = [
        'kode_ok'   => 'integer',
        'status'    => 'boolean',
        'synced_at' => 'datetime',
    ];
}
