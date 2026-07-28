<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Tenaga Kerja — PT. Fokus Jasa Mitra</title>
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

        /* CONTENT */
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

        /* PAGE HEADER */
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

        /* ══════ FILTER BAR ══════ */
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
            transition: border 0.2s;
        }

        .filter-search input:focus {
            border-color: #2D4B9E;
        }

        .filter-search .search-icon {
            left: 12px;
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
            min-width: 150px;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            outline: none;
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

        /* ══════ TABLE ══════ */
        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 760px;
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

        .skeleton-row td {
            padding: 12px 8px;
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

        /* ══════ PAGINATION ══════ */
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
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 6px center;
            font-size: 11px;
            font-weight: 700;
            color: #1A1D2E;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
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
            transition: all 0.15s;
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

        /* ══════ RESPONSIVE ══════ */
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

        .sb-close-btn {
            display: none;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            background: #F0F2FA;
            color: #64748B;
            cursor: pointer;
            margin-left: auto;
            flex-shrink: 0;
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

            .sb-close-btn {
                display: flex;
            }

            .search-box {
                max-width: none;
            }
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

        /* ══════ MODAL KONFIRMASI ══════ */
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

        .modal-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
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

        /* ══════ LOADING SCREEN ══════ */
        .loading-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(26, 29, 46, 0.55);
            backdrop-filter: blur(3px);
            z-index: 200;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .loading-overlay.open {
            display: flex;
            opacity: 1;
        }

        .loading-box {
            background: #fff;
            border-radius: 16px;
            padding: 32px 36px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 300px;
            max-width: calc(100vw - 32px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 3px solid rgba(45, 75, 158, 0.15);
            border-top-color: #2D4B9E;
            animation: spin 0.8s linear infinite;
            margin-bottom: 16px;
        }

        .loading-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 17px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 4px;
        }

        .loading-sub {
            font-size: 11.5px;
            color: #94A3B8;
            line-height: 1.5;
        }

        /* ══════ TOAST ══════ */
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

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .btn-edit-kib {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 7px;
            border: 1px solid rgba(45, 75, 158, 0.2);
            background: #F0F4FF;
            color: #2D4B9E;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-edit-kib:hover {
            background: rgba(45, 75, 158, 0.14);
        }

        /* ══════ MODAL UPDATE KIB ══════ */
        .update-modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            width: 420px;
            max-width: calc(100vw - 32px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.94) translateY(8px);
            transition: transform 0.2s ease;
        }

        .modal-overlay.open .update-modal-box {
            transform: scale(1) translateY(0);
        }

        .update-modal-header {
            margin-bottom: 16px;
        }

        .update-modal-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .update-modal-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            line-height: 1;
        }

        .update-modal-nik {
            font-size: 11.5px;
            color: #94A3B8;
            margin-top: 2px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 5px;
        }

        .form-input,
        .form-select {
            width: 100%;
            height: 38px;
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

        .form-input:focus,
        .form-select:focus {
            border-color: #2D4B9E;
        }

        .form-select {
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 12px center;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
        }

        /* modal detail tenaga */
        .detail-modal-box {
            max-width: 600px;
            width: 100%;
        }

        .detail-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .detail-avatar {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2D4B9E, #1A1D2E);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .detail-subtitle {
            font-size: 12.5px;
            color: #94A3B8;
            font-weight: 500;
        }

        .detail-modal-body {
            max-height: 65vh;
            overflow-y: auto;
            padding-top: 4px;
        }

        .detail-section {
            margin-bottom: 18px;
            padding-bottom: 16px;
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
            margin-bottom: 10px;
        }

        .detail-section-title svg {
            width: 14px;
            height: 14px;
        }

        .detail-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 16px;
        }

        .detail-field {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-field label {
            font-size: 11px;
            font-weight: 600;
            color: #94A3B8;
        }

        .detail-field input,
        .detail-field textarea {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 500;
            color: #1E293B;
            font-family: inherit;
            resize: none;
            cursor: default;
        }

        .detail-field input:focus,
        .detail-field textarea:focus {
            outline: none;
            border-color: #2D4B9E;
            background: #EEF2FB;
        }

        @media (max-width: 640px) {
            .detail-form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-section-title {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }

        .form-group textarea.form-input {
            min-height: 80px;
            resize: vertical;
        }

        .file-info {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            display: block;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-section {
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 16px;
            border-bottom: 1px dashed #cbd5e1;
            padding-bottom: 8px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #334155;
        }

        .input-lainnya {
            margin-top: 8px;
            display: none;
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
        <div id="page-content" style="padding-bottom: 40px;">


            <!-- PAGE HEADER -->
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Database K3 · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">TAMBAH REGISTRASI <span>AWAL K3</span></div>
                        <div class="pg-sub">Silakan isi formulir data dan dokumen K3 di bawah ini.</div>
                    </div>
                    <div class="pg-actions">
                        <a href="{{ route('registrasi-k3.index') }}" class="btn-primary"
                            style="background-color: #2563EB; color: white; border: none; padding: 7px 14px; border-radius: 4px; text-decoration:none; display: inline-flex; align-items: center; gap: 6px; font-weight: 500;">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>


            <!-- FORM WRAPPER -->
            <form action="{{ route('registrasi-k3.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- BAGIAN 1: INFORMASI DASAR -->
                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informasi Dasar & Personal
                    </div>
                    <div class="grid-3">
                        <div class="form-group">
                            <label class="form-label">Tanggal Induction <span style="color:red">*</span></label>
                            <input type="date" name="tanggal_induction" class="form-input"
                                value="{{ old('tanggal_induction') }}" required>
                            @error('tanggal_induction')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Induk Kependudukan (KTP) <span
                                    style="color:red">*</span></label>
                            <input type="text" name="nomor_ktp" class="form-input" value="{{ old('nomor_ktp') }}"
                                placeholder="Masukkan 16 digit NIK" required>
                            @error('nomor_ktp')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Badge</label>
                            <input type="text" name="badge" class="form-input" value="{{ old('badge') }}"
                                placeholder="Masukkan nomor badge...">
                            @error('badge')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nama Lengkap <span style="color:red">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-input"
                                value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap..." required>
                            @error('nama_lengkap')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Handphone (Aktif/WA) <span
                                    style="color:red">*</span></label>
                            <input type="text" name="nomor_hp" class="form-input" value="{{ old('nomor_hp') }}"
                                placeholder="08xxxxxxxxxx" required>
                            @error('nomor_hp')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: DATA PEKERJAAN -->
                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#f59e0b;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Data Penempatan & Pekerjaan
                    </div>
                    <div class="grid-3">
                        <div class="form-group">
                            <label class="form-label">PT Asal / Subkon <span style="color:red">*</span></label>
                            <input type="text" name="pt_asal" class="form-input" value="{{ old('pt_asal') }}"
                                placeholder="Nama Perusahaan Asal" required>
                            @error('pt_asal')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Departemen <span style="color:red">*</span></label>
                            <select name="departemen" class="form-input" required>
                                <option value="">Pilih Departemen</option>
                                <option value="IT" {{ old('departemen') == 'IT' ? 'selected' : '' }}>IT</option>
                                <option value="HR" {{ old('departemen') == 'HR' ? 'selected' : '' }}>HR</option>
                                <option value="Operation" {{ old('departemen') == 'Operation' ? 'selected' : '' }}>
                                    Operation</option>
                            </select>
                            @error('departemen')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jabatan <span style="color:red">*</span></label>
                            <input type="text" name="jabatan" class="form-input" value="{{ old('jabatan') }}"
                                placeholder="Jabatan Pekerjaan" required>
                            @error('jabatan')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Unit Kerja <span style="color:red">*</span></label>
                            <input type="text" name="unit_kerja" class="form-input"
                                value="{{ old('unit_kerja') }}" placeholder="Unit Kerja Spesifik" required>
                            @error('unit_kerja')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Area Kerja <span style="color:red">*</span></label>
                            <input type="text" name="area_kerja" class="form-input"
                                value="{{ old('area_kerja') }}" placeholder="Lokasi Area Kerja" required>
                            @error('area_kerja')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 3: LISENSI & KEAHLIAN -->
                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#10b981;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Lisensi & Kompetensi
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label">Kepemilikan SIM A / C</label>
                            <select name="sim_ac" class="form-select">
                                <option value="">-- Pilih Jenis SIM --</option>
                                <option value="SIM A" {{ old('sim_ac') == 'SIM A' ? 'selected' : '' }}>SIM A</option>
                                <option value="SIM C" {{ old('sim_ac') == 'SIM C' ? 'selected' : '' }}>SIM C</option>
                                <option value="SIM A & C" {{ old('sim_ac') == 'SIM A & C' ? 'selected' : '' }}>SIM A &
                                    C</option>
                                <option value="Tidak Ada" {{ old('sim_ac') == 'Tidak Ada' ? 'selected' : '' }}>Tidak
                                    Ada</option>
                            </select>
                            @error('sim_ac')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">SIO Aktif <span style="font-weight:normal;color:#64748b;">(Hanya
                                    untuk jabatan Operator Alat Berat)</span></label>
                            <input type="text" name="sio_aktif" class="form-input"
                                value="{{ old('sio_aktif') }}" placeholder="Jenis & Nomor SIO (jika ada)">
                            @error('sio_aktif')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 4: KONTAK DARURAT -->
                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#ef4444;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Informasi Kontak Darurat
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label">Nama Kontak Darurat <span style="color:red">*</span></label>
                            <input type="text" name="nama_kontak_darurat" class="form-input"
                                value="{{ old('nama_kontak_darurat') }}" placeholder="Nama lengkap" required>
                            @error('nama_kontak_darurat')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hubungan dengan Karyawan <span
                                    style="color:red">*</span></label>
                            <input type="text" name="hubungan_kontak_darurat" class="form-input"
                                value="{{ old('hubungan_kontak_darurat') }}"
                                placeholder="Contoh: Istri, Orang Tua, Kakak" required>
                            @error('hubungan_kontak_darurat')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Alamat Kontak Darurat <span style="color:red">*</span></label>
                            <textarea name="alamat_kontak_darurat" class="form-input" placeholder="Alamat lengkap domisili kontak darurat"
                                required>{{ old('alamat_kontak_darurat') }}</textarea>
                            @error('alamat_kontak_darurat')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 5: UPLOAD DOKUMEN -->
                <!-- (Input file tidak bisa menyimpan nilai lama/old, tapi tetap wajib menampilkan error-nya) -->
                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#8b5cf6;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Lampiran File & Dokumen K3
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label">Foto Diri (Setengah Badan) <span
                                    style="color:red">*</span></label>
                            <input type="file" name="foto_diri" class="form-input"
                                accept="image/png, image/jpeg, image/jpg" required>
                            <span class="file-info">Format: JPG, JPEG, PNG</span>
                            @error('foto_diri')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">File KTP <span style="color:red">*</span></label>
                            <input type="file" name="file_ktp" class="form-input"
                                accept="image/*, application/pdf" required>
                            @error('file_ktp')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">File Kartu Keluarga (KK) <span
                                    style="color:red">*</span></label>
                            <input type="file" name="file_kk" class="form-input"
                                accept="image/*, application/pdf" required>
                            @error('file_kk')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">File BPJS (Kesehatan / TK) <span
                                    style="color:red">*</span></label>
                            <input type="file" name="file_bpjs" class="form-input"
                                accept="image/*, application/pdf" required>
                            @error('file_bpjs')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">File Surat Keterangan Sehat <span
                                    style="color:red">*</span></label>
                            <input type="file" name="file_sks" class="form-input"
                                accept="image/*, application/pdf" required>
                            @error('file_sks')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">File SKCK <span style="color:red">*</span></label>
                            <input type="file" name="file_skck" class="form-input"
                                accept="image/*, application/pdf" required>
                            @error('file_skck')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">File Safety Induction <span style="color:red">*</span></label>
                            <input type="file" name="file_safety_induction" class="form-input"
                                accept="image/*, application/pdf" required>
                            @error('file_safety_induction')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">File Pakta Integritas <span style="color:red">*</span></label>
                            <input type="file" name="file_pakta_integritas" class="form-input"
                                accept="image/*, application/pdf" required>
                            @error('file_pakta_integritas')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 6: CHECKLIST APD & UKURAN -->
                <div class="form-section">
                    <div class="form-section-title">Kelengkapan APD & Ukuran</div>

                    <div class="form-group">
                        <label class="form-label">Checklist APD Dibagikan</label>
                        <p style="font-size: 12px; color: #64748b; margin-top: -4px; margin-bottom: 12px;">Pilih "Yang
                            lain" jika jenis APD tidak ada di list.</p>

                        <div class="checkbox-grid">
                            @php
                                $apdOptions = [
                                    'Helm',
                                    'Safety Glass - Clear',
                                    'Safety Glass - Smoke',
                                    'Earplug',
                                    'Masker Gas',
                                    'Cartridge',
                                    'Safety Shoes',
                                    'Safety Boot',
                                    'Seragam PDH',
                                    'Seragam PDL',
                                ];
                            @endphp

                            @foreach ($apdOptions as $apd)
                                <label class="checkbox-item">
                                    <input type="checkbox" name="checklist_apd[]" value="{{ $apd }}"
                                        {{ is_array(old('checklist_apd')) && in_array($apd, old('checklist_apd')) ? 'checked' : '' }}>
                                    {{ $apd }}
                                </label>
                            @endforeach

                            <!-- Opsi "Yang Lain" -->
                            <div style="grid-column: 1 / -1;">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="checklist_apd[]" value="Yang lain" id="chkLainnya"
                                        onchange="toggleLainnya()"
                                        {{ is_array(old('checklist_apd')) && in_array('Yang lain', old('checklist_apd')) ? 'checked' : '' }}>
                                    Yang lain:
                                </label>
                                <input type="text" name="checklist_apd_lainnya" id="inputLainnya"
                                    class="form-input" value="{{ old('checklist_apd_lainnya') }}"
                                    placeholder="Sebutkan jenis APD lainnya..."
                                    style="margin-top:8px; {{ is_array(old('checklist_apd')) && in_array('Yang lain', old('checklist_apd')) ? 'display:block;' : 'display:none;' }}">
                                @error('checklist_apd_lainnya')
                                    <span
                                        style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @error('checklist_apd')
                            <span
                                style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-top: 24px;">
                        <div class="form-group">
                            <label class="form-label" for="ukuran_sepatu">Ukuran Sepatu</label>
                            <input type="text" name="ukuran_sepatu" id="ukuran_sepatu" class="form-input"
                                value="{{ old('ukuran_sepatu') }}" placeholder="Cth: 42">
                            @error('ukuran_sepatu')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ukuran_seragam_atas">Ukuran Seragam (Atas)</label>
                            <input type="text" name="ukuran_seragam_atas" id="ukuran_seragam_atas"
                                class="form-input" value="{{ old('ukuran_seragam_atas') }}" placeholder="Cth: L">
                            @error('ukuran_seragam_atas')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ukuran_seragam_bawah">Ukuran Seragam (Bawah)</label>
                            <input type="text" name="ukuran_seragam_bawah" id="ukuran_seragam_bawah"
                                class="form-input" value="{{ old('ukuran_seragam_bawah') }}" placeholder="Cth: 32">
                            @error('ukuran_seragam_bawah')
                                <span
                                    style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 10px;">
                        <button type="reset" class="btn-modal-cancel" style="padding: 10px 24px;">Reset
                            Form</button>
                        <button type="submit" class="btn-primary"
                            style="background-color: #2563EB; color: white; border: none; padding: 10px 24px; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 14px;">
                            Simpan Data Registrasi
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        function toggleLainnya() {
            const chkLainnya = document.getElementById('chkLainnya');
            const inputLainnya = document.getElementById('inputLainnya');

            if (chkLainnya.checked) {
                inputLainnya.style.display = 'block';
                inputLainnya.setAttribute('required', 'true');
            } else {
                inputLainnya.style.display = 'none';
                inputLainnya.removeAttribute('required');
                inputLainnya.value = '';
            }
        }
    </script>

</body>

</html>
