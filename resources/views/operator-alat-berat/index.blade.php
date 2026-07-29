<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Operator Alat Berat — PT. Fokus Jasa Mitra</title>
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

        .sp-expired {
            background: rgba(208, 2, 27, 0.09);
            color: #D0021B;
        }

        .sp-segera {
            background: rgba(217, 119, 6, 0.09);
            color: #D97706;
        }

        .sp-ok {
            background: rgba(26, 122, 60, 0.09);
            color: #1A7A3C;
        }

        .span-3 {
            grid-column: 1 / -1;
        }

        .multi-picker {
            position: relative;
        }

        .picker-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 6px;
        }

        .picker-chip {
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

        .picker-chip button {
            background: none;
            border: none;
            cursor: pointer;
            color: #2D4B9E;
            font-size: 12px;
            line-height: 1;
            padding: 0;
        }

        .picker-chip button:hover {
            color: #D0021B;
        }

        .picker-dropdown {
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
        }

        .picker-dropdown.open {
            display: block;
        }

        .picker-options {
            max-height: 220px;
            overflow-y: auto;
            padding: 6px;
        }

        .picker-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 8px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12.5px;
            color: #1A1D2E;
        }

        .picker-option:hover {
            background: #F0F4FF;
        }

        .picker-option.checked {
            background: #EEF2FB;
            font-weight: 700;
        }

        .picker-option-check {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            color: #2D4B9E;
            font-size: 11px;
        }

        .picker-empty {
            padding: 10px 8px;
            font-size: 12px;
            color: #94A3B8;
            text-align: center;
        }

        /* ACTION BUTTONS */
        .btn-row-action {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: transparent;
            cursor: pointer;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            margin-right: 6px;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-row-action:hover {
            background: #F8F9FF;
        }

        /* Meratakan teks ke tengah secara vertikal untuk div.form-input */
        div.form-input {
            display: flex;
            align-items: center;
        }

        /* Pengecualian khusus untuk box Keterangan agar teksnya tetap mulai dari atas */
        div#detKeterangan {
            align-items: flex-start;
            padding-top: 10px;
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
                            <span class="pg-eyebrow">Database K3 · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">MASTER OPERATOR <span>ALAT BERAT</span></div>
                        <div class="pg-sub">Kelola data operator, KIB, SIO, dan status monitoring.</div>
                    </div>
                    <div class="pg-actions">
                        <button type="button" class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Operator
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
                        <input type="text" id="searchInput" placeholder="Cari Nama, Badge, atau Kode OK..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterAreaKerja" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Area Kerja</option>
                    </select>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="AKTIF">Aktif</option>
                        <option value="NONAKTIF">Nonaktif</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data operator...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Operator</th>
                                <th class="px-6 py-3 text-left">Area & Unit</th>
                                <th class="px-6 py-3 text-left">Status KIB</th>
                                <th class="px-6 py-3 text-left">Status SIO</th>
                                <th class="px-6 py-3 text-left">Status Pensiun</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr class="skeleton-row">
                                <td colspan="6">
                                    <div class="skeleton-bar" style="width:100%; height:20px;"></div>
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

    <!-- MODAL TAMBAH/EDIT -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" style="width:880px; max-width:96%;" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Operator</div>
                <div class="detail-subtitle mb-2" id="formModalSub">Lengkapi data operator alat berat di bawah ini.
                </div>
            </div>

            <form id="formOperator" onsubmit="return submitForm(event)">
                <div class="form-modal-body" style="max-height:68vh; overflow-y:auto; padding-right:6px;">

                    <div class="form-section">
                        <div class="form-section-title">
                            <svg style="width:18px;height:18px;color:#2563eb;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Data Operator
                        </div>
                        <div class="grid-3">
                            <div class="form-group span-3">
                                <label class="form-label">Badge / Nama Lengkap <span
                                        style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="pegawaiPickerInput" class="form-input"
                                        placeholder="Cari nama atau nomor badge karyawan..."
                                        oninput="onPegawaiPickerInput()" autocomplete="off" />
                                    <div class="picker-dropdown" id="pegawaiPickerDropdown"></div>
                                </div>
                                <input type="hidden" name="badge" id="fBadge" />
                                <input type="hidden" name="nama" id="fNama" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Area Kerja <span style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="areaKerjaInput" class="form-input"
                                        placeholder="Cari area kerja..." oninput="onPickerInput('areaKerja')"
                                        onfocus="onPickerFocus('areaKerja')" autocomplete="off" required>
                                    <div class="picker-dropdown" id="areaKerjaDropdown"></div>
                                </div>
                                <input type="hidden" name="area_kerja" id="fAreaKerja">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kualifikasi <span style="color:red">*</span></label>
                                <div class="picker-wrap">
                                    <input type="text" id="kualifikasiInput" class="form-input"
                                        placeholder="Cari kualifikasi..." oninput="onPickerInput('kualifikasi')"
                                        onfocus="onPickerFocus('kualifikasi')" autocomplete="off" required>
                                    <div class="picker-dropdown" id="kualifikasiDropdown"></div>
                                </div>
                                <input type="hidden" name="kualifikasi" id="fKualifikasi">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jenis Unit Utama <span style="color:red">*</span></label>
                                <input type="text" name="jenis_unit_utama" id="fJenisUnit" class="form-input"
                                    placeholder="Cth: FORKLIFT" required>
                            </div>

                            <div class="form-group"><label class="form-label">Bagian</label><input type="text"
                                    name="bagian" id="fBagian" class="form-input"></div>
                            <div class="form-group"><label class="form-label">Titik Absensi</label><input
                                    type="text" name="titik_absensi" id="fTitikAbsensi" class="form-input"></div>
                            <div class="form-group"><label class="form-label">Pemasok</label><input type="text"
                                    name="pemasok" id="fPemasok" class="form-input" placeholder="Cth: AJG / FJM">
                            </div>
                            <div class="form-group"><label class="form-label">Grup</label><input type="text"
                                    name="grup" id="fGrup" class="form-input" placeholder="A/B/C/D"></div>
                            <div class="form-group">
                                <label class="form-label">Kode OK</label>
                                <div class="multi-picker" data-picker="kodeOk">
                                    <div class="picker-chips" id="chips-kodeOk"></div>
                                    <input type="text" class="form-input" id="kodeOkSearchInput"
                                        placeholder="Cari kode OK..." oninput="pickerSearchKodeOk(this.value)"
                                        onfocus="pickerOpenKodeOk()" autocomplete="off" />
                                    <div class="picker-dropdown" id="dropdown-kodeOk">
                                        <div class="picker-options" id="options-kodeOk"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="kode_ok" id="fKodeOk">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status Operator <span style="color:red">*</span></label>
                                <select name="status_operator" id="fStatusOperator" class="form-select" required>
                                    <option value="AKTIF">AKTIF</option>
                                    <option value="NONAKTIF">NONAKTIF</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="fTanggalLahir" class="form-input">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <svg style="width:18px;height:18px;color:#f59e0b;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Kartu Izin Bekerja (KIB)
                        </div>
                        <div class="grid-2">
                            <div class="form-group"><label class="form-label">Nomor KIB</label><input type="text"
                                    name="nomor_kib" id="fNomorKib" class="form-input"></div>
                            <div class="form-group"><label class="form-label">Masa Berlaku KIB</label><input
                                    type="date" name="masa_berlaku_kib" id="fMasaKib" class="form-input"></div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <svg style="width:18px;height:18px;color:#10b981;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            SIO ke-1
                        </div>
                        <div class="grid-3">
                            <div class="form-group"><label class="form-label">Jenis SIO</label><input type="text"
                                    name="jenis_sio_1" id="fJenisSio1" class="form-input"
                                    placeholder="Cth: WHEEL LOADER"></div>
                            <div class="form-group"><label class="form-label">Nomor SIO</label><input type="text"
                                    name="nomor_sio_1" id="fNomorSio1" class="form-input"></div>
                            <div class="form-group"><label class="form-label">Masa Berlaku</label><input
                                    type="date" name="masa_berlaku_sio_1" id="fMasaSio1" class="form-input">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <svg style="width:18px;height:18px;color:#10b981;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            SIO ke-2
                        </div>
                        <div class="grid-3">
                            <div class="form-group"><label class="form-label">Jenis SIO</label><input type="text"
                                    name="jenis_sio_2" id="fJenisSio2" class="form-input"
                                    placeholder="Cth: FORKLIFT"></div>
                            <div class="form-group"><label class="form-label">Nomor SIO</label><input type="text"
                                    name="nomor_sio_2" id="fNomorSio2" class="form-input"></div>
                            <div class="form-group"><label class="form-label">Masa Berlaku</label><input
                                    type="date" name="masa_berlaku_sio_2" id="fMasaSio2" class="form-input">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <svg style="width:18px;height:18px;color:#8b5cf6;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Keterangan
                        </div>
                        <textarea name="keterangan" id="fKeterangan" class="form-input" placeholder="Catatan tambahan (opsional)"></textarea>
                    </div>

                </div>
                <div class="modal-actions" style="margin-top:18px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                    <button type="submit" class="btn-modal-confirm" id="btnSubmitForm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="detailModalOverlay" class="modal-overlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box form-modal-box" style="width:880px; max-width:96%;" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title">Detail Operator</div>
                <div class="detail-subtitle mb-2">Informasi lengkap data operator alat berat.</div>
            </div>

            <div class="form-modal-body" style="max-height:68vh; overflow-y:auto; padding-right:6px;">
                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#2563eb;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Data Operator
                    </div>
                    <div class="grid-3">
                        <div class="form-group span-3"><label class="form-label">Nama Lengkap</label>
                            <div class="form-input bg-gray-50" id="detNama"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Badge</label>
                            <div class="form-input bg-gray-50" id="detBadge"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Area Kerja</label>
                            <div class="form-input bg-gray-50" id="detAreaKerja"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Kualifikasi</label>
                            <div class="form-input bg-gray-50" id="detKualifikasi"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Jenis Unit Utama</label>
                            <div class="form-input bg-gray-50" id="detJenisUnit"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Bagian</label>
                            <div class="form-input bg-gray-50" id="detBagian"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Titik Absensi</label>
                            <div class="form-input bg-gray-50" id="detTitikAbsensi"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Pemasok</label>
                            <div class="form-input bg-gray-50" id="detPemasok"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Grup</label>
                            <div class="form-input bg-gray-50" id="detGrup"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Kode OK</label>
                            <div class="form-input bg-gray-50" id="detKodeOk"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Status Operator</label>
                            <div class="form-input bg-gray-50" id="detStatus"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Tanggal Lahir</label>
                            <div class="form-input bg-gray-50" id="detTglLahir"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#f59e0b;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Kartu Izin Bekerja (KIB)
                    </div>
                    <div class="grid-2">
                        <div class="form-group"><label class="form-label">Nomor KIB</label>
                            <div class="form-input bg-gray-50" id="detNoKib"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Masa Berlaku KIB</label>
                            <div class="form-input bg-gray-50" id="detMasaKib"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#10b981;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        SIO ke-1
                    </div>
                    <div class="grid-3">
                        <div class="form-group"><label class="form-label">Jenis SIO</label>
                            <div class="form-input bg-gray-50" id="detJenisSio1"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Nomor SIO</label>
                            <div class="form-input bg-gray-50" id="detNoSio1"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Masa Berlaku</label>
                            <div class="form-input bg-gray-50" id="detMasaSio1"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#10b981;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        SIO ke-2
                    </div>
                    <div class="grid-3">
                        <div class="form-group"><label class="form-label">Jenis SIO</label>
                            <div class="form-input bg-gray-50" id="detJenisSio2"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Nomor SIO</label>
                            <div class="form-input bg-gray-50" id="detNoSio2"></div>
                        </div>
                        <div class="form-group"><label class="form-label">Masa Berlaku</label>
                            <div class="form-input bg-gray-50" id="detMasaSio2"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">
                        <svg style="width:18px;height:18px;color:#8b5cf6;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Keterangan
                    </div>
                    <div class="form-input bg-gray-50" style="min-height: 80px;" id="detKeterangan"></div>
                </div>

            </div>
            <div class="modal-actions" style="margin-top:18px;">
                <button type="button" class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('operator-alat-berat.data') }}";
        const STORE_ENDPOINT = "{{ route('operator-alat-berat.store') }}";
        const BASE_ENDPOINT = "{{ url('/operator-alat-berat') }}";
        const AREA_KERJA_OPTIONS_ENDPOINT = "{{ route('operator-alat-berat.area-kerja-options') }}";
        const KUALIFIKASI_OPTIONS_ENDPOINT = "{{ route('operator-alat-berat.kualifikasi-options') }}";
        const CARI_PEGAWAI_ENDPOINT = "{{ route('operator-alat-berat.cari-pegawai') }}";
        const KODE_OK_OPTIONS_ENDPOINT = "{{ route('operator-alat-berat.kode-ok-options') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            area_kerja: '',
            status_operator: '',
            page: 1,
            per_page: 10
        };

        let searchDebounce = null,
            filterOptionsLoaded = false,
            currentEditId = null;
        let areaKerjaOptionsCache = [],
            kualifikasiOptionsCache = [];
        let pegawaiPickerDebounce = null;
        const pickerKodeOk = {
            all: [],
            selected: null
        };
        let kodeOkOptionsLoaded = false;


        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        // KODE OK
        async function ensureKodeOkOptionsLoaded() {
            if (kodeOkOptionsLoaded) return;
            try {
                const res = await fetch(KODE_OK_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                pickerKodeOk.all = json.data || [];
                kodeOkOptionsLoaded = true;
            } catch (e) {
                showToast('Gagal memuat data Kode OK.', 'error');
            }
        }

        function kodeOkLabel(item) {
            return item.uraian_kerja ? `${item.kode_ok} — ${item.uraian_kerja}` : item.kode_ok;
        }

        function renderKodeOkChip() {
            const wrap = document.getElementById('chips-kodeOk');
            if (!pickerKodeOk.selected) {
                wrap.innerHTML = '';
                document.getElementById('fKodeOk').value = '';
                return;
            }
            const item = pickerKodeOk.selected;
            wrap.innerHTML = `
        <span class="picker-chip">
            ${escapeHtml(item.kode_ok)}
            <button type="button" onclick="kodeOkClear()">✕</button>
        </span>`;
            document.getElementById('fKodeOk').value = item.kode_ok;
        }

        function renderKodeOkDropdown(keyword = '') {
            const optionsWrap = document.getElementById('options-kodeOk');
            const kw = keyword.trim().toLowerCase();
            const list = pickerKodeOk.all.filter(item => kodeOkLabel(item).toLowerCase().includes(kw));

            optionsWrap.innerHTML = list.length === 0 ?
                `<div class="picker-empty">Kode OK tidak ditemukan.</div>` :
                list.slice(0, 50).map(item => {
                    const checked = pickerKodeOk.selected?.kode_ok === item.kode_ok;
                    const safeKode = item.kode_ok.replace(/'/g, "\\'");
                    return `
                <div class="picker-option ${checked ? 'checked' : ''}" onclick="kodeOkSelect('${safeKode}')">
                    <span class="picker-option-check">${checked ? '✓' : ''}</span>
                    <span>${escapeHtml(kodeOkLabel(item))}</span>
                </div>`;
                }).join('');
        }

        function kodeOkSelect(kode) {
            const item = pickerKodeOk.all.find(i => i.kode_ok === kode);
            if (!item) return;
            pickerKodeOk.selected = item;
            renderKodeOkChip();
            pickerCloseKodeOk();
            document.getElementById('kodeOkSearchInput').value = '';
        }

        function kodeOkClear() {
            pickerKodeOk.selected = null;
            renderKodeOkChip();
        }

        function resetKodeOkPicker(existingKode = null) {
            pickerKodeOk.selected = existingKode ?
                (pickerKodeOk.all.find(i => i.kode_ok === existingKode) || {
                    kode_ok: existingKode,
                    uraian_kerja: null
                }) :
                null;
            renderKodeOkChip();
            document.getElementById('dropdown-kodeOk').classList.remove('open');
            document.getElementById('kodeOkSearchInput').value = '';
        }

        function pickerOpenKodeOk() {
            renderKodeOkDropdown();
            document.getElementById('dropdown-kodeOk').classList.add('open');
        }

        function pickerCloseKodeOk() {
            document.getElementById('dropdown-kodeOk').classList.remove('open');
        }

        function pickerSearchKodeOk(keyword) {
            renderKodeOkDropdown(keyword);
            document.getElementById('dropdown-kodeOk').classList.add('open');
        }

        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('dropdown-kodeOk');
            if (!dropdown.classList.contains('open')) return;
            const wrap = document.querySelector('[data-picker="kodeOk"]');
            if (wrap && !wrap.contains(e.target)) pickerCloseKodeOk();
        });

        // ══════ PICKER PEGAWAI — Badge / Nama ══════

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
            document.getElementById('fNama').value = p.nama;
            document.getElementById('pegawaiPickerInput').value = `${p.nama} (${p.badge})`;
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');
        }

        document.addEventListener('click', (e) => {
            const wrapPegawai = document.getElementById('pegawaiPickerInput')?.closest('.picker-wrap');
            if (wrapPegawai && !wrapPegawai.contains(e.target)) {
                document.getElementById('pegawaiPickerDropdown')?.classList.remove('open');
            }
        });

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            toast.innerHTML =
                `<div class="toast-body"><div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div><div class="toast-msg">${escapeHtml(message)}</div></div><button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        // ══════ SEARCHABLE PICKER (Area Kerja, Kualifikasi) ══════
        const PICKER_CONFIG = {
            areaKerja: {
                inputId: 'areaKerjaInput',
                dropdownId: 'areaKerjaDropdown',
                hiddenId: 'fAreaKerja',
                getData: () => areaKerjaOptionsCache
            },
            kualifikasi: {
                inputId: 'kualifikasiInput',
                dropdownId: 'kualifikasiDropdown',
                hiddenId: 'fKualifikasi',
                getData: () => kualifikasiOptionsCache
            },
        };

        async function loadAreaKerjaOptions() {
            if (areaKerjaOptionsCache.length > 0) return;
            try {
                const res = await fetch(AREA_KERJA_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                areaKerjaOptionsCache = (await res.json()).data || [];
            } catch (e) {}
        }

        async function loadKualifikasiOptions() {
            if (kualifikasiOptionsCache.length > 0) return;
            try {
                const res = await fetch(KUALIFIKASI_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                kualifikasiOptionsCache = (await res.json()).data || [];
            } catch (e) {}
        }

        function renderPickerDropdown(key, keyword = '') {
            const cfg = PICKER_CONFIG[key];
            const dropdown = document.getElementById(cfg.dropdownId);
            const data = cfg.getData();
            const filtered = keyword ? data.filter(v => v.toLowerCase().includes(keyword.toLowerCase())) : data;
            dropdown.innerHTML = filtered.length === 0 ?
                `<div class="picker-item" style="color:#94A3B8;">Tidak ada data ditemukan.</div>` :
                filtered.map(v =>
                    `<div class="picker-item" onclick="pilihPickerItem('${key}', '${v.replace(/'/g, "\\'")}')">${escapeHtml(v)}</div>`
                ).join('');
            dropdown.classList.add('open');
        }

        function onPickerInput(key) {
            document.getElementById(PICKER_CONFIG[key].hiddenId).value = '';
            renderPickerDropdown(key, document.getElementById(PICKER_CONFIG[key].inputId).value.trim());
        }

        function onPickerFocus(key) {
            renderPickerDropdown(key, document.getElementById(PICKER_CONFIG[key].inputId).value.trim());
        }

        function pilihPickerItem(key, value) {
            const cfg = PICKER_CONFIG[key];
            document.getElementById(cfg.inputId).value = value;
            document.getElementById(cfg.hiddenId).value = value;
            document.getElementById(cfg.dropdownId).classList.remove('open');
        }
        document.addEventListener('click', (e) => {
            Object.values(PICKER_CONFIG).forEach(cfg => {
                const wrap = document.getElementById(cfg.inputId)?.closest('.picker-wrap');
                if (wrap && !wrap.contains(e.target)) document.getElementById(cfg.dropdownId)?.classList
                    .remove('open');
            });
        });

        async function populateDropdowns() {
            await Promise.all([loadAreaKerjaOptions(), loadKualifikasiOptions()]);
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
            state.area_kerja = document.getElementById('filterAreaKerja').value;
            state.status_operator = document.getElementById('filterStatus').value;
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
            document.getElementById('filterAreaKerja').value = '';
            document.getElementById('filterStatus').value = '';
            state.search = '';
            state.area_kerja = '';
            state.status_operator = '';
            state.page = 1;
            loadData();
        }

        function goToPage(page) {
            state.page = page;
            loadData();
        }

        function populateFilterOptions(options) {
            if (filterOptionsLoaded || !options) return;
            const select = document.getElementById('filterAreaKerja');
            (options.area_kerja || []).forEach(val => {
                const opt = document.createElement('option');
                opt.value = val;
                opt.textContent = val;
                select.appendChild(opt);
            });
            filterOptionsLoaded = true;
        }

        function statusBadgeClass(status) {
            if (status === 'EXPIRED' || status === 'PENSIUN') return 'sp-expired';
            if (status === 'SEGERA EXPIRED' || status === 'PENSIUN <2 THN') return 'sp-segera';
            if (status === 'AKTIF' || status === 'AMAN') return 'sp-ok';
            return 'sp-gray';
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="6" style="text-align:center; padding:20px; color:#64748b;">Data tidak ditemukan</td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-main">${escapeHtml(row.nama)}</div>
                        <div class="td-name-sub">Badge: ${escapeHtml(row.badge)} · ${escapeHtml(row.kualifikasi)}</div>
                    </td>
                    <td>
                        <div style="font-weight:600; font-size:13px;">${escapeHtml(row.area_kerja)}</div>
                        <div class="td-name-sub">${escapeHtml(row.jenis_unit_utama)}</div>
                    </td>
                    <td><span class="status-pill ${statusBadgeClass(row.status_kib)}">${escapeHtml(row.status_kib)}</span></td>
                    <td><span class="status-pill ${statusBadgeClass(row.status_monitoring_multi)}">${escapeHtml(row.status_monitoring_multi)} (${row.jumlah_sio})</span></td>
                    <td><span class="status-pill ${statusBadgeClass(row.status_pensiun)}">${escapeHtml(row.status_pensiun)}</span></td>
                   <td style="text-align:center; white-space:nowrap;">
                        <div style="display:flex; justify-content:center; gap:6px;">
                            <button class="btn-row-action" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                                <svg style="width:14px;height:14px; color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </button>
                            <button class="btn-row-action" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                                <svg style="width:14px;height:14px; color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button class="btn-row-action" onclick="deleteOperator(${row.id})">
                                <svg style="width:14px;height:14px; color:#D0021B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent = meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> data ditemukan`;
            const container = document.getElementById('paginationPages');
            container.innerHTML =
                `
                <button class="page-btn" ${meta.current_page <= 1 ? 'disabled' : ''} onclick="goToPage(${meta.current_page - 1})">‹</button>
                <span style="font-size:13px; margin:0 10px;">Hal ${meta.current_page} dari ${meta.last_page}</span>
                <button class="page-btn" ${meta.current_page >= meta.last_page ? 'disabled' : ''} onclick="goToPage(${meta.current_page + 1})">›</button>`;
        }

        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.area_kerja) params.set('area_kerja', state.area_kerja);
            if (state.status_operator) params.set('status_operator', state.status_operator);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error();
                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
                populateFilterOptions(json.filter_options);
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="6" style="text-align:center;color:red;">Error memuat data</td></tr>`;
            }
        }

        // ══════ MODAL DETAIL ══════
        function openDetailModal(row) {
            document.getElementById('detNama').textContent = row.nama || '-';
            document.getElementById('detBadge').textContent = row.badge || '-';
            document.getElementById('detAreaKerja').textContent = row.area_kerja || '-';
            document.getElementById('detKualifikasi').textContent = row.kualifikasi || '-';
            document.getElementById('detJenisUnit').textContent = row.jenis_unit_utama || '-';
            document.getElementById('detBagian').textContent = row.bagian || '-';
            document.getElementById('detTitikAbsensi').textContent = row.titik_absensi || '-';
            document.getElementById('detPemasok').textContent = row.pemasok || '-';
            document.getElementById('detGrup').textContent = row.grup || '-';
            document.getElementById('detKodeOk').textContent = row.kode_ok || '-';
            document.getElementById('detStatus').textContent = row.status_operator || '-';
            document.getElementById('detTglLahir').textContent = row.tanggal_lahir || '-';

            document.getElementById('detNoKib').textContent = row.nomor_kib || '-';
            document.getElementById('detMasaKib').textContent = row.masa_berlaku_kib || '-';

            document.getElementById('detJenisSio1').textContent = row.jenis_sio_1 || '-';
            document.getElementById('detNoSio1').textContent = row.nomor_sio_1 || '-';
            document.getElementById('detMasaSio1').textContent = row.masa_berlaku_sio_1 || '-';

            document.getElementById('detJenisSio2').textContent = row.jenis_sio_2 || '-';
            document.getElementById('detNoSio2').textContent = row.nomor_sio_2 || '-';
            document.getElementById('detMasaSio2').textContent = row.masa_berlaku_sio_2 || '-';

            document.getElementById('detKeterangan').textContent = row.keterangan || '-';

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        // ══════ MODAL TAMBAH / EDIT ══════
        async function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            await populateDropdowns();

            const form = document.getElementById('formOperator');
            form.reset();

            document.getElementById('formModalTitle').textContent = row ? 'Edit Operator' : 'Tambah Operator';
            document.getElementById('formModalSub').textContent = row ? `Perbarui data ${row.nama}` :
                'Lengkapi data operator alat berat di bawah ini.';

            document.getElementById('fBadge').value = row?.badge || '';
            document.getElementById('fNama').value = row?.nama || '';
            document.getElementById('pegawaiPickerInput').value =
                (row?.nama && row?.badge) ? `${row.nama} (${row.badge})` : '';
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');
            document.getElementById('areaKerjaInput').value = row?.area_kerja || '';
            document.getElementById('fAreaKerja').value = row?.area_kerja || '';
            document.getElementById('kualifikasiInput').value = row?.kualifikasi || '';
            document.getElementById('fKualifikasi').value = row?.kualifikasi || '';

            document.getElementById('fJenisUnit').value = row?.jenis_unit_utama || '';
            document.getElementById('fBagian').value = row?.bagian || '';
            document.getElementById('fTitikAbsensi').value = row?.titik_absensi || '';
            document.getElementById('fPemasok').value = row?.pemasok || '';
            document.getElementById('fGrup').value = row?.grup || '';
            await ensureKodeOkOptionsLoaded();
            resetKodeOkPicker(row?.kode_ok || null);
            document.getElementById('fStatusOperator').value = row?.status_operator || 'AKTIF';
            document.getElementById('fTanggalLahir').value = row?.tanggal_lahir || '';

            document.getElementById('fNomorKib').value = row?.nomor_kib || '';
            document.getElementById('fMasaKib').value = row?.masa_berlaku_kib || '';

            document.getElementById('fJenisSio1').value = row?.jenis_sio_1 || '';
            document.getElementById('fNomorSio1').value = row?.nomor_sio_1 || '';
            document.getElementById('fMasaSio1').value = row?.masa_berlaku_sio_1 || '';

            document.getElementById('fJenisSio2').value = row?.jenis_sio_2 || '';
            document.getElementById('fNomorSio2').value = row?.nomor_sio_2 || '';
            document.getElementById('fMasaSio2').value = row?.masa_berlaku_sio_2 || '';

            document.getElementById('fKeterangan').value = row?.keterangan || '';

            Object.values(PICKER_CONFIG).forEach(cfg => document.getElementById(cfg.dropdownId)?.classList.remove(
                'open'));
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
            if (!document.getElementById('fBadge').value || !document.getElementById('fNama').value) {
                showToast('Silakan pilih pegawai terlebih dahulu (Badge / Nama).', 'error');
                return false;
            }
            const btn = document.getElementById('btnSubmitForm');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const form = document.getElementById('formOperator');
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
                    body: formData
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

        async function deleteOperator(id) {
            if (!confirm('Yakin ingin menghapus data operator ini?')) return;
            try {
                const res = await fetch(`${BASE_ENDPOINT}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menghapus data.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
