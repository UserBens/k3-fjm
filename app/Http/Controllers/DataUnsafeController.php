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
    // Daftar field file: form_field => [kolom_db, folder_storage]
    private array $fileFields = [
        'foto_temuan' => ['foto_temuan_path', 'foto-temuan'],
        'dokumen_laporan' => ['dokumen_laporan_path', 'dokumen-laporan'],
    ];

    public function index()
    {
        return view('data-unsafe.index');
    }

    private const KATEGORI_FORM_UA_UC = ['temuan'];
    
    public function data(Request $request): JsonResponse
    {
        try {
            $unsafeQuery = $this->buildDataUnsafeQuery($request);
            $safetyQuery = $this->buildDataSafetyUaUcQuery($request);

            $union = $unsafeQuery->unionAll($safetyQuery);

            $perPage = (int) $request->query('per_page', 15);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 15;

            $paginator = $union
                ->orderByDesc('tanggal_temuan')
                ->orderByDesc('id')
                ->paginate($perPage, ['*'], 'page', (int) $request->query('page', 1));

            $data = collect($paginator->items())->values()->map(function ($row, $index) use ($paginator) {
                $row = (array) $row;
                $row['no'] = ($paginator->currentPage() - 1) * $paginator->perPage() + $index + 1;

                foreach (
                    ['badge_so', 'nama_so', 'area_kerja', 'unit_kerja', 'item_temuan', 'jenis_penyebab', 'deskripsi_temuan', 'rekomendasi_perbaikan'] as $field
                ) {
                    $row[$field] = $row[$field] ?? '-';
                }

                $row['tanggal_temuan'] = $row['tanggal_temuan']
                    ? \Illuminate\Support\Carbon::parse($row['tanggal_temuan'])->format('Y-m-d')
                    : null;

                // Bangun URL file — path lokal (data-unsafe/... atau data-safety/...) vs link eksternal
                foreach (['foto_temuan_path', 'dokumen_laporan_path'] as $col) {
                    $value = $row[$col] ?? null;
                    $row[$col . '_url'] = $value
                        ? (str_starts_with($value, 'http') ? $value : asset('storage/' . $value))
                        : null;
                }

                // Data dari data_safety bersifat read-only di halaman ini
                $row['is_editable'] = $row['sumber_tabel'] === 'data_unsafe';

                return $row;
            });

            $total = $paginator->total();

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
                    'keputusan' => ['PENDING', 'APPROVE', 'REJECT'],
                    'tahun' => DataUnsafe::whereNotNull('tanggal_temuan')
                        ->selectRaw('DISTINCT EXTRACT(YEAR FROM tanggal_temuan) as tahun')
                        ->orderByDesc('tahun')
                        ->pluck('tahun'),
                    'area_kerja' => DataUnsafe::whereNotNull('area_kerja')
                        ->distinct()
                        ->orderBy('area_kerja')
                        ->pluck('area_kerja')
                        ->merge(
                            \Illuminate\Support\Facades\DB::table('data_safety')
                                ->whereIn('kategori_form', self::KATEGORI_FORM_UA_UC)
                                ->whereNotNull('area_kerja')
                                ->distinct()
                                ->orderBy('area_kerja')
                                ->pluck('area_kerja')
                        )
                        ->unique()
                        ->sort()
                        ->values(),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat monitoring laporan: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data monitoring laporan.'], 500);
        }
    }

    private function buildDataUnsafeQuery(Request $request): \Illuminate\Database\Query\Builder
    {
        $query = \Illuminate\Support\Facades\DB::table('data_unsafe')
            ->select([
                'id',
                'badge_so',
                'nama_so',
                'area_kerja',
                'unit_kerja',
                'item_temuan',
                'jenis_penyebab',
                'deskripsi_temuan',
                'rekomendasi_perbaikan',
                'status_temuan',
                'tanggal_temuan',
                'keputusan',
                'foto_temuan_path',
                'dokumen_laporan_path',
                \Illuminate\Support\Facades\DB::raw("'data_unsafe' as sumber_tabel"),
            ]);

        if ($badgeSo = $request->query('badge_so')) {
            $query->where('badge_so', $badgeSo);
        }
        if ($tahun = $request->query('tahun')) {
            $query->whereYear('tanggal_temuan', $tahun);
        }
        if ($bulan = $request->query('bulan')) {
            $query->whereMonth('tanggal_temuan', $bulan);
        }
        if ($areaKerja = $request->query('area_kerja')) {
            $query->where('area_kerja', $areaKerja);
        }
        if ($jenis = $request->query('jenis_penyebab')) {
            $query->where('jenis_penyebab', $jenis);
        }
        if ($status = $request->query('status_temuan')) {
            $query->where('status_temuan', $status);
        }
        if ($keputusan = $request->query('keputusan')) {
            $query->where('keputusan', $keputusan);
        }
        if ($search = trim((string) $request->query('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_so', 'ilike', "%{$search}%")
                    ->orWhere('badge_so', 'ilike', "%{$search}%")
                    ->orWhere('item_temuan', 'ilike', "%{$search}%");
            });
        }

        return $query;
    }

    private function buildDataSafetyUaUcQuery(Request $request): \Illuminate\Database\Query\Builder
    {
        $query = \Illuminate\Support\Facades\DB::table('data_safety')
            ->whereIn('kategori_form', self::KATEGORI_FORM_UA_UC)
            ->select([
                'id',
                'badge_tenaga as badge_so',
                'nama_tenaga as nama_so',
                'area_kerja',
                'unit_kerja',
                'item_temuan',
                'jenis_penyebab',
                'deskripsi_temuan',
                'rekomendasi_tindakan_temuan as rekomendasi_perbaikan',
                'status_temuan',
                'tanggal_pelaksanaan as tanggal_temuan',
                'keputusan',
                'foto_temuan_uauc_path as foto_temuan_path',
                'formulir_kegiatan_inspeksi_area_kerja_path as dokumen_laporan_path',
                \Illuminate\Support\Facades\DB::raw("'data_safety' as sumber_tabel"),
            ]);

        if ($badgeSo = $request->query('badge_so')) {
            $query->where('badge_tenaga', $badgeSo);
        }
        if ($tahun = $request->query('tahun')) {
            $query->whereYear('tanggal_pelaksanaan', $tahun);
        }
        if ($bulan = $request->query('bulan')) {
            $query->whereMonth('tanggal_pelaksanaan', $bulan);
        }
        if ($areaKerja = $request->query('area_kerja')) {
            $query->where('area_kerja', $areaKerja);
        }
        if ($jenis = $request->query('jenis_penyebab')) {
            $query->where('jenis_penyebab', $jenis);
        }
        if ($status = $request->query('status_temuan')) {
            $query->where('status_temuan', $status);
        }
        if ($keputusan = $request->query('keputusan')) {
            $query->where('keputusan', $keputusan);
        }
        if ($search = trim((string) $request->query('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_tenaga', 'ilike', "%{$search}%")
                    ->orWhere('badge_tenaga', 'ilike', "%{$search}%")
                    ->orWhere('item_temuan', 'ilike', "%{$search}%");
            });
        }

        return $query;
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
                'data' => $this->transform($data),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data unsafe: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data.'], 500);
        }
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
        // Jangan coba hapus dari storage lokal kalau isinya link eksternal (mis. Google Drive hasil import)
        if ($path && !str_starts_with($path, 'http') && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Mengubah model jadi array untuk response JSON, sekaligus membangun URL
     * untuk kolom file. Mendukung 2 kondisi:
     *  - Path storage lokal hasil upload form (mis. "data-unsafe/foto-temuan/xxx.jpg")
     *    -> dibungkus jadi asset('storage/...')
     *  - Link eksternal penuh hasil import CSV (mis. "https://drive.google.com/...")
     *    -> dikembalikan apa adanya
     */
    private function transform(DataUnsafe $d): array
    {
        $base = $d->toArray();
        $base['tanggal_temuan'] = $d->tanggal_temuan?->format('Y-m-d');

        foreach ($this->fileFields as [$column, $folder]) {
            $value = $d->{$column};
            $base[$column . '_url'] = $value
                ? (str_starts_with($value, 'http') ? $value : asset('storage/' . $value))
                : null;
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
            'keputusan' => 'nullable|string|in:PENDING,APPROVE,REJECT',
        ];

        foreach ($this->fileFields as $formField => [$column, $folder]) {
            $rules[$formField] = $formField === 'foto_temuan'
                ? 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:4096'
                : 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:5120';
        }

        return $request->validate($rules);
    }
}
