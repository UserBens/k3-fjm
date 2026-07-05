<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function indexDashboardIndividu()
    {
        return view('monitoring-kpi.dashboard-individu.index');
    }

    public function indexMonitoringPengawas()
    {
        return view('monitoring-kpi.monitoring-pengawas.index');
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
