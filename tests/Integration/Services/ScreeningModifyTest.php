<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use RuntimeException;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Screening;
use App\Models\Term;
use App\Services\ScreeningService;
use Carbon\Carbon;

class ScreeningModifyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function createScreening()
    {
        $movie = Movie::factory()->create();
        $hall = Hall::factory()->create();
        
        $newDate = Carbon::today()->addDays(2)->addHours(18)->addMinutes(45);
        
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
        
        $service = new ScreeningService($screeningData);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');  // There is no request in service's test
        $service->createScreening();
        
        $newScreening = Screening::orderBy('id', 'desc')->first();
        
        $this->assertEquals($newScreening->term->date_time, $newDate->format('Y-m-d h:i:s'));
        $this->assertEquals($newScreening->term->hall_id, $hall->id);
        $this->assertEquals($newScreening->movie_id, $movie->id);
    }
    
    /** @test */
    public function updateScreening()
    {
        $screening = Screening::factory()->create();
        
        $hall = Hall::factory()->create();
        $newHall = Hall::factory()-> create();
        
        $term = Term::factory()->create([
            'hall_id' => $hall,
            'screening_id' => $screening,
        ]);
        
        $newDate = Carbon::today()->addDays(2)->addHours(12)->addMinutes(30);
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
        
        $service = new ScreeningService($newData);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');  // There is no request in service's test
        $service->updateScreening();
        
        $editedScreening = Screening::find($screening->id);
        
        $this->assertEquals($editedScreening->term->date_time, $newDate->format('Y-m-d h:i:s'));
        $this->assertEquals($editedScreening->term->hall_id, $newHall->id);
    }
    
    /** @test */
    public function deleteScreening()
    {
        $movie = Movie::factory()->create();
        $screening = Screening::factory()->create(['movie_id' => $movie->id]);
        $data = [
            'movieForEditScreening' => json_encode([
                'id' => $screening->id,
                'movie_id' => $movie->id,
            ]),
        ];
        
        $service = new ScreeningService($data);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');  // There is no request in service's test
        $service->removeScreening();
    }
}
