<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\PelaporanPengawas; // Sesuaikan dengan nama model Anda
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PelaporanPengawasController extends Controller
{
    public function index()
    {
        return view('pelaporan-pengawas.index');
    }

    public function create()
    {
        return view('pelaporan-pengawas.create');
    }

    public function api(Request $request): JsonResponse
    {
        try {
            $query = PelaporanPengawas::query();

            // 1. Fitur Pencarian (Search berdasarkan Nama Pengawas atau Kode)
            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pengawas', 'ilike', "%{$search}%")
                      ->orWhere('kode_laporan', 'ilike', "%{$search}%");
                });
            }

            // 2. Fitur Filter Jenis Aktifitas
            if ($jenis_aktifitas = $request->query('jenis_aktifitas')) {
                $query->where('jenis_aktifitas', $jenis_aktifitas);
            }

            $query->orderByDesc('tanggal_pelaksanaan')->orderByDesc('created_at');

            // 3. Menyiapkan Opsi Filter (List Aktifitas Unik)
            $filterOptions = [
                'jenis_aktifitas' => PelaporanPengawas::select('jenis_aktifitas')
                    ->distinct()
                    ->pluck('jenis_aktifitas')
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
                    'tanggal_pelaksanaan' => $item->tanggal_pelaksanaan,
                    'nama_pengawas' => $item->nama_pengawas ?? '-',
                    'area_kerja' => $item->area_kerja ?? '-',
                    'unit_kerja' => $item->unit_kerja ?? '-',
                    'jenis_aktifitas' => $item->jenis_aktifitas ?? '-',
                    
                    'keterangan_bahaya' => $item->keterangan_bahaya ?? '-',
                    'materi_briefing' => $item->materi_briefing ?? '-',
                    
                    'kode_laporan' => $item->kode_laporan ?? '-',
                    'status' => $item->status ?? 'PROSES',
                    'diperiksa_oleh' => $item->diperiksa_oleh ?? '-',

                    // URL Foto & Dokumen (Menangani format path lokal atau URL Drive)
                    'foto_temuan_url' => $this->resolveFileUrl($item->foto_temuan),
                    'foto_briefing_url' => $this->resolveFileUrl($item->foto_briefing),
                    'presensi_briefing_url' => $this->resolveFileUrl($item->presensi_briefing),
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
            Log::error('Gagal memuat data Pelaporan Pengawas: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal mengambil data dari database lokal.',
            ], 500);
        }
    }

    /**
     * Helper untuk membedakan URL eksternal (Google Drive) atau file lokal Storage
     */
    private function resolveFileUrl($path)
    {
        if (!$path) return null;
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path; // Jika formatnya https://drive.google.com/...
        }
        return asset('storage/' . $path); // Jika format path lokal Laravel
    }

    // Fungsi store(), edit(), dan update() bisa Anda kembangkan 
    // serupa dengan RegistrasiK3Controller menyesuaikan input form pelaporan.
}