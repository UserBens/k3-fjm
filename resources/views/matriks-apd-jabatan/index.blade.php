<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Matriks Kebutuhan APD — PT. Fokus Jasa Mitra</title>
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

        .btn-outline.active {
            background: #2D4B9E;
            color: #fff;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
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

        .td-name-main {
            font-weight: 700;
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
            width: 820px;
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

        .apd-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .apd-item {
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 8px;
            padding: 8px 10px;
        }

        .apd-item label {
            display: block;
            font-size: 10.5px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 4px;
        }

        .apd-item select {
            width: 100%;
            height: 30px;
            font-size: 11px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, .09);
            padding: 0 6px;
            background: #fff;
        }

        .jml-apd-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            background: rgba(45, 75, 158, .09);
            color: #2D4B9E;
        }

        @media (max-width:900px) {
            .apd-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width:640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.span-2 {
                grid-column: span 1;
            }

            .apd-grid {
                grid-template-columns: 1fr;
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
                            <span class="pg-eyebrow">HSE &middot; Kebutuhan APD</span>
                        </div>
                        <div class="pg-title">MATRIKS <span>KEBUTUHAN APD</span></div>
                        <div class="pg-sub">Kebutuhan APD berdasarkan Kode OK &amp; Jabatan, terintegrasi dengan
                            analisis risiko HIRADC.</div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <button class="btn-outline" id="btnToggleRisk" onclick="toggleRiskView()">Tampilkan Kolom
                            Risiko</button>
                        <button class="btn-primary" onclick="openItemModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Matriks APD
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
                        <input type="text" id="fSearch" placeholder="Cari kode OK, nama pekerjaan, jabatan..."
                            oninput="onFilterChange()" />
                    </div>
                    <select id="fStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="Open">Open</option>
                        <option value="Close">Close</option>
                    </select>
                    <button class="btn-outline" onclick="resetFilter()">Reset</button>
                </div>

                <div class="data-summary">
                    <span>Menampilkan <strong id="sumShowing">0</strong> dari <strong id="sumTotal">0</strong>
                        data</span>
                    <span id="sumMode" style="font-size:10.5px;">Mode: Ringkas (tanpa kolom risiko)</span>
                </div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr id="theadRow">
                                <th style="width:32px;">No</th>
                                <th>Kode OK</th>
                                <th>Nama Pekerjaan / Jabatan</th>
                                <th>APD Wajib</th>
                                <th class="risk-col" style="display:none;">Risiko Awal</th>
                                <th class="risk-col" style="display:none;">Risiko Residual</th>
                                <th>Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="8">
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

    <!-- MODAL TAMBAH/EDIT -->
    <div id="itemModalOverlay" class="modal-overlay" onclick="closeItemModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div style="margin-bottom:14px;">
                <div class="modal-title" id="itemModalTitle">Tambah Matriks APD</div>
                <div style="font-size:12.5px;color:#94A3B8;" id="itemModalSub">Lengkapi identitas pekerjaan dan
                    checklist APD.</div>
            </div>
            <div class="form-modal-body">
                <div class="form-section-title">Identitas Pekerjaan</div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Kode OK</label><input type="text"
                            id="fKodeOk" class="form-input" placeholder="OK-001" /></div>
                    <div class="form-group"><label class="form-label">Nama Pekerjaan</label><input type="text"
                            id="fNamaPekerjaan" class="form-input" placeholder="Pekerjaan Umum Pabrik" /></div>
                    <div class="form-group span-2"><label class="form-label">Jabatan/Posisi</label><input
                            type="text" id="fJabatanPosisi" class="form-input" placeholder="Operator Produksi" />
                    </div>
                </div>

                <div class="form-section-title">Checklist Kebutuhan APD <span class="jml-apd-badge"
                        id="jmlApdBadge">0 Wajib</span></div>
                <div class="apd-grid" id="apdGrid"></div>

                <div class="form-section-title">Analisis Risiko (Terintegrasi HIRADC) — opsional</div>
                <div class="form-grid">
                    <div class="form-group span-2"><label class="form-label">Potensi Bahaya / Aktivitas</label><input
                            type="text" id="fPotensiBahaya" class="form-input"
                            placeholder="Terangkat beban berat → manual handling" /></div>
                    <div class="form-group"><label class="form-label">Jenis Bahaya</label><input type="text"
                            id="fJenisBahaya" class="form-input" placeholder="Bahaya Ergonomi" /></div>
                    <div class="form-group"><label class="form-label">Konsekuensi/Dampak</label><input type="text"
                            id="fKonsekuensi" class="form-input" placeholder="Nyeri punggung/MSDs" /></div>
                    <div class="form-group"><label class="form-label">Kemungkinan Awal (L)</label><input
                            type="number" min="1" max="5" id="fLAwal" class="form-input"
                            oninput="recalcRisk()" /></div>
                    <div class="form-group"><label class="form-label">Keparahan Awal (S)</label><input type="number"
                            min="1" max="5" id="fSAwal" class="form-input"
                            oninput="recalcRisk()" /></div>
                    <div class="form-group span-2"><label class="form-label">Tingkat Risiko Awal</label>
                        <div id="previewAwal" class="risk-badge-preview sp-gray">—</div>
                    </div>
                    <div class="form-group span-2"><label class="form-label">Pengendalian Eksisting</label>
                        <textarea id="fPengendalianEksisting" class="form-textarea" rows="2"></textarea>
                    </div>
                    <div class="form-group span-2"><label class="form-label">Pengendalian Tambahan</label>
                        <textarea id="fPengendalianTambahan" class="form-textarea" rows="2"></textarea>
                    </div>
                    <div class="form-group"><label class="form-label">Kemungkinan Residual (L)</label><input
                            type="number" min="1" max="5" id="fLRes" class="form-input"
                            oninput="recalcRisk()" /></div>
                    <div class="form-group"><label class="form-label">Keparahan Residual (S)</label><input
                            type="number" min="1" max="5" id="fSRes" class="form-input"
                            oninput="recalcRisk()" /></div>
                    <div class="form-group span-2"><label class="form-label">Tingkat Risiko Residual</label>
                        <div id="previewRes" class="risk-badge-preview sp-gray">—</div>
                    </div>
                </div>

                <div class="form-section-title">Lainnya</div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">PIC</label><input type="text"
                            id="fPic" class="form-input" placeholder="HSE Dept" /></div>
                    <div class="form-group"><label class="form-label">Status</label>
                        <select id="fStatusForm" class="form-select">
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeItemModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmit" onclick="submitItem()">Simpan</button>
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
            <div class="modal-title">Hapus Matriks APD?</div>
            <div class="modal-desc" id="deleteModalDesc">Data yang dihapus tidak dapat dikembalikan.</div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('matriks-apd-jabatan.data') }}";
        const STORE_ENDPOINT = "{{ route('matriks-apd-jabatan.store') }}";
        const BASE_ENDPOINT = "{{ url('/matriks-apd-jabatan') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        // Samakan urutan & label persis dgn MatriksApdJabatan::APD_COLUMNS di Model
        const APD_COLUMNS = {
            helm_safety: 'Helm Safety',
            sepatu_safety: 'Sepatu Safety',
            rompi_hivis: 'Rompi Hi-Vis',
            sarung_tangan_kulit: 'Sarung Tangan Kulit',
            kacamata_safety: 'Kacamata Safety',
            masker_n95: 'Masker N95',
            masker_respirator: 'Masker Respirator',
            earplug_earmuff: 'Earplug/Earmuff',
            full_body_harness: 'Full Body Harness',
            wearpack: 'Wearpack',
            scba: 'SCBA 🔴',
            pakaian_fr: 'Pakaian FR 🔴',
            chemical_suit: 'Chemical Suit 🔴',
            sarung_tangan_listrik: 'Sarung Tangan Listrik 🔴',
            face_shield: 'Face Shield 🔴',
            kacamata_las: 'Kacamata Las 🔴',
            knee_pad: 'Knee Pad 🔴',
        };
        const APD_STATUS = ['TIDAK', 'KONDISIONAL', 'WAJIB'];
        const APD_STATUS_LABEL = {
            TIDAK: '– Tidak',
            KONDISIONAL: '○ Kondisional',
            WAJIB: '✅ Wajib'
        };

        let allData = [],
            filteredData = [],
            currentPage = 1,
            perPage = 25;
        let currentEditId = null,
            currentDeleteId = null,
            showRiskCols = false;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const d = document.createElement('div');
            d.textContent = str ?? '';
            return d.innerHTML;
        }

        function display(v, f = '-') {
            return (v === null || v === undefined || v === '') ? f : v;
        }

        function riskBadge(risk) {
            if (!risk) return '<span class="status-pill sp-gray">—</span>';
            return `<span class="status-pill ${risk.class}">${risk.emoji} ${risk.label} (${risk.nilai})</span>`;
        }

        function statusPillClass(status) {
            return status === 'Close' ? 'sp-green' : 'sp-blue';
        }

        function toggleRiskView() {
            showRiskCols = !showRiskCols;
            document.querySelectorAll('.risk-col').forEach(el => el.style.display = showRiskCols ? '' : 'none');
            document.getElementById('btnToggleRisk').textContent = showRiskCols ? 'Sembunyikan Kolom Risiko' :
                'Tampilkan Kolom Risiko';
            document.getElementById('btnToggleRisk').classList.toggle('active', showRiskCols);
            document.getElementById('sumMode').textContent = showRiskCols ? 'Mode: Terintegrasi HIRADC (dengan risiko)' :
                'Mode: Ringkas (tanpa kolom risiko)';
        }

        // ══════ TOAST ══════
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type==='error'?'toast-error':''}`;
            const iconSvg = type === 'error' ?
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>' :
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
            toast.innerHTML =
                `<div class="toast-icon">${iconSvg}</div><div><div class="toast-title">${type==='error'?'Gagal':'Berhasil'}</div><div class="toast-msg">${escapeHtml(message)}</div></div><button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        // ══════ LOAD ══════
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
                    `<tr><td colspan="8"><div class="empty-state"><div class="empty-state-title">Gagal memuat data</div><div class="empty-state-sub">${escapeHtml(e.message)}</div></div></td></tr>`;
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
            document.getElementById('fStatus').value = '';
            onFilterChange();
        }

        function applyFilter() {
            const search = document.getElementById('fSearch').value.toLowerCase().trim();
            const status = document.getElementById('fStatus').value;
            filteredData = allData.filter(row => {
                const matchSearch = !search || [row.kode_ok, row.nama_pekerjaan, row.jabatan_posisi].join(' ')
                    .toLowerCase().includes(search);
                const matchStatus = !status || row.status === status;
                return matchSearch && matchStatus;
            });
            render();
        }

        function apdWajibSummary(apd) {
            const wajib = Object.keys(APD_COLUMNS).filter(k => apd[k] === 'WAJIB').map(k => APD_COLUMNS[k]);
            if (wajib.length === 0) return '<span style="color:#94A3B8;">-</span>';
            const shown = wajib.slice(0, 3).join(', ');
            const more = wajib.length > 3 ? ` +${wajib.length-3} lainnya` : '';
            return escapeHtml(shown + more);
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
                    `<tr><td colspan="8"><div class="empty-state"><div class="empty-state-title">Belum ada data</div><div class="empty-state-sub">Klik "Tambah Matriks APD" atau ubah filter pencarian.</div></div></td></tr>`;
            } else {
                tbody.innerHTML = pageRows.map((row, idx) => `
                    <tr>
                        <td>${start+idx+1}</td>
                        <td>${escapeHtml(display(row.kode_ok))}</td>
                        <td>
                            <div class="td-name-main">${escapeHtml(row.jabatan_posisi)}</div>
                            <div class="td-name-sub">${escapeHtml(row.nama_pekerjaan)}</div>
                        </td>
                        <td style="max-width:220px;white-space:normal;">${apdWajibSummary(row.apd)}</td>
                        <td class="risk-col" style="display:${showRiskCols?'':'none'};">${riskBadge(row.risiko_awal)}</td>
                        <td class="risk-col" style="display:${showRiskCols?'':'none'};">${riskBadge(row.risiko_residual)}</td>
                        <td><span class="status-pill ${statusPillClass(row.status)}">${escapeHtml(row.status)}</span></td>
                        <td style="text-align:center;white-space:nowrap;">
                            <button class="btn-row-action" onclick='openItemModal(${JSON.stringify(row).replace(/'/g,"&#39;")})'>
                                <svg style="width:14px;height:14px;color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button class="btn-row-action" onclick="openDeleteModal(${row.id}, '${escapeHtml(row.jabatan_posisi)}')">
                                <svg style="width:14px;height:14px;color:#D0021B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </td>
                    </tr>
                `).join('');
            }
            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            const box = document.getElementById('paginationPages');
            let html =
                `<button class="page-btn" ${currentPage===1?'disabled':''} onclick="goToPage(${currentPage-1})">‹</button>`;
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || Math.abs(i - currentPage) <= 1) {
                    html +=
                        `<button class="page-btn ${i===currentPage?'active':''}" onclick="goToPage(${i})">${i}</button>`;
                } else if (Math.abs(i - currentPage) === 2) {
                    html += `<span class="page-ellipsis">…</span>`;
                }
            }
            html +=
                `<button class="page-btn" ${currentPage===totalPages?'disabled':''} onclick="goToPage(${currentPage+1})">›</button>`;
            box.innerHTML = html;
        }

        function goToPage(p) {
            currentPage = p;
            render();
        }

        // ══════ APD GRID (checklist form) ══════
        function buildApdGrid(apdValues = {}) {
            const grid = document.getElementById('apdGrid');
            grid.innerHTML = Object.entries(APD_COLUMNS).map(([key, label]) => `
                <div class="apd-item">
                    <label>${label}</label>
                    <select id="apd_${key}" onchange="updateJmlApdBadge()">
                        ${APD_STATUS.map(s=>`<option value="${s}" ${(apdValues[key]||'TIDAK')===s?'selected':''}>${APD_STATUS_LABEL[s]}</option>`).join('')}
                    </select>
                </div>
            `).join('');
            updateJmlApdBadge();
        }

        function updateJmlApdBadge() {
            const jml = Object.keys(APD_COLUMNS).filter(k => document.getElementById(`apd_${k}`)?.value === 'WAJIB').length;
            document.getElementById('jmlApdBadge').textContent = `${jml} Wajib`;
        }

        // ══════ RISK PREVIEW ══════
        function recalcRisk() {
            const lA = parseInt(document.getElementById('fLAwal').value),
                sA = parseInt(document.getElementById('fSAwal').value);
            const lR = parseInt(document.getElementById('fLRes').value),
                sR = parseInt(document.getElementById('fSRes').value);
            document.getElementById('previewAwal').outerHTML = previewBadge('previewAwal', lA, sA);
            document.getElementById('previewRes').outerHTML = previewBadge('previewRes', lR, sR);
        }

        function previewBadge(id, l, s) {
            if (!l || !s) return `<div id="${id}" class="risk-badge-preview sp-gray">—</div>`;
            const nilai = l * s;
            let cls = 'sp-green',
                label = 'RENDAH',
                emoji = '✅';
            if (nilai > 25) {
                cls = 'sp-red';
                label = 'EKSTRIM';
                emoji = '🚨';
            } else if (nilai >= 15) {
                cls = 'sp-red';
                label = 'TINGGI';
                emoji = '🔴';
            } else if (nilai >= 5) {
                cls = 'sp-amber';
                label = 'SEDANG';
                emoji = '⚠️';
            }
            return `<div id="${id}" class="risk-badge-preview ${cls}">${emoji} ${label} (${nilai})</div>`;
        }

        // ══════ MODAL TAMBAH/EDIT ══════
        function openItemModal(row = null) {
            currentEditId = row ? row.id : null;
            document.getElementById('itemModalTitle').textContent = row ? 'Edit Matriks APD' : 'Tambah Matriks APD';
            document.getElementById('itemModalSub').textContent = row ? `Perbarui data "${row.jabatan_posisi}"` :
                'Lengkapi identitas pekerjaan dan checklist APD.';

            document.getElementById('fKodeOk').value = row?.kode_ok || '';
            document.getElementById('fNamaPekerjaan').value = row?.nama_pekerjaan || '';
            document.getElementById('fJabatanPosisi').value = row?.jabatan_posisi || '';
            buildApdGrid(row?.apd || {});

            document.getElementById('fPotensiBahaya').value = row?.potensi_bahaya_aktivitas || '';
            document.getElementById('fJenisBahaya').value = row?.jenis_bahaya || '';
            document.getElementById('fKonsekuensi').value = row?.konsekuensi_dampak || '';
            document.getElementById('fLAwal').value = row?.l_awal || '';
            document.getElementById('fSAwal').value = row?.s_awal || '';
            document.getElementById('fPengendalianEksisting').value = row?.pengendalian_eksisting || '';
            document.getElementById('fPengendalianTambahan').value = row?.pengendalian_tambahan || '';
            document.getElementById('fLRes').value = row?.l_res || '';
            document.getElementById('fSRes').value = row?.s_res || '';
            document.getElementById('fPic').value = row?.pic || '';
            document.getElementById('fStatusForm').value = row?.status || 'Open';
            recalcRisk();

            document.getElementById('itemModalOverlay').classList.add('open');
        }

        function closeItemModal() {
            document.getElementById('itemModalOverlay').classList.remove('open');
            currentEditId = null;
        }

        function closeItemModalOutside(e) {
            if (e.target.id === 'itemModalOverlay') closeItemModal();
        }

        async function submitItem() {
            const btn = document.getElementById('btnSubmit');
            const original = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const apdPayload = {};
            Object.keys(APD_COLUMNS).forEach(k => apdPayload[k] = document.getElementById(`apd_${k}`).value);

            const payload = {
                ...apdPayload,
                kode_ok: document.getElementById('fKodeOk').value.trim(),
                nama_pekerjaan: document.getElementById('fNamaPekerjaan').value.trim(),
                jabatan_posisi: document.getElementById('fJabatanPosisi').value.trim(),
                potensi_bahaya_aktivitas: document.getElementById('fPotensiBahaya').value.trim() || null,
                jenis_bahaya: document.getElementById('fJenisBahaya').value.trim() || null,
                konsekuensi_dampak: document.getElementById('fKonsekuensi').value.trim() || null,
                l_awal: document.getElementById('fLAwal').value || null,
                s_awal: document.getElementById('fSAwal').value || null,
                pengendalian_eksisting: document.getElementById('fPengendalianEksisting').value.trim() || null,
                pengendalian_tambahan: document.getElementById('fPengendalianTambahan').value.trim() || null,
                l_res: document.getElementById('fLRes').value || null,
                s_res: document.getElementById('fSRes').value || null,
                pic: document.getElementById('fPic').value.trim() || null,
                status: document.getElementById('fStatusForm').value,
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
                    body: JSON.stringify(payload)
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
                `Matriks APD untuk "${label}" akan dihapus permanen. Lanjutkan?`;
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

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
