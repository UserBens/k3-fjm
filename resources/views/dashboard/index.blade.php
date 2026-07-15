<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Dashboard K3 — PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bebas+Neue&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --red: #D0021B;
            --red2: #E8192C;
            --green: #1A7A3C;
            --green2: #22A050;
            --blue: #2D4B9E;
            --blue2: #3A5FBF;
            --dark: #1A1D2E;
            --amber: #D97706;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F0F2FA;
            color: #1A1D2E;
            overflow: hidden;
        }

        .font-display {
            font-family: 'Bebas Neue', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(45, 75, 158, 0.25);
            border-radius: 4px;
        }

        /* TOPBAR */
        #topbar {
            height: 52px;
            background: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 20px;
            flex-shrink: 0;
        }

        .search-box {
            flex: 1;
            max-width: 320px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            height: 32px;
            padding: 0 32px 0 30px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: 8px;
            background: #F8F9FF;
            font-size: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            outline: none;
            transition: border 0.2s;
        }

        .search-box input::placeholder {
            color: #94A3B8;
        }

        .search-box input:focus {
            border-color: #2D4B9E;
            background: #fff;
        }

        .search-icon {
            position: absolute;
            left: 9px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 14px;
        }

        .search-kbd {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 9px;
            font-weight: 700;
            color: #94A3B8;
            background: #F0F2FA;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 4px;
            padding: 1px 5px;
        }

        .tb-badge {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #F8F9FF;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            color: #64748B;
            font-size: 15px;
        }

        .notif-dot {
            position: absolute;
            top: 5px;
            right: 6px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #D0021B;
            border: 1.5px solid #fff;
        }

        .tb-user {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #F8F9FF;
        }

        .tb-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #2D4B9E;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 800;
            color: #fff;
        }

        .tb-name {
            font-size: 12px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .tb-caret {
            font-size: 11px;
            color: #94A3B8;
        }

        .tb-divider {
            width: 1px;
            height: 20px;
            background: rgba(0, 0, 0, 0.07);
        }

        /* CONTENT */
        #main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        #page-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 20px 28px;
        }

        /* STAT CARDS */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px 16px 10px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 6px 24px rgba(45, 75, 158, 0.1);
            transform: translateY(-2px);
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .stat-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .stat-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #1A1D2E;
            line-height: 1;
            margin-bottom: 3px;
        }

        .stat-sub {
            font-size: 10px;
            color: #94A3B8;
            font-weight: 600;
        }

        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 10px;
            font-weight: 700;
            margin-top: 4px;
            padding: 2px 6px;
            border-radius: 999px;
        }

        .trend-up {
            color: #1A7A3C;
            background: rgba(26, 122, 60, 0.08);
        }

        .trend-down {
            color: #D0021B;
            background: rgba(208, 2, 27, 0.07);
        }

        .sparkline-wrap {
            height: 36px;
            margin-top: 6px;
        }

        /* PAGE HEADER */
        .page-hdr {
            margin-bottom: 16px;
        }

        .page-hdr-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pg-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .pg-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #1A1D2E;
            letter-spacing: 0.02em;
            line-height: 1;
        }

        .pg-title span {
            color: #2D4B9E;
        }

        .pg-sub {
            font-size: 12px;
            color: #94A3B8;
            margin-top: 2px;
        }

        .pg-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline {
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid rgba(45, 75, 158, 0.25);
            font-size: 11.5px;
            font-weight: 700;
            color: #2D4B9E;
            background: #fff;
            cursor: pointer;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-outline:hover {
            background: #F0F4FF;
        }

        .btn-primary {
            padding: 6px 14px;
            border-radius: 8px;
            border: none;
            font-size: 11.5px;
            font-weight: 700;
            color: #fff;
            background: #2D4B9E;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: #1A3C8A;
        }

        .dashboard-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .dashboard-tab {
            border: 1px solid rgba(45, 75, 158, 0.25);
            background: #fff;
            color: #2D4B9E;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            white-space: nowrap;
        }

        .dashboard-tab:hover {
            background: #F0F4FF;
        }

        .dashboard-tab.active {
            background: #2D4B9E;
            color: #fff;
            border-color: #2D4B9E;
        }

        .dashboard-panel {
            display: none;
        }

        .dashboard-panel.active {
            display: block;
        }

        .health-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 14px;
        }

        .health-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px 16px 10px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .health-card:hover {
            box-shadow: 0 6px 24px rgba(45, 75, 158, 0.10);
            transform: translateY(-2px);
        }

        .health-card .label {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 8px;
        }

        .health-card .value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #1A1D2E;
            line-height: 1;
            margin-bottom: 3px;
        }

        .health-card .sub {
            font-size: 11px;
            color: #64748B;
            margin-top: 6px;
        }

        .health-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            margin-top: 8px;
            background: rgba(26, 122, 60, 0.08);
            color: #1A7A3C;
        }

        .health-list {
            display: grid;
            gap: 10px;
        }

        .health-list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            background: #F8F9FF;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 12px;
            color: #1A1D2E;
        }

        .health-list-item span {
            font-weight: 600;
            color: #1A1D2E;
        }

        .health-list-item strong {
            color: #64748B;
            font-weight: 600;
        }

        .left-panel {
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-width: 0;
        }

        .health-chart-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 12px;
            margin-bottom: 12px;
        }

        .health-chart-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
            border: 1px solid rgba(45, 75, 158, 0.10);
            border-radius: 14px;
            padding: 14px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #D0021B;
            display: inline-block;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.35
            }
        }

        /* BOTTOM ROW */
        .bottom-row {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 12px;
        }

        .section-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 16px;
            min-width: 0;
        }

        .sc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .sc-title {
            font-size: 13px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .sc-sub {
            font-size: 10.5px;
            color: #94A3B8;
            margin-top: 1px;
        }

        .view-all {
            font-size: 11px;
            font-weight: 700;
            color: #2D4B9E;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .chart-tabs {
            display: flex;
            gap: 4px;
        }

        .chart-tab {
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
            cursor: pointer;
            background: #F8F9FF;
            transition: all 0.15s;
        }

        .chart-tab.active {
            background: #2D4B9E;
            color: #fff;
            border-color: #2D4B9E;
        }

        /* RIGHT PANEL */
        .right-panel {
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-width: 0;
        }

        /* DONUT SECTION */
        .donut-wrap {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .donut-canvas-wrap {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
            position: relative;
        }

        .donut-center {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .donut-center-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            color: #1A1D2E;
            line-height: 1;
        }

        .donut-center-lbl {
            font-size: 9px;
            color: #94A3B8;
            font-weight: 600;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-label {
            font-size: 11px;
            color: #64748B;
            font-weight: 500;
        }

        .legend-pct {
            margin-left: auto;
            font-size: 11px;
            font-weight: 700;
            color: #1A1D2E;
        }

        /* GOALS */
        .goal-item {
            margin-bottom: 12px;
        }

        .goal-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .goal-name {
            font-size: 11.5px;
            font-weight: 600;
            color: #1A1D2E;
        }

        .goal-nums {
            font-size: 11px;
            color: #94A3B8;
        }

        .goal-bar-track {
            height: 5px;
            background: #F0F2FA;
            border-radius: 999px;
            overflow: hidden;
        }

        .goal-bar-fill {
            height: 100%;
            border-radius: 999px;
            transition: width 1s ease;
        }

        /* RECENT TABLE */
        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 620px;
            border-collapse: collapse;
        }

        .rtable th {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0 8px 8px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            white-space: nowrap;
        }

        .rtable td {
            font-size: 12px;
            color: #1A1D2E;
            padding: 9px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            vertical-align: middle;
            white-space: nowrap;
        }

        .rtable tr:last-child td {
            border-bottom: none;
        }

        .rtable tr:hover td {
            background: #F8F9FF;
        }

        .td-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #E0E7FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            color: #2D4B9E;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
        }

        .sp-green {
            background: rgba(26, 122, 60, 0.09);
            color: #1A7A3C;
        }

        .sp-amber {
            background: rgba(217, 119, 6, 0.09);
            color: #D97706;
        }

        .sp-red {
            background: rgba(208, 2, 27, 0.08);
            color: #D0021B;
        }

        .sp-blue {
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
        }

        .amount-pos {
            color: #1A7A3C;
            font-weight: 700;
        }

        .amount-neg {
            color: #D0021B;
            font-weight: 700;
        }

        /* MIDDLE ROW */
        .middle-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px;
        }

        /* ACTIVITY FEED */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .act-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
        }

        .act-text {
            font-size: 11.5px;
            color: #1A1D2E;
            font-weight: 500;
            line-height: 1.4;
        }

        .act-time {
            font-size: 10px;
            color: #94A3B8;
            margin-top: 1px;
        }

        /* ══════ RESPONSIVE ══════ */

        .hamburger-btn {
            display: none;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #F8F9FF;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #1A1D2E;
            flex-shrink: 0;
        }

        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, 0.45);
            z-index: 40;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        #sidebar-overlay.open {
            display: block;
            opacity: 1;
        }

        .sb-close-btn {
            display: none;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            background: #F0F2FA;
            color: #64748B;
            cursor: pointer;
            margin-left: auto;
            flex-shrink: 0;
        }

        @media (max-width: 1024px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.25s ease;
                box-shadow: 12px 0 32px rgba(0, 0, 0, 0.18);
            }

            #sidebar.open {
                transform: translateX(0);
            }

            .hamburger-btn {
                display: flex;
            }

            .sb-close-btn {
                display: flex;
            }

            .bottom-row {
                grid-template-columns: 1fr;
            }

            .search-box {
                max-width: none;
            }
        }

        @media (max-width: 900px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            #topbar {
                padding: 0 12px;
                gap: 8px;
            }

            .search-kbd {
                display: none;
            }

            .tb-name {
                display: none;
            }

            .tb-caret {
                display: none;
            }

            #page-content {
                padding: 14px 14px 22px;
            }

            .pg-title {
                font-size: 24px;
            }

            .page-hdr-top {
                flex-direction: column;
                align-items: stretch;
            }

            .pg-actions {
                width: 100%;
            }

            .pg-actions .btn-outline,
            .pg-actions .btn-primary {
                flex: 1;
                justify-content: center;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .donut-wrap {
                justify-content: center;
                text-align: left;
            }
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- ══════ SIDEBAR ══════ -->
    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- ══════ MAIN ══════ -->
    <div id="main-content">

        @include('partials.topbar')

        <!-- PAGE CONTENT -->
        <div id="page-content">

            <div class="dashboard-tabs" role="tablist">
                <button class="dashboard-tab active" data-tab="safetyDashboard">Dashboard Safety</button>
                <button class="dashboard-tab" data-tab="healthDashboard">Dashboard Health</button>
                <!-- Tombol Export PDF -->
                <button class="dashboard-tab" type="button" onclick="exportDashboardToPDF(this)" class="btn-export"
                    style="padding: 8px 16px; background-color: #2D4B9E; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; display: flex; gap: 8px; align-items: center;">
                    <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span id="export-text">Export as PPT/PDF</span>
                </button>
            </div>

            <div id="safetyDashboard" class="dashboard-panel active">
                <!-- STAT CARDS ROW -->
                <div class="stat-grid">

                    <!-- Hari Tanpa Kecelakaan -->
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-label">Hari Tanpa Kecelakaan</div>
                            <div class="stat-icon-box" style="background:rgba(26,122,60,0.09);">
                                <svg style="width:16px;height:16px;color:#1A7A3C" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-val">127</div>
                        <div class="stat-sub">Rekor berjalan saat ini</div>
                        <span class="stat-trend trend-up">↑ Rekor tertinggi tahun ini</span>
                        <div class="sparkline-wrap"><canvas id="spark1"></canvas></div>
                    </div>

                    <!-- Insiden Bulan Ini -->
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-label">Insiden Bulan Ini</div>
                            <div class="stat-icon-box" style="background:rgba(208,2,27,0.08);">
                                <svg style="width:16px;height:16px;color:#D0021B" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-val">3</div>
                        <div class="stat-sub">Termasuk laporan near-miss</div>
                        <span class="stat-trend trend-up">↓ -2 dibanding bulan lalu</span>
                        <div class="sparkline-wrap"><canvas id="spark2"></canvas></div>
                    </div>

                    <!-- Kepatuhan Inspeksi APD -->
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-label">Kepatuhan Inspeksi APD</div>
                            <div class="stat-icon-box" style="background:rgba(45,75,158,0.09);">
                                <svg style="width:16px;height:16px;color:#2D4B9E" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12.75L11.25 15 15 9.75m6 4.5V9.75a3.75 3.75 0 00-3.75-3.75h-8.5A3.75 3.75 0 004 9.75v4.5A3.75 3.75 0 007.75 18h8.5A3.75 3.75 0 0020 14.25z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-val">94%</div>
                        <div class="stat-sub">Target bulanan 95%</div>
                        <span class="stat-trend trend-up">↑ +3% bulan ini</span>
                        <div class="sparkline-wrap"><canvas id="spark3"></canvas></div>
                    </div>

                    <!-- Pelatihan K3 Selesai -->
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-label">Pelatihan K3 Selesai</div>
                            <div class="stat-icon-box" style="background:rgba(217,119,6,0.09);">
                                <svg style="width:16px;height:16px;color:#D97706" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-val">38</div>
                        <div class="stat-sub">Karyawan tersertifikasi</div>
                        <span class="stat-trend trend-up">↑ +12 bulan ini</span>
                        <div class="sparkline-wrap"><canvas id="spark4"></canvas></div>
                    </div>
                </div>

                <!-- MIDDLE ROW: Chart + Right -->
                <div class="bottom-row">

                    <!-- Area Chart: Tren Insiden -->
                    <div class="section-card">
                        <div class="sc-header">
                            <div>
                                <div class="sc-title">Tren Insiden & Near Miss</div>
                                <div class="sc-sub">Jumlah insiden dan near-miss per bulan</div>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div class="chart-tabs">
                                    <button class="chart-tab active" onclick="setTab(this,'3b')">3B</button>
                                    <button class="chart-tab" onclick="setTab(this,'6b')">6B</button>
                                    <button class="chart-tab" onclick="setTab(this,'1t')">1T</button>
                                </div>
                            </div>
                        </div>
                        <div style="height:220px;position:relative;">
                            <canvas id="areaChart"></canvas>
                        </div>

                        <!-- Tabel Laporan Insiden Terbaru -->
                        <div style="margin-top:18px;">
                            <div class="sc-header" style="margin-bottom:10px;">
                                <div>
                                    <div class="sc-title">Laporan Insiden Terbaru</div>
                                    <div class="sc-sub">5 laporan insiden/near-miss terbaru</div>
                                </div>
                                <button class="view-all">Lihat Semua →</button>
                            </div>
                            <div class="rtable-wrap">
                                <table class="rtable">
                                    <thead>
                                        <tr>
                                            <th>Jenis Insiden</th>
                                            <th>Lokasi / Area</th>
                                            <th>Tanggal</th>
                                            <th>Tingkat Keparahan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="font-weight:600;color:#1A1D2E;">Near Miss — Tergelincir</td>
                                            <td style="color:#94A3B8;">Area Produksi Line 2</td>
                                            <td style="color:#94A3B8;">24 Jun 2025</td>
                                            <td><span class="status-pill sp-blue">Rendah</span></td>
                                            <td><span class="status-pill sp-amber">Investigasi</span></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight:600;color:#1A1D2E;">Insiden — Tangan Tergores</td>
                                            <td style="color:#94A3B8;">Workshop Maintenance</td>
                                            <td style="color:#94A3B8;">20 Jun 2025</td>
                                            <td><span class="status-pill sp-amber">Sedang</span></td>
                                            <td><span class="status-pill sp-blue">Diproses</span></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight:600;color:#1A1D2E;">Near Miss — APD Tidak Lengkap
                                            </td>
                                            <td style="color:#94A3B8;">Gudang Material</td>
                                            <td style="color:#94A3B8;">15 Jun 2025</td>
                                            <td><span class="status-pill sp-blue">Rendah</span></td>
                                            <td><span class="status-pill sp-green">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight:600;color:#1A1D2E;">Insiden — Terpeleset</td>
                                            <td style="color:#94A3B8;">Area Parkir</td>
                                            <td style="color:#94A3B8;">08 Jun 2025</td>
                                            <td><span class="status-pill sp-blue">Rendah</span></td>
                                            <td><span class="status-pill sp-amber">Investigasi</span></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight:600;color:#1A1D2E;">Insiden — Kebocoran Bahan Kimia
                                                Minor</td>
                                            <td style="color:#94A3B8;">Laboratorium QC</td>
                                            <td style="color:#94A3B8;">30 Mei 2025</td>
                                            <td><span class="status-pill sp-red">Tinggi</span></td>
                                            <td><span class="status-pill sp-red">Eskalasi</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT PANEL -->
                    <div class="right-panel">

                        <!-- Donut: Status Tindak Lanjut -->
                        <div class="section-card">
                            <div class="sc-header" style="margin-bottom:12px;">
                                <div>
                                    <div class="sc-title">Status Tindak Lanjut Insiden</div>
                                    <div class="sc-sub">Distribusi status penanganan laporan</div>
                                </div>
                            </div>
                            <div class="donut-wrap">
                                <div class="donut-canvas-wrap">
                                    <canvas id="donutChart"></canvas>
                                    <div class="donut-center">
                                        <div class="donut-center-val">12</div>
                                        <div class="donut-center-lbl">Laporan</div>
                                    </div>
                                </div>
                                <div style="flex:1;">
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#1A7A3C;"></span>
                                        <span class="legend-label">Selesai</span>
                                        <span class="legend-pct">50%</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#D97706;"></span>
                                        <span class="legend-label">Diproses</span>
                                        <span class="legend-pct">25%</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#2D4B9E;"></span>
                                        <span class="legend-label">Investigasi</span>
                                        <span class="legend-pct">17%</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#D0021B;"></span>
                                        <span class="legend-label">Eskalasi</span>
                                        <span class="legend-pct">8%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Goals: Target K3 Bulanan -->
                        <div class="section-card">
                            <div class="sc-header" style="margin-bottom:14px;">
                                <div>
                                    <div class="sc-title">Target K3 Bulanan</div>
                                    <div class="sc-sub">Progress pencapaian program K3</div>
                                </div>
                            </div>

                            <div class="goal-item">
                                <div class="goal-row">
                                    <span class="goal-name">Inspeksi APD Selesai</span>
                                    <span class="goal-nums">94 / 100</span>
                                </div>
                                <div class="goal-bar-track">
                                    <div class="goal-bar-fill" style="width:94%;background:#2D4B9E;"></div>
                                </div>
                            </div>

                            <div class="goal-item">
                                <div class="goal-row">
                                    <span class="goal-name">Pelatihan K3 Selesai</span>
                                    <span class="goal-nums">38 / 50</span>
                                </div>
                                <div class="goal-bar-track">
                                    <div class="goal-bar-fill" style="width:76%;background:#D97706;"></div>
                                </div>
                            </div>

                            <div class="goal-item" style="margin-bottom:0;">
                                <div class="goal-row">
                                    <span class="goal-name">Target Hari Zero Accident</span>
                                    <span class="goal-nums">127 / 150</span>
                                </div>
                                <div class="goal-bar-track">
                                    <div class="goal-bar-fill" style="width:85%;background:#1A7A3C;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="section-card" style="flex:1;">
                            <div class="sc-header" style="margin-bottom:8px;">
                                <div>
                                    <div class="sc-title">Aktivitas K3 Terkini</div>
                                    <div class="sc-sub">24 jam terakhir</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="act-icon" style="background:rgba(26,122,60,0.09);">
                                    <svg style="width:14px;height:14px;color:#1A7A3C" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="act-text">Inspeksi APD rutin area produksi Line 2 telah selesai
                                        dilakukan.</div>
                                    <div class="act-time">2 jam lalu</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="act-icon" style="background:rgba(217,119,6,0.09);">
                                    <svg style="width:14px;height:14px;color:#D97706" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="act-text">Near-miss tergelincir dilaporkan di area gudang material.
                                    </div>
                                    <div class="act-time">5 jam lalu</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="act-icon" style="background:rgba(45,75,158,0.09);">
                                    <svg style="width:14px;height:14px;color:#2D4B9E" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="act-text">Pelatihan K3 dasar untuk 15 karyawan baru telah diselesaikan.
                                    </div>
                                    <div class="act-time">1 hari lalu</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="healthDashboard" class="dashboard-panel">
                <div class="health-grid">
                    <div class="health-card">
                        <div class="label">Hipertensi</div>
                        <div class="value">14</div>
                        <div class="sub">orang bulan ini</div>
                        <div class="health-badge">▲ 3 vs bulan lalu</div>
                    </div>
                    <div class="health-card">
                        <div class="label">Gula Darah Tinggi</div>
                        <div class="value">8</div>
                        <div class="sub">orang bulan ini</div>
                        <div class="health-badge">▲ 1 vs bulan lalu</div>
                    </div>
                    <div class="health-card">
                        <div class="label">Asam Urat Tinggi</div>
                        <div class="value">11</div>
                        <div class="sub">orang bulan ini</div>
                        <div class="health-badge">▲ 2 vs bulan lalu</div>
                    </div>
                    <div class="health-card">
                        <div class="label">Kolesterol Tinggi</div>
                        <div class="value">9</div>
                        <div class="sub">orang bulan ini</div>
                        <div class="health-badge">▲ 1 vs bulan lalu</div>
                    </div>
                </div>

                <div class="bottom-row">
                    <div class="left-panel">
                        <div class="section-card">
                            <div class="sc-header">
                                <div>
                                    <div class="sc-title">Pemeriksaan Kesehatan Karyawan</div>
                                    <div class="sc-sub">Ringkasan data kesehatan bulanan (data dummy)</div>
                                </div>
                            </div>
                            <div class="health-grid">
                                <div class="health-card">
                                    <div class="label">Demam</div>
                                    <div class="value">5</div>
                                    <div class="sub">kasus bulan ini</div>
                                    <div class="health-badge">● 2 aktif</div>
                                </div>
                                <div class="health-card">
                                    <div class="label">Penyakit Kronik</div>
                                    <div class="value">6</div>
                                    <div class="sub">temuan bulan ini</div>
                                    <div class="health-badge">● Perlu monitoring</div>
                                </div>
                                <div class="health-card">
                                    <div class="label">Penyakit Menular</div>
                                    <div class="value">4</div>
                                    <div class="sub">temuan bulan ini</div>
                                    <div class="health-badge">● Tindak lanjut cepat</div>
                                </div>
                                <div class="health-card">
                                    <div class="label">Monitoring Penyakit Menular</div>
                                    <div class="value">7</div>
                                    <div class="sub">kasus terpantau</div>
                                    <div class="health-badge">● 100% tercatat</div>
                                </div>
                            </div>

                            <div class="health-chart-grid">
                                <div class="health-chart-card">
                                    <div class="sc-title" style="margin-bottom: 8px;">Tren Kondisi Kesehatan Bulanan
                                    </div>
                                    <div style="height: 220px; position: relative;">
                                        <canvas id="healthTrendChart"></canvas>
                                    </div>
                                </div>
                                <div class="health-chart-card">
                                    <div class="sc-title" style="margin-bottom: 8px;">Distribusi Penyakit Menular &
                                        Kronik</div>
                                    <div style="height: 220px; position: relative;">
                                        <canvas id="healthDiseaseChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="right-panel">
                        <div class="section-card">
                            <div class="sc-header">
                                <div>
                                    <div class="sc-title">Laporan Penyakit Menular & Kronik</div>
                                    <div class="sc-sub">Pencatatan temuan penyakit yang perlu dipantau</div>
                                </div>
                            </div>
                            <div class="health-list">
                                <div class="health-list-item"><span>TBC</span><strong>2 kasus</strong></div>
                                <div class="health-list-item"><span>Cacar Air</span><strong>1 kasus</strong></div>
                                <div class="health-list-item"><span>Hepatitis B</span><strong>1 kasus</strong></div>
                                <div class="health-list-item"><span>Monitoring Penyakit Menular</span><strong>7 orang
                                        dipantau</strong></div>
                            </div>
                        </div>
                        <div class="section-card" style="flex:1;">
                            <div class="sc-header">
                                <div>
                                    <div class="sc-title">Status Pemantauan Kesehatan</div>
                                    <div class="sc-sub">Aktivitas observasi dan tindak lanjut</div>
                                </div>
                            </div>
                            <div class="health-list">
                                <div class="health-list-item"><span>Rutin Pemeriksaan</span><strong>92%</strong></div>
                                <div class="health-list-item"><span>Pelaporan Mingguan</span><strong>88%</strong></div>
                                <div class="health-list-item"><span>Tindak Lanjut Cepat</span><strong>76%</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const fjmBlue = '#2D4B9E',
            fjmRed = '#D0021B',
            fjmGreen = '#1A7A3C',
            fjmAmber = '#D97706';

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function mkSparkline(id, data, color) {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map((_, i) => i),
                    datasets: [{
                        data,
                        borderColor: color,
                        borderWidth: 1.5,
                        fill: true,
                        backgroundColor: color + '18',
                        pointRadius: 0,
                        tension: 0.4
                    }]
                },
                options: {
                    animation: false, // <-- MATIKAN ANIMASI DI SINI
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    }
                }
            });
        }
        mkSparkline('spark1', [95, 98, 100, 104, 106, 108, 110, 112, 114, 116, 118, 119, 120, 121, 122, 123, 124, 125,
            126, 127
        ], fjmGreen);
        mkSparkline('spark2', [8, 7, 8, 6, 6, 5, 6, 5, 4, 5, 4, 4, 3, 4, 3, 3, 4, 3, 3, 3], fjmRed);
        mkSparkline('spark3', [86, 87, 88, 87, 89, 90, 90, 91, 92, 91, 92, 93, 92, 93, 94, 93, 94, 94, 94, 94],
            fjmBlue);
        mkSparkline('spark4', [10, 12, 14, 15, 17, 18, 20, 22, 24, 26, 27, 29, 30, 32, 33, 34, 35, 36, 37, 38],
            fjmAmber);

        const areaCtx = document.getElementById('areaChart');
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        new Chart(areaCtx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: 'Insiden',
                        data: [2, 1, 2, 1, 1, 2, 1, 1, 2, 1, 1, null],
                        borderColor: fjmRed,
                        backgroundColor: 'rgba(208,2,27,0.08)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: fjmRed
                    },
                    {
                        label: 'Near Miss',
                        data: [4, 5, 3, 6, 5, 4, 6, 5, 4, null, null, null],
                        borderColor: fjmAmber,
                        backgroundColor: 'rgba(217,119,6,0.06)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: fjmAmber
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 8,
                            boxHeight: 8,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 11,
                                family: 'Plus Jakarta Sans'
                            },
                            color: '#64748B'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1A1D2E',
                        titleColor: '#fff',
                        bodyColor: 'rgba(255,255,255,0.7)',
                        padding: 10,
                        cornerRadius: 8,
                        titleFont: {
                            size: 11,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 11
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Plus Jakarta Sans'
                            },
                            color: '#94A3B8'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(0,0,0,0.04)'
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Plus Jakarta Sans'
                            },
                            color: '#94A3B8',
                            stepSize: 2
                        }
                    }
                }
            }
        });

        const donutCtx = document.getElementById('donutChart');
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Diproses', 'Investigasi', 'Eskalasi'],
                datasets: [{
                    data: [6, 3, 2, 1],
                    backgroundColor: [fjmGreen, fjmAmber, fjmBlue, fjmRed],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1A1D2E',
                        titleColor: '#fff',
                        bodyColor: 'rgba(255,255,255,0.7)',
                        padding: 8,
                        cornerRadius: 8,
                        titleFont: {
                            size: 11,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 11
                        }
                    }
                }
            }
        });

        const healthTrendCtx = document.getElementById('healthTrendChart');
        if (healthTrendCtx) {
            new Chart(healthTrendCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Hipertensi',
                        data: [3, 4, 5, 4, 6, 5],
                        borderColor: fjmRed,
                        backgroundColor: 'rgba(208,2,27,0.10)',
                        tension: 0.35,
                        fill: true,
                        pointRadius: 3
                    }, {
                        label: 'Gula Darah Tinggi',
                        data: [2, 2, 3, 3, 4, 3],
                        borderColor: fjmAmber,
                        backgroundColor: 'rgba(217,119,6,0.10)',
                        tension: 0.35,
                        fill: true,
                        pointRadius: 3
                    }, {
                        label: 'Kolesterol Tinggi',
                        data: [1, 2, 2, 2, 3, 2],
                        borderColor: fjmBlue,
                        backgroundColor: 'rgba(45,75,158,0.10)',
                        tension: 0.35,
                        fill: true,
                        pointRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 8,
                                boxHeight: 8,
                                font: {
                                    size: 11,
                                    family: 'Plus Jakarta Sans'
                                },
                                color: '#64748B'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#94A3B8'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#94A3B8'
                            }
                        }
                    }
                }
            });
        }

        const healthDiseaseCtx = document.getElementById('healthDiseaseChart');
        if (healthDiseaseCtx) {
            new Chart(healthDiseaseCtx, {
                type: 'bar',
                data: {
                    labels: ['TBC', 'Cacar Air', 'Hepatitis B', 'Kronik', 'Menular'],
                    datasets: [{
                        label: 'Jumlah Temuan',
                        data: [2, 1, 1, 6, 4],
                        backgroundColor: [fjmRed, fjmAmber, fjmBlue, fjmGreen, '#8B5CF6'],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#94A3B8'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#94A3B8'
                            }
                        }
                    }
                }
            });
        }

        function setTab(el, val) {
            document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
        }

        function switchDashboardTab(tabName) {
            document.querySelectorAll('.dashboard-tab').forEach(button => {
                button.classList.toggle('active', button.dataset.tab === tabName);
            });
            document.querySelectorAll('.dashboard-panel').forEach(panel => {
                panel.classList.toggle('active', panel.id === tabName);
            });
        }

        document.querySelectorAll('.dashboard-tab').forEach(button => {
            button.addEventListener('click', () => switchDashboardTab(button.dataset.tab));
        });
    </script>

    <script>
        function exportDashboardToPDF() {

            console.log("Export diklik");

            const element = document.querySelector(".dashboard-panel.active");
            console.log(element);

            html2pdf()
                .from(element)
                .save();

        }
    </script>
</body>

</html>
