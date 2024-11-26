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
            'first_name' => 'Admin',
            'last_name' => 'Ben Admin',
            'email' => 'admin@app.com',
            'phone'=>"01015616884",
            'type'=>'admin',
            'gender'=>'male',
            'password' => Hash::make('123456789'),
            'role_id' => 1,
        ]);
        \App\Models\User::factory()->create([
            'first_name' => 'manager',
            'last_name' => 'Ben manager',
            'email' => 'manager@app.com',
            'phone'=>"01015616884",
            'type'=>'admin',
            'gender'=>'male',
            'password' => Hash::make('123456789'),
            'role_id' => 2,
        ]);
        \App\Models\User::factory()->create([
            'first_name' => 'teacher',
            'last_name' => 'Ben teacher',
            'email' => 'teacher@app.com',
            'phone'=>"01015616884",
            'type'=>'teacher',
            'gender'=>'male',
            'password' => Hash::make('123456789'),
            'role_id' => 3,
        ]);
        \App\Models\User::factory()->create([
            'first_name' => 'student',
            'last_name' => 'Ben student',
            'email' => 'student@app.com',
            'phone'=>"01015616884",
            'type'=>'student',
            'gender'=>'male',
            'password' => Hash::make('123456789'),
            'role_id' => 4,
        ]);
    }
}
