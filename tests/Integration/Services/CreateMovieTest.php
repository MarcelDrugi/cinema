<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Movie;
use App\Services\CreateMovieService;

class CreateMovieTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function create()
    {
        $newMovie = [
            'newTitle' => 'Some Title',
            'newDescription' => 'Description of the new movie',
            'newPublished' => 1976,
            'newTime' => 110,
            'newAge_limit' => 12,
        ];
        
        $service = new CreateMovieService($newMovie);
        $service->createMovie();
        
        $createdMovie = Movie::orderBy('id', 'desc')->first();
        
        $this->assertEquals($createdMovie->title, $newMovie['newTitle']);
        $this->assertEquals($createdMovie->description, $newMovie['newDescription']);
        $this->assertEquals($createdMovie->published, $newMovie['newPublished']);
        $this->assertEquals($createdMovie->time, $newMovie['newTime']);
        $this->assertEquals($createdMovie->age_limit, $newMovie['newAge_limit']);
        $this->assertEquals($createdMovie->new_movie, false);
    }
}
