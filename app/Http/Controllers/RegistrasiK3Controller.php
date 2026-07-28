<?php

namespace App\Http\Controllers;

use App\Models\Registrasi_K3;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RegistrasiK3Controller extends Controller
{
    /**
     * Menampilkan form Registrasi Awal K3.
     */
    public function index()
    {
        return view('registrasi-k3.index');
    }

    public function create()
    {
        return view('registrasi-k3.create');
    }

    public function api(Request $request): JsonResponse
    {
        try {
            $query = Registrasi_K3::query();

            // 1. Fitur Pencarian (Search)
            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    // Pakai 'ilike' jika pakai PostgreSQL, ganti 'like' jika pakai MySQL
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('badge', 'like', "%{$search}%")
                        ->orWhere('nomor_ktp', 'like', "%{$search}%");
                });
            }

            // 2. Fitur Filter Departemen
            if ($departemen = $request->query('departemen')) {
                $query->where('departemen', $departemen);
            }

            $query->orderByDesc('created_at');

            // 3. Menyiapkan Opsi Filter (List departemen unik)
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

            // 5. Mapping Data
            $transformedData = collect($paginator->items())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'tanggal_induction' => $item->tanggal_induction,
                    'badge' => $item->badge ?? '-',
                    'nama_lengkap' => $item->nama_lengkap ?? '-',
                    'nomor_ktp' => $item->nomor_ktp ?? '-',
                    'nomor_hp' => $item->nomor_hp ?? '-',
                    'pt_asal' => $item->pt_asal ?? '-',
                    'departemen' => $item->departemen ?? '-',
                    'jabatan' => $item->jabatan ?? '-',
                    'unit_kerja' => $item->unit_kerja ?? '-',

                    // URL Foto & Dokumen (untuk ditampilkan di modal detail nantinya)
                    'foto_diri_url' => $item->foto_diri ? asset('storage/' . $item->foto_diri) : null,
                    'file_ktp_url' => $item->file_ktp ? asset('storage/' . $item->file_ktp) : null,
                ];
            });

            return response()->json([
                'data' => $transformedData,
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
            Log::error('Gagal memuat data Registrasi K3: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal mengambil data dari database lokal.',
            ], 500);
        }
    }


    /**
     * Menyimpan data form registrasi & file upload ke database lokal.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Klien
        $validated = $request->validate([
            'tanggal_induction' => 'required|date',
            'nomor_ktp' => 'required|string|max:20',
            'badge' => 'required|string|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',

            'pt_asal' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'area_kerja' => 'required|string|max:255',

            'sim_ac' => 'nullable|string|max:50',
            'sio_aktif' => 'nullable|string|max:255',

            'nama_kontak_darurat' => 'required|string|max:255',
            'hubungan_kontak_darurat' => 'required|string|max:255',
            'alamat_kontak_darurat' => 'required|string',

            // APD & Ukuran
            'checklist_apd' => 'nullable|array',
            'checklist_apd.*' => 'string',
            'checklist_apd_lainnya' => 'nullable|string|max:255',
            'ukuran_sepatu' => 'nullable|string|max:50',
            'ukuran_seragam_atas' => 'nullable|string|max:50',
            'ukuran_seragam_bawah' => 'nullable|string|max:50',

            // Validasi File Upload (Maksimal 2MB)
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file_ktp' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_kk' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_bpjs' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_sks' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_skck' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_safety_induction' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_pakta_integritas' => 'required|mimes:jpeg,png,jpg,pdf,webp|max:2048',
        ]);

        try {
            // Logic APD Lainnya
            $apdList = $request->input('checklist_apd', []);
            if ($request->filled('checklist_apd_lainnya') && in_array('Yang lain', $apdList)) {
                $apdList = array_diff($apdList, ['Yang lain']);
                $apdList[] = $request->input('checklist_apd_lainnya');
            }
            $validated['checklist_apd'] = array_values($apdList);
            unset($validated['checklist_apd_lainnya']);

            // Proses Upload File
            $folderPath = 'registrasi_k3/' . date('Y-m');
            $fileFields = [
                'foto_diri',
                'file_ktp',
                'file_kk',
                'file_bpjs',
                'file_sks',
                'file_skck',
                'file_safety_induction',
                'file_pakta_integritas'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $validated[$field] = $request->file($field)->store($folderPath, 'public');
                }
            }

            // Simpan ke Database
            Registrasi_K3::create($validated);

            return redirect()->route('registrasi-k3.index')
                ->with('success', 'Data registrasi K3 berhasil disimpan!');
        } catch (\Throwable $e) {
            // 1. Tampilkan pesan error ke file log sistem
            Log::error('Gagal menyimpan data Registrasi K3: ' . $e->getMessage());

            // 2. Kembalikan error dan inputan lama agar muncul di tiap-tiap input form
            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage()) // Menyertakan pesan error sistem jika diperlukan
                ->with('error', 'Terjadi kesalahan sistem saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $registrasi = Registrasi_K3::findOrFail($id);

        // Pastikan checklist_apd berbentuk array jika disimpan sebagai string/JSON di DB
        $checklistApd = is_array($registrasi->checklist_apd)
            ? $registrasi->checklist_apd
            : json_decode($registrasi->checklist_apd, true) ?? [];

        return view('registrasi-k3.edit', compact('registrasi', 'checklistApd'));
    }

    /**
     * Memperbarui data form registrasi & file upload di database lokal.
     */
    public function update(Request $request, $id)
    {
        $registrasi = Registrasi_K3::findOrFail($id);

        // 1. Validasi Input Klien
        // Catatan: Semua field file diubah dari 'required' menjadi 'nullable' 
        // karena user tidak wajib upload ulang jika tidak ingin mengganti file.
        $validated = $request->validate([
            'tanggal_induction' => 'required|date',
            'nomor_ktp' => 'required|string|max:20',
            'badge' => 'required|string|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',

            'pt_asal' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'area_kerja' => 'required|string|max:255',

            'sim_ac' => 'nullable|string|max:50',
            'sio_aktif' => 'nullable|string|max:255',

            'nama_kontak_darurat' => 'required|string|max:255',
            'hubungan_kontak_darurat' => 'required|string|max:255',
            'alamat_kontak_darurat' => 'required|string',

            // APD & Ukuran
            'checklist_apd' => 'nullable|array',
            'checklist_apd.*' => 'string',
            'checklist_apd_lainnya' => 'nullable|string|max:255',
            'ukuran_sepatu' => 'nullable|string|max:50',
            'ukuran_seragam_atas' => 'nullable|string|max:50',
            'ukuran_seragam_bawah' => 'nullable|string|max:50',

            // Validasi File Upload (Nullable saat update)
            'foto_diri' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file_ktp' => 'nullable|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_kk' => 'nullable|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_bpjs' => 'nullable|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_sks' => 'nullable|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_skck' => 'nullable|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_safety_induction' => 'nullable|mimes:jpeg,png,jpg,pdf,webp|max:2048',
            'file_pakta_integritas' => 'nullable|mimes:jpeg,png,jpg,pdf,webp|max:2048',
        ]);

        try {
            // Logic APD Lainnya
            $apdList = $request->input('checklist_apd', []);
            if ($request->filled('checklist_apd_lainnya') && in_array('Yang lain', $apdList)) {
                $apdList = array_diff($apdList, ['Yang lain']);
                $apdList[] = $request->input('checklist_apd_lainnya');
            }
            $validated['checklist_apd'] = array_values($apdList);
            unset($validated['checklist_apd_lainnya']);

            // Proses Upload File
            $folderPath = 'registrasi_k3/' . date('Y-m');
            $fileFields = [
                'foto_diri',
                'file_ktp',
                'file_kk',
                'file_bpjs',
                'file_sks',
                'file_skck',
                'file_safety_induction',
                'file_pakta_integritas'
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    // Hapus file lama jika ada
                    if ($registrasi->$field) {
                        Storage::disk('public')->delete($registrasi->$field);
                    }
                    // Simpan file baru
                    $validated[$field] = $request->file($field)->store($folderPath, 'public');
                }
            }

            // Update ke Database
            $registrasi->update($validated);

            return redirect()->route('registrasi-k3.index')
                ->with('success', 'Data registrasi K3 berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Registrasi K3: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage())
                ->with('error', 'Terjadi kesalahan sistem saat memperbarui data: ' . $e->getMessage());
        }
    }
}
