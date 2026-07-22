<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPembelianItem extends Model
{
    use HasFactory;
 
    // Status yang dipakai untuk pill/badge & filter di UI
    public const STATUS_BELUM_DATANG = 'Belum Datang';
    public const STATUS_KURANG       = 'Kurang';
    public const STATUS_LENGKAP      = 'Lengkap';
 
    public const STATUS_OPTIONS = [
        self::STATUS_BELUM_DATANG,
        self::STATUS_KURANG,
        self::STATUS_LENGKAP,
    ];
 
    protected $fillable = [
        'permintaan_pembelian_id',
        'nama_apd',
        'qty_permintaan',
        'qty_datang',
        'tanggal_datang',
        'keterangan',
    ];
 
    protected $casts = [
        'tanggal_datang' => 'date',
        'qty_permintaan' => 'integer',
        'qty_datang'     => 'integer',
    ];
 
    protected $appends = [
        'qty_kurang',
        'status',
    ];
 
    public function permintaanPembelian()
    {
        return $this->belongsTo(PermintaanPembelian::class);
    }
 
    /** Sisa barang yang belum datang. */
    public function getQtyKurangAttribute(): int
    {
        return max(0, (int) $this->qty_permintaan - (int) $this->qty_datang);
    }
 
    /** Status otomatis berdasarkan qty_datang vs qty_permintaan. */
    public function getStatusAttribute(): string
    {
        if ($this->qty_datang <= 0) {
            return self::STATUS_BELUM_DATANG;
        }
 
        if ($this->qty_datang < $this->qty_permintaan) {
            return self::STATUS_KURANG;
        }
 
        return self::STATUS_LENGKAP;
    }
}
