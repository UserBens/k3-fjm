<?php

namespace App\Http\Controllers;

use App\Models\LeadingInput;
use Illuminate\Http\Request;

class LeadingDashboardController extends Controller
{
    /** Halaman dashboard (view) */
    public function index()
    {
        return view('leading-dashboard.index');
    }

    /**
     * GET /leading-dashboard/api
     * Query params:
     *  - tahun   : int (default: tahun terbesar yang ada datanya, fallback tahun sekarang)
     *  - bulan   : 1-12 atau 'otomatis' (default: otomatis = bulan terakhir yang ada realisasi)
     */
    public function api(Request $request)
    {
        $tahunTersedia = LeadingInput::query()->distinct()->orderByDesc('tahun')->pluck('tahun');
        $tahun = (int) $request->get('tahun', $tahunTersedia->first() ?? now()->year);
        $tahunPembanding = $tahun - 1;

        $items = LeadingInput::where('tahun', $tahun)->where('aktif', true)
            ->orderBy('no_urut')->get();

        // "Otomatis" = bulan terakhir yang sudah ada realisasi (dari semua program)
        $autoBulan = $items->count() ? $items->max(fn($i) => $i->bulan_terkini) : now()->month;
        $autoBulan = $autoBulan ?: now()->month;

        $bulanParam = $request->get('bulan', 'otomatis');
        $bulanSd = ($bulanParam !== 'otomatis' && $bulanParam !== null && $bulanParam !== '')
            ? (int) $bulanParam
            : $autoBulan;
        $bulanSd = max(1, min(12, $bulanSd));

        // ---- Baris detail (tabel utama) ----
        $rows = $items->map(function (LeadingInput $item) use ($bulanSd) {
            $m = $this->computeMetrics($item, $bulanSd);

            return [
                'id' => $item->id,
                'no_urut' => $item->no_urut,
                'kategori' => $item->kategori,
                'nama_kegiatan' => $item->nama_kegiatan,
                'satuan' => $item->satuan,
                'target' => (float) $item->target,
                'tipe_capaian' => $item->tipe_capaian,
                'monthly' => $m['monthly'],
                'realisasi_ytd' => $m['realisasiYtd'],
                'target_ytd' => $m['targetYtd'],
                'persen_capai' => $m['persenUtama'],
                'status' => $m['status'],
            ];
        })->values();

        // ---- Kartu ringkasan ----
        $total = $rows->count();
        $tercapai = $rows->where('status.label', 'TERCAPAI')->count();
        $sebagian = $rows->where('status.label', 'SEBAGIAN')->count();
        $dibawah = $rows->where('status.label', 'DI BAWAH')->count();
        $validPersen = $rows->pluck('persen_capai')->filter(fn($v) => $v !== null);
        $skorKinerja = $validPersen->count() ? (int) round($validPersen->avg()) : 0;

        // ---- Ringkasan per kategori ----
        $kategoriSummary = $rows->groupBy('kategori')->map(function ($group, $kat) {
            $targetYtd = round($group->sum('target_ytd'), 2);
            $realisasiYtd = round($group->sum('realisasi_ytd'), 2);
            $persen = $targetYtd > 0 ? (int) round(($realisasiYtd / $targetYtd) * 100) : 0;

            return [
                'kategori' => $kat,
                'jumlah_program' => $group->count(),
                'target_ytd' => $targetYtd,
                'realisasi_ytd' => $realisasiYtd,
                'persen' => $persen,
            ];
        })->values();

        // ---- Distribusi status ----
        $statusDist = [
            ['label' => 'Tercapai', 'jumlah' => $tercapai],
            ['label' => 'Sebagian', 'jumlah' => $sebagian],
            ['label' => 'Di Bawah', 'jumlah' => $dibawah],
        ];

        // ---- Perbandingan tahun (tahun ini vs tahun-1), per kategori, bulan s/d yang sama ----
        $itemsPrev = LeadingInput::where('tahun', $tahunPembanding)->where('aktif', true)->get();
        $kategoriPrevPersen = $itemsPrev->groupBy('kategori')->map(function ($group) use ($bulanSd) {
            $targetYtd = 0;
            $realisasiYtd = 0;
            foreach ($group as $item) {
                $m = $this->computeMetrics($item, $bulanSd);
                $targetYtd += $m['targetYtd'];
                $realisasiYtd += $m['realisasiYtd'];
            }
            return $targetYtd > 0 ? (int) round(($realisasiYtd / $targetYtd) * 100) : null;
        });

        $perbandinganTahun = $kategoriSummary->map(function ($k) use ($kategoriPrevPersen) {
            $prev = $kategoriPrevPersen[$k['kategori']] ?? null;
            return [
                'kategori' => $k['kategori'],
                'th_sekarang' => $k['persen'],
                'th_pembanding' => $prev,
                'selisih' => $prev !== null ? $k['persen'] - $prev : null,
            ];
        })->values();

        // ---- Monitoring bulanan: capaian per program pada bulan terpilih ----
        $capaianPerProgramBulanIni = $items->map(function (LeadingInput $item) use ($bulanSd) {
            return [
                'nama_kegiatan' => $item->nama_kegiatan,
                'persen' => $this->monthPersen($item, $bulanSd),
            ];
        })->sortByDesc('persen')->values();

        // ---- Monitoring bulanan: jumlah program tercapai (>=100%) per bulan, sepanjang tahun ----
        $programTercapaiPerBulan = [];
        foreach (range(1, 12) as $bln) {
            $count = 0;
            foreach ($items as $item) {
                $m = $this->computeMetrics($item, $bln);
                if ($m['persenUtama'] !== null && $m['persenUtama'] >= 100) {
                    $count++;
                }
            }
            $programTercapaiPerBulan[] = $count;
        }

        return response()->json([
            'filters' => [
                'tahun' => $tahun,
                'tahun_pembanding' => $tahunPembanding,
                'bulan_sd' => $bulanSd,
                'bulan_sd_otomatis' => $bulanParam === 'otomatis' || $bulanParam === null || $bulanParam === '',
                'tahun_options' => $tahunTersedia,
            ],
            'cards' => [
                'total_program' => $total,
                'tercapai' => $tercapai,
                'sebagian' => $sebagian,
                'di_bawah' => $dibawah,
                'skor_kinerja' => $skorKinerja,
            ],
            'rows' => $rows,
            'kategori_summary' => $kategoriSummary,
            'status_distribusi' => $statusDist,
            'perbandingan_tahun' => $perbandinganTahun,
            'capaian_per_program_bulan_ini' => $capaianPerProgramBulanIni,
            'program_tercapai_per_bulan' => $programTercapaiPerBulan,
        ]);
    }

