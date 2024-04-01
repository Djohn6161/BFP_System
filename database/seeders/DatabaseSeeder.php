<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //     \App\Models\User::factory()->create(
        //     [
        //         'name' => 'admin',
        //         'type' => 'admin',
        //         'email' => 'admin@gmail.com',
        //     ],
        //     [
        //         'name' => 'user',
        //         'type' => 'user',
        //         'email' => 'user@gmail.com',
        //     ],
        // );
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'type' => 'admin',
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'type' => 'user',
            ],
        ];

        // Insert data into the 'users' table
        DB::table('users')->insert($users);
    }
}
