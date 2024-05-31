<?php

namespace App\Exports;

use App\Models\Investigation;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class operationExport implements FromCollection, WithStyles, WithColumnWidths
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
        $engine_dispatched = [];
        $time_dispatched = [];
        $td_arrived_At_fire_scene = [];
        $time_response = [];
        $time_returned = [];
        $water_tank_refilled = [];
        $gas_consumed = [];

        foreach($this->operations->responses as $response){
            $engine_dispatched[] = $response->truck->name;
            $time_dispatched[] = $response->time_dispatched;
            $td_arrived_At_fire_scene[] = $response->time_arrived_at_scene;
            $time_response[] = $response->response_duration;
            $time_returned[] = $response->time_return_to_base;
            $water_tank_refilled[] = $response->water_tank_refilled;
            $gas_consumed[] = $response->gas_consumed;
        }

        $engine_dispatched = implode(',', $engine_dispatched);
        $time_dispatched = implode(',', $time_dispatched);
        $td_arrived_At_fire_scene = implode(',', $td_arrived_At_fire_scene);;
        $time_response = implode(',', $time_response);;
        $time_returned = implode(',', $time_returned);;
        $water_tank_refilled = implode(',', $water_tank_refilled);
        $gas_consumed = implode(',', $gas_consumed);

        // dd($engine_dispatched);

        foreach ($this->operations as $operation) {
            $data[] = [
                $operation->id,
                $operation->alarm_received,
                $operation->transmitted_by,
                $operation->caller_address,
                $operation->receivedBy->rank->slug . ' ' . $operation->receivedBy->first_name . ' ' . $operation->receivedBy->last_name,
                $operation->full_location,

       
            ];
        }
        // $investigations = Investigation::whereBetween('date', [$this->dateFrom, $this->dateTo])->get();

        return collect($data);
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            // 1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]],

            'A' => ['alignment' => ['wrapText' => true]],
            'B' => ['alignment' => ['wrapText' => true]],
            'C' => ['alignment' => ['wrapText' => true]],
            'D' => ['alignment' => ['wrapText' => true]],
            'E' => ['alignment' => ['wrapText' => true]],
            'F' => ['alignment' => ['wrapText' => true]],
            'G' => ['alignment' => ['wrapText' => true]],
            'H' => ['alignment' => ['wrapText' => true]],
            'I' => ['alignment' => ['wrapText' => true]],
            'J' => ['alignment' => ['wrapText' => true]],
            'K' => ['alignment' => ['wrapText' => true]],
            'L' => ['alignment' => ['wrapText' => true]],
            'M' => ['alignment' => ['wrapText' => true]],
            'N' => ['alignment' => ['wrapText' => true]],
            'O' => ['alignment' => ['wrapText' => true]],
            'P' => ['alignment' => ['wrapText' => true]],
            'Q' => ['alignment' => ['wrapText' => true]],
            'R' => ['alignment' => ['wrapText' => true]],
            'S' => ['alignment' => ['wrapText' => true]],
            'T' => ['alignment' => ['wrapText' => true]],
            'U' => ['alignment' => ['wrapText' => true]],
            'V' => ['alignment' => ['wrapText' => true]],
            'W' => ['alignment' => ['wrapText' => true]],
            'X' => ['alignment' => ['wrapText' => true]],
            'Y' => ['alignment' => ['wrapText' => true]],
            'Z' => ['alignment' => ['wrapText' => true]],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 100,
            'B' => 100,
            'C' => 100,
            'D' => 100,
            'E' => 100,
            'F' => 100,
            'G' => 100,
            'H' => 100,
            'I' => 100,
            'J' => 100,
            'K' => 100,
            'L' => 100,
            'M' => 100,
            'N' => 100,
            'O' => 100,
            'P' => 100,
            'Q' => 100,
            'R' => 100,
            'S' => 100,
            'T' => 100,
            'U' => 100,
            'V' => 100,
            'W' => 100,
            'X' => 100,
            'Y' => 100,
            'Z' => 100,
        ];
    }
}
