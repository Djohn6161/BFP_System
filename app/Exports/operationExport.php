<?php

namespace App\Exports;

use App\Models\Afor;
use App\Models\Afor_casualties;
use App\Models\Afor_duty_personnel;
use App\Models\Casualty;
use App\Models\Declared_alarm;
use App\Models\Occupancy;
use App\Models\Response;
use App\Models\Used_equipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class OperationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $operations;

    public function __construct($operations)
    {
        $this->operations = $operations;
    }

    public function collection()
    {
        foreach ($this->operations as $key => $operation) {
            $responseFields = ['engine_dispatched', 'time_dispatched', 'time_arrived_at_scene', 'response_duration', 'time_return_to_base', 'water_tank_refilled', 'gas_consumed'];
            $response_data = [];

            foreach ($responseFields as $field) {
                $response_data[$field] = implode(',', Response::where('afor_id', $operation->id)->pluck($field)->toArray());
            }

            $alarmFields = ['alarm_name', 'time', 'ground_commander'];
            $alarm_data = [];

            foreach ($alarmFields as $field) {
                $alarm_data[$field] = implode(',', Declared_alarm::where('afor_id', $operation->id)->pluck($field)->toArray());
            }

            $occupancyFields = ['occupancy_name', 'type', 'specify', 'distance', 'description'];
            $occupancy_data = [];

            foreach ($occupancyFields as $field) {
                $occupancy_data[$field] = implode(',', Occupancy::where('afor_id', $operation->id)->pluck($field)->toArray());
            }

            $casualtiesFields = ['type', 'injured', 'death'];
            $casualties_data = [];

            foreach ($casualtiesFields as $field) {
                $casualties_data[$field] = implode(',', Afor_casualties::where('afor_id', $operation->id)->pluck($field)->toArray());
            }

            $equipmentFields = ['category', 'quantity', 'type', 'nr', 'length'];
            $equipment_data = [];

            foreach ($equipmentFields as $field) {
                $equipment_data[$field] = implode(',', Used_equipment::where('afor_id', $operation->id)->pluck($field)->toArray());
            }

            $personnelFields = ['personnels_id', 'designation', 'remarks'];
            $personnel_data = [];

            foreach ($personnelFields as $field) {
                $personnel_data[$field] = implode(',', Afor_duty_personnel::where('afor_id', $operation->id)->pluck($field)->toArray());
            }

            $data[] = [
                $operation->alarm_received,
                $operation->transmitted_by,
                $operation->caller_address,
                $operation->barangay_name,
                $operation->zone,
                $operation->location,
                $operation->full_location,
                $operation->blotter_number,
                $operation->received_by,
                $operation->td_under_control, $operation->td_declared_fireout ,$operation->sketch_of_fire_operation,
                $operation->details,
                $operation->problem_encounter,
                $operation->observation_recommendation,
                $operation->alarm_status_arrival,
                $operation->first_responder,
                $operation->prepared_by,
                $operation->noted_by,
                $response_data['engine_dispatched'],
                $response_data['time_dispatched'],
                $response_data['time_arrived_at_scene'],
                $response_data['response_duration'],
                $response_data['time_return_to_base'],
                $response_data['water_tank_refilled'],
                $response_data['gas_consumed'],
                $alarm_data['alarm_name'],
                $alarm_data['time'],
                $alarm_data['ground_commander'],
                $occupancy_data['occupancy_name'],
                $occupancy_data['type'],
                $occupancy_data['specify'],
                $occupancy_data['distance'],
                $occupancy_data['description'],
                $casualties_data['type'],
                $casualties_data['injured'],
                $casualties_data['death'],
                $equipment_data['category'],
                $equipment_data['quantity'],
                $equipment_data['type'],
                $equipment_data['nr'],
                $equipment_data['length'],
                $personnel_data['personnels_id'],
                $personnel_data['designation'],
                $personnel_data['remarks'],
            ];

        }

        // dd($data);  
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'alarm_received',
            'transmitted_by',
            'caller_address',
            'barangay_name',
            'zone',
            'location',
            'full_location',
            'blotter_number',
            'received_by',
            'td_under_control',
            'td_declared_fireout',
            'sketch_of_the_operation',
            'details',
            'problem_encounter',
            'observation_recommendation',
            'alarm_status_arrival',
            'first_responder',
            'prepared_by',
            'noted_by',
            'engine_dispatched',
            'time_dispatched',
            'time_arrived_at_scene',
            'response_duration',
            'time_return_to_base',
            'water_tank_refilled',
            'gas_consumed',
            'alarm_name',
            'time',
            'ground_commander',
            'occupancy_name',
            'type',
            'specify',
            'distance',
            'description',
            'type',
            'injured',
            'death',
            'category',
            'quantity',
            'type',
            'nr',
            'length',
            'personnels_id',
            'designation',
            'remarks',
        ];
    }


}
