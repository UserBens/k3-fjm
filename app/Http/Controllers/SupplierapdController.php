<?php

namespace App\Http\Controllers;

use App\Models\SupplierApd;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierApdController extends Controller
{
    public function index()
    {
        return view('supplier-apd.index');
    }

    public function data(Request $request)
    {
        $perPage = $request->integer('per_page', 10);

        $query = SupplierApd::query()
            ->search($request->search);

        if ($request->filled('kategori')) {
            $query->where('kategori_produk', $request->kategori);
        }

        if ($request->filled('wilayah')) {
            $query->where('wilayah', $request->wilayah);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis_supplier', $request->jenis);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $paginated = $query
            ->orderBy('nama_supplier')
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

                'kategori' => SupplierApd::whereNotNull('kategori_produk')
                    ->distinct()
                    ->orderBy('kategori_produk')
                    ->pluck('kategori_produk'),

                'wilayah' => SupplierApd::whereNotNull('wilayah')
                    ->distinct()
                    ->orderBy('wilayah')
                    ->pluck('wilayah'),

                'jenis' => SupplierApd::whereNotNull('jenis_supplier')
                    ->distinct()
                    ->orderBy('jenis_supplier')
                    ->pluck('jenis_supplier'),

                'status' => [
                    'Aktif',
                    'Tidak Aktif'
                ],
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $supplier = SupplierApd::create($validated);

        return response()->json([
            'message' => 'Data supplier berhasil ditambahkan.',
            'data' => $supplier
        ], 201);
    }

    public function update(Request $request, SupplierApd $supplierApd)
    {
        $validated = $this->validateData($request);

        $supplierApd->update($validated);

        return response()->json([
            'message' => 'Data supplier berhasil diperbarui.',
            'data' => $supplierApd
        ]);
    }

    public function destroy(SupplierApd $supplierApd)
    {
        $nama = $supplierApd->nama_supplier;

        $supplierApd->delete();

        return response()->json([
            'message' => "Data {$nama} berhasil dihapus."
        ]);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([

            'nama_supplier' => ['required', 'string', 'max:255'],

            'kategori_produk' => ['required', 'string', 'max:150'],

            'merk_utama' => ['nullable', 'string', 'max:255'],

            'jenis_supplier' => ['nullable', 'string', 'max:100'],

            'kontak_person' => ['nullable', 'string', 'max:150'],

            'no_telepon' => ['nullable', 'string', 'max:50'],

            'email' => ['nullable', 'email', 'max:150'],

            'wilayah' => ['nullable', 'string', 'max:150'],

            'alamat' => ['nullable', 'string'],

            'website' => ['nullable', 'string', 'max:255'],

            'nomor_izin_edar' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('supplier_apd_alkes', 'nomor_izin_edar')
                    ->ignore($request->route('supplierApd')),
            ],

            'catatan' => ['nullable', 'string'],

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
