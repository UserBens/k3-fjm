<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Permintaan Pembelian APD — PT. Fokus Jasa Mitra</title>
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

        /* SUMMARY CARDS */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        .summary-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px 16px;
        }

        .summary-label {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 6px;
        }

        .summary-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            letter-spacing: 0.02em;
        }

        @media (max-width: 900px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

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
                            <span class="pg-eyebrow">Pengadaan · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">PERMINTAAN <span>PEMBELIAN APD</span></div>
                        <div class="pg-sub">Rekap permintaan pembelian APD dan status kedatangan barang.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Permintaan
                        </button>
                    </div>
                </div>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Total Item Permintaan</div>
                    <div class="summary-value" id="sumTotal">0</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label" style="color:#D0021B;">Belum Datang</div>
                    <div class="summary-value" id="sumBelumDatang" style="color:#D0021B;">0</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label" style="color:#D97706;">Kurang</div>
                    <div class="summary-value" id="sumKurang" style="color:#D97706;">0</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label" style="color:#1A7A3C;">Lengkap</div>
                    <div class="summary-value" id="sumLengkap" style="color:#1A7A3C;">0</div>
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
                            placeholder="Cari No. PP, nama APD, unit kerja, atau peminta..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="Belum Datang">Belum Datang</option>
                        <option value="Kurang">Kurang</option>
                        <option value="Lengkap">Lengkap</option>
                    </select>

                    <select id="filterUnitKerja" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Unit Kerja</option>
                    </select>

                    <input type="date" id="filterTanggalDari" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal PP Dari" />
                    <input type="date" id="filterTanggalSampai" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal PP Sampai" />

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data permintaan...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>No. PP &amp; Tanggal</th>
                                <th>Unit Kerja / Diminta Oleh</th>
                                <th>Nama APD</th>
                                <th>Qty Diminta / Datang / Kurang</th>
                                <th>Tanggal Datang</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="8">
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

    <!-- ══════ MODAL TAMBAH / EDIT PERMINTAAN ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Permintaan APD</div>
                <div class="detail-subtitle" id="formModalSub">Lengkapi data permintaan pembelian APD di bawah ini.
                </div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Data Permintaan Pembelian (PP)</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">No. PP</label>
                        <input type="text" id="fNoPp" class="form-input" placeholder="17/I/PP/2026" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal PP</label>
                        <input type="date" id="fTanggalPp" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Unit Kerja</label>
                        <input type="text" id="fUnitKerja" class="form-input" placeholder="Warehouse" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Diminta Oleh</label>
                        <input type="text" id="fDimintaOleh" class="form-input" placeholder="Nama pemohon" />
                    </div>
                </div>
                <div class="detail-subtitle" style="margin-top:8px;">
                    Jika No. PP sudah ada, item baru akan otomatis ditambahkan ke PP tersebut.
                </div>

                <div class="form-section-title">Data Barang APD</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">Nama APD</label>
                        <input type="text" id="fNamaApd" class="form-input"
                            placeholder="Helm Krisbow + Tali Dagu" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Qty Diminta</label>
                        <input type="number" min="1" id="fQtyPermintaan" class="form-input"
                            placeholder="0" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Qty Sudah Datang</label>
                        <input type="number" min="0" id="fQtyDatang" class="form-input" placeholder="0" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Datang</label>
                        <input type="date" id="fTanggalDatang" class="form-input" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Keterangan</label>
                        <textarea id="fKeterangan" class="form-textarea" rows="2"
                            placeholder="Contoh: Tali helm kurang 17 / Belum datang / Kurang"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:18px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL PERMINTAAN ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar">
                        <span id="detailAvatarInitial"></span>
                    </div>
                    <div>
                        <div class="modal-title" id="detailNamaApdTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailNoPpSub">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-section-title">Data Permintaan Pembelian</div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>No. PP</label>
                            <input type="text" id="dNoPp" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Tanggal PP</label>
                            <input type="text" id="dTanggalPp" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Unit Kerja</label>
                            <input type="text" id="dUnitKerja" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Diminta Oleh</label>
                            <input type="text" id="dDimintaOleh" readonly>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Data Barang &amp; Kedatangan</div>
                    <div class="detail-form-grid">
                        <div class="detail-field span-2">
                            <label>Nama APD</label>
                            <input type="text" id="dNamaApd" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Qty Diminta</label>
                            <input type="text" id="dQtyPermintaan" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Qty Sudah Datang</label>
                            <input type="text" id="dQtyDatang" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Qty Kurang</label>
                            <input type="text" id="dQtyKurang" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Tanggal Datang</label>
                            <input type="text" id="dTanggalDatang" readonly>
                        </div>
                        <div class="detail-field span-2">
                            <label>Status</label>
                            <input type="text" id="dStatus" readonly>
                        </div>
                        <div class="detail-field span-2">
                            <label>Keterangan</label>
                            <textarea id="dKeterangan" readonly rows="2"></textarea>
                        </div>
                    </div>
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
            <div class="modal-title">Hapus Permintaan?</div>
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
        const DATA_ENDPOINT = "{{ route('permintaan-pembelian.data') }}";
        const STORE_ENDPOINT = "{{ route('permintaan-pembelian.store') }}";
        const BASE_ENDPOINT = "{{ url('/permintaan-pembelian') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            status: '',
            unit_kerja: '',
            tanggal_dari: '',
            tanggal_sampai: '',
            page: 1,
            per_page: 10,
        };

        let searchDebounce = null;
        let filterOptionsLoaded = false;
        let currentEditId = null;
        let currentDeleteId = null;
        let currentRows = [];

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

        function statusPillClass(status) {
            if (status === 'Lengkap') return 'sp-green';
            if (status === 'Kurang') return 'sp-amber';
            if (status === 'Belum Datang') return 'sp-red';
            return 'sp-gray';
        }

        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.status = document.getElementById('filterStatus').value;
            state.unit_kerja = document.getElementById('filterUnitKerja').value;
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
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterUnitKerja').value = '';
            document.getElementById('filterTanggalDari').value = '';
            document.getElementById('filterTanggalSampai').value = '';
            Object.assign(state, {
                search: '',
                status: '',
                unit_kerja: '',
                tanggal_dari: '',
                tanggal_sampai: '',
                page: 1,
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

            const select = document.getElementById('filterUnitKerja');
            const current = select.value;
            (options.unit_kerja || []).forEach(val => {
                const opt = document.createElement('option');
                opt.value = val;
                opt.textContent = val;
                select.appendChild(opt);
            });
            select.value = current;
            filterOptionsLoaded = true;
        }

        function updateSummaryCards(rows) {
            // Ringkasan dihitung dari halaman data yang sedang ditampilkan (server-side paginated),
            // jadi tampilkan sebagai ringkasan "pada halaman ini" agar tetap akurat & ringan.
            const total = rows.length;
            const belumDatang = rows.filter(r => r.status === 'Belum Datang').length;
            const kurang = rows.filter(r => r.status === 'Kurang').length;
            const lengkap = rows.filter(r => r.status === 'Lengkap').length;

            document.getElementById('sumTotal').textContent = total;
            document.getElementById('sumBelumDatang').textContent = belumDatang;
            document.getElementById('sumKurang').textContent = kurang;
            document.getElementById('sumLengkap').textContent = lengkap;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            currentRows = rows;

            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="8">
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
                        <div class="td-name-main">${escapeHtml(row.no_pp)}</div>
                        <div class="td-name-sub">${formatDate(row.tanggal_pp)}</div>
                    </td>

                    <td>
                        <div class="td-name-sub">${escapeHtml(display(row.unit_kerja))}</div>
                        <div class="td-name-sub">${escapeHtml(display(row.diminta_oleh))}</div>
                    </td>

                    <td style="max-width:220px;">
                        <div class="td-name-main">${escapeHtml(row.nama_apd)}</div>
                    </td>

                    <td>
                        <div class="qty-line">Diminta: <b>${row.qty_permintaan}</b></div>
                        <div class="qty-line">Datang: <b>${row.qty_datang}</b></div>
                        <div class="qty-line ${row.qty_kurang > 0 ? 'kurang' : ''}">Kurang: <b>${row.qty_kurang}</b></div>
                    </td>

                    <td>
                        <div class="td-name-sub">${formatDate(row.tanggal_datang)}</div>
                    </td>

                    <td>
                        <span class="status-pill ${statusPillClass(row.status)}">${escapeHtml(row.status)}</span>
                    </td>

                    <td style="max-width:200px;">
                        <div class="td-name-sub" style="white-space:normal; line-height:1.4;">${escapeHtml(display(row.keterangan))}</div>
                    </td>

                    <td style="text-align:center; white-space:nowrap;">
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
                        <button class="btn-row-action" onclick="openDeleteModal(${row.id}, '${escapeHtml(row.nama_apd)}')">
                            <svg style="width:14px;height:14px; color:#D0021B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
            <td colspan="8">
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
            document.getElementById('dataSummary').textContent = 'Gagal memuat data permintaan.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';

            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> permintaan ditemukan`;

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
            if (state.status) params.set('status', state.status);
            if (state.unit_kerja) params.set('unit_kerja', state.unit_kerja);
            if (state.tanggal_dari) params.set('tanggal_dari', state.tanggal_dari);
            if (state.tanggal_sampai) params.set('tanggal_sampai', state.tanggal_sampai);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
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
                populateFilterOptions(json.filter_options);
                updateSummaryCards(json.data);
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

        // ══════ MODAL TAMBAH / EDIT ══════
        function openFormModal(row = null) {
            currentEditId = row ? row.id : null;

            document.getElementById('formModalTitle').textContent = row ? 'Edit Permintaan APD' : 'Tambah Permintaan APD';
            document.getElementById('formModalSub').textContent = row ?
                `Perbarui data permintaan "${row.nama_apd}" (${row.no_pp})` :
                'Lengkapi data permintaan pembelian APD di bawah ini.';

            document.getElementById('fNoPp').value = row?.no_pp || '';
            document.getElementById('fTanggalPp').value = row?.tanggal_pp || '';
            document.getElementById('fUnitKerja').value = row?.unit_kerja || '';
            document.getElementById('fDimintaOleh').value = row?.diminta_oleh || '';

            document.getElementById('fNamaApd').value = row?.nama_apd || '';
            document.getElementById('fQtyPermintaan').value = row?.qty_permintaan ?? '';
            document.getElementById('fQtyDatang').value = row?.qty_datang ?? 0;
            document.getElementById('fTanggalDatang').value = row?.tanggal_datang || '';
            document.getElementById('fKeterangan').value = row?.keterangan || '';

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

            const payload = {
                no_pp: document.getElementById('fNoPp').value.trim(),
                tanggal_pp: document.getElementById('fTanggalPp').value,
                unit_kerja: document.getElementById('fUnitKerja').value.trim() || null,
                diminta_oleh: document.getElementById('fDimintaOleh').value.trim() || null,

                nama_apd: document.getElementById('fNamaApd').value.trim(),
                qty_permintaan: document.getElementById('fQtyPermintaan').value || 0,
                qty_datang: document.getElementById('fQtyDatang').value || 0,
                tanggal_datang: document.getElementById('fTanggalDatang').value || null,
                keterangan: document.getElementById('fKeterangan').value.trim() || null,
            };

            const url = currentEditId ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;
            const method = currentEditId ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    body: JSON.stringify(payload),
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
            document.getElementById('detailAvatarInitial').textContent = initials(row.nama_apd);
            document.getElementById('detailNamaApdTitle').textContent = row.nama_apd || '-';
            document.getElementById('detailNoPpSub').textContent = row.no_pp || '-';

            document.getElementById('dNoPp').value = row.no_pp || '-';
            document.getElementById('dTanggalPp').value = formatDate(row.tanggal_pp);
            document.getElementById('dUnitKerja').value = display(row.unit_kerja);
            document.getElementById('dDimintaOleh').value = display(row.diminta_oleh);

            document.getElementById('dNamaApd').value = row.nama_apd || '-';
            document.getElementById('dQtyPermintaan').value = row.qty_permintaan;
            document.getElementById('dQtyDatang').value = row.qty_datang;
            document.getElementById('dQtyKurang').value = row.qty_kurang;
            document.getElementById('dTanggalDatang').value = formatDate(row.tanggal_datang);
            document.getElementById('dStatus').value = row.status;
            document.getElementById('dKeterangan').value = display(row.keterangan);

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        // ══════ MODAL HAPUS ══════
        function openDeleteModal(id, namaApd) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Permintaan "${namaApd}" akan dihapus permanen dan tidak dapat dikembalikan. Lanjutkan?`;
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
                        'X-CSRF-TOKEN': CSRF_TOKEN,
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

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
