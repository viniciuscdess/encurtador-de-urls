<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/index');
    }

    public function shorten(Request $request)
    {
        $data = $request->validate([
            'url_original' => 'required|min:5|url',
        ]);

        $maxAttempts = 5;
        $attempts    = 0;

        do {
            $attempts++;
            
            $shortHash = $this->generateShortUrl();

            try {
                $url = Url::create([
                    'url_original' => $data['url_original'],
                    'url_modify'   => $shortHash,
                ]); 

                return redirect()->route('home.index')->with('success', 'URL encurtada com sucesso!')->with('url_modify', $shortHash);
            } catch (QueryException $e) {
                if ($e->getCode() !== '23000' || ! str_contains($e->getMessage(), '1062')) {
                    throw $e;
                }
                // recomeça o loop
            }

        } while ($attempts < $maxAttempts);

        abort(500, "Não foi possível gerar um hash único após {$maxAttempts} tentativas.");
    }

    private function generateShortUrl(): string
    {
        return Str::random(7);
    }

    public function redirect(string $param)
    {
        if (strlen($param) < 7) return redirect()->route('home.index');
            
        $url = Url::where('url_modify', $param)->first(); 

        if (!$url) return redirect()->route('home.index');

        $url->increment('redirects');
        
        return redirect()->away($url->url_original);
    }

    public function clickCounter()
    {
        $urls = Url::all();

        return view('home/contador', compact('urls'));
    }
}
