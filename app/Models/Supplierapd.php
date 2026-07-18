<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Supplierapd extends Model
{
    use HasFactory;

    protected $table = 'supplier_apd_alkes';

    protected $guarded = [
        'id'
    ];

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('nama_supplier', 'like', "%{$term}%")
                ->orWhere('kategori_produk', 'like', "%{$term}%")
                ->orWhere('merk_utama', 'like', "%{$term}%")
                ->orWhere('kontak_person', 'like', "%{$term}%")
                ->orWhere('no_telepon', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('wilayah', 'like', "%{$term}%");
        });
    }
}
