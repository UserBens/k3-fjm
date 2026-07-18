<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Stok Alkes — PT. Fokus Jasa Mitra</title>
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
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-row-action:hover {
            background: #F8F9FF;
        }

        .form-modal-box {
            width: 680px;
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
                            <span class="pg-eyebrow">Master Data · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DATA STOK <span>ALKES</span></div>
                        <div class="pg-sub">Kelola master data &amp; stok Alat Kesehatan.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Alkes
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
                        <input type="text" id="searchInput" placeholder="Cari jenis alat, merk, nomor seri..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterKategori" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Kategori</option>
                    </select>

                    <select id="filterKondisi" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Kondisi</option>
                    </select>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                    </select>

                    <select id="filterSupplier" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Supplier</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data stok alkes...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Data Alat</th>
                                <th>Fungsi &amp; Spesifikasi</th>
                                <th>Stok</th>
                                <th>Kalibrasi &amp; Garansi</th>
                                <th>Harga &amp; Supplier</th>
                                <th>Kondisi &amp; Status</th>
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

    <!-- ══════ MODAL TAMBAH / EDIT ALKES ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Alkes</div>
                <div class="detail-subtitle" id="formModalSub">Lengkapi data master &amp; stok di bawah ini.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Data Umum</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Kode Alkes</label>
                        <input
                            type="text"
                            id="fKodeAlkes"
                            class="form-input"
                            readonly
                            placeholder="Otomatis dibuat">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Alat</label>
                        <input type="text" id="fJenisAlat" class="form-input" placeholder="Tensimeter Digital" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select id="fKategori" class="form-select">
                            <option value="Diagnostik">Diagnostik</option>
                            <option value="Monitoring">Monitoring</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Terapi">Terapi</option>
                            <option value="Emergency">Emergency</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Merk</label>
                        <input type="text" id="fMerk" class="form-input" placeholder="Omron, Riester, dsb" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <input type="text" id="fType" class="form-input" placeholder="HEM-7120" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Nomor Seri</label>
                        <input type="text" id="fNomorSeri" class="form-input"
                            placeholder="Kosongkan jika tidak ada" />
                    </div>
                </div>

                <div class="form-section-title">Fungsi &amp; Spesifikasi</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">Fungsi Pemeriksaan</label>
                        <textarea id="fFungsiPemeriksaan" class="form-textarea" rows="2"
                            placeholder="Mengukur tekanan darah sistolik & diastolik"></textarea>
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Spesifikasi Teknis</label>
                        <textarea id="fSpesifikasiTeknis" class="form-textarea" rows="2"
                            placeholder="Akurasi ±3mmHg, range 0-299mmHg"></textarea>
                    </div>
                </div>

                <div class="form-section-title">Stok</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Stok Awal</label>
                        <input type="number" min="0" id="fStokAwal" class="form-input" placeholder="0" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Digunakan</label>
                        <input type="number" min="0" id="fDigunakan" class="form-input" placeholder="0" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Rusak</label>
                        <input type="number" min="0" id="fRusak" class="form-input" placeholder="0" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Reorder Point</label>
                        <input type="number" min="0" id="fReorderPoint" class="form-input"
                            placeholder="0" />
                    </div>
                </div>

                <div class="form-section-title">Kalibrasi &amp; Garansi</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Tanggal Kalibrasi</label>
                        <input type="date" id="fTanggalKalibrasi" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jadwal Kalibrasi Berikut</label>
                        <input type="date" id="fJadwalKalibrasiBerikut" class="form-input" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Masa Garansi</label>
                        <input type="date" id="fMasaGaransi" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Expired</label>
                        <input
                            type="date"
                            id="fTanggalExp"
                            class="form-input">
                    </div>
                </div>

                <div class="form-section-title">Harga &amp; Pengadaan</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Harga Satuan (Rp)</label>
                        <input type="number" min="0" id="fHargaSatuan" class="form-input"
                            placeholder="0" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Supplier</label>
                        <input type="text" id="fSupplier" class="form-input"
                            placeholder="PT. Medika Sejahtera" />
                    </div>
                </div>

                <div class="form-section-title">Kondisi &amp; Status</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Kondisi</label>
                        <select id="fKondisi" class="form-select">
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                            <option value="Perlu Kalibrasi">Perlu Kalibrasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select id="fStatus" class="form-select">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Keterangan</label>
                        <textarea id="fKeterangan" class="form-textarea" rows="2" placeholder="Catatan tambahan"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:18px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL ALKES ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar" id="detailAvatar">--</div>
                    <div>
                        <div class="modal-title" id="detailJenisTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailNomorSeriSub">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-section-title" style="margin-top:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Data Umum
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>Kode Alkes</label>
                            <input type="text" id="dKodeAlkes" readonly>
                        </div>
                        <div class="detail-field"><label>Nomor Seri</label><input type="text" id="dNomorSeri"
                                readonly></div>
                        <div class="detail-field"><label>Kategori</label><input type="text" id="dKategori"
                                readonly></div>
                        <div class="detail-field"><label>Merk</label><input type="text" id="dMerk" readonly>
                        </div>
                        <div class="detail-field"><label>Type</label><input type="text" id="dType" readonly>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Fungsi &amp; Spesifikasi
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field span-2"><label>Fungsi Pemeriksaan</label>
                            <textarea id="dFungsiPemeriksaan" readonly rows="2"></textarea>
                        </div>
                        <div class="detail-field span-2"><label>Spesifikasi Teknis</label>
                            <textarea id="dSpesifikasiTeknis" readonly rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Stok
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field"><label>Stok Awal</label><input type="text" id="dStokAwal"
                                readonly></div>
                        <div class="detail-field"><label>Digunakan</label><input type="text" id="dDigunakan"
                                readonly></div>
                        <div class="detail-field"><label>Rusak</label><input type="text" id="dRusak" readonly>
                        </div>
                        <div class="detail-field"><label>Stok Tersedia</label><input type="text"
                                id="dStokTersedia" readonly></div>
                        <div class="detail-field"><label>Reorder Point</label><input type="text"
                                id="dReorderPoint" readonly></div>
                        <div class="detail-field"><label>Status Stok</label><input type="text" id="dStatusStok"
                                readonly></div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kalibrasi &amp; Garansi
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field"><label>Tanggal Kalibrasi</label><input type="text"
                                id="dTanggalKalibrasi" readonly></div>
                        <div class="detail-field"><label>Jadwal Kalibrasi Berikut</label><input type="text"
                                id="dJadwalKalibrasiBerikut" readonly></div>
                        <div class="detail-field">
                            <label>Tanggal Expired</label>
                            <input type="text" id="dTanggalExp" readonly>
                        </div>
                        <div class="detail-field span-2"><label>Masa Garansi</label><input type="text"
                                id="dMasaGaransi" readonly></div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Harga &amp; Pengadaan
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field"><label>Harga Satuan</label><input type="text" id="dHargaSatuan"
                                readonly></div>
                        <div class="detail-field"><label>Supplier</label><input type="text" id="dSupplier"
                                readonly></div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kondisi &amp; Status
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field"><label>Kondisi</label><input type="text" id="dKondisi"
                                readonly></div>
                        <div class="detail-field"><label>Status</label><input type="text" id="dStatus" readonly>
                        </div>
                        <div class="detail-field span-2"><label>Keterangan</label>
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
            <div class="modal-title">Hapus Data Alkes?</div>
            <div class="modal-desc" id="deleteModalDesc">Data yang sudah dihapus tidak dapat dikembalikan. Pastikan
                Anda yakin sebelum melanjutkan.</div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('master-stok-alkes.data') }}";
        const STORE_ENDPOINT = "{{ route('master-stok-alkes.store') }}";
        const BASE_ENDPOINT = "{{ url('/master-stok-alkes') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            kategori: '',
            kondisi: '',
            status: '',
            supplier: '',
            page: 1,
            per_page: 10
        };

        let searchDebounce = null;
        let filterOptionsLoaded = false;
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

        function formatRupiah(v) {
            const num = Number(v) || 0;
            return 'Rp ' + num.toLocaleString('id-ID', {
                maximumFractionDigits: 0
            });
        }

        function statusStokPillClass(s) {
            return s === 'REORDER' ? 'sp-red' : 'sp-green';
        }

        function statusAktifPillClass(s) {
            return s === 'Aktif' ? 'sp-green' : 'sp-gray';
        }

        function kondisiPillClass(k) {
            if (k === 'Baik') return 'sp-green';
            if (k === 'Rusak Ringan') return 'sp-amber';
            if (k === 'Rusak Berat') return 'sp-red';
            if (k === 'Perlu Kalibrasi') return 'sp-blue';
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
            state.kategori = document.getElementById('filterKategori').value;
            state.kondisi = document.getElementById('filterKondisi').value;
            state.status = document.getElementById('filterStatus').value;
            state.supplier = document.getElementById('filterSupplier').value;
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
            document.getElementById('filterKategori').value = '';
            document.getElementById('filterKondisi').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterSupplier').value = '';
            Object.assign(state, {
                search: '',
                kategori: '',
                kondisi: '',
                status: '',
                supplier: '',
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

        function populateFilterOptions(options) {
            if (filterOptionsLoaded || !options) return;
            const build = (id, values) => {
                const select = document.getElementById(id);
                values.forEach(v => {
                    const o = document.createElement('option');
                    o.value = v;
                    o.textContent = v;
                    select.appendChild(o);
                });
            };
            build('filterKategori', options.kategori || []);
            build('filterKondisi', options.kondisi || []);
            build('filterStatus', options.status || []);
            build('filterSupplier', options.supplier || []);
            filterOptionsLoaded = true;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
                <tr><td colspan="7">
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <div class="empty-state-title">Data tidak ditemukan</div>
                        <div class="empty-state-sub">Coba ubah kata kunci pencarian atau filter yang digunakan.</div>
                    </div>
                </td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">${escapeHtml(initials(row.jenis_alat))}</div>
                            <div>
                                <div class="td-name-main">${escapeHtml(row.jenis_alat)}</div>
                                <div class="td-name-sub">
                                    <strong>${escapeHtml(row.kode_alkes || '-')}</strong>
                                </div>
                                <div class="td-name-sub">
                                    <span style="font-weight:600; color:#475569;">${escapeHtml(row.nomor_seri || '-')}</span>
                                    · <span class="status-pill sp-blue" style="margin-left:2px;">${escapeHtml(row.kategori)}</span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td style="max-width:220px;">
                        <div class="td-name-sub" style="white-space:normal; line-height:1.4; color:#334155; font-weight:600; margin-bottom:3px;">
                            ${escapeHtml(row.fungsi_pemeriksaan || '-')}
                        </div>
                        <div class="td-name-sub" style="white-space:normal; line-height:1.4;">${escapeHtml(row.spesifikasi_teknis || '-')}</div>
                        <div class="td-name-sub" style="margin-top:3px;">${escapeHtml(row.merk || '-')} ${row.type ? '· ' + escapeHtml(row.type) : ''}</div>
                    </td>

                    <td>
                        <div class="stok-line">Awal: <b>${row.stok_awal}</b></div>
                        <div class="stok-line">Pakai/Rusak: <b>${row.digunakan}</b> / <b>${row.rusak}</b></div>
                        <div class="stok-line">Tersedia: <b>${row.stok_tersedia}</b> (RP ${row.reorder_point})</div>
                        <span class="status-pill ${statusStokPillClass(row.status_stok)}">${row.status_stok}</span>
                    </td>

                    <td>
                        <div class="td-name-sub">Kalibrasi: ${formatDate(row.tanggal_kalibrasi)}</div>
                        <div class="td-name-sub">Berikutnya: ${formatDate(row.jadwal_kalibrasi_berikut)}</div>
                        <div class="td-name-sub">Garansi s.d: ${formatDate(row.masa_garansi)}</div>
                    </td>

                    <td>
                        <div style="font-weight:700; font-size:12.5px; margin-bottom:3px;">${formatRupiah(row.harga_satuan)}</div>
                        <div class="td-name-sub">${escapeHtml(row.supplier || '-')}</div>
                    </td>

                    <td>
                        <div style="margin-bottom:4px;"><span class="status-pill ${kondisiPillClass(row.kondisi)}">${escapeHtml(row.kondisi)}</span></div>
                        <span class="status-pill ${statusAktifPillClass(row.status)}">${escapeHtml(row.status)}</span>
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
                        <button class="btn-row-action" onclick="openDeleteModal(${row.id}, '${escapeHtml(row.jenis_alat)}')">
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
            <tr><td colspan="7">
                <div class="error-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                    </svg>
                    <div class="error-state-title">Gagal memuat data</div>
                    <div class="error-state-sub">${escapeHtml(message)}</div>
                </div>
            </td></tr>`;
            document.getElementById('paginationText').textContent = '—';
            document.getElementById('paginationPages').innerHTML = '';
            document.getElementById('dataSummary').textContent = 'Gagal memuat data stok alkes.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent = meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> jenis alkes ditemukan`;
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
            if (state.kategori) params.set('kategori', state.kategori);
            if (state.kondisi) params.set('kondisi', state.kondisi);
            if (state.status) params.set('status', state.status);
            if (state.supplier) params.set('supplier', state.supplier);
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

            document.getElementById('formModalTitle').textContent = row ? 'Edit Data Alkes' : 'Tambah Alkes';
            document.getElementById('formModalSub').textContent = row ? `Perbarui data untuk ${row.jenis_alat}` :
                'Lengkapi data master & stok di bawah ini.';
            document.getElementById('fKodeAlkes').value = row?.kode_alkes || '';
            document.getElementById('fJenisAlat').value = row?.jenis_alat || '';
            document.getElementById('fKategori').value = row?.kategori || 'Lainnya';
            document.getElementById('fMerk').value = row?.merk || '';
            document.getElementById('fType').value = row?.type || '';
            document.getElementById('fNomorSeri').value = row?.nomor_seri || '';
            document.getElementById('fFungsiPemeriksaan').value = row?.fungsi_pemeriksaan || '';
            document.getElementById('fSpesifikasiTeknis').value = row?.spesifikasi_teknis || '';
            document.getElementById('fStokAwal').value = row?.stok_awal ?? 0;
            document.getElementById('fDigunakan').value = row?.digunakan ?? 0;
            document.getElementById('fRusak').value = row?.rusak ?? 0;
            document.getElementById('fReorderPoint').value = row?.reorder_point ?? 0;
            document.getElementById('fTanggalKalibrasi').value = row?.tanggal_kalibrasi ? row.tanggal_kalibrasi.substring(0,
                10) : '';
            document.getElementById('fJadwalKalibrasiBerikut').value = row?.jadwal_kalibrasi_berikut ? row
                .jadwal_kalibrasi_berikut.substring(0, 10) : '';
            document.getElementById('fTanggalExp').value =
            row?.tanggal_exp
                ? row.tanggal_exp.substring(0,10)
                : '';
            document.getElementById('fMasaGaransi').value = row?.masa_garansi ? row.masa_garansi.substring(0, 10) : '';
            document.getElementById('fHargaSatuan').value = row?.harga_satuan ?? 0;
            document.getElementById('fSupplier').value = row?.supplier || '';
            document.getElementById('fKondisi').value = row?.kondisi || 'Baik';
            document.getElementById('fStatus').value = row?.status || 'Aktif';
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
                kode_alkes: document.getElementById('fKodeAlkes').value || null,
                jenis_alat: document.getElementById('fJenisAlat').value.trim(),
                kategori: document.getElementById('fKategori').value,
                merk: document.getElementById('fMerk').value.trim() || null,
                type: document.getElementById('fType').value.trim() || null,
                nomor_seri: document.getElementById('fNomorSeri').value.trim() || null,
                fungsi_pemeriksaan: document.getElementById('fFungsiPemeriksaan').value.trim() || null,
                spesifikasi_teknis: document.getElementById('fSpesifikasiTeknis').value.trim() || null,
                stok_awal: document.getElementById('fStokAwal').value || 0,
                digunakan: document.getElementById('fDigunakan').value || 0,
                rusak: document.getElementById('fRusak').value || 0,
                reorder_point: document.getElementById('fReorderPoint').value || 0,
                tanggal_kalibrasi: document.getElementById('fTanggalKalibrasi').value || null,
                jadwal_kalibrasi_berikut: document.getElementById('fJadwalKalibrasiBerikut').value || null,
                tanggal_exp: document.getElementById('fTanggalExp').value || null,
                masa_garansi: document.getElementById('fMasaGaransi').value || null,
                harga_satuan: document.getElementById('fHargaSatuan').value || 0,
                supplier: document.getElementById('fSupplier').value.trim() || null,
                kondisi: document.getElementById('fKondisi').value,
                status: document.getElementById('fStatus').value,
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
                        'X-CSRF-TOKEN': CSRF_TOKEN
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
            document.getElementById('dKodeAlkes').value = row.kode_alkes || '-';
            document.getElementById('detailAvatar').textContent = initials(row.jenis_alat);
            document.getElementById('detailJenisTitle').textContent = row.jenis_alat || '-';
            document.getElementById('detailNomorSeriSub').textContent = row.nomor_seri || '-';

            document.getElementById('dNomorSeri').value = row.nomor_seri || '-';
            document.getElementById('dKategori').value = row.kategori || '-';
            document.getElementById('dMerk').value = row.merk || '-';
            document.getElementById('dType').value = row.type || '-';

            document.getElementById('dFungsiPemeriksaan').value = row.fungsi_pemeriksaan || '-';
            document.getElementById('dSpesifikasiTeknis').value = row.spesifikasi_teknis || '-';

            document.getElementById('dStokAwal').value = row.stok_awal;
            document.getElementById('dDigunakan').value = row.digunakan;
            document.getElementById('dRusak').value = row.rusak;
            document.getElementById('dStokTersedia').value = row.stok_tersedia;
            document.getElementById('dReorderPoint').value = row.reorder_point;
            document.getElementById('dStatusStok').value = row.status_stok;

            document.getElementById('dTanggalKalibrasi').value = formatDate(row.tanggal_kalibrasi);
            document.getElementById('dJadwalKalibrasiBerikut').value = formatDate(row.jadwal_kalibrasi_berikut);
            document.getElementById('dTanggalExp').value = formatDate(row.tanggal_exp);
            document.getElementById('dMasaGaransi').value = formatDate(row.masa_garansi);

            document.getElementById('dHargaSatuan').value = formatRupiah(row.harga_satuan);
            document.getElementById('dSupplier').value = row.supplier || '-';

            document.getElementById('dKondisi').value = row.kondisi || '-';
            document.getElementById('dStatus').value = row.status || '-';
            document.getElementById('dKeterangan').value = row.keterangan || '-';

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        // ══════ MODAL HAPUS ══════
        function openDeleteModal(id, nama) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Data "${nama}" akan dihapus permanen dan tidak dapat dikembalikan. Lanjutkan?`;
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
                if (!res.ok) throw new Error(json.message || `Server merespons dengan status ${res.status}`);
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
