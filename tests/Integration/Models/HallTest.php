<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Hall;
use App\Models\Term;

class HallTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function relationWithTerm()
    {
        $term = Term::factory()->for(Hall::factory())->create();
        $hall = Hall::orderBy('id', 'desc')->first();
        
        $this->assertEquals($term->id, $hall->terms[0]->id);
    }
}