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
                // 'departments_id' => $faker->numberBetween(1, 3),
                'designation_id' => $faker->numberBetween(1, 49),
                'ranks_id' => $faker->numberBetween(1, 13),
                'account_number' => 101010,
                'item_number' => 12,
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'date_of_birth' => $faker->date(),
                'gender' => 'male',
                'address' => 'Ligao City',
                'picture' => 'default.png',
                'maritam_status' => 'single',
                'religion' => 'Catholic',
                'tin' => '111',
                'gsis' => '111',
                'pagibig' => '11',
                'philhealth' => '111',
                'highest_eligibility' => 'highest',
                'highest_training' => 'training',
                'specialized_training' => 'specialized',
                'mode_of_entry' => 'mode',
                'appointment_status' => 'status',
                'unit_code' => '123',
                'unit_assignment' => 'asiignment',
                'designation' => 'destination',
                'admin_operation_remarks' => 'remarks',
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
