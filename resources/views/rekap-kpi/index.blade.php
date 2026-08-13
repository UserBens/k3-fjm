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

        .saklar-grid {
            grid-template-columns: repeat(5, 1fr);
            /* Periode, Tahun, Bulan, Area, Tombol */
        }

        .saklar-field.flex {
            display: flex;
        }

        .saklar-field.items-end {
            align-items: flex-end;
        }

        .btn-terapkan {
            width: 100%;
            height: 34px;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 800;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-terapkan:hover {
            background: var(--blue2);
        }

        .rkp-wrap {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .rkp-header {
            background: #1E3A6E;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 14px 20px;
        }

        .rkp-header-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .rkp-header-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, .75);
            margin-top: 2px;
        }

        .rkp-subbar {
            background: #EEF2FA;
            border: 1px solid #DCE3F0;
            border-top: none;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 700;
            color: #1E3A6E;
            text-align: center;
        }

        .rkp-periode {
            background: #fff;
            border: 1px solid #DCE3F0;
            border-top: none;
            padding: 8px 20px;
            font-size: 12px;
            color: #475569;
            text-align: center;
            border-radius: 0 0 10px 10px;
            margin-bottom: 4px;
        }

        .rkp-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px 16px;
        }

        .rkp-filters label {
            font-size: 11px;
            color: #64748B;
            font-weight: 600;
            display: block;
            margin-bottom: 3px;
        }

        .rkp-filters select,
        .rkp-filters input {
            border: 1px solid #CBD5E1;
            border-radius: 6px;
            padding: 6px 8px;
            font-size: 12px;
            color: #1A1D2E;
            background: #fff;
        }

        .rkp-filters .rkp-btn {
            background: #2D4B9E;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            align-self: flex-end;
        }

        .rkp-section {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 16px;
            align-items: stretch;
        }

        @media (max-width: 1100px) {
            .rkp-section {
                grid-template-columns: 1fr;
            }
        }

        .rkp-panel {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .rkp-panel-title {
            font-size: 12px;
            font-weight: 700;
            color: #1E3A6E;
            background: #F1F5F9;
            border: 1px solid #E2E8F0;
            padding: 8px 12px;
            margin: -14px -16px 12px -16px;
            border-radius: 10px 10px 0 0;
        }

        table.rkp-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11.5px;
        }

        table.rkp-table th,
        table.rkp-table td {
            border: 1px solid #D8DEEA;
            padding: 5px 7px;
            text-align: center;
        }

        table.rkp-table th {
            background: #1E3A6E;
            color: #fff;
            font-weight: 700;
            font-size: 10.5px;
            text-transform: uppercase;
        }

        table.rkp-table td.rkp-nama {
            text-align: left;
            font-weight: 600;
            color: #1A1D2E;
        }

        table.rkp-table td.rkp-num {
            font-weight: 600;
        }

        table.rkp-table tr:nth-child(even) td {
            background: #FAFBFF;
        }

        .rkp-tim-SAFETY {
            color: #D9730D;
            font-weight: 700;
        }

        .rkp-tim-PENGAWAS {
            color: #1E3A8A;
            font-weight: 700;
        }

        .rkp-tim-MEDIS {
            color: #0F9488;
            font-weight: 700;
        }

        .rkp-chart-box {
            position: relative;
            width: 100%;
        }

        #chartCapaian {
            height: 480px;
        }

        #chartTemuan {
            height: 300px;
        }

        .rkp-empty {
            text-align: center;
            padding: 24px;
            color: #94A3B8;
            font-size: 12px;
        }

        .rkp-loading {
            text-align: center;
            padding: 24px;
            color: #94A3B8;
            font-size: 12px;
        }

        /* CONTENT LAYOUT FIX */
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
            /* Ini yang membuat konten bisa di-scroll dan tidak terpotong */
            padding: 20px 20px 32px;
            max-width: 100%;
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
    </style>
