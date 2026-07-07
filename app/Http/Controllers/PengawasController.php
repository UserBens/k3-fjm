<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PengawasController extends Controller
{
    public function index()
    {
        return view('pengawas.index');
    }

    /**
     * Daftar tenaga kerja yang SUDAH ditetapkan sebagai pengawas.
     */
    public function api(Request $request): JsonResponse
    {
        try {
            $query = Pegawai::where('is_pengawas', true);

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'like', "%{$search}%");
                });
            }

            $query->orderByDesc('tanggal_jadi_pengawas');

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $data = collect($paginator->items())->map(function ($item) {
                $jk = '-';
                if ($item->jenis_kelamin === 'L') $jk = 'Laki-Laki';
                if ($item->jenis_kelamin === 'P') $jk = 'Perempuan';

                return [
                    'id' => $item->id,
                    'badge' => $item->badge ?? '-',
                    'nama' => $item->nama ?? '-',
                    'jenis_kelamin' => $jk,
                    'departemen' => $item->unit_kerjaid ?? '-',
                    'tempat_lahir' => $item->tempat_lahir ?? '-',
                    'tanggal_lahir' => $item->tanggal_lahir,
                    'alamat' => $item->alamat ?? '-',
                    'no_bpjs_kesehatan' => $item->no_bpjs_kesehatan ?? '-',
                    'no_bpjs_ketenagakerjaan' => $item->no_bpjs_ketenagakerjaan ?? '-',
                    'tanggal_jadi_pengawas' => $item->tanggal_jadi_pengawas,
                ];
            });

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
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data pengawas.'], 500);
        }
    }

    /**
     * Pencarian tenaga kerja untuk dipilih jadi pengawas (dipakai di modal picker).
     * Hanya menampilkan tenaga yang BELUM jadi pengawas & masih aktif.
     */
    public function cariTenaga(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));

        $query = Pegawai::where('is_pengawas', false)
            ->where('is_active', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")
                    ->orWhere('badge', 'like', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'badge' => $item->badge ?? '-',
                'nama' => $item->nama ?? '-',
                'departemen' => $item->unit_kerjaid ?? '-',
            ];
        });

        return response()->json(['data' => $results]);
    }

    /**
     * Menetapkan satu tenaga kerja sebagai pengawas.
     * Jika request membawa 'replace_id', pengawas lama otomatis dicopot (fungsi "Ganti Pengawas").
     */
    public function tetapkan(Request $request, $id): JsonResponse
    {
        try {
            $pegawai = Pegawai::findOrFail($id);

            if ($pegawai->is_pengawas) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenaga ini sudah berstatus pengawas.',
                ], 422);
            }

            $pegawai->update([
                'is_pengawas' => true,
                'tanggal_jadi_pengawas' => now(),
            ]);

            if ($replaceId = $request->input('replace_id')) {
                Pegawai::where('id', $replaceId)->update([
                    'is_pengawas' => false,
                    'tanggal_jadi_pengawas' => null,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => $pegawai->nama . ' berhasil ditetapkan sebagai pengawas.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menetapkan pengawas: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan sistem.'], 500);
        }
    }

    /**
     * Mencopot status pengawas (kembali jadi tenaga biasa, TIDAK dihapus dari database).
     */
    public function copot($id): JsonResponse
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->update([
                'is_pengawas' => false,
                'tanggal_jadi_pengawas' => null,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => $pegawai->nama . ' berhasil dicopot dari jabatan pengawas.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mencopot pengawas: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan sistem.'], 500);
        }
    }
}
