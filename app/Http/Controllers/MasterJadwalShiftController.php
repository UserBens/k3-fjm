<?php

namespace App\Http\Controllers;

use App\Imports\MasterJadwalShiftImport;
use App\Models\MasterJadwalShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class MasterJadwalShiftController extends Controller
{
    /**
     * Halaman utama manajemen master jadwal shift.
     */
    public function index(Request $request)
    {
        return view('master-jadwal-shift.index');
    }

    /**
     * Data table (AJAX/JSON) dengan filter bulan & tahun, dipakai oleh halaman index.
     */
    public function data(Request $request)
    {
        $query = MasterJadwalShift::query()
            ->bulan($request->input('bulan'))
            ->tahun($request->input('tahun'))
            ->orderBy('tanggal');

        if ($request->filled('cari_tanggal')) {
            $query->whereDate('tanggal', $request->input('cari_tanggal'));
        }

        $perPage = (int) $request->input('per_page', 31);
        $data = $query->paginate($perPage);

        return response()->json($data);
    }

    /**
     * Simpan satu baris jadwal baru (form tambah manual).
     */
    public function store(Request $request)
    {
        $validated = $this->validateRow($request);

        $exists = MasterJadwalShift::where('tanggal', $validated['tanggal'])->exists();
        if ($exists) {
            return response()->json([
                'message' => 'Tanggal tersebut sudah memiliki jadwal. Silakan edit data yang ada.',
            ], 422);
        }

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        $row = MasterJadwalShift::create($validated);

        return response()->json([
            'message' => 'Jadwal berhasil ditambahkan.',
            'data' => $row,
        ], 201);
    }

    /**
     * Update satu baris jadwal (form edit).
     */
    public function update(Request $request, MasterJadwalShift $masterJadwalShift)
    {
        $validated = $this->validateRow($request, $masterJadwalShift->id);
        $validated['updated_by'] = auth()->id();

        $masterJadwalShift->update($validated);

        return response()->json([
            'message' => 'Jadwal berhasil diperbarui.',
            'data' => $masterJadwalShift->fresh(),
        ]);
    }

    /**
     * Hapus satu baris jadwal.
     */
    public function destroy(MasterJadwalShift $masterJadwalShift)
    {
        $masterJadwalShift->delete();

        return response()->json(['message' => 'Jadwal berhasil dihapus.']);
    }

    /**
     * Import massal dari file Excel (.xlsx/.xls) atau CSV.
     * Data di-upsert berdasarkan tanggal sehingga aman diimport ulang.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ], [
            'file.required' => 'File Excel wajib diunggah.',
            'file.mimes'    => 'Format file harus berupa .xlsx, .xls, atau .csv.',
            'file.max'      => 'Ukuran file maksimal 2 MB.',
        ]);

        $import = new MasterJadwalShiftImport();

        try {
            Excel::import($import, $request->file('file'));

            // Jika terdapat error pada beberapa baris, kirim status 207 (Multi-Status / Sukses Sebagian)
            if (!empty($import->errors)) {
                return response()->json([
                    'message' => "Import selesai dengan catatan. Dibuat: {$import->totalDibuat}, Diperbarui: {$import->totalDiperbarui}.",
                    'errors'  => $import->errors
                ], 207);
            }

            return response()->json([
                'message' => "Import berhasil! Data baru: {$import->totalDibuat}, Diperbarui: {$import->totalDiperbarui}."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal membaca file Excel. Pastikan format kolom sesuai template.'
            ], 422);
        }
    }

    /**
     * Download Template Excel
     */
    public function template()
    {
        // Mengunduh file template contoh dari folder storage/app/templates/
        $path = storage_path('app/public/template_import_jadwal.xlsx');

        if (!file_exists($path)) {
            return response()->json(['message' => 'File template belum tersedia.'], 404);
        }

        return response()->download($path);
    }

    private function validateRow(Request $request, ?int $ignoreId = null): array
    {
        $shiftRule = 'nullable|in:M,S,P,O';

        return $request->validate([
            'tanggal' => [
                'required',
                'date',
                $ignoreId
                    ? \Illuminate\Validation\Rule::unique('master_jadwal_shifts', 'tanggal')->ignore($ignoreId)
                    : \Illuminate\Validation\Rule::unique('master_jadwal_shifts', 'tanggal'),
            ],
            'shift_a' => $shiftRule,
            'jam_a'   => 'nullable|integer|min:0|max:24',
            'shift_b' => $shiftRule,
            'jam_b'   => 'nullable|integer|min:0|max:24',
            'shift_c' => $shiftRule,
            'jam_c'   => 'nullable|integer|min:0|max:24',
            'shift_d' => $shiftRule,
            'jam_d'   => 'nullable|integer|min:0|max:24',
            'jam_nd'  => 'nullable|integer|min:0|max:24',
            'keterangan' => 'nullable|string|max:255',
        ]);
    }

    // private function tahunTersedia(): array
    // {
    //     $tahun = MasterJadwalShift::selectRaw('DISTINCT YEAR(tanggal) as tahun')
    //         ->orderByDesc('tahun')
    //         ->pluck('tahun')
    //         ->toArray();

    //     // selalu sertakan tahun berjalan & tahun depan walau belum ada datanya
    //     $sekarang = (int) date('Y');
    //     foreach ([$sekarang, $sekarang + 1] as $y) {
    //         if (!in_array($y, $tahun)) {
    //             $tahun[] = $y;
    //         }
    //     }
    //     rsort($tahun);

    //     return $tahun;
    // }
}
