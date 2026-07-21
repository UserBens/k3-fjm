<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardKpiController extends Controller
{
    public function index()
    {
        return view('dashboard-kpi.index');
    }
}
