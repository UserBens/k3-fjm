<?php

namespace App\Console\Commands;

use App\Models\Datamedis;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportDataMedisCsv extends Command
{
    protected $signature = 'import:data-medis
        {path : Path absolut ke file CSV}
        {--limit=200 : Jumlah baris maksimal yang diimport (untuk uji coba)}
        {--offset=0 : Mulai dari baris ke-berapa (0-based, tidak termasuk header)}
        {--dry-run : Hanya tampilkan hasil parsing, tidak menyimpan ke database}
        {--delimiter=; : Karakter pemisah kolom CSV (";" untuk export lokal ID, "," untuk export standar)}
        {--no-header : File CSV tidak punya baris header (langsung data), pakai urutan kolom baku sheet Data Medis}';

    protected $description = 'Import data Medis dari CSV export Google Sheets ke tabel datamedis (kolom file disimpan sebagai link Google Drive, tidak didownload)';

    // Mapping: nama header di CSV => kolom di tabel datamedis
    private array $columnMap = [
        'Tanggal Pelaksanaan' => 'tanggal_pelaksanaan',
        'Area Kerja' => 'area_kerja',
        'Sub Area' => 'sub_area',
        'Unit Kerja' => 'unit_kerja',
        'Foto Evidence Kegiatan' => 'foto_evidence_path',
        'Upload Formulir Kegiatan' => 'formulir_kegiatan_path',
        'STATUS (APPROVE / REJECT / CANCEL)' => 'keputusan',
        'ARSIP (otomatis)' => 'arsip_path',
    ];

    // Kolom yang isinya berupa link Google Drive (disimpan sebagai link langsung, TIDAK didownload)
    private array $fileColumns = [
        'foto_evidence_path',
        'formulir_kegiatan_path',
    ];

    // Urutan kolom baku sheet Data Medis (dipakai kalau file CSV tidak punya baris header --no-header)
    private array $defaultHeaderOrder = [
        'Timestamp',
        'Tanggal Pelaksanaan',
        'Nama Tenaga Medis',
        'Area Kerja',
        'Sub Area',
        'Unit Kerja',
        'Jenis Aktifitas KPI',
        'Foto Evidence Kegiatan',
        'Upload Formulir Kegiatan',
        'STATUS (APPROVE / REJECT / CANCEL)',
        'ARSIP (otomatis)',
    ];

    public function handle(): int
    {
        $path = $this->argument('path');
        if (!file_exists($path)) {
            $this->error("File tidak ditemukan: {$path}");
            return self::FAILURE;
        }

        $limit = (int) $this->option('limit');
        $offset = (int) $this->option('offset');
        $dryRun = (bool) $this->option('dry-run');

        $delimiter = $this->resolveDelimiter($this->option('delimiter'));
        $noHeader = (bool) $this->option('no-header');

        $handle = fopen($path, 'r');
        $firstLine = fgets($handle);
        rewind($handle);

        // Auto-deteksi delimiter kalau yang di-set ternyata salah (cuma menghasilkan 1 kolom)
        $delimiter = $this->autoDetectDelimiter($firstLine, $delimiter);

        if ($noHeader) {
            $header = $this->defaultHeaderOrder;
            $this->info('Mode --no-header aktif: memakai urutan kolom baku (' . count($header) . ' kolom), tidak melompati baris pertama file.');
        } else {
            $header = fgetcsv($handle, 0, $delimiter);
            if (!$header || count($header) <= 1) {
                $this->error('Gagal membaca header CSV — cuma terbaca 1 kolom dengan delimiter "' . $this->delimiterLabel($delimiter) . '". Coba set manual: --delimiter=";" atau --delimiter="," atau --delimiter="\t" (tab). Kalau file Anda memang tidak punya baris header, pakai --no-header.');
                fclose($handle);
                return self::FAILURE;
            }
            $this->info('Delimiter terdeteksi: ' . $this->delimiterLabel($delimiter) . ' (' . count($header) . ' kolom)');
        }

        // Bersihkan UTF-8 BOM yang sering nempel di kolom pertama file CSV
        // hasil export Google Sheets/Excel (bikin header pertama, misal "Timestamp",
        // tidak match walau tampak sama secara visual)
        $header = array_map(
            fn($h) => trim(str_replace("\xEF\xBB\xBF", '', $h)),
            $header
        );
        $headerIndex = array_flip($header);

        $rowNum = 0;
        $imported = 0;
        $skipped = 0;

        $this->info("Mulai import (offset={$offset}, limit={$limit}, dry-run=" . ($dryRun ? 'ya' : 'tidak') . ")");
        $bar = $this->output->createProgressBar($limit);

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            if ($rowNum < $offset) {
                $rowNum++;
                continue;
            }
            if ($imported + $skipped >= $limit) {
                break;
            }
            $rowNum++;

            try {
                $data = $this->parseRow($row, $headerIndex);

                if ($dryRun) {
                    $this->newLine();
                    $this->line("Baris {$rowNum}: " . json_encode([
                        'waktu_submit' => $data['waktu_submit'] ?? null,
                        'tanggal_pelaksanaan' => $data['tanggal_pelaksanaan'] ?? null,
                        'badge_tenaga' => $data['badge_tenaga'] ?? null,
                        'nama_tenaga' => $data['nama_tenaga'] ?? null,
                        'jenis_aktifitas_kpi' => $data['jenis_aktifitas_kpi'] ?? null,
                        'keputusan' => $data['keputusan'] ?? null,
                    ], JSON_UNESCAPED_UNICODE));
                } else {
                    Datamedis::create($data);
                }

                $imported++;
            } catch (\Throwable $e) {
                $skipped++;
                $this->newLine();
                $this->warn("Baris {$rowNum} dilewati: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        fclose($handle);

        $this->newLine(2);
        $this->info("Selesai. Berhasil: {$imported}, Dilewati/error: {$skipped}.");

        return self::SUCCESS;
    }

    private function parseRow(array $row, array $headerIndex): array
    {
        $get = function (string $columnName) use ($row, $headerIndex) {
            $idx = $headerIndex[$columnName] ?? null;
            if ($idx === null || !isset($row[$idx])) return null;
            $val = trim($row[$idx]);
            return $val === '' ? null : $val;
        };

        // ── Tanggal Pelaksanaan (D/M/YYYY, format export lokal ID) ──
        $tanggalRaw = $get('Tanggal Pelaksanaan');
        $tanggal = $tanggalRaw ? $this->parseTanggalIndo($tanggalRaw)?->toDateString() : null;

        // ── Timestamp -> waktu_submit ──
        $timestampRaw = $get('Timestamp');
        $waktuSubmit = $timestampRaw ? $this->parseTanggalIndo($timestampRaw) : null;

        // ── Nama Tenaga Medis -> badge_tenaga + nama_tenaga (format "BADGE-Nama") ──
        $namaRaw = $get('Nama Tenaga Medis');
        $badge = null;
        $nama = null;
        if ($namaRaw && preg_match('/^([A-Za-z0-9.]+)-(.+)$/', $namaRaw, $m)) {
            $badge = trim($m[1]);
            $nama = trim($m[2]);
        } else {
            $nama = $namaRaw;
        }

        if (!$nama) {
            throw new \RuntimeException('Nama Tenaga Medis kosong — baris dilewati.');
        }

        // ── Jenis Aktifitas KPI: "[E.6] Laporan Inspeksi Kotak P3K" -> ambil nama saja (kolom string biasa, bukan FK) ──
        $jenisRaw = $get('Jenis Aktifitas KPI');
        $jenisAktifitas = $jenisRaw;
        if ($jenisRaw && preg_match('/^\[(.+?)\]\s*(.+)$/', $jenisRaw, $m)) {
            $jenisAktifitas = trim($m[2]);
        }

        $data = [
            'waktu_submit' => $waktuSubmit,
            'tanggal_pelaksanaan' => $tanggal,
            'badge_tenaga' => $badge,
            'nama_tenaga' => $nama,
            'jenis_aktifitas_kpi' => $jenisAktifitas,
            'keputusan' => $this->normalizeKeputusan($get('STATUS (APPROVE / REJECT / CANCEL)')),
        ];

        // ── Kolom teks & file lainnya (Area Kerja, Sub Area, Unit Kerja, Foto Evidence, Formulir Kegiatan) ──
        $handledManually = [
            'Timestamp',
            'Tanggal Pelaksanaan',
            'Nama Tenaga Medis',
            'Jenis Aktifitas KPI',
            'STATUS (APPROVE / REJECT / CANCEL)',
        ];
        foreach ($this->columnMap as $csvCol => $dbCol) {
            if (in_array($csvCol, $handledManually, true)) continue;
            if (in_array($dbCol, $this->fileColumns, true)) continue; // file ditangani terpisah di bawah
            $data[$dbCol] = $get($csvCol);
        }

        // ── Kolom file: simpan link Google Drive apa adanya, TIDAK didownload ──
        foreach ($this->fileColumns as $dbCol) {
            $csvCol = array_search($dbCol, $this->columnMap, true);
            if ($csvCol === false) continue;
            $link = $get($csvCol);
            if ($link) {
                $data[$dbCol] = $link;
            }
        }

        return array_filter($data, fn($v) => $v !== null) + [
            'keputusan' => $data['keputusan'] ?? 'PENDING',
            'nama_tenaga' => $data['nama_tenaga'],
        ];
    }

    /**
     * Parse tanggal/timestamp dari CSV export sheet Data Medis.
     * Sheet ini pakai format lokal Indonesia D/M/YYYY (tanggal/bulan/tahun),
     * sama seperti sheet Pelaporan Pengawas — beda dengan sheet Data Safety
     * yang M/D/YYYY (gaya export US Google Forms).
     *
     * Auto-detect per baris: default D/M/Y, hanya dianggap M/D/Y kalau angka
     * kedua > 12 (mustahil jadi bulan dalam urutan D/M/Y).
     * Contoh: "14/05/2026" = 14 Mei 2026, "02/06/2026" = 2 Juni 2026.
     */
    private function parseTanggalIndo(string $raw): ?Carbon
    {
        $raw = trim($raw);
        if ($raw === '') return null;

        // Pisahkan bagian tanggal & jam (jika ada)
        $parts = preg_split('/\s+/', $raw, 2);
        $datePart = $parts[0];
        $timePart = $parts[1] ?? '00:00:00';

        // Lengkapi detik kalau cuma H:i
        if (preg_match('/^\d{1,2}:\d{2}$/', $timePart)) {
            $timePart .= ':00';
        }

        if (!preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $datePart, $m)) {
            return null;
        }
        [, $first, $second, $year] = $m;

        // Default: D/M/Y. Kalau angka kedua > 12, urutan sebenarnya M/D/Y — tukar.
        if ((int) $second > 12) {
            $month = $first;
            $day = $second;
        } else {
            $day = $first;
            $month = $second;
        }

        try {
            return Carbon::createFromFormat(
                'Y-m-d H:i:s',
                sprintf('%04d-%02d-%02d %s', $year, $month, $day, $timePart)
            );
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Ubah representasi delimiter dari CLI ("\t", "tab") jadi karakter asli.
     */
    private function resolveDelimiter(string $raw): string
    {
        return match ($raw) {
            '\t', 'tab', 'TAB' => "\t",
            default => $raw,
        };
    }

    /**
     * Kalau delimiter yang diminta cuma menghasilkan 1 kolom, coba tebak
     * delimiter yang benar dari baris pertama (header) — pilih yang menghasilkan
     * jumlah kolom terbanyak di antara koma, titik-koma, tab, dan pipe.
     */
    private function autoDetectDelimiter(string $firstLine, string $requestedDelimiter): string
    {
        $candidates = [$requestedDelimiter, ',', ';', "\t", '|'];
        $best = $requestedDelimiter;
        $bestCount = 0;

        foreach (array_unique($candidates) as $delim) {
            $count = count(str_getcsv($firstLine, $delim));
            if ($count > $bestCount) {
                $bestCount = $count;
                $best = $delim;
            }
        }

        return $best;
    }

    private function delimiterLabel(string $delimiter): string
    {
        return match ($delimiter) {
            "\t" => '\t (tab)',
            ',' => ', (koma)',
            ';' => '; (titik-koma)',
            '|' => '| (pipe)',
            default => $delimiter,
        };
    }

    private function normalizeKeputusan(?string $status): string
    {
        $status = strtoupper((string) $status);
        return in_array($status, ['APPROVE', 'REJECT'], true) ? $status : 'PENDING';
    }
}