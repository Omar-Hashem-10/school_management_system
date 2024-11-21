<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'admin',
                'for' => 'admins',
            ],
            [
                'role_name' => 'manager',
                'for' => 'admins',
            ],
            [
                'role_name' => 'teacher',
                'for' => 'admins',
            ],
            [
                'role_name' => 'student',
                'for' => 'admins',
            ],
        ]);
    }
}