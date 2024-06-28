<?php

namespace App\Imports;

use App\Models\Ifinal;
use App\Models\Investigation;
use App\Models\InvestigationLog;
use App\Models\Victim;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class finalImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
        // dd($collection);
        foreach ($collection as $key => $row) {
            
            // dd($property);
            $inves = Investigation::create([
                'case_number' => $row['case_number'] ?? '',
                'for' => $row['for'] ?? '',
                'subject' => $row['subject'] ?? '',
                'date' => $row['date'] ?? '',
            ]);
            $spot = Investigation::findbyCaseNumber($row['spot_case_number']);
            // $receiver = Personnel::getByName($row['call_receiver']);
            // dd($afor, $truck, $lead, $alarm, $row, $receiver);
            // dd(ltrim($row['estimated_damage'], '₱ '));
            $property = ltrim($row['damage_property'], '₱ ');
            $property = str_replace(',', "", $property);
            $final = Ifinal::create([
                'investigation_id' => $inves->id,
                'spot_id' => $spot->id,
                'intelligence_unit' => $row['investigation_and_intelligence_unit'] ?? '',
                'place_of_fire' =>  $row['place_of_fire'] ?? '',
                'td_alarm' => $row['time_and_date_of_alarm'] ?? '',
                'establishment_burned' => $row['establishment_burned'] ?? '',
                'damage_to_property' => $property ?? '',
                'origin_of_fire' => $row['origin_of_fire'] ?? '',
                'cause_of_fire' => $row['cause_of_fire'] ?? '',
                'substantiating_documents' => $row['substantiating_documents'] ?? '',
                'facts_of_the_case' => $row['facts_of_the_case'] ?? '',
                'discussion' => $row['discussion'] ?? '',
                'findings' => $row['findings'] ?? '',
                'recommendation' => $row['recommendation'] ?? '',
                // 'photos' => $photos ?? '',
            ]);
            if($row['fire_victims'] != "N\A"){
                $victims = explode(', ', $row['fire_victims']);
                foreach($victims as $victim){
                    Victim::create([
                        'name' => $victim,
                        'investigation_id' => $inves->id,
                    ]);
                }
                // dd($victims);
            }
            $log = new InvestigationLog();
            $log->fill([
                'investigation_id' => $final->investigation->id,
                'user_id' => auth()->user()->id,
                'details' => "Created a Minimal Investigation with a subject of " . $final->investigation->subject,
                'action' => "Store",
            ]);
            $log->save();
            // dd($inves);
        }
    }
}
