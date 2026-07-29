<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi_k3 extends Model
{
    use HasFactory;

    protected $table = 'registrasi_k3';

    protected $guarded = [
        'id'
    ];

    // Otomatis convert array checkbox ke JSON saat simpan, dan ke array lagi saat dipanggil
    protected $casts = [
        'checklist_apd' => 'array',
        'tanggal_induction' => 'date',
    ];
}
