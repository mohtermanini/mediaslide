<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserStatusSeeder::class,
            UserSeeder::class,
        ]);

        if (app()->environment(['local', 'staging'])) {
            $this->call([
                CategorySeeder::class,
                CustomerUserSeeder::class,
                FashionModelSeeder::class,
                BookingSeeder::class,
            ]);
        }
    }
}
