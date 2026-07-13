<?php

use App\Http\Controllers\AktivasiAkunController;
use App\Http\Controllers\AlatBeratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMedisController;
use App\Http\Controllers\JKARecordInsidenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemoKibController;
use App\Http\Controllers\MonitoringkpiController;
use App\Http\Controllers\MonitoringLaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\SafetyOfficerController;
use App\Http\Controllers\StokAPDController;
use App\Http\Controllers\TenagaController;
use Illuminate\Support\Facades\Route;

// ══════ LOGIN (tidak perlu auth) ══════
Route::get('/', [LoginController::class, 'indexLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth.custom'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ══════ AKTIVASI AKUN — KHUSUS ADMIN ══════
    Route::middleware(['admin.custom'])->group(function () {
        Route::get('/aktivasi-akun', [AktivasiAkunController::class, 'index'])->name('aktivasi.index');
        Route::get('/aktivasi-akun/data', [AktivasiAkunController::class, 'data'])->name('aktivasi.data');
        Route::post('/aktivasi-akun/{username}/toggle', [AktivasiAkunController::class, 'toggle'])->name('aktivasi.toggle');
    });

    // DATA TENAGA
    Route::get('tenaga', [TenagaController::class, 'index'])->name('tenaga.index');
    Route::get('/tenaga/api', [TenagaController::class, 'api'])->name('tenaga.api');
    Route::post('/tenaga/sync', [TenagaController::class, 'sync'])->name('tenaga.sync');
    Route::put('/tenaga/{id}', [TenagaController::class, 'update'])->name('tenaga.update');

    Route::get('/memo-kib', [MemoKibController::class, 'index'])->name('memo-kib.index');
    Route::get('/memo-kib/data', [MemoKibController::class, 'data'])->name('memo-kib.data');

    Route::get('/pengawas', [PengawasController::class, 'index'])->name('pengawas.index');
    Route::get('/pengawas/data', [PengawasController::class, 'data'])->name('pengawas.data');
    Route::get('/pengawas/{idApi}/pegawai', [PengawasController::class, 'pegawaiBinaan'])->name('pengawas.pegawai');

    // Route::get('/safety-officer', [SafetyOfficerController::class, 'index'])->name('safety-officer.index');
    // Route::get('/safety-officer/data', [SafetyOfficerController::class, 'data'])->name('safety-officer.data');
    // Route::delete('/safety-officer/{pegawai}', [SafetyOfficerController::class, 'destroy'])->name('safety-officer.destroy');

    Route::prefix('safety-officer')->name('safety-officer.')->group(function () {
        Route::get('/', [SafetyOfficerController::class, 'index'])->name('index');
        Route::get('/data', [SafetyOfficerController::class, 'data'])->name('data');
        Route::get('/{badge}/tenaga', [SafetyOfficerController::class, 'tenagaBinaan'])->name('tenaga');

        // Manajemen (Tab 2)
        Route::get('/list-so', [SafetyOfficerController::class, 'listSO'])->name('list-so');
        Route::get('/cari-pegawai-so', [SafetyOfficerController::class, 'cariPegawaiUntukSO'])->name('cari-pegawai-so');
        Route::post('/tetapkan', [SafetyOfficerController::class, 'tetapkanSO'])->name('tetapkan');
        Route::delete('/{badge}/lepas', [SafetyOfficerController::class, 'lepasSO'])->name('lepas');

        Route::get('/{badge}/cari-tenaga', [SafetyOfficerController::class, 'cariTenaga'])->name('cari-tenaga');
        Route::post('/{badge}/assign-tenaga', [SafetyOfficerController::class, 'assignTenaga'])->name('assign-tenaga');
        Route::delete('/{badge}/unassign-tenaga/{pegawaiId}', [SafetyOfficerController::class, 'unassignTenaga'])->name('unassign-tenaga');
    });

    Route::get('monitoring-laporan', [MonitoringLaporanController::class, 'index'])->name('monitoring-laporan.index');

    // KPI
    Route::get('data-pengawas', [MonitoringkpiController::class, 'indexDataPengawas'])->name('data-pengawas.index');

    Route::get('/data-medis', [DataMedisController::class, 'index'])->name('data-medis.index');
    Route::get('/data-medis/data', [DataMedisController::class, 'data'])->name('data-medis.data');
    Route::post('/data-medis', [DataMedisController::class, 'store'])->name('data-medis.store');
    Route::put('/data-medis/{id}', [DataMedisController::class, 'update'])->name('data-medis.update');
    Route::delete('/data-medis/{id}', [DataMedisController::class, 'destroy'])->name('data-medis.destroy');
    Route::patch('/data-medis/{id}/keputusan', [DataMedisController::class, 'updateKeputusan'])->name('laporan-kpi.keputusan');

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

    // APD
    Route::prefix('master-stok-apd')->name('master-stok-apd.')->group(function () {
        Route::get('/', [StokAPDController::class, 'index'])->name('index');
        Route::get('/data', [StokAPDController::class, 'data'])->name('data');
        Route::post('/', [StokAPDController::class, 'store'])->name('store');
        Route::put('/{stokApd}', [StokAPDController::class, 'update'])->name('update');
        Route::delete('/{stokApd}', [StokAPDController::class, 'destroy'])->name('destroy');
    });

    // MONITORING ALBER
    Route::get('alber', [AlatBeratController::class, 'index'])->name('alber.index');
    Route::get('alber-operatornonaktif', [AlatBeratController::class, 'indexOperatorNonAktif'])->name('alber.operatornonaktif');
    Route::get('alber-master-oncall', [AlatBeratController::class, 'indexMasterOncall'])->name('alber.master-oncall');
    Route::get('alber-master-allin', [AlatBeratController::class, 'indexMasterAllIn'])->name('alber.master-allin');
});
