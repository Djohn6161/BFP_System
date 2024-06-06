<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            [
                'slug' => 'D',
                'name' => 'Director',
            ],
            [
                'slug' => 'SS',
                'name' => 'Senior Superintendent',
            ],
            [
                'slug' => 'S',
                'name' => 'Superintendent',
            ],
            [
                'slug' => 'CI',
                'name' => 'Chief Inspector',
            ],
            [
                'slug' => 'SI',
                'name' => 'Senior Inspector',
            ],
            [
                'slug' => 'I',
                'name' => 'Inspector',
            ],
            [
                'slug' => 'SO4',
                'name' => 'Senior Officer 4',
            ],
            [
                'slug' => 'SO3',
                'name' => 'Senior Officer 3',
            ],
            [
                'slug' => 'SO2',
                'name' => 'Senior Officer 2',
            ],
            [
                'slug' => 'SO1',
                'name' => 'Senior Officer 1',
            ],
            [
                'slug' => 'FO3',
                'name' => 'Fire Officer 3',
            ],
            [
                'slug' => 'FO2',
                'name' => 'Fire Officer 2',
            ],
            [
                'slug' => 'FO1',
                'name' => 'Fire Officer 1',
            ],      
        ];
        
        DB::table('ranks')->insert($ranks);
    }
}
