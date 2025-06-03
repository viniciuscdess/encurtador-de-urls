<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlSimplified extends Model
{
    protected $fillable = ['url', 'url_modify'];
    
     protected $table = 'urls_simplified';

    public function getRouteKeyName()
    {
        return 'url_modify';
    }
}
