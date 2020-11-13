<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pricing;
use App\Models\Term;
use Carbon\Carbon;

class TermTest extends TestCase
{
    use RefreshDatabase;
    
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
        $term = Term::factory()->for(Pricing::factory()->state(['week_day' => 'Friday']))->create([
            'date_time' => new Carbon('2020-12-25 18:35:00')
        ]);
        $this->assertEquals($term->pricing_id, $term->pricing->id);
    }
    
    /** @test */
    public function designationOfWeekDay()
    {
        $term = Term::factory()->create(['date_time' => new Carbon('2020-12-23 18:35:00')]);  //  Wednesday
        $this->assertEquals('Wednesday', $term->day());
    }
    
    /** @test */
    public function designationOfTime()
    {
        $time = '20:15';
        $term = Term::factory()->create(['date_time' => new Carbon('2020-12-13 ' . $time)]);
        $this->assertEquals($time, $term->time());
    }
    
    /** @test */
    public function designationOfDate()
    {
        $day = '16';
        $month = '10';
        $term = Term::factory()->create(['date_time' => new Carbon("2020-$month-$day 18:35:00")]);
        $this->assertEquals("{$month}:$day", $term->date());
    }
}
