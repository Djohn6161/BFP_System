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
                    'originator' => $row[2] ?? '', 
                    'caller_address' => $row[3] ?? '',
                    'barangay_name' => $row[4] ?? '',
                    'zone' => $row[5] ?? '',
                    'location' => $row[6] ?? '',
                    'full_location' => $row[7] ?? '',
                    'blotter_number' => $row[8] ?? '',
                    'received_by' => $row[9] ?? null,
                    'td_under_control' => $row[10] ?? null,
                    'td_declared_fireout' => $row[11] ?? null,
                    'sketch_of_fire_operation' => $row[12] ?? '',
                    'details' => $row[13] ?? '',
                    'problem_encounter' => $row[14] ?? '',
                    'observation_recommendation' => $row[15] ?? '',
                    'alarm_status_arrival' => $row[16] ?? '',
                    'first_responder' => $row[17] ?? '',
                    'prepared_by' => $row[18] ?? '',
                    'noted_by' => $row[19] ?? '',
                ]);

                $engine_dispatched = explode(',', $row[20]);
                $time_dispatched = explode(',', $row[21]);
                $time_arrived_at_scene = explode(',', $row[22]);
                $response_duration = explode(',', $row[23]);
                $time_return_to_base = explode(',', $row[24]);
                $water_tank_refilled = explode(',', $row[25]);
                $gas_consumed = explode(',', $row[26]);

                if ($engine_dispatched) {
                    foreach ($engine_dispatched as $index => $engine) {
                        Response::create([
                            'afor_id' => $afor->id,
                            'engine_dispatched' => $engine,
                            'time_dispatched' => $time_dispatched[$index] ?? '',
                            'time_arrived_at_scene' => $time_arrived_at_scene[$index] ?? '',
                            'response_duration' => $response_duration[$index] ?? '',
                            'time_return_to_base' => $time_return_to_base[$index] ?? '',
                            'water_tank_refilled' => $water_tank_refilled[$index] ?? '',
                            'gas_consumed' => $gas_consumed[$index] ?? '',
                        ]);
                    }
                }

                $alarm_names = explode(',', $row[27]);
                $alarm_time = explode(',', $row[28]);
                $ground_commander = explode(',', $row[29]);

                if ($alarm_names) {
                    foreach ($alarm_names as $index => $name) {
                        Declared_alarm::create([
                            'afor_id' => $afor->id,
                            'alarm_name' => $name,
                            'time' => $alarm_time[$index] ?? '',
                            'ground_commander' => $ground_commander[$index] ?? '',
                        ]);
                    }
                }

                Occupancy::create([
                    'afor_id' => $afor->id,
                    'occupancy_name' => $row[30] ?? '',
                    'type' => $row[31] ?? '',
                    'specify' => $row[32] ?? '',
                    'distance' => $row[33] ?? '',
                    'description' => $row[34] ?? '',
                ]);

                $types = explode(',', $row[35]);
                $injured = explode(',', $row[36]);
                $death = explode(',', $row[37]);

                foreach ($types as $index => $type) {
                    Afor_casualties::create([
                        'afor_id' => $afor->id,
                        'type' => $type,
                        'injured' => $injured[$index] ?? '',
                        'death' => $death[$index] ?? '',
                    ]);
                }

                $quantity = explode(',', $row[38]);
                $categories = explode(',', $row[39]);
                $equipment_type = explode(',', $row[40]);
                $nr = explode(',', $row[41]);
                $length = explode(',', $row[42]);

                foreach ($categories as $index => $category) {
                    $quantity_value = isset($quantity[$index]) && is_numeric($quantity[$index]) ? (int)$quantity[$index] : 0;

                    Used_equipment::create([
                        'afor_id' => $afor->id,
                        'quantity' => $quantity_value,
                        'category' => $category,
                        'type' => $equipment_type[$index] ?? '',
                        'nr' => $nr[$index] ?? '',
                        'length' => $length[$index] ?? '',
                    ]);
                }

                $personnels_id = explode(',', $row[43]);
                $designation = explode(',', $row[44]);
                $remarks = explode(',', $row[45]);

                foreach ($personnels_id as $index => $personnel) {
                    Afor_duty_personnel::create([
                        'afor_id' => $afor->id,
                        'personnels_id' => $personnel,
                        'designation' => $designation[$index] ?? '',
                        'remarks' => $remarks[$index] ?? '',
                    ]);
                }
            }
        }
    }
}
