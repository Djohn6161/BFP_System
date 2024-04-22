<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 4) as $index){

            $attributes = [
                'name' => $faker->firstName,
                'plate_num' => $faker->regexify('[A-Za-z0-9]{8}'),
            ];

            DB::table('trucks')->insert($attributes);
        }
    }
}
