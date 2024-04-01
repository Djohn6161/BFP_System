<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Station;
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

        \App\Models\User::factory()->create([
            'name' => 'User1',
            'email' => 'User1@example.com',
            'password' => bcrypt('111'),
            'type' => 'user'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@example.com',
            'password' => bcrypt('111'),
            'type' => 'admin'
        ]);
        Station::factory()->create([
            'name' => 'Bureau of Fire Protection Ligao City'
        ]);
    }
}
