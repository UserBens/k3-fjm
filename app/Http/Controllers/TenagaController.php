<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class TenagaController extends Controller
{
    protected string $apiUrl;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.pegawai.url');
        $this->apiKey = config('services.pegawai.key');
    }
    public function index()
    {
        return view('tenaga.index');
    }

    public function api(Request $request): JsonResponse
    {
        try {
            $pegawai = $this->getPegawaiCollection();
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data pegawai: ' . $e->getMessage());

            return response()->json([
                'message' => 'Gagal mengambil data pegawai dari sistem sumber. Silakan coba lagi.',
            ], 502);
        }

        // Data mentah untuk isi dropdown filter (dibuat dari dataset penuh,
        // supaya pilihan filter tidak ikut menyusut saat sedang difilter)
        $filterOptions = [
            'status' => $pegawai->pluck('status')->filter()->unique()->sort()->values(),
            'departemen' => $pegawai->pluck('departemen')->filter()->unique()->sort()->values(),
            'jenis_kelamin' => $pegawai->pluck('jenis_kelamin')->filter()->unique()->sort()->values(),
        ];

        // ── Search: nama & NIK ──────────────────────────────
        if ($search = trim((string) $request->query('search', ''))) {
            $needle = mb_strtolower($search);
            $pegawai = $pegawai->filter(function ($item) use ($needle) {
                return str_contains(mb_strtolower((string) $item['nama']), $needle)
                    || str_contains(mb_strtolower((string) $item['nik']), $needle);
            });
        }

        // ── Filter: status kerja ────────────────────────────
        if ($status = $request->query('status')) {
            $pegawai = $pegawai->filter(fn($item) => $item['status'] === $status);
        }

        // ── Filter: departemen / unit kerja ─────────────────
        if ($departemen = $request->query('departemen')) {
            $pegawai = $pegawai->filter(fn($item) => $item['departemen'] === $departemen);
        }

        // ── Filter: jenis kelamin ────────────────────────────
        if ($jenisKelamin = $request->query('jenis_kelamin')) {
            $pegawai = $pegawai->filter(fn($item) => $item['jenis_kelamin'] === $jenisKelamin);
        }

        $pegawai = $pegawai->values();

        // ── Pagination manual (koleksi hasil fetch API, bukan Eloquent) ──
        $perPage = (int) $request->query('per_page', 10);
        $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

        $page = (int) $request->query('page', 1);
        $page = $page > 0 ? $page : 1;

        $paginator = new LengthAwarePaginator(
            $pegawai->forPage($page, $perPage)->values(),
            $pegawai->count(),
            $perPage,
            $page
        );

        return response()->json([
            'data' => $paginator->items(),
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
    }

    /**
     * Ambil & normalisasi seluruh data pegawai dari API eksternal, di-cache
     * sebentar (5 menit) supaya search/filter/pindah halaman tidak memukul
     * API eksternal berkali-kali.
     */
    protected function getPegawaiCollection()
    {
        // 1. Simpan data mentah sebagai NATIVE ARRAY ke dalam cache, bukan object Collection
        $cachedArray = Cache::remember('pegawai_api_raw', 300, function () {
            $response = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
            ])->timeout(15)->get($this->apiUrl);

            if (! $response->successful()) {
                throw new \RuntimeException(
                    'API pegawai merespons status ' . $response->status() . ': ' . $response->body()
                );
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (! is_array($items)) {
                throw new \RuntimeException('Format respons API pegawai tidak dikenali.');
            }

            // Gunakan array_map native PHP untuk proses normalisasi sebelum masuk cache
            return array_map(fn($item) => $this->normalize((array) $item), $items);
        });

        // 2. Bungkus array menjadi Collection SETELAH keluar dari proses caching
        return collect($cachedArray);
    }

    /**
     * Normalisasi nama field ke key yang dipakai di frontend.
     *
     * ⚠️ ASUMSI: nama field asli dari API belum bisa dikonfirmasi (401 saat
     * dicoba tanpa akses langsung ke API). Silakan sesuaikan mapping di bawah
     * ini dengan field yang sebenarnya dikembalikan oleh
     * https://mobile.fokusjasamitra.com/api/erp/api/pegawai
     * (cek lewat Postman / `dd($response->json())` di getPegawaiCollection()).
     */
    protected function normalize(array $item): array
    {
        return [
            'nik' => $item['nik'] ?? $item['NIK'] ?? $item['no_ktp'] ?? '-',
            'nama' => $item['nama'] ?? $item['name'] ?? $item['nama_pegawai'] ?? '-',
            'jabatan' => $item['jabatan'] ?? $item['posisi'] ?? $item['position'] ?? '-',
            'departemen' => $item['departemen'] ?? $item['department'] ?? $item['unit_kerja'] ?? $item['divisi'] ?? '-',
            'jenis_kelamin' => $item['jenis_kelamin'] ?? $item['gender'] ?? $item['jk'] ?? '-',
            'status' => $item['status'] ?? $item['status_kerja'] ?? $item['employment_status'] ?? '-',
            'tanggal_masuk' => $item['tanggal_masuk'] ?? $item['join_date'] ?? $item['tgl_masuk'] ?? null,
            'no_hp' => $item['no_hp'] ?? $item['phone'] ?? $item['telepon'] ?? '-',
        ];
    }
}
