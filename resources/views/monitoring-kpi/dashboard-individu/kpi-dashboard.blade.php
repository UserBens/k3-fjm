<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Dashboard KPI Perseorangan — PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
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
            flex-wrap: wrap;
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
            min-width: 180px;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            outline: none;
        }

        .filter-label {
            font-size: 10px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 5px;
            display: block;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        /* Employee info strip */
        .info-strip {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 0;
            margin-bottom: 14px;
        }

        .info-cell {
            padding: 14px 18px;
            border-right: 1px solid rgba(0, 0, 0, 0.06);
        }

        .info-cell:last-child {
            border-right: none;
        }

        .info-cell-label {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 4px;
        }

        .info-cell-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.01em;
            color: #1A1D2E;
            line-height: 1.15;
        }

        .info-cell-sub {
            font-size: 11px;
            color: #94A3B8;
            font-weight: 600;
            margin-top: 1px;
        }

        /* Summary cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px 16px;
        }

        .stat-label {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            letter-spacing: 0.01em;
            line-height: 1;
            color: #1A1D2E;
        }

        .stat-card.accent-blue .stat-value {
            color: #2D4B9E;
        }

        .stat-card.accent-green .stat-value {
            color: #1A7A3C;
        }

        .stat-note {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
            margin-top: 4px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.02em;
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

        .sp-gray {
            background: rgba(100, 116, 139, 0.09);
            color: #64748B;
        }

        .section-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 17px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
        }

        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse;
        }

        .rtable th {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0 8px 8px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            white-space: nowrap;
        }

        .rtable th.num,
        .rtable td.num {
            text-align: right;
        }

        .rtable th.center,
        .rtable td.center {
            text-align: center;
        }

        .rtable td {
            font-size: 12px;
            color: #1A1D2E;
            padding: 9px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            vertical-align: middle;
        }

        .rtable tr:hover td {
            background: #F8F9FF;
        }

        .rtable tr.row-total td {
            border-top: 2px solid rgba(0, 0, 0, 0.08);
            border-bottom: none;
            font-weight: 800;
            background: #F8F9FF;
        }

        .kode-chip {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 6px;
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
            font-size: 10.5px;
            font-weight: 800;
        }

        .status-icon {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .status-icon.on {
            background: rgba(26, 122, 60, 0.1);
            color: #1A7A3C;
        }

        .status-icon.off {
            background: rgba(100, 116, 139, 0.08);
            color: #94A3B8;
        }

        .cell-muted {
            color: #CBD5E1;
        }

        .kontribusi-bar-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kontribusi-track {
            flex: 1;
            height: 6px;
            border-radius: 4px;
            background: #F0F2FA;
            overflow: hidden;
            min-width: 50px;
        }

        .kontribusi-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, #2D4B9E, #3A5FBF);
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

        .note-box {
            font-size: 10.5px;
            line-height: 1.6;
            color: #94A3B8;
            font-style: italic;
            padding: 12px 14px;
            background: #F8F9FF;
            border-radius: 8px;
            border: 1px dashed rgba(45, 75, 158, 0.18);
            margin-top: 14px;
        }

        .chart-wrap {
            position: relative;
            height: 300px;
        }

        @media (max-width: 1100px) {
            .summary-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .info-strip {
                grid-template-columns: 1fr 1fr;
            }

            .info-cell:nth-child(2) {
                border-right: none;
            }
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

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .info-strip {
                grid-template-columns: 1fr;
            }

            .info-cell {
                border-right: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            }

            .filter-select {
                min-width: 0;
                flex: 1 1 100%;
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
                            <span class="pg-eyebrow">Dashboard Monitoring KPI · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DASHBOARD KPI <span>PERSEORANGAN</span></div>
                        <div class="pg-sub">Rekap capaian KPI bulanan per petugas HSE — laporan, bobot, kontribusi,
                            dan estimasi tunjangan.</div>
                    </div>
                    <div class="pg-actions">
                        <div class="filter-group">
                            <label class="filter-label">Nama HSE</label>
                            <select id="filterHse" class="filter-select" style="min-width:220px;"
                                onchange="onFilterChange()">
                                <option value="">Memuat daftar HSE...</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-label">Bulan</label>
                            <select id="filterBulan" class="filter-select" style="min-width:130px;"
                                onchange="onFilterChange()"></select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-label">Tahun</label>
                            <select id="filterTahun" class="filter-select" style="min-width:100px;"
                                onchange="onFilterChange()"></select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ══════ INFO STRIP ══════ -->
            <div class="section-card info-strip" id="infoStrip">
                <div class="info-cell">
                    <div class="info-cell-label">Nama HSE</div>
                    <div class="info-cell-value" id="infoNamaHse">—</div>
                    <div class="info-cell-sub" id="infoBadgeHse">—</div>
                </div>
                <div class="info-cell">
                    <div class="info-cell-label">Bulan</div>
                    <div class="info-cell-value" id="infoBulan">—</div>
                </div>
                <div class="info-cell">
                    <div class="info-cell-label">Tahun</div>
                    <div class="info-cell-value" id="infoTahun">—</div>
                </div>
                <div class="info-cell">
                    <div class="info-cell-label">Hari Kerja Efektif</div>
                    <div class="info-cell-value" id="infoHariKerja">—</div>
                </div>
            </div>

            <!-- ══════ SUMMARY CARDS ══════ -->
            <div class="summary-grid" id="summaryGrid">
                <div class="stat-card">
                    <div class="stat-label">Total Laporan</div>
                    <div class="stat-value" id="statTotalLaporan">—</div>
                    <div class="stat-note">Laporan masuk bulan berjalan</div>
                </div>
                <div class="stat-card accent-blue">
                    <div class="stat-label">Skor (%) — Dasar Tunjangan</div>
                    <div class="stat-value" id="statSkor">—</div>
                    <div class="stat-note">Skala absolut 0–100%</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Status Hasil (Relatif)</div>
                    <div style="margin-top:2px;" id="statStatusWrap"><span class="status-pill sp-gray"
                            id="statStatus">—</span></div>
                    <div class="stat-note">Capaian relatif terhadap tanggung jawab</div>
                </div>
                <div class="stat-card accent-green">
                    <div class="stat-label">Estimasi Tunjangan (Rp)</div>
                    <div class="stat-value" id="statTunjangan" style="font-size:22px;">—</div>
                    <div class="stat-note">Berdasarkan skor absolut</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Maksimal Pencapaian (%)</div>
                    <div class="stat-value" id="statMaksimal">—</div>
                    <div class="stat-note">Total bobot item yang relevan (v)</div>
                </div>
            </div>

            <!-- ══════ TABEL TANGGUNG JAWAB LAPORAN ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="section-title-row">
                    <div class="section-title">Rincian Tanggung Jawab Laporan</div>
                    <span id="tableCount" class="stat-note" style="margin-top:0;">—</span>
                </div>
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th style="width:34px;">No</th>
                                <th>Kode</th>
                                <th>Tanggung Jawab Laporan</th>
                                <th class="center">Status</th>
                                <th class="num">Target/Bulan</th>
                                <th class="num">Aktual</th>
                                <th class="num">Bobot Item (%)</th>
                                <th style="width:160px;">Kontribusi (%)</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="8">
                                    <div class="skeleton-bar" style="width:100%;height:40px;"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="note-box">
                    Status "x" = item KPI tidak relevan dengan tanggung jawab HSE ini (lihat
                    Matriks_Tanggung_Jawab); ditampilkan "-" dan tidak mengurangi skor. Bobot item TIDAK
                    dipindahkan/direnormalisasi — semakin banyak item yang relevan ("v"), semakin tinggi batas
                    Maksimal Pencapaian-nya. SKOR (%) (dasar Tunjangan Rp) memakai skala 0-100% absolut, sehingga
                    HSE dengan tanggung jawab lebih besar punya peluang Tunjangan lebih besar. STATUS HASIL
                    dihitung dari Capaian Relatif (Skor Absolut / Maksimal Pencapaian) supaya HSE yang capai 100%
                    dari tanggung jawabnya sendiri tetap dinilai "SANGAT BAIK", walau Tunjangan Rp-nya berbeda dari
                    rekan yang tanggung jawabnya lebih banyak.
                </div>
            </div>

            <!-- ══════ CHART ══════ -->
            <div class="section-card">
                <div class="section-title-row">
                    <div class="section-title">Bobot Item vs Kontribusi per Item Laporan</div>
                </div>
                <div class="chart-wrap">
                    <canvas id="bobotKontribusiChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script>
        // ══════════════════════════════════════════════════════════════════
        // KONTRAK BACKEND (sesuaikan dengan route Laravel di aplikasi Anda)
        //
        // 1) DATA_ENDPOINT  GET  ?badge_hse=&bulan=&tahun=
        //    → { hse: { badge, nama, hari_kerja_efektif },
        //        summary: { total_laporan, skor_persen, status_hasil,
        //                   estimasi_tunjangan, maksimal_pencapaian },
        //        items: [ { no, kode, label, status: 'v'|'x', target,
        //                   aktual, bobot, kontribusi } , ... ],
        //        total: { target, aktual, bobot, kontribusi } }
        //
        // 2) LIST_HSE_ENDPOINT  GET
        //    → [ { badge: 'K.260061', nama: 'DWI ELLA MAGAREZA' }, ... ]
        //    Daftar ini diambil dari relasi Safety Officer:
        //      SafetyOfficerPegawai::query()
        //          ->distinct('badge_safety_officer')
        //          ->pluck('badge_safety_officer')
        //      lalu di-join ke Pegawai (badge) untuk ambil nama.
        // ══════════════════════════════════════════════════════════════════
        const DATA_ENDPOINT = "{{ route('dashboard-individu.data') }}";
        const LIST_HSE_ENDPOINT = "{{ route('dashboard-individu.list-hse') }}";

        const BULAN_LIST = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        const state = {
            badge_hse: '{{ $defaultBadgeHse ?? '' }}',
            bulan: new Date().getMonth() + 1,
            tahun: new Date().getFullYear(),
        };

        let chartInstance = null;

        function fmtNum(n, decimals = 0) {
            if (n === null || n === undefined || n === '') return '-';
            return Number(n).toLocaleString('id-ID', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            });
        }

        function fmtPercent(n, decimals = 2) {
            if (n === null || n === undefined || n === '') return '-';
            return fmtNum(n, decimals) + '%';
        }

        function fmtRupiah(n) {
            if (n === null || n === undefined || n === '') return '-';
            return 'Rp' + fmtNum(n, 0);
        }

        function statusPillClass(status) {
            const s = (status || '').toUpperCase();
            if (s.includes('SANGAT BAIK')) return 'sp-green';
            if (s === 'BAIK') return 'sp-blue';
            if (s.includes('CUKUP')) return 'sp-amber';
            if (s.includes('SANGAT KURANG')) return 'sp-red';
            if (s.includes('KURANG')) return 'sp-amber';
            return 'sp-gray';
        }

        function initYearOptions() {
            const select = document.getElementById('filterTahun');
            const current = new Date().getFullYear();
            select.innerHTML = '';
            for (let y = current + 1; y >= current - 3; y--) {
                const opt = document.createElement('option');
                opt.value = y;
                opt.textContent = y;
                if (y === state.tahun) opt.selected = true;
                select.appendChild(opt);
            }
        }

        function initMonthOptions() {
            const select = document.getElementById('filterBulan');
            select.innerHTML = '';
            BULAN_LIST.forEach((nama, idx) => {
                const opt = document.createElement('option');
                opt.value = idx + 1;
                opt.textContent = nama;
                if (idx + 1 === state.bulan) opt.selected = true;
                select.appendChild(opt);
            });
        }

        async function loadListHse() {
            const select = document.getElementById('filterHse');
            try {
                const res = await fetch(LIST_HSE_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal memuat daftar HSE');
                const list = await res.json();
                if (!list || list.length === 0) {
                    select.innerHTML = '<option value="">Belum ada Safety Officer terdaftar</option>';
                    return;
                }
                select.innerHTML = list.map(h =>
                    `<option value="${h.badge}">${escapeHtml(h.nama)}</option>`
                ).join('');
                if (!state.badge_hse) state.badge_hse = list[0].badge;
                select.value = state.badge_hse;
            } catch (e) {
                select.innerHTML = '<option value="">Gagal memuat daftar HSE</option>';
            }
        }

        function onFilterChange() {
            state.badge_hse = document.getElementById('filterHse').value;
            state.bulan = parseInt(document.getElementById('filterBulan').value, 10);
            state.tahun = parseInt(document.getElementById('filterTahun').value, 10);
            loadData();
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function renderInfo(hse, bulan, tahun) {
            document.getElementById('infoNamaHse').textContent = hse?.nama || '-';
            document.getElementById('infoBadgeHse').textContent = hse?.badge || '-';
            document.getElementById('infoBulan').textContent = BULAN_LIST[bulan - 1] || '-';
            document.getElementById('infoTahun').textContent = tahun || '-';
            document.getElementById('infoHariKerja').textContent = hse?.hari_kerja_efektif ?? '-';
        }

        function renderSummary(summary) {
            document.getElementById('statTotalLaporan').textContent =
                (summary?.total_laporan ?? '-') + (summary?.total_laporan !== undefined ? ' Laporan' : '');
            document.getElementById('statSkor').textContent = fmtPercent(summary?.skor_persen);
            document.getElementById('statTunjangan').textContent = fmtRupiah(summary?.estimasi_tunjangan);
            document.getElementById('statMaksimal').textContent = fmtPercent(summary?.maksimal_pencapaian);

            const pill = document.getElementById('statStatus');
            pill.textContent = summary?.status_hasil || '-';
            pill.className = 'status-pill ' + statusPillClass(summary?.status_hasil);
        }

        function renderTable(items, total) {
            const tbody = document.getElementById('tableBody');
            document.getElementById('tableCount').textContent = items?.length ?
                `${items.length} item tanggung jawab` : '';

            if (!items || items.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="8"><div class="empty-state"><div class="empty-state-title">Data tidak ditemukan</div><div class="empty-state-sub">Belum ada data KPI untuk filter yang dipilih.</div></div></td></tr>`;
                return;
            }

            tbody.innerHTML = items.map(item => {
                const isRelevant = item.status === 'v';
                const statusIcon = isRelevant ?
                    `<span class="status-icon on" title="Relevan">✓</span>` :
                    `<span class="status-icon off" title="Tidak relevan">–</span>`;

                const target = isRelevant ? fmtNum(item.target) : '<span class="cell-muted">-</span>';
                const aktual = isRelevant ? fmtNum(item.aktual) : '<span class="cell-muted">-</span>';
                const bobot = isRelevant ? fmtPercent(item.bobot) : '<span class="cell-muted">-</span>';

                let kontribusiCell = '<span class="cell-muted">-</span>';
                if (isRelevant) {
                    const kontribusi = Number(item.kontribusi || 0);
                    const bobotVal = Number(item.bobot || 0);
                    const pct = bobotVal > 0 ? Math.min(100, (kontribusi / bobotVal) * 100) : 0;
                    kontribusiCell = `
                        <div class="kontribusi-bar-wrap">
                            <div class="kontribusi-track"><div class="kontribusi-fill" style="width:${pct}%;"></div></div>
                            <span style="font-weight:700;font-size:11.5px;white-space:nowrap;">${kontribusi > 0 ? fmtPercent(kontribusi) : '-'}</span>
                        </div>`;
                }

                return `
                    <tr>
                        <td>${item.no}</td>
                        <td><span class="kode-chip">${escapeHtml(item.kode)}</span></td>
                        <td>${escapeHtml(item.label)}</td>
                        <td class="center">${statusIcon}</td>
                        <td class="num">${target}</td>
                        <td class="num">${aktual}</td>
                        <td class="num">${bobot}</td>
                        <td>${kontribusiCell}</td>
                    </tr>`;
            }).join('');

            if (total) {
                tbody.innerHTML += `
                    <tr class="row-total">
                        <td colspan="4">TOTAL</td>
                        <td class="num">${fmtNum(total.target)}</td>
                        <td class="num">${fmtNum(total.aktual)}</td>
                        <td class="num">${fmtPercent(total.bobot)}</td>
                        <td class="num">${fmtPercent(total.kontribusi)}</td>
                    </tr>`;
            }
        }

        function renderChart(items) {
            const relevant = (items || []).filter(i => i.status === 'v');
            const labels = relevant.map(i => i.kode);
            const bobotData = relevant.map(i => Number(i.bobot || 0));
            const kontribusiData = relevant.map(i => Number(i.kontribusi || 0));

            const ctx = document.getElementById('bobotKontribusiChart').getContext('2d');
            if (chartInstance) chartInstance.destroy();

            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                            label: 'Bobot Item (%)',
                            data: bobotData,
                            backgroundColor: '#D0021B',
                            borderRadius: 4,
                            maxBarThickness: 26,
                        },
                        {
                            label: 'Kontribusi (%)',
                            data: kontribusiData,
                            backgroundColor: '#1A7A3C',
                            borderRadius: 4,
                            maxBarThickness: 26,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 10,
                                font: {
                                    family: 'Plus Jakarta Sans',
                                    size: 11,
                                    weight: '600'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: (c) => `${c.dataset.label}: ${c.formattedValue}%`
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
                                    family: 'Plus Jakarta Sans',
                                    size: 10.5,
                                    weight: '700'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                callback: (v) => v + '%',
                                font: {
                                    family: 'Plus Jakarta Sans',
                                    size: 10.5
                                }
                            }
                        }
                    }
                }
            });
        }

        function showSkeleton() {
            document.getElementById('tableBody').innerHTML =
                `<tr><td colspan="8"><div class="skeleton-bar" style="width:100%;height:40px;"></div></td></tr>`;
        }

        function showError(message) {
            document.getElementById('tableBody').innerHTML =
                `<tr><td colspan="8"><div class="error-state"><div class="error-state-title">Gagal memuat data</div><div class="error-state-sub">${escapeHtml(message)}</div></div></td></tr>`;
        }

        async function loadData() {
            if (!state.badge_hse) return;
            showSkeleton();

            const params = new URLSearchParams({
                badge_hse: state.badge_hse,
                bulan: state.bulan,
                tahun: state.tahun,
            });

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error((await res.json().catch(() => null))?.message || `Status ${res.status}`);
                const json = await res.json();

                renderInfo(json.hse, state.bulan, state.tahun);
                renderSummary(json.summary);
                renderTable(json.items, json.total);
                renderChart(json.items);
            } catch (e) {
                showError(e.message || 'Terjadi kesalahan saat memuat data.');
            }
        }

        function toggleSidebar() {
            document.getElementById('sidebar')?.classList.toggle('open');
            document.getElementById('sidebar-overlay')?.classList.toggle('open');
        }

        document.addEventListener('DOMContentLoaded', async () => {
            initMonthOptions();
            initYearOptions();
            await loadListHse();
            loadData();
        });
    </script>
</body>

</html>
