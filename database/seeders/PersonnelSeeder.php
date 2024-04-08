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
            'departments_id' => $faker->numberBetween(1,3),
            'ranks_id' => $faker->numberBetween(1,13),
            'first_name' => $faker->firstName,
            'middle_name' => $faker->lastName,
            'last_name' => $faker->lastName,
            'date_of_birth' => $faker->date(),
            'gender' => $faker->numberBetween(0,1),
            'address' => 'Ligao City',
            ];

            DB::table('personnels')->insert($attributes);
        }
    }
}
