<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LpiKorban extends Model
{
    protected $table = 'lpi_korban';
    protected $guarded = ['id'];

    public function kejadian()
    {
        return $this->belongsTo(LpiKejadian::class, 'kejadian_id');
    }
}
