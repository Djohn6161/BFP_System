<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class occupancyNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $names = [   
            [
                'name' => 'Places of Assembly',
            ],      
            [
                'name' => 'Educational Occupancy',
            ],
            [
                'name' => 'Day Care Occupancy',
            ],
            [
                'name' => 'Health Care Occupancy',
            ],
            [
                'name' => 'Residential Board and Care',
            ],
            [
                'name' => 'Detention and Correctional Occupancy',
            ],
            [
                'name' => 'Residential Occupancy',
            ],
            [
                'name' => 'Mercantile Occupancy',
            ],
            [
                'name' => 'Business Occupancy',
            ],
            [
                'name' => 'Industrial Occupancy',
            ],
            [
                'name' => 'Storage Occupancy',
            ],
            [
                'name' => 'Special Structures',
            ],
        ];

        DB::table('Occupancy_names')->insert($names);
    }
}
