<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class HomepageController extends Controller
{
    public function index()
    {
        $m = Movie::all();
        //return response()->view('homepage.index', []);
        return response()->view('homepage.index', ['movies' => $m]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //$path = $request->file('myfile')->store('images');
        $path = $request->file('myfile')->store('posters', 's3');
        
        echo basename($path);
        echo "<br />";
        echo Storage::disk('s3')->url($path);
        echo "<br />";
        return "Ala ma kota";
        //return redirect()->action('App\Http\Controllers\HomepageController@index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
