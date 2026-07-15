<?php

namespace App\Http\Controllers;

use App\Models\StokAlkes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StokAlkesController extends Controller
{
    public function index()
    {
        return view('alkes.index');
    }

    public function data(Request $request)
    {
        $perPage = $request->integer('per_page', 10);

        $query = StokAlkes::query()
            ->search($request->search);

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('supplier')) {
            $query->where('supplier', $request->supplier);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        $paginated = $query
            ->orderBy('jenis_alat')
            ->paginate($perPage);

        return response()->json([
            'data' => $paginated->items(),

            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'total' => $paginated->total(),
                'from' => $paginated->firstItem(),
                'to' => $paginated->lastItem(),
            ],

            'filter_options' => [

                'kategori' => StokAlkes::distinct()
                    ->orderBy('kategori')
                    ->pluck('kategori'),

                'supplier' => StokAlkes::whereNotNull('supplier')
                    ->distinct()
                    ->orderBy('supplier')
                    ->pluck('supplier'),

                'status' => [
                    'Aktif',
                    'Tidak Aktif'
                ],

                'kondisi' => [
                    'Baik',
                    'Rusak Ringan',
                    'Rusak Berat',
                    'Perlu Kalibrasi'
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['stok_tersedia'] =
            $validated['stok_awal']
            - $validated['digunakan']
            - $validated['rusak'];

        $alkes = StokAlkes::create($validated);

        return response()->json([
            'message' => 'Data alat kesehatan berhasil ditambahkan.',
            'data' => $alkes
        ], 201);
    }

    public function update(Request $request, StokAlkes $stokAlke)
    {
        $validated = $this->validateData($request);

        $validated['stok_tersedia'] =
            $validated['stok_awal']
            - $validated['digunakan']
            - $validated['rusak'];

        $stokAlke->update($validated);

        return response()->json([
            'message' => 'Data alat kesehatan berhasil diperbarui.',
            'data' => $stokAlke
        ]);
    }

    public function destroy(StokAlkes $stokAlke)
    {
        $nama = $stokAlke->jenis_alat;

        $stokAlke->delete();

        return response()->json([
            'message' => "Data {$nama} berhasil dihapus."
        ]);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([

            'jenis_alat' => ['required', 'string', 'max:255'],

            'fungsi_pemeriksaan' => ['nullable', 'string'],

            'merk' => ['nullable', 'string', 'max:150'],

            'type' => ['nullable', 'string', 'max:150'],

            'spesifikasi_teknis' => ['nullable', 'string'],

            'stok_awal' => ['required', 'integer', 'min:0'],

            'digunakan' => ['required', 'integer', 'min:0'],

            'rusak' => ['required', 'integer', 'min:0'],

            'reorder_point' => ['required', 'integer', 'min:0'],

            'nomor_seri' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('stok_alkes', 'nomor_seri') // BENAR
                    ->ignore($request->route('stokAlkes')),
            ],

            'kategori' => ['required', 'string', 'max:100'],

            'tanggal_kalibrasi' => ['nullable', 'date'],

            'jadwal_kalibrasi_berikut' => ['nullable', 'date'],

            'supplier' => ['nullable', 'string', 'max:255'],

            'harga_satuan' => ['nullable', 'numeric', 'min:0'],

            'masa_garansi' => ['nullable', 'date'],

            'kondisi' => [
                'required',
                Rule::in([
                    'Baik',
                    'Rusak Ringan',
                    'Rusak Berat',
                    'Perlu Kalibrasi'
                ])
            ],

            'keterangan' => ['nullable', 'string'],

            'status' => [
                'required',
                Rule::in([
                    'Aktif',
                    'Tidak Aktif'
                ])
            ],
        ]);
    }
}
