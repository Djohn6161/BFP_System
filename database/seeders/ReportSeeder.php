<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {

            $startDateTime = $faker->dateTime();

            $midDateTime = clone $startDateTime;
            $midDateTime->modify('+30 minutes');

            $endDate = clone $startDateTime;
            $endDate->modify('+5 hours');

            $attributes = [
                'team_leaders_id' => $faker->numberBetween(1, 16),
                'drivers_id' => $faker->numberBetween(1, 16),
                'trucks_id' => $faker->numberBetween(1, 4),
                'barangays_id' => $faker->numberBetween(1, 56),
                'category' => $faker->randomElement(['Operation', 'Investigation']),
                'type' => $faker->randomElement(['Fire Incident', 'Vehicular Accident', 'Non-Emergency Response']),
                'time_of_departure' => $startDateTime,
                'time_of_arrival_to_scene' => $midDateTime,
                'time_of_arrival_to_station' => $endDate,
                'name' => $faker->randomElement(['Blaze Inferno at Industrial Park','Ember Outbreak in Downtown District','
                Flame Fury at Residential Complex' ,'Pyre Catastrophe in Forest Reserve','Inferno Rampage at Historical Landmark', 'Investigation']),
                // 'vi'
            ];

            $reportID = DB::table('reports')->insertGetId($attributes);

            foreach (range(1, 8) as $index){

                $attributes = [
                    'report_id' => $reportID,
                    'personnel_id' => $faker->numberBetween(1,16),
                ];
    
                DB::table('crews')->insert($attributes);
            }

            foreach (range(1, 5) as $index){

                $attributes = [
                    'report_id' => $reportID,
                    'name' => $faker->firstName . ' ' . $faker->lastName,
                ];
    
                DB::table('victims')->insert($attributes);
            }
        }
    }
}
