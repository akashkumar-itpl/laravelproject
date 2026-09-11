<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use HasFactory;
    // use Sluggable;

    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
   // }
   function getBanner()
    {
        // return $this->belongsTo(InvestmentLegend::class);
        return $this->hasOne(HomeBanner::class, 'menu_id', 'id')->where('status',1);
        // return $this->hasMany(BlogsCategory::class,'id');

    }
   function getHomeBanner()
    {
        // return $this->belongsTo(InvestmentLegend::class);
        return $this->hasMany(HomeBanner::class, 'menu_id', 'id')->where('status',1)->orderBy('sortOrder');
        // return $this->hasMany(BlogsCategory::class,'id');

    }
}

