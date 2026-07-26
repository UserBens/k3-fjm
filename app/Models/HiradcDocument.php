<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class HiradcDocument extends Model
{
    use HasFactory;

    protected $table = 'hiradc_documents';

    protected $fillable = [
        'departemen',
        'bagian',
        'pekerjaan',
        'no_hiradc',
        'revisi',
        'tanggal',
        'disiapkan_nama',
        'disiapkan_paraf',
        'disiapkan_tanggal',
        'disiapkan_ttd',
        'diperiksa_nama',
        'diperiksa_paraf',
        'diperiksa_tanggal',
        'diperiksa_ttd',
        'disahkan_nama',
        'disahkan_paraf',
        'disahkan_tanggal',
        'disahkan_ttd',
        'dokumen',
        'dokumen_hiradc',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'disiapkan_tanggal' => 'date',
        'diperiksa_tanggal' => 'date',
        'disahkan_tanggal' => 'date',
    ];

    // Group paling atas (tanpa parent) untuk dokumen ini, disusun sesuai urutan
    public function groups()
    {
        return $this->hasMany(HiradcGroup::class)->whereNull('parent_id')->orderBy('urutan');
    }

    public function allGroups()
    {
        return $this->hasMany(HiradcGroup::class);
    }

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
}
