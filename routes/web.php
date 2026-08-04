<?php

use App\Http\Controllers\AktivasiAkunController;
use App\Http\Controllers\AlatBeratController;
use App\Http\Controllers\AlatKesehatanPenggunaController;
use App\Http\Controllers\DashboardApdAlkesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKpiController;
use App\Http\Controllers\DashboardKpiK3Controller;
use App\Http\Controllers\DataMedisController;
use App\Http\Controllers\DataRejectMonitoringController;
use App\Http\Controllers\DataSafetyController;
use App\Http\Controllers\DataUnsafeController;
use App\Http\Controllers\DcuController;
use App\Http\Controllers\HiradcController;
use App\Http\Controllers\JKARecordInsidenController;
use App\Http\Controllers\KartuStokController;
use App\Http\Controllers\KodeOkController;
use App\Http\Controllers\KodeOkReferensiController;
use App\Http\Controllers\KpiK3MatriksController;
use App\Http\Controllers\LaporanCapaianKpiController;
use App\Http\Controllers\LeadingDashboardController;
use App\Http\Controllers\LeadingInputController;
use App\Http\Controllers\LogApdController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LpiKejadianController;
use App\Http\Controllers\LpiKorbanController;
use App\Http\Controllers\ManajemenApdPegawaiController;
use App\Http\Controllers\MasterHariLiburController;
use App\Http\Controllers\MasterJadwalShiftController;
use App\Http\Controllers\MatriksApdJabatanController;
use App\Http\Controllers\MemoKibController;
use App\Http\Controllers\MonitoringkpiController;
use App\Http\Controllers\MonitoringLaporanController;
use App\Http\Controllers\MonitoringLaporanSoController;
use App\Http\Controllers\OperatorAlatBeratController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelaporanPengawasController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PengembalianKibApdController;
use App\Http\Controllers\PermintaanPembelianController;
use App\Http\Controllers\PusatReminderController;
use App\Http\Controllers\RabAnggaranController;
use App\Http\Controllers\ReferensiKodeOkController;
use App\Http\Controllers\RegistrasiK3Controller;
use App\Http\Controllers\RencanaPelatihanK3Controller;
use App\Http\Controllers\SafetyOfficerController;
use App\Http\Controllers\StokAPDController;
use App\Http\Controllers\StokAlkesController;
use App\Http\Controllers\SupplierApdController;
use App\Http\Controllers\TenagaController;
use App\Http\Controllers\ToolboxMeetingController;
use Illuminate\Support\Facades\Route;

