<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Movie;
use App\Models\Term;
use App\Services\RepertoireService;
use Carbon\Carbon;


class RepertoireController extends Controller
{
    public function index()
    {
        $movies = Movie::has('sevenDaysScreenings')->get();
        $termsWithDays = array();
       
        $service = new RepertoireService();
        $weekDays = $service->weekDays();
                
        foreach ($weekDays as $weekDay) {
            
            $termsWithDays[$weekDay] = array();
            foreach ($movies as $movie) {
                
                $terms = Term::whereHas(
                    'screening', fn($q1) => $q1->whereHas(
                        'movie', fn($q2) => $q2->where('id', $movie->id)
                    )
                )->orderBy('date_time')->get();
                    
                $termsWithDays[$weekDay][$movie->title] = array();
                for ($x=8; $x<24; $x+=2) {
                    
                    $termsWithDays[$weekDay][$movie->title][$x] = array();
                    foreach($terms as $term) {
                            
                        if (
                            $term->day() == $weekDay &&
                            date('H:i', strtotime($term->date_time)) >= $x &&
                            date('H:i', strtotime($term->date_time)) < $x + 2
                            ) {
                                $termsWithDays[$weekDay][$movie->title][$x][] = $term;
                        }
                                
                    }
                    
                }
                
            }
            
        }
        
        $dates = array();
        $today = Carbon::today();
        for ($i=0; $i<7; $i++)
            $dates[] = $today->addDay(1)->format('d/m');
        
        return view('repertoire.index', [
            'termsWithDays' => $termsWithDays,
            'allMovies' => $movies,
            'info' => Information::where('place', 'repertoire')->first(),
            'dates' => $dates,
        ]);
    }
}
