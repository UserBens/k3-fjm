<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use App\Models\PermintaanPembelianItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Pegawai;
use App\Models\StokAPD;
use App\Models\UnitKerja; // sesuaikan nama model kalau berbeda di project kamu
use Illuminate\Http\JsonResponse;


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
                'bukti_serah_terima'     => $item->bukti_serah_terima,
                'bukti_serah_terima_url' => $item->bukti_serah_terima ? Storage::disk('public')->url($item->bukti_serah_terima) : null,
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

    // Dropdown Unit Kerja — sumbernya dari master UnitKerja (sama seperti relasi di cariPegawai LogApd)
    public function unitKerjaOptions()
    {
        $items = UnitKerja::query()
            ->whereNotNull('nama_unit_kerja')
            ->distinct()
            ->orderBy('nama_unit_kerja')
            ->pluck('nama_unit_kerja');

        return response()->json(['data' => $items]);
    }

    // Picker pegawai — dipakai untuk field "Diminta Oleh". Sama seperti cariPegawai() di LogApdController.
    public function cariPegawai(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with(['unitKerja', 'subkon'])->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(function (Pegawai $p) {
            $unitLabel = trim(collect([
                $p->unitKerja->nama_unit_kerja ?? null,
                $p->unitKerja->bagian ?? null,
                $p->subkon->nama_subkon ?? null,
            ])->filter()->implode(' — '));

            return [
                'badge'      => $p->badge ?? '-',
                'nama'       => $p->nama ?? '-',
                'jabatan'    => $p->jabatan ?? '-',
                'unit_kerja' => $unitLabel ?: '-',
            ];
        });

        return response()->json(['data' => $results]);
    }

    // Picker Stok APD — dipakai untuk autofill awal field "Nama APD". Mirip apdOptions() di LogApdController.
    public function daftarApd()
    {
        $items = StokAPD::query()
            ->orderBy('jenis_apd')
            ->get()
            ->map(fn(StokAPD $a) => [
                'id'               => $a->id,
                'kode_apd'         => $a->kode_apd,
                'jenis_apd'        => $a->jenis_apd,
                'merk_rekomendasi' => $a->merk_rekomendasi,
                'ukuran_tersedia'  => $a->ukuran_tersedia,
                'stok_tersedia'    => $a->stok_tersedia,
            ]);

        return response()->json(['data' => $items]);
    }

    /**
     * Simpan permintaan baru. Jika No. PP sudah ada, item baru akan
     * ditambahkan ke PP tersebut (bukan membuat header duplikat).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            $header = PermintaanPembelian::create([
                'no_pp'        => PermintaanPembelian::generateNoPp(),
                'tanggal_pp'   => $payload['tanggal_pp'],
                'unit_kerja'   => $payload['unit_kerja'] ?? null,
                'diminta_oleh' => $payload['diminta_oleh'] ?? null,
            ]);

            return $header->items()->create([
                'nama_apd'       => $payload['nama_apd'],
                'qty_permintaan' => $payload['qty_permintaan'],
                'qty_datang'     => $payload['qty_datang'] ?? 0,
                'tanggal_datang' => $payload['tanggal_datang'] ?? null,
                'keterangan'     => $payload['keterangan'] ?? null,
            ]);
        });

        return response()->json([
            'message' => "Permintaan \"{$item->nama_apd}\" berhasil disimpan dengan No. PP {$item->permintaanPembelian->no_pp}.",
            'data'    => $item,
        ], 201);
    }

    /**
     * Perbarui satu item permintaan (termasuk update kedatangan barang).
     */
    public function update(Request $request, PermintaanPembelianItem $item)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_pp'         => ['required', 'date'],
            'unit_kerja'         => ['nullable', 'string', 'max:150'],
            'diminta_oleh'       => ['nullable', 'string', 'max:150'],
            'nama_apd'           => ['required', 'string', 'max:255'],
            'qty_permintaan'     => ['required', 'integer', 'min:1'],
            'qty_datang'         => ['nullable', 'integer', 'min:0'],
            'tanggal_datang'     => ['nullable', 'date'],
            'keterangan'         => ['nullable', 'string'],
            'bukti_serah_terima' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $payload = $validator->validated();

        DB::transaction(function () use ($item, $payload, $request) {
            $item->permintaanPembelian->update([
                'tanggal_pp'   => $payload['tanggal_pp'],
                'unit_kerja'   => $payload['unit_kerja'] ?? null,
                'diminta_oleh' => $payload['diminta_oleh'] ?? null,
            ]);

            $updateData = [
                'nama_apd'       => $payload['nama_apd'],
                'qty_permintaan' => $payload['qty_permintaan'],
                'qty_datang'     => $payload['qty_datang'] ?? 0,
                'tanggal_datang' => $payload['tanggal_datang'] ?? null,
                'keterangan'     => $payload['keterangan'] ?? null,
            ];

            if ($request->hasFile('bukti_serah_terima')) {
                if ($item->bukti_serah_terima) {
                    Storage::disk('public')->delete($item->bukti_serah_terima);
                }
                $updateData['bukti_serah_terima'] = $request->file('bukti_serah_terima')->store('bukti-serah-terima', 'public');
            }
            // tidak upload baru → bukti lama tetap dipertahankan (tidak ada opsi hapus, sama seperti pola foto APD)

            $item->update($updateData);
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
