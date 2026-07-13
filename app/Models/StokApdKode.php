<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokApdKode extends Model
{
    protected $guarded = ['id'];

    public function stokApd()
    {
        return $this->belongsTo(StokAPD::class, 'stok_apd_id');
    }
}
