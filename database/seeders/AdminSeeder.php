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
            ['admin_name' => 'Admin',
            'email' => 'Admin@app.com',
            'phone' => '01015616884',
            'user_id' => 1,
            'role_id' => 1,
            'created_at' => now(),],
            ['admin_name' => 'Manager',
            'email' => 'Manager@app.com',
            'phone' => '01227863734',
            'user_id' => 2,
            'role_id' => 2,
            'created_at' => now(),]
        ]            
        );
    }
}