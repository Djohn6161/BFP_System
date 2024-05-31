<?php

namespace App\Exports;

use App\Models\Investigation;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ProgressExport implements WithHeadings, FromCollection, WithStyles, WithColumnWidths
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
            if ($investigation->progress != null) {
                $data[] = [
                    $investigation->for,
                    $investigation->subject,
                    $investigation->date,
                    $investigation->progress->authority,
                    $investigation->progress->matters_investigated,
                    $investigation->progress->facts_of_the_case,
                    $investigation->progress->disposition,
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
            'X' => ['alignment' => ['wrapText' => true]],
            'Y' => ['alignment' => ['wrapText' => true]],
            'Z' => ['alignment' => ['wrapText' => true]],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 50,
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
    public function headings(): array
    {
        return [
            'For',
            'Subject',
            'Date',
            'Authority',
            'Matters Investigated',
            'Facts of the Case',
            'Disposition',
        ];
    }
}
