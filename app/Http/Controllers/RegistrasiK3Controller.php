<?php

namespace App\Http\Controllers;

use App\Models\Kualifikasi;
use App\Models\LokasiKerja;
use App\Models\Pegawai;
use App\Models\Registrasi_K3;
use App\Models\StokAPD;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RegistrasiK3Controller extends Controller
{
    /**
     * Menampilkan halaman Registrasi Awal K3 (listing + modal tambah/edit).
     */
    public function index()
    {
        return view('registrasi-k3.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = Registrasi_K3::query();

            // 1. Fitur Pencarian (Search)
            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'ilike', "%{$search}%")
                        ->orWhere('nomor_ktp', 'ilike', "%{$search}%");
                });
            }

            // 2. Fitur Filter Departemen
            if ($departemen = $request->query('departemen')) {
                $query->where('departemen', $departemen);
            }

            $query->orderByDesc('created_at');

            // 3. Menyiapkan Opsi Filter (List departemen unik dari data yang sudah ada)
            $filterOptions = [
                'departemen' => Registrasi_K3::select('departemen')
                    ->distinct()
                    ->pluck('departemen')
                    ->filter()
                    ->sort()
                    ->values(),
            ];

            // 4. Pagination
            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            // 5. Mapping Data (lengkap, dipakai listing + modal detail)
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
            Log::error('Gagal memuat data Registrasi K3: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal mengambil data dari database lokal.',
            ], 500);
        }
    }

    // Dropdown "PT Asal" & "Area Kerja" — datanya sama-sama diambil dari master Lokasi Kerja.
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

    // Dropdown "Departemen" — datanya diambil dari master Unit Kerja.
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

    public function jabatanOptions(): JsonResponse
    {
        $items = Kualifikasi::query()
            ->select('nama_kualifikasi')
            ->whereNotNull('nama_kualifikasi')
            ->where('nama_kualifikasi', '!=', '')
            ->where('is_active', true)
            ->distinct()
            ->orderBy('nama_kualifikasi')
            ->pluck('nama_kualifikasi');

        return response()->json(['data' => $items]);
    }

    // Checklist APD — datanya diambil dari master Stok APD.
    // Dipakai untuk checklist "APD Dikembalikan" — list APD yang bisa dicari & discroll.
    public function apdOptions(): JsonResponse
    {
        $items = StokAPD::query()
            ->select('id', 'kode_apd', 'jenis_apd', 'merk_rekomendasi', 'ukuran_tersedia')
            ->orderBy('jenis_apd')
            ->get()
            ->map(fn(StokAPD $s) => [
                'id'                => $s->id,
                'kode_apd'          => $s->kode_apd,
                'jenis_apd'         => $s->jenis_apd,
                'merk_rekomendasi'  => $s->merk_rekomendasi,
                'ukuran_tersedia'   => $s->ukuran_tersedia,
            ]);

        return response()->json(['data' => $items]);
    }

    // Picker karyawan — dipakai untuk field "Badge" & "Nama Lengkap" di form Registrasi K3.
    public function cariPegawai(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with(['unitKerja', 'subkon'])->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(function (Pegawai $p) {
            $unitLabel = trim(collect([
                $p->unitKerja->nama_unit_kerja ?? null,
                $p->unitKerja->bagian ?? null,
                $p->subkon->nama_subkon ?? null,
            ])->filter()->implode(' — '));

            return [
                'badge'      => $p->badge ?? '-',
                'nama'       => $p->nama ?? '-',
                'jabatan'    => $p->jabatan ?? '-',
                'unit_kerja' => $unitLabel ?: '-',
            ];
        });

        return response()->json(['data' => $results]);
    }

    /**
     * Menyimpan data form registrasi & file upload — dipanggil dari modal (AJAX/FormData).
     */
    public function store(Request $request): JsonResponse
    {
        $validator = $this->validator($request, true);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $validated['unit_kerja'] = $validated['departemen']; // gabungan Departemen/Unit Kerja
        try {
            $validated['checklist_apd'] = $this->resolveChecklistApd($request);

            $folderPath = 'registrasi_k3/' . date('Y-m');
            foreach ($this->fileFields() as $field) {
                if ($request->hasFile($field)) {
                    $validated[$field] = $request->file($field)->store($folderPath, 'public');
                }
            }

            $registrasi = Registrasi_K3::create($validated);

            return response()->json([
                'message' => 'Data registrasi K3 berhasil disimpan.',
                'data'    => $this->transform($registrasi->fresh()),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data Registrasi K3: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan sistem saat menyimpan data.',
            ], 500);
        }
    }

    /**
     * Memperbarui data form registrasi & file upload — dipanggil dari modal (AJAX/FormData + _method=PUT).
     */
    public function update(Request $request, $id): JsonResponse
    {
        $registrasi = Registrasi_K3::findOrFail($id);

        $validator = $this->validator($request, false);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $validated['unit_kerja'] = $validated['departemen']; // gabungan Departemen/Unit Kerja
        try {
            $validated['checklist_apd'] = $this->resolveChecklistApd($request);

            $folderPath = 'registrasi_k3/' . date('Y-m');
            foreach ($this->fileFields() as $field) {
                if ($request->hasFile($field)) {
                    if ($registrasi->$field) {
                        Storage::disk('public')->delete($registrasi->$field);
                    }
                    $validated[$field] = $request->file($field)->store($folderPath, 'public');
                } else {
                    unset($validated[$field]); // tidak upload baru → file lama tetap dipertahankan
                }
            }

            $registrasi->update($validated);

            return response()->json([
                'message' => 'Data registrasi K3 berhasil diperbarui.',
                'data'    => $this->transform($registrasi->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Registrasi K3: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan sistem saat memperbarui data.',
            ], 500);
        }
    }

    private function fileFields(): array
    {
        return [
            'foto_diri',
            'file_ktp',
            'file_kk',
            'file_bpjs',
            'file_sks',
            'file_skck',
            'file_safety_induction',
            'file_pakta_integritas',
        ];
    }

    private function validator(Request $request, bool $filesRequired)
    {
        $fileRule = $filesRequired ? 'required' : 'nullable';

        return \Illuminate\Support\Facades\Validator::make($request->all(), [
            'tanggal_induction' => ['required', 'date'],
            'nomor_ktp'         => ['required', 'string', 'max:20'],
            'badge'             => ['nullable', 'string', 'max:50'],
            'nama_lengkap'      => ['required', 'string', 'max:255'],
            'nomor_hp'          => ['required', 'string', 'max:20'],

            'pt_asal'           => ['required', 'string', 'max:255'],
            'departemen'        => ['required', 'string', 'max:255'], // ini sekaligus jadi unit_kerja
            'jabatan'           => ['required', 'string', 'max:255'],
            'area_kerja'        => ['required', 'string', 'max:255'],

            'sim_ac'            => ['nullable', 'string', 'max:50'],
            'sio_aktif'         => ['nullable', 'string', 'max:255'],

            'nama_kontak_darurat'     => ['required', 'string', 'max:255'],
            'hubungan_kontak_darurat' => ['required', 'string', 'max:255'],
            'alamat_kontak_darurat'   => ['required', 'string'],

            'checklist_apd'          => ['nullable', 'array'],
            'checklist_apd.*'        => ['string'],
            'checklist_apd_lainnya'  => ['nullable', 'string', 'max:255'],
            'ukuran_sepatu'          => ['nullable', 'string', 'max:50'],
            'ukuran_seragam_atas'    => ['nullable', 'string', 'max:50'],
            'ukuran_seragam_bawah'   => ['nullable', 'string', 'max:50'],

            'foto_diri'               => [$fileRule, 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'file_ktp'                => [$fileRule, 'mimes:jpeg,png,jpg,pdf,webp', 'max:2048'],
            'file_kk'                 => [$fileRule, 'mimes:jpeg,png,jpg,pdf,webp', 'max:2048'],
            'file_bpjs'                => [$fileRule, 'mimes:jpeg,png,jpg,pdf,webp', 'max:2048'],
            'file_sks'                 => [$fileRule, 'mimes:jpeg,png,jpg,pdf,webp', 'max:2048'],
            'file_skck'                => [$fileRule, 'mimes:jpeg,png,jpg,pdf,webp', 'max:2048'],
            'file_safety_induction'    => [$fileRule, 'mimes:jpeg,png,jpg,pdf,webp', 'max:2048'],
            'file_pakta_integritas'    => [$fileRule, 'mimes:jpeg,png,jpg,pdf,webp', 'max:2048'],
        ]);
    }

    // Logic APD "Yang lain": kalau dicentang & ada isian teksnya, teks itu yang disimpan
    // sebagai item checklist (bukan literal "Yang lain").
    private function resolveChecklistApd(Request $request): array
    {
        $apdList = $request->input('checklist_apd', []);

        if ($request->filled('checklist_apd_lainnya') && in_array('Yang lain', $apdList)) {
            $apdList = array_diff($apdList, ['Yang lain']);
            $apdList[] = $request->input('checklist_apd_lainnya');
        }

        return array_values($apdList);
    }

    private function transform(Registrasi_K3 $item): array
    {
        $fileUrl = fn(?string $path) => $path ? asset('storage/' . $path) : null;

        return [
            'id'                       => $item->id,
            'tanggal_induction'        => optional($item->tanggal_induction)->format('Y-m-d'),
            'nomor_ktp'                => $item->nomor_ktp,
            'badge'                    => $item->badge,
            'nama_lengkap'             => $item->nama_lengkap,
            'nomor_hp'                 => $item->nomor_hp,

            'pt_asal'                  => $item->pt_asal,
            'departemen'               => $item->departemen,
            'jabatan'                  => $item->jabatan,
            'unit_kerja'               => $item->unit_kerja,
            'area_kerja'               => $item->area_kerja,

            'sim_ac'                   => $item->sim_ac,
            'sio_aktif'                => $item->sio_aktif,

            'nama_kontak_darurat'      => $item->nama_kontak_darurat,
            'hubungan_kontak_darurat'  => $item->hubungan_kontak_darurat,
            'alamat_kontak_darurat'    => $item->alamat_kontak_darurat,

            'checklist_apd'            => $item->checklist_apd ?? [],
            'ukuran_sepatu'            => $item->ukuran_sepatu,
            'ukuran_seragam_atas'      => $item->ukuran_seragam_atas,
            'ukuran_seragam_bawah'     => $item->ukuran_seragam_bawah,

            'foto_diri'                => $item->foto_diri,
            'foto_diri_url'            => $fileUrl($item->foto_diri),
            'file_ktp'                 => $item->file_ktp,
            'file_ktp_url'             => $fileUrl($item->file_ktp),
            'file_kk'                  => $item->file_kk,
            'file_kk_url'              => $fileUrl($item->file_kk),
            'file_bpjs'                => $item->file_bpjs,
            'file_bpjs_url'            => $fileUrl($item->file_bpjs),
            'file_sks'                 => $item->file_sks,
            'file_sks_url'             => $fileUrl($item->file_sks),
            'file_skck'                => $item->file_skck,
            'file_skck_url'            => $fileUrl($item->file_skck),
            'file_safety_induction'    => $item->file_safety_induction,
            'file_safety_induction_url' => $fileUrl($item->file_safety_induction),
            'file_pakta_integritas'    => $item->file_pakta_integritas,
            'file_pakta_integritas_url' => $fileUrl($item->file_pakta_integritas),
        ];
    }
}
