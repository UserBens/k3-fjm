<?php

namespace App\Http\Controllers;

use App\Exports\RabAnggaranExport;
use App\Models\RabAnggaran;
use App\Models\RabAnggaranItem;
use App\Models\StokAPD;
use App\Models\StokAlkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RabAnggaranController extends Controller
{
    // ══════════════════════════ HALAMAN ══════════════════════════

    public function index()
    {
        return view('rab-anggaran.index');
    }

    public function show(RabAnggaran $rabAnggaran)
    {
        return view('rab-anggaran.detail', ['rabId' => $rabAnggaran->id]);
    }

    // Export RAB (kop info + Tabel A APD + Tabel B Alkes + subtotal + grand total) ke .xlsx
    public function exportExcel(RabAnggaran $rabAnggaran)
    {
        $spreadsheet = (new RabAnggaranExport())->build($rabAnggaran);
        $writer = new Xlsx($spreadsheet);

        $filename = "RAB-{$rabAnggaran->nomor_rab}.xlsx";

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // ══════════════════════════ HEADER RAB ══════════════════════════

    public function data(Request $request)
    {
        $query = RabAnggaran::query()->withCount('items')->with('items');

        $query->search($request->input('search'));

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('tahun_anggaran')) {
            $query->where('tahun_anggaran', $request->input('tahun_anggaran'));
        }

        $perPage = (int) $request->input('per_page', 10);

        $paginated = $query->orderByDesc('tanggal_pengajuan')->orderByDesc('id')
            ->paginate($perPage)->withQueryString();

        $rows = $paginated->getCollection()->values()->map(fn(RabAnggaran $rab) => $this->transformHeader($rab));

        return response()->json([
            'data' => $rows,
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page'    => $paginated->lastPage(),
                'total'        => $paginated->total(),
                'from'         => $paginated->firstItem() ?? 0,
                'to'           => $paginated->lastItem() ?? 0,
            ],
            'filter_options' => [
                'status'         => RabAnggaran::STATUS,
                'tahun_anggaran' => RabAnggaran::query()
                    ->distinct()->orderByDesc('tahun_anggaran')->pluck('tahun_anggaran'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->headerValidator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['nomor_rab'] = RabAnggaran::generateNomorRab($data['tahun_anggaran']);

        $rab = RabAnggaran::create($data);

        return response()->json([
            'message' => "RAB {$rab->nomor_rab} berhasil dibuat.",
            'data'    => $this->transformHeader($rab->fresh('items')),
        ], 201);
    }

    public function update(Request $request, RabAnggaran $rabAnggaran)
    {
        $validator = $this->headerValidator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $rabAnggaran->update($validator->validated());

        return response()->json([
            'message' => "RAB {$rabAnggaran->nomor_rab} berhasil diperbarui.",
            'data'    => $this->transformHeader($rabAnggaran->fresh('items')),
        ]);
    }

    public function destroy(RabAnggaran $rabAnggaran)
    {
        $nomor = $rabAnggaran->nomor_rab;
        $rabAnggaran->delete(); // item ikut terhapus (cascadeOnDelete)

        return response()->json([
            'message' => "RAB {$nomor} beserta seluruh itemnya berhasil dihapus.",
        ]);
    }

    // ══════════════════════════ DETAIL + ITEM ══════════════════════════

    // Dipanggil dari halaman detail: header lengkap + daftar item Tabel A (APD) & Tabel B (Alkes)
    public function detailData(RabAnggaran $rabAnggaran)
    {
        $rabAnggaran->load(['items' => fn($q) => $q->orderBy('id')]);

        return response()->json([
            'header'      => $this->transformHeader($rabAnggaran),
            'items_apd'   => $rabAnggaran->itemsApd()->orderBy('id')->get()->map(fn($i) => $this->transformItem($i)),
            'items_alkes' => $rabAnggaran->itemsAlkes()->orderBy('id')->get()->map(fn($i) => $this->transformItem($i)),
        ]);
    }

    public function storeItem(Request $request, RabAnggaran $rabAnggaran)
    {
        $validator = $this->itemValidator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data item belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['rab_anggaran_id'] = $rabAnggaran->id;

        $item = RabAnggaranItem::create($data);

        return response()->json([
            'message' => "Item \"{$item->nama_barang}\" berhasil ditambahkan.",
            'data'    => $this->transformItem($item),
        ], 201);
    }

    public function updateItem(Request $request, RabAnggaranItem $item)
    {
        $validator = $this->itemValidator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data item belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $item->update($validator->validated());

        return response()->json([
            'message' => "Item \"{$item->nama_barang}\" berhasil diperbarui.",
            'data'    => $this->transformItem($item->fresh()),
        ]);
    }

    public function destroyItem(RabAnggaranItem $item)
    {
        $nama = $item->nama_barang;
        $item->delete();

        return response()->json([
            'message' => "Item \"{$nama}\" berhasil dihapus.",
        ]);
    }

    // ══════════════════════════ PICKER MASTER ══════════════════════════

    // Picker "Jenis APD" — dipakai saat menambah item Tabel A
    public function apdOptions()
    {
        $items = StokAPD::query()
            ->select('id', 'kode_apd', 'jenis_apd', 'kategori', 'merk_rekomendasi', 'spesifikasi_teknis', 'ukuran_tersedia', 'harga_satuan')
            ->orderBy('jenis_apd')
            ->get();

        return response()->json(['data' => $items]);
    }

    // Picker "Jenis Alat Kesehatan" — dipakai saat menambah item Tabel B
    public function alkesOptions()
    {
        $items = StokAlkes::query()
            ->select('id', 'kode_alkes', 'jenis_alat', 'kategori', 'merk', 'type', 'spesifikasi_teknis', 'harga_satuan')
            ->orderBy('jenis_alat')
            ->get();

        return response()->json(['data' => $items]);
    }

    // ══════════════════════════ VALIDATOR & TRANSFORM ══════════════════════════

    private function headerValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_perusahaan'   => ['nullable', 'string', 'max:150'],
            'departemen'        => ['nullable', 'string', 'max:150'],
            'tahun_anggaran'    => ['required', 'digits:4'],
            'dibuat_oleh'       => ['nullable', 'string', 'max:150'],
            'disetujui_oleh'    => ['nullable', 'string', 'max:150'],
            'tanggal_pengajuan' => ['nullable', 'date'],
            'status'            => ['required', 'in:' . implode(',', RabAnggaran::STATUS)],
            'keterangan'        => ['nullable', 'string'],
        ]);
    }

    private function itemValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'jenis'              => ['required', 'in:' . implode(',', RabAnggaranItem::JENIS)],
            'stok_apd_id'        => ['nullable', 'exists:stok_apd,id'],
            'stok_alkes_id'      => ['nullable', 'exists:stok_alkes,id'],
            'kode_ok'            => ['nullable', 'string', 'max:50'],
            'jabatan_posisi'     => ['nullable', 'string', 'max:150'],
            'kode_item'          => ['nullable', 'string', 'max:100'],
            'nama_barang'        => ['required', 'string', 'max:150'],
            'kategori'           => ['nullable', 'string', 'max:50'],
            'merk_type'          => ['nullable', 'string', 'max:150'],
            'spesifikasi'        => ['nullable', 'string'],
            'ukuran'             => ['nullable', 'string', 'max:50'],
            'qty_ada'            => ['nullable', 'integer', 'min:0'],
            'qty_butuh'          => ['nullable', 'integer', 'min:0'],
            'qty_pengadaan'      => ['nullable', 'integer', 'min:0'],
            'satuan'             => ['nullable', 'string', 'max:50'],
            'harga_satuan'       => ['nullable', 'numeric', 'min:0'],
            'keterangan'         => ['nullable', 'string'],
            'prioritas'          => ['required', 'in:' . implode(',', RabAnggaranItem::PRIORITAS)],
            'periode_pengajuan'  => ['required', 'in:' . implode(',', RabAnggaranItem::PERIODE)],
        ]);
    }

    private function transformHeader(RabAnggaran $rab): array
    {
        $subtotalApd = $rab->items->where('jenis', 'APD')
            ->sum(fn($i) => $i->qty_pengadaan * $i->harga_satuan);

        $subtotalAlkes = $rab->items->where('jenis', 'ALKES')
            ->sum(fn($i) => $i->qty_pengadaan * $i->harga_satuan);

        $grandTotal = $subtotalApd + $subtotalAlkes;

        // ══════ REKAP RAB PER PERIODE ══════
        // Meniru blok "REKAP RAB PER PERIODE" di sheet: dijumlahkan berdasarkan
        // Periode Pengajuan tiap baris (BULANAN/TRIWULAN/TAHUNAN), lintas Tabel A & B.
        $totalBulanan = $rab->items->where('periode_pengajuan', 'BULANAN')
            ->sum(fn($i) => $i->qty_pengadaan * $i->harga_satuan);

        $totalTriwulan = $rab->items->where('periode_pengajuan', 'TRIWULAN')
            ->sum(fn($i) => $i->qty_pengadaan * $i->harga_satuan);

        $totalTahunan = $rab->items->where('periode_pengajuan', 'TAHUNAN')
            ->sum(fn($i) => $i->qty_pengadaan * $i->harga_satuan);

        // Estimasi Setahun = proyeksi biaya berulang selama 1 tahun:
        // item Bulanan diasumsikan terjadi 12x/tahun, Triwulan 4x/tahun, Tahunan 1x/tahun.
        $estimasiSetahun = ($totalBulanan * 12) + ($totalTriwulan * 4) + $totalTahunan;

        return [
            'id'                 => $rab->id,
            'nomor_rab'          => $rab->nomor_rab,
            'nama_perusahaan'    => $rab->nama_perusahaan,
            'departemen'         => $rab->departemen,
            'tahun_anggaran'     => $rab->tahun_anggaran,
            'dibuat_oleh'        => $rab->dibuat_oleh,
            'disetujui_oleh'     => $rab->disetujui_oleh,
            'tanggal_pengajuan'  => optional($rab->tanggal_pengajuan)->format('Y-m-d'),
            'status'             => $rab->status,
            'keterangan'         => $rab->keterangan,
            'jumlah_item'        => $rab->items_count ?? $rab->items->count(),
            'subtotal_apd'       => (float) $subtotalApd,
            'subtotal_alkes'     => (float) $subtotalAlkes,
            'grand_total'        => (float) $grandTotal,
            'rekap_periode'      => [
                'bulanan'          => (float) $totalBulanan,
                'triwulan'         => (float) $totalTriwulan,
                'tahunan'          => (float) $totalTahunan,
                'estimasi_setahun' => (float) $estimasiSetahun,
                'grand_total'      => (float) $grandTotal,
            ],
        ];
    }

    private function transformItem(RabAnggaranItem $item): array
    {
        return [
            'id'                 => $item->id,
            'rab_anggaran_id'    => $item->rab_anggaran_id,
            'jenis'              => $item->jenis,
            'stok_apd_id'        => $item->stok_apd_id,
            'stok_alkes_id'      => $item->stok_alkes_id,
            'kode_ok'            => $item->kode_ok,
            'jabatan_posisi'     => $item->jabatan_posisi,
            'kode_item'          => $item->kode_item,
            'nama_barang'        => $item->nama_barang,
            'kategori'           => $item->kategori,
            'merk_type'          => $item->merk_type,
            'spesifikasi'        => $item->spesifikasi,
            'ukuran'             => $item->ukuran,
            'qty_ada'            => $item->qty_ada,
            'qty_butuh'          => $item->qty_butuh,
            'qty_pengadaan'      => $item->qty_pengadaan,
            'satuan'             => $item->satuan,
            'harga_satuan'       => (float) $item->harga_satuan,
            'total_harga'        => (float) $item->total_harga,
            'keterangan'         => $item->keterangan,
            'prioritas'          => $item->prioritas,
            'periode_pengajuan'  => $item->periode_pengajuan,
        ];
    }
}
