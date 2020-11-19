<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Screening;
use App\Models\Hall;
use App\Models\Term;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Movie;

class ScreeningTest extends NoPermissionRedirect
{
    use RefreshDatabase;
    
    protected $url = '/screening';
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
    public function modifyScreening()
    {
        
        $screening = Screening::factory()->create();
        
        $hall = Hall::factory()->create();
        $newHall = Hall::factory()-> create();
        
        $term = Term::factory()->create([
            'hall_id' => $hall,
            'screening_id' => $screening,
        ]);
        
        $newDate = Carbon::today()->addDays(3)->addHours(15)->addMinutes(20);
        $newData = [
            'modifyTerm' => $newDate->format('d-m-Y'),
            'modifyTime' => $newDate->format('h:i'),
            'forMovie' => $screening->movie_id,
            'changedHall' => json_encode(['id' => $newHall->id]),
            'movieForEditScreening' => json_encode([
                'id' => $screening->id,
                'term' => ['id' => $term->id],
                'movie_id' => $screening->movie_id,
            ]),
        ];
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->put($this->url, $newData);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        $response->assertSessionHas('screeningEdited', true);
        
        $editedScreening = Screening::find($screening->id);
        
        $this->assertEquals($editedScreening->term->date_time, $newDate->format('Y-m-d h:i:s'));
        $this->assertEquals($editedScreening->term->hall_id, $newHall->id);
    }
    
    /** @test */
    public function createScreening()
    {
        $movie = Movie::factory()->create();
        $hall = Hall::factory()->create();
        
        $newDate = Carbon::today()->addDays(5)->addHours(22)->addMinutes(35);
        
        $screeningData = [
            'term' => $newDate->format('d-m-Y'),
            'time' => $newDate->format('h:i'),
            'movieForScreeningSelect' => json_encode([
                'id' => $movie->id,
                'title' => $movie->title,
                'time' => $movie->time,
            ]),
            'datesForHallSelect' => json_encode([
                'id' => $hall->id,
            ]),
        ];
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->post($this->url, $screeningData);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        $response->assertSessionHas('newScreening', $movie->title);
        
        $newScreening = Screening::orderBy('id', 'desc')->first();
        
        $this->assertEquals($newScreening->term->date_time, $newDate->format('Y-m-d h:i:s'));
        $this->assertEquals($newScreening->term->hall_id, $hall->id);
        $this->assertEquals($newScreening->movie_id, $movie->id);
    }
    
    /** @test */
    public function removeScreening()
    {
        $movie = Movie::factory()->create();
        $screening = Screening::factory()->create(['movie_id' => $movie->id]);
        $body = [
            'movieForEditScreening' => json_encode([
                'id' => $screening->id,
                'movie_id' => $movie->id,
            ]),   
        ];
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->put($this->url . '/delete', $body);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        $response->assertSessionHas('deletedScreening', $movie->title);
        
        $screenings = Screening::all();
        
        $this->assertEquals(Screening::find($screening->id), null);
        $this->assertEquals($screenings->count(), 0);
    }
}

