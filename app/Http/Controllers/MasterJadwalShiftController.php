<?php

namespace App\Http\Controllers;

use App\Exports\MasterJadwalShiftTemplateExport;
use App\Imports\MasterJadwalShiftImport;
use App\Models\MasterJadwalShift;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class MasterJadwalShiftController extends Controller
{
    public function index()
    {
        $tahunSekarang = now()->year;

        // NOTE: EXTRACT(YEAR FROM ...) adalah sintaks PostgreSQL.
        // Jika project ini jalan di SQL Server, ganti dengan: DB::raw('YEAR(tanggal) as tahun')
        $tahunList = MasterJadwalShift::select(DB::raw('DISTINCT EXTRACT(YEAR FROM tanggal)::int as tahun'))
            ->orderByDesc('tahun')
            ->pluck('tahun');

        if (!$tahunList->contains($tahunSekarang)) {
            $tahunList = $tahunList->push($tahunSekarang)->sortByDesc(fn($t) => $t)->values();
        }

        return view('master-jadwal-shift.index', compact('tahunList'));
    }

    public function data(Request $request): JsonResponse
    {
        $query = MasterJadwalShift::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', (int) $request->input('bulan'));
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', (int) $request->input('tahun'));
        }

        if ($request->filled('cari_tanggal')) {
            $query->whereDate('tanggal', $request->input('cari_tanggal'));
        }

        $paginated = $query->orderBy('tanggal')->paginate(15)->withQueryString();

        return response()->json($paginated);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        $jadwal = MasterJadwalShift::create($validated);

        return response()->json([
            'message' => 'Jadwal shift berhasil ditambahkan.',
            'data'    => $jadwal,
        ], 201);
    }

    public function update(Request $request, MasterJadwalShift $masterJadwalShift): JsonResponse
    {
        $validated = $this->validateData($request, $masterJadwalShift->id);

        $masterJadwalShift->update($validated);

        return response()->json([
            'message' => 'Jadwal shift berhasil diperbarui.',
            'data'    => $masterJadwalShift,
        ]);
    }

    public function destroy(MasterJadwalShift $masterJadwalShift): JsonResponse
    {
        $masterJadwalShift->delete();

        return response()->json([
            'message' => 'Jadwal shift berhasil dihapus.',
        ]);
    }

    public function import(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        $import = new MasterJadwalShiftImport();

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Gagal membaca file. Pastikan format file sesuai template.',
            ], 422);
        }

        if ($import->successCount === 0 && !empty($import->errors)) {
            return response()->json([
                'message' => 'Import gagal, tidak ada data yang berhasil disimpan.',
                'errors'  => $import->errors,
            ], 422);
        }

        if (!empty($import->errors)) {
            return response()->json([
                'message' => "{$import->successCount} baris berhasil diimport, " . count($import->errors) . ' baris dilewati.',
                'errors'  => $import->errors,
            ], 207);
        }

        return response()->json([
            'message' => "{$import->successCount} baris jadwal berhasil diimport.",
        ]);
    }

    public function downloadTemplate(): RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new MasterJadwalShiftTemplateExport(), 'template-master-jadwal-shift.xlsx');
    }

    protected function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'tanggal' => [
                'required',
                'date',
                Rule::unique('master_jadwal_shifts', 'tanggal')->ignore($ignoreId),
            ],
            'shift_a'     => 'nullable|in:P,S,M,O',
            'jam_a'       => 'nullable|integer|min:0|max:24',
            'shift_b'     => 'nullable|in:P,S,M,O',
            'jam_b'       => 'nullable|integer|min:0|max:24',
            'shift_c'     => 'nullable|in:P,S,M,O',
            'jam_c'       => 'nullable|integer|min:0|max:24',
            'shift_d'     => 'nullable|in:P,S,M,O',
            'jam_d'       => 'nullable|integer|min:0|max:24',
            'jam_nd'      => 'nullable|integer|min:0|max:24',
            'keterangan'  => 'nullable|string|max:255',
        ], [
            'tanggal.unique' => 'Tanggal tersebut sudah memiliki jadwal. Silakan edit data yang ada.',
        ]);
    }
}
