<?php

namespace App\Http\Controllers;

use App\Models\StokAPD;
use App\Models\StokAlkes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PusatReminderController extends Controller
{
    public function index(): View
    {
        return view('reminder.pusat-reminder');
    }

    /**
     * Data untuk Pusat Reminder & Peringatan.
     * Meniru 5 kartu ringkasan + 5 tabel detail di sheet "PUSAT REMINDER & PERINGATAN".
     *
     * Dihitung di PHP (bukan query SQL murni) karena status APD lifetime,
     * kalibrasi, dan kadaluarsa berasal dari accessor model (tanggal + parsing
     * teks masa_pakai), bukan kolom tersimpan.
     */
    public function data(): JsonResponse
    {
        $apd = StokAPD::orderBy('jenis_apd')->get();
        $alkes = StokAlkes::orderBy('jenis_alat')->get();

        $apdPerluPengadaan = $apd
            ->filter(fn($item) => $item->status === 'REORDER')
            ->map(fn($item) => [
                'kode_apd'        => $item->kode_apd,
                'jenis_apd'       => $item->jenis_apd,
                'stok_tersedia'   => $item->stok_tersedia,
                'reorder_point'   => $item->reorder_point,
                'saran_qty_pesan' => max(0, $item->reorder_point - $item->stok_tersedia),
                // Belum ada kolom EOQ di skema stok_apd saat ini.
                'eoq'             => null,
                'status'          => $item->status,
            ])
            ->values();

        $apdLifetime30 = $apd
            ->filter(fn($item) => in_array($item->lifetime_status, ['SEGERA', 'HABIS MASA'], true))
            ->map(fn($item) => [
                'kode_apd'           => $item->kode_apd,
                'jenis_apd'          => $item->jenis_apd,
                'terakhir_pengadaan' => optional($item->terakhir_pengadaan)->format('d-m-Y'),
                'masa_pakai'         => $item->masa_pakai,
                'status'             => $item->lifetime_status,
            ])
            ->values();

        $alkesStokKritis = $alkes
            ->filter(fn($item) => $item->status_stok === 'REORDER')
            ->map(fn($item) => [
                'kode_alkes'    => $item->kode_alkes,
                'jenis_alat'    => $item->jenis_alat,
                'stok_tersedia' => $item->stok_tersedia,
                'reorder_point' => $item->reorder_point,
                'status'        => $item->status_stok,
            ])
            ->values();

        $kalibrasiJatuhTempo = $alkes
            ->filter(fn($item) => in_array($item->status_kalibrasi, ['SEGERA', 'LEWAT'], true))
            ->map(fn($item) => [
                'kode_alkes'               => $item->kode_alkes,
                'jenis_alat'               => $item->jenis_alat,
                'tanggal_kalibrasi'        => optional($item->tanggal_kalibrasi)->format('d-m-Y'),
                'jadwal_kalibrasi_berikut' => optional($item->jadwal_kalibrasi_berikut)->format('d-m-Y'),
                'status'                   => $item->status_kalibrasi,
            ])
            ->values();

        $kadaluarsaJatuhTempo = $alkes
            ->filter(fn($item) => in_array($item->status_kadaluarsa, ['SEGERA', 'KADALUARSA'], true))
            ->map(fn($item) => [
                'kode_alkes'  => $item->kode_alkes,
                'jenis_alat'  => $item->jenis_alat,
                'tanggal_exp' => optional($item->tanggal_exp)->format('d-m-Y'),
                'status'      => $item->status_kadaluarsa,
            ])
            ->values();

        return response()->json([
            'summary' => [
                'apd_perlu_pengadaan'    => $apdPerluPengadaan->count(),
                'apd_lifetime_30'        => $apdLifetime30->count(),
                'alkes_stok_kritis'      => $alkesStokKritis->count(),
                'kalibrasi_jatuh_tempo'  => $kalibrasiJatuhTempo->count(),
                'kadaluarsa_jatuh_tempo' => $kadaluarsaJatuhTempo->count(),
            ],
            'apd_perlu_pengadaan'    => $apdPerluPengadaan,
            'apd_lifetime_30'        => $apdLifetime30,
            'alkes_stok_kritis'      => $alkesStokKritis,
            'kalibrasi_jatuh_tempo'  => $kalibrasiJatuhTempo,
            'kadaluarsa_jatuh_tempo' => $kadaluarsaJatuhTempo,
        ]);
    }
}
