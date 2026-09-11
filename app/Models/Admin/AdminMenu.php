<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class AdminMenu extends Model
{
    use HasFactory;

  
    protected $table = 'admin_menus';
}
