<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Screening;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            MovieSeeder::class,
            ScreeningSeeder::class,
            HallSeeder::class,
            PricingSeeder::class,
            TermSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            DiscountSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
