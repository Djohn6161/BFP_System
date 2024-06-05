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
                'name' => 'Chief',
                'username' => 'chief',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'chief',
                'picture' => 'default.png',
            ],   
            [
                'name' => 'Configuration Cheif',
                'username' => 'configuration_cheif',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'configuration_cheif',
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
                'name' => 'Admin Cheif',
                'username' => 'admin_cheif',
                'password' => Hash::make('12341234'),
                'type' => 'admin',
                'privilege' => 'admin_cheif',
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
                'type' => 'OC',
                'action' => 'update',
                'code' => 'update1234'
            ],
            [
                'type' => 'OC',
                'action' => 'delete',
                'code' => 'delete1234'
            ],
            // Investigation
            [
                'type' => 'IC',
                'action' => 'update',
                'code' => 'update1234'
            ],
            [
                'type' => 'IC',
                'action' => 'delete',
                'code' => 'delete1234'
            ],

        ];

        // Insert data into the 'users' table
        DB::table('users')->insert($users);
        DB::table('passcodes')->insert($passcodes);


        

    }
}
