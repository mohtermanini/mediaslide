<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('bookings')->insert([
            [
                'customer_name' => $faker->firstName(),
                'fashion_model_id' => 1,
                'booking_date' => now()->subDays(20),
            ],
            [
                'customer_name' => $faker->firstName(),
                'fashion_model_id' => 1,
                'booking_date' => now()->addMonth(),
            ],
            [
                'customer_name' => $faker->firstName(),
                'fashion_model_id' => 2,
                'booking_date' => now()->addWeeks(2),
            ],
            [
                'customer_name' => $faker->firstName(),
                'fashion_model_id' => 1,
                'booking_date' => now()->addWeek(),
            ],
        ]);
    }
}
