<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatKesehatanPenggunaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_digunakan' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function alatKesehatan()
    {
        return $this->belongsTo(
            StokAlkes::class,
            'stok_alkes_id' // BENAR
        );
    }
}
