<?php

namespace App\Http\Controllers;

use App\Models\DataUnsafe;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataUnsafeController extends Controller
{
    private array $fileFields = [
        'foto_temuan' => ['foto_temuan_path', 'foto-temuan'],
        'dokumen_laporan' => ['dokumen_laporan_path', 'dokumen-laporan'],
    ];

    public function index()
    {
        return view('data-unsafe.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = DataUnsafe::search($request->query('search'));

            if ($areaKerja = $request->query('area_kerja')) {
                $query->where('area_kerja', $areaKerja);
            }
            if ($jenisPenyebab = $request->query('jenis_penyebab')) {
                $query->where('jenis_penyebab', $jenisPenyebab);
            }
            if ($statusTemuan = $request->query('status_temuan')) {
                $query->where('status_temuan', $statusTemuan);
            }

            $query->orderByDesc('tanggal_temuan')->orderByDesc('id');

            $filterOptions = [
                'area_kerja' => DataUnsafe::whereNotNull('area_kerja')->distinct()->orderBy('area_kerja')->pluck('area_kerja'),
                'jenis_penyebab' => ['Unsafe Action', 'Unsafe Condition'],
                'status_temuan' => ['OPEN', 'CLOSE'],
                'keputusan' => ['APPROVE', 'REJECT', 'PENDING'],
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;
            $paginator = $query->paginate($perPage);

            return response()->json([
                'data' => collect($paginator->items())->map(fn(DataUnsafe $d) => $this->transform($d)),
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => max($paginator->lastPage(), 1),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                ],
                'filter_options' => $filterOptions,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data unsafe: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $validated['waktu_submit'] = now();
            $validated['status_temuan'] = $validated['status_temuan'] ?? 'OPEN';

            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) $validated[$column] = $path;
            }

            $data = DataUnsafe::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data unsafe action/condition berhasil ditambahkan.',
                'data' => $this->transform($data),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data unsafe: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function update(Request $request, DataUnsafe $dataUnsafe): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) {
                    $this->deleteFileIfExists($dataUnsafe->{$column});
                    $validated[$column] = $path;
                }
            }

            $dataUnsafe->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data unsafe action/condition berhasil diperbarui.',
                'data' => $this->transform($dataUnsafe->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data unsafe: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy(DataUnsafe $dataUnsafe): JsonResponse
    {
        try {
            foreach ($this->fileFields as [$column, $folder]) {
                $this->deleteFileIfExists($dataUnsafe->{$column});
            }
            $dataUnsafe->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data unsafe: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    /**
     * Picker Safety Officer — hanya pegawai yang badge-nya terdaftar
     * sebagai badge_safety_officer di tabel safety_officer_pegawais.
     */
    public function cariSafetyOfficer(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));

        $query = Pegawai::with('unitKerja')
            ->where('is_active', true)
            ->where('is_safety_officer', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(fn(Pegawai $p) => [
            'badge' => $p->badge ?? '-',
            'nama' => $p->nama ?? '-',
            'unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
        ]);

        return response()->json(['data' => $results]);
    }

    private function storeFileIfPresent(Request $request, string $field, string $folder): ?string
    {
        if (!$request->hasFile($field)) return null;
        return $request->file($field)->store("data-unsafe/{$folder}", 'public');
    }

    private function deleteFileIfExists(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function transform(DataUnsafe $d): array
    {
        $base = $d->toArray();
        foreach ($this->fileFields as [$column, $folder]) {
            $base[$column . '_url'] = $d->{$column} ? asset('storage/' . $d->{$column}) : null;
        }
        return $base;
    }

    private function validateData(Request $request): array
    {
        $rules = [
            'tanggal_temuan' => 'nullable|date',
            'badge_so' => 'nullable|string|max:50',
            'nama_so' => 'nullable|string|max:255',
            'area_kerja' => 'nullable|string|max:150',
            'unit_kerja' => 'nullable|string|max:150',
            'item_temuan' => 'nullable|string',
            'jenis_penyebab' => 'nullable|string|max:50|in:Unsafe Action,Unsafe Condition',
            'deskripsi_temuan' => 'nullable|string',
            'rekomendasi_perbaikan' => 'nullable|string',
            'status_temuan' => 'nullable|string|max:20|in:OPEN,CLOSE',
        ];

        foreach ($this->fileFields as $formField => [$column, $folder]) {
            $rules[$formField] = $formField === 'foto_temuan'
                ? 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:4096'
                : 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:5120';
        }

        return $request->validate($rules);
    }
}
