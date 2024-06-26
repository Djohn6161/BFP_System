<?php

namespace App\Imports;

use App\Models\Investigation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class progressImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        dd($collection);
        foreach ($collection as $key => $row) {
            $inves = Investigation::create([
                'case_number' => $row[0] ?? '',
                'for' => $row[1] ?? '',
                'subject' => $row[2] ?? '', 
                'date' => $row[2] ?? '', 
            ]);
            
        }
    }
}
