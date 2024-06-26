<?php

namespace App\Imports;

use App\Models\Progress;
use App\Models\Investigation;
use App\Models\InvestigationLog;
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
        // dd($collection);
        foreach ($collection as $key => $row) {

            $inves = Investigation::create([
                'case_number' => $row['case_number'] ?? '',
                'for' => $row['for'] ?? '',
                'subject' => $row['subject'] ?? '',
                'date' => $row['date'] ?? '',
            ]);
            $spot = Investigation::findbyCaseNumber($row['spot_case_number']);
            // dd($spot, $row);
            $progress = Progress::create([
                'spot_id' => $spot->Spot->id,
                'investigation_id' => $inves->id,
                'authority' => $row['authority'] ?? '',
                'matters_investigated' => $row['matters_investigated'] ?? '',
                'facts_of_the_case' => $row['facts_of_the_case'] ?? '',
                'disposition' => $row['disposition'] ?? '',
            ]);
            $log = new InvestigationLog();
            $log->fill([
                'investigation_id' => $progress->investigation->id,
                'user_id' => auth()->user()->id,
                'details' => "Created a Progress Investigation of " . $spot->subject . " with a subject of " . $progress->investigation->subject,
                'action' => "Store",
            ]);
            $log->save();
            return redirect()->back()->with('success', 'Progress Investigation Imported Successfully');            // dd($inves);
        }
    }
}
