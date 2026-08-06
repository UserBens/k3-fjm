<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Arsip Dokumen KPI K3 — PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bebas+Neue&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --red: #D0021B;
            --green: #1A7A3C;
            --blue: #2D4B9E;
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

        ::-webkit-scrollbar-thumb {
            background: rgba(45, 75, 158, .25);
            border-radius: 4px;
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

        .page-hdr-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 2px;
        }

        .pg-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .pg-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            letter-spacing: .02em;
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
                opacity: .35
            }
        }

        .btn-primary {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            background: #2D4B9E;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary:hover {
            background: #1A3C8A;
        }

        .btn-outline {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid rgba(45, 75, 158, .25);
            font-size: 11.5px;
            font-weight: 700;
            color: #2D4B9E;
            background: #fff;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: #F0F4FF;
        }

        .section-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .06);
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
            border: 1px solid rgba(0, 0, 0, .09);
            border-radius: 8px;
            font-size: 12.5px;
            outline: none;
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
            border: 1px solid rgba(0, 0, 0, .09);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 10px center;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            min-width: 150px;
            appearance: none;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            outline: none;
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
            min-width: 1000px;
            border-collapse: collapse;
        }

        .rtable th {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 0 8px 8px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, .05);
            white-space: nowrap;
        }

        .rtable td {
            font-size: 12px;
            padding: 10px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, .04);
            vertical-align: middle;
        }

        .rtable tr:hover td {
            background: #F8F9FF;
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
            background: rgba(26, 122, 60, .09);
            color: #1A7A3C;
        }

        .sp-amber {
            background: rgba(217, 119, 6, .09);
            color: #D97706;
        }

        .sp-red {
            background: rgba(208, 2, 27, .08);
            color: #D0021B;
        }

        .sp-blue {
            background: rgba(45, 75, 158, .09);
            color: #2D4B9E;
        }

        .sp-gray {
            background: rgba(100, 116, 139, .09);
            color: #64748B;
        }

        .empty-state {
            text-align: center;
            padding: 48px 12px;
            color: #94A3B8;
        }

        .empty-state-title {
            font-size: 13px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 3px;
        }

        .empty-state-sub {
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
                background-position: 100% 50%
            }

            100% {
                background-position: 0 50%
            }
        }

        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(0, 0, 0, .05);
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
            border: 1px solid rgba(0, 0, 0, .09);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394A3B8' stroke-width='2'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 6px center;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            appearance: none;
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
            border: 1px solid rgba(0, 0, 0, .08);
            background: #fff;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            cursor: pointer;
        }

        .page-btn:hover:not(:disabled):not(.active) {
            background: #F0F4FF;
            border-color: rgba(45, 75, 158, .25);
        }

        .page-btn.active {
            background: #2D4B9E;
            border-color: #2D4B9E;
            color: #fff;
        }

        .page-btn:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, .5);
            backdrop-filter: blur(2px);
            z-index: 100;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .2s ease;
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
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
            transform: scale(.94) translateY(8px);
            transition: transform .2s ease;
        }

        .modal-overlay.open .modal-box {
            transform: scale(1) translateY(0);
        }


        .modal-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(208, 2, 27, .09);
            color: #D0021B;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: .02em;
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
            border: 1px solid rgba(0, 0, 0, .09);
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            color: #64748B;
            cursor: pointer;
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
            border-left: 4px solid #1A7A3C;
            opacity: 0;
            transform: translateX(20px);
            transition: all .25s ease;
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
            background: rgba(26, 122, 60, .1);
            color: #1A7A3C;
            margin-top: 1px;
        }

        .toast-error .toast-icon {
            background: rgba(208, 2, 27, .1);
            color: #D0021B;
        }

        .toast-title {
            font-size: 12.5px;
            font-weight: 800;
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
        }

        .btn-row-action:hover {
            background: #F8F9FF;
        }

        .form-modal-box {
            width: 720px;
            max-width: calc(100vw - 32px);
            max-height: 90vh;
            display: flex;
            flex-direction: column;
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
            letter-spacing: .06em;
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
            border: 1px solid rgba(0, 0, 0, .09);
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
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
            cursor: pointer;
        }

        .risk-badge-preview {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        @media (max-width:640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.span-2 {
                grid-column: span 1;
            }
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

        .search-box {
            flex: 1;
            max-width: 320px;
            position: relative;
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

        .multi-picker {
            position: relative;
        }

        .picker-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 6px;
            max-height: 96px;
            overflow-y: auto;
            padding-right: 2px;
        }

        .picker-chips:empty {
            display: none;
            margin-bottom: 0;
        }

        .picker-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #EFF3FB;
            color: #2D4B9E;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .picker-chip button {
            background: none;
            border: none;
            color: #2D4B9E;
            cursor: pointer;
            font-size: 10px;
            line-height: 1;
            padding: 0;
        }

        .picker-dropdown {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 40;
            max-height: 260px;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.12);
            margin-top: 4px;
            overflow: hidden;
        }

        .picker-dropdown.open {
            display: flex;
        }


        .picker-options {
            overflow-y: auto;
            padding: 6px;
        }


        .picker-dropdown-footer {
            flex-shrink: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            border-top: 1px solid #E2E8F0;
            background: #F8FAFC;
        }

        .picker-selected-count {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
        }

        .picker-done-btn {
            border: none;
            background: #2D4B9E;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 7px;
            cursor: pointer;
        }

        .picker-done-btn:hover {
            background: #1A3C8A;
        }

        .picker-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            margin-bottom: 2px;
            border-radius: 7px;
            font-size: 12.5px;
            line-height: 1.4;
            cursor: pointer;
            transition: background 0.12s;
        }

        .picker-option:last-child {
            margin-bottom: 0;
        }

        .picker-option:hover {
            background: #F8FAFC;
        }

        .picker-option.checked {
            background: #EFF6FF;
            color: #2D4B9E;
            font-weight: 700;
        }

        .picker-option-check {
            width: 16px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 16px;
            border-radius: 4px;
            border: 1.5px solid #CBD5E1;
            font-size: 10px;
            color: #fff;
        }

        .picker-option.checked .picker-option-check {
            background: #2D4B9E;
            border-color: #2D4B9E;
        }

        .picker-option span:last-child {
            overflow-wrap: anywhere;
        }

        .picker-empty {
            padding: 16px 12px;
            text-align: center;
            font-size: 12px;
            color: #94A3B8;
        }

        /* ══════ Excel-style HIRADC table (dipakai di modal Detail & Builder) ══════ */
        .hx-wrap {
            overflow: auto;
            border: 1px solid #1E293B;
            border-radius: 8px;
            max-height: 68vh;
        }

        .hx-caption {
            caption-side: top;
            text-align: center;
            font-weight: 700;
            font-size: 13px;
            padding: 8px 6px;
            color: #E2E8F0;
            background: #0B1220;
            letter-spacing: .3px;
            border-bottom: 1px solid #1E293B;
        }

        .hx-table {
            border-collapse: collapse;
            width: max-content;
            min-width: 100%;
            font-size: 11px;
        }

        .hx-table thead th {
            position: sticky;
            top: 0;
            z-index: 3;
            background: #111827;
            color: #93C5FD;
            border: 1px solid #1E293B;
            padding: 5px 6px;
            font-weight: 700;
            text-align: center;
            white-space: normal;
            line-height: 1.25;
        }

        .hx-table thead tr:first-child th {
            top: 0;
        }

        .hx-table thead tr:nth-child(2) th {
            top: 34px;
        }

        .hx-sub {
            font-weight: 400;
            font-size: 9.5px;
            color: #64748B;
        }

        .hx-table tbody td {
            border: 1px solid #1E293B;
            padding: 4px 5px;
            vertical-align: top;
            white-space: pre-wrap;
            color: #030303;
            background: rgba(255, 255, 255, .01);
        }

        .hx-group-row td {
            background: #16213A;
            color: #93C5FD;
            font-weight: 700;
            font-size: 11.5px;
            padding: 6px 8px;
        }

        .hx-sep-row td {
            background: #1a2332;
            height: 6px;
            padding: 2px;
        }

        /* Kategori risiko: L (hijau) / M (kuning) / H (merah gelap) / E (merah terang) */
        .hx-cat {
            text-align: center;
            font-weight: 700;
            border-radius: 4px;
        }

        .hx-cat-l {
            background: #16a34a;
            color: #fff;
        }

        .hx-cat-m {
            background: #eab308;
            color: #1a1a1a;
        }

        .hx-cat-h {
            background: #991b1b;
            color: #fff;
        }

        .hx-cat-e {
            background: #ef4444;
            color: #fff;
        }

        .hx-cat-none {
            background: transparent;
            color: #64748B;
        }

        .hx-lc {
            text-align: center;
            width: 30px;
        }

        .hx-apd-cell {
            border: 1.5px dashed #2D6CDF !important;
            border-radius: 6px;
            text-align: center;
            font-size: 10.5px;
        }

        .hx-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 10px;
            font-size: 11.5px;
            color: #94A3B8;
        }

        .hx-legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .hx-legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            display: inline-block;
        }

        /* Builder (editable) variant */
        .hx-table-edit tbody td {
            padding: 2px;
        }

        .hx-cell-input,
        .hx-cell-select,
        .hx-cell-textarea {
            width: 100%;
            box-sizing: border-box;
            background: transparent;
            border: none;
            color: #000000;
            font-size: 11px;
            padding: 3px 4px;
            border-radius: 3px;
            font-family: inherit;
            resize: vertical;
        }

        .hx-cell-input:focus,
        .hx-cell-select:focus,
        .hx-cell-textarea:focus {
            outline: 1px solid #2D6CDF;
            background: rgba(45, 108, 223, .08);
        }

        .hx-cell-select option {
            background: #0B1220;
            color: #E2E8F0;
        }

        .hx-lc-input {
            width: 34px;
            text-align: center;
        }

        .hx-remove-row {
            background: none;
            border: none;
            color: #D0021B;
            cursor: pointer;
            font-size: 12px;
        }

        .hx-group-row-edit td {
            background: #16213A;
            padding: 4px;
        }

        .hx-group-row-edit input {
            font-weight: 700;
            color: #93C5FD;
            font-size: 12px;
            background: transparent;
            border: none;
            width: 100%;
        }

        .hx-add-row-btn {
            background: none;
            border: 1px dashed #334155;
            color: #94A3B8;
            border-radius: 5px;
            padding: 3px 8px;
            font-size: 11px;
            cursor: pointer;
            margin: 4px 2px;
        }

        .hx-add-row-btn:hover {
            border-color: #2D6CDF;
            color: #93C5FD;
        }

        /* Pengesahan & tanda tangan */
        .hx-sign-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 8px;
        }

        @media (max-width: 900px) {
            .hx-sign-grid {
                grid-template-columns: 1fr;
            }
        }

        .hx-sign-card {
            border: 1px solid #1E293B;
            border-radius: 10px;
            padding: 12px;
            background: rgba(255, 255, 255, .02);
        }

        .hx-sign-title {
            font-weight: 700;
            color: #93C5FD;
            font-size: 12.5px;
            margin-bottom: 8px;
        }

        .hx-ttd-preview-wrap {
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hx-ttd-preview {
            max-width: 140px;
            max-height: 60px;
            border: 1px solid #334155;
            border-radius: 6px;
            background: #fff;
            padding: 2px;
        }

        .hx-attachment-panel {
            margin-top: 14px;
            border: 1px dashed #334155;
            border-radius: 8px;
            padding: 8px 12px;
        }

        .hx-attachment-panel summary {
            cursor: pointer;
            font-size: 12.5px;
            color: #94A3B8;
        }

        .hx-attachment-panel summary:hover {
            color: #93C5FD;
        }

        .hx-sign-block {
            display: flex;
            gap: 24px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .hx-sign-block .hx-sign-view {
            text-align: center;
            font-size: 11.5px;
            color: #94A3B8;
        }

        .hx-sign-block .hx-sign-view img {
            display: block;
            max-width: 140px;
            max-height: 60px;
            background: #fff;
            border-radius: 6px;
            margin: 0 auto 4px;
            padding: 2px;
        }

        .kode-ok-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 20;
            background: #0B1220;
            border: 1px solid #1E293B;
            border-radius: 8px;
            max-height: 220px;
            overflow-y: auto;
            display: none;
            margin-top: 4px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
        }

        .kode-ok-suggestion-item {
            padding: 8px 10px;
            cursor: pointer;
            border-bottom: 1px solid #1E293B;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .kode-ok-suggestion-item:hover {
            background: rgba(45, 108, 223, .12);
        }

        .kode-ok-suggestion-item strong {
            color: #93C5FD;
            font-size: 12px;
        }

        .kode-ok-suggestion-item span {
            color: #94A3B8;
            font-size: 11px;
        }

        .kode-ok-suggestion-empty {
            padding: 10px;
            color: #64748B;
            font-size: 12px;
            text-align: center;
        }

        .kode-ok-info {
            margin-top: 8px;
            border: 1px solid #1E293B;
            border-radius: 8px;
            padding: 10px 12px;
            background: rgba(255, 255, 255, .02);
        }

        .kode-ok-info-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .kode-ok-info-row:last-child {
            margin-bottom: 0;
        }

        .kode-ok-info-label {
            min-width: 80px;
            color: #64748B;
            font-weight: 600;
        }

        .kode-ok-chip-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .kode-ok-chip {
            background: rgba(26, 122, 60, .15);
            color: #4ADE80;
            border: 1px solid rgba(74, 222, 128, .3);
            border-radius: 20px;
            padding: 2px 9px;
            font-size: 10.5px;
        }

        .kode-ok-chip-blue {
            background: rgba(45, 108, 223, .15);
            color: #93C5FD;
            border-color: rgba(147, 197, 253, .3);
        }

        .kode-ok-chip-empty {
            color: #475569;
            font-size: 11px;
        }

        .custom-dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            /* Batas tinggi scroll */
            overflow-y: auto;
            background: #ffffff;
            border: 1px solid #CBD5E1;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 99;
            margin-top: 4px;
        }

        .custom-dropdown-item {
            padding: 8px 12px;
            font-size: 13px;
            color: #334155;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }

        .custom-dropdown-item:hover {
            background-color: #F1F5F9;
            color: #0F172A;
        }

        .custom-dropdown-empty {
            padding: 10px 12px;
            font-size: 12px;
            color: #94A3B8;
            text-align: center;
        }

        .detail-view-text {
            font-size: 13px;
            color: #000000;
            border: 1px solid rgba(0, 0, 0, .09);
            border-radius: 8px;
            padding: 8px 10px;
            min-height: 20px;
        }


        .kpi-tab-bar {
            display: flex;
            gap: 6px;
            margin-bottom: 14px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .kpi-tab-btn {
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 700;
            border: none;
            background: transparent;
            color: #64748B;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
        }

        .kpi-tab-btn.active {
            color: var(--blue);
            border-bottom-color: var(--blue);
        }

        .kpi-tab-panel {}

        .dokumen-inline-row td {
            background: #F8F9FF;
            padding: 12px 16px !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .dokumen-inline-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .dokumen-inline-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 8px 12px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 8px;
        }

        .dokumen-inline-item .di-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .dokumen-inline-item .di-nama {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--dark);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dokumen-inline-item .di-jenis {
            font-size: 11px;
            color: #64748B;
            font-weight: 600;
        }

        .dokumen-inline-item a {
            flex-shrink: 0;
            color: var(--blue);
            font-weight: 800;
            text-decoration: none;
            font-size: 11.5px;
            white-space: nowrap;
        }

        .dokumen-inline-item a:hover {
            text-decoration: underline;
        }

        .dokumen-inline-empty {
            padding: 10px;
            text-align: center;
            color: #94A3B8;
            font-size: 12px;
            font-weight: 600;
        }

        .dokumen-inline-loading {
            padding: 10px;
            text-align: center;
            color: #94A3B8;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-row-action.active {
            background: var(--blue);
            border-color: var(--blue);
            color: #fff;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar && toggleSidebar()"></div>

    <div id="main-content" class="flex-1 flex flex-col overflow-hidden">

        @include('partials.topbar')

        <div id="page-content" class="overflow-y-auto">

            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Manajemen Arsip · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">ARSIP <span>DOKUMEN LAPORAN</span></div>
                        <div class="pg-sub">Rekap dokumen ter-upload dari Data Safety, Data Medis &amp; Pelaporan
                            Pengawas.</div>
                    </div>
                </div>
            </div>

            <!-- TAB STATUS -->
            <div class="kpi-tab-bar" id="statusTabBar">
                <button type="button" class="kpi-tab-btn active" data-status="APPROVE"
                    onclick="switchStatusTab('APPROVE')">
                    Approve <span class="tab-count" id="cntApprove">0</span>
                </button>
                <button type="button" class="kpi-tab-btn" data-status="PENDING" onclick="switchStatusTab('PENDING')">
                    Pending <span class="tab-count" id="cntPending">0</span>
                </button>
                <button type="button" class="kpi-tab-btn" data-status="REJECT" onclick="switchStatusTab('REJECT')">
                    Reject <span class="tab-count" id="cntReject">0</span>
                </button>
                <button type="button" class="kpi-tab-btn" data-status="CANCEL" onclick="switchStatusTab('CANCEL')">
                    Cancel <span class="tab-count" id="cntCancel">0</span>
                </button>
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
                        <input type="text" id="searchInput" placeholder="Cari nama petugas / badge..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterSumber" class="filter-select" onchange="onFilterChange()">
                        <option value="SEMUA">Semua Sumber</option>
                        <option value="SAFETY">Safety</option>
                        <option value="MEDIS">Medis</option>
                        <option value="PENGAWAS">Pengawas</option>
                    </select>

                    <select id="filterArea" class="filter-select" onchange="onFilterChange()">
                        <option value="SEMUA">Semua Area</option>
                    </select>

                    <input type="date" id="filterTanggalDari" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal Dari" />
                    <input type="date" id="filterTanggalSampai" class="filter-select" onchange="onFilterChange()"
                        title="Tanggal Sampai" />

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data arsip dokumen...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Tanggal &amp; Sumber</th>
                                <th>Petugas</th>
                                <th>Area / Unit Kerja</th>
                                <th>Jenis Aktivitas</th>
                                <th>Waktu Submit</th>
                                <th>Jumlah Dokumen</th>
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

        <!-- MODAL DETAIL DOKUMEN -->
    </div>

    <script>
        const DATA_ENDPOINT = "{{ route('arsip-dokumen.data') }}";
        const DETAIL_ENDPOINT_BASE = "{{ url('/arsip-dokumen/detail') }}";

        const state = {
            status: 'APPROVE',
            search: '',
            sumber: 'SEMUA',
            area: 'SEMUA',
            tanggal_dari: '',
            tanggal_sampai: '',
            page: 1,
            per_page: 10,
        };

        let searchDebounce = null;
        let areaOptionsLoaded = false;

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

        function formatDateTime(dateStr) {
            if (!dateStr) return '-';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return dateStr;
            return d.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function sumberPillClass(sumber) {
            if (sumber === 'SAFETY') return 'sp-green';
            if (sumber === 'MEDIS') return 'sp-blue';
            return 'sp-amber'; // PENGAWAS
        }

        function switchStatusTab(status) {
            state.status = status;
            state.page = 1;
            document.querySelectorAll('#statusTabBar .kpi-tab-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.status === status);
            });
            loadData();
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
            state.sumber = document.getElementById('filterSumber').value;
            state.area = document.getElementById('filterArea').value;
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
            document.getElementById('filterSumber').value = 'SEMUA';
            document.getElementById('filterArea').value = 'SEMUA';
            document.getElementById('filterTanggalDari').value = '';
            document.getElementById('filterTanggalSampai').value = '';
            Object.assign(state, {
                search: '',
                sumber: 'SEMUA',
                area: 'SEMUA',
                tanggal_dari: '',
                tanggal_sampai: '',
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

        function populateAreaOptions(areas) {
            if (areaOptionsLoaded || !areas) return;
            const select = document.getElementById('filterArea');
            areas.forEach(a => {
                const opt = document.createElement('option');
                opt.value = a;
                opt.textContent = a;
                select.appendChild(opt);
            });
            areaOptionsLoaded = true;
        }

        function renderTabCounts(counts) {
            document.getElementById('cntApprove').textContent = counts.approve ?? 0;
            document.getElementById('cntPending').textContent = counts.pending ?? 0;
            document.getElementById('cntReject').textContent = counts.reject ?? 0;
            document.getElementById('cntCancel').textContent = counts.cancel ?? 0;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');

            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
        <tr><td colspan="7">
            <div class="empty-state">
                <div class="empty-state-title">Tidak ada dokumen</div>
                <div class="empty-state-sub">Belum ada laporan dengan status ini pada filter yang dipilih.</div>
            </div>
        </td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => {
                const rowKey = `${row.sumber}-${row.id}`;
                return `
        <tr id="row-${rowKey}">
            <td>
                <div class="td-name-main">${formatDate(row.tanggal_pelaksanaan)}</div>
                <span class="status-pill ${sumberPillClass(row.sumber)}" style="margin-top:4px;display:inline-block;">${row.sumber}</span>
            </td>
            <td>
                <div class="td-name-main">${escapeHtml(display(row.nama_petugas))}</div>
                <div class="td-name-sub">${escapeHtml(display(row.badge))}</div>
            </td>
            <td>
                <div class="td-name-sub">${escapeHtml(display(row.area_kerja))}</div>
                <div class="td-name-sub">${escapeHtml(display(row.unit_kerja))}</div>
            </td>
            <td style="max-width:200px;">
                <div class="td-name-sub" style="white-space:normal;line-height:1.4;">${escapeHtml(display(row.jenis_aktifitas_kpi))}</div>
            </td>
            <td><div class="td-name-sub">${formatDateTime(row.waktu_submit)}</div></td>
            <td style="text-align:center;">
                <span class="tab-count" style="background:rgba(45,75,158,0.10);color:var(--blue);">${row.jumlah_dokumen}</span>
            </td>
            <td style="text-align:center; white-space:nowrap;">
                <button class="btn-row-action" id="btn-${rowKey}" onclick="toggleDokumen('${row.sumber}', ${row.id})">
                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Dokumen
                </button>
            </td>
        </tr>
        `;
            }).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> dokumen laporan ditemukan`;

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
                html += p === '...' ?
                    `<span class="page-ellipsis">…</span>` :
                    `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
            });
            html +=
                `<button class="page-btn" ${current >= last ? 'disabled' : ''} onclick="goToPage(${current + 1})">›</button>`;
            container.innerHTML = html;
        }

        async function loadData() {
            const params = new URLSearchParams();
            params.set('status', state.status);
            if (state.search) params.set('search', state.search);
            if (state.sumber && state.sumber !== 'SEMUA') params.set('sumber', state.sumber);
            if (state.area && state.area !== 'SEMUA') params.set('area', state.area);
            if (state.tanggal_dari) params.set('tanggal_dari', state.tanggal_dari);
            if (state.tanggal_sampai) params.set('tanggal_sampai', state.tanggal_sampai);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${DATA_ENDPOINT}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal memuat data');
                const json = await res.json();

                renderTable(json.data);
                renderPagination(json.meta);
                renderTabCounts(json.tab_counts || {});
                populateAreaOptions(json.area_options || []);
            } catch (e) {
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="7" class="empty-state">Gagal memuat data arsip dokumen.</td></tr>`;
            }
        }

        async function toggleDokumen(sumber, id) {
            const rowKey = `${sumber}-${id}`;
            const existing = document.getElementById(`dokrow-${rowKey}`);
            const btn = document.getElementById(`btn-${rowKey}`);

            // Kalau sudah terbuka, tutup saja
            if (existing) {
                existing.remove();
                btn.classList.remove('active');
                return;
            }

            // Tutup panel lain yang mungkin masih terbuka (opsional, biar rapi)
            document.querySelectorAll('.dokumen-inline-row').forEach(el => el.remove());
            document.querySelectorAll('.btn-row-action.active').forEach(el => el.classList.remove('active'));

            btn.classList.add('active');

            const mainRow = document.getElementById(`row-${rowKey}`);
            const inlineRow = document.createElement('tr');
            inlineRow.id = `dokrow-${rowKey}`;
            inlineRow.className = 'dokumen-inline-row';
            inlineRow.innerHTML = `<td colspan="7"><div class="dokumen-inline-loading">Memuat dokumen...</div></td>`;
            mainRow.after(inlineRow);

            try {
                const res = await fetch(`${DETAIL_ENDPOINT_BASE}/${sumber}/${id}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal memuat detail');
                const json = await res.json();
                const d = json.data;

                if (!d.dokumen || d.dokumen.length === 0) {
                    inlineRow.innerHTML =
                        `<td colspan="7"><div class="dokumen-inline-empty">Tidak ada dokumen ter-upload untuk laporan ini.</div></td>`;
                    return;
                }

                const itemsHtml = d.dokumen.map(f => `
            <div class="dokumen-inline-item">
                <div class="di-info">
                    <span class="di-nama">${escapeHtml(f.label)}</span>
                    <span class="di-jenis">${escapeHtml(display(d.jenis_aktifitas_kpi))}</span>
                </div>
                <a href="${f.url}" target="_blank">Buka di tab baru ↗</a>
            </div>
        `).join('');

                inlineRow.innerHTML = `<td colspan="7"><div class="dokumen-inline-list">${itemsHtml}</div></td>`;
            } catch (e) {
                inlineRow.innerHTML =
                    `<td colspan="7"><div class="dokumen-inline-empty" style="color:#D0021B;">Gagal memuat dokumen.</div></td>`;
            }
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
