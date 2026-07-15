<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Monitoring Laporan — PT. Fokus Jasa Mitra</title>
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

        .summary-card-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        @media (max-width: 768px) {
            .summary-card-row {
                grid-template-columns: 1fr;
            }
        }

        .summary-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 16px;
        }

        .summary-card-label {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 6px;
        }

        .summary-card-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: #1A1D2E;
            letter-spacing: 0.02em;
        }

        .summary-card-value span {
            color: #2D4B9E;
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
                            <span class="pg-eyebrow">Monitoring Laporan · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">MONITORING LAPORAN <span>PERSEORANGAN</span></div>
                        <div class="pg-sub">Rekap laporan Unsafe Action / Unsafe Condition per Safety Officer.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Laporan
                        </button>
                    </div>
                </div>
            </div>

            <!-- FILTER UTAMA: Pilih Nama, Jenis Laporan, Tahun, Bulan -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search" style="min-width:260px;">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari item temuan..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterSo" class="filter-select" style="min-width:220px;" onchange="onFilterChange()">
                        <option value="">Semua Safety Officer</option>
                    </select>

                    <select id="filterJenis" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Jenis Laporan</option>
                        <option value="Unsafe Action">Unsafe Action</option>
                        <option value="Unsafe Condition">Unsafe Condition</option>
                    </select>

                    <select id="filterTahun" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Tahun</option>
                    </select>

                    <select id="filterBulan" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select id="filterKeputusan" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Keputusan</option>
                        <option value="PENDING">PENDING</option>
                        <option value="APPROVE">APPROVE</option>
                        <option value="REJECT">REJECT</option>
                    </select>
                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="OPEN">OPEN</option>
                        <option value="CLOSE">CLOSE</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>
            </div>

            <!-- SUMMARY CARD -->
            <div class="summary-card-row">
                <div class="summary-card">
                    <div class="summary-card-label">Safety Officer Terpilih</div>
                    <div class="summary-card-value" id="summarySoName"
                        style="font-size:16px; font-family:'Plus Jakarta Sans',sans-serif; font-weight:800;">Semua
                        Safety Officer</div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-label">Periode</div>
                    <div class="summary-card-value" id="summaryPeriode"
                        style="font-size:16px; font-family:'Plus Jakarta Sans',sans-serif; font-weight:800;">Semua
                        Periode</div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-label">Total Laporan Ditemukan</div>
                    <div class="summary-card-value"><span id="summaryTotal">0</span></div>
                </div>
            </div>

            <div class="section-card" style="margin-bottom:14px;">
                <div class="data-summary" id="dataSummary">Memuat data laporan...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th style="width:36px;">No</th>
                                <th>Tanggal</th>
                                <th>Safety Officer</th>
                                <th>Item Temuan</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Keputusan</th> <!-- BARU -->
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

                <div class="pagination-bar">
                    <div class="pagination-info">
                        <span id="paginationText">—</span>
                        <select id="perPageSelect" class="per-page-select" onchange="onPerPageChange()">
                            <option value="15">15 / halaman</option>
                            <option value="25">25 / halaman</option>
                            <option value="50">50 / halaman</option>
                        </select>
                    </div>
                    <div class="pagination-pages" id="paginationPages"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
                <div>
                    <div class="modal-title" id="detailItemTitle" style="margin-bottom:2px;">-</div>
                    <div class="pg-sub" id="detailSoSub" style="margin:0;">-</div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>
            <div class="detail-modal-body" id="detailModalBody"></div>
            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL FORM TAMBAH/EDIT ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Laporan Temuan</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Safety Officer Pelapor</div>
                <div class="picker-wrap" style="margin-bottom:10px;">
                    <input type="text" id="soPickerInput" class="form-input"
                        placeholder="Cari nama atau badge Safety Officer..." oninput="onSoPickerInput()"
                        autocomplete="off" />
                    <div class="picker-dropdown" id="soPickerDropdown"></div>
                </div>
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Badge</label><input type="text"
                            id="fBadgeSo" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group span-2"><label class="form-label">Nama SO</label><input type="text"
                            id="fNamaSo" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group"><label class="form-label">Tanggal Temuan</label><input type="date"
                            id="fTanggalTemuan" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Area Kerja</label><input type="text"
                            id="fAreaKerja" class="form-input" /></div>
                    <div class="form-group span-2"><label class="form-label">Unit Kerja</label><input type="text"
                            id="fUnitKerja" class="form-input" /></div>
                    <div class="form-group">
                        <label class="form-label">Jenis Penyebab</label>
                        <select id="fJenisPenyebab" class="form-select">
                            <option value="Unsafe Action">Unsafe Action</option>
                            <option value="Unsafe Condition">Unsafe Condition</option>
                        </select>
                    </div>
                </div>

                <div class="form-section-title">Detail Temuan</div>
                <div class="form-grid">
                    <div class="form-group span-4"><label class="form-label">Item Temuan</label><input type="text"
                            id="fItemTemuan" class="form-input" /></div>
                    <div class="form-group span-4"><label class="form-label">Deskripsi Temuan</label>
                        <textarea id="fDeskripsiTemuan" class="form-textarea" rows="2"></textarea>
                    </div>
                    <div class="form-group span-4"><label class="form-label">Rekomendasi Perbaikan</label>
                        <textarea id="fRekomendasiPerbaikan" class="form-textarea" rows="2"></textarea>
                    </div>
                    <div class="form-group"><label class="form-label">Foto Temuan</label><input type="file"
                            id="fFotoTemuan" class="form-input" accept="image/*" /></div>
                    <div class="form-group"><label class="form-label">Dokumen Laporan</label><input type="file"
                            id="fDokumenLaporan" class="form-input" /></div>
                    <div class="form-group">
                        <label class="form-label">Status Temuan</label>
                        <select id="fStatusTemuan" class="form-select">
                            <option value="OPEN">OPEN</option>
                            <option value="CLOSE">CLOSE</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('monitoring-laporan-so.data') }}";
        const STORE_ENDPOINT = "{{ route('monitoring-laporan-so.store') }}";
        const BASE_ENDPOINT = "{{ url('/monitoring-laporan-so') }}";
        const DAFTAR_SO_ENDPOINT = "{{ route('monitoring-laporan-so.daftar-so') }}";
        const CARI_SO_ENDPOINT = "{{ route('monitoring-laporan-so.cari-so') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const BULAN_LABEL = {
            1: 'Januari',
            2: 'Februari',
            3: 'Maret',
            4: 'April',
            5: 'Mei',
            6: 'Juni',
            7: 'Juli',
            8: 'Agustus',
            9: 'September',
            10: 'Oktober',
            11: 'November',
            12: 'Desember'
        };

        const state = {
            search: '',
            badge_so: '',
            jenis_penyebab: '',
            tahun: '',
            bulan: '',
            status_temuan: '',
            keputusan: '',
            page: 1,
            per_page: 15
        };

        let searchDebounce = null,
            soListLoaded = false,
            tahunListLoaded = false,
            currentEditId = null;

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function initials(name) {
            if (!name || name === '-') return '—';
            const p = name.trim().split(/\s+/);
            return ((p[0]?.[0] || '') + (p[1]?.[0] || '')).toUpperCase();
        }

        function formatDate(d) {
            if (!d) return '-';
            const dt = new Date(d);
            return isNaN(dt.getTime()) ? d : dt.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
            toast.innerHTML =
                `<div class="toast-icon">${type === 'error' ? '✕' : '✓'}</div><div><div class="toast-title">${type === 'error' ? 'Gagal' : 'Berhasil'}</div><div class="toast-msg">${escapeHtml(message)}</div></div><button class="toast-close" onclick="this.parentElement.remove()">✕</button>`;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.add('show'));
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 250);
            }, 4000);
        }

        // ══════ LOAD DROPDOWN AWAL ══════
        async function loadSoDropdown() {
            if (soListLoaded) return;
            try {
                const res = await fetch(DAFTAR_SO_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                const select = document.getElementById('filterSo');
                (json.data || []).forEach(so => {
                    const opt = document.createElement('option');
                    opt.value = so.badge;
                    opt.textContent = so.label;
                    select.appendChild(opt);
                });
                soListLoaded = true;
            } catch (e) {
                /* diamkan */
            }
        }

        function populateTahunOptions(tahunList) {
            if (tahunListLoaded || !tahunList) return;
            const select = document.getElementById('filterTahun');
            tahunList.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t;
                opt.textContent = t;
                select.appendChild(opt);
            });
            if (tahunList.length > 0 && !document.getElementById('filterTahun').value) {
                // default: tahun berjalan kalau ada di list, kalau tidak biarkan "Semua Tahun"
                const currentYear = new Date().getFullYear();
                if (tahunList.includes(currentYear)) {
                    document.getElementById('filterTahun').value = currentYear;
                    state.tahun = currentYear;
                }
            }
            tahunListLoaded = true;
        }

        // ══════ FILTER ══════
        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.badge_so = document.getElementById('filterSo').value;
            state.jenis_penyebab = document.getElementById('filterJenis').value;
            state.tahun = document.getElementById('filterTahun').value;
            state.bulan = document.getElementById('filterBulan').value;
            state.status_temuan = document.getElementById('filterStatus').value;
            state.keputusan = document.getElementById('filterKeputusan').value; // BARU

            state.page = 1;
            loadData();
        }

        function onPerPageChange() {
            state.per_page = parseInt(document.getElementById('perPageSelect').value, 10);
            state.page = 1;
            loadData();
        }

        function resetFilters() {
            ['searchInput'].forEach(id => document.getElementById(id).value = '');
            ['filterSo', 'filterJenis', 'filterTahun', 'filterBulan', 'filterStatus', 'filterKeputusan'].forEach(id =>
                document.getElementById(id).value = '');
            Object.assign(state, {
                search: '',
                badge_so: '',
                jenis_penyebab: '',
                tahun: '',
                bulan: '',
                status_temuan: '',
                keputusan: '',
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

        function updateSummary(meta) {
            const soSelect = document.getElementById('filterSo');
            const soLabel = state.badge_so ? soSelect.options[soSelect.selectedIndex].textContent : 'Semua Safety Officer';
            document.getElementById('summarySoName').textContent = soLabel;

            let periode = 'Semua Periode';
            if (state.tahun && state.bulan) periode = `${BULAN_LABEL[state.bulan]} ${state.tahun}`;
            else if (state.tahun) periode = `Tahun ${state.tahun}`;
            else if (state.bulan) periode = BULAN_LABEL[state.bulan];
            document.getElementById('summaryPeriode').textContent = periode;

            document.getElementById('summaryTotal').textContent = meta.total;
        }

        function statusPillClass(s) {
            return s === 'CLOSE' ? 'sp-green' : 'sp-amber';
        }

        function jenisPillClass(j) {
            return j === 'Unsafe Action' ? 'sp-red' : j === 'Unsafe Condition' ? 'sp-blue' : 'sp-gray';
        }

        function keputusanPillClass(k) {
            return k === 'APPROVE' ? 'sp-green' : k === 'REJECT' ? 'sp-red' : 'sp-amber';
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="8"><div class="empty-state"><div class="empty-state-title">Belum ada laporan ditemukan</div><div class="empty-state-sub">Coba ubah filter Safety Officer atau periode.</div></div></td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr class="clickable-row" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>
                    <td>${row.no}</td>
                    <td>${formatDate(row.tanggal_temuan)}</td>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">${escapeHtml(initials(row.nama_so))}</div>
                            <div><div class="td-name-main">${escapeHtml(row.nama_so)}</div><div class="td-name-sub">${escapeHtml(row.badge_so)}</div></div>
                        </div>
                    </td>
                    <td>${escapeHtml(row.item_temuan)}</td>
                    <td><span class="status-pill ${jenisPillClass(row.jenis_penyebab)}">${escapeHtml(row.jenis_penyebab)}</span></td>
                    <td><span class="status-pill ${statusPillClass(row.status_temuan)}">${row.status_temuan}</span></td>
                    <td><span class="status-pill ${keputusanPillClass(row.keputusan)}">${row.keputusan}</span></td>
                    <td style="text-align:center; white-space:nowrap;" onclick="event.stopPropagation()">
                        ${row.keputusan === 'PENDING' ? `
                                    <button
                                        class="btn-outline"
                                        style="padding:5px 8px; color:#1A7A3C; border-color:rgba(26,122,60,0.25);"
                                        onclick='setKeputusan(${row.id}, "APPROVE", ${JSON.stringify(row.item_temuan)})'>
                                        Approve
                                    </button>
                                    <button
                                        class="btn-outline"
                                        style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);"
                                        onclick='setKeputusan(${row.id}, "REJECT", ${JSON.stringify(row.item_temuan)})'>
                                        Reject
                                    </button>                                    ` : `
                                            <button class="btn-outline" style="padding:5px 8px;" onclick="setKeputusan(${row.id}, 'PENDING', ${JSON.stringify(row.item_temuan)})">Reset ke Pending</button>
                                        `}
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-outline" style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);" onclick="deleteData(${row.id}, ${JSON.stringify(row.item_temuan)})">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent = meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> laporan ditemukan`;
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
            Object.entries(state).forEach(([k, v]) => {
                if (v) params.set(k, v);
            });
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
                updateSummary(json.meta);
                populateTahunOptions((json.filter_options?.tahun || []).map(t => parseInt(t, 10)));
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="7"><div class="error-state">${escapeHtml(e.message)}</div></td></tr>`;
            }
        }



        // ══════ MODAL DETAIL ══════
        function detailField(label, value) {
            return `<div class="detail-field"><label>${label}</label><div class="val">${escapeHtml(value ?? '-')}</div></div>`;
        }

        function openDetailModal(row) {
            document.getElementById('detailItemTitle').textContent = row.item_temuan || '-';
            document.getElementById('detailSoSub').textContent =
                `${row.nama_so} (${row.badge_so}) · ${formatDate(row.tanggal_temuan)}`;

            let docLinks = '';
            if (row.foto_temuan_url) docLinks +=
                `<a href="${row.foto_temuan_url}" target="_blank" class="btn-outline" style="padding:5px 10px; font-size:11px; margin-right:6px;">Lihat Foto Temuan</a>`;
            if (row.dokumen_laporan_url) docLinks +=
                `<a href="${row.dokumen_laporan_url}" target="_blank" class="btn-outline" style="padding:5px 10px; font-size:11px;">Lihat Dokumen</a>`;

            document.getElementById('detailModalBody').innerHTML = `
                <div class="detail-section">
                    <div class="detail-section-title">Informasi Temuan</div>
                    <div class="detail-grid">
                        ${detailField('Area Kerja', row.area_kerja)}
                        ${detailField('Unit Kerja', row.unit_kerja)}
                        ${detailField('Jenis Penyebab', row.jenis_penyebab)}
                        ${detailField('Status Temuan', row.status_temuan)}
                        ${detailField('Status Keputusan', row.keputusan)} <!-- BARU -->
                    </div>
                </div>
                <div class="detail-section">
                    <div class="detail-section-title">Deskripsi &amp; Rekomendasi</div>
                    <div class="detail-grid">
                        <div class="detail-field" style="grid-column: span 4;"><label>Deskripsi Temuan</label><div class="val">${escapeHtml(row.deskripsi_temuan || '-')}</div></div>
                        <div class="detail-field" style="grid-column: span 4;"><label>Rekomendasi Perbaikan</label><div class="val">${escapeHtml(row.rekomendasi_perbaikan || '-')}</div></div>
                    </div>
                </div>
                ${docLinks ? `<div class="detail-section"><div class="detail-section-title">Dokumen Pendukung</div>${docLinks}</div>` : ''}
            `;
            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(e) {
            if (e.target.id === 'detailModalOverlay') closeDetailModal();
        }

        // ══════ PICKER SO (form) ══════
        let soPickerDebounce = null;

        function onSoPickerInput() {
            clearTimeout(soPickerDebounce);
            soPickerDebounce = setTimeout(searchSoPicker, 350);
        }

        async function searchSoPicker() {
            const search = document.getElementById('soPickerInput').value.trim();
            const dropdown = document.getElementById('soPickerDropdown');
            if (search.length < 2) {
                dropdown.classList.remove('open');
                return;
            }
            try {
                const res = await fetch(`${CARI_SO_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                dropdown.innerHTML = (!json.data || json.data.length === 0) ?
                    `<div class="picker-item" style="color:#94A3B8;">Tidak ada Safety Officer ditemukan.</div>` :
                    json.data.map(so =>
                        `<div class="picker-item" onclick='pilihSo(${JSON.stringify(so).replace(/'/g, "&#39;")})'><div class="picker-item-name">${escapeHtml(so.nama)}</div><div class="picker-item-sub">${escapeHtml(so.badge)} · ${escapeHtml(so.unit_kerja)}</div></div>`
                    ).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihSo(so) {
            document.getElementById('fBadgeSo').value = so.badge;
            document.getElementById('fNamaSo').value = so.nama;
            document.getElementById('fUnitKerja').value = so.unit_kerja;
            document.getElementById('soPickerInput').value = `${so.nama} (${so.badge})`;
            document.getElementById('soPickerDropdown').classList.remove('open');
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('soPickerInput')?.closest('.picker-wrap');
            if (wrap && !wrap.contains(e.target)) document.getElementById('soPickerDropdown')?.classList.remove(
                'open');
        });

        // ══════ MODAL FORM ══════
        function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            document.getElementById('formModalTitle').textContent = row ? 'Edit Laporan Temuan' : 'Tambah Laporan Temuan';

            document.getElementById('soPickerInput').value = row ? `${row.nama_so} (${row.badge_so})` : '';
            document.getElementById('fBadgeSo').value = row?.badge_so && row.badge_so !== '-' ? row.badge_so : '';
            document.getElementById('fNamaSo').value = row?.nama_so && row.nama_so !== '-' ? row.nama_so : '';
            document.getElementById('fTanggalTemuan').value = row?.tanggal_temuan || '';
            document.getElementById('fAreaKerja').value = row?.area_kerja && row.area_kerja !== '-' ? row.area_kerja : '';
            document.getElementById('fUnitKerja').value = row?.unit_kerja && row.unit_kerja !== '-' ? row.unit_kerja : '';
            document.getElementById('fJenisPenyebab').value = row?.jenis_penyebab && row.jenis_penyebab !== '-' ? row
                .jenis_penyebab : 'Unsafe Action';
            document.getElementById('fItemTemuan').value = row?.item_temuan && row.item_temuan !== '-' ? row.item_temuan :
                '';
            document.getElementById('fDeskripsiTemuan').value = row?.deskripsi_temuan && row.deskripsi_temuan !== '-' ? row
                .deskripsi_temuan : '';
            document.getElementById('fRekomendasiPerbaikan').value = row?.rekomendasi_perbaikan && row
                .rekomendasi_perbaikan !== '-' ? row.rekomendasi_perbaikan : '';
            document.getElementById('fStatusTemuan').value = row?.status_temuan || 'OPEN';
            document.getElementById('fFotoTemuan').value = '';
            document.getElementById('fDokumenLaporan').value = '';

            document.getElementById('formModalOverlay').classList.add('open');
        }

        function closeFormModal() {
            document.getElementById('formModalOverlay').classList.remove('open');
            currentEditId = null;
        }

        function closeFormModalOutside(e) {
            if (e.target.id === 'formModalOverlay') closeFormModal();
        }

        async function submitForm() {
            const btn = document.getElementById('btnSubmitForm');
            btn.disabled = true;
            const originalText = btn.textContent;
            btn.textContent = 'Menyimpan...';

            const formData = new FormData();
            formData.append('badge_so', document.getElementById('fBadgeSo').value);
            formData.append('nama_so', document.getElementById('fNamaSo').value);
            formData.append('tanggal_temuan', document.getElementById('fTanggalTemuan').value || '');
            formData.append('area_kerja', document.getElementById('fAreaKerja').value);
            formData.append('unit_kerja', document.getElementById('fUnitKerja').value);
            formData.append('jenis_penyebab', document.getElementById('fJenisPenyebab').value);
            formData.append('item_temuan', document.getElementById('fItemTemuan').value);
            formData.append('deskripsi_temuan', document.getElementById('fDeskripsiTemuan').value);
            formData.append('rekomendasi_perbaikan', document.getElementById('fRekomendasiPerbaikan').value);
            formData.append('status_temuan', document.getElementById('fStatusTemuan').value);

            const fotoFile = document.getElementById('fFotoTemuan').files[0];
            if (fotoFile) formData.append('foto_temuan', fotoFile);
            const dokFile = document.getElementById('fDokumenLaporan').files[0];
            if (dokFile) formData.append('dokumen_laporan', dokFile);

            if (currentEditId) formData.append('_method', 'PUT');
            const url = currentEditId ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;

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

        async function setKeputusan(id, keputusan, item) {
            const label = keputusan === 'APPROVE' ? 'menyetujui' : keputusan === 'REJECT' ? 'menolak' :
                'mengembalikan ke pending';
            if (!confirm(`Yakin ingin ${label} laporan "${item}"?`)) return;

            try {
                const res = await fetch(`${BASE_ENDPOINT}/${id}/keputusan`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        keputusan
                    }),
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);
                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal mengubah status keputusan.', 'error');
            }
        }

        async function deleteData(id, item) {
            if (!confirm(`Hapus laporan temuan "${item}"?`)) return;
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

        document.addEventListener('DOMContentLoaded', () => {
            loadSoDropdown();
            loadData();
        });
    </script>
</body>

</html>
