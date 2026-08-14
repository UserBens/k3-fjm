<?php

namespace App\Http\Controllers;

use App\Models\AktivitasKpiK3;
use App\Models\LokasiKerja;
use App\Models\Pegawai;
use App\Models\PelaporanPengawas;
use App\Models\UnitKerja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\GeneratesUploadFileName;


class PelaporanPengawasController extends Controller
{
    use GeneratesUploadFileName;

    // Label yang dipakai untuk penamaan file (harus didefinisikan, sebelumnya belum ada)
    private array $fileLabels = [
        'foto_temuan_bahaya'            => 'Foto Temuan Bahaya',
        'foto_kegiatan_safety_briefing' => 'Foto Kegiatan Safety Briefing',
        'formulir_presensi_pdf'         => 'Formulir Presensi',
    ];

    /**
     * Hitung nomor urut file berdasarkan riwayat laporan lain
     * (badge pengawas + jenis aktivitas yang sama) yang sudah punya file di kolom ini.
     * Menggunakan aktivitas_kpi_k3_id karena tabel ini tidak punya kolom jenis_aktifitas_kpi.
     */
    private function nextFileSequence(
        string $column,
        ?string $badge,
        ?int $aktivitasId,
        ?int $excludeId = null
    ): int {
        $query = PelaporanPengawas::query()
            ->whereNotNull($column)
            ->where('badge_pengawas', $badge)
            ->where('aktivitas_kpi_k3_id', $aktivitasId);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->count() + 1;
    }

