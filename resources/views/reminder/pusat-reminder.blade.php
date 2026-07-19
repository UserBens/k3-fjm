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

        .pr-header {
            background: #1A1D2E;
            border-radius: 12px;
            padding: 14px 20px;
            text-align: center;
            color: #fff;
            margin-bottom: 14px;
        }

        .pr-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.04em;
        }

        .pr-header .sub1 {
            font-size: 11px;
            color: #B9C2E8;
            margin-top: 4px;
        }

        .pr-kpi-row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 18px;
        }

        @media (max-width: 900px) {
            .pr-kpi-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .pr-kpi-box {
            border-radius: 10px;
            padding: 14px 12px 10px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            cursor: pointer;
            transition: transform 0.15s ease;
            border: 2px solid transparent;
        }

        .pr-kpi-box:hover {
            transform: translateY(-2px);
        }

        .pr-kpi-box.active {
            border-color: #fff;
        }

        .pr-kpi-box .val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            line-height: 1;
        }

        .pr-kpi-box .lbl {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.03em;
            margin-top: 6px;
            opacity: 0.95;
            text-align: center;
        }

        .pr-kpi-box.pr-aman {
            background: #1A7A3C;
        }

        .pr-kpi-box.pr-warn {
            background: #D97706;
        }

        .pr-section {
            margin-bottom: 18px;
        }

        .pr-section-hdr {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .pr-section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            letter-spacing: 0.03em;
            color: #1A1D2E;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pr-section-count {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
        }

        .pr-empty-row td {
            text-align: center;
            padding: 22px 12px;
            color: #94A3B8;
            font-size: 12px;
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

            <div class="pr-header">
                <h1>PUSAT REMINDER &amp; PERINGATAN</h1>
                <div class="sub1">Otomatis: stok ≤ Reorder Point &middot; lifetime APD ≤ 30 hari &middot; kalibrasi
                    &amp;
                    kadaluarsa alkes jatuh tempo. Baris kosong = aman.</div>
            </div>

            <div class="pr-kpi-row" id="kpiRow">
                <div class="pr-kpi-box" id="kpiBoxPengadaan" onclick="scrollToSection('secPengadaan')">
                    <div class="val" id="valPengadaan">0</div>
                    <div class="lbl">APD PERLU<br>PENGADAAN</div>
                </div>
                <div class="pr-kpi-box" id="kpiBoxLifetime" onclick="scrollToSection('secLifetime')">
                    <div class="val" id="valLifetime">0</div>
                    <div class="lbl">APD LIFETIME<br>≤30 HARI</div>
                </div>
                <div class="pr-kpi-box" id="kpiBoxStokKritis" onclick="scrollToSection('secStokKritis')">
                    <div class="val" id="valStokKritis">0</div>
                    <div class="lbl">ALKES STOK<br>KRITIS</div>
                </div>
                <div class="pr-kpi-box" id="kpiBoxKalibrasi" onclick="scrollToSection('secKalibrasi')">
                    <div class="val" id="valKalibrasi">0</div>
                    <div class="lbl">KALIBRASI<br>JATUH TEMPO</div>
                </div>
                <div class="pr-kpi-box" id="kpiBoxKadaluarsa" onclick="scrollToSection('secKadaluarsa')">
                    <div class="val" id="valKadaluarsa">0</div>
                    <div class="lbl">KADALUARSA<br>JATUH TEMPO</div>
                </div>
            </div>


            <!-- FILTER + TABLE -->
            <!-- ① APD PERLU PENGADAAN -->
            <div class="pr-section" id="secPengadaan">
                <div class="section-card">
                    <div class="pr-section-hdr">
                        <div class="pr-section-title">① APD Perlu Pengadaan <span class="pr-section-count">(Stok ≤
                                Reorder
                                Point)</span></div>
                    </div>
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>Kode APD</th>
                                    <th>Jenis APD</th>
                                    <th>Stok Tersedia</th>
                                    <th>Reorder Point</th>
                                    <th>Saran Qty Pesan</th>
                                    <th>EOQ</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyPengadaan">
                                <tr class="pr-empty-row">
                                    <td colspan="7">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ② APD LIFETIME ≤30 HARI -->
            <div class="pr-section" id="secLifetime">
                <div class="section-card">
                    <div class="pr-section-hdr">
                        <div class="pr-section-title">② APD Lifetime ≤30 Hari</div>
                    </div>
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>Kode APD</th>
                                    <th>Jenis APD</th>
                                    <th>Terakhir Pengadaan</th>
                                    <th>Masa Pakai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyLifetime">
                                <tr class="pr-empty-row">
                                    <td colspan="5">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ③ ALKES STOK KRITIS -->
            <div class="pr-section" id="secStokKritis">
                <div class="section-card">
                    <div class="pr-section-hdr">
                        <div class="pr-section-title">③ Alkes Stok Kritis <span class="pr-section-count">(Stok ≤ Reorder
                                Point)</span></div>
                    </div>
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>Kode Alkes</th>
                                    <th>Jenis Alat</th>
                                    <th>Stok Tersedia</th>
                                    <th>Reorder Point</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyStokKritis">
                                <tr class="pr-empty-row">
                                    <td colspan="5">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ④ KALIBRASI JATUH TEMPO -->
            <div class="pr-section" id="secKalibrasi">
                <div class="section-card">
                    <div class="pr-section-hdr">
                        <div class="pr-section-title">④ Kalibrasi Jatuh Tempo</div>
                    </div>
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>Kode Alkes</th>
                                    <th>Jenis Alat</th>
                                    <th>Tanggal Kalibrasi</th>
                                    <th>Jadwal Kalibrasi Berikut</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyKalibrasi">
                                <tr class="pr-empty-row">
                                    <td colspan="5">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ⑤ KADALUARSA JATUH TEMPO -->
            <div class="pr-section" id="secKadaluarsa">
                <div class="section-card">
                    <div class="pr-section-hdr">
                        <div class="pr-section-title">⑤ Kadaluarsa Jatuh Tempo</div>
                    </div>
                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>Kode Alkes</th>
                                    <th>Jenis Alat</th>
                                    <th>Tanggal Exp</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyKadaluarsa">
                                <tr class="pr-empty-row">
                                    <td colspan="4">Memuat data…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>
    </div>


    <div id="toastContainer" class="toast-container"></div>

    <script>
        const REMINDER_DATA_ENDPOINT = "{{ route('pusat-reminder.data') }}";

        function escapeHtmlPR(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function display(value, fallback = '-') {
            return (value === null || value === undefined || value === '') ? fallback : value;
        }

        function statusPillClass(status) {
            if (status === 'OK' || status === 'AMAN') return 'sp-green';
            if (status === 'SEGERA') return 'sp-amber';
            if (['REORDER', 'HABIS MASA', 'LEWAT', 'KADALUARSA'].includes(status)) return 'sp-red';
            return 'sp-gray';
        }

        function renderStatusPill(status) {
            if (!status) return '<span class="td-name-sub">-</span>';
            return `<span class="status-pill ${statusPillClass(status)}">${escapeHtmlPR(status)}</span>`;
        }

        function scrollToSection(id) {
            document.getElementById(id)?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function renderRows(tbodyId, rows, colspan, rowBuilder) {
            const tbody = document.getElementById(tbodyId);
            if (!rows || rows.length === 0) {
                tbody.innerHTML = `<tr class="pr-empty-row"><td colspan="${colspan}">Tidak ada data — aman.</td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(rowBuilder).join('');
        }

        function setKpi(boxId, valId, count) {
            document.getElementById(valId).textContent = count;
            const box = document.getElementById(boxId);
            box.classList.remove('pr-aman', 'pr-warn');
            box.classList.add(count > 0 ? 'pr-warn' : 'pr-aman');
        }

        async function loadReminderData() {
            try {
                const res = await fetch(REMINDER_DATA_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const json = await res.json();

                setKpi('kpiBoxPengadaan', 'valPengadaan', json.summary.apd_perlu_pengadaan);
                setKpi('kpiBoxLifetime', 'valLifetime', json.summary.apd_lifetime_30);
                setKpi('kpiBoxStokKritis', 'valStokKritis', json.summary.alkes_stok_kritis);
                setKpi('kpiBoxKalibrasi', 'valKalibrasi', json.summary.kalibrasi_jatuh_tempo);
                setKpi('kpiBoxKadaluarsa', 'valKadaluarsa', json.summary.kadaluarsa_jatuh_tempo);

                renderRows('tbodyPengadaan', json.apd_perlu_pengadaan, 7, row => `
                <tr>
                    <td><b>${escapeHtmlPR(row.kode_apd)}</b></td>
                    <td class="txt-left">${escapeHtmlPR(row.jenis_apd)}</td>
                    <td>${row.stok_tersedia}</td>
                    <td>${row.reorder_point}</td>
                    <td>${row.saran_qty_pesan}</td>
                    <td>${display(row.eoq)}</td>
                    <td>${renderStatusPill(row.status)}</td>
                </tr>`);

                renderRows('tbodyLifetime', json.apd_lifetime_30, 5, row => `
                <tr>
                    <td><b>${escapeHtmlPR(row.kode_apd)}</b></td>
                    <td class="txt-left">${escapeHtmlPR(row.jenis_apd)}</td>
                    <td>${display(row.terakhir_pengadaan)}</td>
                    <td>${display(row.masa_pakai)}</td>
                    <td>${renderStatusPill(row.status)}</td>
                </tr>`);

                renderRows('tbodyStokKritis', json.alkes_stok_kritis, 5, row => `
                <tr>
                    <td><b>${escapeHtmlPR(row.kode_alkes)}</b></td>
                    <td class="txt-left">${escapeHtmlPR(row.jenis_alat)}</td>
                    <td>${row.stok_tersedia}</td>
                    <td>${row.reorder_point}</td>
                    <td>${renderStatusPill(row.status)}</td>
                </tr>`);

                renderRows('tbodyKalibrasi', json.kalibrasi_jatuh_tempo, 5, row => `
                <tr>
                    <td><b>${escapeHtmlPR(row.kode_alkes)}</b></td>
                    <td class="txt-left">${escapeHtmlPR(row.jenis_alat)}</td>
                    <td>${display(row.tanggal_kalibrasi)}</td>
                    <td>${display(row.jadwal_kalibrasi_berikut)}</td>
                    <td>${renderStatusPill(row.status)}</td>
                </tr>`);

                renderRows('tbodyKadaluarsa', json.kadaluarsa_jatuh_tempo, 4, row => `
                <tr>
                    <td><b>${escapeHtmlPR(row.kode_alkes)}</b></td>
                    <td class="txt-left">${escapeHtmlPR(row.jenis_alat)}</td>
                    <td>${display(row.tanggal_exp)}</td>
                    <td>${renderStatusPill(row.status)}</td>
                </tr>`);

            } catch (e) {
                console.error(e);
            }
        }

        document.addEventListener('DOMContentLoaded', loadReminderData);
    </script>

</body>

</html>
