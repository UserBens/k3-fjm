<?php

namespace App\Imports;

use App\Models\MasterJadwalShift;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MasterJadwalShiftImport implements ToCollection, WithHeadingRow
{
    // Properti untuk menampung statistik & error
    public int $totalDibuat = 0;
    public int $totalDiperbarui = 0;
    public array $errors = [];

    /**
     * Memproses setiap baris dari file Excel
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Abaikan baris jika kolom tanggal kosong
            if (empty($row['tanggal'])) {
                continue;
            }

            try {
                // 1. Konversi Format Tanggal Excel / String ke Format Database (Y-m-d)
                $tanggal = $this->parseTanggal($row['tanggal']);

                // 2. Pemetaan Data Regu A, B, C, D dari Kolom Excel
                $regus = [
                    'A' => ['shift' => $row['shift_a'] ?? null, 'jam' => $row['jam_a'] ?? 0],
                    'B' => ['shift' => $row['shift_b'] ?? null, 'jam' => $row['jam_b'] ?? 0],
                    'C' => ['shift' => $row['shift_c'] ?? null, 'jam' => $row['jam_c'] ?? 0],
                    'D' => ['shift' => $row['shift_d'] ?? null, 'jam' => $row['jam_d'] ?? 0],
                ];

                $jamNd = $row['jam_nd'] ?? 0;

                // 3. Simpan/Update Data per Regu ke Database
                foreach ($regus as $regu => $data) {
                    if (empty($data['shift'])) {
                        continue;
                    }

                    $shift = strtoupper(trim($data['shift']));
                    // Jam Night Differential (ND) hanya diisi untuk shift Malam ('M')
                    $nd = ($shift === 'M') ? $jamNd : 0;

                    $existing = MasterJadwalShift::where('tanggal', $tanggal)
                        ->where('regu', $regu)
                        ->first();

                    if ($existing) {
                        $existing->update([
                            'kode_shift' => $shift,
                            'jam_kerja'  => $data['jam'],
                            'jam_nd'     => $nd
                        ]);
                        $this->totalDiperbarui++;
                    } else {
                        MasterJadwalShift::create([
                            'tanggal'    => $tanggal,
                            'regu'       => $regu,
                            'kode_shift' => $shift,
                            'jam_kerja'  => $data['jam'],
                            'jam_nd'     => $nd
                        ]);
                        $this->totalDibuat++;
                    }
                }
            } catch (\Exception $e) {
                // Catat error jika baris gagal diproses (Baris +2 karena header ada di baris 1)
                $barisKe = $index + 2; 
                $this->errors[] = "Baris {$barisKe}: " . $e->getMessage();
            }
        }
    }

    /**
     * Helper Parser Tanggal (Menangani Serial Number Excel & String dd/mm/yyyy)
     */
    private function parseTanggal($val): string
    {
        if (is_numeric($val)) {
            return Date::excelToDateTimeObject($val)->format('Y-m-d');
        }

        try {
            return Carbon::createFromFormat('d/m/Y', trim($val))->format('Y-m-d');
        } catch (\Exception $e) {
            return Carbon::parse($val)->format('Y-m-d');
        }
    }
}