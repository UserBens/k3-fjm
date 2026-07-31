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
            max-width: 1280px;
            margin: 0 auto;
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
            margin-bottom: 5px;
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
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar && toggleSidebar()"></div>

    <div id="main-content" class="flex-1 flex flex-col overflow-hidden">

        @include('partials.topbar')

        <div id="page-content" class="overflow-y-auto">

            <div class="k3-header">
                <h1>Dashboard KPI Keselamatan &amp; Kesehatan Kerja</h1>
                <p>PT. Fokus Jasa Mitra — Departemen K3 &amp; Operasional</p>
            </div>

            <!-- PANEL SAKLAR -->
            <div class="panel-saklar">
                <div class="panel-saklar-title">Panel Saklar · ubah di sini, seluruh dashboard mengikuti</div>
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
                    <div class="saklar-field">
                        <label>Tim</label>
                        <select id="fTim">
                            <option value="SEMUA">SEMUA</option>
                            <option value="SAFETY">SAFETY</option>
                            <option value="PENGAWAS">PENGAWAS</option>
                            <option value="MEDIS">MEDIS</option>
                        </select>
                    </div>
                    <div class="saklar-field">
                        <label>Area</label>
                        <select id="fArea">
                            <option value="SEMUA">SEMUA</option>
                        </select>
                    </div>
                    <div class="saklar-field">
                        <label>Tampilkan Rupiah</label>
                        <select id="fRupiah">
                            <option value="1">YA</option>
                            <option value="0">TIDAK</option>
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
            <div>
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
                </div>
            </div>

            <!-- MONITORING PER PERSONIL + RINCIAN AKTIVITAS -->
            <div>
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
            </div>

        </div>
    </div>

    <script>
        const API_URL = "{{ route('dashboard-kpi-k3.api') }}";
        const fmtRp = (n) => n === null || n === undefined ? '—' : 'Rp ' + Number(n).toLocaleString('id-ID');
        const fmtPct = (n) => n === null || n === undefined ? '—' : Number(n).toLocaleString('id-ID', {
            minimumFractionDigits: 1,
            maximumFractionDigits: 1
        }) + '%';
        const fmtNum = (n) => n === null || n === undefined ? '—' : Number(n).toLocaleString('id-ID');

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

        function buildQuery(personilKey) {
            const params = new URLSearchParams({
                tahun: document.getElementById('fTahun').value,
                bulan: document.getElementById('fBulan').value,
                tim: document.getElementById('fTim').value,
                area: document.getElementById('fArea').value,
                tampilkan_rupiah: document.getElementById('fRupiah').value,
            });
            if (personilKey) params.set('personil', personilKey);
            return params.toString();
        }

        function renderPeriode(p) {
            document.getElementById('periodeAktifLine').innerHTML =
                `Periode aktif: <b>${p.periode_mulai}</b> s/d <b>${p.periode_selesai}</b> &nbsp;|&nbsp; <b>${p.bulan_label}</b> &nbsp;·&nbsp; Tim: <b>${p.tim}</b> · Area: <b>${p.area}</b>`;
        }

        function renderRingkasan(r) {
            document.getElementById('stApprove').textContent = fmtNum(r.approve);
            document.getElementById('stReject').textContent = fmtNum(r.reject);
            document.getElementById('stPending').textContent = fmtNum(r.pending);
            document.getElementById('stCancel').textContent = fmtNum(r.cancel);
            document.getElementById('stTotal').textContent = fmtNum(r.total);
        }

        function renderIndikator(ik) {
            document.getElementById('ikTotalLaporan').textContent = fmtNum(ik.total_laporan_disetujui);
            document.getElementById('ikRataSkor').textContent = fmtPct(ik.rata_rata_skor_akhir);
            document.getElementById('ikTunjangan').textContent = ik.total_tunjangan === null ? '—' : fmtRp(ik
                .total_tunjangan);
            document.getElementById('ikPersonilBaik').textContent = fmtNum(ik.jumlah_personil_baik);
        }

        function kategoriClass(k) {
            if (k === 'BAIK') return 'kp-baik';
            if (k === 'CUKUP') return 'kp-cukup';
            return 'kp-perbaikan';
        }

        function renderMonitoring(m) {
            const box = document.getElementById('monitoringBox');
            if (!m) {
                box.innerHTML = '<div class="empty-state">Belum ada personil pada filter ini.</div>';
                return;
            }
            box.innerHTML = `
                <div class="kv-row"><span class="k">Tim / Jenis Petugas</span><span class="v">${m.tim}</span></div>
                <div class="kv-row"><span class="k">Hari Kerja Efektif</span><span class="v">${fmtNum(m.hari_kerja_efektif)}</span></div>
                <div class="kv-row"><span class="k">Total Target Laporan (Periode)</span><span class="v">${fmtNum(m.total_target_laporan)}</span></div>
                <div class="kv-row"><span class="k">Jumlah Laporan Disetujui</span><span class="v">${fmtNum(m.jumlah_laporan_disetujui)}</span></div>
                <div class="kv-row"><span class="k">Jumlah Laporan Tepat Waktu</span><span class="v">${fmtNum(m.jumlah_laporan_tepat_waktu)}</span></div>
                <div class="kv-row"><span class="k">Persentase Capaian Aktivitas</span><span class="v">${fmtPct(m.persentase_capaian_aktivitas)}</span></div>
                <div class="kv-row"><span class="k">Persentase Ketepatan Waktu</span><span class="v">${fmtPct(m.persentase_ketepatan_waktu)}</span></div>
                <div class="kv-row"><span class="k">Nilai KPI Final</span><span class="v" style="color:var(--blue)">${fmtPct(m.nilai_kpi_final)}</span></div>
                <div class="kv-row"><span class="k">Bobot Ditugaskan (%)</span><span class="v">${fmtPct(m.bobot_ditugaskan)}</span></div>
                <div class="kv-row"><span class="k">Jumlah Tugas</span><span class="v">${fmtNum(m.jumlah_tugas)}</span></div>
                <div class="kv-row"><span class="k">Tunjangan (Rp)</span><span class="v">${m.tunjangan === null ? '—' : fmtRp(m.tunjangan)}</span></div>
                <div class="kv-row"><span class="k">Kategori Penilaian</span><span class="kategori-pill ${kategoriClass(m.kategori_penilaian)}">${m.kategori_penilaian}</span></div>
            `;
        }

        function renderRincian(rows) {
            const body = document.getElementById('rincianBody');
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
                    <td>${fmtNum(r.laporan_disetujui)}</td>
                    <td>${fmtPct(r.bobot_item)}</td>
                    <td>${fmtPct(r.kontribusi)}</td>
                    <td><span class="status-capaian ${r.status_capaian === 'TERCAPAI' ? 'sc-tercapai' : 'sc-belum'}">${r.status_capaian}</span></td>
                </tr>
            `).join('');
        }

        function renderPersonilOptions(options, selectedKey) {
            const el = document.getElementById('fPersonil');
            el.innerHTML = options.map(o => `<option value="${o.key}">${o.label} — ${o.tim}</option>`).join('');
            if (selectedKey) el.value = selectedKey;
        }

        function renderAreaOptions(areas) {
            const el = document.getElementById('fArea');
            const current = el.value;
            el.innerHTML = '<option value="SEMUA">SEMUA</option>' + areas.map(a => `<option value="${a}">${a}</option>`)
                .join('');
            el.value = current || 'SEMUA';
        }

        async function loadDashboard(personilKey) {
            try {
                const res = await fetch(`${API_URL}?${buildQuery(personilKey)}`);
                if (!res.ok) throw new Error('Gagal memuat data');
                const json = await res.json();

                renderPeriode(json.periode);
                renderRingkasan(json.ringkasan_status_dokumen);
                renderIndikator(json.indikator_kpi);
                renderAreaOptions(json.area_options || []);
                renderPersonilOptions(json.personil_options || [], json.personil_terpilih);
                renderMonitoring(json.monitoring_personil);
                renderRincian(json.rincian_aktivitas);
            } catch (e) {
                console.error(e);
                document.getElementById('monitoringBox').innerHTML =
                    '<div class="empty-state">Gagal memuat data dashboard.</div>';
            }
        }

        document.getElementById('btnTerapkan').addEventListener('click', () => loadDashboard());
        document.getElementById('fPersonil').addEventListener('change', (e) => loadDashboard(e.target.value));

        populateTahun();
        loadDashboard();
    </script>
</body>

</html>
