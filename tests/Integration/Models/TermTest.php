<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pricing;
use App\Models\Term;
use Carbon\Carbon;
use Exception;
use App\Models\Hall;
use App\Models\Screening;
use App\Models\Movie;

class TermTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function pastTermsValidations()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('date_time may not be in the past.');
        Term::factory()->create(['date_time' => Carbon::now()->addDays(-1)]);
    }
    
    /** @test */
    public function hallNotFreeInTermValidations()
    {
        $date = Carbon::today()->addDays(2)->addHours(19);
        $movieTime = 100;
        
        $hall = Hall::factory()->create();;
        $movie = Movie::factory()->create(['time' => $movieTime]);
        $screening1 = Screening::factory()->create(['movie_id' => $movie]);
        $screening2 = Screening::factory()->create(['movie_id' => $movie]);
        
        Term::factory()->create([
            'screening_id' => $screening1,
            'hall_id' => $hall,
            'date_time' => $date,
        ]);
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('This term is not free.');
        Term::factory()->create([
            'screening_id' => $screening2,
            'hall_id' => $hall,
            'date_time' => $date->addMinutes(20),
        ]);
    }
    
    /** @test */
    public function relationWithScreening()
    {
        $term = Term::factory()->create();
        $this->assertEquals($term->screening_id, $term->screening->id);
    }
    
    /** @test */
    public function relationWithHall()
    {
        $term = Term::factory()->create();
        $this->assertEquals($term->hall_id, $term->hall->id);
    }
    
    /** @test */
    public function relationWithPricing()
    {
        $term = Term::factory()->for(Pricing::factory()->state(['week_day' => 'Sunday']))->create([
            'date_time' => new Carbon('2022-12-25 18:35:00')
        ]);
        $this->assertEquals($term->pricing_id, $term->pricing->id);
    }
    
    /** @test */
    public function designationOfWeekDay()
    {
        $term = Term::factory()->create(['date_time' => new Carbon('2022-12-23 18:35:00')]);  //  Wednesday
        $this->assertEquals('Friday', $term->day());
    }
    
    /** @test */
    public function designationOfTime()
    {
        $time = '20:15';
        $term = Term::factory()->create(['date_time' => new Carbon('2022-12-13 ' . $time)]);
        $this->assertEquals($time, $term->time());
    }
    
    /** @test */
    public function designationOfDate()
    {
        $day = '16';
        $month = '10';
        $term = Term::factory()->create(['date_time' => new Carbon("2022-$month-$day 18:35:00")]);
        $this->assertEquals("{$month}:$day", $term->date());
    }
}
