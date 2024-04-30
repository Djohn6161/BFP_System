<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 16) as $index) {

            $attributes = [
                'departments_id' => $faker->numberBetween(1, 3),
                'ranks_id' => $faker->numberBetween(1, 13),
                'account_number' => 101010,
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'date_of_birth' => $faker->date(),
                'gender' => 'male',
                'address' => 'Ligao City',
                'picture' => 'sir sample.jpg',
                'maritam_status' => '',
                'religion' => '',
                'tin' => '',
                'gsis' => '',
                'pagibig' => '',
                'philhealth' => '',
                'highest_eligibility' => '',
                'highest_training' => '',
                'specialized_training' => '',
                'mode_of_entry' => '',
                'appointment_status' => '',
                'unit_code' => '',
                'unit_assignment' => '',
                'designation' => '',
                'admin_operation_remarks' => '',
            ];

            $personnel_id = DB::table('personnels')->insertGetId($attributes);
            $count = 0;

            foreach (range(1, 2) as $index) {

                $count++;
                $attributes = [
                    'personnel_id' => $personnel_id,
                    'name' => 'tertiary' . $count,
                ];

                DB::table('tertiaries')->insert($attributes);

            }

            foreach (range(1, 2) as $index) {

                $count++;
                $attributes = [
                    'personnel_id' => $personnel_id,
                    'name' => 'course' . $count,
                ];

                DB::table('post_graduate_courses')->insert($attributes);

            }
        }
    }
}
