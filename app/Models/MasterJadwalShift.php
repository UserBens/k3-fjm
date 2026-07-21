<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterJadwalShift extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'tanggal'   => 'date:Y-m-d',
        'jam_kerja' => 'integer',
        'jam_nd'    => 'integer',
    ];

    // Accessor untuk mendapatkan nama shift lengkap
    public function getNamaShiftAttribute(): string
    {
        return match (strtoupper($this->kode_shift)) {
            'P'     => 'Pagi',
            'S'     => 'Sore',
            'M'     => 'Malam',
            'O'     => 'Off / Libur',
            default => $this->kode_shift,
        };
    }

    // Scope Query Helpers
    public function scopeRegu($query, string $regu)
    {
        return $query->where('regu', strtoupper($regu));
    }

    public function scopeTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal', $tanggal);
    }
}
