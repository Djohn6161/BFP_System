<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [

            [
                'slug' => 'FSES',
                'name' => 'FSES',
            ],      
            [
                'slug' => 'Operation',
                'name' => 'Operation',
            ],
            [
                'slug' => 'Admin',
                'name' => 'Admin',
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}
