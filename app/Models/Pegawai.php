<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerjaid', 'id_api');
    }

    // BARU — relasi ke baris pengawas_pekerjaan yang menaungi pegawai ini
    public function pengawasPekerjaan()
    {
        return $this->hasOne(PengawasPekerjaan::class, 'pegawai_id', 'id_api');
    }

    public function lokasiKerja()
    {
        return $this->belongsTo(LokasiKerja::class, 'lokasi_kerjaid', 'id_api');
    }

    public function subkon()
    {
        return $this->belongsTo(Subkon::class, 'perusahaan_subkonid', 'id_api');
    }

    // BARU — daftar tenaga yang dibina oleh pegawai ini (kalau dia berstatus Safety Officer)
    public function tenagaBinaanSafety()
    {
        return $this->hasMany(SafetyOfficerPegawai::class, 'badge_safety_officer', 'badge');
    }

    public function kualifikasi()
    {
        return $this->belongsTo(Kualifikasi::class, 'kualifikasiid', 'id_api');
    }

    public function kodeOk()
    {
        return $this->belongsTo(KodeOk::class, 'kode_ok', 'kode_ok');
    }
}
