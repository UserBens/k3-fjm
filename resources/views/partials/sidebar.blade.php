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

    <div class="sb-section">
        <div class="sb-section-label">Database Tenaga</div>
        <a class="nav-link {{ request()->routeIs('tenaga.*') ? 'active' : '' }}" href="{{ route('tenaga.index') }}">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="nav-label">Data Tenaga</span>
        </a>
    </div>

    <div class="sb-section">
        <div class="sb-section-label">Key Performance Indicator</div>

        @php
            $monitoringActive =
                request()->routeIs('monitoring-laporan.*') ||
                request()->routeIs('monitoring-insiden.*') ||
                request()->routeIs('monitoring-kpi.*');
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

            <a class="nav-link {{ request()->routeIs('monitoring-laporan.*') ? 'active' : '' }}"
                href="{{ route('monitoring-laporan.index') }}">
                <span class="nav-label">Data Pengawas</span>
            </a>

            <a class="nav-link {{ request()->routeIs('monitoring-insiden.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Data Medis</span>
            </a>

            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Data Safety</span>
            </a>

            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Cetak UA/UC</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Dokumen Reject</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Monitoring SO</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Dashboard Individu</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Monitoring Pengawas</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Rekap Pengawas</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Monitoring Medis</span>
            </a>
            <a class="nav-link {{ request()->routeIs('monitoring-kpi.*') ? 'active' : '' }}" href="#">
                <span class="nav-label">Rekap Medis</span>
            </a>

        </div>
    </div>

    <div class="sb-section">
        <div class="sb-section-label">HSE Performance</div>
        <a class="nav-link" href="#">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="nav-label">JKA & Record Insiden</span>
        </a>
    </div>

    <div class="sb-section">
        <div class="sb-section-label">Document Control</div>
        <a class="nav-link" href="#">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="nav-label">Monitoring Dokumen</span>
        </a>
    </div>

    <div class="sb-section">
        <div class="sb-section-label">Training Needs Analysis</div>
        <a class="nav-link" href="#">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="nav-label">Matriks Kebutuhan Pelatihan</span>
        </a>
    </div>

    <div class="sb-section">
        <div class="sb-section-label">Health Performance</div>
        <a class="nav-link" href="#">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="nav-label">Pemeriksaan Kesehatan & Prokes</span>
        </a>
    </div>

    <div class="sb-section">
        <div class="sb-section-label">Assets Management</div>
        <a class="nav-link" href="#">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="nav-label">APD & Alat Kesehatan</span>
        </a>
    </div>

    <div class="sb-bottom">
        <a class="nav-link danger" href="#">
            <svg class="nav-icon" style="width:16px;height:16px" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="nav-label">Keluar</span>
        </a>
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
