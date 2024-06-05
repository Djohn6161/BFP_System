<?php

namespace App\Exports;

use App\Models\Afor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class OperationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $operation;

    public function __construct($operation)
    {
        $this->operation = $operation;
    }

    public function collection()
    {
        dd($this->operation);
        // return Afor::all();
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
        ];
    }


}
