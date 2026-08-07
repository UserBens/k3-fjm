<?php

namespace App\Http\Controllers;

use App\Models\AktivitasKpiK3;
use App\Models\Datamedis;
use App\Models\LokasiKerja;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneratesUploadFileName;


class DataMedisController extends Controller
{
    use GeneratesUploadFileName;
    private function nextFileSequence(
        string $column,
        ?string $badge,
        ?string $jenisAktivitas,
        ?int $excludeId = null
    ): int {
        $query = Datamedis::query()
            ->whereNotNull($column)
            ->where('badge_tenaga', $badge)
            ->where('jenis_aktifitas_kpi', $jenisAktivitas);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->count() + 1;
    }
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

            if ($subArea = $request->query('sub_area')) {
                $query->where('sub_area', $subArea);
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
                'sub_area' => Datamedis::whereNotNull('sub_area')->distinct()->pluck('sub_area')->sort()->values(),
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
        $validated['waktu_submit'] = now(); // ⬅️ TAMBAHKAN INI

        try {
            // SESUDAH
            foreach (
                [
                    'foto_evidence'     => ['foto_evidence_path', 'evidence'],
                    'formulir_kegiatan' => ['formulir_kegiatan_path', 'formulir'],
                ] as $field => [$column, $folder]
            ) {
                if (!$request->hasFile($field)) continue;

                $urutan = $this->nextFileSequence(
                    $column,
                    $validated['badge_tenaga'] ?? null,
                    $validated['jenis_aktifitas_kpi'] ?? null
                );

                $path = $this->storeFileIfPresent(
                    $request,
                    $field,
                    $folder,
                    $validated['tanggal_pelaksanaan'] ?? null,
                    $validated['badge_tenaga'] ?? null,
                    $validated['nama_tenaga'] ?? null,
                    $validated['jenis_aktifitas_kpi'] ?? null,
                    $urutan
                );
                if ($path) {
                    $validated[$column] = $path;
                }
            }

            $laporan = Datamedis::create($validated);

            if (session('auth_user.role') === 'medis') {
                $validated['badge_tenaga'] = session('auth_user.username');
                $validated['nama_tenaga'] = session('auth_user.nama_lengkap');
            }

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

            foreach (
                [
                    'foto_evidence'     => ['foto_evidence_path', 'evidence'],
                    'formulir_kegiatan' => ['formulir_kegiatan_path', 'formulir'],
                ] as $field => [$column, $folder]
            ) {
                if (!$request->hasFile($field)) continue;

                $urutan = $this->nextFileSequence(
                    $column,
                    $validated['badge_tenaga'] ?? $laporan->badge_tenaga,
                    $validated['jenis_aktifitas_kpi'] ?? $laporan->jenis_aktifitas_kpi,
                    $laporan->id
                );

                $path = $this->storeFileIfPresent(
                    $request,
                    $field,
                    $folder,
                    $validated['tanggal_pelaksanaan'] ?? $laporan->tanggal_pelaksanaan,
                    $validated['badge_tenaga'] ?? $laporan->badge_tenaga,
                    $validated['nama_tenaga'] ?? $laporan->nama_tenaga,
                    $validated['jenis_aktifitas_kpi'] ?? $laporan->jenis_aktifitas_kpi,
                    $urutan
                );
                if ($path) {
                    $validated[$column] = $path;
                }
            }
            
            if (session('auth_user.role') === 'medis' && $laporan->badge_tenaga !== session('auth_user.username')) {
                return response()->json(['message' => 'Anda tidak memiliki izin untuk mengubah data ini.'], 403);
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

    // Dropdown/picker "Jenis Aktivitas KPI" <- master aktivitas_kpi_k3 (hanya yang berstatus AKTIF & sesuai tahun berjalan).
    public function jenisAktivitasOptions(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $tahunIni = (int) now()->format('Y');

        $query = AktivitasKpiK3::query()
            ->where('status', 'AKTIF')
            ->where('mulai_berlaku', '<=', $tahunIni)
            ->where(function ($q) use ($tahunIni) {
                $q->whereNull('akhir_berlaku')->orWhere('akhir_berlaku', '>=', $tahunIni);
            });

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama_aktivitas', 'ilike', "%{$search}%")
                    ->orWhere('kode', 'ilike', "%{$search}%");
            });
        }

        $items = $query->orderBy('kode')->get()->map(fn(AktivitasKpiK3 $a) => [
            'id'             => $a->id,
            'kode'           => $a->kode,
            'nama_aktivitas' => $a->nama_aktivitas,
            'label'          => "[{$a->kode}] {$a->nama_aktivitas}",
        ]);

        return response()->json(['data' => $items]);
    }

