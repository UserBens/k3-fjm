<?php

namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MemoKibExport
{
    private Spreadsheet $spreadsheet;
    private $sheet;
    private int $row = 1;

    // A..L = 12 kolom (No, Nama, No KTP, Jalan, RT/RW, Kelurahan, Kecamatan,
    // Kab/Kota, Jabatan, Zonasi, Status KIB, Safety Officer)
    const LAST_COL = 'L';

    const COLOR_TITLE_BG      = '1E3A8A'; // biru tua — kop judul
    const COLOR_KOP_LABEL     = 'EFF6FF'; // biru muda — label kop
    const COLOR_KOP_BORDER    = 'BFDBFE';
    const COLOR_SECTION_BG    = '312E81'; // ungu tua — judul section
    const COLOR_HEADER_BG     = '2D4B9E'; // biru — header tabel
    const COLOR_SUMMARY_AKTIF = 'DCFCE7';
    const COLOR_SUMMARY_EXPIRED = 'FEE2E2';
    const COLOR_SUMMARY_HAMPIR  = 'FEF3C7';
    const COLOR_SUMMARY_TIDAK   = 'F1F5F9';
    const COLOR_SUMMARY_TOTAL   = 'DBEAFE';

    public function build(Pegawai $so, array $ringkasan, Collection $rows): Spreadsheet
    {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
        $this->sheet->setTitle('Memo KIB');
        $this->sheet->getSheetView()->setZoomScale(90);

        $this->setColumnWidths();
        $this->writeTitle();
        $this->row++;
        $this->writeKopInfo($so, $ringkasan);
        $this->row++;
        $this->writeSummaryCards($ringkasan);
        $this->row++;

        $this->writeSectionTitle('DAFTAR TENAGA BINAAN');
        $this->writeTableHeader();
        $this->writeItems($rows);

        $this->sheet->setSelectedCell('A1');
        $this->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $this->sheet->getPageSetup()->setFitToWidth(1);
        $this->sheet->getPageSetup()->setFitToHeight(0);

        return $this->spreadsheet;
    }

    private function setColumnWidths(): void
    {
        $widths = [
            'A' => 5,   // No
            'B' => 26,  // Nama
            'C' => 20,  // No KTP
            'D' => 28,  // Jalan
            'E' => 10,  // RT/RW
            'F' => 18,  // Kelurahan
            'G' => 18,  // Kecamatan
            'H' => 18,  // Kab/Kota
            'I' => 22,  // Jabatan
            'J' => 12,  // Zonasi
            'K' => 16,  // Status KIB
            'L' => 26,  // Safety Officer
        ];

        foreach ($widths as $col => $w) {
            $this->sheet->getColumnDimension($col)->setWidth($w);
        }
    }

    private function writeTitle(): void
    {
        $this->sheet->mergeCells("A{$this->row}:" . self::LAST_COL . "{$this->row}");
        $cell = "A{$this->row}";
        $this->sheet->setCellValue($cell, 'MEMO KIB — DATABASE SAFETY OFFICER PT. FOKUS JASA MITRA');
        $this->sheet->getStyle($cell)->applyFromArray([
            'font' => ['bold' => true, 'size' => 13, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::COLOR_TITLE_BG]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $this->sheet->getRowDimension($this->row)->setRowHeight(26);
    }

    private function writeKopInfo(Pegawai $so, array $ringkasan): void
    {
        $this->writeKopRow([
            ['Safety Officer', $so->badge . ' - ' . $so->nama],
            ['Kode OK', $ringkasan['kode_ok']],
            ['Jumlah Tenaga', $ringkasan['jumlah_tenaga']],
            ['Tanggal Cetak', now()->translatedFormat('d F Y')],
        ]);
    }

    private function writeKopRow(array $pairs): void
    {
        $colGroups = [['A', 'C'], ['D', 'F'], ['G', 'I'], ['J', 'L']];
        $labelRow = $this->row;
        $valueRow = $this->row + 1;

        foreach ($pairs as $i => [$label, $value]) {
            [$start, $end] = $colGroups[$i];

            $this->sheet->mergeCells("{$start}{$labelRow}:{$end}{$labelRow}");
            $this->sheet->setCellValue("{$start}{$labelRow}", strtoupper($label) . ':');
            $this->sheet->getStyle("{$start}{$labelRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '1D4ED8']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::COLOR_KOP_LABEL]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => $this->thinBorder(self::COLOR_KOP_BORDER),
            ]);

            $this->sheet->mergeCells("{$start}{$valueRow}:{$end}{$valueRow}");
            $this->sheet->setCellValue("{$start}{$valueRow}", $value ?: '-');
            $this->sheet->getStyle("{$start}{$valueRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '0F172A']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFFFF']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => $this->thinBorder(self::COLOR_KOP_BORDER),
            ]);
        }

        $this->sheet->getRowDimension($valueRow)->setRowHeight(18);
        $this->row += 2;
    }

    private function writeSummaryCards(array $ringkasan): void
    {
        $cards = [
            ['KIB AKTIF', $ringkasan['kib_aktif'], self::COLOR_SUMMARY_AKTIF],
            ['KIB EXPIRED', $ringkasan['kib_expired'], self::COLOR_SUMMARY_EXPIRED],
            ['HAMPIR HABIS', $ringkasan['kib_hampir_habis'], self::COLOR_SUMMARY_HAMPIR],
            ['TIDAK DITEMUKAN', $ringkasan['kib_tidak_ditemukan'], self::COLOR_SUMMARY_TIDAK],
        ];

        $colGroups = [['A', 'C'], ['D', 'F'], ['G', 'I'], ['J', 'L']];
        $labelRow = $this->row;
        $valueRow = $this->row + 1;

        foreach ($cards as $i => [$label, $value, $color]) {
            [$start, $end] = $colGroups[$i];

            $this->sheet->mergeCells("{$start}{$labelRow}:{$end}{$labelRow}");
            $this->sheet->setCellValue("{$start}{$labelRow}", $label);
            $this->sheet->getStyle("{$start}{$labelRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 8, 'color' => ['rgb' => '64748B']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);

            $this->sheet->mergeCells("{$start}{$valueRow}:{$end}{$valueRow}");
            $this->sheet->setCellValue("{$start}{$valueRow}", $value);
            $this->sheet->getStyle("{$start}{$valueRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1A1D2E']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => $this->thinBorder('E2E8F0'),
            ]);
        }

        $this->sheet->getRowDimension($valueRow)->setRowHeight(22);
        $this->row += 2;
    }

    private function writeSectionTitle(string $text): void
    {
        $this->sheet->mergeCells("A{$this->row}:" . self::LAST_COL . "{$this->row}");
        $cell = "A{$this->row}";
        $this->sheet->setCellValue($cell, $text);
        $this->sheet->getStyle($cell)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::COLOR_SECTION_BG]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
        ]);
        $this->sheet->getRowDimension($this->row)->setRowHeight(20);
        $this->row++;
    }

    private function writeTableHeader(): void
    {
        $headers = [
            'NO',
            'NAMA',
            'NO. KTP',
            'JALAN',
            'RT/RW',
            'KELURAHAN',
            'KECAMATAN',
            'KAB/KOTA',
            'JABATAN',
            'ZONASI',
            'STATUS KIB',
            'SAFETY OFFICER',
        ];

        $cols = range('A', self::LAST_COL);
        foreach ($headers as $i => $label) {
            $cell = "{$cols[$i]}{$this->row}";
            $this->sheet->setCellValue($cell, $label);
        }

        $this->sheet->getStyle("A{$this->row}:" . self::LAST_COL . "{$this->row}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 9, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::COLOR_HEADER_BG]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders' => $this->thinBorder('FFFFFF'),
        ]);
        $this->sheet->getRowDimension($this->row)->setRowHeight(24);
        $this->row++;
    }

    private function writeItems(Collection $rows): void
    {
        if ($rows->isEmpty()) {
            $this->sheet->mergeCells("A{$this->row}:" . self::LAST_COL . "{$this->row}");
            $this->sheet->setCellValue("A{$this->row}", 'Belum ada tenaga binaan.');
            $this->sheet->getStyle("A{$this->row}")->applyFromArray([
                'font' => ['italic' => true, 'color' => ['rgb' => '94A3B8']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => $this->thinBorder('E2E8F0'),
            ]);
            $this->row++;
            return;
        }

        foreach ($rows as $idx => $row) {
            $r = $this->row;

            $values = [
                'A' => $row['no'],
                'B' => $row['nama'],
                'C' => $row['ktp'],
                'D' => $row['jalan'],
                'E' => $row['rt_rw'],
                'F' => $row['kelurahan'],
                'G' => $row['kecamatan'],
                'H' => $row['kabupaten_kota'],
                'I' => $row['jabatan'],
                'J' => $row['zonasi'] ?: '-',
                'K' => $row['status_kib'],
                'L' => $row['safety_officer'],
            ];

            foreach ($values as $col => $val) {
                $this->sheet->setCellValue("{$col}{$r}", $val);
            }

            $this->sheet->getStyle("A{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->sheet->getStyle("E{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->sheet->getStyle("J{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->sheet->getStyle("K{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->sheet->getStyle("D{$r}")->getAlignment()->setWrapText(true);

            $statusColor = match ($row['status_kib_key'] ?? '') {
                'aktif' => '166534',
                'expired' => '991B1B',
                'hampir_habis' => '92400E',
                default => '475569',
            };
            $this->sheet->getStyle("K{$r}")->getFont()->setBold(true)->getColor()->setRGB($statusColor);

            $this->sheet->getStyle("A{$r}:" . self::LAST_COL . "{$r}")->applyFromArray([
                'font' => ['size' => 9],
                'borders' => $this->thinBorder('E2E8F0'),
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $idx % 2 === 0 ? 'FFFFFF' : 'F8FAFC']],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);

            $this->row++;
        }
    }

    private function thinBorder(string $rgb): array
    {
        return [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => $rgb],
            ],
        ];
    }
}
