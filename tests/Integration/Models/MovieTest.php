<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Movie;
use App\Models\Screening;
use App\Models\Term;
use Carbon\Carbon;

class MovieTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function nextSevenDaysScreenings()
    {
        $thisWeekMovies = 3;
        $nextWeekMovies = 2;
        
        $movie = Movie::factory()->create();
        
        Screening::factory()->has(Term::factory()->state([
            'date_time' => Carbon::tomorrow(),
        ]))->count($thisWeekMovies)->create([
            'movie_id' => $movie->id,
        ]);
        
        Screening::factory()->has(Term::factory()->state([
            'date_time' => Carbon::now()->addDays(10),
        ]))->count($nextWeekMovies)->create([
            'movie_id' => $movie->id,
        ]);
        
        $this->assertEquals(count($movie->sevenDaysScreenings), $thisWeekMovies);
        $this->assertEquals(count($movie->screenings), $thisWeekMovies + $nextWeekMovies);
    }
}