<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\ToolboxMeeting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ToolboxMeetingController extends Controller
{
    /**
     * form_field => [kolom_di_database, nama_folder_di_storage]
     * Nama kolom di tabel toolbox_meetings sama persis dengan nama field form.
     */
    private array $fileFields = [
        'foto_tbm' => ['foto_tbm', 'foto-tbm'],
        'foto_daftar_hadir' => ['foto_daftar_hadir', 'foto-daftar-hadir'],
        'dokumen_laporan_kegiatan' => ['dokumen_laporan_kegiatan', 'dokumen-laporan-kegiatan'],
    ];

    /**
     * Halaman utama (Blade view).
     */
    public function index()
    {
        return view('toolbox-meeting.index');
    }

    /**
     * Data tabel: list + search + filter + pagination.
     */
    public function data(Request $request): JsonResponse
    {
        try {
            $query = ToolboxMeeting::query();

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_so', 'ilike', "%{$search}%")
                        ->orWhere('badge_so', 'ilike', "%{$search}%")
                        ->orWhere('area_kerja', 'ilike', "%{$search}%")
                        ->orWhere('unit_kerja', 'ilike', "%{$search}%");
                });
            }

            if ($areaKerja = $request->query('area_kerja')) {
                $query->where('area_kerja', $areaKerja);
            }

            if ($unitKerja = $request->query('unit_kerja')) {
                $query->where('unit_kerja', $unitKerja);
            }

            if ($tanggalMulai = $request->query('tanggal_mulai')) {
                $query->whereDate('tanggal', '>=', $tanggalMulai);
            }

            if ($tanggalSelesai = $request->query('tanggal_selesai')) {
                $query->whereDate('tanggal', '<=', $tanggalSelesai);
            }

            $query->orderBy('tanggal', 'desc')->orderBy('id', 'desc');

            $filterOptions = [
                'area_kerja' => ToolboxMeeting::whereNotNull('area_kerja')
                    ->distinct()->orderBy('area_kerja')->pluck('area_kerja'),
                'unit_kerja' => ToolboxMeeting::whereNotNull('unit_kerja')
                    ->distinct()->orderBy('unit_kerja')->pluck('unit_kerja'),
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $transformed = collect($paginator->items())->map(fn(ToolboxMeeting $item) => [
                'id' => $item->id,
                'tanggal' => optional($item->tanggal)->format('Y-m-d'),
                'badge_so' => $item->badge_so ?? '-',
                'nama_so' => $item->nama_so ?? '-',
                'area_kerja' => $item->area_kerja ?? '-',
                'unit_kerja' => $item->unit_kerja ?? '-',
                'foto_tbm' => $item->foto_tbm ? asset('storage/' . $item->foto_tbm) : null,
                'foto_daftar_hadir' => $item->foto_daftar_hadir ? asset('storage/' . $item->foto_daftar_hadir) : null,
                'dokumen_laporan_kegiatan' => $item->dokumen_laporan_kegiatan ? asset('storage/' . $item->dokumen_laporan_kegiatan) : null,
            ]);

            return response()->json([
                'data' => $transformed,
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
            Log::error('Gagal memuat data TBM: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data toolbox meeting.'], 500);
        }
    }

    /**
     * Simpan data TBM baru (multipart/form-data — mendukung upload file).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $validated['created_by'] = session('auth_user.username');

            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) {
                    $validated[$column] = $path;
                }
            }

            $tbm = ToolboxMeeting::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data toolbox meeting berhasil disimpan.',
                'data' => $this->transform($tbm),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data TBM: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data toolbox meeting.'], 500);
        }
    }

    /**
     * Perbarui data TBM. Dikirim sebagai POST + _method=PUT (form-data)
     * supaya PHP bisa membaca file upload (native PUT tidak mendukung multipart).
     */
    public function update(Request $request, ToolboxMeeting $toolboxMeeting): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) {
                    $this->deleteFileIfExists($toolboxMeeting->{$column});
                    $validated[$column] = $path;
                }
            }

            $toolboxMeeting->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data toolbox meeting berhasil diperbarui.',
                'data' => $this->transform($toolboxMeeting->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data TBM: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data toolbox meeting.'], 500);
        }
    }

    /**
     * Hapus data TBM beserta file-file terkait di storage.
     */
    public function destroy(ToolboxMeeting $toolboxMeeting): JsonResponse
    {
        try {
            foreach ($this->fileFields as [$column, $folder]) {
                $this->deleteFileIfExists($toolboxMeeting->{$column});
            }

            $toolboxMeeting->delete();

            return response()->json(['status' => 'success', 'message' => 'Data toolbox meeting berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data TBM: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data toolbox meeting.'], 500);
        }
    }

    /**
     * Cari Safety Officer aktif untuk dipilih sebagai pengisi TBM (autocomplete).
     */
    public function cariSafetyOfficer(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));

        $query = Pegawai::where('is_active', true)->where('is_safety_officer', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")
                    ->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(fn($p) => [
            'badge' => $p->badge ?? '-',
            'nama' => $p->nama ?? '-',
        ]);

        return response()->json(['data' => $results]);
    }

    private function storeFileIfPresent(Request $request, string $field, string $folder): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        return $request->file($field)->store("tbm/{$folder}", 'public');
    }

    private function deleteFileIfExists(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function transform(ToolboxMeeting $item): array
    {
        $base = $item->toArray();

        foreach ($this->fileFields as [$column, $folder]) {
            $base[$column] = $item->{$column} ? asset('storage/' . $item->{$column}) : null;
        }

        return $base;
    }

    /**
     * Aturan validasi form (dipakai bersama oleh store & update).
     */
    private function validateData(Request $request): array
    {
        $rules = [
            'tanggal' => 'required|date',
            'badge_so' => 'nullable|string',
            'nama_so' => 'nullable|string|max:255',
            'area_kerja' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
        ];

        foreach ($this->fileFields as $formField => [$column, $folder]) {
            $rules[$formField] = $formField === 'foto_tbm'
                // Foto TBM: wajib berupa gambar (dokumentasi kegiatan)
                ? 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:5120'
                // Foto Daftar Hadir & Dokumen Laporan Kegiatan: gambar/PDF/Word hasil scan
                : 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240';
        }

        return $request->validate($rules);
    }
}
