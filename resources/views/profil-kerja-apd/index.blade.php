<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Profil Kerja APD — PT. Fokus Jasa Mitra</title>
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
                        <div class="pg-title">PROFIL KERJA & MATRIKS <span>BAHAYA</span></div>
                        <div class="pg-sub">Kelola profil jabatan, skor paparan bahaya B1–B8, dan tingkat risiko tiap
                            profil kerja.</div>
                    </div>
                    <div class="pg-actions">
                        <button type="button" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 14px;border-radius:4px;display:inline-flex;align-items:center;gap:6px;font-weight:500;cursor:pointer;"
                            onclick="openProfilModal()">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Profil
                        </button>
                    </div>
                </div>
            </div>

            <!-- ══════ RINGKASAN ══════ -->
            <div class="ringkasan-cards" id="ringkasanCards"></div>

            <!-- ══════ FILTER + TABEL PROFIL ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput"
                            placeholder="Cari Kode, Nama Profil, atau Contoh Jabatan..." oninput="onSearchInput()" />
                    </div>

                    <select id="filterTier" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Tier</option>
                        <option value="0">Tier 0 — Tidak Ada / Belum Dipetakan</option>
                        <option value="1">Tier 1 — Rendah</option>
                        <option value="2">Tier 2 — Sedang</option>
                        <option value="3">Tier 3 — Tinggi</option>
                        <option value="4">Tier 4 — Sangat Tinggi</option>
                    </select>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="AKTIF">Aktif</option>
                        <option value="NONAKTIF">Nonaktif</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data profil kerja...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Kode / Profil</th>
                                <th class="px-6 py-3 text-center" colspan="8">B1–B8</th>
                                <th class="px-6 py-3 text-center">Skor Tertinggi</th>
                                <th class="px-6 py-3 text-center">Skor Total</th>
                                <th class="px-6 py-3 text-center">Bahaya Sedang↑</th>
                                <th class="px-6 py-3 text-center">Tier Risiko</th>
                                <th class="px-6 py-3 text-left">Bahaya Pengendali</th>
                                <th class="px-6 py-3 text-center">Karyawan</th>
                                <th class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr class="skeleton-row">
                                <td colspan="16">
                                    <div class="skeleton-bar" style="width:100%; height:20px;"></div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot id="tableFoot"></tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- ══════ MODAL TAMBAH / EDIT PROFIL ══════ -->
    <div class="modal-overlay" id="profilModalOverlay" onclick="closeProfilModalOutside(event)">
        <div class="modal-box form-modal-box" style="max-width:1100px;width:92vw;max-height:90vh;overflow:auto;"
            onclick="event.stopPropagation()">

            <div class="detail-modal-header"
                style="border-bottom:1px solid #e2e8f0;padding-bottom:14px;margin-bottom:16px;">
                <div class="modal-title" id="profilModalTitle" style="font-size:17px;font-weight:700;color:#0f172a;">
                    Tambah Profil Kerja</div>
                <button class="toast-close"
                    style="font-size:20px;color:#94a3b8;border:none;background:none;cursor:pointer;"
                    onclick="closeProfilModal()">✕</button>
            </div>

            <form id="formProfil" onsubmit="return submitProfil(event)">
                <input type="hidden" id="pId">

                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;">
                    <div class="detail-field">
                        <label>Kode Profil</label>
                        <input type="text" id="pKodeProfil" placeholder="cth: P15" required maxlength="10">
                    </div>
                    <div class="detail-field" style="grid-column:span 2;">
                        <label>Nama Profil</label>
                        <input type="text" id="pNamaProfil" required maxlength="255">
                    </div>
                    <div class="detail-field">
                        <label>Jumlah Karyawan</label>
                        <input type="number" id="pJmlKaryawan" min="0" required value="0">
                    </div>
                    <div class="detail-field">
                        <label>Status</label>
                        <select id="pStatus" required>
                            <option value="AKTIF">Aktif</option>
                            <option value="NONAKTIF">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div style="margin-top:16px;">
                    <div class="pengaturan-group-title">Matriks Bahaya (B1–B8) — skala 0 (tidak ada) s/d 4 (tertinggi)
                    </div>
                    <div id="bMatrixGrid"
                        style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:12px;"></div>
                </div>

                <div
                    style="margin-top:14px;padding:12px;background:#F8FAFC;border:1px solid #e2e8f0;border-radius:8px;display:flex;flex-wrap:wrap;gap:18px;align-items:center;">
                    <div><span style="font-size:11px;color:#64748b;font-weight:600;">SKOR TERTINGGI</span>
                        <div id="pPreviewSkorTertinggi" style="font-size:18px;font-weight:800;color:#0f172a;">0</div>
                    </div>
                    <div><span style="font-size:11px;color:#64748b;font-weight:600;">SKOR TOTAL</span>
                        <div id="pPreviewSkorTotal" style="font-size:18px;font-weight:800;color:#0f172a;">0</div>
                    </div>
                    <div><span style="font-size:11px;color:#64748b;font-weight:600;">BAHAYA SEDANG↑</span>
                        <div id="pPreviewBahayaSedang" style="font-size:18px;font-weight:800;color:#0f172a;">0</div>
                    </div>
                    <div><span style="font-size:11px;color:#64748b;font-weight:600;">TIER RISIKO</span>
                        <div id="pPreviewTier"
                            style="font-size:13px;font-weight:700;padding:2px 10px;border-radius:5px;display:inline-block;">
                            -</div>
                    </div>
                    <div style="flex:1;min-width:180px;"><span
                            style="font-size:11px;color:#64748b;font-weight:600;">BAHAYA PENGENDALI</span>
                        <div id="pPreviewPengendali" style="font-size:13px;font-weight:700;color:#0f172a;">-</div>
                    </div>
                </div>

                <div class="detail-form-grid"
                    style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:14px;">
                    <div class="detail-field">
                        <label>Deskripsi Paparan</label>
                        <textarea id="pDeskripsiPaparan" rows="3"
                            style="width:100%;padding:7px 10px;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;"></textarea>
                    </div>
                    <div class="detail-field">
                        <label>Contoh Jabatan</label>
                        <textarea id="pContohJabatan" rows="3"
                            style="width:100%;padding:7px 10px;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;"></textarea>
                    </div>
                    <div class="detail-field">
                        <label>Dasar Penilaian</label>
                        <textarea id="pDasarPenilaian" rows="2"
                            style="width:100%;padding:7px 10px;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;"></textarea>
                    </div>
                    <div class="detail-field">
                        <label>Sumber Skor</label>
                        <input type="text" id="pSumberSkor" maxlength="255"
                            placeholder="PENILAIAN K3 PT FJM — perlu divalidasi Ahli K3">
                    </div>
                </div>

                <div class="modal-actions"
                    style="margin-top:20px;border-top:1px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;gap:10px;">
                    <button type="button" id="btnDeleteProfil" onclick="deleteProfil()"
                        style="display:none;padding:7px 16px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;font-weight:600;">Hapus</button>
                    <div style="display:flex;gap:10px;margin-left:auto;">
                        <button type="button" class="btn-modal-cancel" onclick="closeProfilModal()"
                            style="padding:7px 16px;border-radius:6px;border:1px solid #cbd5e1;background:white;color:#475569;cursor:pointer;font-weight:600;">Batal</button>
                        <button type="submit" class="btn-primary"
                            style="background-color:#2563EB;color:white;border:none;padding:7px 16px;border-radius:6px;font-weight:600;cursor:pointer;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <style>
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
            border-left: 4px solid #cbd5e1;
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

        .pengaturan-group-title {
            font-size: 12px;
            font-weight: 700;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: .03em;
            margin-bottom: 10px;
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

        .b-cell-input {
            width: 56px;
            padding: 6px;
            text-align: center;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-weight: 700;
        }

        .b-mini-grid {
            display: flex;
            gap: 2px;
            justify-content: center;
        }

        .b-mini {
            width: 16px;
            height: 16px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .tier-badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
        }
    </style>

    <script>
        const API_ENDPOINT = "{{ route('k3.profil-kerja.api') }}";
        const STORE_ENDPOINT = "{{ route('k3.profil-kerja.store') }}";
        const UPDATE_ENDPOINT_BASE = "{{ url('k3/profil-kerja') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        // Harus sinkron dengan ProfilKerjaK3::LABEL_BAHAYA / LABEL_TIER / WARNA_TIER di backend
        const LABEL_BAHAYA = {
            1: 'B1 Kimia cair / korosif',
            2: 'B2 Kimia gas, uap & fume',
            3: 'B3 Debu & partikulat',
            4: 'B4 Kebisingan',
            5: 'B5 Mekanis & benda tajam',
            6: 'B6 Jatuh & ketinggian',
            7: 'B7 Panas, api & radiasi',
            8: 'B8 Listrik',
        };
        const LABEL_TIER = {
            0: 'Tidak Ada',
            1: 'Rendah',
            2: 'Sedang',
            3: 'Tinggi',
            4: 'Sangat Tinggi'
        };
        const WARNA_TIER = {
            0: '#94a3b8',
            1: '#16a34a',
            2: '#ca8a04',
            3: '#ea580c',
            4: '#dc2626'
        };
        const AMBANG_BAHAYA_SEDANG = 2;

        const state = {
            search: '',
            tier: '',
            status: ''
        };
        let searchDebounce = null;
        let latestSummary = null;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
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
                <button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
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
            state.tier = document.getElementById('filterTier').value;
            state.status = document.getElementById('filterStatus').value;
            loadData();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterTier').value = '';
            document.getElementById('filterStatus').value = '';
            state.search = '';
            state.tier = '';
            state.status = '';
            loadData();
        }

        // ══════ RENDER RINGKASAN ══════
        function renderRingkasan(summary) {
            latestSummary = summary;
            const el = document.getElementById('ringkasanCards');
            let cards = `
                <div class="ringkasan-card" style="border-left-color:#2563eb;">
                    <div class="rc-label">Total Profil Kerja</div>
                    <div class="rc-value">${summary.total_profil}</div>
                    <div class="rc-sub">Total karyawan tertaut: ${summary.total_karyawan}</div>
                </div>`;
            for (let t = 4; t >= 1; t--) {
                const jml = summary.jml_per_tier?.[t] || 0;
                const kry = summary.karyawan_per_tier?.[t] || 0;
                cards += `
                <div class="ringkasan-card" style="border-left-color:${WARNA_TIER[t]};">
                    <div class="rc-label">Tier ${t} — ${LABEL_TIER[t]}</div>
                    <div class="rc-value" style="color:${WARNA_TIER[t]};">${jml}</div>
                    <div class="rc-sub">${kry} karyawan</div>
                </div>`;
            }
            el.innerHTML = cards;
        }

        // ══════ RENDER TABLE ══════
        function bMiniCell(v) {
            const colors = {
                0: '#e2e8f0',
                1: '#86efac',
                2: '#fde047',
                3: '#fb923c',
                4: '#f87171'
            };
            const textColor = v === 0 ? '#64748b' : '#1e293b';
            return `<div class="b-mini" style="background:${colors[v] ?? '#e2e8f0'};color:${textColor};" title="Nilai ${v}">${v}</div>`;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="16" style="text-align:center;padding:20px;color:#64748b;">Data tidak ditemukan</td></tr>`;
                document.getElementById('tableFoot').innerHTML = '';
                return;
            }

            tbody.innerHTML = rows.map(row => {
                const bCells = [row.b1, row.b2, row.b3, row.b4, row.b5, row.b6, row.b7, row.b8]
                    .map(v => `<td style="text-align:center;padding:4px;">${bMiniCell(v)}</td>`).join('');

                const statusPill = row.status === 'AKTIF' ?
                    '<span class="status-pill sp-green">AKTIF</span>' :
                    '<span class="status-pill" style="background:#f1f5f9;color:#64748b;">NONAKTIF</span>';

                return `
                <tr>
                    <td>
                        <div class="td-name-main">${escapeHtml(row.kode_profil)} — ${escapeHtml(row.nama_profil)}</div>
                        <div class="td-name-sub">${escapeHtml((row.contoh_jabatan || '').slice(0, 60))}</div>
                    </td>
                    ${bCells}
                    <td style="text-align:center;font-weight:800;color:#2563eb;">${row.skor_tertinggi}</td>
                    <td style="text-align:center;font-weight:700;">${row.skor_total}</td>
                    <td style="text-align:center;">${row.jml_bahaya_sedang}</td>
                    <td style="text-align:center;"><span class="tier-badge" style="background:${row.warna_tier};">T${row.tier_risiko} · ${escapeHtml(row.label_tier)}</span></td>
                    <td style="font-size:12px;">${escapeHtml(row.bahaya_pengendali)}</td>
                    <td style="text-align:center;">${row.jml_karyawan}</td>
                    <td style="text-align:center;">${statusPill}</td>
                    <td style="text-align:center;">
                        <button onclick='openProfilModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'
                            style="background:transparent;border:1px solid #e2e8f0;padding:6px 10px;border-radius:6px;cursor:pointer;color:#475569;font-size:12px;font-weight:600;">
                            Edit
                        </button>
                    </td>
                </tr>`;
            }).join('');

            document.getElementById('tableFoot').innerHTML = `
                <tr style="background:#f8fafc;font-weight:700;">
                    <td>TOTAL</td>
                    <td colspan="8"></td>
                    <td></td><td></td><td></td><td></td><td></td>
                    <td style="text-align:center;color:#2563eb;">${latestSummary.total_karyawan}</td>
                    <td></td><td></td>
                </tr>`;
        }

        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.tier !== '') params.set('tier', state.tier);
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
                    `<strong>${json.data.length}</strong> profil kerja ditemukan`;
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="16" style="text-align:center;color:red;">Error memuat data</td></tr>`;
            }
        }

        // ══════ MODAL: MATRIKS B1-B8 INPUT + LIVE PREVIEW ══════
        function buildBMatrixGrid() {
            const grid = document.getElementById('bMatrixGrid');
            grid.innerHTML = Object.entries(LABEL_BAHAYA).map(([kode, label]) => `
                <div class="detail-field">
                    <label>${label}</label>
                    <select id="pB${kode}" class="b-input" onchange="updatePreviewSkor()">
                        <option value="0">0 — Tidak ada</option>
                        <option value="1">1 — Rendah</option>
                        <option value="2">2 — Sedang</option>
                        <option value="3">3 — Tinggi</option>
                        <option value="4">4 — Tertinggi</option>
                    </select>
                </div>`).join('');
        }

        function updatePreviewSkor() {
            const nilai = {};
            for (let i = 1; i <= 8; i++) nilai[i] = parseInt(document.getElementById(`pB${i}`).value, 10);

            const skorTertinggi = Math.max(...Object.values(nilai));
            const skorTotal = Object.values(nilai).reduce((a, b) => a + b, 0);
            const jmlSedang = Object.values(nilai).filter(v => v >= AMBANG_BAHAYA_SEDANG).length;

            let pengendali = '(tidak ada bahaya bernilai)';
            if (skorTertinggi > 0) {
                for (const k in nilai) {
                    if (nilai[k] === skorTertinggi) {
                        pengendali = LABEL_BAHAYA[k];
                        break;
                    }
                }
            }

            document.getElementById('pPreviewSkorTertinggi').textContent = skorTertinggi;
            document.getElementById('pPreviewSkorTotal').textContent = skorTotal;
            document.getElementById('pPreviewBahayaSedang').textContent = jmlSedang;
            document.getElementById('pPreviewPengendali').textContent = pengendali;

            const tierEl = document.getElementById('pPreviewTier');
            tierEl.textContent = `T${skorTertinggi} · ${LABEL_TIER[skorTertinggi]}`;
            tierEl.style.background = WARNA_TIER[skorTertinggi];
            tierEl.style.color = '#fff';
        }

        function openProfilModal(row = null) {
            document.getElementById('formProfil').reset();
            buildBMatrixGrid();
            document.getElementById('btnDeleteProfil').style.display = row ? 'inline-block' : 'none';

            if (row) {
                document.getElementById('profilModalTitle').textContent = `Edit Profil — ${row.kode_profil}`;
                document.getElementById('pId').value = row.id;
                document.getElementById('pKodeProfil').value = row.kode_profil;
                document.getElementById('pNamaProfil').value = row.nama_profil;
                document.getElementById('pJmlKaryawan').value = row.jml_karyawan;
                document.getElementById('pStatus').value = row.status;
                document.getElementById('pDeskripsiPaparan').value = row.deskripsi_paparan || '';
                document.getElementById('pContohJabatan').value = row.contoh_jabatan || '';
                document.getElementById('pDasarPenilaian').value = row.dasar_penilaian || '';
                document.getElementById('pSumberSkor').value = row.sumber_skor || '';
                for (let i = 1; i <= 8; i++) document.getElementById(`pB${i}`).value = row[`b${i}`] ?? 0;
            } else {
                document.getElementById('profilModalTitle').textContent = 'Tambah Profil Kerja';
                document.getElementById('pId').value = '';
                document.getElementById('pJmlKaryawan').value = 0;
                document.getElementById('pStatus').value = 'AKTIF';
                document.getElementById('pSumberSkor').value = 'PENILAIAN K3 PT FJM — perlu divalidasi Ahli K3';
            }

            updatePreviewSkor();
            document.getElementById('profilModalOverlay').classList.add('open');
        }

        function closeProfilModal() {
            document.getElementById('profilModalOverlay').classList.remove('open');
        }

        function closeProfilModalOutside(event) {
            if (event.target.id === 'profilModalOverlay') closeProfilModal();
        }

        async function submitProfil(event) {
            event.preventDefault();
            const id = document.getElementById('pId').value;

            const payload = {
                kode_profil: document.getElementById('pKodeProfil').value.trim(),
                nama_profil: document.getElementById('pNamaProfil').value.trim(),
                jml_karyawan: parseInt(document.getElementById('pJmlKaryawan').value, 10),
                status: document.getElementById('pStatus').value,
                deskripsi_paparan: document.getElementById('pDeskripsiPaparan').value.trim(),
                contoh_jabatan: document.getElementById('pContohJabatan').value.trim(),
                dasar_penilaian: document.getElementById('pDasarPenilaian').value.trim(),
                sumber_skor: document.getElementById('pSumberSkor').value.trim(),
            };
            for (let i = 1; i <= 8; i++) payload[`b${i}`] = parseInt(document.getElementById(`pB${i}`).value, 10);

            const url = id ? `${UPDATE_ENDPOINT_BASE}/${id}` : STORE_ENDPOINT;

            try {
                const res = await fetch(url, {
                    method: id ? 'PUT' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify(payload),
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || 'Gagal menyimpan data');

                showToast(json.message, 'success');
                closeProfilModal();
                loadData();
            } catch (e) {
                showToast(e.message || 'Terjadi kesalahan', 'error');
            }
            return false;
        }

        async function deleteProfil() {
            const id = document.getElementById('pId').value;
            if (!id) return;
            if (!confirm('Yakin ingin menghapus profil kerja ini?')) return;

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
                closeProfilModal();
                loadData();
            } catch (e) {
                showToast(e.message || 'Terjadi kesalahan', 'error');
            }
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
