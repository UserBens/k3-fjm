<?php

namespace App\Http\Controllers;

use App\Models\LogApd;
use App\Models\StokAPD;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogApdController extends Controller
{
    public function index()
    {
        return view('log-apd.index');
    }

    public function data(Request $request)
    {
        $query = LogApd::query();

        $query->search($request->input('search'));

        if ($request->filled('jenis_transaksi')) {
            $query->where('jenis_transaksi', $request->input('jenis_transaksi'));
        }

        if ($request->filled('unit_kerja')) {
            $query->where('unit_kerja', $request->input('unit_kerja'));
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->input('tanggal_dari'));
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->input('tanggal_sampai'));
        }

        $perPage = (int) $request->input('per_page', 10);

        $query->orderByDesc('tanggal')->orderByDesc('id');

        $paginated = $query->paginate($perPage)->withQueryString();

        $rows = $paginated->getCollection()->values()->map(function (LogApd $row, $index) use ($paginated) {
            return $this->transform($row, $paginated->firstItem() + $index);
        });

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
                'jenis_transaksi' => LogApd::JENIS_TRANSAKSI,
                'unit_kerja' => LogApd::query()
                    ->whereNotNull('unit_kerja')
                    ->where('unit_kerja', '!=', '')
                    ->distinct()
                    ->orderBy('unit_kerja')
                    ->pluck('unit_kerja'),
            ],
        ]);
    }

    // Dipakai dropdown "Jenis APD" di modal form supaya bisa autofill kode_apd / merk / ukuran
    public function apdOptions()
    {
        $items = StokAPD::query()
            ->select('id', 'kode_apd', 'jenis_apd', 'merk_rekomendasi', 'ukuran_tersedia')
            ->orderBy('jenis_apd')
            ->get();

        return response()->json(['data' => $items]);
    }

    // Picker pegawai — dipakai untuk field "Data Karyawan" dan "Diterima Oleh".
    // Sama seperti cariPegawai() milik AlatKesehatanPenggunaController.
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

    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['no_dokumen'] = LogApd::generateNoDokumen();

        $log = LogApd::create($data);

        return response()->json([
            'message' => "Log APD {$log->no_dokumen} berhasil disimpan.",
            'data'    => $this->transform($log, 1),
        ], 201);
    }

    public function update(Request $request, LogApd $logApd)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $logApd->update($validator->validated());

        return response()->json([
            'message' => "Log APD {$logApd->no_dokumen} berhasil diperbarui.",
            'data'    => $this->transform($logApd->fresh(), 1),
        ]);
    }

    public function destroy(LogApd $logApd)
    {
        $noDokumen = $logApd->no_dokumen;
        $logApd->delete();

        return response()->json([
            'message' => "Log APD {$noDokumen} berhasil dihapus.",
        ]);
    }

    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'tanggal'            => ['required', 'date'],
            'id_karyawan'        => ['nullable', 'string', 'max:50'],
            'nama_karyawan'      => ['nullable', 'string', 'max:150'],
            'kode_ok'            => ['nullable', 'string', 'max:50'],
            'unit_kerja'         => ['nullable', 'string', 'max:150'],
            'jabatan'            => ['nullable', 'string', 'max:150'],
            'stok_apd_id'        => ['nullable', 'exists:stok_apd,id'],
            'kode_apd'           => ['nullable', 'string', 'max:50'],
            'jenis_apd'          => ['required', 'string', 'max:150'],
            'merk_type'          => ['nullable', 'string', 'max:150'],
            'ukuran'             => ['nullable', 'string', 'max:50'],
            'qty_keluar'         => ['nullable', 'integer', 'min:0'],
            'qty_masuk'          => ['nullable', 'integer', 'min:0'],
            'jenis_transaksi'    => ['required', 'string', 'max:50'],
            'no_po_pr'           => ['nullable', 'string', 'max:100'],
            'kondisi_apd_lama'   => ['nullable', 'string', 'max:150'],
            'alasan_penggantian' => ['nullable', 'string'],
            'diterima_oleh'      => ['nullable', 'string', 'max:150'],
            'keterangan'         => ['nullable', 'string'],
        ]);
    }

    // Nilai mentah dikirim apa adanya (null jika kosong) — fallback tampilan "Data Tidak
    // Ditemukan" / "-" ditangani di JS, supaya form edit tidak ikut terisi teks placeholder.
    private function transform(LogApd $row, int $no): array
    {
        return [
            'id'                 => $row->id,
            'no'                 => $no,
            'tanggal'            => optional($row->tanggal)->format('Y-m-d'),
            'no_dokumen'         => $row->no_dokumen,
            'id_karyawan'        => $row->id_karyawan,
            'nama_karyawan'      => $row->nama_karyawan,
            'kode_ok'            => $row->kode_ok,
            'unit_kerja'         => $row->unit_kerja,
            'jabatan'            => $row->jabatan,
            'stok_apd_id'        => $row->stok_apd_id,
            'kode_apd'           => $row->kode_apd,
            'jenis_apd'          => $row->jenis_apd,
            'merk_type'          => $row->merk_type,
            'ukuran'             => $row->ukuran,
            'qty_keluar'         => $row->qty_keluar,
            'qty_masuk'          => $row->qty_masuk,
            'jenis_transaksi'    => $row->jenis_transaksi,
            'no_po_pr'           => $row->no_po_pr,
            'kondisi_apd_lama'   => $row->kondisi_apd_lama,
            'alasan_penggantian' => $row->alasan_penggantian,
            'diterima_oleh'      => $row->diterima_oleh,
            'keterangan'         => $row->keterangan,
        ];
    }
}
