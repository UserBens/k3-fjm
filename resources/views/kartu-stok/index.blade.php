<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Kartu Stok Gudang (FIFO/FEFO) — PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bebas+Neue&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --red: #D0021B;
            --green: #1A7A3C;
            --blue: #2D4B9E;
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

        /* SUMMARY CARDS */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        @media (max-width: 900px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .summary-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px;
        }

        .summary-label {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 6px;
        }

        .summary-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            color: #1A1D2E;
            letter-spacing: 0.01em;
        }

        .summary-value.blue {
            color: #2D4B9E;
        }

        .summary-value.green {
            color: #1A7A3C;
        }

        .summary-value.red {
            color: #D0021B;
        }

        /* FILTER BAR */
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

        /* TABLE */
        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 1000px;
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

        .rtable tr.row-item-first td {
            border-top: 2px solid rgba(45, 75, 158, 0.12);
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

        .sp-amber {
            background: rgba(217, 119, 6, 0.09);
            color: #D97706;
        }

        .tipe-badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 7px;
            border-radius: 6px;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.03em;
        }

        .tipe-apd {
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
        }

        .tipe-alkes {
            background: rgba(26, 122, 60, 0.09);
            color: #1A7A3C;
        }

        .saldo-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 17px;
            letter-spacing: 0.02em;
        }

        .empty-state,
        .error-state {
            text-align: center;
            padding: 48px 12px;
            color: #94A3B8;
        }

        .empty-state svg,
        .error-state svg {
            width: 32px;
            height: 32px;
            margin: 0 auto 10px;
            color: #CBD5E1;
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

        /* PAGINATION */
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
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 6px center;
            font-size: 11px;
            font-weight: 700;
            color: #1A1D2E;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
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
            transition: all 0.15s;
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

        @media (max-width: 640px) {
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

            .filter-select {
                min-width: 0;
                flex: 1 1 46%;
            }

            .pagination-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .pagination-pages {
                justify-content: center;
            }
        }

        /* MODAL DETAIL */
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
            transform: scale(0.94) translateY(8px);
            transition: transform 0.2s ease;
        }

        .modal-overlay.open .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 8px;
        }

        .detail-subtitle {
            font-size: 12.5px;
            color: #94A3B8;
            font-weight: 500;
        }

        .detail-modal-box {
            max-width: 560px;
            width: 100%;
        }

        .detail-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .detail-avatar {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2D4B9E, #1A1D2E);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            flex-shrink: 0;
        }

        .detail-modal-body {
            max-height: 65vh;
            overflow-y: auto;
            padding-top: 4px;
        }

        .detail-section {
            margin-bottom: 18px;
            padding-bottom: 16px;
            border-bottom: 1px dashed #E2E8F0;
        }

        .detail-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-section-title {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #2D4B9E;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        .detail-section-title svg {
            width: 14px;
            height: 14px;
        }

        .detail-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 16px;
        }

        .detail-field {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-field.span-2 {
            grid-column: span 2;
        }

        .detail-field label {
            font-size: 11px;
            font-weight: 600;
            color: #94A3B8;
        }

        .detail-field input,
        .detail-field textarea {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 500;
            color: #1E293B;
            font-family: inherit;
            resize: none;
            cursor: default;
        }

        @media (max-width: 640px) {
            .detail-form-grid {
                grid-template-columns: 1fr;
            }

            .detail-field.span-2 {
                grid-column: span 1;
            }
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
            transition: background 0.15s;
        }

        .btn-modal-cancel:hover {
            background: #F8F9FF;
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
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-row-action:hover {
            background: #F8F9FF;
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

    @includeIf('partials.sidebar')
    <div id="sidebar-overlay"></div>

    <div id="main-content">

        @includeIf('partials.topbar')

        <div id="page-content">

            <!-- PAGE HEADER -->
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Laporan Stok · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">KARTU STOK <span>GUDANG</span></div>
                        <div class="pg-sub">Mutasi masuk-keluar per item (FIFO/FEFO) — dihasilkan otomatis dari Log APD
                            &amp; Log Alkes.</div>
                    </div>
                    <div class="pg-actions">
                        <a href="{{ route('kartu-stok.export') }}" class="btn-outline"
                            style="text-decoration:none; display:inline-flex; align-items:center; gap:5px;">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                            </svg>
                            Export CSV
                        </a>
                        {{-- <button class="btn-primary" onclick="loadData()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Muat Ulang
                        </button> --}}
                    </div>
                </div>
            </div>

            <!-- SUMMARY -->
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Total Baris Mutasi</div>
                    <div class="summary-value" id="sumTotalBaris">—</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Item APD</div>
                    <div class="summary-value blue" id="sumItemApd">—</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Item Alkes</div>
                    <div class="summary-value green" id="sumItemAlkes">—</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Item Saldo ≤ 0</div>
                    <div class="summary-value red" id="sumSaldoHabis">—</div>
                </div>
            </div>

            <!-- FILTER BAR -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput"
                            placeholder="Cari kode item, nama item, no. dokumen, jenis transaksi..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterTipeItem" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Tipe Item</option>
                        <option value="APD">APD</option>
                        <option value="ALKES">Alkes</option>
                    </select>

                    <select id="filterKodeItem" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Kode Item</option>
                    </select>

                    <input type="date" id="filterTanggalDari" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal Dari" />
                    <input type="date" id="filterTanggalSampai" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal Sampai" />

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat kartu stok...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode &amp; Nama Item</th>
                                <th>Tanggal</th>
                                <th>Sumber / No. Dok</th>
                                <th>Ket. Transaksi</th>
                                <th style="text-align:right;">Masuk</th>
                                <th style="text-align:right;">Keluar</th>
                                <th style="text-align:right;">Saldo Berjalan</th>
                                <th>Tgl Exp / Ganti</th>
                                <th>Catatan FIFO/FEFO</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="11">
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
                            <option value="25">25 / halaman</option>
                            <option value="50">50 / halaman</option>
                            <option value="100">100 / halaman</option>
                        </select>
                    </div>
                    <div class="pagination-pages" id="paginationPages"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar"><span id="detailAvatarInitial"></span></div>
                    <div>
                        <div class="modal-title" id="detailNamaItem" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailKodeItem">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-section-title">Data Mutasi</div>
                    <div class="detail-form-grid">
                        <div class="detail-field"><label>Tanggal</label><input type="text" id="dTanggal"
                                readonly></div>
                        <div class="detail-field"><label>Tipe Item</label><input type="text" id="dTipeItem"
                                readonly></div>
                        <div class="detail-field"><label>Sumber / No. Dok</label><input type="text" id="dSumber"
                                readonly></div>
                        <div class="detail-field"><label>Ket. Transaksi</label><input type="text"
                                id="dKetTransaksi" readonly></div>
                        <div class="detail-field"><label>Masuk</label><input type="text" id="dMasuk" readonly>
                        </div>
                        <div class="detail-field"><label>Keluar</label><input type="text" id="dKeluar" readonly>
                        </div>
                        <div class="detail-field"><label>Saldo Berjalan</label><input type="text" id="dSaldo"
                                readonly></div>
                        <div class="detail-field"><label>Tgl Exp / Ganti</label><input type="text" id="dTglExp"
                                readonly></div>
                        <div class="detail-field span-2"><label>Catatan FIFO/FEFO</label><input type="text"
                                id="dCatatan" readonly></div>
                    </div>
                </div>
                <div class="detail-section" id="detailExtraSection" style="display:none;">
                    <div class="detail-section-title">Detail Tambahan dari Log</div>
                    <div class="detail-form-grid" id="detailExtraGrid"></div>
                </div>
            </div>
            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        const DATA_ENDPOINT = "{{ route('kartu-stok.data') }}";

        const state = {
            search: '',
            tipe_item: '',
            kode_item: '',
            tanggal_dari: '',
            tanggal_sampai: '',
            page: 1,
            per_page: 25,
        };

        let searchDebounce = null;
        let filterOptionsLoaded = false;
        let lastRows = [];

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function display(value, fallback = '-') {
            return (value === null || value === undefined || value === '') ? fallback : value;
        }

        function initials(name) {
            if (!name || name === '-') return '—';
            const parts = String(name).trim().split(/\s+/);
            return ((parts[0]?.[0] || '') + (parts[1]?.[0] || '')).toUpperCase();
        }

        function formatDate(dateStr) {
            if (!dateStr) return '-';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return dateStr;
            return d.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function ketPillClass(ket) {
            if (!ket) return 'sp-gray';
            if (ket.startsWith('MASUK')) return 'sp-blue';
            if (ket === 'SALDO AWAL') return 'sp-gray';
            if (ket.includes('RUSAK') || ket.includes('HILANG')) return 'sp-amber';
            return 'sp-green';
        }

        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.tipe_item = document.getElementById('filterTipeItem').value;
            state.kode_item = document.getElementById('filterKodeItem').value;
            state.tanggal_dari = document.getElementById('filterTanggalDari').value;
            state.tanggal_sampai = document.getElementById('filterTanggalSampai').value;
            state.page = 1;
            loadData();
        }

        function onPerPageChange() {
            state.per_page = parseInt(document.getElementById('perPageSelect').value, 10);
            state.page = 1;
            loadData();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterTipeItem').value = '';
            document.getElementById('filterKodeItem').value = '';
            document.getElementById('filterTanggalDari').value = '';
            document.getElementById('filterTanggalSampai').value = '';
            Object.assign(state, {
                search: '',
                tipe_item: '',
                kode_item: '',
                tanggal_dari: '',
                tanggal_sampai: '',
                page: 1
            });
            loadData();
        }

        function goToPage(page) {
            state.page = page;
            loadData();
            document.getElementById('page-content').scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function populateFilterOptions(options) {
            if (filterOptionsLoaded || !options) return;
            const select = document.getElementById('filterKodeItem');
            (options.kode_item || []).forEach(val => {
                const opt = document.createElement('option');
                opt.value = val;
                opt.textContent = val;
                select.appendChild(opt);
            });
            filterOptionsLoaded = true;
        }

        function updateSummaryCards(rows) {
            const totalBaris = rows.length;
            const apdItems = new Set(rows.filter(r => r.tipe_item === 'APD').map(r => r.kode_item));
            const alkesItems = new Set(rows.filter(r => r.tipe_item === 'ALKES').map(r => r.kode_item));

            // Ambil saldo TERAKHIR per kode_item dari baris yang sedang ditampilkan (halaman berjalan)
            const lastSaldoPerItem = {};
            rows.forEach(r => {
                lastSaldoPerItem[r.kode_item] = r.saldo;
            });
            const habisCount = Object.values(lastSaldoPerItem).filter(s => s <= 0).length;

            document.getElementById('sumTotalBaris').textContent = totalBaris;
            document.getElementById('sumItemApd').textContent = apdItems.size;
            document.getElementById('sumItemAlkes').textContent = alkesItems.size;
            document.getElementById('sumSaldoHabis').textContent = habisCount;
        }

        function renderTable(rows) {
            lastRows = rows;
            const tbody = document.getElementById('tableBody');

            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
                <tr><td colspan="11">
                    <div class="empty-state">
                        <div class="empty-state-title">Data tidak ditemukan</div>
                        <div class="empty-state-sub">Coba ubah kata kunci pencarian atau filter yang digunakan.</div>
                    </div>
                </td></tr>`;
                return;
            }

            let prevKode = null;
            tbody.innerHTML = rows.map(row => {
                const isFirstOfItem = row.kode_item !== prevKode;
                prevKode = row.kode_item;
                const tipeClass = row.tipe_item === 'APD' ? 'tipe-apd' : 'tipe-alkes';

                return `
                <tr class="${isFirstOfItem ? 'row-item-first' : ''}">
                    <td>${row.no}</td>
                    <td>
                        <div class="td-name-main">${escapeHtml(row.kode_item)}</div>
                        <div class="td-name-sub">${escapeHtml(row.nama_item)} <span class="tipe-badge ${tipeClass}" style="margin-left:4px;">${row.tipe_item}</span></div>
                    </td>
                    <td>${formatDate(row.tanggal)}</td>
                    <td class="td-name-sub" style="font-weight:600; color:#475569;">${escapeHtml(display(row.sumber))}</td>
                    <td><span class="status-pill ${ketPillClass(row.ket_transaksi)}">${escapeHtml(row.ket_transaksi)}</span></td>
                    <td style="text-align:right; color:${row.masuk > 0 ? '#1A7A3C' : '#94A3B8'}; font-weight:700;">${row.masuk > 0 ? row.masuk : '-'}</td>
                    <td style="text-align:right; color:${row.keluar > 0 ? '#D0021B' : '#94A3B8'}; font-weight:700;">${row.keluar > 0 ? row.keluar : '-'}</td>
                    <td style="text-align:right;"><span class="saldo-value">${row.saldo}</span></td>
                    <td class="td-name-sub">${formatDate(row.tgl_exp)}</td>
                    <td class="td-name-sub" style="max-width:180px; white-space:normal; line-height:1.4;">${escapeHtml(display(row.catatan))}</td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-row-action" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                            <svg style="width:14px;height:14px; color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </button>
                    </td>
                </tr>`;
            }).join('');

            updateSummaryCards(rows);
        }

        function renderError(message) {
            document.getElementById('tableBody').innerHTML = `
        <tr><td colspan="11">
            <div class="error-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                </svg>
                <div class="error-state-title">Gagal memuat data</div>
                <div class="error-state-sub">${escapeHtml(message)}</div>
            </div>
        </td></tr>`;
            document.getElementById('paginationText').textContent = '—';
            document.getElementById('paginationPages').innerHTML = '';
            document.getElementById('dataSummary').textContent = 'Gagal memuat kartu stok.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} baris mutasi` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> baris mutasi ditemukan`;

            const container = document.getElementById('paginationPages');
            const current = meta.current_page;
            const last = meta.last_page;

            let pages = [];
            const addPage = p => pages.push(p);
            const addEllipsis = () => pages.push('...');

            addPage(1);
            if (current > 3) addEllipsis();
            for (let p = Math.max(2, current - 1); p <= Math.min(last - 1, current + 1); p++) addPage(p);
            if (current < last - 2) addEllipsis();
            if (last > 1) addPage(last);
            pages = [...new Set(pages)];

            let html =
                `<button class="page-btn" ${current <= 1 ? 'disabled' : ''} onclick="goToPage(${current - 1})">‹</button>`;
            pages.forEach(p => {
                html += p === '...' ?
                    `<span class="page-ellipsis">…</span>` :
                    `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
            });
            html +=
                `<button class="page-btn" ${current >= last ? 'disabled' : ''} onclick="goToPage(${current + 1})">›</button>`;
            container.innerHTML = html;
        }

        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.tipe_item) params.set('tipe_item', state.tipe_item);
            if (state.kode_item) params.set('kode_item', state.kode_item);
            if (state.tanggal_dari) params.set('tanggal_dari', state.tanggal_dari);
            if (state.tanggal_sampai) params.set('tanggal_sampai', state.tanggal_sampai);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) {
                    const errJson = await res.json().catch(() => null);
                    throw new Error(errJson?.message || `Server merespons status ${res.status}`);
                }
                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
                populateFilterOptions(json.filter_options);
            } catch (e) {
                renderError(e.message || 'Terjadi kesalahan tak terduga.');
            }
        }

        function openDetailModal(row) {
            document.getElementById('detailAvatarInitial').textContent = initials(row.nama_item);
            document.getElementById('detailNamaItem').textContent = row.nama_item || '-';
            document.getElementById('detailKodeItem').textContent = `${row.kode_item} · ${row.tipe_item}`;

            document.getElementById('dTanggal').value = formatDate(row.tanggal);
            document.getElementById('dTipeItem').value = row.tipe_item;
            document.getElementById('dSumber').value = display(row.sumber);
            document.getElementById('dKetTransaksi').value = display(row.ket_transaksi);
            document.getElementById('dMasuk').value = row.masuk;
            document.getElementById('dKeluar').value = row.keluar;
            document.getElementById('dSaldo').value = row.saldo;
            document.getElementById('dTglExp').value = formatDate(row.tgl_exp);
            document.getElementById('dCatatan').value = display(row.catatan);

            const extraSection = document.getElementById('detailExtraSection');
            const extraGrid = document.getElementById('detailExtraGrid');
            const detail = row.detail || {};
            const entries = Object.entries(detail).filter(([, v]) => v !== null && v !== '' && v !== undefined);

            if (entries.length === 0) {
                extraSection.style.display = 'none';
                extraGrid.innerHTML = '';
            } else {
                extraSection.style.display = 'block';
                extraGrid.innerHTML = entries.map(([key, val]) => {
                    const label = key.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                    return `<div class="detail-field"><label>${escapeHtml(label)}</label><input type="text" value="${escapeHtml(val)}" readonly></div>`;
                }).join('');
            }

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
