<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
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
                'name' => 'Chief',
                'username' => 'chief',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'chief',
                'picture' => 'default.png',
            ],   
            [
                'name' => 'Configuration Chief',
                'username' => 'configuration_chief',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'configuration_chief',
                'picture' => 'default.png',
            ],     
            
            [
                'name' => 'Operation Admin Chief',
                'username' => 'operation_admin_chief',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'operation_admin_chief',
                'picture' => 'default.png',
            ],   

            [
                'name' => 'Investigation Admin Chief',
                'username' => 'admin',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'investigation_admin_chief',
                'picture' => 'default.png',
            ],   

            [
                'name' => 'Admin Chief',
                'username' => 'admin_chief',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'admin_chief',
                'picture' => 'default.png',
            ], 

            // User
            [
                'name' => 'Investigation Clerk',
                'username' => 'investigation_clerk',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'investigation_clerk',
                'picture' => 'default.png',
            ],
            [
                'name' => 'Operation Clerk',
                'username' => 'operation_clerk',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'operation_clerk',
                'picture' => 'default.png',
            ],
            [
                'name' => 'Admin Clerk',
                'username' => 'admin_clerk',
                'password' => Hash::make('12341234'),
                'type' => 'user',
                'privilege' => 'admin_clerk',
                'picture' => 'default.png',
            ],

        ];

        $passcodes = [
            
            //Operation
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],
            [

                'creators_id' => 1,
                'code' => Str::upper(Str::random(20)),
                'status' => true,
                'users_id' => 2,
            ],

        ];

        // Insert data into the 'users' table
        DB::table('users')->insert($users);
        DB::table('passcodes')->insert($passcodes);


        

    }
}
