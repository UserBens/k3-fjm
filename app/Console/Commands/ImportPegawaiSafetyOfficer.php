<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use App\Models\SafetyOfficer;
use App\Models\SafetyOfficerPegawai;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPegawaiSafetyOfficer extends Command
{
    protected $signature = 'import:pegawai-safety-officer
        {path : Path absolut ke file CSV}
        {--limit=1000 : Jumlah baris maksimal yang diimport}
        {--offset=0 : Mulai dari baris ke-berapa (0-based, tidak termasuk header)}
        {--dry-run : Hanya tampilkan hasil parsing, tidak menyimpan ke database}
        {--delimiter=; : Karakter pemisah kolom CSV (";" atau ",")}';

    protected $description = 'Import data pegawai (tenaga binaan) beserta penugasan Safety Officer & info KIB dari CSV export sheet Data Safety. '
        . 'Hanya meng-update pegawai yang SUDAH ada (hasil sync:pegawai) — tidak pernah membuat baris pegawai baru, untuk mencegah duplikasi id_api.';

    // Mapping header CSV => informasi yang dipakai
    private array $columnMap = [
        'ID_KARYAWAN' => 'id_karyawan',
        'NOMOR_KTP' => 'nomor_ktp',
        'NOMOR_KIB' => 'nomor_kib',
        'MASA_BERLAKU_KIB' => 'masa_berlaku_kib',
        'SISA_HARI_KIB' => 'sisa_hari_kib', // tidak disimpan, informatif saja
        'STATUS_KIB' => 'status_kib',
        'NAMA_KARYAWAN' => 'nama_karyawan',
        'JABATAN' => 'jabatan',
        'ZONASI' => 'zonasi',
        'JALAN' => 'jalan',
        'RT/RW' => 'rt_rw',
        'KELURAHAN/DESA' => 'kelurahan',
        'KECAMATAN' => 'kecamatan',
        'KABUPATEN/KOTA' => 'kabupaten_kota',
        'NAMA_SAFETY_OFFICER' => 'nama_safety_officer',
    ];

    // Kolom yang juga diisi sync:pegawai dari API ERP — CSV hanya boleh
    // mengisi kalau kolom masih kosong, tidak boleh menimpa data ERP.
    // CATATAN: kecamatan & kelurahan SENGAJA TIDAK di sini — nilai yang
    // diisi sync:pegawai untuk dua kolom itu ternyata berupa kode wilayah
    // ERP (mis. "35.25.16.1006"), bukan nama yang bisa dibaca. Untuk
    // keperluan memo KIB, CSV (yang berisi nama asli) harus selalu menang.
    private const FILL_ONLY_IF_EMPTY = ['jabatan', 'rt', 'rw'];

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

        $handle = fopen($path, 'r');
        $firstLine = fgets($handle);
        rewind($handle);

        $delimiter = $this->autoDetectDelimiter($firstLine, $this->resolveDelimiter($this->option('delimiter')));

        $header = fgetcsv($handle, 0, $delimiter);
        if (!$header || count($header) <= 1) {
            $this->error('Gagal membaca header CSV. Coba set manual --delimiter=";" atau --delimiter=",".');
            fclose($handle);
            return self::FAILURE;
        }

        $header = array_map(fn($h) => trim(str_replace("\xEF\xBB\xBF", '', $h)), $header);
        $headerIndex = array_flip($header);

        $this->info('Delimiter terdeteksi: ' . $this->delimiterLabel($delimiter) . ' (' . count($header) . ' kolom)');

        $missingRequired = array_diff(array_keys($this->columnMap), array_keys($headerIndex));
        if (!empty($missingRequired)) {
            $this->warn('Kolom berikut tidak ditemukan di header CSV dan akan diabaikan: ' . implode(', ', $missingRequired));
        }

        $rowNum = 0;
        $imported = 0;
        $skipped = 0;
        $ktpCorrupted = [];
        $pegawaiTidakDitemukan = [];
        $soTidakDitemukan = [];

        $this->info("Mulai import (offset={$offset}, limit={$limit}, dry-run=" . ($dryRun ? 'ya' : 'tidak') . ")");
        $bar = $this->output->createProgressBar($limit);

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                if ($rowNum < $offset) {
                    $rowNum++;
                    continue;
                }
                if ($imported + $skipped >= $limit) {
                    break;
                }
                $rowNum++;

                // Lewati baris kosong
                if (count(array_filter($row, fn($v) => trim((string) $v) !== '')) === 0) {
                    continue;
                }

                try {
                    $parsed = $this->parseRow($row, $headerIndex);

                    if ($parsed['ktp_corrupted']) {
                        $ktpCorrupted[] = $parsed['badge_tenaga'];
                    }

                    if ($dryRun) {
                        $this->newLine();
                        $this->line("Baris {$rowNum}: " . json_encode($parsed, JSON_UNESCAPED_UNICODE));
                        $imported++;
                        $bar->advance();
                        continue;
                    }

                    $result = $this->applyRow($parsed);

                    if ($result === 'pegawai_missing') {
                        $pegawaiTidakDitemukan[] = $parsed['badge_tenaga'];
                        $skipped++;
                    } elseif ($result === 'so_missing') {
                        $soTidakDitemukan[] = $parsed['badge_so'];
                        $skipped++;
                    } else {
                        $imported++;
                    }
                } catch (\Throwable $e) {
                    $skipped++;
                    $this->newLine();
                    $this->warn("Baris {$rowNum} dilewati: " . $e->getMessage());
                }

                $bar->advance();
            }

            if ($dryRun) {
                DB::rollBack();
            } else {
                DB::commit();
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            fclose($handle);
            $this->newLine(2);
            $this->error('Import dibatalkan karena error fatal: ' . $e->getMessage());
            return self::FAILURE;
        }

        $bar->finish();
        fclose($handle);

        $this->newLine(2);
        $this->info("Selesai. Berhasil: {$imported}, Dilewati/error: {$skipped}.");

        if (!empty($pegawaiTidakDitemukan)) {
            $this->warn('Badge pegawai tidak ditemukan di tabel pegawais — jalankan sync:pegawai dulu, lalu import ulang: ' . implode(', ', array_unique($pegawaiTidakDitemukan)));
        }
        if (!empty($soTidakDitemukan)) {
            $this->warn('Badge Safety Officer tidak ditemukan di tabel pegawais — jalankan sync:pegawai dulu, lalu import ulang: ' . implode(', ', array_unique($soTidakDitemukan)));
        }
        if (!empty($ktpCorrupted)) {
            $this->warn('NOMOR_KTP berformat notasi ilmiah (rusak akibat export Excel/Sheets, presisi digit hilang) sehingga DILEWATI/tidak diisi untuk badge: ' . implode(', ', array_unique($ktpCorrupted)) . '. Silakan input ulang manual dari sumber data asli.');
        }

        return self::SUCCESS;
    }

    /**
     * Parse satu baris CSV jadi array data siap pakai.
     */
    private function parseRow(array $row, array $headerIndex): array
    {
        $get = function (string $columnName) use ($row, $headerIndex) {
            $idx = $headerIndex[$columnName] ?? null;
            if ($idx === null || !isset($row[$idx])) return null;
            $val = trim((string) $row[$idx]);
            return $val === '' ? null : $val;
        };

        $badgeTenaga = $get('ID_KARYAWAN');
        $namaTenaga = $get('NAMA_KARYAWAN');

        // ── NOMOR_KTP: deteksi notasi ilmiah rusak (mis. "3,52516E+15") ──
        $ktpRaw = $get('NOMOR_KTP');
        $ktpCorrupted = false;
        $noKtp = null;
        if ($ktpRaw !== null) {
            $normalized = str_replace(',', '.', $ktpRaw);
            if (preg_match('/E\+?\d+$/i', $normalized) || preg_match('/^\d+\.\d+E\+\d+$/i', $normalized)) {
                $ktpCorrupted = true;
                $noKtp = null;
            } else {
                $noKtp = preg_replace('/\D/', '', $ktpRaw) ?: null;
            }
        }

        // ── MASA_BERLAKU_KIB: DD/MM/YYYY ──
        $masaBerlakuRaw = $get('MASA_BERLAKU_KIB');
        $masaBerlaku = $masaBerlakuRaw ? $this->parseTanggalDMY($masaBerlakuRaw)?->toDateString() : null;

        // ── NAMA_SAFETY_OFFICER: "K.202737-ARI ANGGI WICAKSONO" -> badge + nama ──
        $namaSO = $get('NAMA_SAFETY_OFFICER');
        $badgeSO = null;
        $namaSOOnly = null;
        if ($namaSO && preg_match('/^([A-Za-z0-9.]+)-(.+)$/', $namaSO, $m)) {
            $badgeSO = trim($m[1]);
            $namaSOOnly = trim($m[2]);
        }

        $rtRwRaw = $get('RT/RW'); // format "003/003"
        $rt = null;
        $rw = null;
        if ($rtRwRaw && str_contains($rtRwRaw, '/')) {
            [$rt, $rw] = array_map('trim', explode('/', $rtRwRaw, 2));
        } elseif ($rtRwRaw) {
            $rt = $rtRwRaw; // fallback kalau format tidak sesuai
        }

        return [
            'badge_tenaga' => $badgeTenaga,
            'nama_tenaga' => $namaTenaga,
            'no_ktp' => $noKtp,
            'ktp_corrupted' => $ktpCorrupted,
            'nomor_kib' => $get('NOMOR_KIB'),
            'masa_berlaku_kib' => $masaBerlaku,
            'status_kib' => $get('STATUS_KIB'),
            'jabatan' => $get('JABATAN'),
            'zonasi' => $get('ZONASI'),
            'jalan' => $get('JALAN'),
            'rt' => $rt,
            'rw' => $rw,
            'kelurahan' => $get('KELURAHAN/DESA'),
            'kecamatan' => $get('KECAMATAN'),
            'kabupaten_kota' => $get('KABUPATEN/KOTA'),
            'badge_so' => $badgeSO,
            'nama_so' => $namaSOOnly,
        ];
    }

    /**
     * Terapkan satu baris hasil parsing ke database:
     * - update data pegawai (tenaga) beserta info KIB & alamat — TIDAK PERNAH membuat pegawai baru
     * - pastikan pegawai SO ada & berstatus Safety Officer — TIDAK PERNAH membuat SO baru
     * - assign tenaga ke SO tersebut (1 tenaga = 1 SO, penugasan lama dihapus)
     */
    private function applyRow(array $parsed): string
    {
        if (empty($parsed['badge_tenaga'])) {
            return 'pegawai_missing';
        }

        $pegawai = Pegawai::where('badge', $parsed['badge_tenaga'])->first();
        if (!$pegawai) {
            return 'pegawai_missing';
        }

        if ($parsed['nama_tenaga']) {
            $pegawai->nama = $parsed['nama_tenaga'];
        }
        if ($parsed['no_ktp']) {
            $pegawai->no_ktp = $parsed['no_ktp'];
        }
        if ($parsed['nomor_kib']) {
            $pegawai->nomor_kib = $parsed['nomor_kib'];
        }
        if ($parsed['masa_berlaku_kib']) {
            $pegawai->masa_berlaku_kib = $parsed['masa_berlaku_kib'];
        }
        if ($parsed['status_kib']) {
            $pegawai->status_kib = $parsed['status_kib'];
        }

        // Field murni milik CSV, atau field yang nilai ERP-nya tidak
        // dapat dipakai untuk memo (kode wilayah, bukan nama) — selalu update.
        if ($parsed['zonasi']) {
            $pegawai->zonasi = $parsed['zonasi'];
        }
        if ($parsed['jalan']) {
            $pegawai->jalan = $parsed['jalan'];
        }
        if ($parsed['kabupaten_kota']) {
            $pegawai->kabupaten_kota = $parsed['kabupaten_kota'];
        }
        if ($parsed['kecamatan']) {
            $pegawai->kecamatan = $parsed['kecamatan'];
        }
        if ($parsed['kelurahan']) {
            $pegawai->kelurahan = $parsed['kelurahan'];
        }

        // Field yang juga diisi sync:pegawai dari ERP dengan nilai yang valid — jangan timpa kalau sudah terisi.
        $this->fillIfEmpty($pegawai, 'jabatan', $parsed['jabatan']);
        $this->fillIfEmpty($pegawai, 'rt', $parsed['rt']);
        $this->fillIfEmpty($pegawai, 'rw', $parsed['rw']);

        $pegawai->save();

        // ── Safety Officer ──
        if (empty($parsed['badge_so'])) {
            return 'ok'; // tidak ada info SO di baris ini, cukup update data pegawai saja
        }

        $so = Pegawai::where('badge', $parsed['badge_so'])->first();
        if (!$so) {
            return 'so_missing';
        }

        if (!$so->is_safety_officer) {
            $so->is_safety_officer = true;
            $so->safety_officer_since = $so->safety_officer_since ?? now();
            $so->save();
        }

        SafetyOfficer::updateOrCreate(
            ['badge' => $so->badge],
            [
                'assigned_at' => now(),
                'assigned_by' => 'system:import-csv',
                'is_active' => true,
            ]
        );

        // Satu tenaga hanya dibina satu SO — hapus penugasan lama, buat yang baru
        SafetyOfficerPegawai::where('pegawai_id', $pegawai->id_api)->delete();
        SafetyOfficerPegawai::create([
            'badge_safety_officer' => $so->badge,
            'pegawai_id' => $pegawai->id_api,
            'assigned_by' => 'system:import-csv',
            'assigned_at' => now(),
        ]);

        return 'ok';
    }

    /**
     * Isi kolom hanya kalau nilainya masih kosong (null/''), supaya tidak
     * menimpa data yang sudah diisi sync:pegawai dari ERP.
     */
    private function fillIfEmpty(Pegawai $pegawai, string $column, ?string $value): void
    {
        if ($value === null) {
            return;
        }
        if ($pegawai->{$column} === null || $pegawai->{$column} === '') {
            $pegawai->{$column} = $value;
        }
    }

    /**
     * Parse tanggal format DD/MM/YYYY (format sheet lokal ID untuk MASA_BERLAKU_KIB).
     */
    private function parseTanggalDMY(string $raw): ?Carbon
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
