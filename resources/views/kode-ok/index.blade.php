<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Master Data Kode OK — PT. Fokus Jasa Mitra</title>
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
            display: inline-flex;
            align-items: center;
            gap: 5px;
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

        .btn-sync {
            background-color: #2563EB;
        }

        .btn-sync:hover {
            background-color: #1d4ed8;
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
            min-width: 860px;
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
            vertical-align: top;
        }

        .rtable tr:last-child td {
            border-bottom: none;
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
            background: rgba(26, 122, 60, 0.09);
            color: #1A7A3C;
        }

        .sp-red {
            background: rgba(208, 2, 27, 0.08);
            color: #D0021B;
        }

        .sp-blue {
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
        }

        .sp-amber {
            background: rgba(217, 119, 6, 0.09);
            color: #D97706;
        }

        .sp-gray {
            background: rgba(100, 116, 139, 0.09);
            color: #64748B;
        }

        .badge-list {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            max-width: 220px;
        }

        .badge-more {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            padding: 2px 6px;
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

        .skeleton-row td {
            padding: 12px 8px;
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

        @media (max-width: 640px) {
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
            padding: 16px;
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
            background: rgba(45, 75, 158, 0.09);
            color: #2D4B9E;
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

        .loading-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(26, 29, 46, 0.55);
            backdrop-filter: blur(3px);
            z-index: 200;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .loading-overlay.open {
            display: flex;
            opacity: 1;
        }

        .loading-box {
            background: #fff;
            border-radius: 16px;
            padding: 32px 36px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 300px;
            max-width: calc(100vw - 32px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 3px solid rgba(45, 75, 158, 0.15);
            border-top-color: #2D4B9E;
            animation: spin 0.8s linear infinite;
            margin-bottom: 16px;
        }

        .loading-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 17px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 4px;
        }

        .loading-sub {
            font-size: 11.5px;
            color: #94A3B8;
            line-height: 1.5;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
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
            gap: 5px;
            padding: 5px 10px;
            border-radius: 7px;
            border: 1px solid rgba(45, 75, 158, 0.2);
            background: #F0F4FF;
            color: #2D4B9E;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .btn-row-action:hover {
            background: rgba(45, 75, 158, 0.14);
        }

        .btn-row-action.danger {
            border-color: rgba(208, 2, 27, 0.2);
            background: rgba(208, 2, 27, 0.06);
            color: #D0021B;
        }

        .btn-row-action.danger:hover {
            background: rgba(208, 2, 27, 0.12);
        }

        .form-modal-box {
            background: #fff;
            border-radius: 16px;
            width: 560px;
            max-width: calc(100vw - 32px);
            max-height: calc(100vh - 48px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.94) translateY(8px);
            transition: transform 0.2s ease;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .modal-overlay.open .form-modal-box {
            transform: scale(1) translateY(0);
        }

        .form-modal-header {
            padding: 24px 24px 14px;
            flex-shrink: 0;
        }

        .form-modal-body {
            padding: 0 24px;
            overflow-y: auto;
            flex: 1;
        }

        .form-modal-footer {
            padding: 14px 24px 24px;
            flex-shrink: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
        }

        .form-modal-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .form-modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            line-height: 1;
        }

        .form-group {
            margin-bottom: 14px;
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
            padding: 10px 12px;
            resize: vertical;
            min-height: 70px;
            line-height: 1.5;
        }

        .form-input:disabled {
            background: #F1F5F9;
            color: #94A3B8;
            cursor: not-allowed;
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

        .form-hint {
            font-size: 10.5px;
            color: #94A3B8;
            margin-top: 4px;
        }

        /* ══════ MODAL DETAIL KODE OK (scrollable) ══════ */
        .detail-modal-box {
            background: #fff;
            border-radius: 16px;
            width: 640px;
            max-width: calc(100vw - 32px);
            max-height: calc(100vh - 48px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.96) translateY(8px);
            transition: transform 0.2s ease;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .modal-overlay.open .detail-modal-box {
            transform: scale(1) translateY(0);
        }

        .detail-modal-header {
            padding: 20px 24px 14px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            flex-shrink: 0;
        }

        .detail-modal-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .detail-modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            line-height: 1;
        }

        .detail-modal-close {
            background: #F8F9FF;
            border: 1px solid rgba(0, 0, 0, 0.06);
            width: 30px;
            height: 30px;
            border-radius: 8px;
            color: #64748B;
            cursor: pointer;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detail-modal-close:hover {
            background: #F0F4FF;
        }

        .detail-summary-row {
            display: flex;
            gap: 20px;
            padding: 14px 24px;
            flex-wrap: wrap;
            flex-shrink: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .detail-summary-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .detail-summary-label {
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .detail-summary-value {
            font-size: 15px;
            font-weight: 800;
            color: #1A1D2E;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.02em;
        }

        .detail-tags-block {
            padding: 12px 24px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            flex-shrink: 0;
        }

        .detail-tags-label {
            font-size: 10px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .detail-tags-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .detail-pegawai-body {
            flex: 1;
            overflow-y: auto;
            padding: 4px 24px 20px;
        }

        .detail-pegawai-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-pegawai-table thead th {
            position: sticky;
            top: 0;
            background: #fff;
            font-size: 9.5px;
            font-weight: 800;
            color: #94A3B8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 10px 6px 8px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            z-index: 1;
        }

        .detail-pegawai-table td {
            font-size: 12px;
            color: #1A1D2E;
            padding: 9px 6px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .detail-pegawai-table tr:last-child td {
            border-bottom: none;
        }

        .detail-pegawai-table .td-badge {
            font-size: 10.5px;
            font-weight: 700;
            color: #2D4B9E;
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
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    @include('partials.sidebar')
    <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div id="main-content">

        @include('partials.topbar')

        <div id="page-content">

            <!-- PAGE HEADER -->
            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Database Kode OK · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">MASTER <span>KODE OK</span></div>
                        <div class="pg-sub">Kode OK, pegawai, unit kerja, dan kualifikasi yang tergabung di dalamnya.
                        </div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary btn-sync" id="btnSync" onclick="syncData()">
                            <svg style="width:12px;height:12px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span id="syncText">Sync Kode OK</span>
                        </button>
                        <button class="btn-primary" onclick="openAddModal()">
                            <svg style="width:12px;height:12px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Tambah Kode OK</span>
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
                        <input type="text" id="searchInput" placeholder="Cari kode OK atau uraian..."
                            oninput="onSearchInput()" />
                    </div>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>

                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data kode OK...</div>

                <!-- TABLE -->
                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr>
                                <th>Kode OK</th>
                                <th>Uraian</th>
                                <th>Jml Pegawai</th>
                                <th>Unit Kerja</th>
                                <th>Kualifikasi</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr class="skeleton-row">
                                <td>
                                    <div class="skeleton-bar" style="width:40px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:180px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:40px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:120px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:120px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:60px;"></div>
                                </td>
                                <td>
                                    <div class="skeleton-bar" style="width:100px;margin:auto;"></div>
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

    <!-- MODAL KONFIRMASI SYNC -->
    <div id="syncConfirmOverlay" class="modal-overlay" onclick="closeSyncModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:20px;height:20px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </div>
            <div class="modal-title">Sinkronkan Data Kode OK?</div>
            <div class="modal-desc">
                Sistem akan menarik ulang data pegawai dari API dan menambahkan kode OK baru yang belum ada
                ke master. Uraian kode OK yang sudah Anda edit manual tidak akan tertimpa.
            </div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeSyncModal()">Batal</button>
                <button class="btn-modal-confirm" onclick="confirmSync()">Ya, Sync Sekarang</button>
            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <div id="deleteConfirmOverlay" class="modal-overlay" onclick="closeDeleteModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap" style="background:rgba(208,2,27,0.09); color:#D0021B;">
                <svg style="width:20px;height:20px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9.5 3h5a1 1 0 011 1v3h-7V4a1 1 0 011-1z" />
                </svg>
            </div>
            <div class="modal-title">Hapus Kode OK Ini?</div>
            <div class="modal-desc" id="deleteConfirmDesc">
                Data yang sudah dihapus tidak dapat dikembalikan.
            </div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="btn-modal-confirm" style="background:#D0021B;" onclick="confirmDelete()">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH / EDIT -->
    <div id="formModalOverlay" class="modal-overlay" onclick="closeFormModalOutside(event)">
        <div class="form-modal-box" onclick="event.stopPropagation()">
            <div class="form-modal-header">
                <div class="form-modal-eyebrow" id="formModalEyebrow">Tambah Data</div>
                <div class="form-modal-title" id="formModalTitle">Kode OK Baru</div>
            </div>

            <div class="form-modal-body">
                <div class="form-group">
                    <label class="form-label">Kode OK</label>
                    <input type="text" id="inputKodeOk" class="form-input"
                        placeholder="Kosongkan untuk otomatis" />
                    <div class="form-hint" id="kodeOkHint">Kosongkan untuk menggunakan nomor urut berikutnya.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Uraian Kerja</label>
                    <input type="text" id="inputUraianKerja" class="form-input"
                        placeholder="Kosongkan untuk otomatis" />
                </div>

                <div class="form-group">
                    <label class="form-label">Unit Kerja</label>
                    <div class="multi-picker" data-picker="unitKerja">
                        <div class="picker-chips" id="chips-unitKerja"></div>
                        <input type="text" class="form-input" placeholder="Cari unit kerja..."
                            oninput="pickerSearch('unitKerja', this.value)" onfocus="pickerOpen('unitKerja')"
                            autocomplete="off" />
                        <div class="picker-dropdown" id="dropdown-unitKerja">
                            <div class="picker-options" id="options-unitKerja"></div>
                            <div class="picker-dropdown-footer">
                                <span class="picker-selected-count" id="count-unitKerja">0 dipilih</span>
                                <button type="button" class="picker-done-btn"
                                    onclick="pickerClose('unitKerja')">Selesai</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Kualifikasi</label>
                    <div class="multi-picker" data-picker="kualifikasi">
                        <div class="picker-chips" id="chips-kualifikasi"></div>
                        <input type="text" class="form-input" placeholder="Cari kualifikasi..."
                            oninput="pickerSearch('kualifikasi', this.value)" onfocus="pickerOpen('kualifikasi')"
                            autocomplete="off" />
                        <div class="picker-dropdown" id="dropdown-kualifikasi">
                            <div class="picker-options" id="options-kualifikasi"></div>
                            <div class="picker-dropdown-footer">
                                <span class="picker-selected-count" id="count-kualifikasi">0 dipilih</span>
                                <button type="button" class="picker-done-btn"
                                    onclick="pickerClose('kualifikasi')">Selesai</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tenaga (Pegawai)</label>
                    <div class="multi-picker" data-picker="pegawai">
                        <div class="picker-chips" id="chips-pegawai"></div>
                        <input type="text" class="form-input" placeholder="Cari nama / badge pegawai..."
                            oninput="pickerSearch('pegawai', this.value)" onfocus="pickerOpen('pegawai')"
                            autocomplete="off" />
                        <div class="picker-dropdown" id="dropdown-pegawai">
                            <div class="picker-options" id="options-pegawai"></div>
                            <div class="picker-dropdown-footer">
                                <span class="picker-selected-count" id="count-pegawai">0 dipilih</span>
                                <button type="button" class="picker-done-btn"
                                    onclick="pickerClose('pegawai')">Selesai</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:4px;">
                    <label class="form-label">Status</label>
                    <select id="inputStatus" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="form-modal-footer">
                <div class="modal-actions" style="margin-top:0;">
                    <button class="btn-modal-cancel" onclick="closeFormModal()">Batal</button>
                    <button class="btn-modal-confirm" id="btnSubmitForm" onclick="submitForm()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL KODE OK (scrollable) -->
    <div id="detailModalOverlay" class="modal-overlay" onclick="closeDetailModalOutside(event)">
        <div class="detail-modal-box" onclick="event.stopPropagation()">
            <div class="detail-modal-header">
                <div>
                    <div class="detail-modal-eyebrow" id="detailEyebrow">Detail Kode OK</div>
                    <div class="detail-modal-title" id="detailTitle">#—</div>
                </div>
                <button class="detail-modal-close" onclick="closeDetailModal()">
                    <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="detail-summary-row">
                <div class="detail-summary-item">
                    <span class="detail-summary-label">Jumlah Pegawai</span>
                    <span class="detail-summary-value" id="detailJumlahPegawai">0</span>
                </div>
                <div class="detail-summary-item">
                    <span class="detail-summary-label">Unit Kerja</span>
                    <span class="detail-summary-value" id="detailJumlahUnitKerja">0</span>
                </div>
                <div class="detail-summary-item">
                    <span class="detail-summary-label">Kualifikasi</span>
                    <span class="detail-summary-value" id="detailJumlahKualifikasi">0</span>
                </div>
            </div>

            <div class="detail-tags-block">
                <div class="detail-tags-label">Unit Kerja Terlibat</div>
                <div class="detail-tags-wrap" id="detailUnitKerjaTags"></div>
            </div>

            <div class="detail-tags-block">
                <div class="detail-tags-label">Kualifikasi Terlibat</div>
                <div class="detail-tags-wrap" id="detailKualifikasiTags"></div>
            </div>

            <div class="detail-pegawai-body">
                <table class="detail-pegawai-table">
                    <thead>
                        <tr>
                            <th>Badge</th>
                            <th>Nama Pegawai</th>
                            <th>Unit Kerja</th>
                            <th>Kualifikasi</th>
                        </tr>
                    </thead>
                    <tbody id="detailPegawaiBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-box">
            <div class="loading-spinner"></div>
            <div class="loading-text">Menyinkronkan Data Kode OK</div>
            <div class="loading-sub">Mohon tunggu, sedang mengambil data terbaru dari sumber API...</div>
        </div>
    </div>

    <script>
        const API_ENDPOINT = "{{ route('kode-ok.api') }}";
        const SYNC_ENDPOINT = "{{ route('kode-ok.sync') }}";
        const STORE_ENDPOINT = "{{ route('kode-ok.store') }}";
        const UPDATE_ENDPOINT_BASE = "{{ url('/kode-ok') }}";
        const DELETE_ENDPOINT_BASE = "{{ url('/kode-ok') }}";
        const OPTIONS_ENDPOINT = "{{ route('kode-ok.options') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            status: '',
            page: 1,
            per_page: 10
        };
        let searchDebounce = null;
        let currentEditId = null;
        let deleteTargetId = null;
        let deleteTargetKode = null;
        let lastLoadedRows = [];

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
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
            document.getElementById('filterStatus').value = '';
            state.search = '';
            state.status = '';
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

        function statusPill(status) {
            return status ?
                `<span class="status-pill sp-green">Aktif</span>` :
                `<span class="status-pill sp-red">Nonaktif</span>`;
        }

        function renderBadgeList(list, colorClass, max = 3) {
            if (!list || list.length === 0) {
                return `<span style="font-size:11px;color:#CBD5E1;">—</span>`;
            }
            const shown = list.slice(0, max);
            let html = `<div class="badge-list">`;
            shown.forEach(item => {
                html += `<span class="status-pill ${colorClass}">${escapeHtml(item)}</span>`;
            });
            if (list.length > max) {
                html += `<span class="badge-more">+${list.length - max} lagi</span>`;
            }
            html += `</div>`;
            return html;
        }

        function renderTable(rows) {
            lastLoadedRows = rows || [];
            const tbody = document.getElementById('tableBody');

            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <div class="empty-state-title">Data tidak ditemukan</div>
                            <div class="empty-state-sub">Coba ubah kata kunci pencarian atau filter yang digunakan.</div>
                        </div>
                    </td>
                </tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr>
                    <td><span class="status-pill sp-blue" style="font-size:11px;">#${escapeHtml(row.kode_ok)}</span></td>
                    <td style="max-width:220px;">
                        <div style="font-weight:600; color:#1e293b; font-size:12.5px; line-height:1.4;">${escapeHtml(row.uraian_kerja || '-')}</div>
                    </td>
                    <td style="font-weight:700;">${row.jumlah_pegawai}</td>
                    <td>${renderBadgeList(row.unit_kerja_list, 'sp-blue')}</td>
                    <td>${renderBadgeList(row.kualifikasi_list, 'sp-amber')}</td>
                    <td>${statusPill(row.status)}</td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-row-action" onclick="openDetailModal(${row.id})">Detail</button>
                        <button class="btn-row-action" style="margin-left:6px;" onclick='openEditModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-row-action danger" style="margin-left:6px;" onclick="openDeleteModal(${row.id}, ${JSON.stringify(row.kode_ok)}, ${row.jumlah_pegawai})">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        function renderError(message) {
            document.getElementById('tableBody').innerHTML = `
        <tr>
            <td colspan="7">
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
            document.getElementById('dataSummary').textContent = 'Gagal memuat data kode OK.';
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent =
                meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> kode OK ditemukan`;

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
            if (state.search) params.set('search', state.search);
            if (state.status !== '') params.set('status', state.status);
            params.set('page', state.page);
            params.set('per_page', state.per_page);

            try {
                const res = await fetch(`${API_ENDPOINT}?${params.toString()}`, {
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
            } catch (e) {
                renderError(e.message || 'Terjadi kesalahan tak terduga.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>

    <script>
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

        // SYNC
        function syncData() {
            document.getElementById('syncConfirmOverlay').classList.add('open');
        }

        function closeSyncModal() {
            document.getElementById('syncConfirmOverlay').classList.remove('open');
        }

        function closeSyncModalOutside(event) {
            if (event.target.id === 'syncConfirmOverlay') closeSyncModal();
        }
        async function confirmSync() {
            closeSyncModal();
            document.getElementById('loadingOverlay').classList.add('open');
            try {
                const res = await fetch(SYNC_ENDPOINT, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Server merespons dengan status ${res.status}`);
                await loadData();
                document.getElementById('loadingOverlay').classList.remove('open');
                showToast(json.message || 'Data kode OK berhasil disinkronkan.', 'success');
            } catch (e) {
                document.getElementById('loadingOverlay').classList.remove('open');
                showToast(e.message || 'Terjadi kesalahan tidak terduga saat sinkronisasi.', 'error');
            }
        }

        const pickerData = {
            unitKerja: {
                all: [],
                selected: new Map()
            },
            kualifikasi: {
                all: [],
                selected: new Map()
            },
            pegawai: {
                all: [],
                selected: new Map()
            },
        };
        let optionsLoaded = false;

        async function ensureOptionsLoaded() {
            if (optionsLoaded) return;
            try {
                const res = await fetch(OPTIONS_ENDPOINT, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                pickerData.unitKerja.all = json.unit_kerja || [];
                pickerData.kualifikasi.all = json.kualifikasi || [];
                pickerData.pegawai.all = json.pegawai || [];
                optionsLoaded = true;
            } catch (e) {
                showToast('Gagal memuat data unit kerja/kualifikasi/pegawai.', 'error');
            }
        }

        function pickerLabel(type, item) {
            if (type === 'pegawai') return `${item.badge ? item.badge + ' — ' : ''}${item.nama}`;
            if (type === 'unitKerja') return item.nama_unit_kerja;
            return item.nama_kualifikasi;
        }

        function resetPicker(type) {
            pickerData[type].selected = new Map();
            document.getElementById(`chips-${type}`).innerHTML = '';
            document.getElementById(`dropdown-${type}`).classList.remove('open');
        }

        function renderChips(type) {
            const wrap = document.getElementById(`chips-${type}`);
            const items = Array.from(pickerData[type].selected.values());
            wrap.innerHTML = items.map(item => `
        <span class="picker-chip">
            ${escapeHtml(pickerLabel(type, item))}
            <button type="button" onclick="pickerRemove('${type}', ${item.id})">✕</button>
        </span>
    `).join('');
        }

        function renderDropdown(type, keyword = '') {
            const optionsWrap = document.getElementById(`options-${type}`);
            const kw = keyword.trim().toLowerCase();
            const list = pickerData[type].all.filter(item => {
                const label = pickerLabel(type, item).toLowerCase();
                return !kw || label.includes(kw);
            });

            if (list.length === 0) {
                optionsWrap.innerHTML = `<div class="picker-empty">Tidak ada data cocok.</div>`;
            } else {
                optionsWrap.innerHTML = list.slice(0, 50).map(item => {
                    const checked = pickerData[type].selected.has(item.id);
                    return `
                <div class="picker-option ${checked ? 'checked' : ''}" onclick="pickerToggle('${type}', ${item.id})">
                    <span class="picker-option-check">${checked ? '✓' : ''}</span>
                    <span>${escapeHtml(pickerLabel(type, item))}</span>
                </div>
            `;
                }).join('');
            }

            document.getElementById(`count-${type}`).textContent =
                `${pickerData[type].selected.size} dipilih`;
        }


        function pickerOpen(type) {
            // tutup picker lain biar tidak ada dua dropdown terbuka bersamaan
            ['unitKerja', 'kualifikasi', 'pegawai'].forEach(t => {
                if (t !== type) pickerClose(t);
            });
            renderDropdown(type);
            document.getElementById(`dropdown-${type}`).classList.add('open');
        }

        function pickerClose(type) {
            document.getElementById(`dropdown-${type}`).classList.remove('open');
        }

        function pickerSearch(type, keyword) {
            renderDropdown(type, keyword);
            document.getElementById(`dropdown-${type}`).classList.add('open');
        }

        function pickerToggle(type, id) {
            const item = pickerData[type].all.find(i => i.id === id);
            if (!item) return;
            if (pickerData[type].selected.has(id)) {
                pickerData[type].selected.delete(id);
            } else {
                pickerData[type].selected.set(id, item);
            }
            renderChips(type);
            renderDropdown(type);
        }

        function pickerRemove(type, id) {
            pickerData[type].selected.delete(id);
            renderChips(type);
            renderDropdown(type);
        }

        function pickerSetSelected(type, ids) {
            const items = (ids || [])
                .map(id => pickerData[type].all.find(i => i.id === id))
                .filter(Boolean);
            pickerData[type].selected = new Map(items.map(i => [i.id, i]));
            renderChips(type);
        }

        document.addEventListener('click', (e) => {
            ['unitKerja', 'kualifikasi', 'pegawai'].forEach(type => {
                const dropdown = document.getElementById(`dropdown-${type}`);
                if (!dropdown.classList.contains('open')) return;

                const wrap = document.querySelector(`[data-picker="${type}"]`);
                if (wrap && !wrap.contains(e.target)) {
                    pickerClose(type);
                }
            });
        }, true);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                ['unitKerja', 'kualifikasi', 'pegawai'].forEach(pickerClose);
            }
        });

        // FORM TAMBAH / EDIT
        async function openAddModal() {
            currentEditId = null;
            document.getElementById('formModalEyebrow').textContent = 'Tambah Data';
            document.getElementById('formModalTitle').textContent = 'Kode OK Baru';
            document.getElementById('inputKodeOk').value = '';
            document.getElementById('inputKodeOk').disabled = false;
            document.getElementById('kodeOkHint').textContent = 'Kosongkan untuk menggunakan nomor urut berikutnya.';
            document.getElementById('inputStatus').value = '1';
            document.getElementById('inputUraianKerja').value = '';


            resetPicker('unitKerja');
            resetPicker('kualifikasi');
            resetPicker('pegawai');

            document.getElementById('formModalOverlay').classList.add('open');
            await ensureOptionsLoaded();
        }

        async function openEditModal(row) {
            currentEditId = row.id;
            document.getElementById('formModalEyebrow').textContent = 'Update Data';
            document.getElementById('formModalTitle').textContent = `Edit Kode OK #${row.kode_ok}`;
            document.getElementById('inputKodeOk').value = row.kode_ok;
            document.getElementById('inputKodeOk').disabled = true;
            document.getElementById('kodeOkHint').textContent = 'Kode OK tidak dapat diubah setelah dibuat.';
            document.getElementById('inputStatus').value = row.status ? '1' : '0';
            document.getElementById('inputUraianKerja').value = row.uraian_kerja || '';

            document.getElementById('formModalOverlay').classList.add('open');
            await ensureOptionsLoaded();

            pickerSetSelected('unitKerja', row.unit_kerja_ids);
            pickerSetSelected('kualifikasi', row.kualifikasi_ids);
            pickerSetSelected('pegawai', row.pegawai_ids);
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

            const payload = {
                kode_ok: document.getElementById('inputKodeOk').value.trim() || null,
                uraian_kerja: document.getElementById('inputUraianKerja').value.trim() || null,
                status: parseInt(document.getElementById('inputStatus').value, 10),
                unit_kerja_ids: Array.from(pickerData.unitKerja.selected.keys()),
                kualifikasi_ids: Array.from(pickerData.kualifikasi.selected.keys()),
                pegawai_ids: Array.from(pickerData.pegawai.selected.keys()),
            };

            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            try {
                const isEdit = currentEditId !== null;
                const url = isEdit ? `${UPDATE_ENDPOINT_BASE}/${currentEditId}` : STORE_ENDPOINT;

                const res = await fetch(url, {
                    method: isEdit ? 'PUT' : 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify(payload)
                });
                const json = await res.json();
                if (!res.ok) {
                    const firstError = json.errors ? Object.values(json.errors)[0][0] : null;
                    throw new Error(firstError || json.message || `Server merespons dengan status ${res.status}`);
                }
                closeFormModal();
                await loadData();
                showToast(json.message || (isEdit ? 'Kode OK berhasil diperbarui.' :
                    'Kode OK baru berhasil ditambahkan.'), 'success');
            } catch (e) {
                showToast(e.message || 'Terjadi kesalahan saat menyimpan data.', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // HAPUS
        function openDeleteModal(id, kodeOk, jumlahPegawai) {
            deleteTargetId = id;
            deleteTargetKode = kodeOk;
            const extraWarning = jumlahPegawai > 0 ?
                ` Kode OK ini masih dipakai oleh ${jumlahPegawai} pegawai — sebaiknya nonaktifkan saja lewat Edit, bukan dihapus.` :
                '';
            document.getElementById('deleteConfirmDesc').textContent =
                `Kode OK #${kodeOk} akan dihapus permanen dan tidak dapat dikembalikan.${extraWarning}`;
            document.getElementById('deleteConfirmOverlay').classList.add('open');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmOverlay').classList.remove('open');
            deleteTargetId = null;
        }

        function closeDeleteModalOutside(event) {
            if (event.target.id === 'deleteConfirmOverlay') closeDeleteModal();
        }
        async function confirmDelete() {
            if (!deleteTargetId) return;
            try {
                const res = await fetch(`${DELETE_ENDPOINT_BASE}/${deleteTargetId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message || `Server merespons dengan status ${res.status}`);
                closeDeleteModal();
                await loadData();
                showToast(json.message || 'Kode OK berhasil dihapus.', 'success');
            } catch (e) {
                closeDeleteModal();
                showToast(e.message || 'Terjadi kesalahan saat menghapus data.', 'error');
            }
        }

        // DETAIL (scrollable table)
        function openDetailModal(id) {
            const row = lastLoadedRows.find(r => r.id === id);
            if (!row) return;

            document.getElementById('detailEyebrow').textContent = row.uraian_kerja || 'Detail Kode OK';
            document.getElementById('detailTitle').textContent = `Kode OK #${row.kode_ok}`;
            document.getElementById('detailJumlahPegawai').textContent = row.jumlah_pegawai;
            document.getElementById('detailJumlahUnitKerja').textContent = (row.unit_kerja_list || []).length;
            document.getElementById('detailJumlahKualifikasi').textContent = (row.kualifikasi_list || []).length;

            const unitTagsWrap = document.getElementById('detailUnitKerjaTags');
            unitTagsWrap.innerHTML = (row.unit_kerja_list || []).length ?
                row.unit_kerja_list.map(u => `<span class="status-pill sp-blue">${escapeHtml(u)}</span>`).join('') :
                `<span style="font-size:11px;color:#CBD5E1;">Belum ada data unit kerja.</span>`;

            const qualTagsWrap = document.getElementById('detailKualifikasiTags');
            qualTagsWrap.innerHTML = (row.kualifikasi_list || []).length ?
                row.kualifikasi_list.map(k => `<span class="status-pill sp-amber">${escapeHtml(k)}</span>`).join('') :
                `<span style="font-size:11px;color:#CBD5E1;">Belum ada data kualifikasi.</span>`;

            const pegawaiBody = document.getElementById('detailPegawaiBody');
            const list = row.pegawai_list || [];
            pegawaiBody.innerHTML = list.length ? list.map(p => `
                <tr>
                    <td class="td-badge">${escapeHtml(p.badge)}</td>
                    <td>${escapeHtml(p.nama)}</td>
                    <td>${escapeHtml(p.unit_kerja)}</td>
                    <td>${escapeHtml(p.kualifikasi)}</td>
                </tr>
            `).join('') : `
                <tr><td colspan="4" style="text-align:center;color:#94A3B8;padding:24px 0;">Belum ada pegawai di kode OK ini.</td></tr>
            `;

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(event) {
            if (event.target.id === 'detailModalOverlay') closeDetailModal();
        }
    </script>
</body>

</html>
