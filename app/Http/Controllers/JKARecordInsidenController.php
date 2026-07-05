<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JKARecordInsidenController extends Controller
{
    public function indexDashboardInsiden()
    {
        return view('jka-record-insiden.dashboard-insiden.index');
    }

    public function indexDashboardJKA()
    {
        return view('jka-record-insiden.dashboard-jka.index');
    }

    public function indexDashboardLeading()
    {
        return view('jka-record-insiden.dashboard-leading.index');
    }
}
