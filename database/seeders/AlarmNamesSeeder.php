<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlarmNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [   
            [
                'name' => '1st Alarm',
            ],      
            [
                'name' => '2nd Alarm',
            ],
            [
                'name' => '3rd Alarm',
            ],
            [
                'name' => '4th Alarm',
            ],
            [
                'name' => '5th Alarm',
            ],
            [
                'name' => 'Task Force Alpha',
            ],
            [
                'name' => 'Task Force Bravo',
            ],
            [
                'name' => 'Task Force Charlie',
            ],
            [
                'name' => 'Task Force Delta',
            ],
            [
                'name' => 'Task Force Echo',
            ],
            [
                'name' => 'Task Force Hotel',
            ],
            [
                'name' => 'Task Force India',
            ],
            [
                'name' => 'General Alarm',
            ],
        ];

        DB::table('alarm_names')->insert($names);
    }
}
