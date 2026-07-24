<?php

namespace App\Http\Controllers;

use App\Models\KodeOk;
use App\Models\LogApd;
use App\Models\StokAPD;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

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

    public function kodeOkOptions()
    {
        $items = KodeOk::query()
            ->select('id', 'kode_ok')
            ->with('unitKerjaRelasi:id,nama_unit_kerja')
            ->where('status', true)
            ->orderBy('kode_ok')
            ->get()
            ->map(fn($k) => [
                'id'         => $k->id,
                'kode_ok'    => $k->kode_ok,
                'unit_kerja' => $k->unitKerjaRelasi->pluck('nama_unit_kerja')->join(', '),
            ]);

        return response()->json(['data' => $items]);
    }

    // Dipakai dropdown "Jenis APD" di modal form supaya bisa autofill kode_apd / merk / ukuran
    public function apdOptions()
    {
        $items = StokAPD::query()
            ->select(
                'id',
                'kode_apd',
                'jenis_apd',
                'merk_rekomendasi',
                'ukuran_tersedia',
                'stok_awal',
                'digunakan',
                'rusak',
                'reorder_point',
                'masa_pakai',
                'terakhir_pengadaan'
            )
            ->orderBy('jenis_apd')
            ->get()
            ->map(fn(StokAPD $s) => [
                'id'                => $s->id,
                'kode_apd'          => $s->kode_apd,
                'jenis_apd'         => $s->jenis_apd,
                'merk_rekomendasi'  => $s->merk_rekomendasi,
                'ukuran_tersedia'   => $s->ukuran_tersedia,
                'stok_tersedia'     => $s->stok_tersedia,     // accessor
                'reorder_point'     => $s->reorder_point,
                'status'            => $s->status,            // OK / REORDER
                'lifetime_status'   => $s->lifetime_status,    // AMAN / SEGERA / HABIS MASA
            ]);

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
            'keterangan_lainnya' => ['nullable', 'required_if:jenis_transaksi,LAINNYA', 'string', 'max:255'],
            'kondisi_apd_lama'   => [
                'nullable',
                'string',
                'max:150',
                Rule::requiredIf(fn() => in_array($request->input('jenis_transaksi'), LogApd::JENIS_TRANSAKSI_TUKAR)),
            ],
            'pernah_tukar'       => ['nullable', 'boolean'],
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
            'keterangan_lainnya' => $row->keterangan_lainnya,
            'kondisi_apd_lama'   => $row->kondisi_apd_lama,
            'pernah_tukar'       => $row->pernah_tukar,
            'alasan_penggantian' => $row->alasan_penggantian,
            'diterima_oleh'      => $row->diterima_oleh,
            'keterangan'         => $row->keterangan,
        ];
    }

    public function riwayatTukar(Request $request): JsonResponse
    {
        $idKaryawan = $request->query('id_karyawan');
        $stokApdId  = $request->query('stok_apd_id');

        if (!$idKaryawan || !$stokApdId) {
            return response()->json(['data' => null]);
        }

        $last = LogApd::where('id_karyawan', $idKaryawan)
            ->where('stok_apd_id', $stokApdId)
            ->whereIn('jenis_transaksi', ['TUKAR LAMA', 'TUKAR RUSAK', 'JATAH BARU'])
            ->orderByDesc('tanggal')
            ->first();

        if (!$last) {
            return response()->json(['data' => ['pernah_tukar' => false]]);
        }

        $jadwalSelanjutnya = null;
        $stokApd = StokAPD::find($stokApdId);

        if ($stokApd && $stokApd->masa_pakai) {
            $totalHari = StokAPD::parseMasaPakaiToDays($stokApd->masa_pakai);
            if ($totalHari !== null) {
                $jadwalSelanjutnya = $last->tanggal->copy()->addDays($totalHari)->format('Y-m-d');
            }
        }

        return response()->json([
            'data' => [
                'pernah_tukar'             => true,
                'tanggal_terakhir'         => $last->tanggal->format('Y-m-d'),
                'no_dokumen'               => $last->no_dokumen,
                'jenis_transaksi'          => $last->jenis_transaksi,
                'kondisi_apd_lama'         => $last->kondisi_apd_lama,
                'jadwal_tukar_selanjutnya' => $jadwalSelanjutnya,
            ],
        ]);
    }

    public function export(Request $request)
    {
        $format = $request->query('format', 'xlsx');

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
        if ($request->filled('id')) {
            $ids = array_filter(explode(',', $request->input('id')));
            $query->whereIn('id', $ids);
        }

        $rows = $query->orderByDesc('tanggal')->orderByDesc('id')->get();
        $filename = 'log-apd-' . now()->format('Ymd-His');

        return $format === 'csv'
            ? $this->exportCsv($rows, $filename)
            : $this->exportXlsx($rows, $filename);
    }

    private function columns(): array
    {
        return [
            'No. Dokumen',
            'Tanggal',
            'Jenis Transaksi',
            'Keterangan Lainnya',
            'ID Karyawan',
            'Nama Karyawan',
            'Kode OK',
            'Unit Kerja',
            'Jabatan',
            'Kode APD',
            'Jenis APD',
            'Merk/Type',
            'Ukuran',
            'Qty Keluar',
            'Qty Masuk',
            'Kondisi APD Lama',
            'Pernah Tukar',
            'Alasan Penggantian',
            'Diterima Oleh',
            'Keterangan',
        ];
    }

    private function rowToArray(LogApd $row): array
    {
        return [
            $row->no_dokumen,
            optional($row->tanggal)->format('d/m/Y'),
            $row->jenis_transaksi,
            $row->keterangan_lainnya,
            $row->id_karyawan,
            $row->nama_karyawan,
            $row->kode_ok,
            $row->unit_kerja,
            $row->jabatan,
            $row->kode_apd,
            $row->jenis_apd,
            $row->merk_type,
            $row->ukuran,
            $row->qty_keluar,
            $row->qty_masuk,
            $row->kondisi_apd_lama,
            $row->pernah_tukar === null ? '-' : ($row->pernah_tukar ? 'Ya' : 'Tidak'),
            $row->alasan_penggantian,
            $row->diterima_oleh,
            $row->keterangan,
        ];
    }

    private function exportXlsx($rows, string $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Log APD');

        $columns = $this->columns();
        $sheet->fromArray($columns, null, 'A1');

        // Kolom terakhir dihitung dari jumlah header, mis. 20 kolom -> "T"
        $lastCol = Coordinate::stringFromColumnIndex(count($columns));
        $headerRange = "A1:{$lastCol}1";

        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('2D4B9E');

        $rowNum = 2;
        foreach ($rows as $row) {
            $sheet->fromArray($this->rowToArray($row), null, "A{$rowNum}");
            $rowNum++;
        }

        foreach (range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, "{$filename}.xlsx", [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    private function exportCsv($rows, string $filename)
    {
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}.csv\"",
        ];

        $columns = $this->columns();

        $callback = function () use ($rows, $columns) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $columns);

            foreach ($rows as $row) {
                fputcsv($handle, $this->rowToArray($row));
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
