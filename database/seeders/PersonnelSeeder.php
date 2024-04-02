<?php

namespace Database\Seeders;

use App\Models\Rank;
use App\Models\Personnel;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $fo1 = Rank::factory()->create([
            'slug' => 'FO1',
            'name' => 'Fire Officer 1',
        ]);
        $fses = Department::factory()->create([
            'slug' => 'FSES',
            'name' => 'FSES'
        ]);
        Department::factory()->create([
            'slug' => 'Operation',
            'name' => 'Operation'
        ]);
        Department::factory()->create([
            'slug' => 'Admin',
            'name' => 'Admin'
        ]);

        Rank::factory()->create([
            'slug' => 'FO2',
            'name' => 'Fire Officer 2',
        ]);
        Rank::factory()->create([
            'slug' => 'FO3',
            'name' => 'Fire Officer 3',
        ]);
        Rank::factory()->create([
            'slug' => 'SO1',
            'name' => 'Senior Officer 1',
        ]);
        Rank::factory()->create([
            'slug' => 'SO2',
            'name' => 'Senior Officer 2',
        ]);
        Rank::factory()->create([
            'slug' => 'SO3',
            'name' => 'Senior Officer 3',
        ]);
        Rank::factory()->create([
            'slug' => 'SO4',
            'name' => 'Senior Officer 4',
        ]);
        Rank::factory()->create([
            'slug' => 'I',
            'name' => 'Inspector',
        ]);
        Rank::factory()->create([
            'slug' => 'SI',
            'name' => 'Senior Inspector',
        ]);
        Rank::factory()->create([
            'slug' => 'CI',
            'name' => 'Chief Inspector',
        ]);
        Rank::factory()->create([
            'slug' => 'S',
            'name' => 'Superintendent',
        ]);
        Rank::factory()->create([
            'slug' => 'SS',
            'name' => 'Senior Superintendent',
        ]);
        Rank::factory()->create([
            'slug' => 'CS',
            'name' => 'Chief Superintendent',
        ]);
        Rank::factory()->create([
            'slug' => 'D',
            'name' => 'Director',
        ]);
        Personnel::factory()->create([
            'departments_id' => $fses->id,
            'ranks_id' => $fo1->id,
            'first_name'=> 'craig ben',
            'last_name'=> 'Cadag',
            'middle_name'=> 'Lana',
            'date_of_birth'=> '2001-08-08',
            'gender'=> 1,
            'address'=> 'Iriga, Camarines Sur',
        ]);
    }
}
