<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VictimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index){

            $attributes = [
                'report_id' => $faker->numberBetween(1,10),
            ];

            DB::table('victims')->insert($attributes);
        }
    }
}
