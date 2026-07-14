<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Medis — PT. Fokus Jasa Mitra</title>
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
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- ══════ SIDEBAR ══════ -->
    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- ══════ MAIN ══════ -->
    <div id="main-content">

        <!-- TOPBAR -->
        @include('partials.topbar')

        <!-- PAGE CONTENT -->
        <div id="page-content">

            <!-- PAGE HEADER -->
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Data Medis · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DATA <span>MEDIS</span></div>
                        <div class="pg-sub">Kelola data medis tenaga media & keputusan persetujuan.</div>
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

            <!-- FILTER BAR -->
            <div class="section-card" style="margin-bottom:14px;">
                <div class="filter-bar">
                    <div class="filter-search">
                        <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari berdasarkan nama tenaga atau badge..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterAreaKerja" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Area Kerja</option>
                    </select>

                    <select id="filterStatusPindah" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status Pindah</option>
                    </select>

                    <select id="filterKeputusan" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Keputusan</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data Medis...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Tenaga Medis</th>
                                <th>Kegiatan</th>
                                <th>Tgl Pelaksanaan</th>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Keputusan</th>
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

    <!-- ══════ MODAL TAMBAH / EDIT LAPORAN KPI ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Laporan KPI</div>
                <div class="detail-subtitle" id="formModalSub">Lengkapi data laporan aktivitas KPI di bawah ini.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Data Tenaga & Waktu</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">Tenaga Medis</label>
                        <div class="picker-wrap" id="tenagaPickerWrap">
                            <input type="text" id="tenagaPickerInput" class="form-input"
                                placeholder="Cari nama atau badge tenaga medis..." oninput="onTenagaPickerInput()"
                                autocomplete="off" />
                            <div class="picker-dropdown" id="tenagaPickerDropdown"></div>
                        </div>
                        <div class="picker-selected-chip" id="tenagaSelectedChip" style="display:none;">
                            <div>
                                <div class="chip-name" id="tenagaSelectedName">-</div>
                                <div class="chip-sub" id="tenagaSelectedSub">-</div>
                            </div>
                            <button type="button" class="picker-clear-btn" onclick="clearTenagaPicker()">Ganti
                                Tenaga</button>
                        </div>
                        <input type="hidden" id="fBadgeTenaga" />
                        <input type="hidden" id="fNamaTenaga" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" id="fTanggalPelaksanaan" class="form-input" />
                    </div>
                </div>

                <div class="form-section-title">Area & Aktivitas</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Area Kerja</label>
                        <input type="text" id="fAreaKerja" class="form-input" placeholder="PABRIK III B" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Unit Kerja</label>
                        <input type="text" id="fUnitKerja" class="form-input"
                            placeholder="ALAT BERAT EXISTING" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Jenis Aktivitas KPI</label>
                        <input type="text" id="fJenisAktifitas" class="form-input"
                            placeholder="[E.1] Laporan DCU" />
                    </div>
                </div>

                <div class="form-section-title">Evidence & Arsip</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">Foto Evidence Kegiatan</label>
                        <input type="file" id="fFotoEvidence" class="form-input"
                            style="padding:8px 12px; height:auto;" accept=".jpg,.jpeg,.png,.webp" />
                        <a href="#" id="fFotoEvidenceCurrent" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file saat ini ↗</a>
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Upload Formulir Kegiatan</label>
                        <input type="file" id="fFormulirKegiatan" class="form-input"
                            style="padding:8px 12px; height:auto;" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                        <a href="#" id="fFormulirKegiatanCurrent" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file saat ini ↗</a>
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Arsip</label>
                        <input type="file" id="fArsip" class="form-input"
                            style="padding:8px 12px; height:auto;"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx" />
                        <a href="#" id="fArsipCurrent" class="file-current-link" target="_blank"
                            style="display:none;">Lihat file saat ini ↗</a>
                    </div>
                </div>

                <div class="form-section-title">Status</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Status Pindah</label>
                        <select id="fStatusPindah" class="form-select">
                            <option value="PENDING">PENDING</option>
                            <option value="SUKSES">SUKSES</option>
                            <option value="GAGAL">GAGAL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Keputusan</label>
                        <select id="fKeputusan" class="form-select">
                            <option value="PENDING">PENDING</option>
                            <option value="APPROVE">APPROVE</option>
                            <option value="REJECT">REJECT</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:18px;">
                <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL DETAIL LAPORAN KPI ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar" id="detailAvatar">--</div>
                    <div>
                        <div class="modal-title" id="detailNamaTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailBadgeSub">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-section-title mt-2">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Waktu & Area
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>Tanggal Pelaksanaan</label>
                            <input type="text" id="dTanggalPelaksanaan" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Waktu Submit</label>
                            <input type="text" id="dWaktuSubmit" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Area Kerja</label>
                            <input type="text" id="dAreaKerja" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Unit Kerja</label>
                            <input type="text" id="dUnitKerja" readonly>
                        </div>
                        <div class="detail-field span-2">
                            <label>Jenis Aktivitas KPI</label>
                            <input type="text" id="dJenisAktifitas" readonly>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h16" />
                        </svg>
                        Evidence & Arsip
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field span-2" id="dFotoEvidenceWrap">
                            <label>Foto Evidence Kegiatan</label>
                        </div>
                        <div class="detail-field span-2" id="dFormulirWrap">
                            <label>Upload Formulir Kegiatan</label>
                        </div>
                        <div class="detail-field span-2" id="dLinkArsipWrap">
                            <label>Link Arsip</label>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status
                    </div>
                    <div class="detail-form-grid">
                        <div class="detail-field">
                            <label>Status Pindah</label>
                            <input type="text" id="dStatusPindah" readonly>
                        </div>
                        <div class="detail-field">
                            <label>Keputusan</label>
                            <input type="text" id="dKeputusan" readonly>
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
            <div class="modal-title">Hapus Laporan KPI?</div>
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
        const DATA_ENDPOINT = "{{ route('data-medis.data') }}";
        const STORE_ENDPOINT = "{{ route('data-medis.store') }}";
        const BASE_ENDPOINT = "{{ url('/data-medis') }}";
        const CARI_TENAGA_ENDPOINT = "{{ route('data-medis.cari-tenaga') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            area_kerja: '',
            status_pindah: '',
            keputusan: '',
            page: 1,
            per_page: 10,
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
            const parts = name.trim().split(/\s+/);
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

        function formatDateTime(dateStr) {
            if (!dateStr) return '-';
            const d = new Date(dateStr.replace(' ', 'T'));
            if (isNaN(d.getTime())) return dateStr;
            return d.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function statusPindahPillClass(status) {
            if (status === 'SUKSES') return 'sp-green';
            if (status === 'GAGAL') return 'sp-red';
            return 'sp-amber';
        }

        function keputusanPillClass(keputusan) {
            if (keputusan === 'APPROVE') return 'sp-green';
            if (keputusan === 'REJECT') return 'sp-red';
            return 'sp-amber';
        }

        function renderLinkList(rawLinks) {
            if (!rawLinks) return '<span class="link-line empty">Belum ada link</span>';
            const links = rawLinks.split(/\r?\n/).map(l => l.trim()).filter(Boolean);
            if (links.length === 0) return '<span class="link-line empty">Belum ada link</span>';
            return links.map((link, i) =>
                `<a class="link-line" href="${escapeHtml(link)}" target="_blank" rel="noopener">Link Arsip ${links.length > 1 ? (i + 1) : ''}</a>`
            ).join('');
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
            state.area_kerja = document.getElementById('filterAreaKerja').value;
            state.status_pindah = document.getElementById('filterStatusPindah').value;
            state.keputusan = document.getElementById('filterKeputusan').value;
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
            document.getElementById('filterAreaKerja').value = '';
            document.getElementById('filterStatusPindah').value = '';
            document.getElementById('filterKeputusan').value = '';
            state.search = '';
            state.area_kerja = '';
            state.status_pindah = '';
            state.keputusan = '';
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

            build('filterAreaKerja', options.area_kerja || []);
            build('filterStatusPindah', options.status_pindah || []);
            build('filterKeputusan', options.keputusan || []);
            filterOptionsLoaded = true;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="7"><div class="empty-state"><div class="empty-state-title">Data tidak ditemukan</div></div></td></tr>`;
                return;
            }
            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">${escapeHtml(initials(row.nama_tenaga))}</div>
                            <div>
                                <div class="td-name-main">${escapeHtml(row.nama_tenaga)}</div>
                                <div class="td-name-sub">${escapeHtml(row.badge_tenaga)}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600; font-size:12.5px;">${escapeHtml(row.jenis_aktifitas_kpi)}</div>
                        <div class="td-name-sub">${escapeHtml(row.area_kerja)} · ${escapeHtml(row.unit_kerja)}</div>
                    </td>
                    <td>${formatDate(row.tanggal_pelaksanaan)}</td>
                    <td>
                        ${row.foto_evidence_url ? `<a href="${row.foto_evidence_url}" target="_blank" class="btn-outline" style="padding:3px 8px; font-size:10px; margin-right:4px;">Foto</a>` : ''}
                        ${row.formulir_kegiatan_url ? `<a href="${row.formulir_kegiatan_url}" target="_blank" class="btn-outline" style="padding:3px 8px; font-size:10px; margin-right:4px;">Formulir</a>` : ''}
                        ${row.arsip_url ? `<a href="${row.arsip_url}" target="_blank" class="btn-outline" style="padding:3px 8px; font-size:10px;">Arsip</a>` : ''}
                        ${!row.foto_evidence_url && !row.formulir_kegiatan_url && !row.arsip_url ? '<span class="td-name-sub">Belum ada dokumen</span>' : ''}
                    </td>
                    <td><span class="status-pill ${row.status_pindah === 'SUKSES' ? 'sp-green' : row.status_pindah === 'GAGAL' ? 'sp-red' : 'sp-amber'}">${row.status_pindah}</span></td>
                    <td><span class="status-pill ${row.keputusan === 'APPROVE' ? 'sp-green' : row.keputusan === 'REJECT' ? 'sp-red' : 'sp-amber'}">${row.keputusan}</span></td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-outline" style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);" onclick="deleteData(${row.id}, ${JSON.stringify(row.nama_tenaga)})">Hapus</button>
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
            document.getElementById('dataSummary').textContent = 'Gagal memuat data medis.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';

            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> data medis ditemukan`;

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
            if (state.area_kerja) params.set('area_kerja', state.area_kerja);
            if (state.status_pindah) params.set('status_pindah', state.status_pindah);
            if (state.keputusan) params.set('keputusan', state.keputusan);
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

        // ══════ PICKER TENAGA MEDIS ══════
        let tenagaPickerDebounce = null;

        function onTenagaPickerInput() {
            clearTimeout(tenagaPickerDebounce);
            tenagaPickerDebounce = setTimeout(searchTenagaPicker, 350);
        }

        async function searchTenagaPicker() {
            const search = document.getElementById('tenagaPickerInput').value.trim();
            const dropdown = document.getElementById('tenagaPickerDropdown');
            if (search.length < 2) {
                dropdown.classList.remove('open');
                return;
            }

            try {
                const res = await fetch(`${CARI_TENAGA_ENDPOINT}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();

                dropdown.innerHTML = (!json.data || json.data.length === 0) ?
                    `<div class="picker-item" style="color:#94A3B8;">Tidak ada tenaga ditemukan.</div>` :
                    json.data.map(t => `
                <div class="picker-item" onclick='pilihTenaga(${JSON.stringify(t).replace(/'/g, "&#39;")})'>
                    <div class="picker-item-name">${escapeHtml(t.nama)}</div>
                    <div class="picker-item-sub">${escapeHtml(t.badge)} · ${escapeHtml(t.unit_kerja)}</div>
                </div>
            `).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihTenaga(t) {
            document.getElementById('fBadgeTenaga').value = t.badge;
            document.getElementById('fNamaTenaga').value = t.nama;
            document.getElementById('fUnitKerja').value = t.unit_kerja !== '-' ? t.unit_kerja : '';
            document.getElementById('tenagaPickerDropdown').classList.remove('open');
            showTenagaChip(t.nama, t.badge);
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('tenagaPickerInput')?.closest('.picker-wrap');
            if (wrap && !wrap.contains(e.target)) {
                document.getElementById('tenagaPickerDropdown')?.classList.remove('open');
            }
        });

        // ══════ MODAL TAMBAH / EDIT ══════
        function openFormModal(row = null) {
            currentEditId = row ? row.id : null;

            document.getElementById('formModalTitle').textContent = row ? 'Edit Laporan KPI Medis' :
                'Tambah Laporan KPI Medis';
            document.getElementById('formModalSub').textContent = row ? `Perbarui data untuk ${row.nama_tenaga}` :
                'Lengkapi data kegiatan di bawah ini.';

            // Reset picker
            document.getElementById('tenagaPickerInput').value = '';
            document.getElementById('tenagaPickerDropdown').classList.remove('open');
            document.getElementById('tenagaPickerDropdown').innerHTML = '';
            document.getElementById('fBadgeTenaga').value = row?.badge_tenaga && row.badge_tenaga !== '-' ? row
                .badge_tenaga : '';
            document.getElementById('fNamaTenaga').value = row?.nama_tenaga && row.nama_tenaga !== '-' ? row.nama_tenaga :
                '';

            if (row && row.nama_tenaga && row.nama_tenaga !== '-') {
                showTenagaChip(row.nama_tenaga, row.badge_tenaga);
            } else {
                hideTenagaChip();
            }

            document.getElementById('fTanggalPelaksanaan').value = row?.tanggal_pelaksanaan || '';
            document.getElementById('fAreaKerja').value = row?.area_kerja && row.area_kerja !== '-' ? row.area_kerja : '';
            document.getElementById('fUnitKerja').value = row?.unit_kerja && row.unit_kerja !== '-' ? row.unit_kerja : '';
            document.getElementById('fJenisAktifitas').value = row?.jenis_aktifitas_kpi && row.jenis_aktifitas_kpi !== '-' ?
                row.jenis_aktifitas_kpi : '';
            document.getElementById('fStatusPindah').value = row?.status_pindah || 'PENDING';
            document.getElementById('fKeputusan').value = row?.keputusan || 'PENDING';

            // File input selalu dikosongkan; hanya terisi jika user upload file baru
            document.getElementById('fFotoEvidence').value = '';
            document.getElementById('fFormulirKegiatan').value = '';
            document.getElementById('fArsip').value = '';

            setCurrentFileLink('fFotoEvidenceCurrent', row?.foto_evidence_url);
            setCurrentFileLink('fFormulirKegiatanCurrent', row?.formulir_kegiatan_url);
            setCurrentFileLink('fArsipCurrent', row?.arsip_url);

            document.getElementById('formModalOverlay').classList.add('open');
        }

        function setCurrentFileLink(id, url) {
            const el = document.getElementById(id);
            if (url) {
                el.href = url;
                el.style.display = 'inline-block';
            } else {
                el.style.display = 'none';
            }
        }

        function showTenagaChip(nama, badge) {
            document.getElementById('tenagaSelectedName').textContent = nama;
            document.getElementById('tenagaSelectedSub').textContent = badge && badge !== '-' ? badge : '-';
            document.getElementById('tenagaSelectedChip').style.display = 'flex';
            document.getElementById('tenagaPickerWrap').style.display = 'none';
        }

        function hideTenagaChip() {
            document.getElementById('tenagaSelectedChip').style.display = 'none';
            document.getElementById('tenagaPickerWrap').style.display = 'block';
        }

        function clearTenagaPicker() {
            document.getElementById('fBadgeTenaga').value = '';
            document.getElementById('fNamaTenaga').value = '';
            document.getElementById('tenagaPickerInput').value = '';
            hideTenagaChip();
            document.getElementById('tenagaPickerInput').focus();
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

            const namaTenaga = document.getElementById('fNamaTenaga').value.trim();
            if (!namaTenaga) {
                showToast('Silakan pilih tenaga medis terlebih dahulu.', 'error');
                return;
            }

            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            const formData = new FormData();
            formData.append('badge_tenaga', document.getElementById('fBadgeTenaga').value.trim());
            formData.append('nama_tenaga', namaTenaga);
            formData.append('tanggal_pelaksanaan', document.getElementById('fTanggalPelaksanaan').value || '');
            formData.append('area_kerja', document.getElementById('fAreaKerja').value.trim());
            formData.append('unit_kerja', document.getElementById('fUnitKerja').value.trim());
            formData.append('jenis_aktifitas_kpi', document.getElementById('fJenisAktifitas').value.trim());
            formData.append('status_pindah', document.getElementById('fStatusPindah').value);
            formData.append('keputusan', document.getElementById('fKeputusan').value);

            const fotoFile = document.getElementById('fFotoEvidence').files[0];
            if (fotoFile) formData.append('foto_evidence', fotoFile);

            const formulirFile = document.getElementById('fFormulirKegiatan').files[0];
            if (formulirFile) formData.append('formulir_kegiatan', formulirFile);

            const arsipFile = document.getElementById('fArsip').files[0];
            if (arsipFile) formData.append('arsip', arsipFile);

            let url = STORE_ENDPOINT;
            if (currentEditId) {
                url = `${BASE_ENDPOINT}/${currentEditId}`;
                formData.append('_method', 'PUT'); // spoofing, karena PHP tidak parse file di request PUT asli
            }

            try {
                const res = await fetch(url, {
                    method: 'POST', // selalu POST; PUT di-spoof via _method di atas
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        // JANGAN set Content-Type manual — browser yang atur boundary multipart
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
            document.getElementById('detailAvatar').textContent = initials(row.nama_tenaga);
            document.getElementById('detailNamaTitle').textContent = row.nama_tenaga || '-';
            document.getElementById('detailBadgeSub').textContent = row.badge_tenaga || '-';

            document.getElementById('dTanggalPelaksanaan').value = formatDate(row.tanggal_pelaksanaan);
            document.getElementById('dWaktuSubmit').value = formatDateTime(row.waktu_submit);
            document.getElementById('dAreaKerja').value = row.area_kerja || '-';
            document.getElementById('dUnitKerja').value = row.unit_kerja || '-';
            document.getElementById('dJenisAktifitas').value = row.jenis_aktifitas_kpi || '-';

            const fotoWrap = document.getElementById('dFotoEvidenceWrap');
            fotoWrap.innerHTML = '<label>Foto Evidence Kegiatan</label>' + (row.foto_evidence_url ?
                `<a class="detail-link" href="${escapeHtml(row.foto_evidence_url)}" target="_blank" rel="noopener">Buka Foto Evidence ↗</a>` :
                '<input type="text" value="Belum ada foto" readonly>');

            const formulirWrap = document.getElementById('dFormulirWrap');
            formulirWrap.innerHTML = '<label>Upload Formulir Kegiatan</label>' + (row.formulir_kegiatan_url ?
                `<a class="detail-link" href="${escapeHtml(row.formulir_kegiatan_url)}" target="_blank" rel="noopener">Buka Formulir Kegiatan ↗</a>` :
                '<input type="text" value="Belum ada formulir" readonly>');

            const linkArsipWrap = document.getElementById('dLinkArsipWrap');
            if (row.link_arsip) {
                const links = row.link_arsip.split(/\r?\n/).map(l => l.trim()).filter(Boolean);
                linkArsipWrap.innerHTML = '<label>Link Arsip</label>' +
                    links.map((link, i) =>
                        `<a class="detail-link" style="margin-bottom:6px;" href="${escapeHtml(link)}" target="_blank" rel="noopener">Buka Arsip ${links.length > 1 ? (i + 1) : ''} ↗</a>`
                    ).join('');
            } else {
                linkArsipWrap.innerHTML = '<label>Link Arsip</label><input type="text" value="Belum ada arsip" readonly>';
            }

            document.getElementById('dStatusPindah').value = row.status_pindah || '-';
            document.getElementById('dKeputusan').value = row.keputusan || '-';

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        // ══════ APPROVE / REJECT CEPAT ══════
        async function setKeputusan(id, keputusan, nama) {
            const aksi = keputusan === 'APPROVE' ? 'menyetujui' : 'menolak';
            if (!confirm(`Yakin ingin ${aksi} laporan KPI milik ${nama}?`)) return;

            try {
                const res = await fetch(`${BASE_ENDPOINT}/${id}/keputusan`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    body: JSON.stringify({
                        keputusan
                    }),
                });

                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Server merespons status ${res.status}`);

                await loadData();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal memperbarui keputusan.', 'error');
            }
        }

        // ══════ MODAL HAPUS ══════
        function openDeleteModal(id, nama) {
            currentDeleteId = id;
            document.getElementById('deleteModalDesc').textContent =
                `Laporan KPI milik "${nama}" akan dihapus permanen dan tidak dapat dikembalikan. Lanjutkan?`;
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
