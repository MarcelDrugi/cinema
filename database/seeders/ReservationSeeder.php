<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        $reservation = new Reservation([
            'screening_id' => 2,
            'user_id' => 1,
            'payment_status' => true,
            'price' => 40,
            'tickets_number' => 2,
        ]);
        $reservation->save();
    }
}
