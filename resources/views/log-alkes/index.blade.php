<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Penggunaan Alat Kesehatan — PT. Fokus Jasa Mitra</title>
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
        }

        .filter-search input:focus {
            border-color: #2D4B9E;
        }

        .filter-search .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
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
            min-width: 160px;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-date {
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 12px;
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

        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 900px;
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

        .td-name-cell {
            display: flex;
            align-items: center;
            gap: 9px;
            white-space: nowrap;
        }

        .td-avatar {
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: #E0E7FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            color: #2D4B9E;
            flex-shrink: 0;
        }

        .td-name-main {
            font-weight: 700;
            color: #1A1D2E;
            line-height: 1.3;
        }

        .td-name-sub {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
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

        .sp-blue {
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
        }

        .sp-gray {
            background: rgba(100, 116, 139, 0.09);
            color: #64748B;
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

        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pagination-info {
            font-size: 11px;
            color: #94A3B8;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .per-page-select {
            height: 28px;
            padding: 0 24px 0 8px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 11px;
            font-weight: 700;
            color: #1A1D2E;
            cursor: pointer;
        }

        .pagination-pages {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-wrap: wrap;
        }

        .page-btn {
            min-width: 28px;
            height: 28px;
            padding: 0 6px;
            border-radius: 7px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #fff;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            cursor: pointer;
        }

        .page-btn:hover:not(:disabled):not(.active) {
            background: #F0F4FF;
            border-color: rgba(45, 75, 158, 0.25);
        }

        .page-btn.active {
            background: #2D4B9E;
            border-color: #2D4B9E;
            color: #fff;
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .page-ellipsis {
            font-size: 11px;
            color: #94A3B8;
            padding: 0 2px;
        }

        .hamburger-btn {
            display: none;
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
        }

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
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
            opacity: 1;
        }

        .modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            width: 380px;
            max-width: calc(100vw - 32px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .modal-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(208, 2, 27, 0.09);
            color: #D0021B;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 8px;
        }

        .modal-desc {
            font-size: 12.5px;
            line-height: 1.55;
            color: #64748B;
            margin-bottom: 20px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-modal-cancel {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            color: #64748B;
            cursor: pointer;
        }

        .btn-modal-cancel:hover {
            background: #F8F9FF;
        }

        .btn-modal-confirm {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: #2D4B9E;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
        }

        .btn-modal-danger {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: #D0021B;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 300;
            display: flex;
            flex-direction: column;
            gap: 10px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(26, 122, 60, 0.1);
            color: #1A7A3C;
            flex-shrink: 0;
        }

        .toast-error .toast-icon {
            background: rgba(208, 2, 27, 0.1);
            color: #D0021B;
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
        }

        .toast-close {
            background: none;
            border: none;
            color: #94A3B8;
            cursor: pointer;
            font-size: 14px;
            margin-left: auto;
            flex-shrink: 0;
        }

        .btn-row-action {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: transparent;
            cursor: pointer;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            margin-right: 6px;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-row-action:hover {
            background: #F8F9FF;
        }

        .form-modal-box {
            width: 560px;
            max-width: calc(100vw - 32px);
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .form-modal-header {
            margin-bottom: 14px;
        }

        .form-modal-body {
            overflow-y: auto;
            padding-right: 4px;
        }

        .form-section-title {
            font-size: 11px;
            font-weight: 800;
            color: #2D4B9E;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin: 14px 0 8px;
        }

        .form-section-title:first-child {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 14px;
        }

        .form-group.span-2 {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 5px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            background: #fff;
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            outline: none;
        }

        .form-input,
        .form-select {
            height: 38px;
        }

        .form-textarea {
            padding: 8px 12px;
            resize: none;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #2D4B9E;
        }

        .picker-wrap {
            position: relative;
        }

        .picker-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            max-height: 220px;
            overflow-y: auto;
            z-index: 20;
            margin-top: 4px;
            display: none;
        }

        .picker-dropdown.open {
            display: block;
        }

        .picker-item {
            padding: 8px 10px;
            cursor: pointer;
            font-size: 12px;
            border-bottom: 1px solid #F1F5F9;
        }

        .picker-item:last-child {
            border-bottom: none;
        }

        .picker-item:hover {
            background: #F8F9FF;
        }

        .picker-item-name {
            font-weight: 700;
            color: #1A1D2E;
        }

        .picker-item-sub {
            font-size: 10.5px;
            color: #94A3B8;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.span-2 {
                grid-column: span 1;
            }
        }

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
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div id="main-content">
        @include('partials.topbar')

        <div id="page-content">

            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Master Data · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">PENGGUNAAN <span>ALAT KESEHATAN</span></div>
                        <div class="pg-sub">Catat pemakaian alat kesehatan oleh tenaga kerja.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Catat Penggunaan
                        </button>
                    </div>
                </div>
            </div>

            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari nama atau badge tenaga..."
                            oninput="onSearchInput()" />
                    </div>
                    <select id="filterAlat" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Alat</option>
                    </select>
                    <select id="filterUnitKerja" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Unit Kerja</option>
                    </select>
                    <input type="date" id="filterTglDari" class="filter-date" onchange="onFilterChange()" />
                    <input type="date" id="filterTglSampai" class="filter-date" onchange="onFilterChange()" />
                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data penggunaan...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th style="width:36px;">No</th>
                                <th>Tanggal</th>
                                <th>Tenaga</th>
                                <th>Unit Kerja / Bagian</th>
                                <th>Alat Digunakan</th>
                                <th>Keterangan</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="7">
                                    <div class="skeleton-bar" style="width:100%;height:40px;"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pagination-bar">
                    <div class="pagination-info">
                        <span id="paginationText">—</span>
                        <select id="perPageSelect" class="per-page-select" onchange="onPerPageChange()">
                            <option value="10">10 / halaman</option>
                            <option value="25">25 / halaman</option>
                            <option value="50">50 / halaman</option>
                        </select>
                    </div>
                    <div class="pagination-pages" id="paginationPages"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- ══════ MODAL FORM ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Catat Penggunaan Alat</div>
                <div class="pg-sub" style="margin:0;">Pilih tenaga dan alat yang digunakan.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Tenaga Pengguna</div>
                <div class="picker-wrap" style="margin-bottom:10px;">
                    <input type="text" id="pegawaiPickerInput" class="form-input"
                        placeholder="Cari nama atau badge tenaga..." oninput="onPegawaiPickerInput()"
                        autocomplete="off" />
                    <div class="picker-dropdown" id="pegawaiPickerDropdown"></div>
                </div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Badge</label><input type="text"
                            id="fIdKaryawan" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Nama Pengguna</label><input type="text"
                            id="fNamaPengguna" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Jabatan</label><input type="text"
                            id="fJabatan" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Unit Kerja</label><input type="text"
                            id="fUnitKerja" class="form-input" readonly style="background:#F8FAFC;" /></div>
                </div>

                <div class="form-section-title">Alat Kesehatan</div>
                <div class="picker-wrap" style="margin-bottom:10px;">
                    <input type="text" id="alatPickerInput" class="form-input"
                        placeholder="Cari jenis alat, merk, atau type..." oninput="onAlatPickerInput()"
                        autocomplete="off" />
                    <div class="picker-dropdown" id="alatPickerDropdown"></div>
                </div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Alat Terpilih</label><input type="text"
                            id="fJenisAlatTerpilih" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Stok Tersedia</label><input type="text"
                            id="fStokTersedia" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Tanggal Penggunaan</label><input type="date"
                            id="fTanggal" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Jumlah Digunakan</label><input type="number"
                            min="1" id="fJumlahDigunakan" class="form-input" value="1" /></div>
                    <div class="form-group span-2"><label class="form-label">Keterangan</label>
                        <textarea id="fKeterangan" class="form-textarea" rows="2" placeholder="MCU Rutin, dsb"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL HAPUS ══════ -->
    <div id="deleteConfirmOverlay" class="modal-overlay" onclick="closeDeleteModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="modal-title">Hapus Data Penggunaan?</div>
            <div class="modal-desc" id="deleteModalDesc">Data akan dihapus permanen dan stok alat akan dikembalikan.
            </div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('penggunaan-alkes.data') }}";
        const STORE_ENDPOINT = "{{ route('penggunaan-alkes.store') }}";
        const BASE_ENDPOINT = "{{ url('/penggunaan-alkes') }}";
        const CARI_PEGAWAI_ENDPOINT = "{{ route('penggunaan-alkes.cari-pegawai') }}";
        const CARI_ALAT_ENDPOINT = "{{ route('penggunaan-alkes.cari-alat') }}";
        const DAFTAR_ALAT_ENDPOINT = "{{ route('penggunaan-alkes.daftar-alat') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            stok_alkes_id: '',
            unit_kerja: '',
            tanggal_dari: '',
            tanggal_sampai: '',
            page: 1,
            per_page: 10
        };
        let searchDebounce = null,
            alatListLoaded = false,
            currentEditId = null,
            currentDeleteId = null;
        let selectedAlatId = null;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function initials(name) {
            if (!name || name === '-') return '—';
            const p = name.trim().split(/\s+/);
            return ((p[0]?.[0] || '') + (p[1]?.[0] || '')).toUpperCase();
        }

        function formatDate(d) {
            if (!d) return '-';
            const dt = new Date(d);
            return isNaN(dt.getTime()) ? d : dt.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            const iconSvg = type === 'error' ?
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>' :
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>';
            toast.innerHTML =
                `<div class="toast-icon">${iconSvg}</div><div><div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div><div class="toast-msg">${escapeHtml(message)}</div></div><button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        // ══════ FILTER & LIST ══════
        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.stok_alkes_id = document.getElementById('filterAlat').value;
            state.unit_kerja = document.getElementById('filterUnitKerja').value;
            state.tanggal_dari = document.getElementById('filterTglDari').value;
            state.tanggal_sampai = document.getElementById('filterTglSampai').value;
            state.page = 1;
            loadData();
        }

        function onPerPageChange() {
            state.per_page = parseInt(document.getElementById('perPageSelect').value, 10);
            state.page = 1;
            loadData();
        }

        function resetFilters() {
            ['searchInput', 'filterAlat', 'filterUnitKerja', 'filterTglDari', 'filterTglSampai'].forEach(id => document
                .getElementById(id).value = '');
            Object.assign(state, {
                search: '',
                stok_alkes_id: '',
                unit_kerja: '',
                tanggal_dari: '',
                tanggal_sampai: '',
                page: 1
            });
            loadData();
        }

        function goToPage(p) {
            state.page = p;
            loadData();
            document.getElementById('page-content').scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        async function loadAlatDropdown() {
            if (alatListLoaded) return;
            try {
                const res = await fetch(DAFTAR_ALAT_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                const select = document.getElementById('filterAlat');
                (json.data || []).forEach(a => {
                    const opt = document.createElement('option');
                    opt.value = a.id;
                    opt.textContent = a.jenis_alat;
                    select.appendChild(opt);
                });
                alatListLoaded = true;
            } catch (e) {
                /* diamkan */
            }
        }

        let unitKerjaLoaded = false;

        function populateUnitKerjaOptions(list) {
            if (unitKerjaLoaded || !list) return;
            const select = document.getElementById('filterUnitKerja');
            list.forEach(u => {
                const opt = document.createElement('option');
                opt.value = u;
                opt.textContent = u;
                select.appendChild(opt);
            });
            unitKerjaLoaded = true;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="7"><div class="empty-state"><div class="empty-state-title">Belum ada data penggunaan</div><div class="empty-state-sub">Klik "Catat Penggunaan" untuk menambahkan.</div></div></td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>${row.no}</td>
                    <td>${formatDate(row.tanggal)}</td>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">${escapeHtml(initials(row.nama_pengguna))}</div>
                            <div><div class="td-name-main">${escapeHtml(row.nama_pengguna)}</div><div class="td-name-sub">${escapeHtml(row.id_karyawan)} · ${escapeHtml(row.jabatan)}</div></div>
                        </div>
                    </td>
                    <td>${escapeHtml(row.unit_kerja)}</td>
                    <td><span class="status-pill sp-blue">${escapeHtml(row.jenis_alat)}</span> <span class="td-name-sub">×${row.jumlah_digunakan}</span></td>
                    <td>${escapeHtml(row.keterangan)}</td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-row-action" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-row-action" onclick="openDeleteModal(${row.id}, ${JSON.stringify(row.nama_pengguna)})" style="color:#D0021B; border-color:rgba(208,2,27,0.25);">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent = meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML =
                `<strong>${meta.total}</strong> catatan penggunaan ditemukan`;
            const container = document.getElementById('paginationPages');
            const current = meta.current_page,
                last = meta.last_page;
            let pages = [1];
            if (current > 3) pages.push('...');
            for (let p = Math.max(2, current - 1); p <= Math.min(last - 1, current + 1); p++) pages.push(p);
            if (current < last - 2) pages.push('...');
            if (last > 1) pages.push(last);
            pages = [...new Set(pages)];
            let html =
                `<button class="page-btn" ${current <= 1 ? 'disabled' : ''} onclick="goToPage(${current - 1})">‹</button>`;
            pages.forEach(p => {
                html += p === '...' ? `<span class="page-ellipsis">…</span>` :
                    `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
            });
            html +=
                `<button class="page-btn" ${current >= last ? 'disabled' : ''} onclick="goToPage(${current + 1})">›</button>`;
            container.innerHTML = html;
        }

        async function loadData() {
            const params = new URLSearchParams();
            Object.entries(state).forEach(([k, v]) => {
                if (v) params.set(k, v);
            });
            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error((await res.json().catch(() => null))?.message || `Status ${res.status}`);
                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
                populateUnitKerjaOptions(json.filter_options?.unit_kerja);
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="7"><div class="error-state">${escapeHtml(e.message)}</div></td></tr>`;
            }
        }

        // ══════ PICKER PEGAWAI ══════
        let pegawaiPickerDebounce = null;

        function onPegawaiPickerInput() {
            clearTimeout(pegawaiPickerDebounce);
            pegawaiPickerDebounce = setTimeout(searchPegawaiPicker, 350);
        }

        async function searchPegawaiPicker() {
            const search = document.getElementById('pegawaiPickerInput').value.trim();
            const dropdown = document.getElementById('pegawaiPickerDropdown');
            if (search.length < 2) {
                dropdown.classList.remove('open');
                return;
            }
            try {
                const res = await fetch(`${CARI_PEGAWAI_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                dropdown.innerHTML = (!json.data || json.data.length === 0) ?
                    `<div class="picker-item" style="color:#94A3B8;">Tidak ada tenaga ditemukan.</div>` :
                    json.data.map(p =>
                        `<div class="picker-item" onclick='pilihPegawai(${JSON.stringify(p).replace(/'/g, "&#39;")})'><div class="picker-item-name">${escapeHtml(p.nama)}</div><div class="picker-item-sub">${escapeHtml(p.badge)} · ${escapeHtml(p.unit_kerja)}</div></div>`
                    ).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihPegawai(p) {
            document.getElementById('fIdKaryawan').value = p.badge;
            document.getElementById('fNamaPengguna').value = p.nama;
            document.getElementById('fJabatan').value = p.jabatan;
            document.getElementById('fUnitKerja').value = p.unit_kerja;
            document.getElementById('pegawaiPickerInput').value = `${p.nama} (${p.badge})`;
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');
        }

        // ══════ PICKER ALAT ══════
        let alatPickerDebounce = null;

        function onAlatPickerInput() {
            clearTimeout(alatPickerDebounce);
            alatPickerDebounce = setTimeout(searchAlatPicker, 350);
        }

        async function searchAlatPicker() {
            const search = document.getElementById('alatPickerInput').value.trim();
            const dropdown = document.getElementById('alatPickerDropdown');
            if (search.length < 1) {
                dropdown.classList.remove('open');
                return;
            }
            try {
                const res = await fetch(`${CARI_ALAT_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                dropdown.innerHTML = (!json.data || json.data.length === 0) ?
                    `<div class="picker-item" style="color:#94A3B8;">Tidak ada alat ditemukan.</div>` :
                    json.data.map(a =>
                        `<div class="picker-item" onclick='pilihAlat(${JSON.stringify(a).replace(/'/g, "&#39;")})'><div class="picker-item-name">${escapeHtml(a.jenis_alat)}</div><div class="picker-item-sub">${escapeHtml(a.merk)} ${escapeHtml(a.type)} · Stok: ${a.stok_tersedia}</div></div>`
                    ).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihAlat(a) {
            selectedAlatId = a.id;
            document.getElementById('fJenisAlatTerpilih').value = a.jenis_alat;
            document.getElementById('fStokTersedia').value = a.stok_tersedia;
            document.getElementById('alatPickerInput').value = `${a.jenis_alat} (${a.merk} ${a.type})`;
            document.getElementById('alatPickerDropdown').classList.remove('open');
        }

        document.addEventListener('click', (e) => {
            const wrapPegawai = document.getElementById('pegawaiPickerInput')?.closest('.picker-wrap');
            if (wrapPegawai && !wrapPegawai.contains(e.target)) document.getElementById('pegawaiPickerDropdown')
                ?.classList.remove('open');
            const wrapAlat = document.getElementById('alatPickerInput')?.closest('.picker-wrap');
            if (wrapAlat && !wrapAlat.contains(e.target)) document.getElementById('alatPickerDropdown')?.classList
                .remove('open');
        });

        // ══════ MODAL FORM ══════
        function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            selectedAlatId = row ? row.stok_alkes_id : null;

            document.getElementById('formModalTitle').textContent = row ? 'Edit Data Penggunaan' : 'Catat Penggunaan Alat';

            document.getElementById('pegawaiPickerInput').value = row ? `${row.nama_pengguna} (${row.id_karyawan})` : '';
            document.getElementById('fIdKaryawan').value = row?.id_karyawan || '';
            document.getElementById('fNamaPengguna').value = row?.nama_pengguna || '';
            document.getElementById('fJabatan').value = row?.jabatan && row.jabatan !== '-' ? row.jabatan : '';
            document.getElementById('fUnitKerja').value = row?.unit_kerja && row.unit_kerja !== '-' ? row.unit_kerja : '';

            document.getElementById('alatPickerInput').value = row ? row.jenis_alat : '';
            document.getElementById('fJenisAlatTerpilih').value = row?.jenis_alat || '';
            document.getElementById('fStokTersedia').value = '';

            document.getElementById('fTanggal').value = row?.tanggal || new Date().toISOString().substring(0, 10);
            document.getElementById('fJumlahDigunakan').value = row?.jumlah_digunakan ?? 1;
            document.getElementById('fKeterangan').value = row?.keterangan && row.keterangan !== '-' ? row.keterangan : '';

            document.getElementById('formModalOverlay').classList.add('open');
        }

        function closeFormModal() {
            document.getElementById('formModalOverlay').classList.remove('open');
            currentEditId = null;
            selectedAlatId = null;
        }

        function closeFormModalOutside(e) {
            if (e.target.id === 'formModalOverlay') closeFormModal();
        }

        async function submitForm() {
            if (!selectedAlatId) {
                showToast('Silakan pilih alat kesehatan terlebih dahulu.', 'error');
                return;
            }

            const btn = document.getElementById('btnSubmitForm');
            btn.disabled = true;
            const originalText = btn.textContent;
            btn.textContent = 'Menyimpan...';

            const payload = {
                tanggal: document.getElementById('fTanggal').value,
                stok_alkes_id: selectedAlatId,
                id_karyawan: document.getElementById('fIdKaryawan').value,
                nama_pengguna: document.getElementById('fNamaPengguna').value,
                jabatan: document.getElementById('fJabatan').value,
                unit_kerja: document.getElementById('fUnitKerja').value,
                jumlah_digunakan: document.getElementById('fJumlahDigunakan').value || 1,
                keterangan: document.getElementById('fKeterangan').value,
            };

            const url = currentEditId ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;
            const method = currentEditId ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify(payload),
                });
                const json = await res.json();
                if (!res.ok) {
                    const firstError = json.errors ? Object.values(json.errors)[0][0] : null;
                    throw new Error(firstError || json.message || `Status ${res.status}`);
                }
                closeFormModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan data.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ══════ MODAL HAPUS ══════
        function openDeleteModal(id, nama) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Data penggunaan oleh "${nama}" akan dihapus dan stok alat dikembalikan. Lanjutkan?`;
            document.getElementById('deleteConfirmOverlay').classList.add('open');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmOverlay').classList.remove('open');
            currentDeleteId = null;
        }

        function closeDeleteModalOutside(e) {
            if (e.target.id === 'deleteConfirmOverlay') closeDeleteModal();
        }

        async function confirmDelete() {
            if (!currentDeleteId) return;
            try {
                const res = await fetch(`${BASE_ENDPOINT}/${currentDeleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);
                closeDeleteModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                closeDeleteModal();
                showToast(e.message || 'Gagal menghapus data.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadAlatDropdown();
            loadData();
        });
    </script>
</body>

</html>
