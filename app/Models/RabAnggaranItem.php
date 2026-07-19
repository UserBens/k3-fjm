<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class RabAnggaranItem extends Model
{
    use HasFactory;
    protected $table = 'rab_anggaran_item';

    protected $guarded = ['id'];

    protected $casts = [
        'qty_ada'       => 'integer',
        'qty_butuh'     => 'integer',
        'qty_pengadaan' => 'integer',
        'harga_satuan'  => 'decimal:2',
    ];

    protected $appends = ['total_harga'];

    const JENIS = ['APD', 'ALKES'];
    const PRIORITAS = ['TINGGI', 'SEDANG', 'RENDAH'];
    const KATEGORI_APD = ['WAJIB', 'KHUSUS'];
    const KATEGORI_ALKES = ['ALKES', 'CONSUMABLE'];

    // Dasar perhitungan REKAP RAB PER PERIODE (Total Bulanan/Triwulan/Tahunan + Estimasi Setahun)
    const PERIODE = ['BULANAN', 'TRIWULAN', 'TAHUNAN'];

    public function getTotalHargaAttribute(): float
    {
        return (float) $this->qty_pengadaan * (float) $this->harga_satuan;
    }

    public function rabAnggaran()
    {
        return $this->belongsTo(RabAnggaran::class, 'rab_anggaran_id');
    }

    public function stokApd()
    {
        return $this->belongsTo(StokAPD::class, 'stok_apd_id');
    }

    public function stokAlkes()
    {
        return $this->belongsTo(StokAlkes::class, 'stok_alkes_id');
    }

    public function scopeJenis($query, ?string $jenis)
    {
        if (!$jenis) {
            return $query;
        }

        return $query->where('jenis', $jenis);
    }
}
