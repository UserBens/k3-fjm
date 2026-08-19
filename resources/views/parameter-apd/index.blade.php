<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Parameter APD K3 — PT. Fokus Jasa Mitra</title>
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

    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div id="main-content">

        @include('partials.topbar')

        <div id="page-content">

            <!-- PAGE HEADER -->
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Database K3 · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">PARAMETER SISTEM <span>APD</span></div>
                        <div class="pg-sub">Konstanta perhitungan APD — ubah di sini, seluruh modul (RAB, Matriks APD,
                            60_LOG_APD) ikut menyesuaikan.</div>
                    </div>
                </div>
            </div>

            <!-- ══════ A · SETELAN GLOBAL ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;cursor:pointer;"
                    onclick="togglePanel('globalBody','globalChevron')">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">A · Setelan Global</span>
                    </div>
                    <svg id="globalChevron" style="width:16px;height:16px;color:#64748b;transition:transform .2s;"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div
                    style="display:flex;align-items:center;gap:10px;margin-bottom:14px;padding:10px 12px;background:#F8FAFC;border:1px solid #e2e8f0;border-radius:8px;">
                    <span style="font-size:12px;font-weight:600;color:#475569;">Tahun Anggaran:</span>
                    <input type="number" id="globalPeriodeTahun" class="filter-select" style="width:100px;"
                        onchange="onGlobalPeriodeChange()">
                    <span id="globalPeriodeBadge"
                        style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:4px;"></span>
                </div>

                <div id="globalBody">
                    <form id="formGlobal" onsubmit="return submitGlobal(event)">
                        <div class="pengaturan-grid">
                            <div class="pengaturan-group">
                                <div class="pengaturan-group-title">Cadangan &amp; Pembulatan</div>
                                <div class="pengaturan-field">
                                    <label>Buffer Cadangan Rusak/Hilang (%)</label>
                                    <input type="number" id="gBufferCadangan" min="0" max="100"
                                        step="0.1" required>
                                </div>
                                <div class="pengaturan-field">
                                    <label style="display:flex;align-items:center;gap:6px;">
                                        <input type="checkbox" id="gPembulatanKemasan" style="width:auto;"> Qty
                                        dibulatkan ke atas mengikuti isi kemasan
                                    </label>
                                </div>
                            </div>

                            <div class="pengaturan-group">
                                <div class="pengaturan-group-title">Aturan Kewajiban</div>
                                <div class="pengaturan-field">
                                    <label style="display:flex;align-items:center;gap:6px;">
                                        <input type="checkbox" id="gHitungTandaO" style="width:auto;"> Tanda O
                                        (kondisional) ikut dihitung sebagai wajib
                                    </label>
                                </div>
                                <div class="pengaturan-field">
                                    <label style="display:flex;align-items:center;gap:6px;">
                                        <input type="checkbox" id="gWajibDasarDiHijau" style="width:auto;"> APD Wajib
                                        Dasar berlaku juga di zona HIJAU
                                    </label>
                                </div>
                                <div class="pengaturan-field">
                                    <label style="display:flex;align-items:center;gap:6px;">
                                        <input type="checkbox" id="gPakaiKontrakDulu" style="width:auto;"> RAB
                                        memakai hak kontrak dulu; K3 hanya dipakai bila kontrak tidak mengatur
                                    </label>
                                </div>
                            </div>

                            <div class="pengaturan-group">
                                <div class="pengaturan-group-title">Hari Kerja Baku (nilai acuan tampilan)</div>
                                <div class="pengaturan-field">
                                    <label>Pola NON-SHIFT (hari/tahun)</label>
                                    <input type="number" id="gHariKerjaBaku" min="1" max="366"
                                        required>
                                </div>
                                <div class="pengaturan-field">
                                    <label>Pola SHIFT (hari/tahun)</label>
                                    <input type="number" id="gHariKerjaShift" min="1" max="366"
                                        required>
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
                                Simpan Setelan Global
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ══════ B · BASIS FREKUENSI PENGGANTIAN ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;gap:8px;cursor:pointer;"
                        onclick="togglePanel('basisBody','basisChevron')">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">B · Basis Frekuensi
                            Penggantian</span>
                        <svg id="basisChevron" style="width:16px;height:16px;color:#64748b;transition:transform .2s;"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <button type="button" class="btn-primary"
                        style="background-color:#2563EB;color:white;border:none;padding:6px 12px;border-radius:4px;font-weight:500;cursor:pointer;font-size:12px;"
                        onclick="openBasisModal()">+ Tambah Basis</button>
                </div>
                <div id="basisBody">
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left">Basis Frekuensi</th>
                                    <th class="px-6 py-3 text-left">Rumus per Tahun</th>
                                    <th class="px-6 py-3 text-left">Arti Nilai Basis</th>
                                    <th class="px-6 py-3 text-left">Contoh</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="basisTableBody">
                                <tr class="skeleton-row">
                                    <td colspan="6">
                                        <div class="skeleton-bar" style="width:100%;height:20px;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ══════ B2 · SUMBER FREKUENSI ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;gap:8px;cursor:pointer;"
                        onclick="togglePanel('sumberBody','sumberChevron')">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">B2 · Sumber Frekuensi</span>
                        <svg id="sumberChevron" style="width:16px;height:16px;color:#64748b;transition:transform .2s;"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <button type="button" class="btn-primary"
                        style="background-color:#2563EB;color:white;border:none;padding:6px 12px;border-radius:4px;font-weight:500;cursor:pointer;font-size:12px;"
                        onclick="openSumberModal()">+ Tambah Sumber</button>
                </div>
                <div id="sumberBody">
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left">Sumber Frekuensi</th>
                                    <th class="px-6 py-3 text-center">Bisa Dipertahankan?</th>
                                    <th class="px-6 py-3 text-left">Arti</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sumberTableBody">
                                <tr class="skeleton-row">
                                    <td colspan="5">
                                        <div class="skeleton-bar" style="width:100%;height:20px;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ══════ C · KONVERSI SIMBOL MATRIKS ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;gap:8px;cursor:pointer;"
                        onclick="togglePanel('simbolBody','simbolChevron')">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">C · Konversi Simbol Matriks</span>
                        <svg id="simbolChevron" style="width:16px;height:16px;color:#64748b;transition:transform .2s;"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <button type="button" class="btn-primary"
                        style="background-color:#2563EB;color:white;border:none;padding:6px 12px;border-radius:4px;font-weight:500;cursor:pointer;font-size:12px;"
                        onclick="openSimbolModal()">+ Tambah Simbol</button>
                </div>
                <div id="simbolBody">
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center" style="width:80px;">Simbol</th>
                                    <th class="px-6 py-3 text-center" style="width:80px;">Nilai</th>
                                    <th class="px-6 py-3 text-left">Keterangan</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="simbolTableBody">
                                <tr class="skeleton-row">
                                    <td colspan="4">
                                        <div class="skeleton-bar" style="width:100%;height:20px;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ══════ D · DAFTAR NILAI SAH (SUMBER DROPDOWN) ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;gap:8px;cursor:pointer;"
                        onclick="togglePanel('dropdownBody','dropdownChevron')">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">D · Daftar Nilai Sah (Sumber
                            Dropdown)</span>
                        <svg id="dropdownChevron"
                            style="width:16px;height:16px;color:#64748b;transition:transform .2s;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <button type="button" class="btn-primary"
                        style="background-color:#2563EB;color:white;border:none;padding:6px 12px;border-radius:4px;font-weight:500;cursor:pointer;font-size:12px;"
                        onclick="openNilaiModal()">+ Tambah Nilai</button>
                </div>
                <div id="dropdownBody">
                    <div id="kategoriTabs" class="kategori-tabs"></div>
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center" style="width:60px;">Urutan</th>
                                    <th class="px-6 py-3 text-left">Nilai</th>
                                    <th class="px-6 py-3 text-left">Keterangan</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="nilaiTableBody">
                                <tr class="skeleton-row">
                                    <td colspan="5">
                                        <div class="skeleton-bar" style="width:100%;height:20px;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ══════ E · JENIS TRANSAKSI 60_LOG_APD ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;gap:8px;cursor:pointer;"
                        onclick="togglePanel('transaksiBody','transaksiChevron')">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4M16 17H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span style="font-size:14px;font-weight:700;color:#1e293b;">E · Jenis Transaksi
                            60_LOG_APD</span>
                        <svg id="transaksiChevron"
                            style="width:16px;height:16px;color:#64748b;transition:transform .2s;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <button type="button" class="btn-primary"
                        style="background-color:#2563EB;color:white;border:none;padding:6px 12px;border-radius:4px;font-weight:500;cursor:pointer;font-size:12px;"
                        onclick="openTransaksiModal()">+ Tambah Jenis Transaksi</button>
                </div>
                <div id="transaksiBody">
                    <div class="data-summary" style="margin-bottom:8px;">Pengadaan (SO/PO) diatur di sheet 63/64/65 —
                        daftar ini hanya utk transaksi di 60_LOG_APD.</div>
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left">Jenis Transaksi</th>
                                    <th class="px-6 py-3 text-center">Arah Stok</th>
                                    <th class="px-6 py-3 text-center">Menjadi Limbah?</th>
                                    <th class="px-6 py-3 text-left">Keterangan</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="transaksiTableBody">
                                <tr class="skeleton-row">
                                    <td colspan="6">
                                        <div class="skeleton-bar" style="width:100%;height:20px;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ══════ MODAL B · BASIS FREKUENSI ══════ -->
    <div class="modal-overlay" id="basisModalOverlay" onclick="closeModalOutside(event,'basisModalOverlay')">
        <div class="modal-box form-modal-box" style="max-width:560px;width:92vw;" onclick="event.stopPropagation()">
            <div class="detail-modal-header"
                style="border-bottom:1px solid #e2e8f0;padding-bottom:14px;margin-bottom:16px;">
                <div class="modal-title" id="basisModalTitle" style="font-size:17px;font-weight:700;color:#0f172a;">
                    Tambah Basis Frekuensi</div>
                <button class="toast-close"
                    style="font-size:20px;color:#94a3b8;border:none;background:none;cursor:pointer;"
                    onclick="closeModal('basisModalOverlay')">✕</button>
            </div>
            <form id="formBasis" onsubmit="return submitBasisFrekuensi(event)">
                <input type="hidden" id="bId">
                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;">
                    <div class="detail-field"><label>Kode</label><input type="text" id="bKode"
                            placeholder="cth: PER_SHIFT" required maxlength="30"></div>
                    <div class="detail-field" style="grid-column:span 2;"><label>Basis Frekuensi (label)</label><input
                            type="text" id="bBasisFrekuensi" placeholder="cth: PER SHIFT" required
                            maxlength="255"></div>
                    <div class="detail-field" style="grid-column:span 2;"><label>Rumus per Tahun</label><input
                            type="text" id="bRumusPerTahun" placeholder="cth: hari kerja × shift/hari ÷ nilai"
                            required maxlength="255"></div>
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Arti Nilai Basis</label><input
                            type="text" id="bArtiNilaiBasis" required maxlength="255"></div>
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Contoh</label><input type="text"
                            id="bContoh" maxlength="255"></div>
                    <div class="detail-field"><label>Urutan</label><input type="number" id="bUrutan"
                            min="0" required value="0"></div>
                    <div class="detail-field"><label>Status</label>
                        <select id="bStatus" required>
                            <option value="AKTIF">Aktif</option>
                            <option value="NONAKTIF">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-actions"
                    style="margin-top:20px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" id="btnDeleteBasis" onclick="deleteBasisFrekuensi()"
                        style="display:none;padding:7px 16px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;font-weight:600;">Hapus</button>
                    <div style="display:flex;gap:10px;margin-left:auto;">
                        <button type="button" class="btn-modal-cancel" onclick="closeModal('basisModalOverlay')"
                            style="padding:7px 16px;border-radius:6px;border:1px solid #cbd5e1;background:white;color:#475569;cursor:pointer;font-weight:600;">Batal</button>
                        <button type="submit" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 16px;border-radius:6px;font-weight:600;cursor:pointer;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ══════ MODAL B2 · SUMBER FREKUENSI ══════ -->
    <div class="modal-overlay" id="sumberModalOverlay" onclick="closeModalOutside(event,'sumberModalOverlay')">
        <div class="modal-box form-modal-box" style="max-width:560px;width:92vw;" onclick="event.stopPropagation()">
            <div class="detail-modal-header"
                style="border-bottom:1px solid #e2e8f0;padding-bottom:14px;margin-bottom:16px;">
                <div class="modal-title" id="sumberModalTitle" style="font-size:17px;font-weight:700;color:#0f172a;">
                    Tambah Sumber Frekuensi</div>
                <button class="toast-close"
                    style="font-size:20px;color:#94a3b8;border:none;background:none;cursor:pointer;"
                    onclick="closeModal('sumberModalOverlay')">✕</button>
            </div>
            <form id="formSumber" onsubmit="return submitSumberFrekuensi(event)">
                <input type="hidden" id="suId">
                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;">
                    <div class="detail-field"><label>Kode</label><input type="text" id="suKode"
                            placeholder="cth: UJI_LAPANGAN" required maxlength="30"></div>
                    <div class="detail-field" style="grid-column:span 2;"><label>Sumber Frekuensi
                            (label)</label><input type="text" id="suSumberFrekuensi" required maxlength="255">
                    </div>
                    <div class="detail-field"><label>Bisa Dipertahankan?</label>
                        <select id="suBisaDipertahankan" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Arti</label><input type="text"
                            id="suKeterangan" required maxlength="255"></div>
                    <div class="detail-field"><label>Urutan</label><input type="number" id="suUrutan"
                            min="0" required value="0"></div>
                    <div class="detail-field"><label>Status</label>
                        <select id="suStatus" required>
                            <option value="AKTIF">Aktif</option>
                            <option value="NONAKTIF">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-actions"
                    style="margin-top:20px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" id="btnDeleteSumber" onclick="deleteSumberFrekuensi()"
                        style="display:none;padding:7px 16px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;font-weight:600;">Hapus</button>
                    <div style="display:flex;gap:10px;margin-left:auto;">
                        <button type="button" class="btn-modal-cancel" onclick="closeModal('sumberModalOverlay')"
                            style="padding:7px 16px;border-radius:6px;border:1px solid #cbd5e1;background:white;color:#475569;cursor:pointer;font-weight:600;">Batal</button>
                        <button type="submit" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 16px;border-radius:6px;font-weight:600;cursor:pointer;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ══════ MODAL C · KONVERSI SIMBOL ══════ -->
    <div class="modal-overlay" id="simbolModalOverlay" onclick="closeModalOutside(event,'simbolModalOverlay')">
        <div class="modal-box form-modal-box" style="max-width:480px;width:92vw;" onclick="event.stopPropagation()">
            <div class="detail-modal-header"
                style="border-bottom:1px solid #e2e8f0;padding-bottom:14px;margin-bottom:16px;">
                <div class="modal-title" id="simbolModalTitle" style="font-size:17px;font-weight:700;color:#0f172a;">
                    Tambah Simbol</div>
                <button class="toast-close"
                    style="font-size:20px;color:#94a3b8;border:none;background:none;cursor:pointer;"
                    onclick="closeModal('simbolModalOverlay')">✕</button>
            </div>
            <form id="formSimbol" onsubmit="return submitSimbol(event)">
                <input type="hidden" id="siId">
                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;">
                    <div class="detail-field"><label>Simbol</label><input type="text" id="siSimbol"
                            placeholder="✔ / O / –" required maxlength="5"></div>
                    <div class="detail-field"><label>Nilai</label>
                        <select id="siNilai" required>
                            <option value="1">1</option>
                            <option value="0">0</option>
                        </select>
                    </div>
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Keterangan</label><input
                            type="text" id="siKeterangan" required maxlength="255"></div>
                    <div class="detail-field"><label>Urutan</label><input type="number" id="siUrutan"
                            min="0" required value="0"></div>
                </div>
                <div class="modal-actions"
                    style="margin-top:20px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" id="btnDeleteSimbol" onclick="deleteSimbol()"
                        style="display:none;padding:7px 16px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;font-weight:600;">Hapus</button>
                    <div style="display:flex;gap:10px;margin-left:auto;">
                        <button type="button" class="btn-modal-cancel" onclick="closeModal('simbolModalOverlay')"
                            style="padding:7px 16px;border-radius:6px;border:1px solid #cbd5e1;background:white;color:#475569;cursor:pointer;font-weight:600;">Batal</button>
                        <button type="submit" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 16px;border-radius:6px;font-weight:600;cursor:pointer;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ══════ MODAL D · NILAI DROPDOWN ══════ -->
    <div class="modal-overlay" id="nilaiModalOverlay" onclick="closeModalOutside(event,'nilaiModalOverlay')">
        <div class="modal-box form-modal-box" style="max-width:480px;width:92vw;" onclick="event.stopPropagation()">
            <div class="detail-modal-header"
                style="border-bottom:1px solid #e2e8f0;padding-bottom:14px;margin-bottom:16px;">
                <div class="modal-title" id="nilaiModalTitle" style="font-size:17px;font-weight:700;color:#0f172a;">
                    Tambah Nilai</div>
                <button class="toast-close"
                    style="font-size:20px;color:#94a3b8;border:none;background:none;cursor:pointer;"
                    onclick="closeModal('nilaiModalOverlay')">✕</button>
            </div>
            <form id="formNilai" onsubmit="return submitNilai(event)">
                <input type="hidden" id="nId">
                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;">
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Kategori</label>
                        <select id="nKategori" required
                            onchange="document.getElementById('nilaiModalTitle').dataset.kategori=this.value"></select>
                    </div>
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Nilai (isi dropdown)</label><input
                            type="text" id="nNilai" required maxlength="255"></div>
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Keterangan (opsional)</label><input
                            type="text" id="nKeterangan" maxlength="255"></div>
                    <div class="detail-field"><label>Urutan</label><input type="number" id="nUrutan"
                            min="0" required value="0"></div>
                    <div class="detail-field"><label>Status</label>
                        <select id="nStatus" required>
                            <option value="AKTIF">Aktif</option>
                            <option value="NONAKTIF">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-actions"
                    style="margin-top:20px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" id="btnDeleteNilai" onclick="deleteNilai()"
                        style="display:none;padding:7px 16px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;font-weight:600;">Hapus</button>
                    <div style="display:flex;gap:10px;margin-left:auto;">
                        <button type="button" class="btn-modal-cancel" onclick="closeModal('nilaiModalOverlay')"
                            style="padding:7px 16px;border-radius:6px;border:1px solid #cbd5e1;background:white;color:#475569;cursor:pointer;font-weight:600;">Batal</button>
                        <button type="submit" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 16px;border-radius:6px;font-weight:600;cursor:pointer;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ══════ MODAL E · JENIS TRANSAKSI ══════ -->
    <div class="modal-overlay" id="transaksiModalOverlay" onclick="closeModalOutside(event,'transaksiModalOverlay')">
        <div class="modal-box form-modal-box" style="max-width:560px;width:92vw;" onclick="event.stopPropagation()">
            <div class="detail-modal-header"
                style="border-bottom:1px solid #e2e8f0;padding-bottom:14px;margin-bottom:16px;">
                <div class="modal-title" id="transaksiModalTitle"
                    style="font-size:17px;font-weight:700;color:#0f172a;">Tambah Jenis Transaksi</div>
                <button class="toast-close"
                    style="font-size:20px;color:#94a3b8;border:none;background:none;cursor:pointer;"
                    onclick="closeModal('transaksiModalOverlay')">✕</button>
            </div>
            <form id="formTransaksi" onsubmit="return submitTransaksi(event)">
                <input type="hidden" id="tId">
                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;">
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Jenis Transaksi</label><input
                            type="text" id="tJenisTransaksi" placeholder="cth: PENGGANTIAN - RUSAK" required
                            maxlength="255"></div>
                    <div class="detail-field"><label>Arah Stok</label>
                        <select id="tArahStok" required>
                            <option value="KELUAR">KELUAR</option>
                            <option value="MASUK">MASUK</option>
                            <option value="NETRAL">NETRAL</option>
                        </select>
                    </div>
                    <div class="detail-field"><label>Menjadi Limbah?</label>
                        <select id="tMenjadiLimbah" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="detail-field" style="grid-column: 1 / -1;"><label>Keterangan</label><input
                            type="text" id="tKeterangan" required maxlength="255"></div>
                    <div class="detail-field"><label>Urutan</label><input type="number" id="tUrutan"
                            min="0" required value="0"></div>
                    <div class="detail-field"><label>Status</label>
                        <select id="tStatus" required>
                            <option value="AKTIF">Aktif</option>
                            <option value="NONAKTIF">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-actions"
                    style="margin-top:20px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" id="btnDeleteTransaksi" onclick="deleteTransaksi()"
                        style="display:none;padding:7px 16px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;font-weight:600;">Hapus</button>
                    <div style="display:flex;gap:10px;margin-left:auto;">
                        <button type="button" class="btn-modal-cancel" onclick="closeModal('transaksiModalOverlay')"
                            style="padding:7px 16px;border-radius:6px;border:1px solid #cbd5e1;background:white;color:#475569;cursor:pointer;font-weight:600;">Batal</button>
                        <button type="submit" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 16px;border-radius:6px;font-weight:600;cursor:pointer;">Simpan</button>
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

        .kategori-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 14px;
        }

        .kategori-tab {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .kategori-tab.active {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
        }

        .status-pill {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .sp-green {
            background: #DCFCE7;
            color: #166534;
        }

        .sp-gray {
            background: #f1f5f9;
            color: #64748b;
        }

        .sp-blue {
            background: #dbeafe;
            color: #1e40af;
        }

        .sp-amber {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-row-edit {
            background: transparent;
            border: 1px solid #e2e8f0;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    <script>
        // ══════════════════ ENDPOINTS ══════════════════
        const GLOBAL_SHOW_ENDPOINT = "{{ route('apd.parameter.global.show') }}";
        const GLOBAL_PERIODE_LIST_ENDPOINT = "{{ route('apd.parameter.global.periode-list') }}";
        const GLOBAL_UPDATE_ENDPOINT = "{{ route('apd.parameter.global.update') }}";

        const BASIS_INDEX_ENDPOINT = "{{ route('apd.parameter.basis-frekuensi.index') }}";
        const BASIS_STORE_ENDPOINT = "{{ route('apd.parameter.basis-frekuensi.store') }}";
        const BASIS_UPDATE_BASE = "{{ url('apd/parameter-sistem/basis-frekuensi') }}";

        const SUMBER_INDEX_ENDPOINT = "{{ route('apd.parameter.sumber-frekuensi.index') }}";
        const SUMBER_STORE_ENDPOINT = "{{ route('apd.parameter.sumber-frekuensi.store') }}";
        const SUMBER_UPDATE_BASE = "{{ url('apd/parameter-sistem/sumber-frekuensi') }}";

        const SIMBOL_INDEX_ENDPOINT = "{{ route('apd.parameter.konversi-simbol.index') }}";
        const SIMBOL_STORE_ENDPOINT = "{{ route('apd.parameter.konversi-simbol.store') }}";
        const SIMBOL_UPDATE_BASE = "{{ url('apd/parameter-sistem/konversi-simbol') }}";

        const NILAI_INDEX_ENDPOINT = "{{ route('apd.parameter.nilai-dropdown.index') }}";
        const NILAI_STORE_ENDPOINT = "{{ route('apd.parameter.nilai-dropdown.store') }}";
        const NILAI_UPDATE_BASE = "{{ url('apd/parameter-sistem/nilai-dropdown') }}";

        const TRANSAKSI_INDEX_ENDPOINT = "{{ route('apd.parameter.jenis-transaksi.index') }}";
        const TRANSAKSI_STORE_ENDPOINT = "{{ route('apd.parameter.jenis-transaksi.store') }}";
        const TRANSAKSI_UPDATE_BASE = "{{ url('apd/parameter-sistem/jenis-transaksi') }}";

        const CSRF_TOKEN = "{{ csrf_token() }}";

        let nilaiGrouped = {};
        let nilaiKategoriAktif = null;

        // ══════════════════ UTIL ══════════════════
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function togglePanel(bodyId, chevronId) {
            const body = document.getElementById(bodyId);
            const chevron = document.getElementById(chevronId);
            const isHidden = body.style.display === 'none';
            body.style.display = isHidden ? 'block' : 'none';
            chevron.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(-90deg)';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }

        function closeModalOutside(event, id) {
            if (event.target.id === id) closeModal(id);
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
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

        async function apiFetch(url, options = {}) {
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                ...options,
            });
            const json = await res.json().catch(() => ({}));
            if (!res.ok) throw new Error(json.message || 'Terjadi kesalahan');
            return json;
        }

        // ══════════════════ A · SETELAN GLOBAL ══════════════════
        async function loadGlobalForPeriode(tahun) {
            const json = await apiFetch(`${GLOBAL_SHOW_ENDPOINT}?tahun=${tahun}`);
            fillGlobalForm(json.data);
            const badge = document.getElementById('globalPeriodeBadge');
            if (json.exists) {
                badge.textContent = 'Tersimpan';
                badge.style.background = '#DCFCE7';
                badge.style.color = '#166534';
            } else {
                badge.textContent = 'Belum disimpan — disalin dari tahun terakhir';
                badge.style.background = '#FEF3C7';
                badge.style.color = '#92400E';
            }
        }

        function fillGlobalForm(p) {
            document.getElementById('gBufferCadangan').value = p.buffer_cadangan;
            document.getElementById('gHitungTandaO').checked = !!p.hitung_tanda_o;
            document.getElementById('gWajibDasarDiHijau').checked = !!p.wajib_dasar_di_hijau;
            document.getElementById('gPembulatanKemasan').checked = !!p.pembulatan_kemasan;
            document.getElementById('gHariKerjaBaku').value = p.hari_kerja_baku;
            document.getElementById('gHariKerjaShift').value = p.hari_kerja_shift;
            document.getElementById('gPakaiKontrakDulu').checked = !!p.pakai_kontrak_dulu;
        }

        function onGlobalPeriodeChange() {
            const tahun = parseInt(document.getElementById('globalPeriodeTahun').value, 10);
            if (tahun) loadGlobalForPeriode(tahun);
        }

        async function submitGlobal(event) {
            event.preventDefault();
            const payload = {
                tahun_anggaran: parseInt(document.getElementById('globalPeriodeTahun').value, 10),
                buffer_cadangan: parseFloat(document.getElementById('gBufferCadangan').value),
                hitung_tanda_o: document.getElementById('gHitungTandaO').checked,
                wajib_dasar_di_hijau: document.getElementById('gWajibDasarDiHijau').checked,
                pembulatan_kemasan: document.getElementById('gPembulatanKemasan').checked,
                hari_kerja_baku: parseInt(document.getElementById('gHariKerjaBaku').value, 10),
                hari_kerja_shift: parseInt(document.getElementById('gHariKerjaShift').value, 10),
                pakai_kontrak_dulu: document.getElementById('gPakaiKontrakDulu').checked,
            };
            try {
                const json = await apiFetch(GLOBAL_UPDATE_ENDPOINT, {
                    method: 'PUT',
                    body: JSON.stringify(payload)
                });
                showToast(json.message, 'success');
                loadGlobalForPeriode(payload.tahun_anggaran);
            } catch (e) {
                showToast(e.message, 'error');
            }
            return false;
        }

        // ══════════════════ B · BASIS FREKUENSI ══════════════════
        async function loadBasisFrekuensi() {
            const rows = await apiFetch(BASIS_INDEX_ENDPOINT);
            const tbody = document.getElementById('basisTableBody');
            if (!rows.length) {
                tbody.innerHTML =
                    `<tr><td colspan="6" style="text-align:center;padding:20px;color:#64748b;">Belum ada data</td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td><div class="td-name-main">${escapeHtml(row.basis_frekuensi)}</div><div class="td-name-sub">${escapeHtml(row.kode)}</div></td>
                    <td>${escapeHtml(row.rumus_per_tahun)}</td>
                    <td>${escapeHtml(row.arti_nilai_basis)}</td>
                    <td>${escapeHtml(row.contoh || '-')}</td>
                    <td style="text-align:center;">${statusPill(row.status)}</td>
                    <td style="text-align:center;"><button onclick='openBasisModal(${JSON.stringify(row).replace(/'/g, "&#39;")})' class="btn-row-edit">Edit</button></td>
                </tr>`).join('');
        }

        function openBasisModal(row = null) {
            document.getElementById('formBasis').reset();
            document.getElementById('btnDeleteBasis').style.display = row ? 'inline-block' : 'none';
            document.getElementById('basisModalTitle').textContent = row ? `Edit Basis — ${row.kode}` :
                'Tambah Basis Frekuensi';
            document.getElementById('bId').value = row?.id || '';
            document.getElementById('bKode').value = row?.kode || '';
            document.getElementById('bBasisFrekuensi').value = row?.basis_frekuensi || '';
            document.getElementById('bRumusPerTahun').value = row?.rumus_per_tahun || '';
            document.getElementById('bArtiNilaiBasis').value = row?.arti_nilai_basis || '';
            document.getElementById('bContoh').value = row?.contoh || '';
            document.getElementById('bUrutan').value = row?.urutan ?? 0;
            document.getElementById('bStatus').value = row?.status || 'AKTIF';
            document.getElementById('basisModalOverlay').classList.add('open');
        }

        async function submitBasisFrekuensi(event) {
            event.preventDefault();
            const id = document.getElementById('bId').value;
            const payload = {
                kode: document.getElementById('bKode').value.trim(),
                basis_frekuensi: document.getElementById('bBasisFrekuensi').value.trim(),
                rumus_per_tahun: document.getElementById('bRumusPerTahun').value.trim(),
                arti_nilai_basis: document.getElementById('bArtiNilaiBasis').value.trim(),
                contoh: document.getElementById('bContoh').value.trim() || null,
                urutan: parseInt(document.getElementById('bUrutan').value, 10),
                status: document.getElementById('bStatus').value,
            };
            try {
                const json = await apiFetch(id ? `${BASIS_UPDATE_BASE}/${id}` : BASIS_STORE_ENDPOINT, {
                    method: id ? 'PUT' : 'POST',
                    body: JSON.stringify(payload)
                });
                showToast(json.message, 'success');
                closeModal('basisModalOverlay');
                loadBasisFrekuensi();
            } catch (e) {
                showToast(e.message, 'error');
            }
            return false;
        }

        async function deleteBasisFrekuensi() {
            const id = document.getElementById('bId').value;
            if (!id || !confirm('Yakin ingin menghapus basis frekuensi ini?')) return;
            try {
                const json = await apiFetch(`${BASIS_UPDATE_BASE}/${id}`, {
                    method: 'DELETE'
                });
                showToast(json.message, 'success');
                closeModal('basisModalOverlay');
                loadBasisFrekuensi();
            } catch (e) {
                showToast(e.message, 'error');
            }
        }

        // ══════════════════ B2 · SUMBER FREKUENSI ══════════════════
        async function loadSumberFrekuensi() {
            const rows = await apiFetch(SUMBER_INDEX_ENDPOINT);
            const tbody = document.getElementById('sumberTableBody');
            if (!rows.length) {
                tbody.innerHTML =
                    `<tr><td colspan="5" style="text-align:center;padding:20px;color:#64748b;">Belum ada data</td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td><div class="td-name-main">${escapeHtml(row.sumber_frekuensi)}</div><div class="td-name-sub">${escapeHtml(row.kode)}</div></td>
                    <td style="text-align:center;">${row.bisa_dipertahankan ? '<span class="status-pill sp-green">YA</span>' : '<span class="status-pill sp-amber">TIDAK</span>'}</td>
                    <td>${escapeHtml(row.keterangan)}</td>
                    <td style="text-align:center;">${statusPill(row.status)}</td>
                    <td style="text-align:center;"><button onclick='openSumberModal(${JSON.stringify(row).replace(/'/g, "&#39;")})' class="btn-row-edit">Edit</button></td>
                </tr>`).join('');
        }

        function openSumberModal(row = null) {
            document.getElementById('formSumber').reset();
            document.getElementById('btnDeleteSumber').style.display = row ? 'inline-block' : 'none';
            document.getElementById('sumberModalTitle').textContent = row ? `Edit Sumber — ${row.kode}` :
                'Tambah Sumber Frekuensi';
            document.getElementById('suId').value = row?.id || '';
            document.getElementById('suKode').value = row?.kode || '';
            document.getElementById('suSumberFrekuensi').value = row?.sumber_frekuensi || '';
            document.getElementById('suBisaDipertahankan').value = row ? (row.bisa_dipertahankan ? '1' : '0') : '1';
            document.getElementById('suKeterangan').value = row?.keterangan || '';
            document.getElementById('suUrutan').value = row?.urutan ?? 0;
            document.getElementById('suStatus').value = row?.status || 'AKTIF';
            document.getElementById('sumberModalOverlay').classList.add('open');
        }

        async function submitSumberFrekuensi(event) {
            event.preventDefault();
            const id = document.getElementById('suId').value;
            const payload = {
                kode: document.getElementById('suKode').value.trim(),
                sumber_frekuensi: document.getElementById('suSumberFrekuensi').value.trim(),
                bisa_dipertahankan: document.getElementById('suBisaDipertahankan').value === '1',
                keterangan: document.getElementById('suKeterangan').value.trim(),
                urutan: parseInt(document.getElementById('suUrutan').value, 10),
                status: document.getElementById('suStatus').value,
            };
            try {
                const json = await apiFetch(id ? `${SUMBER_UPDATE_BASE}/${id}` : SUMBER_STORE_ENDPOINT, {
                    method: id ? 'PUT' : 'POST',
                    body: JSON.stringify(payload)
                });
                showToast(json.message, 'success');
                closeModal('sumberModalOverlay');
                loadSumberFrekuensi();
            } catch (e) {
                showToast(e.message, 'error');
            }
            return false;
        }

        async function deleteSumberFrekuensi() {
            const id = document.getElementById('suId').value;
            if (!id || !confirm('Yakin ingin menghapus sumber frekuensi ini?')) return;
            try {
                const json = await apiFetch(`${SUMBER_UPDATE_BASE}/${id}`, {
                    method: 'DELETE'
                });
                showToast(json.message, 'success');
                closeModal('sumberModalOverlay');
                loadSumberFrekuensi();
            } catch (e) {
                showToast(e.message, 'error');
            }
        }

        // ══════════════════ C · KONVERSI SIMBOL ══════════════════
        async function loadKonversiSimbol() {
            const rows = await apiFetch(SIMBOL_INDEX_ENDPOINT);
            const tbody = document.getElementById('simbolTableBody');
            if (!rows.length) {
                tbody.innerHTML =
                    `<tr><td colspan="4" style="text-align:center;padding:20px;color:#64748b;">Belum ada data</td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td style="text-align:center;font-size:18px;font-weight:700;">${escapeHtml(row.simbol)}</td>
                    <td style="text-align:center;font-weight:700;color:#2563eb;">${row.nilai}</td>
                    <td>${escapeHtml(row.keterangan)}</td>
                    <td style="text-align:center;"><button onclick='openSimbolModal(${JSON.stringify(row).replace(/'/g, "&#39;")})' class="btn-row-edit">Edit</button></td>
                </tr>`).join('');
        }

        function openSimbolModal(row = null) {
            document.getElementById('formSimbol').reset();
            document.getElementById('btnDeleteSimbol').style.display = row ? 'inline-block' : 'none';
            document.getElementById('simbolModalTitle').textContent = row ? `Edit Simbol — ${row.simbol}` : 'Tambah Simbol';
            document.getElementById('siId').value = row?.id || '';
            document.getElementById('siSimbol').value = row?.simbol || '';
            document.getElementById('siNilai').value = row ? String(row.nilai) : '1';
            document.getElementById('siKeterangan').value = row?.keterangan || '';
            document.getElementById('siUrutan').value = row?.urutan ?? 0;
            document.getElementById('simbolModalOverlay').classList.add('open');
        }

        async function submitSimbol(event) {
            event.preventDefault();
            const id = document.getElementById('siId').value;
            const payload = {
                simbol: document.getElementById('siSimbol').value.trim(),
                nilai: parseInt(document.getElementById('siNilai').value, 10),
                keterangan: document.getElementById('siKeterangan').value.trim(),
                urutan: parseInt(document.getElementById('siUrutan').value, 10),
            };
            try {
                const json = await apiFetch(id ? `${SIMBOL_UPDATE_BASE}/${id}` : SIMBOL_STORE_ENDPOINT, {
                    method: id ? 'PUT' : 'POST',
                    body: JSON.stringify(payload)
                });
                showToast(json.message, 'success');
                closeModal('simbolModalOverlay');
                loadKonversiSimbol();
            } catch (e) {
                showToast(e.message, 'error');
            }
            return false;
        }

        async function deleteSimbol() {
            const id = document.getElementById('siId').value;
            if (!id || !confirm('Yakin ingin menghapus simbol ini?')) return;
            try {
                const json = await apiFetch(`${SIMBOL_UPDATE_BASE}/${id}`, {
                    method: 'DELETE'
                });
                showToast(json.message, 'success');
                closeModal('simbolModalOverlay');
                loadKonversiSimbol();
            } catch (e) {
                showToast(e.message, 'error');
            }
        }

        // ══════════════════ D · NILAI DROPDOWN (per kategori) ══════════════════
        async function loadNilaiDropdown() {
            const json = await apiFetch(NILAI_INDEX_ENDPOINT);
            nilaiGrouped = json.data;
            if (!nilaiKategoriAktif) nilaiKategoriAktif = json.kategori[0];

            document.getElementById('kategoriTabs').innerHTML = json.kategori.map(k => `
                <div class="kategori-tab ${k === nilaiKategoriAktif ? 'active' : ''}" onclick="switchKategoriTab('${k}')">${k.replace(/_/g, ' ')} (${(nilaiGrouped[k] || []).length})</div>
            `).join('');

            populateKategoriSelect(json.kategori);
            renderNilaiTable();
        }

        function populateKategoriSelect(kategoriList) {
            const select = document.getElementById('nKategori');
            select.innerHTML = kategoriList.map(k => `<option value="${k}">${k.replace(/_/g, ' ')}</option>`).join('');
        }

        function switchKategoriTab(kategori) {
            nilaiKategoriAktif = kategori;
            document.querySelectorAll('.kategori-tab').forEach(el => el.classList.remove('active'));
            event?.target?.classList.add('active');
            renderNilaiTable();
        }

        function renderNilaiTable() {
            const rows = nilaiGrouped[nilaiKategoriAktif] || [];
            const tbody = document.getElementById('nilaiTableBody');
            if (!rows.length) {
                tbody.innerHTML =
                    `<tr><td colspan="5" style="text-align:center;padding:20px;color:#64748b;">Belum ada nilai utk kategori ini</td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td style="text-align:center;">${row.urutan}</td>
                    <td style="font-weight:600;">${escapeHtml(row.nilai)}</td>
                    <td>${escapeHtml(row.keterangan || '-')}</td>
                    <td style="text-align:center;">${statusPill(row.status)}</td>
                    <td style="text-align:center;"><button onclick='openNilaiModal(${JSON.stringify(row).replace(/'/g, "&#39;")})' class="btn-row-edit">Edit</button></td>
                </tr>`).join('');
        }

        function openNilaiModal(row = null) {
            document.getElementById('formNilai').reset();
            document.getElementById('btnDeleteNilai').style.display = row ? 'inline-block' : 'none';
            document.getElementById('nilaiModalTitle').textContent = row ? `Edit Nilai — ${row.nilai}` : 'Tambah Nilai';
            document.getElementById('nId').value = row?.id || '';
            document.getElementById('nKategori').value = row?.kategori || nilaiKategoriAktif;
            document.getElementById('nKategori').disabled = !!row; // kategori tidak bisa diubah saat edit
            document.getElementById('nNilai').value = row?.nilai || '';
            document.getElementById('nKeterangan').value = row?.keterangan || '';
            document.getElementById('nUrutan').value = row?.urutan ?? (nilaiGrouped[nilaiKategoriAktif]?.length || 0) + 1;
            document.getElementById('nStatus').value = row?.status || 'AKTIF';
            document.getElementById('nilaiModalOverlay').classList.add('open');
        }

        async function submitNilai(event) {
            event.preventDefault();
            const id = document.getElementById('nId').value;
            const payload = {
                kategori: document.getElementById('nKategori').value,
                nilai: document.getElementById('nNilai').value.trim(),
                keterangan: document.getElementById('nKeterangan').value.trim() || null,
                urutan: parseInt(document.getElementById('nUrutan').value, 10),
                status: document.getElementById('nStatus').value,
            };
            try {
                const json = await apiFetch(id ? `${NILAI_UPDATE_BASE}/${id}` : NILAI_STORE_ENDPOINT, {
                    method: id ? 'PUT' : 'POST',
                    body: JSON.stringify(payload)
                });
                showToast(json.message, 'success');
                closeModal('nilaiModalOverlay');
                nilaiKategoriAktif = payload.kategori;
                loadNilaiDropdown();
            } catch (e) {
                showToast(e.message, 'error');
            }
            return false;
        }

        async function deleteNilai() {
            const id = document.getElementById('nId').value;
            if (!id || !confirm('Yakin ingin menghapus nilai ini?')) return;
            try {
                const json = await apiFetch(`${NILAI_UPDATE_BASE}/${id}`, {
                    method: 'DELETE'
                });
                showToast(json.message, 'success');
                closeModal('nilaiModalOverlay');
                loadNilaiDropdown();
            } catch (e) {
                showToast(e.message, 'error');
            }
        }

        // ══════════════════ E · JENIS TRANSAKSI ══════════════════
        async function loadJenisTransaksi() {
            const rows = await apiFetch(TRANSAKSI_INDEX_ENDPOINT);
            const tbody = document.getElementById('transaksiTableBody');
            if (!rows.length) {
                tbody.innerHTML =
                    `<tr><td colspan="6" style="text-align:center;padding:20px;color:#64748b;">Belum ada data</td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td style="font-weight:600;">${escapeHtml(row.jenis_transaksi)}</td>
                    <td style="text-align:center;">${arahStokPill(row.arah_stok)}</td>
                    <td style="text-align:center;">${row.menjadi_limbah ? '<span class="status-pill sp-amber">YA</span>' : '<span class="status-pill sp-gray">TIDAK</span>'}</td>
                    <td>${escapeHtml(row.keterangan)}</td>
                    <td style="text-align:center;">${statusPill(row.status)}</td>
                    <td style="text-align:center;"><button onclick='openTransaksiModal(${JSON.stringify(row).replace(/'/g, "&#39;")})' class="btn-row-edit">Edit</button></td>
                </tr>`).join('');
        }

        function openTransaksiModal(row = null) {
            document.getElementById('formTransaksi').reset();
            document.getElementById('btnDeleteTransaksi').style.display = row ? 'inline-block' : 'none';
            document.getElementById('transaksiModalTitle').textContent = row ? `Edit Transaksi — ${row.jenis_transaksi}` :
                'Tambah Jenis Transaksi';
            document.getElementById('tId').value = row?.id || '';
            document.getElementById('tJenisTransaksi').value = row?.jenis_transaksi || '';
            document.getElementById('tArahStok').value = row?.arah_stok || 'KELUAR';
            document.getElementById('tMenjadiLimbah').value = row ? (row.menjadi_limbah ? '1' : '0') : '0';
            document.getElementById('tKeterangan').value = row?.keterangan || '';
            document.getElementById('tUrutan').value = row?.urutan ?? 0;
            document.getElementById('tStatus').value = row?.status || 'AKTIF';
            document.getElementById('transaksiModalOverlay').classList.add('open');
        }

        async function submitTransaksi(event) {
            event.preventDefault();
            const id = document.getElementById('tId').value;
            const payload = {
                jenis_transaksi: document.getElementById('tJenisTransaksi').value.trim(),
                arah_stok: document.getElementById('tArahStok').value,
                menjadi_limbah: document.getElementById('tMenjadiLimbah').value === '1',
                keterangan: document.getElementById('tKeterangan').value.trim(),
                urutan: parseInt(document.getElementById('tUrutan').value, 10),
                status: document.getElementById('tStatus').value,
            };
            try {
                const json = await apiFetch(id ? `${TRANSAKSI_UPDATE_BASE}/${id}` : TRANSAKSI_STORE_ENDPOINT, {
                    method: id ? 'PUT' : 'POST',
                    body: JSON.stringify(payload)
                });
                showToast(json.message, 'success');
                closeModal('transaksiModalOverlay');
                loadJenisTransaksi();
            } catch (e) {
                showToast(e.message, 'error');
            }
            return false;
        }

        async function deleteTransaksi() {
            const id = document.getElementById('tId').value;
            if (!id || !confirm('Yakin ingin menghapus jenis transaksi ini?')) return;
            try {
                const json = await apiFetch(`${TRANSAKSI_UPDATE_BASE}/${id}`, {
                    method: 'DELETE'
                });
                showToast(json.message, 'success');
                closeModal('transaksiModalOverlay');
                loadJenisTransaksi();
            } catch (e) {
                showToast(e.message, 'error');
            }
        }

        // ══════════════════ RENDER HELPERS ══════════════════
        function statusPill(status) {
            return status === 'AKTIF' ? '<span class="status-pill sp-green">AKTIF</span>' :
                '<span class="status-pill sp-gray">NONAKTIF</span>';
        }

        function arahStokPill(arah) {
            const map = {
                KELUAR: 'sp-amber',
                MASUK: 'sp-green',
                NETRAL: 'sp-blue'
            };
            return `<span class="status-pill ${map[arah] || 'sp-gray'}">${arah}</span>`;
        }

        // ══════════════════ INIT ══════════════════
        document.addEventListener('DOMContentLoaded', () => {
            const now = new Date();
            document.getElementById('globalPeriodeTahun').value = now.getFullYear();
            loadGlobalForPeriode(now.getFullYear());
            loadBasisFrekuensi();
            loadSumberFrekuensi();
            loadKonversiSimbol();
            loadNilaiDropdown();
            loadJenisTransaksi();
        });
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
