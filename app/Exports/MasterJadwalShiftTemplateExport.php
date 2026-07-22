<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MasterJadwalShiftTemplateExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * Beberapa baris contoh agar admin paham format yang diharapkan.
     */
    public function array(): array
    {
        return [
            ['01/01/2026', 'O', 0, 'M', 8, 'S', 8, 'P', 8, 0],
            ['02/01/2026', 'M', 8, 'O', 0, 'S', 8, 'P', 8, 8],
            ['03/01/2026', 'M', 8, 'P', 8, 'O', 0, 'S', 8, 0],
        ];
    }

    public function headings(): array
    {
        return [
            'TANGGAL', 'SHIFT_A', 'JAM_A', 'SHIFT_B', 'JAM_B',
            'SHIFT_C', 'JAM_C', 'SHIFT_D', 'JAM_D', 'JAM_ND',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
