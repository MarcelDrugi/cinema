<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Screening;
use App\Models\Term;
use Carbon\Carbon;


class ScreeningInfoTest extends TestCase
{
    use RefreshDatabase;
    
    protected $url = '/api/screenings';
    
    protected function setUp(): void 
    {
        parent::setUp();
        
        $this->screenings = Screening::factory()->count(5)->create();
        
        $this->jsonResponse = [];
        
        foreach ($this->screenings as $screening) {
            $term = Term::factory()->create([
                'screening_id' => $screening->id,
                'date_time' => Carbon::tomorrow()->addHours(14),
            ]);
            
            $this->jsonResponse[] = [
                'freeTickets' => true,
                'term' => Carbon::parse($term->date_time)->format('Y-m-d H:i:s'),
                'time' => $screening->movie->time,
                'title' => $screening->movie->title,
            ];
        }
    }
    
    /** @test */
    public function correctRequestWithoutFilter()
    {   
        $response = $this->get($this->url);
        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => $this->jsonResponse
        ]);
    }
    
    /** @test */
    public function correctRequestWithTitleFilter()
    {
        $id = 2;
        $title = $this->screenings[$id]->movie->title;
        
        $response = $this->get($this->url . '?title=' . $title);
        $response->assertStatus(200);
        $response->assertJsonFragment($this->jsonResponse[$id]);
    }
    
    /**
     * All screenings have data 'Carbon::tomorrow()', so response should contains full data.
     * 
     *  @test 
     */
    public function correctRequestWithSevenDaysFilter()
    {
        $response = $this->get($this->url . '?sevenDays=' . true);
        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => $this->jsonResponse
        ]);
    }
    
    /** @test */
    public function correctRequestWithDayFilter()
    {
        $id = 0;
        $term = Term::where('screening_id', $this->screenings[$id]->id)->first();
        $date = Carbon::parse($term->date_time)->format('Y-m-d');

        $response = $this->get($this->url . '?day=' . $date);
        $response->assertStatus(200);
        $response->assertJsonFragment($this->jsonResponse[$id]);
    }
    
    /** @test */
    public function incorrectRequest()
    {
        $response = $this->get($this->url . '?wrong=something');
        $response->assertStatus(400);
        $response->assertExactJson(['error' => 'Wrong filters.']);
    }
}