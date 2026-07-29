<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>HIRADC — PT. Fokus Jasa Mitra</title>
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

        ::-webkit-scrollbar-thumb {
            background: rgba(45, 75, 158, .25);
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

        .page-hdr-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 2px;
        }

        .pg-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .pg-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            letter-spacing: .02em;
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
                opacity: .35
            }
        }

        .btn-primary {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            background: #2D4B9E;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary:hover {
            background: #1A3C8A;
        }

        .btn-outline {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid rgba(45, 75, 158, .25);
            font-size: 11.5px;
            font-weight: 700;
            color: #2D4B9E;
            background: #fff;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: #F0F4FF;
        }

        .section-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .06);
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
            border: 1px solid rgba(0, 0, 0, .09);
            border-radius: 8px;
            font-size: 12.5px;
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
            border: 1px solid rgba(0, 0, 0, .09);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 10px center;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            min-width: 150px;
            appearance: none;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            outline: none;
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
            min-width: 1000px;
            border-collapse: collapse;
        }

        .rtable th {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 0 8px 8px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, .05);
            white-space: nowrap;
        }

        .rtable td {
            font-size: 12px;
            padding: 10px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, .04);
            vertical-align: middle;
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
            background: rgba(26, 122, 60, .09);
            color: #1A7A3C;
        }

        .sp-amber {
            background: rgba(217, 119, 6, .09);
            color: #D97706;
        }

        .sp-red {
            background: rgba(208, 2, 27, .08);
            color: #D0021B;
        }

        .sp-blue {
            background: rgba(45, 75, 158, .09);
            color: #2D4B9E;
        }

        .sp-gray {
            background: rgba(100, 116, 139, .09);
            color: #64748B;
        }

        .empty-state {
            text-align: center;
            padding: 48px 12px;
            color: #94A3B8;
        }

        .empty-state-title {
            font-size: 13px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 3px;
        }

        .empty-state-sub {
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
                background-position: 100% 50%
            }

            100% {
                background-position: 0 50%
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
            border-top: 1px solid rgba(0, 0, 0, .05);
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
            border: 1px solid rgba(0, 0, 0, .09);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 6px center;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            appearance: none;
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
            border: 1px solid rgba(0, 0, 0, .08);
            background: #fff;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            cursor: pointer;
        }

        .page-btn:hover:not(:disabled):not(.active) {
            background: #F0F4FF;
            border-color: rgba(45, 75, 158, .25);
        }

        .page-btn.active {
            background: #2D4B9E;
            border-color: #2D4B9E;
            color: #fff;
        }

        .page-btn:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, .5);
            backdrop-filter: blur(2px);
            z-index: 100;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .2s ease;
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
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
            transform: scale(.94) translateY(8px);
            transition: transform .2s ease;
        }

        .modal-overlay.open .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(208, 2, 27, .09);
            color: #D0021B;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: .02em;
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
            border: 1px solid rgba(0, 0, 0, .09);
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

        .btn-modal-confirm:hover {
            background: #1A3C8A;
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

        .btn-modal-danger:hover {
            background: #A80115;
        }

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
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
            border-left: 4px solid #1A7A3C;
            opacity: 0;
            transform: translateX(20px);
            transition: all .25s ease;
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
            background: rgba(26, 122, 60, .1);
            color: #1A7A3C;
            margin-top: 1px;
        }

        .toast-error .toast-icon {
            background: rgba(208, 2, 27, .1);
            color: #D0021B;
        }

        .toast-title {
            font-size: 12.5px;
            font-weight: 800;
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
        }

        .btn-row-action:hover {
            background: #F8F9FF;
        }

        .form-modal-box {
            width: 720px;
            max-width: calc(100vw - 32px);
            max-height: 90vh;
            display: flex;
            flex-direction: column;
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
            letter-spacing: .06em;
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
            border: 1px solid rgba(0, 0, 0, .09);
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
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

        .form-select {
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 12px center;
            appearance: none;
            cursor: pointer;
        }

        .risk-badge-preview {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        @media (max-width:640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.span-2 {
                grid-column: span 1;
            }

            .pg-title {
                font-size: 24px;
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

        .search-box {
            flex: 1;
            max-width: 320px;
            position: relative;
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

        /* ACTION BUTTONS */
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
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div id="main-content">
        @include('partials.topbar')

        <div id="page-content">
            <div class="page-hdr" style="margin-bottom:16px;">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">HSE &middot; Manajemen Risiko</span>
                        </div>
                        <div class="pg-title">DATA <span>HIRADC</span></div>
                        <div class="pg-sub">Hazard Identification, Risk Assessment and Determining Control — per
                            dokumen pekerjaan.</div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <button class="btn-primary" onclick="openBuilderModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Dokumen HIRADC
                        </button>
                    </div>
                </div>
            </div>

            <div class="section-card">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:14px;height:14px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="fSearch"
                            placeholder="Cari departemen, bagian, pekerjaan, no HIRADC..." oninput="onFilterChange()" />
                    </div>
                    <button class="btn-outline" onclick="resetFilter()">Reset</button>
                </div>

                <div class="data-summary">Menampilkan <strong id="sumShowing">0</strong> dari <strong
                        id="sumTotal">0</strong> dokumen HIRADC</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th style="width:32px;">No</th>
                                <th>No. HIRADC</th>
                                <th>Departemen</th>
                                <th>Bagian</th>
                                <th>Pekerjaan</th>
                                <th>Revisi</th>
                                <th>Tanggal</th>
                                <th>Jml Aktivitas</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="9">
                                    <div class="skeleton-bar" style="width:100%;height:36px;"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pagination-bar">
                    <div class="pagination-info">
                        <span>Baris per halaman</span>
                        <select id="perPage" class="per-page-select" onchange="onPerPageChange()">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="pagination-pages" id="paginationPages"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL (tabel Excel, read-only) ══════ -->
    <div id="detailModalOverlay" class="modal-overlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box" style="max-width:98vw;width:1500px;max-height:94vh;overflow:auto;"
            onclick="event.stopPropagation()">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
                <div>
                    <div class="modal-title" id="detailTitle">Detail HIRADC</div>
                    <div style="font-size:12.5px;color:#94A3B8;" id="detailSub"></div>
                </div>
                <button class="btn-outline" onclick="closeDetailModal()">Tutup</button>
            </div>
            <div id="detailHeaderInfo" style="margin-bottom:12px;font-size:12.5px;"></div>

            <div class="hx-wrap">
                <table class="hx-table" id="detailTable">
                    <caption class="hx-caption">HAZARD IDENTIFICATION, RISK ASSESSMENT AND DETERMINING CONTROL [HIRADC]
                    </caption>
                    <thead>
                        <tr>
                            <th rowspan="2" style="min-width:36px;">NO</th>
                            <th rowspan="2" style="min-width:170px;">AKTIVITAS<br><span
                                    class="hx-sub">(ACTIVITY)</span></th>
                            <th colspan="2">SUMBER BAHAYA<br><span class="hx-sub">(HAZARD SOURCE)</span></th>
                            <th rowspan="2">N/A/E</th>
                            <th colspan="3">IDENTIFIKASI RISIKO<br><span class="hx-sub">(RISK
                                    IDENTIFICATION)</span></th>
                            <th colspan="4">RISIKO AWAL<br><span class="hx-sub">(INHERENT RISK)</span></th>
                            <th rowspan="2" style="min-width:200px;">PENGENDALIAN EXISTING<br><span
                                    class="hx-sub">(EXISTING CONTROL)</span></th>
                            <th colspan="4">RISIKO SISA<br><span class="hx-sub">(RESIDUAL RISK)</span></th>
                            <th rowspan="2">R/O</th>
                            <th rowspan="2" style="min-width:160px;">ADDITIONAL CONTROL FOR RISK / OPPORTUNITY</th>
                            <th colspan="2">TINDAK LANJUT<br><span class="hx-sub">(ACTION PLAN)</span></th>
                            <th rowspan="2" style="min-width:150px;">KESIMPULAN KEBUTUHAN APD</th>
                        </tr>
                        <tr>
                            <th>Hazard Register</th>
                            <th>Sub Hazard Register</th>
                            <th style="min-width:170px;">DESKRIPSI<br><span class="hx-sub">(DESCRIPTION)</span></th>
                            <th>DAMPAK<br><span class="hx-sub">(CONSEQUENCE)</span></th>
                            <th>DETAIL</th>
                            <th>L</th>
                            <th>C</th>
                            <th>RR</th>
                            <th>Cat</th>
                            <th>L</th>
                            <th>C</th>
                            <th>RR</th>
                            <th>Cat</th>
                            <th>PIC</th>
                            <th>DUE DATE</th>
                        </tr>
                    </thead>
                    <tbody id="detailTableBody"></tbody>
                </table>
            </div>

            <div class="hx-legend">
                <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-l"></span> L — Low (1–4)</span>
                <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-m"></span> M — Moderate (5–9)</span>
                <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-h"></span> H — High (10–16)</span>
                <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-e"></span> E — Extreme (20–25)</span>
            </div>

            <div id="detailSignBlock" class="hx-sign-block"></div>
        </div>
    </div>

    <!-- ══════ MODAL BUILDER (Tambah/Edit) — input gaya spreadsheet ══════ -->
    <div id="itemModalOverlay" class="modal-overlay" onclick="closeItemModalOutside(event)">
        <div class="modal-box form-modal-box" style="max-width:98vw;width:1600px;max-height:94vh;overflow:auto;"
            onclick="event.stopPropagation()">
            <div style="margin-bottom:14px;">
                <div class="modal-title" id="itemModalTitle">Tambah Dokumen HIRADC</div>
                <div style="font-size:12.5px;color:#94A3B8;">Lengkapi header dokumen, lalu isi tabel aktivitas &amp;
                    hazard seperti lembar kerja Excel.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Header Dokumen</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">Kode OK</label>
                        <div class="multi-picker" data-picker="kodeOk">
                            <div class="picker-chips" id="chips-kodeOk"></div>
                            <input type="text" class="form-input" id="kodeOkSearchInput"
                                placeholder="Cari kode OK atau uraian kerja..." autocomplete="off"
                                oninput="pickerSearchKodeOk(this.value)" onfocus="pickerOpenKodeOk()" />
                            <div class="picker-dropdown" id="dropdown-kodeOk">
                                <div class="picker-options" id="options-kodeOk"></div>
                                <div class="picker-dropdown-footer">
                                    <span class="picker-selected-count" id="count-kodeOk">0 dipilih</span>
                                    <button type="button" class="picker-done-btn"
                                        onclick="pickerCloseKodeOk()">Selesai</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="fKodeOkId" />
                    </div>
                    <div class="form-group"><label class="form-label">Departemen</label><input type="text"
                            id="fDepartemen" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Bagian</label><input type="text"
                            id="fBagian" class="form-input" /></div>
                    <div class="form-group span-2"><label class="form-label">Pekerjaan</label><input type="text"
                            id="fPekerjaan" class="form-input" /></div>

                    <div class="form-group"><label class="form-label">No. HIRADC</label><input type="text"
                            id="fNoHiradc" class="form-input" placeholder="01-00" /></div>
                    <div class="form-group"><label class="form-label">Revisi</label><input type="text"
                            id="fRevisi" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Tanggal</label><input type="date"
                            id="fTanggal" class="form-input" /></div>
                </div>

                <!-- ══ Pengesahan & Tanda Tangan — terpisah dari header, TTD berupa upload gambar ══ -->
                <div class="form-section-title">Pengesahan (Disiapkan Oleh)</div>
                <div class="hx-sign-grid" style="grid-template-columns: 1fr; max-width: 400px;">
                    <div class="hx-sign-card">
                        <div class="hx-sign-title">Disiapkan</div>
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input type="text" id="fDisiapkanNama" class="form-input" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <input type="date" id="fDisiapkanTanggal" class="form-input" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanda Tangan (gambar)</label>
                            <input type="file" id="fDisiapkanTtd" class="form-input" accept="image/*"
                                onchange="previewTtd('disiapkan', this)" />
                            <div class="hx-ttd-preview-wrap">
                                <img id="ttdPreviewDisiapkan" class="hx-ttd-preview" style="display:none;" />
                                <span id="ttdExistingDisiapkan" style="font-size:11px;color:#94A3B8;"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section-title"
                    style="display:flex;justify-content:space-between;align-items:center;">
                    <span>Tabel Aktivitas &amp; Hazard</span>
                    <button type="button" class="btn-outline" style="padding:4px 10px;font-size:12px;"
                        onclick="addGroup()">+ Tambah Grup</button>
                </div>

                <div class="hx-wrap" id="builderTableWrap">
                    <table class="hx-table hx-table-edit" id="builderTable">
                        <thead>
                            <tr>
                                <th rowspan="2" style="min-width:34px;">NO</th>
                                <th rowspan="2" style="min-width:170px;">AKTIVITAS<br><span
                                        class="hx-sub">(ACTIVITY)</span></th>
                                <th colspan="2">SUMBER BAHAYA<br><span class="hx-sub">(HAZARD SOURCE)</span></th>
                                <th rowspan="2">N/A/E</th>
                                <th colspan="3">IDENTIFIKASI RISIKO</th>
                                <th colspan="4">RISIKO AWAL</th>
                                <th rowspan="2" style="min-width:190px;">PENGENDALIAN EXISTING</th>
                                <th colspan="4">RISIKO SISA</th>
                                <th rowspan="2">R/O</th>
                                <th rowspan="2" style="min-width:150px;">ADDITIONAL CONTROL</th>
                                <th colspan="2">TINDAK LANJUT</th>
                                <th rowspan="2" style="min-width:140px;">KESIMPULAN APD</th>
                                <th rowspan="2" style="width:28px;"></th>
                            </tr>
                            <tr>
                                <th>Hazard Register</th>
                                <th>Sub Hazard Reg.</th>
                                <th style="min-width:150px;">Deskripsi</th>
                                <th>Dampak</th>
                                <th>Detail</th>
                                <th>L</th>
                                <th>C</th>
                                <th>RR</th>
                                <th>Cat</th>
                                <th>L</th>
                                <th>C</th>
                                <th>RR</th>
                                <th>Cat</th>
                                <th>PIC</th>
                                <th>Due</th>
                            </tr>
                        </thead>
                        <tbody id="builderTableBody"></tbody>
                    </table>
                </div>

                <div class="hx-legend">
                    <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-l"></span> L — Low (1–4)</span>
                    <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-m"></span> M — Moderate
                        (5–9)</span>
                    <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-h"></span> H — High (10–16)</span>
                    <span class="hx-legend-item"><span class="hx-legend-dot hx-cat-e"></span> E — Extreme
                        (20–25)</span>
                </div>

                <!-- ══ Lampiran opsional — TERPISAH dari Pengesahan, bukan bagian dari lembar HIRADC ══ -->
                <details class="hx-attachment-panel">
                    <summary>Lampiran Dokumen Pendukung (opsional, PDF)</summary>
                    <div class="form-group" style="margin-top:8px;">
                        <input type="file" id="fDokumen" class="form-input" accept="application/pdf" />
                        <div id="dokumenExisting" style="font-size:12px;color:#94A3B8;margin-top:4px;"></div>
                    </div>
                </details>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeItemModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmit" onclick="submitDocument()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- MODAL HAPUS -->
    <div id="deleteConfirmOverlay" class="modal-overlay" onclick="closeDeleteModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="modal-title">Hapus Dokumen HIRADC?</div>
            <div class="modal-desc" id="deleteModalDesc">Data yang dihapus tidak dapat dikembalikan.</div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <style>
        .kode-ok-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kode-ok-row .form-input {
            flex: 1;
        }

        .btn-remove-kode-ok {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 8px;
            border: 1px solid rgba(208, 2, 27, 0.2);
            background: rgba(208, 2, 27, 0.06);
            color: #D0021B;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .btn-remove-kode-ok:hover {
            background: rgba(208, 2, 27, 0.14);
        }

        .kode-ok-pill {
            display: inline-flex;
            align-items: center;
            padding: 1px 7px;
            border-radius: 6px;
            background: rgba(45, 75, 158, 0.08);
            color: #2D4B9E;
            font-size: 10px;
            font-weight: 700;
            margin: 0 4px 4px 0;
        }

        .multi-picker {
            position: relative;
        }

        .picker-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 6px;
            max-height: 96px;
            overflow-y: auto;
            padding-right: 2px;
        }

        .picker-chips:empty {
            display: none;
            margin-bottom: 0;
        }

        .picker-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #EFF3FB;
            color: #2D4B9E;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .picker-chip button {
            background: none;
            border: none;
            color: #2D4B9E;
            cursor: pointer;
            font-size: 10px;
            line-height: 1;
            padding: 0;
        }

        .picker-dropdown {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 40;
            max-height: 260px;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.12);
            margin-top: 4px;
            overflow: hidden;
        }

        .picker-dropdown.open {
            display: flex;
        }


        .picker-options {
            overflow-y: auto;
            padding: 6px;
        }


        .picker-dropdown-footer {
            flex-shrink: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            border-top: 1px solid #E2E8F0;
            background: #F8FAFC;
        }

        .picker-selected-count {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
        }

        .picker-done-btn {
            border: none;
            background: #2D4B9E;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 7px;
            cursor: pointer;
        }

        .picker-done-btn:hover {
            background: #1A3C8A;
        }

        .picker-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            margin-bottom: 2px;
            border-radius: 7px;
            font-size: 12.5px;
            line-height: 1.4;
            cursor: pointer;
            transition: background 0.12s;
        }

        .picker-option:last-child {
            margin-bottom: 0;
        }

        .picker-option:hover {
            background: #F8FAFC;
        }

        .picker-option.checked {
            background: #EFF6FF;
            color: #2D4B9E;
            font-weight: 700;
        }

        .picker-option-check {
            width: 16px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 16px;
            border-radius: 4px;
            border: 1.5px solid #CBD5E1;
            font-size: 10px;
            color: #fff;
        }

        .picker-option.checked .picker-option-check {
            background: #2D4B9E;
            border-color: #2D4B9E;
        }

        .picker-option span:last-child {
            overflow-wrap: anywhere;
        }

        .picker-empty {
            padding: 16px 12px;
            text-align: center;
            font-size: 12px;
            color: #94A3B8;
        }

        /* ══════ Excel-style HIRADC table (dipakai di modal Detail & Builder) ══════ */
        .hx-wrap {
            overflow: auto;
            border: 1px solid #1E293B;
            border-radius: 8px;
            max-height: 68vh;
        }

        .hx-caption {
            caption-side: top;
            text-align: center;
            font-weight: 700;
            font-size: 13px;
            padding: 8px 6px;
            color: #E2E8F0;
            background: #0B1220;
            letter-spacing: .3px;
            border-bottom: 1px solid #1E293B;
        }

        .hx-table {
            border-collapse: collapse;
            width: max-content;
            min-width: 100%;
            font-size: 11px;
        }

        .hx-table thead th {
            position: sticky;
            top: 0;
            z-index: 3;
            background: #111827;
            color: #93C5FD;
            border: 1px solid #1E293B;
            padding: 5px 6px;
            font-weight: 700;
            text-align: center;
            white-space: normal;
            line-height: 1.25;
        }

        .hx-table thead tr:first-child th {
            top: 0;
        }

        .hx-table thead tr:nth-child(2) th {
            top: 34px;
        }

        .hx-sub {
            font-weight: 400;
            font-size: 9.5px;
            color: #64748B;
        }

        .hx-table tbody td {
            border: 1px solid #1E293B;
            padding: 4px 5px;
            vertical-align: top;
            white-space: pre-wrap;
            color: #030303;
            background: rgba(255, 255, 255, .01);
        }

        .hx-group-row td {
            background: #16213A;
            color: #93C5FD;
            font-weight: 700;
            font-size: 11.5px;
            padding: 6px 8px;
        }

        .hx-sep-row td {
            background: #1a2332;
            height: 6px;
            padding: 2px;
        }

        /* Kategori risiko: L (hijau) / M (kuning) / H (merah gelap) / E (merah terang) */
        .hx-cat {
            text-align: center;
            font-weight: 700;
            border-radius: 4px;
        }

        .hx-cat-l {
            background: #16a34a;
            color: #fff;
        }

        .hx-cat-m {
            background: #eab308;
            color: #1a1a1a;
        }

        .hx-cat-h {
            background: #991b1b;
            color: #fff;
        }

        .hx-cat-e {
            background: #ef4444;
            color: #fff;
        }

        .hx-cat-none {
            background: transparent;
            color: #64748B;
        }

        .hx-lc {
            text-align: center;
            width: 30px;
        }

        .hx-apd-cell {
            border: 1.5px dashed #2D6CDF !important;
            border-radius: 6px;
            text-align: center;
            font-size: 10.5px;
        }

        .hx-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 10px;
            font-size: 11.5px;
            color: #94A3B8;
        }

        .hx-legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .hx-legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            display: inline-block;
        }

        /* Builder (editable) variant */
        .hx-table-edit tbody td {
            padding: 2px;
        }

        .hx-cell-input,
        .hx-cell-select,
        .hx-cell-textarea {
            width: 100%;
            box-sizing: border-box;
            background: transparent;
            border: none;
            color: #000000;
            font-size: 11px;
            padding: 3px 4px;
            border-radius: 3px;
            font-family: inherit;
            resize: vertical;
        }

        .hx-cell-input:focus,
        .hx-cell-select:focus,
        .hx-cell-textarea:focus {
            outline: 1px solid #2D6CDF;
            background: rgba(45, 108, 223, .08);
        }

        .hx-cell-select option {
            background: #0B1220;
            color: #E2E8F0;
        }

        .hx-lc-input {
            width: 34px;
            text-align: center;
        }

        .hx-remove-row {
            background: none;
            border: none;
            color: #D0021B;
            cursor: pointer;
            font-size: 12px;
        }

        .hx-group-row-edit td {
            background: #16213A;
            padding: 4px;
        }

        .hx-group-row-edit input {
            font-weight: 700;
            color: #93C5FD;
            font-size: 12px;
            background: transparent;
            border: none;
            width: 100%;
        }

        .hx-add-row-btn {
            background: none;
            border: 1px dashed #334155;
            color: #94A3B8;
            border-radius: 5px;
            padding: 3px 8px;
            font-size: 11px;
            cursor: pointer;
            margin: 4px 2px;
        }

        .hx-add-row-btn:hover {
            border-color: #2D6CDF;
            color: #93C5FD;
        }

        /* Pengesahan & tanda tangan */
        .hx-sign-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 8px;
        }

        @media (max-width: 900px) {
            .hx-sign-grid {
                grid-template-columns: 1fr;
            }
        }

        .hx-sign-card {
            border: 1px solid #1E293B;
            border-radius: 10px;
            padding: 12px;
            background: rgba(255, 255, 255, .02);
        }

        .hx-sign-title {
            font-weight: 700;
            color: #93C5FD;
            font-size: 12.5px;
            margin-bottom: 8px;
        }

        .hx-ttd-preview-wrap {
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hx-ttd-preview {
            max-width: 140px;
            max-height: 60px;
            border: 1px solid #334155;
            border-radius: 6px;
            background: #fff;
            padding: 2px;
        }

        .hx-attachment-panel {
            margin-top: 14px;
            border: 1px dashed #334155;
            border-radius: 8px;
            padding: 8px 12px;
        }

        .hx-attachment-panel summary {
            cursor: pointer;
            font-size: 12.5px;
            color: #94A3B8;
        }

        .hx-attachment-panel summary:hover {
            color: #93C5FD;
        }

        .hx-sign-block {
            display: flex;
            gap: 24px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .hx-sign-block .hx-sign-view {
            text-align: center;
            font-size: 11.5px;
            color: #94A3B8;
        }

        .hx-sign-block .hx-sign-view img {
            display: block;
            max-width: 140px;
            max-height: 60px;
            background: #fff;
            border-radius: 6px;
            margin: 0 auto 4px;
            padding: 2px;
        }

        .kode-ok-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 20;
            background: #0B1220;
            border: 1px solid #1E293B;
            border-radius: 8px;
            max-height: 220px;
            overflow-y: auto;
            display: none;
            margin-top: 4px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
        }

        .kode-ok-suggestion-item {
            padding: 8px 10px;
            cursor: pointer;
            border-bottom: 1px solid #1E293B;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .kode-ok-suggestion-item:hover {
            background: rgba(45, 108, 223, .12);
        }

        .kode-ok-suggestion-item strong {
            color: #93C5FD;
            font-size: 12px;
        }

        .kode-ok-suggestion-item span {
            color: #94A3B8;
            font-size: 11px;
        }

        .kode-ok-suggestion-empty {
            padding: 10px;
            color: #64748B;
            font-size: 12px;
            text-align: center;
        }

        .kode-ok-info {
            margin-top: 8px;
            border: 1px solid #1E293B;
            border-radius: 8px;
            padding: 10px 12px;
            background: rgba(255, 255, 255, .02);
        }

        .kode-ok-info-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .kode-ok-info-row:last-child {
            margin-bottom: 0;
        }

        .kode-ok-info-label {
            min-width: 80px;
            color: #64748B;
            font-weight: 600;
        }

        .kode-ok-chip-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .kode-ok-chip {
            background: rgba(26, 122, 60, .15);
            color: #4ADE80;
            border: 1px solid rgba(74, 222, 128, .3);
            border-radius: 20px;
            padding: 2px 9px;
            font-size: 10.5px;
        }

        .kode-ok-chip-blue {
            background: rgba(45, 108, 223, .15);
            color: #93C5FD;
            border-color: rgba(147, 197, 253, .3);
        }

        .kode-ok-chip-empty {
            color: #475569;
            font-size: 11px;
        }
    </style>

    <script>
        const DATA_ENDPOINT = "{{ route('hiradc.data') }}";
        const STORE_ENDPOINT = "{{ route('hiradc.store') }}";
        const BASE_ENDPOINT = "{{ url('/hiradc') }}";
        const KODE_OK_OPTIONS_ENDPOINT = "{{ route('hiradc.kodeOk.options') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        let allData = [];
        let filteredData = [];
        let currentPage = 1;
        let perPage = 25;
        let currentEditId = null;
        let currentDeleteId = null;
        let kodeOkSearchTimeout = null;
        let selectedKodeOk = null;

        // groups: [{ nama, items:[{no,aktivitas,kesimpulan_apd,hazards:[{...}]}], children:[{nama, items:[...]}] }]
        let formState = {
            groups: []
        };

        const SIGN_KEYS = ['disiapkan'];
        const HAZARD_REGISTERS = ['Mechanical', 'Enviromental', 'Physical', 'Ergonomic', 'Psychosocial', 'Chemical',
            'Biological', 'Electrical'
        ];
        const SUB_HAZARD_BY_REGISTER = {
            Mechanical: ['Benda tajam', 'Benda berputar', 'Benda jatuh', 'Terjepit'],
            Enviromental: ['Pencahayaan', 'Kebisingan', 'Iklim Kerja', 'Lainnya'],
            Physical: ['Terpeleset', 'Tersandung', 'Jatuh', 'Listrik', 'Ketinggian'],
            Ergonomic: ['Cara Kerja', 'Postur Kerja', 'Beban Kerja'],
            Psychosocial: ['Tingkat Pemahaman', 'Jam Kerja', 'Gangguan Mental', 'Beban Psikologis'],
            Chemical: ['Terpapar B3', 'Tumpahan Kimia', 'Uap/Gas Berbahaya'],
            Biological: ['Virus', 'Bakteri', 'Serangga/Hewan'],
            Electrical: ['Konsleting', 'Kabel Terkelupas', 'Sengatan Listrik'],
        };
        const DAMPAK_KATEGORI = ['Manusia', 'Aset', 'Lingkungan'];
        const DETAIL_BY_DAMPAK = {
            Manusia: ['Tidak Ada Cidera', 'FAI', 'MTI/RDI', 'LTI', 'Gangguan Kesehatan Ringan',
                'Gangguan Kesehatan Akut', 'Fatality'
            ],
            Aset: ['Tidak Signifikan (< 10 jt)', 'Kerusakan Ringan (10 - 100 jt)', 'Kerusakan Sedang (100 jt - 1 M)',
                'Kerusakan Berat (> 1 M)'
            ],
            Lingkungan: ['Pencemaran Ringan', 'Pencemaran Sedang', 'Pencemaran Berat'],
        };

        function escapeHtml(str) {
            const d = document.createElement('div');
            d.textContent = str ?? '';
            return d.innerHTML;
        }

        function display(v, f = '-') {
            return (v === null || v === undefined || v === '') ? f : v;
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            const iconSvg = type === 'error' ?
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>' :
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
            toast.innerHTML =
                `<div class="toast-icon">${iconSvg}</div><div><div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div><div class="toast-msg">${escapeHtml(message)}</div></div><button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        // Sama persis dengan HiradcHazard::tingkatRisiko() di backend:
        // L 1-4 (hijau) · M 5-9 (kuning) · H 10-16 (merah gelap) · E 20-25 (merah terang)
        function HiradcRisk(l, c) {
            l = parseInt(l);
            c = parseInt(c);
            if (!l || !c) return null;
            const rr = l * c;
            if (rr >= 20) return {
                nilai: rr,
                kode: 'E',
                label: 'Extreme',
                cls: 'hx-cat-e'
            };
            if (rr >= 10) return {
                nilai: rr,
                kode: 'H',
                label: 'High',
                cls: 'hx-cat-h'
            };
            if (rr >= 5) return {
                nilai: rr,
                kode: 'M',
                label: 'Moderate',
                cls: 'hx-cat-m'
            };
            return {
                nilai: rr,
                kode: 'L',
                label: 'Low',
                cls: 'hx-cat-l'
            };
        }

        function catCell(risk) {
            if (!risk) return `<td class="hx-cat hx-cat-none">-</td><td class="hx-cat hx-cat-none">-</td>`;
            return `<td class="hx-lc">${risk.nilai}</td><td class="hx-cat ${risk.cls}" title="${risk.label}">${risk.kode}</td>`;
        }

        // ══════ LOAD LIST ══════
        async function loadData() {
            try {
                const res = await fetch(DATA_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const json = await res.json();
                allData = json.data || [];
                applyFilter();
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="9"><div class="empty-state"><div class="empty-state-title">Gagal memuat data</div><div class="empty-state-sub">${escapeHtml(e.message)}</div></div></td></tr>`;
            }
        }

        function onFilterChange() {
            currentPage = 1;
            applyFilter();
        }

        function onPerPageChange() {
            perPage = parseInt(document.getElementById('perPage').value);
            currentPage = 1;
            render();
        }

        function resetFilter() {
            document.getElementById('fSearch').value = '';
            onFilterChange();
        }

        function countItems(doc) {
            const countGroup = g => (g.items?.length || 0) + (g.children || []).reduce((s, c) => s + countGroup(c), 0);
            return (doc.groups || []).reduce((s, g) => s + countGroup(g), 0);
        }

        function applyFilter() {
            const search = document.getElementById('fSearch').value.toLowerCase().trim();
            filteredData = allData.filter(row => {
                if (!search) return true;
                return [row.no_hiradc, row.departemen, row.bagian, row.pekerjaan].join(' ').toLowerCase().includes(
                    search);
            });
            render();
        }

        function render() {
            const totalPages = Math.max(1, Math.ceil(filteredData.length / perPage));
            if (currentPage > totalPages) currentPage = totalPages;
            const start = (currentPage - 1) * perPage;
            const pageRows = filteredData.slice(start, start + perPage);

            document.getElementById('sumShowing').textContent = pageRows.length;
            document.getElementById('sumTotal').textContent = filteredData.length;

            const tbody = document.getElementById('tableBody');
            if (pageRows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="9"><div class="empty-state"><div class="empty-state-title">Belum ada data</div><div class="empty-state-sub">Klik "Tambah Dokumen HIRADC" untuk mulai.</div></div></td></tr>`;
            } else {
                tbody.innerHTML = pageRows.map((row, idx) => {
                    // Tentukan Badge Status
                    let statusHtml = '';
                    if (row.status === 'disahkan') statusHtml =
                        `<span style="background:#16a34a;color:#fff;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:bold;">Disahkan</span>`;
                    else if (row.status === 'diperiksa') statusHtml =
                        `<span style="background:#2D6CDF;color:#fff;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:bold;">Diperiksa</span>`;
                    else statusHtml =
                        `<span style="background:#64748B;color:#fff;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:bold;">Draft</span>`;

                    // Logika Tombol Aksi berdasarkan status
                    let actionButtons = `
                        <button class="btn-row-action" onclick="openDetailModal(${row.id})" title="Detail">
                            <svg style="width:14px;height:14px; color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </button>
                    `;

                                        if (row.status === 'draft') {
                                            actionButtons += `
                            <button class="btn-row-action" onclick="openBuilderModal(${row.id})" title="Edit">
                                <svg style="width:14px;height:14px; color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button class="btn-row-action" style="color:#2D6CDF" onclick="confirmAction(${row.id}, 'periksa')" title="Periksa Dokumen">
                                <svg style="width:14px;height:14px; color:#2D6CDF;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Periksa
                            </button>
                            <button class="btn-row-action" style="color:#D0021B;" onclick="openDeleteModal(${row.id}, '${escapeHtml(row.pekerjaan)}')" title="Hapus">
                                <svg style="width:14px;height:14px; color:#D0021B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        `;
                                        } else if (row.status === 'diperiksa') {
                                            actionButtons += `
                            <button class="btn-row-action" style="color:#16a34a" onclick="confirmAction(${row.id}, 'sahkan')" title="Sahkan Dokumen">
                                <svg style="width:14px;height:14px; color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Sahkan
                            </button>
                        `;
                    }

                    return `
                        <tr>
                            <td>${start + idx + 1}</td>
                            <td>${escapeHtml(display(row.no_hiradc))}</td>
                            <td>${escapeHtml(row.departemen)}</td>
                            <td>${escapeHtml(row.bagian)}</td>
                            <td style="max-width:220px;white-space:normal;">${escapeHtml(row.pekerjaan)}</td>
                            <td>${escapeHtml(display(row.revisi))}</td>
                            <td>${escapeHtml(display(row.tanggal))}</td>
                            <td>${countItems(row)}</td>
                            <td>${statusHtml}</td>
                            <td style="text-align:center;white-space:nowrap; gap:6px;">
                                ${actionButtons}
                            </td>
                        </tr>
                        `;
                }).join('');
            }
            renderPagination(totalPages);
        }

        async function confirmAction(id, actionType) {
            let confirmMsg = actionType === 'periksa' ?
                "Apakah Anda yakin sudah memeriksa dokumen ini dengan teliti?" :
                "Apakah Anda yakin ingin mengesahkan dokumen HIRADC ini?";

            if (!confirm(confirmMsg)) return;

            try {
                const res = await fetch(`${BASE_ENDPOINT}/${id}/${actionType}`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Content-Type': 'application/json'
                    }
                });

                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Status ${res.status}`);

                showToast(json.message, 'success');
                await loadData(); // Reload tabel untuk update status
            } catch (e) {
                showToast(e.message || `Gagal memproses dokumen.`, 'error');
            }
        }

        function renderPagination(totalPages) {
            const box = document.getElementById('paginationPages');
            let html =
                `<button class="page-btn" ${currentPage === 1 ? 'disabled' : ''} onclick="goToPage(${currentPage - 1})">‹</button>`;
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || Math.abs(i - currentPage) <= 1) {
                    html +=
                        `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
                } else if (Math.abs(i - currentPage) === 2) {
                    html += `<span class="page-ellipsis">…</span>`;
                }
            }
            html +=
                `<button class="page-btn" ${currentPage === totalPages ? 'disabled' : ''} onclick="goToPage(${currentPage + 1})">›</button>`;
            box.innerHTML = html;
        }

        function goToPage(p) {
            currentPage = p;
            render();
        }

        // ══════ MODAL DETAIL (tabel Excel read-only) ══════
        async function openDetailModal(id) {
            try {
                const res = await fetch(`${BASE_ENDPOINT}/${id}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Status ${res.status}`);
                renderDetail(json.data);
                document.getElementById('detailModalOverlay').classList.add('open');
            } catch (e) {
                showToast(e.message || 'Gagal memuat detail.', 'error');
            }
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(e) {
            if (e.target.id === 'detailModalOverlay') closeDetailModal();
        }

        function renderDetail(doc) {
            document.getElementById('detailTitle').textContent = `${doc.no_hiradc || '-'} — ${doc.pekerjaan}`;
            document.getElementById('detailSub').textContent =
                `${doc.departemen} / ${doc.bagian} · Revisi ${display(doc.revisi)} · ${display(doc.tanggal)}`;
            document.getElementById('detailHeaderInfo').innerHTML = `
              <strong>Kode OK:</strong> ${escapeHtml(display(doc.kode_ok?.kode_ok))}<br>
            <strong>Disiapkan:</strong> ${escapeHtml(display(doc.disiapkan_nama))} (${escapeHtml(display(doc.disiapkan_tanggal))}) &nbsp;|&nbsp;
            <strong>Diperiksa:</strong> ${escapeHtml(display(doc.diperiksa_nama))} (${escapeHtml(display(doc.diperiksa_tanggal))}) &nbsp;|&nbsp;
            <strong>Disahkan:</strong> ${escapeHtml(display(doc.disahkan_nama))} (${escapeHtml(display(doc.disahkan_tanggal))})
        `;

            const signHtml = (label, nama, tanggal, ttdUrl) => `
            <div class="hx-sign-view">
                <div><strong>${label}</strong></div>
                ${ttdUrl ? `<img src="${ttdUrl}" alt="TTD ${label}" />` : `<div style="height:40px;display:flex;align-items:center;justify-content:center;color:#475569;">(belum ada ttd)</div>`}
                <div>${escapeHtml(display(nama))}</div>
                <div>${escapeHtml(display(tanggal))}</div>
            </div>
        `;
            document.getElementById('detailSignBlock').innerHTML =
                signHtml('Disiapkan', doc.disiapkan_nama, doc.disiapkan_tanggal, doc.disiapkan_ttd_url) +
                signHtml('Diperiksa', doc.diperiksa_nama, doc.diperiksa_tanggal, doc.diperiksa_ttd_url) +
                signHtml('Disahkan', doc.disahkan_nama, doc.disahkan_tanggal, doc.disahkan_ttd_url);

            let rows = '';
            const COLSPAN = 21;

            function renderGroup(group) {
                rows += `<tr class="hx-group-row"><td colspan="${COLSPAN}">${escapeHtml(group.nama)}</td></tr>`;
                (group.items || []).forEach(item => {
                    const hazards = item.hazards && item.hazards.length ? item.hazards : [{}];
                    hazards.forEach((h, hIdx) => {
                        rows += '<tr>';
                        if (hIdx === 0) {
                            rows +=
                                `<td rowspan="${hazards.length}" style="text-align:center;">${display(item.no)}</td>`;
                            rows += `<td rowspan="${hazards.length}">${escapeHtml(item.aktivitas)}</td>`;
                        }
                        rows += `<td>${escapeHtml(display(h.hazard_register))}</td>`;
                        rows += `<td>${escapeHtml(display(h.sub_hazard_register))}</td>`;
                        rows += `<td style="text-align:center;">${escapeHtml(display(h.na_e))}</td>`;
                        rows += `<td>${escapeHtml(display(h.deskripsi))}</td>`;
                        rows += `<td>${escapeHtml(display(h.dampak_kategori))}</td>`;
                        rows += `<td>${escapeHtml(display(h.detail))}</td>`;
                        rows += `<td class="hx-lc">${display(h.l_awal)}</td>`;
                        rows += `<td class="hx-lc">${display(h.c_awal)}</td>`;
                        rows += catCell(HiradcRisk(h.l_awal, h.c_awal));
                        rows += `<td>${escapeHtml(display(h.pengendalian_existing))}</td>`;
                        rows += `<td class="hx-lc">${display(h.l_sisa)}</td>`;
                        rows += `<td class="hx-lc">${display(h.c_sisa)}</td>`;
                        rows += catCell(HiradcRisk(h.l_sisa, h.c_sisa));
                        rows += `<td style="text-align:center;">${escapeHtml(display(h.r_o))}</td>`;
                        rows += `<td>${escapeHtml(display(h.additional_control))}</td>`;
                        rows += `<td>${escapeHtml(display(h.pic))}</td>`;
                        rows += `<td>${escapeHtml(display(h.due_date))}</td>`;
                        if (hIdx === 0) {
                            rows +=
                                `<td rowspan="${hazards.length}" class="hx-apd-cell">${escapeHtml(display(item.kesimpulan_apd))}</td>`;
                        }
                        rows += '</tr>';
                    });
                });
                rows += `<tr class="hx-sep-row"><td colspan="${COLSPAN}"></td></tr>`;
                (group.children || []).forEach(child => renderGroup(child));
            }
            (doc.groups || []).forEach(g => renderGroup(g));
            document.getElementById('detailTableBody').innerHTML = rows ||
                `<tr><td colspan="${COLSPAN}">Belum ada aktivitas.</td></tr>`;
        }

        // ══════ MODAL BUILDER (Tambah/Edit) ══════
        function emptyHazard() {
            return {
                hazard_register: '',
                sub_hazard_register: '',
                na_e: 'N',
                deskripsi: '',
                dampak_kategori: '',
                detail: '',
                l_awal: '',
                c_awal: '',
                pengendalian_existing: '',
                l_sisa: '',
                c_sisa: '',
                r_o: 'R',
                additional_control: '',
                pic: '',
                due_date: ''
            };
        }

        function emptyItem() {
            return {
                no: '',
                aktivitas: '',
                kesimpulan_apd: '',
                hazards: [emptyHazard()]
            };
        }

        function emptyGroup() {
            return {
                nama: '',
                items: [emptyItem()],
                children: []
            };
        }

        function resetTtdInputs() {
            SIGN_KEYS.forEach(key => {
                const Key = key.charAt(0).toUpperCase() + key.slice(1);
                document.getElementById(`f${Key}Ttd`).value = '';
                const img = document.getElementById(`ttdPreview${Key}`);
                img.style.display = 'none';
                img.src = '';
                document.getElementById(`ttdExisting${Key}`).textContent = '';
            });
        }

        function previewTtd(key, input) {
            const Key = key.charAt(0).toUpperCase() + key.slice(1);
            const file = input.files[0];
            const img = document.getElementById(`ttdPreview${Key}`);
            if (!file) {
                img.style.display = 'none';
                return;
            }
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        async function openBuilderModal(id = null) {
            currentEditId = id;
            document.getElementById('fDokumen').value = '';
            document.getElementById('dokumenExisting').textContent = '';
            resetTtdInputs();

            await ensureKodeOkOptionsLoaded(); // ← baru, load sekali saja

            if (id) {
                document.getElementById('itemModalTitle').textContent = 'Edit Dokumen HIRADC';
                try {
                    const res = await fetch(`${BASE_ENDPOINT}/${id}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const json = await res.json();
                    if (!res.ok) throw new Error(json.message || `Status ${res.status}`);
                    const doc = json.data;
                    fillHeaderForm(doc);
                    resetKodeOkPicker(doc.kode_ok || null); // ← baru
                    formState = {
                        groups: (doc.groups && doc.groups.length) ? doc.groups : [emptyGroup()]
                    };
                    if (doc.dokumen_hiradc) {
                        document.getElementById('dokumenExisting').textContent =
                            `File saat ini: ${doc.dokumen_hiradc} (biarkan kosong jika tidak ingin ganti)`;
                    }
                    SIGN_KEYS.forEach(key => {
                        const Key = key.charAt(0).toUpperCase() + key.slice(1);
                        const url = doc[`${key}_ttd_url`];
                        if (url) document.getElementById(`ttdExisting${Key}`).textContent =
                            'TTD sudah ada (biarkan kosong jika tidak ingin ganti)';
                    });
                } catch (e) {
                    showToast(e.message || 'Gagal memuat data.', 'error');
                    return;
                }
            } else {
                document.getElementById('itemModalTitle').textContent = 'Tambah Dokumen HIRADC';
                fillHeaderForm({});
                resetKodeOkPicker(null); // ← baru
                formState = {
                    groups: [emptyGroup()]
                };
            }
            renderGroupsBuilder();
            document.getElementById('itemModalOverlay').classList.add('open');
        }

        function renderKodeOkInfo(k) {
            // Info Pengawas, Unit Kerja, Kualifikasi tidak lagi ditampilkan
            document.getElementById('kodeOkInfo').style.display = 'none';
        }

        function fillHeaderForm(doc) {
            document.getElementById('fDepartemen').value = doc.departemen || '';
            document.getElementById('fBagian').value = doc.bagian || '';
            document.getElementById('fPekerjaan').value = doc.pekerjaan || '';
            // Kode OK di-set terpisah di openBuilderModal
            document.getElementById('fNoHiradc').value = doc.no_hiradc || '';
            document.getElementById('fRevisi').value = doc.revisi || '';
            document.getElementById('fTanggal').value = doc.tanggal || '';

            // Hanya sisakan input disiapkan
            document.getElementById('fDisiapkanNama').value = doc.disiapkan_nama || '';
            document.getElementById('fDisiapkanTanggal').value = doc.disiapkan_tanggal || '';
        }

        function closeItemModal() {
            document.getElementById('itemModalOverlay').classList.remove('open');
            currentEditId = null;
        }

        function closeItemModalOutside(e) {
            if (e.target.id === 'itemModalOverlay') closeItemModal();
        }

        // ── builder: tambah/hapus struktur ──
        function addGroup() {
            formState.groups.push(emptyGroup());
            renderGroupsBuilder();
        }

        function removeGroup(gi) {
            formState.groups.splice(gi, 1);
            renderGroupsBuilder();
        }

        function addSubGroup(gi) {
            (formState.groups[gi].children ||= []).push(emptyGroup());
            renderGroupsBuilder();
        }

        function removeSubGroup(gi, ci) {
            formState.groups[gi].children.splice(ci, 1);
            renderGroupsBuilder();
        }

        function addItem(path) {
            getGroupByPath(path).items.push(emptyItem());
            renderGroupsBuilder();
        }

        function removeItem(path, ii) {
            getGroupByPath(path).items.splice(ii, 1);
            renderGroupsBuilder();
        }

        function addHazard(path, ii) {
            getGroupByPath(path).items[ii].hazards.push(emptyHazard());
            renderGroupsBuilder();
        }

        function removeHazard(path, ii, hi) {
            const item = getGroupByPath(path).items[ii];
            if (item.hazards.length <= 1) {
                showToast('Minimal harus ada 1 baris hazard per aktivitas.', 'error');
                return;
            }
            item.hazards.splice(hi, 1);
            renderGroupsBuilder();
        }

        // path contoh: "0" untuk group ke-0, "0.1" untuk sub-group ke-1 di dalam group ke-0
        function getGroupByPath(path) {
            const parts = path.split('.').map(Number);
            let group = formState.groups[parts[0]];
            for (let i = 1; i < parts.length; i++) group = group.children[parts[i]];
            return group;
        }

        function bindVal(path, field, ii, hi, event) {
            const item = getGroupByPath(path).items[ii];
            if (hi === null) {
                item[field] = event.target.value;
            } else {
                item.hazards[hi][field] = event.target.value;
            }
        }

        function bindGroupName(path, event) {
            getGroupByPath(path).nama = event.target.value;
        }

        function renderGroupsBuilder() {
            const tbody = document.getElementById('builderTableBody');
            let html = '';
            formState.groups.forEach((group, gi) => {
                html += renderGroupRowsHtml(group, String(gi));
            });
            tbody.innerHTML = html ||
                `<tr><td colspan="22" style="text-align:center;color:#64748B;padding:16px;">Belum ada grup aktivitas. Klik "+ Tambah Grup".</td></tr>`;
        }

        const COLSPAN_EDIT = 22;

        function renderGroupRowsHtml(group, path) {
            const isTop = path.split('.').length === 1;
            let html = `
            <tr class="hx-group-row-edit">
                <td colspan="${COLSPAN_EDIT - 1}">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="color:#64748B;font-size:10px;">GRUP:</span>
                        <input type="text" value="${escapeHtml(group.nama)}" placeholder="Nama grup / aktivitas besar (mis. Persiapan Pekerjaan)" oninput="bindGroupName('${path}', event)" />
                        ${isTop ? `<button type="button" class="hx-add-row-btn" onclick="addSubGroup(${path})">+ Sub-grup</button>` : ''}
                    </div>
                </td>
                <td style="text-align:center;">
                    <button type="button" class="hx-remove-row" title="Hapus grup" onclick="${isTop ? `removeGroup(${path})` : `removeSubGroup(${path.split('.')[0]}, ${path.split('.')[1]})`}">✕</button>
                </td>
            </tr>
        `;

            (group.items || []).forEach((item, ii) => {
                html += renderItemRowsHtml(item, path, ii);
            });

            html += `
            <tr>
                <td colspan="${COLSPAN_EDIT}" style="background:transparent;border:none;padding:2px 4px;">
                    <button type="button" class="hx-add-row-btn" onclick="addItem('${path}')">+ Tambah Aktivitas (baris NO baru)</button>
                </td>
            </tr>
        `;

            (group.children || []).forEach((child, ci) => {
                html += renderGroupRowsHtml(child, `${path}.${ci}`);
            });

            return html;
        }

        function renderItemRowsHtml(item, path, ii) {
            const hazards = item.hazards && item.hazards.length ? item.hazards : [emptyHazard()];
            let html = '';
            hazards.forEach((h, hi) => {
                html += renderHazardRowHtml(item, hazards, h, path, ii, hi);
            });
            return html;
        }

        function renderHazardRowHtml(item, hazards, h, path, ii, hi) {
            const uid = `${path.replace(/\./g, '_')}_${ii}_${hi}`;
            const subOptions = SUB_HAZARD_BY_REGISTER[h.hazard_register] || [];
            const detailOptions = DETAIL_BY_DAMPAK[h.dampak_kategori] || [];
            const riskAwal = HiradcRisk(h.l_awal, h.c_awal);
            const riskSisa = HiradcRisk(h.l_sisa, h.c_sisa);
            const f = (field) => `bindVal('${path}','${field}',${ii},${hi},event)`;
            const fr = (field) => `bindVal('${path}','${field}',${ii},${hi},event); renderGroupsBuilder()`;
            const fi = (field) => `bindVal('${path}','${field}',${ii},null,event)`;

            let rowHtml = '<tr>';

            if (hi === 0) {
                rowHtml += `<td rowspan="${hazards.length}" style="min-width:44px;">
                <input class="hx-cell-input" type="number" style="text-align:center;" placeholder="No" value="${display(item.no,'')}" oninput="${fi('no')}" />
            </td>`;
                rowHtml += `<td rowspan="${hazards.length}" style="min-width:170px;">
                <textarea class="hx-cell-textarea" rows="2" placeholder="Aktivitas..." oninput="${fi('aktivitas')}">${escapeHtml(item.aktivitas)}</textarea>
            </td>`;
            }

            rowHtml += `<td style="min-width:110px;">
            <select class="hx-cell-select" onchange="${fr('hazard_register')}">
                <option value="">—</option>
                ${HAZARD_REGISTERS.map(r => `<option value="${r}" ${h.hazard_register === r ? 'selected' : ''}>${r}</option>`).join('')}
            </select>
        </td>`;
            rowHtml += `<td style="min-width:120px;">
            <input class="hx-cell-input" type="text" list="dl_sub_${uid}" value="${escapeHtml(h.sub_hazard_register)}" oninput="${f('sub_hazard_register')}" placeholder="Pilih/ketik" />
            <datalist id="dl_sub_${uid}">${subOptions.map(o => `<option value="${o}">`).join('')}</datalist>
        </td>`;
            rowHtml += `<td style="min-width:60px;">
            <select class="hx-cell-select" onchange="${f('na_e')}">
                <option value="N" ${h.na_e === 'N' ? 'selected' : ''}>N</option>
                <option value="A" ${h.na_e === 'A' ? 'selected' : ''}>A</option>
                <option value="E" ${h.na_e === 'E' ? 'selected' : ''}>E</option>
            </select>
        </td>`;
            rowHtml +=
                `<td style="min-width:150px;"><textarea class="hx-cell-textarea" rows="2" oninput="${f('deskripsi')}">${escapeHtml(h.deskripsi)}</textarea></td>`;
            rowHtml += `<td style="min-width:100px;">
            <select class="hx-cell-select" onchange="${fr('dampak_kategori')}">
                <option value="">—</option>
                ${DAMPAK_KATEGORI.map(d => `<option value="${d}" ${h.dampak_kategori === d ? 'selected' : ''}>${d}</option>`).join('')}
            </select>
        </td>`;
            rowHtml += `<td style="min-width:120px;">
            <input class="hx-cell-input" type="text" list="dl_detail_${uid}" value="${escapeHtml(h.detail)}" oninput="${f('detail')}" placeholder="Pilih/ketik" />
            <datalist id="dl_detail_${uid}">${detailOptions.map(o => `<option value="${o}">`).join('')}</datalist>
        </td>`;

            rowHtml +=
                `<td><input class="hx-cell-input hx-lc-input" type="number" min="1" max="5" value="${display(h.l_awal,'')}" oninput="${fr('l_awal')}" /></td>`;
            rowHtml +=
                `<td><input class="hx-cell-input hx-lc-input" type="number" min="1" max="5" value="${display(h.c_awal,'')}" oninput="${fr('c_awal')}" /></td>`;
            rowHtml += catCell(riskAwal);

            rowHtml +=
                `<td style="min-width:180px;"><textarea class="hx-cell-textarea" rows="2" oninput="${f('pengendalian_existing')}">${escapeHtml(h.pengendalian_existing)}</textarea></td>`;

            rowHtml +=
                `<td><input class="hx-cell-input hx-lc-input" type="number" min="1" max="5" value="${display(h.l_sisa,'')}" oninput="${fr('l_sisa')}" /></td>`;
            rowHtml +=
                `<td><input class="hx-cell-input hx-lc-input" type="number" min="1" max="5" value="${display(h.c_sisa,'')}" oninput="${fr('c_sisa')}" /></td>`;
            rowHtml += catCell(riskSisa);

            rowHtml += `<td style="min-width:60px;">
            <select class="hx-cell-select" onchange="${f('r_o')}">
                <option value="R" ${h.r_o === 'R' ? 'selected' : ''}>R</option>
                <option value="O" ${h.r_o === 'O' ? 'selected' : ''}>O</option>
            </select>
        </td>`;
            rowHtml +=
                `<td style="min-width:150px;"><textarea class="hx-cell-textarea" rows="2" oninput="${f('additional_control')}">${escapeHtml(h.additional_control)}</textarea></td>`;
            rowHtml +=
                `<td style="min-width:90px;"><input class="hx-cell-input" type="text" value="${escapeHtml(h.pic)}" oninput="${f('pic')}" /></td>`;
            rowHtml +=
                `<td style="min-width:120px;"><input class="hx-cell-input" type="date" value="${h.due_date || ''}" oninput="${f('due_date')}" /></td>`;

            if (hi === 0) {
                rowHtml += `<td rowspan="${hazards.length}" class="hx-apd-cell" style="min-width:140px;">
                <textarea class="hx-cell-textarea" rows="3" placeholder="Kesimpulan APD" oninput="${fi('kesimpulan_apd')}">${escapeHtml(item.kesimpulan_apd)}</textarea>
            </td>`;
            }

            rowHtml += `<td style="text-align:center;white-space:nowrap;">
            <button type="button" class="hx-remove-row" title="Hapus baris hazard ini" onclick="removeHazard('${path}',${ii},${hi})">✕</button>
        </td>`;

            rowHtml += '</tr>';

            if (hi === hazards.length - 1) {
                rowHtml += `
                <tr>
                    <td colspan="2" style="border:none;background:transparent;"></td>
                    <td colspan="${COLSPAN_EDIT - 3}" style="border:none;background:transparent;padding:2px 4px;">
                        <button type="button" class="hx-add-row-btn" onclick="addHazard('${path}',${ii})">+ Sumber Bahaya</button>
                        <button type="button" class="hx-add-row-btn" style="color:#D0021B;border-color:#D0021B;" onclick="removeItem('${path}',${ii})">✕ Hapus Aktivitas Ini</button>
                    </td>
                    <td style="border:none;background:transparent;"></td>
                </tr>
            `;
            }

            return rowHtml;
        }

        // ── append struktur bersarang ke FormData pakai bracket notation ──
        function appendGroupsToFormData(fd, groups, prefix = 'groups') {
            groups.forEach((group, gi) => {
                const gp = `${prefix}[${gi}]`;
                fd.append(`${gp}[nama]`, group.nama || '');
                (group.items || []).forEach((item, ii) => {
                    const ip = `${gp}[items][${ii}]`;
                    fd.append(`${ip}[no]`, item.no ?? '');
                    fd.append(`${ip}[aktivitas]`, item.aktivitas || '');
                    fd.append(`${ip}[kesimpulan_apd]`, item.kesimpulan_apd || '');
                    (item.hazards || []).forEach((h, hi) => {
                        const hp = `${ip}[hazards][${hi}]`;
                        Object.keys(h).forEach(key => fd.append(`${hp}[${key}]`, h[key] ?? ''));
                    });
                });
                if (group.children && group.children.length) {
                    appendGroupsToFormData(fd, group.children, `${gp}[children]`);
                }
            });
        }

        async function submitDocument() {
            const pekerjaan = document.getElementById('fPekerjaan').value.trim();
            if (!pekerjaan) {
                showToast('Pekerjaan wajib diisi.', 'error');
                return;
            }

            const btn = document.getElementById('btnSubmit');
            const original = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const fd = new FormData();
            fd.append('departemen', document.getElementById('fDepartemen').value.trim());
            fd.append('bagian', document.getElementById('fBagian').value.trim());
            fd.append('pekerjaan', pekerjaan);
            fd.append('kode_ok_id', document.getElementById('fKodeOkId').value);
            fd.append('no_hiradc', document.getElementById('fNoHiradc').value.trim());
            fd.append('revisi', document.getElementById('fRevisi').value.trim());
            fd.append('tanggal', document.getElementById('fTanggal').value);

            // Hanya append 'disiapkan' sesuai dengan yang ada di HTML Modal
            fd.append('disiapkan_nama', document.getElementById('fDisiapkanNama').value.trim());
            fd.append('disiapkan_tanggal', document.getElementById('fDisiapkanTanggal').value);

            // BARIS DI BAWAH INI DIHAPUS KARENA ELEMENNYA TIDAK ADA DI DOM
            // fd.append('diperiksa_nama', document.getElementById('fDiperiksaNama').value.trim());
            // fd.append('diperiksa_tanggal', document.getElementById('fDiperiksaTanggal').value);
            // fd.append('disahkan_nama', document.getElementById('fDisahkanNama').value.trim());
            // fd.append('disahkan_tanggal', document.getElementById('fDisahkanTanggal').value);

            SIGN_KEYS.forEach(key => {
                const Key = key.charAt(0).toUpperCase() + key.slice(1);
                const file = document.getElementById(`f${Key}Ttd`).files[0];
                if (file) fd.append(`${key}_ttd`, file);
            });

            const dokumenFile = document.getElementById('fDokumen').files[0];
            if (dokumenFile) fd.append('dokumen', dokumenFile);

            appendGroupsToFormData(fd, formState.groups);

            const url = currentEditId ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;
            if (currentEditId) fd.append('_method', 'PUT');

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: fd
                });
                const json = await res.json();
                if (!res.ok) {
                    const firstError = json.errors ? Object.values(json.errors)[0][0] : null;
                    throw new Error(firstError || json.message || `Status ${res.status}`);
                }
                closeItemModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan data.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = original;
            }
        }

        // ══════ HAPUS ══════
        function openDeleteModal(id, label) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Dokumen HIRADC "${label}" akan dihapus permanen beserta seluruh grup, aktivitas, dan hazard-nya. Lanjutkan?`;
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
                if (!res.ok) throw new Error(json.message || `Status ${res.status}`);
                closeDeleteModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                closeDeleteModal();
                showToast(e.message || 'Gagal menghapus data.', 'error');
            }
        }

        const pickerKodeOk = {
            all: [],
            selected: null
        };
        let kodeOkOptionsLoaded = false;

        async function ensureKodeOkOptionsLoaded() {
            if (kodeOkOptionsLoaded) return;
            try {
                const res = await fetch(KODE_OK_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                pickerKodeOk.all = json.data || [];
                kodeOkOptionsLoaded = true;
            } catch (e) {
                showToast('Gagal memuat data Kode OK.', 'error');
            }
        }

        function kodeOkLabel(item) {
            return item.uraian_kerja ? `${item.kode_ok} — ${item.uraian_kerja}` : item.kode_ok;
        }

        function renderKodeOkChip() {
            const wrap = document.getElementById('chips-kodeOk');
            if (!pickerKodeOk.selected) {
                wrap.innerHTML = '';
                document.getElementById('fKodeOkId').value = '';
                return; // ← hapus baris document.getElementById('kodeOkInfo').style.display = 'none';
            }
            const item = pickerKodeOk.selected;
            wrap.innerHTML = `
                <span class="picker-chip">
                    ${escapeHtml(item.kode_ok)}
                    <button type="button" onclick="kodeOkClear()">✕</button>
                </span>`;
            document.getElementById('fKodeOkId').value = item.id;
            // renderKodeOkInfo(item);  ← hapus baris ini
        }

        function renderKodeOkDropdown(keyword = '') {
            const optionsWrap = document.getElementById('options-kodeOk');
            const kw = keyword.trim().toLowerCase();
            const list = pickerKodeOk.all.filter(item => kodeOkLabel(item).toLowerCase().includes(kw));

            optionsWrap.innerHTML = list.length === 0 ?
                `<div class="picker-empty">Kode OK tidak ditemukan.</div>` :
                list.slice(0, 50).map(item => {
                    const checked = pickerKodeOk.selected?.id === item.id;
                    return `
                <div class="picker-option ${checked ? 'checked' : ''}" onclick="kodeOkSelect(${item.id})">
                    <span class="picker-option-check">${checked ? '✓' : ''}</span>
                    <span>${escapeHtml(kodeOkLabel(item))}</span>
                </div>`;
                }).join('');

            // ← baru: sinkron dengan tampilan footer APD
            document.getElementById('count-kodeOk').textContent = pickerKodeOk.selected ? '1 dipilih' : '0 dipilih';
        }

        function kodeOkSelect(id) {
            const item = pickerKodeOk.all.find(i => i.id === id);
            if (!item) return;
            pickerKodeOk.selected = item;
            renderKodeOkChip();
            pickerCloseKodeOk();
            document.getElementById('kodeOkSearchInput').value = '';
        }

        function kodeOkClear() {
            pickerKodeOk.selected = null;
            renderKodeOkChip();
        }

        function resetKodeOkPicker(existing = null) {
            pickerKodeOk.selected = existing || null;
            renderKodeOkChip();
            document.getElementById('dropdown-kodeOk').classList.remove('open');
            document.getElementById('kodeOkSearchInput').value = '';
        }

        function pickerOpenKodeOk() {
            renderKodeOkDropdown();
            document.getElementById('dropdown-kodeOk').classList.add('open');
        }

        function pickerCloseKodeOk() {
            document.getElementById('dropdown-kodeOk').classList.remove('open');
        }

        function pickerSearchKodeOk(keyword) {
            renderKodeOkDropdown(keyword);
            document.getElementById('dropdown-kodeOk').classList.add('open');
        }

        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('dropdown-kodeOk');
            if (!dropdown.classList.contains('open')) return;
            const wrap = document.querySelector('[data-picker="kodeOk"]');
            if (wrap && !wrap.contains(e.target)) pickerCloseKodeOk();
        });

        document.addEventListener('DOMContentLoaded', loadData);
    </script>


</body>

</html>
