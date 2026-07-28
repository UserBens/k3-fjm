<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_pp',
        'tanggal_pp',
        'unit_kerja',
        'diminta_oleh',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pp' => 'date',
    ];

    public function items()
    {
        return $this->hasMany(PermintaanPembelianItem::class);
    }

    /**
     * Generate No. PP otomatis, format: {urut}/{bulan_romawi}/PP/{tahun}.
     * Nomor urut direset setiap ganti bulan/tahun.
     */
    public static function generateNoPp(): string
    {
        $bulanRomawi = self::bulanKeRomawi((int) now()->format('n'));
        $tahun = now()->format('Y');
        $suffix = "/{$bulanRomawi}/PP/{$tahun}";

        $lastNumber = static::where('no_pp', 'like', "%{$suffix}")
            ->get()
            ->map(fn($row) => (int) explode('/', $row->no_pp)[0])
            ->max();

        $next = ((int) $lastNumber) + 1;

        return "{$next}{$suffix}";
    }

    private static function bulanKeRomawi(int $bulan): string
    {
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $map[$bulan] ?? 'I';
    }
}
