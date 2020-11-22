<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Movie;
use App\Services\RepertoireService;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RepertoireController extends Controller
{
    public function index()
    {
        $s = new RepertoireService();
        
        return view('repertoire.index', [
            'movies' => Movie::has('sevenDaysScreenings')->get(),
            'weekDays' => $s->weekDays(),
            'today' => Carbon::today()->format('d/m'),
            'lastDay' => Carbon::today()->addDay(7)->format('d/m'),
            'info' => Information::where('place', 'repertoire')->first(),
        ]);
    }
}
