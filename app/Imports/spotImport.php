<?php

namespace App\Imports;

use App\Models\Afor;
use App\Models\Spot;
use App\Models\Alarm_name;
use App\Models\Investigation;
use App\Models\InvestigationLog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class spotImport implements ToCollection, WithHeadingRow
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
            $afor = Afor::getByBlotterNumber($row['operation_blotter_number']);
            $alarm = Alarm_name::getByName($row['alarm']);
            // $receiver = Personnel::getByName($row['call_receiver']);
            // dd($afor, $truck, $lead, $alarm, $row, $receiver);
            // dd(ltrim($row['estimated_damage'], '₱ '));
            $spot = Spot::create([
                'afor_id' => $afor->id,
                'investigation_id' => $inves->id,
                'date_occurence' => $row['date_of_occurence'] ?? '',
                'time_occurence' => $row['time_of_occurence'] ?? '',
                'address_occurence' => $row['place_of_occurence'] ?? '',
                'involved' => $row['involved'] ?? '',
                'name_of_establishment' => $row['name_of_establishment'] ?? '',
                'owner' => $row['owner'] ?? '',
                'occupant' => $row['occupant'] ?? '',
                'fatality' => $row['casualty'] == "Negative" ? 0 : $row['casualty'],
                'injured' => $row['injured'] == "Negative" ? 0 : $row['casualty'],
                'estimate_damage' => ltrim($row['estimated_damage'], '₱ ') ?? '',
                'time_fire_start' => $row['time_fire_started'] ?? '',
                'time_fire_out' => $row['time_of_fire_out'] ?? '',
                'alarm' => $alarm->id ?? '',
                'details' => $row['details'] ?? '',
                'disposition' => $row['disposition'] ?? '',
                // 'photos' => $photos ?? '',
            ]);
            $log = new InvestigationLog();
            $log->fill([
                'investigation_id' => $spot->investigation->id,
                'user_id' => auth()->user()->id,
                'details' => "Created a Minimal Investigation with a subject of " . $spot->investigation->subject,
                'action' => "Store",
            ]);
            $log->save();
                        // dd($inves);
        }
    }
}