    // Dropdown/picker "Area Kerja" <- gabungan daftar tetap + master Lokasi Kerja.
    public function lokasiKerjaOptions(): JsonResponse
    {
        $staticOptions = [
            "BUNCOP",
            "DERMAGA A",
            "DIKLAT",
            "GEDUNG GRAHA",
            "GUDANG MULTI GUNA (GMG)",
            "JETTY I, II, III",
            "KIG",
            "PA BABAT",
            "PA GUNUNGSARI",
            "PABRIK I A",
            "PABRIK I B",
            "PABRIK II A",
            "PABRIK II B",
            "PABRIK III A",
            "PABRIK III B",
            "PERUMAHAN DINAS",
            "SOR"
        ];

        $items = collect($staticOptions)
            ->unique()
            ->sort(SORT_STRING)
            ->values();

        return response()->json(['data' => $items]);
    }

    // Dropdown/picker "Sub Area" — daftar tetap.
    public function subAreaOptions(): JsonResponse
    {
        $staticOptions = [
            "ADM & KEUANGAN",
            "ADMIN BISNIS",
            "ADMINISTRASI & PENJUALAN",
            "ADMINISTRASI BISNIS",
            "AGRO SOLUTION",
            "AKUNTANSI",
            "BARANG REJECT",
            "DIKLAT",
            "FABRIKASI DAN ALAT BERAT",
            "GEDUNG ADMINISTRASI",
            "HAR I A",
            "HAR I B",
            "HAR II",
            "HAR III A",
            "HAR III B",
            "HARSAN",
            "HK",
            "HUKUM & SEKRETARIAT",
            "KEUANGAN",
            "KOMUNIKASI KORPORAT",
            "LABORATORIUM",
            "MITRA BISNIS PEMASARAN RETAIL",
            "OPERASIONAL PELABUHAN",
            "PA BABAT",
            "PA GUNUNGSARI",
            "PELAPORAN KEUANGAN & MANAJEMEN",
            "PELAYANAN UMUM",
            "PEMADAM KEBAKARAN",
            "PEMELIHARAAN PELABUHAN",
            "PENGADAAN BARANG",
            "PENGADAAN DAN PENGEMBANGAN BISNIS",
            "PENGADAAN JASA",
            "PENGELOLAAN MITRA",
            "PENGELOLAAN PELANGGAN",
            "PENGELOLAAN TRANSFORMASI BISNIS",
            "PENGEMBANGAN KORPORAT",
            "PENGHIJAUAN",
            "PERGUDANGAN DAN PENGANTONGAN",
            "PORTFOLIO BISNIS",
            "PPBJ",
            "PPSB",
            "PRODUKSI I",
            "PRODUKSI II A",
            "PRODUKSI II B",
            "PRODUKSI III",
            "PRODUKSI III A",
            "PRODUKSI III B",
            "PROJECT MANAJER RETAIL MANAJEMEN",
            "PROYEK INFRASTRUKTUR",
            "PROYEK MANAJEMEN PRODUK BARU",
            "PROYEK PENGEMBANGAN",
            "RENDAL & ANGGARAN",
            "RENSTRAHAR",
            "RISET",
            "TANGGUNG JAWAB SOSIAL DAN LINGKUNGAN",
            "TATA KELOLA PERUSAHAAN & MANAJEMEN RISIKO",
            "TEKNIK & BISNIS"
        ];

        $items = collect($staticOptions)
            ->unique()
            ->sort(SORT_STRING)
            ->values();

        return response()->json(['data' => $items]);
    }

    public function destroy($id): JsonResponse
    {
        try {
            $laporan = Datamedis::findOrFail($id);
            $nama = $laporan->nama_tenaga;

            $this->deleteFileIfExists($laporan->foto_evidence_path);
            $this->deleteFileIfExists($laporan->formulir_kegiatan_path);

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

    private function storeFileIfPresent(
        Request $request,
        string $field,
        string $folder,
        ?string $tanggal,
        ?string $badge,
        ?string $nama,
        ?string $jenisAktivitas,
        int $urutan
    ): ?string {
        if (!$request->hasFile($field)) return null;

        $file = $request->file($field);
        $fileName = $this->buildUploadFileName(
            $tanggal,
            $badge,
            $nama,
            $jenisAktivitas,
            $this->fileLabels[$field] ?? $field,
            $urutan,
            $file->getClientOriginalExtension()
        );

        return $file->storeAs("data-medis/{$folder}", $fileName, 'public');
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
            'sub_area' => $item->sub_area ?? '-', // ⬅️ BARU
            'unit_kerja' => $item->unit_kerja ?? '-',
            'jenis_aktifitas_kpi' => $item->jenis_aktifitas_kpi ?? '-',
            'foto_evidence_url' => $item->foto_evidence_path ? asset('storage/' . $item->foto_evidence_path) : null,
            'formulir_kegiatan_url' => $item->formulir_kegiatan_path ? asset('storage/' . $item->formulir_kegiatan_path) : null,
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
            'sub_area' => 'nullable|string|max:150', // ⬅️ BARU
            'unit_kerja' => 'nullable|string|max:150',
            'jenis_aktifitas_kpi' => 'nullable|string|max:150',
            'status_pindah' => 'nullable|string|max:30',
            'keputusan' => 'nullable|string|max:30',

            'foto_evidence' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:4096',
            'formulir_kegiatan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);
    }
}
