<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id'
    ];

    public function user() {

        return $this->belongsTo(Admin::class,'foreign_key');

       // return $this->belongsTo('App\Models\Admin\Admin','id','user_id') ;
    }
}
