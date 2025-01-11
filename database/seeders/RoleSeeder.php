<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date_now = Carbon::now();

        Role::insert([
            ['name' => 'Admin', 'description' => 'Has full access to manage the system.', 'created_at' => $date_now, 'updated_at' => $date_now],
        ]);
    }
}
