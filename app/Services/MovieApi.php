<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieApi
{
    private $apiKey = "73c22d7aa417b39eb5263228a25ce742";
    private $urlDetail = "https://api.themoviedb.org/3/movie/";

    public function getMovies($url)
    {
        $request = Http::get($url.'?api_key='.$this->apiKey);
                
        return $request->json();
    }

    public function getDetail($movieId)
    {
        $url = $this->urlDetail.$movieId.'?api_key='.$this->apiKey;

        $request = Http::get($url);

        return $request->collect();
    }

}