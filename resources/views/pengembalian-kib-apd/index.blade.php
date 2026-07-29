<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Pengembalian APD & KIB — PT. Fokus Jasa Mitra</title>
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
            display: inline-flex;
            /* Mengubah tombol menjadi container flex */
            align-items: center;
            /* Menyejajarkan ikon dan teks tepat di tengah secara vertikal */
            justify-content: center;
            /* Mengatur posisi konten di tengah secara horizontal */
            gap: 8px;
            /* Memberikan jarak yang rapi antara ikon dan teks */
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

        /* FILTER BAR */
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

        /* TABLE */
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
            border-radius: 9px;
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

        /* stok mini bar */
        .stok-line {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #64748B;
            margin-bottom: 2px;
        }

        .stok-line b {
            color: #1A1D2E;
        }

        /* PAGINATION */
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

        /* RESPONSIVE */
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

        /* MODAL GENERIC */
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

        .btn-modal-danger {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: #D0021B;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-modal-danger:hover {
            background: #A80115;
        }

        /* TOAST */
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

        /* FORM (modal tambah/edit) */
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

        .form-group {
            margin-bottom: 0;
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

        /* MODAL DETAIL */
        .detail-modal-box {
            max-width: 620px;
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
            font-size: 13px;
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
            margin-top: 20px;

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

        .detail-field.span-2 {
            grid-column: span 2;
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

        @media (max-width: 640px) {
            .detail-form-grid {
                grid-template-columns: 1fr;
            }

            .detail-field.span-2 {
                grid-column: span 1;
            }
        }

        .kode-ok-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kode-ok-row .form-input {
            flex: 1;
        }

        .btn-remove-kode-ok {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 8px;
            border: 1px solid rgba(208, 2, 27, 0.2);
            background: rgba(208, 2, 27, 0.06);
            color: #D0021B;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .btn-remove-kode-ok:hover {
            background: rgba(208, 2, 27, 0.14);
        }

        .kode-ok-pill {
            display: inline-flex;
            align-items: center;
            padding: 1px 7px;
            border-radius: 6px;
            background: rgba(45, 75, 158, 0.08);
            color: #2D4B9E;
            font-size: 10px;
            font-weight: 700;
            margin: 0 4px 4px 0;
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

        /* ══════ Checklist dropdown multi-select (APD Wajib / Khusus) ══════ */
        .ms-dropdown {
            position: relative;
        }

        .ms-dropdown-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 9px 12px;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            background: #fff;
            font-size: 12.5px;
            color: #1A1D2E;
            cursor: pointer;
            text-align: left;
        }

        .ms-dropdown-btn:hover {
            border-color: #94A3B8;
        }

        .ms-dropdown-panel {
            display: none;
            position: absolute;
            z-index: 40;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            max-height: 260px;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        .ms-dropdown-panel.open {
            display: flex;
            flex-direction: column;
        }

        .ms-search {
            border: none;
            border-bottom: 1px solid #E2E8F0;
            padding: 9px 12px;
            font-size: 12.5px;
            outline: none;
            width: 100%;
        }

        .ms-options {
            overflow-y: auto;
            padding: 4px 0;
        }

        .ms-option-row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            font-size: 12.5px;
            color: #1A1D2E;
            cursor: pointer;
        }

        .ms-option-row:hover {
            background: #F8FAFC;
        }

        .ms-option-row input[type="checkbox"] {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .ms-option-empty {
            padding: 12px;
            text-align: center;
            font-size: 12px;
            color: #94A3B8;
        }

        /* ══════ INFO BOX (Stok APD & Riwayat Tukar) ══════ */
        .info-box {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            color: #334155;
            margin-top: 12px
        }

        .info-box-line {
            line-height: 1.6;
        }

        .info-box-line+.info-box-line {
            margin-top: 4px;
        }

        .info-box-line b {
            color: #1E293B;
            font-weight: 600;
        }

        /* ══════ STATUS PILL variants (dipakai juga di tabel) ══════ */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            line-height: 1.4;
        }

        .status-pill.sp-green {
            background: #DCFCE7;
            color: #1A7A3C;
        }

        .status-pill.sp-red {
            background: #FEE2E2;
            color: #D0021B;
        }

        .status-pill.sp-amber {
            background: #FEF3C7;
            color: #D97706;
        }

        .status-pill.sp-blue {
            background: #DBEAFE;
            color: #2D4B9E;
        }

        .status-pill.sp-gray {
            background: #F1F5F9;
            color: #64748B;
        }

        .export-dropdown {
            position: relative;
        }

        .export-dropdown-panel {
            position: absolute;
            top: calc(100% + 6px);
            right: 0;
            min-width: 200px;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            padding: 6px;
            display: none;
            z-index: 20;
        }

        .export-dropdown-panel.open {
            display: block;
        }

        .export-option {
            display: block;
            width: 100%;
            text-align: left;
            padding: 8px 10px;
            border: none;
            background: transparent;
            border-radius: 6px;
            font-size: 13px;
            color: #334155;
            cursor: pointer;
        }

        .export-option:hover {
            background: #F1F5F9;
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
                            <span class="pg-eyebrow">Manajemen Pengembalian · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">PENGEMBALIAN <span>KIB &amp; APD K3</span></div>
                        <div class="pg-sub">Catatan pengembalian KIB dan APD K3 dari karyawan.</div>
                    </div>
                    <div class="pg-actions" style="display:flex; gap:8px;">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Pengembalian
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
                            placeholder="Cari no. dokumen, badge, nama karyawan, no. KIB..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterStatusKib" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status Fisik KIB</option>
                    </select>

                    <input type="date" id="filterTanggalDari" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal Dari" />
                    <input type="date" id="filterTanggalSampai" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal Sampai" />

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data pengembalian...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Tanggal &amp; Dokumen</th>
                                <th>Karyawan</th>
                                <th>Status Fisik KIB</th>
                                <th>No. KIB Dikembalikan</th>
                                <th>APD Dikembalikan</th>
                                <th>Keterangan</th>
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

    <!-- ══════ MODAL TAMBAH / EDIT PENGEMBALIAN ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Pengembalian KIB &amp; APD</div>
                <div class="detail-subtitle" id="formModalSub">Lengkapi data pengembalian di bawah ini.</div>
            </div>

            <div class="form-modal-body">

                <div class="form-section-title">Data Karyawan</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">No. Dokumen</label>
                        <input type="text" id="fNoDokumen" class="form-input" readonly disabled
                            style="background:#F1F5F9; color:#64748B; cursor:not-allowed;"
                            placeholder="Otomatis digenerate setelah disimpan" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" id="fTanggal" class="form-input" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Nomor Badge / Nama Lengkap</label>
                        <div class="picker-wrap">
                            <input type="text" id="pegawaiPickerInput" class="form-input"
                                placeholder="Cari nama atau nomor badge karyawan..." oninput="onPegawaiPickerInput()"
                                autocomplete="off" />
                            <div class="picker-dropdown" id="pegawaiPickerDropdown"></div>
                        </div>
                        <input type="hidden" id="fNomorBadge" />
                        <input type="hidden" id="fNamaLengkap" />
                        <input type="hidden" id="fJabatan" />
                        <input type="hidden" id="fUnitKerja" />
                    </div>
                </div>

                <div class="form-section-title">Pengembalian KIB</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Status Pengembalian Fisik KIB</label>
                        <select id="fStatusFisikKib" class="form-select"></select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor KIB Dikembalikan</label>
                        <input type="text" id="fNomorKibDikembalikan" class="form-input"
                            placeholder="KIB-00123" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Foto KIB Dikembalikan</label>
                        <input type="file" id="fFotoKib" class="form-input" accept="image/*"
                            onchange="onFotoKibChange()" />
                        <div id="fotoKibPreviewBox" style="margin-top:8px; display:none;">
                            <div class="detail-subtitle" id="fotoKibPreviewLabel" style="margin-bottom:4px;">Foto
                                saat ini:</div>
                            <img id="fotoKibPreviewImg" src=""
                                style="max-width:160px; max-height:120px; border-radius:8px; border:1px solid #E2E8F0;" />
                        </div>
                    </div>
                </div>

                <div class="form-section-title">Pengembalian APD</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">Checklist APD Dikembalikan</label>
                        <div class="ms-dropdown" id="apdChecklistWrap">
                            <button type="button" class="ms-dropdown-btn" onclick="toggleApdChecklistDropdown()">
                                <span id="apdChecklistLabel">Pilih APD yang dikembalikan...</span>
                                <svg style="width:13px;height:13px; flex-shrink:0;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="ms-dropdown-panel" id="apdChecklistPanel">
                                <input type="text" class="ms-search" placeholder="Cari jenis / kode APD..."
                                    oninput="filterApdChecklistOptions(this.value)" />
                                <div class="ms-options" id="apdChecklistOptionsList"
                                    style="max-height:220px; overflow-y:auto;"></div>
                            </div>
                        </div>
                        <div id="apdChecklistChips" style="display:flex; flex-wrap:wrap; gap:6px; margin-top:8px;">
                        </div>
                    </div>

                    <div class="form-group span-2">
                        <label class="form-label">Foto APD Dikembalikan</label>
                        <input type="file" id="fFotoApd" class="form-input" accept="image/*"
                            onchange="onFotoApdChange()" />
                        <div id="fotoApdPreviewBox" style="margin-top:8px; display:none;">
                            <div class="detail-subtitle" id="fotoApdPreviewLabel" style="margin-bottom:4px;">Foto
                                saat ini:</div>
                            <img id="fotoApdPreviewImg" src=""
                                style="max-width:160px; max-height:120px; border-radius:8px; border:1px solid #E2E8F0;" />
                        </div>
                    </div>

                    <div class="form-group span-2">
                        <label class="form-label">Keterangan</label>
                        <textarea id="fKeterangan" class="form-textarea" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
                    </div>
                </div>

            </div>

            <div class="modal-actions" style="margin-top:18px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL PENGEMBALIAN ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar" id="detailAvatar">
                        <span id="detailAvatarInitial"></span>
                    </div>
                    <div>
                        <div class="modal-title" id="detailNamaTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailNoDokumenSub">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Data Karyawan
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>No. Dokumen</label>
                            <input type="text" id="dNoDokumen" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Tanggal</label>
                            <input type="text" id="dTanggal" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Nomor Badge</label>
                            <input type="text" id="dNomorBadge" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Nama Lengkap</label>
                            <input type="text" id="dNamaLengkap" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Jabatan</label>
                            <input type="text" id="dJabatan" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Unit Kerja</label>
                            <input type="text" id="dUnitKerja" readonly>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pengembalian KIB
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>Status Fisik KIB</label>
                            <input type="text" id="dStatusFisikKib" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Nomor KIB Dikembalikan</label>
                            <input type="text" id="dNomorKibDikembalikan" readonly>
                        </div>
                    </div>
                    <div id="dFotoKibBox" style="margin-top:10px;">
                        <div class="detail-field-empty" style="color:#94A3B8; font-size:13px;">Tidak ada foto.</div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Pengembalian APD
                    </div>
                    <div id="dApdChecklistList" style="display:flex; flex-wrap:wrap; gap:6px; margin-bottom:10px;">
                    </div>
                    <div id="dFotoApdBox">
                        <div class="detail-field-empty" style="color:#94A3B8; font-size:13px;">Tidak ada foto.</div>
                    </div>
                </div>

                <div class="detail-field">
                    <label>Keterangan</label>
                    <textarea id="dKeterangan" readonly rows="2"></textarea>
                </div>
            </div>
            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL KONFIRMASI HAPUS ══════ -->
    <div id="deleteConfirmOverlay" class="modal-overlay" onclick="closeDeleteModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="modal-title">Hapus Data Pengembalian?</div>
            <div class="modal-desc" id="deleteModalDesc">
                Data yang sudah dihapus tidak dapat dikembalikan. Pastikan Anda yakin sebelum melanjutkan.
            </div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <script>
        // ══════ CONFIG ══════
        const DATA_ENDPOINT = "{{ route('pengembalian-kib-apd.data') }}";
        const STORE_ENDPOINT = "{{ route('pengembalian-kib-apd.store') }}";
        const APD_OPTIONS_ENDPOINT = "{{ route('pengembalian-kib-apd.apd-options') }}";
        const CARI_PEGAWAI_ENDPOINT = "{{ route('pengembalian-kib-apd.cari-pegawai') }}";
        const BASE_ENDPOINT = "{{ url('/pengembalian-kib-apd') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const STATUS_FISIK_KIB_OPTIONS = @json(\App\Models\PengembalianKibApd::STATUS_FISIK_KIB);
        const FALLBACK_KARYAWAN = @json(\App\Models\PengembalianKibApd::FALLBACK_KARYAWAN);

        const state = {
            search: '',
            status_fisik_kib: '',
            tanggal_dari: '',
            tanggal_sampai: '',
            page: 1,
            per_page: 10,
        };

        let searchDebounce = null;
        let filterOptionsLoaded = false;
        let apdOptionsCache = [];
        let selectedApdList = []; // [{id, kode_apd, jenis_apd, ukuran}]
        let currentEditId = null;
        let currentDeleteId = null;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function display(value, fallback = '-') {
            return (value === null || value === undefined || value === '') ? fallback : value;
        }

        function initials(name) {
            if (!name || name === '-') return '—';
            const parts = String(name).trim().split(/\s+/);
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

        function statusKibPillClass(status) {
            return status === 'OK/BAIK' ? 'sp-green' : 'sp-red';
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
            state.status_fisik_kib = document.getElementById('filterStatusKib').value;
            state.tanggal_dari = document.getElementById('filterTanggalDari').value;
            state.tanggal_sampai = document.getElementById('filterTanggalSampai').value;
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
            document.getElementById('filterStatusKib').value = '';
            document.getElementById('filterTanggalDari').value = '';
            document.getElementById('filterTanggalSampai').value = '';
            Object.assign(state, {
                search: '',
                status_fisik_kib: '',
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
            const select = document.getElementById('filterStatusKib');
            const current = select.value;
            (options.status_fisik_kib || []).forEach(val => {
                const opt = document.createElement('option');
                opt.value = val;
                opt.textContent = val;
                select.appendChild(opt);
            });
            select.value = current;
            filterOptionsLoaded = true;
        }

        // ══════ TABEL ══════
        function apdChipsHtml(apdList) {
            if (!apdList || apdList.length === 0) {
                return `<span style="color:#94A3B8; font-size:12px;">Tidak ada APD dikembalikan.</span>`;
            }
            return apdList.map(a => `
                <span class="status-pill sp-blue" style="margin:2px 4px 2px 0; display:inline-block;">
                    ${escapeHtml(a.jenis_apd)}${a.kode_apd ? ' · ' + escapeHtml(a.kode_apd) : ''}
                </span>
            `).join('');
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');

            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-state-title">Data tidak ditemukan</div>
                            <div class="empty-state-sub">Coba ubah kata kunci pencarian atau filter yang digunakan.</div>
                        </div>
                    </td>
                </tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-main">${formatDate(row.tanggal)}</div>
                        <div class="td-name-sub" style="font-weight:600; color:#475569;">${escapeHtml(row.no_dokumen)}</div>
                    </td>
 
                    <td>
                        <div class="td-name-main">${escapeHtml(display(row.nama_lengkap, FALLBACK_KARYAWAN))}</div>
                        <div class="td-name-sub">${escapeHtml(display(row.nomor_badge, FALLBACK_KARYAWAN))}</div>
                        <div class="td-name-sub">${escapeHtml(display(row.unit_kerja, FALLBACK_KARYAWAN))}</div>
                    </td>
 
                    <td>
                        <span class="status-pill ${statusKibPillClass(row.status_fisik_kib)}">${escapeHtml(row.status_fisik_kib)}</span>
                    </td>
 
                    <td>
                        <div class="td-name-sub">${escapeHtml(display(row.nomor_kib_dikembalikan))}</div>
                    </td>
 
                    <td style="max-width:220px;">
                        ${apdChipsHtml(row.apd_dikembalikan)}
                    </td>
 
                    <td style="max-width:180px;">
                        <div class="td-name-sub" style="white-space:normal; line-height:1.4;">${escapeHtml(display(row.keterangan))}</div>
                    </td>
 
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-row-action" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                            <svg style="width:14px;height:14px; color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </button>
                        <button class="btn-row-action" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                            <svg style="width:14px;height:14px; color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </button>
                        <button class="btn-row-action" onclick="openDeleteModal(${row.id}, '${escapeHtml(row.no_dokumen)}')">
                            <svg style="width:14px;height:14px; color:#D0021B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderError(message) {
            document.getElementById('tableBody').innerHTML = `
        <tr>
            <td colspan="7">
                <div class="error-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                    </svg>
                    <div class="error-state-title">Gagal memuat data</div>
                    <div class="error-state-sub">${escapeHtml(message)}</div>
                </div>
            </td>
        </tr>`;
            document.getElementById('paginationText').textContent = '—';
            document.getElementById('paginationPages').innerHTML = '';
            document.getElementById('dataSummary').textContent = 'Gagal memuat data pengembalian.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';

            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> data pengembalian ditemukan`;

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
            if (state.status_fisik_kib) params.set('status_fisik_kib', state.status_fisik_kib);
            if (state.tanggal_dari) params.set('tanggal_dari', state.tanggal_dari);
            if (state.tanggal_sampai) params.set('tanggal_sampai', state.tanggal_sampai);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!res.ok) {
                    const errJson = await res.json().catch(() => null);
                    throw new Error(errJson?.message || `Server merespons status ${res.status}`);
                }

                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
                populateFilterOptions(json.filter_options);
            } catch (e) {
                renderError(e.message || 'Terjadi kesalahan tak terduga.');
            }
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

        // ══════ OPSI STATUS FISIK KIB ══════
        function populateStatusFisikKibSelect() {
            const select = document.getElementById('fStatusFisikKib');
            select.innerHTML = STATUS_FISIK_KIB_OPTIONS
                .map(v => `<option value="${escapeHtml(v)}">${escapeHtml(v)}</option>`)
                .join('');
        }

        // ══════ MASTER APD (dipakai checklist multi-select) ══════
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
                // Diamkan — checklist tetap tampil kosong tanpa master data
            }
        }

        // ══════ CHECKLIST APD — searchable + scrollable multi-select ══════
        function isApdSelected(id) {
            return selectedApdList.some(a => String(a.id) === String(id));
        }

        function renderApdChecklistOptions(term = '') {
            const container = document.getElementById('apdChecklistOptionsList');
            const term_ = term.toLowerCase();
            const list = apdOptionsCache.filter(a =>
                a.jenis_apd.toLowerCase().includes(term_) ||
                (a.kode_apd || '').toLowerCase().includes(term_)
            );

            container.innerHTML = list.length === 0 ?
                `<div class="ms-option-empty">APD tidak ditemukan.</div>` :
                list.map(a => `
            <label class="ms-option-row">
                <input type="checkbox" value="${a.id}" ${isApdSelected(a.id) ? 'checked' : ''}
                    onchange='toggleApdSelection(${JSON.stringify(a).replace(/'/g, "&#39;")}, this.checked)' />
                <span>${escapeHtml(a.jenis_apd)} <span style="color:#94A3B8;">(${escapeHtml(a.kode_apd || '-')}${a.ukuran_tersedia ? ' · ' + escapeHtml(a.ukuran_tersedia) : ''})</span></span>
            </label>
        `).join('');
        }

        function filterApdChecklistOptions(term) {
            renderApdChecklistOptions(term);
        }

        function toggleApdSelection(item, checked) {
            if (checked) {
                if (!isApdSelected(item.id)) {
                    selectedApdList.push({
                        id: item.id,
                        kode_apd: item.kode_apd,
                        jenis_apd: item.jenis_apd,
                        ukuran: item.ukuran_tersedia || null,
                    });
                }
            } else {
                selectedApdList = selectedApdList.filter(a => String(a.id) !== String(item.id));
            }
            renderApdChecklistChips();
            renderApdChecklistLabel();
        }

        function removeApdSelection(id) {
            selectedApdList = selectedApdList.filter(a => String(a.id) !== String(id));
            renderApdChecklistChips();
            renderApdChecklistLabel();
            renderApdChecklistOptions(document.querySelector('#apdChecklistPanel .ms-search')?.value || '');
        }

        function renderApdChecklistChips() {
            const box = document.getElementById('apdChecklistChips');
            if (selectedApdList.length === 0) {
                box.innerHTML = '';
                return;
            }
            box.innerHTML = selectedApdList.map(a => `
                <span class="status-pill sp-blue" style="display:inline-flex; align-items:center; gap:6px;">
                    ${escapeHtml(a.jenis_apd)}${a.kode_apd ? ' · ' + escapeHtml(a.kode_apd) : ''}
                    <span style="cursor:pointer; font-weight:700;" onclick="removeApdSelection('${a.id}')">✕</span>
                </span>
            `).join('');
        }

        function renderApdChecklistLabel() {
            const label = document.getElementById('apdChecklistLabel');
            label.textContent = selectedApdList.length > 0 ?
                `${selectedApdList.length} APD dipilih` :
                'Pilih APD yang dikembalikan...';
        }

        function toggleApdChecklistDropdown() {
            const panel = document.getElementById('apdChecklistPanel');
            const isOpen = panel.classList.contains('open');
            document.querySelectorAll('.ms-dropdown-panel.open').forEach(p => p.classList.remove('open'));
            if (!isOpen) {
                panel.classList.add('open');
                renderApdChecklistOptions();
                const search = panel.querySelector('.ms-search');
                search.value = '';
                search.focus();
            }
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('apdChecklistWrap');
            if (wrap && !wrap.contains(e.target)) {
                document.getElementById('apdChecklistPanel')?.classList.remove('open');
            }
        });

        // ══════ PICKER PEGAWAI — Nomor Badge / Nama Lengkap ══════
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
            document.getElementById('fNomorBadge').value = p.badge;
            document.getElementById('fNamaLengkap').value = p.nama;
            document.getElementById('fJabatan').value = p.jabatan;
            document.getElementById('fUnitKerja').value = p.unit_kerja;
            document.getElementById('pegawaiPickerInput').value = `${p.nama} (${p.badge})`;
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');
        }

        document.addEventListener('click', (e) => {
            const wrapPegawai = document.getElementById('pegawaiPickerInput')?.closest('.picker-wrap');
            if (wrapPegawai && !wrapPegawai.contains(e.target)) {
                document.getElementById('pegawaiPickerDropdown')?.classList.remove('open');
            }
        });

        // ══════ MODAL TAMBAH / EDIT ══════
        async function openFormModal(row = null) {
            currentEditId = row ? row.id : null;

            populateStatusFisikKibSelect();
            await loadApdOptions();

            document.getElementById('formModalTitle').textContent = row ? 'Edit Pengembalian KIB & APD' :
                'Tambah Pengembalian KIB & APD';
            document.getElementById('formModalSub').textContent = row ?
                `Perbarui data pengembalian ${row.no_dokumen}` :
                'Lengkapi data pengembalian di bawah ini.';

            document.getElementById('fNoDokumen').value = row?.no_dokumen || '';
            document.getElementById('fNoDokumen').placeholder = row ? '' : 'Otomatis digenerate setelah disimpan';
            document.getElementById('fTanggal').value = row?.tanggal || new Date().toISOString().slice(0, 10);

            document.getElementById('fNomorBadge').value = row?.nomor_badge || '';
            document.getElementById('fNamaLengkap').value = row?.nama_lengkap || '';
            document.getElementById('fJabatan').value = row?.jabatan || '';
            document.getElementById('fUnitKerja').value = row?.unit_kerja || '';
            document.getElementById('pegawaiPickerInput').value =
                (row?.nama_lengkap && row?.nomor_badge) ? `${row.nama_lengkap} (${row.nomor_badge})` : '';
            document.getElementById('pegawaiPickerDropdown').classList.remove('open');

            document.getElementById('fStatusFisikKib').value = row?.status_fisik_kib || STATUS_FISIK_KIB_OPTIONS[0];
            document.getElementById('fNomorKibDikembalikan').value = row?.nomor_kib_dikembalikan || '';
            document.getElementById('fKeterangan').value = row?.keterangan || '';

            document.getElementById('fFotoKib').value = '';
            const kibPreviewBox = document.getElementById('fotoKibPreviewBox');
            if (row?.foto_kib_url) {
                document.getElementById('fotoKibPreviewImg').src = row.foto_kib_url;
                document.getElementById('fotoKibPreviewLabel').textContent = 'Foto saat ini:';
                kibPreviewBox.style.display = '';
            } else {
                kibPreviewBox.style.display = 'none';
            }

            document.getElementById('fFotoApd').value = '';
            const apdPreviewBox = document.getElementById('fotoApdPreviewBox');
            if (row?.foto_apd_url) {
                document.getElementById('fotoApdPreviewImg').src = row.foto_apd_url;
                document.getElementById('fotoApdPreviewLabel').textContent = 'Foto saat ini:';
                apdPreviewBox.style.display = '';
            } else {
                apdPreviewBox.style.display = 'none';
            }

            selectedApdList = Array.isArray(row?.apd_dikembalikan) ? row.apd_dikembalikan.map(a => ({
                id: a.id,
                kode_apd: a.kode_apd,
                jenis_apd: a.jenis_apd,
                ukuran: a.ukuran,
            })) : [];
            renderApdChecklistChips();
            renderApdChecklistLabel();
            document.getElementById('apdChecklistPanel').classList.remove('open');

            document.getElementById('formModalOverlay').classList.add('open');
        }

        function closeFormModal() {
            document.getElementById('formModalOverlay').classList.remove('open');
            currentEditId = null;
        }

        function closeFormModalOutside(event) {
            if (event.target.id === 'formModalOverlay') closeFormModal();
        }

        async function submitForm() {
            const btn = document.getElementById('btnSubmitForm');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const formData = new FormData();
            formData.append('tanggal', document.getElementById('fTanggal').value);
            formData.append('nomor_badge', document.getElementById('fNomorBadge').value.trim());
            formData.append('nama_lengkap', document.getElementById('fNamaLengkap').value.trim());

            const appendOrEmpty = (key, val) => formData.append(key, val ?? '');
            appendOrEmpty('jabatan', document.getElementById('fJabatan').value.trim());
            appendOrEmpty('unit_kerja', document.getElementById('fUnitKerja').value.trim());

            formData.append('status_fisik_kib', document.getElementById('fStatusFisikKib').value);
            appendOrEmpty('nomor_kib_dikembalikan', document.getElementById('fNomorKibDikembalikan').value.trim());
            appendOrEmpty('keterangan', document.getElementById('fKeterangan').value.trim());

            formData.append('apd_dikembalikan', JSON.stringify(selectedApdList));

            const fotoKibInput = document.getElementById('fFotoKib');
            if (fotoKibInput.files && fotoKibInput.files[0]) {
                formData.append('foto_kib', fotoKibInput.files[0]);
            }

            const fotoApdInput = document.getElementById('fFotoApd');
            if (fotoApdInput.files && fotoApdInput.files[0]) {
                formData.append('foto_apd', fotoApdInput.files[0]);
            }

            if (!formData.get('nomor_badge') || !formData.get('nama_lengkap')) {
                showToast('Silakan pilih karyawan terlebih dahulu.', 'error');
                btn.disabled = false;
                btn.textContent = originalText;
                return;
            }

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
        }

        // ══════ MODAL DETAIL ══════
        function openDetailModal(row) {
            document.getElementById('detailAvatarInitial').textContent = initials(row.nama_lengkap);
            document.getElementById('detailNamaTitle').textContent = display(row.nama_lengkap, FALLBACK_KARYAWAN);
            document.getElementById('detailNoDokumenSub').textContent = row.no_dokumen || '-';

            document.getElementById('dNoDokumen').value = row.no_dokumen || '-';
            document.getElementById('dTanggal').value = formatDate(row.tanggal);
            document.getElementById('dNomorBadge').value = display(row.nomor_badge, FALLBACK_KARYAWAN);
            document.getElementById('dNamaLengkap').value = display(row.nama_lengkap, FALLBACK_KARYAWAN);
            document.getElementById('dJabatan').value = display(row.jabatan, FALLBACK_KARYAWAN);
            document.getElementById('dUnitKerja').value = display(row.unit_kerja, FALLBACK_KARYAWAN);

            document.getElementById('dStatusFisikKib').value = row.status_fisik_kib || '-';
            document.getElementById('dNomorKibDikembalikan').value = display(row.nomor_kib_dikembalikan);
            document.getElementById('dKeterangan').value = display(row.keterangan);

            const fotoKibBox = document.getElementById('dFotoKibBox');
            fotoKibBox.innerHTML = row.foto_kib_url ?
                `<a href="${row.foto_kib_url}" target="_blank"><img src="${row.foto_kib_url}" style="max-width:220px; max-height:160px; border-radius:8px; border:1px solid #E2E8F0;" /></a>` :
                `<div class="detail-field-empty" style="color:#94A3B8; font-size:13px;">Tidak ada foto.</div>`;

            document.getElementById('dApdChecklistList').innerHTML = apdChipsHtml(row.apd_dikembalikan);

            const fotoApdBox = document.getElementById('dFotoApdBox');
            fotoApdBox.innerHTML = row.foto_apd_url ?
                `<a href="${row.foto_apd_url}" target="_blank"><img src="${row.foto_apd_url}" style="max-width:220px; max-height:160px; border-radius:8px; border:1px solid #E2E8F0;" /></a>` :
                `<div class="detail-field-empty" style="color:#94A3B8; font-size:13px;">Tidak ada foto.</div>`;

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        // ══════ MODAL HAPUS ══════
        function openDeleteModal(id, noDokumen) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Data pengembalian "${noDokumen}" akan dihapus permanen dan tidak dapat dikembalikan. Lanjutkan?`;
            document.getElementById('deleteConfirmOverlay').classList.add('open');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmOverlay').classList.remove('open');
            currentDeleteId = null;
        }

        function closeDeleteModalOutside(event) {
            if (event.target.id === 'deleteConfirmOverlay') closeDeleteModal();
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

                if (!res.ok) {
                    throw new Error(json.message || `Server merespons dengan status ${res.status}`);
                }

                closeDeleteModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                closeDeleteModal();
                showToast(e.message || 'Terjadi kesalahan saat menghapus data.', 'error');
            }
        }

        // ══════ FOTO PREVIEW ══════
        function onFotoKibChange() {
            const input = document.getElementById('fFotoKib');
            const box = document.getElementById('fotoKibPreviewBox');
            const img = document.getElementById('fotoKibPreviewImg');
            const label = document.getElementById('fotoKibPreviewLabel');

            if (input.files && input.files[0]) {
                img.src = URL.createObjectURL(input.files[0]);
                label.textContent = 'Preview foto baru (akan menggantikan foto lama jika disimpan):';
                box.style.display = '';
            }
        }

        function onFotoApdChange() {
            const input = document.getElementById('fFotoApd');
            const box = document.getElementById('fotoApdPreviewBox');
            const img = document.getElementById('fotoApdPreviewImg');
            const label = document.getElementById('fotoApdPreviewLabel');

            if (input.files && input.files[0]) {
                img.src = URL.createObjectURL(input.files[0]);
                label.textContent = 'Preview foto baru (akan menggantikan foto lama jika disimpan):';
                box.style.display = '';
            }
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>


</html>
