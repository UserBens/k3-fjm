<style>
    /* SIDEBAR */
    #sidebar {
        width: 220px;
        min-width: 220px;
        background: #fff;
        border-right: 1px solid rgba(0, 0, 0, 0.07);
        display: flex;
        flex-direction: column;
        height: 100vh;
        overflow-y: auto;
    }

    .sb-logo {
        padding: 18px 16px 14px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .sb-logo-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sb-logo-box {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #1A1D2E;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sb-brand-main {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 15px;
        color: #1A1D2E;
        letter-spacing: 0.05em;
        line-height: 1.1;
    }

    .sb-brand-sub {
        font-size: 9px;
        font-weight: 700;
        color: #1A7A3C;
        letter-spacing: 0.07em;
        text-transform: uppercase;
    }

    .sb-user {
        margin: 12px 12px 0;
        background: #F5F7FF;
        border-radius: 10px;
        padding: 10px 12px;
        border: 1px solid rgba(45, 75, 158, 0.08);
    }

    .sb-user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #2D4B9E;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        color: #fff;
        flex-shrink: 0;
    }

    .sb-user-name {
        font-size: 12px;
        font-weight: 700;
        color: #1A1D2E;
        line-height: 1.2;
    }

    .sb-user-role {
        font-size: 9.5px;
        color: #9CA3AF;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.07em;
    }

    .sb-section {
        padding: 14px 12px 4px;
    }

    .sb-section-label {
        font-size: 9px;
        font-weight: 800;
        color: #CBD5E1;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 0 6px;
        margin-bottom: 4px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 8px 10px;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.15s;
        margin-bottom: 1px;
    }

    .nav-link:hover {
        background: #F0F2FA;
    }

    .nav-link.active {
        background: #2D4B9E;
    }

    .nav-link.active .nav-icon {
        color: #fff;
    }

    .nav-link.active .nav-label {
        color: #fff;
        font-weight: 700;
    }

    .nav-icon {
        font-size: 16px;
        color: #94A3B8;
        width: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    .nav-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        color: #64748B;
    }

    .nav-link.danger:hover {
        background: #FEF2F2;
    }

    .nav-link.danger .nav-icon,
    .nav-link.danger .nav-label {
        color: #D0021B;
    }

    .sb-bottom {
        padding: 10px 12px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        margin-top: auto;
    }

    .sb-logo-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #1A7A3C;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sb-logo-icon svg {
        width: 18px;
        height: 18px;
        color: #fff;
    }

    .sb-logo-text {
        font-size: 11.5px;
        font-weight: 800;
        color: #1A1D2E;
        letter-spacing: 0.01em;
        line-height: 1.3;
    }

    /* ===========================
    DROPDOWN SIDEBAR
    =========================== */

    .nav-dropdown-toggle {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        cursor: pointer;
    }

    .nav-dropdown-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dropdown-arrow {
        width: 16px;
        height: 16px;
        color: #94A3B8;
        transition: .3s;
        flex-shrink: 0;
    }

    .nav-dropdown-toggle.active .dropdown-arrow {
        color: #fff;
    }

    .dropdown-arrow.rotate {
        transform: rotate(180deg);
    }

    /* dropdown */

    .dropdown-menu {
        height: 0;
        overflow: hidden;
        transition: height .35s ease;
    }

    .dropdown-menu .nav-link {
        padding: 8px 10px 8px 44px;
        margin: 2px 0;
    }

    .dropdown-menu .nav-label {
        font-size: 12px;
    }
</style>

