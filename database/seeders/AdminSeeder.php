<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
                'salary' => 5000,
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'role_id' => 2,
                'salary' => 7000,
                'created_at' => now(),
            ],
        ]);
    }
}
