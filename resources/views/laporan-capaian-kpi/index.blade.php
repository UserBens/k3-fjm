<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Laporan Capaian KPI K3 — PT. Fokus Jasa Mitra</title>
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
            grid-template-columns: repeat(6, 1fr);
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
            background: #F8F9FF;
            outline: none;
        }

        .saklar-field select:focus,
        .saklar-field input:focus {
            border-color: var(--blue);
            background: #fff;
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

        /* TAB TIM (khusus laporan capaian: pilih tim sebelum lihat rincian B & C) */
        .tim-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 14px;
        }

        .tim-tab {
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 800;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #F8F9FF;
            color: #64748B;
        }

        .tim-tab.active {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .subsection-title {
            font-size: 11px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .rtable-wrap {
            overflow-x: auto;
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

        .rtable tfoot td {
            font-weight: 800;
            background: #F8F9FF;
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
        }

        @media (max-width: 640px) {
            .saklar-grid {
                grid-template-columns: repeat(2, 1fr);
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

        .rtable tr.grp-header td {
            background: #EEF2FF;
            font-weight: 800;
            color: #2D4B9E;
            font-size: 11.5px;
            letter-spacing: .3px;
            text-transform: uppercase;
        }

        .rtable tr.grp-subtotal td {
            background: #F8FAFC;
            font-weight: 800;
            border-top: 1.5px solid #CBD5E1;
        }

        .rtable tr.grand-total td {
            background: #1A1D2E;
            color: #fff;
            font-weight: 800;
        }

        .rtable tr.total-a td {
            background: #F1F5F9;
            font-weight: 800;
            border-top: 2px solid #94A3B8;
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
            display: inline-flex;
            /* Mengubah tombol menjadi container flex */
            align-items: center;
            /* Menyejajarkan ikon dan teks tepat di tengah secara vertikal */
            justify-content: center;
            /* Mengatur posisi konten di tengah secara horizontal */
            gap: 8px;
            /* Memberikan jarak yang rapi antara ikon dan teks */
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
                            <span class="pg-eyebrow">Laporan Capaian KPI K3 · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">lAPORAN CAPAIAN KPI <span>K3</span></div>
                        <div class="pg-sub">Keselamatan &amp; Kesehatan Kerja — Departemen K3 &amp; Operasional.</div>
                    </div>
                    {{-- <div class="pg-actions" style="display:flex; gap:8px;">
                        <button class="btn-outline" onclick="exportExcel()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                            </svg>
                            Export Data
                        </button>
                    </div> --}}
                </div>
            </div>

            <!-- PANEL SAKLAR -->
            <div class="panel-saklar">
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

                    <!-- Kolom Aksi (Terapkan & Export Data) digabung menggunakan Flexbox -->
                    <div class="saklar-field flex items-end" style="display:flex; gap:8px;">
                        <button id="btnTerapkan" type="button"
                            style="width:100%;height:34px;background:var(--blue);color:#fff;border:none;border-radius:8px;font-size:11.5px;font-weight:800;cursor:pointer;">
                            Filter
                        </button>

                        <!-- Tombol Export Data -->
                        <div class="pg-actions" style="display:flex;">
                            <button class="btn-outline" onclick="exportExcel()"
                                style="height:34px; display:flex; align-items:center; gap:6px; padding:0 12px; border-radius:8px; border:1px solid #ccc; background:#fff; cursor:pointer; white-space:nowrap; font-size:11.5px; font-weight:600;">
                                <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                                </svg>
                                Export Data
                            </button>
                        </div>
                    </div>

                </div>
                <div class="periode-aktif-line" id="periodeAktifLine">Memuat periode aktif…</div>
            </div>

            <!-- A. RINGKASAN CAPAIAN KPI PER TIM -->
            <div>
                <span class="section-label sl-blue">A · Ringkasan Capaian KPI per Tim</span>
                <div class="card-block">
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Tim</th>
                                    <th>Target Laporan</th>
                                    <th>Laporan Disetujui</th>
                                    <th>Pencapaian (%)</th>
                                    <th>Ketepatan Target</th>
                                    <th>Ketepatan Realisasi</th>
                                    <th>Nilai KPI Final (%)</th>
                                    <th>Tunjangan Tim (Rp)</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody id="ringkasanBody">
                                <tr>
                                    <td colspan="9" class="loading-state">Memuat ringkasan…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- B & C. RINCIAN PER TIM -->
            <!-- B. RINCIAN CAPAIAN PER AKTIVITAS KPI (seluruh tim) -->
            <div>
                <span class="section-label sl-green">B · Rincian Capaian per Aktivitas KPI (hanya program aktif —
                    seluruh tim)</span>
                <div class="card-block">
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>Tim</th>
                                    <th>Kode</th>
                                    <th>Nama Aktivitas</th>
                                    <th>Bobot (%)</th>
                                    <th>Target Periode</th>
                                    <th>Disetujui</th>
                                    <th>Aktual Pencapaian (%)</th>
                                </tr>
                            </thead>
                            <tbody id="aktivitasBody">
                                <tr>
                                    <td colspan="7" class="loading-state">Memuat rincian aktivitas…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- C. LAPORAN PER PETUGAS & JENIS (dikelompokkan per tim) -->
            <div>
                <span class="section-label sl-gold">C · Laporan per Petugas &amp; Jenis (hanya aktif · termasuk
                    tunjangan)</span>
                <div class="card-block">
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Terkirim</th>
                                    <th>Disetujui</th>
                                    <th>Capaian (%)</th>
                                    <th>Ketepatan Waktu (%)</th>
                                    <th>Nilai KPI Final</th>
                                    <th>Standby (Y/N)</th>
                                    <th>Hari Kerja Efektif</th>
                                    <th>Tunjangan (Rp)</th>
                                </tr>
                            </thead>
                            <tbody id="petugasBody">
                                <tr>
                                    <td colspan="10" class="loading-state">Memuat data petugas…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const API_URL = "{{ route('laporan-capaian-kpi.api') }}";
        const EXPORT_URL = "{{ route('laporan-capaian-kpi.export') }}";
        const fmtRp = (n) => n === null || n === undefined || n === 0 ? '-' : 'Rp ' + Number(n).toLocaleString('id-ID');
        const fmtPct = (n) => n === null || n === undefined ? '-' : Number(n).toLocaleString('id-ID', {
            minimumFractionDigits: 1,
            maximumFractionDigits: 1
        }) + '%';
        const fmtNum = (n) => n === null || n === undefined || n === 0 ? '-' : Number(n).toLocaleString('id-ID');

        const TEAM_ORDER = [
            ['safety', 'SAFETY'],
            ['pengawas', 'PENGAWAS'],
            ['medis', 'MEDIS'],
        ];

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

        function exportExcel() {
            const params = new URLSearchParams({
                tahun: document.getElementById('fTahun').value,
                bulan: document.getElementById('fBulan').value,
            });
            window.location.href = `${EXPORT_URL}?${params.toString()}`;
        }

        function buildQuery() {
            return new URLSearchParams({
                tahun: document.getElementById('fTahun').value,
                bulan: document.getElementById('fBulan').value,
            }).toString();
        }

        function renderPeriode(p) {
            document.getElementById('periodeAktifLine').innerHTML =
                `Periode Cut Off: <b>${p.mulai}</b> s/d <b>${p.selesai}</b> &nbsp;|&nbsp; Bulan: <b>${p.bulan_label}</b>`;
        }

        function kategoriClass(k) {
            if (k === 'BAIK') return 'kp-baik';
            if (k === 'CUKUP') return 'kp-cukup';
            return 'kp-perbaikan';
        }

        // ══════ SECTION A ══════
        function renderRingkasan(tim, total) {
            const body = document.getElementById('ringkasanBody');

            const rows = TEAM_ORDER.map(([key, label], idx) => {
                const t = tim[key];
                if (!t) return '';
                return `
            <tr>
                <td>${idx + 1}</td>
                <td style="font-weight:800;color:var(--blue)">${label}</td>
                <td>${fmtNum(t.target_laporan)}</td>
                <td>${fmtNum(t.laporan_disetujui)}</td>
                <td>${fmtPct(t.pencapaian_persen)}</td>
                <td>${fmtPct(t.ketepatan_target_persen)}</td>
                <td>${fmtPct(t.ketepatan_realisasi_persen)}</td>
                <td>${fmtPct(t.nilai_kpi_final_persen)}</td>
                <td>${fmtRp(t.tunjangan_tim)}</td>
                <td><span class="kategori-pill ${kategoriClass(t.kategori)}">${t.kategori}</span></td>
            </tr>`;
            }).join('');

            const totalRow = total ? `
        <tr class="total-a">
            <td></td>
            <td>HASIL PENCAPAIAN TIM (rata²)</td>
            <td>${fmtNum(total.target_laporan)}</td>
            <td>${fmtNum(total.laporan_disetujui)}</td>
            <td>${fmtPct(total.pencapaian_persen)}</td>
            <td>${fmtPct(total.ketepatan_target_persen)}</td>
            <td>${fmtPct(total.ketepatan_realisasi_persen)}</td>
            <td>${fmtPct(total.nilai_kpi_final_persen)}</td>
            <td>${fmtRp(total.tunjangan_tim)}</td>
            <td><span class="kategori-pill ${kategoriClass(total.kategori)}">${total.kategori}</span></td>
        </tr>` : '';

            body.innerHTML = (rows ||
                '<tr><td colspan="10" class="empty-state">Tidak ada data untuk periode ini.</td></tr>') + totalRow;
        }

        // ══════ SECTION B (gabungan seluruh tim, urut Safety → Pengawas → Medis) ══════
        function renderAktivitasGabungan(tim) {
            const body = document.getElementById('aktivitasBody');
            let rows = [];

            TEAM_ORDER.forEach(([key, label]) => {
                const t = tim[key];
                if (!t || !t.rincian_aktivitas) return;
                t.rincian_aktivitas.forEach(r => {
                    rows.push(`
                <tr>
                    <td style="font-weight:700;">${label}</td>
                    <td style="font-weight:700;color:var(--blue)">${r.kode}</td>
                    <td>${r.nama_aktivitas}</td>
                    <td>${fmtPct(r.bobot_persen)}</td>
                    <td>${fmtNum(r.target_periode)}</td>
                    <td>${fmtNum(r.disetujui)}</td>
                    <td>${fmtPct(r.aktual_pencapaian_persen)}</td>
                </tr>`);
                });
            });

            body.innerHTML = rows.length ?
                rows.join('') :
                '<tr><td colspan="7" class="empty-state">Belum ada aktivitas aktif.</td></tr>';
        }

        // ══════ SECTION C (dikelompokkan per tim + subtotal + grand total) ══════
        function renderPetugasGabungan(tim, totalTunjanganSeluruhTim) {
            const body = document.getElementById('petugasBody');
            let html = '';
            let adaData = false;

            TEAM_ORDER.forEach(([key, label]) => {
                const t = tim[key];
                if (!t) return;
                adaData = true;

                html += `<tr class="grp-header"><td colspan="10">TIM ${label}</td></tr>`;

                if (!t.petugas || t.petugas.length === 0) {
                    html +=
                        `<tr><td colspan="10" class="empty-state">Belum ada petugas terdaftar untuk tim ini.</td></tr>`;
                } else {
                    t.petugas.forEach((p, idx) => {
                        html += `
                    <tr>
                        <td>${idx + 1}</td>
                        <td>${p.nama} <span style="color:#94A3B8;font-weight:600;">(${p.badge ?? '-'})</span></td>
                        <td>${fmtNum(p.terkirim)}</td>
                        <td>${fmtNum(p.disetujui)}</td>
                        <td>${fmtPct(p.capaian_persen)}</td>
                        <td>${fmtPct(p.ketepatan_waktu_persen)}</td>
                        <td>${fmtPct(p.nilai_kpi_final)}</td>
                        <td>${p.standby}</td>
                        <td>${fmtNum(p.hari_kerja_efektif)}</td>
                        <td>${fmtRp(p.tunjangan)}</td>
                    </tr>`;
                    });
                }

                const terkirimTim = (t.petugas || []).reduce((s, p) => s + (p.terkirim || 0), 0);

                html += `
            <tr class="grp-subtotal">
                <td></td>
                <td>SUBTOTAL ${label} (aktif)</td>
                <td>${fmtNum(terkirimTim)}</td>
                <td>${fmtNum(t.laporan_disetujui)}</td>
                <td>${fmtPct(t.pencapaian_persen)}</td>
                <td></td>
                <td>${fmtPct(t.nilai_kpi_final_persen)}</td>
                <td></td>
                <td></td>
                <td>${fmtRp(t.tunjangan_tim)}</td>
            </tr>`;
            });

            if (!adaData) {
                body.innerHTML = '<tr><td colspan="10" class="empty-state">Tidak ada data untuk periode ini.</td></tr>';
                return;
            }

            html += `
        <tr class="grand-total">
            <td colspan="9">TOTAL TUNJANGAN SELURUH PETUGAS AKTIF (periode ini)</td>
            <td>${fmtRp(totalTunjanganSeluruhTim)}</td>
        </tr>`;

            body.innerHTML = html;
        }

        async function loadLaporan() {
            try {
                const res = await fetch(`${API_URL}?${buildQuery()}`);
                if (!res.ok) throw new Error('Gagal memuat data');
                const json = await res.json();

                renderPeriode(json.periode);
                renderRingkasan(json.tim, json.total);
                renderAktivitasGabungan(json.tim);
                renderPetugasGabungan(json.tim, json.total_tunjangan_seluruh_tim);
            } catch (e) {
                console.error(e);
                document.getElementById('ringkasanBody').innerHTML =
                    '<tr><td colspan="10" class="empty-state">Gagal memuat laporan.</td></tr>';
                document.getElementById('aktivitasBody').innerHTML =
                    '<tr><td colspan="7" class="empty-state">Gagal memuat data.</td></tr>';
                document.getElementById('petugasBody').innerHTML =
                    '<tr><td colspan="10" class="empty-state">Gagal memuat data.</td></tr>';
            }
        }

        document.getElementById('btnTerapkan').addEventListener('click', loadLaporan);

        populateTahun();
        loadLaporan();
    </script>
</body>

</html>