<aside id="sidebar">
    <div class="sb-logo">
        <div class="sb-logo-row">
            <div class="sb-logo-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12.75L11.25 15 15 9.75M21 12c0 4.556-3.207 8.377-7.5 9.32a9.735 9.735 0 01-3 0C6.207 20.377 3 16.556 3 12V6.741a3 3 0 011.5-2.598l6-3.464a3 3 0 013 0l6 3.464a3 3 0 011.5 2.598V12z" />
                </svg>
            </div>
            <div class="sb-logo-text">K3 PT. FOKUS JASA MITRA</div>
            <div class="sb-close-btn" onclick="toggleSidebar()" aria-label="Tutup menu">
                <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    </div>

    <div class="sb-section">
        <div class="sb-section-label">Overview</div>
        <a class="nav-link {{ request()->routeIs('dashboard') || request()->is('/') ? 'active' : '' }}"
            href="{{ route('dashboard') }}">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="nav-label">Dashboard</span>
        </a>
    </div>

    {{-- DATABASE TENAGA --}}
    <div class="sb-section">
        <div class="sb-section-label">Database Tenaga</div>

        @php
            // Sesuaikan nama route ini dengan yang ada di web.php Anda
            $datatenagaActive =
                request()->routeIs('tenaga.*') ||
                request()->routeIs('memo-kib.*') ||
                request()->routeIs('safety-officer.*') ||
                request()->routeIs('pengawas.*');
        @endphp

        <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle {{ $datatenagaActive ? 'active' : '' }}"
            onclick="toggleDropdown('datatenagaDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>

                <span class="nav-label">Data Tenaga</span>
            </div>

            <svg class="dropdown-arrow {{ $datatenagaActive ? 'rotate' : '' }}" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="datatenagaDropdown" class="dropdown-menu {{ $datatenagaActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('tenaga.*') ? 'active' : '' }}" href="{{ route('tenaga.index') }}">
                <span class="nav-label">Master Tenaga</span>
            </a>

            {{-- <a class="nav-link {{ request()->routeIs('memo-kib.*') ? 'active' : '' }}" href="{{ route('memo-kib.index') }}">
                <span class="nav-label">Memo KIB</span>
            </a> --}}

            <a class="nav-link {{ request()->routeIs('pengawas.*') ? 'active' : '' }}"
                href="{{ route('pengawas.index') }}">
                <span class="nav-label">Data Pengawas</span>
            </a>

            <a class="nav-link {{ request()->routeIs('safety-officer.*') ? 'active' : '' }}"
                href="{{ route('safety-officer.index') }}">
                <span class="nav-label">Data Safety Officer</span>
            </a>

        </div>
    </div>

    {{-- KPI --}}
    <div class="sb-section">
        <div class="sb-section-label">Key Performance Indicator</div>

        @php
            $monitoringActive =
                // request()->routeIs('data-pengawas.*') ||
                request()->routeIs('data-medis.*') ||
                request()->routeIs('data-safety.*') ||
                request()->routeIs('data-unsafe.*') ||
                request()->routeIs('data-reject-monitoring.*') ||
                request()->routeIs('monitoring-so.*') ||
                request()->routeIs('dashboard-individu.*') ||
                request()->routeIs('monitoring-pengawas.*') ||
                request()->routeIs('rekap-pengawas.*') ||
                request()->routeIs('monitoring-medis.*') ||
                request()->routeIs('rekap-medis.*');
        @endphp

        <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle {{ $monitoringActive ? 'active' : '' }}"
            onclick="toggleDropdown('monitoringDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <span class="nav-label">Monitoring Laporan KPI</span>
            </div>

            <svg class="dropdown-arrow {{ $monitoringActive ? 'rotate' : '' }}" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="monitoringDropdown" class="dropdown-menu {{ $monitoringActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('data-medis.*') ? 'active' : '' }}"
                href="{{ route('data-medis.index') }}">
                <span class="nav-label">Data Medis</span>
            </a>

            <a class="nav-link {{ request()->routeIs('data-safety.*') ? 'active' : '' }}"
                href="{{ route('data-safety.index') }}">
                <span class="nav-label">Data Safety</span>
            </a>

            <a class="nav-link {{ request()->routeIs('data-unsafe.*') ? 'active' : '' }}"
                href="{{ route('data-unsafe.index') }}">
                <span class="nav-label">Data UA/UC</span>
            </a>
            <a class="nav-link {{ request()->routeIs('data-reject-monitoring.*') ? 'active' : '' }}"
                href="{{ route('data-reject-monitoring.index') }}">
                <span class="nav-label">Monitoring Dokumen Reject</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-laporan-so.*') ? 'active' : '' }}"
                href="{{ route('monitoring-laporan-so.index') }}">
                <span class="nav-label">Monitoring SO</span>
            </a>
            <a class="nav-link {{ request()->routeIs('dashboard-individu.*') ? 'active' : '' }}"
                href="{{ route('dashboard-individu.index') }}">
                <span class="nav-label">Dashboard Individu</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-pengawas.*') ? 'active' : '' }}"
                href="{{ route('monitoring-pengawas.index') }}">
                <span class="nav-label">Monitoring Pengawas</span>
            </a>
            <a class="nav-link {{ request()->routeIs('rekap-pengawas.*') ? 'active' : '' }}"
                href="{{ route('rekap-pengawas.index') }}">
                <span class="nav-label">Rekap Pengawas</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-medis.*') ? 'active' : '' }}"
                href="{{ route('monitoring-medis.index') }}">
                <span class="nav-label">Monitoring Medis</span>
            </a>
            <a class="nav-link {{ request()->routeIs('rekap-medis.*') ? 'active' : '' }}"
                href="{{ route('rekap-medis.index') }}">
                <span class="nav-label">Rekap Medis</span>
            </a>

        </div>
    </div>

    {{-- HSE PERFORMANCE --}}
    <div class="sb-section">
        <div class="sb-section-label">HSE Performance</div>

        @php
            // Sesuaikan nama route ini dengan yang ada di web.php Anda
            $jkaActive =
                request()->routeIs('dashboard-insiden.*') ||
                request()->routeIs('lpi-kejadian.*') ||
                request()->routeIs('dashboard-jka.*') ||
                request()->routeIs('leading-dashboard.*') ||
                request()->routeIs('leading-input.*');
        @endphp

        <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle {{ $jkaActive ? 'active' : '' }}"
            onclick="toggleDropdown('jkaDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>

                <span class="nav-label">JKA & Record Insiden</span>
            </div>

            <svg class="dropdown-arrow {{ $jkaActive ? 'rotate' : '' }}" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="jkaDropdown" class="dropdown-menu {{ $jkaActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('dashboard-insiden.*') ? 'active' : '' }}"
                href="{{ route('dashboard-insiden.index') }}">
                <span class="nav-label">Dashboard Monitoring Insiden</span>
            </a>

            <a class="nav-link {{ request()->routeIs('lpi-kejadian.*') ? 'active' : '' }}"
                href="{{ route('lpi-kejadian.index') }}">
                <span class="nav-label">LPI Insiden</span>
            </a>

            <a class="nav-link {{ request()->routeIs('dashboard-jka.*') ? 'active' : '' }}"
                href="{{ route('dashboard-jka.index') }}">
                <span class="nav-label">Dashboard JKA</span>
            </a>

            <a class="nav-link {{ request()->routeIs('leading-dashboard.*') ? 'active' : '' }}"
                href="{{ route('leading-dashboard.index') }}">
                <span class="nav-label">Dashboard Leading</span>
            </a>

            <a class="nav-link {{ request()->routeIs('leading-input.*') ? 'active' : '' }}"
                href="{{ route('leading-input.index') }}">
                <span class="nav-label">Leading Input</span>
            </a>

        </div>
    </div>

    {{-- DOCUMENT CONTROL --}}
    <div class="sb-section">
        <div class="sb-section-label">Document Control</div>

        @php
            // Sesuaikan nama route ini dengan yang ada di web.php Anda
            $documentcontrolActive = request()->routeIs('daftar-induk.*') || request()->routeIs('dashboard-dokumen.*');
        @endphp

        <a href="javascript:void(0)"
            class="nav-link nav-dropdown-toggle {{ $documentcontrolActive ? 'active' : '' }}"
            onclick="toggleDropdown('documentcontrolDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>

                <span class="nav-label">Monitoring Dokumen</span>
            </div>

            <svg class="dropdown-arrow {{ $documentcontrolActive ? 'rotate' : '' }}" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="documentcontrolDropdown" class="dropdown-menu {{ $documentcontrolActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('daftar-induk.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Daftar Induk Dokumen</span>
            </a>

            <a class="nav-link {{ request()->routeIs('dashboard-dokumen.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Dashboard Dokumen</span>
            </a>

        </div>
    </div>

    {{-- MATRIKS TNA --}}
    <div class="sb-section">
        <div class="sb-section-label">Training Needs Analysis</div>

        @php
            // Sesuaikan nama route ini dengan yang ada di web.php Anda
            $matriksActive =
                request()->routeIs('cover.*') ||
                request()->routeIs('matriks-tna.*') ||
                request()->routeIs('rencana.*') ||
                request()->routeIs('dasar-hukum.*') ||
                request()->routeIs('form-evaluasi.*') ||
                request()->routeIs('matriks-gap.*') ||
                request()->routeIs('matriks-prioritas.*');
        @endphp

        <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle {{ $matriksActive ? 'active' : '' }}"
            onclick="toggleDropdown('matriksDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>

                <span class="nav-label">Matriks Kebutuhan Pelatihan</span>
            </div>

            <svg class="dropdown-arrow {{ $matriksActive ? 'rotate' : '' }}" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="matriksDropdown" class="dropdown-menu {{ $matriksActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('cover.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Cover</span>
            </a>

            <a class="nav-link {{ request()->routeIs('matriks-tna.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Matriks TNA K3</span>
            </a>

            <a class="nav-link {{ request()->routeIs('rencana.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Rencana Implementasi</span>
            </a>

            <a class="nav-link {{ request()->routeIs('dasar-hukum.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Dasar Hukum K3</span>
            </a>

            <a class="nav-link {{ request()->routeIs('form-evaluasi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Form Evaluasi</span>
            </a>

            <a class="nav-link {{ request()->routeIs('matriks-gap.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Matriks Gap Kompetensi</span>
            </a>

            <a class="nav-link {{ request()->routeIs('matriks-prioritas.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Matriks Prioritas Pelatihan</span>
            </a>

        </div>
    </div>

    {{-- Health Performance --}}
    <div class="sb-section">
        <div class="sb-section-label">Health Performance</div>

        @php
            // Sesuaikan nama route ini dengan yang ada di web.php Anda
            $healthperformanceActive =
                request()->routeIs('dasboard-he.*') ||
                request()->routeIs('dcu.*') ||
                request()->routeIs('matriks-refrensi.*') ||
                request()->routeIs('matriks-kesehatan.*') ||
                request()->routeIs('program-kesehatan.*') ||
                request()->routeIs('rekap-bulanan.*') ||
                request()->routeIs('form-dcu.*') ||
                request()->routeIs('lembar-folowup.*');
        @endphp

        <a href="javascript:void(0)"
            class="nav-link nav-dropdown-toggle {{ $healthperformanceActive ? 'active' : '' }}"
            onclick="toggleDropdown('healthperformanceDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>

                <span class="nav-label">Pemeriksaan Kesehatan & Prokes</span>
            </div>

            <svg class="dropdown-arrow {{ $healthperformanceActive ? 'rotate' : '' }}" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="healthperformanceDropdown" class="dropdown-menu {{ $healthperformanceActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('dasboard-he.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Dashboard HE</span>
            </a>

            <a class="nav-link {{ request()->routeIs('data-dcu.*') ? 'active' : '' }}"
                href="{{ route('dcu.index') }}">
                <span class="nav-label">Data DCU</span>
            </a>

            <a class="nav-link {{ request()->routeIs('matriks-refrensi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Matriks Refrensi</span>
            </a>

            <a class="nav-link {{ request()->routeIs('matriks-kesehatan.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Matriks Kesehatan</span>
            </a>

            <a class="nav-link {{ request()->routeIs('program-kesehatan.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Program Kesehatan</span>
            </a>

            <a class="nav-link {{ request()->routeIs('rekap-bulanan.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Rekap Bulanan</span>
            </a>

            <a class="nav-link {{ request()->routeIs('form-dcu.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Form DCU</span>
            </a>

            <a class="nav-link {{ request()->routeIs('lembar-folowup.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Lembar Folowup</span>
            </a>

        </div>
    </div>

    {{-- Assets Management --}}
    <div class="sb-section">
        <div class="sb-section-label">Assets Management</div>

        @php
            // Sesuaikan nama route ini dengan yang ada di web.php Anda
            $assetsmanagementActive =
                request()->routeIs('dasboard-apd.*') ||
                request()->routeIs('kode-ok-referensi.*') ||
                request()->routeIs('master-supplier-apd.*') ||
                request()->routeIs('master-stok-apd.*') ||
                request()->routeIs('log-apd.*') ||
                request()->routeIs('master-stok-alkes.*') ||
                request()->routeIs('penggunaan-alkes.*') ||
                request()->routeIs('kartu-stok.*') ||
                request()->routeIs('pusat-reminder.*') ||
                request()->routeIs('matriks-apd.*') ||
                request()->routeIs('matriks-apd-jabatan.*') ||
                request()->routeIs('hiradc.*') ||
                request()->routeIs('rab-anggaran.*');
        @endphp

        <a href="javascript:void(0)"
            class="nav-link nav-dropdown-toggle {{ $assetsmanagementActive ? 'active' : '' }}"
            onclick="toggleDropdown('assetsmanagementDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>

                <span class="nav-label">APD & Alat Kesehatan</span>
            </div>

            <svg class="dropdown-arrow {{ $assetsmanagementActive ? 'rotate' : '' }}" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="assetsmanagementDropdown" class="dropdown-menu {{ $assetsmanagementActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('dasboard-apd.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Dashboard APD</span>
            </a>

            <a class="nav-link {{ request()->routeIs('kode-ok-referensi.*') ? 'active' : '' }}" href="{{route('kode-ok-referensi.index')}}">
                <span class="nav-label">Refrensi Kode OK</span>
            </a>
           
            <a class="nav-link {{ request()->routeIs('master-supplier-apd.*') ? 'active' : '' }}" href="{{route('master-supplier-apd.index')}}">
                <span class="nav-label">Master Supplier APD & Alkes</span>
            </a>

            <a class="nav-link {{ request()->routeIs('master-stok-apd.*') ? 'active' : '' }}"
                href="{{ route('master-stok-apd.index') }}">
                <span class="nav-label">Master Stok APD</span>
            </a>
            <a class="nav-link {{ request()->routeIs('log-apd.*') ? 'active' : '' }}"
                href="{{ route('log-apd.index') }}">
                <span class="nav-label">LOG APD</span>
            </a>

            <a class="nav-link {{ request()->routeIs('master-stok-alkes.*') ? 'active' : '' }}"
                href="{{ route('master-stok-alkes.index') }}">
                <span class="nav-label">Master Stok Alkes</span>
            </a>

            <a class="nav-link {{ request()->routeIs('penggunaan-alkes.*') ? 'active' : '' }}"
                href="{{ route('penggunaan-alkes.index') }}">
                <span class="nav-label">LOG ALKES</span>
            </a>
           
            <a class="nav-link {{ request()->routeIs('kartu-stok.*') ? 'active' : '' }}"
                href="{{ route('kartu-stok.index') }}">
                <span class="nav-label">Kartu Stok</span>
            </a>
            
            <a class="nav-link {{ request()->routeIs('pusat-reminder.*') ? 'active' : '' }}"
                href="{{ route('pusat-reminder.index') }}">
                <span class="nav-label">Pusat Reminder</span>
            </a>

            <a class="nav-link {{ request()->routeIs('matriks-apd-jabatan.*') ? 'active' : '' }}"
                href="{{ route('matriks-apd-jabatan.index') }}">
                <span class="nav-label">Matriks APD Jabatan</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hiradc.*') ? 'active' : '' }}"
                href="{{ route('hiradc.index') }}">
                <span class="nav-label">HIRADC</span>
            </a>

            <a class="nav-link {{ request()->routeIs('rab-anggaran.*') ? 'active' : '' }}"
                href="{{ route('rab-anggaran.index') }}">
                <span class="nav-label">RAB</span>
            </a>

            <a class="nav-link {{ request()->routeIs('lembar-folowup.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Lembar Folowup</span>
            </a>

        </div>
    </div>

    {{-- ALAT BERAT --}}
    <div class="sb-section">
        <div class="sb-section-label">Alat Berat All In & On Call</div>

        @php
            // Hapus .* agar nama route cocok persis dengan yang ada di web.php
            $alberActive =
                request()->routeIs('alber.index') ||
                request()->routeIs('alber.operatornonaktif') ||
                request()->routeIs('alber.master-oncall') ||
                request()->routeIs('alber.master-allin');
        @endphp

        <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle {{ $alberActive ? 'active' : '' }}"
            onclick="toggleDropdown('alberDropdown', this)">

            <div class="nav-dropdown-left">
                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>

                <span class="nav-label">Monitoring Operator Alat Berat</span>
            </div>

            <svg class="dropdown-arrow {{ $alberActive ? 'rotate' : '' }}" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>

        </a>

        <div id="alberDropdown" class="dropdown-menu {{ $alberActive ? 'show' : '' }}">

            <a class="nav-link {{ request()->routeIs('alber.index') ? 'active' : '' }}"
                href="{{ route('alber.index') }}">
                <span class="nav-label">Dashboard Alat Berat</span>
            </a>

            <a class="nav-link {{ request()->routeIs('alber.operatornonaktif') ? 'active' : '' }}"
                href="{{ route('alber.operatornonaktif') }}">
                <span class="nav-label">Operator Non-Aktif</span>
            </a>

            <a class="nav-link {{ request()->routeIs('alber.master-oncall') ? 'active' : '' }}"
                href="{{ route('alber.master-oncall') }}">
                <span class="nav-label">Master On Call</span>
            </a>

            <a class="nav-link {{ request()->routeIs('alber.master-allin') ? 'active' : '' }}"
                href="{{ route('alber.master-allin') }}">
                <span class="nav-label">Master All In</span>
            </a>

        </div>
    </div>


    @if (session('auth_user.is_admin'))
        {{-- User Management --}}
        <div class="sb-section">
            <div class="sb-section-label">User Management</div>

            <a href="{{ route('aktivasi.index') }}"
                class="nav-link {{ request()->routeIs('aktivasi.*') ? 'active' : '' }}">

                <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>

                <span class="nav-label">Aktivasi Akun</span>
            </a>
        </div>
    @endif

    <div class="sb-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-outline" style="width:100%;">
                <svg style="width:12px;height:12px;display:inline;margin-right:4px" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
    }

    function toggleDropdown(dropdownId, toggleElement) {

        const dropdown = document.getElementById(dropdownId);

        const arrow = toggleElement.querySelector(".dropdown-arrow");

        if (dropdown.classList.contains("show")) {

            dropdown.style.height = dropdown.scrollHeight + "px";

            requestAnimationFrame(() => {
                dropdown.style.height = "0px";
            });

            dropdown.classList.remove("show");

        } else {

            dropdown.classList.add("show");

            dropdown.style.height = dropdown.scrollHeight + "px";

        }

        arrow.classList.toggle("rotate");

    }

    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll(".dropdown-menu.show").forEach(function(menu) {

            menu.style.height = menu.scrollHeight + "px";

        });

    });
</script>
