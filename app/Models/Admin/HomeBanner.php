<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    use HasFactory;

    function getMenu()
    {
        // return $this->belongsTo(InvestmentLegend::class);
        return $this->hasOne(Menu::class, 'id', 'menu_id');
        // return $this->hasMany(BlogsCategory::class,'id');

    }

    function getPage()
    {
        // return $this->belongsTo(InvestmentLegend::class);
        return $this->hasOne(Page::class, 'id', 'menu_id');
        // return $this->hasMany(BlogsCategory::class,'id');

    }
}
