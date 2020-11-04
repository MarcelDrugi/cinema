<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\RepertoireService;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RepertoireController extends Controller
{
    public function index()
    {
        $s = new RepertoireService();
        $movies = Movie::has('sevenDaysScreenings')->get();
        return view('repertoire.index', [
            'movies' => $movies,
            'weekDays' => $s->weekDays(),
            'today' => Carbon::today()->format('d/m'),
            'lastDay' => Carbon::today()->addDay(7)->format('d/m'),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
