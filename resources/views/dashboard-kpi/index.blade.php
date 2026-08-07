<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Dashboard KPI K3 — PT. Fokus Jasa Mitra</title>
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
            --gold: #B7860B;
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

        #page-content {
            padding: 20px 20px 32px;
            max-width: 100%;
        }

        /* HEADER */
        .k3-header {
            background: linear-gradient(135deg, var(--blue) 0%, #1E3A7A 100%);
            border-radius: 14px;
            padding: 20px 24px;
            color: #fff;
            margin-bottom: 14px;
            text-align: center;
        }

        .k3-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            letter-spacing: 0.03em;
        }

        .k3-header p {
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.75);
            font-weight: 600;
            margin-top: 2px;
        }

        /* PANEL SAKLAR */
        .panel-saklar {
            background: #fff;
            border: 1.5px solid var(--gold);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 14px;
        }

        .panel-saklar-title {
            font-size: 10.5px;
            font-weight: 800;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 10px;
        }

        .saklar-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* Diubah menjadi 4 kolom karena filter rupiah dihapus */
            gap: 10px;
        }

        .saklar-field label {
            display: block;
            font-size: 9.5px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .saklar-field select,
        .saklar-field input {
            width: 100%;
            height: 34px;
            border: 1px solid rgba(45, 75, 158, 0.25);
            border-radius: 8px;
            padding: 0 10px;
            font-size: 12px;
            font-weight: 700;
            color: var(--blue);
            background-color: #F8F9FF;
            /* Menggunakan background-color agar tidak menimpa background-image */
            outline: none;
            transition: border-color 0.2s, background-color 0.2s;
        }

        /* Tambahan untuk Custom Arrow yang lebih rapi */
        .saklar-field select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232D4B9E' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            padding-right: 32px;
            cursor: pointer;
        }

        .saklar-field select:focus,
        .saklar-field input:focus {
            border-color: var(--blue);
            background-color: #fff;
        }

        .periode-aktif-line {
            margin-top: 10px;
            font-size: 11px;
            color: #64748B;
            font-weight: 600;
            border-top: 1px dashed rgba(0, 0, 0, 0.08);
            padding-top: 8px;
        }

        .periode-aktif-line b {
            color: var(--dark);
        }

        /* SECTION LABEL */
        .section-label {
            font-size: 10.5px;
            font-weight: 800;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 7px 14px;
            border-radius: 8px 8px 0 0;
            display: inline-block;
        }

        .sl-blue {
            background: var(--blue);
        }

        .sl-green {
            background: var(--green);
        }

        .sl-gold {
            background: #A9760A;
        }

        .card-block {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 0 12px 12px 12px;
            padding: 16px;
            margin-bottom: 14px;
        }

        /* RINGKASAN STATUS DOKUMEN */
        .status-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }

        .status-card {
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .status-card .lbl {
            font-size: 10px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .status-card .val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            line-height: 1.2;
            margin-top: 4px;
        }

        .sc-approve {
            background: rgba(26, 122, 60, 0.08);
        }

        .sc-approve .val {
            color: var(--green);
        }

        .sc-reject {
            background: rgba(208, 2, 27, 0.07);
        }

        .sc-reject .val {
            color: var(--red);
        }

        .sc-pending {
            background: rgba(217, 119, 6, 0.08);
        }

        .sc-pending .val {
            color: var(--amber);
        }

        .sc-cancel {
            background: rgba(100, 116, 139, 0.08);
        }

        .sc-cancel .val {
            color: #64748B;
        }

        .sc-total {
            background: var(--dark);
        }

        .sc-total .val {
            color: #fff;
        }

        .sc-total .lbl {
            color: rgba(255, 255, 255, 0.65);
        }

        /* INDIKATOR KPI */
        .indikator-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .indikator-card {
            background: #F8F9FF;
            border: 1px solid rgba(45, 75, 158, 0.10);
            border-radius: 10px;
            padding: 14px;
        }

        .indikator-card .lbl {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 6px;
        }

        .indikator-card .val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            color: var(--dark);
        }

        /* MONITORING + RINCIAN */
        .monitor-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 14px;
        }

        .ringkasan-personil {
            margin-top: 14px;
        }

        .ringkasan-personil-title {
            font-size: 10.5px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .monitoring-box {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 10px;
            overflow: hidden;
            background: #F8F9FF;
        }

        .monitoring-box .kv-row {
            padding: 9px 12px;
        }

        .monitoring-box .kv-row .v.highlight {
            color: var(--blue);
            font-size: 13px;
        }

        .personil-select-wrap {
            margin-bottom: 12px;
        }

        .personil-select-wrap label {
            display: block;
            font-size: 10.5px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            /* Ubah dari 5px menjadi 8px */
        }

        .personil-select-wrap select {
            width: 100%;
            height: 38px;
            border: 1px solid rgba(45, 75, 158, 0.25);
            border-radius: 8px;
            padding: 0 10px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--blue);
            background: #F8F9FF;
        }

        .kv-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 12px;
        }

        .kv-row:last-child {
            border-bottom: none;
        }

        .kv-row .k {
            color: #64748B;
            font-weight: 600;
        }

        .kv-row .v {
            color: var(--dark);
            font-weight: 800;
        }

        .kategori-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 800;
        }

        .kp-baik {
            background: rgba(26, 122, 60, 0.10);
            color: var(--green);
        }

        .kp-cukup {
            background: rgba(217, 119, 6, 0.10);
            color: var(--amber);
        }

        .kp-perbaikan {
            background: rgba(208, 2, 27, 0.09);
            color: var(--red);
        }

        .rtable-wrap {
            overflow-x: auto;
            margin-top: 0;
            /* Ubah dari 16px menjadi 0 (atau hapus baris ini) */
        }

        .rtable {
            width: 100%;
            min-width: 640px;
            border-collapse: collapse;
        }

        .rtable th {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 8px;
            text-align: left;
            border-bottom: 2px solid rgba(0, 0, 0, 0.06);
            background: #F8F9FF;
            white-space: nowrap;
        }

        .rtable td {
            font-size: 12px;
            color: var(--dark);
            padding: 9px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            white-space: nowrap;
        }

        .rtable tr:hover td {
            background: #F8F9FF;
        }

        .rincian-kpi-col {
            margin-left: 18px;
        }

        .rincian-kpi-title {
            font-size: 10.5px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            /* Ubah dari 10px menjadi 8px */
        }

        .status-capaian {
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
        }

        .sc-tercapai {
            background: rgba(26, 122, 60, 0.09);
            color: var(--green);
        }

        .sc-belum {
            background: rgba(208, 2, 27, 0.08);
            color: var(--red);
        }

        .empty-state {
            padding: 24px;
            text-align: center;
            color: #94A3B8;
            font-size: 12.5px;
            font-weight: 600;
        }

        .loading-state {
            padding: 24px;
            text-align: center;
            color: #94A3B8;
            font-size: 12px;
            font-weight: 700;
        }

        @media (max-width: 1024px) {
            .saklar-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .status-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .indikator-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .monitor-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .saklar-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .status-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .indikator-grid {
                grid-template-columns: 1fr;
            }

            #page-content {
                padding: 14px;
            }
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

        .kpi-tab-bar {
            display: flex;
            gap: 6px;
            margin-bottom: 14px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .kpi-tab-btn {
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 700;
            border: none;
            background: transparent;
            color: #64748B;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
        }

        .kpi-tab-btn.active {
            color: var(--blue);
            border-bottom-color: var(--blue);
        }

        .kpi-tab-panel {}

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

        .page-hdr-top {
            flex-direction: column;
            align-items: stretch;
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #D0021B;
            display: inline-block;
            animation: pulse 2s infinite;
        }

        /* CUSTOM SELECT (menggantikan tampilan <select> personil) */
        .cs-wrap {
            position: relative;
        }

        .cs-trigger {
            width: 100%;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            border: 1px solid rgba(45, 75, 158, 0.25);
            border-radius: 8px;
            padding: 0 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--blue);
            background: #F8F9FF;
            cursor: pointer;
            transition: border-color .15s, background .15s, box-shadow .15s;
        }

        .cs-trigger:hover {
            border-color: var(--blue);
        }

        .cs-wrap.open .cs-trigger {
            border-color: var(--blue);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(45, 75, 158, 0.10);
        }

        .cs-trigger-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .cs-trigger-label.placeholder {
            color: #94A3B8;
            font-weight: 600;
        }

        /* panah bawah custom, konsisten & rapi */
        .cs-arrow {
            flex-shrink: 0;
            width: 9px;
            height: 9px;
            border-right: 2px solid #94A3B8;
            border-bottom: 2px solid #94A3B8;
            transform: rotate(45deg);
            margin-top: -3px;
            transition: transform .15s, border-color .15s;
        }

        .cs-wrap.open .cs-arrow {
            transform: rotate(-135deg);
            margin-top: 3px;
            border-color: var(--blue);
        }

        .cs-panel {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            box-shadow: 0 14px 30px rgba(26, 29, 46, 0.16);
            z-index: 40;
            display: none;
            overflow: hidden;
        }

        .cs-wrap.open .cs-panel {
            display: block;
        }

        .cs-search-wrap {
            padding: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            background: #fff;
        }

        .cs-search {
            width: 100%;
            height: 32px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: 6px;
            padding: 0 10px;
            font-size: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
            background: #F8F9FF;
        }

        .cs-search:focus {
            border-color: var(--blue);
            background: #fff;
        }

        .cs-list {
            max-height: 236px;
            overflow-y: auto;
            padding: 4px;
        }

        .cs-item {
            padding: 9px 10px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--dark);
            cursor: pointer;
            border-radius: 6px;
        }

        .cs-item:hover {
            background: #F0F2FA;
        }

        .cs-item.selected {
            background: rgba(45, 75, 158, 0.09);
            color: var(--blue);
            font-weight: 800;
        }

        .cs-empty {
            padding: 16px 10px;
            text-align: center;
            font-size: 12px;
            color: #94A3B8;
            font-weight: 600;
        }

        .cs-wrap.disabled .cs-trigger {
            opacity: .6;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar && toggleSidebar()"></div>

    <div id="main-content" class="flex-1 flex flex-col overflow-hidden">

        @include('partials.topbar')

        <div id="page-content" class="overflow-y-auto">

            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Dashboard KPI · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DASHBOARD KPI <span>K3</span></div>
                        <div class="pg-sub">Keselamatan &amp; Kesehatan Kerja — Departemen K3 &amp; Operasional.</div>
                    </div>
                </div>
            </div>

            <!-- PANEL SAKLAR -->
            <div class="panel-saklar">
                <!-- BARU: Field Skema Periode Cut-Off -->
                <div class="saklar-field">
                    <label>Periode</label>
                    <select id="fPeriode">
                        <option value="26_25" selected>Tanggal 26 s/d 25</option>
                        <option value="1_31">Tanggal 1 s/d Akhir Bulan</option>
                    </select>
                </div>
                {{-- <div class="panel-saklar-title">Panel Saklar · ubah di sini, seluruh dashboard mengikuti</div> --}}
                <div class="saklar-grid">
                    <div class="saklar-field">
                        <label>Tahun</label>
                        <select id="fTahun"></select>
                    </div>
                    <div class="saklar-field">
                        <label>Bulan</label>
                        <select id="fBulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    {{-- <div class="saklar-field">
                        <label>Tim</label>
                        <select id="fTim">
                            <option value="SEMUA">SEMUA</option>
                            <option value="SAFETY">SAFETY</option>
                            <option value="PENGAWAS">PENGAWAS</option>
                            <option value="MEDIS">MEDIS</option>
                        </select>
                    </div> --}}
                    <div class="saklar-field">
                        <label>Area</label>
                        <select id="fArea">
                            <option value="SEMUA">SEMUA</option>
                        </select>
                    </div>

                    <div class="saklar-field flex items-end">
                        <button id="btnTerapkan" type="button"
                            style="width:100%;height:34px;background:var(--blue);color:#fff;border:none;border-radius:8px;font-size:11.5px;font-weight:800;cursor:pointer;">
                            Terapkan
                        </button>
                    </div>
                </div>
                <div class="periode-aktif-line" id="periodeAktifLine">Memuat periode aktif…</div>
            </div>

            <!-- MONITORING PER PERSONIL + RINCIAN AKTIVITAS -->
            {{-- <div>
                <span class="section-label sl-gold">Monitoring &amp; Rincian per Personil</span>
                <div class="card-block">
                    <div class="monitor-grid">
                        <div>
                            <div class="personil-select-wrap">
                                <label>Pilih Nama</label>
                                <select id="fPersonil"></select>
                            </div>
                            <div id="monitoringBox"
                                style="border:1px solid rgba(0,0,0,0.06);border-radius:10px;overflow:hidden;">
                                <div class="loading-state">Memuat data personil…</div>
                            </div>
                        </div>
                        <div>
                            <div class="rtable-wrap">
                                <table class="rtable">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Aktivitas KPI</th>
                                            <th>Target/Bulan</th>
                                            <th>Laporan Disetujui</th>
                                            <th>Bobot Item (%)</th>
                                            <th>Kontribusi (%)</th>
                                            <th>Status Capaian</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rincianBody">
                                        <tr>
                                            <td colspan="7" class="loading-state">Memuat rincian aktivitas…</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- MONITORING PER PERSONIL + RINCIAN AKTIVITAS — PER TIM (TAB) -->
            <div>
                <span class="section-label sl-gold">Monitoring &amp; Rincian per Personil</span>
                <div class="card-block">

                    <div class="kpi-tab-bar">
                        <button type="button" class="kpi-tab-btn active" data-tim="SAFETY"
                            onclick="switchTeamTab('SAFETY')">Safety</button>
                        <button type="button" class="kpi-tab-btn" data-tim="PENGAWAS"
                            onclick="switchTeamTab('PENGAWAS')">Pengawas</button>
                        <button type="button" class="kpi-tab-btn" data-tim="MEDIS"
                            onclick="switchTeamTab('MEDIS')">Medis</button>
                    </div>

                    <!-- PANEL SAFETY -->
                    <div class="kpi-tab-panel" data-tim-panel="SAFETY">
                        <div class="monitor-grid">
                            <div>
                                <div class="personil-select-wrap">
                                    <label>Pilih Nama (Safety)</label>
                                    <select id="fPersonil_SAFETY"></select>
                                </div>

                                <div class="ringkasan-personil">
                                    <div class="ringkasan-personil-title">Ringkasan Kinerja</div>
                                    <div id="monitoringBox_SAFETY" class="monitoring-box">
                                        <div class="loading-state">Memuat data personil…</div>
                                    </div>
                                </div>
                            </div>
                            <div class="rincian-kpi-col">
                                <div class="rincian-kpi-title">Tabel Aktivitas KPI Personil</div>
                                <div class="rtable-wrap">
                                    <table class="rtable">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Aktivitas KPI</th>
                                                <th>Target/Bulan</th>
                                                <th>Laporan Disetujui</th>
                                                <th>Bobot Item (%)</th>
                                                <th>Kontribusi (%)</th>
                                                <th>Status Capaian</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rincianBody_SAFETY">
                                            <tr>
                                                <td colspan="7" class="loading-state">Memuat rincian aktivitas…
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL PENGAWAS -->
                    <!-- PANEL PENGAWAS -->
                    <div class="kpi-tab-panel" data-tim-panel="PENGAWAS" style="display:none;">
                        <div class="monitor-grid">
                            <div>
                                <div class="personil-select-wrap">
                                    <label>Pilih Nama (Pengawas)</label>
                                    <select id="fPersonil_PENGAWAS"></select>
                                </div>

                                <div class="ringkasan-personil">
                                    <div class="ringkasan-personil-title">Ringkasan Kinerja</div>
                                    <div id="monitoringBox_PENGAWAS" class="monitoring-box">
                                        <div class="loading-state">Memuat data personil…</div>
                                    </div>
                                </div>
                            </div>
                            <div class="rincian-kpi-col">
                                <div class="rincian-kpi-title">Tabel Aktivitas KPI Personil</div>
                                <div class="rtable-wrap">
                                    <table class="rtable">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Aktivitas KPI</th>
                                                <th>Target/Bulan</th>
                                                <th>Laporan Disetujui</th>
                                                <th>Bobot Item (%)</th>
                                                <th>Kontribusi (%)</th>
                                                <th>Status Capaian</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rincianBody_PENGAWAS">
                                            <tr>
                                                <td colspan="7" class="loading-state">Memuat rincian aktivitas…
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL MEDIS -->
                    <div class="kpi-tab-panel" data-tim-panel="MEDIS" style="display:none;">
                        <div class="monitor-grid">
                            <div>
                                <div class="personil-select-wrap">
                                    <label>Pilih Nama (Medis)</label>
                                    <select id="fPersonil_MEDIS"></select>
                                </div>

                                <div class="ringkasan-personil">
                                    <div class="ringkasan-personil-title">Ringkasan Kinerja</div>
                                    <div id="monitoringBox_MEDIS" class="monitoring-box">
                                        <div class="loading-state">Memuat data personil…</div>
                                    </div>
                                </div>
                            </div>
                            <div class="rincian-kpi-col">
                                <div class="rincian-kpi-title">Tabel Aktivitas KPI Personil</div>
                                <div class="rtable-wrap">
                                    <table class="rtable">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Aktivitas KPI</th>
                                                <th>Target/Bulan</th>
                                                <th>Laporan Disetujui</th>
                                                <th>Bobot Item (%)</th>
                                                <th>Kontribusi (%)</th>
                                                <th>Status Capaian</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rincianBody_MEDIS">
                                            <tr>
                                                <td colspan="7" class="loading-state">Memuat rincian aktivitas…
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

            <!-- RINGKASAN STATUS DOKUMEN -->
            <div>
                <span class="section-label sl-blue">Ringkasan Status Dokumen</span>
                <div class="card-block">
                    <div class="status-grid" id="statusGrid">
                        <div class="status-card sc-approve">
                            <div class="lbl">Disetujui</div>
                            <div class="val" id="stApprove">–</div>
                        </div>
                        <div class="status-card sc-reject">
                            <div class="lbl">Ditolak</div>
                            <div class="val" id="stReject">–</div>
                        </div>
                        <div class="status-card sc-pending">
                            <div class="lbl">Menunggu</div>
                            <div class="val" id="stPending">–</div>
                        </div>
                        <div class="status-card sc-cancel">
                            <div class="lbl">Dibatalkan</div>
                            <div class="val" id="stCancel">–</div>
                        </div>
                        <div class="status-card sc-total">
                            <div class="lbl">Total Dokumen</div>
                            <div class="val" id="stTotal">–</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INDIKATOR KPI -->
            {{-- <div>
                <span class="section-label sl-green">Indikator KPI</span>
                <div class="card-block">
                    <div class="indikator-grid">
                        <div class="indikator-card">
                            <div class="lbl">Total Laporan Disetujui</div>
                            <div class="val" id="ikTotalLaporan">–</div>
                        </div>
                        <div class="indikator-card">
                            <div class="lbl">Rata-rata Skor Akhir (aktif)</div>
                            <div class="val" id="ikRataSkor">–</div>
                        </div>
                        <div class="indikator-card">
                            <div class="lbl">Total Tunjangan (Rp)</div>
                            <div class="val" id="ikTunjangan">–</div>
                        </div>
                        <div class="indikator-card">
                            <div class="lbl">Jumlah Personil "BAIK"</div>
                            <div class="val" id="ikPersonilBaik">–</div>
                        </div>
                    </div>

                    <div style="margin-top:16px;">
                        <div class="rincian-kpi-title">Monitoring Personil Terpilih</div>
                        <div id="monitoringBox_SAFETY" data-monitor-team="SAFETY"
                            style="border:1px solid rgba(0,0,0,0.06);border-radius:10px;overflow:hidden;">
                            <div class="loading-state">Memuat data personil…</div>
                        </div>
                        <div id="monitoringBox_PENGAWAS" data-monitor-team="PENGAWAS"
                            style="border:1px solid rgba(0,0,0,0.06);border-radius:10px;overflow:hidden;display:none;">
                            <div class="loading-state">Memuat data personil…</div>
                        </div>
                        <div id="monitoringBox_MEDIS" data-monitor-team="MEDIS"
                            style="border:1px solid rgba(0,0,0,0.06);border-radius:10px;overflow:hidden;display:none;">
                            <div class="loading-state">Memuat data personil…</div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

    <script>
        const LOCKED_TIM = @json($lockedTim);
        const LOCKED_BADGE = @json($lockedBadge);
        const API_URL = "{{ route('dashboard-kpi-k3.api') }}";
        const TEAMS = LOCKED_TIM ? [LOCKED_TIM] : ['SAFETY', 'PENGAWAS', 'MEDIS'];
        let activeTeamTab = LOCKED_TIM || 'SAFETY';
        const teamLoaded = {};

        const fmtRp = (n) => n === null || n === undefined ? '—' : 'Rp ' + Number(n).toLocaleString('id-ID');
        const fmtPct = (n) => n === null || n === undefined ? '—' : Number(n).toLocaleString('id-ID', {
            minimumFractionDigits: 1,
            maximumFractionDigits: 1
        }) + '%';
        const fmtNum = (n) => n === null || n === undefined ? '—' : Number(n).toLocaleString('id-ID');

        function enhanceSelect(selectEl) {
            if (!selectEl || selectEl.dataset.enhanced) return;
            selectEl.dataset.enhanced = '1';
            selectEl.style.display = 'none';

            const wrap = document.createElement('div');
            wrap.className = 'cs-wrap';

            const trigger = document.createElement('button');
            trigger.type = 'button';
            trigger.className = 'cs-trigger';
            trigger.innerHTML =
                `<span class="cs-trigger-label placeholder">Pilih nama…</span><span class="cs-arrow"></span>`;

            const panel = document.createElement('div');
            panel.className = 'cs-panel';
            panel.innerHTML = `
        <div class="cs-search-wrap"><input type="text" class="cs-search" placeholder="Cari nama / badge…"></div>
        <div class="cs-list"></div>
    `;

            selectEl.insertAdjacentElement('afterend', wrap);
            wrap.appendChild(trigger);
            wrap.appendChild(panel);
            wrap.insertBefore(selectEl, trigger); // select tetap di dalam wrap, tersembunyi

            const searchInput = panel.querySelector('.cs-search');
            const list = panel.querySelector('.cs-list');

            function closePanel() {
                wrap.classList.remove('open');
            }

            trigger.addEventListener('click', () => {
                if (selectEl.disabled) return;
                const willOpen = !wrap.classList.contains('open');
                document.querySelectorAll('.cs-wrap.open').forEach(w => w.classList.remove('open'));
                if (willOpen) {
                    wrap.classList.add('open');
                    searchInput.value = '';
                    filterList('');
                    searchInput.focus();
                }
            });

            document.addEventListener('click', (e) => {
                if (!wrap.contains(e.target)) closePanel();
            });

            searchInput.addEventListener('input', (e) => filterList(e.target.value.toLowerCase()));

            function filterList(q) {
                let visible = 0;
                list.querySelectorAll('.cs-item').forEach(item => {
                    const match = item.textContent.toLowerCase().includes(q);
                    item.style.display = match ? '' : 'none';
                    if (match) visible++;
                });
                const empty = list.querySelector('.cs-empty');
                if (empty) empty.style.display = visible ? 'none' : '';
            }

            refreshEnhancedSelect(selectEl);
        }

        function refreshEnhancedSelect(selectEl) {
            if (!selectEl || !selectEl.dataset.enhanced) return;
            const wrap = selectEl.parentElement;
            const trigger = wrap.querySelector('.cs-trigger-label');
            const list = wrap.querySelector('.cs-list');

            list.innerHTML = '';
            [...selectEl.options].forEach(opt => {
                const item = document.createElement('div');
                item.className = 'cs-item' + (opt.value === selectEl.value ? ' selected' : '');
                item.textContent = opt.textContent;
                item.dataset.value = opt.value;
                item.addEventListener('click', () => {
                    if (selectEl.value !== opt.value) {
                        selectEl.value = opt.value;
                        selectEl.dispatchEvent(new Event('change'));
                    }
                    wrap.classList.remove('open');
                });
                list.appendChild(item);
            });
            list.insertAdjacentHTML('beforeend', '<div class="cs-empty" style="display:none;">Tidak ditemukan.</div>');

            const selectedOpt = selectEl.options[selectEl.selectedIndex];
            trigger.textContent = selectedOpt ? selectedOpt.textContent : 'Pilih nama…';
            trigger.classList.toggle('placeholder', !selectedOpt);

            wrap.classList.toggle('disabled', selectEl.disabled);
        }

        function populateTahun() {
            const el = document.getElementById('fTahun');
            const current = new Date().getFullYear();
            for (let y = current + 1; y >= current - 3; y--) {
                const opt = document.createElement('option');
                opt.value = y;
                opt.textContent = y;
                el.appendChild(opt);
            }
            el.value = current;
        }

        function applyLockUI() {
            if (!LOCKED_TIM) return;

            document.querySelectorAll('.kpi-tab-btn').forEach(btn => {
                btn.style.display = btn.dataset.tim === LOCKED_TIM ? '' : 'none';
            });
            document.querySelectorAll('.kpi-tab-panel').forEach(panel => {
                panel.style.display = panel.dataset.timPanel === LOCKED_TIM ? '' : 'none';
            });

            const sel = document.getElementById(`fPersonil_${LOCKED_TIM}`);
            if (sel) {
                sel.disabled = true;
                refreshEnhancedSelect(sel); // ⬅️ supaya class .disabled ikut terpasang di cs-wrap
            }
        }

        // Helper: Format tanggal dari YYYY-MM-DD menjadi DD/MM/YYYY (Sesuai Gambar Dashboard Sheet)
        function formatDateIndo(dateStr) {
            if (!dateStr) return '-';
            const parts = dateStr.split('-');
            if (parts.length !== 3) return dateStr;
            return `${parts[2]}/${parts[1]}/${parts[0]}`;
        }

        // Ambil parameter filter dari Panel Saklar
        function baseParams() {
            return {
                tahun: document.getElementById('fTahun').value,
                bulan: document.getElementById('fBulan').value,
                area: document.getElementById('fArea').value,
                periode_type: document.getElementById('fPeriode') ? document.getElementById('fPeriode').value : '26_25',
            };
        }

        function buildQueryTop() {
            return new URLSearchParams({
                ...baseParams(),
                tim: 'SEMUA'
            }).toString();
        }

        function buildQueryTeam(tim, personilKey) {
            const params = new URLSearchParams({
                tahun: document.getElementById('fTahun').value,
                bulan: document.getElementById('fBulan').value,
                area: document.getElementById('fArea').value,
                tim: tim, // ⬅️ tambahkan baris ini
            });
            if (personilKey) params.set('personil', personilKey);
            return params.toString();
        }

        function renderPeriode(p) {
            const tglMulaiFormatted = formatDateIndo(p.periode_mulai);
            const tglSelesaiFormatted = formatDateIndo(p.periode_selesai);

            document.getElementById('periodeAktifLine').innerHTML =
                `Periode aktif: &nbsp; <b>${tglMulaiFormatted} s/d ${tglSelesaiFormatted}</b> &nbsp;|&nbsp; <b>${p.bulan_label}</b> &nbsp;|&nbsp; Tim: <b>${p.tim}</b> &nbsp;·&nbsp; Area: <b>${p.area}</b>`;
        }

        function renderRingkasan(r) {
            document.getElementById('stApprove').textContent = fmtNum(r.approve);
            document.getElementById('stReject').textContent = fmtNum(r.reject);
            document.getElementById('stPending').textContent = fmtNum(r.pending);
            document.getElementById('stCancel').textContent = fmtNum(r.cancel);
            document.getElementById('stTotal').textContent = fmtNum(r.total);
        }

        // function renderIndikator(ik) {
        //     document.getElementById('ikTotalLaporan').textContent = fmtNum(ik.total_laporan_disetujui);
        //     document.getElementById('ikRataSkor').textContent = fmtPct(ik.rata_rata_skor_akhir);
        //     document.getElementById('ikTunjangan').textContent = ik.total_tunjangan === null ? '—' : fmtRp(ik
        //         .total_tunjangan);
        //     document.getElementById('ikPersonilBaik').textContent = fmtNum(ik.jumlah_personil_baik);
        // }

        function renderAreaOptions(areas) {
            const el = document.getElementById('fArea');
            const current = el.value;
            el.innerHTML = '<option value="SEMUA">SEMUA</option>' + areas.map(a => `<option value="${a}">${a}</option>`)
                .join('');
            el.value = current || 'SEMUA';
        }

        function kategoriClass(k) {
            if (k === 'BAIK') return 'kp-baik';
            if (k === 'CUKUP') return 'kp-cukup';
            return 'kp-perbaikan';
        }

        function renderMonitoringFor(tim, m) {
            const box = document.getElementById(`monitoringBox_${tim}`);
            if (!m) {
                box.innerHTML = '<div class="empty-state">Belum ada personil pada filter ini.</div>';
                return;
            }
            box.innerHTML = `
                <div class="kv-row"><span class="k">Persentase Capaian Aktivitas</span><span class="v">${fmtPct(m.persentase_capaian_aktivitas)}</span></div>
                <div class="kv-row"><span class="k">Persentase Ketepatan Waktu</span><span class="v">${fmtPct(m.persentase_ketepatan_waktu)}</span></div>
                <div class="kv-row"><span class="k">Nilai KPI Final</span><span class="v highlight">${fmtPct(m.nilai_kpi_final)}</span></div>                <div class="kv-row"><span class="k">Bobot Ditugaskan (%)</span><span class="v">${fmtPct(m.bobot_ditugaskan)}</span></div>
                <div class="kv-row"><span class="k">Jumlah Tugas</span><span class="v">${fmtNum(m.jumlah_tugas)}</span></div>
                <div class="kv-row"><span class="k">Tunjangan (Rp)</span><span class="v">${m.tunjangan === null ? '—' : fmtRp(m.tunjangan)}</span></div>
            `;
        }

        function renderRincianFor(tim, rows) {
            const body = document.getElementById(`rincianBody_${tim}`);
            if (!rows || rows.length === 0) {
                body.innerHTML =
                    '<tr><td colspan="7" class="empty-state">Tidak ada aktivitas untuk personil/filter ini.</td></tr>';
                return;
            }
            body.innerHTML = rows.map(r => `
                <tr>
                    <td style="font-weight:700;color:var(--blue)">${r.kode}</td>
                    <td>${r.nama_aktivitas}</td>
                    <td>${fmtNum(r.target_per_bulan)}</td>
                    <td style="color:var(--green);font-weight:800">${fmtNum(r.laporan_disetujui)}</td>
                    <td>${fmtPct(r.bobot_item)}</td>
                    <td>${fmtPct(r.kontribusi)}</td>
                    <td><span class="status-capaian ${r.status_capaian === 'TERCAPAI' ? 'sc-tercapai' : 'sc-belum'}">${r.status_capaian}</span></td>
                </tr>
            `).join('');
        }

        function renderPersonilOptionsFor(tim, options, selectedKey) {
            const el = document.getElementById(`fPersonil_${tim}`);
            el.innerHTML = options.map(o => `<option value="${o.key}">${o.label}</option>`).join('');
            if (selectedKey) el.value = selectedKey;
            refreshEnhancedSelect(el); // ⬅️ tambahkan ini
        }

        async function loadTopData() {
            try {
                const res = await fetch(`${API_URL}?${buildQueryTop()}`);
                if (!res.ok) throw new Error('Gagal memuat data');
                const json = await res.json();
                renderPeriode(json.periode);
                renderRingkasan(json.ringkasan_status_dokumen);
                // renderIndikator(json.indikator_kpi);
                renderAreaOptions(json.area_options || []);
            } catch (e) {
                console.error(e);
            }
        }

        async function loadTeamData(tim, personilKey) {
            const box = document.getElementById(`monitoringBox_${tim}`);
            const body = document.getElementById(`rincianBody_${tim}`);
            box.innerHTML = '<div class="loading-state">Memuat data personil…</div>';
            body.innerHTML = '<tr><td colspan="7" class="loading-state">Memuat rincian aktivitas…</td></tr>';
            try {
                const res = await fetch(`${API_URL}?${buildQueryTeam(tim, personilKey)}`);
                if (!res.ok) throw new Error('Gagal memuat data');
                const json = await res.json();

                // Top panel sekarang ikut personil/tim yang aktif di tab ini
                renderPeriode(json.periode);
                renderRingkasan(json.ringkasan_status_dokumen);
                // renderIndikator(json.indikator_kpi);
                renderAreaOptions(json.area_options || []);

                renderPersonilOptionsFor(tim, json.personil_options || [], json.personil_terpilih);
                renderMonitoringFor(tim, json.monitoring_personil);
                renderRincianFor(tim, json.rincian_aktivitas);
                teamLoaded[tim] = true;
            } catch (e) {
                console.error(e);
                box.innerHTML = '<div class="empty-state">Gagal memuat data tim ini.</div>';
            }
        }

        function switchTeamTab(tim) {
            if (LOCKED_TIM && tim !== LOCKED_TIM) return; // abaikan percobaan pindah tab

            activeTeamTab = tim;
            document.querySelectorAll('.kpi-tab-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.tim === tim);
            });

            document.querySelectorAll('.kpi-tab-panel').forEach(panel => {
                panel.style.display = panel.dataset.timPanel === tim ? '' : 'none';
            });
            // document.querySelectorAll('[data-monitor-team]').forEach(el => {
            //     el.style.display = el.dataset.monitorTeam === tim ? '' : 'none';
            // });
            // pindah tab -> top panel ikut ganti ke data tim ini, entah dari cache atau fetch baru
            if (!teamLoaded[tim]) {
                loadTeamData(tim);
            } else {
                // sudah pernah di-load sebelumnya, tapi top panel bisa saja lagi menampilkan tim lain -> refresh ringan
                const currentPersonil = document.getElementById(`fPersonil_${tim}`)?.value || null;
                loadTeamData(tim, currentPersonil);
            }
        }

        TEAMS.forEach(tim => {
            document.getElementById(`fPersonil_${tim}`).addEventListener('change', (e) => {
                loadTeamData(tim, e.target.value);
            });
        });

        document.getElementById('btnTerapkan').addEventListener('click', () => {
            TEAMS.forEach(t => teamLoaded[t] = false);
            const currentPersonil = document.getElementById(`fPersonil_${activeTeamTab}`)?.value || null;
            loadTeamData(activeTeamTab, currentPersonil);
        });

        TEAMS.forEach(tim => enhanceSelect(document.getElementById(`fPersonil_${tim}`)));

        populateTahun();
        applyLockUI();
        loadTeamData(activeTeamTab);
    </script>
</body>

</html>
