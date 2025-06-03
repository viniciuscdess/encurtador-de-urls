<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\UrlSimplified;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/index');
    }

    public function redirect($url_modify)
    {
        $url = UrlSimplified::where('url_modify', $url_modify)->first();
        
        if (!$url) {
            die('URL não encontrada');
        }

        return redirect($url->url);
    }
}