    /**
     * Hitung Realisasi YTD, Target YTD, % Capai, dan Status untuk satu LeadingInput,
     * dibatasi sampai bulan $bulanSd (mereplikasi logika accessor di model,
     * tapi bisa dibatasi bulan sesuai filter "BULAN s/d" di dashboard).
     */
    private function computeMetrics(LeadingInput $item, int $bulanSd): array
    {
        $monthlyFull = $item->monthly; // [1..12] => nilai|null
        $monthly = [];
        $lastMonth = 0;
        foreach ($monthlyFull as $bln => $val) {
            if ($bln > $bulanSd) {
                $monthly[$bln] = null; // di luar rentang filter, dianggap belum ada
                continue;
            }
            $monthly[$bln] = $val;
            if ($val !== null) {
                $lastMonth = $bln;
            }
        }

        $filled = array_filter($monthly, fn($v) => $v !== null);
        $target = (float) $item->target;
        $tipe = $item->tipe_capaian;

        if ($tipe === 'Persentase') {
            $realisasiYtd = $lastMonth ? (float) $monthly[$lastMonth] : 0.0;
            $targetYtd = $target;
        } elseif ($tipe === 'Rata-rata Bulanan') {
            $realisasiYtd = array_sum($filled);
            $targetYtd = round($target * $lastMonth, 2);
        } else { // Kumulatif Tahunan
            $realisasiYtd = array_sum($filled);
            $targetYtd = round($target * ($lastMonth / 12), 2);
        }

        if ($targetYtd <= 0) {
            $persenUtama = $realisasiYtd > 0 ? 100.0 : null;
        } else {
            $persenUtama = round(($realisasiYtd / $targetYtd) * 100);
        }

        if ($item->bulan_mulai && $lastMonth < $item->bulan_mulai && $realisasiYtd == 0) {
            $status = ['label' => 'belum jatuh tempo', 'icon' => '◷', 'class' => 'sp-gray'];
        } elseif ($persenUtama === null) {
            $status = ['label' => 'belum ada data', 'icon' => '—', 'class' => 'sp-gray'];
        } elseif ($persenUtama >= 100) {
            $status = ['label' => 'TERCAPAI', 'icon' => '✓', 'class' => 'sp-green'];
        } elseif ($persenUtama >= 70) {
            $status = ['label' => 'SEBAGIAN', 'icon' => '⚠', 'class' => 'sp-amber'];
        } else {
            $status = ['label' => 'DI BAWAH', 'icon' => '✗', 'class' => 'sp-red'];
        }

        return [
            'monthly' => $monthly,
            'realisasiYtd' => round($realisasiYtd, 2),
            'targetYtd' => round($targetYtd, 2),
            'persenUtama' => $persenUtama,
            'status' => $status,
            'lastMonth' => $lastMonth,
        ];
    }

    /**
     * % Capai untuk SATU bulan tertentu (bukan YTD) — dipakai di grafik "Capaian per Program (bulan terpilih)".
     */
    private function monthPersen(LeadingInput $item, int $bulan): ?float
    {
        $val = $item->monthly[$bulan] ?? null;
        if ($val === null) {
            return null;
        }

        $target = (float) $item->target;
        if ($target <= 0) {
            return null;
        }

        if ($item->tipe_capaian === 'Kumulatif Tahunan') {
            $targetBulan = $target / 12;
            return $targetBulan > 0 ? round(($val / $targetBulan) * 100) : null;
        }

        // Persentase & Rata-rata Bulanan: target sudah berbasis per-bulan/akhir
        return round(($val / $target) * 100);
    }
}
