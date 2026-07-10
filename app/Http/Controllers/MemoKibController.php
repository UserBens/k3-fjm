<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoKibController extends Controller
{
    public function index()
    {
        return view('memo-kib.index');
    }
}
