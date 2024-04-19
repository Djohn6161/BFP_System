<?php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brgys = [
            [
                'name' => '',
                'unit' => '',
            ],    
            [
                'name' => 'Amtic',
                'unit' => 'Mayon Unit',
            ],      
            [
                'name' => 'Baligang',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Barayong',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Basag',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Batang',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Binanowan',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Busay',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Herrera',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Mahaba',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Nabonton',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Nasisi',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Paulog',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Pinit',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Tambo',
                'unit' => 'Mayon Unit',
            ],
            [
                'name' => 'Bagumbayan',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Bay',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Binatagan',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Bobonsuran',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Bonga',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Calzada',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Cavasi',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Dunao',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Guilid',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Layon',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Pandan',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Ranao-ranao',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Sta. Cruz',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Tagpo',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Tinago',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Tinampo',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Tomolin',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Tuburan',
                'unit' => 'Central Unit',
            ],
            [
                'name' => 'Abella',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Allang',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Bacong',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Balanac',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Busac',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Culliat',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Francia',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Macalidong',
                'unit' => 'Upland Unit',
            ],            
            [
                'name' => 'Malama',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Oma-oma',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Palapas',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Paulba',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Pinamaniquian',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'San Vicente',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Tandarura',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Tastas',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Tiongson',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Tula-tula Grande',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Tula-tula Pequeño',
                'unit' => 'Upland Unit',
            ],
            [
                'name' => 'Tupaz',
                'unit' => 'Upland Unit',
            ],       
            [
                'name' => 'Cabarian',
                'unit' => 'Coastal Unit',
            ],
            [
                'name' => 'Catburawan',
                'unit' => 'Coastal Unit',
            ],
            [
                'name' => 'Maonon',
                'unit' => 'Coastal Unit',
            ]
        ];

        DB::table('barangays')->insert($brgys);
    }
}
