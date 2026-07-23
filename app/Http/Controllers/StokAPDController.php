<?php

namespace App\Http\Controllers;

use App\Models\KodeOk;
use App\Models\StokAPD;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StokAPDController extends Controller
{
    public function index()
    {
        return view('apd.index');
    }

    /**
     * Endpoint JSON untuk tabel: search, filter, pagination.
     * GET /master-stok-apd/data
     */
    public function data(Request $request)
    {
        $perPage    = (int) $request->input('per_page', 10);
        $search     = $request->input('search');
        $kategori   = $request->input('kategori');
        $status     = $request->input('status');     // OK | REORDER
        $supplier   = $request->input('supplier');

        $query = StokAPD::query()->with('kodeOk')->search($search);

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        if ($supplier) {
            $query->where('supplier', $supplier);
        }

        if ($status === 'REORDER') {
            $query->whereRaw('(stok_awal - digunakan - rusak) <= reorder_point');
        } elseif ($status === 'OK') {
            $query->whereRaw('(stok_awal - digunakan - rusak) > reorder_point');
        }

        $paginated = $query->orderBy('jenis_apd')->paginate($perPage);

        return response()->json([
            'data' => collect($paginated->items())->map(function (StokAPD $item) {
                $arr = $item->toArray(); // stok_tersedia & status ikut karena $appends
                $arr['kode_ok'] = $item->kodeOk->pluck('kode_ok')->values();
                $arr['gambar_apd_url'] = $item->gambar_apd ? asset('storage/' . $item->gambar_apd) : null;
                return $arr;
            }),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page'    => $paginated->lastPage(),
                'total'        => $paginated->total(),
                'from'         => $paginated->firstItem(),
                'to'           => $paginated->lastItem(),
            ],
            'filter_options' => [
                'kategori' => ['WAJIB', 'KHUSUS'],
                'status'   => ['OK', 'REORDER'],
                'supplier' => StokAPD::query()
                    ->whereNotNull('supplier')
                    ->distinct()
                    ->orderBy('supplier')
                    ->pluck('supplier'),
            ],
        ]);
    }

    public function kodeOkOptions()
    {
        $items = KodeOk::query()
            ->select('id', 'kode_ok', 'uraian_kerja')
            ->where('status', true)
            ->orderBy('kode_ok')
            ->get();

        return response()->json(['data' => $items]);
    }

    /**
     * Simpan APD baru.
     * POST /master-stok-apd
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $kodeOkList = $this->sanitizeKodeOkList($request->input('kode_ok', []));
        unset($validated['kode_ok']);

        if ($request->hasFile('gambar_apd')) {
            $validated['gambar_apd'] = $request->file('gambar_apd')->store('apd_images', 'public');
        }

        $attempts = 0;
        do {
            $validated['kode_apd'] = StokAPD::generateKode($validated['jenis_apd']);

            try {
                $apd = StokAPD::create($validated);
                break;
            } catch (\Illuminate\Database\QueryException $e) {
                $attempts++;
                if ($attempts >= 3) {
                    throw $e;
                }
            }
        } while (true);

        foreach ($kodeOkList as $kode) {
            $apd->kodeOk()->create(['kode_ok' => $kode]);
        }

        return response()->json([
            'message' => "APD '{$apd->jenis_apd}' berhasil ditambahkan dengan kode {$apd->kode_apd}.",
            'data'    => $apd->fresh('kodeOk'),
        ], 201);
    }


    /**
     * Update data APD (spesifikasi maupun angka stok).
     * PUT /master-stok-apd/{stokApd}
     */
    public function update(Request $request, StokAPD $stokApd)
    {
        $validated = $this->validateData($request, $stokApd->id);
        $kodeOkList = $this->sanitizeKodeOkList($request->input('kode_ok', []));
        unset($validated['kode_ok']);

        if ($request->hasFile('gambar_apd')) {
            if ($stokApd->gambar_apd && Storage::disk('public')->exists($stokApd->gambar_apd)) {
                Storage::disk('public')->delete($stokApd->gambar_apd);
            }
            $validated['gambar_apd'] = $request->file('gambar_apd')->store('apd_images', 'public');
        }

        $stokApd->update($validated);

        $stokApd->kodeOk()->delete();
        foreach ($kodeOkList as $kode) {
            $stokApd->kodeOk()->create(['kode_ok' => $kode]);
        }

        return response()->json([
            'message' => "Data '{$stokApd->jenis_apd}' berhasil diperbarui.",
            'data'    => $stokApd->fresh('kodeOk'),
        ]);
    }

    private function sanitizeKodeOkList($rawList): array
    {
        if (!is_array($rawList)) {
            return [];
        }

        return collect($rawList)
            ->map(fn($k) => trim((string) $k))
            ->filter(fn($k) => $k !== '')
            ->unique()
            ->values()
            ->all();
    }

    /**
     * Hapus data APD.
     * DELETE /master-stok-apd/{stokApd}
     */
    public function destroy(StokAPD $stokApd)
    {
        $nama = $stokApd->jenis_apd;
        $stokApd->delete();

        return response()->json([
            'message' => "Data '{$nama}' berhasil dihapus.",
        ]);
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'jenis_apd'          => ['required', 'string', 'max:150'],
            'kategori'           => ['required', Rule::in(['WAJIB', 'KHUSUS'])],
            'fungsi_sasaran'     => ['nullable', 'string'],
            'merk_rekomendasi'   => ['nullable', 'string', 'max:255'],
            'spesifikasi_teknis' => ['nullable', 'string'],
            'ukuran_tersedia'    => ['nullable', 'string', 'max:100'],
            'standar_regulasi'   => ['nullable', 'string', 'max:255'],
            'stok_awal'          => ['required', 'integer', 'min:0'],
            'digunakan'          => ['required', 'integer', 'min:0'],
            'rusak'              => ['required', 'integer', 'min:0'],
            'reorder_point'      => ['required', 'integer', 'min:0'],
            'harga_satuan'       => ['required', 'numeric', 'min:0'],
            'supplier'           => ['nullable', 'string', 'max:255'],
            'masa_pakai'         => ['nullable', 'string', 'max:100'],
            'terakhir_pengadaan' => ['nullable', 'date'],
            'keterangan'         => ['nullable', 'string'],
            'kode_ok'            => ['nullable', 'array'],
            'kode_ok.*'          => ['nullable', 'string', 'max:50'],

            // maksimal 2MB, format umum foto
            'gambar_apd'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);
    }
}
