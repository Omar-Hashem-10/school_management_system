<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            ['user_id' => 1,
            'role_id' => 6,
            'created_at' => now(),],
            ['user_id' => 2,
            'role_id' => 7,
            'created_at' => now(),]
        ]            
        );
    }
}