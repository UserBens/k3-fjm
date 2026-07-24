<?php

namespace App\Http\Controllers;

use App\Models\StokAlkes;
use App\Models\Supplierapd;
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

        if ($request->filled('tipe_alat')) {
            $query->where('tipe_alat', $request->tipe_alat);
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

                'tipe_alat' => ['Consumable', 'Non-Consumable'],

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

        $validated['kode_alkes'] = $this->generateKodeAlkes($validated['jenis_alat']);
        $alkes = StokAlkes::create($validated);

        return response()->json([
            'message' => 'Data alat kesehatan berhasil ditambahkan.',
            'data' => $alkes
        ], 201);
    }

    public function update(Request $request, StokAlkes $stokAlkes)
    {
        $validated = $this->validateData($request);

        if ($stokAlkes->jenis_alat != $validated['jenis_alat']) {
            $validated['kode_alkes'] = $this->generateKodeAlkes($validated['jenis_alat']);
        }
        $validated['stok_tersedia'] = $validated['stok_awal'] - $validated['digunakan'] - $validated['rusak'];

        $stokAlkes->update($validated);

        return response()->json([
            'message' => 'Data alat kesehatan berhasil diperbarui.',
            'data' => $stokAlkes
        ]);
    }

    public function destroy(StokAlkes $stokAlkes)
    {
        $nama = $stokAlkes->jenis_alat;
        $stokAlkes->delete();

        return response()->json([
            'message' => "Data {$nama} berhasil dihapus."
        ]);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'kode_alkes' => ['nullable', 'string', 'max:50', Rule::unique('stok_alkes', 'kode_alkes')
                ->ignore($request->route('stokAlkes'))],   // ← diperbaiki

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
                Rule::unique('stok_alkes', 'nomor_seri')->ignore($request->route('stokAlkes')),
            ],

            'kategori' => ['required', 'string', 'max:100'],

            'tanggal_kalibrasi' => ['nullable', 'date'],

            'jadwal_kalibrasi_berikut' => ['nullable', 'date'],

            'tanggal_exp' => ['nullable', 'date'],

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

            'tipe_alat' => ['required', Rule::in(['Consumable', 'Non-Consumable'])],
            'interval_kalibrasi' => ['nullable', Rule::in(['3_BULAN', '6_BULAN', '1_TAHUN', '2_TAHUN'])],

            'status' => [
                'required',
                Rule::in([
                    'Aktif',
                    'Tidak Aktif'
                ])
            ],
        ]);
    }

    private function generateKodeAlkes(string $jenisAlat): string
    {
        $map = [
            'Glukometer'         => 'GL',
            'Cholesterol Meter'  => 'CM',
            'Asam Urat Meter'    => 'AU',
            'Hb Meter'           => 'HB',
            'Tensimeter'         => 'TM',
            'Tensimeter Digital' => 'TD',
            'Thermometer'        => 'TH',
            'Nebulizer'          => 'NB',
            'Pulse Oximeter'     => 'PO',
            'ECG'                => 'EC',
        ];

        $prefix = $map[$jenisAlat]
            ?? strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $jenisAlat), 0, 2));

        $last = StokAlkes::where('kode_alkes', 'like', "ALK-NC-{$prefix}-%")
            ->orderByDesc('kode_alkes')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode_alkes, -2);
            $next = $lastNumber + 1;
        } else {
            $next = 1;
        }

        return sprintf(
            'ALK-NC-%s-%02d',
            $prefix,
            $next
        );
    }

    public function supplierOptions(Request $request)
    {
        $items = SupplierApd::query()
            ->aktif()
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = $request->search;
                $q->where(function ($qq) use ($term) {
                    $qq->where('nama_supplier', 'like', "%{$term}%")
                        ->orWhere('kategori_produk', 'like', "%{$term}%")
                        ->orWhere('merk_utama', 'like', "%{$term}%");
                });
            })
            ->orderBy('nama_supplier')
            ->get(['id', 'nama_supplier', 'kategori_produk', 'merk_utama', 'wilayah']);

        return response()->json(['data' => $items]);
    }
}
