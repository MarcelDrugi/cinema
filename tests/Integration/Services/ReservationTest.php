<?php


namespace Tests\Integration;

use App\Models\Pricing;
use App\Models\Screening;
use App\Models\Term;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Carbon\Carbon;
use App\Services\ReservationService;
use App\Models\Discount;
use App\Models\Reservation;

class ReservationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function createContext()
    {
        $user = User::factory()->create();
        Auth::loginUsingId($user->id, TRUE);
        
        $discount = Discount::factory()->create(['user_id' => $user->id]);
        
        $screening = Screening::factory()->create();
        Term::factory()->for(Pricing::factory()->state(['week_day' => 'Friday']))->create([
            'screening_id' => $screening->id,
            'date_time' => Carbon::now()->addDays(3),
        ]);
        
        $toPay = 84.95;
        $sumOfTickets = 5; 
        $discountId = $discount->id;
        
        $service = new ReservationService($screening->id, $toPay, $sumOfTickets, $discountId);
        $service->createReservation();
        
        $reservation = Reservation::orderBy('id', 'desc')->first();  // reservation created in service
        $this->assertEquals($reservation->screening_id, $screening->id);
        $this->assertEquals($reservation->user_id, $user->id);
        $this->assertEquals($reservation->price, $toPay);
        $this->assertEquals($reservation->tickets_number, $sumOfTickets);
        
        $modifiedScreening = Screening::find($screening->id);  // take the same screening modified by service 
        $this->assertEquals($modifiedScreening->viewers, $screening->viewers + $sumOfTickets);
    }
    
    /** @test */
    public function removeDiscount()
    {
        $user = User::factory()->create();
        $discount = Discount::factory()->create(['user_id' => $user->id]);
        
        $service = new ReservationService(null, null, null, $discount->id);
        $service->removeDiscount();
        
        $discount = Discount::all();
        $this->assertEquals($discount->count(), 0);
    }
}
