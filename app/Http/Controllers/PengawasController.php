<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\PengawasIntraUser;
use App\Models\PengawasPekerjaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PengawasController extends Controller
{
    public function index()
    {
        return view('pengawas.index');
    }

    // List pengawas + jumlah pegawai binaan
    public function data(Request $request): JsonResponse
    {
        try {
            $query = PengawasIntraUser::where('role_user', 'PENGAWAS');

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'ilike', "%{$search}%")
                        ->orWhere('username', 'ilike', "%{$search}%");
                });
            }

            $query->withCount('pengawasPekerjaans as jumlah_pegawai')
                ->with('dataPegawai.unitKerja') // BARU — eager load unit kerja milik si pengawas sendiri
                ->orderBy('nama_lengkap');

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $transformed = collect($paginator->items())->map(fn($item) => [
                'id_api' => $item->id_api,
                'username' => $item->username ?? '-',
                'nama_lengkap' => $item->nama_lengkap ?? '-',
                'kode_ok_pekerjaan' => $item->kode_ok_pekerjaan ?? '-',
                'nama_unit_kerja' => $item->dataPegawai->unitKerja->nama_unit_kerja ?? '-', // BARU
                'bagian' => $item->dataPegawai->unitKerja->bagian ?? '-', // BARU
                'jumlah_pegawai' => $item->jumlah_pegawai ?? 0,
                'status' => $item->is_active ? 'Aktif' : 'Non-Aktif',
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
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data pengawas.'], 500);
        }
    }

    // List pegawai binaan untuk satu pengawas (dipanggil saat baris diklik)
    public function pegawaiBinaan(Request $request, string $idApi): JsonResponse
    {
        try {
            $pengawas = PengawasIntraUser::where('id_api', $idApi)->firstOrFail();

            $pegawaiIds = PengawasPekerjaan::where('pengguna_id', $pengawas->id_api)
                ->pluck('pegawai_id');

            $query = Pegawai::with('unitKerja')->whereIn('id_api', $pegawaiIds);

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'ilike', "%{$search}%");
                });
            }

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->orderBy('nama')->paginate($perPage);

            $transformed = collect($paginator->items())->map(fn($p) => [
                'id' => $p->id,
                'badge' => $p->badge ?? '-',
                'nama' => $p->nama ?? '-',
                'jenis_kelamin' => $p->jenis_kelamin === 'L' ? 'Laki-Laki' : ($p->jenis_kelamin === 'P' ? 'Perempuan' : '-'),
                'nama_unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
                'bagian' => $p->unitKerja->bagian ?? '-',
                'status' => $p->is_active ? 'Aktif' : 'Non-Aktif',
            ]);

            return response()->json([
                'pengawas' => [
                    'nama_lengkap' => $pengawas->nama_lengkap,
                    'username' => $pengawas->username,
                ],
                'data' => $transformed,
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
            Log::error('Gagal memuat pegawai binaan pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data pegawai untuk pengawas ini.'], 500);
        }
    }
}
