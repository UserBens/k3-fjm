<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

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
            $query = Pegawai::with(['unitKerja', 'pengawasPekerjaan.pengawas', 'lokasiKerja', 'subkon'])
                ->where('is_active', true); // BARU — wajib hanya pegawai aktif, tidak bisa dioverride

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'like', "%{$search}%");
                });
            }

            if ($departemen = $request->query('departemen')) {
                $query->where('unit_kerjaid', $departemen);
            }

            if ($jenisKelamin = $request->query('jenis_kelamin')) {
                $query->where('jenis_kelamin', $jenisKelamin);
            }

            $query->orderByDesc('updated_at');

            $filterOptions = [
                // BARU — hapus opsi 'Non-Aktif' karena tidak akan pernah muncul lagi
                'status' => ['Aktif'],
                'departemen' => UnitKerja::whereIn('id_api', Pegawai::where('is_active', true)->whereNotNull('unit_kerjaid')->distinct()->pluck('unit_kerjaid'))
                    ->orderBy('nama_unit_kerja')
                    ->get(['id_api', 'nama_unit_kerja'])
                    ->map(fn($u) => ['value' => $u->id_api, 'label' => $u->nama_unit_kerja])
                    ->values(),
                'jenis_kelamin' => Pegawai::where('is_active', true)->whereNotNull('jenis_kelamin')->distinct()->pluck('jenis_kelamin')->sort()->values(),
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $transformedData = collect($paginator->items())->map(function ($item) {
                $sisaHari = null;
                if ($item->masa_berlaku_kib) {
                    $sisaHari = (int) now()->startOfDay()
                        ->diffInDays(\Carbon\Carbon::parse($item->masa_berlaku_kib)->startOfDay(), false);
                }

                $jk = '-';
                if ($item->jenis_kelamin === 'L') $jk = 'Laki-Laki';
                if ($item->jenis_kelamin === 'P') $jk = 'Perempuan';

                return [
                    'id' => $item->id,
                    'badge' => $item->badge ?? '-',
                    'nama' => $item->nama ?? '-',
                    'jenis_kelamin' => $jk,

                    'no_bpjs_kesehatan' => $item->no_bpjs_kesehatan ?? '-',
                    'no_bpjs_ketenagakerjaan' => $item->no_bpjs_ketenagakerjaan ?? '-',
                    'tempat_lahir' => $item->tempat_lahir ?? '-',
                    'tanggal_lahir' => $item->tanggal_lahir ?? null,
                    'alamat' => $item->alamat ?? '-',
                    'kode_ok' => $item->kode_ok ?? '-',
                    'nomor_ok' => $item->nomor_ok ?? '-',

                    'nama_unit_kerja' => $item->unitKerja->nama_unit_kerja ?? '-',
                    'bagian' => $item->unitKerja->bagian ?? '-',

                    'nama_pengawas' => $item->pengawasPekerjaan->pengawas->nama_lengkap ?? '-',
                    'badge_pengawas' => $item->pengawasPekerjaan->pengawas->username ?? '-',

                    'jabatan' => $item->jabatan ?? '-',
                    'departemen' => $item->unit_kerjaid ?? '-',
                    'status' => $item->is_active ? 'Aktif' : 'Non-Aktif',
                    'nomor_kib' => $item->nomor_kib,
                    'masa_berlaku_kib' => $item->masa_berlaku_kib,
                    'status_kib' => $item->status_kib,
                    'sisa_hari_kib' => $sisaHari,
                    'gambar_kib_url' => $item->gambar_kib ? asset('storage/' . $item->gambar_kib) : null,
                    'nama_lokasi' => $item->lokasiKerja->nama_lokasi ?? '-',
                    'nama_subkon' => $item->subkon->nama_subkon ?? '-',
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
            Artisan::call('sync:pegawai');
            Log::info('Sync output: ' . Artisan::output());

            return response()->json([
                'status' => 'success',
                'message' => 'Sinkronisasi selesai! Data pegawai & unit kerja berhasil diperbarui dari API SIFO.',
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
        // Validasi input data dari Client ditambah validasi file gambar
        $validated = $request->validate([
            'nomor_kib' => 'nullable|string|max:100',
            'masa_berlaku_kib' => 'nullable|date',
            'status_kib' => 'nullable|string|max:50',
            'gambar_kib' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        try {
            $pegawai = Pegawai::findOrFail($id);

            // Cek apakah ada file gambar yang diupload
            if ($request->hasFile('gambar_kib')) {
                // Hapus gambar lama jika ada
                if ($pegawai->gambar_kib && Storage::disk('public')->exists($pegawai->gambar_kib)) {
                    Storage::disk('public')->delete($pegawai->gambar_kib);
                }

                // Simpan gambar baru ke folder storage/app/public/kib_images
                $path = $request->file('gambar_kib')->store('kib_images', 'public');
                $pegawai->gambar_kib = $path;
            }

            // Simpan perubahan ke database lokal
            $pegawai->nomor_kib = $validated['nomor_kib'];
            $pegawai->masa_berlaku_kib = $validated['masa_berlaku_kib'];
            $pegawai->status_kib = $validated['status_kib'];
            $pegawai->save();

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
