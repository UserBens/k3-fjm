<?php

namespace App\Console\Commands;

use App\Models\DataUnsafe;
use App\Models\SafetyOfficer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportDataUnsafeCsv extends Command
{
    protected $signature = 'import:data-unsafe
        {path : Path absolut ke file CSV}
        {--limit=500 : Jumlah baris maksimal yang diimport (untuk uji coba)}
        {--offset=0 : Mulai dari baris ke-berapa (0-based, tidak termasuk header)}
        {--dry-run : Hanya tampilkan hasil parsing, tidak menyimpan ke database}
        {--delimiter=, : Karakter pemisah kolom CSV (";" untuk export lokal ID, "," untuk export standar)}
        {--sync-so : Sinkronkan badge Nama SO yang belum ada ke tabel safety_officers}';

    protected $description = 'Import data Unsafe Action/Unsafe Condition dari CSV export Google Sheets ke tabel data_unsafe. Kolom foto_temuan_path SENGAJA dikosongkan (null) saat import, diisi menyusul manual lewat aplikasi. Kolom dokumen_laporan_path tetap diisi dari link Google Drive di CSV.';

    // Mapping: nama header di CSV => kolom di tabel data_unsafe
    // Kolom "Nama SO" ditangani manual (dipecah jadi badge_so + nama_so)
    // Kolom "Foto Temuan UA/UC" SENGAJA TIDAK dimapping ke sini — lihat parseRow(),
    // foto_temuan_path selalu diisi null saat import.
    private array $columnMap = [
        'Tanggal'                   => 'tanggal_temuan',
        'Area Kerja'                => 'area_kerja',
        'Unit Kerja'                => 'unit_kerja',
        'Item Temuan'               => 'item_temuan',
        'Jenis Penyebab'            => 'jenis_penyebab',
        'Deskripsi Temuan'          => 'deskripsi_temuan',
        'Rekomendasi Perbaikan'     => 'rekomendasi_perbaikan',
        'Status Temuan'             => 'status_temuan',
        'Dokumen Laporan Kegiatan'  => 'dokumen_laporan_path',
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
        $syncSo = (bool) $this->option('sync-so');

        $delimiter = $this->resolveDelimiter($this->option('delimiter'));

        $handle = fopen($path, 'r');
        $firstLine = fgets($handle);
        rewind($handle);

        $delimiter = $this->autoDetectDelimiter($firstLine, $delimiter);

        $header = fgetcsv($handle, 0, $delimiter);
        if (!$header || count($header) <= 1) {
            $this->error('Gagal membaca header CSV — cuma terbaca 1 kolom dengan delimiter "' . $this->delimiterLabel($delimiter) . '". Coba set manual: --delimiter=";" atau --delimiter="," atau --delimiter="\t" (tab).');
            fclose($handle);
            return self::FAILURE;
        }
        $this->info('Delimiter terdeteksi: ' . $this->delimiterLabel($delimiter) . ' (' . count($header) . ' kolom)');

        // Bersihkan UTF-8 BOM yang sering nempel di kolom pertama hasil export
        $header = array_map(
            fn($h) => trim(str_replace("\xEF\xBB\xBF", '', $h)),
            $header
        );
        $headerIndex = array_flip($header);

        $this->comment('Catatan: kolom foto_temuan_path akan dikosongkan (null) untuk semua baris — upload foto dilakukan menyusul secara manual.');

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
                    $this->line("Baris {$rowNum}: " . json_encode($data, JSON_UNESCAPED_UNICODE));
                } else {
                    DataUnsafe::create($data);

                    if ($syncSo && !empty($data['badge_so'])) {
                        SafetyOfficer::updateOrCreate(
                            ['badge' => $data['badge_so']],
                            [
                                'assigned_at' => now(),
                                'assigned_by' => 'system:sync-import-unsafe',
                                'is_active' => true,
                            ]
                        );
                    }
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

        // ── Tanggal (format export Google Sheets bisa D/M/YYYY atau M/D/YYYY
        //    tergantung locale sheet, contoh data kamu berformat DD/MM/YYYY,
        //    misal "10/08/2026" = 10 Agustus 2026) ──
        $tanggalRaw = $get('Tanggal');
        $tanggal = $tanggalRaw ? $this->parseTanggal($tanggalRaw)?->toDateString() : null;

        // ── Nama SO -> badge_so + nama_so, contoh: "K.210283-ABDUL HAMID JUNAIDI" ──
        $namaSORaw = $get('Nama SO');
        $badge = null;
        $nama = null;
        if ($namaSORaw && preg_match('/^([A-Za-z0-9.]+)-(.+)$/', $namaSORaw, $m)) {
            $badge = trim($m[1]);
            $nama = trim($m[2]);
        } else {
            $nama = $namaSORaw;
        }

        // ── Status Temuan: normalisasi ke OPEN/CLOSE ──
        $status = strtoupper((string) $get('Status Temuan'));
        $status = in_array($status, ['OPEN', 'CLOSE'], true) ? $status : 'OPEN';

        $data = [
            'tanggal_temuan'          => $tanggal,
            'badge_so'                => $badge,
            'nama_so'                 => $nama,
            'area_kerja'              => $get('Area Kerja'),
            'unit_kerja'              => $get('Unit Kerja'),
            'item_temuan'             => $get('Item Temuan'),
            'jenis_penyebab'          => $get('Jenis Penyebab'),
            'deskripsi_temuan'        => $get('Deskripsi Temuan'),
            'rekomendasi_perbaikan'   => $get('Rekomendasi Perbaikan'),
            'status_temuan'           => $status,
            'dokumen_laporan_path'    => $get('Dokumen Laporan Kegiatan'),
        ];

        $data = array_filter($data, fn($v) => $v !== null) + ['status_temuan' => $status];

        // foto_temuan_path sengaja dikosongkan saat import, diisi menyusul
        // secara manual (misal lewat form upload di aplikasi)
        $data['foto_temuan_path'] = null;

        return $data;
    }

    /**
     * Parse tanggal format DD/MM/YYYY (sesuai contoh data: "10/08/2026" = 10 Agustus 2026).
     * Kalau CSV kamu ternyata format M/D/YYYY (locale US Google Sheets), ganti
     * urutan $day dan $month di bawah.
     */
    private function parseTanggal(string $raw): ?Carbon
    {
        $raw = trim($raw);
        if ($raw === '') return null;

        if (!preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $raw, $m)) {
            return null;
        }
        [, $day, $month, $year] = $m;

        try {
            return Carbon::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $year, $month, $day));
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function resolveDelimiter(string $raw): string
    {
        return match ($raw) {
            '\t', 'tab', 'TAB' => "\t",
            default => $raw,
        };
    }

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
}
