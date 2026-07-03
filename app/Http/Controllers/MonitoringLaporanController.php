<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringLaporanController extends Controller
{
    public function index()
    {
        return view('monitoring-laporan.index');
    }
}
