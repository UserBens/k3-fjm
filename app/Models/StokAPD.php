<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class StokAPD extends Model
{
    use HasFactory;
    protected $table = 'stok_apd';
    protected $guarded = ['id'];

    protected $casts = [
        'stok_awal'          => 'integer',
        'digunakan'          => 'integer',
        'rusak'              => 'integer',
        'reorder_point'      => 'integer',
        'harga_satuan'       => 'decimal:2',
        'terakhir_pengadaan' => 'date',
    ];

    // Ditambahkan otomatis setiap kali model di-serialize ke array/json (dipakai di modal detail & Pusat Reminder)
    protected $appends = ['stok_tersedia', 'status', 'lifetime_status'];

    public function getStokTersediaAttribute(): int
    {
        return $this->stok_awal - $this->digunakan - $this->rusak;
    }

    public function getStatusAttribute(): string
    {
        return $this->stok_tersedia <= $this->reorder_point ? 'REORDER' : 'OK';
    }

    /**
     * Status masa pakai APD berdasarkan tanggal_pengadaan + masa_pakai.
     * Meniru kolom AD di sheet '05_Master_APD' (SEGERA / HABIS MASA / AMAN).
     *
     * Ambang "SEGERA" = sisa ≤ 30 hari, sama seperti label kartu
     * "APD lifetime ≤30 hari" di Pusat Reminder.
     *
     * Return null jika data tidak cukup untuk dihitung (tanggal kosong,
     * atau format masa_pakai tidak bisa diparse — mis. "Sekali pakai").
     */
    public function getLifetimeStatusAttribute(): ?string
    {
        if (!$this->terakhir_pengadaan || !$this->masa_pakai) {
            return null;
        }

        $totalHari = static::parseMasaPakaiToDays($this->masa_pakai);

        if ($totalHari === null) {
            return null;
        }

        $tanggalHabisMasa = $this->terakhir_pengadaan->copy()->startOfDay()->addDays($totalHari);
        $sisaHari = now()->startOfDay()->diffInDays($tanggalHabisMasa, false);

        if ($sisaHari < 0) {
            return 'HABIS MASA';
        }

        if ($sisaHari <= 30) {
            return 'SEGERA';
        }

        return 'AMAN';
    }

    /**
     * Parser sederhana untuk teks bebas masa_pakai, mis:
     * "5 Tahun", "6 bulan", "2 minggu", "30 hari".
     * Mengembalikan null kalau tidak dikenali (mis. "Sekali pakai"),
     * supaya item itu tidak ikut dihitung reminder lifetime.
     */
    public static function parseMasaPakaiToDays(string $masaPakai): ?int
    {
        $text = strtolower(trim($masaPakai));

        if (preg_match('/(\d+)\s*tahun/', $text, $m)) {
            return ((int) $m[1]) * 365;
        }

        if (preg_match('/(\d+)\s*bulan/', $text, $m)) {
            return ((int) $m[1]) * 30;
        }

        if (preg_match('/(\d+)\s*minggu/', $text, $m)) {
            return ((int) $m[1]) * 7;
        }

        if (preg_match('/(\d+)\s*hari/', $text, $m)) {
            return (int) $m[1];
        }

        return null;
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('kode_apd', 'like', "%{$term}%")
                ->orWhere('jenis_apd', 'like', "%{$term}%")
                ->orWhere('merk_rekomendasi', 'like', "%{$term}%");
        });
    }

    public static function generateKode(string $jenisApd): string
    {
        $inisial = strtoupper(substr(trim($jenisApd), 0, 1));
        $inisial = $inisial ?: 'X';

        $prefix = "FJM-{$inisial}-";

        // Ambil nomor urut tertinggi yang sudah dipakai untuk inisial ini.
        // SUBSTRING ... FROM '[0-9]+$' mengambil digit di ujung kode (Postgres).
        $lastNumber = static::where('kode_apd', 'like', "{$prefix}%")
            ->selectRaw("MAX(CAST(SUBSTRING(kode_apd FROM '[0-9]+$') AS INTEGER)) as max_num")
            ->value('max_num');

        $next = ((int) $lastNumber) + 1;

        return $prefix . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }

    public function kodeOk()
    {
        return $this->hasMany(StokApdKode::class, 'stok_apd_id');
    }
}
