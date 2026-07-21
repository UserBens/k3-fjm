<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Rencana Implementasi Pelatihan K3 — PT. Fokus Jasa Mitra</title>
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

        /* ══════ Ringkasan anggaran ══════ */
        .summary-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        .summary-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px 16px;
        }

        .summary-card .s-label {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 6px;
        }

        .summary-card .s-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            color: #1A1D2E;
            letter-spacing: 0.01em;
        }

        .summary-card.accent .s-value {
            color: #2D4B9E;
        }

        @media (max-width: 900px) {
            .summary-row {
                grid-template-columns: repeat(2, 1fr);
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
            min-width: 1420px;
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

        .rtable th.th-periode {
            text-align: center;
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

        .td-topik-main {
            font-weight: 700;
            color: #1A1D2E;
            line-height: 1.3;
            max-width: 220px;
        }

        .td-topik-sub {
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

        .periode-cell {
            text-align: center;
            font-size: 13px;
        }

        .periode-dash {
            color: #CBD5E1;
        }

        .empty-state,
        .error-state {
            text-align: center;
            padding: 48px 12px;
            color: #94A3B8;
        }

        .empty-state-title,
        .error-state-title {
            font-size: 13px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 3px;
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

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 8px;
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

        .form-modal-box {
            width: 720px;
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

        /* ══════ Grid jadwal bulanan (form) ══════ */
        .jadwal-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px 14px;
        }

        .jadwal-item label {
            display: block;
            font-size: 10.5px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 4px;
        }

        .jadwal-item select {
            height: 34px;
            font-size: 11.5px;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.span-2 {
                grid-column: span 1;
            }

            .jadwal-grid {
                grid-template-columns: repeat(2, 1fr);
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
            font-size: 15px;
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

        .detail-jadwal-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .detail-jadwal-cell {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 8px;
            padding: 8px 10px;
            text-align: center;
        }

        .detail-jadwal-cell .dj-label {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        @media (max-width: 640px) {
            .detail-form-grid {
                grid-template-columns: 1fr;
            }

            .detail-field.span-2 {
                grid-column: span 1;
            }

            .detail-jadwal-grid {
                grid-template-columns: repeat(2, 1fr);
            }
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
                            <span class="pg-eyebrow">Master Data K3 · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">RENCANA IMPLEMENTASI <span>PELATIHAN K3</span></div>
                        <div class="pg-sub">Kelola rencana, anggaran, dan jadwal bulanan pelatihan K3.</div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-primary" onclick="openFormModal()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Rencana
                        </button>
                    </div>
                </div>
            </div>

            <div class="summary-row">
                <div class="summary-card">
                    <div class="s-label">Total Program</div>
                    <div class="s-value" id="sumTotalProgram">—</div>
                </div>
                <div class="summary-card">
                    <div class="s-label">Prioritas Tinggi</div>
                    <div class="s-value" id="sumPrioritasTinggi">—</div>
                </div>
                <div class="summary-card accent" style="grid-column: span 2;">
                    <div class="s-label">Estimasi Total Anggaran (sesuai filter)</div>
                    <div class="s-value" id="sumTotalAnggaran">—</div>
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
                        <input type="text" id="searchInput" placeholder="Cari topik pelatihan..."
                            oninput="onSearchInput()" />
                    </div>
                    <select id="filterTahun" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Tahun</option>
                    </select>
                    <select id="filterPrioritas" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Prioritas</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                    <select id="filterPeriode" class="filter-select" onchange="onFilterChange()">
                        <option value="">Semua Periode</option>
                    </select>
                    <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                </div>

                <div class="data-summary" id="dataSummary">Memuat data...</div>

                <div class="rtable-wrap">
                    <table class="rtable">
                        <thead>
                            <tr id="tableHeadRow">
                                <th>No.</th>
                                <th>Topik Pelatihan K3</th>
                                <th>Prioritas</th>
                                <th>Peserta (Est.)</th>
                                <th>Durasi (Jam)</th>
                                <th>Anggaran (Est. Rp)</th>
                                <!-- kolom periode disisipkan lewat JS -->
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="20">
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
                <div class="modal-title" id="formModalTitle">Tambah Rencana Pelatihan</div>
                <div class="pg-sub" style="margin:0;">Lengkapi data rencana implementasi pelatihan K3.</div>
            </div>

            <div class="form-modal-body">
                <div class="form-section-title">Informasi Umum</div>
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label class="form-label">Topik Pelatihan K3</label>
                        <input type="text" id="fTopikPelatihan" class="form-input"
                            placeholder="Contoh: Kerja di Ketinggian" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tahun</label>
                        <input type="number" id="fTahun" class="form-input" placeholder="2026" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Prioritas</label>
                        <select id="fPrioritas" class="form-select">
                            <option value="Tinggi">Tinggi</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Rendah">Rendah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Peserta (Est.)</label>
                        <input type="text" id="fPesertaEstimasi" class="form-input"
                            placeholder="Contoh: 25 org / Semua Baru" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Durasi (Jam)</label>
                        <input type="number" id="fDurasiJam" class="form-input" placeholder="8" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Anggaran Estimasi (Rp)</label>
                        <input type="number" id="fAnggaranEstimasi" class="form-input" placeholder="4000000" />
                    </div>
                    <div class="form-group span-2">
                        <label class="form-label">Keterangan</label>
                        <textarea id="fKeterangan" class="form-textarea" rows="2"></textarea>
                    </div>
                </div>

                <div class="form-section-title">Jadwal Bulanan</div>
                <div class="jadwal-grid" id="jadwalFormGrid"></div>
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
            <div class="detail-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="detail-avatar" id="detailAvatar">--</div>
                    <div>
                        <div class="modal-title" id="detailTopikTitle" style="margin-bottom:2px;">-</div>
                        <div class="detail-subtitle" id="detailPrioritasSub">-</div>
                    </div>
                </div>
                <button class="toast-close" style="font-size:18px;" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="detail-section-title">Informasi Umum</div>
                    <div class="form-grid" id="detailUmumGrid"></div>
                </div>
                <div class="detail-section">
                    <div class="detail-section-title">Jadwal Bulanan</div>
                    <div class="detail-jadwal-grid" id="detailJadwalGrid"></div>
                </div>
            </div>

            <div class="modal-actions" style="margin-top:16px;">
                <button class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        const DATA_ENDPOINT = "{{ route('rencana-pelatihan-k3.data') }}";
        const STORE_ENDPOINT = "{{ route('rencana-pelatihan-k3.store') }}";
        const BASE_ENDPOINT = "{{ url('/rencana-pelatihan-k3') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const PERIODE = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'ags', 'sep_des'];
        const PERIODE_LABEL = {
            jan: 'Jan',
            feb: 'Feb',
            mar: 'Mar',
            apr: 'Apr',
            mei: 'Mei',
            jun: 'Jun',
            jul: 'Jul',
            ags: 'Ags',
            sep_des: 'Sep-Des'
        };
        const STATUS_LABEL = {
            terlaksana: 'Terlaksana',
            dijadwalkan: 'Dijadwalkan',
            tertunda: 'Tertunda'
        };
        const STATUS_ICON = {
            terlaksana: '✔',
            dijadwalkan: '📋',
            tertunda: '⚠'
        };

        const state = {
            search: '',
            tahun: '',
            prioritas: '',
            periode: '',
            page: 1,
            per_page: 10
        };
        let searchDebounce = null,
            filterOptionsLoaded = false,
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

        function initials(text) {
            if (!text) return '—';
            const p = text.trim().split(/\s+/);
            return ((p[0]?.[0] || '') + (p[1]?.[0] || '')).toUpperCase();
        }

        function formatRupiah(n) {
            const num = Number(n || 0);
            return 'Rp ' + num.toLocaleString('id-ID', {
                maximumFractionDigits: 0
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

        // ══════ Bangun kolom periode di header tabel & form/jadwal grid, sekali saja ══════
        (function buildStaticPeriodeUI() {
            const headRow = document.getElementById('tableHeadRow');
            const aksiTh = headRow.lastElementChild;
            PERIODE.forEach(p => {
                const th = document.createElement('th');
                th.className = 'th-periode';
                th.textContent = PERIODE_LABEL[p];
                headRow.insertBefore(th, aksiTh);
            });

            const jadwalGrid = document.getElementById('jadwalFormGrid');
            jadwalGrid.innerHTML = PERIODE.map(p => `
                <div class="jadwal-item">
                    <label>${PERIODE_LABEL[p]}</label>
                    <select class="form-select" data-periode="${p}" id="jadwal_${p}">
                        <option value="">Kosong</option>
                        <option value="dijadwalkan">📋 Dijadwalkan</option>
                        <option value="terlaksana">✔ Terlaksana</option>
                        <option value="tertunda">⚠ Tertunda</option>
                    </select>
                </div>
            `).join('');

            const filterPeriode = document.getElementById('filterPeriode');
            PERIODE.forEach(p => {
                const o = document.createElement('option');
                o.value = p;
                o.textContent = PERIODE_LABEL[p];
                filterPeriode.appendChild(o);
            });
        })();

        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.tahun = document.getElementById('filterTahun').value;
            state.prioritas = document.getElementById('filterPrioritas').value;
            state.periode = document.getElementById('filterPeriode').value;
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
            document.getElementById('filterTahun').value = '';
            document.getElementById('filterPrioritas').value = '';
            document.getElementById('filterPeriode').value = '';
            Object.assign(state, {
                search: '',
                tahun: '',
                prioritas: '',
                periode: '',
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
            const s = document.getElementById('filterTahun');
            (options.tahun || []).forEach(v => {
                const o = document.createElement('option');
                o.value = v;
                o.textContent = v;
                s.appendChild(o);
            });
            filterOptionsLoaded = true;
        }

        function periodeCellHtml(status) {
            if (!status || !STATUS_ICON[status]) return '<span class="periode-dash">–</span>';
            const title = STATUS_LABEL[status];
            return `<span title="${title}">${STATUS_ICON[status]}</span>`;
        }

        function renderTable(rows, meta) {
            const tbody = document.getElementById('tableBody');
            const colspan = 6 + PERIODE.length + 1;
            if (!rows || rows.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="${colspan}"><div class="empty-state"><div class="empty-state-title">Data tidak ditemukan</div></div></td></tr>`;
                return;
            }
            const startNo = (meta.from || 1);
            tbody.innerHTML = rows.map((row, idx) => {
                const jadwal = row.jadwal || {};
                const periodeCells = PERIODE.map(p => `<td class="periode-cell">${periodeCellHtml(jadwal[p])}</td>`)
                    .join('');
                const prioritasClass = row.prioritas === 'Tinggi' ? 'sp-red' : (row.prioritas === 'Sedang' ?
                    'sp-amber' : 'sp-gray');
                return `
                <tr>
                    <td>${startNo + idx}</td>
                    <td><div class="td-topik-main">${escapeHtml(row.topik_pelatihan || '-')}</div><div class="td-topik-sub">Tahun ${escapeHtml(row.tahun ?? '-')}</div></td>
                    <td><span class="status-pill ${prioritasClass}">${escapeHtml(row.prioritas || '-')}</span></td>
                    <td>${escapeHtml(row.peserta_estimasi || '-')}</td>
                    <td>${row.durasi_jam ?? '-'}</td>
                    <td>${formatRupiah(row.anggaran_estimasi)}</td>
                    ${periodeCells}
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Detail</button>
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openFormModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-outline" style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);" onclick="deleteData(${row.id}, ${JSON.stringify(row.topik_pelatihan || 'data ini')})">Hapus</button>
                    </td>
                </tr>`;
            }).join('');
        }

        function renderPagination(meta) {
            document.getElementById('paginationText').textContent = meta.total > 0 ?
                `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> rencana pelatihan ditemukan`;
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

        function renderSummary(rows, meta) {
            document.getElementById('sumTotalProgram').textContent = meta.total ?? 0;
            const tinggiCount = (rows || []).filter(r => r.prioritas === 'Tinggi').length;
            document.getElementById('sumPrioritasTinggi').textContent = tinggiCount + (meta.total > rows.length ? '+' : '');
            document.getElementById('sumTotalAnggaran').textContent = formatRupiah(meta.total_anggaran);
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
                renderTable(json.data, json.meta);
                renderPagination(json.meta);
                renderSummary(json.data, json.meta);
                populateFilterOptions(json.filter_options);
            } catch (e) {
                const colspan = 6 + PERIODE.length + 1;
                document.getElementById('tableBody').innerHTML =
                    `<tr><td colspan="${colspan}"><div class="error-state">${escapeHtml(e.message)}</div></td></tr>`;
            }
        }

        // ══════ MODAL FORM ══════
        function openFormModal(row = null) {
            currentEditId = row ? row.id : null;
            document.getElementById('formModalTitle').textContent = row ? 'Edit Rencana Pelatihan' :
                'Tambah Rencana Pelatihan';

            document.getElementById('fTopikPelatihan').value = row?.topik_pelatihan || '';
            document.getElementById('fTahun').value = row?.tahun || new Date().getFullYear();
            document.getElementById('fPrioritas').value = row?.prioritas || 'Sedang';
            document.getElementById('fPesertaEstimasi').value = row?.peserta_estimasi || '';
            document.getElementById('fDurasiJam').value = row?.durasi_jam ?? '';
            document.getElementById('fAnggaranEstimasi').value = row?.anggaran_estimasi ?? '';
            document.getElementById('fKeterangan').value = row?.keterangan || '';

            const jadwal = row?.jadwal || {};
            PERIODE.forEach(p => {
                const el = document.getElementById(`jadwal_${p}`);
                if (el) el.value = jadwal[p] || '';
            });

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
            const topik = document.getElementById('fTopikPelatihan').value.trim();
            if (!topik) {
                showToast('Topik pelatihan wajib diisi.', 'error');
                return;
            }

            btn.disabled = true;
            const originalText = btn.textContent;
            btn.textContent = 'Menyimpan...';

            const payload = {
                topik_pelatihan: topik,
                tahun: document.getElementById('fTahun').value,
                prioritas: document.getElementById('fPrioritas').value,
                peserta_estimasi: document.getElementById('fPesertaEstimasi').value.trim(),
                durasi_jam: document.getElementById('fDurasiJam').value,
                anggaran_estimasi: document.getElementById('fAnggaranEstimasi').value,
                keterangan: document.getElementById('fKeterangan').value.trim(),
                jadwal: {}
            };
            PERIODE.forEach(p => {
                payload.jadwal[p] = document.getElementById(`jadwal_${p}`).value || null;
            });

            const isEdit = !!currentEditId;
            const url = isEdit ? `${BASE_ENDPOINT}/${currentEditId}` : STORE_ENDPOINT;
            if (isEdit) payload._method = 'PUT';

            try {
                const res = await fetch(url, {
                    method: 'POST',
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

        // ══════ MODAL DETAIL ══════
        function openDetailModal(row) {
            document.getElementById('detailAvatar').textContent = initials(row.topik_pelatihan);
            document.getElementById('detailTopikTitle').textContent = row.topik_pelatihan || '-';
            document.getElementById('detailPrioritasSub').textContent =
                `Prioritas ${row.prioritas || '-'} · Tahun ${row.tahun ?? '-'}`;

            const umum = [{
                    label: 'Peserta (Est.)',
                    value: row.peserta_estimasi || '-'
                },
                {
                    label: 'Durasi (Jam)',
                    value: row.durasi_jam ?? '-'
                },
                {
                    label: 'Anggaran (Est.)',
                    value: formatRupiah(row.anggaran_estimasi)
                },
                {
                    label: 'Keterangan',
                    value: row.keterangan || '-',
                    span: 2
                },
            ];
            document.getElementById('detailUmumGrid').innerHTML = umum.map(f =>
                `<div class="detail-field${f.span ? ' span-' + f.span : ''}"><label>${f.label}</label><div class="detail-value">${escapeHtml(f.value)}</div></div>`
            ).join('');

            const jadwal = row.jadwal || {};
            document.getElementById('detailJadwalGrid').innerHTML = PERIODE.map(p => {
                const status = jadwal[p];
                const cls = status === 'terlaksana' ? 'sp-green' : status === 'dijadwalkan' ? 'sp-blue' : status ===
                    'tertunda' ? 'sp-red' : 'sp-gray';
                const label = status ? STATUS_LABEL[status] : 'Kosong';
                return `<div class="detail-jadwal-cell"><div class="dj-label">${PERIODE_LABEL[p]}</div><span class="status-pill ${cls}">${label}</span></div>`;
            }).join('');

            document.getElementById('detailModalOverlay').classList.add('open');
        }

        function closeDetailModal() {
            document.getElementById('detailModalOverlay').classList.remove('open');
        }

        function closeDetailModalOutside(e) {
            if (e.target.id === 'detailModalOverlay') closeDetailModal();
        }

        async function deleteData(id, nama) {
            if (!confirm(`Hapus rencana pelatihan "${nama}"?`)) return;
            try {
                const res = await fetch(`${BASE_ENDPOINT}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
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
