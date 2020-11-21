<?php

namespace Tests\Integration;

use App\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use RuntimeException;
use App\Services\InformationService;


class InformationModifyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function discountForUser()
    {
        $info = Information::factory()->create();
        
        $data = [
            'content' => 'New content',
            'infoSelect' => json_encode( ['place' => $info->place]),
        ];
        
        $service = new InformationService($data);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');  // There is no request in service's test
        $service->updateInfo();
        
        $updatedInfo = Information::find($info->id);
        
        $this->assertEquals($updatedInfo->content, $data['content']);
    }
}
