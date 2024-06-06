<?php

namespace Database\Seeders;

use App\Models\Truck;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AforSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            $date = $faker->dateTime();
            $zone = 'Zone 1';
            $barangay = 'Amtic';
            $location = 'Mayon';
            $full_location = 'Location: ' . $zone . ' ' . 'Brgy: ' . $barangay . ' Ligao City ' . 'Landmark / Other location: ' . $location;

            $attributes = [
                'alarm_received' => $faker->time('H:i') . 'H',
                'transmitted_by' => $faker->firstName . ' ' . $faker->lastName,
                'caller_address' => 'Ligao City',
                'barangay_name' => 'Amtic',
                'zone' => 'Zone 1',
                'location' => 'Mayon',
                'full_location' => $full_location,
                'blotter_number' => 'OPT2024_' . $index,
                'received_by' => $faker->numberBetween(1, 16),
                'td_under_control' => null,
                'td_declared_fireout' => null,
                'sketch_of_fire_operation' => 'sample - Copy.jpg,sample.jpg',
                'details' => $faker->paragraph(),
                'problem_encounter' => $faker->paragraph(),
                'observation_recommendation' => $faker->paragraph(),
                'alarm_status_arrival' => '1st Alarm',
                'first_responder' => 'First',
                'prepared_by' => '',
                'noted_by' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $reportID = DB::table('afors')->insertGetId($attributes);

            // Occupancies
            $attributes = [
                'afor_id' => $reportID,
                'occupancy_name' => 'Places of Assembly',
                'type' => 'Structural',
                'specify' => 'park',
                'distance' => '1km',
                'description' => 'description',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            DB::table('occupancies')->insert($attributes);

            // Afor Casualties
            $attributes = [
                'afor_id' => $reportID,
                'type' => 1,
                'injured' => 1,
                'death' => 1,
                'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ];

            DB::table('afor_casualties')->insert($attributes);

            $attributes = [
                'afor_id' => $reportID,
                'type' => 2,
                'injured' => 1,
                'death' => 1,
                'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ];

            DB::table('afor_casualties')->insert($attributes);

            // Responses
            $date = $faker->dateTime();
            $formatted_date = $date->format('H:i') . 'H';
            $truckNames = Truck::pluck('name')->toArray();

            foreach (range(1, 2) as $index) {

                $formatted_added_date = clone $date;
                $formatted_added_date->modify('+1 hour');
                $formatted_added_date_string = date('H:i', $formatted_added_date->getTimestamp()) . 'H';

                $return_date = clone $formatted_added_date;
                $return_date->modify('+2 hour');
                $return_date_string = date('H:i', $return_date->getTimestamp()) . 'H';

                $response_duration = $formatted_added_date_string . '-' .
                    $return_date_string;

                $attributes = [
                    'afor_id' => $reportID,
                    'engine_dispatched' => $truckNames[$index],
                    'time_dispatched' => $formatted_date,
                    'time_arrived_at_scene' => $formatted_added_date_string,
                    'response_duration' => $response_duration,
                    'time_return_to_base' => $return_date_string,
                    'water_tank_refilled' => '1000',
                    'gas_consumed' => '50L',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('responses')->insert($attributes);
            }

            // Declared Alarms
            foreach (range(1, 2) as $index) {
                $attributes = [
                    'afor_id' => $reportID,
                    'alarm_name' => $faker->randomElement(['1st Alarm', '2nd Alarm', '3rd Alarm', '4th Alarm', '5th Alarm']),
                    'time' => '2400H',
                    'ground_commander' => $faker->numberBetween(1, 16),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('declared_alarms')->insert($attributes);
            }

            // Breathing equipment
            foreach (range(1, 2) as $index) {
                $attributes = [
                    'afor_id' => $reportID,
                    'quantity' => 1,
                    'category' => 'breathing apparatus',
                    'type' => $faker->word(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('used_equipments')->insert($attributes);
            }

            // Extinguishing Agent
            foreach (range(1, 2) as $index) {
                $attributes = [
                    'afor_id' => $reportID,
                    'quantity' => 1,
                    'category' => 'extinguishing agent',
                    'type' => $faker->word(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('used_equipments')->insert($attributes);
            }

            // Rope and Ladder
            foreach (range(1, 2) as $index) {
                $attributes = [
                    'afor_id' => $reportID,
                    'category' => 'rope and ladder',
                    'type' => $faker->word(),
                    'length' => '1ft',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('used_equipments')->insert($attributes);
            }

            // Hose line
            foreach (range(1, 2) as $index) {
                $attributes = [
                    'afor_id' => $reportID,
                    'category' => 'hose line',
                    'quantity' => 1,
                    'type' => $faker->word(),
                    'length' => '1ft',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('used_equipments')->insert($attributes);
            }

            // Duty Personnel
            foreach (range(1, 2) as $index) {
                $attributes = [
                    'afor_id' => $reportID,
                    'personnels_id' => $faker->numberBetween(1, 16),
                    'remarks' => 'remarks',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('afor_duty_personnels')->insert($attributes);
            }
        }
    }
}
