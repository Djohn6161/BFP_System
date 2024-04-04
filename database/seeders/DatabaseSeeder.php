<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Report;
use App\Models\Station;
use App\Models\Truck;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\BarangaySeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PersonnelSeeder;

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
        $this->call([
            PersonnelSeeder::class,
            BarangaySeeder::class,
        ]);
        Truck::factory()->create([
            'name' => 'Truckun',
            'plate_num' => 'F1R3 5T4T10N',

        ]);
        Report::factory()->create([
            'team_leaders_id' => '1',
            'drivers_id' => '1',
            'trucks_id' => '1',
            'Barangays_id' => '1',
            'category' => 'Operation',
            'type' => 'Vehicular Accident',
            'time_of_departure' => '2024-04-02 05:23:42',
            'time_of_arrival_to_scene' => '2024-04-02 05:23:42',
            'time_of_arrival_to_station' => '2024-04-02 05:23:42',
            'name' => 'Bungoan',
        ]);
        Report::factory()->create([
            'team_leaders_id' => '1',
            'drivers_id' => '1',
            'trucks_id' => '1',
            'Barangays_id' => '1',
            'category' => 'Investigation',
            'type' => 'Fire Incident',
            'time_of_departure' => '2024-04-02 05:23:42',
            'time_of_arrival_to_scene' => '2024-04-02 05:23:42',
            'time_of_arrival_to_station' => '2024-04-02 05:23:42',
            'name' => 'Sunog sa Edsa',
        ]);
    }
}
