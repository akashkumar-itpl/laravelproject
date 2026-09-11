<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class ContactUs extends Model implements Searchable
{
    protected $table = 'contact_us_page'; // your table name

    public function getSearchResult(): SearchResult
    {
        $title   = 'Contact us';
        $content = 'Contact us';
        $url = url('/contact-us');
        return new SearchResult(
            $this,
            $title,
            $url,
            $content
        );
    }
    
}
