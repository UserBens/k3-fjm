<?php

namespace App\Imports;

use App\Models\MasterJadwalShift;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Import Master Jadwal Shift dari file .xlsx/.xls/.csv.
 *
 * Header wajib (case-insensitive, otomatis di-snake_case-kan oleh WithHeadingRow):
 * TANGGAL, SHIFT_A, JAM_A, SHIFT_B, JAM_B, SHIFT_C, JAM_C, SHIFT_D, JAM_D, JAM_ND
 *
 * Baris dengan tanggal yang sudah ada di database akan di-upsert (update),
 * baris dengan data tidak valid akan dilewati dan dicatat di $errors.
 */
class MasterJadwalShiftImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public int $successCount = 0;

    /** @var string[] */
    public array $errors = [];

    protected const SHIFT_CODES = ['P', 'S', 'M', 'O'];
    protected const SHIFT_KOLOM = ['shift_a', 'shift_b', 'shift_c', 'shift_d'];
    protected const JAM_KOLOM   = ['jam_a', 'jam_b', 'jam_c', 'jam_d', 'jam_nd'];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            // +1 karena heading row, +1 karena index dimulai dari 0
            $baris = $index + 2;

            $tanggalRaw = trim((string) ($row['tanggal'] ?? ''));
            if ($tanggalRaw === '') {
                $this->errors[] = "Baris {$baris}: kolom TANGGAL kosong, baris dilewati.";
                continue;
            }

            $tanggal = $this->parseTanggal($tanggalRaw);
            if (!$tanggal) {
                $this->errors[] = "Baris {$baris}: format tanggal '{$tanggalRaw}' tidak valid (gunakan dd/mm/yyyy), baris dilewati.";
                continue;
            }

            $data = [];
            $shiftInvalid = [];

            foreach (self::SHIFT_KOLOM as $kolom) {
                $original = $row[$kolom] ?? null;
                $normal = $this->normalizeShift($original);

                if ($original !== null && trim((string) $original) !== '' && $normal === null) {
                    $shiftInvalid[] = strtoupper($kolom) . " ('{$original}')";
                }

                $data[$kolom] = $normal;
            }

            if (!empty($shiftInvalid)) {
                $this->errors[] = "Baris {$baris} ({$tanggalRaw}): nilai shift tidak valid pada " . implode(', ', $shiftInvalid) . ' — harus P/S/M/O, baris dilewati.';
                continue;
            }

            foreach (self::JAM_KOLOM as $kolom) {
                $data[$kolom] = $this->normalizeJam($row[$kolom] ?? 0);
            }

            MasterJadwalShift::updateOrCreate(
                ['tanggal' => $tanggal->toDateString()],
                $data
            );

            $this->successCount++;
        }
    }

    protected function parseTanggal(string $value): ?Carbon
    {
        $value = str_replace('-', '/', trim($value));

        try {
            if (preg_match('#^\d{1,2}/\d{1,2}/\d{4}$#', $value)) {
                return Carbon::createFromFormat('d/m/Y', $value)->startOfDay();
            }

            // fallback: dukung tanggal Excel numeric/format lain
            return Carbon::parse($value)->startOfDay();
        } catch (\Throwable) {
            return null;
        }
    }

    protected function normalizeShift(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $v = strtoupper(trim((string) $value));

        if ($v === '') {
            return null;
        }

        return in_array($v, self::SHIFT_CODES, true) ? $v : null;
    }

    protected function normalizeJam(mixed $value): int
    {
        if ($value === null || trim((string) $value) === '') {
            return 0;
        }

        return max(0, min(24, (int) $value));
    }
}
