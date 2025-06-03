<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlSimplified extends Model
{
     protected $table = 'urls_simplified';

    public function getRouteKeyName()
    {
        return 'url_modify';
    }
}
