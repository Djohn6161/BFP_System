<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigurationLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Sample data for seeding
        $data = [
            [
                'userID' => 1,
                'Details' => 'Updated occupancy status',
                'type' => 'occupancy',
                'action' => 'Update',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'userID' => 2,
                'Details' => 'Barangay details added',
                'type' => 'barangay',
                'action' => 'Store',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'userID' => 3,
                'Details' => 'Alarm status changed',
                'type' => 'alarm',
                'action' => 'Update',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'userID' => 3,
                'Details' => 'Truck information updated',
                'type' => 'truck',
                'action' => 'Update',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'userID' => 4,
                'Details' => 'Rank details modified',
                'type' => 'rank',
                'action' => 'Update',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('configuration_logs')->insert($data);
    }
}
