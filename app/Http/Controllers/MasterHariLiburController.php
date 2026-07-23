<?php

namespace App\Http\Controllers;

use App\Models\MasterHariLibur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv as CsvWriter;

class MasterHariLiburController extends Controller
{
    /**
     * Halaman utama manajemen master hari libur.
     */
    public function index()
    {
        return view('master-hari-libur.index');
    }

    /**
     * Data untuk tabel (dipanggil via fetch, paginated + filter).
     */
    public function data(Request $request)
    {
        $query = MasterHariLibur::query();

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $perPage = 15;
        $paginated = $query->orderBy('tanggal')->paginate($perPage);

        return response()->json($paginated);
    }

    /**
     * Daftar tahun yang tersedia pada data (dipakai untuk mengisi dropdown filter).
     */
    public function tahunList()
    {
        $tahun = MasterHariLibur::query()
            ->selectRaw('DISTINCT YEAR(tanggal) as tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');

        if ($tahun->isEmpty()) {
            $tahun = collect([now()->year]);
        }

        return response()->json($tahun);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date|unique:master_hari_liburs,tanggal',
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:libur_nasional,cuti_bersama',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.unique' => 'Tanggal tersebut sudah terdaftar sebagai hari libur.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        MasterHariLibur::create($validator->validated());

        return response()->json(['message' => 'Hari libur berhasil ditambahkan.']);
    }

    public function update(Request $request, MasterHariLibur $masterHariLibur)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date|unique:master_hari_liburs,tanggal,' . $masterHariLibur->id,
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:libur_nasional,cuti_bersama',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.unique' => 'Tanggal tersebut sudah terdaftar sebagai hari libur.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $masterHariLibur->update($validator->validated());

        return response()->json(['message' => 'Hari libur berhasil diperbarui.']);
    }

    public function destroy(MasterHariLibur $masterHariLibur)
    {
        $masterHariLibur->delete();

        return response()->json(['message' => 'Hari libur berhasil dihapus.']);
    }

    /**
     * Import massal dari file Excel/CSV.
     * Kolom wajib pada header: TANGGAL, NAMA, JENIS, KETERANGAN
     * Format tanggal: dd/mm/yyyy
     * Data yang tanggalnya sudah ada akan diperbarui (upsert).
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        $path = $request->file('file')->getRealPath();

        try {
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, false);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'File tidak dapat dibaca. Pastikan formatnya benar.'], 422);
        }

        if (count($rows) < 2) {
            return response()->json(['message' => 'File kosong atau tidak memiliki data.'], 422);
        }

        $header = array_map(fn ($h) => strtoupper(trim((string) $h)), $rows[0]);
        $required = ['TANGGAL', 'NAMA'];
        $missing = array_diff($required, $header);

        if (!empty($missing)) {
            return response()->json([
                'message' => 'Kolom wajib tidak ditemukan: ' . implode(', ', $missing),
            ], 422);
        }

        $colIndex = array_flip($header);
        $errors = [];
        $successCount = 0;

        DB::beginTransaction();
        try {
            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $baris = $i + 1;

                $tanggalRaw = trim((string) ($row[$colIndex['TANGGAL']] ?? ''));
                $nama = trim((string) ($row[$colIndex['NAMA']] ?? ''));
                $jenisRaw = isset($colIndex['JENIS']) ? trim((string) ($row[$colIndex['JENIS']] ?? '')) : '';
                $keterangan = isset($colIndex['KETERANGAN']) ? trim((string) ($row[$colIndex['KETERANGAN']] ?? '')) : null;

                if ($tanggalRaw === '' && $nama === '') {
                    continue; // baris kosong, dilewati diam-diam
                }

                if ($tanggalRaw === '') {
                    $errors[] = "Baris {$baris}: tanggal kosong.";
                    continue;
                }

                if ($nama === '') {
                    $errors[] = "Baris {$baris}: nama hari libur kosong.";
                    continue;
                }

                try {
                    $tanggal = Carbon::createFromFormat('d/m/Y', $tanggalRaw)->format('Y-m-d');
                } catch (\Throwable $e) {
                    $errors[] = "Baris {$baris}: format tanggal '{$tanggalRaw}' tidak valid (gunakan dd/mm/yyyy).";
                    continue;
                }

                $jenis = $this->normalisasiJenis($jenisRaw, $nama);

                MasterHariLibur::updateOrCreate(
                    ['tanggal' => $tanggal],
                    [
                        'nama' => $nama,
                        'jenis' => $jenis,
                        'keterangan' => $keterangan ?: null,
                    ]
                );

                $successCount++;
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }

        if (!empty($errors) && $successCount > 0) {
            return response()->json([
                'message' => "Import selesai sebagian: {$successCount} data berhasil, " . count($errors) . ' baris dilewati.',
                'errors' => $errors,
            ], 207);
        }

        if (!empty($errors) && $successCount === 0) {
            return response()->json([
                'message' => 'Import gagal, tidak ada data yang berhasil disimpan.',
                'errors' => $errors,
            ], 422);
        }

        return response()->json(['message' => "Import berhasil, {$successCount} data disimpan."]);
    }

    /**
     * Menentukan jenis (libur_nasional / cuti_bersama) dari isi kolom JENIS,
     * atau menebak dari nama bila kolom JENIS kosong.
     */
    private function normalisasiJenis(string $jenisRaw, string $nama): string
    {
        $j = strtolower(trim($jenisRaw));

        if (in_array($j, ['cuti_bersama', 'cuti bersama'])) {
            return MasterHariLibur::JENIS_CUTI_BERSAMA;
        }

        if (in_array($j, ['libur_nasional', 'libur nasional'])) {
            return MasterHariLibur::JENIS_LIBUR_NASIONAL;
        }

        // tebak dari nama jika kolom JENIS kosong / tidak dikenali
        if (str_contains(strtolower($nama), 'cuti bersama')) {
            return MasterHariLibur::JENIS_CUTI_BERSAMA;
        }

        return MasterHariLibur::JENIS_LIBUR_NASIONAL;
    }

    /**
     * Unduh template kosong (CSV) untuk import.
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['TANGGAL', 'NAMA', 'JENIS', 'KETERANGAN'],
            ['01/01/2026', 'Tahun Baru 2026 Masehi', 'libur_nasional', ''],
            ['16/02/2026', 'Cuti Bersama Tahun Baru Imlek', 'cuti_bersama', ''],
        ], null, 'A1');

        $writer = new CsvWriter($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, 'template_master_hari_liburs.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}