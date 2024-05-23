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
                'username' => 'admin',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'All',
                'picture' => 'default.png',
            ],      

            // User
            [
                'name' => 'user AC',
                'username' => 'user1',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'AC',
                'picture' => 'default.png',
            ],
            [
                'name' => 'user IC',
                'username' => 'user2',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'IC',
                'picture' => 'default.png',
            ],
            [
                'name' => 'user OC',
                'username' => 'user3',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'OC',
                'picture' => 'default.png',
            ],

        ];

        // Insert data into the 'users' table
        DB::table('users')->insert($users);

        

    }
}
