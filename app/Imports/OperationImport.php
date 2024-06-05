<?php

namespace App\Imports;

use App\Models\Afor;
use App\Models\Afor_casualties;
use App\Models\Afor_duty_personnel;
use App\Models\Declared_alarm;
use App\Models\Occupancy;
use App\Models\Response;
use App\Models\Used_equipment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OperationImport implements ToCollection
{
    /**
     * @param Collection $collection
     */

    public function collection(Collection $collection)
    {

        foreach ($collection as $key => $row) {

            if ($key > 0) {

                $afor = Afor::create([
                    'alarm_received' => $row[0] ?? '',
                    'transmitted_by' => $row[1] ?? '',
                    'caller_address' => $row[2] ?? '',
                    'barangay_name' => $row[3] ?? '',
                    'zone' => $row[4] ?? '',
                    'location' => $row[5] ?? '',
                    'full_location' => $row[6] ?? '',
                    'blotter_number' => $row[7] ?? '',
                    'received_by' => $row[8] ?? null,
                    'td_under_control' => $row[9] ?? null,
                    'td_declared_fireout' => $row[10] ?? null,
                    'sketch_of_fire_operation' => $row[11] ?? '',
                    'details' => $row[12] ?? '',
                    'problem_encounter' => $row[13] ?? '',
                    'observation_recommendation' => $row[14] ?? '',
                    'alarm_status_arrival' => $row[15] ?? '',
                    'first_responder' => $row[16] ?? '',
                    'prepared_by' => $row[17] ?? '',
                    'noted_by' => $row[18] ?? '',
                ]);

                $engine_dispatched = explode(',', $row[19]);
                $time_dispatched = explode(',', $row[20]);
                $time_arrived_at_scene = explode(',', $row[21]);
                $response_duration = explode(',', $row[22]);
                $time_return_to_base = explode(',', $row[23]);
                $water_tank_refilled = explode(',', $row[24]);
                $gas_consumed = explode(',', $row[25]);

                if ($engine_dispatched) {
                    foreach ($engine_dispatched as $key => $engine) {
                        Response::create([
                            'afor_id' => $afor->id,
                            'engine_dispatched' => $engine,
                            'time_dispatched' => $time_dispatched[$key] ?? '',
                            'time_arrived_at_scene' => $time_arrived_at_scene[$key] ?? '',
                            'response_duration' => $response_duration[$key] ?? '',
                            'time_return_to_base' => $time_return_to_base[$key] ?? '',
                            'water_tank_refilled' => $water_tank_refilled[$key] ?? '',
                            'gas_consumed' => $gas_consumed[$key] ?? '',
                        ]);
                    }
                }

                $alarm_names = explode(',', $row[26]);
                $alarm_time = explode(',', $row[27]);
                $fund_commander = explode(',', $row[28]);

                if ($alarm_names) {
                    foreach ($alarm_names as $key => $name) {
                        // Ensure alarm_time and fund_commander are properly set or null
                        $time = isset($alarm_time[$key]) ? $alarm_time[$key] : null;
                        $commander = isset($fund_commander[$key]) && is_numeric($fund_commander[$key]) ? (int)$fund_commander[$key] : null;

                        Declared_alarm::create([
                            'afor_id' => $afor->id,
                            'alarm_name' => $name,
                            'time' => $time,
                            'ground_commander' => $commander,
                        ]);
                    }
                }

                Occupancy::create([
                    'afor_id' => $afor->id,
                    'occupancy_name' => $row[29] ?? '',
                    'type' => $row[30] ?? '',
                    'specify' => $row[31] ?? '',
                    'distance' => $row[32] ?? '',
                    'description' => $row[33] ?? '',
                ]);

                $types = explode(',', $row[34]);
                $injured = explode(',', $row[35]);
                $death = explode(',', $row[36]);

                foreach ($types as $key => $type) {
                    Afor_casualties::create([
                        'afor_id' => $afor->id,
                        'type' => $type,
                        'injured' => $injured[$key] ?? '',
                        'death' => $death[$key] ?? '',
                    ]);
                }

                $categories = explode(',', $row[37]);
                $quantity = explode(',', $row[38]);
                $type = explode(',', $row[39]);
                $nr = explode(',', $row[40]);
                $length = explode(',', $row[41]);

                foreach ($categories as $key => $category) {
                    $trimmedCategory = trim($category);

                    // Skip if category is empty
                    if (empty($trimmedCategory)) {
                        continue;
                    }

                    Used_equipment::create([
                        'afor_id' => $afor->id,
                        'category' => $trimmedCategory,
                        'quantity' => is_numeric($quantity[$key]) ? $quantity[$key] : null,
                        'type' => $type[$key] ?? '',
                        'nr' => $nr[$key] ?? null,
                        'length' => $length[$key] ?? null,
                    ]);
                }

                $personnels_id = explode(',', $row[42]);
                $designation = explode(',', $row[43]);
                $remarks = explode(',', $row[44]);

                foreach ($personnels_id as $key => $personnel) {
                    Afor_duty_personnel::create([
                        'afor_id' => $afor->id,
                        'personnels_id' => $personnel,
                        'designation' => $designation[$key] ?? '',
                        'remarks' => $remarks[$key] ?? '',
                    ]);
                }
            }
        }
    }
}
