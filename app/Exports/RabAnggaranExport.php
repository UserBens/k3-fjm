<?php

namespace App\Exports;

use App\Models\RabAnggaran;
use App\Models\RabAnggaranItem;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RabAnggaranExport
{
    private Spreadsheet $spreadsheet;
    private $sheet;
    private int $row = 1;

    // A..P = 16 kolom (No, Kode OK, Jabatan, Jenis, Kategori, Merk/Type, Spesifikasi, Ukuran,
    // Qty Ada, Qty Butuh, Qty Pengadaan, Satuan, Harga Satuan, Total Harga, Keterangan, Prioritas)
    const LAST_COL = 'P';

    const COLOR_TITLE_BG   = '1E3A8A'; // biru tua — kop judul
    const COLOR_KOP_LABEL  = 'EFF6FF'; // biru muda — label kop
    const COLOR_KOP_BORDER = 'BFDBFE';
    const COLOR_SECTION_BG = '312E81'; // ungu tua — judul section A/B
    const COLOR_HEADER_BG  = '6D28D9'; // ungu — header tabel
    const COLOR_SUBTOTAL_BG = 'F1F5F9';
    const COLOR_GRANDTOTAL_BG = 'FEF3C7';
    const COLOR_GRANDTOTAL_BORDER = 'FDE68A';

    public function build(RabAnggaran $rab): Spreadsheet
    {
        $rab->load(['items' => fn($q) => $q->orderBy('id')]);

        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
        $this->sheet->setTitle('RAB APD & Alkes');
        $this->sheet->getSheetView()->setZoomScale(90);

        $this->setColumnWidths();
        $this->writeTitle();
        $this->row++;
        $this->writeKopInfo($rab);
        $this->row++;

        $itemsApd = $rab->items->where('jenis', 'APD')->values();
        $itemsAlkes = $rab->items->where('jenis', 'ALKES')->values();

        $subtotalApd = $itemsApd->sum(fn(RabAnggaranItem $i) => $i->qty_pengadaan * $i->harga_satuan);
        $subtotalAlkes = $itemsAlkes->sum(fn(RabAnggaranItem $i) => $i->qty_pengadaan * $i->harga_satuan);

        $this->writeSectionTitle('A. KEBUTUHAN APD BERDASARKAN KODE OK DAN JABATAN');
        $this->writeTableHeader('APD');
        $this->writeItems($itemsApd);
        $this->writeSubtotalRow('SUBTOTAL A (APD)', $subtotalApd);
        $this->row++;

        $this->writeSectionTitle('B. KEBUTUHAN ALAT KESEHATAN & CONSUMABLE');
        $this->writeTableHeader('ALKES');
        $this->writeItems($itemsAlkes);
        $this->writeSubtotalRow('SUBTOTAL B (ALKES)', $subtotalAlkes);
        $this->row++;

        $this->writeGrandTotal($rab->tahun_anggaran, $subtotalApd + $subtotalAlkes);

        $this->sheet->setSelectedCell('A1');
        $this->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $this->sheet->getPageSetup()->setFitToWidth(1);
        $this->sheet->getPageSetup()->setFitToHeight(0);

        return $this->spreadsheet;
    }

    private function setColumnWidths(): void
    {
        $widths = [
            'A' => 5,
            'B' => 12,
            'C' => 20,
            'D' => 24,
            'E' => 12,
            'F' => 18,
            'G' => 28,
            'H' => 10,
            'I' => 8,
            'J' => 8,
            'K' => 10,
            'L' => 9,
            'M' => 15,
            'N' => 15,
            'O' => 22,
            'P' => 11,
        ];

        foreach ($widths as $col => $w) {
            $this->sheet->getColumnDimension($col)->setWidth($w);
        }
    }

    private function writeTitle(): void
    {
        $this->sheet->mergeCells("A{$this->row}:" . self::LAST_COL . "{$this->row}");
        $cell = "A{$this->row}";
        $this->sheet->setCellValue($cell, 'RENCANA ANGGARAN BIAYA (RAB) — PENGAJUAN ASET APD & ALAT KESEHATAN TAHUNAN');
        $this->sheet->getStyle($cell)->applyFromArray([
            'font' => ['bold' => true, 'size' => 13, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::COLOR_TITLE_BG]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $this->sheet->getRowDimension($this->row)->setRowHeight(26);
    }

    private function writeKopInfo(RabAnggaran $rab): void
    {
        $this->writeKopRow([
            ['Nama Perusahaan', $rab->nama_perusahaan],
            ['Departemen', $rab->departemen],
            ['Tahun Anggaran', $rab->tahun_anggaran],
            ['Nomor RAB', $rab->nomor_rab],
        ]);

        $this->writeKopRow([
            ['Dibuat Oleh', $rab->dibuat_oleh],
            ['Disetujui Oleh', $rab->disetujui_oleh],
            ['Tanggal Pengajuan', optional($rab->tanggal_pengajuan)->format('d/m/Y')],
            ['Status', $rab->status],
        ]);
    }

    private function writeKopRow(array $pairs): void
    {
        $colGroups = [['A', 'D'], ['E', 'H'], ['I', 'L'], ['M', 'P']];
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

    private function writeTableHeader(string $jenis): void
    {
        $labelJenis = $jenis === 'APD' ? 'JENIS APD' : 'JENIS ALAT';

        $headers = [
            'NO',
            'KODE OK',
            'JABATAN/POSISI',
            $labelJenis,
            'KATEGORI',
            'MERK/TYPE',
            'SPESIFIKASI',
            'UKURAN',
            'QTY ADA',
            'QTY BUTUH',
            'QTY PENGADAAN',
            'SATUAN',
            'HARGA SATUAN (Rp)',
            'TOTAL HARGA (Rp)',
            'KETERANGAN',
            'PRIORITAS',
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
        $this->sheet->getRowDimension($this->row)->setRowHeight(28);
        $this->row++;
    }

    private function writeItems(Collection $items): void
    {
        if ($items->isEmpty()) {
            $this->sheet->mergeCells("A{$this->row}:" . self::LAST_COL . "{$this->row}");
            $this->sheet->setCellValue("A{$this->row}", 'Belum ada item.');
            $this->sheet->getStyle("A{$this->row}")->applyFromArray([
                'font' => ['italic' => true, 'color' => ['rgb' => '94A3B8']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => $this->thinBorder('E2E8F0'),
            ]);
            $this->row++;
            return;
        }

        foreach ($items as $idx => $item) {
            /** @var RabAnggaranItem $item */
            $totalHarga = $item->qty_pengadaan * $item->harga_satuan;
            $r = $this->row;

            $values = [
                'A' => $idx + 1,
                'B' => $item->kode_ok ?: '-',
                'C' => $item->jabatan_posisi ?: '-',
                'D' => $item->nama_barang,
                'E' => $item->kategori ?: '-',
                'F' => $item->merk_type ?: '-',
                'G' => $item->spesifikasi ?: '-',
                'H' => $item->ukuran ?: '-',
                'I' => $item->qty_ada,
                'J' => $item->qty_butuh,
                'K' => $item->qty_pengadaan,
                'L' => $item->satuan ?: '-',
                'M' => (float) $item->harga_satuan,
                'N' => (float) $totalHarga,
                'O' => $item->keterangan ?: '-',
                'P' => $item->prioritas,
            ];

            foreach ($values as $col => $val) {
                $this->sheet->setCellValue("{$col}{$r}", $val);
            }

            $this->sheet->getStyle("M{$r}")->getNumberFormat()->setFormatCode('#,##0');
            $this->sheet->getStyle("N{$r}")->getNumberFormat()->setFormatCode('#,##0');
            $this->sheet->getStyle("N{$r}")->getFont()->setBold(true);

            $this->sheet->getStyle("I{$r}:K{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->sheet->getStyle("A{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->sheet->getStyle("P{$r}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->sheet->getStyle("G{$r}:G{$r}")->getAlignment()->setWrapText(true);
            $this->sheet->getStyle("O{$r}:O{$r}")->getAlignment()->setWrapText(true);

            $this->sheet->getStyle("A{$r}:" . self::LAST_COL . "{$r}")->applyFromArray([
                'font' => ['size' => 9],
                'borders' => $this->thinBorder('E2E8F0'),
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $idx % 2 === 0 ? 'FFFFFF' : 'F8FAFC']],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);

            $this->row++;
        }
    }

    private function writeSubtotalRow(string $label, float $total): void
    {
        $r = $this->row;

        $this->sheet->mergeCells("A{$r}:M{$r}");
        $this->sheet->setCellValue("A{$r}", $label);
        $this->sheet->getStyle("A{$r}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $this->sheet->setCellValue("N{$r}", $total);
        $this->sheet->getStyle("N{$r}")->getNumberFormat()->setFormatCode('#,##0');
        $this->sheet->getStyle("N{$r}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 10],
        ]);

        $this->sheet->mergeCells("O{$r}:P{$r}");

        $this->sheet->getStyle("A{$r}:" . self::LAST_COL . "{$r}")->applyFromArray([
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::COLOR_SUBTOTAL_BG]],
            'borders' => $this->thinBorder('CBD5E1'),
        ]);
        $this->sheet->getRowDimension($r)->setRowHeight(20);

        $this->row++;
    }

    private function writeGrandTotal(string $tahun, float $grandTotal): void
    {
        $r = $this->row;

        $this->sheet->mergeCells("A{$r}:K{$r}");
        $this->sheet->setCellValue("A{$r}", "GRAND TOTAL RAB APD & ALKES TAHUN {$tahun}");
        $this->sheet->getStyle("A{$r}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '78350F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
        ]);

        $this->sheet->mergeCells("L{$r}:" . self::LAST_COL . "{$r}");
        $this->sheet->setCellValue("L{$r}", $grandTotal);
        $this->sheet->getStyle("L{$r}")->getNumberFormat()->setFormatCode('"Rp" #,##0');
        $this->sheet->getStyle("L{$r}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 13, 'color' => ['rgb' => '78350F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $this->sheet->getStyle("A{$r}:" . self::LAST_COL . "{$r}")->applyFromArray([
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::COLOR_GRANDTOTAL_BG]],
            'borders' => $this->thinBorder(self::COLOR_GRANDTOTAL_BORDER),
        ]);
        $this->sheet->getRowDimension($r)->setRowHeight(24);

        $this->row++;
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
