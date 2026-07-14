<?php

namespace App\Http\Controllers;

use App\Models\DataRejectMonitoring;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataRejectMonitoringController extends Controller
{
    // Sesuaikan opsi ini dengan nama-nama modul asal data yang sebenarnya
    private array $asalDataOptions = ['Data Medis', 'Data Safety', 'Data Pengawas', 'Data HSE'];

    public function index()
    {
        return view('data-reject-monitoring.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = DataRejectMonitoring::search($request->query('search'));

            if ($areaKerja = $request->query('area_kerja')) {
                $query->where('area_kerja', $areaKerja);
            }
            if ($asalData = $request->query('asal_data')) {
                $query->where('asal_data', $asalData);
            }
            if ($jenis = $request->query('jenis_aktifitas_kpi')) {
                $query->where('jenis_aktifitas_kpi', $jenis);
            }

            $query->orderByDesc('tanggal_reject')->orderByDesc('id');

            $filterOptions = [
                'area_kerja' => DataRejectMonitoring::whereNotNull('area_kerja')->distinct()->orderBy('area_kerja')->pluck('area_kerja'),
                'asal_data' => $this->asalDataOptions,
                'jenis_aktifitas_kpi' => DataRejectMonitoring::whereNotNull('jenis_aktifitas_kpi')->distinct()->orderBy('jenis_aktifitas_kpi')->pluck('jenis_aktifitas_kpi'),
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;
            $paginator = $query->paginate($perPage);

            return response()->json([
                'data' => collect($paginator->items())->map(fn(DataRejectMonitoring $d) => $this->transform($d)),
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
            Log::error('Gagal memuat data reject monitoring: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $data = DataRejectMonitoring::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data monitoring reject berhasil ditambahkan.',
                'data' => $this->transform($data),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data reject monitoring: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function update(Request $request, DataRejectMonitoring $dataRejectMonitoring): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $dataRejectMonitoring->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data monitoring reject berhasil diperbarui.',
                'data' => $this->transform($dataRejectMonitoring->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data reject monitoring: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy(DataRejectMonitoring $dataRejectMonitoring): JsonResponse
    {
        try {
            $dataRejectMonitoring->delete();
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data reject monitoring: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    /**
     * Picker Nama Pelapor — semua pegawai aktif (tidak dibatasi status SO).
     */
    public function cariPelapor(Request $request): JsonResponse
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

    private function transform(DataRejectMonitoring $d): array
    {
        return $d->toArray();
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tanggal_reject' => 'nullable|date',
            'waktu_submit_form' => 'nullable|date',
            'tanggal_pelaksanaan' => 'nullable|date',
            'badge_pelapor' => 'nullable|string|max:50',
            'nama_pelapor' => 'nullable|string|max:255',
            'area_kerja' => 'nullable|string|max:150',
            'unit_kerja' => 'nullable|string|max:150',
            'jenis_aktifitas_kpi' => 'nullable|string|max:150',
            'keterangan_bahaya_materi' => 'nullable|string',
            'asal_data' => 'nullable|string|max:50',
            'link_file_reject' => 'nullable|string',
            'link_arsip_lama' => 'nullable|string',
            'catatan_reject' => 'nullable|string',
        ]);
    }
}
