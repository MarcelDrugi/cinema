<?php


namespace Tests\Integration;

use Tests\TestCase;
use App\Models\Pricing;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PricingTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function relationWithTerm()
    {
        $term = Term::factory()->for(Pricing::factory()->state(['week_day' => 'Monday']))->create([
            'date_time' => new Carbon('2020-12-21 20:00:00')
        ]);
        
        $pricing = Pricing::orderBy('id', 'desc')->first();
        $this->assertEquals($pricing->terms[0]->id, $term->id);
    }
    
    /** @test */
    public function weekDayValidation()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The value must be one of the days of the week in English.');
        Pricing::factory()->create(['week_day' => 'WrongName']);
    }
}