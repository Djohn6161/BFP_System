<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            // Admin
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'All',
            ],      

            // User
            [
                'name' => 'user IC',
                'email' => 'user1@example.com',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'IC',
            ],

            [
                'name' => 'user OC',
                'email' => 'user2@example.com',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'OC',
            ],

        ];

        // Insert data into the 'users' table
        DB::table('users')->insert($users);
    }
}
