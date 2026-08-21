<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAreaKerja extends Model
{
    protected $table = 'master_area_kerja';
    protected $guarded = ['id'];

    protected $casts = [
        'urutan_risiko' => 'integer',
        'aktif' => 'boolean',
    ];

    // Urutan Risiko = turunan otomatis dari Zona, selalu dihitung ulang
    // (pola sama dengan skor = kompleksitas x frekuensi di AktivitasKpiK3)
    protected static function booted(): void
    {
        static::saving(function (MasterAreaKerja $row) {
            $map = ['HIJAU' => 1, 'PUTIH' => 2, 'KUNING' => 3, 'MERAH' => 4];
            $row->urutan_risiko = $map[$row->zona] ?? 1;
        });
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('kompleks', 'ilike', "%{$term}%")
                ->orWhere('nama_area', 'ilike', "%{$term}%");
        });
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function getLabelAttribute(): string
    {
        return "{$this->kompleks} — {$this->nama_area}";
    }

    // Teks aturan APD default per zona — dipakai frontend untuk auto-suggest
    // Keterangan (admin tetap boleh edit manual sebelum simpan)
    public static function keteranganDefaultZona(string $zona): string
    {
        return match ($zona) {
            'HIJAU'  => 'Boleh tidak menggunakan APD jika tidak ada pekerjaan; APD menyesuaikan JSA/JRA saat ada pekerjaan.',
            'PUTIH'  => 'APD dasar wajib digunakan; APD tambahan menyesuaikan JSA/JRA saat ada pekerjaan.',
            'KUNING' => 'APD tambahan (Face Shield/Welding Goggles/dll.) menyesuaikan JSA untuk pekerjaan panas, ketinggian, atau kelistrikan.',
            'MERAH'  => 'APD tambahan (Chemical Suit/SAR/dll.) menyesuaikan JSA untuk pekerjaan radiografi, ruang terbatas, atau handling bahan kimia; SCBA wajib saat kondisi darurat.',
            default  => '',
        };
    }
}
