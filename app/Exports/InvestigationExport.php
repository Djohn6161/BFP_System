<?php

namespace App\Exports;

use App\Models\Investigation;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class InvestigationExport implements FromCollection, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $investigations;

    public function __construct($investigations)
    {
        $this->investigations = $investigations;
    }
    public function collection()
    {
        
        // dd($this->investigations);
        foreach ($this->investigations as $investigation) {
            if ($investigation->Minimal != null) {
                $data[] = [
                    $investigation->id,
                    $investigation->for,
                    $investigation->subject,
                    $investigation->Minimal->dt_actual_occurence,
                    $investigation->Minimal->dt_reported,
                    $investigation->Minimal->incident_location,
                    $investigation->Minimal->involved_property,
                    $investigation->Minimal->property_data,
                    $investigation->Minimal->receiverPersonnel->rank->slug . " " . $investigation->Minimal->receiverPersonnel->last_name . " " . $investigation->Minimal->receiverPersonnel->first_name,
                    $investigation->Minimal->caller_name,
                    $investigation->Minimal->caller_address,
                    $investigation->Minimal->caller_number,
                    $investigation->Minimal->notification_originator,
                    $investigation->Minimal->respondingEngine->name,
                    $investigation->Minimal->respondingLeader->rank->slug . ' ' . $investigation->Minimal->respondingLeader->last_name . ' ' . $investigation->Minimal->respondingLeader->first_name,
                    $investigation->Minimal->time_arrival_on_scene,
                    $investigation->Minimal->alarm->name,
                    $investigation->Minimal->time_Fire_out,
                    $investigation->Minimal->property_owner,
                    $investigation->Minimal->property_occupant,
                    $investigation->Minimal->details,
                    $investigation->Minimal->findings,
                    $investigation->Minimal->recommendation, 
                ];
            } else if ($investigation->Spot != null) {
                $data[] = [
                    $investigation->id,
                    $investigation->for,
                    $investigation->subject,
                    // $investigation->Spot->
                ];
            } else if ($investigation->progress != null) {
                $data[] = [
                    $investigation->id,
                    $investigation->for,
                    $investigation->subject,
                ];
            } else if ($investigation->final != null) {
                $data[] = [
                    $investigation->id,
                    $investigation->for,
                    $investigation->subject,
                ];
            } else {
                $data[] = [
                    $investigation->id,
                    $investigation->for,
                    $investigation->subject,
                ];
            }
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
