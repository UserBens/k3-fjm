<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanPengawas extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_pengawas';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];
}
