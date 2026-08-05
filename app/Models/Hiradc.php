<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Hiradc extends Model
{
    use HasFactory;

    protected $table = 'hiradc';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kodeOk()
    {
        return $this->belongsTo(KodeOk::class, 'kode_ok_id');
    }

    public function apdList()
    {
        return $this->belongsToMany(StokAPD::class, 'hiradc_document_apd', 'hiradc_document_id', 'stok_apd_id')
            ->withTimestamps();
    }

    protected function dokumenUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->dokumen
                ? Storage::disk('public')->url($this->dokumen)
                : null,
        );
    }
}
