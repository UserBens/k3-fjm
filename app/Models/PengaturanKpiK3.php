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

    private static function kolomDisalin(): array
    {
        return [
            'tanggal_cutoff_manajer',
            'hari_kerja_efektif_manajer',
            'hari_kerja_efektif_p2k3',
            'jumlah_hari_kalender_manajer',
            'jumlah_hari_kalender_p2k3',
            'batas_terlambat_lapor',
            'batas_lapor_lebih_awal',
            'porsi_capaian_aktivitas',
            'porsi_ketepatan_waktu',
            'tunjangan_safety',
            'tunjangan_pengawas',
            'tunjangan_medis',
            'skor_minimum_tunjangan',
            'skor_maksimum_tunjangan',
            'tim_safety_dapat_tunjangan',
            'tim_pengawas_dapat_tunjangan',
            'tim_medis_dapat_tunjangan',
            'ambang_merah',
            'ambang_kuning',
        ];
    }

    /** Selalu ambil baris pengaturan tunggal (buat default kalau belum ada). */
    public static function forPeriode(int $tahun, int $bulan): self
    {
        $existing = static::where('tahun_aktif', $tahun)->where('bulan_aktif', $bulan)->first();
        if ($existing) {
            return $existing;
        }

        $sebelumnya = static::where(function ($q) use ($tahun, $bulan) {
            $q->where('tahun_aktif', '<', $tahun)
                ->orWhere(function ($q2) use ($tahun, $bulan) {
                    $q2->where('tahun_aktif', $tahun)->where('bulan_aktif', '<', $bulan);
                });
        })
            ->orderByDesc('tahun_aktif')
            ->orderByDesc('bulan_aktif')
            ->first();

        $base = $sebelumnya
            ? $sebelumnya->only(self::kolomDisalin())
            : [
                'tanggal_cutoff_manajer' => 26,
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
            ];

        $awalBulan = now()->setDate($tahun, $bulan, 1)->startOfMonth();
        $akhirBulan = now()->setDate($tahun, $bulan, 1)->endOfMonth();

        $model = new static(array_merge($base, [
            'tahun_aktif' => $tahun,
            'bulan_aktif' => $bulan,
            'periode_manajer_mulai' => $awalBulan,
            'periode_manajer_selesai' => $akhirBulan,
            'periode_p2k3_mulai' => $awalBulan,
            'periode_p2k3_selesai' => $akhirBulan,
        ]));
        $model->exists = false; // penanda: ini DRAFT, belum ada di DB

        return $model;
    }

    /** Daftar periode yang SUDAH pernah disimpan (untuk dropdown histori). */
    public static function daftarPeriodeTersimpan()
    {
        return static::query()
            ->select('tahun_aktif', 'bulan_aktif')
            ->orderByDesc('tahun_aktif')
            ->orderByDesc('bulan_aktif')
            ->get();
    }
}
