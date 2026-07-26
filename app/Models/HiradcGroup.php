<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class HiradcGroup extends Model
{
    use HasFactory;

    protected $table = 'hiradc_groups';

    protected $fillable = [
        'hiradc_document_id',
        'parent_id',
        'nama',
        'urutan',
    ];

    public function document()
    {
        return $this->belongsTo(HiradcDocument::class, 'hiradc_document_id');
    }

    public function parent()
    {
        return $this->belongsTo(HiradcGroup::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(HiradcGroup::class, 'parent_id')->orderBy('urutan');
    }

    public function items()
    {
        return $this->hasMany(HiradcItem::class)->orderBy('urutan');
    }
}
