<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringLaporanController;
use App\Http\Controllers\TenagaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'indexLogin'])->name('login');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('tenaga', [TenagaController::class, 'index'])->name('tenaga.index');
Route::get('/tenaga/api', [TenagaController::class, 'api'])->name('tenaga.api');
Route::get('monitoring-laporan', [MonitoringLaporanController::class, 'index'])->name('monitoring-laporan.index');
