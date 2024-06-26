<?php

namespace App\Exports;

use App\Models\Investigation;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class SpotExport implements WithHeadings, FromCollection, WithStyles, WithColumnWidths
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
            if ($investigation->Spot != null) {
                if ($investigation->landmark == null || $investigation->landmark == '') {
                    $location = $investigation->Spot->address_occurence;
                } else {
                    $location = $investigation->landmark;
                }
                // dd($investigation);
                $data[] = [
                    $investigation->case_number,
                    $investigation->for,
                    $investigation->subject,
                    $investigation->date,
                    $investigation->Spot->afor->blotter_number,
                    $investigation->Spot->date_occurence,
                    $investigation->Spot->time_occurence,
                    $location,
                    $investigation->Spot->involved,
                    $investigation->Spot->name_of_establishment,
                    $investigation->Spot->owner,
                    $investigation->Spot->occupant,
                    $investigation->Spot->fatality != 0 ? $investigation->Spot->fatality : 'Negative',
                    $investigation->Spot->injured != 0 ? $investigation->Spot->injured : 'Negative',
                    '₱ ' . number_format($investigation->Spot->estimate_damage, 0, '.', ','),
                    $investigation->Spot->time_fire_start,
                    $investigation->Spot->time_fire_out,
                    $investigation->Spot->alarmed->name,
                    $investigation->Spot->details,
                    $investigation->Spot->disposition,
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
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 45,
            'C' => 60,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 30,
            'I' => 20,
            'J' => 30,
            'K' => 20,
            'L' => 20,
            'M' => 15,
            'N' => 15,
            'O' => 20,
            'P' => 20,
            'Q' => 15,
            'R' => 15,
            'S' => 100,
            'T' => 60,
        ];
    }
    public function headings(): array
    {
        return [
            'Case Number',
            'For',
            'Subject',
            'Date',
            'Operation Blotter Number',
            'Date of Occurence',
            'Time of Occurence',
            'Place of Occurence',
            'Involved',
            'Name of Establishment',
            'Owner',
            'Occupant',
            'Casualty',
            'Injured',
            'Estimated Damage',
            'Time Fire Started',
            'Time of Fire Out',
            'Alarm',
            'Details',
            'Disposition',
        ];
    }
}
