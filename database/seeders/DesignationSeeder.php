<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designation = [   
            [
                'id' => '1',
                'name' => 'City Fire Marshal',
                'class' => 'A',
                'section' => null,

            ],  
            [
                'id' => '2',
                'name' => 'Deputy City Fire Marshal',
                'class' => 'A',
                'section' => null,

            ],  
            [
                'id' => '3',
                'name' => 'Driver',
                'class' => 'A',
                'section' => null,

            ],  
            [
                'id' => '4',
                'name' => 'C, Operations Section',
                'class' => 'B',
                'section' => '4',

            ],  
            [
                'id' => '5',
                'name' => 'C, Fire Safety and Enforcement Section',
                'class' => 'B',
                'section' => '5',

            ],
            [
                'id' => '6',
                'name' => 'C, Administrative Section',
                'class' => 'B',
                'section' => '6',

            ],
            [
                'id' => '7',
                'name' => 'C, COMMEL',
                'class' => 'C',
                'section' => '4',

            ],
            [
                'id' => '8',
                'name' => 'C, Intelligence and Investigation Unit',
                'class' => 'C',
                'section' => '4',

            ],
            [
                'id' => '9',
                'name' => 'C, Emergency Medical Services',
                'class' => 'C',
                'section' => '4',
                
            ],
            [
                'id' => '10',
                'name' => 'C, Rescue Unit',
                'class' => 'C',
                'section' => '4',
                
            ],
            [
                'id' => '11',
                'name' => 'C, Fire Engine Company',
                'class' => 'C',
                'section' => '4',
                
            ],
            [
                'id' => '12',
                'name' => 'C, Community Relations Unit',
                'class' => 'C',
                'section' => '5',
                
            ],
            [
                'id' => '13',
                'name' => 'C, Fire Prevention Unit',
                'class' => 'C',
                'section' => '5',
                
            ],
            [
                'id' => '14',
                'name' => 'C, Personal and Training Unit',
                'class' => 'C',
                'section' => '6',
                
            ],
            [
                'id' => '15',
                'name' => 'C, Records and Leave Management Unit',
                'class' => 'C',
                'section' => '6',
                
            ],
            [
                'id' => '16',
                'name' => 'C, Morale and Welfare Unit',
                'class' => 'C',
                'section' => '6',
                
            ],
            [
                'id' => '17',
                'name' => 'C, Finance Unit',
                'class' => 'C',
                'section' => '6',
                
            ],
            [
                'id' => '18',
                'name' => 'Radio Operation/Telephone Operator',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '19',
                'name' => 'Information Technologist',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '20',
                'name' => 'Lead Fire Arson Investigator',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '21',
                'name' => 'Fire Scene Photographer',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '22',
                'name' => 'Fire Scene Sketch Preparer',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '23',
                'name' => 'Evidence Custodian',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '24',
                'name' => 'Evidence Recovery Personnel',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '25',
                'name' => 'Team Security Personnel',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '26',
                'name' => 'Fire Arson Investigator',
                'class' => 'D',
                'section' => '4',

            ],
            [
                'id' => '27',
                'name' => 'Medical First Responder',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '28',
                'name' => 'EMT/Paramedics',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '29',
                'name' => 'EMS Clerk',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '30',
                'name' => 'EMS Personnel',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '31',
                'name' => 'Search and Rescue',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '32',
                'name' => 'Hazmat/CBRN Response',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '33',
                'name' => 'Shift A - Commander',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '34',
                'name' => 'Shift B - Commander',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '35',
                'name' => 'Driver/Pump Operator',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '36',
                'name' => 'Lineman',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '37',
                'name' => 'Nozzleman',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '38',
                'name' => 'Operations Clerk',
                'class' => 'D',
                'section' => '4',
                
            ],
            [
                'id' => '39',
                'name' => 'CRU Personnel',
                'class' => 'D',
                'section' => '5',
                
            ],
            [
                'id' => '40',
                'name' => 'Assessor',
                'class' => 'D',
                'section' => '5',
                
            ],
            [
                'id' => '41',
                'name' => 'Building Inspector',
                'class' => 'D',
                'section' => '5',
                
            ],
            [
                'id' => '42',
                'name' => 'FPU Clerk',
                'class' => 'D',
                'section' => '5',
                
            ],
            [
                'id' => '43',
                'name' => 'Plan Evaluator',
                'class' => 'D',
                'section' => '5',
                
            ],
            [
                'id' => '44',
                'name' => 'FSES Clerk',
                'class' => 'D',
                'section' => '5',
                
            ],
            [
                'id' => '45',
                'name' => 'Admin Clerk',
                'class' => 'D',
                'section' => '6',
                
            ],
            [
                'id' => '46',
                'name' => 'Leave Processor',
                'class' => 'D',
                'section' => '6',
                
            ],
            [
                'id' => '47',
                'name' => 'Records Custodian',
                'class' => 'D',
                'section' => '6',
                
            ],
            [
                'id' => '48',
                'name' => 'Admin Clerk',
                'class' => 'D',
                'section' => '6',
                
            ],
            [
                'id' => '49',
                'name' => 'Liason Officer',
                'class' => 'D',
                'section' => '6',
                
            ],
        ];

        DB::table('Designations')->insert($designation);
    }
}
