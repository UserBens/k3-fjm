<?php

namespace App\Http\Controllers;

use App\Models\KodeOk;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class KodeOkController extends Controller
{
    /**
     * Tampilkan halaman manajemen Kode OK.
     */
    public function index()
    {
        return view('kode-ok.index');
    }

    /**
     * Endpoint JSON: list Kode OK dengan search, filter, dan pagination.
     * Dikonsumsi oleh JS di kode-ok.index (API_ENDPOINT).
     */
    public function api(Request $request): JsonResponse
    {
        $query = KodeOk::query();

        // ── Search (kode OK atau uraian pekerjaan) ──
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('uraian_pekerjaan', 'ilike', "%{$search}%")
                    ->orWhere('unit_kerja', 'ilike', "%{$search}%")
                    ->orWhereRaw('CAST(kode_ok AS TEXT) ILIKE ?', ["%{$search}%"]);
            });
        }

        // ── Filter status ──
        if ($request->query('status') !== null && $request->query('status') !== '') {
            $query->where('status', (bool) $request->query('status'));
        }

        // ── Filter unit kerja ──
        if ($unitKerja = $request->query('unit_kerja')) {
            $query->where('unit_kerja', $unitKerja);
        }

        $perPage = (int) $request->query('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 100) : 10;

        $paginator = $query->latest()->paginate($perPage);
        
        return response()->json([
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'total'        => $paginator->total(),
                'from'         => $paginator->firstItem(),
                'to'           => $paginator->lastItem(),
            ],
            'filter_options' => [
                'unit_kerja' => KodeOk::query()
                    ->whereNotNull('unit_kerja')
                    ->distinct()
                    ->orderBy('unit_kerja')
                    ->pluck('unit_kerja'),
            ],
        ]);
    }

    /**
     * Sinkronisasi data Kode OK dari sumber API eksternal (SIFO).
     * Upsert berdasarkan kode_ok: data baru ditambahkan, data lama diperbarui.
     */
    public function sync(Request $request): JsonResponse
    {
        $apiUrl = config('services.kode_ok.url');
        $apiKey = config('services.kode_ok.key');

        if (! $apiUrl) {
            return response()->json([
                'message' => 'URL sumber data Kode OK belum dikonfigurasi (services.kode_ok.url).',
            ], 500);
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
            ])->timeout(30)->get($apiUrl);

            if (! $response->successful()) {
                return response()->json([
                    'message' => "Gagal mengambil data dari sumber API (status {$response->status()}).",
                ], 502);
            }

            $items = $response->json('data') ?? $response->json();

            if (! is_array($items)) {
                return response()->json([
                    'message' => 'Format respons dari sumber API tidak sesuai yang diharapkan.',
                ], 502);
            }

            $created = 0;
            $updated = 0;
            $now = now();

            foreach ($items as $item) {
                if (! isset($item['kode_ok'])) {
                    continue;
                }

                $record = KodeOk::updateOrCreate(
                    ['kode_ok' => $item['kode_ok']],
                    [
                        'pengawas'         => $item['pengawas'] ?? null,
                        'unit_kerja'       => $item['unit_kerja'] ?? null,
                        'uraian_pekerjaan' => $item['uraian_pekerjaan'] ?? null,
                        'status'           => $item['status'] ?? true,
                        'synced_at'        => $now,
                    ]
                );

                $record->wasRecentlyCreated ? $created++ : $updated++;
            }

            return response()->json([
                'message' => "Sinkronisasi selesai. {$created} data baru, {$updated} data diperbarui.",
                'created' => $created,
                'updated' => $updated,
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal sync Kode OK: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan saat menghubungi sumber API. Coba lagi beberapa saat.',
            ], 500);
        }
    }

    /**
     * Tambah data Kode OK baru secara manual.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'kode_ok'          => ['nullable', 'integer', 'min:1', 'unique:kode_oks,kode_ok'],
            'unit_kerja'       => ['required', 'string', 'max:255'],
            'uraian_pekerjaan' => ['required', 'string'],
            'status'           => ['nullable', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Kode OK kosong → pakai nomor urut berikutnya
        $data['kode_ok'] = $data['kode_ok'] ?? ((int) KodeOk::max('kode_ok') + 1);
        $data['status'] = $data['status'] ?? true;

        $kodeOk = KodeOk::create($data);

        return response()->json([
            'message' => "Kode OK #{$kodeOk->kode_ok} berhasil ditambahkan.",
            'data'    => $kodeOk,
        ], 201);
    }

    /**
     * Update data Kode OK yang sudah ada. Kode OK sendiri tidak bisa diubah.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $kodeOk = KodeOk::find($id);

        if (! $kodeOk) {
            return response()->json(['message' => 'Data Kode OK tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'unit_kerja'       => ['required', 'string', 'max:255'],
            'uraian_pekerjaan' => ['required', 'string'],
            'status'           => ['nullable', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $kodeOk->update($validator->validated());

        return response()->json([
            'message' => "Kode OK #{$kodeOk->kode_ok} berhasil diperbarui.",
            'data'    => $kodeOk,
        ]);
    }

    /**
     * Hapus data Kode OK.
     */
    public function destroy(int $id): JsonResponse
    {
        $kodeOk = KodeOk::find($id);

        if (! $kodeOk) {
            return response()->json(['message' => 'Data Kode OK tidak ditemukan.'], 404);
        }

        $kodeOkNumber = $kodeOk->kode_ok;
        $kodeOk->delete();

        return response()->json([
            'message' => "Kode OK #{$kodeOkNumber} berhasil dihapus.",
        ]);
    }
}