    /**
     * Menampilkan halaman Pelaporan Pengawas (listing + modal tambah/edit).
     */
    public function index()
    {
        return view('pelaporan-pengawas.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = PelaporanPengawas::with('aktivitas');
            $userRole = session('auth_user.role');
            if ($userRole === 'pengawas') {
                $query->where('badge_pengawas', session('auth_user.username'));
            }
            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pengawas', 'ilike', "%{$search}%")
                        ->orWhere('badge_pengawas', 'ilike', "%{$search}%")
                        ->orWhere('id_laporan', 'ilike', "%{$search}%");
                });
            }

            if ($unitKerja = $request->query('unit_kerja')) {
                $query->where('unit_kerja', $unitKerja);
            }
            if ($status = $request->query('status')) {
                $query->where('status', $status);
            }
            if ($aktivitasId = $request->query('aktivitas_kpi_k3_id')) {
                $query->where('aktivitas_kpi_k3_id', $aktivitasId);
            }

            $query->orderByDesc('tanggal_pelaksanaan')->orderByDesc('created_at');

            $filterOptions = [
                'unit_kerja' => PelaporanPengawas::select('unit_kerja')
                    ->distinct()
                    ->pluck('unit_kerja')
                    ->filter()
                    ->sort()
                    ->values(),
                'status' => ['PENDING', 'APPROVE', 'REJECT', 'CANCEL'],
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $transformedData = collect($paginator->items())->map(fn($item) => $this->transform($item));

            return response()->json([
                'data' => $transformedData,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page'    => max($paginator->lastPage(), 1),
                    'per_page'     => $paginator->perPage(),
                    'total'        => $paginator->total(),
                    'from'         => $paginator->firstItem(),
                    'to'           => $paginator->lastItem(),
                ],
                'filter_options' => $filterOptions,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data Pelaporan Pengawas: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal mengambil data dari database lokal.',
            ], 500);
        }
    }

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

    public function unitKerjaOptions(): JsonResponse
    {
        $items = UnitKerja::query()
            ->select('nama_unit_kerja')
            ->whereNotNull('nama_unit_kerja')
            ->where('nama_unit_kerja', '!=', '')
            ->where('is_active', true)
            ->distinct()
            ->orderBy('nama_unit_kerja')
            ->pluck('nama_unit_kerja');

        return response()->json(['data' => $items]);
    }

    public function jenisAktivitasOptions(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $tahunIni = (int) now()->format('Y');

        $query = AktivitasKpiK3::query()
            ->aktif()
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
            'label'          => $a->label,
            'kategori'       => str_contains(strtolower($a->nama_aktivitas), 'nearmiss')
                ? 'NEARMISS'
                : (str_contains(strtolower($a->nama_aktivitas), 'safety briefing') ? 'BRIEFING' : 'LAINNYA'),
        ]);

        return response()->json(['data' => $items]);
    }

    public function cariPengawas(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with(['unitKerja'])->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(fn(Pegawai $p) => [
            'badge'      => $p->badge ?? '-',
            'nama'       => $p->nama ?? '-',
            'unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
        ]);

        return response()->json(['data' => $results]);
    }

    public function store(Request $request): JsonResponse
    {
        $aktivitas = AktivitasKpiK3::find($request->input('aktivitas_kpi_k3_id'));

        $validator = $this->validator($request, $aktivitas, true);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        try {
            $folderPath = 'pelaporan_pengawas/' . date('Y-m');

            foreach ($this->fileFields() as $field) {
                if (!$request->hasFile($field)) continue;

                $urutan = $this->nextFileSequence(
                    $field,
                    $validated['badge_pengawas'] ?? null,
                    $validated['aktivitas_kpi_k3_id'] ?? null
                );

                $file = $request->file($field);
                $fileName = $this->buildUploadFileName(
                    $validated['tanggal_pelaksanaan'] ?? null,
                    $validated['badge_pengawas'] ?? null,
                    $validated['nama_pengawas'] ?? null,
                    $aktivitas->nama_aktivitas ?? null,
                    $this->fileLabels[$field] ?? $field,
                    $urutan,
                    $file->getClientOriginalExtension()
                );

                $validated[$field] = $file->storeAs($folderPath, $fileName, 'public');
            }

            $validated['id_laporan']    = $this->generateIdLaporan();
            $validated['status']    = $validated['status'] ?? 'PENDING';
            $validated['lokasi_berkas'] = 'ARSIP';
            $validated['diperiksa_oleh'] = $request->user()->email ?? auth()->user()?->email;
            $validated['waktu_submit']  = $validated['waktu_submit'] ?? now(); // ← baru

            $laporan = PelaporanPengawas::create($validated);

            return response()->json([
                'message' => 'Data pelaporan pengawas berhasil disimpan.',
                'data'    => $this->transform($laporan->fresh('aktivitas')),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data Pelaporan Pengawas: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan sistem saat menyimpan data.',
            ], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $laporan = PelaporanPengawas::findOrFail($id);
        $aktivitas = AktivitasKpiK3::find($request->input('aktivitas_kpi_k3_id'));

        $validator = $this->validator($request, $aktivitas, false);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        try {
            $folderPath = 'pelaporan_pengawas/' . date('Y-m');

            foreach ($this->fileFields() as $field) {
                if ($request->hasFile($field)) {
                    $urutan = $this->nextFileSequence(
                        $field,
                        $validated['badge_pengawas'] ?? $laporan->badge_pengawas,
                        $validated['aktivitas_kpi_k3_id'] ?? $laporan->aktivitas_kpi_k3_id,
                        $laporan->id
                    );

                    if ($laporan->$field) {
                        Storage::disk('public')->delete($laporan->$field);
                    }

                    $file = $request->file($field);
                    $fileName = $this->buildUploadFileName(
                        $validated['tanggal_pelaksanaan'] ?? $laporan->tanggal_pelaksanaan,
                        $validated['badge_pengawas'] ?? $laporan->badge_pengawas,
                        $validated['nama_pengawas'] ?? $laporan->nama_pengawas,
                        $aktivitas->nama_aktivitas ?? $laporan->aktivitas?->nama_aktivitas,
                        $this->fileLabels[$field] ?? $field,
                        $urutan,
                        $file->getClientOriginalExtension()
                    );

                    $validated[$field] = $file->storeAs($folderPath, $fileName, 'public');
                } else {
                    unset($validated[$field]); // tidak upload baru -> file lama tetap dipertahankan
                }
            }

            $laporan->update($validated);

            return response()->json([
                'message' => 'Data pelaporan pengawas berhasil diperbarui.',
                'data'    => $this->transform($laporan->fresh('aktivitas')),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Pelaporan Pengawas: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan sistem saat memperbarui data.',
            ], 500);
        }
    }

    private function fileFields(): array
    {
        return [
            'foto_temuan_bahaya',
            'foto_kegiatan_safety_briefing',
            'formulir_presensi_pdf',
        ];
    }

    private function generateIdLaporan(): string
    {
        do {
            $candidate = 'PGW-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (PelaporanPengawas::where('id_laporan', $candidate)->exists());

        return $candidate;
    }

    private function validator(Request $request, ?AktivitasKpiK3 $aktivitas, bool $filesRequiredBase)
    {
        $namaAktivitas = strtolower($aktivitas->nama_aktivitas ?? '');
        $isNearmiss   = str_contains($namaAktivitas, 'nearmiss');
        $isBriefing   = str_contains($namaAktivitas, 'safety briefing');

        $nearmissTextRule = $isNearmiss ? 'required' : 'nullable';
        $nearmissFileRule = ($isNearmiss && $filesRequiredBase) ? 'required' : 'nullable';
        $briefingTextRule = $isBriefing ? 'required' : 'nullable';
        $briefingFileRule = ($isBriefing && $filesRequiredBase) ? 'required' : 'nullable';

        return Validator::make($request->all(), [
            'tanggal_pelaksanaan' => ['required', 'date'],
            'waktu_submit' => ['nullable', 'date'],
            'badge_pengawas'      => ['nullable', 'string', 'max:50'],
            'nama_pengawas'       => ['required', 'string', 'max:255'],
            'area_kerja'          => ['required', 'string', 'max:255'],
            'sub_area' => ['nullable', 'string', 'max:150'],
            'unit_kerja'          => ['required', 'string', 'max:255'],
            'aktivitas_kpi_k3_id' => ['required', 'exists:aktivitas_kpi_k3,id'],

            'keterangan_bahaya'  => [$nearmissTextRule, 'string'],
            'foto_temuan_bahaya' => [$nearmissFileRule, 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],

            'materi_safety_briefing'        => [$briefingTextRule, 'string'],
            'foto_kegiatan_safety_briefing' => [$briefingFileRule, 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'formulir_presensi_pdf'         => [$briefingFileRule, 'mimes:pdf', 'max:4096'],
            'status' => ['nullable', 'in:PENDING,APPROVE,REJECT,CANCEL'],
        ]);
    }

    private function transform(PelaporanPengawas $item): array
    {
        $fileUrl = fn(?string $path) => $path ? asset('storage/' . $path) : null;

        return [
            'id'                   => $item->id,
            'tanggal_pelaksanaan'  => optional($item->tanggal_pelaksanaan)->format('Y-m-d'),
            'waktu_submit' => optional($item->waktu_submit)->format('Y-m-d H:i:s'),
            'badge_pengawas'       => $item->badge_pengawas,
            'nama_pengawas'        => $item->nama_pengawas,
            'area_kerja'           => $item->area_kerja,
            'sub_area'    => $item->sub_area,   // ← BARU
            'unit_kerja'           => $item->unit_kerja,

            'aktivitas_kpi_k3_id'  => $item->aktivitas_kpi_k3_id,
            'aktivitas_label'      => $item->aktivitas?->label,
            'aktivitas_kode'       => $item->aktivitas?->kode,
            'aktivitas_nama'       => $item->aktivitas?->nama_aktivitas,

            'keterangan_bahaya'    => $item->keterangan_bahaya,
            'foto_temuan_bahaya'   => $item->foto_temuan_bahaya,
            'foto_temuan_bahaya_url' => $fileUrl($item->foto_temuan_bahaya),

            'materi_safety_briefing' => $item->materi_safety_briefing,
            'foto_kegiatan_safety_briefing' => $item->foto_kegiatan_safety_briefing,
            'foto_kegiatan_safety_briefing_url' => $fileUrl($item->foto_kegiatan_safety_briefing),
            'formulir_presensi_pdf' => $item->formulir_presensi_pdf,
            'formulir_presensi_pdf_url' => $fileUrl($item->formulir_presensi_pdf),

            'id_laporan'     => $item->id_laporan,
            'status'         => $item->status,
            'lokasi_berkas'  => $item->lokasi_berkas,
            'diperiksa_oleh' => $item->diperiksa_oleh,
        ];
    }
}
