<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UrlsSimplifiedSeeder extends Seeder
{
    public function run(): void
    {
        $urls = [
            'https://youtube.com',
            'https://google.com',
            'https://github.com',
            'https://facebook.com',
            'https://twitter.com',
            'https://instagram.com',
            'https://linkedin.com',
            'https://netflix.com',
            'https://amazon.com',
            'https://spotify.com'
        ];

        foreach ($urls as $url) {
            DB::table('urls_simplified')->insert([
                'url' => $url,
                'url_modify' => Str::random(5),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
} 