// ══════ LOGIN (tidak perlu auth) ══════
Route::get('/', [LoginController::class, 'indexLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth.custom'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ROLE SUPER ADMIN
    Route::middleware(['role.custom:super_admin'])->group(function () {
        // ══════ AKTIVASI AKUN — KHUSUS ADMIN ══════
        Route::get('/aktivasi-akun', [AktivasiAkunController::class, 'index'])->name('aktivasi.index');
        Route::get('/aktivasi-akun/data', [AktivasiAkunController::class, 'data'])->name('aktivasi.data');
        Route::post('/aktivasi-akun/{username}/toggle', [AktivasiAkunController::class, 'toggle'])->name('aktivasi.toggle');


        // DATA TENAGA
        Route::get('tenaga', [TenagaController::class, 'index'])->name('tenaga.index');
        Route::get('/tenaga/api', [TenagaController::class, 'api'])->name('tenaga.api');
        Route::post('/tenaga/sync', [TenagaController::class, 'sync'])->name('tenaga.sync');
        Route::put('/tenaga/{id}', [TenagaController::class, 'update'])->name('tenaga.update');

        // MASTER KODE OK
        Route::prefix('kode-ok')->name('kode-ok.')->group(function () {
            Route::get('/', [KodeOkController::class, 'index'])->name('index');
            Route::get('/data', [KodeOkController::class, 'apiIndex'])->name('api');
            Route::get('/options', [KodeOkController::class, 'options'])->name('options'); // ← BARU
            Route::post('/sync', [KodeOkController::class, 'sync'])->name('sync');
            Route::post('/', [KodeOkController::class, 'store'])->name('store');
            Route::get('/{kodeOk}', [KodeOkController::class, 'show'])->name('show');
            Route::put('/{kodeOk}', [KodeOkController::class, 'update'])->name('update');
            Route::delete('/{kodeOk}', [KodeOkController::class, 'destroy'])->name('destroy');
        });

        // DATA PENGAWAS
        Route::get('/pengawas', [PengawasController::class, 'index'])->name('pengawas.index');
        Route::get('/pengawas/data', [PengawasController::class, 'data'])->name('pengawas.data');
        Route::get('/pengawas/{idApi}/pegawai', [PengawasController::class, 'pegawaiBinaan'])->name('pengawas.pegawai');

        // DATA SAFETY OFFICER
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

        // KPI 
        // MATRIKS AKTIVITAS KPI K3 & PENGATURAN
        Route::prefix('kpi-k3/matriks')->name('kpi-k3.matriks.')->group(function () {
            Route::get('/', [KpiK3MatriksController::class, 'index'])->name('index');
            Route::get('/api', [KpiK3MatriksController::class, 'api'])->name('api');
            Route::post('/', [KpiK3MatriksController::class, 'store'])->name('store');
            Route::put('/{aktivitasKpiK3}', [KpiK3MatriksController::class, 'update'])->name('update');
            Route::delete('/{aktivitasKpiK3}', [KpiK3MatriksController::class, 'destroy'])->name('destroy');
        });

        Route::put('kpi-k3/pengaturan', [KpiK3MatriksController::class, 'updatePengaturan'])->name('kpi-k3.pengaturan.update');

        // MONITORING LAPORAN (Medis, Safety, Pengawas)
        Route::prefix('monitoring-laporan')->name('monitoring-laporan.')->group(function () {
            Route::get('/', [MonitoringLaporanController::class, 'index'])->name('index');
            Route::get('/data', [MonitoringLaporanController::class, 'data'])->name('data');
            Route::get('/{sumber}/{id}', [MonitoringLaporanController::class, 'detail'])
                ->where(['sumber' => 'medis|safety|pengawas|MEDIS|SAFETY|PENGAWAS', 'id' => '[0-9]+'])
                ->name('detail');
            Route::patch('/{sumber}/{id}/status', [MonitoringLaporanController::class, 'updateStatus'])
                ->where(['sumber' => 'medis|safety|pengawas|MEDIS|SAFETY|PENGAWAS', 'id' => '[0-9]+'])
                ->name('update-status');
        });

        // UA/UC
        Route::get('/data-unsafe', [DataUnsafeController::class, 'index'])->name('data-unsafe.index');
        Route::get('/data-unsafe/data', [DataUnsafeController::class, 'data'])->name('data-unsafe.data');
        Route::post('/data-unsafe', [DataUnsafeController::class, 'store'])->name('data-unsafe.store');
        Route::put('/data-unsafe/{dataUnsafe}', [DataUnsafeController::class, 'update'])->name('data-unsafe.update');
        Route::delete('/data-unsafe/{dataUnsafe}', [DataUnsafeController::class, 'destroy'])->name('data-unsafe.destroy');
        Route::get('/data-unsafe/cari-so', [DataUnsafeController::class, 'cariSafetyOfficer'])->name('data-unsafe.cari-so');

        // TBM
        Route::get('/toolbox-meeting', [ToolboxMeetingController::class, 'index'])->name('toolbox-meeting.index');
        Route::get('/toolbox-meeting/data', [ToolboxMeetingController::class, 'data'])->name('tbm.data');
        Route::post('/toolbox-meeting', [ToolboxMeetingController::class, 'store'])->name('tbm.store');
        Route::put('/toolbox-meeting/{toolboxMeeting}', [ToolboxMeetingController::class, 'update'])->name('tbm.update');
        Route::delete('/toolbox-meeting/{toolboxMeeting}', [ToolboxMeetingController::class, 'destroy'])->name('tbm.destroy');
        Route::get('/toolbox-meeting/cari-so', [ToolboxMeetingController::class, 'cariSafetyOfficer'])->name('tbm.cari-so');

        // JKA
        // LPI KEJADIAN
        Route::get('/lpi-kejadian', [LpiKejadianController::class, 'index'])->name('lpi-kejadian.index');
        Route::get('/lpi-kejadian/data', [LpiKejadianController::class, 'data'])->name('lpi-kejadian.data');
        Route::get('/lpi-kejadian/{lpiKejadian}', [LpiKejadianController::class, 'show'])->name('lpi-kejadian.show');
        Route::get('/lpi-kejadian/{lpiKejadian}/detail', [LpiKejadianController::class, 'detail'])->name('lpi-kejadian.detail');
        Route::post('/lpi-kejadian', [LpiKejadianController::class, 'store'])->name('lpi-kejadian.store');
        Route::put('/lpi-kejadian/{lpiKejadian}', [LpiKejadianController::class, 'update'])->name('lpi-kejadian.update');
        Route::delete('/lpi-kejadian/{lpiKejadian}', [LpiKejadianController::class, 'destroy'])->name('lpi-kejadian.destroy');

        // LPI KORBAN
        Route::get('/lpi-kejadian/{lpiKejadian}/korban', [LpiKorbanController::class, 'data'])->name('lpi-korban.data');
        Route::post('/lpi-kejadian/{lpiKejadian}/korban', [LpiKorbanController::class, 'store'])->name('lpi-korban.store');
        Route::put('/lpi-korban/{lpiKorban}', [LpiKorbanController::class, 'update'])->name('lpi-korban.update');
        Route::delete('/lpi-korban/{lpiKorban}', [LpiKorbanController::class, 'destroy'])->name('lpi-korban.destroy');
        Route::get('/lpi-korban/cari-karyawan', [LpiKorbanController::class, 'cariKaryawan'])->name('lpi-korban.cari-karyawan');

        // APD
        Route::prefix('master-stok-apd')->name('master-stok-apd.')->group(function () {
            Route::get('/', [StokAPDController::class, 'index'])->name('index');
            Route::get('/data', [StokAPDController::class, 'data'])->name('data');
            Route::get('/kode-ok-options', [StokAPDController::class, 'kodeOkOptions'])->name('kode-ok-options'); // baru
            Route::get('/supplier-options', [StokAPDController::class, 'supplierOptions'])->name('supplier-options');
            Route::post('/', [StokAPDController::class, 'store'])->name('store');
            Route::put('/{stokApd}', [StokAPDController::class, 'update'])->name('update');
            Route::delete('/{stokApd}', [StokAPDController::class, 'destroy'])->name('destroy');
        });

        // PEMETAAN APD TENAGA KERJA
        Route::prefix('pemetaan-apd')->name('pemetaan-apd.')->group(function () {
            Route::get('/', [ManajemenApdPegawaiController::class, 'index'])->name('index');
            Route::get('/data', [ManajemenApdPegawaiController::class, 'data'])->name('data');
            Route::get('/{id}', [ManajemenApdPegawaiController::class, 'show'])->name('show');
        });

        // LOG APD
        Route::prefix('log-apd')->name('log-apd.')->group(function () {
            Route::get('/', [LogApdController::class, 'index'])->name('index');
            Route::get('/data', [LogApdController::class, 'data'])->name('data');
            Route::get('/export', [LogApdController::class, 'export'])->name('export'); // baru
            Route::get('/apd-options', [LogApdController::class, 'apdOptions'])->name('apd-options');
            Route::get('/kode-ok-options', [LogApdController::class, 'kodeOkOptions'])->name('kode-ok-options');
            Route::get('/riwayat-tukar', [LogApdController::class, 'riwayatTukar'])->name('riwayat-tukar'); // baru
            Route::get('/cari-pegawai', [LogApdController::class, 'cariPegawai'])->name('cari-pegawai');
            Route::post('/', [LogApdController::class, 'store'])->name('store');
            Route::put('/{logApd}', [LogApdController::class, 'update'])->name('update');
            Route::delete('/{logApd}', [LogApdController::class, 'destroy'])->name('destroy');
        });

        // ALKES
        Route::prefix('master-stok-alkes')->name('master-stok-alkes.')->group(function () {
            Route::get('/', [StokAlkesController::class, 'index'])->name('index');
            Route::get('/data', [StokAlkesController::class, 'data'])->name('data');
            Route::get('/supplier-options', [StokAlkesController::class, 'supplierOptions'])->name('supplier-options');
            Route::get('/kode-ok-options', [StokAlkesController::class, 'kodeOkOptions'])->name('kode-ok-options'); // ← baru
            Route::post('/', [StokAlkesController::class, 'store'])->name('store');
            Route::put('/{stokAlkes}', [StokAlkesController::class, 'update'])->name('update');
            Route::delete('/{stokAlkes}', [StokAlkesController::class, 'destroy'])->name('destroy');
        });

        // LOG ALKES
        Route::prefix('penggunaan-alkes')->name('penggunaan-alkes.')->group(function () {
            Route::get('/', [AlatKesehatanPenggunaController::class, 'index'])->name('index');
            Route::get('/data', [AlatKesehatanPenggunaController::class, 'data'])->name('data');
            Route::post('/', [AlatKesehatanPenggunaController::class, 'store'])->name('store');
            Route::put('/{alatKesehatanPenggunaan}', [AlatKesehatanPenggunaController::class, 'update'])->name('update');
            Route::delete('/{alatKesehatanPenggunaan}', [AlatKesehatanPenggunaController::class, 'destroy'])->name('destroy');
            Route::get('/cari-pegawai', [AlatKesehatanPenggunaController::class, 'cariPegawai'])->name('cari-pegawai');
            Route::get('/cari-alat', [AlatKesehatanPenggunaController::class, 'cariAlat'])->name('cari-alat');
            Route::get('/daftar-alat', [AlatKesehatanPenggunaController::class, 'daftarAlat'])->name('daftar-alat');
        });
    });



    Route::get('/memo-kib', [MemoKibController::class, 'index'])->name('memo-kib.index');
    Route::get('/memo-kib/data', [MemoKibController::class, 'data'])->name('memo-kib.data');

    // DATA PELAPORAN
    Route::get('monitoring-laporan', [MonitoringLaporanController::class, 'index'])->name('monitoring-laporan.index');

    // KPI
    // DASHBOARD KPI
    Route::get('/dashboard-kpi-k3', [DashboardKpiK3Controller::class, 'index'])
        ->name('dashboard-kpi-k3.index');
    Route::get('/api/dashboard-kpi-k3', [DashboardKpiK3Controller::class, 'api'])
        ->name('dashboard-kpi-k3.api');

    // LAPORAN KPI
    Route::get('/laporan-capaian-kpi', [LaporanCapaianKpiController::class, 'index'])->name('laporan-capaian-kpi.index');
    Route::get('/laporan-capaian-kpi/api', [LaporanCapaianKpiController::class, 'api'])->name('laporan-capaian-kpi.api');

    // HALAMAN MANAJEMEN MASTER JADWAL SHIFT
    Route::get('master-jadwal-shift', [MasterJadwalShiftController::class, 'index'])
        ->name('master-jadwal-shift.index');

    Route::prefix('master-jadwal-shift')->name('master-jadwal-shift.')->group(function () {
        Route::get('/data', [MasterJadwalShiftController::class, 'data'])->name('data');
        Route::post('/', [MasterJadwalShiftController::class, 'store'])->name('store');
        Route::put('/{masterJadwalShift}', [MasterJadwalShiftController::class, 'update'])->name('update');
        Route::delete('/{masterJadwalShift}', [MasterJadwalShiftController::class, 'destroy'])->name('destroy');

        // import & template
        Route::post('/import', [MasterJadwalShiftController::class, 'import'])->name('import');
        Route::get('/template', [MasterJadwalShiftController::class, 'downloadTemplate'])->name('template');
    });

    // MASTER HARI LIBUR
    Route::get('master-hari-libur', [MasterHariLiburController::class, 'index'])
        ->name('master-hari-libur.index');

    Route::prefix('master-hari-libur')->name('master-hari-libur.')->group(function () {
        Route::get('/data', [MasterHariLiburController::class, 'data'])->name('data');
        Route::get('/tahun', [MasterHariLiburController::class, 'tahunList'])->name('tahun');

        Route::post('/', [MasterHariLiburController::class, 'store'])->name('store');
        Route::put('/{masterHariLibur}', [MasterHariLiburController::class, 'update'])->name('update');
        Route::delete('/{masterHariLibur}', [MasterHariLiburController::class, 'destroy'])->name('destroy');

        // import & template
        Route::post('/import', [MasterHariLiburController::class, 'import'])->name('import');
        Route::get('/template', [MasterHariLiburController::class, 'downloadTemplate'])->name('template');
    });

    Route::get('data-pengawas', [MonitoringkpiController::class, 'indexDataPengawas'])->name('data-pengawas.index');

    // ROLE MEDIS
    Route::middleware(['role.custom:medis'])->group(function () {
        // DATA MEDIS
        Route::get('/data-medis', [DataMedisController::class, 'index'])->name('data-medis.index');
        Route::get('/data-medis/data', [DataMedisController::class, 'data'])->name('data-medis.data');
        Route::get('/data-medis/jenis-aktivitas-options', [DataMedisController::class, 'jenisAktivitasOptions'])->name('data-medis.jenis-aktivitas-options'); // ← BARU
        Route::get('/data-medis/lokasi-kerja-options', [DataMedisController::class, 'lokasiKerjaOptions'])->name('data-medis.lokasi-kerja-options'); // ← BARU
        Route::post('/data-medis', [DataMedisController::class, 'store'])->name('data-medis.store');
        Route::put('/data-medis/{id}', [DataMedisController::class, 'update'])->name('data-medis.update');
        Route::delete('/data-medis/{id}', [DataMedisController::class, 'destroy'])->name('data-medis.destroy');
        Route::patch('/data-medis/{id}/keputusan', [DataMedisController::class, 'updateKeputusan'])->name('laporan-kpi.keputusan');
        Route::get('/data-medis/cari-tenaga', [DataMedisController::class, 'cariTenagaMedis'])->name('data-medis.cari-tenaga');
    });

    // ROLE SAFETY
    Route::middleware(['role.custom:safety'])->prefix('data-safety')->name('data-safety.')->group(function () {
        // DATA SAFETY
        Route::get('/', [DataSafetyController::class, 'index'])->name('index');
        Route::get('/data', [DataSafetyController::class, 'data'])->name('data');
        Route::get('/lokasi-kerja-options', [DataSafetyController::class, 'lokasiKerjaOptions'])->name('lokasi-kerja-options'); // ← BARU
        Route::get('/sub-area-options', [DataSafetyController::class, 'subAreaOptions'])->name('sub-area-options'); // ← BARU
        Route::get('/jenis-aktivitas-options', [DataSafetyController::class, 'jenisAktivitasOptions'])->name('jenis-aktivitas-options');
        Route::post('/', [DataSafetyController::class, 'store'])->name('store');
        Route::put('/{dataSafety}', [DataSafetyController::class, 'update'])->name('update');
        Route::delete('/{dataSafety}', [DataSafetyController::class, 'destroy'])->name('destroy');
        Route::get('/cari-tenaga', [DataSafetyController::class, 'cariTenaga'])->name('cari-tenaga');
    });


    Route::get('/data-reject-monitoring', [DataRejectMonitoringController::class, 'index'])->name('data-reject-monitoring.index');
    Route::get('/data-reject-monitoring/data', [DataRejectMonitoringController::class, 'data'])->name('data-reject-monitoring.data');
    Route::post('/data-reject-monitoring', [DataRejectMonitoringController::class, 'store'])->name('data-reject-monitoring.store');
    Route::put('/data-reject-monitoring/{dataRejectMonitoring}', [DataRejectMonitoringController::class, 'update'])->name('data-reject-monitoring.update');
    Route::delete('/data-reject-monitoring/{dataRejectMonitoring}', [DataRejectMonitoringController::class, 'destroy'])->name('data-reject-monitoring.destroy');
    Route::get('/data-reject-monitoring/cari-pelapor', [DataRejectMonitoringController::class, 'cariPelapor'])->name('data-reject-monitoring.cari-pelapor');

    Route::prefix('monitoring-laporan-so')->name('monitoring-laporan-so.')->group(function () {
        Route::get('/', [MonitoringLaporanSoController::class, 'index'])->name('index');
        Route::get('/data', [MonitoringLaporanSoController::class, 'data'])->name('data');
        Route::post('/', [MonitoringLaporanSoController::class, 'store'])->name('store');
        Route::put('/{dataUnsafe}', [MonitoringLaporanSoController::class, 'update'])->name('update');
        Route::patch('/{dataUnsafe}/status', [MonitoringLaporanSoController::class, 'updateStatus'])->name('status');
        Route::patch('/{dataUnsafe}/keputusan', [MonitoringLaporanSoController::class, 'updateKeputusan'])->name('keputusan');
        Route::delete('/{dataUnsafe}', [MonitoringLaporanSoController::class, 'destroy'])->name('destroy');
        Route::get('/daftar-so', [MonitoringLaporanSoController::class, 'daftarSafetyOfficer'])->name('daftar-so');
        Route::get('/cari-so', [MonitoringLaporanSoController::class, 'cariSafetyOfficer'])->name('cari-so');
    });

    Route::prefix('dashboard-individu')
        ->name('dashboard-individu.')
        ->group(function () {

            Route::get('/', [MonitoringkpiController::class, 'indexDashboardIndividu'])
                ->name('index');

            Route::get('/list-hse', [MonitoringkpiController::class, 'listHseDashboardIndividu'])
                ->name('list-hse');

            Route::get('/data', [MonitoringkpiController::class, 'dataDashboardIndividu'])
                ->name('data');
        });


    Route::get('rekap-pengawas', [MonitoringkpiController::class, 'indexRekapPengawas'])->name('rekap-pengawas.index');
    Route::get('monitoring-medis', [MonitoringkpiController::class, 'indexMonitoringMedis'])->name('monitoring-medis.index');
    Route::get('rekap-medis', [MonitoringkpiController::class, 'indexRekapMedis'])->name('rekap-medis.index');

    // JKA & RECORD INSIDEN
    Route::get('dashboard-insiden', [JKARecordInsidenController::class, 'indexDashboardInsiden'])->name('dashboard-insiden.index');

    Route::get('dashboard-jka', [JKARecordInsidenController::class, 'indexDashboardJKA'])->name('dashboard-jka.index');
    Route::get('dashboard-leading', [JKARecordInsidenController::class, 'indexDashboardLeading'])->name('dashboard-leading.index');

    // LEADING INPUT
    Route::prefix('leading-input')->name('leading-input.')->group(function () {
        Route::get('/', [LeadingInputController::class, 'index'])->name('index');
        Route::get('/api', [LeadingInputController::class, 'api'])->name('api');
        Route::post('/', [LeadingInputController::class, 'store'])->name('store');
        Route::put('/{leadingInput}', [LeadingInputController::class, 'update'])->name('update');
        Route::delete('/{leadingInput}', [LeadingInputController::class, 'destroy'])->name('destroy');
    });

    // RENCANA PELATIHAN K3
    Route::prefix('rencana-pelatihan-k3')
        ->name('rencana-pelatihan-k3.')
        ->group(function () {
            Route::get('/', [RencanaPelatihanK3Controller::class, 'index'])->name('index');
            Route::get('/data', [RencanaPelatihanK3Controller::class, 'data'])->name('data');
            Route::post('/', [RencanaPelatihanK3Controller::class, 'store'])->name('store');
            Route::put('/{rencanaPelatihanK3}', [RencanaPelatihanK3Controller::class, 'update'])->name('update');
            Route::delete('/{rencanaPelatihanK3}', [RencanaPelatihanK3Controller::class, 'destroy'])->name('destroy');
        });

    // Dashboard Leading
    Route::get('/leading-dashboard', [LeadingDashboardController::class, 'index'])
        ->name('leading-dashboard.index');
    Route::get('/leading-dashboard/api', [LeadingDashboardController::class, 'api'])
        ->name('leading-dashboard.api');

    // KODE OK REFRENSI
    Route::prefix('kode-ok-referensi')->name('kode-ok-referensi.')->group(function () {
        Route::get('/', [KodeOkReferensiController::class, 'index'])->name('index');
        Route::get('/data', [KodeOkReferensiController::class, 'data'])->name('data');
        Route::get('/apd-options', [KodeOkReferensiController::class, 'apdOptions'])->name('apd-options');
        Route::get('/kode-ok-options', [KodeOkReferensiController::class, 'kodeOkOptions'])->name('kode-ok-options');
        Route::post('/', [KodeOkReferensiController::class, 'store'])->name('store');
        Route::put('/{kodeOkReferensi}', [KodeOkReferensiController::class, 'update'])->name('update');
        Route::delete('/{kodeOkReferensi}', [KodeOkReferensiController::class, 'destroy'])->name('destroy');
    });

    Route::get('/dashboard-apd-alkes', [DashboardApdAlkesController::class, 'index'])
        ->name('dashboard-apd-alkes.index');

    Route::get('/dashboard-apd-alkes/data', [DashboardApdAlkesController::class, 'data'])
        ->name('dashboard-apd-alkes.data');



    // KARTU STOK
    Route::prefix('kartu-stok')->name('kartu-stok.')->group(function () {
        Route::get('/', [KartuStokController::class, 'index'])->name('index');
        Route::get('/data', [KartuStokController::class, 'data'])->name('data');
        Route::get('/export', [KartuStokController::class, 'export'])->name('export');
    });

    // PUSAT REMINDER
    Route::get('/pusat-reminder', [PusatReminderController::class, 'index'])
        ->name('pusat-reminder.index');

    Route::get('/pusat-reminder/data', [PusatReminderController::class, 'data'])
        ->name('pusat-reminder.data');

    // SUPPLIER APD & ALKES
    Route::prefix('master-supplier-apd')->name('master-supplier-apd.')->group(function () {
        Route::get('/', [SupplierApdController::class, 'index'])->name('index');
        Route::get('/data', [SupplierApdController::class, 'data'])->name('data');
        Route::post('/', [SupplierApdController::class, 'store'])->name('store');
        Route::put('/{supplierApd}', [SupplierApdController::class, 'update'])->name('update');
        Route::delete('/{supplierApd}', [SupplierApdController::class, 'destroy'])->name('destroy');
    });

    // RAB
    Route::prefix('rab-anggaran')->name('rab-anggaran.')->group(function () {
        Route::get('/', [RabAnggaranController::class, 'index'])->name('index');
        Route::get('/data', [RabAnggaranController::class, 'data'])->name('data');
        Route::get('/apd-options', [RabAnggaranController::class, 'apdOptions'])->name('apd-options');
        Route::get('/alkes-options', [RabAnggaranController::class, 'alkesOptions'])->name('alkes-options');
        Route::post('/', [RabAnggaranController::class, 'store'])->name('store');
        Route::put('/{rabAnggaran}', [RabAnggaranController::class, 'update'])->name('update');
        Route::delete('/{rabAnggaran}', [RabAnggaranController::class, 'destroy'])->name('destroy');

        // Halaman & data detail (Tabel A APD + Tabel B Alkes)
        Route::get('/{rabAnggaran}/detail', [RabAnggaranController::class, 'show'])->name('detail');
        Route::get('/{rabAnggaran}/detail-data', [RabAnggaranController::class, 'detailData'])->name('detail-data');
        Route::get('/{rabAnggaran}/export', [RabAnggaranController::class, 'exportExcel'])->name('export');
        Route::post('/{rabAnggaran}/items', [RabAnggaranController::class, 'storeItem'])->name('items.store');
        Route::put('/items/{item}', [RabAnggaranController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{item}', [RabAnggaranController::class, 'destroyItem'])->name('items.destroy');
    });

    // HIRADC
    Route::prefix('hiradc')->name('hiradc.')->group(function () {
        Route::get('/', [HiradcController::class, 'index'])->name('index');
        Route::get('/data', [HiradcController::class, 'data'])->name('data');
        Route::get('/kode-ok/options', [HiradcController::class, 'kodeOkOptions'])->name('kodeOk.options'); // ← diganti
        Route::get('/apd/options', [HiradcController::class, 'apdOptions'])->name('apd.options'); // ← baru
        Route::get('/{hiradc}', [HiradcController::class, 'show'])->name('show');
        Route::post('/', [HiradcController::class, 'store'])->name('store');
        Route::put('/{hiradc}', [HiradcController::class, 'update'])->name('update');
        Route::delete('/{hiradc}', [HiradcController::class, 'destroy'])->name('destroy');
        Route::put('/{hiradc}/periksa', [HiradcController::class, 'periksa'])->name('periksa');
        Route::put('/{hiradc}/sahkan', [HiradcController::class, 'sahkan'])->name('sahkan');
    });

    // MATRIKS APD JABATAN
    Route::prefix('matriks-apd-jabatan')->name('matriks-apd-jabatan.')->group(function () {
        Route::get('/', [MatriksApdJabatanController::class, 'index'])->name('index');
        Route::get('/data', [MatriksApdJabatanController::class, 'data'])->name('data');
        Route::post('/', [MatriksApdJabatanController::class, 'store'])->name('store');
        Route::put('/{matriksApdJabatan}', [MatriksApdJabatanController::class, 'update'])->name('update');
        Route::delete('/{matriksApdJabatan}', [MatriksApdJabatanController::class, 'destroy'])->name('destroy');
    });

    // PERMINTAAN PEMBELIAN
    Route::prefix('permintaan-pembelian')->name('permintaan-pembelian.')->group(function () {
        Route::get('/', [PermintaanPembelianController::class, 'index'])->name('index');
        Route::get('/data', [PermintaanPembelianController::class, 'data'])->name('data');
        Route::get('/unit-kerja-options', [PermintaanPembelianController::class, 'unitKerjaOptions'])->name('unit-kerja-options'); // ← baru
        Route::get('/cari-pegawai', [PermintaanPembelianController::class, 'cariPegawai'])->name('cari-pegawai'); // ← baru
        Route::get('/daftar-apd', [PermintaanPembelianController::class, 'daftarApd'])->name('daftar-apd'); // ← baru
        Route::post('/', [PermintaanPembelianController::class, 'store'])->name('store');
        Route::put('/{item}', [PermintaanPembelianController::class, 'update'])->name('update');
        Route::delete('/{item}', [PermintaanPembelianController::class, 'destroy'])->name('destroy');
    });

    // MONITORING ALBER
    Route::prefix('operator-alat-berat')->name('operator-alat-berat.')->group(function () {
        Route::get('/', [OperatorAlatBeratController::class, 'index'])->name('index');
        Route::get('/data', [OperatorAlatBeratController::class, 'data'])->name('data');
        Route::get('/area-kerja-options', [OperatorAlatBeratController::class, 'areaKerjaOptions'])->name('area-kerja-options');
        Route::get('/kualifikasi-options', [OperatorAlatBeratController::class, 'kualifikasiOptions'])->name('kualifikasi-options');
        Route::get('/kode-ok-options', [OperatorAlatBeratController::class, 'kodeOkOptions'])->name('kode-ok-options');
        Route::get('/cari-pegawai', [OperatorAlatBeratController::class, 'cariPegawai'])->name('cari-pegawai');
        Route::post('/', [OperatorAlatBeratController::class, 'store'])->name('store');
        Route::put('/{id}', [OperatorAlatBeratController::class, 'update'])->name('update');
        Route::delete('/{id}', [OperatorAlatBeratController::class, 'destroy'])->name('destroy');
    });

    // DATA-DCU
    Route::prefix('data-dcu')->name('dcu.')->group(function () {
        Route::get('/', [DcuController::class, 'index'])->name('index');
        Route::get('/data', [DcuController::class, 'data'])->name('data');
        Route::post('/', [DcuController::class, 'store'])->name('store');
        Route::put('/{dcu}', [DcuController::class, 'update'])->name('update');
        Route::delete('/{dcu}', [DcuController::class, 'destroy'])->name('destroy');
        Route::get('/cari-pegawai', [DcuController::class, 'cariPegawai'])->name('cari-pegawai');
    });

    // REGISTRASI K3
    Route::prefix('registrasi-k3')->name('registrasi-k3.')->group(function () {
        Route::get('/', [RegistrasiK3Controller::class, 'index'])->name('index');
        Route::get('/data', [RegistrasiK3Controller::class, 'data'])->name('data');
        Route::get('/lokasi-kerja-options', [RegistrasiK3Controller::class, 'lokasiKerjaOptions'])->name('lokasi-kerja-options');
        Route::get('/unit-kerja-options', [RegistrasiK3Controller::class, 'unitKerjaOptions'])->name('unit-kerja-options');
        Route::get('/jabatan-options', [RegistrasiK3Controller::class, 'jabatanOptions'])->name('jabatan-options');
        Route::get('/apd-options', [RegistrasiK3Controller::class, 'apdOptions'])->name('apd-options');
        Route::get('/cari-pegawai', [RegistrasiK3Controller::class, 'cariPegawai'])->name('cari-pegawai');
        Route::post('/', [RegistrasiK3Controller::class, 'store'])->name('store');
        Route::put('/{id}', [RegistrasiK3Controller::class, 'update'])->name('update');
    });

    // PENGEMBALIAN KIB & APD K3
    Route::prefix('pengembalian-kib-apd')->name('pengembalian-kib-apd.')->group(function () {
        Route::get('/', [PengembalianKibApdController::class, 'index'])->name('index');
        Route::get('/data', [PengembalianKibApdController::class, 'data'])->name('data');
        Route::get('/apd-options', [PengembalianKibApdController::class, 'apdOptions'])->name('apd-options');
        Route::get('/cari-pegawai', [PengembalianKibApdController::class, 'cariPegawai'])->name('cari-pegawai');
        Route::post('/', [PengembalianKibApdController::class, 'store'])->name('store');
        Route::put('/{pengembalianKibApd}', [PengembalianKibApdController::class, 'update'])->name('update');
        Route::delete('/{pengembalianKibApd}', [PengembalianKibApdController::class, 'destroy'])->name('destroy');
    });



    // ROLE PENGAWAS
    Route::middleware(['role.custom:pengawas'])->prefix('pelaporan-pengawas')->name('pelaporan-pengawas.')->group(function () {
        Route::get('/', [PelaporanPengawasController::class, 'index'])->name('index');
        Route::get('/data', [PelaporanPengawasController::class, 'data'])->name('data');
        Route::get('/lokasi-kerja-options', [PelaporanPengawasController::class, 'lokasiKerjaOptions'])->name('lokasi-kerja-options');
        Route::get('/unit-kerja-options', [PelaporanPengawasController::class, 'unitKerjaOptions'])->name('unit-kerja-options');
        Route::get('/jenis-aktivitas-options', [PelaporanPengawasController::class, 'jenisAktivitasOptions'])->name('jenis-aktivitas-options');
        Route::get('/cari-pengawas', [PelaporanPengawasController::class, 'cariPengawas'])->name('cari-pengawas');
        Route::post('/', [PelaporanPengawasController::class, 'store'])->name('store');
        Route::put('/{id}', [PelaporanPengawasController::class, 'update'])->name('update');
    });
});
