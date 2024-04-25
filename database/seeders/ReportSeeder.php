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
            $date = $faker->dateTime();
            $td_declared_fireout = clone $date;

            $attributes = [
                'alarm_received' => $faker->time('H:i') . 'H',
                'transmitted_by' => $faker->numberBetween(1, 16),
                'caller_address' => $faker->address(),
                'location' => $faker->address(),
                'td_under_control' => $date,
                'td_declared_fireout' => $td_declared_fireout,
                'occupancy' => $faker->randomElement(['s', 'ns', 'v']),
                'distance_to_fire_incident' => '7 kilometers',
                'structure_description' => $faker->paragraph(),
                'details' => $faker->paragraph(),
                'problem_encounter' => $faker->paragraph(),
                'observation_recommendation' => $faker->paragraph(),
                'sketch_of_fire_operation' => ''
            ];

            $reportID = DB::table('afor')->insertGetId($attributes);

            $date = $faker->dateTime();
            $formatted_date = $date->format('Y-m-d H:i') . 'H';

            foreach (range(1, 3) as $index) {

                $formatted_added_date = clone $date;
                $formatted_added_date->modify('+1 hour');
                $formatted_added_date->format('Y-m-d H:i') . 'H';

                $return_date = clone $formatted_added_date;
                $return_date->modify('+2 hour');
                $return_date->format('Y-m-d H:i') . 'H';

                $attributes = [
                    'afor_id' => $reportID,
                    'engine_dispatched' => $index,
                    'time_dispatched' => $formatted_date,
                    'time_arrived_at_scene' => $formatted_added_date,
                    'response_duration' => $formatted_date . '-' . $formatted_added_date,
                    'time_return_to_base' => $return_date,
                    'water_tank_refilled' => '1000',
                    'gas_consumed' => '50L'
                ];

                DB::table('responses')->insert($attributes);

            }

            foreach (range(1, 3) as $index) {
                $attributes = [
                    'afor_id' => $reportID,
                    'quantity' => $faker->numberBetween(1,3),
                    'category' => $faker->randomElement(['extinguishing agent','rope and ladder','breathing apparatus','hose line']),
                    'type' => $faker->word(),
                    'length' => '5 feet',
                ];
                
                DB::table('used_equipments')->insert($attributes);
            }
            
            $attributes = [
                'afor_id' => $reportID,
                'quantity' => $faker->numberBetween(1,3),
                'category' => $faker->randomElement(['extinguishing agent','rope and ladder','breathing apparatus','hose line']),
                'type' => $faker->word(),
                'length' => '5 feet',
            ];
            
            DB::table('used_equipments')->insert($attributes);

        }

        // DB::table('crews')->insert($attributes);


        // foreach (range(1, 10) as $index) {

        //     $startDateTime = $faker->dateTime();

        //     $midDateTime = clone $startDateTime;
        //     $midDateTime->modify('+30 minutes');

        //     $endDate = clone $startDateTime;
        //     $endDate->modify('+5 hours');

        //     $attributes = [
        //         'team_leaders_id' => $faker->numberBetween(1, 16),
        //         'drivers_id' => $faker->numberBetween(1, 16),
        //         'trucks_id' => $faker->numberBetween(1, 4),
        //         'category' => $faker->randomElement(['Operation', 'Investigation']),
        //         'type' => $faker->randomElement(['Fire Incident', 'Vehicular Accident', 'Non-Emergency Response']),
        //         'time_of_departure' => $startDateTime,
        //         'time_of_arrival_to_scene' => $midDateTime,
        //         'time_of_arrival_to_station' => $endDate,
        //         'name' => $faker->randomElement([
        //             'Blaze Inferno at Industrial Park',
        //             'Ember Outbreak in Downtown District', '
        //         Flame Fury at Residential Complex',
        //             'Pyre Catastrophe in Forest Reserve',
        //             'Inferno Rampage at Historical Landmark',
        //             'Investigation'
        //         ]),
        //     ];

        //     $reportID = DB::table('reports')->insertGetId($attributes);

        //     foreach (range(1, 8) as $index) {

        //         $attributes = [
        //             'report_id' => $reportID,
        //             'personnel_id' => $faker->numberBetween(1, 16),
        //         ];

        //         DB::table('crews')->insert($attributes);
        //     }

        //     foreach (range(1, 5) as $index) {

        //         $attributes = [
        //             'report_id' => $reportID,
        //             'name' => $faker->firstName . ' ' . $faker->lastName,
        //         ];

        //         DB::table('victims')->insert($attributes);
        //     }

        //     $attributes = [
        //         'report_id' => $reportID,
        //         'type' => $faker->randomElement(['civilian','firefighters']),
        //         'injured' => 0,
        //         'death' => 0,
        //     ];

        //     DB::table('afor_casualties')->insert($attributes);
        // }
    }
}
