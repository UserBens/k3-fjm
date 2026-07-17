<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class KodeOkReferensi extends Model
{
    use HasFactory;

    protected $table = 'kode_ok_referensi';
    protected $guarded = ['id'];

    // wherePivot() + withPivotValue() membuat 2 "relasi virtual" dari 1 tabel pivot yang sama,
    // masing-masing hanya melihat/menulis baris dengan jenis='WAJIB' atau jenis='KHUSUS'.
    // Jadi ->sync() di masing-masing relasi ini aman dipakai terpisah tanpa saling menimpa.
    public function apdWajib()
    {
        return $this->belongsToMany(StokAPD::class, 'kode_ok_referensi_apd', 'kode_ok_referensi_id', 'stok_apd_id')
            ->wherePivot('jenis', 'WAJIB')
            ->withPivotValue('jenis', 'WAJIB');
    }

    public function apdKhusus()
    {
        return $this->belongsToMany(StokAPD::class, 'kode_ok_referensi_apd', 'kode_ok_referensi_id', 'stok_apd_id')
            ->wherePivot('jenis', 'KHUSUS')
            ->withPivotValue('jenis', 'KHUSUS');
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('kode_ok', 'like', "%{$term}%")
                ->orWhere('uraian_pekerjaan', 'like', "%{$term}%")
                ->orWhere('dept_unit_kerja_pic', 'like', "%{$term}%")
                ->orWhere('kategori_pekerjaan', 'like', "%{$term}%");
        });
    }
}
