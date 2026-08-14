<?php

namespace App\Console\Commands;

use App\Models\AktivitasKpiK3;
use App\Models\PelaporanPengawas;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportDataPengawasCsv extends Command
{
    protected $signature = 'import:data-pengawas
        {path : Path absolut ke file CSV}
        {--limit=200 : Jumlah baris maksimal yang diimport (untuk uji coba)}
        {--offset=0 : Mulai dari baris ke-berapa (0-based, tidak termasuk header)}
        {--dry-run : Hanya tampilkan hasil parsing, tidak menyimpan ke database}
        {--delimiter=; : Karakter pemisah kolom CSV (";" untuk export lokal ID, "," untuk export standar)}
        {--no-header : File CSV tidak punya baris header (langsung data), pakai urutan kolom baku sheet Pelaporan Pengawas}';

    protected $description = 'Import data Pelaporan Pengawas dari CSV export Google Sheets ke tabel pelaporan_pengawas (kolom file disimpan sebagai link Google Drive, tidak didownload)';

    // Mapping: nama header di CSV => kolom di tabel pelaporan_pengawas
    private array $columnMap = [
        'Tanggal Pelaksanaan' => 'tanggal_pelaksanaan',
        'Area Kerja' => 'area_kerja',
        'Sub Area' => 'sub_area',
        'Unit Kerja' => 'unit_kerja',
        'Keterangan Bahaya (Nearmiss)' => 'keterangan_bahaya',
        'Upload Foto Temuan Bahaya (Nearmiss)' => 'foto_temuan_bahaya',
        'Materi Safety Briefing' => 'materi_safety_briefing',
        'Upload Foto Kegiatan Safety Briefing' => 'foto_kegiatan_safety_briefing',
        'Upload Formulir Presensi Safety Briefing (PDF)' => 'formulir_presensi_pdf',
        'STATUS (APPROVE / REJECT / CANCEL)' => 'status',
        'LOKASI BERKAS (otomatis)' => 'lokasi_berkas',
        'DIPERIKSA OLEH (otomatis)' => 'diperiksa_oleh',
    ];

    // Kolom yang isinya berupa link Google Drive (disimpan sebagai link langsung, TIDAK didownload)
    private array $fileColumns = [
        'foto_temuan_bahaya',
        'foto_kegiatan_safety_briefing',
        'formulir_presensi_pdf',
    ];

    // Urutan kolom baku sheet Pelaporan Pengawas (dipakai kalau file CSV tidak punya baris header --no-header)
    private array $defaultHeaderOrder = [
        'Timestamp',
        'Tanggal Pelaksanaan',
        'Nama Pengawas',
        'Area Kerja',
        'Sub Area',
        'Unit Kerja',
        'Jenis Aktifitas KPI',
        'Keterangan Bahaya (Nearmiss)',
        'Upload Foto Temuan Bahaya (Nearmiss)',
        'Materi Safety Briefing',
        'Upload Foto Kegiatan Safety Briefing',
        'Upload Formulir Presensi Safety Briefing (PDF)',
        'STATUS (APPROVE / REJECT / CANCEL)',
        'LOKASI BERKAS (otomatis)',
        'DIPERIKSA OLEH (otomatis)',
    ];

    // Cache lookup nama_aktivitas -> id, supaya tidak query berulang tiap baris
    private array $aktivitasCache = [];

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
                        'tanggal_pelaksanaan' => $data['tanggal_pelaksanaan'] ?? null,
                        'badge_pengawas' => $data['badge_pengawas'] ?? null,
                        'nama_pengawas' => $data['nama_pengawas'] ?? null,
                        'aktivitas_kpi_k3_id' => $data['aktivitas_kpi_k3_id'] ?? null,
                        'id_laporan' => $data['id_laporan'] ?? null,
                        'status' => $data['status'] ?? null,
                    ], JSON_UNESCAPED_UNICODE));
                } else {
                    PelaporanPengawas::create($data);
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

        // ── Tanggal Pelaksanaan (M/D/YYYY, format export Google Sheets, boleh tanpa leading zero) ──
        $tanggalRaw = $get('Tanggal Pelaksanaan');
        $tanggal = $tanggalRaw ? $this->parseTanggalIndo($tanggalRaw)?->toDateString() : null;

        // ── Nama Pengawas -> badge_pengawas + nama_pengawas (format "BADGE-Nama", sama seperti Nama Safety Officer) ──
        $namaPengawasRaw = $get('Nama Pengawas');
        $badge = null;
        $nama = null;
        if ($namaPengawasRaw && preg_match('/^([A-Za-z0-9.]+)-(.+)$/', $namaPengawasRaw, $m)) {
            $badge = trim($m[1]);
            $nama = trim($m[2]);
        } else {
            $nama = $namaPengawasRaw;
        }

        // ── Jenis Aktifitas KPI: "[D.1] Laporan Nearmiss" -> cari id di master aktivitas_kpi_k3 ──
        $jenisRaw = $get('Jenis Aktifitas KPI');
        $aktivitasId = $this->resolveAktivitasId($jenisRaw);

        $timestampRaw = $get('Timestamp');
        $waktuSubmit = $timestampRaw ? $this->parseTanggalIndo($timestampRaw) : null;

        // ── TANGGAL DIPERIKSA (otomatis), kalau ada di sumber lain ──
        $data = [
            'tanggal_pelaksanaan' => $tanggal,
            'waktu_submit'        => $waktuSubmit, // ← BARU
            'badge_pengawas' => $badge,
            'nama_pengawas' => $nama,
            'aktivitas_kpi_k3_id' => $aktivitasId,
            'id_laporan' => $this->generateIdLaporan(),
            'status' => $this->normalizeStatus($get('STATUS (APPROVE / REJECT / CANCEL)')),
            'lokasi_berkas' => $get('LOKASI BERKAS (otomatis)') ?? 'ARSIP',
            'diperiksa_oleh' => $get('DIPERIKSA OLEH (otomatis)'),
        ];

        if (!$aktivitasId) {
            throw new \RuntimeException("Jenis Aktifitas KPI \"{$jenisRaw}\" tidak ditemukan di master aktivitas_kpi_k3.");
        }

        // ── Kolom teks & file lainnya (Area Kerja, Sub Area, Unit Kerja, Nearmiss, Safety Briefing) ──
        $handledManually = [
            'Tanggal Pelaksanaan',
            'Nama Pengawas',
            'Jenis Aktifitas KPI',
            'STATUS (APPROVE / REJECT / CANCEL)',
            'LOKASI BERKAS (otomatis)',
            'DIPERIKSA OLEH (otomatis)',
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
            'status' => $data['status'] ?? 'PENDING', // dikembalikan
            'lokasi_berkas' => $data['lokasi_berkas'] ?? 'ARSIP',
            'aktivitas_kpi_k3_id' => $data['aktivitas_kpi_k3_id'],
            'id_laporan' => $data['id_laporan'],
        ];
    }

    /**
     * Cari aktivitas_kpi_k3_id dari teks "Jenis Aktifitas KPI", mis. "[D.1] Laporan Nearmiss".
     * Dicocokkan ke kode dulu (paling akurat), baru fallback ke nama_aktivitas ternormalisasi,
     * supaya tidak kena bug normalisasi teks yang pernah ditemukan di Dashboard KPI K3
     * (beda kata "Pelaporan" bikin match gagal).
     */
    private function resolveAktivitasId(?string $jenisRaw): ?int
    {
        if (!$jenisRaw) return null;

        $kode = null;
        $namaBersih = $jenisRaw;
        if (preg_match('/^\[(.+?)\]\s*(.+)$/', $jenisRaw, $m)) {
            $kode = trim($m[1]);
            $namaBersih = trim($m[2]);
        }

        $cacheKey = $kode ?: $this->normalisasiTeks($namaBersih);
        if (array_key_exists($cacheKey, $this->aktivitasCache)) {
            return $this->aktivitasCache[$cacheKey];
        }

        $id = null;

        if ($kode) {
            $id = AktivitasKpiK3::where('kode', $kode)->value('id');
        }

        if (!$id) {
            $target = $this->normalisasiTeks($namaBersih);
            $id = AktivitasKpiK3::get(['id', 'nama_aktivitas'])
                ->first(fn($a) => $this->normalisasiTeks($a->nama_aktivitas) === $target)
                ?->id;
        }

        $this->aktivitasCache[$cacheKey] = $id;

        return $id;
    }

    private function normalisasiTeks(string $text): string
    {
        $text = strtolower($text);
        $text = str_replace(['/', '  '], [' ', ' '], $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    /**
     * Generate id_laporan unik, format: PP-YYYYMMDD-XXXX.
     */
    private function generateIdLaporan(): string
    {
        do {
            $candidate = 'PP-' . now()->format('Ymd') . '-' . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (PelaporanPengawas::where('id_laporan', $candidate)->exists());

        return $candidate;
    }

    /**
     * Parse tanggal/timestamp dari CSV export sheet Pelaporan Pengawas.
     * Sheet ini pakai format lokal Indonesia D/M/YYYY (tanggal/bulan/tahun),
     * beda dengan sheet Data Safety yang M/D/YYYY (gaya export US Google Forms) —
     * jadi jangan disamakan asumsi formatnya.
     *
     * Untuk jaga-jaga kalau di masa depan file bercampur format, dilakukan
     * auto-detect per baris: angka pertama > 12 dipastikan itu TANGGAL (karena
     * tidak mungkin jadi bulan), sehingga urutannya D/M/Y. Kalau angka pertama
     * <= 12 (ambigu), default ke D/M/Y sesuai format sheet ini.
     * Contoh: "22/05/2026" = 22 Mei 2026, "3/6/2026" = 3 Juni 2026.
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

        // Default format sheet ini: D/M/Y (angka pertama = tanggal, kedua = bulan).
        // Hanya dianggap M/D/Y kalau angka kedua > 12 (mustahil jadi bulan dalam
        // urutan D/M/Y), berarti urutan sebenarnya terbalik.
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

    private function normalizeStatus(?string $status): string
    {
        $status = strtoupper((string) $status);
        return in_array($status, ['APPROVE', 'REJECT', 'CANCEL'], true) ? $status : 'PENDING'; // dikembalikan
    }
}
