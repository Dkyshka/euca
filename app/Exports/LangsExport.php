<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LangsExport implements FromCollection, WithMapping, WithColumnWidths, WithStyles, WithHeadings
{

    protected Collection $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection(): Collection
    {
        return $this->data;
    }

    public function map($row): array
    {
        return [
            $row['column1'],
            $row['column2'],
            $row['column3'],
            $row['column4'],
        ];
    }

    public function headings(): array
    {
        return [
            'Key',
            'Ru',
            'Uz',
            'En',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);

        $sheet->getStyle('A1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'],]);
        $sheet->getStyle('B1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '17A2B8']]);
        $sheet->getStyle('C1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '17A2B8']]);
        $sheet->getStyle('D1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '17A2B8']]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 40,
            'C' => 40,
            'D' => 40,
        ];
    }

}
