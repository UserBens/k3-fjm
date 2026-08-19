<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilKerjaApd extends Model
{
    protected $table = 'profil_kerja_apd';

    protected $guarded = ['id'];

    protected $casts = [
        'b1' => 'integer',
        'b2' => 'integer',
        'b3' => 'integer',
        'b4' => 'integer',
        'b5' => 'integer',
        'b6' => 'integer',
        'b7' => 'integer',
        'b8' => 'integer',
        'skor_tertinggi'    => 'integer',
        'skor_total'        => 'integer',
        'jml_bahaya_sedang' => 'integer',
        'tier_risiko'       => 'integer',
        'jml_karyawan'      => 'integer',
    ];

    /**
     * Label kategori bahaya B1..B8.
     * NB: label B2 adalah asumsi ("Kimia gas, uap & fume") karena tidak ada baris
     * contoh yang menjadikan B2 sebagai bahaya pengendali tunggal — silakan sesuaikan.
     */
    public const LABEL_BAHAYA = [
        1 => 'B1 Kimia cair / korosif',
        2 => 'B2 Kimia gas, uap & fume',
        3 => 'B3 Debu & partikulat',
        4 => 'B4 Kebisingan',
        5 => 'B5 Mekanis & benda tajam',
        6 => 'B6 Jatuh & ketinggian',
        7 => 'B7 Panas, api & radiasi',
        8 => 'B8 Listrik',
    ];

    /** Ambang batas nilai B dianggap "bahaya sedang" ke atas. */
    public const AMBANG_BAHAYA_SEDANG = 2;

    public const LABEL_TIER = [
        0 => 'Tidak Ada / Belum Dipetakan',
        1 => 'Rendah',
        2 => 'Sedang',
        3 => 'Tinggi',
        4 => 'Sangat Tinggi',
    ];

    public const WARNA_TIER = [
        0 => '#94a3b8',
        1 => '#16a34a',
        2 => '#ca8a04',
        3 => '#ea580c',
        4 => '#dc2626',
    ];

    protected static function booted(): void
    {
        static::saving(function (ProfilKerjaApd $row) {
            $nilai = [
                1 => (int) $row->b1,
                2 => (int) $row->b2,
                3 => (int) $row->b3,
                4 => (int) $row->b4,
                5 => (int) $row->b5,
                6 => (int) $row->b6,
                7 => (int) $row->b7,
                8 => (int) $row->b8,
            ];

            $skorTertinggi = max($nilai);

            // Bahaya pengendali = kategori dengan nilai tertinggi; jika seri, B bernomor terkecil menang.
            $bahayaPengendali = '(tidak ada bahaya bernilai)';
            if ($skorTertinggi > 0) {
                foreach ($nilai as $kode => $v) {
                    if ($v === $skorTertinggi) {
                        $bahayaPengendali = self::LABEL_BAHAYA[$kode];
                        break;
                    }
                }
            }

            $row->skor_tertinggi    = $skorTertinggi;
            $row->skor_total        = array_sum($nilai);
            $row->jml_bahaya_sedang = count(array_filter($nilai, fn($v) => $v >= self::AMBANG_BAHAYA_SEDANG));
            $row->tier_risiko       = $skorTertinggi; // Tier = skor tertinggi (0-4)
            $row->bahaya_pengendali = $bahayaPengendali;
        });
    }

    public function getLabelTierAttribute(): string
    {
        return self::LABEL_TIER[$this->tier_risiko] ?? '-';
    }

    public function getWarnaTierAttribute(): string
    {
        return self::WARNA_TIER[$this->tier_risiko] ?? '#94a3b8';
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'AKTIF');
    }
}
