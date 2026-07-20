<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolboxMeeting extends Model
{
    protected $table = 'toolbox_meetings';

    protected $fillable = [
        'tanggal',
        'badge_so',
        'nama_so',
        'area_kerja',
        'unit_kerja',
        'foto_tbm',
        'foto_daftar_hadir',
        'dokumen_laporan_kegiatan',
        'created_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi opsional ke Pegawai (Safety Officer) berdasarkan badge.
     * Dipakai untuk menarik data terkini jika dibutuhkan, terpisah dari
     * snapshot nama_so yang sudah tersimpan.
     */
    public function safetyOfficer()
    {
        return $this->belongsTo(Pegawai::class, 'badge_so', 'badge');
    }
}
