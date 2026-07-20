<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Pemetaan APD — PT. Fokus Jasa Mitra</title>
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

        .apd-chip {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            margin: 0 3px 3px 0;
            white-space: nowrap;
        }

        .apd-chip-wajib {
            background: rgba(26, 122, 60, .09);
            color: #1A7A3C;
        }

        .apd-chip-khusus {
            background: rgba(217, 119, 6, .10);
            color: #D97706;
        }

        .apd-cell {
            max-width: 240px;
            white-space: normal;
        }

        .apd-label {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 3px;
        }

        .so-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
        }

        .so-self {
            background: rgba(45, 75, 158, .10);
            color: #2D4B9E;
        }

        .so-under {
            background: rgba(100, 116, 139, .09);
            color: #64748B;
        }

        .apd-matrix-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 12px;
        }

        .apd-matrix-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 6px 10px;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
            color: #334155;
        }

        .apd-status {
            font-size: 10px;
            font-weight: 800;
            padding: 1px 7px;
            border-radius: 5px;
        }

        .apd-status-WAJIB {
            background: rgba(26, 122, 60, .12);
            color: #1A7A3C;
        }

        .apd-status-KONDISIONAL {
            background: rgba(217, 119, 6, .12);
            color: #D97706;
        }

        .apd-status-TIDAK {
            background: rgba(148, 163, 184, .15);
            color: #94A3B8;
        }

        @media (max-width:640px) {
            .apd-matrix-grid {
                grid-template-columns: 1fr;
            }
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

        <div id="page-content">
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Master Tenaga Kerja · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">PEMETAAN <span>APD</span> TENAGA</div>
                        <div class="pg-sub">Pemetaan APD wajib &amp; khusus per tenaga kerja, status KIB, HIRADC, dan
                            Safety Officer pembina.</div>
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
                        <input type="text" id="searchInput" placeholder="Cari nama, ID karyawan, jabatan, kode OK..."
                            oninput="onSearchInput()" />
                    </div>
                    <select id="filterUnitKerja" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Unit Kerja</option>
                    </select>
                    <select id="filterStatusHiradc" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status HIRADC</option>
                    </select>
                    <select id="filterStatusSo" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua (SO &amp; Binaan)</option>
                        <option value="so">Safety Officer</option>
                        <option value="binaan">Tenaga Binaan</option>
                    </select>
                    <select id="filterStatusKib" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status KIB</option>
                    </select>
                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>
                <div class="data-summary" id="dataSummary">Memuat data pemetaan APD...</div>
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Tenaga Kerja</th>
                                <th>Unit / Area Kerja</th>
                                <th>Kode OK / Uraian Pekerjaan</th>
                                <th>Status KIB</th>
                                <th>APD Wajib &amp; Khusus</th>
                                <th>Safety Officer</th>
                                <th>Status HIRADC</th>
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

    <!-- ══════ MODAL DETAIL LOG APD ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar"><span id="dAvatar"></span></div>
                    <div>
                        <div class="modal-title" id="dNamaTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="dBadgeSub">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>
            <div class="detail-modal-body" id="detailBody">
                {{-- diisi via JS --}}
            </div>
            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>
    <!-- ══════ TOAST ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('pemetaan-apd.data') }}";
        const SHOW_ENDPOINT = "{{ url('/pemetaan-apd') }}";
        const state = {
            search: '',
            unit_kerja: '',
            status_hiradc: '',
            status_so: '',
            status_kib: '',
            page: 1,
            per_page: 10,
        };
        let searchDebounce = null;
        let filterOptionsLoaded = false;

        function escapeHtml(str) {
            const d = document.createElement('div');
            d.textContent = str ?? '';
            return d.innerHTML;
        }

        function display(v, f = '-') {
            return (v === null || v === undefined || v === '') ? f : v;
        }

        function initials(name) {
            if (!name || name === '-') return '—';
            const p = String(name).trim().split(/\s+/);
            return ((p[0]?.[0] || '') + (p[1]?.[0] || '')).toUpperCase();
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
            state.unit_kerja = document.getElementById('filterUnitKerja').value;
            state.status_hiradc = document.getElementById('filterStatusHiradc').value;
            state.status_so = document.getElementById('filterStatusSo').value;
            state.status_kib = document.getElementById('filterStatusKib').value;
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
            document.getElementById('filterUnitKerja').value = '';
            document.getElementById('filterStatusHiradc').value = '';
            document.getElementById('filterStatusSo').value = '';
            document.getElementById('filterStatusKib').value = '';
            Object.assign(state, {
                search: '',
                unit_kerja: '',
                status_hiradc: '',
                status_so: '',
                status_kib: '',
                page: 1
            });
            loadData();
        }

        function goToPage(p) {
            state.page = p;
            loadData();
            document.getElementById('page-content').scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function populateFilterOptions(opts) {
            if (filterOptionsLoaded || !opts) return;
            const unitSel = document.getElementById('filterUnitKerja');
            (opts.unit_kerja || []).forEach(u => {
                const o = document.createElement('option');
                o.value = u.value;
                o.textContent = u.label;
                unitSel.appendChild(o);
            });
            const hiradcSel = document.getElementById('filterStatusHiradc');
            (opts.status_hiradc || []).forEach(v => {
                const o = document.createElement('option');
                o.value = v;
                o.textContent = v;
                hiradcSel.appendChild(o);
            });
            const kibSel = document.getElementById('filterStatusKib');
            (opts.status_kib || []).forEach(v => {
                const o = document.createElement('option');
                o.value = v;
                o.textContent = v;
                kibSel.appendChild(o);
            });
            filterOptionsLoaded = true;
        }

        function kibPillClass(status, sisa) {
            if (status === 'TIDAK DITEMUKAN') return 'sp-gray';
            if (sisa !== null && sisa <= 0) return 'sp-red';
            if (sisa !== null && sisa <= 30) return 'sp-amber';
            return 'sp-green';
        }

        function apdChips(list, cls) {
            if (!list || list.length === 0) return '<span style="color:#CBD5E1;font-size:11px;">—</span>';
            return list.map(a => `<span class="apd-chip ${cls}">${escapeHtml(a)}</span>`).join('');
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML = `<tr><td colspan="8"><div class="empty-state">
                <div class="empty-state-title">Data tidak ditemukan</div>
                <div class="empty-state-sub">Coba ubah kata kunci pencarian atau filter.</div>
            </div></td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
            <tr>
                <td>
                    <div class="td-name-cell">
                        <div class="td-avatar">${initials(row.nama)}</div>
                        <div>
                            <div class="td-name-main">${escapeHtml(row.nama)}
                                ${row.is_safety_officer?'<span class="so-badge so-self" style="margin-left:4px;">SO</span>':''}
                            </div>
                            <div class="td-name-sub">${escapeHtml(row.id_karyawan)} · ${escapeHtml(row.jabatan)}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="td-name-main" style="font-size:11.5px;">${escapeHtml(row.unit_kerja)}</div>
                    <div class="td-name-sub">${escapeHtml(row.area_kerja)}</div>
                </td>
                <td style="max-width:200px;">
                    <div class="td-name-sub"><b>OK:</b> ${escapeHtml(row.kode_ok)}</div>
                    <div class="td-name-sub" style="white-space:normal;line-height:1.4;">${escapeHtml(row.uraian_pekerjaan)}</div>
                </td>
                <td>
                    <span class="status-pill ${kibPillClass(row.status_kib,row.sisa_kib)}">${escapeHtml(row.status_kib)}</span>
                    ${row.sisa_kib!==null?`<div class="td-name-sub" style="margin-top:3px;">Sisa: <b>${row.sisa_kib}</b> hari</div>`:''}
                </td>
                <td class="apd-cell">
                    <div class="apd-label">Wajib</div>
                    <div style="margin-bottom:6px;">${apdChips(row.apd_wajib,'apd-chip-wajib')}</div>
                    <div class="apd-label">Khusus</div>
                    <div>${apdChips(row.apd_khusus,'apd-chip-khusus')}</div>
                </td>
                <td>
                    ${row.is_safety_officer
                        ? '<span class="so-badge so-self">Safety Officer</span>'
                        : `<div class="td-name-sub" style="white-space:normal;line-height:1.4;">${escapeHtml(row.safety_officer)}</div>`}
                </td>
                <td>
                    <span class="status-pill ${row.status_hiradc==='Didukung HIRADC'?'sp-green':'sp-amber'}">
                        ${escapeHtml(row.status_hiradc)}
                    </span>
                </td>
                <td style="text-align:center;white-space:nowrap;">
                    <button class="btn-row-action" onclick="openDetailModal(${row.id})">
                        <svg style="width:14px;height:14px;color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Detail
                    </button>
                </td>
            </tr>
        `).join('');
        }

        function renderError(msg) {
            document.getElementById('tableBody').innerHTML = `<tr><td colspan="8">
            <div class="error-state">
                <div class="error-state-title">Gagal memuat data</div>
                <div class="error-state-sub">${escapeHtml(msg)}</div>
            </div></td></tr>`;
            document.getElementById('paginationText').textContent = '—';
            document.getElementById('paginationPages').innerHTML = '';
            document.getElementById('dataSummary').textContent = 'Gagal memuat data.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> tenaga kerja terpetakan`;
            const container = document.getElementById('paginationPages');
            const cur = meta.current_page,
                last = meta.last_page;
            let pages = [];
            const add = p => pages.push(p);
            add(1);
            if (cur > 3) pages.push('...');
            for (let p = Math.max(2, cur - 1); p <= Math.min(last - 1, cur + 1); p++) add(p);
            if (cur < last - 2) pages.push('...');
            if (last > 1) add(last);
            pages = [...new Set(pages)];
            let html = `<button class="page-btn" ${cur<=1?'disabled':''} onclick="goToPage(${cur-1})">‹</button>`;
            pages.forEach(p => {
                html += p === '...' ?
                    `<span class="page-ellipsis">…</span>` :
                    `<button class="page-btn ${p===cur?'active':''}" onclick="goToPage(${p})">${p}</button>`;
            });
            html += `<button class="page-btn" ${cur>=last?'disabled':''} onclick="goToPage(${cur+1})">›</button>`;
            container.innerHTML = html;
        }
        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.unit_kerja) params.set('unit_kerja', state.unit_kerja);
            if (state.status_hiradc) params.set('status_hiradc', state.status_hiradc);
            if (state.status_so) params.set('status_so', state.status_so);
            if (state.status_kib) params.set('status_kib', state.status_kib);
            params.set('page', state.page);
            params.set('per_page', state.per_page);
            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) {
                    const err = await res.json().catch(() => null);
                    throw new Error(err?.message || `Server merespons status ${res.status}`);
                }
                const json = await res.json();
                renderTable(json.data);
                renderPagination(json.meta);
                populateFilterOptions(json.filter_options);
            } catch (e) {
                renderError(e.message || 'Terjadi kesalahan tak terduga.');
            }
        }
        // ══════ DETAIL ══════
        async function openDetailModal(id) {
            const body = document.getElementById('detailBody');
            body.innerHTML = '<div class="skeleton-bar" style="height:120px;"></div>';
            document.getElementById('detailModalOverlay').classList.add('open');
            try {
                const res = await fetch(`${SHOW_ENDPOINT}/${id}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                const d = json.data;
                document.getElementById('dAvatar').textContent = initials(d.nama);
                document.getElementById('dNamaTitle').textContent = d.nama;
                document.getElementById('dBadgeSub').textContent = `${d.id_karyawan} · ${d.jabatan}`;
                const matrixHtml = (d.apd_breakdown && d.apd_breakdown.length) ?
                    d.apd_breakdown.map(a => `
                    <div class="apd-matrix-item">
                        <span>${escapeHtml(a.nama)}</span>
                        <span class="apd-status apd-status-${a.status}">${a.status==='WAJIB'?'✅ Wajib':a.status==='KONDISIONAL'?'○ Kondisional':'– Tidak'}</span>
                    </div>`).join('') :
                    '<div style="color:#94A3B8;font-size:12px;padding:8px;">Belum ada matriks APD untuk kode OK ini.</div>';
                const hiradcHtml = (d.hiradc_list && d.hiradc_list.length) ?
                    d.hiradc_list.map(h => `
                    <div class="apd-matrix-item" style="flex-direction:column;align-items:flex-start;gap:2px;">
                        <span><b>${escapeHtml(h.aktivitas_pekerjaan)}</b></span>
                        <span style="font-size:10.5px;color:#64748B;">${escapeHtml(h.potensi_bahaya)} · ${escapeHtml(h.jenis_bahaya)} · ${escapeHtml(h.status)}</span>
                    </div>`).join('') :
                    '<div style="color:#94A3B8;font-size:12px;padding:8px;">Belum ada HIRADC terkait kode OK ini.</div>';
                body.innerHTML = `
                <div class="detail-section">
                    <div class="detail-section-title" style="margin-top:0;">Data Tenaga Kerja</div>
                    <div class="detail-form-grid">
                        <div class="detail-field"><label>Departemen</label><input type="text" value="${escapeHtml(d.departemen)}" readonly></div>
                        <div class="detail-field"><label>Unit Kerja</label><input type="text" value="${escapeHtml(d.unit_kerja)}" readonly></div>
                        <div class="detail-field span-2"><label>Area Kerja</label><input type="text" value="${escapeHtml(d.area_kerja)}" readonly></div>
                        <div class="detail-field"><label>Kode OK</label><input type="text" value="${escapeHtml(d.kode_ok)}" readonly></div>
                        <div class="detail-field"><label>Nomor OK</label><input type="text" value="${escapeHtml(d.nomor_ok)}" readonly></div>
                        <div class="detail-field span-2"><label>Uraian Pekerjaan</label><input type="text" value="${escapeHtml(d.uraian_pekerjaan)}" readonly></div>
                    </div>
                </div>
                <div class="detail-section">
                    <div class="detail-section-title">Status KIB &amp; Safety Officer</div>
                    <div class="detail-form-grid">
                        <div class="detail-field"><label>Nomor KIB</label><input type="text" value="${escapeHtml(d.nomor_kib)}" readonly></div>
                        <div class="detail-field"><label>Status KIB</label><input type="text" value="${escapeHtml(d.status_kib)}" readonly></div>
                        <div class="detail-field span-2"><label>Status Safety Officer</label><input type="text" value="${d.is_safety_officer?'Tenaga ini adalah Safety Officer':'Tenaga binaan'}" readonly></div>
                    </div>
                </div>
                <div class="detail-section">
                    <div class="detail-section-title">Matriks APD (17 Jenis)</div>
                    <div class="apd-matrix-grid">${matrixHtml}</div>
                </div>
                <div class="detail-section">
                    <div class="detail-section-title">HIRADC Terkait — ${escapeHtml(d.status_hiradc)}</div>
                    <div style="display:flex;flex-direction:column;gap:6px;">${hiradcHtml}</div>
                </div>
            `;
            } catch (e) {
                body.innerHTML =
                    `<div class="error-state"><div class="error-state-title">Gagal memuat detail</div></div>`;
            }
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(e) {
            if (e.target.id === 'detailModalOverlay') closeDetailModal();
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }
        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
