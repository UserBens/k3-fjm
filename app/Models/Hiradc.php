<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hiradc extends Model
{
    use HasFactory;

    protected $table = 'hiradc';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'disiapkan_tanggal' => 'date',
        'diperiksa_tanggal' => 'date',
        'disahkan_tanggal' => 'date',
    ];

    public function getDokumenUrlAttribute(): ?string
    {
        return $this->dokumen ? Storage::disk('public')->url($this->dokumen) : null;
    }

    public function getDisiapkanTtdUrlAttribute(): ?string
    {
        return $this->disiapkan_ttd ? Storage::disk('public')->url($this->disiapkan_ttd) : null;
    }

    public function getDiperiksaTtdUrlAttribute(): ?string
    {
        return $this->diperiksa_ttd ? Storage::disk('public')->url($this->diperiksa_ttd) : null;
    }

    public function getDisahkanTtdUrlAttribute(): ?string
    {
        return $this->disahkan_ttd ? Storage::disk('public')->url($this->disahkan_ttd) : null;
    }

    public function kodeOk()
    {
        return $this->belongsTo(KodeOk::class, 'kode_ok_id');
    }

    public function apdList()
    {
        return $this->belongsToMany(StokAPD::class, 'hiradc_document_apd', 'hiradc_document_id', 'stok_apd_id')
            ->withTimestamps();
    }
}
