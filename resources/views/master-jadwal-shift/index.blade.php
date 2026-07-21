<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Master Jadwal Shift — PT. Fokus Jasa Mitra</title>
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
            padding: 18px 18px 28px;
        }

        .panel {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .panel-hdr {
            padding: 12px 16px;
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            letter-spacing: 0.03em;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .panel-hdr .sub {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 10.5px;
            font-weight: 500;
            letter-spacing: 0;
            opacity: 0.85;
            margin-top: 2px;
        }

        .panel-hdr.hdr-blue {
            background: linear-gradient(135deg, var(--blue), var(--blue2));
        }

        .panel-body {
            padding: 14px 16px 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-white {
            background: #fff;
            color: var(--blue);
        }

        .btn-white:hover {
            background: #EEF1FC;
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        .btn-green {
            background: var(--green);
            color: #fff;
        }

        .btn-green:hover {
            background: var(--green2);
        }

        .btn-red {
            background: var(--red);
            color: #fff;
        }

        .btn-red:hover {
            background: var(--red2);
        }

        .btn-gray {
            background: #EEF1F6;
            color: #475569;
        }

        .btn-gray:hover {
            background: #E2E7F2;
        }

        .btn-sm {
            padding: 5px 9px;
            font-size: 11px;
            border-radius: 6px;
        }

        .filter-strip {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: end;
            margin-bottom: 14px;
        }

        .filter-field label {
            display: block;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #64748B;
            margin-bottom: 4px;
        }

        .filter-field select,
        .filter-field input {
            height: 34px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid #E2E7F2;
            font-size: 12px;
            font-weight: 600;
            color: #1A1D2E;
            background: #fff;
            outline: none;
            min-width: 130px;
        }

        .filter-field select:focus,
        .filter-field input:focus {
            border-color: var(--blue);
        }

        .jdw-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .jdw-table {
            width: 100%;
            min-width: 920px;
            border-collapse: collapse;
            font-size: 11.5px;
        }

        .jdw-table th {
            background: var(--blue);
            color: #fff;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            padding: 8px 6px;
            text-align: center;
            white-space: nowrap;
        }

        .jdw-table th.group-hdr {
            background: var(--blue2);
        }

        .jdw-table td {
            padding: 7px 6px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            white-space: nowrap;
            color: #1A1D2E;
        }

        .jdw-table tbody tr:hover td {
            background: #F5F7FD;
        }

        .jdw-table .txt-left {
            text-align: left;
        }

        .shift-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 22px;
            border-radius: 6px;
            font-weight: 800;
            font-size: 11px;
        }

        .shift-badge.shift-M {
            background: #E7EBFB;
            color: #2D4B9E;
        }

        .shift-badge.shift-S {
            background: #FCEED2;
            color: #B36B00;
        }

        .shift-badge.shift-P {
            background: #E4F4E9;
            color: #1A7A3C;
        }

        .shift-badge.shift-O {
            background: #F1F2F6;
            color: #94A3B8;
        }

        .shift-badge.shift-empty {
            background: transparent;
            color: #CBD5E1;
        }

        .empty-row td {
            text-align: center;
            padding: 26px 10px;
            color: #94A3B8;
            font-size: 12px;
        }

        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .pagination-bar .info {
            font-size: 11px;
            color: #64748B;
            font-weight: 600;
        }

        .pagination-bar .pages {
            display: flex;
            gap: 4px;
        }

        .pagination-bar .pages button {
            border: 1px solid #E2E7F2;
            background: #fff;
            border-radius: 6px;
            width: 28px;
            height: 28px;
            font-size: 11px;
            font-weight: 700;
            color: #1A1D2E;
            cursor: pointer;
        }

        .pagination-bar .pages button.active {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .pagination-bar .pages button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* modal */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(20, 22, 40, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 60;
            padding: 16px;
        }

        .modal-backdrop.open {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 14px;
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-box.modal-lg {
            max-width: 640px;
        }

        .modal-hdr {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-hdr h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 17px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
        }

        .modal-hdr button {
            border: none;
            background: #F1F2F6;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 13px;
            color: #64748B;
        }

        .modal-body {
            padding: 16px 18px;
        }

        .modal-ftr {
            padding: 12px 18px;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-field label {
            display: block;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #64748B;
            margin-bottom: 5px;
        }

        .form-field select,
        .form-field input {
            width: 100%;
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid #E2E7F2;
            font-size: 12.5px;
            font-weight: 600;
            color: #1A1D2E;
            outline: none;
        }

        .form-field select:focus,
        .form-field input:focus {
            border-color: var(--blue);
        }

        .form-field.full {
            grid-column: 1/-1;
        }

        .form-note {
            font-size: 10.5px;
            color: #94A3B8;
            margin-top: 10px;
        }

        .alert {
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 11.5px;
            font-weight: 600;
            margin-bottom: 12px;
            display: none;
        }

        .alert.show {
            display: block;
        }

        .alert-success {
            background: #E4F4E9;
            color: #1A7A3C;
        }

        .alert-error {
            background: #FCE9EA;
            color: #B3121F;
        }

        .alert-warn {
            background: #FCEED2;
            color: #B36B00;
        }

        .dropzone {
            border: 2px dashed #CBD5E1;
            border-radius: 10px;
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: 0.15s;
        }

        .dropzone:hover,
        .dropzone.dragover {
            border-color: var(--blue);
            background: #F5F7FD;
        }

        .dropzone .dz-icon {
            font-size: 26px;
            margin-bottom: 6px;
        }

        .dropzone .dz-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .dropzone .dz-sub {
            font-size: 10.5px;
            color: #94A3B8;
            margin-top: 3px;
        }

        .file-chip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #EEF1FC;
            border-radius: 8px;
            padding: 8px 10px;
            margin-top: 10px;
            font-size: 11.5px;
            font-weight: 700;
            color: #2D4B9E;
        }

        .file-chip button {
            border: none;
            background: none;
            color: #B3121F;
            font-weight: 800;
            cursor: pointer;
        }

        .import-error-list {
            max-height: 160px;
            overflow-y: auto;
            background: #FCE9EA;
            border-radius: 8px;
            padding: 10px 12px;
            margin-top: 10px;
        }

        .import-error-list li {
            font-size: 11px;
            color: #B3121F;
            margin-bottom: 3px;
        }

        .spinner {
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
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

            <div class="panel">
                <div class="panel-hdr hdr-blue">
                    <div>
                        MASTER JADWAL SHIFT
                        <div class="sub">Kelola jadwal rotasi 4 regu (A/B/C/D) &middot; input manual atau import
                            Excel/CSV</div>
                    </div>
                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        <button class="btn btn-outline" onclick="openTemplateInfo()">
                            &#8681; Template
                        </button>
                        <button class="btn btn-outline" onclick="openImportModal()">
                            &#8593; Import Excel/CSV
                        </button>
                        <button class="btn btn-white" onclick="openAddModal()">
                            + Tambah Jadwal
                        </button>
                    </div>
                </div>

                <div class="panel-body">

                    <div id="alertBox" class="alert"></div>

                    {{-- filter --}}
                    <div class="filter-strip">
                        <div class="filter-field">
                            <label>Bulan</label>
                            <select id="filterBulan" onchange="reloadTable()">
                                <option value="">Semua Bulan</option>
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
                        <div class="filter-field">
                            <label>Tahun</label>
                            <select id="filterTahun" onchange="reloadTable()">
                                {{-- @foreach ($tahunList as $t)
                                    <option value="{{ $t }}" {{ $t == date('Y') ? 'selected' : '' }}>
                                        {{ $t }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="filter-field">
                            <label>Cari Tanggal</label>
                            <input type="date" id="filterTanggal" onchange="reloadTable()" />
                        </div>
                        <div class="filter-field">
                            <label>&nbsp;</label>
                            <button class="btn btn-gray" onclick="resetFilter()">Reset Filter</button>
                        </div>
                    </div>

                    {{-- table --}}
                    <div class="jdw-table-wrap">
                        <table class="jdw-table">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Tanggal</th>
                                    <th colspan="2" class="group-hdr">Regu A</th>
                                    <th colspan="2" class="group-hdr">Regu B</th>
                                    <th colspan="2" class="group-hdr">Regu C</th>
                                    <th colspan="2" class="group-hdr">Regu D</th>
                                    <th rowspan="2">Jam ND</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="group-hdr">Shift</th>
                                    <th class="group-hdr">Jam</th>
                                    <th class="group-hdr">Shift</th>
                                    <th class="group-hdr">Jam</th>
                                    <th class="group-hdr">Shift</th>
                                    <th class="group-hdr">Jam</th>
                                    <th class="group-hdr">Shift</th>
                                    <th class="group-hdr">Jam</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyJadwal">
                                <tr class="empty-row">
                                    <td colspan="11">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-bar">
                        <div class="info" id="paginationInfo">-</div>
                        <div class="pages" id="paginationPages"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- ══════ MODAL TAMBAH / EDIT ══════ --}}
    <div class="modal-backdrop" id="modalForm">
        <div class="modal-box">
            <div class="modal-hdr">
                <h3 id="modalFormTitle">Tambah Jadwal</h3>
                <button onclick="closeModal('modalForm')">&times;</button>
            </div>
            <form id="formJadwal" onsubmit="submitFormJadwal(event)">
                <div class="modal-body">
                    <input type="hidden" id="fId" />
                    <div class="form-grid">
                        <div class="form-field full">
                            <label>Tanggal</label>
                            <input type="date" id="fTanggal" required />
                        </div>

                        <div class="form-field">
                            <label>Shift Regu A</label>
                            <select id="fShiftA" onchange="autoJam('A')">
                                <option value="">-</option>
                                <option value="P">P - Pagi</option>
                                <option value="S">S - Siang</option>
                                <option value="M">M - Malam</option>
                                <option value="O">O - Off</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label>Jam Regu A</label>
                            <input type="number" id="fJamA" min="0" max="24" value="0" />
                        </div>

                        <div class="form-field">
                            <label>Shift Regu B</label>
                            <select id="fShiftB" onchange="autoJam('B')">
                                <option value="">-</option>
                                <option value="P">P - Pagi</option>
                                <option value="S">S - Siang</option>
                                <option value="M">M - Malam</option>
                                <option value="O">O - Off</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label>Jam Regu B</label>
                            <input type="number" id="fJamB" min="0" max="24" value="0" />
                        </div>

                        <div class="form-field">
                            <label>Shift Regu C</label>
                            <select id="fShiftC" onchange="autoJam('C')">
                                <option value="">-</option>
                                <option value="P">P - Pagi</option>
                                <option value="S">S - Siang</option>
                                <option value="M">M - Malam</option>
                                <option value="O">O - Off</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label>Jam Regu C</label>
                            <input type="number" id="fJamC" min="0" max="24" value="0" />
                        </div>

                        <div class="form-field">
                            <label>Shift Regu D</label>
                            <select id="fShiftD" onchange="autoJam('D')">
                                <option value="">-</option>
                                <option value="P">P - Pagi</option>
                                <option value="S">S - Siang</option>
                                <option value="M">M - Malam</option>
                                <option value="O">O - Off</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label>Jam Regu D</label>
                            <input type="number" id="fJamD" min="0" max="24" value="0" />
                        </div>

                        <div class="form-field">
                            <label>Jam ND</label>
                            <input type="number" id="fJamNd" min="0" max="24" value="0" />
                        </div>
                        <div class="form-field">
                            <label>Keterangan (opsional)</label>
                            <input type="text" id="fKeterangan" maxlength="255" />
                        </div>
                    </div>
                    <div class="form-note">Shift: P = Pagi, S = Siang, M = Malam, O = Off/Libur. Jam terisi otomatis 8
                        saat memilih P/S/M dan 0 saat memilih O — bisa diubah manual bila perlu.</div>
                </div>
                <div class="modal-ftr">
                    <button type="button" class="btn btn-gray" onclick="closeModal('modalForm')">Batal</button>
                    <button type="submit" class="btn btn-green" id="btnSubmitJadwal">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══════ MODAL IMPORT ══════ --}}
    <div class="modal-backdrop" id="modalImport">
        <div class="modal-box modal-lg">
            <div class="modal-hdr">
                <h3>Import Master Jadwal Shift</h3>
                <button onclick="closeModal('modalImport')">&times;</button>
            </div>
            <div class="modal-body">
                <div id="importAlert" class="alert"></div>

                <div class="dropzone" id="dropzone" onclick="document.getElementById('importFileInput').click()">
                    <div class="dz-icon">&#128193;</div>
                    <div class="dz-title">Klik untuk pilih file, atau drag & drop di sini</div>
                    <div class="dz-sub">Format: .xlsx, .xls, atau .csv &middot; maksimal 5MB</div>
                </div>
                <input type="file" id="importFileInput" accept=".xlsx,.xls,.csv" style="display:none"
                    onchange="onFileSelected()" />
                <div id="fileChipWrap"></div>

                <div id="importErrorWrap" style="display:none">
                    <div style="font-size:11px; font-weight:800; color:#B3121F; margin-top:12px;">BARIS YANG DILEWATI:
                    </div>
                    <ul class="import-error-list" id="importErrorList"></ul>
                </div>

                <div class="form-note">
                    Kolom yang wajib ada pada baris header: <b>TANGGAL, SHIFT_A, JAM_A, SHIFT_B, JAM_B, SHIFT_C, JAM_C,
                        SHIFT_D, JAM_D, JAM_ND</b>.
                    Format tanggal: dd/mm/yyyy. Data yang tanggalnya sudah ada akan otomatis diperbarui (upsert), jadi
                    file yang sama aman diimport ulang.
                    Belum punya file? unduh <a href="{{ route('master-jadwal-shift.template') }}"
                        style="color:var(--blue); font-weight:700;">template kosong di sini</a>.
                </div>
            </div>
            <div class="modal-ftr">
                <button type="button" class="btn btn-gray" onclick="closeModal('modalImport')">Batal</button>
                <button type="button" class="btn btn-green" id="btnSubmitImport" onclick="submitImport()" disabled>
                    Import Sekarang
                </button>
            </div>
        </div>
    </div>

    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content ?? '{{ csrf_token() }}';
        const ROUTE_DATA = "{{ route('master-jadwal-shift.data') }}";
        const ROUTE_STORE = "{{ route('master-jadwal-shift.store') }}";
        const ROUTE_UPDATE_BASE = "{{ url('master-jadwal-shift') }}"; // + /{id}
        const ROUTE_IMPORT = "{{ route('master-jadwal-shift.import') }}";
        const ROUTE_TEMPLATE = "{{ route('master-jadwal-shift.template') }}";

        let currentPage = 1;
        let selectedFile = null;

        function showAlert(id, type, message) {
            const el = document.getElementById(id);
            el.className = `alert alert-${type} show`;
            el.textContent = message;
            if (type === 'success') {
                setTimeout(() => el.classList.remove('show'), 4000);
            }
        }

        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }

        function resetFilter() {
            document.getElementById('filterBulan').value = '';
            document.getElementById('filterTanggal').value = '';
            reloadTable();
        }

        function reloadTable(page = 1) {
            currentPage = page;
            loadTable();
        }

        async function loadTable() {
            const tbody = document.getElementById('tbodyJadwal');
            tbody.innerHTML = '<tr class="empty-row"><td colspan="11">Memuat data…</td></tr>';

            const params = new URLSearchParams({
                bulan: document.getElementById('filterBulan').value,
                tahun: document.getElementById('filterTahun').value,
                cari_tanggal: document.getElementById('filterTanggal').value,
                page: currentPage,
            });

            try {
                const res = await fetch(`${ROUTE_DATA}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const json = await res.json();
                renderTable(json.data);
                renderPagination(json);
            } catch (e) {
                console.error(e);
                tbody.innerHTML = '<tr class="empty-row"><td colspan="11">Gagal memuat data.</td></tr>';
            }
        }

        function shiftBadge(kode) {
            if (!kode) return '<span class="shift-badge shift-empty">-</span>';
            return `<span class="shift-badge shift-${kode}">${kode}</span>`;
        }

        function formatTanggalTampil(iso) {
            if (!iso) return '-';
            const [y, m, d] = iso.split('-');
            return `${d}/${m}/${y}`;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tbodyJadwal');
            if (!rows || rows.length === 0) {
                tbody.innerHTML = '<tr class="empty-row"><td colspan="11">Tidak ada data pada filter ini.</td></tr>';
                return;
            }

            tbody.innerHTML = rows.map((r, idx) => `
                <tr>
                    <td>${(currentPage - 1) * rows.length + idx + 1}</td>
                    <td class="txt-left"><b>${formatTanggalTampil(r.tanggal)}</b></td>
                    <td>${shiftBadge(r.shift_a)}</td><td>${r.jam_a ?? 0}</td>
                    <td>${shiftBadge(r.shift_b)}</td><td>${r.jam_b ?? 0}</td>
                    <td>${shiftBadge(r.shift_c)}</td><td>${r.jam_c ?? 0}</td>
                    <td>${shiftBadge(r.shift_d)}</td><td>${r.jam_d ?? 0}</td>
                    <td>${r.jam_nd ?? 0}</td>
                    <td>
                        <button class="btn btn-gray btn-sm" onclick='openEditModal(${JSON.stringify(r)})'>Edit</button>
                        <button class="btn btn-red btn-sm" onclick="hapusJadwal(${r.id}, '${formatTanggalTampil(r.tanggal)}')">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(json) {
            document.getElementById('paginationInfo').textContent =
                `Menampilkan ${json.from ?? 0}–${json.to ?? 0} dari ${json.total ?? 0} data`;

            const wrap = document.getElementById('paginationPages');
            const lastPage = json.last_page ?? 1;
            let html =
                `<button ${json.current_page <= 1 ? 'disabled' : ''} onclick="reloadTable(${json.current_page - 1})">&lsaquo;</button>`;

            const start = Math.max(1, json.current_page - 2);
            const end = Math.min(lastPage, json.current_page + 2);
            for (let p = start; p <= end; p++) {
                html +=
                    `<button class="${p === json.current_page ? 'active' : ''}" onclick="reloadTable(${p})">${p}</button>`;
            }
            html +=
                `<button ${json.current_page >= lastPage ? 'disabled' : ''} onclick="reloadTable(${json.current_page + 1})">&rsaquo;</button>`;
            wrap.innerHTML = html;
        }

        // ══════ Tambah / Edit ══════
        function openAddModal() {
            document.getElementById('modalFormTitle').textContent = 'Tambah Jadwal';
            document.getElementById('formJadwal').reset();
            document.getElementById('fId').value = '';
            openModal('modalForm');
        }

        function openEditModal(row) {
            document.getElementById('modalFormTitle').textContent = 'Edit Jadwal';
            document.getElementById('fId').value = row.id;
            document.getElementById('fTanggal').value = row.tanggal;
            document.getElementById('fShiftA').value = row.shift_a ?? '';
            document.getElementById('fJamA').value = row.jam_a ?? 0;
            document.getElementById('fShiftB').value = row.shift_b ?? '';
            document.getElementById('fJamB').value = row.jam_b ?? 0;
            document.getElementById('fShiftC').value = row.shift_c ?? '';
            document.getElementById('fJamC').value = row.jam_c ?? 0;
            document.getElementById('fShiftD').value = row.shift_d ?? '';
            document.getElementById('fJamD').value = row.jam_d ?? 0;
            document.getElementById('fJamNd').value = row.jam_nd ?? 0;
            document.getElementById('fKeterangan').value = row.keterangan ?? '';
            openModal('modalForm');
        }

        function autoJam(regu) {
            const shiftVal = document.getElementById(`fShift${regu}`).value;
            const jamInput = document.getElementById(`fJam${regu}`);
            jamInput.value = shiftVal === 'O' || shiftVal === '' ? 0 : 8;
        }

        async function submitFormJadwal(e) {
            e.preventDefault();
            const id = document.getElementById('fId').value;
            const payload = {
                tanggal: document.getElementById('fTanggal').value,
                shift_a: document.getElementById('fShiftA').value || null,
                jam_a: document.getElementById('fJamA').value || 0,
                shift_b: document.getElementById('fShiftB').value || null,
                jam_b: document.getElementById('fJamB').value || 0,
                shift_c: document.getElementById('fShiftC').value || null,
                jam_c: document.getElementById('fJamC').value || 0,
                shift_d: document.getElementById('fShiftD').value || null,
                jam_d: document.getElementById('fJamD').value || 0,
                jam_nd: document.getElementById('fJamNd').value || 0,
                keterangan: document.getElementById('fKeterangan').value || null,
            };

            const btn = document.getElementById('btnSubmitJadwal');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner"></span> Menyimpan…';

            try {
                const url = id ? `${ROUTE_UPDATE_BASE}/${id}` : ROUTE_STORE;
                const res = await fetch(url, {
                    method: id ? 'PUT' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    body: JSON.stringify(payload),
                });
                const json = await res.json();

                if (!res.ok) {
                    const msg = json.errors ? Object.values(json.errors).flat().join(' ') : (json.message ||
                        'Gagal menyimpan data.');
                    showAlert('alertBox', 'error', msg);
                    return;
                }

                closeModal('modalForm');
                showAlert('alertBox', 'success', json.message);
                reloadTable(currentPage);
            } catch (e) {
                console.error(e);
                showAlert('alertBox', 'error', 'Terjadi kesalahan jaringan.');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Simpan';
            }
        }

        async function hapusJadwal(id, tanggalTampil) {
            if (!confirm(`Hapus jadwal tanggal ${tanggalTampil}?`)) return;

            try {
                const res = await fetch(`${ROUTE_UPDATE_BASE}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                });
                const json = await res.json();
                if (!res.ok) {
                    showAlert('alertBox', 'error', json.message || 'Gagal menghapus data.');
                    return;
                }
                showAlert('alertBox', 'success', json.message);
                reloadTable(currentPage);
            } catch (e) {
                console.error(e);
                showAlert('alertBox', 'error', 'Terjadi kesalahan jaringan.');
            }
        }

        // ══════ Import ══════
        function openImportModal() {
            selectedFile = null;
            document.getElementById('importFileInput').value = '';
            document.getElementById('fileChipWrap').innerHTML = '';
            document.getElementById('importErrorWrap').style.display = 'none';
            document.getElementById('importAlert').classList.remove('show');
            document.getElementById('btnSubmitImport').disabled = true;
            openModal('modalImport');
        }

        function openTemplateInfo() {
            window.location.href = ROUTE_TEMPLATE;
        }

        function onFileSelected() {
            const input = document.getElementById('importFileInput');
            if (!input.files.length) return;
            selectedFile = input.files[0];
            document.getElementById('fileChipWrap').innerHTML = `
                <div class="file-chip">
                    <span>&#128196; ${selectedFile.name}</span>
                    <button onclick="clearSelectedFile()">&times;</button>
                </div>`;
            document.getElementById('btnSubmitImport').disabled = false;
        }

        function clearSelectedFile() {
            selectedFile = null;
            document.getElementById('importFileInput').value = '';
            document.getElementById('fileChipWrap').innerHTML = '';
            document.getElementById('btnSubmitImport').disabled = true;
        }

        // drag & drop
        const dz = document.getElementById('dropzone');
        ['dragenter', 'dragover'].forEach(evt => dz.addEventListener(evt, e => {
            e.preventDefault();
            dz.classList.add('dragover');
        }));
        ['dragleave', 'drop'].forEach(evt => dz.addEventListener(evt, e => {
            e.preventDefault();
            dz.classList.remove('dragover');
        }));
        dz.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) {
                document.getElementById('importFileInput').files = files;
                onFileSelected();
            }
        });

        async function submitImport() {
            if (!selectedFile) return;

            const btn = document.getElementById('btnSubmitImport');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner"></span> Mengimport…';
            document.getElementById('importErrorWrap').style.display = 'none';

            const formData = new FormData();
            formData.append('file', selectedFile);

            try {
                const res = await fetch(ROUTE_IMPORT, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: formData,
                });
                const json = await res.json();

                if (res.status === 207) {
                    // sukses sebagian
                    showAlert('importAlert', 'warn', json.message);
                    document.getElementById('importErrorWrap').style.display = 'block';
                    document.getElementById('importErrorList').innerHTML =
                        json.errors.map(e => `<li>${e}</li>`).join('');
                    reloadTable(1);
                } else if (!res.ok) {
                    showAlert('importAlert', 'error', json.message || 'Import gagal.');
                } else {
                    showAlert('importAlert', 'success', json.message);
                    reloadTable(1);
                    setTimeout(() => closeModal('modalImport'), 1500);
                }
            } catch (e) {
                console.error(e);
                showAlert('importAlert', 'error', 'Terjadi kesalahan jaringan saat import.');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Import Sekarang';
            }
        }

        document.addEventListener('DOMContentLoaded', () => loadTable());
    </script>

</body>

</html>
