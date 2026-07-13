<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data DCU — PT. Fokus Jasa Mitra</title>
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

        .pg-actions {
            display: flex;
            align-items: center;
            gap: 8px;
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
            margin-bottom: 14px;
        }

        .filter-search {
            flex: 1;
            min-width: 220px;
            position: relative;
        }

        .filter-search input {
            width: 100%;
            height: 36px;
            padding: 0 12px 0 34px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: 8px;
            background: #fff;
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            outline: none;
        }

        .filter-search input:focus {
            border-color: #2D4B9E;
        }

        .filter-search .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
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
            min-width: 160px;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            outline: none;
        }

        .filter-date {
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 12px;
        }

        .filter-reset {
            height: 36px;
            padding: 0 14px;
        }

        .data-summary {
            font-size: 11px;
            color: #94A3B8;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .data-summary strong {
            color: #1A1D2E;
        }

        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .rtable th {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0 8px 8px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            white-space: nowrap;
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

        .td-name-cell {
            display: flex;
            align-items: center;
            gap: 9px;
            white-space: nowrap;
        }

        .td-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #E0E7FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            color: #2D4B9E;
            flex-shrink: 0;
        }

        .td-name-main {
            font-weight: 700;
            color: #1A1D2E;
            line-height: 1.3;
        }

        .td-name-sub {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
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

        .sp-blue {
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
        }

        .sp-gray {
            background: rgba(100, 116, 139, 0.09);
            color: #64748B;
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

        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pagination-info {
            font-size: 11px;
            color: #94A3B8;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .per-page-select {
            height: 28px;
            padding: 0 24px 0 8px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 11px;
            font-weight: 700;
            color: #1A1D2E;
            cursor: pointer;
        }

        .pagination-pages {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-wrap: wrap;
        }

        .page-btn {
            min-width: 28px;
            height: 28px;
            padding: 0 6px;
            border-radius: 7px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #fff;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            cursor: pointer;
        }

        .page-btn:hover:not(:disabled):not(.active) {
            background: #F0F4FF;
            border-color: rgba(45, 75, 158, 0.25);
        }

        .page-btn.active {
            background: #2D4B9E;
            border-color: #2D4B9E;
            color: #fff;
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .page-ellipsis {
            font-size: 11px;
            color: #94A3B8;
            padding: 0 2px;
        }

        /* MODAL */
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
        }

        .modal-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(208, 2, 27, 0.09);
            color: #D0021B;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 8px;
        }

        .modal-desc {
            font-size: 12.5px;
            line-height: 1.55;
            color: #64748B;
            margin-bottom: 20px;
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
        }

        .form-modal-box {
            width: 820px;
            max-height: 88vh;
            display: flex;
            flex-direction: column;
        }

        .form-modal-header {
            margin-bottom: 12px;
            flex-shrink: 0;
        }

        .form-modal-body {
            overflow-y: auto;
            flex: 1;
            padding-right: 4px;
        }

        .form-section-title {
            font-size: 11px;
            font-weight: 800;
            color: #2D4B9E;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin: 16px 0 8px;
        }

        .form-section-title:first-child {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 10px 12px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .form-group.span-2 {
            grid-column: span 2;
        }

        .form-group.span-4 {
            grid-column: span 4;
        }

        .form-label {
            font-size: 10.5px;
            font-weight: 700;
            color: #64748B;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0 10px;
            height: 34px;
            border-radius: 7px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 12px;
            font-family: inherit;
            outline: none;
        }

        .form-textarea {
            height: auto;
            padding: 8px 10px;
            resize: vertical;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #2D4B9E;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 600;
            color: #334155;
        }

        .vital-block {
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
        }

        .vital-block-title {
            font-size: 11.5px;
            font-weight: 800;
            color: #1A1D2E;
            margin-bottom: 8px;
        }

        .picker-wrap {
            position: relative;
        }

        .picker-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            max-height: 240px;
            overflow-y: auto;
            z-index: 20;
            margin-top: 4px;
            display: none;
        }

        .picker-dropdown.open {
            display: block;
        }

        .picker-item {
            padding: 8px 10px;
            cursor: pointer;
            font-size: 12px;
            border-bottom: 1px solid #F1F5F9;
        }

        .picker-item:last-child {
            border-bottom: none;
        }

        .picker-item:hover {
            background: #F8F9FF;
        }

        .picker-item-name {
            font-weight: 700;
            color: #1A1D2E;
        }

        .picker-item-sub {
            font-size: 10.5px;
            color: #94A3B8;
        }

        .detail-modal-box {
            max-width: 720px;
            width: 100%;
            max-height: 85vh;
            display: flex;
            flex-direction: column;
        }

        .detail-modal-body {
            overflow-y: auto;
            flex: 1;
        }

        .detail-section {
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px dashed #E2E8F0;
        }

        .detail-section:last-child {
            border-bottom: none;
        }

        .detail-section-title {
            font-size: 11.5px;
            font-weight: 800;
            color: #2D4B9E;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px 12px;
        }

        .detail-field label {
            font-size: 10px;
            font-weight: 600;
            color: #94A3B8;
            display: block;
            margin-bottom: 2px;
        }

        .detail-field .val {
            font-size: 12.5px;
            font-weight: 600;
            color: #1E293B;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            padding: 6px 8px;
            min-height: 20px;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 300;
            display: flex;
            flex-direction: column;
            gap: 10px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(26, 122, 60, 0.1);
            color: #1A7A3C;
            flex-shrink: 0;
        }

        .toast-error .toast-icon {
            background: rgba(208, 2, 27, 0.1);
            color: #D0021B;
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
        }

        .toast-close {
            background: none;
            border: none;
            color: #94A3B8;
            cursor: pointer;
            font-size: 14px;
            margin-left: auto;
            flex-shrink: 0;
        }

        .hamburger-btn {
            display: none;
        }

        @media (max-width: 1024px) {
            .hamburger-btn {
                display: flex;
            }
        }

        @media (max-width: 900px) {
            .form-modal-box {
                width: 100%;
            }

            .form-grid {
                grid-template-columns: 1fr 1fr;
            }

            .detail-grid {
                grid-template-columns: 1fr 1fr;
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

        @media (max-width: 640px) {
            #topbar {
                padding: 0 12px;
                gap: 8px;
            }

            .tb-name {
                display: none;
            }

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

            .filter-select {
                min-width: 0;
                flex: 1 1 46%;
            }

            .pagination-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .pagination-pages {
                justify-content: center;
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
                            <span class="pg-eyebrow">Master Data DCU · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DATA <span>DCU</span></div>
                        <div class="pg-sub">Daily Check Up — hasil pemeriksaan kesehatan harian pegawai.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah DCU
                        </button>
                    </div>
                </div>
            </div>

            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari nama, badge, atau NIK..."
                            oninput="onSearchInput()" />
                    </div>
                    <select id="filterDepartemen" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Departemen</option>
                    </select>
                    <select id="filterResult" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Hasil</option>
                    </select>
                    <input type="date" id="filterTglDari" class="filter-date" onchange="onFilterChange()" />
                    <input type="date" id="filterTglSampai" class="filter-date" onchange="onFilterChange()" />
                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data DCU...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Pegawai</th>
                                <th>Departemen / Unit Kerja</th>
                                <th>Tgl Periksa</th>
                                <th>Tensi</th>
                                <th>GDA / Kolesterol</th>
                                <th>Hasil</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="7">
                                    <div class="skeleton-bar" style="width:100%;height:40px;"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pagination-bar">
                    <div class="pagination-info">
                        <span id="paginationText">—</span>
                        <select id="perPageSelect" class="per-page-select" onchange="onPerPageChange()">
                            <option value="10">10 / halaman</option>
                            <option value="25">25 / halaman</option>
                            <option value="50">50 / halaman</option>
                        </select>
                    </div>
                    <div class="pagination-pages" id="paginationPages"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- ══════ MODAL TAMBAH/EDIT ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Data DCU</div>
                <div class="pg-sub" id="formModalSub" style="margin:0;">Lengkapi hasil pemeriksaan di bawah ini.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Data Pegawai</div>
                <div class="picker-wrap" style="margin-bottom:10px;">
                    <input type="text" id="pegawaiPickerInput" class="form-input"
                        placeholder="Cari nama, badge, atau NIK pegawai..." oninput="onPegawaiPickerInput()"
                        autocomplete="off" />
                    <div class="picker-dropdown" id="pegawaiPickerDropdown"></div>
                </div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Badge</label><input type="text"
                            id="fBadge" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Grup</label><input type="text"
                            id="fGrup" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">NIK</label><input type="text"
                            id="fNik" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Nama</label><input type="text"
                            id="fNama" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Departemen</label><input type="text"
                            id="fDepartemen" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Unit Kerja</label><input type="text"
                            id="fUnitKerja" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Jabatan</label><input type="text"
                            id="fJabatan" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Tanggal Lahir</label><input type="date"
                            id="fTanggalLahir" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Usia</label><input type="number"
                            id="fUsia" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Tanggal Periksa</label><input type="date"
                            id="fTanggalPeriksa" class="form-input" /></div>
                </div>

                <div class="form-section-title">Vital Sign</div>
                <div id="vitalBlocksContainer"></div>

                <div class="form-section-title">Catatan Tambahan</div>
                <div class="form-grid">
                    <div class="form-group span-2"><label class="form-label">Keterangan Tambahan (17)</label><input
                            type="text" id="fKet17" class="form-input" /></div>
                    <div class="form-group span-2"><label class="form-label">Rujukan Tambahan (18)</label><input
                            type="text" id="fRujukan18" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Kelayakan Tambahan (19)</label><input
                            type="text" id="fKelayakan19" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Skor (N/A)</label><input type="number"
                            id="fNa" class="form-input" /></div>
                    <div class="form-group span-2"
                        style="flex-direction:row; align-items:center; gap:16px; padding-top:18px;">
                        <label class="form-check"><input type="checkbox" id="fSelfCheck" /> Self Check</label>
                        <label class="form-check"><input type="checkbox" id="fConsultDr" /> Consult Dr.</label>
                        <label class="form-check"><input type="checkbox" id="fDanger" /> Danger</label>
                    </div>
                </div>

                <div class="form-section-title">Kesimpulan</div>
                <div class="form-grid">
                    <div class="form-group span-2"><label class="form-label">Hasil (Result)</label><input
                            type="text" id="fResult" class="form-input"
                            placeholder="Fit To Work / Fit with Note / Unfit" /></div>
                    <div class="form-group span-2"><label class="form-label">Tindak Lanjut</label><input
                            type="text" id="fKeyTreatment" class="form-input" /></div>
                    <div class="form-group span-4"><label class="form-label">Rekomendasi Medis</label>
                        <textarea id="fRekomendasiMedis" class="form-textarea" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
                <div>
                    <div class="modal-title" id="detailNamaTitle" style="margin-bottom:2px;">-</div>
                    <div class="pg-sub" id="detailBadgeSub" style="margin:0;">-</div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body" id="detailModalBody"></div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL HAPUS ══════ -->
    <div id="deleteConfirmOverlay" class="modal-overlay" onclick="closeDeleteModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="modal-title">Hapus Data DCU?</div>
            <div class="modal-desc" id="deleteModalDesc">Data akan dihapus permanen.</div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-confirm" style="background:#D0021B;" onclick="confirmDelete()">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('dcu.data') }}";
        const STORE_ENDPOINT = "{{ route('dcu.store') }}";
        const BASE_ENDPOINT = "{{ url('/data-dcu') }}";
        const CARI_PEGAWAI_ENDPOINT = "{{ route('dcu.cari-pegawai') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            departemen: '',
            result: '',
            tanggal_dari: '',
            tanggal_sampai: '',
            page: 1,
            per_page: 10
        };
        let searchDebounce = null;
        let filterOptionsLoaded = false;
        let currentEditId = null;
        let currentDeleteId = null;

        // Definisi 6 kelompok vital sign — dipakai untuk generate form & tabel secara konsisten
        const VITALS = [{
                key: 'blood_pressure',
                title: 'Tekanan Darah (Tensi)',
                hasDualValue: true,
                valLabel1: 'Sistolik',
                valLabel2: 'Distolik',
                valId1: 'fTensiSistolik',
                valId2: 'fTensiDistolik'
            },
            {
                key: 'blood_glucose_levels',
                title: 'Gula Darah (GDA)',
                valLabel1: 'GDA',
                valId1: 'fGda'
            },
            {
                key: 'saturasi_oxygen',
                title: 'Saturasi Oksigen (SPO2)',
                valLabel1: 'SPO2',
                valId1: 'fSpo2'
            },
            {
                key: 'temperature',
                title: 'Suhu Tubuh',
                valLabel1: 'Suhu (°C)',
                valId1: 'fSuhu'
            },
            {
                key: 'pulse',
                title: 'Nadi',
                valLabel1: 'Nadi',
                valId1: 'fNadi'
            },
            {
                key: 'cholesterol',
                title: 'Kolesterol',
                valLabel1: 'Kolesterol',
                valId1: 'fCholesterol'
            },
            {
                key: 'uric_acid',
                title: 'Asam Urat',
                valLabel1: 'Asam Urat',
                valId1: 'fAsamUrat'
            },
        ];

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function initials(name) {
            if (!name || name === '-') return '—';
            const parts = name.trim().split(/\s+/);
            return ((parts[0]?.[0] || '') + (parts[1]?.[0] || '')).toUpperCase();
        }

        function formatDate(dateStr) {
            if (!dateStr) return '-';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return dateStr;
            return d.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function resultPillClass(result) {
            const r = (result || '').toLowerCase();
            if (r.includes('unfit')) return 'sp-red';
            if (r.includes('note')) return 'sp-amber';
            if (r.includes('fit')) return 'sp-green';
            return 'sp-gray';
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            const iconSvg = type === 'error' ?
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>' :
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>';
            toast.innerHTML = `
                <div class="toast-icon">${iconSvg}</div>
                <div><div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div><div class="toast-msg">${escapeHtml(message)}</div></div>
                <button class="toast-close" onclick="this.parentElement.remove()">✕</button>
            `;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        // ══════ FILTER & LIST ══════
        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.departemen = document.getElementById('filterDepartemen').value;
            state.result = document.getElementById('filterResult').value;
            state.tanggal_dari = document.getElementById('filterTglDari').value;
            state.tanggal_sampai = document.getElementById('filterTglSampai').value;
            state.page = 1;
            loadData();
        }

        function onPerPageChange() {
            state.per_page = parseInt(document.getElementById('perPageSelect').value, 10);
            state.page = 1;
            loadData();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterDepartemen').value = '';
            document.getElementById('filterResult').value = '';
            document.getElementById('filterTglDari').value = '';
            document.getElementById('filterTglSampai').value = '';
            Object.assign(state, {
                search: '',
                departemen: '',
                result: '',
                tanggal_dari: '',
                tanggal_sampai: '',
                page: 1
            });
            loadData();
        }

        function goToPage(page) {
            state.page = page;
            loadData();
            document.getElementById('page-content').scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function populateFilterOptions(options) {
            if (filterOptionsLoaded || !options) return;
            const build = (id, values) => {
                const select = document.getElementById(id);
                values.forEach(v => {
                    const opt = document.createElement('option');
                    opt.value = v;
                    opt.textContent = v;
                    select.appendChild(opt);
                });
            };
            build('filterDepartemen', options.departemen || []);
            build('filterResult', options.result || []);
            filterOptionsLoaded = true;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="7"><div class="empty-state"><div class="empty-state-title">Data tidak ditemukan</div><div class="empty-state-sub">Coba ubah kata kunci pencarian atau filter.</div></div></td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">${escapeHtml(initials(row.nama))}</div>
                            <div>
                                <div class="td-name-main">${escapeHtml(row.nama)}</div>
                                <div class="td-name-sub">${escapeHtml(row.badge)} · ${escapeHtml(row.jabatan || '-')}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600; font-size:12.5px;">${escapeHtml(row.departemen || '-')}</div>
                        <div class="td-name-sub">${escapeHtml(row.unit_kerja || '-')}</div>
                    </td>
                    <td>${formatDate(row.tanggal_periksa)}</td>
                    <td>${row.tensi_sistolik ?? '-'}/${row.tensi_distolik ?? '-'} <div class="td-name-sub">${escapeHtml(row.blood_pressure_judgement || '-')}</div></td>
                    <td>GDA: ${row.gda ?? '-'} <div class="td-name-sub">Kol: ${row.cholesterol ?? '-'}</div></td>
                    <td><span class="status-pill ${resultPillClass(row.result)}">${escapeHtml(row.result || '-')}</span></td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Detail</button>
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-outline" style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);" onclick="openDeleteModal(${row.id}, ${JSON.stringify(row.nama)})">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        function renderError(message) {
            document.getElementById('tableBody').innerHTML =
                `<tr><td colspan="7"><div class="error-state">${escapeHtml(message)}</div></td></tr>`;
            document.getElementById('paginationText').textContent = '—';
            document.getElementById('paginationPages').innerHTML = '';
            document.getElementById('dataSummary').textContent = 'Gagal memuat data.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent = meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> data DCU ditemukan`;
            const container = document.getElementById('paginationPages');
            const current = meta.current_page,
                last = meta.last_page;
            let pages = [1];
            if (current > 3) pages.push('...');
            for (let p = Math.max(2, current - 1); p <= Math.min(last - 1, current + 1); p++) pages.push(p);
            if (current < last - 2) pages.push('...');
            if (last > 1) pages.push(last);
            pages = [...new Set(pages)];
            let html =
                `<button class="page-btn" ${current <= 1 ? 'disabled' : ''} onclick="goToPage(${current - 1})">‹</button>`;
            pages.forEach(p => {
                html += p === '...' ? `<span class="page-ellipsis">…</span>` :
                    `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
            });
            html +=
                `<button class="page-btn" ${current >= last ? 'disabled' : ''} onclick="goToPage(${current + 1})">›</button>`;
            container.innerHTML = html;
        }

        async function loadData() {
            const params = new URLSearchParams();
            Object.entries(state).forEach(([k, v]) => {
                if (v) params.set(k, v);
            });
            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error((await res.json().catch(() => null))?.message || `Status ${res.status}`);
                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
                populateFilterOptions(json.filter_options);
            } catch (e) {
                renderError(e.message || 'Terjadi kesalahan.');
            }
        }

        // ══════ FORM VITAL SIGN GENERATOR ══════
        function vitalBlockHtml(v) {
            const valueInputs = v.hasDualValue ?
                `<div class="form-group"><label class="form-label">${v.valLabel1}</label><input type="number" id="${v.valId1}" class="form-input" /></div>
                   <div class="form-group"><label class="form-label">${v.valLabel2}</label><input type="number" id="${v.valId2}" class="form-input" /></div>` :
                `<div class="form-group"><label class="form-label">${v.valLabel1}</label><input type="number" step="0.01" id="${v.valId1}" class="form-input" /></div>`;

            return `
            <div class="vital-block">
                <div class="vital-block-title">${v.title}</div>
                <div class="form-grid">
                    ${valueInputs}
                    <div class="form-group"><label class="form-label">Judgement</label><input type="text" id="f_${v.key}_judgement" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Keterangan</label><input type="text" id="f_${v.key}_keterangan" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Rujukan</label><input type="text" id="f_${v.key}_rujukan" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Kelayakan</label><input type="text" id="f_${v.key}_kelayakan" class="form-input" /></div>
                </div>
            </div>`;
        }

        function renderVitalBlocks() {
            document.getElementById('vitalBlocksContainer').innerHTML = VITALS.map(vitalBlockHtml).join('');
        }

        // ══════ PICKER PEGAWAI ══════
        let pickerDebounce = null;

        function onPegawaiPickerInput() {
            clearTimeout(pickerDebounce);
            pickerDebounce = setTimeout(searchPegawaiPicker, 350);
        }

        async function searchPegawaiPicker() {
            const search = document.getElementById('pegawaiPickerInput').value.trim();
            const dropdown = document.getElementById('pegawaiPickerDropdown');
            if (search.length < 2) {
                dropdown.classList.remove('open');
                return;
            }

            try {
                const res = await fetch(`${CARI_PEGAWAI_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();

                if (!json.data || json.data.length === 0) {
                    dropdown.innerHTML =
                        `<div class="picker-item" style="color:#94A3B8;">Tidak ada pegawai ditemukan.</div>`;
                } else {
                    dropdown.innerHTML = json.data.map(p => `
                        <div class="picker-item" onclick='pilihPegawai(${JSON.stringify(p).replace(/'/g, "&#39;")})'>
                            <div class="picker-item-name">${escapeHtml(p.nama)}</div>
                            <div class="picker-item-sub">${escapeHtml(p.badge)} · ${escapeHtml(p.departemen)}</div>
                        </div>
                    `).join('');
                }
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihPegawai(p) {
            document.getElementById('fBadge').value = p.badge;
            document.getElementById('fNik').value = p.nik;
            document.getElementById('fNama').value = p.nama;
            document.getElementById('fDepartemen').value = p.departemen;
            document.getElementById('fUnitKerja').value = p.unit_kerja;
            document.getElementById('fJabatan').value = p.jabatan;
            document.getElementById('fTanggalLahir').value = p.tanggal_lahir || '';
            document.getElementById('fUsia').value = p.usia ?? '';
            document.getElementById('pegawaiPickerInput').value = `${p.nama} (${p.badge})`;
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('pegawaiPickerInput')?.closest('.picker-wrap');
            if (wrap && !wrap.contains(e.target)) {
                document.getElementById('pegawaiPickerDropdown')?.classList.remove('open');
            }
        });

        // ══════ MODAL FORM ══════
        function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            renderVitalBlocks();

            document.getElementById('formModalTitle').textContent = row ? 'Edit Data DCU' : 'Tambah Data DCU';
            document.getElementById('formModalSub').textContent = row ? `Perbarui data pemeriksaan ${row.nama}` :
                'Lengkapi hasil pemeriksaan di bawah ini.';

            document.getElementById('pegawaiPickerInput').value = row ? `${row.nama} (${row.badge})` : '';
            document.getElementById('fBadge').value = row?.badge || '';
            document.getElementById('fGrup').value = row?.grup || '';
            document.getElementById('fNik').value = row?.nik || '';
            document.getElementById('fNama').value = row?.nama || '';
            document.getElementById('fDepartemen').value = row?.departemen || '';
            document.getElementById('fUnitKerja').value = row?.unit_kerja || '';
            document.getElementById('fJabatan').value = row?.jabatan || '';
            document.getElementById('fTanggalLahir').value = row?.tanggal_lahir || '';
            document.getElementById('fUsia').value = row?.usia ?? '';
            document.getElementById('fTanggalPeriksa').value = row?.tanggal_periksa || new Date().toISOString().substring(0,
                10);

            document.getElementById('fTensiSistolik').value = row?.tensi_sistolik ?? '';
            document.getElementById('fTensiDistolik').value = row?.tensi_distolik ?? '';
            document.getElementById('fGda').value = row?.gda ?? '';
            document.getElementById('fSpo2').value = row?.spo2 ?? '';
            document.getElementById('fSuhu').value = row?.suhu ?? '';
            document.getElementById('fNadi').value = row?.nadi ?? '';
            document.getElementById('fCholesterol').value = row?.cholesterol ?? '';
            document.getElementById('fAsamUrat').value = row?.asam_urat ?? '';

            VITALS.forEach(v => {
                ['judgement', 'keterangan', 'rujukan', 'kelayakan'].forEach(suffix => {
                    const fieldName = v.key + '_' + suffix;
                    const el = document.getElementById(`f_${v.key}_${suffix}`);
                    if (el) el.value = row?.[fieldName] || '';
                });
            });

            document.getElementById('fKet17').value = row?.ket_17 || '';
            document.getElementById('fRujukan18').value = row?.rujukan_18 || '';
            document.getElementById('fKelayakan19').value = row?.kelayakan_19 || '';
            document.getElementById('fNa').value = row?.na ?? '';
            document.getElementById('fSelfCheck').checked = !!row?.self_check;
            document.getElementById('fConsultDr').checked = !!row?.consult_dr;
            document.getElementById('fDanger').checked = !!row?.danger;
            document.getElementById('fResult').value = row?.result || '';
            document.getElementById('fKeyTreatment').value = row?.key_treatment || '';
            document.getElementById('fRekomendasiMedis').value = row?.rekomendasi_medis || '';

            document.getElementById('formModalOverlay').classList.add('open');
        }

        function closeFormModal() {
            document.getElementById('formModalOverlay').classList.remove('open');
            currentEditId = null;
        }

        function closeFormModalOutside(e) {
            if (e.target.id === 'formModalOverlay') closeFormModal();
        }

        async function submitForm() {
            const btn = document.getElementById('btnSubmitForm');
            btn.disabled = true;
            const originalText = btn.textContent;
            btn.textContent = 'Menyimpan...';

            const payload = {
                badge: document.getElementById('fBadge').value,
                grup: document.getElementById('fGrup').value,
                nik: document.getElementById('fNik').value,
                nama: document.getElementById('fNama').value,
                departemen: document.getElementById('fDepartemen').value,
                unit_kerja: document.getElementById('fUnitKerja').value,
                jabatan: document.getElementById('fJabatan').value,
                tanggal_lahir: document.getElementById('fTanggalLahir').value || null,
                usia: document.getElementById('fUsia').value || null,
                tanggal_periksa: document.getElementById('fTanggalPeriksa').value,

                tensi_sistolik: document.getElementById('fTensiSistolik').value || null,
                tensi_distolik: document.getElementById('fTensiDistolik').value || null,
                gda: document.getElementById('fGda').value || null,
                spo2: document.getElementById('fSpo2').value || null,
                suhu: document.getElementById('fSuhu').value || null,
                nadi: document.getElementById('fNadi').value || null,
                cholesterol: document.getElementById('fCholesterol').value || null,
                asam_urat: document.getElementById('fAsamUrat').value || null,

                ket_17: document.getElementById('fKet17').value,
                rujukan_18: document.getElementById('fRujukan18').value,
                kelayakan_19: document.getElementById('fKelayakan19').value,
                na: document.getElementById('fNa').value || null,
                self_check: document.getElementById('fSelfCheck').checked,
                consult_dr: document.getElementById('fConsultDr').checked,
                danger: document.getElementById('fDanger').checked,
                result: document.getElementById('fResult').value,
                key_treatment: document.getElementById('fKeyTreatment').value,
                rekomendasi_medis: document.getElementById('fRekomendasiMedis').value,
            };

            VITALS.forEach(v => {
                ['judgement', 'keterangan', 'rujukan', 'kelayakan'].forEach(suffix => {
                    const fieldName = v.key + '_' + suffix;
                    const el = document.getElementById(`f_${v.key}_${suffix}`);
                    payload[fieldName] = el ? el.value : '';
                });
            });

            const url = currentEditId ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;
            const method = currentEditId ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify(payload),
                });
                const json = await res.json();
                if (!res.ok) {
                    const firstError = json.errors ? Object.values(json.errors)[0][0] : null;
                    throw new Error(firstError || json.message || `Status ${res.status}`);
                }
                closeFormModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan data.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ══════ MODAL DETAIL ══════
        function detailField(label, value) {
            return `<div class="detail-field"><label>${label}</label><div class="val">${escapeHtml(value ?? '-')}</div></div>`;
        }

        function openDetailModal(row) {
            document.getElementById('detailNamaTitle').textContent = row.nama;
            document.getElementById('detailBadgeSub').textContent = `${row.badge} · ${row.jabatan || '-'}`;

            let html = `
                <div class="detail-section">
                    <div class="detail-section-title">Data Pegawai</div>
                    <div class="detail-grid">
                        ${detailField('Badge', row.badge)}
                        ${detailField('Grup', row.grup)}
                        ${detailField('NIK', row.nik)}
                        ${detailField('Departemen', row.departemen)}
                        ${detailField('Unit Kerja', row.unit_kerja)}
                        ${detailField('Jabatan', row.jabatan)}
                        ${detailField('Usia', row.usia)}
                        ${detailField('Tgl Periksa', formatDate(row.tanggal_periksa))}
                    </div>
                </div>`;

            VITALS.forEach(v => {
                const val1 = row[v.valId1.replace('f', '').charAt(0).toLowerCase() + v.valId1.replace('f', '')
                    .slice(1)] ?? row[v.key.split('_')[0]];
                html += `
                <div class="detail-section">
                    <div class="detail-section-title">${v.title}</div>
                    <div class="detail-grid">
                        ${detailField('Judgement', row[v.key + '_judgement'])}
                        ${detailField('Keterangan', row[v.key + '_keterangan'])}
                        ${detailField('Rujukan', row[v.key + '_rujukan'])}
                        ${detailField('Kelayakan', row[v.key + '_kelayakan'])}
                    </div>
                </div>`;
            });

            html += `
                <div class="detail-section">
                    <div class="detail-section-title">Kesimpulan</div>
                    <div class="detail-grid">
                        ${detailField('Hasil', row.result)}
                        ${detailField('Self Check', row.self_check ? 'Ya' : 'Tidak')}
                        ${detailField('Consult Dr.', row.consult_dr ? 'Ya' : 'Tidak')}
                        ${detailField('Danger', row.danger ? 'Ya' : 'Tidak')}
                    </div>
                    <div class="detail-grid" style="margin-top:8px;">
                        <div class="detail-field" style="grid-column: span 4;"><label>Tindak Lanjut</label><div class="val">${escapeHtml(row.key_treatment || '-')}</div></div>
                        <div class="detail-field" style="grid-column: span 4;"><label>Rekomendasi Medis</label><div class="val">${escapeHtml(row.rekomendasi_medis || '-')}</div></div>
                    </div>
                </div>`;

            document.getElementById('detailModalBody').innerHTML = html;
            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(e) {
            if (e.target.id === 'detailModalOverlay') closeDetailModal();
        }

        // ══════ MODAL HAPUS ══════
        function openDeleteModal(id, nama) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Data DCU untuk "${nama}" akan dihapus permanen. Lanjutkan?`;
            document.getElementById('deleteConfirmOverlay').classList.add('open');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmOverlay').classList.remove('open');
            currentDeleteId = null;
        }

        function closeDeleteModalOutside(e) {
            if (e.target.id === 'deleteConfirmOverlay') closeDeleteModal();
        }

        async function confirmDelete() {
            if (!currentDeleteId) return;
            try {
                const res = await fetch(`${BASE_ENDPOINT}/${currentDeleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Status ${res.status}`);
                closeDeleteModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                closeDeleteModal();
                showToast(e.message || 'Gagal menghapus data.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
