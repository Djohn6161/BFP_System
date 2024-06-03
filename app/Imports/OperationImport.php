<?php

namespace App\Imports;

use App\Models\Afor;
use App\Models\Response;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OperationImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {

        foreach ($collection as $key => $row) 
        {
 
            if ($key > 0) {

                $afor = Afor::create([
                    'alarm_received' => $row[0] ?? '',
                    'transmitted_by' => $row[1] ?? '',
                    'caller_address' => $row[2] ?? '',
                    'barangay_name' => $row[3] ?? '',
                    'zone' => $row[4] ?? '',
                    'location' => $row[5] ?? '',
                    'full_location' => $row[6] ?? '',
                    'received_by' => $row[7] ?? null,
                    'td_under_control' => $row[8] ?? null,
                    'td_declared_fireout' => $row[9] ?? null,
                    'sketch_of_fire_operation' => $row[10] ?? '',
                    'details' => $row[11] ?? '',
                    'problem_encounter' => $row[12] ?? '',
                    'observation_recommendation' => $row[13] ?? '',
                    'alarm_status_arrival' => $row[14] ?? '',
                    'first_responder' => $row[15] ?? '',
                    'prepared_by' => $row[16] ?? '',
                    'noted_by' => $row[17] ?? '',
                ]);

                $engine_dispatched = explode(',',$row[18]);
                $time_dispatched = explode(',',$row[19]);
                $time_arrived_at_scene = explode(',',$row[20]);
                $response_duration = explode(',',$row[21]);
                $time_return_to_base = explode(',',$row[22]);
                $water_tank_refilled = explode(',',$row[23]);
                $gas_consumed = explode(',',$row[24]);
                
                if($engine_dispatched){
                    foreach ($engine_dispatched as $key => $engine) {
                        Response::create([
                            'afor_id' => $afor->id,
                            'engine_dispatched' => $engine,
                            'time_dispatched' => $time_dispatched[$key],
                            'time_arrived_at_scene' => $time_arrived_at_scene[$key],
                            'response_duration' => $response_duration[$key],
                            'time_return_to_base' => $time_return_to_base[$key],
                            'water_tank_refilled' => $water_tank_refilled[$key],
                            'gas_consumed' => $gas_consumed[$key],
                        ]);
                    }
                }
    
                // Response::create([
                    
                // ])
  
            }
        }
    }
}
