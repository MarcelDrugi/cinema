<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\Services\RepertoireService;
use function PHPUnit\Framework\assertGreaterThanOrEqual;

class RepertoireTest extends TestCase
{
    
    /** @test */
    public function createContext()
    {
        $days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];
        
        $service = new RepertoireService();
        $daysFromService = $service->weekDays();
        
        $this->assertEquals(7, count($daysFromService));
        foreach ($daysFromService as $key => $value) {
            $this->assertLessThanOrEqual(7, $key);
            $this>assertGreaterThanOrEqual(0, $key);
            $this->assertTrue(in_array($value, $days));
        }
    }
}
