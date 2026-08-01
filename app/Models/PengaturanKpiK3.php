<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanKpiK3 extends Model
{
    protected $table = 'pengaturan_kpi_k3';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'periode_manajer_mulai'   => 'date',
        'periode_manajer_selesai' => 'date',
        'periode_p2k3_mulai'      => 'date',
        'periode_p2k3_selesai'    => 'date',
        'tim_safety_dapat_tunjangan'   => 'boolean',
        'tim_pengawas_dapat_tunjangan' => 'boolean',
        'tim_medis_dapat_tunjangan'    => 'boolean',
        'porsi_capaian_aktivitas'  => 'float',
        'porsi_ketepatan_waktu'    => 'float',
        'tunjangan_safety'         => 'integer',
        'tunjangan_pengawas'       => 'integer',
        'tunjangan_medis'          => 'integer',
        'skor_minimum_tunjangan'   => 'float',
        'skor_maksimum_tunjangan'  => 'float',
        'ambang_merah'             => 'float',
        'ambang_kuning'            => 'float',
    ];

    /** Selalu ambil baris pengaturan tunggal (buat default kalau belum ada). */
    public static function current(): self
    {
        return static::first() ?? static::create([
            'tahun_aktif' => now()->year,
            'bulan_aktif' => now()->month,
            'tanggal_cutoff_manajer' => 26,
            'periode_manajer_mulai' => now()->startOfMonth(),
            'periode_manajer_selesai' => now()->endOfMonth(),
            'periode_p2k3_mulai' => now()->startOfMonth(),
            'periode_p2k3_selesai' => now()->endOfMonth(),
            'hari_kerja_efektif_manajer' => 21,
            'hari_kerja_efektif_p2k3' => 23,
            'jumlah_hari_kalender_manajer' => 30,
            'jumlah_hari_kalender_p2k3' => 31,
            'batas_terlambat_lapor' => 7,
            'batas_lapor_lebih_awal' => 1,
            'porsi_capaian_aktivitas' => 90,
            'porsi_ketepatan_waktu' => 10,
            'tunjangan_safety' => 600000,
            'tunjangan_pengawas' => 600000,
            'tunjangan_medis' => 600000,
            'skor_minimum_tunjangan' => 0,
            'skor_maksimum_tunjangan' => 100,
            'tim_safety_dapat_tunjangan' => true,
            'tim_pengawas_dapat_tunjangan' => false,
            'tim_medis_dapat_tunjangan' => false,
            'ambang_merah' => 75,
            'ambang_kuning' => 90,
        ]);
    }
}
