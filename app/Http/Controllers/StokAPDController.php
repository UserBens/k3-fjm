<?php

namespace App\Http\Controllers;

use App\Models\StokAPD;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

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

        $query = StokAPD::query()->search($search);

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        if ($supplier) {
            $query->where('supplier', $supplier);
        }

        // status dihitung dari (stok_awal - digunakan - rusak) vs reorder_point,
        // jadi difilter langsung lewat raw expression, bukan kolom tersimpan.
        if ($status === 'REORDER') {
            $query->whereRaw('(stok_awal - digunakan - rusak) <= reorder_point');
        } elseif ($status === 'OK') {
            $query->whereRaw('(stok_awal - digunakan - rusak) > reorder_point');
        }

        $paginated = $query->orderBy('jenis_apd')->paginate($perPage);

        return response()->json([
            'data' => collect($paginated->items())->map(function (StokAPD $item) {
                return $item->toArray(); // stok_tersedia & status ikut karena $appends
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

    /**
     * Simpan APD baru.
     * POST /master-stok-apd
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $apd = StokAPD::create($validated);

        return response()->json([
            'message' => "APD '{$apd->jenis_apd}' berhasil ditambahkan.",
            'data'    => $apd,
        ], 201);
    }

    /**
     * Update data APD (spesifikasi maupun angka stok).
     * PUT /master-stok-apd/{stokApd}
     */
    public function update(Request $request, StokAPD $stokApd)
    {
        $validated = $this->validateData($request, $stokApd->id);

        $stokApd->update($validated);

        return response()->json([
            'message' => "Data '{$stokApd->jenis_apd}' berhasil diperbarui.",
            'data'    => $stokApd->fresh(),
        ]);
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
            'kode_apd' => [
                'required',
                'string',
                'max:50',
                // PENTING: nama tabel di sini harus "stok_apd" (sesuai migration),
                // bukan "stok_apds" — kalau salah, validasi unique akan query ke
                // tabel yang tidak ada dan melempar 500 error.
                Rule::unique('stok_apd', 'kode_apd')->ignore($ignoreId),
            ],
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
        ]);
    }
}
