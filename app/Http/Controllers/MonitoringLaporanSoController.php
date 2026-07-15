<?php

namespace App\Http\Controllers;

use App\Models\DataUnsafe;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MonitoringLaporanSoController extends Controller
{
    public function index()
    {
        return view('monitoring-laporan-so.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = DataUnsafe::query();

            if ($badgeSo = $request->query('badge_so')) {
                $query->where('badge_so', $badgeSo);
            }

            if ($tahun = $request->query('tahun')) {
                $query->whereYear('tanggal_temuan', $tahun);
            }

            if ($bulan = $request->query('bulan')) {
                $query->whereMonth('tanggal_temuan', $bulan);
            }

            if ($jenis = $request->query('jenis_penyebab')) {
                $query->where('jenis_penyebab', $jenis);
            }

            if ($status = $request->query('status_temuan')) {
                $query->where('status_temuan', $status);
            }

            if ($search = trim((string) $request->query('search', ''))) {
                $query->search($search);
            }

            $total = $query->count();

            $query->orderByDesc('tanggal_temuan')->orderByDesc('id');

            $perPage = (int) $request->query('per_page', 15);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 15;
            $paginator = $query->paginate($perPage);

            $data = collect($paginator->items())->values()->map(function (DataUnsafe $item, $index) use ($paginator) {
                return [
                    'no' => ($paginator->currentPage() - 1) * $paginator->perPage() + $index + 1,
                    'id' => $item->id,
                    'tanggal_temuan' => optional($item->tanggal_temuan)->format('Y-m-d'),
                    'badge_so' => $item->badge_so ?? '-',
                    'nama_so' => $item->nama_so ?? '-',
                    'area_kerja' => $item->area_kerja ?? '-',
                    'unit_kerja' => $item->unit_kerja ?? '-',
                    'item_temuan' => $item->item_temuan ?? '-',
                    'jenis_penyebab' => $item->jenis_penyebab ?? '-',
                    'deskripsi_temuan' => $item->deskripsi_temuan ?? '-',
                    'rekomendasi_perbaikan' => $item->rekomendasi_perbaikan ?? '-',
                    'status_temuan' => $item->status_temuan,
                    'keputusan' => $item->keputusan ?? 'PENDING',
                    'foto_temuan_url' => $item->foto_temuan_path ? asset('storage/' . $item->foto_temuan_path) : null,
                    'dokumen_laporan_url' => $item->dokumen_laporan_path ? asset('storage/' . $item->dokumen_laporan_path) : null,
                ];
            });

            return response()->json([
                'data' => $data,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => max($paginator->lastPage(), 1),
                    'per_page' => $paginator->perPage(),
                    'total' => $total,
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                ],
                'filter_options' => [
                    'jenis_penyebab' => ['Unsafe Action', 'Unsafe Condition'],
                    'status_temuan' => ['OPEN', 'CLOSE'],
                    'tahun' => DataUnsafe::whereNotNull('tanggal_temuan')
                        ->selectRaw('DISTINCT EXTRACT(YEAR FROM tanggal_temuan) as tahun')
                        ->orderByDesc('tahun')
                        ->pluck('tahun'),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat monitoring laporan: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data monitoring laporan.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $validated['waktu_submit'] = now();
            $validated['status_temuan'] = $validated['status_temuan'] ?? 'OPEN';
            $validated['keputusan'] = $validated['keputusan'] ?? 'PENDING';

            $validated['foto_temuan_path'] = $this->storeFileIfPresent($request, 'foto_temuan', 'foto-temuan');
            $validated['dokumen_laporan_path'] = $this->storeFileIfPresent($request, 'dokumen_laporan', 'dokumen-laporan');

            $data = DataUnsafe::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => "Laporan temuan {$data->item_temuan} berhasil ditambahkan.",
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
            $newFoto = $this->storeFileIfPresent($request, 'foto_temuan', 'foto-temuan');
            if ($newFoto) {
                $this->deleteFileIfExists($dataUnsafe->foto_temuan_path);
                $validated['foto_temuan_path'] = $newFoto;
            }

            $newDokumen = $this->storeFileIfPresent($request, 'dokumen_laporan', 'dokumen-laporan');
            if ($newDokumen) {
                $this->deleteFileIfExists($dataUnsafe->dokumen_laporan_path);
                $validated['dokumen_laporan_path'] = $newDokumen;
            }

            $dataUnsafe->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => "Laporan temuan {$dataUnsafe->item_temuan} berhasil diperbarui.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data unsafe: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function updateStatus(Request $request, DataUnsafe $dataUnsafe): JsonResponse
    {
        $validated = $request->validate([
            'status_temuan' => 'required|string|in:OPEN,CLOSE',
        ]);

        $dataUnsafe->update(['status_temuan' => $validated['status_temuan']]);

        return response()->json([
            'status' => 'success',
            'message' => "Status temuan berhasil diubah menjadi {$validated['status_temuan']}.",
        ]);
    }

    public function updateKeputusan(Request $request, DataUnsafe $dataUnsafe): JsonResponse
    {
        $validated = $request->validate([
            'keputusan' => 'required|string|in:PENDING,APPROVE,REJECT',
        ]);

        $dataUnsafe->update(['keputusan' => $validated['keputusan']]);

        return response()->json([
            'status' => 'success',
            'message' => "Status keputusan untuk \"{$dataUnsafe->item_temuan}\" berhasil diubah menjadi {$validated['keputusan']}.",
        ]);
    }

    public function destroy(DataUnsafe $dataUnsafe): JsonResponse
    {
        try {
            $this->deleteFileIfExists($dataUnsafe->foto_temuan_path);
            $this->deleteFileIfExists($dataUnsafe->dokumen_laporan_path);
            $dataUnsafe->delete();

            return response()->json(['status' => 'success', 'message' => 'Laporan temuan berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data unsafe: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    // Dropdown "Pilih Nama" — hanya pegawai berstatus Safety Officer
    public function daftarSafetyOfficer(): JsonResponse
    {
        $data = Pegawai::where('is_active', true)
            ->where('is_safety_officer', true)
            ->orderBy('nama')
            ->get(['badge', 'nama'])
            ->map(fn(Pegawai $p) => [
                'badge' => $p->badge,
                'nama' => $p->nama,
                'label' => "{$p->badge}-{$p->nama}",
            ]);

        return response()->json(['data' => $data]);
    }

    // Picker Safety Officer untuk form tambah/edit (auto-fill area/unit kerja dari data pegawai)
    public function cariSafetyOfficer(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with('unitKerja')->where('is_active', true)->where('is_safety_officer', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(fn(Pegawai $p) => [
            'badge' => $p->badge,
            'nama' => $p->nama,
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

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tanggal_temuan' => 'nullable|date',
            'badge_so' => 'nullable|string|max:50',
            'nama_so' => 'required|string|max:255',
            'area_kerja' => 'nullable|string|max:150',
            'unit_kerja' => 'nullable|string|max:150',
            'item_temuan' => 'nullable|string',
            'jenis_penyebab' => 'nullable|string|in:Unsafe Action,Unsafe Condition',
            'deskripsi_temuan' => 'nullable|string',
            'rekomendasi_perbaikan' => 'nullable|string',
            'status_temuan' => 'nullable|string|in:OPEN,CLOSE',
            'keputusan' => 'nullable|string|in:PENDING,APPROVE,REJECT',
            'foto_temuan' => 'nullable|file|image|max:4096',
            'dokumen_laporan' => 'nullable|file|max:5120',
        ]);
    }
}
