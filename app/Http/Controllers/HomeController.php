<?php

namespace App\Http\Controllers;

use App\Models\UrlSimplified;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function encurtar(Request $request)
    {
        $url = $request->input('url');
        
        $url_modify = $this->gerarUrl();

        $url = UrlSimplified::create([
            'url' => $url,
            'url_modify' => $url_modify,
        ]);

        return redirect()->route('home.index')->with('url_modify', $url_modify);
    }

    public function gerarUrl()
    {
        do {
            $url_modify = Str::random(6);
        } while (UrlSimplified::where('url_modify', $url_modify)->exists());

        return $url_modify;
    }
}
