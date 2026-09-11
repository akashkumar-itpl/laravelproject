<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    protected function casts(): array
{
    return [
        'two_factor_enabled' => 'boolean',
        'two_factor_confirmed_at' => 'datetime',

        'google2fa_secret' => 'encrypted',
    ];
}
}