<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AksesUser extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
        'activated_at' => 'datetime',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
}
