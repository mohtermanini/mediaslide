<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date_now = Carbon::now();

        UserStatus::insert([
            ['name' => 'Active', 'description' => 'The user is active and can use the system.', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['name' => 'In-Active', 'description' => 'The user account is inactive and cannot log in.', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['name' => 'Blocked', 'description' => 'The user is blocked due to violations or administrative actions.', 'created_at' => $date_now, 'updated_at' => $date_now],
        ]);
    }
}
