<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Pengawas — PT. Fokus Jasa Mitra</title>
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

            .pagination-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .pagination-pages {
                justify-content: center;
            }
        }

        /* ══════ MODAL UMUM ══════ */
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

        /* ══════ MODAL DETAIL / PICKER (box lebar) ══════ */
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

        .form-input {
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

        .form-input:focus {
            border-color: #2D4B9E;
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

        /* ══════ MODAL PICKER TENAGA ══════ */
        .picker-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 10px;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            transition: background 0.15s;
        }

        .picker-item:hover {
            background: #F8F9FF;
            border-color: rgba(45, 75, 158, 0.25);
        }

        .picker-item-name {
            font-size: 12.5px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .picker-item-sub {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
        }

        .btn-picker-select {
            padding: 5px 10px;
            border-radius: 6px;
            border: none;
            background: #2D4B9E;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            flex-shrink: 0;
        }

        .btn-picker-select:hover {
            background: #1A3C8A;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- ══════ SIDEBAR ══════ -->
    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- ══════ MAIN ══════ -->
    <div id="main-content">

        <!-- TOPBAR -->
        <div id="topbar">
            <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="search-box" style="visibility:hidden;">
                <input type="text" tabindex="-1" />
            </div>
            <div style="flex:1"></div>
            <div style="display:flex;align-items:center;gap:6px;">
                <div class="tb-badge" style="position:relative;">
                    <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="notif-dot"></span>
                </div>
                <div class="tb-divider"></div>
                <div class="tb-user">
                    <div class="tb-avatar">AR</div>
                    <span class="tb-name">Ahmad R.</span>
                    <svg class="tb-caret" style="width:12px;height:12px" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div id="page-content">

            <!-- PAGE HEADER -->
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Database Pengawas · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DATA <span>PENGAWAS</span></div>
                        <div class="pg-sub">Kelola tenaga kerja yang bertugas sebagai pengawas.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openPickerModal()">
                            <svg style="width:13px;height:13px;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Pengawas
                        </button>

                        <button class="btn-outline" onclick="loadData()">
                            <svg style="width:12px;height:12px;display:inline;margin-right:4px" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Muat Ulang
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
                        <input type="text" id="searchInput"
                            placeholder="Cari pengawas berdasarkan nama atau badge..." oninput="onSearchInput()" />
                    </div>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data pengawas...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Data Pegawai</th>
                                <th class="px-6 py-3 text-left">Info Personal (TTL & Alamat)</th>
                                <th class="px-6 py-3 text-left">Data BPJS</th>
                                <th class="px-6 py-3 text-left">Sejak Bertugas</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr class="skeleton-row">
                                <td>
                                    <div class="skeleton-bar" style="width:160px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:180px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:120px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:100px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:90px; margin:auto;"></div>
                                </td>
                            </tr>
                            <tr class="skeleton-row">
                                <td>
                                    <div class="skeleton-bar" style="width:150px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:190px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:110px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:90px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:90px; margin:auto;"></div>
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

    <!-- ══════ MODAL DETAIL TENAGA/PENGAWAS ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="modal-header detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar" id="detailAvatar">--</div>
                    <div>
                        <div class="modal-title" id="detailNamaTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailBadgeSub">-</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="modal-body detail-modal-body">

                <div class="detail-section">
                    <div class="detail-section-title mt-2">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Data Pribadi
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>Nama Lengkap</label>
                            <input type="text" id="detailInputNama" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Badge / NIK</label>
                            <input type="text" id="detailInputBadge" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Jenis Kelamin</label>
                            <input type="text" id="detailInputJenisKelamin" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Tempat, Tanggal Lahir</label>
                            <input type="text" id="detailInputTtl" readonly>
                        </div>
                        <div class="detail-field" style="grid-column: span 2;">
                            <label>Alamat</label>
                            <textarea id="detailInputAlamat" readonly rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Data BPJS
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>No. BPJS Kesehatan</label>
                            <input type="text" id="detailInputBpjsKesehatan" readonly>
                        </div>
                        <div class="detail-field">
                            <label>No. BPJS Ketenagakerjaan</label>
                            <input type="text" id="detailInputBpjsTk" readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer mt-4">
                <button class="btn-outline" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL PILIH TENAGA UNTUK PENGAWAS ══════ -->
    <div class="modal-overlay" id="pickerModalOverlay" onclick="closePickerModalOutside(event)">
        <div class="update-modal-box" onclick="event.stopPropagation()">
            <div class="update-modal-header">
                <div class="update-modal-eyebrow" id="pickerModeLabel">Tambah Pengawas Baru</div>
                <div class="update-modal-name">Pilih Tenaga Kerja</div>
                <div class="update-modal-nik" id="pickerReplaceInfo" style="display:none;"></div>
            </div>

            <div class="form-group">
                <input type="text" id="pickerSearchInput" class="form-input"
                    placeholder="Cari nama atau badge..." oninput="onPickerSearchInput()" />
            </div>

            <div id="pickerResultList"
                style="max-height:280px; overflow-y:auto; display:flex; flex-direction:column; gap:6px;">
                <div style="text-align:center; color:#94A3B8; font-size:12px; padding:20px 0;">Ketik untuk mencari
                    tenaga kerja...</div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closePickerModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST NOTIFIKASI ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <script>
        // ══════ CONFIG ══════
        const API_ENDPOINT = "{{ route('pengawas.api') }}";
        const CARI_TENAGA_ENDPOINT = "{{ route('pengawas.cari-tenaga') }}";
        const PENGAWAS_BASE = "{{ url('/pengawas') }}";

        const state = {
            search: '',
            page: 1,
            per_page: 10,
        };

        let searchDebounce = null;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function initials(name) {
            if (!name || name === '-') return '—';
            const parts = name.trim().split(/\s+/);
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

        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onPerPageChange() {
            state.per_page = parseInt(document.getElementById('perPageSelect').value, 10);
            state.page = 1;
            loadData();
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            state.search = '';
            state.page = 1;
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

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');

            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <div class="empty-state-title">Belum ada pengawas ditetapkan</div>
                            <div class="empty-state-sub">Klik "Tambah Pengawas" untuk memilih dari data tenaga kerja.</div>
                        </div>
                    </td>
                </tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">${escapeHtml(initials(row.nama))}</div>
                            <div>
                                <div class="td-name-main">${escapeHtml(row.nama)}</div>
                                <div class="td-name-sub">
                                    <span style="font-weight:600; color:#475569;">${escapeHtml(row.badge)}</span> • ${escapeHtml(row.jenis_kelamin)}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div style="font-weight:600; color:#334155; font-size: 13px; margin-bottom:3px;">
                            ${escapeHtml(row.tempat_lahir)}, ${formatDate(row.tanggal_lahir)}
                        </div>
                        <div class="td-name-sub" style="white-space: normal; max-width: 260px; line-height: 1.4;">
                            ${escapeHtml(row.alamat)}
                        </div>
                    </td>

                    <td>
                        <div style="font-size: 12px; margin-bottom:4px;">
                            <span style="color:#64748B;">Kes:</span>
                            <span style="font-weight:600; color:#1e293b;">${escapeHtml(row.no_bpjs_kesehatan)}</span>
                        </div>
                        <div style="font-size: 12px;">
                            <span style="color:#64748B;">TK:</span>
                            <span style="font-weight:600; color:#1e293b;">${escapeHtml(row.no_bpjs_ketenagakerjaan)}</span>
                        </div>
                    </td>

                    <td>
                        <span class="status-pill sp-blue">${formatDate(row.tanggal_jadi_pengawas)}</span>
                    </td>

                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-detail-tenaga" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'
                                style="background:transparent; border:1px solid #e2e8f0; padding:6px 10px; border-radius:6px; cursor:pointer; color:#475569; display:inline-flex; align-items:center; gap:4px; font-size:12px; font-weight:600; margin-right:6px;">
                            <svg style="width:14px;height:14px; color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </button>

                        <button class="btn-edit-kib" onclick="openPickerModal(${row.id}, '${escapeHtml(row.nama)}')"
                                style="margin-right:6px;">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.253 8H18" />
                            </svg>
                            Ganti
                        </button>

                        <button class="btn-edit-kib" onclick="copotPengawas(${row.id}, '${escapeHtml(row.nama)}')"
                                style="color:#D0021B; border-color:rgba(208,2,27,0.2); background:rgba(208,2,27,0.06);">
                            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Copot
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderError(message) {
            document.getElementById('tableBody').innerHTML = `
        <tr>
            <td colspan="5">
                <div class="error-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                    </svg>
                    <div class="error-state-title">Gagal memuat data</div>
                    <div class="error-state-sub">${escapeHtml(message)}</div>
                </div>
            </td>
        </tr>`;
            document.getElementById('paginationText').textContent = '—';
            document.getElementById('paginationPages').innerHTML = '';
            document.getElementById('dataSummary').textContent = 'Gagal memuat data pengawas.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` :
                'Tidak ada data';

            document.getElementById('dataSummary').innerHTML =
                `<strong>${meta.total}</strong> pengawas ditemukan`;

            const container = document.getElementById('paginationPages');
            const current = meta.current_page;
            const last = meta.last_page;

            let pages = [];
            const addPage = p => pages.push(p);
            const addEllipsis = () => pages.push('...');

            addPage(1);
            if (current > 3) addEllipsis();
            for (let p = Math.max(2, current - 1); p <= Math.min(last - 1, current + 1); p++) addPage(p);
            if (current < last - 2) addEllipsis();
            if (last > 1) addPage(last);

            pages = [...new Set(pages)];

            let html =
                `<button class="page-btn" ${current <= 1 ? 'disabled' : ''} onclick="goToPage(${current - 1})">‹</button>`;
            pages.forEach(p => {
                if (p === '...') {
                    html += `<span class="page-ellipsis">…</span>`;
                } else {
                    html +=
                        `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
                }
            });
            html +=
                `<button class="page-btn" ${current >= last ? 'disabled' : ''} onclick="goToPage(${current + 1})">›</button>`;

            container.innerHTML = html;
        }

        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${API_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    },
                });

                if (!res.ok) {
                    const errJson = await res.json().catch(() => null);
                    throw new Error(errJson?.message || `Server merespons status ${res.status}`);
                }

                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
            } catch (e) {
                renderError(e.message || 'Terjadi kesalahan tak terduga.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadData);

        // ══════ MODAL DETAIL ══════
        function openDetailModal(row) {
            document.getElementById('detailAvatar').textContent = initials(row.nama);
            document.getElementById('detailNamaTitle').textContent = row.nama || '-';
            document.getElementById('detailBadgeSub').textContent = row.badge || '-';

            document.getElementById('detailInputNama').value = row.nama || '-';
            document.getElementById('detailInputBadge').value = row.badge || '-';
            document.getElementById('detailInputJenisKelamin').value = row.jenis_kelamin || '-';
            document.getElementById('detailInputTtl').value =
                `${row.tempat_lahir || '-'}, ${formatDate(row.tanggal_lahir)}`;
            document.getElementById('detailInputAlamat').value = row.alamat || '-';
            document.getElementById('detailInputBpjsKesehatan').value = row.no_bpjs_kesehatan || '-';
            document.getElementById('detailInputBpjsTk').value = row.no_bpjs_ketenagakerjaan || '-';

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') {
                closeDetailModal();
            }
        }

        // ══════ MODAL PICKER TENAGA (Tambah / Ganti Pengawas) ══════
        let pickerReplaceId = null;
        let pickerSearchDebounce = null;

        function openPickerModal(replaceId = null, replaceName = null) {
            pickerReplaceId = replaceId;
            document.getElementById('pickerSearchInput').value = '';
            document.getElementById('pickerResultList').innerHTML =
                '<div style="text-align:center; color:#94A3B8; font-size:12px; padding:20px 0;">Ketik untuk mencari tenaga kerja...</div>';

            const modeLabel = document.getElementById('pickerModeLabel');
            const replaceInfo = document.getElementById('pickerReplaceInfo');

            if (replaceId) {
                modeLabel.textContent = 'Ganti Pengawas';
                replaceInfo.style.display = 'block';
                replaceInfo.textContent = `Menggantikan: ${replaceName}`;
            } else {
                modeLabel.textContent = 'Tambah Pengawas Baru';
                replaceInfo.style.display = 'none';
            }

            document.getElementById('pickerModalOverlay').classList.add('open');
        }

        function closePickerModal() {
            document.getElementById('pickerModalOverlay').classList.remove('open');
            pickerReplaceId = null;
        }

        function closePickerModalOutside(event) {
            if (event.target.id === 'pickerModalOverlay') closePickerModal();
        }

        function onPickerSearchInput() {
            clearTimeout(pickerSearchDebounce);
            pickerSearchDebounce = setTimeout(searchTenagaPicker, 350);
        }

        async function searchTenagaPicker() {
            const search = document.getElementById('pickerSearchInput').value.trim();
            const listEl = document.getElementById('pickerResultList');
            listEl.innerHTML =
                '<div style="text-align:center; color:#94A3B8; font-size:12px; padding:20px 0;">Mencari...</div>';

            try {
                const res = await fetch(`${CARI_TENAGA_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();

                if (!json.data || json.data.length === 0) {
                    listEl.innerHTML =
                        '<div style="text-align:center; color:#94A3B8; font-size:12px; padding:20px 0;">Tidak ada tenaga ditemukan.</div>';
                    return;
                }

                listEl.innerHTML = json.data.map(t => `
                    <div class="picker-item">
                        <div>
                            <div class="picker-item-name">${escapeHtml(t.nama)}</div>
                            <div class="picker-item-sub">${escapeHtml(t.badge)} • ${escapeHtml(t.departemen)}</div>
                        </div>
                        <button class="btn-picker-select" onclick="pilihTenaga(${t.id})">Pilih</button>
                    </div>
                `).join('');
            } catch (e) {
                listEl.innerHTML =
                    '<div style="text-align:center; color:#D0021B; font-size:12px; padding:20px 0;">Gagal memuat data.</div>';
            }
        }

        async function pilihTenaga(id) {
            try {
                const body = pickerReplaceId ? {
                    replace_id: pickerReplaceId
                } : {};

                const res = await fetch(`${PENGAWAS_BASE}/${id}/tetapkan`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(body)
                });

                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Server merespons status ${res.status}`);

                closePickerModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menetapkan pengawas.', 'error');
            }
        }

        async function copotPengawas(id, nama) {
            if (!confirm(`Copot ${nama} dari jabatan pengawas?`)) return;

            try {
                const res = await fetch(`${PENGAWAS_BASE}/${id}/copot`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Server merespons status ${res.status}`);

                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal mencopot pengawas.', 'error');
            }
        }
    </script>
</body>

</html>
