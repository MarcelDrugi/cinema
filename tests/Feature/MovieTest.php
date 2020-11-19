<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends NoPermissionRedirect
{
    use RefreshDatabase;
    
    protected $url = '/movie';
    protected $correctRole = 'employee';
    protected $incorrectRole = 'customer';
    
    /** @test */
    public function getRedirectNotLoggedInUser()
    {
        parent::getRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function postRedirectNotLoggedInUser()
    {
        parent::postRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function putRedirectNotLoggedInUser()
    {
        parent::putRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function getRedirectUserWithoutPermission()
    {
        parent::getRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function postRedirectUserWithoutPermission()
    {
        parent::postRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function putRedirectUserWithoutPermission()
    {
        parent::putRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function modifyMovie()
    {
        $movie = Movie::factory()->create();
        
        $newData = [
            'id' => $movie->id,
            'title' => 'New Title',
            'description' => 'Some new description',
            'published' => 1948,
            'time' => 125,
            'age_limit' => 16,
            'new_movie' => 'on'
        ];
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->put($this->url, $newData);
        $response->assertStatus(302);
        $response->assertRedirect($this->url . '/movieEdited');
        
        $editedMovie = Movie::find($movie->id);
        
        $this->assertEquals($editedMovie->title, $newData['title']);
        $this->assertEquals($editedMovie->description, $newData['description']);
        $this->assertEquals($editedMovie->published, $newData['published']);
        $this->assertEquals($editedMovie->time, $newData['time']);
        $this->assertEquals($editedMovie->age_limit, $newData['age_limit']);
        $this->assertEquals($editedMovie->new_movie, true);
    }
    
    /** @test */
    public function createMovie()
    {
        $movieData = [
            'newTitle' => 'Some Title',
            'newDescription' => 'Description of the new movie',
            'newPublished' => 1976,
            'newTime' => 110,
            'newAge_limit' => 12,
        ];
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->post($this->url, $movieData);
        $response->assertStatus(302);
        $response->assertRedirect($this->url . '/newMovie');
        
        $newMovie = Movie::orderBy('id', 'desc')->first();
        
        $this->assertEquals($newMovie->title, $movieData['newTitle']);
        $this->assertEquals($newMovie->description, $movieData['newDescription']);
        $this->assertEquals($newMovie->published, $movieData['newPublished']);
        $this->assertEquals($newMovie->time, $movieData['newTime']);
        $this->assertEquals($newMovie->age_limit, $movieData['newAge_limit']);
        $this->assertEquals($newMovie->new_movie, false);
    }
    
    /** @test */
    public function removeMovie()
    {
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $movie = Movie::factory()->create();
        $body = ['id' => $movie->id];
        
        $response = $this->actingAs($user)->put($this->url . '/delete', $body);
        $response->assertStatus(302);
        $response->assertRedirect($this->url . '/movieDeleted');
        
        $movies = Movie::all();
        
        $this->assertEquals(Movie::find($movie->id), null);
        $this->assertEquals($movies->count(), 0);
    }
}
