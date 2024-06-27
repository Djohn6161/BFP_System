<?php

namespace App\Imports;

use App\Models\Afor;
use App\Models\Alarm_name;
use App\Models\Minimal;
use App\Models\Investigation;
use App\Models\InvestigationLog;
use App\Models\Personnel;
use App\Models\Truck;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class minimalImport implements ToCollection, WithHeadingRow
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
            $truck = Truck::getByName($row['first_responding_engine']);
            $lead = Personnel::getByName($row['first_responding_leader']);
            $alarm = Alarm_name::getByName($row['alarm_status_time']);
            // dd($afor, $truck, $lead, $alarm, $row);
            $minimal = Minimal::create([
                'afor_id' => $afor->id,
                'investigation_id' => $inves->id,
                'dt_actual_occurence' => $row['actual_occurence_date_and_time'] ?? '',
                'dt_reported' => $row['date_and_time_reported'] ?? '',
                'incident_location' => $row['incident_location'] ?? '',
                'involved_property' => $row['involved_property'] ?? '',
                'property_data' => $row['property_data'] ?? '',
                'property_occupant' => $row['property_occupant'] ?? '',
                'receiver' => $row['call_receiver'] ?? '',
                'caller_name' => $row['caller_name'] ?? '',
                'caller_address' => $row['caller_address'] ?? '',
                'caller_number' => $row['caller_number'] ?? '',
                'notification_originator' => $row['notification_originator'] ?? '',
                'first_responding_engine' => $truck->id ?? null,
                'first_responding_leader' => $lead->id ?? null,
                'time_arrival_on_scene' => $row['time_arrival_on_scene'] ?? '',
                'alarm_status_time' => $alarm->id ?? null,
                'Time_Fire_out' => $row['time_fire_out'] ?? '',
                'property_owner' => $row['property_owner'] ?? '',
                // 'property_occupant' => $row['property_owner'] ?? '',
                'details' => $row['details'] ?? '',
                'findings' => $row['findings'] ?? '',
                'recommendation' => $row['recommendation'] ?? '',
                // 'photos' => $photos ?? '',
            ]);
            $log = new InvestigationLog();
            $log->fill([
                'investigation_id' => $minimal->investigation->id,
                'user_id' => auth()->user()->id,
                'details' => "Created a Minimal Investigation with a subject of " . $minimal->investigation->subject,
                'action' => "Store",
            ]);
            $log->save();
            return redirect()->back()->with('success', 'Progress Investigation Imported Successfully');            // dd($inves);
        }
    }
}
