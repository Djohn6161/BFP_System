<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'name' => 'Bureau of Fire Protection Ligao City'
        ];

        DB::table('stations')->insert($attributes);
    }
}
