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
            [
                'name' => 'Apartment Building',
            ],
            [
                'name' => 'Condominiums',
            ],
            [
                'name' => 'Dormitory',
            ],
            [
                'name' => 'Hotel',
            ],
            [
                'name' => 'Lodging and Rooming Houses',
            ],
            [
                'name' => 'Single and Two Family Dwelling',
            ],
            [
                'name' => 'Mixed Occupancies',
            ],
            [
                'name' => 'Agricultural Land',
            ],
            [
                'name' => 'Ambulant Vendor',
            ],
            [
                'name' => 'Electrical Post Fire',
            ],
            [
                'name' => 'Forest Fire',
            ],
            [
                'name' => 'Grass Fire',
            ],
            [
                'name' => 'Rubbish Fire',
            ],
            [
                'name' => 'Brush Fire',
            ],
            [
                'name' => 'Automobile',
            ],
            [
                'name' => 'Bus',
            ],
            [
                'name' => 'Jeepney',
            ],
            [
                'name' => 'Motorcycle',
            ],
            [
                'name' => 'Tricycle',
            ],
            [
                'name' => 'Truck',
            ],
            [
                'name' => 'Heavy Equipment',
            ],
            [
                'name' => 'Ship/Water Vessel',
            ],
            [
                'name' => 'Aircraft',
            ],
            [
                'name' => 'Locomotive',
            ],
            [
                'name' => 'Hybrid and Electric Vehicle',
            ],
        ];

        DB::table('Occupancy_names')->insert($names);
    }
}
