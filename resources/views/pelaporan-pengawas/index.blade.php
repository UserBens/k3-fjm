<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Pelaporan Pengawas K3 — PT. Fokus Jasa Mitra</title>
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

        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 980px;
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

        .link-line {
            display: block;
            font-size: 11px;
            color: #2D4B9E;
            font-weight: 700;
            text-decoration: none;
            margin-bottom: 3px;
        }

        .link-line:hover {
            text-decoration: underline;
        }

        .link-line.empty {
            color: #CBD5E1;
            font-weight: 500;
            text-decoration: none;
        }

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
            margin-bottom: 4px;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-row-action:hover {
            background: #F8F9FF;
        }

        .btn-row-action.approve {
            color: #1A7A3C;
            border-color: rgba(26, 122, 60, 0.25);
            background: rgba(26, 122, 60, 0.06);
        }

        .btn-row-action.reject {
            color: #D0021B;
            border-color: rgba(208, 2, 27, 0.25);
            background: rgba(208, 2, 27, 0.06);
        }

        .form-modal-box {
            width: 640px;
            max-width: calc(100vw - 32px);
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .form-modal-header {
            /* margin-bottom: 14px; */
        }

        .form-modal-body {
            flex: 1;
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
            margin-top: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 14px;
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

        .detail-modal-box {
            max-width: 680px;
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
            max-height: 68vh;
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

        .detail-field.span-4 {
            grid-column: span 4;
        }

        .detail-field label {
            font-size: 11px;
            font-weight: 600;
            color: #94A3B8;
        }

        .detail-field .detail-value {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 500;
            color: #1E293B;
            min-height: 36px;
            white-space: pre-line;
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

        .detail-field a.detail-link {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 600;
            color: #2D4B9E;
            text-decoration: none;
            display: block;
        }

        .detail-field a.detail-link:hover {
            text-decoration: underline;
        }

        .detail-empty-note {
            font-size: 12px;
            color: #94A3B8;
            padding: 8px 0;
        }

        @media (max-width: 640px) {
            .detail-form-grid {
                grid-template-columns: 1fr;
            }

            .detail-field.span-2 {
                grid-column: span 1;
            }
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

        .file-current-link {
            display: inline-block;
            margin-top: 6px;
            font-size: 11px;
            font-weight: 700;
            color: #2D4B9E;
            text-decoration: none;
        }

        .file-current-link:hover {
            text-decoration: underline;
        }

        .category-block {
            display: none;
        }

        .category-block.visible {
            display: block;
        }

        .category-select-wrap {
            margin-bottom: 14px;
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
                        <div class="pg-title">MONITORING PELAPORAN <span>PENGAWAS</span></div>
                        <div class="pg-sub">Kelola laporan Safety Briefing &amp; Nearmiss dari Pengawas lapangan.</div>
                    </div>
                    <div class="pg-actions">
                        <button type="button" class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Laporan Baru
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
                            placeholder="Cari Nama Pengawas, Badge, atau ID Laporan..." oninput="onSearchInput()" />
                    </div>

                    <select id="filterUnitKerja" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Unit Kerja</option>
                    </select>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="PENDING">PENDING</option> <!-- TAMBAHKAN INI -->
                        <option value="APPROVE">APPROVE</option>
                        <option value="REJECT">REJECT</option>
                        <option value="CANCEL">CANCEL</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data pelaporan pengawas...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Pengawas</th>
                                <th class="px-6 py-3 text-left">Area &amp; Unit Kerja</th>
                                <th class="px-6 py-3 text-left">Jenis Aktifitas KPI</th>
                                <th class="px-6 py-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-center">Status</th>
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

    <!-- ══════ MODAL TAMBAH / EDIT PELAPORAN PENGAWAS ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" style="width:820px; max-width:96%;" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Laporan Baru Pengawas</div>
                <div class="detail-subtitle mb-4" id="formModalSub">Lengkapi formulir laporan Safety Briefing /
                    Nearmiss di bawah ini.</div>
            </div>

            <form id="formPelaporanPengawas" onsubmit="return submitForm(event)"
                style="display: flex; flex-direction: column; flex: 1; min-height: 0;">
                <div class="form-modal-body">

                    <!-- Data Umum -->
                    <div class="form-section-title">Data Umum</div>

                    <div class="category-select-wrap">
                        <label class="form-label">Jenis Aktifitas KPI</label>
                        <div class="picker-wrap">
                            <input type="text" id="jenisAktivitasInput" class="form-input" style="width:100%;"
                                placeholder="Cari jenis aktifitas (nama atau kode)..."
                                oninput="onJenisAktivitasInput()" onfocus="onJenisAktivitasFocus()"
                                autocomplete="off" required>
                            <div class="picker-dropdown" id="jenisAktivitasDropdown"></div>
                        </div>
                        <input type="hidden" name="aktivitas_kpi_k3_id" id="fAktivitasId">
                    </div>

                    <div class="picker-wrap" style="margin-bottom:10px;">
                        <label class="form-label">Nama Pengawas</label>
                        <input type="text" id="pengawasPickerInput" class="form-input"
                            placeholder="Cari nama atau nomor badge pengawas..." oninput="onPengawasPickerInput()"
                            autocomplete="off" required />
                        <div class="picker-dropdown" id="pengawasPickerDropdown"></div>
                        <input type="hidden" name="badge_pengawas" id="fBadgePengawas">
                        <input type="hidden" name="nama_pengawas" id="fNamaPengawas">
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Unit Kerja</label>
                            <div class="picker-wrap">
                                <input type="text" id="unitKerjaInput" class="form-input"
                                    placeholder="Cari Unit Kerja..." oninput="onPickerInput('unitKerja')"
                                    onfocus="onPickerFocus('unitKerja')" autocomplete="off" required>
                                <div class="picker-dropdown" id="unitKerjaDropdown"></div>
                            </div>
                            <input type="hidden" name="unit_kerja" id="fUnitKerja">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Area Kerja</label>
                            <div class="picker-wrap">
                                <input type="text" id="areaKerjaInput" class="form-input"
                                    placeholder="Cari Area Kerja..." oninput="onPickerInput('areaKerja')"
                                    onfocus="onPickerFocus('areaKerja')" autocomplete="off" required>
                                <div class="picker-dropdown" id="areaKerjaDropdown"></div>
                            </div>
                            <input type="hidden" name="area_kerja" id="fAreaKerja">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal_pelaksanaan" id="fTanggalPelaksanaan"
                                class="form-input" required>
                        </div>
                    </div>

                    <!-- ══════ KATEGORI: NEARMISS ══════ -->
                    <div class="category-block" data-cat="NEARMISS">
                        <div class="form-section-title">Laporan Nearmiss</div>
                        <div class="form-grid">
                            <div class="form-group span-2">
                                <label class="form-label">Keterangan Bahaya</label>
                                <textarea name="keterangan_bahaya" id="fKeteranganBahaya" class="form-textarea" rows="2"
                                    placeholder="Jelaskan temuan bahaya / potensi kecelakaan yang ditemukan..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Foto Temuan Bahaya</label>
                                <input type="file" name="foto_temuan_bahaya" id="f_foto_temuan_bahaya"
                                    class="form-input" accept="image/png, image/jpeg, image/jpg, image/webp">
                            </div>
                        </div>
                    </div>

                    <!-- ══════ KATEGORI: SAFETY BRIEFING ══════ -->
                    <div class="category-block" data-cat="BRIEFING">
                        <div class="form-section-title">Safety Briefing</div>
                        <div class="form-grid">
                            <div class="form-group span-2">
                                <label class="form-label">Materi Safety Briefing</label>
                                <textarea name="materi_safety_briefing" id="fMateriBriefing" class="form-textarea" rows="2"
                                    placeholder="Ringkasan materi yang disampaikan saat briefing..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Foto Kegiatan</label>
                                <input type="file" name="foto_kegiatan_safety_briefing"
                                    id="f_foto_kegiatan_safety_briefing" class="form-input"
                                    accept="image/png, image/jpeg, image/jpg, image/webp">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Formulir Presensi (PDF)</label>
                                <input type="file" name="formulir_presensi_pdf" id="f_formulir_presensi_pdf"
                                    class="form-input" accept="application/pdf">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-actions" style="margin-top:16px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                    <button type="submit" class="btn-modal-confirm" id="btnSubmitForm">Simpan Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL PELAPORAN PENGAWAS ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header" style="display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar" id="detailAvatar"
                        style="width:42px;height:42px;border-radius:10px;background:linear-gradient(135deg,#2D4B9E,#1A1D2E);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;">
                        --</div>
                    <div>
                        <div class="modal-title" id="detailNamaTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailIdLaporanSub"
                            style="font-size:12.5px;color:#94A3B8;font-weight:500;">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-section-title">Data Umum</div>
                    <div class="form-grid" id="detailUmumGrid"></div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title" id="detailKategoriTitle">Detail Aktifitas</div>
                    <div class="form-grid" id="detailKategoriGrid"></div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Status</div>
                    <div class="form-grid" id="detailArsipGrid"></div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
                <button type="button" id="btnEditModal" class="btn-modal-confirm" onclick="editFromDetail()">Edit
                    Data
                    Ini</button>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST CONTAINER ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- JS LOGIC -->
    <script>
        // ══════ CONFIG ══════
        const DATA_ENDPOINT = "{{ route('pelaporan-pengawas.data') }}";
        const STORE_ENDPOINT = "{{ route('pelaporan-pengawas.store') }}";
        const BASE_ENDPOINT = "{{ url('/pelaporan-pengawas') }}";
        const LOKASI_KERJA_OPTIONS_ENDPOINT = "{{ route('pelaporan-pengawas.lokasi-kerja-options') }}";
        const UNIT_KERJA_OPTIONS_ENDPOINT = "{{ route('pelaporan-pengawas.unit-kerja-options') }}";
        const JENIS_AKTIVITAS_OPTIONS_ENDPOINT = "{{ route('pelaporan-pengawas.jenis-aktivitas-options') }}";
        const CARI_PENGAWAS_ENDPOINT = "{{ route('pelaporan-pengawas.cari-pengawas') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const FILE_FIELDS = ['foto_temuan_bahaya', 'foto_kegiatan_safety_briefing', 'formulir_presensi_pdf'];

        const state = {
            search: '',
            unit_kerja: '',
            status: '',
            page: 1,
            per_page: 10
        };

        let searchDebounce = null;
        let filterOptionsLoaded = false;
        let lokasiKerjaOptionsCache = [];
        let unitKerjaOptionsCache = [];
        let jenisAktivitasOptionsCache = []; // { id, kode, nama_aktivitas, label, kategori }
        let selectedAktivitas = null; // objek aktivitas yang sedang dipilih di form
        let currentEditId = null;
        let currentDetailRow = null;

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

        function statusPillClass(status) {
            if (status === 'APPROVE') return 'sp-green';
            if (status === 'REJECT') return 'sp-red';
            if (status === 'PENDING') return 'sp-amber'; // Status PENDING
            return 'sp-gray';
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

        // ══════ MASTER DATA: Lokasi Kerja / Unit Kerja ══════
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
                /* diamkan */
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
                /* diamkan */
            }
        }

        // ══════ GENERIC SEARCHABLE PICKER (Area Kerja, Unit Kerja) ══════
        const PICKER_CONFIG = {
            areaKerja: {
                inputId: 'areaKerjaInput',
                dropdownId: 'areaKerjaDropdown',
                hiddenId: 'fAreaKerja',
                getData: () => lokasiKerjaOptionsCache
            },
            unitKerja: {
                inputId: 'unitKerjaInput',
                dropdownId: 'unitKerjaDropdown',
                hiddenId: 'fUnitKerja',
                getData: () => unitKerjaOptionsCache
            },
        };

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
            const cfg = PICKER_CONFIG[key];
            document.getElementById(cfg.hiddenId).value = '';
            renderPickerDropdown(key, document.getElementById(cfg.inputId).value.trim());
        }

        function onPickerFocus(key) {
            const cfg = PICKER_CONFIG[key];
            renderPickerDropdown(key, document.getElementById(cfg.inputId).value.trim());
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

        // ══════ PICKER "JENIS AKTIFITAS KPI" — dari master aktivitas_kpi_k3 ══════
        async function loadJenisAktivitasOptions(search = '') {
            try {
                const url = search ?
                    `${JENIS_AKTIVITAS_OPTIONS_ENDPOINT}?search=${encodeURIComponent(search)}` :
                    JENIS_AKTIVITAS_OPTIONS_ENDPOINT;
                const res = await fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                jenisAktivitasOptionsCache = json.data || [];
            } catch (e) {
                jenisAktivitasOptionsCache = [];
            }
        }

        function renderJenisAktivitasDropdown() {
            const dropdown = document.getElementById('jenisAktivitasDropdown');
            if (jenisAktivitasOptionsCache.length === 0) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#94A3B8;">Tidak ada aktifitas ditemukan.</div>`;
            } else {
                dropdown.innerHTML = jenisAktivitasOptionsCache.map(a => `
                    <div class="picker-item" onclick='pilihJenisAktivitas(${JSON.stringify(a).replace(/'/g, "&#39;")})'>
                        <div class="picker-item-name">${escapeHtml(a.label)}</div>
                    </div>
                `).join('');
            }
            dropdown.classList.add('open');
        }

        let jenisAktivitasDebounce = null;

        function onJenisAktivitasInput() {
            document.getElementById('fAktivitasId').value = '';
            clearTimeout(jenisAktivitasDebounce);
            const keyword = document.getElementById('jenisAktivitasInput').value.trim();
            jenisAktivitasDebounce = setTimeout(async () => {
                await loadJenisAktivitasOptions(keyword);
                renderJenisAktivitasDropdown();
            }, 300);
        }

        async function onJenisAktivitasFocus() {
            if (jenisAktivitasOptionsCache.length === 0) await loadJenisAktivitasOptions();
            renderJenisAktivitasDropdown();
        }

        function pilihJenisAktivitas(aktivitas) {
            selectedAktivitas = aktivitas;
            document.getElementById('jenisAktivitasInput').value = aktivitas.label;
            document.getElementById('fAktivitasId').value = aktivitas.id;
            document.getElementById('jenisAktivitasDropdown').classList.remove('open');
            toggleCategoryBlocks(aktivitas.kategori);
        }

        // Kedua section (Nearmiss & Safety Briefing) selalu tampil sekaligus di form —
        // fungsi ini hanya mengatur atribut "required" mengikuti jenis aktifitas yang dipilih.
        function toggleCategoryBlocks(kategori) {
            document.querySelectorAll('.category-block').forEach(el => {
                const active = el.dataset.cat === kategori;
                el.classList.toggle('visible', active);
                el.querySelectorAll('[required]').forEach(f => f.removeAttribute('data-was-required'));
            });

            const showNearmiss = kategori === 'NEARMISS';
            const showBriefing = kategori === 'BRIEFING';

            document.getElementById('fKeteranganBahaya').toggleAttribute('required', showNearmiss);
            document.getElementById('fMateriBriefing').toggleAttribute('required', showBriefing);

            const filesRequired = !currentEditId;
            document.getElementById('f_foto_temuan_bahaya').toggleAttribute('required', showNearmiss && filesRequired);
            document.getElementById('f_foto_kegiatan_safety_briefing').toggleAttribute('required', showBriefing &&
                filesRequired);
            document.getElementById('f_formulir_presensi_pdf').toggleAttribute('required', showBriefing && filesRequired);
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('jenisAktivitasInput')?.closest('.picker-wrap');
            if (wrap && !wrap.contains(e.target)) document.getElementById('jenisAktivitasDropdown')?.classList
                .remove('open');
        });

        // ══════ PREVIEW FILE UPLOAD ══════
        function formatFileSize(bytes) {
            if (!bytes && bytes !== 0) return '';
            const units = ['B', 'KB', 'MB', 'GB'];
            let i = 0,
                size = bytes;
            while (size >= 1024 && i < units.length - 1) {
                size /= 1024;
                i++;
            }
            return `${size.toFixed(size >= 10 || i === 0 ? 0 : 1)} ${units[i]}`;
        }

        function getFileNameFromUrl(url) {
            try {
                return decodeURIComponent(url.split('/').pop().split('?')[0]);
            } catch (e) {
                return 'dokumen';
            }
        }

        function isImageUrl(url) {
            return /\.(jpe?g|png|gif|webp|bmp|svg)$/i.test(url || '');
        }

        function fieldNameFromInput(input) {
            return input.id.replace(/^f_/, '');
        }

        function ensureFilePreviewBox(input) {
            const fieldName = fieldNameFromInput(input);
            let box = document.getElementById('filepreview_' + fieldName);
            if (box) return box;
            box = document.createElement('div');
            box.id = 'filepreview_' + fieldName;
            box.style.cssText = 'display:none; margin-top:8px;';
            input.insertAdjacentElement('afterend', box);
            return box;
        }

        function renderImagePreview(box, src, caption) {
            box.innerHTML = `
        <div style="display:flex; align-items:center; gap:10px;">
            <img src="${src}" alt="Preview" style="width:64px; height:64px; border-radius:8px; border:1px solid #e2e8f0; object-fit:cover; flex-shrink:0;">
            <div style="min-width:0;">
                <div style="font-size:11.5px; font-weight:600; color:#334155; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:220px;">${escapeHtml(caption)}</div>
                <a href="${src}" target="_blank" rel="noopener" style="font-size:11px; color:#2D4B9E; text-decoration:none;">Lihat ukuran penuh ↗</a>
            </div>
        </div>`;
            box.style.display = 'block';
        }

        function renderDocPreview(box, href, caption, isNew) {
            box.innerHTML = `
        <div style="display:flex; align-items:center; gap:8px; padding:6px 10px; background:#F8FAFC; border:1px solid #e2e8f0; border-radius:8px;">
            <span style="font-size:16px;">📄</span>
            <div style="min-width:0; flex:1;">
                <div style="font-size:11.5px; font-weight:600; color:#334155; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${escapeHtml(caption)}</div>
                <div style="font-size:10.5px; color:#94A3B8;">${isNew ? 'Siap diupload' : 'Dokumen tersimpan'}</div>
            </div>
            ${href ? `<a href="${href}" target="_blank" rel="noopener" style="font-size:11px; color:#2D4B9E; text-decoration:none; flex-shrink:0;">Buka ↗</a>` : ''}
        </div>`;
            box.style.display = 'block';
        }

        function clearFilePreview(box) {
            if (!box) return;
            box.style.display = 'none';
            box.innerHTML = '';
        }

        function restoreExistingPreview(input, box) {
            const url = input.dataset.existingUrl;
            if (!url) {
                clearFilePreview(box);
                return;
            }
            if (isImageUrl(url)) renderImagePreview(box, url, getFileNameFromUrl(url));
            else renderDocPreview(box, url, getFileNameFromUrl(url), false);
        }

        function onFileInputChange(e) {
            const input = e.target;
            const box = ensureFilePreviewBox(input);
            const file = input.files && input.files[0];
            if (!file) {
                restoreExistingPreview(input, box);
                return;
            }
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (ev) => renderImagePreview(box, ev.target.result,
                    `${file.name} (${formatFileSize(file.size)})`);
                reader.readAsDataURL(file);
            } else {
                renderDocPreview(box, null, `${file.name} (${formatFileSize(file.size)})`, true);
            }
        }

        function setupFilePreviewListeners() {
            document.querySelectorAll('.form-modal-body input[type="file"]').forEach(input => {
                ensureFilePreviewBox(input);
                if (input.dataset.previewBound) return;
                input.dataset.previewBound = '1';
                input.addEventListener('change', onFileInputChange);
            });
        }

        function resetFilePreviews() {
            document.querySelectorAll('.form-modal-body input[type="file"]').forEach(input => {
                delete input.dataset.existingUrl;
                clearFilePreview(document.getElementById('filepreview_' + fieldNameFromInput(input)));
            });
        }

        // Field URL pengawas bersuffix "_url" (bukan "_path_url" seperti Data Safety)
        function setExistingFilePreviews(row) {
            document.querySelectorAll('.form-modal-body input[type="file"]').forEach(input => {
                const fieldName = fieldNameFromInput(input);
                const url = row ? row[fieldName + '_url'] : null;
                const box = document.getElementById('filepreview_' + fieldName);
                if (url) {
                    input.dataset.existingUrl = url;
                    if (isImageUrl(url)) renderImagePreview(box, url, getFileNameFromUrl(url));
                    else renderDocPreview(box, url, getFileNameFromUrl(url), false);
                } else {
                    delete input.dataset.existingUrl;
                    clearFilePreview(box);
                }
            });
        }

        // ══════ PICKER PENGAWAS — Badge / Nama ══════
        let pengawasPickerDebounce = null;

        function onPengawasPickerInput() {
            clearTimeout(pengawasPickerDebounce);
            pengawasPickerDebounce = setTimeout(searchPengawasPicker, 350);
        }

        async function searchPengawasPicker() {
            const search = document.getElementById('pengawasPickerInput').value.trim();
            const dropdown = document.getElementById('pengawasPickerDropdown');
            if (search.length < 2) {
                dropdown.classList.remove('open');
                return;
            }
            try {
                const res = await fetch(`${CARI_PENGAWAS_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                dropdown.innerHTML = (!json.data || json.data.length === 0) ?
                    `<div class="picker-item" style="color:#94A3B8;">Tidak ada pengawas ditemukan.</div>` :
                    json.data.map(p => `
                        <div class="picker-item" onclick='pilihPengawas(${JSON.stringify(p).replace(/'/g, "&#39;")})'>
                            <div class="picker-item-name">${escapeHtml(p.nama)}</div>
                            <div class="picker-item-sub">${escapeHtml(p.badge)} · ${escapeHtml(p.unit_kerja)}</div>
                        </div>`).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihPengawas(p) {
            document.getElementById('fBadgePengawas').value = p.badge;
            document.getElementById('fNamaPengawas').value = p.nama;
            document.getElementById('pengawasPickerInput').value = `${p.nama} (${p.badge})`;
            document.getElementById('pengawasPickerDropdown').classList.remove('open');
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('pengawasPickerInput')?.closest('.picker-wrap');
            if (wrap && !wrap.contains(e.target)) document.getElementById('pengawasPickerDropdown')?.classList
                .remove('open');
        });

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
            state.unit_kerja = document.getElementById('filterUnitKerja').value;
            state.status = document.getElementById('filterStatus').value;
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
            document.getElementById('filterStatus').value = '';
            state.search = '';
            state.unit_kerja = '';
            state.status = '';
            state.page = 1;
            loadData();
        }

        function goToPage(page) {
            state.page = page;
            loadData();
        }

        function populateFilterOptions(options) {
            if (filterOptionsLoaded || !options) return;
            const select = document.getElementById('filterUnitKerja');
            (options.unit_kerja || []).forEach(val => {
                const opt = document.createElement('option');
                opt.value = val;
                opt.textContent = val;
                select.appendChild(opt);
            });
            filterOptionsLoaded = true;
        }

        // ══════ TABEL ══════
        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="6" style="text-align:center; padding: 20px; color:#64748b;">Data tidak ditemukan</td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-main">${escapeHtml(row.nama_pengawas)}</div>
                        <div class="td-name-sub">Badge: ${escapeHtml(row.badge_pengawas || '-')}</div>
                    </td>
                    <td>
                        <div style="font-weight:600; color:#0f172a; font-size:13px;">${escapeHtml(row.area_kerja)}</div>
                        <div class="td-name-sub" style="color:#0284c7; font-weight:500;">${escapeHtml(row.unit_kerja)}</div>
                    </td>
                    <td>
                        <span class="status-pill sp-blue">${escapeHtml(row.aktivitas_label || '-')}</span>
                    </td>
                    <td>${formatDate(row.tanggal_pelaksanaan)}</td>
                    <td style="text-align:center;">
                        <span class="status-pill ${statusPillClass(row.status)}">${escapeHtml(row.status)}</span>
                    </td>
                    <td style="text-align:center; display:flex; justify-content:center; gap:8px;">
                        <button class="btn-detail-tenaga" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'
                                style="background:transparent; border:1px solid #e2e8f0; padding:6px 10px; border-radius:6px; cursor:pointer; color:#475569; font-size:12px; font-weight:600;">
                            Detail
                        </button>
                        <button onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'
                            style="background-color:#f59e0b; color:white; padding:6px 10px; border-radius:6px; cursor:pointer; border:none; font-size:12px; font-weight:600;">
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
            if (state.unit_kerja) params.set('unit_kerja', state.unit_kerja);
            if (state.status) params.set('status', state.status);
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
                    `<tr><td colspan="6" style="text-align:center;color:red;">Error memuat data</td></tr>`;
            }
        }

        // ══════ MODAL TAMBAH / EDIT ══════
        function setCurrentFileLinks(row) {
            const map = {
                foto_temuan_bahaya: 'current_foto_temuan_bahaya',
                foto_kegiatan_safety_briefing: 'current_foto_kegiatan_safety_briefing',
                formulir_presensi_pdf: 'current_formulir_presensi_pdf',
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

            // Tampilkan foto yang sudah ada sebagai preview awal saat edit,
            // supaya user tidak perlu upload ulang untuk sekadar melihat foto lama.
            const imagePreviewMap = {
                foto_temuan_bahaya: 'preview_foto_temuan_bahaya',
                foto_kegiatan_safety_briefing: 'preview_foto_kegiatan_safety_briefing',
            };
            Object.entries(imagePreviewMap).forEach(([field, previewId]) => {
                const box = document.getElementById(previewId);
                const url = row ? row[`${field}_url`] : null;
                if (url) {
                    box.querySelector('img').src = url;
                    box.style.display = 'block';
                }
            });

            if (row?.formulir_presensi_pdf_url) {
                const pdfBox = document.getElementById('preview_formulir_presensi_pdf');
                pdfBox.innerHTML =
                    `<span style="font-size:12px; color:#334155;">📄 File presensi sudah ada (upload baru untuk mengganti)</span>`;
                pdfBox.style.display = 'block';
            }
        }

        async function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            selectedAktivitas = null;

            await Promise.all([loadLokasiKerjaOptions(), loadUnitKerjaOptions()]);

            const form = document.getElementById('formPelaporanPengawas');
            form.reset();

            document.getElementById('formModalTitle').textContent = row ? 'Edit Laporan Pengawas' :
                'Laporan Baru Pengawas';
            document.getElementById('formModalSub').textContent = row ?
                `Perbarui laporan ${row.nama_pengawas} — ${row.id_laporan}` :
                'Lengkapi formulir laporan Safety Briefing / Nearmiss di bawah ini.';

            document.getElementById('fTanggalPelaksanaan').value = row?.tanggal_pelaksanaan || '';

            document.getElementById('fBadgePengawas').value = row?.badge_pengawas || '';
            document.getElementById('fNamaPengawas').value = row?.nama_pengawas || '';
            document.getElementById('pengawasPickerInput').value =
                (row?.nama_pengawas && row?.badge_pengawas) ? `${row.nama_pengawas} (${row.badge_pengawas})` : (row
                    ?.nama_pengawas || '');

            document.getElementById('areaKerjaInput').value = row?.area_kerja || '';
            document.getElementById('fAreaKerja').value = row?.area_kerja || '';

            document.getElementById('unitKerjaInput').value = row?.unit_kerja || '';
            document.getElementById('fUnitKerja').value = row?.unit_kerja || '';

            document.getElementById('jenisAktivitasInput').value = row?.aktivitas_label || '';
            document.getElementById('fAktivitasId').value = row?.aktivitas_kpi_k3_id || '';

            document.getElementById('fKeteranganBahaya').value = row?.keterangan_bahaya || '';
            document.getElementById('fMateriBriefing').value = row?.materi_safety_briefing || '';

            let kategoriAwal = null;
            if (row?.aktivitas_nama) {
                const lower = row.aktivitas_nama.toLowerCase();
                kategoriAwal = lower.includes('nearmiss') ? 'NEARMISS' : (lower.includes('safety briefing') ?
                    'BRIEFING' : null);
            }
            toggleCategoryBlocks(kategoriAwal);

            setExistingFilePreviews(row);
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

            if (!document.getElementById('fNamaPengawas').value) {
                showToast('Silakan pilih Nama Pengawas terlebih dahulu.', 'error');
                return false;
            }
            if (!document.getElementById('fAktivitasId').value) {
                showToast('Silakan pilih Jenis Aktifitas KPI terlebih dahulu.', 'error');
                return false;
            }

            const btn = document.getElementById('btnSubmitForm');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const form = document.getElementById('formPelaporanPengawas');
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
        function initials(name) {
            if (!name || name === '-') return '—';
            const p = name.trim().split(/\s+/);
            return ((p[0]?.[0] || '') + (p[1]?.[0] || '')).toUpperCase();
        }

        function buildDetailField(label, value, span = null) {
            const spanClass = span ? ` span-${span}` : '';
            return `<div class="detail-field${spanClass}"><label>${label}</label><div class="detail-value">${escapeHtml(value && value !== '' ? value : '-')}</div></div>`;
        }

        function buildDetailFileField(label, url, span = null) {
            const spanClass = span ? ` span-${span}` : '';
            const inner = url ?
                `<a class="detail-link" href="${escapeHtml(url)}" target="_blank" rel="noopener">Buka Dokumen ↗</a>` :
                `<div class="detail-value" style="color:#CBD5E1;">Belum ada dokumen</div>`;
            return `<div class="detail-field${spanClass}"><label>${label}</label>${inner}</div>`;
        }

        function openDetailModal(row) {
            currentDetailRow = row;

            document.getElementById('detailAvatar').textContent = initials(row.nama_pengawas);
            document.getElementById('detailNamaTitle').textContent = row.nama_pengawas || '-';
            document.getElementById('detailIdLaporanSub').textContent = `ID Laporan: ${row.id_laporan || '-'}`;

            const umumFields = [
                buildDetailField('Tanggal Pelaksanaan', formatDate(row.tanggal_pelaksanaan)),
                buildDetailField('Area Kerja', row.area_kerja),
                buildDetailField('Unit Kerja', row.unit_kerja),
                buildDetailField('Jenis Aktifitas KPI', row.aktivitas_label, 2),
            ];
            document.getElementById('detailUmumGrid').innerHTML = umumFields.join('');

            const lower = (row.aktivitas_nama || '').toLowerCase();
            const isNearmiss = lower.includes('nearmiss');
            const isBriefing = lower.includes('safety briefing');

            document.getElementById('detailKategoriTitle').textContent = row.aktivitas_label ?
                `Detail — ${row.aktivitas_label}` : 'Detail Aktifitas';

            let kategoriFields = '';
            if (isNearmiss) {
                kategoriFields =
                    buildDetailField('Keterangan Bahaya', row.keterangan_bahaya, 4) +
                    buildDetailFileField('Foto Temuan Bahaya', row.foto_temuan_bahaya_url);
            } else if (isBriefing) {
                kategoriFields =
                    buildDetailField('Materi Safety Briefing', row.materi_safety_briefing, 4) +
                    buildDetailFileField('Foto Kegiatan', row.foto_kegiatan_safety_briefing_url) +
                    buildDetailFileField('Formulir Presensi (PDF)', row.formulir_presensi_pdf_url);
            } else {
                kategoriFields =
                    `<div class="detail-empty-note">Tidak ada detail tambahan untuk jenis aktifitas ini.</div>`;
            }
            document.getElementById('detailKategoriGrid').innerHTML = kategoriFields;

            const arsipFields = [
                buildDetailField('Status', row.status),
                buildDetailField('Diperiksa Oleh', row.diperiksa_oleh),
            ];
            document.getElementById('detailArsipGrid').innerHTML = arsipFields.join('');

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

        document.addEventListener('DOMContentLoaded', () => {
            loadData();
            setupFilePreviewListeners();
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
