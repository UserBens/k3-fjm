<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JKARecordInsidenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringkpiController;
use App\Http\Controllers\MonitoringLaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TenagaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'indexLogin'])->name('login');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('tenaga', [TenagaController::class, 'index'])->name('tenaga.index');
Route::get('/tenaga/api', [TenagaController::class, 'api'])->name('tenaga.api');
Route::post('/tenaga/sync', [TenagaController::class, 'sync'])->name('tenaga.sync');
Route::put('/tenaga/{id}', [TenagaController::class, 'update'])->name('tenaga.update');

Route::get('monitoring-laporan', [MonitoringLaporanController::class, 'index'])->name('monitoring-laporan.index');

// Route::get('/k3/pegawai', [PegawaiController::class, 'index'])->name('k3.pegawai.index');
// Route::put('/k3/pegawai/{id}/update-kib', [PegawaiController::class, 'updateKib'])->name('k3.pegawai.update_kib');

// KPI
Route::get('data-pengawas', [MonitoringkpiController::class, 'indexDataPengawas'])->name('data-pengawas.index');
Route::get('data-medis', [MonitoringkpiController::class, 'indexDataMedis'])->name('data-medis.index');
Route::get('data-safety', [MonitoringkpiController::class, 'indexDataSafety'])->name('data-safety.index');
Route::get('cetak-uauc', [MonitoringkpiController::class, 'indexCetakuauc'])->name('cetak-uauc.index');
Route::get('dokumen-reject', [MonitoringkpiController::class, 'indexDokumenReject'])->name('dokumen-reject.index');
Route::get('monitoring-so', [MonitoringkpiController::class, 'indexMonitoringSO'])->name('monitoring-so.index');
Route::get('dashboard-individu', [MonitoringkpiController::class, 'indexDashboardIndividu'])->name('dashboard-individu.index');
Route::get('monitoring-pengawas', [MonitoringkpiController::class, 'indexMonitoringPengawas'])->name('monitoring-pengawas.index');
Route::get('rekap-pengawas', [MonitoringkpiController::class, 'indexRekapPengawas'])->name('rekap-pengawas.index');
Route::get('monitoring-medis', [MonitoringkpiController::class, 'indexMonitoringMedis'])->name('monitoring-medis.index');
Route::get('rekap-medis', [MonitoringkpiController::class, 'indexRekapMedis'])->name('rekap-medis.index');

// JKA % RECORD INSIDEN
Route::get('dashboard-insiden', [JKARecordInsidenController::class, 'indexDashboardInsiden'])->name('dashboard-insiden.index');
Route::get('dashboard-jka', [JKARecordInsidenController::class, 'indexDashboardJKA'])->name('dashboard-jka.index');
Route::get('dashboard-leading', [JKARecordInsidenController::class, 'indexDashboardLeading'])->name('dashboard-leading.index');
