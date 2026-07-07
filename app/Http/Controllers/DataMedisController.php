<?php

namespace App\Http\Controllers;

use App\Models\Datamedis;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

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

            $data = collect($paginator->items())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'waktu_submit' => optional($item->waktu_submit)->toDateTimeString(),
                    'tanggal_pelaksanaan' => optional($item->tanggal_pelaksanaan)->toDateString(),
                    'badge_tenaga' => $item->badge_tenaga ?? '-',
                    'nama_tenaga' => $item->nama_tenaga ?? '-',
                    'area_kerja' => $item->area_kerja ?? '-',
                    'unit_kerja' => $item->unit_kerja ?? '-',
                    'jenis_aktifitas_kpi' => $item->jenis_aktifitas_kpi ?? '-',
                    'foto_evidence_url' => $item->foto_evidence_url,
                    'formulir_kegiatan_url' => $item->formulir_kegiatan_url,
                    'status_pindah' => $item->status_pindah,
                    'link_arsip' => $item->link_arsip,
                    'keputusan' => $item->keputusan,
                ];
            });

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

            return response()->json([
                'message' => 'Gagal mengambil data laporan KPI dari database lokal.',
            ], 500);
        }
    }

    /**
     * Menyimpan laporan KPI baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tanggal_pelaksanaan' => 'nullable|date',
            'badge_tenaga' => 'nullable|string|max:50',
            'nama_tenaga' => 'required|string|max:255',
            'area_kerja' => 'nullable|string|max:100',
            'unit_kerja' => 'nullable|string|max:150',
            'jenis_aktifitas_kpi' => 'nullable|string|max:150',
            'foto_evidence_url' => 'nullable|string',
            'formulir_kegiatan_url' => 'nullable|string',
            'status_pindah' => 'nullable|string|max:30',
            'link_arsip' => 'nullable|string',
            'keputusan' => 'nullable|string|max:30',
        ]);

        try {
            $validated['waktu_submit'] = now();
            $validated['status_pindah'] = $validated['status_pindah'] ?? 'PENDING';
            $validated['keputusan'] = $validated['keputusan'] ?? 'PENDING';

            $laporan = Datamedis::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Laporan KPI untuk ' . $laporan->nama_tenaga . ' berhasil ditambahkan.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan laporan KPI: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat menyimpan data.',
            ], 500);
        }
    }

    /**
     * Memperbarui laporan KPI.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'tanggal_pelaksanaan' => 'nullable|date',
            'badge_tenaga' => 'nullable|string|max:50',
            'nama_tenaga' => 'required|string|max:255',
            'area_kerja' => 'nullable|string|max:100',
            'unit_kerja' => 'nullable|string|max:150',
            'jenis_aktifitas_kpi' => 'nullable|string|max:150',
            'foto_evidence_url' => 'nullable|string',
            'formulir_kegiatan_url' => 'nullable|string',
            'status_pindah' => 'nullable|string|max:30',
            'link_arsip' => 'nullable|string',
            'keputusan' => 'nullable|string|max:30',
        ]);

        try {
            $laporan = Datamedis::findOrFail($id);
            $laporan->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Laporan KPI untuk ' . $laporan->nama_tenaga . ' berhasil diperbarui.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui laporan KPI: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat memperbarui data.',
            ], 500);
        }
    }

    /**
     * Update cepat kolom keputusan saja (dipakai tombol Approve/Reject di tabel).
     */
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

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat memperbarui keputusan.',
            ], 500);
        }
    }

    /**
     * Menghapus laporan KPI.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $laporan = Datamedis::findOrFail($id);
            $nama = $laporan->nama_tenaga;
            $laporan->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Laporan KPI untuk ' . $nama . ' berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus laporan KPI: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat menghapus data.',
            ], 500);
        }
    }
}
