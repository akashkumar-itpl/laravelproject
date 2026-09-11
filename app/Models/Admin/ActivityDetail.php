<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ActivityDetail extends Model
{
    use HasFactory;
  

    protected $table = 'activityitems';

    function getgalleryImages(){
        // return $this->belongsTo(InvestmentLegend::class);
        return $this->hasMany(ActivityImage::class, 'gallery_id', 'id');
        // return $this->hasMany(BlogsCategory::class,'id');
        
    }

    function getgalleryCategory(){
        // return $this->belongsTo(InvestmentLegend::class);
        return $this->hasOne(Activity::class, 'id', 'gallery_id');
        // return $this->hasMany(BlogsCategory::class,'id');
        
    }
   
}
