<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class AboutController extends Controller
{
    public function index()
    {
        return response()->view('about.index', [
            'info_left' => Information::where('place', 'about_left')->first(),
            'info_right' => Information::where('place', 'about_right')->first(),
            'info_bottom' => Information::where('place', 'about_bottom')->first(),
        ]);
    }
}
