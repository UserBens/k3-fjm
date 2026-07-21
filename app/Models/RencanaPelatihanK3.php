<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaPelatihanK3 extends Model
{
    protected $table = 'rencana_pelatihan_k3';
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'jadwal' => 'array',
        'anggaran_estimasi' => 'decimal:2',
        'tahun' => 'integer',
        'durasi_jam' => 'integer',
    ];

    /** Urutan periode sesuai sheet: Jan..Ags per bulan, lalu Sep-Des digabung. */
    public const PERIODE = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'ags', 'sep_des'];

    public const PERIODE_LABEL = [
        'jan' => 'Jan',
        'feb' => 'Feb',
        'mar' => 'Mar',
        'apr' => 'Apr',
        'mei' => 'Mei',
        'jun' => 'Jun',
        'jul' => 'Jul',
        'ags' => 'Ags',
        'sep_des' => 'Sep-Des',
    ];

    public const STATUS_LABEL = [
        'terlaksana' => 'Terlaksana',
        'dijadwalkan' => 'Dijadwalkan',
        'tertunda' => 'Tertunda',
    ];

    public const PRIORITAS = ['Tinggi', 'Sedang', 'Rendah'];
}
