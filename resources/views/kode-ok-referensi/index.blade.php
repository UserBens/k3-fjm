<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Referensi Kode OK &amp; Pemetaan APD — PT. Fokus Jasa Mitra</title>
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

        /* ══════ Grid ala spreadsheet ══════ */
        .grid-wrap {
            width: 100%;
            overflow: auto;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.07);
            max-height: 72vh;
        }

        .grid-table {
            border-collapse: separate;
            border-spacing: 0;
            font-size: 11.5px;
            min-width: 2200px;
        }

        .grid-table thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            background: #1A1D2E;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 10px 8px;
            text-align: center;
            white-space: nowrap;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .grid-table td {
            padding: 7px 8px;
            text-align: center;
            white-space: nowrap;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            color: #1A1D2E;
        }

        .grid-table tbody tr:hover td {
            background: #F8F9FF;
        }

        .grid-table tbody tr.row-inactive td {
            opacity: 0.45;
        }

        /* kolom sticky kiri */
        .col-no {
            min-width: 34px;
        }

        .col-kategori {
            min-width: 110px;
            text-align: left !important;
        }

        .col-nama {
            min-width: 240px;
            text-align: left !important;
            position: sticky;
            left: 0;
            z-index: 3;
            background: #fff;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.04);
            font-weight: 700;
        }

        .grid-table thead th.col-nama {
            left: 0;
            z-index: 6;
            background: #1A1D2E;
        }

        .grid-table tbody tr:hover td.col-nama {
            background: #F8F9FF;
        }

        .col-satuan {
            min-width: 70px;
            color: #64748B;
        }

        .col-target {
            min-width: 60px;
            background: #FBE4E4;
            color: #B3121F;
            font-weight: 800;
        }

        .col-month {
            min-width: 44px;
            color: #2D4B9E;
            font-weight: 600;
        }

        .col-month.empty {
            color: #CBD5E1;
        }

        .col-ytd {
            min-width: 70px;
            background: #ECEAFB;
            color: #4C3F91;
            font-weight: 700;
        }

        .col-capai {
            min-width: 66px;
            font-weight: 800;
        }

        .col-status {
            min-width: 130px;
            text-align: left !important;
        }

        .col-key {
            min-width: 60px;
            background: #E3ECFC;
            color: #2D4B9E;
            font-weight: 600;
        }

        .col-tipe {
            min-width: 120px;
            background: #EFE7FC;
            color: #6B3FA0;
            font-weight: 600;
        }

        .col-key2 {
            min-width: 220px;
            background: #E3ECFC;
            color: #2D4B9E;
            text-align: left !important;
            font-weight: 600;
        }

        .col-aktif {
            min-width: 56px;
            background: #FDECD2;
            color: #B36B00;
            font-weight: 700;
        }

        .col-pembanding {
            min-width: 76px;
            color: #64748B;
            font-weight: 700;
        }

        .col-bulan-n {
            min-width: 56px;
            background: #EFE7FC;
            color: #6B3FA0;
            font-weight: 600;
        }

        .col-aksi {
            min-width: 56px;
            position: sticky;
            right: 0;
            background: #fff;
        }

        .grid-table thead th.col-aksi {
            right: 0;
            background: #1A1D2E;
        }

        .capai-cell-100 {
            background: #DCF3E3;
            color: #157A3C;
        }

        .capai-cell-70 {
            background: #FCEED2;
            color: #B36B00;
        }

        .capai-cell-low {
            background: #FBE1E3;
            color: #B3121F;
        }

        .capai-cell-none {
            background: #F1F2F6;
            color: #94A3B8;
        }

        .status-inline {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-weight: 700;
            font-size: 10.5px;
            white-space: nowrap;
        }

        .status-inline.st-green {
            color: #1A7A3C;
        }

        .status-inline.st-amber {
            color: #D97706;
        }

        .status-inline.st-red {
            color: #D0021B;
        }

        .status-inline.st-gray {
            color: #94A3B8;
        }

        .row-edit-btn {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #fff;
            color: #64748B;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .row-edit-btn:hover {
            background: #F0F4FF;
            color: #2D4B9E;
        }

        .cat-pill {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            background: rgba(45, 75, 158, 0.08);
            color: #2D4B9E;
            white-space: nowrap;
        }

        /* Modal */
        #modalOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, 0.5);
            z-index: 60;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        #modalOverlay.open {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 14px;
            width: 100%;
            max-width: 640px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 20px;
        }

        .modal-hdr {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.02em;
        }

        .modal-close {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: #F0F2FA;
            color: #64748B;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 12px;
            margin-bottom: 14px;
        }

        .form-grid.full {
            grid-template-columns: 1fr;
        }

        .form-field label {
            font-size: 10.5px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 4px;
        }

        .form-field input,
        .form-field select {
            width: 100%;
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
            color: #1A1D2E;
            background: #fff;
        }

        .form-field input:focus,
        .form-field select:focus {
            border-color: #2D4B9E;
        }

        .month-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
            margin-bottom: 6px;
        }

        .month-field label {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            text-transform: uppercase;
            display: block;
            margin-bottom: 3px;
        }

        .month-field input {
            width: 100%;
            height: 32px;
            padding: 0 6px;
            border-radius: 7px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 11.5px;
            text-align: center;
            outline: none;
        }

        .month-field input:focus {
            border-color: #2D4B9E;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .btn-danger-outline {
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid rgba(208, 2, 27, 0.25);
            font-size: 11.5px;
            font-weight: 700;
            color: #D0021B;
            background: #fff;
            cursor: pointer;
        }

        .btn-danger-outline:hover {
            background: #FFF0F1;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .month-grid {
                grid-template-columns: repeat(3, 1fr);
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

            <!-- HEADER -->
            <div class="ld-header">
                <h1>REFERENSI KODE OK &amp; PEMETAAN APD</h1>
                <div class="sub1">PT. Fokus Jasa Mitra · Departemen K3 &amp; Operasional · Status pemetaan mengikuti
                    data HIRADC</div>
                <div class="sub2">Setiap Kode OK dipetakan ke APD Wajib/Khusus. Status "Didukung HIRADC" dihitung
                    otomatis dari jumlah dokumen HIRADC terkait Kode OK tersebut.</div>
            </div>

            <!-- KPI CARDS -->
            <div class="kok-kpi-row">
                <div class="kpi-box kpi-total">
                    <div class="val" id="kpiTotal">0</div>
                    <div class="lbl">TOTAL KODE OK</div>
                    <div class="lbl2">Referensi terdaftar</div>
                </div>
                <div class="kpi-box kpi-tercapai">
                    <div class="val" id="kpiDidukung">0</div>
                    <div class="lbl">✅ DIDUKUNG HIRADC</div>
                    <div class="lbl2">Sudah ada analisa risiko</div>
                </div>
                <div class="kpi-box kpi-dibawah">
                    <div class="val" id="kpiBelum">0</div>
                    <div class="lbl">⚠️ BELUM ADA HIRADC</div>
                    <div class="lbl2">APD masih standar K3</div>
                </div>
            </div>

            <!-- FILTER + TABLE -->
            <div class="section-card">
                <div class="sc-header">
                    <div>
                        <div class="sc-title">Daftar Referensi Kode OK</div>
                        <div class="sc-sub">Cari, filter, dan kelola pemetaan APD per Kode OK.</div>
                    </div>
                    <button class="btn-primary" onclick="openFormModal()">
                        <svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Referensi
                    </button>
                </div>

                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari Kode OK, uraian pekerjaan, dept..."
                            oninput="onSearchInput()" />
                    </div>
                    <select id="filterDept" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Dept/Unit Kerja</option>
                    </select>
                    <select id="filterKategori" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Kategori Pekerjaan</option>
                    </select>
                    <select id="filterStatusPemetaan" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status Pemetaan</option>
                        <option value="DIDUKUNG">✅ Didukung HIRADC</option>
                        <option value="BELUM">⚠️ Belum Ada HIRADC</option>
                    </select>
                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data...</div>

                <div class="rtable-wrap">
                    <table class="rtable kok-rtable">
                        <thead>
                            <tr>
                                <th style="width:32px;">No</th>
                                <th class="txt-left">Kode OK</th>
                                <th class="txt-left">Uraian Pekerjaan</th>
                                <th class="txt-left">Dept/Unit Kerja PIC</th>
                                <th class="txt-left">Kategori Pekerjaan</th>
                                <th class="txt-left">APD Wajib</th>
                                <th class="txt-left">APD Khusus</th>
                                <th>HIRADC Terkait</th>
                                <th class="txt-left">Status Pemetaan APD</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr class="loading-row">
                                <td colspan="10">Memuat data…</td>
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

    <!-- ══════ MODAL TAMBAH / EDIT ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Referensi Kode OK</div>
                <div class="detail-subtitle">Kolom "HIRADC Terkait" &amp; "Status Pemetaan APD" dihitung otomatis dari
                    data HIRADC — tidak diisi manual.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Identitas Pekerjaan</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Kode OK</label>
                        <input type="text" id="fKodeOk" class="form-input" placeholder="1 / OK-001 / PCS01" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Dept / Unit Kerja PIC</label>
                        <input type="text" id="fDept" class="form-input" placeholder="DEP. PRODUKSI I" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Uraian Pekerjaan</label>
                        <textarea id="fUraian" class="form-textarea" rows="2" placeholder="JASA ADMINISTRASI PRODUKSI I A"></textarea>
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Kategori Pekerjaan</label>
                        <input type="text" id="fKategori" class="form-input" placeholder="PRODUKSI / OPERATOR" />
                    </div>
                </div>

                <div class="form-section-title">Pemetaan APD</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">APD Wajib</label>
                        <div class="ms-dropdown" id="msWajibWrap">
                            <button type="button" class="ms-dropdown-btn" onclick="toggleMsDropdown('msWajib')">
                                <span id="msWajibLabel">Pilih APD Wajib...</span>
                                <svg style="width:13px;height:13px; flex-shrink:0;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="ms-dropdown-panel" id="msWajibPanel">
                                <input type="text" class="ms-search" placeholder="Cari APD..."
                                    oninput="filterMsOptions('msWajib', this.value)" />
                                <div class="ms-options" id="msWajibOptions"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">APD Khusus</label>
                        <div class="ms-dropdown" id="msKhususWrap">
                            <button type="button" class="ms-dropdown-btn" onclick="toggleMsDropdown('msKhusus')">
                                <span id="msKhususLabel">Pilih APD Khusus...</span>
                                <svg style="width:13px;height:13px; flex-shrink:0;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="ms-dropdown-panel" id="msKhususPanel">
                                <input type="text" class="ms-search" placeholder="Cari APD..."
                                    oninput="filterMsOptions('msKhusus', this.value)" />
                                <div class="ms-options" id="msKhususOptions"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL HAPUS ══════ -->
    <div id="deleteConfirmOverlay" class="modal-overlay" onclick="closeDeleteModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="modal-title">Hapus Referensi Kode OK?</div>
            <div class="modal-desc" id="deleteModalDesc">Data ini akan dihapus permanen.</div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <style>
        /* ══════ Kop halaman ala dashboard leading indicator ══════ */
        .ld-header {
            background: #1A1D2E;
            border-radius: 12px;
            padding: 14px 20px;
            text-align: center;
            color: #fff;
            margin-bottom: 14px;
        }

        .ld-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.04em;
        }

        .ld-header .sub1 {
            font-size: 11px;
            color: #B9C2E8;
            margin-top: 4px;
        }

        .ld-header .sub2 {
            font-size: 10.5px;
            color: #8792C4;
            margin-top: 2px;
        }

        .kok-kpi-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 14px;
        }

        .kpi-box {
            border-radius: 10px;
            padding: 14px 12px 10px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .kpi-box .val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 34px;
            line-height: 1;
        }

        .kpi-box .lbl {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.04em;
            margin-top: 6px;
            opacity: 0.9;
        }

        .kpi-box .lbl2 {
            font-size: 9px;
            opacity: 0.75;
            margin-top: 1px;
        }

        .kpi-total {
            background: #1A1D2E;
        }

        .kpi-tercapai {
            background: #1A7A3C;
        }

        .kpi-dibawah {
            background: #D97706;
        }

        /* Header tabel gelap ala dashboard */
        .kok-rtable thead th {
            background: #1A1D2E;
            color: #fff;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .kok-rtable td {
            vertical-align: top;
        }

        .apd-pill-list {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            max-width: 220px;
        }

        .apd-pill {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 600;
            background: rgba(45, 75, 158, 0.08);
            color: #2D4B9E;
            white-space: nowrap;
        }

        .apd-pill.khusus {
            background: rgba(208, 2, 27, 0.08);
            color: #D0021B;
        }

        .apd-pill-more {
            font-size: 10px;
            color: #94A3B8;
            font-weight: 600;
        }

        .hiradc-count-badge {
            display: inline-flex;
            min-width: 26px;
            justify-content: center;
            padding: 3px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            background: #EEF1FC;
            color: #2D4B9E;
        }

        .hiradc-count-badge.zero {
            background: #FEF3E2;
            color: #D97706;
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
    </style>

    <script>
        // ══════ CONFIG ══════
        const DATA_ENDPOINT = "{{ route('kode-ok-referensi.data') }}";
        const STORE_ENDPOINT = "{{ route('kode-ok-referensi.store') }}";
        const APD_OPTIONS_ENDPOINT = "{{ route('kode-ok-referensi.apd-options') }}";
        const BASE_ENDPOINT = "{{ url('/kode-ok-referensi') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            dept_unit_kerja_pic: '',
            kategori_pekerjaan: '',
            status_pemetaan: '',
            page: 1,
            per_page: 10
        };

        let searchDebounce = null;
        let filterOptionsLoaded = false;
        let currentEditId = null;
        let currentDeleteId = null;
        let apdOptionsCache = [];

        // set terpilih untuk masing-masing dropdown, key = stok_apd_id
        let msSelected = {
            msWajib: new Set(),
            msKhusus: new Set()
        };

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

        // ══════ FILTER & LIST ══════
        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.dept_unit_kerja_pic = document.getElementById('filterDept').value;
            state.kategori_pekerjaan = document.getElementById('filterKategori').value;
            state.status_pemetaan = document.getElementById('filterStatusPemetaan').value;
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
            document.getElementById('filterDept').value = '';
            document.getElementById('filterKategori').value = '';
            document.getElementById('filterStatusPemetaan').value = '';
            Object.assign(state, {
                search: '',
                dept_unit_kerja_pic: '',
                kategori_pekerjaan: '',
                status_pemetaan: '',
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
            const build = (selectId, values) => {
                const select = document.getElementById(selectId);
                const current = select.value;
                values.forEach(val => {
                    const opt = document.createElement('option');
                    opt.value = val;
                    opt.textContent = val;
                    select.appendChild(opt);
                });
                select.value = current;
            };
            build('filterDept', options.dept_unit_kerja_pic || []);
            build('filterKategori', options.kategori_pekerjaan || []);
            filterOptionsLoaded = true;
        }

        function renderApdPills(list, isKhusus = false) {
            if (!list || list.length === 0) {
                return '<span class="td-name-sub">-</span>';
            }
            const shown = list.slice(0, 3);
            const rest = list.length - shown.length;
            const pills = shown.map(a =>
                `<span class="apd-pill ${isKhusus ? 'khusus' : ''}">${escapeHtml(a.jenis_apd)}</span>`).join('');
            const more = rest > 0 ? `<span class="apd-pill-more">+${rest} lainnya</span>` : '';
            return `<div class="apd-pill-list">${pills}${more}</div>`;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML = `<tr class="loading-row"><td colspan="10">Tidak ada data untuk filter ini.</td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map((row, idx) => `
                <tr>
                    <td>${(state.page - 1) * state.per_page + idx + 1}</td>
                    <td class="txt-left"><b>${escapeHtml(row.kode_ok)}</b></td>
                    <td class="txt-left" style="max-width:220px; white-space:normal;">${escapeHtml(row.uraian_pekerjaan)}</td>
                    <td class="txt-left">${escapeHtml(display(row.dept_unit_kerja_pic))}</td>
                    <td class="txt-left">${escapeHtml(display(row.kategori_pekerjaan))}</td>
                    <td class="txt-left">${renderApdPills(row.apd_wajib, false)}</td>
                    <td class="txt-left">${renderApdPills(row.apd_khusus, true)}</td>
                    <td><span class="hiradc-count-badge ${row.hiradc_terkait === 0 ? 'zero' : ''}">${row.hiradc_terkait}</span></td>
                    <td class="txt-left">
                        <span class="status-pill ${row.status_pemetaan_apd.key === 'DIDUKUNG' ? 'sp-green' : 'sp-amber'}">
                            ${row.status_pemetaan_apd.icon} ${escapeHtml(row.status_pemetaan_apd.label)}
                        </span>
                    </td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-row-action" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                            <svg style="width:14px;height:14px; color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button class="btn-row-action" onclick="openDeleteModal(${row.id}, '${escapeHtml(row.kode_ok)}')">
                            <svg style="width:14px;height:14px; color:#D0021B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> referensi Kode OK ditemukan`;

            const container = document.getElementById('paginationPages');
            const current = meta.current_page,
                last = meta.last_page;
            let pages = [1];
            if (current > 3) pages.push('...');
            for (let p = Math.max(2, current - 1); p <= Math.min(last - 1, current + 1); p++) pages.push(p);
            if (current < last - 2) pages.push('...');
            if (last > 1) pages.push(last);
            pages = [...new Set(pages)];

            let html =
                `<button class="page-btn" ${current <= 1 ? 'disabled' : ''} onclick="goToPage(${current - 1})">‹</button>`;
            pages.forEach(p => {
                html += p === '...' ? `<span class="page-ellipsis">…</span>` :
                    `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
            });
            html +=
                `<button class="page-btn" ${current >= last ? 'disabled' : ''} onclick="goToPage(${current + 1})">›</button>`;
            container.innerHTML = html;
        }

        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.dept_unit_kerja_pic) params.set('dept_unit_kerja_pic', state.dept_unit_kerja_pic);
            if (state.kategori_pekerjaan) params.set('kategori_pekerjaan', state.kategori_pekerjaan);
            if (state.status_pemetaan) params.set('status_pemetaan', state.status_pemetaan);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error((await res.json().catch(() => null))?.message || `Status ${res.status}`);
                const json = await res.json();

                renderTable(json.data);
                renderPagination(json.meta);
                populateFilterOptions(json.filter_options);

                document.getElementById('kpiTotal').textContent = json.kpi.total;
                document.getElementById('kpiDidukung').textContent = json.kpi.didukung_hiradc;
                document.getElementById('kpiBelum').textContent = json.kpi.belum_ada_hiradc;
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr class="loading-row"><td colspan="10">${escapeHtml(e.message)}</td></tr>`;
            }
        }

        // ══════ CHECKLIST DROPDOWN (APD Wajib / APD Khusus) ══════
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
                /* diamkan */
            }
        }

        function renderMsOptions(prefix, term = '') {
            const container = document.getElementById(`${prefix}Options`);
            const term_ = term.toLowerCase();
            const list = apdOptionsCache.filter(a => a.jenis_apd.toLowerCase().includes(term_));

            if (list.length === 0) {
                container.innerHTML = `<div class="ms-option-empty">APD tidak ditemukan.</div>`;
                return;
            }

            container.innerHTML = list.map(a => `
                <label class="ms-option-row">
                    <input type="checkbox" value="${a.id}" ${msSelected[prefix].has(a.id) ? 'checked' : ''}
                        onchange="onMsCheckboxChange('${prefix}', ${a.id}, this.checked)" />
                    <span>${escapeHtml(a.jenis_apd)} <span style="color:#94A3B8;">(${escapeHtml(a.kode_apd)})</span></span>
                </label>
            `).join('');
        }

        function filterMsOptions(prefix, term) {
            renderMsOptions(prefix, term);
        }

        function onMsCheckboxChange(prefix, id, checked) {
            if (checked) msSelected[prefix].add(id);
            else msSelected[prefix].delete(id);
            updateMsLabel(prefix);
        }

        function updateMsLabel(prefix) {
            const label = document.getElementById(`${prefix}Label`);
            const count = msSelected[prefix].size;
            if (count === 0) {
                label.textContent = prefix === 'msWajib' ? 'Pilih APD Wajib...' : 'Pilih APD Khusus...';
                return;
            }
            const names = apdOptionsCache.filter(a => msSelected[prefix].has(a.id)).map(a => a.jenis_apd);
            label.textContent = count <= 2 ? names.join(', ') : `${names.slice(0, 2).join(', ')} +${count - 2} lainnya`;
        }

        function toggleMsDropdown(prefix) {
            const panel = document.getElementById(`${prefix}Panel`);
            const isOpen = panel.classList.contains('open');
            document.querySelectorAll('.ms-dropdown-panel.open').forEach(p => p.classList.remove('open'));
            if (!isOpen) {
                panel.classList.add('open');
                renderMsOptions(prefix);
                panel.querySelector('.ms-search').value = '';
                panel.querySelector('.ms-search').focus();
            }
        }

        document.addEventListener('click', (e) => {
            document.querySelectorAll('.ms-dropdown').forEach(wrap => {
                if (!wrap.contains(e.target)) {
                    wrap.querySelector('.ms-dropdown-panel')?.classList.remove('open');
                }
            });
        });

        // ══════ MODAL TAMBAH / EDIT ══════
        async function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            await loadApdOptions();

            document.getElementById('formModalTitle').textContent = row ? 'Edit Referensi Kode OK' :
                'Tambah Referensi Kode OK';

            document.getElementById('fKodeOk').value = row?.kode_ok || '';
            document.getElementById('fDept').value = row?.dept_unit_kerja_pic || '';
            document.getElementById('fUraian').value = row?.uraian_pekerjaan || '';
            document.getElementById('fKategori').value = row?.kategori_pekerjaan || '';

            msSelected.msWajib = new Set((row?.apd_wajib || []).map(a => a.id));
            msSelected.msKhusus = new Set((row?.apd_khusus || []).map(a => a.id));
            updateMsLabel('msWajib');
            updateMsLabel('msKhusus');
            document.querySelectorAll('.ms-dropdown-panel.open').forEach(p => p.classList.remove('open'));

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
                kode_ok: document.getElementById('fKodeOk').value.trim(),
                dept_unit_kerja_pic: document.getElementById('fDept').value.trim() || null,
                uraian_pekerjaan: document.getElementById('fUraian').value.trim(),
                kategori_pekerjaan: document.getElementById('fKategori').value.trim() || null,
                apd_wajib_ids: Array.from(msSelected.msWajib),
                apd_khusus_ids: Array.from(msSelected.msKhusus),
            };

            const url = currentEditId ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;
            const method = currentEditId ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify(payload),
                });
                const json = await res.json();
                if (!res.ok) {
                    const firstError = json.errors ? Object.values(json.errors)[0][0] : null;
                    throw new Error(firstError || json.message || `Status ${res.status}`);
                }
                closeFormModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menyimpan data.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ══════ MODAL HAPUS ══════
        function openDeleteModal(id, kodeOk) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Referensi Kode OK "${kodeOk}" akan dihapus permanen. Lanjutkan?`;
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
                if (!res.ok) throw new Error(json.message || `Status ${res.status}`);
                closeDeleteModal();
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                closeDeleteModal();
                showToast(e.message || 'Gagal menghapus data.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
