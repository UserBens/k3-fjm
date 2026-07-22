<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPembelian extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'no_pp',
        'tanggal_pp',
        'unit_kerja',
        'diminta_oleh',
        'catatan',
    ];
 
    protected $casts = [
        'tanggal_pp' => 'date',
    ];
 
    public function items()
    {
        return $this->hasMany(PermintaanPembelianItem::class);
    }
}

