<?php

namespace App\Http\Controllers;

use App\Models\Datamedis;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataMedisController extends Controller
{
    public function index()
    {
        return view('data-medis.index');
    }

    /**
     * Mengambil data laporan KPI dari database lokal untuk tabel & filter.
     */
    public function data(Request $request): JsonResponse
    {
        try {
            $query = Datamedis::query();

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_tenaga', 'ilike', "%{$search}%")
                        ->orWhere('badge_tenaga', 'ilike', "%{$search}%");
                });
            }

            if ($areaKerja = $request->query('area_kerja')) {
                $query->where('area_kerja', $areaKerja);
            }

            if ($statusPindah = $request->query('status_pindah')) {
                $query->where('status_pindah', $statusPindah);
            }

            if ($keputusan = $request->query('keputusan')) {
                $query->where('keputusan', $keputusan);
            }

            $query->orderByDesc('tanggal_pelaksanaan')->orderByDesc('id');

            $filterOptions = [
                'area_kerja' => Datamedis::whereNotNull('area_kerja')->distinct()->pluck('area_kerja')->sort()->values(),
                'status_pindah' => ['SUKSES', 'GAGAL', 'PENDING'],
                'keputusan' => ['APPROVE', 'REJECT', 'PENDING'],
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $data = collect($paginator->items())->map(fn($item) => $this->transform($item));

            return response()->json([
                'data' => $data,
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
            Log::error('Gagal memuat data laporan KPI: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data laporan KPI dari database lokal.'], 500);
        }
    }

    /**
     * Menyimpan laporan KPI baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $validated['waktu_submit'] = now();
            $validated['status_pindah'] = $validated['status_pindah'] ?? 'PENDING';
            $validated['keputusan'] = $validated['keputusan'] ?? 'PENDING';

            $validated['foto_evidence_path'] = $this->storeFileIfPresent($request, 'foto_evidence', 'evidence');
            $validated['formulir_kegiatan_path'] = $this->storeFileIfPresent($request, 'formulir_kegiatan', 'formulir');
            $validated['arsip_path'] = $this->storeFileIfPresent($request, 'arsip', 'arsip');

            $laporan = Datamedis::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Laporan KPI untuk ' . $laporan->nama_tenaga . ' berhasil ditambahkan.',
                'data' => $this->transform($laporan),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan laporan KPI: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan sistem saat menyimpan data.'], 500);
        }
    }

    /**
     * Memperbarui laporan KPI.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $laporan = Datamedis::findOrFail($id);

            $newFoto = $this->storeFileIfPresent($request, 'foto_evidence', 'evidence');
            if ($newFoto) {
                $this->deleteFileIfExists($laporan->foto_evidence_path);
                $validated['foto_evidence_path'] = $newFoto;
            }

            $newFormulir = $this->storeFileIfPresent($request, 'formulir_kegiatan', 'formulir');
            if ($newFormulir) {
                $this->deleteFileIfExists($laporan->formulir_kegiatan_path);
                $validated['formulir_kegiatan_path'] = $newFormulir;
            }

            $newArsip = $this->storeFileIfPresent($request, 'arsip', 'arsip');
            if ($newArsip) {
                $this->deleteFileIfExists($laporan->arsip_path);
                $validated['arsip_path'] = $newArsip;
            }

            $laporan->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Laporan KPI untuk ' . $laporan->nama_tenaga . ' berhasil diperbarui.',
                'data' => $this->transform($laporan->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui laporan KPI: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan sistem saat memperbarui data.'], 500);
        }
    }

    public function updateKeputusan(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'keputusan' => 'required|string|in:APPROVE,REJECT,PENDING',
        ]);

        try {
            $laporan = Datamedis::findOrFail($id);
            $laporan->update(['keputusan' => $validated['keputusan']]);

            return response()->json([
                'status' => 'success',
                'message' => 'Keputusan untuk ' . $laporan->nama_tenaga . ' berhasil diperbarui menjadi ' . $validated['keputusan'] . '.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui keputusan laporan KPI: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan sistem saat memperbarui keputusan.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $laporan = Datamedis::findOrFail($id);
            $nama = $laporan->nama_tenaga;

            $this->deleteFileIfExists($laporan->foto_evidence_path);
            $this->deleteFileIfExists($laporan->formulir_kegiatan_path);
            $this->deleteFileIfExists($laporan->arsip_path);

            $laporan->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Laporan KPI untuk ' . $nama . ' berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus laporan KPI: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan sistem saat menghapus data.'], 500);
        }
    }

    // Picker pencarian tenaga medis — reuse tabel pegawais yang sudah ada
    public function cariTenagaMedis(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with('unitKerja')->where('is_active', true);

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
        if (!$request->hasFile($field)) {
            return null;
        }

        return $request->file($field)->store("data-medis/{$folder}", 'public');
    }

    private function deleteFileIfExists(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function transform(Datamedis $item): array
    {
        return [
            'id' => $item->id,
            'waktu_submit' => optional($item->waktu_submit)->toDateTimeString(),
            'tanggal_pelaksanaan' => optional($item->tanggal_pelaksanaan)->toDateString(),
            'badge_tenaga' => $item->badge_tenaga ?? '-',
            'nama_tenaga' => $item->nama_tenaga ?? '-',
            'area_kerja' => $item->area_kerja ?? '-',
            'unit_kerja' => $item->unit_kerja ?? '-',
            'jenis_aktifitas_kpi' => $item->jenis_aktifitas_kpi ?? '-',
            'foto_evidence_url' => $item->foto_evidence_path ? asset('storage/' . $item->foto_evidence_path) : null,
            'formulir_kegiatan_url' => $item->formulir_kegiatan_path ? asset('storage/' . $item->formulir_kegiatan_path) : null,
            'arsip_url' => $item->arsip_path ? asset('storage/' . $item->arsip_path) : null,
            'status_pindah' => $item->status_pindah,
            'keputusan' => $item->keputusan,
        ];
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tanggal_pelaksanaan' => 'nullable|date',
            'badge_tenaga' => 'nullable|string|max:50',
            'nama_tenaga' => 'required|string|max:255',
            'area_kerja' => 'nullable|string|max:100',
            'unit_kerja' => 'nullable|string|max:150',
            'jenis_aktifitas_kpi' => 'nullable|string|max:150',
            'status_pindah' => 'nullable|string|max:30',
            'keputusan' => 'nullable|string|max:30',

            'foto_evidence' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:4096',
            'formulir_kegiatan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'arsip' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:5120',
        ]);
    }
}
