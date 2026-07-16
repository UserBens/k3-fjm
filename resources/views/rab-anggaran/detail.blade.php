<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Stok APD — PT. Fokus Jasa Mitra</title>
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
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- ══════ SIDEBAR (pakai partial existing app Anda) ══════ -->
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
                            <a href="{{ route('rab-anggaran.index') }}" class="pg-eyebrow"
                                style="text-decoration:none;">
                                ‹ Kembali ke Daftar RAB
                            </a>
                        </div>
                        <div class="pg-title">DETAIL <span id="pgNomorRabTitle">RAB</span></div>
                        <div class="pg-sub">Rencana Anggaran Biaya pengajuan aset APD &amp; Alat Kesehatan.</div>
                    </div>
                    <div class="pg-actions">
                        <a class="btn-outline" href="{{ route('rab-anggaran.export', ['rabAnggaran' => $rabId]) }}">
                            <svg style="width:13px;height:13px; display:inline-block; vertical-align:-2px; margin-right:4px;"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H8a2 2 0 01-2-2V5a2 2 0 012-2h6l6 6v11a2 2 0 01-2 2z" />
                            </svg>
                            Export Excel
                        </a>
                        <button class="btn-outline" onclick="openHeaderEditModal()">Edit Header</button>
                    </div>
                </div>
            </div>

            <!-- ══════ KOP RAB ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="rab-kop-title">RENCANA ANGGARAN BIAYA (RAB) — PENGAJUAN ASET APD &amp; ALAT KESEHATAN
                    TAHUNAN</div>
                <div class="rab-kop-grid" id="rabKopGrid">
                    <div class="rab-kop-box"><label>Nama Perusahaan</label><span id="hNamaPerusahaan">—</span></div>
                    <div class="rab-kop-box"><label>Departemen</label><span id="hDepartemen">—</span></div>
                    <div class="rab-kop-box"><label>Tahun Anggaran</label><span id="hTahunAnggaran">—</span></div>
                    <div class="rab-kop-box"><label>Nomor RAB</label><span id="hNomorRab">—</span></div>
                    <div class="rab-kop-box"><label>Dibuat Oleh</label><span id="hDibuatOleh">—</span></div>
                    <div class="rab-kop-box"><label>Disetujui Oleh</label><span id="hDisetujuiOleh">—</span></div>
                    <div class="rab-kop-box"><label>Tanggal Pengajuan</label><span id="hTanggalPengajuan">—</span></div>
                    <div class="rab-kop-box"><label>Status</label><span id="hStatus">—</span></div>
                </div>
            </div>

            <!-- ══════ TABEL A — APD ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div class="form-section-title" style="margin:0;">A. Kebutuhan APD Berdasarkan Kode OK dan Jabatan
                    </div>
                    <button class="btn-primary" onclick="openItemModal('APD')">
                        <svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Item APD
                    </button>
                </div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th style="width:32px;">No</th>
                                <th>Kode OK</th>
                                <th>Jabatan/Posisi</th>
                                <th>Jenis APD</th>
                                <th>Kategori</th>
                                <th>Merk/Type</th>
                                <th>Spesifikasi</th>
                                <th>Ukuran</th>
                                <th>Qty Ada</th>
                                <th>Qty Butuh</th>
                                <th>Qty Pengadaan</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                                <th>Keterangan</th>
                                <th>Prioritas</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyApd">
                            <tr>
                                <td colspan="17">
                                    <div class="skeleton-bar" style="width:100%;height:36px;"></div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="rab-subtotal-row">
                                <td colspan="13" style="text-align:right;">SUBTOTAL A (APD)</td>
                                <td id="subtotalApd">Rp 0</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- ══════ TABEL B — ALKES ══════ -->
            <div class="section-card" style="margin-bottom:14px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div class="form-section-title" style="margin:0;">B. Kebutuhan Alat Kesehatan &amp; Consumable
                    </div>
                    <button class="btn-primary" onclick="openItemModal('ALKES')">
                        <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Item Alkes
                    </button>
                </div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th style="width:32px;">No</th>
                                <th>Kode OK</th>
                                <th>Jabatan/Posisi</th>
                                <th>Jenis Alat</th>
                                <th>Kategori</th>
                                <th>Merk/Type</th>
                                <th>Spesifikasi</th>
                                <th>Ukuran</th>
                                <th>Qty Ada</th>
                                <th>Qty Butuh</th>
                                <th>Qty Pengadaan</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                                <th>Keterangan</th>
                                <th>Prioritas</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyAlkes">
                            <tr>
                                <td colspan="17">
                                    <div class="skeleton-bar" style="width:100%;height:36px;"></div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="rab-subtotal-row">
                                <td colspan="13" style="text-align:right;">SUBTOTAL B (ALKES)</td>
                                <td id="subtotalAlkes">Rp 0</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- ══════ GRAND TOTAL ══════ -->
            <div class="section-card rab-grandtotal-bar" style="margin-bottom:14px;">
                <span>GRAND TOTAL RAB APD &amp; ALKES TAHUN <span id="gtTahun">—</span></span>
                <span id="grandTotal" class="rab-grandtotal-value">Rp 0</span>
            </div>

        </div>
    </div>

    <!-- ══════ MODAL EDIT HEADER ══════ -->
    <div id="headerEditModalOverlay" class="modal-overlay" onclick="closeHeaderEditModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title">Edit Header RAB</div>
                <div class="detail-subtitle" id="headerEditSub">Perbarui data header dokumen RAB.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">No. RAB</label>
                        <input type="text" id="hfNomorRab" class="form-input" readonly disabled
                            style="background:#F1F5F9; color:#64748B; cursor:not-allowed;" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Perusahaan</label>
                        <input type="text" id="hfNamaPerusahaan" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Departemen</label>
                        <input type="text" id="hfDepartemen" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tahun Anggaran</label>
                        <input type="number" id="hfTahunAnggaran" class="form-input" min="2000"
                            max="2100" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Pengajuan</label>
                        <input type="date" id="hfTanggalPengajuan" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select id="hfStatus" class="form-select"></select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Dibuat Oleh</label>
                        <input type="text" id="hfDibuatOleh" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Disetujui Oleh</label>
                        <input type="text" id="hfDisetujuiOleh" class="form-input" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Keterangan</label>
                        <textarea id="hfKeterangan" class="form-textarea" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeHeaderEditModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitHeader" onclick="submitHeaderEdit()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL TAMBAH / EDIT ITEM (APD atau ALKES) ══════ -->
    <div id="itemModalOverlay" class="modal-overlay" onclick="closeItemModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="itemModalTitle">Tambah Item</div>
                <div class="detail-subtitle" id="itemModalSub">Lengkapi data item di bawah ini.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Data Umum</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Kode OK</label>
                        <input type="text" id="fItemKodeOk" class="form-input" placeholder="PCS01 / OK-001" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jabatan/Posisi</label>
                        <input type="text" id="fItemJabatanPosisi" class="form-input"
                            placeholder="Operator Produksi" />
                    </div>
                </div>

                <div class="form-section-title" id="itemPickerSectionTitle">Pilih dari Master</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label" id="itemPickerLabel">Pilih dari Master (opsional)</label>
                        <select id="fItemMasterId" class="form-select" onchange="onItemMasterSelectChange()">
                            <option value="">— Pilih untuk autofill, atau isi manual di bawah —</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" id="itemNamaBarangLabel">Jenis APD</label>
                        <input type="text" id="fItemNamaBarang" class="form-input" placeholder="Helm Safety" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select id="fItemKategori" class="form-select"></select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Merk / Type</label>
                        <input type="text" id="fItemMerkType" class="form-input" placeholder="MSA V-Gard" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ukuran</label>
                        <input type="text" id="fItemUkuran" class="form-input" placeholder="L / Universal" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Spesifikasi</label>
                        <textarea id="fItemSpesifikasi" class="form-textarea" rows="2" placeholder="ABS Class E, EN 397"></textarea>
                    </div>
                </div>

                <div class="form-section-title">Kuantitas &amp; Harga</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Qty Ada</label>
                        <input type="number" min="0" id="fItemQtyAda" class="form-input" placeholder="0"
                            oninput="recalcItemTotal()" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Qty Butuh</label>
                        <input type="number" min="0" id="fItemQtyButuh" class="form-input" placeholder="0"
                            oninput="recalcItemTotal()" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Qty Pengadaan</label>
                        <input type="number" min="0" id="fItemQtyPengadaan" class="form-input"
                            placeholder="0" oninput="recalcItemTotal()" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Satuan</label>
                        <input type="text" id="fItemSatuan" class="form-input"
                            placeholder="Unit / Pasang / Box" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Satuan (Rp)</label>
                        <input type="number" min="0" id="fItemHargaSatuan" class="form-input"
                            placeholder="0" oninput="recalcItemTotal()" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total Harga (Rp)</label>
                        <input type="text" id="fItemTotalHargaPreview" class="form-input" readonly
                            style="background:#F1F5F9; color:#0F172A; font-weight:700;" value="Rp 0" />
                    </div>
                </div>

                <div class="form-section-title">Lainnya</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Prioritas</label>
                        <select id="fItemPrioritas" class="form-select"></select>
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Keterangan</label>
                        <textarea id="fItemKeterangan" class="form-textarea" rows="2" placeholder="Pengadaan rutin, dsb"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeItemModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitItem" onclick="submitItem()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL KONFIRMASI HAPUS ITEM ══════ -->
    <div id="deleteItemConfirmOverlay" class="modal-overlay" onclick="closeDeleteItemModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="modal-title">Hapus Item?</div>
            <div class="modal-desc" id="deleteItemModalDesc">
                Item yang sudah dihapus tidak dapat dikembalikan.
            </div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteItemModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmDeleteItem()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <style>
        /* Kop RAB — mengikuti tampilan kotak biru pada dokumen RAB */
        .rab-kop-title {
            text-align: center;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: .02em;
            color: #0F172A;
            background: #1E3A8A;
            color: #fff;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .rab-kop-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .rab-kop-box {
            border: 1px solid #BFDBFE;
            background: #EFF6FF;
            border-radius: 8px;
            padding: 8px 10px;
        }

        .rab-kop-box label {
            display: block;
            font-size: 10.5px;
            font-weight: 700;
            color: #1D4ED8;
            text-transform: uppercase;
            letter-spacing: .03em;
            margin-bottom: 2px;
        }

        .rab-kop-box span {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #0F172A;
        }

        .rab-subtotal-row td {
            background: #F8FAFC;
            font-weight: 700;
            color: #0F172A;
        }

        .rab-grandtotal-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FEF3C7;
            border: 1px solid #FDE68A;
            font-weight: 800;
            font-size: 14px;
            color: #78350F;
        }

        .rab-grandtotal-value {
            font-size: 16px;
        }

        .prioritas-pill {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .prioritas-tinggi {
            background: #FEE2E2;
            color: #B91C1C;
        }

        .prioritas-sedang {
            background: #FEF3C7;
            color: #92400E;
        }

        .prioritas-rendah {
            background: #DCFCE7;
            color: #15803D;
        }
    </style>

    <script>
        // ══════ CONFIG ══════
        const RAB_ID = {{ $rabId }};
        const DETAIL_DATA_ENDPOINT = "{{ route('rab-anggaran.detail-data', ['rabAnggaran' => $rabId]) }}";
        const HEADER_UPDATE_ENDPOINT = "{{ url('/rab-anggaran/' . $rabId) }}";
        const ITEM_STORE_ENDPOINT = "{{ route('rab-anggaran.items.store', ['rabAnggaran' => $rabId]) }}";
        const ITEM_BASE_ENDPOINT = "{{ url('/rab-anggaran/items') }}";
        const APD_OPTIONS_ENDPOINT = "{{ route('rab-anggaran.apd-options') }}";
        const ALKES_OPTIONS_ENDPOINT = "{{ route('rab-anggaran.alkes-options') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const STATUS_OPTIONS = @json(\App\Models\RabAnggaran::STATUS);
        const PRIORITAS_OPTIONS = @json(\App\Models\RabAnggaranItem::PRIORITAS);
        const KATEGORI_APD = @json(\App\Models\RabAnggaranItem::KATEGORI_APD);
        const KATEGORI_ALKES = @json(\App\Models\RabAnggaranItem::KATEGORI_ALKES);

        let apdOptionsCache = [];
        let alkesOptionsCache = [];
        let currentItemJenis = 'APD';
        let currentEditItemId = null;
        let currentDeleteItemId = null;

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

        function formatRupiah(value) {
            const num = Number(value) || 0;
            return 'Rp ' + num.toLocaleString('id-ID', {
                maximumFractionDigits: 0
            });
        }

        function statusPillClass(status) {
            if (status === 'DISETUJUI') return 'sp-green';
            if (status === 'DIAJUKAN') return 'sp-blue';
            return 'sp-gray';
        }

        function prioritasPillClass(prioritas) {
            if (prioritas === 'TINGGI') return 'prioritas-tinggi';
            if (prioritas === 'RENDAH') return 'prioritas-rendah';
            return 'prioritas-sedang';
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

        // ══════ LOAD DETAIL (header + 2 tabel) ══════
        async function loadDetail() {
            try {
                const res = await fetch(DETAIL_DATA_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error((await res.json().catch(() => null))?.message || `Status ${res.status}`);
                const json = await res.json();

                renderHeader(json.header);
                renderItemsTable('tableBodyApd', json.items_apd, 'APD');
                renderItemsTable('tableBodyAlkes', json.items_alkes, 'ALKES');

                document.getElementById('subtotalApd').textContent = formatRupiah(json.header.subtotal_apd);
                document.getElementById('subtotalAlkes').textContent = formatRupiah(json.header.subtotal_alkes);
                document.getElementById('grandTotal').textContent = formatRupiah(json.header.grand_total);
                document.getElementById('gtTahun').textContent = json.header.tahun_anggaran;
            } catch (e) {
                showToast(e.message || 'Gagal memuat detail RAB.', 'error');
            }
        }

        function renderHeader(h) {
            document.getElementById('pgNomorRabTitle').textContent = h.nomor_rab;
            document.getElementById('hNamaPerusahaan').textContent = display(h.nama_perusahaan);
            document.getElementById('hDepartemen').textContent = display(h.departemen);
            document.getElementById('hTahunAnggaran').textContent = display(h.tahun_anggaran);
            document.getElementById('hNomorRab').textContent = display(h.nomor_rab);
            document.getElementById('hDibuatOleh').textContent = display(h.dibuat_oleh);
            document.getElementById('hDisetujuiOleh').textContent = display(h.disetujui_oleh);
            document.getElementById('hTanggalPengajuan').textContent = formatDate(h.tanggal_pengajuan);
            document.getElementById('hStatus').innerHTML =
                `<span class="status-pill ${statusPillClass(h.status)}">${escapeHtml(h.status)}</span>`;

            // simpan untuk modal edit header
            window.__rabHeaderCache = h;
        }

        function renderItemsTable(tbodyId, rows, jenis) {
            const tbody = document.getElementById(tbodyId);

            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
                    <tr><td colspan="17">
                        <div class="empty-state">
                            <div class="empty-state-title">Belum ada item ${jenis === 'APD' ? 'APD' : 'Alat Kesehatan'}</div>
                            <div class="empty-state-sub">Klik "Tambah Item ${jenis === 'APD' ? 'APD' : 'Alkes'}" untuk menambahkan baris.</div>
                        </div>
                    </td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map((row, idx) => `
                <tr>
                    <td>${idx + 1}</td>
                    <td>${escapeHtml(display(row.kode_ok))}</td>
                    <td>${escapeHtml(display(row.jabatan_posisi))}</td>
                    <td><b>${escapeHtml(row.nama_barang)}</b></td>
                    <td>${escapeHtml(display(row.kategori))}</td>
                    <td>${escapeHtml(display(row.merk_type))}</td>
                    <td style="max-width:180px; white-space:normal;">${escapeHtml(display(row.spesifikasi))}</td>
                    <td>${escapeHtml(display(row.ukuran))}</td>
                    <td style="text-align:center;">${row.qty_ada}</td>
                    <td style="text-align:center;">${row.qty_butuh}</td>
                    <td style="text-align:center;"><b>${row.qty_pengadaan}</b></td>
                    <td>${escapeHtml(display(row.satuan))}</td>
                    <td>${formatRupiah(row.harga_satuan)}</td>
                    <td><b>${formatRupiah(row.total_harga)}</b></td>
                    <td style="max-width:160px; white-space:normal;">${escapeHtml(display(row.keterangan))}</td>
                    <td><span class="prioritas-pill ${prioritasPillClass(row.prioritas)}">${escapeHtml(row.prioritas)}</span></td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-row-action" onclick='openItemModal("${jenis}", ${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                            <svg style="width:14px;height:14px; color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button class="btn-row-action" onclick="openDeleteItemModal(${row.id}, '${escapeHtml(row.nama_barang)}')">
                            <svg style="width:14px;height:14px; color:#D0021B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // ══════ EDIT HEADER ══════
        function populateStatusSelect(selectedValue) {
            const select = document.getElementById('hfStatus');
            select.innerHTML = STATUS_OPTIONS.map(v => `<option value="${v}">${v}</option>`).join('');
            select.value = selectedValue || 'DRAFT';
        }

        function openHeaderEditModal() {
            const h = window.__rabHeaderCache || {};
            document.getElementById('headerEditSub').textContent = `Perbarui data header ${h.nomor_rab || ''}`;
            document.getElementById('hfNomorRab').value = h.nomor_rab || '';
            document.getElementById('hfNamaPerusahaan').value = h.nama_perusahaan || '';
            document.getElementById('hfDepartemen').value = h.departemen || '';
            document.getElementById('hfTahunAnggaran').value = h.tahun_anggaran || '';
            document.getElementById('hfTanggalPengajuan').value = h.tanggal_pengajuan || '';
            populateStatusSelect(h.status);
            document.getElementById('hfDibuatOleh').value = h.dibuat_oleh || '';
            document.getElementById('hfDisetujuiOleh').value = h.disetujui_oleh || '';
            document.getElementById('hfKeterangan').value = h.keterangan || '';

            document.getElementById('headerEditModalOverlay').classList.add('open');
        }

        function closeHeaderEditModal() {
            document.getElementById('headerEditModalOverlay').classList.remove('open');
        }

        function closeHeaderEditModalOutside(event) {
            if (event.target.id === 'headerEditModalOverlay') closeHeaderEditModal();
        }

        async function submitHeaderEdit() {
            const btn = document.getElementById('btnSubmitHeader');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const payload = {
                nama_perusahaan: document.getElementById('hfNamaPerusahaan').value.trim() || null,
                departemen: document.getElementById('hfDepartemen').value.trim() || null,
                tahun_anggaran: document.getElementById('hfTahunAnggaran').value,
                tanggal_pengajuan: document.getElementById('hfTanggalPengajuan').value || null,
                status: document.getElementById('hfStatus').value,
                dibuat_oleh: document.getElementById('hfDibuatOleh').value.trim() || null,
                disetujui_oleh: document.getElementById('hfDisetujuiOleh').value.trim() || null,
                keterangan: document.getElementById('hfKeterangan').value.trim() || null,
            };

            try {
                const res = await fetch(HEADER_UPDATE_ENDPOINT, {
                    method: 'PUT',
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
                    throw new Error(firstError || json.message || `Status ${res.status}`);
                }
                closeHeaderEditModal();
                await loadDetail();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan header.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ══════ MASTER OPTIONS (picker APD / Alkes) ══════
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
                /* diamkan, tetap bisa isi manual */ }
        }

        async function loadAlkesOptions() {
            if (alkesOptionsCache.length > 0) return;
            try {
                const res = await fetch(ALKES_OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                alkesOptionsCache = json.data || [];
            } catch (e) {
                /* diamkan, tetap bisa isi manual */ }
        }

        function populateItemMasterSelect() {
            const select = document.getElementById('fItemMasterId');
            select.innerHTML = '<option value="">— Pilih untuk autofill, atau isi manual di bawah —</option>';

            const list = currentItemJenis === 'APD' ? apdOptionsCache : alkesOptionsCache;
            list.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.id;
                opt.textContent = currentItemJenis === 'APD' ?
                    `${item.jenis_apd} (${item.kode_apd})` :
                    `${item.jenis_alat}${item.type ? ' — ' + item.type : ''}`;
                select.appendChild(opt);
            });
        }

        function onItemMasterSelectChange() {
            const id = document.getElementById('fItemMasterId').value;
            if (!id) return;

            const list = currentItemJenis === 'APD' ? apdOptionsCache : alkesOptionsCache;
            const item = list.find(i => String(i.id) === String(id));
            if (!item) return;

            if (currentItemJenis === 'APD') {
                document.getElementById('fItemNamaBarang').value = item.jenis_apd || '';
                document.getElementById('fItemKategori').value = item.kategori || 'WAJIB';
                document.getElementById('fItemMerkType').value = item.merk_rekomendasi || '';
                document.getElementById('fItemSpesifikasi').value = item.spesifikasi_teknis || '';
                document.getElementById('fItemUkuran').value = item.ukuran_tersedia || '';
                document.getElementById('fItemHargaSatuan').value = item.harga_satuan || 0;
            } else {
                document.getElementById('fItemNamaBarang').value = item.jenis_alat || '';
                document.getElementById('fItemKategori').value = item.kategori || 'ALKES';
                document.getElementById('fItemMerkType').value = [item.merk, item.type].filter(Boolean).join(' ');
                document.getElementById('fItemSpesifikasi').value = item.spesifikasi_teknis || '';
                document.getElementById('fItemHargaSatuan').value = item.harga_satuan || 0;
            }

            recalcItemTotal();
        }

        function populateKategoriSelect(jenis, selectedValue) {
            const select = document.getElementById('fItemKategori');
            const options = jenis === 'APD' ? KATEGORI_APD : KATEGORI_ALKES;
            select.innerHTML = options.map(v => `<option value="${v}">${v}</option>`).join('');
            select.value = selectedValue || options[0];
        }

        function populatePrioritasSelect(selectedValue) {
            const select = document.getElementById('fItemPrioritas');
            select.innerHTML = PRIORITAS_OPTIONS.map(v => `<option value="${v}">${v}</option>`).join('');
            select.value = selectedValue || 'SEDANG';
        }

        function recalcItemTotal() {
            const qty = parseFloat(document.getElementById('fItemQtyPengadaan').value) || 0;
            const harga = parseFloat(document.getElementById('fItemHargaSatuan').value) || 0;
            document.getElementById('fItemTotalHargaPreview').value = formatRupiah(qty * harga);
        }

        // ══════ MODAL TAMBAH / EDIT ITEM ══════
        async function openItemModal(jenis, row = null) {
            currentItemJenis = jenis;
            currentEditItemId = row ? row.id : null;

            if (jenis === 'APD') {
                await loadApdOptions();
                document.getElementById('itemPickerSectionTitle').textContent = 'Pilih dari Master Stok APD';
                document.getElementById('itemPickerLabel').textContent = 'Pilih Jenis APD (opsional)';
                document.getElementById('itemNamaBarangLabel').textContent = 'Jenis APD';
                document.getElementById('fItemNamaBarang').placeholder = 'Helm Safety';
                document.getElementById('fItemUkuran').closest('.form-group').style.display = '';
            } else {
                await loadAlkesOptions();
                document.getElementById('itemPickerSectionTitle').textContent = 'Pilih dari Master Alat Kesehatan';
                document.getElementById('itemPickerLabel').textContent = 'Pilih Jenis Alat Kesehatan (opsional)';
                document.getElementById('itemNamaBarangLabel').textContent = 'Jenis Alat Kesehatan';
                document.getElementById('fItemNamaBarang').placeholder = 'Glukometer Accu-Check';
            }
            populateItemMasterSelect();

            document.getElementById('itemModalTitle').textContent =
                (row ? 'Edit Item ' : 'Tambah Item ') + (jenis === 'APD' ? 'APD' : 'Alat Kesehatan');
            document.getElementById('itemModalSub').textContent = row ?
                `Perbarui data item "${row.nama_barang}"` :
                'Lengkapi data item di bawah ini.';

            document.getElementById('fItemKodeOk').value = row?.kode_ok || '';
            document.getElementById('fItemJabatanPosisi').value = row?.jabatan_posisi || '';
            document.getElementById('fItemMasterId').value = jenis === 'APD' ? (row?.stok_apd_id || '') : (row
                ?.stok_alkes_id || '');
            document.getElementById('fItemNamaBarang').value = row?.nama_barang || '';
            populateKategoriSelect(jenis, row?.kategori);
            document.getElementById('fItemMerkType').value = row?.merk_type || '';
            document.getElementById('fItemSpesifikasi').value = row?.spesifikasi || '';
            document.getElementById('fItemUkuran').value = row?.ukuran || '';
            document.getElementById('fItemQtyAda').value = row?.qty_ada ?? 0;
            document.getElementById('fItemQtyButuh').value = row?.qty_butuh ?? 0;
            document.getElementById('fItemQtyPengadaan').value = row?.qty_pengadaan ?? 0;
            document.getElementById('fItemSatuan').value = row?.satuan || '';
            document.getElementById('fItemHargaSatuan').value = row?.harga_satuan ?? 0;
            document.getElementById('fItemKeterangan').value = row?.keterangan || '';
            populatePrioritasSelect(row?.prioritas);
            recalcItemTotal();

            document.getElementById('itemModalOverlay').classList.add('open');
        }

        function closeItemModal() {
            document.getElementById('itemModalOverlay').classList.remove('open');
            currentEditItemId = null;
        }

        function closeItemModalOutside(event) {
            if (event.target.id === 'itemModalOverlay') closeItemModal();
        }

        async function submitItem() {
            const btn = document.getElementById('btnSubmitItem');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const masterId = document.getElementById('fItemMasterId').value || null;

            const payload = {
                jenis: currentItemJenis,
                stok_apd_id: currentItemJenis === 'APD' ? masterId : null,
                stok_alkes_id: currentItemJenis === 'ALKES' ? masterId : null,
                kode_ok: document.getElementById('fItemKodeOk').value.trim() || null,
                jabatan_posisi: document.getElementById('fItemJabatanPosisi').value.trim() || null,
                nama_barang: document.getElementById('fItemNamaBarang').value.trim(),
                kategori: document.getElementById('fItemKategori').value,
                merk_type: document.getElementById('fItemMerkType').value.trim() || null,
                spesifikasi: document.getElementById('fItemSpesifikasi').value.trim() || null,
                ukuran: document.getElementById('fItemUkuran').value.trim() || null,
                qty_ada: document.getElementById('fItemQtyAda').value || 0,
                qty_butuh: document.getElementById('fItemQtyButuh').value || 0,
                qty_pengadaan: document.getElementById('fItemQtyPengadaan').value || 0,
                satuan: document.getElementById('fItemSatuan').value.trim() || null,
                harga_satuan: document.getElementById('fItemHargaSatuan').value || 0,
                keterangan: document.getElementById('fItemKeterangan').value.trim() || null,
                prioritas: document.getElementById('fItemPrioritas').value,
            };

            const url = currentEditItemId ? `${ITEM_BASE_ENDPOINT}/${currentEditItemId}` : ITEM_STORE_ENDPOINT;
            const method = currentEditItemId ? 'PUT' : 'POST';

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
                    throw new Error(firstError || json.message || `Status ${res.status}`);
                }
                closeItemModal();
                await loadDetail();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan item.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ══════ HAPUS ITEM ══════
        function openDeleteItemModal(id, namaBarang) {
            currentDeleteItemId = id;
            document.getElementById('deleteItemModalDesc').textContent =
                `Item "${namaBarang}" akan dihapus permanen dari RAB ini. Lanjutkan?`;
            document.getElementById('deleteItemConfirmOverlay').classList.add('open');
        }

        function closeDeleteItemModal() {
            document.getElementById('deleteItemConfirmOverlay').classList.remove('open');
            currentDeleteItemId = null;
        }

        function closeDeleteItemModalOutside(event) {
            if (event.target.id === 'deleteItemConfirmOverlay') closeDeleteItemModal();
        }

        async function confirmDeleteItem() {
            if (!currentDeleteItemId) return;
            try {
                const res = await fetch(`${ITEM_BASE_ENDPOINT}/${currentDeleteItemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Status ${res.status}`);
                closeDeleteItemModal();
                await loadDetail();
                showToast(json.message, 'success');
            } catch (e) {
                closeDeleteItemModal();
                showToast(e.message || 'Gagal menghapus item.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', loadDetail);
    </script>
</body>

</html>
