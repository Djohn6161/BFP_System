<?php

namespace App\Exports;

use App\Models\Investigation;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class MinimalExport implements WithHeadings, FromCollection, WithStyles, WithColumnWidths
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
                    $investigation->case_number,
                    $investigation->for,
                    $investigation->subject,
                    $investigation->date,
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
            } 
        }
        // $investigations = Investigation::whereBetween('date', [$this->dateFrom, $this->dateTo])->get();

        return collect($data);
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]],

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
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 45,
            'C' => 60,
            'D' => 15,
            'E' => 30,
            'F' => 30,
            'G' => 25,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20, 
            'N' => 25,
            'O' => 30,
            'P' => 25,
            'Q' => 30,
            'R' => 25,
            'S' => 25,
            'T' => 25,
            'U' => 25,
            'V' => 100,
            'W' => 100,
            'X' => 100,
        ];
    }
    public function headings(): array
    {
        return [
            'case_number',
            'For',
            'Subject',
            'Date',
            'Actual Occurence Date and Time',
            'Date and Time Reported',
            'Incident Location',
            'Involved Property',
            'Property Data',
            'Call Receiver',
            'Caller Name',
            'Caller Address',
            'Caller Number',
            'Notification Originator',
            'First Responding Engine',
            'First Responding Leader',
            'Time Arrival On Scene',
            'Alarm Status Time',
            'Time Fire Out',
            'Property Owner',
            'Property Occupant',
            'Details',
            'Findings',
            'Recommendation',
        ];
    }
}
