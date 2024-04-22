<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AforSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $date = $faker->dateTime();
            $stringDate = $date->format('Y-m-d H:i:s');
            $td_declared_fireout = clone $date;

            $attributes = [
                'alarm_received' => $faker->time('H:i') . 'H',
                'transmitted_by' => $faker->numberBetween(1, 16),
                'caller_address' => $faker->address(),
                'location' => $faker->address(),
                'received_by' => $faker->numberBetween(1, 16),
                'td_under_control' => $stringDate,
                'td_declared_fireout' => $td_declared_fireout,
                'occupancy' => $faker->randomElement(['s', 'ns', 'v']),
                'occupancy_specify' => '',
                'distance_to_fire_incident' => '7 kilometers',
                'structure_description' => $faker->paragraph(),
                'sketch_of_fire_operation' => '',
                'details' => $faker->paragraph(),
                'problem_encounter' => $faker->paragraph(),
                'observation_recommendation' => $faker->paragraph(),
                'alarm_status_arrival' => '',
                'first_responder' => '',
            ];

            $reportID = DB::table('afors')->insertGetId($attributes);

            $date = $faker->dateTime();
            $formatted_date = $date->format('Y-m-d H:i') . 'H';

            foreach (range(1, 3) as $index) {

                $formatted_added_date = clone $date;
                $formatted_added_date->modify('+1 hour');
                $formatted_added_date_string = date('Y-m-d H:i', $formatted_added_date->getTimestamp());


                $return_date = clone $formatted_added_date;
                $return_date->modify('+2 hour');
                $return_date_string = date('Y-m-d H:i', $return_date->getTimestamp());
                
                $response_duration = $formatted_added_date_string . '-' . 
                $return_date_string;

                $attributes = [
                    'afor_id' => $reportID,
                    'engine_dispatched' => $index,
                    'time_dispatched' => $formatted_date,
                    'time_arrived_at_scene' => $formatted_added_date,
                    'response_duration' => $response_duration,
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
    }
}
