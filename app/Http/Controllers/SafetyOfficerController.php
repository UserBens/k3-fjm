<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SafetyOfficerController extends Controller
{
    /**
     * Halaman utama (Blade view).
     */
    public function index()
    {
        return view('safety-officer.index');
    }

    /**
     * Endpoint JSON untuk tabel: search, filter unit kerja, pagination.
     * GET /safety-officer/data
     */
    public function data(Request $request): JsonResponse
    {
        try {
            $query = Pegawai::with(['unitKerja', 'lokasiKerja'])
                ->where('is_active', true)
                ->where('is_safety_officer', true);

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'like', "%{$search}%");
                });
            }

            if ($departemen = $request->query('departemen')) {
                $query->where('unit_kerjaid', $departemen);
            }

            $query->orderBy('nama');

            $filterOptions = [
                'departemen' => UnitKerja::whereIn(
                    'id_api',
                    Pegawai::where('is_active', true)
                        ->where('is_safety_officer', true)
                        ->whereNotNull('unit_kerjaid')
                        ->distinct()
                        ->pluck('unit_kerjaid')
                )
                    ->orderBy('nama_unit_kerja')
                    ->get(['id_api', 'nama_unit_kerja'])
                    ->map(fn($u) => ['value' => $u->id_api, 'label' => $u->nama_unit_kerja])
                    ->values(),
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $transformedData = collect($paginator->items())->map(function (Pegawai $item) {
                $jk = '-';
                if ($item->jenis_kelamin === 'L') $jk = 'Laki-Laki';
                if ($item->jenis_kelamin === 'P') $jk = 'Perempuan';

                return [
                    'id'                 => $item->id,
                    'badge'              => $item->badge ?? '-',
                    'nama'               => $item->nama ?? '-',
                    'jenis_kelamin'      => $jk,
                    'jabatan'            => $item->jabatan ?? '-',
                    'nama_unit_kerja'    => $item->unitKerja->nama_unit_kerja ?? '-',
                    'bagian'             => $item->unitKerja->bagian ?? '-',
                    'nama_lokasi'        => $item->lokasiKerja->nama_lokasi ?? '-',
                    'status'             => $item->is_active ? 'Aktif' : 'Non-Aktif',
                    'safety_officer_since' => optional($item->safety_officer_since)->format('Y-m-d'),
                ];
            });

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
            Log::error('Gagal memuat data safety officer: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal mengambil data safety officer dari database lokal.',
            ], 500);
        }
    }

    /**
     * Lepas satu pegawai dari status Safety Officer secara manual.
     * (Catatan: jalankan sync:pegawai lagi akan menandainya balik jika
     * badge-nya masih ada di daftar $safetyOfficerBadges.)
     * DELETE /safety-officer/{pegawai}
     */
    public function destroy(Pegawai $pegawai): JsonResponse
    {
        $pegawai->is_safety_officer = false;
        $pegawai->safety_officer_since = null;
        $pegawai->save();

        return response()->json([
            'message' => "{$pegawai->nama} dilepas dari status Safety Officer.",
        ]);
    }
}
