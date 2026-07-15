<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PengawasIntraUser;
use App\Models\PengawasPekerjaan;
use Illuminate\Http\Request;
use App\Models\SafetyOfficerPegawai;
use Carbon\Carbon;

class MonitoringkpiController extends Controller
{
    public function indexDataPengawas()
    {
        return view('monitoring-kpi.data-pengawas.index');
    }

    public function indexDataMedis()
    {
        return view('monitoring-kpi.data-medis.index');
    }

    public function indexDataSafety()
    {
        return view('monitoring-kpi.data-safety.index');
    }

    public function indexCetakuauc()
    {
        return view('monitoring-kpi.cetak-uauc.index');
    }

    public function indexDokumenReject()
    {
        return view('monitoring-kpi.dokumen-reject.index');
    }

    public function indexMonitoringSO()
    {
        return view('monitoring-kpi.monitoring-so.index');
    }

    public function indexDashboardIndividu(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        // Ambil data Safety Officer
        $safetyOfficers = SafetyOfficerPegawai::with(['pegawai', 'safetyOfficer'])
            ->get()
            ->map(function ($so) use ($bulan, $tahun) {
                return [
                    'id' => $so->id,
                    'badge' => $so->pegawai_id ?? $so->pegawai->badge ?? 'N/A',
                    'nama' => $so->pegawai->nama ?? 'Tidak Diketahui',
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ];
            });

        // Jika ada data, gunakan yang pertama. Jika tidak, gunakan data dummy
        $selectedSO = $safetyOfficers->first() ?? (object)[
            'id' => null,
            'badge' => 'K.260061',
            'nama' => 'DWI ELLA MAGAREZA',
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return view('monitoring-kpi.dashboard-individu.kpi-dashboard', [
            'selectedSO' => $selectedSO,
            'safetyOfficers' => $safetyOfficers,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanArray' => $this->getBulanArray(),
            'tahunArray' => $this->getTahunArray(),
        ]);
    }

    public function listHseDashboardIndividu()
    {
        $badges = SafetyOfficerPegawai::query()->distinct()->pluck('badge_safety_officer');

        $list = Pegawai::whereIn('badge', $badges)
            ->get(['badge', 'nama_lengkap as nama']); // sesuaikan nama kolom nama di tabel pegawais

        return response()->json($list);
    }

    public function dataDashboardIndividu(Request $request)
    {
        $badgeHse = $request->query('badge_hse');
        $bulan    = (int) $request->query('bulan');
        $tahun    = (int) $request->query('tahun');

        // TODO: hitung 13 item KPI (target/aktual/bobot/kontribusi) untuk badge_hse
        // pada periode bulan/tahun tsb, lalu kembalikan JSON sesuai kontrak
        // (hse, summary, items[], total) yang sudah didokumentasikan di kpi-dashboard.blade.php
    }

    // MonitoringkpiController.php
    public function listPengawas()
    {
        $list = PengawasIntraUser::query()
            ->where('is_active', true)
            ->orderBy('nama_lengkap')
            ->get(['id_api', 'username', 'nama_lengkap'])
            ->map(fn($p) => [
                'id_api' => $p->id_api,
                'label'  => strtoupper($p->username . '-' . $p->nama_lengkap),
            ]);

        return response()->json($list);
    }

    public function dataMonitoringPengawas(Request $request)
    {
        $pengawasId   = $request->query('pengawas_id');   // id_api pengawas_intra_users
        $jenisLaporan = $request->query('jenis_laporan');  // opsional
        $tahun        = (int) $request->query('tahun');
        $bulan        = (int) $request->query('bulan');

        // 1. Ambil tenaga binaan pengawas via pengawas_pekerjaans
        $pegawaiIds = PengawasPekerjaan::where('pengguna_id', $pengawasId)
            ->pluck('pegawai_id');

        // 2. TODO: dari $pegawaiIds, tarik laporan KPI pada periode tahun/bulan
        //    (dan filter jenis_laporan bila diisi) dari tabel laporan KPI Anda.
        // 3. Susun items sesuai kontrak di monitoring-pengawas.blade.php
        //    dan hitung total_ditemukan = count(items).
    }

    public function indexKpiDashboard(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        // Ambil data Safety Officer
        $safetyOfficers = SafetyOfficerPegawai::with(['pegawai', 'safetyOfficer'])
            ->get()
            ->map(function ($so) use ($bulan, $tahun) {
                return [
                    'id' => $so->id,
                    'badge' => $so->pegawai_id ?? $so->pegawai->badge ?? 'N/A',
                    'nama' => $so->pegawai->nama ?? 'Tidak Diketahui',
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ];
            });

        // Jika ada data, gunakan yang pertama. Jika tidak, gunakan data dummy
        $selectedSO = $safetyOfficers->first() ?? (object)[
            'id' => null,
            'badge' => 'K.260061',
            'nama' => 'DWI ELLA MAGAREZA',
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return view('monitoring-kpi.dashboard-individu.kpi-dashboard', [
            'selectedSO' => $selectedSO,
            'safetyOfficers' => $safetyOfficers,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanArray' => $this->getBulanArray(),
            'tahunArray' => $this->getTahunArray(),
        ]);
    }

    private function getBulanArray()
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    private function getTahunArray()
    {
        $currentYear = now()->year;
        return array_combine(
            range($currentYear - 2, $currentYear + 2),
            range($currentYear - 2, $currentYear + 2)
        );
    }

    public function indexMonitoringPengawas()
    {
        $pengawas = PengawasPekerjaan::all();
        return view('monitoring-kpi.monitoring-pengawas.index', compact('pengawas'));
    }

    public function indexRekapPengawas()
    {
        return view('monitoring-kpi.rekap-pengawas.index');
    }

    public function indexMonitoringMedis()
    {
        return view('monitoring-kpi.monitoring-medis.index');
    }

    public function indexRekapMedis()
    {
        return view('monitoring-kpi.rekap-medis.index');
    }
}