</head>


<body class="flex h-screen overflow-hidden">

    <!-- ══════ SIDEBAR ══════ -->
    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- ══════ MAIN ══════ -->
    <div id="main-content">

        @include('partials.topbar')

        <!-- PAGE CONTENT -->
        <div id="page-content">

            <!-- HEADER -->
            {{-- <div class="k3-header">
                <h1></h1>
                <p>Capaian per aktivitas &amp; temuan UA/UC per area — PT. Fokus Jasa Mitra, Departemen K3 &amp;
                    Operasional</p>
            </div> --}}

            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">REKAP KPI PROGRAM (LEADING) KPI · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">REKAP KPI <span>K3</span></div>
                        <div class="pg-sub">Keselamatan &amp; Kesehatan Kerja — Departemen K3 &amp; Operasional.</div>
                    </div>
                </div>
            </div>

            <!-- PANEL SAKLAR / FILTER -->
            <div class="panel-saklar">
                <div class="panel-saklar-title">Filter</div>
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
                        <label>Jenis Periode</label>
                        <select id="fPeriodeType">
                            <option value="26_25">Cutoff Manajer (26 s/d 25)</option>
                            <option value="1_31">Kalender (1 s/d Akhir Bulan)</option>
                        </select>
                    </div>
                    <div class="saklar-field">
                        <label>Tim</label>
                        <select id="fTim">
                            <option value="SEMUA">Semua Tim</option>
                            <option value="SAFETY">Safety</option>
                            <option value="PENGAWAS">Pengawas</option>
                            <option value="MEDIS">Medis</option>
                        </select>
                    </div>
                    <div class="saklar-field">
                        <label>Area Kerja</label>
                        <select id="fArea">
                            <option value="SEMUA">Semua Area</option>
                        </select>
                    </div>
                    <div class="saklar-field flex items-end" style="gap:6px;">
                        <button class="btn-terapkan" id="btnMuat" type="button">Filter</button>
                        {{-- <button class="btn-terapkan hijau" id="btnExport" type="button">Export PDF</button> --}}
                    </div>
                </div>
                <div class="periode-aktif-line" id="rkpPeriodeLabel">Memuat periode…</div>
            </div>

            <!-- WRAPPER KONTEN -->
            <div class="rkp-wrap" id="rkpWrap">

                <!-- SECTION A: TABEL CAPAIAN -->
                <div class="rkp-panel">
                    <div class="rkp-panel-title">A. CAPAIAN KPI PER AKTIVITAS (hanya program aktif)</div>
                    <div style="overflow-x:auto;">
                        <table class="rkp-table" id="tblCapaian">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sumber<br>(Tim)</th>
                                    <th>Kode</th>
                                    <th>Nama Aktivitas</th>
                                    <th>Bobot<br>(%)</th>
                                    <th>Target/<br>Bln</th>
                                    <th>Jml Petugas<br>Ditugaskan</th>
                                    <th>Target<br>Periode</th>
                                    <th>Terkirim</th>
                                    <th>Disetujui</th>
                                    <th>% Capai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="11" class="rkp-loading">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- SECTION A: GRAFIK CAPAIAN -->
                <div class="rkp-panel">
                    <div class="rkp-panel-title">% CAPAI vs NAMA AKTIVITAS</div>
                    <div class="rkp-chart-box" style="height: 400px;">
                        <canvas id="chartCapaian"></canvas>
                    </div>
                </div>

                <!-- SECTION B: TABEL TEMUAN UA/UC -->
                <div class="rkp-panel">
                    <div class="rkp-panel-title">B. TEMUAN UNSAFE ACTION / UNSAFE CONDITION PER AREA</div>
                    <div style="overflow-x:auto;">
                        <table class="rkp-table" id="tblTemuan">
                            <thead>
                                <tr>
                                    <th>Area Kerja</th>
                                    <th class="num">Total Temuan</th>
                                    <th class="num">Unsafe Action</th>
                                    <th class="num">Unsafe Condition</th>
                                    <th class="num">% Unsafe Condition</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="rkp-loading">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- SECTION B: GRAFIK TEMUAN UA/UC -->
                <div class="rkp-panel">
                    <div class="rkp-panel-title">TEMUAN UA/UC PER AREA</div>
                    <div class="rkp-chart-box" style="height: 350px;">
                        <canvas id="chartTemuan"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const rkpBlue = '#2D4B9E';
        const rkpRed = '#D0021B';

        let chartCapaianInstance = null;
        let chartTemuanInstance = null;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function isiPilihanTahun() {
            const sel = document.getElementById('fTahun');
            const tahunSekarang = new Date().getFullYear();
            for (let y = tahunSekarang + 1; y >= tahunSekarang - 3; y--) {
                const opt = document.createElement('option');
                opt.value = y;
                opt.textContent = y;
                if (y === tahunSekarang) opt.selected = true;
                sel.appendChild(opt);
            }
            document.getElementById('fBulan').value = new Date().getMonth() + 1;
        }

        function rkpTimClass(tim) {
            return 'rkp-tim-' + tim;
        }

        function pillCapaian(persen) {
            const cls = persen >= 100 ? 'sc-tercapai' : 'sc-belum';
            return `<span class="status-capaian ${cls}">${persen.toFixed(1)}%</span>`;
        }

        function renderTabelCapaian(rows) {
            const tbody = document.querySelector('#tblCapaian tbody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    '<tr><td colspan="11" class="empty-state">Tidak ada data aktivitas untuk filter ini.</td></tr>';
                return;
            }
            tbody.innerHTML = rows.map(r => `
                <tr>
                    <td>${r.no}</td>
                    <td class="${rkpTimClass(r.sumber)}">${r.sumber.charAt(0) + r.sumber.slice(1).toLowerCase()}</td>
                    <td class="${rkpTimClass(r.sumber)}">${r.kode}</td>
                    <td style="font-weight:600;">${r.nama_aktivitas}</td>
                    <td class="num">${r.bobot.toFixed(1)}%</td>
                    <td class="num">${r.target_per_bulan}</td>
                    <td class="num">${r.jml_petugas_ditugaskan}</td>
                    <td class="num">${r.target_periode}</td>
                    <td class="num">${r.terkirim || '-'}</td>
                    <td class="num">${r.disetujui || '-'}</td>
                    <td class="num">${pillCapaian(r.persen_capai)}</td>
                </tr>
            `).join('');
        }

        function renderTabelTemuan(rows) {
            const tbody = document.querySelector('#tblTemuan tbody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    '<tr><td colspan="5" class="empty-state">Tidak ada temuan UA/UC untuk filter ini.</td></tr>';
                return;
            }
            tbody.innerHTML = rows.map(r => `
                <tr>
                    <td style="font-weight:600;">${r.area_kerja}</td>
                    <td class="num">${r.total_temuan || '-'}</td>
                    <td class="num">${r.unsafe_action || '-'}</td>
                    <td class="num">${r.unsafe_condition || '-'}</td>
                    <td class="num">${r.persen_unsafe_condition.toFixed(1)}%</td>
                </tr>
            `).join('');
        }

        function renderChartCapaian(rows) {
            const ctx = document.getElementById('chartCapaian');
            const labels = rows.map(r => r.nama_aktivitas);
            const data = rows.map(r => r.persen_capai);

            if (chartCapaianInstance) chartCapaianInstance.destroy();
            chartCapaianInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: '% Capai',
                        data,
                        backgroundColor: rkpBlue,
                        borderRadius: 3,
                        barThickness: 12,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: (c) => `${c.parsed.x.toFixed(1)}%`
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                callback: (v) => v + '%',
                                color: '#94A3B8'
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 10
                                },
                                color: '#475569'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        function renderChartTemuan(rows) {
            const ctx = document.getElementById('chartTemuan');
            const labels = rows.map(r => r.area_kerja);

            if (chartTemuanInstance) chartTemuanInstance.destroy();
            chartTemuanInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                            label: 'Unsafe Action',
                            data: rows.map(r => r.unsafe_action),
                            backgroundColor: rkpBlue,
                            borderRadius: 3
                        },
                        {
                            label: 'Unsafe Condition',
                            data: rows.map(r => r.unsafe_condition),
                            backgroundColor: rkpRed,
                            borderRadius: 3
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
                                boxWidth: 8,
                                boxHeight: 8,
                                font: {
                                    size: 10
                                },
                                color: '#64748B'
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 9
                                },
                                color: '#94A3B8'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#94A3B8'
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        }
                    }
                }
            });
        }

        function isiPilihanArea(areaOptions, areaTerpilih) {
            const sel = document.getElementById('fArea');
            const nilaiSebelumnya = areaTerpilih || sel.value || 'SEMUA';
            sel.innerHTML = '<option value="SEMUA">Semua Area</option>' +
                areaOptions.map(a => `<option value="${a}">${a}</option>`).join('');
            sel.value = nilaiSebelumnya;
        }

        async function muatDashboard() {
            const tahun = document.getElementById('fTahun').value;
            const bulan = document.getElementById('fBulan').value;
            const periodeType = document.getElementById('fPeriodeType').value;
            const tim = document.getElementById('fTim').value;
            const area = document.getElementById('fArea').value;

            const params = new URLSearchParams({
                tahun,
                bulan,
                periode_type: periodeType,
                tim,
                area
            });

            try {
                const res = await fetch(`{{ route('rekap-kpi-program.api') }}?${params.toString()}`);
                const json = await res.json();

                if (!res.ok) {
                    throw new Error(json.message || 'Gagal memuat data');
                }

                document.getElementById('rkpPeriodeLabel').innerHTML =
                    `Periode <b>${json.periode.periode_mulai} s/d ${json.periode.periode_selesai}</b> &nbsp;|&nbsp; Bulan <b>${json.periode.bulan_label}</b>`;

                isiPilihanArea(json.area_options, area);

                renderTabelCapaian(json.capaian_aktivitas);
                renderChartCapaian(json.capaian_aktivitas);

                renderTabelTemuan(json.temuan_ua_uc);
                renderChartTemuan(json.temuan_ua_uc);
            } catch (err) {
                console.error(err);
                document.querySelector('#tblCapaian tbody').innerHTML =
                    '<tr><td colspan="11" class="empty-state">Gagal memuat data. Coba lagi.</td></tr>';
                document.querySelector('#tblTemuan tbody').innerHTML =
                    '<tr><td colspan="5" class="empty-state">Gagal memuat data. Coba lagi.</td></tr>';
            }
        }

        function exportRekapToPDF() {
            const element = document.getElementById('rkpWrap');
            html2pdf().from(element).save();
        }

        document.getElementById('btnMuat').addEventListener('click', muatDashboard);
        // document.getElementById('btnExport').addEventListener('click', exportRekapToPDF);

        isiPilihanTahun();

        // Pastikan Chart.js sudah tersedia sebelum memuat data & menggambar chart.
        function pastikanChartJsSiap(callback) {
            if (typeof Chart !== 'undefined') {
                callback();
                return;
            }
            const existing = document.querySelector('script[data-rkp-chartjs]');
            if (existing) {
                existing.addEventListener('load', callback);
                return;
            }
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4';
            script.setAttribute('data-rkp-chartjs', '1');
            script.onload = callback;
            script.onerror = () => console.error('Gagal memuat Chart.js dari CDN.');
            document.head.appendChild(script);
        }

        pastikanChartJsSiap(muatDashboard);
    </script>
</body>

</html>
