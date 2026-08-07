<?php

namespace App\Console\Commands;

use App\Models\DataSafety;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportDataSafetyCsv extends Command
{
    protected $signature = 'import:data-safety
        {path : Path absolut ke file CSV}
        {--limit=200 : Jumlah baris maksimal yang diimport (untuk uji coba)}
        {--offset=0 : Mulai dari baris ke-berapa (0-based, tidak termasuk header)}
        {--dry-run : Hanya tampilkan hasil parsing, tidak menyimpan ke database}
        {--delimiter=; : Karakter pemisah kolom CSV (";" untuk export lokal ID, "," untuk export standar)}
        {--no-header : File CSV tidak punya baris header (langsung data), pakai urutan kolom baku sheet Data Safety}';

    protected $description = 'Import data Safety dari CSV export Google Sheets ke tabel data_safety (kolom file disimpan sebagai link Google Drive, tidak didownload)';

    // Mapping: nama header di CSV => kolom di tabel data_safety
    private array $columnMap = [
        'Tanggal Pelaksanaan' => 'tanggal_pelaksanaan',
        'Area Kerja' => 'area_kerja',
        'Unit Kerja' => 'unit_kerja',
        'Kategori Peralatan' => 'kategori_peralatan',
        'Nama Alat' => 'nama_alat',
        'Nomor Seri Alat / Kode Lambung Unit' => 'nomor_seri_alat',
        'Keterangan Tambahan' => 'keterangan_tambahan_alat',
        'Rekomendasi Tindakan (Jika ada kerusakan)' => 'rekomendasi_tindakan_alat',
        'Upload Foto Alat' => 'foto_alat_path',
        'Upload Formulir Inspeksi Peralatan' => 'formulir_inspeksi_peralatan_path',
        'Upload Formulir Kegiatan Inspeksi Peralatan' => 'formulir_kegiatan_inspeksi_peralatan_path',
        'Item Temuan' => 'item_temuan',
        'Jenis Penyebab' => 'jenis_penyebab',
        'Deskripsi Temuan' => 'deskripsi_temuan',
        'Rekomendasi Tindakan' => 'rekomendasi_tindakan_temuan',
        'Foto Temuan UA/UC' => 'foto_temuan_uauc_path',
        'Upload Formulir Kegiatan Inspeksi Area Kerja' => 'formulir_kegiatan_inspeksi_area_kerja_path',
        'Nama Subject Observasi' => 'nama_subject_observasi',
        'Proses Kerja' => 'proses_kerja',
        'Upload Formulir OBSERI' => 'formulir_observi_path',
        'Upload Formulir Kegiatan OBSERI' => 'formulir_kegiatan_observi_path',
        'Pekerjaan yang akan dikerjakan' => 'pekerjaan_dikerjakan',
        'Upload Safety Permit' => 'safety_permit_path',
        'Upload Formulir Kegiatan Verifikasi Safety Permit' => 'formulir_kegiatan_verifikasi_safety_permit_path',
        'Keterangan Bahaya (Nearmiss)' => 'keterangan_bahaya_nearmiss',
        'Upload Foto Temuan Bahaya (Nearmiss)' => 'foto_temuan_bahaya_nearmiss_path',
        'Foto Pelaksanaan Safety Briefing' => 'foto_pelaksanaan_safety_briefing_path',
        'Foto Daftar Hadir (PDF)' => 'foto_daftar_hadir_briefing_path',
        'Upload Formulir Kegiatan Safety Briefing' => 'formulir_kegiatan_safety_briefing_path',
        'Nama Penerima' => 'nama_penerima',
        'Jenis Tindakan' => 'jenis_tindakan',
        'Alasan Pemberian' => 'alasan_pemberian',
        'Foto Evidence / Dokumentasi' => 'foto_evidence_reward_path',
        'Upload Formulir Kegiatan Pemberian Reward / Punishment' => 'formulir_kegiatan_reward_path',
        'Materi Sosialisasi Keselamatan Kerja' => 'materi_sosialisasi_keselamatan',
        'Foto Kegiatan Sosialisasi Keselamatan Kerja' => 'foto_kegiatan_sosialisasi_keselamatan_path',
        'Upload Formulir Presensi Sosialisasi Keselamatan Kerja (PDF)' => 'formulir_presensi_sosialisasi_keselamatan_path',
        'Upload Formulir Kegiatan Sosialisasi Keselamatan Kerja' => 'formulir_kegiatan_sosialisasi_keselamatan_path',
        'Upload Foto Kegiatan DCU' => 'foto_kegiatan_dcu_path',
        'Upload Formulir Hasil Pemeriksaan DCU' => 'formulir_hasil_pemeriksaan_dcu_path',
        'Upload Formulir Kegiatan Pemeriksaan DCU' => 'formulir_kegiatan_pemeriksaan_dcu_path',
        'Foto Kegiatan Bugar Sehat' => 'foto_kegiatan_bugar_sehat_path',
        'Upload Formulir Presensi Bugar Sehat (PDF)' => 'formulir_presensi_bugar_sehat_path',
        'Upload Formulir Kegiatan Bugar Sehat' => 'formulir_kegiatan_bugar_sehat_path',
        'Nama Pekerja' => 'nama_pekerja_romberg',
        'Foto Kegiatan Tes Keseimbangan' => 'foto_kegiatan_tes_keseimbangan_path',
        'Upload Formulir Hasil Pemeriksaan (Romberg Test)' => 'formulir_hasil_pemeriksaan_romberg_path',
        'Upload Formulir Kegiatan Tes Keseimbangan' => 'formulir_kegiatan_tes_keseimbangan_path',
        'Materi Sosialisasi Kesehatan Kerja' => 'materi_sosialisasi_kesehatan',
        'Foto Kegiatan Sosialisasi Kesehatan Kerja' => 'foto_kegiatan_sosialisasi_kesehatan_path',
        'Upload Formulir Presensi Sosialisasi Kesehatan Kerja (PDF)' => 'formulir_presensi_sosialisasi_kesehatan_path',
        'Upload Formulir Kegiatan Sosialisasi Kesehatan Kerja' => 'formulir_kegiatan_sosialisasi_kesehatan_path',
        'Kelas Kotak P3K' => 'kelas_kotak_p3k',
        'Kesesuaian Isi Kotak P3K (Upload Form Checklist)' => 'kesesuaian_isi_p3k_path',
        'Upload Formulir Kegiatan Inspeksi Kotak P3K' => 'formulir_kegiatan_inspeksi_p3k_path',
        'STATUS (APPROVE / REJECT / CANCEL)' => 'keputusan',
        'DIPERIKSA OLEH (otomatis)' => 'direview_oleh',
        'TANGGAL DIPERIKSA (otomatis)' => 'direview_at',
    ];

    // Kolom yang isinya berupa link Google Drive (disimpan sebagai link langsung, TIDAK didownload)
    private array $fileColumns = [
        'foto_alat_path',
        'formulir_inspeksi_peralatan_path',
        'formulir_kegiatan_inspeksi_peralatan_path',
        'foto_temuan_uauc_path',
        'formulir_kegiatan_inspeksi_area_kerja_path',
        'formulir_observi_path',
        'formulir_kegiatan_observi_path',
        'safety_permit_path',
        'formulir_kegiatan_verifikasi_safety_permit_path',
        'foto_temuan_bahaya_nearmiss_path',
        'foto_pelaksanaan_safety_briefing_path',
        'foto_daftar_hadir_briefing_path',
        'formulir_kegiatan_safety_briefing_path',
        'foto_evidence_reward_path',
        'formulir_kegiatan_reward_path',
        'foto_kegiatan_sosialisasi_keselamatan_path',
        'formulir_presensi_sosialisasi_keselamatan_path',
        'formulir_kegiatan_sosialisasi_keselamatan_path',
        'foto_kegiatan_dcu_path',
        'formulir_hasil_pemeriksaan_dcu_path',
        'formulir_kegiatan_pemeriksaan_dcu_path',
        'foto_kegiatan_bugar_sehat_path',
        'formulir_presensi_bugar_sehat_path',
        'formulir_kegiatan_bugar_sehat_path',
        'foto_kegiatan_tes_keseimbangan_path',
        'formulir_hasil_pemeriksaan_romberg_path',
        'formulir_kegiatan_tes_keseimbangan_path',
        'foto_kegiatan_sosialisasi_kesehatan_path',
        'formulir_presensi_sosialisasi_kesehatan_path',
        'formulir_kegiatan_sosialisasi_kesehatan_path',
        'kesesuaian_isi_p3k_path',
        'formulir_kegiatan_inspeksi_p3k_path',
    ];

    // Urutan kolom baku sheet Data Safety (dipakai kalau file CSV tidak punya baris header --no-header)
    private array $defaultHeaderOrder = [
        'Timestamp',
        'Tanggal Pelaksanaan',
        'Nama Safety Officer',
        'Area Kerja',
        'Unit Kerja',
        'Jenis Aktifitas KPI',
        'Kategori Peralatan',
        'Nama Alat',
        'Nomor Seri Alat / Kode Lambung Unit',
        'Column 10',
        'Keterangan Tambahan',
        'Rekomendasi Tindakan (Jika ada kerusakan)',
        'Upload Foto Alat',
        'Upload Formulir Inspeksi Peralatan',
        'Upload Formulir Kegiatan Inspeksi Peralatan',
        'Item Temuan',
        'Jenis Penyebab',
        'Deskripsi Temuan',
        'Rekomendasi Tindakan',
        'Column 20',
        'Foto Temuan UA/UC',
        'Upload Formulir Kegiatan Inspeksi Area Kerja',
        'Nama Subject Observasi',
        'Proses Kerja',
        'Upload Formulir OBSERI',
        'Upload Formulir Kegiatan OBSERI',
        'Pekerjaan yang akan dikerjakan',
        'Upload Safety Permit',
        'Upload Formulir Kegiatan Verifikasi Safety Permit',
        'Keterangan Bahaya (Nearmiss)',
        'Upload Foto Temuan Bahaya (Nearmiss)',
        'Foto Pelaksanaan Safety Briefing',
        'Foto Daftar Hadir (PDF)',
        'Upload Formulir Kegiatan Safety Briefing',
        'Nama Penerima',
        'Jenis Tindakan',
        'Alasan Pemberian',
        'Foto Evidence / Dokumentasi',
        'Upload Formulir Kegiatan Pemberian Reward / Punishment',
        'Materi Sosialisasi Keselamatan Kerja',
        'Foto Kegiatan Sosialisasi Keselamatan Kerja',
        'Upload Formulir Presensi Sosialisasi Keselamatan Kerja (PDF)',
        'Upload Formulir Kegiatan Sosialisasi Keselamatan Kerja',
        'Upload Foto Kegiatan DCU',
        'Upload Formulir Hasil Pemeriksaan DCU',
        'Upload Formulir Kegiatan Pemeriksaan DCU',
        'Foto Kegiatan Bugar Sehat',
        'Upload Formulir Presensi Bugar Sehat (PDF)',
        'Upload Formulir Kegiatan Bugar Sehat',
        'Nama Pekerja',
        'Foto Kegiatan Tes Keseimbangan',
        'Upload Formulir Hasil Pemeriksaan (Romberg Test)',
        'Upload Formulir Kegiatan Tes Keseimbangan',
        'Materi Sosialisasi Kesehatan Kerja',
        'Foto Kegiatan Sosialisasi Kesehatan Kerja',
        'Upload Formulir Presensi Sosialisasi Kesehatan Kerja (PDF)',
        'Upload Formulir Kegiatan Sosialisasi Kesehatan Kerja',
        'Kelas Kotak P3K',
        'Kesesuaian Isi Kotak P3K (Upload Form Checklist)',
        'Upload Formulir Kegiatan Inspeksi Kotak P3K',
        'ID LAPORAN (otomatis)',
        'STATUS (APPROVE / REJECT / CANCEL)',
        'LOKASI BERKAS (otomatis)',
        'DIPERIKSA OLEH (otomatis)',
        'TANGGAL DIPERIKSA (otomatis)',
        'CATATAN (otomatis)',
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
                        'badge_tenaga' => $data['badge_tenaga'] ?? null,
                        'nama_tenaga' => $data['nama_tenaga'] ?? null,
                        'tanggal_pelaksanaan' => $data['tanggal_pelaksanaan'] ?? null,
                        'jenis_aktifitas_kpi' => $data['jenis_aktifitas_kpi'] ?? null,
                        'keputusan' => $data['keputusan'] ?? null,
                    ], JSON_UNESCAPED_UNICODE));
                } else {
                    DataSafety::create($data);
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

        // ── Timestamp -> waktu_submit ──
        $timestampRaw = $get('Timestamp');
        $waktuSubmit = $timestampRaw ? $this->parseTanggalIndo($timestampRaw) : null;

        // ── Nama Safety Officer -> badge_tenaga + nama_tenaga ──
        $namaSO = $get('Nama Safety Officer');
        $badge = null;
        $nama = null;
        if ($namaSO && preg_match('/^([A-Za-z0-9.]+)-(.+)$/', $namaSO, $m)) {
            $badge = trim($m[1]);
            $nama = trim($m[2]);
        } else {
            $nama = $namaSO;
        }

        // ── Jenis Aktifitas KPI: "[C.1] Laporan Inspeksi Peralatan" -> ambil nama saja ──
        $jenisRaw = $get('Jenis Aktifitas KPI');
        $jenisAktifitas = $jenisRaw;
        if ($jenisRaw && preg_match('/^\[(.+?)\]\s*(.+)$/', $jenisRaw, $m)) {
            $jenisAktifitas = trim($m[2]);
        }

        // ── TANGGAL DIPERIKSA (otomatis) ──
        $tglDiperiksaRaw = $get('TANGGAL DIPERIKSA (otomatis)');
        $direviewAt = $tglDiperiksaRaw ? $this->parseTanggalIndo($tglDiperiksaRaw) : null;

        $data = [
            'waktu_submit' => $waktuSubmit,
            'tanggal_pelaksanaan' => $tanggal,
            'badge_tenaga' => $badge,
            'nama_tenaga' => $nama,
            'area_kerja' => $get('Area Kerja'),
            'unit_kerja' => $get('Unit Kerja'),
            'jenis_aktifitas_kpi' => $jenisAktifitas,
            'kategori_form' => $this->resolveKategoriForm($jenisAktifitas ?? ''),
            'direview_oleh' => $get('DIPERIKSA OLEH (otomatis)'),
            'direview_at' => $direviewAt,
            'keputusan' => $this->normalizeKeputusan($get('STATUS (APPROVE / REJECT / CANCEL)')),
        ];

        // ── Kolom teks biasa (selain yang sudah ditangani manual di atas) ──
        $handledManually = ['Tanggal Pelaksanaan', 'STATUS (APPROVE / REJECT / CANCEL)', 'DIPERIKSA OLEH (otomatis)', 'TANGGAL DIPERIKSA (otomatis)'];
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

        return array_filter($data, fn($v) => $v !== null) + ['keputusan' => $data['keputusan'] ?? 'PENDING'];
    }

    /**
     * Parse tanggal/timestamp format export Google Sheets: M/D/YYYY (bulan/hari/tahun),
     * contoh: "5/13/2026" = 13 Mei 2026, "5/12/2026 19:40:50", dst.
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
        [, $month, $day, $year] = $m; // format CSV Google Sheets adalah M/D/Y, bukan D/M/Y

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
        return in_array($status, ['APPROVE', 'REJECT', 'CANCEL'], true) ? $status : 'PENDING';
    }

    /**
     * Memetakan jenis_aktifitas_kpi ke kategori_form (nilai data-cat pada .category-block
     * di view / key pada DETAIL_FIELDS di JS). Disamakan persis dengan
     * DataSafetyController::resolveKategoriForm() supaya data hasil import CSV
     * dan data hasil input manual lewat form konsisten.
     */
    private function resolveKategoriForm(string $nama): string
    {
        $n = strtolower($nama);

        $rules = [
            'p3k'                     => ['p3k'],
            'dcu'                     => ['dcu'],
            'romberg'                 => ['romberg', 'keseimbangan'],
            'bugar_sehat'             => ['bugar sehat', 'bugar'],
            'sosialisasi_keselamatan' => ['sosialisasi keselamatan'],
            'sosialisasi_kesehatan'   => ['sosialisasi kesehatan'],
            'reward'                  => ['reward', 'punishment'],
            'briefing'                => ['safety briefing', 'briefing'],
            'nearmiss'                => ['nearmiss'],
            'permit'                  => ['safety permit', 'permit'],
            'observi'                 => ['observi'],
            'peralatan'               => ['inspeksi peralatan', 'peralatan'],
            'temuan'                  => ['area kerja', 'temuan'],
        ];

        foreach ($rules as $kategori => $keywords) {
            foreach ($keywords as $kw) {
                if (str_contains($n, $kw)) {
                    return $kategori;
                }
            }
        }

        return '';
    }
}
