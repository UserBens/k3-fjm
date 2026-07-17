<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Dashboard Leading Indicator — PT. Fokus Jasa Mitra</title>
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

        /* HEADER BAND */
        .ld-header {
            background: #1A1D2E;
            border-radius: 12px;
            padding: 14px 20px;
            text-align: center;
            color: #fff;
            margin-bottom: 14px;
        }

        .ld-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.04em;
        }

        .ld-header .sub1 {
            font-size: 11px;
            color: #B9C2E8;
            margin-top: 4px;
        }

        .ld-header .sub2 {
            font-size: 10.5px;
            color: #8792C4;
            margin-top: 2px;
        }

        /* FILTER + CARDS ROW */
        .filter-cards-row {
            display: grid;
            grid-template-columns: 170px repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 14px;
        }

        .filter-box {
            background: #FDF7DC;
            border: 1px solid #E9D98A;
            border-radius: 10px;
            padding: 8px 12px;
        }

        .filter-box label {
            font-size: 9.5px;
            font-weight: 800;
            color: #92750F;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 3px;
        }

        .filter-box select {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 16px;
            font-weight: 800;
            color: #1A1D2E;
            outline: none;
            cursor: pointer;
        }

        .kpi-box {
            border-radius: 10px;
            padding: 14px 12px 10px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .kpi-box .val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 34px;
            line-height: 1;
        }

        .kpi-box .lbl {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.04em;
            margin-top: 6px;
            opacity: 0.9;
        }

        .kpi-box .lbl2 {
            font-size: 9px;
            opacity: 0.75;
            margin-top: 1px;
        }

        .kpi-total {
            background: #1A1D2E;
        }

        .kpi-tercapai {
            background: #1A7A3C;
        }

        .kpi-sebagian {
            background: #D97706;
        }

        .kpi-dibawah {
            background: #D0021B;
        }

        .kpi-skor {
            background: #C2560F;
        }

        /* SECTION */
        .section-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 16px;
            min-width: 0;
            margin-bottom: 14px;
        }

        .sc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
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

        /* MAIN TABLE */
        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 1400px;
            border-collapse: collapse;
        }

        .rtable thead th {
            font-size: 9px;
            font-weight: 800;
            color: #fff;
            background: #1A1D2E;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 8px 6px;
            text-align: center;
            white-space: nowrap;
            position: sticky;
            top: 0;
        }

        .rtable thead th.txt-left {
            text-align: left;
        }

        .rtable td {
            font-size: 11.5px;
            color: #1A1D2E;
            padding: 6px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
            white-space: nowrap;
        }

        .rtable td.txt-left {
            text-align: left;
        }

        .rtable tr:hover td {
            background: #F8F9FF;
        }

        .rtable td.col-target {
            font-weight: 800;
            background: rgba(208, 2, 27, 0.06);
            color: #D0021B;
        }

        .rtable td.col-ytd {
            font-weight: 800;
        }

        .kategori-heading td {
            background: #E7EBFA;
            font-weight: 800;
            text-align: left;
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

        .sp-gray {
            background: rgba(100, 116, 139, 0.09);
            color: #64748B;
        }

        /* GRID LAYOUTS FOR SUMMARY SECTIONS */
        .summary-grid-3 {
            display: grid;
            grid-template-columns: 1.1fr 1fr 0.8fr;
            gap: 12px;
            margin-bottom: 14px;
        }

        .summary-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px;
        }

        .mini-table {
            width: 100%;
            border-collapse: collapse;
        }

        .mini-table th {
            font-size: 9.5px;
            font-weight: 800;
            color: #2D4B9E;
            background: #EEF1FC;
            text-align: left;
            padding: 6px 8px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .mini-table td {
            font-size: 11.5px;
            padding: 6px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .mini-table td.num {
            text-align: right;
            font-weight: 700;
        }

        .mini-table tr:hover td {
            background: #F8F9FF;
        }

        .donut-canvas-wrap {
            width: 110px;
            height: 110px;
            position: relative;
            margin: 0 auto;
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
            font-size: 22px;
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
            font-size: 11px;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-label {
            color: #64748B;
            font-weight: 500;
        }

        .legend-pct {
            margin-left: auto;
            font-weight: 700;
            color: #1A1D2E;
        }

        .section-band {
            background: #1A1D2E;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 8px 14px;
            border-radius: 8px;
            margin: 6px 0 14px;
        }

        .loading-row td {
            text-align: center;
            padding: 24px;
            color: #94A3B8;
            font-size: 12px;
        }

        @media (max-width: 1200px) {
            .filter-cards-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .summary-grid-3 {
                grid-template-columns: 1fr;
            }

            .summary-grid-2 {
                grid-template-columns: 1fr;
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

            <!-- HEADER -->
            <div class="ld-header">
                <h1>DASHBOARD LEADING INDICATOR — PROGRAM &amp; KEGIATAN PROAKTIF K3</h1>
                <div class="sub1">PT. Fokus Jasa Mitra &nbsp;·&nbsp; Departemen K3 &amp; Operasional &nbsp;·&nbsp;
                    Sistem Informasi HSE</div>
                <div class="sub2" id="dataInfoLine">Data s/d bln: — &nbsp;·&nbsp; Banding otomatis: Th —</div>
            </div>

            <!-- FILTER + KPI CARDS -->
            <div class="filter-cards-row">
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <div class="filter-box">
                        <label>📅 Tahun</label>
                        <select id="filterTahun"></select>
                    </div>
                    <div class="filter-box">
                        <label>🗓 Bulan s/d</label>
                        <select id="filterBulan">
                            <option value="otomatis">Otomatis</option>
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">Mei</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Ags</option>
                            <option value="9">Sep</option>
                            <option value="10">Okt</option>
                            <option value="11">Nov</option>
                            <option value="12">Des</option>
                        </select>
                    </div>
                </div>
                <div class="kpi-box kpi-total">
                    <div class="val" id="kpiTotal">0</div>
                    <div class="lbl">TOTAL PROGRAM</div>
                    <div class="lbl2">Program dipantau</div>
                </div>
                <div class="kpi-box kpi-tercapai">
                    <div class="val" id="kpiTercapai">0</div>
                    <div class="lbl">TERCAPAI</div>
                    <div class="lbl2">≥ 100% target</div>
                </div>
                <div class="kpi-box kpi-sebagian">
                    <div class="val" id="kpiSebagian">0</div>
                    <div class="lbl">SEBAGIAN</div>
                    <div class="lbl2">70–99% target</div>
                </div>
                <div class="kpi-box kpi-dibawah">
                    <div class="val" id="kpiDibawah">0</div>
                    <div class="lbl">DI BAWAH TARGET</div>
                    <div class="lbl2">&lt; 70% target</div>
                </div>
                <div class="kpi-box kpi-skor">
                    <div class="val" id="kpiSkor">0%</div>
                    <div class="lbl">SKOR KINERJA</div>
                    <div class="lbl2">Rata-rata pencapaian</div>
                </div>
            </div>

            <!-- TABEL RINCIAN -->
            <div class="section-card">
                <div class="sc-header">
                    <div>
                        <div class="sc-title" id="tblTitle">Rincian Program &amp; Kegiatan — Realisasi vs Target</div>
                        <div class="sc-sub">Data mentah per bulan, Realisasi/Target YTD &amp; status dihitung otomatis
                        </div>
                    </div>
                </div>
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="txt-left">Kategori</th>
                                <th class="txt-left">Nama Kegiatan</th>
                                <th>Satuan</th>
                                <th>Target</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>Mei</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Ags</th>
                                <th>Sep</th>
                                <th>Okt</th>
                                <th>Nov</th>
                                <th>Des</th>
                                <th>Realisasi YTD</th>
                                <th>Target YTD</th>
                                <th>% Capai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="mainTableBody">
                            <tr class="loading-row">
                                <td colspan="21">Memuat data…</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- RINGKASAN PER KATEGORI + STATUS + PERBANDINGAN TAHUN -->
            <div class="summary-grid-3">
                <div class="section-card" style="margin-bottom:0;">
                    <div class="sc-header">
                        <div>
                            <div class="sc-title">Ringkasan per Kategori</div>
                            <div class="sc-sub">Jumlah program &amp; capaian YTD</div>
                        </div>
                    </div>
                    <table class="mini-table" id="kategoriSummaryTable">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th style="text-align:right;">Jumlah</th>
                                <th style="text-align:right;">Target YTD</th>
                                <th style="text-align:right;">Realisasi YTD</th>
                                <th style="text-align:right;">% Capai</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div style="height:200px;margin-top:14px;"><canvas id="kategoriBarChart"></canvas></div>
                </div>

                <div class="section-card" style="margin-bottom:0;">
                    <div class="sc-header">
                        <div>
                            <div class="sc-title">Distribusi Status Program</div>
                            <div class="sc-sub">Sebaran status seluruh program</div>
                        </div>
                    </div>
                    <table class="mini-table" id="statusTable">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th style="text-align:right;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="donut-canvas-wrap" style="margin-top:14px;">
                        <canvas id="statusDonutChart"></canvas>
                        <div class="donut-center">
                            <div class="donut-center-val" id="donutTotal">0</div>
                            <div class="donut-center-lbl">Program</div>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="margin-bottom:0;">
                    <div class="sc-header">
                        <div>
                            <div class="sc-title">Perbandingan Tahun</div>
                            <div class="sc-sub" id="perbandinganSub">% Capai per kategori vs tahun lalu</div>
                        </div>
                    </div>
                    <table class="mini-table" id="perbandinganTable">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th style="text-align:right;">Th Ini</th>
                                <th style="text-align:right;">Th Lalu</th>
                                <th style="text-align:right;">Selisih</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div class="section-card">
                <div class="sc-header">
                    <div>
                        <div class="sc-title">% Pencapaian per Kategori — Perbandingan Tahun</div>
                    </div>
                </div>
                <div style="height:230px;"><canvas id="perbandinganBarChart"></canvas></div>
            </div>

            <!-- MONITORING BULANAN -->
            <div class="section-band" id="monitoringBand">MONITORING BULANAN</div>

            <div class="summary-grid-2">
                <div class="section-card" style="margin-bottom:0;">
                    <div class="sc-header">
                        <div>
                            <div class="sc-title">Capaian per Program (bulan terpilih)</div>
                            <div class="sc-sub" id="capaianBulanSub">% capai, maks 100%</div>
                        </div>
                    </div>
                    <div id="capaianProgramChartWrap" style="position:relative;"><canvas
                            id="capaianProgramChart"></canvas></div>
                </div>
                <div class="section-card" style="margin-bottom:0;">
                    <div class="sc-header">
                        <div>
                            <div class="sc-title">Program Tercapai / Bulan</div>
                            <div class="sc-sub">Jumlah program ≥100% target per bulan</div>
                        </div>
                    </div>
                    <div style="height:340px;"><canvas id="tercapaiPerBulanChart"></canvas></div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const fjmBlue = '#2D4B9E',
            fjmRed = '#D0021B',
            fjmGreen = '#1A7A3C',
            fjmAmber = '#D97706',
            fjmDark = '#1A1D2E';
        const BULAN_LABEL = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        let kategoriBarChart, statusDonutChart, perbandinganBarChart, capaianProgramChart, tercapaiPerBulanChart;

        function fmtNum(v) {
            if (v === null || v === undefined) return '—';
            return Number(v).toLocaleString('id-ID', {
                maximumFractionDigits: 2
            });
        }

        function statusPill(status) {
            if (!status) return '<span class="status-pill sp-gray">—</span>';
            return `<span class="status-pill ${status.class}">${status.icon} ${status.label}</span>`;
        }

        async function loadDashboard() {
            const tahun = document.getElementById('filterTahun').value;
            const bulan = document.getElementById('filterBulan').value;

            const params = new URLSearchParams();
            if (tahun) params.set('tahun', tahun);
            params.set('bulan', bulan);

            const res = await fetch(`{{ route('leading-dashboard.api') }}?${params.toString()}`);
            const json = await res.json();
            render(json);
        }

        function populateTahunFilter(tahunOptions, selected) {
            const sel = document.getElementById('filterTahun');
            if (sel.options.length === 0) {
                sel.innerHTML = tahunOptions.map(t => `<option value="${t}">${t}</option>`).join('');
            }
            sel.value = selected;
        }

        function render(data) {
            const f = data.filters;
            populateTahunFilter(f.tahun_options, f.tahun);
            document.getElementById('filterBulan').value = f.bulan_sd_otomatis ? 'otomatis' : String(f.bulan_sd);

            document.getElementById('dataInfoLine').textContent =
                `Data s/d bln: ${BULAN_LABEL[f.bulan_sd]} · Banding otomatis: Th ${f.tahun_pembanding}`;
            document.getElementById('tblTitle').textContent =
                `Rincian Program & Kegiatan — Realisasi vs Target (Tahun ${f.tahun}, s/d bln ${f.bulan_sd})`;
            document.getElementById('perbandinganSub').textContent = `% Capai per kategori vs Tahun ${f.tahun_pembanding}`;
            document.getElementById('capaianBulanSub').textContent =
                `Bulan ${BULAN_LABEL[f.bulan_sd]} ${f.tahun} — % capai, maks 100%`;
            document.getElementById('monitoringBand').textContent =
                `MONITORING BULANAN — ${BULAN_LABEL[f.bulan_sd]} ${f.tahun}`;

            // KPI
            document.getElementById('kpiTotal').textContent = data.cards.total_program;
            document.getElementById('kpiTercapai').textContent = data.cards.tercapai;
            document.getElementById('kpiSebagian').textContent = data.cards.sebagian;
            document.getElementById('kpiDibawah').textContent = data.cards.di_bawah;
            document.getElementById('kpiSkor').textContent = data.cards.skor_kinerja + '%';

            renderMainTable(data.rows);
            renderKategoriSummary(data.kategori_summary);
            renderStatusDistribusi(data.status_distribusi);
            renderPerbandinganTahun(data.perbandingan_tahun);
            renderCapaianPerProgram(data.capaian_per_program_bulan_ini);
            renderTercapaiPerBulan(data.program_tercapai_per_bulan);
        }

        function renderMainTable(rows) {
            const tbody = document.getElementById('mainTableBody');
            if (!rows.length) {
                tbody.innerHTML = '<tr class="loading-row"><td colspan="21">Tidak ada data untuk filter ini.</td></tr>';
                return;
            }
            let html = '';
            let currentKategori = null;
            rows.forEach(r => {
                if (r.kategori !== currentKategori) {
                    currentKategori = r.kategori;
                    html += `<tr class="kategori-heading"><td colspan="21">${currentKategori}</td></tr>`;
                }
                const bulanCells = Object.values(r.monthly).map(v => `<td>${v === null ? '' : fmtNum(v)}</td>`)
                    .join('');
                html += `
                    <tr>
                        <td>${r.no_urut}</td>
                        <td class="txt-left">${r.kategori}</td>
                        <td class="txt-left">${r.nama_kegiatan}</td>
                        <td>${r.satuan ?? ''}</td>
                        <td class="col-target">${fmtNum(r.target)}</td>
                        ${bulanCells}
                        <td class="col-ytd">${fmtNum(r.realisasi_ytd)}</td>
                        <td>${fmtNum(r.target_ytd)}</td>
                        <td><strong>${r.persen_capai === null ? '—' : r.persen_capai + '%'}</strong></td>
                        <td>${statusPill(r.status)}</td>
                    </tr>`;
            });
            tbody.innerHTML = html;
        }

        function renderKategoriSummary(list) {
            const tbody = document.querySelector('#kategoriSummaryTable tbody');
            tbody.innerHTML = list.map(k => `
                <tr>
                    <td>${k.kategori}</td>
                    <td class="num">${k.jumlah_program}</td>
                    <td class="num">${fmtNum(k.target_ytd)}</td>
                    <td class="num">${fmtNum(k.realisasi_ytd)}</td>
                    <td class="num">${k.persen}%</td>
                </tr>`).join('');

            const ctx = document.getElementById('kategoriBarChart');
            if (kategoriBarChart) kategoriBarChart.destroy();
            kategoriBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: list.map(k => k.kategori),
                    datasets: [{
                        label: '% Pencapaian',
                        data: list.map(k => k.persen),
                        backgroundColor: fjmAmber,
                        borderRadius: 6,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 120,
                            ticks: {
                                color: '#94A3B8'
                            }
                        },
                        y: {
                            ticks: {
                                color: '#64748B',
                                font: {
                                    size: 10.5
                                }
                            }
                        }
                    }
                }
            });
        }

        function renderStatusDistribusi(list) {
            const tbody = document.querySelector('#statusTable tbody');
            tbody.innerHTML = list.map(s => `<tr><td>${s.label}</td><td class="num">${s.jumlah}</td></tr>`).join('');
            const total = list.reduce((a, s) => a + s.jumlah, 0);
            document.getElementById('donutTotal').textContent = total;

            const ctx = document.getElementById('statusDonutChart');
            if (statusDonutChart) statusDonutChart.destroy();
            statusDonutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: list.map(s => s.label),
                    datasets: [{
                        data: list.map(s => s.jumlah),
                        backgroundColor: [fjmGreen, fjmAmber, fjmRed],
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
                        }
                    }
                }
            });
        }

        function renderPerbandinganTahun(list) {
            const tbody = document.querySelector('#perbandinganTable tbody');
            tbody.innerHTML = list.map(p => `
                <tr>
                    <td>${p.kategori}</td>
                    <td class="num">${p.th_sekarang}%</td>
                    <td class="num">${p.th_pembanding === null ? '—' : p.th_pembanding + '%'}</td>
                    <td class="num" style="color:${p.selisih === null ? '#94A3B8' : (p.selisih >= 0 ? '#1A7A3C' : '#D0021B')}">
                        ${p.selisih === null ? '—' : (p.selisih >= 0 ? '+' : '') + p.selisih + '%'}
                    </td>
                </tr>`).join('');

            const ctx = document.getElementById('perbandinganBarChart');
            if (perbandinganBarChart) perbandinganBarChart.destroy();
            perbandinganBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: list.map(p => p.kategori),
                    datasets: [{
                        label: 'Tahun Ini',
                        data: list.map(p => p.th_sekarang),
                        backgroundColor: fjmDark,
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 8,
                                boxHeight: 8,
                                font: {
                                    size: 11
                                },
                                color: '#64748B'
                            }
                        },
                        datalabels: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 120,
                            ticks: {
                                color: '#94A3B8'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#64748B',
                                font: {
                                    size: 10.5
                                }
                            }
                        }
                    }
                }
            });
        }

        function renderCapaianPerProgram(list) {
            const wrap = document.getElementById('capaianProgramChartWrap');
            wrap.style.height = Math.max(260, list.length * 24) + 'px';
            const ctx = document.getElementById('capaianProgramChart');
            if (capaianProgramChart) capaianProgramChart.destroy();
            capaianProgramChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: list.map(p => p.nama_kegiatan),
                    datasets: [{
                        data: list.map(p => p.persen),
                        backgroundColor: fjmBlue,
                        borderRadius: 4,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 120,
                            ticks: {
                                color: '#94A3B8'
                            }
                        },
                        y: {
                            ticks: {
                                color: '#64748B',
                                font: {
                                    size: 10
                                }
                            }
                        }
                    }
                }
            });
        }

        function renderTercapaiPerBulan(list) {
            const ctx = document.getElementById('tercapaiPerBulanChart');
            if (tercapaiPerBulanChart) tercapaiPerBulanChart.destroy();
            tercapaiPerBulanChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: BULAN_LABEL.slice(1),
                    datasets: [{
                        label: 'Program Tercapai',
                        data: list,
                        borderColor: fjmAmber,
                        backgroundColor: 'rgba(217,119,6,0.10)',
                        fill: true,
                        tension: 0.35,
                        pointRadius: 3,
                        pointBackgroundColor: fjmAmber
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
                                stepSize: 1,
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

        document.getElementById('filterTahun').addEventListener('change', loadDashboard);
        document.getElementById('filterBulan').addEventListener('change', loadDashboard);

        loadDashboard();
    </script>
</body>

</html>
