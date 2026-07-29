<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Registrasi K3 — PT. Fokus Jasa Mitra</title>
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

        .picker-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 50;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            margin-top: 4px;
            max-height: 220px;
            overflow-y: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .picker-dropdown.open {
            display: block;
        }

        .picker-item {
            padding: 8px 12px;
            cursor: pointer;
            font-size: 13px;
        }

        .picker-item:hover {
            background: #f1f5f9;
        }

        .picker-wrap {
            position: relative;
        }

        .picker-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 999;
            /* dinaikkan dari 50, biar aman di atas elemen form modal lain */
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            margin-top: 4px;
            max-height: 220px;
            overflow-y: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .ms-dropdown {
            position: relative;
        }

        .ms-dropdown-btn {
            width: 100%;
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            background: #fff;
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            text-align: left;
        }

        .ms-dropdown-btn:hover {
            border-color: #2D4B9E;
        }

        .ms-dropdown-btn span {
            color: #94A3B8;
        }

        .ms-dropdown-btn.has-value span {
            color: #1A1D2E;
            font-weight: 600;
        }

        .ms-dropdown-panel {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 999;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-top: 4px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 8px;
        }

        .ms-dropdown-panel.open {
            display: block;
        }

        .ms-search {
            width: 100%;
            height: 34px;
            padding: 0 10px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin-bottom: 8px;
            outline: none;
        }

        .ms-search:focus {
            border-color: #2D4B9E;
        }

        .ms-options {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .ms-option-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 8px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12.5px;
            color: #1A1D2E;
        }

        .ms-option-item:hover {
            background: #F0F4FF;
        }

        .ms-option-item.selected {
            background: #EEF2FB;
            font-weight: 700;
        }

        .ms-option-checkbox {
            width: 15px;
            height: 15px;
            border: 1.5px solid #CBD5E1;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: transparent;
        }

        .ms-option-item.selected .ms-option-checkbox {
            background: #2D4B9E;
            border-color: #2D4B9E;
            color: #fff;
        }

        .ms-option-empty {
            padding: 10px 8px;
            font-size: 12px;
            color: #94A3B8;
            text-align: center;
        }

        .ms-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px 4px 10px;
            border-radius: 999px;
            background: #F0F4FF;
            border: 1px solid rgba(45, 75, 158, 0.2);
            font-size: 11.5px;
            font-weight: 600;
            color: #2D4B9E;
        }

        .ms-chip-remove {
            background: none;
            border: none;
            cursor: pointer;
            color: #2D4B9E;
            font-size: 13px;
            line-height: 1;
            padding: 0;
        }

        .ms-chip-remove:hover {
            color: #D0021B;
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
                        <div class="pg-title">DATA REGISTRASI <span>AWAL K3</span></div>
                        <div class="pg-sub">Kelola dan pantau data karyawan yang telah registrasi K3.</div>
                    </div>
                    <div class="pg-actions">
                        <button type="button" class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Registrasi Baru
                        </button>
                    </div>
                </div>
            </div>

            <!-- FILTER BAR -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari Nama, Badge, atau NIK..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterDepartemen" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Departemen</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data registrasi K3...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Data Pegawai</th>
                                <th class="px-6 py-3 text-left">Kontak & NIK</th>
                                <th class="px-6 py-3 text-left">Departemen & Jabatan</th>
                                <th class="px-6 py-3 text-left">Tgl Induction</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr class="skeleton-row">
                                <td colspan="5">
                                    <div class="skeleton-bar" style="width:100%; height:20px;"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
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

    <!-- ══════ MODAL TAMBAH / EDIT REGISTRASI K3 ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" style="width:920px; max-width:96%;" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Registrasi Baru K3</div>
                <div class="detail-subtitle mb-4" id="formModalSub">Lengkapi formulir data dan dokumen K3 di bawah
                    ini.
                </div>
            </div>

            <form id="formRegistrasiK3" onsubmit="return submitForm(event)">
                <div class="form-modal-body" style="max-height:68vh; overflow-y:auto; padding-right:6px;">

                    <!-- BAGIAN 1: INFORMASI DASAR -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <svg style="width:18px;height:18px;color:#2563eb;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informasi Dasar &amp; Personal
                        </div>
                        <div class="grid-3">
                            <div class="form-group">
                                <label class="form-label">Tanggal Induction <span style="color:red">*</span></label>
                                <input type="date" name="tanggal_induction" id="fTanggalInduction"
                                    class="form-input" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nomor Induk Kependudukan (KTP) <span
                                        style="color:red">*</span></label>
                                <input type="text" name="nomor_ktp" id="fNomorKtp" class="form-input"
                                    placeholder="Masukkan 16 digit NIK" required>
                            </div>

                            <div class="form-group span-2">
                                <label class="form-label">Badge / Nama Lengkap <span
                                        style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="pegawaiPickerInput" class="form-input"
                                        placeholder="Cari nama atau nomor badge karyawan..."
                                        oninput="onPegawaiPickerInput()" autocomplete="off" />
                                    <div class="picker-dropdown" id="pegawaiPickerDropdown"></div>
                                </div>
                                <input type="hidden" name="badge" id="fBadge" />
                                <input type="hidden" name="nama_lengkap" id="fNamaLengkap" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nomor Handphone (Aktif/WA) <span
                                        style="color:red">*</span></label>
                                <input type="text" name="nomor_hp" id="fNomorHp" class="form-input"
                                    placeholder="08xxxxxxxxxx" required>
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
                            Data Penempatan &amp; Pekerjaan
                        </div>
                        <div class="grid-3">
                            <div class="form-group">
                                <label class="form-label">PT Asal / Subkon <span style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="ptAsalInput" class="form-input"
                                        placeholder="Cari PT Asal / Subkon..." oninput="onPickerInput('ptAsal')"
                                        onfocus="onPickerFocus('ptAsal')" autocomplete="off" required>
                                    <div class="picker-dropdown" id="ptAsalDropdown"></div>
                                </div>
                                <input type="hidden" name="pt_asal" id="fPtAsal">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Departemen / Unit Kerja <span
                                        style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="departemenInput" class="form-input"
                                        placeholder="Cari Departemen / Unit Kerja..."
                                        oninput="onPickerInput('departemen')" onfocus="onPickerFocus('departemen')"
                                        autocomplete="off" required>
                                    <div class="picker-dropdown" id="departemenDropdown"></div>
                                </div>
                                <input type="hidden" name="departemen" id="fDepartemen">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jabatan <span style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="jabatanInput" class="form-input"
                                        placeholder="Cari Jabatan..." oninput="onPickerInput('jabatan')"
                                        onfocus="onPickerFocus('jabatan')" autocomplete="off" required>
                                    <div class="picker-dropdown" id="jabatanDropdown"></div>
                                </div>
                                <input type="hidden" name="jabatan" id="fJabatan">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Area Kerja <span style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="areaKerjaInput" class="form-input"
                                        placeholder="Cari Area Kerja..." oninput="onPickerInput('areaKerja')"
                                        onfocus="onPickerFocus('areaKerja')" autocomplete="off" required>
                                    <div class="picker-dropdown" id="areaKerjaDropdown"></div>
                                </div>
                                <input type="hidden" name="area_kerja" id="fAreaKerja">
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
                            Lisensi &amp; Kompetensi
                        </div>
                        <div class="grid-2">
                            <div class="form-group">
                                <label class="form-label">Kepemilikan SIM A / C</label>
                                <select name="sim_ac" id="fSimAc" class="form-select">
                                    <option value="">-- Pilih Jenis SIM --</option>
                                    <option value="SIM A">SIM A</option>
                                    <option value="SIM C">SIM C</option>
                                    <option value="SIM A & C">SIM A & C</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">SIO Aktif <span
                                        style="font-weight:normal;color:#64748b;">(Hanya untuk jabatan Operator Alat
                                        Berat)</span></label>
                                <input type="text" name="sio_aktif" id="fSioAktif" class="form-input"
                                    placeholder="Jenis & Nomor SIO (jika ada)">
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
                                <input type="text" name="nama_kontak_darurat" id="fNamaKontakDarurat"
                                    class="form-input" placeholder="Nama lengkap" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Hubungan dengan Karyawan <span
                                        style="color:red">*</span></label>
                                <input type="text" name="hubungan_kontak_darurat" id="fHubunganKontakDarurat"
                                    class="form-input" placeholder="Contoh: Istri, Orang Tua, Kakak" required>
                            </div>

                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label class="form-label">Alamat Kontak Darurat <span
                                        style="color:red">*</span></label>
                                <textarea name="alamat_kontak_darurat" id="fAlamatKontakDarurat" class="form-input"
                                    placeholder="Alamat lengkap domisili kontak darurat" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 5: UPLOAD DOKUMEN -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <svg style="width:18px;height:18px;color:#8b5cf6;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Lampiran File &amp; Dokumen K3
                        </div>
                        <p id="fileHintEdit"
                            style="font-size:12px; color:#64748b; margin-top:-4px; margin-bottom:12px; display:none;">
                            Kosongkan file yang tidak ingin diganti — file lama akan tetap dipertahankan.
                        </p>
                        <div class="grid-2">
                            @php
                                $fileFieldsConfig = [
                                    'foto_diri' => [
                                        'label' => 'Foto Diri (Setengah Badan)',
                                        'accept' => 'image/png, image/jpeg, image/jpg',
                                    ],
                                    'file_ktp' => ['label' => 'File KTP', 'accept' => 'image/*, application/pdf'],
                                    'file_kk' => [
                                        'label' => 'File Kartu Keluarga (KK)',
                                        'accept' => 'image/*, application/pdf',
                                    ],
                                    'file_bpjs' => [
                                        'label' => 'File BPJS (Kesehatan / TK)',
                                        'accept' => 'image/*, application/pdf',
                                    ],
                                    'file_sks' => [
                                        'label' => 'File Surat Keterangan Sehat',
                                        'accept' => 'image/*, application/pdf',
                                    ],
                                    'file_skck' => ['label' => 'File SKCK', 'accept' => 'image/*, application/pdf'],
                                    'file_safety_induction' => [
                                        'label' => 'File Safety Induction',
                                        'accept' => 'image/*, application/pdf',
                                    ],
                                    'file_pakta_integritas' => [
                                        'label' => 'File Pakta Integritas',
                                        'accept' => 'image/*, application/pdf',
                                    ],
                                ];
                            @endphp

                            @foreach ($fileFieldsConfig as $field => $cfg)
                                <div class="form-group">
                                    <label class="form-label">{{ $cfg['label'] }} <span
                                            class="req-star-{{ $field }}" style="color:red">*</span></label>
                                    <input type="file" name="{{ $field }}" id="f_{{ $field }}"
                                        class="form-input" accept="{{ $cfg['accept'] }}">
                                    <span class="file-info">Format:
                                        {{ str_contains($cfg['accept'], 'pdf') ? 'JPG, JPEG, PNG, PDF' : 'JPG, JPEG, PNG' }}</span>
                                    <div id="current_{{ $field }}"
                                        style="margin-top:4px; font-size:12px; display:none;">
                                        <a href="#" target="_blank"
                                            style="color:#2563eb; text-decoration:underline;">Lihat File Saat Ini</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- BAGIAN 6: CHECKLIST APD & UKURAN -->
                    <!-- BAGIAN 6: CHECKLIST APD & UKURAN -->
                    <div class="form-section">
                        <div class="form-section-title">Kelengkapan APD &amp; Ukuran</div>

                        <div class="form-group">
                            <label class="form-label">Checklist APD Dibagikan</label>
                            <div class="ms-dropdown" id="apdChecklistWrap">
                                <button type="button" class="ms-dropdown-btn" id="apdChecklistBtn"
                                    onclick="toggleApdChecklistDropdown()">
                                    <span id="apdChecklistLabel">Pilih APD yang dibagikan...</span>
                                    <svg style="width:13px;height:13px; flex-shrink:0;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="ms-dropdown-panel" id="apdChecklistPanel">
                                    <input type="text" class="ms-search" placeholder="Cari jenis APD..."
                                        oninput="filterApdChecklistOptions(this.value)" />
                                    <div class="ms-options" id="apdChecklistOptionsList"></div>
                                </div>
                            </div>
                            <div id="apdChecklistChips"
                                style="display:flex; flex-wrap:wrap; gap:6px; margin-top:8px;"></div>

                            <div id="apdLainnyaWrap" style="margin-top:8px; display:none;">
                                <input type="text" id="inputLainnya" class="form-input"
                                    placeholder="Sebutkan jenis APD lainnya..." oninput="onApdLainnyaInput()">
                            </div>

                            <div id="checklistApdHiddenInputs"></div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-top: 24px;">
                            <div class="form-group">
                                <label class="form-label">Ukuran Sepatu</label>
                                <input type="text" name="ukuran_sepatu" id="fUkuranSepatu" class="form-input"
                                    placeholder="Cth: 42">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Ukuran Seragam (Atas)</label>
                                <input type="text" name="ukuran_seragam_atas" id="fUkuranSeragamAtas"
                                    class="form-input" placeholder="Cth: L">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Ukuran Seragam (Bawah)</label>
                                <input type="text" name="ukuran_seragam_bawah" id="fUkuranSeragamBawah"
                                    class="form-input" placeholder="Cth: 32">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-actions" style="margin-top:18px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                    <button type="submit" class="btn-modal-confirm" id="btnSubmitForm">Simpan Data
                        Registrasi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL REGISTRASI ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" style="width: 780px; max-width: 95%; padding: 24px;"
            onclick="event.stopPropagation()">

            <!-- HEADER MODAL -->
            <div class="detail-modal-header"
                style="border-bottom: 1px solid #e2e8f0; padding-bottom: 16px; margin-bottom: 16px;">
                <div style="display:flex; align-items:center; gap:14px;">
                    <div class="detail-avatar" id="detailAvatar"
                        style="overflow:hidden; position:relative; width:56px; height:56px; border-radius:50%; display:flex; align-items:center; justify-content:center; background:#cbd5e1; border: 2px solid #3b82f6;">
                        <img id="detailAvatarImg" src="" alt="Foto Diri"
                            style="display:none; width:100%; height:100%; object-fit:cover;">
                        <span id="detailAvatarInitial"
                            style="font-weight:bold; color:#334155; font-size:18px;"></span>
                    </div>
                    <div>
                        <div class="modal-title" id="detailNamaTitle"
                            style="font-size: 18px; font-weight: 700; color: #0f172a;">-</div>
                        <div class="detail-subtitle" id="detailBadgeSub"
                            style="font-size: 13px; color: #64748b; font-weight: 500;">-</div>
                    </div>
                </div>
                <button class="toast-close"
                    style="font-size:20px; color:#94a3b8; border:none; background:none; cursor:pointer;"
                    onclick="closeDetailModal()">✕</button>
            </div>

            <!-- MODAL BODY (SCROLLABLE) -->
            <div class="detail-modal-body" style="max-height: 68vh; overflow-y: auto; padding-right: 8px;">

                <div class="detail-section" style="margin-bottom: 20px;">
                    <div
                        style="font-size:14px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display:flex; align-items:center; gap:6px;">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informasi Dasar &amp; Pekerjaan
                    </div>
                    <div class="detail-form-grid"
                        style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Nomor
                                KTP (NIK)</label>
                            <input type="text" id="dNik" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Nomor
                                HP</label>
                            <input type="text" id="dNoHp" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Tanggal
                                Induction</label>
                            <input type="text" id="dTglInduction" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">PT
                                Asal</label>
                            <input type="text" id="dPtAsal" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Departemen</label>
                            <input type="text" id="dDepartemen" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Jabatan</label>
                            <input type="text" id="dJabatan" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Unit
                                Kerja</label>
                            <input type="text" id="dUnitKerja" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Area
                                Kerja</label>
                            <input type="text" id="dAreaKerja" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                    </div>
                </div>

                <div class="detail-section" style="margin-bottom: 20px;">
                    <div
                        style="font-size:14px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display:flex; align-items:center; gap:6px;">
                        <svg style="width:16px;height:16px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Lisensi, Keahlian &amp; Perlengkapan APD
                    </div>
                    <div class="detail-form-grid"
                        style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">SIM
                                AC</label>
                            <input type="text" id="dSimAc" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">SIO
                                Aktif</label>
                            <input type="text" id="dSioAktif" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Ukuran
                                Sepatu</label>
                            <input type="text" id="dUkuranSepatu" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Seragam
                                Atas / Bawah</label>
                            <input type="text" id="dUkuranSeragam" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field" style="grid-column: span 2;">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Checklist
                                APD yang Diterima</label>
                            <div id="dChecklistApd"
                                style="padding:8px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:12px; color:#334155; min-height:36px; display:flex; flex-wrap:wrap; gap:6px;">
                                -</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section" style="margin-bottom: 20px;">
                    <div
                        style="font-size:14px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display:flex; align-items:center; gap:6px;">
                        <svg style="width:16px;height:16px;color:#dc2626;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Kontak Darurat
                    </div>
                    <div class="detail-form-grid"
                        style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Nama
                                Kontak Darurat</label>
                            <input type="text" id="dNamaDarurat" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Hubungan</label>
                            <input type="text" id="dHubunganDarurat" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                        <div class="detail-field" style="grid-column: span 2;">
                            <label
                                style="font-size:11px; font-weight:600; color:#64748b; text-transform:uppercase;">Alamat
                                Kontak Darurat</label>
                            <input type="text" id="dAlamatDarurat" readonly
                                style="width:100%; padding:7px 10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; font-size:13px;">
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div
                        style="font-size:14px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display:flex; align-items:center; gap:6px;">
                        <svg style="width:16px;height:16px;color:#059669;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Dokumen Lampiran
                    </div>
                    <div
                        style="display:grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 10px;">
                        @php
                            $docList = [
                                ['id' => 'Ktp', 'label' => '1. Dokumen KTP'],
                                ['id' => 'Kk', 'label' => '2. Kartu Keluarga (KK)'],
                                ['id' => 'Bpjs', 'label' => '3. Kartu BPJS'],
                                ['id' => 'Sks', 'label' => '4. Ket. Sehat (SKS)'],
                                ['id' => 'Skck', 'label' => '5. SKCK'],
                                ['id' => 'Induction', 'label' => '6. Safety Induction'],
                                ['id' => 'Pakta', 'label' => '7. Pakta Integritas'],
                            ];
                        @endphp
                        @foreach ($docList as $doc)
                            <div
                                style="padding:10px; border:1px solid #e2e8f0; border-radius:6px; background:#f8fafc; display:flex; align-items:center; justify-content:space-between;">
                                <span
                                    style="font-size:12px; font-weight:600; color:#475569;">{{ $doc['label'] }}</span>
                                <a id="doc{{ $doc['id'] }}" href="#" target="_blank" class="doc-link"
                                    style="font-size:12px; color:#2563eb; text-decoration:underline; font-weight:600;">Lihat
                                    File</a>
                                <span id="empty{{ $doc['id'] }}"
                                    style="font-size:12px; color:#94a3b8; display:none;">Kosong</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- FOOTER MODAL ACTIONS -->
            <div class="modal-actions"
                style="margin-top:20px; border-top: 1px solid #e2e8f0; padding-top: 14px; display:flex; justify-content:flex-end; gap:10px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()"
                    style="padding: 7px 16px; border-radius: 6px; border: 1px solid #cbd5e1; background: white; color: #475569; cursor: pointer; font-weight: 600;">Tutup</button>
                <button type="button" id="btnEditModal" class="btn-primary" onclick="editFromDetail()"
                    style="background-color: #f59e0b; color: white; border: none; padding: 7px 16px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; cursor:pointer;">
                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data Ini
                </button>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST CONTAINER ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- JS LOGIC -->
    <script>
        // ══════ CONFIG ══════
        const DATA_ENDPOINT = "{{ route('registrasi-k3.data') }}";
        const STORE_ENDPOINT = "{{ route('registrasi-k3.store') }}";
        const BASE_ENDPOINT = "{{ url('/registrasi-k3') }}";
        const LOKASI_KERJA_OPTIONS_ENDPOINT = "{{ route('registrasi-k3.lokasi-kerja-options') }}";
        const UNIT_KERJA_OPTIONS_ENDPOINT = "{{ route('registrasi-k3.unit-kerja-options') }}";
        const CARI_PEGAWAI_ENDPOINT = "{{ route('registrasi-k3.cari-pegawai') }}";
        const JABATAN_OPTIONS_ENDPOINT = "{{ route('registrasi-k3.jabatan-options') }}";
        const APD_OPTIONS_ENDPOINT = "{{ route('registrasi-k3.apd-options') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const FILE_FIELDS = [
            'foto_diri', 'file_ktp', 'file_kk', 'file_bpjs',
            'file_sks', 'file_skck', 'file_safety_induction', 'file_pakta_integritas',
        ];

        const state = {
            search: '',
            departemen: '',
            page: 1,
            per_page: 10
        };

        let searchDebounce = null;
        let filterOptionsLoaded = false;
        let lokasiKerjaOptionsCache = [];
        let unitKerjaOptionsCache = [];
        let currentEditId = null;
        let currentDetailRow = null;
        let jabatanOptionsCache = [];
        let apdOptionsCache = [];
        let selectedApdChecklist = []; // array string: jenis_apd terpilih, bisa termasuk "Yang lain"

        function initials(name) {
            if (!name || name === '-') return '—';
            const parts = String(name).trim().split(/\s+/);
            return ((parts[0]?.[0] || '') + (parts[1]?.[0] || '')).toUpperCase();
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
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

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function getApdOptionsWithLainnya() {
            return [
                ...apdOptionsCache.map(a => ({
                    value: a.jenis_apd,
                    kategori: a.kategori
                })),
                {
                    value: 'Yang lain',
                    kategori: null
                },
            ];
        }

        function toggleApdChecklistDropdown() {
            const panel = document.getElementById('apdChecklistPanel');
            const willOpen = !panel.classList.contains('open');
            panel.classList.toggle('open', willOpen);
            if (willOpen) {
                renderApdChecklistOptions('');
                panel.querySelector('.ms-search').value = '';
                panel.querySelector('.ms-search').focus();
            }
        }

        function filterApdChecklistOptions(keyword) {
            renderApdChecklistOptions(keyword.trim());
        }

        function renderApdChecklistOptions(keyword = '') {
            const listEl = document.getElementById('apdChecklistOptionsList');
            const all = getApdOptionsWithLainnya();
            const filtered = keyword ?
                all.filter(o => o.value.toLowerCase().includes(keyword.toLowerCase())) :
                all;

            if (filtered.length === 0) {
                listEl.innerHTML = `<div class="ms-option-empty">Tidak ada APD ditemukan.</div>`;
                return;
            }

            listEl.innerHTML = filtered.map(o => {
                const isSelected = selectedApdChecklist.includes(o.value);
                const badge = o.kategori === 'WAJIB' ?
                    '<span style="color:#D0021B; font-size:10px; font-weight:700; margin-left:4px;">*</span>' :
                    '';
                return `
            <div class="ms-option-item ${isSelected ? 'selected' : ''}" onclick="toggleApdChecklistItem('${o.value.replace(/'/g, "\\'")}')">
                <span class="ms-option-checkbox">${isSelected ? '✓' : ''}</span>
                <span>${escapeHtml(o.value)}${badge}</span>
            </div>
        `;
            }).join('');
        }

        function toggleApdChecklistItem(value) {
            const idx = selectedApdChecklist.indexOf(value);
            if (idx >= 0) {
                selectedApdChecklist.splice(idx, 1);
                if (value === 'Yang lain') {
                    apdLainnyaValue = '';
                    document.getElementById('inputLainnya').value = '';
                }
            } else {
                selectedApdChecklist.push(value);
            }
            renderApdChecklistOptions(document.querySelector('#apdChecklistPanel .ms-search')?.value.trim() || '');
            renderApdChecklistChips();
            syncChecklistApdHiddenInputs();
        }

        function removeApdChecklistItem(value) {
            selectedApdChecklist = selectedApdChecklist.filter(v => v !== value);
            if (value === 'Yang lain') {
                apdLainnyaValue = '';
                document.getElementById('inputLainnya').value = '';
            }
            renderApdChecklistOptions(document.querySelector('#apdChecklistPanel .ms-search')?.value.trim() || '');
            renderApdChecklistChips();
            syncChecklistApdHiddenInputs();
        }

        function renderApdChecklistChips() {
            const chipsEl = document.getElementById('apdChecklistChips');
            const labelEl = document.getElementById('apdChecklistLabel');
            const btnEl = document.getElementById('apdChecklistBtn');
            const lainnyaWrap = document.getElementById('apdLainnyaWrap');

            if (selectedApdChecklist.length === 0) {
                chipsEl.innerHTML = '';
                labelEl.textContent = 'Pilih APD yang dibagikan...';
                btnEl.classList.remove('has-value');
            } else {
                chipsEl.innerHTML = selectedApdChecklist.map(v => `
            <span class="ms-chip">
                ${escapeHtml(v)}
                <button type="button" class="ms-chip-remove" onclick="removeApdChecklistItem('${v.replace(/'/g, "\\'")}')">✕</button>
            </span>
        `).join('');
                labelEl.textContent = `${selectedApdChecklist.length} APD dipilih`;
                btnEl.classList.add('has-value');
            }

            lainnyaWrap.style.display = selectedApdChecklist.includes('Yang lain') ? 'block' : 'none';
        }

        function onApdLainnyaInput() {
            apdLainnyaValue = document.getElementById('inputLainnya').value;
            syncChecklistApdHiddenInputs();
        }

        // Bikin ulang <input type="hidden" name="checklist_apd[]"> sesuai pilihan saat ini,
        // supaya otomatis ikut terkirim lewat FormData saat submit.
        function syncChecklistApdHiddenInputs() {
            const container = document.getElementById('checklistApdHiddenInputs');
            const finalList = selectedApdChecklist
                .filter(v => v !== 'Yang lain')
                .concat(
                    selectedApdChecklist.includes('Yang lain') && apdLainnyaValue.trim() ? [apdLainnyaValue.trim()] : []
                );

            container.innerHTML = finalList.map(v =>
                `<input type="hidden" name="checklist_apd[]" value="${escapeHtml(v)}">`
            ).join('');
        }

        function resetApdChecklist() {
            selectedApdChecklist = [];
            apdLainnyaValue = '';
            document.getElementById('inputLainnya').value = '';
            document.getElementById('apdChecklistPanel').classList.remove('open');
            renderApdChecklistChips();
            syncChecklistApdHiddenInputs();
        }

        // Tutup dropdown kalau klik di luar
        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('apdChecklistWrap');
            if (wrap && !wrap.contains(e.target)) {
                document.getElementById('apdChecklistPanel')?.classList.remove('open');
            }
        });


        // ══════ TOAST NOTIFICATION ══════
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

        async function loadApdOptions() {
            if (apdOptionsCache.length > 0) return;
            try {
                const res = await fetch(APD_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                apdOptionsCache = json.data || [];
            } catch (e) {
                // Diamkan
            }
        }

        function renderChecklistApd() {
            const container = document.getElementById('checklistApdContainer');

            if (apdOptionsCache.length === 0) {
                container.innerHTML =
                    `<div style="grid-column: 1 / -1; font-size:12px; color:#94A3B8;">Data APD tidak tersedia.</div>`;
                return;
            }

            container.innerHTML = apdOptionsCache.map(apd => `
        <label class="checkbox-item">
            <input type="checkbox" name="checklist_apd[]" value="${escapeHtml(apd.jenis_apd)}" class="chk-apd-item">
            ${escapeHtml(apd.jenis_apd)}
            ${apd.kategori === 'WAJIB' ? '<span style="color:#D0021B; font-size:10px; font-weight:700; margin-left:4px;">*</span>' : ''}
        </label>
    `).join('');
        }

        // ══════ DROPDOWN MASTER DATA (PT Asal / Area Kerja ← Lokasi Kerja, Departemen ← Unit Kerja) ══════
        async function loadLokasiKerjaOptions() {
            if (lokasiKerjaOptionsCache.length > 0) return;
            try {
                const res = await fetch(LOKASI_KERJA_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                lokasiKerjaOptionsCache = json.data || [];
            } catch (e) {
                // Diamkan — dropdown tetap tampil kosong tanpa master data
            }
        }

        async function loadUnitKerjaOptions() {
            if (unitKerjaOptionsCache.length > 0) return;
            try {
                const res = await fetch(UNIT_KERJA_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                unitKerjaOptionsCache = json.data || [];
            } catch (e) {
                // Diamkan
            }
        }

        // ══════ GENERIC SEARCHABLE PICKER (PT Asal, Departemen, Jabatan, Area Kerja) ══════
        const PICKER_CONFIG = {
            ptAsal: {
                inputId: 'ptAsalInput',
                dropdownId: 'ptAsalDropdown',
                hiddenId: 'fPtAsal',
                getData: () => lokasiKerjaOptionsCache
            },
            departemen: {
                inputId: 'departemenInput',
                dropdownId: 'departemenDropdown',
                hiddenId: 'fDepartemen',
                getData: () => unitKerjaOptionsCache
            },
            jabatan: {
                inputId: 'jabatanInput',
                dropdownId: 'jabatanDropdown',
                hiddenId: 'fJabatan',
                getData: () => jabatanOptionsCache
            },
            areaKerja: {
                inputId: 'areaKerjaInput',
                dropdownId: 'areaKerjaDropdown',
                hiddenId: 'fAreaKerja',
                getData: () => lokasiKerjaOptionsCache
            },
        };

        function renderPickerDropdown(key, keyword = '') {
            const cfg = PICKER_CONFIG[key];
            const dropdown = document.getElementById(cfg.dropdownId);
            const data = cfg.getData();

            const filtered = keyword ?
                data.filter(v => v.toLowerCase().includes(keyword.toLowerCase())) :
                data;

            if (filtered.length === 0) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#94A3B8;">Tidak ada data ditemukan.</div>`;
            } else {
                dropdown.innerHTML = filtered.map(v => `
            <div class="picker-item" onclick="pilihPickerItem('${key}', '${v.replace(/'/g, "\\'")}')">${escapeHtml(v)}</div>
        `).join('');
            }

            dropdown.classList.add('open');
        }

        function onPickerInput(key) {
            const cfg = PICKER_CONFIG[key];
            const input = document.getElementById(cfg.inputId);
            // Kalau user mengetik ulang, kosongkan hidden value sampai memilih ulang dari list
            document.getElementById(cfg.hiddenId).value = '';
            renderPickerDropdown(key, input.value.trim());
        }

        function onPickerFocus(key) {
            const cfg = PICKER_CONFIG[key];
            const input = document.getElementById(cfg.inputId);
            renderPickerDropdown(key, input.value.trim());
        }

        function pilihPickerItem(key, value) {
            const cfg = PICKER_CONFIG[key];
            document.getElementById(cfg.inputId).value = value;
            document.getElementById(cfg.hiddenId).value = value;
            document.getElementById(cfg.dropdownId).classList.remove('open');
        }

        // Tutup dropdown kalau klik di luar area picker
        document.addEventListener('click', (e) => {
            Object.values(PICKER_CONFIG).forEach(cfg => {
                const wrap = document.getElementById(cfg.inputId)?.closest('.picker-wrap');
                if (wrap && !wrap.contains(e.target)) {
                    document.getElementById(cfg.dropdownId)?.classList.remove('open');
                }
            });
        });

        async function populateJobDropdowns() {
            await Promise.all([loadLokasiKerjaOptions(), loadUnitKerjaOptions(), loadJabatanOptions(),
                loadApdOptions()
            ]);
            renderApdChecklistOptions('');
        }

        async function loadJabatanOptions() {
            if (jabatanOptionsCache.length > 0) return;
            try {
                const res = await fetch(JABATAN_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                jabatanOptionsCache = json.data || [];
            } catch (e) {
                // Diamkan
            }
        }

        // ══════ PICKER PEGAWAI — Badge / Nama Lengkap ══════
        let pegawaiPickerDebounce = null;

        function onPegawaiPickerInput() {
            clearTimeout(pegawaiPickerDebounce);
            pegawaiPickerDebounce = setTimeout(searchPegawaiPicker, 350);
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
                dropdown.innerHTML = (!json.data || json.data.length === 0) ?
                    `<div class="picker-item" style="color:#94A3B8;">Tidak ada karyawan ditemukan.</div>` :
                    json.data.map(p => `
                        <div class="picker-item" onclick='pilihPegawai(${JSON.stringify(p).replace(/'/g, "&#39;")})'>
                            <div class="picker-item-name">${escapeHtml(p.nama)}</div>
                            <div class="picker-item-sub">${escapeHtml(p.badge)} · ${escapeHtml(p.jabatan)} · ${escapeHtml(p.unit_kerja)}</div>
                        </div>`).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihPegawai(p) {
            document.getElementById('fBadge').value = p.badge;
            document.getElementById('fNamaLengkap').value = p.nama;
            document.getElementById('pegawaiPickerInput').value = `${p.nama} (${p.badge})`;
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');

            // Convenience autofill — tetap bisa diedit manual oleh user.
            const jabatanEl = document.getElementById('fJabatan');
            const unitKerjaEl = document.getElementById('fUnitKerja');
            if (!jabatanEl.value && p.jabatan && p.jabatan !== '-') jabatanEl.value = p.jabatan;
            if (!unitKerjaEl.value && p.unit_kerja && p.unit_kerja !== '-') unitKerjaEl.value = p.unit_kerja;
        }

        document.addEventListener('click', (e) => {
            const wrapPegawai = document.getElementById('pegawaiPickerInput')?.closest('.picker-wrap');
            if (wrapPegawai && !wrapPegawai.contains(e.target)) {
                document.getElementById('pegawaiPickerDropdown')?.classList.remove('open');
            }
        });

        // ══════ CHECKLIST APD "Yang Lain" ══════
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

        // ══════ FILTER / SEARCH / PAGINATION ══════
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
            state.search = '';
            state.departemen = '';
            state.page = 1;
            loadData();
        }

        function goToPage(page) {
            state.page = page;
            loadData();
        }

        function populateFilterOptions(options) {
            if (filterOptionsLoaded || !options) return;
            const select = document.getElementById('filterDepartemen');
            const current = select.value;
            (options.departemen || []).forEach(val => {
                const opt = document.createElement('option');
                opt.value = val;
                opt.textContent = val;
                select.appendChild(opt);
            });
            select.value = current;
            filterOptionsLoaded = true;
        }

        // ══════ TABEL ══════
        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');

            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="5" style="text-align:center; padding: 20px; color:#64748b;">Data tidak ditemukan</td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">
                                ${row.foto_diri_url
                                    ? `<img src="${row.foto_diri_url}" alt="Foto" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`
                                    : escapeHtml(initials(row.nama_lengkap))}
                            </div>
                            <div>
                                <div class="td-name-main">${escapeHtml(row.nama_lengkap)}</div>
                                <div class="td-name-sub">
                                    <span style="font-weight:600; color:#475569;">Badge: ${escapeHtml(row.badge)}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600; color:#334155; font-size:13px;">${escapeHtml(row.nomor_hp)}</div>
                        <div class="td-name-sub">NIK: ${escapeHtml(row.nomor_ktp)}</div>
                    </td>
                    <td>
                        <div style="font-weight:600; color:#0f172a; font-size:13px;">${escapeHtml(row.departemen)}</div>
                        <div class="td-name-sub" style="color: #0284c7; font-weight: 500;">Jabatan: ${escapeHtml(row.jabatan)}</div>
                    </td>
                    <td>
                        <span class="status-pill sp-blue">${formatDate(row.tanggal_induction)}</span>
                    </td>
                    <td style="text-align:center; display:flex; justify-content:center; gap:8px;">
                        <button class="btn-detail-tenaga" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'
                                style="background:transparent; border:1px solid #e2e8f0; padding:6px 10px; border-radius:6px; cursor:pointer; color:#475569; display:inline-flex; align-items:center; gap:4px; font-size:12px; font-weight:600;">
                            <svg style="width:14px;height:14px; color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </button>
 
                        <button onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'
                            style="background-color:#f59e0b; color:white; padding:6px 10px; border-radius:6px; cursor:pointer; border:none; display:inline-flex; align-items:center; gap:4px; font-size:12px; font-weight:600;">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> data ditemukan`;

            const container = document.getElementById('paginationPages');
            let html =
                `<button class="page-btn" ${meta.current_page <= 1 ? 'disabled' : ''} onclick="goToPage(${meta.current_page - 1})">‹</button>`;
            html += `<span style="font-size:13px; margin:0 10px;">Hal ${meta.current_page} dari ${meta.last_page}</span>`;
            html +=
                `<button class="page-btn" ${meta.current_page >= meta.last_page ? 'disabled' : ''} onclick="goToPage(${meta.current_page + 1})">›</button>`;

            container.innerHTML = html;
        }

        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.departemen) params.set('departemen', state.departemen);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error("Gagal mengambil data dari server");

                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
                populateFilterOptions(json.filter_options);
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="5" style="text-align:center;color:red;">Error memuat data</td></tr>`;
            }
        }

        // ══════ MODAL TAMBAH / EDIT ══════
        function setFileRequired(required) {
            FILE_FIELDS.forEach(field => {
                const input = document.getElementById(`f_${field}`);
                const star = document.querySelector(`.req-star-${field}`);
                if (required) {
                    input.setAttribute('required', 'true');
                    if (star) star.style.display = '';
                } else {
                    input.removeAttribute('required');
                    if (star) star.style.display = 'none';
                }
                input.value = '';
            });
            document.getElementById('fileHintEdit').style.display = required ? 'none' : 'block';
        }

        function setCurrentFileLinks(row) {
            const map = {
                foto_diri: 'current_foto_diri',
                file_ktp: 'current_file_ktp',
                file_kk: 'current_file_kk',
                file_bpjs: 'current_file_bpjs',
                file_sks: 'current_file_sks',
                file_skck: 'current_file_skck',
                file_safety_induction: 'current_file_safety_induction',
                file_pakta_integritas: 'current_file_pakta_integritas',
            };
            Object.entries(map).forEach(([field, boxId]) => {
                const box = document.getElementById(boxId);
                const url = row ? row[`${field}_url`] : null;
                if (url) {
                    box.querySelector('a').href = url;
                    box.style.display = 'block';
                } else {
                    box.style.display = 'none';
                }
            });
        }

        async function openFormModal(row = null) {
            currentEditId = row ? row.id : null;

            await populateJobDropdowns();

            const form = document.getElementById('formRegistrasiK3');
            form.reset();

            document.getElementById('formModalTitle').textContent = row ? 'Edit Registrasi K3' : 'Registrasi Baru K3';
            document.getElementById('formModalSub').textContent = row ?
                `Perbarui data registrasi ${row.nama_lengkap}` :
                'Lengkapi formulir data dan dokumen K3 di bawah ini.';

            document.getElementById('fTanggalInduction').value = row?.tanggal_induction || '';
            document.getElementById('fNomorKtp').value = row?.nomor_ktp || '';
            document.getElementById('fBadge').value = row?.badge || '';
            document.getElementById('fNamaLengkap').value = row?.nama_lengkap || '';
            document.getElementById('pegawaiPickerInput').value =
                (row?.nama_lengkap && row?.badge) ? `${row.nama_lengkap} (${row.badge})` : '';
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');
            document.getElementById('fNomorHp').value = row?.nomor_hp || '';

            document.getElementById('ptAsalInput').value = row?.pt_asal || '';
            document.getElementById('fPtAsal').value = row?.pt_asal || '';

            document.getElementById('departemenInput').value = row?.departemen || '';
            document.getElementById('fDepartemen').value = row?.departemen || '';

            document.getElementById('jabatanInput').value = row?.jabatan || '';
            document.getElementById('fJabatan').value = row?.jabatan || '';

            document.getElementById('areaKerjaInput').value = row?.area_kerja || '';
            document.getElementById('fAreaKerja').value = row?.area_kerja || '';

            document.getElementById('fSimAc').value = row?.sim_ac || '';
            document.getElementById('fSioAktif').value = row?.sio_aktif || '';

            document.getElementById('fNamaKontakDarurat').value = row?.nama_kontak_darurat || '';
            document.getElementById('fHubunganKontakDarurat').value = row?.hubungan_kontak_darurat || '';
            document.getElementById('fAlamatKontakDarurat').value = row?.alamat_kontak_darurat || '';

            document.getElementById('fUkuranSepatu').value = row?.ukuran_sepatu || '';
            document.getElementById('fUkuranSeragamAtas').value = row?.ukuran_seragam_atas || '';
            document.getElementById('fUkuranSeragamBawah').value = row?.ukuran_seragam_bawah || '';

            // Checklist APD
            // Checklist APD
            resetApdChecklist();

            const apdOptionsInForm = apdOptionsCache.map(a => a.jenis_apd);
            const savedApd = Array.isArray(row?.checklist_apd) ? row.checklist_apd : [];
            const apdLain = savedApd.filter(v => !apdOptionsInForm.includes(v));

            selectedApdChecklist = savedApd.filter(v => apdOptionsInForm.includes(v));

            if (apdLain.length > 0) {
                selectedApdChecklist.push('Yang lain');
                apdLainnyaValue = apdLain.join(', ');
                document.getElementById('inputLainnya').value = apdLainnyaValue;
            }

            renderApdChecklistChips();
            syncChecklistApdHiddenInputs();
            document.getElementById('formModalOverlay').classList.add('open');
        }

        function closeFormModal() {
            document.getElementById('formModalOverlay').classList.remove('open');
            currentEditId = null;
        }

        function closeFormModalOutside(event) {
            if (event.target.id === 'formModalOverlay') closeFormModal();
        }

        async function submitForm(event) {
            event.preventDefault();

            if (!document.getElementById('fBadge').value || !document.getElementById('fNamaLengkap').value) {
                showToast('Silakan pilih karyawan terlebih dahulu (Badge / Nama Lengkap).', 'error');
                return false;
            }

            const btn = document.getElementById('btnSubmitForm');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const form = document.getElementById('formRegistrasiK3');
            const formData = new FormData(form);

            const url = currentEditId ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;
            if (currentEditId) formData.append('_method', 'PUT');

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: formData,
                });

                const json = await res.json();

                if (!res.ok) {
                    const firstError = json.errors ? Object.values(json.errors)[0][0] : null;
                    throw new Error(firstError || json.message || `Server merespons dengan status ${res.status}`);
                }

                closeFormModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Terjadi kesalahan saat menyimpan data.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }

            return false;
        }

        // ══════ MODAL DETAIL ══════
        function bindDocumentLink(linkId, emptyId, url) {
            const linkEl = document.getElementById(linkId);
            const emptyEl = document.getElementById(emptyId);
            if (url) {
                linkEl.href = url;
                linkEl.style.display = 'inline';
                emptyEl.style.display = 'none';
            } else {
                linkEl.style.display = 'none';
                emptyEl.style.display = 'inline';
            }
        }

        function openDetailModal(row) {
            currentDetailRow = row;

            const avatarImg = document.getElementById('detailAvatarImg');
            const avatarInitial = document.getElementById('detailAvatarInitial');

            if (row.foto_diri_url) {
                avatarImg.src = row.foto_diri_url;
                avatarImg.style.display = 'block';
                avatarInitial.style.display = 'none';
            } else {
                avatarImg.style.display = 'none';
                avatarInitial.style.display = 'block';
                avatarInitial.textContent = initials(row.nama_lengkap);
            }

            document.getElementById('detailNamaTitle').textContent = row.nama_lengkap || '-';
            document.getElementById('detailBadgeSub').textContent = `Badge: ${row.badge || '-'}`;

            document.getElementById('dNik').value = row.nomor_ktp || '-';
            document.getElementById('dNoHp').value = row.nomor_hp || '-';
            document.getElementById('dTglInduction').value = formatDate(row.tanggal_induction);
            document.getElementById('dPtAsal').value = row.pt_asal || '-';
            document.getElementById('dDepartemen').value = row.departemen || '-';
            document.getElementById('dJabatan').value = row.jabatan || '-';
            document.getElementById('dUnitKerja').value = row.unit_kerja || '-';
            document.getElementById('dAreaKerja').value = row.area_kerja || '-';

            document.getElementById('dSimAc').value = row.sim_ac || '-';
            document.getElementById('dSioAktif').value = row.sio_aktif || '-';
            document.getElementById('dUkuranSepatu').value = row.ukuran_sepatu || '-';
            document.getElementById('dUkuranSeragam').value =
                `Atas: ${row.ukuran_seragam_atas || '-'} / Bawah: ${row.ukuran_seragam_bawah || '-'}`;

            const apdContainer = document.getElementById('dChecklistApd');
            apdContainer.innerHTML = '';
            const apdArray = Array.isArray(row.checklist_apd) ? row.checklist_apd : [];
            if (apdArray.length > 0) {
                apdArray.forEach(item => {
                    const badge = document.createElement('span');
                    badge.style.cssText =
                        "background:#e2e8f0; color:#334155; padding:2px 8px; border-radius:4px; font-weight:600; font-size:11px;";
                    badge.textContent = item;
                    apdContainer.appendChild(badge);
                });
            } else {
                apdContainer.textContent = 'Tidak ada APD yang tercatat';
            }

            document.getElementById('dNamaDarurat').value = row.nama_kontak_darurat || '-';
            document.getElementById('dHubunganDarurat').value = row.hubungan_kontak_darurat || '-';
            document.getElementById('dAlamatDarurat').value = row.alamat_kontak_darurat || '-';

            bindDocumentLink('docKtp', 'emptyKtp', row.file_ktp_url);
            bindDocumentLink('docKk', 'emptyKk', row.file_kk_url);
            bindDocumentLink('docBpjs', 'emptyBpjs', row.file_bpjs_url);
            bindDocumentLink('docSks', 'emptySks', row.file_sks_url);
            bindDocumentLink('docSkck', 'emptySkck', row.file_skck_url);
            bindDocumentLink('docInduction', 'emptyInduction', row.file_safety_induction_url);
            bindDocumentLink('docPakta', 'emptyPakta', row.file_pakta_integritas_url);

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        function editFromDetail() {
            if (!currentDetailRow) return;
            closeDetailModal();
            openFormModal(currentDetailRow);
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>

    <!-- LISTENER UNTUK FLASH SESSION -->
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
