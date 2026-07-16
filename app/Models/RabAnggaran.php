<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class RabAnggaran extends Model
{
    use HasFactory;
    protected $table = 'rab_anggaran';   // ← tambahkan baris ini

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    const STATUS = ['DRAFT', 'DIAJUKAN', 'DISETUJUI'];

    public function items()
    {
        return $this->hasMany(RabAnggaranItem::class, 'rab_anggaran_id');
    }

    public function itemsApd()
    {
        return $this->items()->where('jenis', 'APD');
    }

    public function itemsAlkes()
    {
        return $this->items()->where('jenis', 'ALKES');
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('nomor_rab', 'like', "%{$term}%")
                ->orWhere('departemen', 'like', "%{$term}%")
                ->orWhere('dibuat_oleh', 'like', "%{$term}%")
                ->orWhere('disetujui_oleh', 'like', "%{$term}%");
        });
    }

    // RAB-HSE-2026-001, penomoran direset ulang tiap tahun anggaran
    public static function generateNomorRab(string $tahun): string
    {
        $prefix = "RAB-HSE-{$tahun}-";

        $lastNumber = static::where('nomor_rab', 'like', "{$prefix}%")
            ->selectRaw("MAX(CAST(SUBSTRING(nomor_rab FROM '[0-9]+$') AS INTEGER)) as max_num")
            ->value('max_num');

        $next = ((int) $lastNumber) + 1;

        return $prefix . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }
}
