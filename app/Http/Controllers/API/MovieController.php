<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index($title)
    {
        $movie = Movie::where('title', $title)->get();
        
        if (!$movie->isEmpty())
            return MovieResource::collection($movie);
        else
            return response()->json(['error' => 'Movie not found.'], 404);
    }

}
