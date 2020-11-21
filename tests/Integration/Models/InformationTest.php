<?php


namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Information;
use Exception;

class InformationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function contentLengthValidation()
    {
        $info = new Information([
            'place' => 'homepage_top',
            'max_length' => 5,
            'content' => '123456'
        ]);
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Content is too long.');
        
        $info->save();
    }
}