<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Matriks KPI K3 — PT. Fokus Jasa Mitra</title>
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

        .rekap-check {
            text-align: center;
            font-weight: 800;
        }

        .rekap-check.yes {
            color: #1A7A3C;
        }

        .rekap-check.no {
            color: #cbd5e1;
        }

        .rekap-total-col {
            background: #f8fafc;
            font-weight: 800;
            text-align: center;
        }

        #soAssignmentList label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 4px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
        }

        #soAssignmentList label:last-child {
            border-bottom: none;
        }

        #soAssignmentList label:hover {
            background: #f8fafc;
        }

        #soAssignmentList input[type="checkbox"] {
            width: 15px !important;
            height: 15px;
            flex-shrink: 0;
            accent-color: #2563eb;
            cursor: pointer;
        }

        #soAssignmentList span {
            font-size: 12.5px;
            color: #1e293b;
        }

        #soAssignmentList {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2px 16px;
        }

        #soAssignmentList label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 4px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
        }

        #soAssignmentList label:hover {
            background: #f8fafc;
        }

        #soAssignmentList input[type="checkbox"] {
            width: 15px !important;
            height: 15px;
            flex-shrink: 0;
            accent-color: #2563eb;
            cursor: pointer;
        }

        #soAssignmentList .so-name {
            font-size: 12.5px;
            color: #1e293b;
            font-weight: 600;
        }

        #soAssignmentList .so-badge {
            font-size: 10.5px;
            color: #94a3b8;
            font-weight: 500;
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

            <!-- PAGE HEADER -->
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Database K3 · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">MATRIKS AKTIVITAS <span>KPI K3</span></div>
                        <div class="pg-sub">Kelola daftar aktivitas, kompleksitas, frekuensi, dan bobot penilaian KPI K3
                            tiap tim.</div>
                    </div>
                    <div class="pg-actions">
                        <button type="button" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 14px;border-radius:4px;display:inline-flex;align-items:center;gap:6px;font-weight:500;cursor:pointer;"
                            onclick="openAktivitasModal()">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Aktivitas
                        </button>
                    </div>
                </div>
            </div>

            <!-- ══════ PANEL PENGATURAN (1-6) ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;cursor:pointer;"
                    onclick="togglePengaturanPanel()">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">Pengaturan KPI K3 — Periode,
                            Ketepatan Waktu, Bobot & Tunjangan</span>
                    </div>
                    <svg id="pengaturanChevron" style="width:16px;height:16px;color:#64748b;transition:transform .2s;"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div id="pengaturanBody">
                    <form id="formPengaturan" onsubmit="return submitPengaturan(event)">
                        <div class="pengaturan-grid">

                            <!-- 1. PERIODE AKTIF -->
                            <div class="pengaturan-group">
                                <div class="pengaturan-group-title">1 · Periode Aktif</div>
                                <div class="pengaturan-field">
                                    <label>Tahun</label>
                                    <input type="number" id="pTahunAktif" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Bulan</label>
                                    <input type="number" id="pBulanAktif" min="1" max="12" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Tanggal Cut-off Laporan Manajer</label>
                                    <input type="number" id="pCutoffManajer" min="1" max="31" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Periode Manajer</label>
                                    <div style="display:flex;gap:6px;">
                                        <input type="date" id="pPeriodeManajerMulai" required>
                                        <input type="date" id="pPeriodeManajerSelesai" required>
                                    </div>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Periode P2K3</label>
                                    <div style="display:flex;gap:6px;">
                                        <input type="date" id="pPeriodeP2k3Mulai" required>
                                        <input type="date" id="pPeriodeP2k3Selesai" required>
                                    </div>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Hari Kerja Efektif (Manajer / P2K3)</label>
                                    <div style="display:flex;gap:6px;">
                                        <input type="number" id="pHariKerjaManajer" min="0" max="31"
                                            required>
                                        <input type="number" id="pHariKerjaP2k3" min="0" max="31"
                                            required>
                                    </div>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Jumlah Hari Kalender (Manajer / P2K3)</label>
                                    <div style="display:flex;gap:6px;">
                                        <input type="number" id="pHariKalenderManajer" min="0"
                                            max="31" required>
                                        <input type="number" id="pHariKalenderP2k3" min="0" max="31"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- 2 & 3. KETEPATAN WAKTU + BOBOT PENILAIAN -->
                            <div class="pengaturan-group">
                                <div class="pengaturan-group-title">2 · Ketepatan Waktu</div>
                                <div class="pengaturan-field">
                                    <label>Batas Terlambat Lapor (hari setelah kegiatan)</label>
                                    <input type="number" id="pBatasTerlambat" min="0" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Batas Lapor Lebih Awal (hari sebelum kegiatan)</label>
                                    <input type="number" id="pBatasLebihAwal" min="0" required>
                                </div>

                                <div class="pengaturan-group-title" style="margin-top:14px;">3 · Bobot Penilaian</div>
                                <div class="pengaturan-field">
                                    <label>Porsi Nilai — Capaian Aktivitas (%)</label>
                                    <input type="number" id="pPorsiCapaian" min="0" max="100"
                                        step="0.1" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Porsi Nilai — Ketepatan Waktu (%)</label>
                                    <input type="number" id="pPorsiKetepatan" min="0" max="100"
                                        step="0.1" required>
                                </div>

                                <div class="pengaturan-group-title" style="margin-top:14px;">6 · Ambang Warna</div>
                                <div class="pengaturan-field">
                                    <label>Merah bila skor di bawah (%)</label>
                                    <input type="number" id="pAmbangMerah" min="0" max="100"
                                        step="0.1" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Kuning bila skor di bawah (%)</label>
                                    <input type="number" id="pAmbangKuning" min="0" max="100"
                                        step="0.1" required>
                                </div>
                            </div>

                            <!-- 4. TUNJANGAN -->
                            <div class="pengaturan-group">
                                <div class="pengaturan-group-title">4 · Tunjangan per Tim</div>

                                <div class="pengaturan-field">
                                    <label style="display:flex;align-items:center;gap:6px;">
                                        <input type="checkbox" id="pTunjSafety" style="width:auto;"> Tim SAFETY —
                                        Nominal Tunjangan (Rp)
                                    </label>
                                    <input type="number" id="pTunjanganSafety" min="0" required>
                                </div>

                                <div class="pengaturan-field">
                                    <label style="display:flex;align-items:center;gap:6px;">
                                        <input type="checkbox" id="pTunjPengawas" style="width:auto;"> Tim PENGAWAS —
                                        Nominal Tunjangan (Rp)
                                    </label>
                                    <input type="number" id="pTunjanganPengawas" min="0" required>
                                </div>

                                <div class="pengaturan-field">
                                    <label style="display:flex;align-items:center;gap:6px;">
                                        <input type="checkbox" id="pTunjMedis" style="width:auto;"> Tim MEDIS —
                                        Nominal Tunjangan (Rp)
                                    </label>
                                    <input type="number" id="pTunjanganMedis" min="0" required>
                                </div>

                                <div class="pengaturan-field">
                                    <label>Skor Minimum agar Tunjangan Dibayar (%)</label>
                                    <input type="number" id="pSkorMin" min="0" max="100"
                                        step="0.1" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Skor Maksimum yang Dibayar (%)</label>
                                    <input type="number" id="pSkorMax" min="0" max="100"
                                        step="0.1" required>
                                </div>

                            </div>
                        </div>

                        <div
                            style="margin-top:16px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:flex-end;">
                            <button type="submit" class="btn-primary"
                                style="background-color:#1A7A3C;color:white;border:none;padding:8px 18px;border-radius:6px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
                                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ══════ RINGKASAN TOTAL SKOR PER TIM ══════ -->
            <div class="ringkasan-cards" id="ringkasanCards">
                <!-- di-render via JS: total skor keseluruhan, safety, pengawas, medis -->
            </div>

            <!-- ══════ FILTER + TABEL MATRIKS ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari Kode atau Nama Aktivitas..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterTim" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Tim</option>
                        <option value="safety">Safety</option>
                        <option value="pengawas">Pengawas</option>
                        <option value="medis">Medis</option>
                    </select>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="AKTIF">Aktif</option>
                        <option value="NONAKTIF">Nonaktif</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data matriks aktivitas...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Kode / Aktivitas</th>
                                <th class="px-6 py-3 text-center">K</th>
                                <th class="px-6 py-3 text-center">F</th>
                                <th class="px-6 py-3 text-center">Skor</th>
                                <th class="px-6 py-3 text-center">Target / Bulan</th>
                                <th class="px-6 py-3 text-center">Hari Kerja</th>
                                <th class="px-6 py-3 text-center">Berlaku</th>
                                <th class="px-6 py-3 text-center">Tim & Bobot %</th>
                                <th class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr class="skeleton-row">
                                <td colspan="10">
                                    <div class="skeleton-bar" style="width:100%; height:20px;"></div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot id="tableFoot"></tfoot>
                    </table>
                </div>
            </div>

            <!-- ══════ REKAP PENUGASAN SAFETY OFFICER ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;cursor:pointer;"
                    onclick="toggleRekapSoPanel()">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 100-8 4 4 0 000 8zm6 0a4 4 0 10-8 0" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">Rekap Penugasan Safety
                            Officer</span>
                    </div>
                    <svg id="rekapSoChevron" style="width:16px;height:16px;color:#64748b;transition:transform .2s;"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div id="rekapSoBody" style="display:none;">
                    <div class="data-summary" id="rekapSoSummary">Memuat rekap...</div>
                    <div class="rtable-wrap">
                        <table class="rtable" id="rekapSoTable">
                            <thead id="rekapSoHead"></thead>
                            <tbody id="rekapSoBodyTable"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL TAMBAH / EDIT AKTIVITAS ══════ -->
    <div class="modal-overlay" id="aktivitasModalOverlay" onclick="closeAktivitasModalOutside(event)">
        <div class="modal-box form-modal-box"
            style="max-width:1100px;width:92vw;max-height:90vh;overflow:auto; onclick="event.stopPropagation()">

            <div class="detail-modal-header"
                style="border-bottom:1px solid #e2e8f0;padding-bottom:14px;margin-bottom:16px;">
                <div class="modal-title" id="aktivitasModalTitle"
                    style="font-size:17px;font-weight:700;color:#0f172a;">Tambah Aktivitas</div>
                <button class="toast-close"
                    style="font-size:20px;color:#94a3b8;border:none;background:none;cursor:pointer;"
                    onclick="closeAktivitasModal()">✕</button>
            </div>

            <form id="formAktivitas" onsubmit="return submitAktivitas(event)">
                <input type="hidden" id="aId">

                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;">
                    <div class="detail-field">
                        <label>Kode</label>
                        <input type="text" id="aKode" placeholder="cth: C.1" required maxlength="10">
                    </div>
                    <div class="detail-field" style="grid-column:span 2;">
                        <label>Nama Aktivitas</label>
                        <input type="text" id="aNamaAktivitas" required maxlength="255">
                    </div>

                    <div class="detail-field">
                        <label>Kompleksitas (K)</label>
                        <select id="aKompleksitas" required onchange="updatePreviewSkor()">
                            <option value="1">1 — Sederhana</option>
                            <option value="2">2 — Sedang</option>
                            <option value="3">3 — Kompleks</option>
                        </select>
                    </div>
                    <div class="detail-field">
                        <label>Frekuensi (F)</label>
                        <select id="aFrekuensi" required onchange="updatePreviewSkor()">
                            <option value="1">1 — Jarang</option>
                            <option value="2">2 — Berkala</option>
                            <option value="3">3 — Sering</option>
                        </select>
                    </div>
                    <div class="detail-field">
                        <label>Skor (K × F)</label>
                        <input type="text" id="aSkorPreview" readonly
                            style="background:#f1f5f9;font-weight:700;text-align:center;">
                    </div>

                    <div class="detail-field">
                        <label>Target / Bulan</label>
                        <input type="number" id="aTargetPerBulan" min="0" required>
                    </div>
                    <div class="detail-field">
                        <label>Maks / Hari</label>
                        <input type="number" id="aMaksPerHari" min="0" required value="1">
                    </div>
                    <div class="detail-field">
                        <label>Ikut Hari Kerja?</label>
                        <select id="aIkutHariKerja" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>

                    <div class="detail-field">
                        <label>Mulai Berlaku (tahun)</label>
                        <input type="number" id="aMulaiBerlaku" min="2000" max="2100" required>
                    </div>
                    <div class="detail-field">
                        <label>Akhir Berlaku (tahun, opsional)</label>
                        <input type="number" id="aAkhirBerlaku" min="2000" max="2100">
                    </div>
                    <div class="detail-field">
                        <label>Status</label>
                        <select id="aStatus" required>
                            <option value="AKTIF">Aktif</option>
                            <option value="NONAKTIF">Nonaktif</option>
                        </select>
                    </div>

                    <div class="detail-field" style="grid-column: 1 / -1;">
                        <label>Tim Terkait</label>
                        <div style="display:flex;gap:18px;margin-top:4px;">
                            <label
                                style="display:flex;align-items:center;gap:6px;font-weight:500;font-size:13px;color:#334155;">
                                <input type="checkbox" id="aSafety" style="width:auto;"> Safety
                            </label>
                            <label
                                style="display:flex;align-items:center;gap:6px;font-weight:500;font-size:13px;color:#334155;">
                                <input type="checkbox" id="aPengawas" style="width:auto;"> Pengawas
                            </label>
                            <label
                                style="display:flex;align-items:center;gap:6px;font-weight:500;font-size:13px;color:#334155;">
                                <input type="checkbox" id="aMedis" style="width:auto;"> Medis
                            </label>
                        </div>
                        <div style="font-size:11px;color:#94a3b8;margin-top:4px;">Bobot % akan otomatis dihitung ulang
                            berdasarkan total skor tim yang dipilih.</div>
                    </div>

                    <div class="detail-field" id="soAssignmentSection" style="grid-column: 1 / -1; display:none;">
                        <label>Pilih Safety Officer yang mendapatkan aktivitas ini</label>
                        <div id="soAssignmentList"
                            style="border:1px solid #e2e8f0;border-radius:6px;padding:10px;max-height:260px;overflow-y:auto;">

                            <div style="color:#94a3b8;font-size:12px;">Memuat daftar safety officer...</div>
                        </div>
                        <div style="font-size:11px;color:#94a3b8;margin-top:4px;">
                            Skor tugas & bobot % dihitung otomatis dari skor aktivitas ini dan total skor tim Safety.
                        </div>
                    </div>
                </div>

                <div class="modal-actions"
                    style="margin-top:20px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" id="btnDeleteAktivitas" onclick="deleteAktivitas()"
                        style="display:none;padding:7px 16px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;font-weight:600;">
                        Hapus
                    </button>
                    <div style="display:flex;gap:10px;margin-left:auto;">
                        <button type="button" class="btn-modal-cancel" onclick="closeAktivitasModal()"
                            style="padding:7px 16px;border-radius:6px;border:1px solid #cbd5e1;background:white;color:#475569;cursor:pointer;font-weight:600;">Batal</button>
                        <button type="submit" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 16px;border-radius:6px;font-weight:600;cursor:pointer;">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ══════ TOAST CONTAINER ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <style>
        .pengaturan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 22px;
        }

        .pengaturan-group-title {
            font-size: 12px;
            font-weight: 700;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: .03em;
            margin-bottom: 10px;
        }

        .pengaturan-field {
            margin-bottom: 10px;
        }

        .pengaturan-field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .pengaturan-field input,
        .pengaturan-field select {
            width: 100%;
            padding: 7px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            color: #0f172a;
        }

        .detail-field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .detail-field input,
        .detail-field select {
            width: 100%;
            padding: 7px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            color: #0f172a;
        }

        .ringkasan-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 14px;
        }

        .ringkasan-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
        }

        .ringkasan-card .rc-label {
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
        }

        .ringkasan-card .rc-value {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin-top: 4px;
        }

        .ringkasan-card .rc-sub {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .bobot-badge {
            display: inline-block;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 10.5px;
            font-weight: 700;
            margin: 1px;
        }

        .bobot-safety {
            background: #dbeafe;
            color: #1e40af;
        }

        .bobot-pengawas {
            background: #dcfce7;
            color: #166534;
        }

        .bobot-medis {
            background: #fef3c7;
            color: #92400e;
        }
    </style>

    <script>
        const API_ENDPOINT = "{{ route('kpi-k3.matriks.api') }}";
        const STORE_ENDPOINT = "{{ route('kpi-k3.matriks.store') }}";
        const UPDATE_ENDPOINT_BASE = "{{ url('kpi-k3/matriks') }}";
        const PENGATURAN_ENDPOINT = "{{ route('kpi-k3.pengaturan.update') }}";
        const SO_OPTIONS_ENDPOINT = "{{ route('kpi-k3.matriks.safety-officers') }}";
        const REKAP_SO_ENDPOINT = "{{ route('kpi-k3.matriks.rekap-so') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            tim: '',
            status: ''
        };
        let searchDebounce = null;
        let latestSummary = null;
        let cachedSafetyOfficers = null;
        let rekapSoLoaded = false;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function togglePengaturanPanel() {
            const body = document.getElementById('pengaturanBody');
            const chevron = document.getElementById('pengaturanChevron');
            const isHidden = body.style.display === 'none';
            body.style.display = isHidden ? 'block' : 'none';
            chevron.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(-90deg)';
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        // ══════ TOAST ══════
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            const iconSvg = type === 'error' ?
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>' :
                '<svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>';
            toast.innerHTML = `
                <div class="toast-icon">${iconSvg}</div>
                <div class="toast-body">
                    <div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div>
                    <div class="toast-msg">${escapeHtml(message)}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">✕</button>
            `;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        // ══════ FILTER / SEARCH ══════
        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.tim = document.getElementById('filterTim').value;
            state.status = document.getElementById('filterStatus').value;
            loadData();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterTim').value = '';
            document.getElementById('filterStatus').value = '';
            state.search = '';
            state.tim = '';
            state.status = '';
            loadData();
        }

        // ══════ RENDER RINGKASAN ══════
        function renderRingkasan(summary) {
            latestSummary = summary;
            const el = document.getElementById('ringkasanCards');
            el.innerHTML = `
                <div class="ringkasan-card">
                    <div class="rc-label">Total Skor Seluruh Aktivitas</div>
                    <div class="rc-value">${summary.total_skor}</div>
                    <div class="rc-sub">Target total: ${summary.total_target} / bulan</div>
                </div>
                <div class="ringkasan-card">
                    <div class="rc-label">Total Skor Tim Safety</div>
                    <div class="rc-value" style="color:#1e40af;">${summary.total_skor_safety}</div>
                    <div class="rc-sub">Dasar pembagian bobot % Safety</div>
                </div>
                <div class="ringkasan-card">
                    <div class="rc-label">Total Skor Tim Pengawas</div>
                    <div class="rc-value" style="color:#166534;">${summary.total_skor_pengawas}</div>
                    <div class="rc-sub">Dasar pembagian bobot % Pengawas</div>
                </div>
                <div class="ringkasan-card">
                    <div class="rc-label">Total Skor Tim Medis</div>
                    <div class="rc-value" style="color:#92400e;">${summary.total_skor_medis}</div>
                    <div class="rc-sub">Dasar pembagian bobot % Medis</div>
                </div>
            `;
        }

        // ══════ RENDER TABLE ══════
        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="10" style="text-align:center;padding:20px;color:#64748b;">Data tidak ditemukan</td></tr>`;
                document.getElementById('tableFoot').innerHTML = '';
                return;
            }

            tbody.innerHTML = rows.map(row => {
                const badges = [];
                if (row.safety) badges.push(
                    `<span class="bobot-badge bobot-safety">Safety ${row.bobot_safety}%</span>`);
                if (row.pengawas) badges.push(
                    `<span class="bobot-badge bobot-pengawas">Pengawas ${row.bobot_pengawas}%</span>`);
                if (row.medis) badges.push(
                    `<span class="bobot-badge bobot-medis">Medis ${row.bobot_medis}%</span>`);

                const statusPill = row.status === 'AKTIF' ?
                    '<span class="status-pill sp-green">AKTIF</span>' :
                    '<span class="status-pill" style="background:#f1f5f9;color:#64748b;">NONAKTIF</span>';

                const berlaku = row.akhir_berlaku ? `${row.mulai_berlaku} – ${row.akhir_berlaku}` :
                    `${row.mulai_berlaku} – berjalan`;

                return `
                <tr>
                    <td>
                        <div class="td-name-main">${escapeHtml(row.kode)} — ${escapeHtml(row.nama_aktivitas)}</div>
                        <div class="td-name-sub">Target ${row.target_per_bulan}/bulan · Maks ${row.maks_per_hari}/hari</div>
                    </td>
                    <td style="text-align:center;">
                        <span style="font-weight:700;">${row.kompleksitas}</span>
                        <div class="td-name-sub">${escapeHtml(row.label_kompleksitas)}</div>
                    </td>
                    <td style="text-align:center;">
                        <span style="font-weight:700;">${row.frekuensi}</span>
                        <div class="td-name-sub">${escapeHtml(row.label_frekuensi)}</div>
                    </td>
                    <td style="text-align:center;font-weight:800;color:#2563eb;">${row.skor}</td>
                    <td style="text-align:center;">${row.target_per_bulan}</td>
                    <td style="text-align:center;">${row.ikut_hari_kerja ? 'Y' : 'N'}</td>
                    <td style="text-align:center;font-size:12px;">${berlaku}</td>
                    <td style="text-align:center;">${badges.join(' ') || '<span style="color:#cbd5e1;">-</span>'}</td>
                    <td style="text-align:center;">${statusPill}</td>
                    <td style="text-align:center;">
                        <button onclick='openAktivitasModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'
                            style="background:transparent;border:1px solid #e2e8f0;padding:6px 10px;border-radius:6px;cursor:pointer;color:#475569;font-size:12px;font-weight:600;">
                            Edit
                        </button>
                    </td>
                </tr>`;
            }).join('');

            document.getElementById('tableFoot').innerHTML = `
                <tr style="background:#f8fafc;font-weight:700;">
                    <td>TOTAL</td>
                    <td></td><td></td>
                    <td style="text-align:center;color:#2563eb;">${latestSummary.total_skor}</td>
                    <td style="text-align:center;">${latestSummary.total_target}</td>
                    <td></td><td></td>
                    <td style="text-align:center;font-size:11px;">
                        S:${latestSummary.total_skor_safety} · P:${latestSummary.total_skor_pengawas} · M:${latestSummary.total_skor_medis}
                    </td>
                    <td></td><td></td>
                </tr>`;
        }

        // ══════ FETCH DATA ══════
        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.tim) params.set('tim', state.tim);
            if (state.status) params.set('status', state.status);

            try {
                const res = await fetch(`${API_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal mengambil data');
                const json = await res.json();

                renderRingkasan(json.summary);
                renderTable(json.data);
                document.getElementById('dataSummary').innerHTML =
                    `<strong>${json.data.length}</strong> aktivitas ditemukan`;

                if (!window.__pengaturanLoaded) {
                    fillPengaturanForm(json.pengaturan);
                    window.__pengaturanLoaded = true;
                }
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="10" style="text-align:center;color:red;">Error memuat data</td></tr>`;
            }
        }

        // ══════ MODAL AKTIVITAS ══════
        function updatePreviewSkor() {
            const k = parseInt(document.getElementById('aKompleksitas').value, 10);
            const f = parseInt(document.getElementById('aFrekuensi').value, 10);
            document.getElementById('aSkorPreview').value = (k * f) + ' (otomatis)';
        }

        function openAktivitasModal(row = null) {
            document.getElementById('formAktivitas').reset();
            document.getElementById('btnDeleteAktivitas').style.display = row ? 'inline-block' : 'none';

            if (row) {
                document.getElementById('aktivitasModalTitle').textContent = `Edit Aktivitas — ${row.kode}`;
                document.getElementById('aId').value = row.id;
                document.getElementById('aKode').value = row.kode;
                document.getElementById('aNamaAktivitas').value = row.nama_aktivitas;
                document.getElementById('aKompleksitas').value = row.kompleksitas;
                document.getElementById('aFrekuensi').value = row.frekuensi;
                document.getElementById('aTargetPerBulan').value = row.target_per_bulan;
                document.getElementById('aMaksPerHari').value = row.maks_per_hari;
                document.getElementById('aIkutHariKerja').value = row.ikut_hari_kerja ? '1' : '0';
                document.getElementById('aMulaiBerlaku').value = row.mulai_berlaku;
                document.getElementById('aAkhirBerlaku').value = row.akhir_berlaku || '';
                document.getElementById('aStatus').value = row.status;
                document.getElementById('aSafety').checked = !!row.safety;
                document.getElementById('aPengawas').checked = !!row.pengawas;
                document.getElementById('aMedis').checked = !!row.medis;
            } else {
                document.getElementById('aktivitasModalTitle').textContent = 'Tambah Aktivitas';
                document.getElementById('aId').value = '';
                document.getElementById('aMaksPerHari').value = 1;
                document.getElementById('aMulaiBerlaku').value = new Date().getFullYear();
            }

            updatePreviewSkor();

            toggleSoAssignmentSection();
            renderSoAssignmentList(row?.safety_officers || []);

            updatePreviewSkor();
            document.getElementById('aktivitasModalOverlay').classList.add('open');
        }

        function closeAktivitasModal() {
            document.getElementById('aktivitasModalOverlay').classList.remove('open');
        }

        function closeAktivitasModalOutside(event) {
            if (event.target.id === 'aktivitasModalOverlay') closeAktivitasModal();
        }

        async function submitAktivitas(event) {
            event.preventDefault();
            const id = document.getElementById('aId').value;

            const payload = {
                kode: document.getElementById('aKode').value.trim(),
                nama_aktivitas: document.getElementById('aNamaAktivitas').value.trim(),
                kompleksitas: parseInt(document.getElementById('aKompleksitas').value, 10),
                frekuensi: parseInt(document.getElementById('aFrekuensi').value, 10),
                target_per_bulan: parseInt(document.getElementById('aTargetPerBulan').value, 10),
                ikut_hari_kerja: document.getElementById('aIkutHariKerja').value === '1',
                maks_per_hari: parseInt(document.getElementById('aMaksPerHari').value, 10),
                mulai_berlaku: parseInt(document.getElementById('aMulaiBerlaku').value, 10),
                akhir_berlaku: document.getElementById('aAkhirBerlaku').value ? parseInt(document.getElementById(
                    'aAkhirBerlaku').value, 10) : null,
                safety: document.getElementById('aSafety').checked,
                pengawas: document.getElementById('aPengawas').checked,
                medis: document.getElementById('aMedis').checked,
                status: document.getElementById('aStatus').value,
                safety_officer_badges: collectSafetyOfficerPayload(),
            };

            const url = id ? `${UPDATE_ENDPOINT_BASE}/${id}` : STORE_ENDPOINT;

            try {
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
                if (!res.ok) throw new Error(json.message || 'Gagal menyimpan data');

                showToast(json.message, 'success');
                closeAktivitasModal();
                loadData();
            } catch (e) {
                showToast(e.message || 'Terjadi kesalahan', 'error');
            }
            return false;
        }

        async function deleteAktivitas() {
            const id = document.getElementById('aId').value;
            if (!id) return;
            if (!confirm('Yakin ingin menghapus aktivitas ini?')) return;

            try {
                const res = await fetch(`${UPDATE_ENDPOINT_BASE}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || 'Gagal menghapus data');

                showToast(json.message, 'success');
                closeAktivitasModal();
                loadData();
            } catch (e) {
                showToast(e.message || 'Terjadi kesalahan', 'error');
            }
        }

        // ══════ PANEL PENGATURAN ══════
        function fillPengaturanForm(p) {
            document.getElementById('pTahunAktif').value = p.tahun_aktif;
            document.getElementById('pBulanAktif').value = p.bulan_aktif;
            document.getElementById('pCutoffManajer').value = p.tanggal_cutoff_manajer;
            document.getElementById('pPeriodeManajerMulai').value = (p.periode_manajer_mulai || '').substring(0, 10);
            document.getElementById('pPeriodeManajerSelesai').value = (p.periode_manajer_selesai || '').substring(0, 10);
            document.getElementById('pPeriodeP2k3Mulai').value = (p.periode_p2k3_mulai || '').substring(0, 10);
            document.getElementById('pPeriodeP2k3Selesai').value = (p.periode_p2k3_selesai || '').substring(0, 10);
            document.getElementById('pHariKerjaManajer').value = p.hari_kerja_efektif_manajer;
            document.getElementById('pHariKerjaP2k3').value = p.hari_kerja_efektif_p2k3;
            document.getElementById('pHariKalenderManajer').value = p.jumlah_hari_kalender_manajer;
            document.getElementById('pHariKalenderP2k3').value = p.jumlah_hari_kalender_p2k3;
            document.getElementById('pBatasTerlambat').value = p.batas_terlambat_lapor;
            document.getElementById('pBatasLebihAwal').value = p.batas_lapor_lebih_awal;
            document.getElementById('pPorsiCapaian').value = p.porsi_capaian_aktivitas;
            document.getElementById('pPorsiKetepatan').value = p.porsi_ketepatan_waktu;
            document.getElementById('pAmbangMerah').value = p.ambang_merah;
            document.getElementById('pAmbangKuning').value = p.ambang_kuning;
            document.getElementById('pTunjanganSafety').value = p.tunjangan_safety;
            document.getElementById('pTunjanganPengawas').value = p.tunjangan_pengawas;
            document.getElementById('pTunjanganMedis').value = p.tunjangan_medis;
            document.getElementById('pSkorMin').value = p.skor_minimum_tunjangan;
            document.getElementById('pSkorMax').value = p.skor_maksimum_tunjangan;
            document.getElementById('pTunjSafety').checked = !!p.tim_safety_dapat_tunjangan;
            document.getElementById('pTunjPengawas').checked = !!p.tim_pengawas_dapat_tunjangan;
            document.getElementById('pTunjMedis').checked = !!p.tim_medis_dapat_tunjangan;
        }

        async function submitPengaturan(event) {
            event.preventDefault();

            const payload = {
                tahun_aktif: parseInt(document.getElementById('pTahunAktif').value, 10),
                bulan_aktif: parseInt(document.getElementById('pBulanAktif').value, 10),
                tanggal_cutoff_manajer: parseInt(document.getElementById('pCutoffManajer').value, 10),
                periode_manajer_mulai: document.getElementById('pPeriodeManajerMulai').value,
                periode_manajer_selesai: document.getElementById('pPeriodeManajerSelesai').value,
                periode_p2k3_mulai: document.getElementById('pPeriodeP2k3Mulai').value,
                periode_p2k3_selesai: document.getElementById('pPeriodeP2k3Selesai').value,
                hari_kerja_efektif_manajer: parseInt(document.getElementById('pHariKerjaManajer').value, 10),
                hari_kerja_efektif_p2k3: parseInt(document.getElementById('pHariKerjaP2k3').value, 10),
                jumlah_hari_kalender_manajer: parseInt(document.getElementById('pHariKalenderManajer').value, 10),
                jumlah_hari_kalender_p2k3: parseInt(document.getElementById('pHariKalenderP2k3').value, 10),
                batas_terlambat_lapor: parseInt(document.getElementById('pBatasTerlambat').value, 10),
                batas_lapor_lebih_awal: parseInt(document.getElementById('pBatasLebihAwal').value, 10),
                porsi_capaian_aktivitas: parseFloat(document.getElementById('pPorsiCapaian').value),
                porsi_ketepatan_waktu: parseFloat(document.getElementById('pPorsiKetepatan').value),
                tunjangan_safety: parseInt(document.getElementById('pTunjanganSafety').value, 10),
                tunjangan_pengawas: parseInt(document.getElementById('pTunjanganPengawas').value, 10),
                tunjangan_medis: parseInt(document.getElementById('pTunjanganMedis').value, 10),
                skor_minimum_tunjangan: parseFloat(document.getElementById('pSkorMin').value),
                skor_maksimum_tunjangan: parseFloat(document.getElementById('pSkorMax').value),
                tim_safety_dapat_tunjangan: document.getElementById('pTunjSafety').checked,
                tim_pengawas_dapat_tunjangan: document.getElementById('pTunjPengawas').checked,
                tim_medis_dapat_tunjangan: document.getElementById('pTunjMedis').checked,
                ambang_merah: parseFloat(document.getElementById('pAmbangMerah').value),
                ambang_kuning: parseFloat(document.getElementById('pAmbangKuning').value),
            };

            try {
                const res = await fetch(PENGATURAN_ENDPOINT, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    body: JSON.stringify(payload),
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || 'Gagal menyimpan pengaturan');

                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Terjadi kesalahan', 'error');
            }
            return false;
        }

        async function loadSafetyOfficerOptions() {
            if (cachedSafetyOfficers) return cachedSafetyOfficers;
            const res = await fetch(SO_OPTIONS_ENDPOINT, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            cachedSafetyOfficers = await res.json();
            return cachedSafetyOfficers;
        }

        function toggleSoAssignmentSection() {
            document.getElementById('soAssignmentSection').style.display =
                document.getElementById('aSafety').checked ? 'block' : 'none';
        }
        document.getElementById('aSafety').addEventListener('change', toggleSoAssignmentSection);

        async function renderSoAssignmentList(assigned = []) {
            const options = await loadSafetyOfficerOptions();
            const assignedBadges = new Set(assigned.map(a => a.badge));
            const list = document.getElementById('soAssignmentList');

            if (!options.length) {
                list.innerHTML =
                    '<div style="color:#94a3b8;font-size:12px;grid-column:1/-1;">Belum ada safety officer aktif.</div>';
                return;
            }

            list.innerHTML = options.map(so => `
                <label>
                    <input type="checkbox" class="so-check" value="${so.badge}" ${assignedBadges.has(so.badge) ? 'checked' : ''}>
                    <span>
                        <span class="so-name">${escapeHtml(so.nama)}</span><br>
                        <span class="so-badge">${escapeHtml(so.badge)}</span>
                    </span>
                </label>
            `).join('');
        }

        function collectSafetyOfficerPayload() {
            return Array.from(document.querySelectorAll('#soAssignmentList .so-check:checked')).map(chk => chk.value);
        }

        function toggleRekapSoPanel() {
            const body = document.getElementById('rekapSoBody');
            const chevron = document.getElementById('rekapSoChevron');
            const isHidden = body.style.display === 'none';
            body.style.display = isHidden ? 'block' : 'none';
            chevron.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(-90deg)';
            if (isHidden && !rekapSoLoaded) {
                loadRekapSafetyOfficer();
                rekapSoLoaded = true;
            }
        }

        async function loadRekapSafetyOfficer() {
            try {
                const res = await fetch(REKAP_SO_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal mengambil rekap');
                const json = await res.json();
                renderRekapSoTable(json);
            } catch (e) {
                document.getElementById('rekapSoBodyTable').innerHTML =
                    `<tr><td colspan="99" style="text-align:center;color:red;">Error memuat rekap</td></tr>`;
            }
        }

        function renderRekapSoTable(json) {
            const {
                aktivitas,
                officers,
                total_skor_tim
            } = json;

            document.getElementById('rekapSoSummary').innerHTML =
                `<strong>${officers.length}</strong> safety officer aktif · Total skor tim: <strong>${total_skor_tim}</strong>`;

            // Header: Nama + kolom per aktivitas + kolom total
            const head = document.getElementById('rekapSoHead');
            head.innerHTML = `
        <tr>
            <th class="px-6 py-3 text-left" style="min-width:180px;">Safety Officer</th>
            ${aktivitas.map(a => `<th class="px-6 py-3 text-center" title="${escapeHtml(a.nama)} (skor ${a.skor})" style="min-width:44px;">${escapeHtml(a.kode)}</th>`).join('')}
            <th class="px-6 py-3 text-center rekap-total-col">Σ Skor Tugas</th>
            <th class="px-6 py-3 text-center rekap-total-col">Bobot Ditugaskan</th>
            <th class="px-6 py-3 text-center rekap-total-col">Jumlah Tugas</th>
        </tr>`;

            // Body
            const body = document.getElementById('rekapSoBodyTable');
            if (!officers.length) {
                body.innerHTML =
                    `<tr><td colspan="${aktivitas.length + 4}" style="text-align:center;padding:20px;color:#64748b;">Belum ada safety officer aktif</td></tr>`;
                return;
            }

            body.innerHTML = officers.map(so => `
        <tr>
            <td>${escapeHtml(so.nama)}</td>
            ${aktivitas.map(a => {
                const checked = so.checklist[a.kode];
                return `<td class="rekap-check ${checked ? 'yes' : 'no'}">${checked ? '✓' : '–'}</td>`;
            }).join('')}
            <td class="rekap-total-col" style="color:#2563eb;">${so.skor_tugas}</td>
            <td class="rekap-total-col">${so.bobot_ditugaskan}%</td>
            <td class="rekap-total-col">${so.jumlah_tugas}</td>
        </tr>`).join('');
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("{{ session('success') }}", 'success');
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("{{ session('error') }}", 'error');
            });
        </script>
    @endif
</body>


</html>
