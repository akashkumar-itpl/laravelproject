<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $fillable = ['menytype', 'menuName', 'menuslug', 'parent_id', 'childparent_id', 'NavigationLabel', 'CSSClasses', 'Description', 'Image','imageGallery','OpenLink', 'sortorder','sorting'];


    public function childs() {
        return $this->hasMany('App\Models\Admin\Menu','parent_id','sortorder') ;
    }

    function getBanner()
    {
        // return $this->belongsTo(InvestmentLegend::class);
        return $this->hasOne(HomeBanner::class, 'menu_id', 'id');
        // return $this->hasMany(BlogsCategory::class,'id');

    }
}
