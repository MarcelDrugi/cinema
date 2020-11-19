<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Discount;

class DiscountTest extends NoPermissionRedirect
{
    use RefreshDatabase;
    
    protected $url = '/discount';
    protected $correctRole = 'employee';
    protected $incorrectRole = 'customer';
    
    /** @test */
    public function getRedirectNotLoggedInUser()
    {
        parent::getRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function postRedirectNotLoggedInUser()
    {
        parent::postRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function deleteRedirectNotLoggedInUser()
    {
        $this->url .= '/delete';
        parent::deleteRedirectNotLoggedInUser();
    }
    
    /** @test */
    public function getRedirectUserWithoutPermission()
    {
        parent::getRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function postRedirectUserWithoutPermission()
    {
        parent::postRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function deleteRedirectUserWithoutPermission()
    {
        $this->url .= '/delete';
        parent::deleteRedirectUserWithoutPermission();
    }
    
    /** @test */
    public function createDiscountForCustomer()
    {
        $customer = User::factory()->make();
        $customer->assignRole('customer');
        $customer->save();
        
        $newDiscountData = [
            'value' => 10,
            'customerSelect' => $customer->id,
        ];
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->post($this->url, $newDiscountData);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        
        $discount = Discount::orderBy('id', 'desc')->first();
        
        $response->assertSessionHas('newDiscount', $discount->id);
        $this->assertEquals($discount->value, $newDiscountData['value']/100);
        $this->assertEquals($discount->user_id, $customer->id);
    }
    
    /** @test */
    public function createFreeDiscount()
    {
        $newDiscountData = ['value' => 25];
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $response = $this->actingAs($user)->post($this->url, $newDiscountData);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        
        $discount = Discount::orderBy('id', 'desc')->first();
        
        $response->assertSessionHas('newDiscount', $discount->id);
        $this->assertEquals($discount->value, $newDiscountData['value']/100);
        $this->assertEquals($discount->user_id, null);
    }
    
    /** @test */
    public function removeDiscount()
    {
        $discount = Discount::factory()->create();
        
        $user = User::factory()->make();
        $user->assignRole('employee');
        $user->save();
        
        $data = [
            'selectDiscount' => json_encode(['id' => $discount->id]),
        ];
        
        $response = $this->actingAs($user)->delete($this->url . '/delete', $data);
        $response->assertStatus(302);
        $response->assertRedirect($this->url);
        
        $discounts = Discount::all();
        $removedDiscount = Discount::find($discount->id);
        
        $response->assertSessionHas('deletedDiscount', $discount->code);
        $this->assertEquals($discounts->count(), 0);
        $this->assertEquals($removedDiscount, null);
    }
    
}
