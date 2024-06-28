<?php

namespace App\Exports;

use App\Models\Investigation;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class FinalExport implements WithHeadings, FromCollection, WithStyles, WithColumnWidths
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
            if ($investigation->final != null) {
                $victims = "";
                if (count($investigation->victims) != 0) {
                    $victimnames = [];
                    foreach ($investigation->victims as $victim) {
                        $victimnames[] = $victim->name;
                    }
                    $victims = implode(', ', $victimnames);
                } else {
                    $victims = 'N\A';
                }
                $td = explode(' ', $investigation->final->td_alarm);
                $data[] = [
                    $investigation->case_number,
                    $investigation->for,
                    $investigation->subject,
                    $investigation->date,
                    $investigation->final->Spot->investigation->case_number,
                    $investigation->final->intelligence_unit,
                    $investigation->final->place_of_fire,
                    $investigation->final->td_alarm,
                    $investigation->final->establishment_burned,
                    $victims,

                    '₱ ' . number_format($investigation->final->damage_to_property, 0, '.', ','),
                    $investigation->final->origin_of_fire,
                    $investigation->final->cause_of_fire,
                    $investigation->final->substantiating_documents,
                    $investigation->final->facts_of_the_case,
                    $investigation->final->discussion,
                    $investigation->final->findings,
                    $investigation->final->recommendation,
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
            'F' => 40,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 20,
            'L' => 60,
            'M' => 40,
            'N' => 100,
            'O' => 100,
            'P' => 100,
            'Q' => 100,
            'R' => 100,
        ];
    }
    public function headings(): array
    {
        return [
            'Case Number',
            'For',
            'Subject',
            'Date',
            'Spot Case Number',
            'INVESTIGATION AND INTELLIGENCE UNIT',
            'PLACE OF FIRE',
            'TIME AND DATE OF ALARM',
            'ESTABLISHMENT BURNED',
            'FIRE VICTIM/S',
            'DAMAGE PROPERTY',
            'ORIGIN OF FIRE',
            'CAUSE OF FIRE',
            'SUBSTANTIATING DOCUMENTS',
            'FACTS OF THE CASE',
            'DISCUSSION',
            'FINDINGS',
            'RECOMMENDATION',
        ];
    }
}
