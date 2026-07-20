<?php

namespace App\Http\Controllers;

use App\Models\LogApd;
use App\Models\RabAnggaran;
use App\Models\StokAPD;
use App\Models\StokAlkes;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardApdAlkesController extends Controller
{
    public function index(): View
    {
        return view('dashboard-apd-alkes.index');
    }

    /**
     * Data ringkasan untuk kartu-kartu dashboard.
     * Mengikuti struktur 3 blok pada sheet "Dashboard":
     * Ringkasan Stok & Nilai Persediaan, Peringatan, Transaksi & Anggaran.
     */
    public function data(): JsonResponse
    {
        $apd   = StokAPD::all();
        $alkes = StokAlkes::all();

        /*
        |----------------------------------------------------------------
        | RINGKASAN STOK & NILAI PERSEDIAAN
        |----------------------------------------------------------------
        */
        $totalJenisApd = $apd->count();
        $totalStokApd  = (int) $apd->sum('stok_tersedia');

        // Nilai persediaan per item = stok_tersedia * harga_satuan (setara kolom W di Master APD)
        $nilaiPersediaanApd = $apd->sum(
            fn(StokAPD $item) => $item->stok_tersedia * (float) $item->harga_satuan
        );

        $totalJenisAlkes = $alkes->count();
        $totalStokAlkes  = (int) $alkes->sum('stok_tersedia');

        $nilaiPersediaanAlkes = $alkes->sum(
            fn(StokAlkes $item) => $item->stok_tersedia * (float) $item->harga_satuan
        );

        /*
        |----------------------------------------------------------------
        | PERINGATAN (PERLU TINDAKAN)
        |----------------------------------------------------------------
        */
        $apdPerluPengadaan = $apd->where('status', 'REORDER')->count();

        $apdLifetime30 = $apd
            ->filter(fn(StokAPD $item) => in_array($item->lifetime_status, ['SEGERA', 'HABIS MASA'], true))
            ->count();

        $alkesStokKritis = $alkes->where('status_stok', 'REORDER')->count();

        $kalibrasiJatuhTempo = $alkes
            ->filter(fn(StokAlkes $item) => in_array($item->status_kalibrasi, ['SEGERA', 'LEWAT'], true))
            ->count();

        $kadaluarsa30 = $alkes
            ->filter(fn(StokAlkes $item) => in_array($item->status_kadaluarsa, ['SEGERA', 'KADALUARSA'], true))
            ->count();

        /*
        |----------------------------------------------------------------
        | TRANSAKSI & ANGGARAN
        |----------------------------------------------------------------
        */
        $transaksiApdBulanIni = LogApd::whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->count();

        $totalNilaiPersediaan = $nilaiPersediaanApd + $nilaiPersediaanAlkes;

        $grandTotalRab = RabAnggaran::with('items')
            ->where('tahun_anggaran', (string) now()->year)
            ->get()
            ->flatMap->items
            ->sum(fn($item) => (int) $item->qty_pengadaan * (float) $item->harga_satuan);

        $totalItemKritis = $apdPerluPengadaan + $alkesStokKritis;

        // TODO: belum ada tabel setara "08_Matriks_APD" di skema saat ini.
        // Fallback sementara: jumlah kategori unik pada stok_apd (WAJIB/KHUSUS).
        $kategoriPekerjaan = $apd->pluck('kategori')->filter()->unique()->count();

        return response()->json([
            'ringkasan' => [
                'total_jenis_apd'      => $totalJenisApd,
                'total_stok_apd'       => $totalStokApd,
                'nilai_persediaan_apd' => (float) $nilaiPersediaanApd,
                'total_jenis_alkes'    => $totalJenisAlkes,
                'total_stok_alkes'     => $totalStokAlkes,
            ],
            'peringatan' => [
                'apd_perlu_pengadaan'   => $apdPerluPengadaan,
                'apd_lifetime_30'       => $apdLifetime30,
                'alkes_stok_kritis'     => $alkesStokKritis,
                'kalibrasi_jatuh_tempo' => $kalibrasiJatuhTempo,
                'kadaluarsa_30'         => $kadaluarsa30,
            ],
            'transaksi_anggaran' => [
                'transaksi_apd_bulan_ini' => $transaksiApdBulanIni,
                'total_nilai_persediaan'  => (float) $totalNilaiPersediaan,
                'grand_total_rab'         => (float) $grandTotalRab,
                'total_item_kritis'       => $totalItemKritis,
                'kategori_pekerjaan'      => $kategoriPekerjaan,
            ],
        ]);
    }
}
