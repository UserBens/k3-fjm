<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterHariLibur extends Model
{
    protected $table = 'master_hari_liburs';
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'tanggal' => 'date:Y-m-d',
    ];

    const JENIS_LIBUR_NASIONAL = 'libur_nasional';
    const JENIS_CUTI_BERSAMA = 'cuti_bersama';

    const JENIS_LABEL = [
        self::JENIS_LIBUR_NASIONAL => 'Libur Nasional',
        self::JENIS_CUTI_BERSAMA => 'Cuti Bersama',
    ];
}
