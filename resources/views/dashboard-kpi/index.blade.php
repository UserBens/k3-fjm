<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Dashboard Monitoring KPI K3 — PT. Fokus Jasa Mitra</title>
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
            --purple: #4C3F91;
            --teal: #0E7C86;
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
            padding: 18px 18px 28px;
        }

        .dash-grid {
            display: grid;
            grid-template-columns: 5fr 7fr;
            gap: 16px;
            align-items: start;
        }

        @media (max-width: 1180px) {
            .dash-grid {
                grid-template-columns: 1fr;
            }
        }

        .panel {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .panel-hdr {
            padding: 10px 16px;
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 15px;
            letter-spacing: 0.03em;
        }

        .panel-hdr .sub {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 10.5px;
            font-weight: 500;
            letter-spacing: 0;
            opacity: 0.85;
            margin-top: 2px;
        }

        .panel-hdr.hdr-red {
            background: linear-gradient(135deg, var(--red), var(--red2));
        }

        .panel-hdr.hdr-green {
            background: linear-gradient(135deg, var(--green), var(--green2));
        }

        .panel-body {
            padding: 14px 16px 16px;
        }

        /* ── info strip (jenis / periode / % capai / % ketepatan) ── */
        .info-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .info-cell {
            background: #EFEBFB;
            padding: 8px 10px;
            text-align: center;
        }

        .info-cell .info-lbl {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #6B3FA0;
            margin-bottom: 3px;
        }

        .info-cell .info-val {
            font-size: 12.5px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .info-cell.formula-note {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-cell.formula-note .info-lbl {
            font-size: 8.5px;
            color: #8B7BB8;
            font-weight: 600;
            letter-spacing: 0;
            text-transform: none;
        }

        /* ── selector + result strip (pilih jenis/tim, nama petugas, HKE, nilai, tunjangan) ── */
        .selector-strip {
            display: grid;
            grid-template-columns: 1.1fr 1.4fr 0.7fr 0.9fr 1fr;
            gap: 1px;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .selector-cell {
            background: var(--red);
            padding: 8px 10px;
        }

        .selector-cell .sel-lbl {
            font-size: 8.5px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 5px;
        }

        .selector-cell.result-cell {
            background: #FCE9EA;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .selector-cell.result-cell .sel-lbl {
            color: #B3121F;
        }

        .selector-cell.result-cell .sel-val {
            font-size: 15px;
            font-weight: 800;
            color: var(--red);
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.02em;
        }

        .selector-cell select {
            width: 100%;
            height: 30px;
            padding: 0 8px;
            border-radius: 6px;
            border: none;
            font-size: 11.5px;
            font-weight: 700;
            color: #1A1D2E;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 8px center;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        @media (max-width: 900px) {
            .selector-strip {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* ── activity table ── */
        .kpi-rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .kpi-rtable {
            width: 100%;
            min-width: 720px;
            border-collapse: collapse;
            font-size: 11px;
        }

        .kpi-rtable th {
            background: var(--red);
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            padding: 7px 6px;
            text-align: center;
            white-space: nowrap;
        }

        .kpi-rtable th.group-hdr {
            background: var(--red2);
        }

        .kpi-rtable td {
            padding: 6px 6px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            white-space: nowrap;
            color: #1A1D2E;
        }

        .kpi-rtable td.txt-left {
            text-align: left;
        }

        .kpi-rtable tbody tr:hover td {
            background: #FBF5F5;
        }

        .kpi-rtable a.act-link {
            color: var(--blue);
            font-weight: 700;
            text-decoration: none;
        }

        .kpi-rtable a.act-link:hover {
            text-decoration: underline;
        }

        .kpi-rtable tfoot td {
            background: var(--red);
            color: #fff;
            font-weight: 800;
            font-size: 10.5px;
            padding: 8px 6px;
        }

        .status-inline {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-weight: 800;
            font-size: 9.5px;
            letter-spacing: 0.02em;
            white-space: nowrap;
        }

        .status-inline.st-green {
            color: #1A7A3C;
        }

        .status-inline.st-amber {
            color: #D97706;
        }

        .status-inline.st-red {
            color: #D0021B;
        }

        .status-inline.st-gray {
            color: #94A3B8;
        }

        .col-ditolak {
            color: #D0021B;
            font-weight: 700;
        }

        /* ── right panel: periode config strip ── */
        .periode-strip {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1px;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .periode-cell {
            background: var(--green);
            padding: 8px 10px;
        }

        .periode-cell .p-lbl {
            font-size: 8.5px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 5px;
        }

        .periode-cell select,
        .periode-cell .p-static {
            width: 100%;
            height: 30px;
            padding: 0 8px;
            border-radius: 6px;
            border: none;
            font-size: 11.5px;
            font-weight: 700;
            color: #1A1D2E;
            background: #fff;
            display: flex;
            align-items: center;
        }

        .periode-cell select {
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 8px center;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        .periode-cell.static-cell {
            background: #E7F3EC;
        }

        .periode-cell.static-cell .p-lbl {
            color: #1A7A3C;
        }

        .periode-cell.static-cell .p-static {
            background: transparent;
            color: #1A7A3C;
            font-weight: 800;
        }

        @media (max-width: 900px) {
            .periode-strip {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* ── KPI summary boxes (2 rows of boxes) ── */
        .kpi-box-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 10px;
        }

        @media (max-width: 900px) {
            .kpi-box-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .kpi-box {
            border-radius: 10px;
            padding: 12px 10px;
            text-align: center;
        }

        .kpi-box .kb-lbl {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .kpi-box .kb-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            line-height: 1;
        }

        .kpi-box.box-total {
            background: #EAF1FB;
        }

        .kpi-box.box-total .kb-lbl {
            color: #2D4B9E;
        }

        .kpi-box.box-total .kb-val {
            color: #1A1D2E;
        }

        .kpi-box.box-green {
            background: #E4F4E9;
        }

        .kpi-box.box-green .kb-lbl {
            color: #1A7A3C;
        }

        .kpi-box.box-green .kb-val {
            color: #1A7A3C;
        }

        .kpi-box.box-blue {
            background: #E7EBFB;
        }

        .kpi-box.box-blue .kb-lbl {
            color: #2D4B9E;
        }

        .kpi-box.box-blue .kb-val {
            color: #2D4B9E;
        }

        .kpi-box.box-purple {
            background: #ECE9FB;
        }

        .kpi-box.box-purple .kb-lbl {
            color: #4C3F91;
        }

        .kpi-box.box-purple .kb-val {
            color: #4C3F91;
        }

        .kpi-box.box-amber {
            background: #FCEED2;
        }

        .kpi-box.box-amber .kb-lbl {
            color: #B36B00;
        }

        .kpi-box.box-amber .kb-val {
            color: #D97706;
        }

        .kpi-box.box-teal {
            background: #DFF1F2;
        }

        .kpi-box.box-teal .kb-lbl {
            color: #0E7C86;
        }

        .kpi-box.box-teal .kb-val {
            color: #0E7C86;
        }

        /* ── total tunjangan banner ── */
        .tunjangan-banner {
            background: var(--dark);
            border-radius: 10px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .tunjangan-banner .tb-lbl {
            font-size: 11px;
            font-weight: 700;
            color: #B9C2E8;
            letter-spacing: 0.02em;
        }

        .tunjangan-banner .tb-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: #fff;
            letter-spacing: 0.02em;
        }

        /* ── ringkasan berkas sistem ── */
        .berkas-panel {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .berkas-hdr {
            background: var(--dark);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            text-align: center;
            padding: 8px;
        }

        .berkas-body {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 18px;
            padding: 12px 14px;
            justify-content: center;
            background: #fff;
        }

        .berkas-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .berkas-item .b-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .b-dot.ok {
            background: #1A7A3C;
        }

        .b-dot.pending {
            background: #D97706;
        }

        .b-dot.gagal {
            background: #D0021B;
        }

        .b-dot.reject {
            background: #D0021B;
        }

        .b-dot.batal {
            background: #94A3B8;
        }

        .b-dot.warn {
            background: #D97706;
        }

        .skeleton-bar {
            height: 12px;
            border-radius: 6px;
            background: linear-gradient(90deg, #F0F2FA 25%, #E5E9F5 37%, #F0F2FA 63%);
            background-size: 400% 100%;
            animation: shimmer 1.4s ease infinite;
            display: inline-block;
            width: 60px;
        }

        @keyframes shimmer {
            0% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0 50%;
            }
        }

        .empty-row td {
            text-align: center;
            padding: 20px 10px;
            color: #94A3B8;
            font-size: 11.5px;
        }

        @media (max-width: 640px) {
            #page-content {
                padding: 12px 12px 22px;
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

    {{-- ══════ SIDEBAR (partial existing app) ══════ --}}
    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    {{-- ══════ MAIN ══════ --}}
    <div id="main-content">

        @include('partials.topbar')

        <div id="page-content">

            <div class="dash-grid">

                {{-- ══════════════════ PANEL KIRI — MONITORING PETUGAS ══════════════════ --}}
                <div class="panel">
                    <div class="panel-hdr hdr-red">
                        MONITORING PETUGAS
                        <div class="sub">cek laporan Anda: submit / approve / reject, status &amp; tunjangan</div>
                    </div>
                    <div class="panel-body">

                        {{-- info strip: jenis, periode, % capai, % ketepatan --}}
                        <div class="info-strip">
                            <div class="info-cell">
                                <div class="info-lbl">Jenis (cek)</div>
                                <div class="info-val" id="infoJenisCek">-</div>
                            </div>
                            <div class="info-cell">
                                <div class="info-lbl">Periode</div>
                                <div class="info-val" id="infoPeriode">-</div>
                            </div>
                            <div class="info-cell">
                                <div class="info-lbl">% Capai Aktivitas</div>
                                <div class="info-val" id="infoCapaiAktivitas">-</div>
                            </div>
                            <div class="info-cell">
                                <div class="info-lbl">% Ketepatan</div>
                                <div class="info-val" id="infoKetepatan">-</div>
                            </div>
                        </div>
                        <div
                            style="text-align:center;font-size:9.5px;color:#94A3B8;font-weight:600;margin:-4px 0 12px;">
                            (Aktivitas&times;90% + Ketepatan&times;10%)
                        </div>

                        {{-- selector + hasil strip --}}
                        <div class="selector-strip">
                            <div class="selector-cell">
                                <div class="sel-lbl">1) Pilih Jenis/Tim</div>
                                <select id="selJenisTim" onchange="onJenisTimChange()">
                                    <option value="">Memuat…</option>
                                </select>
                            </div>
                            <div class="selector-cell">
                                <div class="sel-lbl">2) Pilih Nama Petugas</div>
                                <select id="selNamaPetugas" onchange="onPetugasChange()">
                                    <option value="">Pilih jenis/tim dahulu</option>
                                </select>
                            </div>
                            <div class="selector-cell result-cell">
                                <div class="sel-lbl">HKE Anda</div>
                                <div class="sel-val" id="hkeAnda">-</div>
                            </div>
                            <div class="selector-cell result-cell">
                                <div class="sel-lbl">Nilai KPI Final</div>
                                <div class="sel-val" id="nilaiKpiFinal">-</div>
                            </div>
                            <div class="selector-cell result-cell">
                                <div class="sel-lbl">Tunjangan</div>
                                <div class="sel-val" id="tunjanganPetugas">-</div>
                            </div>
                        </div>

                        {{-- tabel aktivitas petugas --}}
                        <div class="kpi-rtable-wrap">
                            <table class="kpi-rtable">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Kode</th>
                                        <th rowspan="2">Aktivitas</th>
                                        <th rowspan="2">Tim</th>
                                        <th rowspan="2">Target/<br>Bulan</th>
                                        <th colspan="4" class="group-hdr">Aktual/Bulan</th>
                                        <th rowspan="2">Bobot<br>Item (%)</th>
                                        <th rowspan="2">Kontribusi<br>(%)</th>
                                        <th rowspan="2">Status</th>
                                    </tr>
                                    <tr>
                                        <th class="group-hdr">Terkirim</th>
                                        <th class="group-hdr">Disetujui</th>
                                        <th class="group-hdr">Ditolak</th>
                                        <th class="group-hdr">Pending</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyAktivitasPetugas">
                                    <tr class="empty-row">
                                        <td colspan="11">Pilih jenis/tim dan nama petugas untuk menampilkan data.</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td id="totTarget">-</td>
                                        <td id="totTerkirim">-</td>
                                        <td id="totDisetujui">-</td>
                                        <td id="totDitolak">-</td>
                                        <td id="totPending">-</td>
                                        <td id="totBobot">-</td>
                                        <td id="totKontribusi">-</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- ══════════════════ PANEL KANAN — MONITORING REALTIME TIM ══════════════════ --}}
                <div class="panel">
                    <div class="panel-hdr hdr-green">
                        MONITORING REALTIME HASIL PENCAPAIAN KPI TIM KESELURUHAN
                        <div class="sub">(Medis &middot; Safety &middot; Pengawas)</div>
                    </div>
                    <div class="panel-body">

                        {{-- periode config strip --}}
                        <div class="periode-strip">
                            <div class="periode-cell">
                                <div class="p-lbl">Periode Bulan</div>
                                <select id="selPeriodeBulan" onchange="onPeriodeChange()">
                                    <option value="">Memuat…</option>
                                </select>
                            </div>
                            <div class="periode-cell">
                                <div class="p-lbl">Periode Tahun</div>
                                <select id="selPeriodeTahun" onchange="onPeriodeChange()">
                                    <option value="">Memuat…</option>
                                </select>
                            </div>
                            <div class="periode-cell">
                                <div class="p-lbl">Tanggal Cut Off</div>
                                <div class="p-static" id="tanggalCutOff">-</div>
                            </div>
                            <div class="periode-cell static-cell">
                                <div class="p-lbl">Dari Tanggal (Otomatis)</div>
                                <div class="p-static" id="dariTanggal">-</div>
                            </div>
                            <div class="periode-cell static-cell">
                                <div class="p-lbl">Sampai Tanggal (Otomatis)</div>
                                <div class="p-static" id="sampaiTanggal">-</div>
                            </div>
                        </div>

                        {{-- baris KPI 1: total laporan, tepat waktu, disetujui, capaian keseluruhan --}}
                        <div class="kpi-box-row">
                            <div class="kpi-box box-total">
                                <div class="kb-lbl">Total Laporan</div>
                                <div class="kb-val" id="valTotalLaporan"><span class="skeleton-bar"></span></div>
                            </div>
                            <div class="kpi-box box-green">
                                <div class="kb-lbl">% Tepat Waktu</div>
                                <div class="kb-val" id="valTepatWaktu"><span class="skeleton-bar"></span></div>
                            </div>
                            <div class="kpi-box box-blue">
                                <div class="kb-lbl">% Disetujui</div>
                                <div class="kb-val" id="valDisetujui"><span class="skeleton-bar"></span></div>
                            </div>
                            <div class="kpi-box box-purple">
                                <div class="kb-lbl">Capaian KPI Keseluruhan</div>
                                <div class="kb-val" id="valCapaianKeseluruhan"><span class="skeleton-bar"></span>
                                </div>
                            </div>
                        </div>

                        {{-- baris KPI 2: KPI per tim + closing UA/UC --}}
                        <div class="kpi-box-row">
                            <div class="kpi-box box-green">
                                <div class="kb-lbl">KPI Tim Safety</div>
                                <div class="kb-val" id="valKpiSafety"><span class="skeleton-bar"></span></div>
                            </div>
                            <div class="kpi-box box-blue">
                                <div class="kb-lbl">KPI Tim Pengawas</div>
                                <div class="kb-val" id="valKpiPengawas"><span class="skeleton-bar"></span></div>
                            </div>
                            <div class="kpi-box box-amber">
                                <div class="kb-lbl">KPI Tim Medis</div>
                                <div class="kb-val" id="valKpiMedis"><span class="skeleton-bar"></span></div>
                            </div>
                            <div class="kpi-box box-teal">
                                <div class="kb-lbl">% Closing UA/UC</div>
                                <div class="kb-val" id="valClosingUaUc"><span class="skeleton-bar"></span></div>
                            </div>
                        </div>

                        {{-- total tunjangan periode --}}
                        <div class="tunjangan-banner">
                            <div class="tb-lbl">TOTAL TUNJANGAN PERIODE INI (SEMUA PETUGAS)</div>
                            <div class="tb-val" id="valTotalTunjangan">-</div>
                        </div>

                        {{-- ringkasan berkas sistem --}}
                        <div class="berkas-panel">
                            <div class="berkas-hdr">Ringkasan Berkas Sistem (status pemindahan file)</div>
                            <div class="berkas-body" id="berkasSummaryRow">
                                <div class="berkas-item"><span class="b-dot ok"></span> Berkas SUKSES: <span
                                        id="berkasSukses">-</span></div>
                                <div class="berkas-item"><span class="b-dot pending"></span> Menunggu approve
                                    (PENDING): <span id="berkasPending">-</span></div>
                                <div class="berkas-item"><span class="b-dot gagal"></span> GAGAL pindah: <span
                                        id="berkasGagalPindah">-</span></div>
                                <div class="berkas-item"><span class="b-dot reject"></span> REJECT (menunggu revisi):
                                    <span id="berkasReject">-</span>
                                </div>
                                <div class="berkas-item"><span class="b-dot batal"></span> BATAL: <span
                                        id="berkasBatal">-</span></div>
                                <div class="berkas-item"><span class="b-dot gagal"></span> GAGAL tak direvisi: <span
                                        id="berkasGagalTakDirevisi">-</span></div>
                                <div class="berkas-item"><span class="b-dot warn"></span> Tanggal tidak valid: <span
                                        id="berkasTanggalTidakValid">-</span></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // ══════ Endpoints (sesuaikan dengan route yang tersedia di aplikasi) ══════
        const KPI_FILTER_ENDPOINT = "{{ route('dashboard-kpi.filters') }}";
        const KPI_PETUGAS_DATA_ENDPOINT = "{{ route('dashboard-kpi.petugas-data') }}";
        const KPI_TIM_SUMMARY_ENDPOINT = "{{ route('dashboard-kpi.tim-summary') }}";

        let currentPeriodeBulan = null;
        let currentPeriodeTahun = null;

        function escapeHtmlKPI(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function display(value, fallback = '-') {
            return (value === null || value === undefined || value === '') ? fallback : value;
        }

        function formatRupiah(value) {
            if (value === null || value === undefined) return '-';
            return 'Rp' + Number(value).toLocaleString('id-ID', {
                maximumFractionDigits: 0
            });
        }

        function formatPercent(value) {
            if (value === null || value === undefined) return '-';
            return Number(value).toLocaleString('id-ID', {
                minimumFractionDigits: 1,
                maximumFractionDigits: 1
            }) + '%';
        }

        function statusClass(status) {
            if (status === 'TERCAPAI') return 'st-green';
            if (status === 'MENUNGGU') return 'st-amber';
            if (status === 'BELUM/KURANG' || status === 'TIDAK TERCAPAI') return 'st-red';
            return 'st-gray';
        }

        function renderStatusInline(status) {
            if (!status) return '<span class="status-inline st-gray">-</span>';
            return `<span class="status-inline ${statusClass(status)}">${escapeHtmlKPI(status)}</span>`;
        }

        // ══════ 1) Muat opsi filter (jenis/tim, bulan, tahun) ══════
        async function loadFilterOptions() {
            try {
                const res = await fetch(KPI_FILTER_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const json = await res.json();

                const selJenis = document.getElementById('selJenisTim');
                selJenis.innerHTML = json.jenis_tim.map(j =>
                    `<option value="${escapeHtmlKPI(j.value)}">${escapeHtmlKPI(j.label)}</option>`
                ).join('');

                const selBulan = document.getElementById('selPeriodeBulan');
                selBulan.innerHTML = json.bulan_list.map(b =>
                    `<option value="${b.value}" ${b.selected ? 'selected' : ''}>${escapeHtmlKPI(b.label)}</option>`
                ).join('');

                const selTahun = document.getElementById('selPeriodeTahun');
                selTahun.innerHTML = json.tahun_list.map(t =>
                    `<option value="${t.value}" ${t.selected ? 'selected' : ''}>${t.label}</option>`
                ).join('');

                currentPeriodeBulan = selBulan.value;
                currentPeriodeTahun = selTahun.value;

                if (json.jenis_tim.length > 0) {
                    await onJenisTimChange();
                }
                await loadTimSummary();

            } catch (e) {
                console.error(e);
            }
        }

        // ══════ 2) Saat Jenis/Tim dipilih → muat daftar nama petugas ══════
        async function onJenisTimChange() {
            const jenisTim = document.getElementById('selJenisTim').value;
            const selPetugas = document.getElementById('selNamaPetugas');
            selPetugas.innerHTML = '<option value="">Memuat…</option>';
            document.getElementById('infoJenisCek').textContent = display(jenisTim);

            if (!jenisTim) return;

            try {
                const res = await fetch(`${KPI_FILTER_ENDPOINT}?jenis_tim=${encodeURIComponent(jenisTim)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const json = await res.json();

                if (!json.petugas_list || json.petugas_list.length === 0) {
                    selPetugas.innerHTML = '<option value="">Tidak ada petugas</option>';
                    clearPetugasPanel();
                    return;
                }

                selPetugas.innerHTML = json.petugas_list.map(p =>
                    `<option value="${escapeHtmlKPI(p.value)}">${escapeHtmlKPI(p.label)}</option>`
                ).join('');

                await onPetugasChange();
            } catch (e) {
                console.error(e);
                selPetugas.innerHTML = '<option value="">Gagal memuat</option>';
            }
        }

        // ══════ 3) Saat Nama Petugas dipilih → muat data KPI petugas ══════
        async function onPetugasChange() {
            const jenisTim = document.getElementById('selJenisTim').value;
            const petugas = document.getElementById('selNamaPetugas').value;
            if (!jenisTim || !petugas) {
                clearPetugasPanel();
                return;
            }

            document.getElementById('hkeAnda').innerHTML = '<span class="skeleton-bar"></span>';
            document.getElementById('nilaiKpiFinal').innerHTML = '<span class="skeleton-bar"></span>';
            document.getElementById('tunjanganPetugas').innerHTML = '<span class="skeleton-bar"></span>';
            document.getElementById('tbodyAktivitasPetugas').innerHTML =
                '<tr class="empty-row"><td colspan="11">Memuat data…</td></tr>';

            try {
                const params = new URLSearchParams({
                    jenis_tim: jenisTim,
                    petugas: petugas,
                    bulan: currentPeriodeBulan ?? '',
                    tahun: currentPeriodeTahun ?? ''
                });
                const res = await fetch(`${KPI_PETUGAS_DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const json = await res.json();

                document.getElementById('infoPeriode').textContent =
                    `${display(json.periode.dari)} s/d ${display(json.periode.sampai)}`;
                document.getElementById('infoCapaiAktivitas').textContent = formatPercent(json.persen_capai_aktivitas);
                document.getElementById('infoKetepatan').textContent = formatPercent(json.persen_ketepatan);

                document.getElementById('hkeAnda').textContent = display(json.hke);
                document.getElementById('nilaiKpiFinal').textContent = formatPercent(json.nilai_kpi_final);
                document.getElementById('tunjanganPetugas').textContent = formatRupiah(json.tunjangan);

                const tbody = document.getElementById('tbodyAktivitasPetugas');
                if (!json.aktivitas || json.aktivitas.length === 0) {
                    tbody.innerHTML =
                        '<tr class="empty-row"><td colspan="11">Belum ada aktivitas pada periode ini.</td></tr>';
                } else {
                    tbody.innerHTML = json.aktivitas.map((row, idx) => `
                    <tr>
                        <td>${idx + 1}</td>
                        <td><b>${escapeHtmlKPI(row.kode)}</b></td>
                        <td class="txt-left">
                            ${row.link ? `<a class="act-link" href="${row.link}">${escapeHtmlKPI(row.nama)}</a>` : escapeHtmlKPI(row.nama)}
                        </td>
                        <td>${escapeHtmlKPI(row.tim)}</td>
                        <td>${display(row.target)}</td>
                        <td>${display(row.terkirim)}</td>
                        <td>${display(row.disetujui)}</td>
                        <td class="col-ditolak">${display(row.ditolak)}</td>
                        <td>${display(row.pending)}</td>
                        <td>${formatPercent(row.bobot_item)}</td>
                        <td>${formatPercent(row.kontribusi)}</td>
                        <td>${renderStatusInline(row.status)}</td>
                    </tr>`).join('');
                }

                document.getElementById('totTarget').textContent = display(json.total?.target);
                document.getElementById('totTerkirim').textContent = display(json.total?.terkirim);
                document.getElementById('totDisetujui').textContent = display(json.total?.disetujui);
                document.getElementById('totDitolak').textContent = display(json.total?.ditolak);
                document.getElementById('totPending').textContent = display(json.total?.pending);
                document.getElementById('totBobot').textContent = formatPercent(json.total?.bobot_item);
                document.getElementById('totKontribusi').textContent = formatPercent(json.total?.kontribusi);

            } catch (e) {
                console.error(e);
                document.getElementById('tbodyAktivitasPetugas').innerHTML =
                    '<tr class="empty-row"><td colspan="11">Gagal memuat data.</td></tr>';
            }
        }

        function clearPetugasPanel() {
            document.getElementById('hkeAnda').textContent = '-';
            document.getElementById('nilaiKpiFinal').textContent = '-';
            document.getElementById('tunjanganPetugas').textContent = '-';
            document.getElementById('infoPeriode').textContent = '-';
            document.getElementById('infoCapaiAktivitas').textContent = '-';
            document.getElementById('infoKetepatan').textContent = '-';
            document.getElementById('tbodyAktivitasPetugas').innerHTML =
                '<tr class="empty-row"><td colspan="11">Pilih jenis/tim dan nama petugas untuk menampilkan data.</td></tr>';
            ['totTarget', 'totTerkirim', 'totDisetujui', 'totDitolak', 'totPending', 'totBobot', 'totKontribusi']
            .forEach(id => document.getElementById(id).textContent = '-');
        }

        // ══════ 4) Ganti periode bulan/tahun → muat ulang ringkasan tim ══════
        async function onPeriodeChange() {
            currentPeriodeBulan = document.getElementById('selPeriodeBulan').value;
            currentPeriodeTahun = document.getElementById('selPeriodeTahun').value;
            await loadTimSummary();
            if (document.getElementById('selNamaPetugas').value) {
                await onPetugasChange();
            }
        }

        // ══════ 5) Muat ringkasan realtime tim keseluruhan ══════
        async function loadTimSummary() {
            try {
                const params = new URLSearchParams({
                    bulan: currentPeriodeBulan ?? '',
                    tahun: currentPeriodeTahun ?? ''
                });
                const res = await fetch(`${KPI_TIM_SUMMARY_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const json = await res.json();

                document.getElementById('tanggalCutOff').textContent = display(json.periode.tanggal_cut_off);
                document.getElementById('dariTanggal').textContent = display(json.periode.dari_tanggal);
                document.getElementById('sampaiTanggal').textContent = display(json.periode.sampai_tanggal);

                document.getElementById('valTotalLaporan').textContent = display(json.summary.total_laporan);
                document.getElementById('valTepatWaktu').textContent = formatPercent(json.summary.persen_tepat_waktu);
                document.getElementById('valDisetujui').textContent = formatPercent(json.summary.persen_disetujui);
                document.getElementById('valCapaianKeseluruhan').textContent = formatPercent(json.summary
                    .capaian_kpi_keseluruhan);

                document.getElementById('valKpiSafety').textContent = formatPercent(json.summary.kpi_tim_safety);
                document.getElementById('valKpiPengawas').textContent = formatPercent(json.summary.kpi_tim_pengawas);
                document.getElementById('valKpiMedis').textContent = formatPercent(json.summary.kpi_tim_medis);
                document.getElementById('valClosingUaUc').textContent = formatPercent(json.summary
                .persen_closing_ua_uc);

                document.getElementById('valTotalTunjangan').textContent = formatRupiah(json.summary
                    .total_tunjangan_periode);

                document.getElementById('berkasSukses').textContent = display(json.berkas.sukses);
                document.getElementById('berkasPending').textContent = display(json.berkas.pending);
                document.getElementById('berkasGagalPindah').textContent = display(json.berkas.gagal_pindah);
                document.getElementById('berkasReject').textContent = display(json.berkas.reject);
                document.getElementById('berkasBatal').textContent = display(json.berkas.batal);
                document.getElementById('berkasGagalTakDirevisi').textContent = display(json.berkas.gagal_tak_direvisi);
                document.getElementById('berkasTanggalTidakValid').textContent = display(json.berkas
                    .tanggal_tidak_valid);

            } catch (e) {
                console.error(e);
            }
        }

        document.addEventListener('DOMContentLoaded', loadFilterOptions);
    </script>

</body>

</html>
