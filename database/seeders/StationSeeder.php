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
            'name' => 'Fire Incidents Reports Management System',
            'caseNumberTemp' => "INV2024_",
            'blotterNumberTemp' => "OPT2024_",
            'acronym' => "FIRMS",
        ];

        DB::table('stations')->insert($attributes);
    }
}
