<?php

namespace App\Http\Controllers;

use App\Models\DataSafety;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataSafetyController extends Controller
{
    // Daftar semua field file: form_field => [kolom_db, folder_storage]
    private array $fileFields = [
        'foto_alat' => ['foto_alat_path', 'foto-alat'],
        'formulir_inspeksi_peralatan' => ['formulir_inspeksi_peralatan_path', 'formulir-inspeksi-peralatan'],
        'formulir_kegiatan_inspeksi_peralatan' => ['formulir_kegiatan_inspeksi_peralatan_path', 'formulir-kegiatan-inspeksi-peralatan'],
        'foto_temuan_uauc' => ['foto_temuan_uauc_path', 'foto-temuan-uauc'],
        'formulir_kegiatan_inspeksi_area_kerja' => ['formulir_kegiatan_inspeksi_area_kerja_path', 'formulir-inspeksi-area-kerja'],
        'formulir_observi' => ['formulir_observi_path', 'formulir-observi'],
        'formulir_kegiatan_observi' => ['formulir_kegiatan_observi_path', 'formulir-kegiatan-observi'],
        'safety_permit' => ['safety_permit_path', 'safety-permit'],
        'formulir_kegiatan_verifikasi_safety_permit' => ['formulir_kegiatan_verifikasi_safety_permit_path', 'formulir-verifikasi-safety-permit'],
        'foto_temuan_bahaya_nearmiss' => ['foto_temuan_bahaya_nearmiss_path', 'foto-nearmiss'],
        'foto_pelaksanaan_safety_briefing' => ['foto_pelaksanaan_safety_briefing_path', 'foto-safety-briefing'],
        'foto_daftar_hadir_briefing' => ['foto_daftar_hadir_briefing_path', 'daftar-hadir-briefing'],
        'formulir_kegiatan_safety_briefing' => ['formulir_kegiatan_safety_briefing_path', 'formulir-safety-briefing'],
        'foto_evidence_reward' => ['foto_evidence_reward_path', 'foto-reward'],
        'formulir_kegiatan_reward' => ['formulir_kegiatan_reward_path', 'formulir-reward'],
        'foto_kegiatan_sosialisasi_keselamatan' => ['foto_kegiatan_sosialisasi_keselamatan_path', 'foto-sosialisasi-keselamatan'],
        'formulir_presensi_sosialisasi_keselamatan' => ['formulir_presensi_sosialisasi_keselamatan_path', 'presensi-sosialisasi-keselamatan'],
        'formulir_kegiatan_sosialisasi_keselamatan' => ['formulir_kegiatan_sosialisasi_keselamatan_path', 'formulir-sosialisasi-keselamatan'],
        'foto_kegiatan_dcu' => ['foto_kegiatan_dcu_path', 'foto-kegiatan-dcu'],
        'formulir_hasil_pemeriksaan_dcu' => ['formulir_hasil_pemeriksaan_dcu_path', 'hasil-pemeriksaan-dcu'],
        'formulir_kegiatan_pemeriksaan_dcu' => ['formulir_kegiatan_pemeriksaan_dcu_path', 'formulir-kegiatan-dcu'],
        'foto_kegiatan_bugar_sehat' => ['foto_kegiatan_bugar_sehat_path', 'foto-bugar-sehat'],
        'formulir_presensi_bugar_sehat' => ['formulir_presensi_bugar_sehat_path', 'presensi-bugar-sehat'],
        'formulir_kegiatan_bugar_sehat' => ['formulir_kegiatan_bugar_sehat_path', 'formulir-bugar-sehat'],
        'foto_kegiatan_tes_keseimbangan' => ['foto_kegiatan_tes_keseimbangan_path', 'foto-romberg'],
        'formulir_hasil_pemeriksaan_romberg' => ['formulir_hasil_pemeriksaan_romberg_path', 'hasil-romberg'],
        'formulir_kegiatan_tes_keseimbangan' => ['formulir_kegiatan_tes_keseimbangan_path', 'formulir-romberg'],
        'foto_kegiatan_sosialisasi_kesehatan' => ['foto_kegiatan_sosialisasi_kesehatan_path', 'foto-sosialisasi-kesehatan'],
        'formulir_presensi_sosialisasi_kesehatan' => ['formulir_presensi_sosialisasi_kesehatan_path', 'presensi-sosialisasi-kesehatan'],
        'formulir_kegiatan_sosialisasi_kesehatan' => ['formulir_kegiatan_sosialisasi_kesehatan_path', 'formulir-sosialisasi-kesehatan'],
        'kesesuaian_isi_p3k' => ['kesesuaian_isi_p3k_path', 'kesesuaian-p3k'],
        'formulir_kegiatan_inspeksi_p3k' => ['formulir_kegiatan_inspeksi_p3k_path', 'formulir-inspeksi-p3k'],
        'arsip' => ['arsip_path', 'arsip'],
    ];

    public function index()
    {
        return view('data-safety.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = DataSafety::search($request->query('search'));

            if ($jenis = $request->query('jenis_aktifitas_kpi')) {
                $query->where('jenis_aktifitas_kpi', $jenis);
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
                'jenis_aktifitas_kpi' => DataSafety::whereNotNull('jenis_aktifitas_kpi')->distinct()->orderBy('jenis_aktifitas_kpi')->pluck('jenis_aktifitas_kpi'),
                'area_kerja' => DataSafety::whereNotNull('area_kerja')->distinct()->orderBy('area_kerja')->pluck('area_kerja'),
                'status_pindah' => ['SUKSES', 'GAGAL', 'PENDING'],
                'keputusan' => ['APPROVE', 'REJECT', 'PENDING'],
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;
            $paginator = $query->paginate($perPage);

            return response()->json([
                'data' => collect($paginator->items())->map(fn(DataSafety $d) => $this->transform($d)),
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
            Log::error('Gagal memuat data safety: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $validated['waktu_submit'] = now();
            $validated['status_pindah'] = $validated['status_pindah'] ?? 'PENDING';
            $validated['keputusan'] = $validated['keputusan'] ?? 'PENDING';

            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) $validated[$column] = $path;
            }

            $data = DataSafety::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data safety berhasil ditambahkan.',
                'data' => $this->transform($data),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data safety: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function update(Request $request, DataSafety $dataSafety): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            foreach ($this->fileFields as $formField => [$column, $folder]) {
                $path = $this->storeFileIfPresent($request, $formField, $folder);
                if ($path) {
                    $this->deleteFileIfExists($dataSafety->{$column});
                    $validated[$column] = $path;
                }
            }

            $dataSafety->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data safety berhasil diperbarui.',
                'data' => $this->transform($dataSafety->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data safety: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy(DataSafety $dataSafety): JsonResponse
    {
        try {
            foreach ($this->fileFields as [$column, $folder]) {
                $this->deleteFileIfExists($dataSafety->{$column});
            }
            $dataSafety->delete();

            return response()->json(['status' => 'success', 'message' => 'Data safety berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data safety: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    public function cariTenaga(Request $request): JsonResponse
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

    private function storeFileIfPresent(Request $request, string $field, string $folder): ?string
    {
        if (!$request->hasFile($field)) return null;
        return $request->file($field)->store("data-safety/{$folder}", 'public');
    }

    private function deleteFileIfExists(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function transform(DataSafety $d): array
    {
        $base = $d->toArray();

        // Ubah semua kolom *_path jadi full URL
        foreach ($this->fileFields as [$column, $folder]) {
            $base[$column . '_url'] = $d->{$column} ? asset('storage/' . $d->{$column}) : null;
        }

        return $base;
    }

    private function validateData(Request $request): array
    {
        $rules = [
            'tanggal_pelaksanaan' => 'nullable|date',
            'badge_tenaga' => 'nullable|string|max:50',
            'nama_tenaga' => 'nullable|string|max:255',
            'area_kerja' => 'nullable|string|max:150',
            'unit_kerja' => 'nullable|string|max:150',
            'jenis_aktifitas_kpi' => 'required|string|max:150',

            'kategori_peralatan' => 'nullable|string|max:100',
            'nama_alat' => 'nullable|string|max:150',
            'nomor_seri_alat' => 'nullable|string|max:150',
            'status_alat' => 'nullable|string|max:50',
            'keterangan_tambahan_alat' => 'nullable|string',
            'rekomendasi_tindakan_alat' => 'nullable|string',

            'item_temuan' => 'nullable|string',
            'jenis_penyebab' => 'nullable|string|max:150',
            'deskripsi_temuan' => 'nullable|string',
            'rekomendasi_tindakan_temuan' => 'nullable|string',
            'status_temuan' => 'nullable|string|max:50',

            'nama_subject_observasi' => 'nullable|string|max:255',
            'proses_kerja' => 'nullable|string',

            'pekerjaan_dikerjakan' => 'nullable|string',

            'keterangan_bahaya_nearmiss' => 'nullable|string',

            'nama_penerima' => 'nullable|string|max:255',
            'jenis_tindakan' => 'nullable|string|max:100',
            'alasan_pemberian' => 'nullable|string',

            'materi_sosialisasi_keselamatan' => 'nullable|string',
            'materi_sosialisasi_kesehatan' => 'nullable|string',

            'nama_pekerja_romberg' => 'nullable|string|max:255',

            'kelas_kotak_p3k' => 'nullable|string|max:50',

            'status_pindah' => 'nullable|string|max:30',
            'keputusan' => 'nullable|string|max:30',
            'indikasi_duplikat' => 'nullable|string|max:20',
        ];

        foreach ($this->fileFields as $formField => [$column, $folder]) {
            $rules[$formField] = 'nullable|file|max:5120';
        }

        return $request->validate($rules);
    }
}
