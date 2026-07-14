<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Safety — PT. Fokus Jasa Mitra</title>
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
                            <span class="pg-eyebrow">Master Data Safety · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DATA <span>SAFETY</span></div>
                        <div class="pg-sub">Rekap seluruh kegiatan KPI Safety — inspeksi, OBSERI, safety permit,
                            briefing, dan lainnya.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Data
                        </button>
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
                        <input type="text" id="searchInput" placeholder="Cari nama atau badge tenaga..."
                            oninput="onSearchInput()" />
                    </div>
                    <select id="filterJenis" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Jenis Aktifitas</option>
                    </select>
                    <select id="filterAreaKerja" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Area Kerja</option>
                    </select>
                    <select id="filterKeputusan" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Keputusan</option>
                    </select>
                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Tenaga</th>
                                <th>Jenis Aktifitas</th>
                                <th>Area / Unit Kerja</th>
                                <th>Tgl Pelaksanaan</th>
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

    <!-- ══════ MODAL FORM ══════ -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="modal-box form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="modal-title" id="formModalTitle">Tambah Data Safety</div>
                <div class="pg-sub" style="margin:0;">Pilih jenis aktifitas untuk menampilkan field yang sesuai.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Data Umum</div>
                <div class="category-select-wrap">
                    <label class="form-label">Jenis Aktifitas KPI</label>
                    <select id="fJenisAktifitas" class="form-select" style="width:100%;"
                        onchange="onJenisAktifitasChange()">
                        <option value="">-- Pilih Jenis Aktifitas --</option>
                        <option value="[C.1] Laporan Inspeksi Peralatan" data-category="peralatan">[C.1] Laporan
                            Inspeksi Peralatan</option>
                        <option value="Inspeksi Area Kerja" data-category="temuan">Inspeksi Area Kerja (Item Temuan)
                        </option>
                        <option value="OBSERI" data-category="observi">OBSERI</option>
                        <option value="Verifikasi Safety Permit" data-category="permit">Verifikasi Safety Permit
                        </option>
                        <option value="Laporan Nearmiss" data-category="nearmiss">Laporan Nearmiss</option>
                        <option value="Safety Briefing" data-category="briefing">Safety Briefing</option>
                        <option value="Reward / Punishment" data-category="reward">Reward / Punishment</option>
                        <option value="Sosialisasi Keselamatan Kerja" data-category="sosialisasi_keselamatan">
                            Sosialisasi Keselamatan Kerja</option>
                        <option value="Kegiatan DCU" data-category="dcu">Kegiatan DCU</option>
                        <option value="Bugar Sehat" data-category="bugar_sehat">Bugar Sehat</option>
                        <option value="Tes Keseimbangan (Romberg)" data-category="romberg">Tes Keseimbangan (Romberg)
                        </option>
                        <option value="Sosialisasi Kesehatan Kerja" data-category="sosialisasi_kesehatan">Sosialisasi
                            Kesehatan Kerja</option>
                        <option value="Inspeksi Kotak P3K" data-category="p3k">Inspeksi Kotak P3K</option>
                    </select>
                </div>

                <div class="picker-wrap" style="margin-bottom:10px;">
                    <input type="text" id="tenagaPickerInput" class="form-input"
                        placeholder="Cari nama atau badge tenaga..." oninput="onTenagaPickerInput()"
                        autocomplete="off" />

                    <div class="picker-dropdown" id="tenagaPickerDropdown"></div>

                    <!-- Hidden input -->
                    <input type="hidden" id="fBadgeTenaga">
                    <input type="hidden" id="fNamaTenaga">
                </div>
                <div class="form-grid">
                    {{-- <div class="form-group"><label class="form-label">Badge</label><input type="text"
                            id="fBadgeTenaga" class="form-input" readonly style="background:#F8FAFC;" /></div>
                    <div class="form-group span-2"><label class="form-label">Nama Tenaga</label><input type="text"
                            id="fNamaTenaga" class="form-input" readonly style="background:#F8FAFC;" /></div> --}}
                    <div class="form-group"><label class="form-label">Tanggal Pelaksanaan</label><input
                            type="date" id="fTanggalPelaksanaan" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Area Kerja</label><input type="text"
                            id="fAreaKerja" class="form-input" /></div>
                    <div class="form-group span-2"><label class="form-label">Unit Kerja</label><input type="text"
                            id="fUnitKerja" class="form-input" /></div>
                </div>

                <!-- ══════ KATEGORI: PERALATAN ══════ -->
                <div class="category-block" data-cat="peralatan">
                    <div class="form-section-title">[C.1] Inspeksi Peralatan</div>
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Kategori Peralatan</label><input
                                type="text" id="fKategoriPeralatan" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Nama Alat</label><input type="text"
                                id="fNamaAlat" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Nomor Seri / Kode Lambung</label><input
                                type="text" id="fNomorSeriAlat" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Status Alat</label><input type="text"
                                id="fStatusAlat" class="form-input" placeholder="Layak / Tidak Layak" /></div>
                        <div class="form-group span-2"><label class="form-label">Keterangan Tambahan</label>
                            <textarea id="fKeteranganTambahanAlat" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group span-2"><label class="form-label">Rekomendasi Tindakan</label>
                            <textarea id="fRekomendasiTindakanAlat" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group"><label class="form-label">Foto Alat</label><input type="file"
                                id="f_foto_alat" class="form-input" accept="image/*" /></div>
                        <div class="form-group"><label class="form-label">Formulir Inspeksi</label><input
                                type="file" id="f_formulir_inspeksi_peralatan" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_inspeksi_peralatan" class="form-input" />
                        </div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: TEMUAN / AREA KERJA ══════ -->
                <div class="category-block" data-cat="temuan">
                    <div class="form-section-title">Item Temuan (Inspeksi Area Kerja)</div>
                    <div class="form-grid">
                        <div class="form-group span-2"><label class="form-label">Item Temuan</label><input
                                type="text" id="fItemTemuan" class="form-input" /></div>
                        <div class="form-group span-2"><label class="form-label">Jenis Penyebab</label><input
                                type="text" id="fJenisPenyebab" class="form-input" /></div>
                        <div class="form-group span-4"><label class="form-label">Deskripsi Temuan</label>
                            <textarea id="fDeskripsiTemuan" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group span-4"><label class="form-label">Rekomendasi Tindakan</label>
                            <textarea id="fRekomendasiTindakanTemuan" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group"><label class="form-label">Status Temuan</label><input type="text"
                                id="fStatusTemuan" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Foto Temuan UA/UC</label><input
                                type="file" id="f_foto_temuan_uauc" class="form-input" accept="image/*" /></div>
                        <div class="form-group span-2"><label class="form-label">Formulir Kegiatan Inspeksi Area
                                Kerja</label><input type="file" id="f_formulir_kegiatan_inspeksi_area_kerja"
                                class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: OBSERI ══════ -->
                <div class="category-block" data-cat="observi">
                    <div class="form-section-title">OBSERI</div>
                    <div class="form-grid">
                        <div class="form-group span-2"><label class="form-label">Nama Subject Observasi</label><input
                                type="text" id="fNamaSubjectObservasi" class="form-input" /></div>
                        <div class="form-group span-2"><label class="form-label">Proses Kerja</label><input
                                type="text" id="fProsesKerja" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir OBSERI</label><input
                                type="file" id="f_formulir_observi" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan OBSERI</label><input
                                type="file" id="f_formulir_kegiatan_observi" class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: SAFETY PERMIT ══════ -->
                <div class="category-block" data-cat="permit">
                    <div class="form-section-title">Verifikasi Safety Permit</div>
                    <div class="form-grid">
                        <div class="form-group span-4"><label class="form-label">Pekerjaan yang akan
                                Dikerjakan</label>
                            <textarea id="fPekerjaanDikerjakan" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group"><label class="form-label">Upload Safety Permit</label><input
                                type="file" id="f_safety_permit" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan Verifikasi</label><input
                                type="file" id="f_formulir_kegiatan_verifikasi_safety_permit"
                                class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: NEARMISS ══════ -->
                <div class="category-block" data-cat="nearmiss">
                    <div class="form-section-title">Laporan Nearmiss</div>
                    <div class="form-grid">
                        <div class="form-group span-4"><label class="form-label">Keterangan Bahaya</label>
                            <textarea id="fKeteranganBahayaNearmiss" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group"><label class="form-label">Foto Temuan Bahaya</label><input
                                type="file" id="f_foto_temuan_bahaya_nearmiss" class="form-input"
                                accept="image/*" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: SAFETY BRIEFING ══════ -->
                <div class="category-block" data-cat="briefing">
                    <div class="form-section-title">Safety Briefing</div>
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Foto Pelaksanaan</label><input
                                type="file" id="f_foto_pelaksanaan_safety_briefing" class="form-input"
                                accept="image/*" /></div>
                        <div class="form-group"><label class="form-label">Foto Daftar Hadir (PDF)</label><input
                                type="file" id="f_foto_daftar_hadir_briefing" class="form-input"
                                accept=".pdf,image/*" /></div>
                        <div class="form-group span-2"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_safety_briefing" class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: REWARD/PUNISHMENT ══════ -->
                <div class="category-block" data-cat="reward">
                    <div class="form-section-title">Reward / Punishment</div>
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Nama Penerima</label><input type="text"
                                id="fNamaPenerima" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Jenis Tindakan</label><input type="text"
                                id="fJenisTindakan" class="form-input" /></div>
                        <div class="form-group span-2"><label class="form-label">Alasan Pemberian</label>
                            <textarea id="fAlasanPemberian" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group"><label class="form-label">Foto Evidence</label><input type="file"
                                id="f_foto_evidence_reward" class="form-input" accept="image/*" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_reward" class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: SOSIALISASI KESELAMATAN ══════ -->
                <div class="category-block" data-cat="sosialisasi_keselamatan">
                    <div class="form-section-title">Sosialisasi Keselamatan Kerja</div>
                    <div class="form-grid">
                        <div class="form-group span-4"><label class="form-label">Materi Sosialisasi</label>
                            <textarea id="fMateriSosialisasiKeselamatan" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group"><label class="form-label">Foto Kegiatan</label><input type="file"
                                id="f_foto_kegiatan_sosialisasi_keselamatan" class="form-input" accept="image/*" />
                        </div>
                        <div class="form-group"><label class="form-label">Formulir Presensi (PDF)</label><input
                                type="file" id="f_formulir_presensi_sosialisasi_keselamatan" class="form-input" />
                        </div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_sosialisasi_keselamatan" class="form-input" />
                        </div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: DCU ══════ -->
                <div class="category-block" data-cat="dcu">
                    <div class="form-section-title">Kegiatan DCU</div>
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Foto Kegiatan DCU</label><input
                                type="file" id="f_foto_kegiatan_dcu" class="form-input" accept="image/*" /></div>
                        <div class="form-group"><label class="form-label">Formulir Hasil Pemeriksaan</label><input
                                type="file" id="f_formulir_hasil_pemeriksaan_dcu" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_pemeriksaan_dcu" class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: BUGAR SEHAT ══════ -->
                <div class="category-block" data-cat="bugar_sehat">
                    <div class="form-section-title">Bugar Sehat</div>
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Foto Kegiatan</label><input type="file"
                                id="f_foto_kegiatan_bugar_sehat" class="form-input" accept="image/*" /></div>
                        <div class="form-group"><label class="form-label">Formulir Presensi (PDF)</label><input
                                type="file" id="f_formulir_presensi_bugar_sehat" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_bugar_sehat" class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: ROMBERG ══════ -->
                <div class="category-block" data-cat="romberg">
                    <div class="form-section-title">Tes Keseimbangan (Romberg)</div>
                    <div class="form-grid">
                        <div class="form-group span-2"><label class="form-label">Nama Pekerja</label><input
                                type="text" id="fNamaPekerjaRomberg" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Foto Kegiatan</label><input type="file"
                                id="f_foto_kegiatan_tes_keseimbangan" class="form-input" accept="image/*" /></div>
                        <div class="form-group"><label class="form-label">Formulir Hasil Pemeriksaan</label><input
                                type="file" id="f_formulir_hasil_pemeriksaan_romberg" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_tes_keseimbangan" class="form-input" /></div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: SOSIALISASI KESEHATAN ══════ -->
                <div class="category-block" data-cat="sosialisasi_kesehatan">
                    <div class="form-section-title">Sosialisasi Kesehatan Kerja</div>
                    <div class="form-grid">
                        <div class="form-group span-4"><label class="form-label">Materi Sosialisasi</label>
                            <textarea id="fMateriSosialisasiKesehatan" class="form-textarea" rows="2"></textarea>
                        </div>
                        <div class="form-group"><label class="form-label">Foto Kegiatan</label><input type="file"
                                id="f_foto_kegiatan_sosialisasi_kesehatan" class="form-input" accept="image/*" />
                        </div>
                        <div class="form-group"><label class="form-label">Formulir Presensi (PDF)</label><input
                                type="file" id="f_formulir_presensi_sosialisasi_kesehatan" class="form-input" />
                        </div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan</label><input
                                type="file" id="f_formulir_kegiatan_sosialisasi_kesehatan" class="form-input" />
                        </div>
                    </div>
                </div>

                <!-- ══════ KATEGORI: P3K ══════ -->
                <div class="category-block" data-cat="p3k">
                    <div class="form-section-title">Inspeksi Kotak P3K</div>
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Kelas Kotak P3K</label><input
                                type="text" id="fKelasKotakP3k" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Kesesuaian Isi (Checklist)</label><input
                                type="file" id="f_kesesuaian_isi_p3k" class="form-input" /></div>
                        <div class="form-group"><label class="form-label">Formulir Kegiatan Inspeksi</label><input
                                type="file" id="f_formulir_kegiatan_inspeksi_p3k" class="form-input" /></div>
                    </div>
                </div>

                <div class="form-section-title">Arsip &amp; Status</div>
                <div class="form-grid">
                    <div class="form-group span-2"><label class="form-label">Arsip</label><input type="file"
                            id="f_arsip" class="form-input" /></div>
                    <div class="form-group"><label class="form-label">Status Pindah</label>
                        <select id="fStatusPindah" class="form-select">
                            <option value="PENDING">PENDING</option>
                            <option value="SUKSES">SUKSES</option>
                            <option value="GAGAL">GAGAL</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label">Keputusan</label>
                        <select id="fKeputusan" class="form-select">
                            <option value="PENDING">PENDING</option>
                            <option value="APPROVE">APPROVE</option>
                            <option value="REJECT">REJECT</option>
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

    <!-- ══════ MODAL DETAIL ══════ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
        <div class="modal-box detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header" style="display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar" id="detailAvatar"
                        style="width:42px;height:42px;border-radius:10px;background:linear-gradient(135deg,#2D4B9E,#1A1D2E);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;">
                        --</div>
                    <div>
                        <div class="modal-title" id="detailNamaTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailBadgeSub"
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
                    <div class="detail-section-title">Arsip & Status</div>
                    <div class="form-grid" id="detailArsipGrid"></div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('data-safety.data') }}";
        const STORE_ENDPOINT = "{{ route('data-safety.store') }}";
        const BASE_ENDPOINT = "{{ url('/data-safety') }}";
        const CARI_TENAGA_ENDPOINT = "{{ route('data-safety.cari-tenaga') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            jenis_aktifitas_kpi: '',
            area_kerja: '',
            keputusan: '',
            page: 1,
            per_page: 10
        };
        let searchDebounce = null,
            filterOptionsLoaded = false,
            currentEditId = null;

        // Daftar field id → nama field form (dipakai untuk kirim FormData)
        const TEXT_FIELDS = {
            fBadgeTenaga: 'badge_tenaga',
            fNamaTenaga: 'nama_tenaga',
            fTanggalPelaksanaan: 'tanggal_pelaksanaan',
            fAreaKerja: 'area_kerja',
            fUnitKerja: 'unit_kerja',
            fJenisAktifitas: 'jenis_aktifitas_kpi',
            fKategoriPeralatan: 'kategori_peralatan',
            fNamaAlat: 'nama_alat',
            fNomorSeriAlat: 'nomor_seri_alat',
            fStatusAlat: 'status_alat',
            fKeteranganTambahanAlat: 'keterangan_tambahan_alat',
            fRekomendasiTindakanAlat: 'rekomendasi_tindakan_alat',
            fItemTemuan: 'item_temuan',
            fJenisPenyebab: 'jenis_penyebab',
            fDeskripsiTemuan: 'deskripsi_temuan',
            fRekomendasiTindakanTemuan: 'rekomendasi_tindakan_temuan',
            fStatusTemuan: 'status_temuan',
            fNamaSubjectObservasi: 'nama_subject_observasi',
            fProsesKerja: 'proses_kerja',
            fPekerjaanDikerjakan: 'pekerjaan_dikerjakan',
            fKeteranganBahayaNearmiss: 'keterangan_bahaya_nearmiss',
            fNamaPenerima: 'nama_penerima',
            fJenisTindakan: 'jenis_tindakan',
            fAlasanPemberian: 'alasan_pemberian',
            fMateriSosialisasiKeselamatan: 'materi_sosialisasi_keselamatan',
            fMateriSosialisasiKesehatan: 'materi_sosialisasi_kesehatan',
            fNamaPekerjaRomberg: 'nama_pekerja_romberg',
            fKelasKotakP3k: 'kelas_kotak_p3k',
            fStatusPindah: 'status_pindah',
            fKeputusan: 'keputusan',
        };

        // Peta jenis_aktifitas_kpi (text) → kategori
        const CATEGORY_MAP = {
            '[C.1] Laporan Inspeksi Peralatan': 'peralatan',
            'Inspeksi Area Kerja': 'temuan',
            'OBSERI': 'observi',
            'Verifikasi Safety Permit': 'permit',
            'Laporan Nearmiss': 'nearmiss',
            'Safety Briefing': 'briefing',
            'Reward / Punishment': 'reward',
            'Sosialisasi Keselamatan Kerja': 'sosialisasi_keselamatan',
            'Kegiatan DCU': 'dcu',
            'Bugar Sehat': 'bugar_sehat',
            'Tes Keseimbangan (Romberg)': 'romberg',
            'Sosialisasi Kesehatan Kerja': 'sosialisasi_kesehatan',
            'Inspeksi Kotak P3K': 'p3k',
        };

        // Field per kategori: field mengacu ke key hasil transform() —
        // kolom teks pakai nama kolom asli, kolom file pakai suffix "_url"
        const DETAIL_FIELDS = {
            peralatan: [{
                    label: 'Kategori Peralatan',
                    field: 'kategori_peralatan',
                    type: 'text'
                },
                {
                    label: 'Nama Alat',
                    field: 'nama_alat',
                    type: 'text'
                },
                {
                    label: 'Nomor Seri / Kode Lambung',
                    field: 'nomor_seri_alat',
                    type: 'text'
                },
                {
                    label: 'Status Alat',
                    field: 'status_alat',
                    type: 'text'
                },
                {
                    label: 'Keterangan Tambahan',
                    field: 'keterangan_tambahan_alat',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Rekomendasi Tindakan',
                    field: 'rekomendasi_tindakan_alat',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Foto Alat',
                    field: 'foto_alat_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Inspeksi',
                    field: 'formulir_inspeksi_peralatan_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_inspeksi_peralatan_path_url',
                    type: 'file'
                },
            ],
            temuan: [{
                    label: 'Item Temuan',
                    field: 'item_temuan',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Jenis Penyebab',
                    field: 'jenis_penyebab',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Deskripsi Temuan',
                    field: 'deskripsi_temuan',
                    type: 'text',
                    span: 4
                },
                {
                    label: 'Rekomendasi Tindakan',
                    field: 'rekomendasi_tindakan_temuan',
                    type: 'text',
                    span: 4
                },
                {
                    label: 'Status Temuan',
                    field: 'status_temuan',
                    type: 'text'
                },
                {
                    label: 'Foto Temuan UA/UC',
                    field: 'foto_temuan_uauc_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan Inspeksi Area Kerja',
                    field: 'formulir_kegiatan_inspeksi_area_kerja_path_url',
                    type: 'file',
                    span: 2
                },
            ],
            observi: [{
                    label: 'Nama Subject Observasi',
                    field: 'nama_subject_observasi',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Proses Kerja',
                    field: 'proses_kerja',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Formulir OBSERI',
                    field: 'formulir_observi_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan OBSERI',
                    field: 'formulir_kegiatan_observi_path_url',
                    type: 'file'
                },
            ],
            permit: [{
                    label: 'Pekerjaan yang akan Dikerjakan',
                    field: 'pekerjaan_dikerjakan',
                    type: 'text',
                    span: 4
                },
                {
                    label: 'Safety Permit',
                    field: 'safety_permit_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan Verifikasi',
                    field: 'formulir_kegiatan_verifikasi_safety_permit_path_url',
                    type: 'file'
                },
            ],
            nearmiss: [{
                    label: 'Keterangan Bahaya',
                    field: 'keterangan_bahaya_nearmiss',
                    type: 'text',
                    span: 4
                },
                {
                    label: 'Foto Temuan Bahaya',
                    field: 'foto_temuan_bahaya_nearmiss_path_url',
                    type: 'file'
                },
            ],
            briefing: [{
                    label: 'Foto Pelaksanaan',
                    field: 'foto_pelaksanaan_safety_briefing_path_url',
                    type: 'file'
                },
                {
                    label: 'Foto Daftar Hadir',
                    field: 'foto_daftar_hadir_briefing_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_safety_briefing_path_url',
                    type: 'file',
                    span: 2
                },
            ],
            reward: [{
                    label: 'Nama Penerima',
                    field: 'nama_penerima',
                    type: 'text'
                },
                {
                    label: 'Jenis Tindakan',
                    field: 'jenis_tindakan',
                    type: 'text'
                },
                {
                    label: 'Alasan Pemberian',
                    field: 'alasan_pemberian',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Foto Evidence',
                    field: 'foto_evidence_reward_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_reward_path_url',
                    type: 'file'
                },
            ],
            sosialisasi_keselamatan: [{
                    label: 'Materi Sosialisasi',
                    field: 'materi_sosialisasi_keselamatan',
                    type: 'text',
                    span: 4
                },
                {
                    label: 'Foto Kegiatan',
                    field: 'foto_kegiatan_sosialisasi_keselamatan_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Presensi',
                    field: 'formulir_presensi_sosialisasi_keselamatan_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_sosialisasi_keselamatan_path_url',
                    type: 'file'
                },
            ],
            dcu: [{
                    label: 'Foto Kegiatan DCU',
                    field: 'foto_kegiatan_dcu_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Hasil Pemeriksaan',
                    field: 'formulir_hasil_pemeriksaan_dcu_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_pemeriksaan_dcu_path_url',
                    type: 'file'
                },
            ],
            bugar_sehat: [{
                    label: 'Foto Kegiatan',
                    field: 'foto_kegiatan_bugar_sehat_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Presensi',
                    field: 'formulir_presensi_bugar_sehat_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_bugar_sehat_path_url',
                    type: 'file'
                },
            ],
            romberg: [{
                    label: 'Nama Pekerja',
                    field: 'nama_pekerja_romberg',
                    type: 'text',
                    span: 2
                },
                {
                    label: 'Foto Kegiatan',
                    field: 'foto_kegiatan_tes_keseimbangan_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Hasil Pemeriksaan',
                    field: 'formulir_hasil_pemeriksaan_romberg_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_tes_keseimbangan_path_url',
                    type: 'file'
                },
            ],
            sosialisasi_kesehatan: [{
                    label: 'Materi Sosialisasi',
                    field: 'materi_sosialisasi_kesehatan',
                    type: 'text',
                    span: 4
                },
                {
                    label: 'Foto Kegiatan',
                    field: 'foto_kegiatan_sosialisasi_kesehatan_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Presensi',
                    field: 'formulir_presensi_sosialisasi_kesehatan_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan',
                    field: 'formulir_kegiatan_sosialisasi_kesehatan_path_url',
                    type: 'file'
                },
            ],
            p3k: [{
                    label: 'Kelas Kotak P3K',
                    field: 'kelas_kotak_p3k',
                    type: 'text'
                },
                {
                    label: 'Kesesuaian Isi (Checklist)',
                    field: 'kesesuaian_isi_p3k_path_url',
                    type: 'file'
                },
                {
                    label: 'Formulir Kegiatan Inspeksi',
                    field: 'formulir_kegiatan_inspeksi_p3k_path_url',
                    type: 'file'
                },
            ],
        };

        function buildDetailField(item, row) {
            const spanClass = item.span ? ` span-${item.span}` : '';
            const value = row[item.field];
            let inner;
            if (item.type === 'file') {
                inner = value ?
                    `<a class="detail-link" href="${escapeHtml(value)}" target="_blank" rel="noopener">Buka Dokumen ↗</a>` :
                    `<div class="detail-value" style="color:#CBD5E1;">Belum ada dokumen</div>`;
            } else {
                inner = `<div class="detail-value">${escapeHtml(value && value !== '' ? value : '-')}</div>`;
            }
            return `<div class="detail-field${spanClass}"><label>${item.label}</label>${inner}</div>`;
        }

        function openDetailModal(row) {
            document.getElementById('detailAvatar').textContent = initials(row.nama_tenaga);
            document.getElementById('detailNamaTitle').textContent = row.nama_tenaga || '-';
            document.getElementById('detailBadgeSub').textContent = row.badge_tenaga || '-';

            // Data umum
            const umumFields = [{
                    label: 'Tanggal Pelaksanaan',
                    value: formatDate(row.tanggal_pelaksanaan)
                },
                {
                    label: 'Waktu Submit',
                    value: row.waktu_submit ? new Date(row.waktu_submit.replace(' ', 'T')).toLocaleString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }) : '-'
                },
                {
                    label: 'Area Kerja',
                    value: row.area_kerja || '-'
                },
                {
                    label: 'Unit Kerja',
                    value: row.unit_kerja || '-'
                },
                {
                    label: 'Jenis Aktifitas KPI',
                    value: row.jenis_aktifitas_kpi || '-',
                    span: 2
                },
            ];
            document.getElementById('detailUmumGrid').innerHTML = umumFields.map(f =>
                `<div class="detail-field${f.span ? ' span-' + f.span : ''}"><label>${f.label}</label><div class="detail-value">${escapeHtml(f.value)}</div></div>`
            ).join('');

            // Detail sesuai kategori
            const category = CATEGORY_MAP[row.jenis_aktifitas_kpi];
            const fields = DETAIL_FIELDS[category];
            document.getElementById('detailKategoriTitle').textContent = row.jenis_aktifitas_kpi ?
                `Detail — ${row.jenis_aktifitas_kpi}` : 'Detail Aktifitas';

            document.getElementById('detailKategoriGrid').innerHTML = fields ?
                fields.map(item => buildDetailField(item, row)).join('') :
                `<div class="detail-empty-note">Tidak ada detail tambahan untuk jenis aktifitas ini.</div>`;

            // Arsip & status
            const arsipFields = [{
                    label: 'Arsip',
                    el: row.arsip_path_url ?
                        `<a class="detail-link" href="${escapeHtml(row.arsip_path_url)}" target="_blank" rel="noopener">Buka Arsip ↗</a>` :
                        `<div class="detail-value" style="color:#CBD5E1;">Belum ada arsip</div>`,
                    span: 2
                },
                {
                    label: 'Status Pindah',
                    el: `<div class="detail-value">${escapeHtml(row.status_pindah || '-')}</div>`
                },
                {
                    label: 'Keputusan',
                    el: `<div class="detail-value">${escapeHtml(row.keputusan || '-')}</div>`
                },
                {
                    label: 'Indikasi Duplikat',
                    el: `<div class="detail-value">${escapeHtml(row.indikasi_duplikat || '-')}</div>`
                },
            ];
            document.getElementById('detailArsipGrid').innerHTML = arsipFields.map(f =>
                `<div class="detail-field${f.span ? ' span-' + f.span : ''}"><label>${f.label}</label>${f.el}</div>`
            ).join('');

            document.getElementById('detailModalOverlay').classList.add('open');
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

        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.jenis_aktifitas_kpi = document.getElementById('filterJenis').value;
            state.area_kerja = document.getElementById('filterAreaKerja').value;
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
            document.getElementById('filterJenis').value = '';
            document.getElementById('filterAreaKerja').value = '';
            document.getElementById('filterKeputusan').value = '';
            Object.assign(state, {
                search: '',
                jenis_aktifitas_kpi: '',
                area_kerja: '',
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

        function populateFilterOptions(options) {
            if (filterOptionsLoaded || !options) return;
            const build = (id, values) => {
                const s = document.getElementById(id);
                values.forEach(v => {
                    const o = document.createElement('option');
                    o.value = v;
                    o.textContent = v;
                    s.appendChild(o);
                });
            };
            build('filterJenis', options.jenis_aktifitas_kpi || []);
            build('filterAreaKerja', options.area_kerja || []);
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
                    <td><div class="td-name-cell"><div class="td-avatar">${escapeHtml(initials(row.nama_tenaga))}</div><div><div class="td-name-main">${escapeHtml(row.nama_tenaga || '-')}</div><div class="td-name-sub">${escapeHtml(row.badge_tenaga || '-')}</div></div></div></td>
                    <td>${escapeHtml(row.jenis_aktifitas_kpi || '-')}</td>
                    <td><div style="font-weight:600; font-size:12.5px;">${escapeHtml(row.area_kerja || '-')}</div><div class="td-name-sub">${escapeHtml(row.unit_kerja || '-')}</div></td>
                    <td>${formatDate(row.tanggal_pelaksanaan)}</td>
                    <td><span class="status-pill ${row.status_pindah === 'SUKSES' ? 'sp-green' : row.status_pindah === 'GAGAL' ? 'sp-red' : 'sp-amber'}">${row.status_pindah}</span></td>
                    <td><span class="status-pill ${row.keputusan === 'APPROVE' ? 'sp-green' : row.keputusan === 'REJECT' ? 'sp-red' : 'sp-amber'}">${row.keputusan}</span></td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Detail</button>
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-outline" style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);" onclick="deleteData(${row.id}, ${JSON.stringify(row.nama_tenaga || 'data ini')})">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent = meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> data ditemukan`;
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
                populateFilterOptions(json.filter_options);
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="7"><div class="error-state">${escapeHtml(e.message)}</div></td></tr>`;
            }
        }

        // ══════ PICKER TENAGA ══════
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
                    json.data.map(t =>
                        `<div class="picker-item" onclick='pilihTenaga(${JSON.stringify(t).replace(/'/g, "&#39;")})'><div class="picker-item-name">${escapeHtml(t.nama)}</div><div class="picker-item-sub">${escapeHtml(t.badge)} · ${escapeHtml(t.unit_kerja)}</div></div>`
                    ).join('');
                dropdown.classList.add('open');
            } catch (e) {
                dropdown.innerHTML = `<div class="picker-item" style="color:#D0021B;">Gagal memuat data.</div>`;
                dropdown.classList.add('open');
            }
        }

        function pilihTenaga(t) {
            document.getElementById('fBadgeTenaga').value = t.badge;
            document.getElementById('fNamaTenaga').value = t.nama;
            document.getElementById('fUnitKerja').value = t.unit_kerja;
            document.getElementById('tenagaPickerInput').value = `${t.nama} (${t.badge})`;
            document.getElementById('tenagaPickerDropdown').classList.remove('open');
        }

        document.addEventListener('click', (e) => {
            const wrap = document.getElementById('tenagaPickerInput')?.closest('.picker-wrap');
            if (wrap && !wrap.contains(e.target)) document.getElementById('tenagaPickerDropdown')?.classList.remove(
                'open');
        });

        // ══════ TOGGLE KATEGORI DINAMIS ══════
        function onJenisAktifitasChange() {
            const select = document.getElementById('fJenisAktifitas');
            const cat = select.options[select.selectedIndex]?.dataset.category || '';
            document.querySelectorAll('.category-block').forEach(el => {
                el.classList.toggle('visible', el.dataset.cat === cat);
            });
        }

        // ══════ MODAL FORM ══════
        function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            document.getElementById('formModalTitle').textContent = row ? 'Edit Data Safety' : 'Tambah Data Safety';

            document.querySelectorAll(
                '.form-modal-body input[type="text"], .form-modal-body input[type="date"], .form-modal-body textarea, .form-modal-body select'
            ).forEach(el => {
                if (el.id !== 'fJenisAktifitas') el.value = '';
            });
            document.querySelectorAll('.form-modal-body input[type="file"]').forEach(el => el.value = '');

            document.getElementById('tenagaPickerInput').value = row ?
                `${row.nama_tenaga || ''} (${row.badge_tenaga || ''})` : '';

            Object.entries(TEXT_FIELDS).forEach(([elId, fieldName]) => {
                const el = document.getElementById(elId);
                if (el && row) el.value = row[fieldName] || (fieldName.includes('status') || fieldName ===
                    'keputusan' ? 'PENDING' : '');
            });
            if (!row) {
                document.getElementById('fStatusPindah').value = 'PENDING';
                document.getElementById('fKeputusan').value = 'PENDING';
            }

            onJenisAktifitasChange();
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
            Object.entries(TEXT_FIELDS).forEach(([elId, fieldName]) => {
                const el = document.getElementById(elId);
                if (el) formData.append(fieldName, el.value || '');
            });

            document.querySelectorAll('input[type="file"]').forEach(el => {
                const fieldName = el.id.replace(/^f_/, '');
                if (el.files[0]) formData.append(fieldName, el.files[0]);
            });

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

        async function deleteData(id, nama) {
            if (!confirm(`Hapus data "${nama}"? Semua dokumen terkait juga akan dihapus.`)) return;
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

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
