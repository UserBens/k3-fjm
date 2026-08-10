<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Memo KIB Tenaga Kerja — PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .section-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 16px;
            min-width: 0;
        }

        /* ══════ FILTER BAR ══════ */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .filter-search {
            flex: 1;
            min-width: 220px;
            position: relative;
        }

        .filter-search input {
            width: 100%;
            height: 36px;
            padding: 0 12px 0 34px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: 8px;
            background: #fff;
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            outline: none;
            transition: border 0.2s;
        }

        .filter-search input:focus {
            border-color: #2D4B9E;
        }

        .filter-search .search-icon {
            left: 12px;
        }

        .filter-select {
            height: 36px;
            padding: 0 30px 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 10px center;
            font-size: 12px;
            font-weight: 600;
            color: #1A1D2E;
            cursor: pointer;
            min-width: 150px;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            outline: none;
        }

        .filter-reset {
            height: 36px;
            padding: 0 14px;
        }

        .data-summary {
            font-size: 11px;
            color: #94A3B8;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .data-summary strong {
            color: #1A1D2E;
        }

        /* ══════ TABLE ══════ */
        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 760px;
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
            padding: 10px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            vertical-align: middle;
        }

        .rtable tr:last-child td {
            border-bottom: none;
        }

        .rtable tr:hover td {
            background: #F8F9FF;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
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

        .empty-state,
        .error-state {
            text-align: center;
            padding: 48px 12px;
            color: #94A3B8;
        }

        .empty-state-title,
        .error-state-title {
            font-size: 13px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 3px;
        }

        .empty-state-sub,
        .error-state-sub {
            font-size: 11.5px;
        }

        .skeleton-bar {
            height: 12px;
            border-radius: 6px;
            background: linear-gradient(90deg, #F0F2FA 25%, #E5E9F5 37%, #F0F2FA 63%);
            background-size: 400% 100%;
            animation: shimmer 1.4s ease infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0 50%;
            }
        }

        /* ══════ RESPONSIVE / SIDEBAR ══════ */
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

            .search-box {
                max-width: none;
            }
        }

        @media (max-width: 640px) {
            #topbar {
                padding: 0 12px;
                gap: 8px;
            }

            .tb-name,
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
        }

        /* ══════ MODAL DASAR (overlay + box umum) ══════ */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, 0.5);
            backdrop-filter: blur(2px);
            z-index: 100;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .modal-overlay.open {
            display: flex;
            opacity: 1;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 15px;
            color: #94A3B8;
            cursor: pointer;
            line-height: 1;
            padding: 4px;
        }

        .modal-close:hover {
            color: #1A1D2E;
        }

        /* box khusus modal "picker"/list (dipakai pindah SO) */
        .binaan-modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.94) translateY(8px);
            transition: transform 0.2s ease;
            max-width: calc(100vw - 32px);
            max-height: 85vh;
            display: flex;
            flex-direction: column;
        }

        .modal-overlay.open .binaan-modal-box {
            transform: scale(1) translateY(0);
        }

        .binaan-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .binaan-modal-body {
            overflow-y: auto;
        }

        .binaan-loading,
        .binaan-empty {
            text-align: center;
            padding: 24px 8px;
            font-size: 12px;
            color: #94A3B8;
            font-weight: 600;
        }

        /* ══════ TOAST ══════ */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 300;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #fff;
            border-radius: 10px;
            padding: 12px 14px;
            width: 320px;
            max-width: calc(100vw - 40px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-left: 4px solid #1A7A3C;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.25s ease;
            pointer-events: auto;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .toast.toast-error {
            border-left-color: #D0021B;
        }

        .toast-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(26, 122, 60, 0.1);
            color: #1A7A3C;
            margin-top: 1px;
        }

        .toast-error .toast-icon {
            background: rgba(208, 2, 27, 0.1);
            color: #D0021B;
        }

        .toast-body {
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-size: 12.5px;
            font-weight: 800;
            color: #1A1D2E;
            margin-bottom: 2px;
        }

        .toast-msg {
            font-size: 11.5px;
            color: #64748B;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            color: #94A3B8;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            padding: 2px;
            flex-shrink: 0;
        }

        /* ══════ PANEL MANAJEMEN (grid kiri-kanan) ══════ */
        .mgmt-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 16px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .mgmt-grid {
                grid-template-columns: 1fr;
            }
        }

        .mgmt-so-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .mgmt-so-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #E5E7EB;
            cursor: pointer;
            transition: .15s;
        }

        .mgmt-so-item:hover {
            border-color: #2D4B9E;
            background: #F5F7FD;
        }

        .mgmt-so-item.active-so {
            border-color: #2D4B9E;
            background: #EEF1FB;
        }

        .mgmt-so-name {
            font-weight: 700;
            font-size: 12.5px;
            color: #1A1D2E;
        }

        .mgmt-so-sub {
            font-size: 11px;
            color: #64748B;
            margin-top: 2px;
        }

        .mgmt-empty-hint {
            text-align: center;
            padding: 48px 16px;
            font-size: 12.5px;
            color: #94A3B8;
            font-weight: 600;
        }

        /* ══════ KHUSUS MEMO KIB ══════ */
        .memo-kode-ok {
            font-size: 11px;
            color: #64748B;
            margin-top: 3px;
            max-width: 560px;
        }

        .memo-summary-cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
        }

        @media (max-width: 900px) {
            .memo-summary-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .memo-summary-card {
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
        }

        .memo-summary-card .val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            line-height: 1;
        }

        .memo-summary-card .lbl {
            font-size: 10px;
            color: #64748B;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .memo-summary-card.c-total .val {
            color: #2D4B9E;
        }

        .memo-summary-card.c-aktif .val {
            color: #1A7A3C;
        }

        .memo-summary-card.c-expired .val {
            color: #D0021B;
        }

        .memo-summary-card.c-hampir .val {
            color: #D97706;
        }

        .memo-summary-card.c-tidak .val {
            color: #64748B;
        }

        .zonasi-input {
            width: 110px;
            padding: 5px 8px;
            font-size: 11.5px;
            border: 1px solid #E5E7EB;
            border-radius: 6px;
        }

        .zonasi-input:focus {
            outline: none;
            border-color: #2D4B9E;
        }

        .btn-pindah-so {
            padding: 5px 10px;
            font-size: 10.5px;
            border-radius: 6px;
            border: 1px solid #2D4B9E;
            color: #2D4B9E;
            background: #fff;
            cursor: pointer;
        }

        .btn-pindah-so:hover {
            background: #EEF1FB;
        }

        /* Dropdown Cetak Memo */
        .dropdown-cetak {
            position: relative;
        }

        .dropdown-cetak-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 6px);
            background: #fff;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
            min-width: 160px;
            padding: 6px;
            z-index: 20;
        }

        .dropdown-cetak-menu.open {
            display: block;
        }

        .dropdown-cetak-menu a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            font-size: 11.5px;
            font-weight: 600;
            color: #1A1D2E;
            text-decoration: none;
            border-radius: 6px;
        }

        .dropdown-cetak-menu a:hover {
            background: #F5F7FD;
            color: #2D4B9E;
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

        <div id="page-content">

            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Database Safety Officer · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">MEMO <span>KIB</span></div>
                        <div class="pg-sub">Kelola zonasi &amp; penentuan Safety Officer per tenaga, lalu cetak memo
                            KIB.</div>
                    </div>
                </div>
            </div>

            <div class="section-card">
                <div class="mgmt-grid">
                    <!-- KIRI: daftar SO -->
                    <div>
                        <div class="pg-sub" style="margin:0 0 8px; font-weight:700; color:#1A1D2E;">Daftar Safety
                            Officer</div>

                        <div class="filter-search" style="margin-bottom:10px;">
                            <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" id="soSearchInput" placeholder="Cari nama atau badge..."
                                oninput="onSoSearchInput()" />
                        </div>

                        <div class="mgmt-so-list" id="memoSoList" style="max-height:640px; overflow-y:auto;">
                            <div class="binaan-loading">Memuat...</div>
                        </div>
                    </div>

                    <!-- KANAN: ringkasan + detail SO terpilih -->
                    <div>
                        <div id="memoEmptyState" class="mgmt-empty-hint">Klik salah satu Safety Officer di sebelah
                            kiri untuk mengelola memo KIB-nya.</div>

                        <div id="memoDetailWrap" style="display:none;">
                            <div
                                style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
                                <div>
                                    <div class="pg-sub" style="margin:0; font-weight:700; color:#1A1D2E;"
                                        id="memoSoTitle">-</div>
                                    <div class="memo-kode-ok" id="memoKodeOk">-</div>
                                </div>

                                <div class="dropdown-cetak" id="dropdownCetak">
                                    <button class="btn-primary" style="padding:7px 14px; font-size:11.5px;"
                                        onclick="toggleCetakMenu(event)">
                                        <svg style="width:12px;height:12px;" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4H8v4a1 1 0 001 1zm0-13h6a1 1 0 011 1v3H8V5a1 1 0 011-1z" />
                                        </svg>
                                        Cetak Memo
                                        <svg style="width:10px;height:10px;" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div class="dropdown-cetak-menu" id="cetakMenu">
                                        <a href="#" target="_blank" id="btnCetakPdf">
                                            <svg style="width:12px;height:12px;" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Cetak PDF
                                        </a>
                                        <a href="#" target="_blank" id="btnCetakExcel">
                                            <svg style="width:12px;height:12px;" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4h16v16H4V4zm4 4l8 8m0-8l-8 8" />
                                            </svg>
                                            Export Excel
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="memo-summary-cards" id="memoSummaryCards"></div>

                            <div class="rtable-wrap" style="margin-top:14px;">
                                <table class="rtable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Zonasi</th>
                                            <th>Status KIB</th>
                                            <th>Safety Officer</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="memoTableBody">
                                        <tr>
                                            <td colspan="7">
                                                <div class="skeleton-bar" style="width:100%;height:40px;"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ══════ MODAL PINDAH SAFETY OFFICER ══════ -->
    <div class="modal-overlay" id="pindahSOOverlay" onclick="closePindahSOModalOutside(event)">
        <div class="binaan-modal-box" style="width:420px;" onclick="event.stopPropagation()">
            <div class="binaan-modal-header">
                <div class="modal-title">Pindah Safety Officer</div>
                <button class="modal-close" onclick="closePindahSOModal()">✕</button>
            </div>
            <div class="binaan-modal-body">
                <p class="pg-sub" style="margin:0 0 10px;" id="pindahSODesc">Pilih Safety Officer baru untuk tenaga
                    ini.</p>
                <select id="pindahSOSelect" class="filter-select" style="width:100%;"></select>
                <button class="btn-primary" style="width:100%; margin-top:12px; justify-content:center;"
                    onclick="confirmPindahSO()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <script>
        const MEMO_RINGKASAN_ENDPOINT = "{{ route('memo-kib.ringkasan') }}";
        const MEMO_BASE_ENDPOINT = "{{ url('/memo-kib') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        let currentSO = null; // { badge, nama }
        let soSearchDebounce = null;
        let pendingPindahSO = null; // { idApi, nama }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            const iconSvg = type === 'error' ?
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>' :
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>';
            toast.innerHTML = `
                <div class="toast-icon">${iconSvg}</div>
                <div class="toast-body">
                    <div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div>
                    <div class="toast-msg">${escapeHtml(message)}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">✕</button>
            `;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        function onSoSearchInput() {
            clearTimeout(soSearchDebounce);
            soSearchDebounce = setTimeout(loadSoList, 350);
        }

        async function loadSoList() {
            const listEl = document.getElementById('memoSoList');
            const search = document.getElementById('soSearchInput').value.trim();
            listEl.innerHTML = '<div class="binaan-loading">Memuat...</div>';

            try {
                const res = await fetch(`${MEMO_RINGKASAN_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();

                if (!json.data || json.data.length === 0) {
                    listEl.innerHTML = '<div class="binaan-empty">Tidak ada Safety Officer ditemukan.</div>';
                    return;
                }

                listEl.innerHTML = json.data.map(so => `
                    <div class="mgmt-so-item ${currentSO && currentSO.badge === so.badge ? 'active-so' : ''}" onclick='selectSO(${JSON.stringify(so.badge)}, ${JSON.stringify(so.nama)})'>
                        <div>
                            <div class="mgmt-so-name">${escapeHtml(so.nama)}</div>
                            <div class="mgmt-so-sub">${escapeHtml(so.badge)} · ${so.jumlah_tenaga} tenaga</div>
                        </div>
                    </div>
                `).join('');
            } catch (e) {
                listEl.innerHTML = '<div class="binaan-empty" style="color:#D0021B;">Gagal memuat data.</div>';
            }
        }

        function selectSO(badge, nama) {
            currentSO = {
                badge,
                nama
            };
            document.getElementById('memoEmptyState').style.display = 'none';
            document.getElementById('memoDetailWrap').style.display = 'block';
            document.getElementById('memoSoTitle').textContent = `${badge}-${nama}`;
            document.getElementById('btnCetakPdf').href = `${MEMO_BASE_ENDPOINT}/${badge}/cetak?format=pdf`;
            document.getElementById('btnCetakExcel').href = `${MEMO_BASE_ENDPOINT}/${badge}/cetak?format=excel`;
            loadSoList();
            loadRingkasanCard();
            loadDetail();
        }

        async function loadRingkasanCard() {
            if (!currentSO) return;
            try {
                const res = await fetch(`${MEMO_RINGKASAN_ENDPOINT}?search=${encodeURIComponent(currentSO.badge)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                const r = (json.data || []).find(x => x.badge === currentSO.badge);
                if (!r) return;

                document.getElementById('memoKodeOk').textContent = `Kode OK: ${r.kode_ok}`;
                document.getElementById('memoSummaryCards').innerHTML = `
                    <div class="memo-summary-card c-total"><div class="val">${r.jumlah_tenaga}</div><div class="lbl">Jumlah Tenaga</div></div>
                    <div class="memo-summary-card c-aktif"><div class="val">${r.kib_aktif}</div><div class="lbl">KIB Aktif</div></div>
                    <div class="memo-summary-card c-expired"><div class="val">${r.kib_expired}</div><div class="lbl">KIB Expired</div></div>
                    <div class="memo-summary-card c-hampir"><div class="val">${r.kib_hampir_habis}</div><div class="lbl">Hampir Habis</div></div>
                    <div class="memo-summary-card c-tidak"><div class="val">${r.kib_tidak_ditemukan}</div><div class="lbl">Tidak Ditemukan</div></div>
                `;
            } catch (e) {
                /* ringkasan bukan bagian kritikal */ }
        }

        async function loadDetail() {
            if (!currentSO) return;
            const tbody = document.getElementById('memoTableBody');
            tbody.innerHTML =
                '<tr><td colspan="7"><div class="skeleton-bar" style="width:100%;height:40px;"></div></td></tr>';

            try {
                const res = await fetch(`${MEMO_BASE_ENDPOINT}/${currentSO.badge}/detail`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);

                if (!json.data || json.data.length === 0) {
                    tbody.innerHTML =
                        '<tr><td colspan="7"><div class="empty-state"><div class="empty-state-title">Belum ada tenaga binaan</div></div></td></tr>';
                    return;
                }

                const pillClass = {
                    aktif: 'sp-green',
                    expired: 'sp-red',
                    hampir_habis: 'sp-amber',
                    tidak_ditemukan: 'sp-blue'
                };

                tbody.innerHTML = json.data.map(p => `
                    <tr>
                        <td>${p.no}</td>
                        <td>${escapeHtml(p.nama)}</td>
                        <td>${escapeHtml(p.jabatan)}</td>
                        <td><input type="text" class="zonasi-input" value="${escapeHtml(p.zonasi)}" placeholder="Zona I, II..." onchange="saveZonasi('${p.id_api}', this.value)"></td>
                        <td><span class="status-pill ${pillClass[p.status_kib_key] || 'sp-blue'}">${escapeHtml(p.status_kib)}</span></td>
                        <td>${escapeHtml(p.safety_officer)}</td>
                        <td><button class="btn-pindah-so" onclick='openPindahSOModal("${p.id_api}", ${JSON.stringify(p.nama)})'>Pindah SO</button></td>
                    </tr>
                `).join('');
            } catch (e) {
                tbody.innerHTML =
                    `<tr><td colspan="7"><div class="error-state">${escapeHtml(e.message || 'Gagal memuat data.')}</div></td></tr>`;
            }
        }

        async function saveZonasi(idApi, value) {
            try {
                const res = await fetch(`${MEMO_BASE_ENDPOINT}/${idApi}/zonasi`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        zonasi: value
                    })
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan zonasi.', 'error');
            }
        }

        async function openPindahSOModal(idApi, nama) {
            pendingPindahSO = {
                idApi,
                nama
            };
            document.getElementById('pindahSODesc').textContent = `Pindahkan "${nama}" menjadi binaan Safety Officer:`;

            const select = document.getElementById('pindahSOSelect');
            select.innerHTML = '<option>Memuat...</option>';
            document.getElementById('pindahSOOverlay').classList.add('open');

            try {
                const res = await fetch(`${MEMO_BASE_ENDPOINT}/list-so`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                select.innerHTML = (json.data || []).map(so =>
                    `<option value="${escapeHtml(so.badge)}" ${currentSO && so.badge === currentSO.badge ? 'selected' : ''}>${escapeHtml(so.nama)} (${escapeHtml(so.badge)})</option>`
                ).join('');
            } catch (e) {
                select.innerHTML = '<option>Gagal memuat daftar SO</option>';
            }
        }

        function closePindahSOModal() {
            document.getElementById('pindahSOOverlay').classList.remove('open');
            pendingPindahSO = null;
        }

        function closePindahSOModalOutside(e) {
            if (e.target.id === 'pindahSOOverlay') closePindahSOModal();
        }

        async function confirmPindahSO() {
            if (!pendingPindahSO) return;
            const badge = document.getElementById('pindahSOSelect').value;

            try {
                const res = await fetch(`${MEMO_BASE_ENDPOINT}/${pendingPindahSO.idApi}/pindah-so`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        badge_safety_officer: badge
                    })
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);

                closePindahSOModal();
                await loadSoList();
                await loadRingkasanCard();
                await loadDetail();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal memindahkan.', 'error');
            }
        }

        // ══════ DROPDOWN CETAK MEMO ══════
        function toggleCetakMenu(e) {
            e.stopPropagation();
            document.getElementById('cetakMenu').classList.toggle('open');
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('dropdownCetak');
            const menu = document.getElementById('cetakMenu');
            if (wrap && !wrap.contains(e.target)) menu.classList.remove('open');
        });

        document.addEventListener('DOMContentLoaded', loadSoList);
    </script>
</body>

</html>
