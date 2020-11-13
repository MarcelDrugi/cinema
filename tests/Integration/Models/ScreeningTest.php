<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Screening;
use App\Models\Term;
use Carbon\Carbon;
use App\Models\Reservation;

class ScreeningTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function relationWithMovie()
    {
        $screening = Screening::factory()->create();
        $this->assertEquals($screening->movie_id, $screening->movie->id);
    }
    
    /** @test */
    public function relationWithTerm()
    {
        $term = Term::factory()->create();
        $screening = Screening::orderBy('id', 'desc')->first();
        
        $this->assertEquals($screening->term->id, $term->id);
    }
    
    /** @test */
    public function sevenDaysTerm()
    {
        Term::factory()->create([
            'date_time' => Carbon::tomorrow(),
        ]);
        $screening = Screening::orderBy('id', 'desc')->first();    
        $this->assertNotNull($screening);
    }
    
    /** @test */
    public function relationWithReservation()
    {
        $reservation = Reservation::factory()->create();
        $screening = Screening::orderBy('id', 'desc')->first();
        
        $this->assertEquals($screening->reservations[0]->id, $reservation->id);
    }
    
    /** @test */
    public function maxNumberOfViewers()
    {
        Term::factory()->create();
        $screening = Screening::orderBy('id', 'desc')->first();
        
        $screening->viewers = $screening->term->hall->capacity + 1;
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The number of viewers is greater than the capacity of the hall!');
        $screening->save();
    }
}
