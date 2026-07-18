<?php

namespace App\Services;

use App\Models\AlatKesehatanPenggunaan;
use App\Models\LogApd;
use App\Models\StokAPD;
use App\Models\StokAlkes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class KartuStokService
{
    /**
     * Bangun Kartu Stok Gudang (FIFO/FEFO) gabungan APD + Alkes.
     *
     * Saldo berjalan dihitung dari saldo_awal Master + mutasi Log,
     * diurutkan per item berdasarkan tanggal transaksi (FIFO kronologis).
     * Item baru selalu ditambahkan sebagai baris log baru, urutan tanggal
     * per item tetap terjaga karena dihitung ulang setiap request.
     *
     * @return Collection<int, array>
     */
    public function buildLedger(): Collection
    {
        return $this->buildApdLedger()->concat($this->buildAlkesLedger());
    }

    /*
    |--------------------------------------------------------------------------
    | APD — sumber: log_apd (qty_masuk & qty_keluar), saldo awal: stok_apd
    |--------------------------------------------------------------------------
    */
    protected function buildApdLedger(): Collection
    {
        $result = collect();

        StokAPD::orderBy('kode_apd')->get()->each(function (StokAPD $item) use ($result) {
            $trx = LogApd::where('stok_apd_id', $item->id)
                ->orderBy('tanggal')
                ->orderBy('id')
                ->get();

            $saldo = (int) $item->stok_awal;

            if ($trx->isEmpty()) {
                $result->push($this->rowSaldoAwalApd($item, $saldo));
                return;
            }

            foreach ($trx as $t) {
                $masuk  = (int) $t->qty_masuk;
                $keluar = (int) $t->qty_keluar;
                $saldo += $masuk - $keluar;

                $result->push([
                    'kode_item'     => $item->kode_apd,
                    'nama_item'     => $item->jenis_apd,
                    'tipe_item'     => 'APD',
                    'tanggal'       => optional($t->tanggal)->format('Y-m-d'),
                    'sumber'        => $t->no_dokumen,
                    'ket_transaksi' => $this->ketTransaksiApd($t),
                    'masuk'         => $masuk,
                    'keluar'        => $keluar,
                    'saldo'         => $saldo,
                    'tgl_exp'       => null, // stok_apd belum punya tanggal kadaluarsa asli
                    'catatan'       => $masuk > 0
                        ? 'Barang masuk (batch baru)'
                        : 'Keluar (FIFO: batch terlama dulu)',
                    'detail'        => [
                        'nama_karyawan'      => $t->nama_karyawan,
                        'id_karyawan'        => $t->id_karyawan,
                        'unit_kerja'         => $t->unit_kerja,
                        'jabatan'            => $t->jabatan,
                        'kode_ok'            => $t->kode_ok,
                        'merk_type'          => $t->merk_type,
                        'ukuran'             => $t->ukuran,
                        'no_po_pr'           => $t->no_po_pr,
                        'kondisi_apd_lama'   => $t->kondisi_apd_lama,
                        'alasan_penggantian' => $t->alasan_penggantian,
                        'diterima_oleh'      => $t->diterima_oleh,
                        'keterangan'         => $t->keterangan,
                    ],
                ]);
            }
        });

        // log_apd yang belum terhubung ke Master (stok_apd_id kosong) — mis. input manual
        // tanpa memilih dari dropdown Master — tetap ditampilkan, dikelompokkan per kode_apd,
        // dengan saldo awal 0 karena tidak ada Master untuk dijadikan acuan saldo_awal.
        LogApd::whereNull('stok_apd_id')
            ->orderBy('kode_apd')
            ->orderBy('tanggal')
            ->orderBy('id')
            ->get()
            ->groupBy(fn (LogApd $t) => $t->kode_apd ?: ('TANPA-KODE::' . $t->jenis_apd))
            ->each(function (Collection $trx) use ($result) {
                $saldo = 0;
                foreach ($trx as $t) {
                    $masuk  = (int) $t->qty_masuk;
                    $keluar = (int) $t->qty_keluar;
                    $saldo += $masuk - $keluar;

                    $result->push([
                        'kode_item'     => $t->kode_apd ?: '(Tanpa Kode)',
                        'nama_item'     => $t->jenis_apd,
                        'tipe_item'     => 'APD',
                        'tanggal'       => optional($t->tanggal)->format('Y-m-d'),
                        'sumber'        => $t->no_dokumen,
                        'ket_transaksi' => $this->ketTransaksiApd($t),
                        'masuk'         => $masuk,
                        'keluar'        => $keluar,
                        'saldo'         => $saldo,
                        'tgl_exp'       => null,
                        'catatan'       => 'Belum terhubung ke Master Stok APD',
                        'detail'        => [
                            'nama_karyawan'      => $t->nama_karyawan,
                            'id_karyawan'        => $t->id_karyawan,
                            'unit_kerja'         => $t->unit_kerja,
                            'jabatan'            => $t->jabatan,
                            'kode_ok'            => $t->kode_ok,
                            'merk_type'          => $t->merk_type,
                            'ukuran'             => $t->ukuran,
                            'no_po_pr'           => $t->no_po_pr,
                            'kondisi_apd_lama'   => $t->kondisi_apd_lama,
                            'alasan_penggantian' => $t->alasan_penggantian,
                            'diterima_oleh'      => $t->diterima_oleh,
                            'keterangan'         => $t->keterangan,
                        ],
                    ]);
                }
            });

        return $result;
    }

    protected function rowSaldoAwalApd(StokAPD $item, int $saldo): array
    {
        return [
            'kode_item'     => $item->kode_apd,
            'nama_item'     => $item->jenis_apd,
            'tipe_item'     => 'APD',
            'tanggal'       => optional($item->created_at)->format('Y-m-d'),
            'sumber'        => 'Saldo Awal Master',
            'ket_transaksi' => 'SALDO AWAL',
            'masuk'         => 0,
            'keluar'        => 0,
            'saldo'         => $saldo,
            'tgl_exp'       => null,
            'catatan'       => 'Belum ada mutasi',
            'detail'        => [],
        ];
    }

    protected function ketTransaksiApd(LogApd $t): string
    {
        return $t->qty_masuk > 0
            ? 'MASUK (' . $t->jenis_transaksi . ')'
            : 'KELUAR (' . $t->jenis_transaksi . ')';
    }

    /*
    |--------------------------------------------------------------------------
    | Alkes — sumber: alat_kesehatan_penggunaans (hanya KELUAR/pemakaian),
    | saldo awal: stok_alkes. Skema log alkes tidak punya transaksi MASUK,
    | jadi penambahan stok hanya lewat stok_awal di Master.
    |--------------------------------------------------------------------------
    */
    protected function buildAlkesLedger(): Collection
    {
        $result = collect();
        $hasKodeAlkesColumn = Schema::hasColumn('stok_alkes', 'kode_alkes');
        $hasTanggalExpColumn = Schema::hasColumn('stok_alkes', 'tanggal_exp');

        StokAlkes::orderBy('jenis_alat')->get()->each(function (StokAlkes $item) use ($result, $hasKodeAlkesColumn, $hasTanggalExpColumn) {
            $kodeItem = ($hasKodeAlkesColumn && $item->kode_alkes) ? $item->kode_alkes : $this->kodeAlkesFallback($item);
            $tglExp = $hasTanggalExpColumn && $item->tanggal_exp
                ? $item->tanggal_exp->format('Y-m-d')
                : optional($item->jadwal_kalibrasi_berikut)->format('Y-m-d');
            $labelExp = ($hasTanggalExpColumn && $item->tanggal_exp) ? 'exp' : 'kalibrasi';

            $trx = AlatKesehatanPenggunaan::where('stok_alkes_id', $item->id)
                ->orderBy('tanggal')
                ->orderBy('id')
                ->get();

            $saldo = (int) $item->stok_awal;

            if ($trx->isEmpty()) {
                $result->push([
                    'kode_item'     => $kodeItem,
                    'nama_item'     => $item->jenis_alat,
                    'tipe_item'     => 'ALKES',
                    'tanggal'       => optional($item->created_at)->format('Y-m-d'),
                    'sumber'        => 'Saldo Awal Master',
                    'ket_transaksi' => 'SALDO AWAL',
                    'masuk'         => 0,
                    'keluar'        => 0,
                    'saldo'         => $saldo,
                    'tgl_exp'       => $tglExp,
                    'catatan'       => 'Belum ada mutasi',
                    'detail'        => [],
                ]);
                return;
            }

            foreach ($trx as $t) {
                $keluar = (int) $t->jumlah_digunakan;
                $saldo -= $keluar;

                $result->push([
                    'kode_item'     => $kodeItem,
                    'nama_item'     => $item->jenis_alat,
                    'tipe_item'     => 'ALKES',
                    'tanggal'       => optional($t->tanggal)->format('Y-m-d'),
                    'sumber'        => 'Log Alkes #' . str_pad((string) $t->id, 5, '0', STR_PAD_LEFT),
                    'ket_transaksi' => 'KELUAR (Pemakaian)',
                    'masuk'         => 0,
                    'keluar'        => $keluar,
                    'saldo'         => $saldo,
                    'tgl_exp'       => $tglExp,
                    'catatan'       => $tglExp
                        ? "Batas {$labelExp} — FEFO"
                        : 'Tidak ada acuan tanggal — FIFO',
                    'detail'        => [
                        'nama_pengguna' => $t->nama_pengguna,
                        'id_karyawan'   => $t->id_karyawan,
                        'jabatan'       => $t->jabatan,
                        'unit_kerja'    => $t->unit_kerja,
                        'keterangan'    => $t->keterangan,
                    ],
                ]);
            }
        });

        return $result;
    }

    /**
     * Fallback kode item untuk Alkes selama kolom kode_alkes belum diisi/belum ada.
     * Format: ALK-{inisial jenis alat}-{id master}, mis. "ALK-GS-7".
     * Jalankan migration add_kode_dan_exp_ke_stok_alkes_table lalu isi kolom
     * kode_alkes di Master supaya kode bisa disesuaikan dengan konvensi Anda
     * sendiri (mis. ALK-CS-GS-01).
     */
    protected function kodeAlkesFallback(StokAlkes $item): string
    {
        $inisial = collect(preg_split('/\s+/', trim($item->jenis_alat)))
            ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
            ->implode('');

        return 'ALK-' . ($inisial ?: 'X') . '-' . $item->id;
    }
}