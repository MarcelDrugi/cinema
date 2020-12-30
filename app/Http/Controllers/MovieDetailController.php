<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Term;
use App\Services\RepertoireService;

class MovieDetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $terms = Term::whereHas(
            'screening', fn($q1) => $q1->whereHas(
                'movie', fn($q2) => $q2->where('id', $id)
            )
        )->orderBy('date_time')->get();
        
        $service = new RepertoireService();
        $weekDays = $service->weekDays();
        
        $termsWithDays = array();
        
        foreach($weekDays as $weekDay) {
            
            $termsWithDays[$weekDay] = array();
            for($x = 8; $x < 24; $x += 2) {
                
                $termsWithDays[$weekDay][$x] = array();
                foreach($terms as $term) {
                    
                    if (
                        $term->day() == $weekDay && 
                        date('H:i', strtotime($term->date_time)) >= $x && 
                        date('H:i', strtotime($term->date_time)) < $x + 2
                    ) {
                        $termsWithDays[$weekDay][$x][] = $term;
                    }
                        
                }
                
            }
            
        }

        return response()->view('detail.index', [
            'movie' => Movie::findOrFail($id),
            'termsWithDays' => $termsWithDays,
        ]);
    }
}
