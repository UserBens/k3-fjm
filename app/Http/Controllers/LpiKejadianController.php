<?php

namespace App\Http\Controllers;

use App\Models\LpiKejadian;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LpiKejadianController extends Controller
{
    private array $fileFields = [
        'evidence_1' => ['evidence_1_path', 'evidence'],
        'evidence_2' => ['evidence_2_path', 'evidence'],
        'evidence_3' => ['evidence_3_path', 'evidence'],
        'evidence_4' => ['evidence_4_path', 'evidence'],
        'evidence_5' => ['evidence_5_path', 'evidence'],
        'lampiran_dokumen' => ['lampiran_dokumen_path', 'lampiran'],
    ];

    public function index()
    {
        return view('lpi-kejadian.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = LpiKejadian::search($request->query('search'))
                ->withCount('korban');

            if ($tingkat = $request->query('tingkat_risiko')) {
                $query->where('tingkat_risiko', $tingkat);
            }
            if ($statusPenyelesaian = $request->query('status_penyelesaian_lpi')) {
                $query->where('status_penyelesaian_lpi', $statusPenyelesaian);
            }

            $query->orderByDesc('tanggal_insiden')->orderByDesc('id');

            $filterOptions = [
                'tingkat_risiko' => ['LOW', 'MEDIUM', 'HIGH'],
                'status_penyelesaian_lpi' => ['OPEN', 'CLOSE'],
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;
            $paginator = $query->paginate($perPage);

            return response()->json([
                'data' => collect($paginator->items())->map(fn(LpiKejadian $k) => $this->transform($k)),
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
            Log::error('Gagal memuat data LPI kejadian: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) $validated[$column] = $path;
            }

            $kejadian = LpiKejadian::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data kejadian LPI berhasil ditambahkan.',
                'data' => $this->transform($kejadian->loadCount('korban')),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan LPI kejadian: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function update(Request $request, LpiKejadian $lpiKejadian): JsonResponse
    {
        $validated = $this->validateData($request, $lpiKejadian->id);

        try {
            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) {
                    $this->deleteFileIfExists($lpiKejadian->{$column});
                    $validated[$column] = $path;
                }
            }

            $lpiKejadian->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data kejadian LPI berhasil diperbarui.',
                'data' => $this->transform($lpiKejadian->fresh()->loadCount('korban')),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui LPI kejadian: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy(LpiKejadian $lpiKejadian): JsonResponse
    {
        try {
            foreach ($this->fileFields as [$column, $folder]) {
                $this->deleteFileIfExists($lpiKejadian->{$column});
            }
            $lpiKejadian->delete(); // korban ikut terhapus via cascadeOnDelete

            return response()->json(['status' => 'success', 'message' => 'Data kejadian LPI berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus LPI kejadian: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    private function storeFileIfPresent(Request $request, string $field, string $folder): ?string
    {
        if (!$request->hasFile($field)) return null;
        return $request->file($field)->store("lpi/{$folder}", 'public');
    }

    private function deleteFileIfExists(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function transform(LpiKejadian $k): array
    {
        $base = $k->toArray();
        foreach ($this->fileFields as [$column, $folder]) {
            $base[$column . '_url'] = $k->{$column} ? asset('storage/' . $k->{$column}) : null;
        }
        $base['korban_count'] = $k->korban_count ?? $k->korban()->count();
        return $base;
    }

    public function show(LpiKejadian $lpiKejadian)
    {
        return view('lpi-kejadian.show', ['id' => $lpiKejadian->id]);
    }

    public function detail(LpiKejadian $lpiKejadian): JsonResponse
    {
        try {
            $lpiKejadian->load('korban')->loadCount('korban');
            $data = $this->transform($lpiKejadian);
            $data['korban'] = $lpiKejadian->korban;
            return response()->json(['data' => $data]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat detail LPI kejadian: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil detail data.'], 500);
        }
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $rules = [
            'id_lpi' => 'required|string|max:100|unique:lpi_kejadian,id_lpi' . ($ignoreId ? ",{$ignoreId}" : ''),
            'owner_user' => 'nullable|string|max:255',
            'tanggal_insiden' => 'nullable|date',
            'hari_insiden' => 'nullable|string|max:20',
            'jam_insiden' => 'nullable|date_format:H:i',
            'jam_insiden_shift' => 'nullable|string|max:20',
            'zona_lokasi_insiden' => 'nullable|string|max:150',
            'sub_lokasi_insiden' => 'nullable|string|max:150',
            'detail_lokasi_insiden' => 'nullable|string|max:255',
            'uraian_kejadian' => 'nullable|string',
            'nominal_kerugian_material' => 'nullable|numeric|min:0',
            'total_cost_lost' => 'nullable|numeric|min:0',
            'pica_tindakan_perbaikan' => 'nullable|string',
            'pica_pic_bertanggung_jawab' => 'nullable|string|max:255',
            'pica_due_date' => 'nullable|date',
            'tingkat_risiko' => 'nullable|string|in:LOW,MEDIUM,HIGH',
            'hasil_investigasi_root_cause' => 'nullable|string',
            'status_penyelesaian_lpi' => 'nullable|string|in:OPEN,CLOSE',
            'status_pelaporan_lpi' => 'nullable|string|max:30',
        ];

        foreach ($this->fileFields as $formField => [$column, $folder]) {
            $rules[$formField] = 'nullable|file|max:5120';
        }

        return $request->validate($rules);
    }
}
