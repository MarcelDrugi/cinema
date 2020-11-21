<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Information;

class InformationTest extends NoPermissionRedirect
{
    use RefreshDatabase;
    
    protected $url = '/information';
    protected $correctRole = 'employee';
    protected $incorrectRole = 'customer';
    
    /** @test */
    public function getRedirectNotLoggedInUser()
    {
        parent::getRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function putRedirectNotLoggedInUser()
    {
        parent::postRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function getRedirectUserWithoutPermission()
    {
        parent::getRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function putRedirectUserWithoutPermission()
    {
        parent::postRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function updateInfo()
    {
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $info = Information::factory()->create();
        
        $body = [
            'content' => 'Some new content',
            'infoSelect' => json_encode( ['place' => $info->place]),
        ];
        
        $response = $this->actingAs($user)->put($this->url, $body);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        $response->assertSessionHas('infoModified', $info->place);
        
        $updatedInfo = Information::find($info->id);
        
        $this->assertEquals($updatedInfo->content, $body['content']);
    }
}
