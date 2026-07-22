<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterJadwalShift extends Model
{
    use HasFactory;

    protected $table = 'master_jadwal_shifts';

    protected $fillable = [
        'tanggal',
        'shift_a',
        'jam_a',
        'shift_b',
        'jam_b',
        'shift_c',
        'jam_c',
        'shift_d',
        'jam_d',
        'jam_nd',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date:Y-m-d',
        'jam_a'   => 'integer',
        'jam_b'   => 'integer',
        'jam_c'   => 'integer',
        'jam_d'   => 'integer',
        'jam_nd'  => 'integer',
    ];

    /**
     * Kode shift yang valid.
     */
    public const SHIFT_CODES = ['P', 'S', 'M', 'O'];
}
