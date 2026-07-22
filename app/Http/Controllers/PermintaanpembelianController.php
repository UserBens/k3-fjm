<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use App\Models\PermintaanPembelianItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermintaanPembelianController extends Controller
{
    /**
     * Tampilkan halaman manajemen Permintaan Pembelian APD.
     */
    public function index()
    {
        return view('permintaan-pembelian.index');
    }

    /**
     * Endpoint data untuk tabel (dipanggil via fetch/AJAX).
     * Mendukung: search, filter status, filter unit_kerja, filter rentang tanggal PP, pagination.
     */
    public function data(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50]) ? $perPage : 10;

        $query = PermintaanPembelianItem::query()
            ->with('permintaanPembelian')
            ->join('permintaan_pembelians', 'permintaan_pembelians.id', '=', 'permintaan_pembelian_items.permintaan_pembelian_id')
            ->select('permintaan_pembelian_items.*')
            ->orderByDesc('permintaan_pembelians.tanggal_pp')
            ->orderByDesc('permintaan_pembelian_items.id');

        // Pencarian bebas: no PP, nama APD, unit kerja
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('permintaan_pembelians.no_pp', 'like', "%{$search}%")
                    ->orWhere('permintaan_pembelian_items.nama_apd', 'like', "%{$search}%")
                    ->orWhere('permintaan_pembelians.unit_kerja', 'like', "%{$search}%")
                    ->orWhere('permintaan_pembelians.diminta_oleh', 'like', "%{$search}%");
            });
        }

        // Filter unit kerja
        if ($unitKerja = $request->input('unit_kerja')) {
            $query->where('permintaan_pembelians.unit_kerja', $unitKerja);
        }

        // Filter rentang tanggal PP
        if ($tanggalDari = $request->input('tanggal_dari')) {
            $query->whereDate('permintaan_pembelians.tanggal_pp', '>=', $tanggalDari);
        }
        if ($tanggalSampai = $request->input('tanggal_sampai')) {
            $query->whereDate('permintaan_pembelians.tanggal_pp', '<=', $tanggalSampai);
        }

        // Filter status dihitung di level SQL supaya pagination tetap akurat
        if ($status = $request->input('status')) {
            switch ($status) {
                case PermintaanPembelianItem::STATUS_BELUM_DATANG:
                    $query->where('permintaan_pembelian_items.qty_datang', '<=', 0);
                    break;
                case PermintaanPembelianItem::STATUS_KURANG:
                    $query->whereColumn('permintaan_pembelian_items.qty_datang', '<', 'permintaan_pembelian_items.qty_permintaan')
                        ->where('permintaan_pembelian_items.qty_datang', '>', 0);
                    break;
                case PermintaanPembelianItem::STATUS_LENGKAP:
                    $query->whereColumn('permintaan_pembelian_items.qty_datang', '>=', 'permintaan_pembelian_items.qty_permintaan');
                    break;
            }
        }

        $paginator = $query->paginate($perPage)->withQueryString();

        $data = collect($paginator->items())->map(function (PermintaanPembelianItem $item) {
            return [
                'id'              => $item->id,
                'permintaan_pembelian_id' => $item->permintaan_pembelian_id,
                'no_pp'           => $item->permintaanPembelian->no_pp,
                'tanggal_pp'      => optional($item->permintaanPembelian->tanggal_pp)->toDateString(),
                'unit_kerja'      => $item->permintaanPembelian->unit_kerja,
                'diminta_oleh'    => $item->permintaanPembelian->diminta_oleh,
                'nama_apd'        => $item->nama_apd,
                'qty_permintaan'  => $item->qty_permintaan,
                'qty_datang'      => $item->qty_datang,
                'qty_kurang'      => $item->qty_kurang,
                'tanggal_datang'  => optional($item->tanggal_datang)->toDateString(),
                'status'          => $item->status,
                'keterangan'      => $item->keterangan,
            ];
        });

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'total'        => $paginator->total(),
                'from'         => $paginator->firstItem() ?? 0,
                'to'           => $paginator->lastItem() ?? 0,
            ],
            'filter_options' => [
                'unit_kerja' => PermintaanPembelian::query()
                    ->whereNotNull('unit_kerja')
                    ->distinct()
                    ->orderBy('unit_kerja')
                    ->pluck('unit_kerja'),
                'status' => PermintaanPembelianItem::STATUS_OPTIONS,
            ],
        ]);
    }

    /**
     * Simpan permintaan baru. Jika No. PP sudah ada, item baru akan
     * ditambahkan ke PP tersebut (bukan membuat header duplikat).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_pp'          => ['required', 'string', 'max:100'],
            'tanggal_pp'     => ['required', 'date'],
            'unit_kerja'     => ['nullable', 'string', 'max:150'],
            'diminta_oleh'   => ['nullable', 'string', 'max:150'],
            'nama_apd'       => ['required', 'string', 'max:255'],
            'qty_permintaan' => ['required', 'integer', 'min:1'],
            'qty_datang'     => ['nullable', 'integer', 'min:0'],
            'tanggal_datang' => ['nullable', 'date'],
            'keterangan'     => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $payload = $validator->validated();

        $item = DB::transaction(function () use ($payload) {
            $header = PermintaanPembelian::firstOrCreate(
                ['no_pp' => $payload['no_pp']],
                [
                    'tanggal_pp'   => $payload['tanggal_pp'],
                    'unit_kerja'   => $payload['unit_kerja'] ?? null,
                    'diminta_oleh' => $payload['diminta_oleh'] ?? null,
                ]
            );

            return $header->items()->create([
                'nama_apd'       => $payload['nama_apd'],
                'qty_permintaan' => $payload['qty_permintaan'],
                'qty_datang'     => $payload['qty_datang'] ?? 0,
                'tanggal_datang' => $payload['tanggal_datang'] ?? null,
                'keterangan'     => $payload['keterangan'] ?? null,
            ]);
        });

        return response()->json([
            'message' => "Permintaan \"{$item->nama_apd}\" berhasil disimpan.",
            'data'    => $item,
        ], 201);
    }

    /**
     * Perbarui satu item permintaan (termasuk update kedatangan barang).
     */
    public function update(Request $request, PermintaanPembelianItem $item)
    {
        $validator = Validator::make($request->all(), [
            'no_pp'          => ['required', 'string', 'max:100'],
            'tanggal_pp'     => ['required', 'date'],
            'unit_kerja'     => ['nullable', 'string', 'max:150'],
            'diminta_oleh'   => ['nullable', 'string', 'max:150'],
            'nama_apd'       => ['required', 'string', 'max:255'],
            'qty_permintaan' => ['required', 'integer', 'min:1'],
            'qty_datang'     => ['nullable', 'integer', 'min:0'],
            'tanggal_datang' => ['nullable', 'date'],
            'keterangan'     => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $payload = $validator->validated();

        DB::transaction(function () use ($item, $payload) {
            $item->permintaanPembelian->update([
                'no_pp'        => $payload['no_pp'],
                'tanggal_pp'   => $payload['tanggal_pp'],
                'unit_kerja'   => $payload['unit_kerja'] ?? null,
                'diminta_oleh' => $payload['diminta_oleh'] ?? null,
            ]);

            $item->update([
                'nama_apd'       => $payload['nama_apd'],
                'qty_permintaan' => $payload['qty_permintaan'],
                'qty_datang'     => $payload['qty_datang'] ?? 0,
                'tanggal_datang' => $payload['tanggal_datang'] ?? null,
                'keterangan'     => $payload['keterangan'] ?? null,
            ]);
        });

        return response()->json([
            'message' => 'Permintaan berhasil diperbarui.',
            'data'    => $item->fresh(),
        ]);
    }

    /**
     * Hapus satu item permintaan. Jika itu item terakhir dalam PP,
     * header PP ikut dihapus supaya tidak menyisakan PP kosong.
     */
    public function destroy(PermintaanPembelianItem $item)
    {
        DB::transaction(function () use ($item) {
            $header = $item->permintaanPembelian;
            $item->delete();

            if ($header && $header->items()->count() === 0) {
                $header->delete();
            }
        });

        return response()->json([
            'message' => 'Permintaan berhasil dihapus.',
        ]);
    }
}