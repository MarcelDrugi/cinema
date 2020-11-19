<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Movie;
use App\Services\MovieService;

class MovieModifyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function updateMovie()
    {
        $movie = Movie::factory()->create();
        
        $newMovieData = [
            'id' => $movie->id,
            'title' => 'Title',
            'description' => 'Some description',
            'published' => 1953,
            'time' => 142,
            'age_limit' => 12,
            'new_movie' => 'on'
        ];
        
        $service = new MovieService($newMovieData);
        $service->updateMovie();
        
        $editedMovie = Movie::find($movie->id);
        
        $this->assertEquals($editedMovie->title, $newMovieData['title']);
        $this->assertEquals($editedMovie->description, $newMovieData['description']);
        $this->assertEquals($editedMovie->published, $newMovieData['published']);
        $this->assertEquals($editedMovie->time, $newMovieData['time']);
        $this->assertEquals($editedMovie->age_limit, $newMovieData['age_limit']);
        $this->assertEquals($editedMovie->new_movie, true);
    }
    
    /** @test */
    public function deleteMovie() 
    {
        $movie = Movie::factory()->create();
        $id = ['id' => $movie->id];
        
        $service = new MovieService($id);
        $service->deleteMovie();
        
        $movies = Movie::all();
        
        $this->assertEquals(Movie::find($movie->id), null);
        $this->assertEquals($movies->count(), 0);
    }
}