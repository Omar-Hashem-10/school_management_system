<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => '123456789',
            'role_id' => 1,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'Manager@app.com',
            'password' => '123456789',
            'role_id' => 2,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Teacher',
            'email' => 'Teacher@app.com',
            'password' => '123456789',
            'role_id' => 3,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Student',
            'email' => 'Student@app.com',
            'password' => '123456789',
            'role_id' => 4,
        ]);
    }
}
