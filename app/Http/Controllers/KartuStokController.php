<?php

namespace App\Http\Controllers;

use App\Services\KartuStokService;

use Illuminate\Http\Request;

class KartuStokController extends Controller
{
    public function index()
    {
        return view('kartu-stok.index');
    }

    public function data(Request $request, KartuStokService $service)
    {
        try {
            $ledger = $service->buildLedger();

            $search        = trim((string) $request->input('search', ''));
            $tipeItem      = (string) $request->input('tipe_item', '');
            $kodeItem      = (string) $request->input('kode_item', '');
            $tanggalDari   = (string) $request->input('tanggal_dari', '');
            $tanggalSampai = (string) $request->input('tanggal_sampai', '');

            $filtered = $ledger->filter(function (array $row) use ($search, $tipeItem, $kodeItem, $tanggalDari, $tanggalSampai) {
                if ($tipeItem && $row['tipe_item'] !== $tipeItem) {
                    return false;
                }
                if ($kodeItem && $row['kode_item'] !== $kodeItem) {
                    return false;
                }
                if ($tanggalDari && $row['tanggal'] && $row['tanggal'] < $tanggalDari) {
                    return false;
                }
                if ($tanggalSampai && $row['tanggal'] && $row['tanggal'] > $tanggalSampai) {
                    return false;
                }
                if ($search) {
                    $haystack = strtolower(implode(' ', [
                        $row['kode_item'],
                        $row['nama_item'],
                        $row['sumber'],
                        $row['ket_transaksi'],
                    ]));
                    if (!str_contains($haystack, strtolower($search))) {
                        return false;
                    }
                }
                return true;
            });

            // Urut per kode item lalu tanggal — supaya alur FIFO/FEFO per item terlihat berurutan,
            // persis seperti contoh kartu stok (baris 1-2 item A, lalu baris berikut item B, dst).
            $sorted = $filtered->sort(function (array $a, array $b) {
                return [$a['kode_item'], $a['tanggal']] <=> [$b['kode_item'], $b['tanggal']];
            })->values();

            $perPage  = max(1, (int) $request->input('per_page', 25));
            $total    = $sorted->count();
            $lastPage = max(1, (int) ceil($total / $perPage));
            $page     = min(max(1, (int) $request->input('page', 1)), $lastPage);
            $offset   = ($page - 1) * $perPage;

            $data = $sorted->slice($offset, $perPage)->values()->map(function (array $row, int $i) use ($offset) {
                $row['no'] = $offset + $i + 1;
                return $row;
            });

            return response()->json([
                'data' => $data,
                'meta' => [
                    'current_page' => $page,
                    'last_page'    => $lastPage,
                    'per_page'     => $perPage,
                    'total'        => $total,
                    'from'         => $total > 0 ? $offset + 1 : 0,
                    'to'           => $total > 0 ? min($offset + $perPage, $total) : 0,
                ],
                'filter_options' => [
                    'tipe_item' => ['APD', 'ALKES'],
                    'kode_item' => $ledger->pluck('kode_item')->unique()->sort()->values(),
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Gagal memuat kartu stok: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function export(Request $request, KartuStokService $service)
    {
        $ledger = $service->buildLedger()->sort(function (array $a, array $b) {
            return [$a['kode_item'], $a['tanggal']] <=> [$b['kode_item'], $b['tanggal']];
        })->values();

        $filename = 'kartu-stok-gudang-' . now()->format('Ymd-His') . '.csv';

        return response()->stream(function () use ($ledger) {
            $out = fopen('php://output', 'w');
            fputcsv($out, [
                'No',
                'Kode Item',
                'Nama Item',
                'Tanggal',
                'Sumber / No. Dok',
                'Ket. Transaksi',
                'Masuk',
                'Keluar',
                'Saldo Berjalan',
                'Tgl Exp / Ganti',
                'Catatan FIFO/FEFO',
            ]);
            foreach ($ledger as $i => $row) {
                fputcsv($out, [
                    $i + 1,
                    $row['kode_item'],
                    $row['nama_item'],
                    $row['tanggal'],
                    $row['sumber'],
                    $row['ket_transaksi'],
                    $row['masuk'],
                    $row['keluar'],
                    $row['saldo'],
                    $row['tgl_exp'],
                    $row['catatan'],
                ]);
            }
            fclose($out);
        }, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
