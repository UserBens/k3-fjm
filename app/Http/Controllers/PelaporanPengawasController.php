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

class PelaporanPengawasController extends Controller
{
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

            // 1. Fitur Pencarian (Search)
            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pengawas', 'ilike', "%{$search}%")
                        ->orWhere('badge_pengawas', 'ilike', "%{$search}%")
                        ->orWhere('id_laporan', 'ilike', "%{$search}%");
                });
            }

            // 2. Fitur Filter Unit Kerja & Status
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

            // 3. Opsi Filter (unit kerja & status unik dari data yang sudah ada)
            $filterOptions = [
                'unit_kerja' => PelaporanPengawas::select('unit_kerja')
                    ->distinct()
                    ->pluck('unit_kerja')
                    ->filter()
                    ->sort()
                    ->values(),
                'status' => ['APPROVE', 'REJECT', 'CANCEL'],
            ];

            // 4. Pagination
            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            // 5. Mapping Data
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

    // Dropdown "Area Kerja" <- master Lokasi Kerja.
    public function lokasiKerjaOptions(): JsonResponse
    {
        $items = LokasiKerja::query()
            ->select('nama_lokasi')
            ->whereNotNull('nama_lokasi')
            ->where('nama_lokasi', '!=', '')
            ->distinct()
            ->orderBy('nama_lokasi')
            ->pluck('nama_lokasi');

        return response()->json(['data' => $items]);
    }

    // Dropdown "Unit Kerja" <- master Unit Kerja.
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

    // Dropdown/picker "Jenis Aktifitas KPI" <- master aktivitas_kpi_k3 (hanya yang berstatus AKTIF).
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
            'label'          => $a->label, // "[kode] nama_aktivitas"
            'kategori'       => str_contains(strtolower($a->nama_aktivitas), 'nearmiss')
                ? 'NEARMISS'
                : (str_contains(strtolower($a->nama_aktivitas), 'safety briefing') ? 'BRIEFING' : 'LAINNYA'),
        ]);

        return response()->json(['data' => $items]);
    }

    // Picker karyawan — dipakai untuk field "Nama Pengawas" di form.
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
                if ($request->hasFile($field)) {
                    $validated[$field] = $request->file($field)->store($folderPath, 'public');
                }
            }

            $validated['id_laporan']    = $this->generateIdLaporan();
            $validated['status']        = $validated['status'] ?? 'APPROVE';
            $validated['lokasi_berkas'] = 'ARSIP';
            $validated['diperiksa_oleh'] = $request->user()->email ?? auth()->user()?->email;

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
                    if ($laporan->$field) {
                        Storage::disk('public')->delete($laporan->$field);
                    }
                    $validated[$field] = $request->file($field)->store($folderPath, 'public');
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

    /**
     * Generate ID Laporan format: PGW-YYYYMMDD-XXXX (4 karakter acak uppercase),
     * dicek keunikannya terhadap kolom id_laporan.
     */
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

        // Field khusus per jenis aktivitas hanya wajib diisi kalau jenis aktivitasnya cocok,
        // dan hanya wajib saat data baru (create) — saat edit tanpa upload baru, file lama dipertahankan.
        $nearmissTextRule = $isNearmiss ? 'required' : 'nullable';
        $nearmissFileRule = ($isNearmiss && $filesRequiredBase) ? 'required' : 'nullable';
        $briefingTextRule = $isBriefing ? 'required' : 'nullable';
        $briefingFileRule = ($isBriefing && $filesRequiredBase) ? 'required' : 'nullable';

        return Validator::make($request->all(), [
            'tanggal_pelaksanaan' => ['required', 'date'],
            'badge_pengawas'      => ['nullable', 'string', 'max:50'],
            'nama_pengawas'       => ['required', 'string', 'max:255'],
            'area_kerja'          => ['required', 'string', 'max:255'],
            'unit_kerja'          => ['required', 'string', 'max:255'],
            'aktivitas_kpi_k3_id' => ['required', 'exists:aktivitas_kpi_k3,id'],

            'keterangan_bahaya'  => [$nearmissTextRule, 'string'],
            'foto_temuan_bahaya' => [$nearmissFileRule, 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],

            'materi_safety_briefing'        => [$briefingTextRule, 'string'],
            'foto_kegiatan_safety_briefing' => [$briefingFileRule, 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'formulir_presensi_pdf'         => [$briefingFileRule, 'mimes:pdf', 'max:4096'],

            'status' => ['nullable', 'in:APPROVE,REJECT,CANCEL'],
        ]);
    }

    private function transform(PelaporanPengawas $item): array
    {
        $fileUrl = fn(?string $path) => $path ? asset('storage/' . $path) : null;

        return [
            'id'                   => $item->id,
            'tanggal_pelaksanaan'  => optional($item->tanggal_pelaksanaan)->format('Y-m-d'),
            'badge_pengawas'       => $item->badge_pengawas,
            'nama_pengawas'        => $item->nama_pengawas,
            'area_kerja'           => $item->area_kerja,
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
