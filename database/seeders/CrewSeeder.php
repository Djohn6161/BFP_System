<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 8) as $index){

            $attributes = [
                'report_id' => $faker->numberBetween(1,10),
                'personnel_id' => $faker->numberBetween(1,16),
            ];

            DB::table('crews')->insert($attributes);
        }
    }
}
