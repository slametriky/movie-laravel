<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieApi
{
    private $apiKey = "73c22d7aa417b39eb5263228a25ce742";

    public function getMovies($url)
    {
        $response = Http::get($url.'?api_key='.$this->apiKey);
                
        return $response->json();
    }

}