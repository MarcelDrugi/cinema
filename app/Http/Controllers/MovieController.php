<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Services\MovieService;
use App\Services\CreateMovieService;
use App\Http\Requests\EditMovieRequest;
use App\Http\Requests\CreateMovieRequest;

class MovieController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:employee');
    }
    
    public function index($action=null)
    {
        return response()->view('movie.index', ['movies' => Movie::all(), 'action' => $action]);
    }

    public function store(CreateMovieRequest $request)
    {
        $service = new CreateMovieService($request->all());
        $service->createMovie();
        
        return redirect()->route('movie.index', ['action' => 'newMovie']);
    }

    public function update(EditMovieRequest $request)
    {
        $service = new MovieService($request->all());
        $service->updateMovie();
        
        return redirect()->route('movie.index', ['action' => 'movieEdited']);
        
    }

    public function destroy(Request $request)
    {
        $service = new MovieService($request->all());
        $service->deleteMovie();
        
        return redirect()->route('movie.index', ['action' => 'movieDeleted']);
    }
}
