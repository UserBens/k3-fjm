<?php

namespace App\Http\Controllers;

use App\Models\MasterAreaKerja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterAreaKerjaController extends Controller
{
    public function index()
    {
        return view('master-area-kerja.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = MasterAreaKerja::search($request->query('search'));

            if ($kompleks = $request->query('kompleks')) {
                $query->where('kompleks', $kompleks);
            }
            if ($zona = $request->query('zona')) {
                $query->where('zona', $zona);
            }
            if ($request->filled('aktif')) {
                $query->where('aktif', $request->query('aktif') === '1');
            }

            $query->orderBy('kompleks')->orderBy('urutan_risiko')->orderBy('nama_area');

            $perPage = (int) $request->query('per_page', 15);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 15;
            $paginator = $query->paginate($perPage);

            return response()->json([
                'data' => collect($paginator->items())->map(fn(MasterAreaKerja $a) => $this->transform($a)),
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => max($paginator->lastPage(), 1),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                ],
                'filter_options' => [
                    'kompleks' => MasterAreaKerja::whereNotNull('kompleks')->distinct()->orderBy('kompleks')->pluck('kompleks'),
                    'zona' => ['HIJAU', 'PUTIH', 'KUNING', 'MERAH'],
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat master area kerja: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $data = MasterAreaKerja::create($validated);
            return response()->json([
                'status' => 'success',
                'message' => "Area \"{$data->nama_area}\" berhasil ditambahkan.",
                'data' => $this->transform($data),
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            // unique(kompleks, nama_area) bentrok
            if ($e->getCode() === '23505') {
                return response()->json(['status' => 'error', 'message' => 'Kombinasi Kompleks + Nama Area ini sudah ada.'], 422);
            }
            Log::error('Gagal menyimpan master area kerja: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function update(Request $request, MasterAreaKerja $masterAreaKerja): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $masterAreaKerja->update($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Data area berhasil diperbarui.',
                'data' => $this->transform($masterAreaKerja->fresh()),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23505') {
                return response()->json(['status' => 'error', 'message' => 'Kombinasi Kompleks + Nama Area ini sudah ada.'], 422);
            }
            Log::error('Gagal memperbarui master area kerja: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy(MasterAreaKerja $masterAreaKerja): JsonResponse
    {
        try {
            $masterAreaKerja->delete();
            return response()->json(['status' => 'success', 'message' => 'Data area berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus master area kerja: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    // Dropdown/picker "Kompleks" — daftar unik dari data yang sudah ada.
    public function komplekOptions(): JsonResponse
    {
        $items = MasterAreaKerja::whereNotNull('kompleks')
            ->distinct()
            ->orderBy('kompleks')
            ->pluck('kompleks');

        return response()->json(['data' => $items]);
    }

    private function transform(MasterAreaKerja $a): array
    {
        $base = $a->toArray();
        $base['potensi_bahaya_list'] = $a->potensi_bahaya
            ? array_values(array_filter(array_map('trim', explode(';', $a->potensi_bahaya))))
            : [];

        return $base;
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'kompleks' => 'required|string|max:150',
            'nama_area' => 'required|string|max:200',
            'zona' => 'required|string|in:HIJAU,PUTIH,KUNING,MERAH',
            'keterangan' => 'nullable|string',
            'potensi_bahaya' => 'nullable|string',
            'aktif' => 'nullable|boolean',
        ]);
    }
}
