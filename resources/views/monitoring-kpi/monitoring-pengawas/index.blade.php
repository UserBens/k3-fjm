<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Monitoring Laporan Perseorangan — Tim Pengawas</title>
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

        /* Letterhead style banner (mengacu pada layout laporan) */
        .report-banner {
            background: linear-gradient(135deg, var(--dark), #232742);
            border-radius: 12px;
            padding: 16px 20px;
            text-align: center;
            margin-bottom: 14px;
        }

        .report-banner-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.03em;
            color: #fff;
            line-height: 1.3;
        }

        .report-banner-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.55);
            font-weight: 600;
            margin-top: 2px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-size: 10px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        .filter-select {
            height: 40px;
            width: 100%;
            padding: 0 34px 0 14px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 12px center;
            font-size: 13px;
            font-weight: 700;
            color: #1A1D2E;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            transition: border 0.2s;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            outline: none;
        }

        .info-strip {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr;
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
            font-size: 22px;
            letter-spacing: 0.01em;
            color: #1A1D2E;
            line-height: 1.15;
        }

        .info-cell.accent-blue .info-cell-value {
            color: #2D4B9E;
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

        .stat-note {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
        }

        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 720px;
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

        .rtable th.center,
        .rtable td.center {
            text-align: center;
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

        .kode-chip {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 6px;
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
            font-size: 10.5px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 10.5px;
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

        .sp-gray {
            background: rgba(100, 116, 139, 0.09);
            color: #64748B;
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

        @media (max-width: 780px) {
            .filter-grid {
                grid-template-columns: 1fr;
            }

            .info-strip {
                grid-template-columns: 1fr 1fr;
            }

            .info-cell:nth-child(2) {
                border-right: none;
            }

            .info-cell:last-child {
                grid-column: span 2;
                border-top: 1px solid rgba(0, 0, 0, 0.06);
            }
        }

        @media (max-width: 640px) {
            #page-content {
                padding: 14px 14px 22px;
            }

            .pg-title {
                font-size: 24px;
            }

            .report-banner-title {
                font-size: 16px;
            }

            .info-strip {
                grid-template-columns: 1fr;
            }

            .info-cell {
                border-right: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            }

            .info-cell:last-child {
                grid-column: span 1;
                border-top: none;
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
                            <span class="pg-eyebrow">Monitoring Laporan · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">MONITORING <span>PENGAWAS</span></div>
                        <div class="pg-sub">Rekap laporan KPI yang ditemukan per Pengawas, berdasarkan jenis
                            laporan dan periode.</div>
                    </div>
                </div>
            </div>

            <!-- ══════ LETTERHEAD ══════ -->
            <div class="report-banner">
                <div class="report-banner-title">MONITORING LAPORAN PERSEORANGAN — TIM PENGAWAS</div>
                <div class="report-banner-sub">PT. Fokus Jasa Mitra</div>
            </div>

            <!-- ══════ FILTER: NAMA & JENIS LAPORAN ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label class="filter-label">Pilih Nama Pengawas</label>
                        <select id="filterPengawas" class="filter-select" onchange="onFilterChange()">
                            <option value="">Memuat daftar pengawas...</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Jenis Laporan</label>
                        <select id="filterJenisLaporan" class="filter-select" onchange="onFilterChange()">
                            <option value="">Semua Jenis</option>
                            <option value="[C.1] Laporan Inspeksi Peralatan">[C.1] Laporan Inspeksi Peralatan</option>
                            <option value="[C.2] Laporan Temuan UA/UC">[C.2] Laporan Temuan UA/UC</option>
                            <option value="[C.4] Laporan OBSERI">[C.4] Laporan OBSERI</option>
                            <option value="[C.5] Laporan Safety Permit">[C.5] Laporan Safety Permit</option>
                            <option value="[D.1] Laporan Nearmiss">[D.1] Laporan Nearmiss</option>
                            <option value="[D.2] Pelaporan Safety Briefing">[D.2] Pelaporan Safety Briefing</option>
                            <option value="[D.3] Laporan Reward/Punishment">[D.3] Laporan Reward/Punishment</option>
                            <option value="[D.4] Laporan Sosialisasi Keselamatan Kerja">[D.4] Laporan Sosialisasi
                                Keselamatan Kerja</option>
                            <option value="[E.1] Laporan DCU">[E.1] Laporan DCU</option>
                            <option value="[E.2] Laporan Bugar Sehat">[E.2] Laporan Bugar Sehat</option>
                            <option value="[E.4] Laporan Evaluasi Fatigue">[E.4] Laporan Evaluasi Fatigue</option>
                            <option value="[E.5] Laporan Sosialisasi Kesehatan Kerja">[E.5] Laporan Sosialisasi
                                Kesehatan Kerja</option>
                            <option value="[E.6] Laporan Inspeksi Kotak P3K">[E.6] Laporan Inspeksi Kotak P3K
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- ══════ FILTER PERIODE + TOTAL DITEMUKAN ══════ -->
            <div class="section-card info-strip">
                <div class="info-cell">
                    <div class="info-cell-label">Tahun</div>
                    <select id="filterTahun" class="filter-select"
                        style="height:34px;font-size:14px;padding:0 28px 0 0;background-position:right 2px center;border:none;"
                        onchange="onFilterChange()"></select>
                </div>
                <div class="info-cell">
                    <div class="info-cell-label">Bulan</div>
                    <select id="filterBulan" class="filter-select"
                        style="height:34px;font-size:14px;padding:0 28px 0 0;background-position:right 2px center;border:none;"
                        onchange="onFilterChange()"></select>
                </div>
                <div class="info-cell accent-blue">
                    <div class="info-cell-label">Total Laporan Ditemukan</div>
                    <div class="info-cell-value" id="statTotalDitemukan">—</div>
                </div>
            </div>

            <!-- ══════ TABEL LAPORAN ══════ -->
            <div class="section-card" style="margin-top:14px;">
                <div class="section-title-row">
                    <div class="section-title">Daftar Laporan Ditemukan</div>
                    <span id="tableCount" class="stat-note">—</span>
                </div>
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th style="width:34px;">No</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Kode KPI</th>
                                <th>Jenis Aktifitas KPI</th>
                                <th class="center">Status Keputusan</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="5">
                                    <div class="skeleton-bar" style="width:100%;height:40px;"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        // ══════════════════════════════════════════════════════════════════
        // KONTRAK BACKEND (sesuaikan dengan route Laravel di aplikasi Anda)
        //
        // 1) LIST_PENGAWAS_ENDPOINT  GET
        //    → [ { id_api: '123', label: 'K.201340-H. SUNANDAR' }, ... ]
        //    Diambil dari PengawasIntraUser (id_api, username sebagai badge,
        //    nama_lengkap), contoh query di controller:
        //      PengawasIntraUser::query()
        //          ->where('is_active', true)
        //          ->orderBy('nama_lengkap')
        //          ->get(['id_api', 'username', 'nama_lengkap'])
        //          ->map(fn ($p) => [
        //              'id_api' => $p->id_api,
        //              'label'  => strtoupper($p->username . '-' . $p->nama_lengkap),
        //          ]);
        //
        // 2) DATA_ENDPOINT  GET  ?pengawas_id=&jenis_laporan=&tahun=&bulan=
        //    → { total_ditemukan: 1,
        //        items: [ { no, tanggal_pelaksanaan, kode_kpi,
        //                   jenis_aktifitas_kpi, status_keputusan } , ... ] }
        //    pengawas_id = id_api dari pengawas_intra_users (pengguna_id pada
        //    pengawas_pekerjaans), dipakai untuk menelusuri seluruh tenaga
        //    binaan pengawas tsb lalu mengumpulkan laporan KPI mereka.
        // ══════════════════════════════════════════════════════════════════
        const LIST_PENGAWAS_ENDPOINT = "{{ route('monitoring-pengawas.list-pengawas') }}";
        const DATA_ENDPOINT = "{{ route('monitoring-pengawas.data') }}";

        const BULAN_LIST = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        const state = {
            pengawas_id: '{{ $defaultPengawasId ?? '' }}',
            jenis_laporan: '',
            tahun: new Date().getFullYear(),
            bulan: new Date().getMonth() + 1,
        };

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function fmtDate(d) {
            if (!d) return '-';
            const dt = new Date(d);
            return isNaN(dt.getTime()) ? d : dt.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function statusPillClass(status) {
            const s = (status || '').toUpperCase();
            if (s === 'APPROVE') return 'sp-green';
            if (s === 'REJECT') return 'sp-red';
            if (s === 'PENDING') return 'sp-amber';
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

        async function loadListPengawas() {
            const select = document.getElementById('filterPengawas');
            try {
                const res = await fetch(LIST_PENGAWAS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal memuat daftar pengawas');
                const list = await res.json();
                if (!list || list.length === 0) {
                    select.innerHTML = '<option value="">Belum ada pengawas terdaftar</option>';
                    return;
                }
                select.innerHTML = list.map(p =>
                    `<option value="${p.id_api}">${escapeHtml(p.label)}</option>`
                ).join('');
                if (!state.pengawas_id) state.pengawas_id = list[0].id_api;
                select.value = state.pengawas_id;
            } catch (e) {
                select.innerHTML = '<option value="">Gagal memuat daftar pengawas</option>';
            }
        }

        function onFilterChange() {
            state.pengawas_id = document.getElementById('filterPengawas').value;
            state.jenis_laporan = document.getElementById('filterJenisLaporan').value;
            state.tahun = parseInt(document.getElementById('filterTahun').value, 10);
            state.bulan = parseInt(document.getElementById('filterBulan').value, 10);
            loadData();
        }

        function showSkeleton() {
            document.getElementById('tableBody').innerHTML =
                `<tr><td colspan="5"><div class="skeleton-bar" style="width:100%;height:40px;"></div></td></tr>`;
        }

        function showError(message) {
            document.getElementById('tableBody').innerHTML =
                `<tr><td colspan="5"><div class="error-state"><div class="error-state-title">Gagal memuat data</div><div class="error-state-sub">${escapeHtml(message)}</div></div></td></tr>`;
        }

        function renderTable(items) {
            const tbody = document.getElementById('tableBody');
            document.getElementById('tableCount').textContent = items?.length ?
                `${items.length} laporan` : '';

            if (!items || items.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="5"><div class="empty-state"><div class="empty-state-title">Data tidak ditemukan</div><div class="empty-state-sub">Belum ada laporan untuk filter yang dipilih.</div></div></td></tr>`;
                return;
            }

            tbody.innerHTML = items.map(item => `
                <tr>
                    <td>${item.no}</td>
                    <td>${fmtDate(item.tanggal_pelaksanaan)}</td>
                    <td><span class="kode-chip">${escapeHtml(item.kode_kpi)}</span></td>
                    <td>${escapeHtml(item.jenis_aktifitas_kpi)}</td>
                    <td class="center"><span class="status-pill ${statusPillClass(item.status_keputusan)}">${escapeHtml(item.status_keputusan)}</span></td>
                </tr>
            `).join('');
        }

        async function loadData() {
            if (!state.pengawas_id) return;
            showSkeleton();

            const params = new URLSearchParams();
            params.set('pengawas_id', state.pengawas_id);
            if (state.jenis_laporan) params.set('jenis_laporan', state.jenis_laporan);
            params.set('tahun', state.tahun);
            params.set('bulan', state.bulan);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error((await res.json().catch(() => null))?.message || `Status ${res.status}`);
                const json = await res.json();

                document.getElementById('statTotalDitemukan').textContent = json.total_ditemukan ?? 0;
                renderTable(json.items);
            } catch (e) {
                document.getElementById('statTotalDitemukan').textContent = '-';
                showError(e.message || 'Terjadi kesalahan saat memuat data.');
            }
        }

        function toggleSidebar() {
            document.getElementById('sidebar')?.classList.toggle('open');
            document.getElementById('sidebar-overlay')?.classList.toggle('open');
        }

        document.addEventListener('DOMContentLoaded', async () => {
            initYearOptions();
            initMonthOptions();
            await loadListPengawas();
            loadData();
        });
    </script>
</body>

</html>
