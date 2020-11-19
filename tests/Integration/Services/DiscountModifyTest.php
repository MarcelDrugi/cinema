<?php

namespace Tests\Integration;

use App\Models\Discount;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use RuntimeException;
use App\Services\DiscountService;


class DiscountModifyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function discountForUser()
    {
        $user = User::factory()->make();
        $user->assignRole('customer');
        $user->save();
        
        $newDiscountData = [
            'value' => 10,
            'customerSelect' => $user->id,
        ];
        
        $service = new DiscountService($newDiscountData);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');  // There is no request in service's test
        $service->createDiscount();
        
        $discount = Discount::orderBy('id', 'desc')->first();
        
        $this->assertEquals($discount->value, $newDiscountData['value']/100);
        $this->assertEquals($discount->user_id, $user->id);
    }
    
    /** @test */
    public function freeDiscount()
    {
        $newDiscountData = [
            'value' => 10,
        ];
        
        $service = new DiscountService($newDiscountData);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');
        $service->createDiscount();
        
        $discount = Discount::orderBy('id', 'desc')->first();
        
        $this->assertEquals($discount->value, $newDiscountData['value']/100);
        $this->assertEquals($discount->user_id, null);
    }
    
    /** @test */
    public function updateScreening()
    {
        $discount = Discount::factory()->create();
        
        $data = [
            'selectDiscount' => json_encode(['id' => $discount->id]),
        ];
        
        $service = new DiscountService($data);
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Session store not set on request.');
        $service->delDiscount();
        
        $discounts = Discount::all();
        $removedDiscount = Discount::find($discount->id);
        
        $this->assertEquals($discounts->count(), 0);
        $this->assertEquals($removedDiscount, null);
        
    }
}
