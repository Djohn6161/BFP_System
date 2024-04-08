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

        Station::factory()->create([
            'name' => 'Bureau of Fire Protection Ligao City'
        ]);

        $this->call([
            UserSeeder::class,
            DepartmentSeeder::class,
            TruckSeeder::class,
            RankSeeder::class,
            PersonnelSeeder::class,
            BarangaySeeder::class,
            ReportSeeder::class,
        ]);
    }
}
