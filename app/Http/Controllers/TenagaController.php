<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Artisan;

class TenagaController extends Controller
{
    public function index()
    {
        return view('tenaga.index');
    }

    public function indexPengawas()
    {
        // Mengambil data pegawai yang aktif. 
        // Anda juga bisa menambahkan filter spesifik jika ada kriteria khusus untuk 'Pengawas'
        $pengawas = Pegawai::where('is_active', true)->paginate(10);

        return view('pengawas.index', compact('pengawas'));
    }

    /**
     * Mengambil data dari DATABASE LOKAL (PostgreSQL) untuk keperluan tabel & filter.
     */
    public function api(Request $request): JsonResponse
    {
        try {
            // Memulai query dari tabel pegawai_k3
            $query = Pegawai::query();

            // ── Search: nama & NIK (kolom 'badge' di database) ──────────────────────────────
            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'like', "%{$search}%");
                });
            }

            // ── Filter: status kerja ────────────────────────────
            if ($request->has('status') && $request->query('status') !== '') {
                $statusParam = $request->query('status');
                $query->where('is_active', $statusParam === 'Aktif');
            }

            // ── Filter: departemen / unit kerja ─────────────────
            if ($departemen = $request->query('departemen')) {
                $query->where('unit_kerjaid', $departemen);
            }

            // ── Filter: jenis kelamin ────────────────────────────
            if ($jenisKelamin = $request->query('jenis_kelamin')) {
                $query->where('jenis_kelamin', $jenisKelamin);
            }

            // Urutkan berdasarkan data yang paling baru diupdate/disync, ditampilkan paling atas
            $query->orderByDesc('updated_at');

            // Dapatkan opsi filter secara dinamis berdasarkan data yang ada di database lokal
            $filterOptions = [
                'status' => ['Aktif', 'Non-Aktif'],
                'departemen' => Pegawai::whereNotNull('unit_kerjaid')->distinct()->pluck('unit_kerjaid')->sort()->values(),
                'jenis_kelamin' => Pegawai::whereNotNull('jenis_kelamin')->distinct()->pluck('jenis_kelamin')->sort()->values(),
            ];

            // Pagination menggunakan bawaan Eloquent Builder
            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            // Transformasi data agar struktur key JSON-nya tetap sama dengan yang dibaca JavaScript di View Anda
            // Transformasi data agar struktur key JSON-nya cocok dengan View
            $transformedData = collect($paginator->items())->map(function ($item) {
                // Hitung sisa hari masa berlaku KIB (bisa minus jika sudah lewat)
                $sisaHari = null;
                if ($item->masa_berlaku_kib) {
                    $sisaHari = (int) now()->startOfDay()
                        ->diffInDays(\Carbon\Carbon::parse($item->masa_berlaku_kib)->startOfDay(), false);
                }

                // Format Jenis Kelamin
                $jk = '-';
                if ($item->jenis_kelamin === 'L') $jk = 'Laki-Laki';
                if ($item->jenis_kelamin === 'P') $jk = 'Perempuan';

                return [
                    'id' => $item->id,
                    'badge' => $item->badge ?? '-',
                    'nama' => $item->nama ?? '-',
                    'jenis_kelamin' => $jk,

                    // Data Baru sesuai JSON API
                    'no_bpjs_kesehatan' => $item->no_bpjs_kesehatan ?? '-',
                    'no_bpjs_ketenagakerjaan' => $item->no_bpjs_ketenagakerjaan ?? '-',
                    'tempat_lahir' => $item->tempat_lahir ?? '-',
                    'tanggal_lahir' => $item->tanggal_lahir ?? null,
                    'alamat' => $item->alamat ?? '-',
                    'kode_ok' => $item->kode_ok ?? '-',
                    'nomor_ok' => $item->nomor_ok ?? '-',

                    // Data Lama yang mungkin masih dibutuhkan untuk struktur layout/modal
                    'jabatan' => $item->jabatan ?? '-',
                    'departemen' => $item->unit_kerjaid ?? '-',
                    'status' => $item->is_active ? 'Aktif' : 'Non-Aktif',
                    'nomor_kib' => $item->nomor_kib,
                    'masa_berlaku_kib' => $item->masa_berlaku_kib,
                    'status_kib' => $item->status_kib,
                    'sisa_hari_kib' => $sisaHari,
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
            Log::error('Gagal memuat data pegawai dari DB lokal: ' . $e->getMessage());

            return response()->json([
                'message' => 'Gagal mengambil data dari database lokal. Pastikan migrasi sudah dijalankan.',
            ], 500);
        }
    }

    /**
     * Method untuk memicu sinkronisasi Artisan Command dari UI Web Admin.
     */
    public function sync(): JsonResponse
    {
        try {
            // Memanggil command 'sync:pegawai' secara programmatif
            Artisan::call('sync:pegawai');

            return response()->json([
                'status' => 'success',
                'message' => 'Sinkronisasi selesai! Data pegawai berhasil diperbarui dari API SIFO.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menjalankan sinkronisasi via Web UI: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat sinkronisasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        // Validasi input data dari Client
        $validated = $request->validate([
            'nomor_kib' => 'nullable|string|max:100',
            'masa_berlaku_kib' => 'nullable|date',
            'status_kib' => 'nullable|string|max:50',
        ]);

        try {
            $pegawai = Pegawai::findOrFail($id);

            // Simpan perubahan ke database lokal
            $pegawai->update([
                'nomor_kib' => $validated['nomor_kib'],
                'masa_berlaku_kib' => $validated['masa_berlaku_kib'],
                'status_kib' => $validated['status_kib'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data KIB untuk pegawai bernama ' . $pegawai->nama . ' berhasil diperbarui.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal update data KIB pegawai: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat memperbarui data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
