<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class AboutController extends Controller
{
    public function index()
    {
        return response()->view('about.index', [
            'info_side' => Information::where('place', 'about_side')->first(),
            'info_bottom' => Information::where('place', 'about_bottom')->first(),
        ]);
    }
}
