<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterApd extends Model
{
    protected $table = 'parameter_apd';

    protected $guarded = ['id'];

    protected $casts = [
        'tahun_anggaran'       => 'integer',
        'buffer_cadangan'      => 'float',
        'hitung_tanda_o'       => 'boolean',
        'wajib_dasar_di_hijau' => 'boolean',
        'pembulatan_kemasan'   => 'boolean',
        'hari_kerja_baku'      => 'integer',
        'hari_kerja_shift'     => 'integer',
        'pakai_kontrak_dulu'   => 'boolean',
    ];

    /** Default nilai dasar ketika belum ada baris utk tahun manapun (baris pertama kali dibuat). */
    private static function default(int $tahun): array
    {
        return [
            'tahun_anggaran'       => $tahun,
            'buffer_cadangan'      => 5.00,
            'hitung_tanda_o'       => false,
            'wajib_dasar_di_hijau' => true,
            'pembulatan_kemasan'   => true,
            'hari_kerja_baku'      => 250,
            'hari_kerja_shift'     => 365,
            'pakai_kontrak_dulu'   => true,
        ];
    }

    /**
     * Ambil (atau susun draft) setelan global utk satu Tahun Anggaran.
     * Kalau belum pernah disimpan utk tahun itu, salin dari tahun terakhir yang tersimpan;
     * kalau belum ada sama sekali, pakai nilai dasar bawaan sistem.
     */
    public static function forTahun(int $tahun): self
    {
        $existing = static::where('tahun_anggaran', $tahun)->first();
        if ($existing) {
            return $existing;
        }

        $sebelumnya = static::where('tahun_anggaran', '<', $tahun)
            ->orderByDesc('tahun_anggaran')
            ->first();

        $base = $sebelumnya
            ? $sebelumnya->only([
                'buffer_cadangan',
                'hitung_tanda_o',
                'wajib_dasar_di_hijau',
                'pembulatan_kemasan',
                'hari_kerja_baku',
                'hari_kerja_shift',
                'pakai_kontrak_dulu',
            ])
            : static::default($tahun);

        $model = new static(array_merge($base, ['tahun_anggaran' => $tahun]));
        $model->exists = false; // penanda: DRAFT, belum ada di DB

        return $model;
    }

    public static function daftarTahunTersimpan()
    {
        return static::query()->orderByDesc('tahun_anggaran')->pluck('tahun_anggaran');
    }
}
