<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Term;
use Carbon\Carbon;
use App\Models\Movie;


class TitleInfoTest extends TestCase
{
    use RefreshDatabase;
    
    protected $url = '/api/movie/';
    
    /** 
     * Asserting only 'fragment' of JSON reponse, because Factory doesn't include 'poster' on s3.
     * So test checks 5 of 6 fields.
     * 
     * @test
     */
    public function correctMovieRequest()
    {
        $movie = Movie::factory()->create();
        
        $expectedJSON = [
            'title' => $movie->title,
            'description' => $movie->description,
            'published' => (int)$movie->published,
            'time' => (int)$movie->time,
            'age_limit' => (int)$movie->age_limit,
        ];
        
        $response = $this->get($this->url . $movie->title);
        $response->assertStatus(200);
        $response->assertJsonFragment($expectedJSON);
    }
    
    /** @test */
    public function incorrectMovieRequest()
    {
        $response = $this->get($this->url . 'Non-Existent Movie');
        $response->assertStatus(404);
        $response->assertExactJson(['error' => 'Movie not found.']);
    }
}