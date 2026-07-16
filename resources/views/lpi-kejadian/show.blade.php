<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Detail LPI — PT. Fokus Jasa Mitra</title>
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

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11.5px;
            font-weight: 700;
            color: #64748B;
            text-decoration: none;
            margin-bottom: 8px;
        }

        .back-link:hover {
            color: #2D4B9E;
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

        .section-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 18px 20px;
            min-width: 0;
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

        .hamburger-btn {
            display: none;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #F8F9FF;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #1A1D2E;
            flex-shrink: 0;
        }

        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, 0.45);
            z-index: 40;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        #sidebar-overlay.open {
            display: block;
            opacity: 1;
        }

        @media (max-width: 1024px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.25s ease;
                box-shadow: 12px 0 32px rgba(0, 0, 0, 0.18);
            }

            #sidebar.open {
                transform: translateX(0);
            }

            .hamburger-btn {
                display: flex;
            }
        }

        @media (max-width: 640px) {
            #topbar {
                padding: 0 12px;
                gap: 8px;
            }

            .tb-name,
            .tb-caret {
                display: none;
            }

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
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, 0.5);
            backdrop-filter: blur(2px);
            z-index: 100;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
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
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.94) translateY(8px);
            transition: transform 0.2s ease;
        }

        .modal-overlay.open .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 8px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-modal-cancel {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            color: #64748B;
            cursor: pointer;
            transition: background 0.15s;
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
            transition: background 0.15s;
        }

        .btn-modal-confirm:hover {
            background: #1A3C8A;
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-left: 4px solid #1A7A3C;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.25s ease;
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
            background: rgba(26, 122, 60, 0.1);
            color: #1A7A3C;
            margin-top: 1px;
        }

        .toast-error .toast-icon {
            background: rgba(208, 2, 27, 0.1);
            color: #D0021B;
        }

        .toast-body {
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-size: 12.5px;
            font-weight: 800;
            color: #1A1D2E;
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
            line-height: 1;
            padding: 2px;
            flex-shrink: 0;
        }

        .form-modal-box {
            width: 640px;
            max-width: calc(100vw - 32px);
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .form-modal-header {
            margin-bottom: 14px;
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
            letter-spacing: 0.06em;
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
            border: 1px solid rgba(0, 0, 0, 0.09);
            background: #fff;
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            outline: none;
            transition: border 0.2s;
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
            -webkit-appearance: none;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.span-2 {
                grid-column: span 1;
            }
        }

        .detail-section {
            margin-bottom: 22px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #E2E8F0;
        }

        .detail-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-section-title {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #2D4B9E;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 12px;
        }

        .detail-form-grid,
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 16px;
        }

        .detail-field {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-field.span-2 {
            grid-column: span 2;
        }

        .detail-field.span-4 {
            grid-column: span 4;
        }

        .detail-field label {
            font-size: 11px;
            font-weight: 600;
            color: #94A3B8;
        }

        .detail-field .detail-value {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 500;
            color: #1E293B;
            min-height: 36px;
            white-space: pre-line;
        }

        .detail-field a.detail-link {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 600;
            color: #2D4B9E;
            text-decoration: none;
            display: block;
        }

        .detail-field a.detail-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 640px) {

            .detail-form-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }

            .detail-field.span-2,
            .detail-field.span-4 {
                grid-column: span 1;
            }
        }

        .picker-wrap {
            position: relative;
        }

        .picker-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            max-height: 220px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            z-index: 20;
        }

        .picker-dropdown.open {
            display: block;
        }

        .picker-item {
            padding: 8px 12px;
            cursor: pointer;
            font-size: 12px;
        }

        .picker-item:hover {
            background: #F0F4FF;
        }

        .picker-item-name {
            font-weight: 700;
            color: #1A1D2E;
        }

        .picker-item-sub {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
        }

        .picker-selected-chip {
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid rgba(45, 75, 158, 0.25);
            background: #F0F4FF;
            font-size: 12px;
        }

        .picker-selected-chip .chip-name {
            font-weight: 700;
            color: #1A1D2E;
        }

        .picker-selected-chip .chip-sub {
            font-size: 10.5px;
            color: #64748B;
        }

        .picker-clear-btn {
            background: none;
            border: none;
            color: #D0021B;
            cursor: pointer;
            font-size: 11.5px;
            font-weight: 700;
        }

        .file-current-link {
            display: inline-block;
            margin-top: 6px;
            font-size: 11px;
            font-weight: 700;
            color: #2D4B9E;
            text-decoration: none;
        }

        .file-current-link:hover {
            text-decoration: underline;
        }

        .korban-form-modal-box {
            max-width: 760px;
            width: 100%;
            max-height: 92vh;
        }

        .korban-list-item {
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .korban-list-item .kli-name {
            font-weight: 700;
            font-size: 13px;
            color: #1A1D2E;
        }

        .korban-list-item .kli-sub {
            font-size: 11px;
            color: #94A3B8;
            font-weight: 600;
            margin-top: 2px;
        }

        .badge-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 999px;
            background: #2D4B9E;
            color: #fff;
            font-size: 10.5px;
            font-weight: 800;
        }

        .dynamic-form-section-title {
            font-size: 11px;
            font-weight: 800;
            color: #2D4B9E;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin: 14px 0 8px;
        }

        .dynamic-form-section-title:first-child {
            margin-top: 0;
        }

        .two-col-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .detail-section-title svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
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
                <a href="{{ route('lpi-kejadian.index') }}" class="back-link">
                    <svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar LPI
                </a>
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:2px;">
                            <span class="pg-eyebrow">Detail Kejadian · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title" id="pgIdLpi">DETAIL <span>KEJADIAN LPI</span></div>
                        <div class="pg-sub" id="pgOwnerSub">Memuat data...</div>
                    </div>
                    <div class="pg-actions">
                       
                        <button class="btn-primary" onclick="openKorbanFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Korban
                        </button>
                    </div>
                </div>
            </div>

            <div id="detailLoadingState">
                <div class="section-card" style="margin-bottom:14px;">
                    <div class="skeleton-bar" style="width:100%;height:100px;"></div>
                </div>
            </div>

            <div id="detailContent" style="display:none;">

                <!-- ══════ CARD DETAIL KEJADIAN ══════ -->
                <div class="section-card" style="margin-bottom:14px;">

                    <div class="detail-section">
                        <div class="detail-section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Waktu & Lokasi
                        </div>
                        <div class="form-grid" id="detailWaktuGrid"></div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Uraian & Evidence
                        </div>
                        <div class="form-grid" id="detailUraianGrid"></div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2m9-8a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kerugian & PICA
                        </div>
                        <div class="form-grid" id="detailPicaGrid"></div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-section-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Investigasi & Status
                        </div>
                        <div class="form-grid" id="detailInvestigasiGrid"></div>
                    </div>

                </div>

                <!-- ══════ CARD DATA KORBAN ══════ -->
                <div class="section-card">
                    <div class="detail-section-title" style="margin-bottom:14px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-8a4 4 0 110 8 4 4 0 010-8zm0 8a4 4 0 018 0v2H9v-2a4 4 0 018 0" />
                        </svg>
                        Data Korban
                        <span class="badge-count" id="korbanCountBadge">0</span>
                    </div>

                    <div id="korbanListContainer">
                        <div class="skeleton-bar" style="width:100%;height:60px;"></div>
                    </div>
                </div>

            </div>

            <div id="detailErrorState" style="display:none;">
                <div class="section-card">
                    <div class="error-state">
                        <div class="error-state-title">Gagal memuat data</div>
                        <div class="error-state-sub" id="detailErrorMessage">Terjadi kesalahan.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ══════ MODAL EDIT KEJADIAN ══════ -->
    <div id="kejadianModalOverlay" class="modal-overlay" onclick="closeKejadianEditModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title">Edit Kejadian LPI</div>
                <div class="pg-sub" style="margin:0;">Perbarui data kejadian insiden.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Identitas Laporan</div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">ID LPI</label><input type="text"
                            id="kId_lpi" class="form-input" placeholder="002/LPI/K3/FJM/I/2026" /></div>
                    <div class="form-group"><label class="form-label">Owner User</label><input type="text"
                            id="kOwner_user" class="form-input" placeholder="PT. PETRO GRAHA MEDIKA" /></div>
                    <div class="form-group"><label class="form-label">Tanggal Insiden</label><input type="date"
                            id="kTanggal_insiden" class="form-input" onchange="autoFillHari()" /></div>
                    <div class="form-group"><label class="form-label">Hari Insiden</label><input type="text"
                            id="kHari_insiden" class="form-input" placeholder="SELASA" /></div>
                    <div class="form-group"><label class="form-label">Jam Insiden</label><input type="time"
                            id="kJam_insiden" class="form-input" /></div>
                    <div class="form-group">
                        <label class="form-label">Jam Insiden pada Shift</label>
                        <select id="kJam_insiden_shift" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="PAGI">PAGI</option>
                            <option value="SIANG">SIANG</option>
                            <option value="SORE">SORE</option>
                            <option value="MALAM">MALAM</option>
                        </select>
                    </div>
                </div>

                <div class="form-section-title">Lokasi Kejadian</div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Zona Lokasi Insiden</label><input
                            type="text" id="kZona_lokasi_insiden" class="form-input" placeholder="PG Zona V" />
                    </div>
                    <div class="form-group"><label class="form-label">Sub Lokasi Insiden</label><input type="text"
                            id="kSub_lokasi_insiden" class="form-input" /></div>
                    <div class="form-group span-2"><label class="form-label">Detail Lokasi Insiden</label><input
                            type="text" id="kDetail_lokasi_insiden" class="form-input"
                            placeholder="DEPAN IGD RSPG" /></div>
                    <div class="form-group span-2"><label class="form-label">Uraian Kejadian</label>
                        <textarea id="kUraian_kejadian" class="form-textarea" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-section-title">Evidence & Lampiran</div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Evidence 1</label><input type="file"
                            id="kEvidence_1" class="form-input" style="padding:8px 12px; height:auto;" />
                            href="#" id="kEvidence_1Current" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file ↗</a></div>
                    <div class="form-group"><label class="form-label">Evidence 2</label><input type="file"
                            id="kEvidence_2" class="form-input" style="padding:8px 12px; height:auto;" />
                            href="#" id="kEvidence_2Current" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file ↗</a></div>
                    <div class="form-group"><label class="form-label">Evidence 3</label><input type="file"
                            id="kEvidence_3" class="form-input" style="padding:8px 12px; height:auto;" />
                            href="#" id="kEvidence_3Current" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file ↗</a></div>
                    <div class="form-group"><label class="form-label">Evidence 4</label><input type="file"
                            id="kEvidence_4" class="form-input" style="padding:8px 12px; height:auto;" />
                            href="#" id="kEvidence_4Current" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file ↗</a></div>
                    <div class="form-group"><label class="form-label">Evidence 5</label><input type="file"
                            id="kEvidence_5" class="form-input" style="padding:8px 12px; height:auto;" />
                            href="#" id="kEvidence_5Current" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file ↗</a></div>
                    <div class="form-group"><label class="form-label">Lampiran Dokumen</label><input type="file"
                            id="kLampiran_dokumen" class="form-input" style="padding:8px 12px; height:auto;" />
                            href="#" id="kLampiran_dokumenCurrent" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file ↗</a></div>
                </div>

                <div class="form-section-title">Kerugian & PICA</div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Nominal Kerugian Material (Rp)</label><input
                            type="number" id="kNominal_kerugian_material" class="form-input" min="0"
                            step="1000" /></div>
                    <div class="form-group"><label class="form-label">Total Cost Lost (Rp)</label><input
                            type="number" id="kTotal_cost_lost" class="form-input" min="0"
                            step="1000" /></div>
                    <div class="form-group span-2"><label class="form-label">PICA — Tindakan Perbaikan</label>
                        <textarea id="kPica_tindakan_perbaikan" class="form-textarea" rows="2"></textarea>
                    </div>
                    <div class="form-group"><label class="form-label">PICA — PIC Bertanggung Jawab</label><input
                            type="text" id="kPica_pic_bertanggung_jawab" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">PICA — Due Date</label><input type="date"
                            id="kPica_due_date" class="form-input" /></div>
                </div>

                <div class="form-section-title">Investigasi & Status</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Tingkat Risiko</label>
                        <select id="kTingkat_risiko" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="LOW">LOW</option>
                            <option value="MEDIUM">MEDIUM</option>
                            <option value="HIGH">HIGH</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Penyelesaian LPI</label>
                        <select id="kStatus_penyelesaian_lpi" class="form-select">
                            <option value="OPEN">OPEN</option>
                            <option value="CLOSE">CLOSE</option>
                        </select>
                    </div>
                    <div class="form-group span-2"><label class="form-label">Hasil Investigasi (Root Cause)</label>
                        <textarea id="kHasil_investigasi_root_cause" class="form-textarea" rows="2"></textarea>
                    </div>
                    <div class="form-group span-2"><label class="form-label">Status Pelaporan LPI</label><input
                            type="text" id="kStatus_pelaporan_lpi" class="form-input" placeholder="USER/OWNER" />
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeKejadianEditModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitKejadian" onclick="submitKejadian()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL FORM KORBAN (data-driven, single level) ══════ -->
    <div class="modal-overlay" id="korbanFormModalOverlay" onclick="closeKorbanFormModalOutside(event)">
        <div class="modal-box korban-form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="korbanFormTitle">Tambah Data Korban</div>
                <div class="pg-sub" style="margin:0;">Lengkapi data korban & analisis penyebab insiden.</div>
            </div>

            <div class="form-modal-body" id="korbanFormBody" style="max-height:65vh;"></div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeKorbanFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitKorban" onclick="submitKorban()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL KONFIRMASI ══════ -->
    <div class="modal-overlay" id="confirmModalOverlay" onclick="closeConfirmModalOutside(event)">
        <div class="modal-box" style="max-width:430px;" onclick="event.stopPropagation()">
            <div class="modal-title" id="confirmModalTitle">Konfirmasi</div>
            <div id="confirmModalMessage" style="margin-top:12px; color:#64748B; font-size:14px; line-height:1.7;">
            </div>
            <div class="modal-actions" style="margin-top:20px;">
                <button class="btn-modal-cancel" onclick="closeConfirmModal()">Batal</button>
                <button class="btn-modal-confirm" id="confirmModalButton">Ya</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL KORBAN (read-only) ══════ -->
    <div class="modal-overlay" id="korbanDetailModalOverlay" onclick="closeKorbanDetailModalOutside(event)">
        <div class="modal-box korban-form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="korbanDetailTitle">Detail Data Korban</div>
                <div class="pg-sub" style="margin:0;">Informasi lengkap korban & analisis penyebab insiden.</div>
            </div>

            <div class="form-modal-body" id="korbanDetailBody" style="max-height:65vh;"></div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeKorbanDetailModal()">Tutup</button>
                <button class="btn-modal-confirm" onclick="editFromKorbanDetail()">Edit Data</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const KEJADIAN_ID = {{ $id }};
        const KEJADIAN_BASE_ENDPOINT = "{{ url('/lpi-kejadian') }}";
        const KEJADIAN_DETAIL_ENDPOINT = `${KEJADIAN_BASE_ENDPOINT}/${KEJADIAN_ID}/detail`;
        const KORBAN_BASE_ENDPOINT = "{{ url('/lpi-korban') }}";
        const CARI_KARYAWAN_ENDPOINT = "{{ route('lpi-korban.cari-karyawan') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        let currentKejadian = null;
        let currentEditKorbanId = null;
        let activeKaryawanPickerTarget = null;
        let karyawanPickerDebounce = null;
        let confirmAction = null;

        // ══════ UTIL ══════
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function formatDate(d) {
            if (!d) return '-';
            const dt = new Date(d);
            return isNaN(dt.getTime()) ? d : dt.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function formatRupiah(n) {
            if (n === null || n === undefined || n === '') return '-';
            return 'Rp' + Number(n).toLocaleString('id-ID');
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            toast.innerHTML =
                `<div class="toast-icon">${type === 'error' ? '✕' : '✓'}</div><div><div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div><div class="toast-msg">${escapeHtml(message)}</div></div><button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        function openConfirmModal(title, message, callback) {
            document.getElementById('confirmModalTitle').textContent = title;
            document.getElementById('confirmModalMessage').textContent = message;
            confirmAction = callback;
            document.getElementById('confirmModalOverlay').classList.add('open');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModalOverlay').classList.remove('open');
            confirmAction = null;
        }

        function closeConfirmModalOutside(e) {
            if (e.target.id === 'confirmModalOverlay') closeConfirmModal();
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('confirmModalButton').addEventListener('click', async () => {
                if (confirmAction) await confirmAction();
                closeConfirmModal();
            });
            loadDetail();
        });

        function autoFillHari() {
            const val = document.getElementById('kTanggal_insiden').value;
            if (!val) return;
            const hariList = ['MINGGU', 'SENIN', 'SELASA', 'RABU', 'KAMIS', "JUM'AT", 'SABTU'];
            document.getElementById('kHari_insiden').value = hariList[new Date(val).getDay()];
        }

        // ══════ LOAD DETAIL ══════
        async function loadDetail() {
            document.getElementById('detailLoadingState').style.display = 'block';
            document.getElementById('detailContent').style.display = 'none';
            document.getElementById('detailErrorState').style.display = 'none';
            try {
                const res = await fetch(KEJADIAN_DETAIL_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error((await res.json().catch(() => null))?.message || `Status ${res.status}`);
                const json = await res.json();
                currentKejadian = json.data;
                renderDetail(currentKejadian);
                renderKorbanList(currentKejadian.korban ?? []);
                document.getElementById('detailLoadingState').style.display = 'none';
                document.getElementById('detailContent').style.display = 'block';
            } catch (e) {
                document.getElementById('detailLoadingState').style.display = 'none';
                document.getElementById('detailErrorState').style.display = 'block';
                document.getElementById('detailErrorMessage').textContent = e.message || 'Terjadi kesalahan.';
            }
        }

        function renderDetail(row) {
            document.getElementById('pgIdLpi').innerHTML = `<span>${escapeHtml(row.id_lpi)}</span>`;
            document.getElementById('pgOwnerSub').textContent = row.owner_user || '-';
            document.getElementById('korbanCountBadge').textContent = row.korban_count ?? (row.korban ?
                row.korban.length : 0);

            const waktu = [{
                    label: 'Tanggal Insiden',
                    value: formatDate(row.tanggal_insiden)
                },
                {
                    label: 'Hari Insiden',
                    value: row.hari_insiden || '-'
                },
                {
                    label: 'Jam Insiden',
                    value: row.jam_insiden || '-'
                },
                {
                    label: 'Shift',
                    value: row.jam_insiden_shift || '-'
                },
                {
                    label: 'Zona Lokasi',
                    value: row.zona_lokasi_insiden || '-'
                },
                {
                    label: 'Sub Lokasi',
                    value: row.sub_lokasi_insiden || '-'
                },
                {
                    label: 'Detail Lokasi',
                    value: row.detail_lokasi_insiden || '-',
                    span: 2
                },
            ];
            document.getElementById('detailWaktuGrid').innerHTML = waktu.map(f =>
                `<div class="detail-field${f.span ? ' span-' + f.span : ''}"><label>${f.label}</label><div class="detail-value">${escapeHtml(f.value)}</div></div>`
            ).join('');

            const evidenceLinks = ['evidence_1_url', 'evidence_2_url', 'evidence_3_url', 'evidence_4_url', 'evidence_5_url',
                    'lampiran_dokumen_url'
                ]
                .map((f, i) => row[f] ?
                    `<a class="detail-link" style="margin-bottom:6px;" href="${escapeHtml(row[f])}" target="_blank">Buka ${i < 5 ? 'Evidence ' + (i + 1) : 'Lampiran'} ↗</a>` :
                    '').join('') || '<div class="detail-value" style="color:#CBD5E1;">Belum ada evidence</div>';

            document.getElementById('detailUraianGrid').innerHTML = `
                <div class="detail-field span-2"><label>Uraian Kejadian</label><div class="detail-value">${escapeHtml(row.uraian_kejadian || '-')}</div></div>
                <div class="detail-field span-2"><label>Evidence & Lampiran</label>${evidenceLinks}</div>
            `;

            document.getElementById('detailPicaGrid').innerHTML = `
                <div class="detail-field"><label>Nominal Kerugian Material</label><div class="detail-value">${formatRupiah(row.nominal_kerugian_material)}</div></div>
                <div class="detail-field"><label>Total Cost Lost</label><div class="detail-value">${formatRupiah(row.total_cost_lost)}</div></div>
                <div class="detail-field span-2"><label>PICA — Tindakan Perbaikan</label><div class="detail-value">${escapeHtml(row.pica_tindakan_perbaikan || '-')}</div></div>
                <div class="detail-field"><label>PICA — PIC</label><div class="detail-value">${escapeHtml(row.pica_pic_bertanggung_jawab || '-')}</div></div>
                <div class="detail-field"><label>PICA — Due Date</label><div class="detail-value">${formatDate(row.pica_due_date)}</div></div>
            `;

            document.getElementById('detailInvestigasiGrid').innerHTML = `
                <div class="detail-field"><label>Tingkat Risiko</label><div class="detail-value">${escapeHtml(row.tingkat_risiko || '-')}</div></div>
                <div class="detail-field"><label>Status Penyelesaian LPI</label><div class="detail-value">${escapeHtml(row.status_penyelesaian_lpi || '-')}</div></div>
                <div class="detail-field"><label>Status Pelaporan LPI</label><div class="detail-value">${escapeHtml(row.status_pelaporan_lpi || '-')}</div></div>
                <div class="detail-field span-2"><label>Hasil Investigasi (Root Cause)</label><div class="detail-value">${escapeHtml(row.hasil_investigasi_root_cause || '-')}</div></div>
            `;
        }

        function renderKorbanList(list) {
            const container = document.getElementById('korbanListContainer');
            if (!list || list.length === 0) {
                container.innerHTML =
                    `<div class="empty-state"><div class="empty-state-title">Belum ada data korban</div></div>`;
                return;
            }
            window.__lastKorbanList = list;
            container.innerHTML = list.map(k => `
                <div class="korban-list-item">
                    <div>
                        <div class="kli-name">${escapeHtml(k.nama_korban || '-')}</div>
                        <div class="kli-sub">${escapeHtml(k.badge_korban || '-')} · ${escapeHtml(k.jabatan || '-')} · ${escapeHtml(k.klasifikasi_insiden || '-')}</div>
                    </div>
                    <div style="display:flex; gap:6px;">
                        <button class="btn-outline" style="padding:5px 8px;" onclick="openKorbanDetailModal(${k.id})">Detail</button>
                        <button class="btn-outline" style="padding:5px 8px;" onclick="openKorbanFormModal(${k.id})">Edit</button>
                        <button class="btn-outline" style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);" onclick="deleteKorban(${k.id}, ${JSON.stringify(k.nama_korban || 'data ini')})">Hapus</button>
                    </div>
                </div>
            `).join('');
        }

        // ══════ MODAL EDIT KEJADIAN ══════
        const KEJADIAN_FILE_FIELDS = ['evidence_1', 'evidence_2', 'evidence_3', 'evidence_4', 'evidence_5',
            'lampiran_dokumen'
        ];
        const KEJADIAN_TEXT_MAP = {
            kId_lpi: 'id_lpi',
            kOwner_user: 'owner_user',
            kTanggal_insiden: 'tanggal_insiden',
            kHari_insiden: 'hari_insiden',
            kJam_insiden: 'jam_insiden',
            kJam_insiden_shift: 'jam_insiden_shift',
            kZona_lokasi_insiden: 'zona_lokasi_insiden',
            kSub_lokasi_insiden: 'sub_lokasi_insiden',
            kDetail_lokasi_insiden: 'detail_lokasi_insiden',
            kUraian_kejadian: 'uraian_kejadian',
            kNominal_kerugian_material: 'nominal_kerugian_material',
            kTotal_cost_lost: 'total_cost_lost',
            kPica_tindakan_perbaikan: 'pica_tindakan_perbaikan',
            kPica_pic_bertanggung_jawab: 'pica_pic_bertanggung_jawab',
            kPica_due_date: 'pica_due_date',
            kTingkat_risiko: 'tingkat_risiko',
            kHasil_investigasi_root_cause: 'hasil_investigasi_root_cause',
            kStatus_penyelesaian_lpi: 'status_penyelesaian_lpi',
            kStatus_pelaporan_lpi: 'status_pelaporan_lpi',
        };

        function setCurrentFileLink(id, url) {
            const el = document.getElementById(id);
            if (url) {
                el.href = url;
                el.style.display = 'inline-block';
            } else {
                el.style.display = 'none';
            }
        }

        function openKejadianEditModal() {
            if (!currentKejadian) return;
            const row = currentKejadian;

            Object.entries(KEJADIAN_TEXT_MAP).forEach(([elId, field]) => {
                document.getElementById(elId).value = row?.[field] ?? (field === 'status_penyelesaian_lpi' ?
                    'OPEN' : '');
            });

            KEJADIAN_FILE_FIELDS.forEach(f => {
                const inputId = 'k' + f.split('_').map((segment, index) => index === 0 ? segment.charAt(0)
                    .toUpperCase() + segment.slice(1) : segment).join('_');
                const input = document.getElementById(inputId);
                if (input) input.value = '';
                setCurrentFileLink(inputId + 'Current', row?.[f + '_url']);
            });

            document.getElementById('kejadianModalOverlay').classList.add('open');
        }

        function closeKejadianEditModal() {
            document.getElementById('kejadianModalOverlay').classList.remove('open');
        }

        function closeKejadianEditModalOutside(e) {
            if (e.target.id === 'kejadianModalOverlay') closeKejadianEditModal();
        }

        async function submitKejadian() {
            const btn = document.getElementById('btnSubmitKejadian');
            const idLpi = document.getElementById('kId_lpi').value.trim();
            if (!idLpi) {
                showToast('ID LPI wajib diisi.', 'error');
                return;
            }

            btn.disabled = true;
            const originalText = btn.textContent;
            btn.textContent = 'Menyimpan...';

            const formData = new FormData();
            Object.entries(KEJADIAN_TEXT_MAP).forEach(([elId, field]) => {
                formData.append(field, document.getElementById(elId).value || '');
            });
            KEJADIAN_FILE_FIELDS.forEach(f => {
                const inputId = 'k' + f.replace(/(^|_)([a-z])/g, (_, p1, p2) => p2.toUpperCase());
                const input = document.getElementById(inputId);
                if (input && input.files.length > 0) {
                    formData.append(f, input.files[0]);
                }
            });
            formData.append('_method', 'PUT');

            try {
                const res = await fetch(`${KEJADIAN_BASE_ENDPOINT}/${KEJADIAN_ID}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: formData
                });
                const json = await res.json();
                if (!res.ok) {
                    const firstError = json.errors ? Object.values(json.errors)[0][0] : null;
                    throw new Error(firstError || json.message || `Status ${res.status}`);
                }
                closeKejadianEditModal();
                await loadDetail();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan data.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ══════ FORM KORBAN — data-driven ══════
        const KORBAN_FIELDS = [{
                section: 'Klasifikasi & Saksi',
                fields: [{
                        key: 'klasifikasi_insiden',
                        label: 'Klasifikasi Insiden',
                        type: 'text',
                        placeholder: 'MTI / FAC / NM'
                    },
                    {
                        key: '__saksi_fjm_picker',
                        label: 'Saksi Karyawan FJM',
                        type: 'picker_saksi'
                    },
                    {
                        key: 'nama_saksi_karyawan_non_fjm',
                        label: 'Nama Saksi Non-FJM',
                        type: 'text'
                    },
                ]
            },
            {
                section: 'Data Korban',
                fields: [{
                        key: 'pt_asal_korban',
                        label: 'PT Asal Korban',
                        type: 'text'
                    },
                    {
                        key: '__korban_picker',
                        label: 'Nama Korban (Karyawan)',
                        type: 'picker_korban'
                    },
                    {
                        key: 'alamat',
                        label: 'Alamat',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'jenis_kelamin',
                        label: 'Jenis Kelamin',
                        type: 'select',
                        options: ['L', 'P']
                    },
                    {
                        key: 'usia',
                        label: 'Usia',
                        type: 'number'
                    },
                    {
                        key: 'masa_kerja',
                        label: 'Masa Kerja (tahun)',
                        type: 'text'
                    },
                    {
                        key: 'shift',
                        label: 'Shift',
                        type: 'text'
                    },
                    {
                        key: 'departemen',
                        label: 'Departemen',
                        type: 'text'
                    },
                    {
                        key: 'unit_kerja',
                        label: 'Unit Kerja',
                        type: 'text'
                    },
                    {
                        key: 'jabatan',
                        label: 'Jabatan',
                        type: 'text'
                    },
                    {
                        key: 'kode_ok',
                        label: 'Kode OK',
                        type: 'text'
                    },
                    {
                        key: 'uraian_pekerjaan',
                        label: 'Uraian Pekerjaan',
                        type: 'textarea',
                        span: 2
                    },
                ]
            },
            {
                section: 'Jenis Insiden & Alat',
                fields: [{
                        key: 'jenis_insiden',
                        label: 'Jenis Insiden',
                        type: 'text'
                    },
                    {
                        key: 'penjelasan_jenis_insiden',
                        label: 'Penjelasan Jenis Insiden',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'keterlibatan_alat',
                        label: 'Keterlibatan Alat',
                        type: 'text'
                    },
                    {
                        key: 'keterangan_alat_lain',
                        label: 'Keterangan Alat Lain-lain',
                        type: 'text'
                    },
                    {
                        key: 'nomor_alat',
                        label: 'Nomor Alat',
                        type: 'text'
                    },
                    {
                        key: 'status_milik_alat_unit',
                        label: 'Status Milik Alat/Unit',
                        type: 'text'
                    },
                ]
            },
            {
                section: 'Analisis — Unsafe Action',
                fields: [{
                        key: 'tindakan_tidak_aman',
                        label: 'Tindakan Tidak Aman',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'ua_sebab_1',
                        label: 'Sebab 1',
                        type: 'textarea'
                    },
                    {
                        key: 'ua_sebab_2',
                        label: 'Sebab 2',
                        type: 'textarea'
                    },
                    {
                        key: 'ua_sebab_3',
                        label: 'Sebab 3',
                        type: 'textarea'
                    },
                ]
            },
            {
                section: 'Analisis — Unsafe Condition',
                fields: [{
                        key: 'kondisi_tidak_aman',
                        label: 'Kondisi Tidak Aman',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'uc_sebab_1',
                        label: 'Sebab 1',
                        type: 'textarea'
                    },
                    {
                        key: 'uc_sebab_2',
                        label: 'Sebab 2',
                        type: 'textarea'
                    },
                    {
                        key: 'uc_sebab_3',
                        label: 'Sebab 3',
                        type: 'textarea'
                    },
                ]
            },
            {
                section: 'Analisis — Faktor Pribadi',
                fields: [{
                        key: 'faktor_pribadi',
                        label: 'Faktor Pribadi',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'fp_sebab_1',
                        label: 'Sebab 1',
                        type: 'textarea'
                    },
                    {
                        key: 'fp_sebab_2',
                        label: 'Sebab 2',
                        type: 'textarea'
                    },
                    {
                        key: 'fp_sebab_3',
                        label: 'Sebab 3',
                        type: 'textarea'
                    },
                ]
            },
            {
                section: 'Analisis — Faktor Pekerjaan',
                fields: [{
                        key: 'faktor_pekerjaan',
                        label: 'Faktor Pekerjaan',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'fk_sebab_1',
                        label: 'Sebab 1',
                        type: 'textarea'
                    },
                    {
                        key: 'fk_sebab_2',
                        label: 'Sebab 2',
                        type: 'textarea'
                    },
                    {
                        key: 'fk_sebab_3',
                        label: 'Sebab 3',
                        type: 'textarea'
                    },
                ]
            },
            {
                section: 'Sistem Manajemen',
                fields: [{
                        key: 'sistem_manajemen_terkait',
                        label: 'Nomor & Judul Prosedur',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'deskripsi_kegagalan_sistem',
                        label: 'Deskripsi Kegagalan Sistem',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'penyebab_kegagalan_sistem',
                        label: 'Penyebab Kegagalan Sistem',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'sebab_sebab_teridentifikasi',
                        label: 'Sebab-sebab Teridentifikasi',
                        type: 'textarea',
                        span: 2
                    },
                ]
            },
            {
                section: 'Pengendalian Risiko',
                fields: [{
                        key: 'pengendalian_risiko',
                        label: 'Pengendalian Risiko',
                        type: 'text',
                        span: 2
                    },
                    {
                        key: 'penjelasan_pengendalian_risiko',
                        label: 'Penjelasan Pengendalian Risiko',
                        type: 'textarea',
                        span: 2
                    },
                ]
            },
            {
                section: 'Cidera & Penanganan Medis',
                fields: [{
                        key: 'rincian_cidera',
                        label: 'Rincian Cidera',
                        type: 'text'
                    },
                    {
                        key: 'persentase_luka_bakar',
                        label: 'Persentase Luka Bakar (%)',
                        type: 'number'
                    },
                    {
                        key: 'keterangan_detail_cidera',
                        label: 'Keterangan Detail Cidera',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'kategori_penanganan_medis',
                        label: 'Kategori Penanganan Medis',
                        type: 'text'
                    },
                    {
                        key: 'keterangan_penanganan_medis',
                        label: 'Keterangan Penanganan Medis',
                        type: 'textarea',
                        span: 2
                    },
                    {
                        key: 'nama_dokter',
                        label: 'Nama Dokter',
                        type: 'text'
                    },
                    {
                        key: 'total_hari_kerja_hilang',
                        label: 'Total Hari Kerja Hilang',
                        type: 'number'
                    },
                    {
                        key: 'nominal_biaya_medis',
                        label: 'Nominal Biaya Medis (Rp)',
                        type: 'number'
                    },
                    {
                        key: 'penjamin_platform',
                        label: 'Penjamin / Platform',
                        type: 'text'
                    },
                ]
            },
        ];

        function fieldInputId(key) {
            return 'korban_' + key;
        }

        function renderKorbanFormFields() {
            const body = document.getElementById('korbanFormBody');
            body.innerHTML = KORBAN_FIELDS.map(section => `
                <div class="dynamic-form-section-title">${section.section}</div>
                <div class="form-grid">
                    ${section.fields.map(f => renderKorbanField(f)).join('')}
                </div>
            `).join('');
        }

        function renderKorbanField(f) {
            const spanClass = f.span ? ` span-${f.span}` : '';
            const id = fieldInputId(f.key);

            if (f.type === 'picker_korban') {
                return `<div class="form-group span-2">
                    <label class="form-label">${f.label}</label>
                    <div class="picker-wrap" id="korbanPickerWrap">
                        <input type="text" id="korbanPickerInput" class="form-input" placeholder="Cari nama atau badge karyawan..." oninput="onKaryawanPickerInput('korban')" autocomplete="off" />
                        <div class="picker-dropdown" id="korbanPickerDropdown"></div>
                    </div>
                    <div class="picker-selected-chip" id="korbanSelectedChip" style="display:none;">
                        <div><div class="chip-name" id="korbanSelectedName">-</div><div class="chip-sub" id="korbanSelectedSub">-</div></div>
                        <button type="button" class="picker-clear-btn" onclick="clearKaryawanPicker('korban')">Ganti</button>
                    </div>
                    <input type="hidden" id="${fieldInputId('badge_korban')}" />
                    <input type="hidden" id="${fieldInputId('nama_korban')}" />
                </div>`;
            }
            if (f.type === 'picker_saksi') {
                return `<div class="form-group span-2">
                    <label class="form-label">${f.label}</label>
                    <div class="picker-wrap" id="saksiPickerWrap">
                        <input type="text" id="saksiPickerInput" class="form-input" placeholder="Cari nama atau badge karyawan..." oninput="onKaryawanPickerInput('saksi')" autocomplete="off" />
                        <div class="picker-dropdown" id="saksiPickerDropdown"></div>
                    </div>
                    <div class="picker-selected-chip" id="saksiSelectedChip" style="display:none;">
                        <div><div class="chip-name" id="saksiSelectedName">-</div><div class="chip-sub" id="saksiSelectedSub">-</div></div>
                        <button type="button" class="picker-clear-btn" onclick="clearKaryawanPicker('saksi')">Ganti</button>
                    </div>
                    <input type="hidden" id="${fieldInputId('badge_saksi_karyawan_fjm')}" />
                    <input type="hidden" id="${fieldInputId('nama_saksi_karyawan_fjm')}" />
                </div>`;
            }
            if (f.type === 'textarea') {
                return `<div class="form-group${spanClass}"><label class="form-label">${f.label}</label><textarea id="${id}" class="form-textarea" rows="2"></textarea></div>`;
            }
            if (f.type === 'select') {
                return `<div class="form-group${spanClass}"><label class="form-label">${f.label}</label><select id="${id}" class="form-select"><option value="">-- Pilih --</option>${f.options.map(o => `<option value="${o}">${o}</option>`).join('')}</select></div>`;
            }
            return `<div class="form-group${spanClass}"><label class="form-label">${f.label}</label><input type="${f.type}" id="${id}" class="form-input" placeholder="${f.placeholder || ''}" /></div>`;
        }

        function flatKorbanKeys() {
            return KORBAN_FIELDS.flatMap(s => s.fields).filter(f => !f.type.startsWith('picker_')).map(f => f.key);
        }

        // ══════ PICKER KARYAWAN (dipakai untuk korban & saksi) ══════
        function onKaryawanPickerInput(target) {
            activeKaryawanPickerTarget = target;
            clearTimeout(karyawanPickerDebounce);
            karyawanPickerDebounce = setTimeout(() => searchKaryawanPicker(target), 350);
        }

        async function searchKaryawanPicker(target) {
            const inputId = target === 'korban' ? 'korbanPickerInput' : 'saksiPickerInput';
            const dropdownId = target === 'korban' ? 'korbanPickerDropdown' : 'saksiPickerDropdown';
            const search = document.getElementById(inputId).value.trim();
            const dropdown = document.getElementById(dropdownId);
            if (search.length < 2) {
                dropdown.classList.remove('open');
                return;
            }
            try {
                const res = await fetch(`${CARI_KARYAWAN_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                dropdown.innerHTML = (!json.data || json.data.length === 0) ?
                    `<div class="picker-item" style="color:#94A3B8;">Tidak ada karyawan ditemukan.</div>` :
                    json.data.map(t =>
                        `<div class="picker-item" onclick='pilihKaryawan("${target}", ${JSON.stringify(t).replace(/'/g, "&#39;")})'><div class="picker-item-name">${escapeHtml(t.nama)}</div><div class="picker-item-sub">${escapeHtml(t.badge)} · ${escapeHtml(t.unit_kerja)}</div></div>`
                    ).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihKaryawan(target, t) {
            if (target === 'korban') {
                document.getElementById(fieldInputId('badge_korban')).value = t.badge;
                document.getElementById(fieldInputId('nama_korban')).value = t.nama;
                if (!document.getElementById(fieldInputId('unit_kerja')).value) document.getElementById(fieldInputId(
                    'unit_kerja')).value = t.unit_kerja;
                if (!document.getElementById(fieldInputId('departemen')).value) document.getElementById(fieldInputId(
                    'departemen')).value = t.departemen;
                if (!document.getElementById(fieldInputId('jabatan')).value) document.getElementById(fieldInputId(
                    'jabatan')).value = t.jabatan;
                document.getElementById('korbanSelectedName').textContent = t.nama;
                document.getElementById('korbanSelectedSub').textContent = t.badge;
                document.getElementById('korbanSelectedChip').style.display = 'flex';
                document.getElementById('korbanPickerWrap').style.display = 'none';
                document.getElementById('korbanPickerDropdown').classList.remove('open');
            } else {
                document.getElementById(fieldInputId('badge_saksi_karyawan_fjm')).value = t.badge;
                document.getElementById(fieldInputId('nama_saksi_karyawan_fjm')).value = t.nama;
                document.getElementById('saksiSelectedName').textContent = t.nama;
                document.getElementById('saksiSelectedSub').textContent = t.badge;
                document.getElementById('saksiSelectedChip').style.display = 'flex';
                document.getElementById('saksiPickerWrap').style.display = 'none';
                document.getElementById('saksiPickerDropdown').classList.remove('open');
            }
        }

        function clearKaryawanPicker(target) {
            if (target === 'korban') {
                document.getElementById(fieldInputId('badge_korban')).value = '';
                document.getElementById(fieldInputId('nama_korban')).value = '';
                document.getElementById('korbanPickerInput').value = '';
                document.getElementById('korbanSelectedChip').style.display = 'none';
                document.getElementById('korbanPickerWrap').style.display = 'block';
            } else {
                document.getElementById(fieldInputId('badge_saksi_karyawan_fjm')).value = '';
                document.getElementById(fieldInputId('nama_saksi_karyawan_fjm')).value = '';
                document.getElementById('saksiPickerInput').value = '';
                document.getElementById('saksiSelectedChip').style.display = 'none';
                document.getElementById('saksiPickerWrap').style.display = 'block';
            }
        }

        document.addEventListener('click', (e) => {
            ['korbanPickerWrap', 'saksiPickerWrap'].forEach(wrapId => {
                const wrap = document.getElementById(wrapId);
                const dropdownId = wrapId === 'korbanPickerWrap' ? 'korbanPickerDropdown' :
                    'saksiPickerDropdown';
                if (wrap && !wrap.contains(e.target)) document.getElementById(dropdownId)?.classList.remove(
                    'open');
            });
        });

        // ══════ MODAL FORM KORBAN — open/submit ══════
        function openKorbanFormModal(korbanId = null) {
            currentEditKorbanId = korbanId;
            renderKorbanFormFields();

            const row = korbanId ? (window.__lastKorbanList || []).find(k => k.id === korbanId) : null;
            document.getElementById('korbanFormTitle').textContent = row ? 'Edit Data Korban' : 'Tambah Data Korban';

            flatKorbanKeys().forEach(key => {
                const el = document.getElementById(fieldInputId(key));
                if (el) el.value = row?.[key] ?? '';
            });

            document.getElementById(fieldInputId('badge_korban')).value = row?.badge_korban || '';
            document.getElementById(fieldInputId('nama_korban')).value = row?.nama_korban || '';
            document.getElementById(fieldInputId('badge_saksi_karyawan_fjm')).value = row?.badge_saksi_karyawan_fjm ||
                '';
            document.getElementById(fieldInputId('nama_saksi_karyawan_fjm')).value = row?.nama_saksi_karyawan_fjm ||
                '';

            document.getElementById('korbanPickerWrap').style.display = 'block';
            document.getElementById('korbanSelectedChip').style.display = 'none';
            document.getElementById('korbanPickerInput').value = '';
            document.getElementById('saksiPickerWrap').style.display = 'block';
            document.getElementById('saksiSelectedChip').style.display = 'none';
            document.getElementById('saksiPickerInput').value = '';

            if (row?.nama_korban) {
                document.getElementById('korbanSelectedName').textContent = row.nama_korban;
                document.getElementById('korbanSelectedSub').textContent = row.badge_korban || '-';
                document.getElementById('korbanSelectedChip').style.display = 'flex';
                document.getElementById('korbanPickerWrap').style.display = 'none';
            }
            if (row?.nama_saksi_karyawan_fjm) {
                document.getElementById('saksiSelectedName').textContent = row.nama_saksi_karyawan_fjm;
                document.getElementById('saksiSelectedSub').textContent = row.badge_saksi_karyawan_fjm || '-';
                document.getElementById('saksiSelectedChip').style.display = 'flex';
                document.getElementById('saksiPickerWrap').style.display = 'none';
            }

            document.getElementById('korbanFormModalOverlay').classList.add('open');
        }

        function closeKorbanFormModal() {
            document.getElementById('korbanFormModalOverlay').classList.remove('open');
            currentEditKorbanId = null;
        }

        function closeKorbanFormModalOutside(e) {
            if (e.target.id === 'korbanFormModalOverlay') closeKorbanFormModal();
        }

        async function submitKorban() {
            const btn = document.getElementById('btnSubmitKorban');
            btn.disabled = true;
            const originalText = btn.textContent;
            btn.textContent = 'Menyimpan...';

            const payload = {};
            flatKorbanKeys().forEach(key => {
                payload[key] = document.getElementById(fieldInputId(key)).value || null;
            });
            payload.badge_korban = document.getElementById(fieldInputId('badge_korban')).value || null;
            payload.nama_korban = document.getElementById(fieldInputId('nama_korban')).value || null;
            payload.badge_saksi_karyawan_fjm = document.getElementById(fieldInputId('badge_saksi_karyawan_fjm'))
                .value || null;
            payload.nama_saksi_karyawan_fjm = document.getElementById(fieldInputId('nama_saksi_karyawan_fjm')).value ||
                null;

            const url = currentEditKorbanId ?
                `${KORBAN_BASE_ENDPOINT}/${currentEditKorbanId}` :
                `${KEJADIAN_BASE_ENDPOINT}/${KEJADIAN_ID}/korban`;
            const method = currentEditKorbanId ? 'PUT' : 'POST';

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
                closeKorbanFormModal();
                await loadDetail(); // refresh detail kejadian + list korban sekaligus
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan data korban.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ══════ MODAL DETAIL KORBAN (read-only) ══════
        function detailRow(label, value, span) {
            return `<div class="detail-field${span ? ' span-' + span : ''}"><label>${label}</label><div class="detail-value">${escapeHtml(value ?? '-') || '-'}</div></div>`;
        }

        function openKorbanDetailModal(korbanId) {
            const row = (window.__lastKorbanList || []).find(k => k.id === korbanId);
            if (!row) {
                showToast('Data korban tidak ditemukan.', 'error');
                return;
            }
            currentEditKorbanId = korbanId;
            document.getElementById('korbanDetailTitle').textContent = row.nama_korban || 'Detail Data Korban';

            const body = document.getElementById('korbanDetailBody');
            body.innerHTML = `
                <div class="dynamic-form-section-title">Klasifikasi & Saksi</div>
                <div class="form-grid">
                    ${detailRow('Klasifikasi Insiden', row.klasifikasi_insiden)}
                    ${detailRow('Saksi Karyawan FJM', row.nama_saksi_karyawan_fjm ? `${row.nama_saksi_karyawan_fjm} (${row.badge_saksi_karyawan_fjm || '-'})` : '-')}
                    ${detailRow('Nama Saksi Non-FJM', row.nama_saksi_karyawan_non_fjm)}
                </div>

                <div class="dynamic-form-section-title">Data Korban</div>
                <div class="form-grid">
                    ${detailRow('PT Asal Korban', row.pt_asal_korban)}
                    ${detailRow('Nama Korban', row.nama_korban ? `${row.nama_korban} (${row.badge_korban || '-'})` : '-')}
                    ${detailRow('Alamat', row.alamat, 2)}
                    ${detailRow('Jenis Kelamin', row.jenis_kelamin)}
                    ${detailRow('Usia', row.usia)}
                    ${detailRow('Masa Kerja (tahun)', row.masa_kerja)}
                    ${detailRow('Shift', row.shift)}
                    ${detailRow('Departemen', row.departemen)}
                    ${detailRow('Unit Kerja', row.unit_kerja)}
                    ${detailRow('Jabatan', row.jabatan)}
                    ${detailRow('Kode OK', row.kode_ok)}
                    ${detailRow('Uraian Pekerjaan', row.uraian_pekerjaan, 2)}
                </div>

                <div class="dynamic-form-section-title">Jenis Insiden & Alat</div>
                <div class="form-grid">
                    ${detailRow('Jenis Insiden', row.jenis_insiden)}
                    ${detailRow('Penjelasan Jenis Insiden', row.penjelasan_jenis_insiden, 2)}
                    ${detailRow('Keterlibatan Alat', row.keterlibatan_alat)}
                    ${detailRow('Keterangan Alat Lain-lain', row.keterangan_alat_lain)}
                    ${detailRow('Nomor Alat', row.nomor_alat)}
                    ${detailRow('Status Milik Alat/Unit', row.status_milik_alat_unit)}
                </div>

                <div class="dynamic-form-section-title">Analisis — Unsafe Action</div>
                <div class="form-grid">
                    ${detailRow('Tindakan Tidak Aman', row.tindakan_tidak_aman, 2)}
                    ${detailRow('Sebab 1', row.ua_sebab_1)}
                    ${detailRow('Sebab 2', row.ua_sebab_2)}
                    ${detailRow('Sebab 3', row.ua_sebab_3)}
                </div>

                <div class="dynamic-form-section-title">Analisis — Unsafe Condition</div>
                <div class="form-grid">
                    ${detailRow('Kondisi Tidak Aman', row.kondisi_tidak_aman, 2)}
                    ${detailRow('Sebab 1', row.uc_sebab_1)}
                    ${detailRow('Sebab 2', row.uc_sebab_2)}
                    ${detailRow('Sebab 3', row.uc_sebab_3)}
                </div>

                <div class="dynamic-form-section-title">Analisis — Faktor Pribadi</div>
                <div class="form-grid">
                    ${detailRow('Faktor Pribadi', row.faktor_pribadi, 2)}
                    ${detailRow('Sebab 1', row.fp_sebab_1)}
                    ${detailRow('Sebab 2', row.fp_sebab_2)}
                    ${detailRow('Sebab 3', row.fp_sebab_3)}
                </div>

                <div class="dynamic-form-section-title">Analisis — Faktor Pekerjaan</div>
                <div class="form-grid">
                    ${detailRow('Faktor Pekerjaan', row.faktor_pekerjaan, 2)}
                    ${detailRow('Sebab 1', row.fk_sebab_1)}
                    ${detailRow('Sebab 2', row.fk_sebab_2)}
                    ${detailRow('Sebab 3', row.fk_sebab_3)}
                </div>

                <div class="dynamic-form-section-title">Sistem Manajemen</div>
                <div class="form-grid">
                    ${detailRow('Nomor & Judul Prosedur', row.sistem_manajemen_terkait, 2)}
                    ${detailRow('Deskripsi Kegagalan Sistem', row.deskripsi_kegagalan_sistem, 2)}
                    ${detailRow('Penyebab Kegagalan Sistem', row.penyebab_kegagalan_sistem, 2)}
                    ${detailRow('Sebab-sebab Teridentifikasi', row.sebab_sebab_teridentifikasi, 2)}
                </div>

                <div class="dynamic-form-section-title">Pengendalian Risiko</div>
                <div class="form-grid">
                    ${detailRow('Pengendalian Risiko', row.pengendalian_risiko, 2)}
                    ${detailRow('Penjelasan Pengendalian Risiko', row.penjelasan_pengendalian_risiko, 2)}
                </div>

                <div class="dynamic-form-section-title">Cidera & Penanganan Medis</div>
                <div class="form-grid">
                    ${detailRow('Rincian Cidera', row.rincian_cidera)}
                    ${detailRow('Persentase Luka Bakar (%)', row.persentase_luka_bakar)}
                    ${detailRow('Keterangan Detail Cidera', row.keterangan_detail_cidera, 2)}
                    ${detailRow('Kategori Penanganan Medis', row.kategori_penanganan_medis)}
                    ${detailRow('Keterangan Penanganan Medis', row.keterangan_penanganan_medis, 2)}
                    ${detailRow('Nama Dokter', row.nama_dokter)}
                    ${detailRow('Total Hari Kerja Hilang', row.total_hari_kerja_hilang)}
                    ${detailRow('Nominal Biaya Medis', formatRupiah(row.nominal_biaya_medis))}
                    ${detailRow('Penjamin / Platform', row.penjamin_platform)}
                </div>
            `;

            document.getElementById('korbanDetailModalOverlay').classList.add('open');
        }

        function closeKorbanDetailModal() {
            document.getElementById('korbanDetailModalOverlay').classList.remove('open');
        }

        function closeKorbanDetailModalOutside(e) {
            if (e.target.id === 'korbanDetailModalOverlay') closeKorbanDetailModal();
        }

        function editFromKorbanDetail() {
            const id = currentEditKorbanId;
            closeKorbanDetailModal();
            openKorbanFormModal(id);
        }

        async function deleteKorban(id, nama) {
            openConfirmModal(
                'Hapus Data Korban',
                `Apakah Anda yakin ingin menghapus data korban "${nama}"? Tindakan ini tidak dapat dibatalkan.`,
                async () => {
                    try {
                        const res = await fetch(`${KORBAN_BASE_ENDPOINT}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': CSRF_TOKEN
                            }
                        });
                        const json = await res.json();
                        if (!res.ok) throw new Error(json.message);
                        await loadDetail();
                        showToast(json.message, 'success');
                    } catch (e) {
                        showToast(e.message || 'Gagal menghapus data korban.', 'error');
                    }
                }
            );
        }
    </script>
</body>

</html>