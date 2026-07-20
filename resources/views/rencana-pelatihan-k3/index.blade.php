<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Rencana Pelatihan K3 — PT. Fokus Jasa Mitra</title>
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

        .btn-danger-text {
            color: var(--red);
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
            font-size: 14px;
        }

        .filter-select,
        .filter-date {
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

        .filter-select:focus,
        .filter-date:focus {
            border-color: #2D4B9E;
            outline: none;
        }

        .filter-date {
            background: #fff;
            cursor: text;
            min-width: 130px;
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
            min-width: 820px;
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
            border-radius: 50%;
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

        .doc-links {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .doc-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 7px;
            background: rgba(45, 75, 158, 0.08);
            color: #2D4B9E;
            text-decoration: none;
            font-size: 11px;
        }

        .doc-chip:hover {
            background: rgba(45, 75, 158, 0.16);
        }

        .doc-chip.disabled {
            color: #CBD5E1;
            background: #F0F2FA;
            pointer-events: none;
        }

        .row-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .icon-btn {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #64748B;
        }

        .icon-btn:hover {
            background: #F0F4FF;
            color: #2D4B9E;
        }

        .icon-btn.danger:hover {
            background: rgba(208, 2, 27, 0.08);
            color: var(--red);
            border-color: rgba(208, 2, 27, 0.2);
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

        /* ══════ MODAL ══════ */
        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 17, 26, 0.5);
            z-index: 60;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .modal-backdrop.open {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 14px;
            width: 100%;
            max-width: 520px;
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
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
        }

        .modal-close {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            border: none;
            background: #F0F2FA;
            color: #64748B;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 12px;
            position: relative;
        }

        .form-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            margin-bottom: 4px;
            display: block;
        }

        .form-input {
            width: 100%;
            height: 36px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            font-size: 12.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
        }

        .form-input:focus {
            border-color: #2D4B9E;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .so-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            margin-top: 4px;
            max-height: 180px;
            overflow-y: auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            z-index: 5;
            display: none;
        }

        .so-dropdown.open {
            display: block;
        }

        .so-option {
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
        }

        .so-option:hover {
            background: #F0F4FF;
        }

        .so-option-badge {
            font-size: 10px;
            color: #94A3B8;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 16px;
        }

        .form-error {
            font-size: 10.5px;
            color: var(--red);
            margin-top: 3px;
        }

        .file-input {
            padding: 6px 10px;
            line-height: 1.4;
            cursor: pointer;
        }

        .current-file {
            margin-top: 6px;
            display: none;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #64748B;
        }

        .current-file.show {
            display: flex;
        }

        .current-file img {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .current-file a {
            color: #2D4B9E;
            font-weight: 700;
            text-decoration: none;
        }

        .current-file a:hover {
            text-decoration: underline;
        }

        .thumb-cell {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            object-fit: cover;
            border: 1px solid rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        /* ══════ MODAL KONFIRMASI (HAPUS) ══════ */
        .confirm-overlay {
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

        .confirm-overlay.open {
            display: flex;
            opacity: 1;
        }

        .confirm-box {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            width: 360px;
            max-width: calc(100vw - 32px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.94) translateY(8px);
            transition: transform 0.2s ease;
        }

        .confirm-overlay.open .confirm-box {
            transform: scale(1) translateY(0);
        }

        .confirm-icon-wrap {
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

        .confirm-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 8px;
        }

        .confirm-desc {
            font-size: 12.5px;
            line-height: 1.55;
            color: #64748B;
            margin-bottom: 20px;
        }

        .confirm-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-confirm-cancel {
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

        .btn-confirm-cancel:hover {
            background: #F8F9FF;
        }

        .btn-confirm-danger {
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

        .btn-confirm-danger:hover {
            background: #A80115;
        }

        .btn-confirm-danger:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* ══════ MODAL DETAIL ══════ */
        .detail-box {
            max-width: 560px;
            width: 100%;
        }

        .detail-hdr {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .detail-hdr-left {
            display: flex;
            align-items: center;
            gap: 12px;
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

        .detail-close {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            border: none;
            background: #F0F2FA;
            color: #64748B;
            cursor: pointer;
            font-size: 14px;
        }

        .detail-body {
            max-height: 68vh;
            overflow-y: auto;
            padding-top: 14px;
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
            font-size: 11px;
            font-weight: 800;
            color: #2D4B9E;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 10px;
        }

        .detail-grid {
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

        .detail-value {
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

        .detail-value.empty {
            color: #CBD5E1;
        }

        a.detail-link {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 600;
            color: #2D4B9E;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        a.detail-link:hover {
            text-decoration: underline;
        }

        a.detail-link img {
            width: 28px;
            height: 28px;
            border-radius: 5px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .detail-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 16px;
        }

        /* ══════ TOAST ══════ */
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
            font-size: 11px;
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

        @media (max-width: 640px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-field.span-2 {
                grid-column: span 1;
            }
        }

        @media (max-width: 640px) {
            .pg-title {
                font-size: 24px;
            }

            .page-hdr-top {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-select,
            .filter-date {
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

            .form-grid-2 {
                grid-template-columns: 1fr;
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

        <!-- TOPBAR -->
        @include('partials.topbar')


        <!-- PAGE CONTENT -->
        <div id="page-content">

            <div class="page-hdr">
                <div class="page-hdr-top">

                    <div>

                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>

                            <span class="pg-eyebrow">
                                Data Master K3 · PT. Fokus Jasa Mitra
                            </span>
                        </div>

                        <div class="pg-title">
                            RENCANA <span>IMPLEMENTASI PELATIHAN K3</span>
                        </div>

                        <div class="pg-sub">
                            Kelola seluruh rencana implementasi pelatihan K3 tahunan berdasarkan prioritas,
                            peserta, anggaran, jadwal pelaksanaan serta status implementasi.
                        </div>

                    </div>

                    <div class="pg-actions">

                        <button class="btn-primary" onclick="openCreateModal()">

                            <svg style="width:12px;height:12px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.5v15m7.5-7.5h-15" />

                            </svg>

                            Tambah Pelatihan

                        </button>

                    </div>

                </div>
            </div>

            <div class="section-card">
                <div class="filter-bar">

                    <div class="filter-search">

                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />

                        </svg>

                        <input type="text" id="searchInput" placeholder="Cari topik pelatihan..."
                            oninput="onSearchInput()">

                    </div>

                    <select id="filterPrioritas" class="filter-select" onchange="onFilterChange()">

                        <option value="">Semua Prioritas</option>
                        <option>Tinggi</option>
                        <option>Sedang</option>
                        <option>Rendah</option>

                    </select>

                    <select id="filterStatus" class="filter-select" onchange="onFilterChange()">

                        <option value="">Semua Status</option>

                        <option>Dijadwalkan</option>
                        <option>Terlaksana</option>
                        <option>Tertunda</option>

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

                    <button class="btn-outline" onclick="resetFilters()">

                        Reset Filter

                    </button>

                </div>

                <div class="data-summary" id="dataSummary">
                    <strong>Total Pelatihan :</strong>
                    <span id="totalPelatihan">0</span>

                    &nbsp; | &nbsp;

                    <strong>Terlaksana :</strong>
                    <span id="totalTerlaksana">0</span>

                    &nbsp; | &nbsp;

                    <strong>Dijadwalkan :</strong>
                    <span id="totalJadwal">0</span>

                    &nbsp; | &nbsp;

                    <strong>Total Anggaran :</strong>

                    <span id="totalAnggaran">

                        Rp 0

                    </span>

                </div>


                <div class="rtable-wrap">

                    <table class="rtable">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Topik Pelatihan</th>

                                <th>Prioritas</th>

                                <th>Peserta</th>

                                <th>Durasi</th>

                                <th>Anggaran</th>

                                <th>Bulan</th>

                                <th>Status</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody id="tableBody">

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

            <!-- ══════ MODAL TAMBAH / EDIT TBM ══════ -->
            <div class="modal-backdrop" id="tbmModal" onclick="closeFormModalOutside(event)">
                <div class="modal-box" onclick="event.stopPropagation()">
                    <div class="modal-box">
                        <div class="modal-hdr">
                            <div class="modal-title" id="modalTitle">TAMBAH TBM</div>
                        </div>

                        <form id="tbmForm" enctype="multipart/form-data" onsubmit="submitForm(event)"> <input
                                type="hidden" id="tbmId" value="" />
                            <div id="formErrorBox"
                                style="
                                        display:none;
                                        margin-bottom:15px;
                                        padding:10px 14px;
                                        border-radius:8px;
                                        background:#FEF2F2;
                                        color:#DC2626;
                                        font-size:13px;
                                        font-weight:600;
                                ">
                            </div>
                            <div class="form-grid-2">

                                <div class="form-group">

                                    <label class="form-label">

                                        Topik Pelatihan

                                    </label>

                                    <input class="form-input" id="fTopik">

                                </div>

                                <div class="form-group">

                                    <label class="form-label">

                                        Prioritas

                                    </label>

                                    <select class="form-select" id="fPrioritas">

                                        <option>Tinggi</option>
                                        <option>Sedang</option>
                                        <option>Rendah</option>

                                    </select>

                                </div>

                            </div>

                            <div class="form-grid-2">

                                <div class="form-group">

                                    <label class="form-label">

                                        Jumlah Peserta

                                    </label>

                                    <input type="number" class="form-input" id="fPeserta">

                                </div>

                                <div class="form-group">

                                    <label class="form-label">

                                        Durasi (Jam)

                                    </label>

                                    <input type="number" class="form-input" id="fDurasi">

                                </div>

                            </div>

                            <div class="form-grid-2">

                                <div class="form-group">

                                    <label class="form-label">

                                        Estimasi Anggaran

                                    </label>

                                    <input type="number" class="form-input" id="fAnggaran">

                                </div>

                                <div class="form-group">

                                    <label class="form-label">

                                        Bulan Pelaksanaan

                                    </label>

                                    <select id="fBulan" class="form-select">

                                        <option value="1">Januari</option>

                                        ...

                                        <option value="12">Desember</option>

                                    </select>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label">

                                    Status

                                </label>

                                <select id="fStatus" class="form-select">

                                    <option>Dijadwalkan</option>

                                    <option>Terlaksana</option>

                                    <option>Tertunda</option>

                                </select>

                            </div>

                            <div class="form-group">

                                <label class="form-label">

                                    Keterangan

                                </label>

                                <textarea id="fKeterangan" class="form-textarea" rows="4"></textarea>

                            </div>
                        </form>

                        <div class="modal-footer">

                            <button type="button" class="btn-outline" onclick="closeModal()">

                                Batal

                            </button>

                            <button type="submit" id="submitBtn" form="tbmForm" class="btn-primary">

                                Simpan

                            </button>

                        </div>
                    </div>
                </div>

                <!-- ══════ MODAL DETAIL TBM ══════ -->
                <div class="confirm-overlay" id="detailModalOverlay" onclick="closeDetailModalOutside(event)">
                    <div class="confirm-box detail-box" onclick="event.stopPropagation()">
                        <div class="detail-hdr">
                            <div class="detail-hdr-left">
                                <div class="detail-avatar" id="detailAvatar">--</div>
                                <div>
                                    <div class="confirm-title" id="detailNamaTitle" style="margin-bottom:2px;">-
                                    </div>
                                    <div class="detail-subtitle" id="detailBadgeSub">-</div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-body">
                            <div class="detail-section">
                                <div class="detail-section-title">Data Umum</div>
                                <div class="detail-grid" id="detailUmumGrid"></div>
                            </div>
                            <div class="detail-section">
                                <div class="detail-section-title">Dokumentasi</div>
                                <div class="detail-grid" id="detailDokumenGrid"></div>
                            </div>
                        </div>

                        <div class="detail-footer">
                            <button class="btn-confirm-cancel" onclick="closeDetailModal()">Tutup</button>
                            <button class="btn-modal-confirm-edit" onclick="editFromDetail()"
                                style="padding:8px 16px;border-radius:8px;border:none;background:#2D4B9E;font-size:12px;font-weight:700;color:#fff;cursor:pointer;">Edit
                                Data</button>
                        </div>
                    </div>
                </div>

                <!-- ══════ MODAL KONFIRMASI HAPUS ══════ -->
                <div class="confirm-overlay" id="confirmDeleteOverlay" onclick="closeDeleteConfirmOutside(event)">
                    <div class="confirm-box" onclick="event.stopPropagation()">
                        <div class="confirm-icon-wrap">
                            <svg style="width:20px;height:20px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </div>
                        <div class="confirm-title">Hapus Data Toolbox Meeting?</div>
                        <div class="confirm-desc" id="confirmDeleteDesc">Tindakan ini tidak dapat dibatalkan. Semua
                            dokumen (foto & laporan) yang terlampir juga akan ikut dihapus.</div>
                        <div class="confirm-actions">
                            <button class="btn-confirm-cancel" onclick="closeDeleteConfirm()">Batal</button>
                            <button class="btn-confirm-danger" id="btnConfirmDelete" onclick="confirmDelete()">Ya,
                                Hapus</button>
                        </div>
                    </div>
                </div>

                <div id="toastContainer" class="toast-container"></div>

            </div>
        </div>

        <script>
            const API_ENDPOINT = "{{ route('tbm.data') }}";
            const STORE_ENDPOINT = "{{ route('tbm.store') }}";
            const CARI_SO_ENDPOINT = "{{ route('tbm.cari-so') }}";
            const CSRF_TOKEN = "{{ csrf_token() }}";

            const state = {
                search: '',
                area_kerja: '',
                unit_kerja: '',
                tanggal_mulai: '',
                tanggal_selesai: '',
                page: 1,
                per_page: 10,
            };

            let searchDebounce = null;
            let soSearchDebounce = null;
            let filterOptionsLoaded = false;

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

            function showToast(message, type = 'success') {
                const container = document.getElementById('toastContainer');
                const toast = document.createElement('div');
                toast.className = `toast ${type === 'error' ? 'toast-error' : ''}`;
                toast.innerHTML = `
            <div class="toast-icon">${type === 'error' ? '✕' : '✓'}</div>
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
                state.unit_kerja = document.getElementById('filterUnitKerja').value;
                state.tanggal_mulai = document.getElementById('filterTanggalMulai').value;
                state.tanggal_selesai = document.getElementById('filterTanggalSelesai').value;
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
                document.getElementById('filterUnitKerja').value = '';
                document.getElementById('filterTanggalMulai').value = '';
                document.getElementById('filterTanggalSelesai').value = '';
                Object.assign(state, {
                    search: '',
                    area_kerja: '',
                    unit_kerja: '',
                    tanggal_mulai: '',
                    tanggal_selesai: '',
                    page: 1
                });
                loadData();
            }

            function goToPage(page) {
                state.page = page;
                loadData();
                window.scrollTo({
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
                build('filterUnitKerja', options.unit_kerja || []);
                filterOptionsLoaded = true;
            }

            function isImageUrl(url) {
                return /\.(jpe?g|png|gif|webp)(\?.*)?$/i.test(url || '');
            }

            function docChip(url, label, iconPath) {
                if (!url) {
                    return `<span class="doc-chip disabled" title="Tidak ada ${label}">${iconPath}</span>`;
                }
                if (isImageUrl(url)) {
                    return `<a href="${escapeHtml(url)}" target="_blank" rel="noopener" title="${label}"><img class="thumb-cell" src="${escapeHtml(url)}" alt="${label}" /></a>`;
                }
                return `<a class="doc-chip" href="${escapeHtml(url)}" target="_blank" rel="noopener" title="${label}">${iconPath}</a>`;
            }

            // ══════ MODAL DETAIL ══════
            let detailCurrentRow = null;

            function buildDetailValue(value) {
                const filled = value && value !== '-';
                return `<div class="detail-value${filled ? '' : ' empty'}">${escapeHtml(filled ? value : 'Belum diisi')}</div>`;
            }

            function buildDetailFile(url, label) {
                if (!url) {
                    return `<div class="detail-value empty">Belum ada ${label.toLowerCase()}</div>`;
                }
                const thumb = isImageUrl(url) ? `<img src="${escapeHtml(url)}" alt="${label}" />` : '';
                return `<a class="detail-link" href="${escapeHtml(url)}" target="_blank" rel="noopener">${thumb}<span>Buka ${label} ↗</span></a>`;
            }

            function openDetailModal(row) {
                detailCurrentRow = row;
                document.getElementById('detailAvatar').textContent = initials(row.nama_so);
                document.getElementById('detailNamaTitle').textContent = row.nama_so && row.nama_so !== '-' ? row.nama_so :
                    'Belum ada Safety Officer';
                document.getElementById('detailBadgeSub').textContent = row.badge_so && row.badge_so !== '-' ? row.badge_so :
                    '-';

                document.getElementById('detailUmumGrid').innerHTML = `
            <div class="detail-field"><label>Tanggal</label>${buildDetailValue(formatDate(row.tanggal))}</div>
            <div class="detail-field"><label>Safety Officer</label>${buildDetailValue(row.nama_so)}</div>
            <div class="detail-field"><label>Area Kerja</label>${buildDetailValue(row.area_kerja)}</div>
            <div class="detail-field"><label>Unit Kerja</label>${buildDetailValue(row.unit_kerja)}</div>
        `;

                document.getElementById('detailDokumenGrid').innerHTML = `
            <div class="detail-field"><label>Foto TBM</label>${buildDetailFile(row.foto_tbm, 'Foto TBM')}</div>
            <div class="detail-field"><label>Foto Daftar Hadir</label>${buildDetailFile(row.foto_daftar_hadir, 'Daftar Hadir')}</div>
            <div class="detail-field span-2"><label>Dokumen Laporan Kegiatan</label>${buildDetailFile(row.dokumen_laporan_kegiatan, 'Dokumen Laporan')}</div>
        `;

                document.getElementById('detailModalOverlay').classList.add('open');
            }

            function closeDetailModal() {
                document.getElementById('detailModalOverlay').classList.remove('open');
                detailCurrentRow = null;
            }

            function closeFormModalOutside(e) {
                // Sesuaikan ID dengan id div overlay modal Anda di HTML
                if (e.target.id === 'formModalOverlay' || e.target.id === 'tbmModal') {
                    closeModal();
                }
            }

            function closeDetailModalOutside(e) {
                if (e.target.id === 'detailModalOverlay') {
                    closeDetailModal();
                }
            }

            function editFromDetail() {
                if (!detailCurrentRow) return;
                const row = detailCurrentRow;
                closeDetailModal();
                openEditModal(row);
            }

            // ══════ MODAL KONFIRMASI HAPUS ══════
            let pendingDeleteId = null;

            function openDeleteConfirm(id, label) {
                pendingDeleteId = id;
                document.getElementById('confirmDeleteDesc').textContent =
                    `Data TBM untuk "${label}" akan dihapus permanen beserta seluruh dokumen (foto & laporan) yang terlampir. Tindakan ini tidak dapat dibatalkan.`;
                document.getElementById('confirmDeleteOverlay').classList.add('open');
            }

            function closeDeleteConfirm() {
                document.getElementById('confirmDeleteOverlay').classList.remove('open');
                pendingDeleteId = null;
            }

            function closeDeleteConfirmOutside(e) {
                if (e.target.id === 'confirmDeleteOverlay') closeDeleteConfirm();
            }

            async function confirmDelete() {
                if (!pendingDeleteId) return;
                const btn = document.getElementById('btnConfirmDelete');
                const id = pendingDeleteId;

                btn.disabled = true;
                btn.textContent = 'Menghapus...';

                try {
                    const res = await fetch(`${STORE_ENDPOINT}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                    });
                    const json = await res.json();
                    if (!res.ok) throw new Error(json.message || 'Gagal menghapus data.');

                    closeDeleteConfirm();
                    showToast(json.message || 'Data toolbox meeting berhasil dihapus.', 'success');
                    loadData();
                } catch (err) {
                    showToast(err.message || 'Gagal menghapus data.', 'error');
                } finally {
                    btn.disabled = false;
                    btn.textContent = 'Ya, Hapus';
                }
            }

            function renderTable(rows) {
                const tbody = document.getElementById('tableBody');

                if (!rows || rows.length === 0) {
                    // Menggunakan gaya empty state yang lebih ringkas dari script referensi (disesuaikan dengan 6 kolom)
                    tbody.innerHTML =
                        `<tr><td colspan="6"><div class="empty-state"><div class="empty-state-title">Data tidak ditemukan</div></div></td></tr>`;
                    return;
                }

                // Icon tetap dipertahankan karena dibutuhkan oleh fungsi docChip() Anda
                const camIcon =
                    '<svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.174C2.999 7.58 2.25 8.507 2.25 9.574v9.176c0 1.24 1.01 2.25 2.25 2.25h15c1.24 0 2.25-1.01 2.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.174 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" /></svg>';
                const listIcon =
                    '<svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 8.25h16.5M3.75 5.25h16.5" /></svg>';
                const docIcon =
                    '<svg style="width:13px;height:13px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-1.519-2.394a2.98 2.98 0 01-1.106.235c-1.03 0-1.984-.397-2.708-1.043m3.814.808l1.519 2.394m-5.333-3.202a2.98 2.98 0 001.106.235" /></svg>';

                tbody.innerHTML = rows.map(row => `
                <tr>
                    <td style="white-space:nowrap;">${formatDate(row.tanggal)}</td>
                    <td><div class="td-name-cell"><div class="td-avatar">${escapeHtml(initials(row.nama_so))}</div><div><div class="td-name-main">${escapeHtml(row.nama_so || '-')}</div><div class="td-name-sub">${escapeHtml(row.badge_so || '-')}</div></div></div></td>
                    <td>${escapeHtml(row.area_kerja || '-')}</td>
                    <td>${escapeHtml(row.unit_kerja || '-')}</td>
                    <td>
                        <div class="doc-links">
                            ${docChip(row.foto_tbm, 'Foto TBM', camIcon)}
                            ${docChip(row.foto_daftar_hadir, 'Daftar Hadir', listIcon)}
                            ${docChip(row.dokumen_laporan_kegiatan, 'Laporan Kegiatan', docIcon)}
                        </div>
                    </td>
                    <td style="text-align:center; white-space:nowrap;">
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openDetailModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Detail</button>
                        <button class="btn-outline" style="padding:5px 8px;" onclick='openEditModal(${JSON.stringify(row).replace(/'/g, "&#39;")})'>Edit</button>
                        <button class="btn-outline" style="padding:5px 8px; color:#D0021B; border-color:rgba(208,2,27,0.25);" onclick="openDeleteConfirm(${row.id}, ${JSON.stringify(row.nama_so || 'data ini').replace(/"/g, '&quot;')})">Hapus</button>
                    </td>
                </tr>
            `).join('');
            }

            function renderError(message) {
                document.getElementById('tableBody').innerHTML = `
            <tr>
                <td colspan="6">
                    <div class="error-state">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                        </svg>
                        <div class="error-state-title">Gagal memuat data</div>
                        <div class="error-state-sub">${escapeHtml(message)}</div>
                    </div>
                </td>
            </tr>`;
                document.getElementById('paginationText').textContent = '—';
                document.getElementById('paginationPages').innerHTML = '';
                document.getElementById('dataSummary').textContent = 'Gagal memuat data toolbox meeting.';
            }

            function renderPagination(meta) {
                document.getElementById('paginationText').textContent =
                    meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` : 'Tidak ada data';

                document.getElementById('dataSummary').innerHTML =
                    `<strong>${meta.total}</strong> data toolbox meeting ditemukan`;

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
                if (state.area_kerja) params.set('area_kerja', state.area_kerja);
                if (state.unit_kerja) params.set('unit_kerja', state.unit_kerja);
                if (state.tanggal_mulai) params.set('tanggal_mulai', state.tanggal_mulai);
                if (state.tanggal_selesai) params.set('tanggal_selesai', state.tanggal_selesai);
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
                    populateFilterOptions(json.filter_options);
                } catch (e) {
                    renderError(e.message || 'Terjadi kesalahan tak terduga.');
                }
            }

            // ══════ MODAL TAMBAH / EDIT ══════
            function renderCurrentFile(containerId, url, label) {
                const el = document.getElementById(containerId);
                if (!url) {
                    el.classList.remove('show');
                    el.innerHTML = '';
                    return;
                }
                el.classList.add('show');
                el.innerHTML = isImageUrl(url) ?
                    `<img src="${escapeHtml(url)}" alt="${label}" /><span>File saat ini — pilih file baru untuk mengganti</span>` :
                    `<a href="${escapeHtml(url)}" target="_blank" rel="noopener">Lihat ${label} saat ini</a><span>— pilih file baru untuk mengganti</span>`;
            }

            function openCreateModal() {
                document.getElementById('modalTitle').textContent = 'TAMBAH TBM';
                document.getElementById('tbmForm').reset();
                document.getElementById('tbmId').value = '';
                document.getElementById('fBadgeSo').value = '';
                ['currentFotoTbm', 'currentFotoDaftarHadir', 'currentDokumenLaporan'].forEach(id => renderCurrentFile(id,
                    null));
                document.getElementById('formErrorBox').style.display = 'none';
                document.getElementById('tbmModal').classList.add('open');
            }

            function openEditModal(row) {
                document.getElementById('modalTitle').textContent = 'EDIT TBM';
                document.getElementById('tbmForm').reset();
                document.getElementById('tbmId').value = row.id;
                document.getElementById('fTanggal').value = row.tanggal || '';
                document.getElementById('fNamaSo').value = row.nama_so && row.nama_so !== '-' ? row.nama_so : '';
                document.getElementById('fBadgeSo').value = row.badge_so && row.badge_so !== '-' ? row.badge_so : '';
                document.getElementById('fAreaKerja').value = row.area_kerja && row.area_kerja !== '-' ? row.area_kerja : '';
                document.getElementById('fUnitKerja').value = row.unit_kerja && row.unit_kerja !== '-' ? row.unit_kerja : '';
                renderCurrentFile('currentFotoTbm', row.foto_tbm, 'foto TBM');
                renderCurrentFile('currentFotoDaftarHadir', row.foto_daftar_hadir, 'foto daftar hadir');
                renderCurrentFile('currentDokumenLaporan', row.dokumen_laporan_kegiatan, 'dokumen laporan');
                document.getElementById('formErrorBox').style.display = 'none';
                document.getElementById('tbmModal').classList.add('open');
            }

            function closeModal() {
                document.getElementById('tbmModal').classList.remove('open');
                document.getElementById('soDropdown').classList.remove('open');
            }

            function onSoSearch() {
                document.getElementById('fBadgeSo').value = '';
                clearTimeout(soSearchDebounce);
                const term = document.getElementById('fNamaSo').value.trim();
                soSearchDebounce = setTimeout(async () => {
                    const dropdown = document.getElementById('soDropdown');
                    try {
                        const res = await fetch(`${CARI_SO_ENDPOINT}?search=${encodeURIComponent(term)}`, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                        const json = await res.json();
                        const results = json.data || [];
                        if (results.length === 0) {
                            dropdown.innerHTML =
                                `<div class="so-option" style="color:#94A3B8;">Tidak ada Safety Officer ditemukan</div>`;
                        } else {
                            dropdown.innerHTML = results.map(so => `
                        <div class="so-option" onclick='selectSo(${JSON.stringify(so)})'>
                            <div>${escapeHtml(so.nama)}</div>
                            <div class="so-option-badge">${escapeHtml(so.badge)}</div>
                        </div>
                    `).join('');
                        }
                        dropdown.classList.add('open');
                    } catch (e) {
                        dropdown.classList.remove('open');
                    }
                }, 300);
            }

            function selectSo(so) {
                document.getElementById('fNamaSo').value = so.nama;
                document.getElementById('fBadgeSo').value = so.badge;
                document.getElementById('soDropdown').classList.remove('open');
            }

            document.addEventListener('click', (e) => {
                // Menutup Modal Form (Tambah/Edit)
                if (e.target.id === 'tbmModal' || e.target.id === 'formModalOverlay') {
                    closeModal();
                }

                // Menutup Modal Detail
                if (e.target.id === 'detailModalOverlay') {
                    closeDetailModal();
                }

                // Menutup Modal Konfirmasi Hapus
                if (e.target.id === 'confirmDeleteOverlay') {
                    closeDeleteConfirm();
                }

                // (Kode Anda yang sudah ada untuk menutup dropdown)
                if (!e.target.closest('.form-group')) {
                    document.getElementById('soDropdown')?.classList.remove('open');
                }
            });

            async function submitForm(e) {
                e.preventDefault();
                const id = document.getElementById('tbmId').value;

                const formData = new FormData();
                formData.append(
                    'topik',
                    document.getElementById('fTopik').value);

                formData.append(
                    'prioritas',
                    document.getElementById('fPrioritas').value);

                formData.append(
                    'peserta',
                    document.getElementById('fPeserta').value);

                formData.append(
                    'durasi',
                    document.getElementById('fDurasi').value);

                formData.append(
                    'anggaran',
                    document.getElementById('fAnggaran').value);

                formData.append(
                    'bulan',
                    document.getElementById('fBulan').value);

                formData.append(
                    'status',
                    document.getElementById('fStatus').value);

                formData.append(
                    'keterangan',
                    document.getElementById('fKeterangan').value);

                // Laravel tidak bisa membaca file dari request PUT native, jadi form
                // dikirim sebagai POST dengan method spoofing saat mode edit.
                if (id) formData.append('_method', 'PUT');

                const url = id ? `${STORE_ENDPOINT}/${id}` : STORE_ENDPOINT;
                const submitBtn = document.getElementById('submitBtn');
                const errorBox = document.getElementById('formErrorBox');

                submitBtn.disabled = true;
                submitBtn.textContent = 'Menyimpan...';
                errorBox.style.display = 'none';

                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN,
                        },
                        body: formData,
                    });

                    const json = await res.json();

                    if (!res.ok) {
                        const msg = json.errors ?
                            Object.values(json.errors).flat().join(' ') :
                            (json.message || 'Gagal menyimpan data.');
                        throw new Error(msg);
                    }

                    closeModal();
                    loadData();
                } catch (err) {
                    errorBox.textContent = err.message;
                    errorBox.style.display = 'block';
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Simpan';
                }
            }

            async function deleteRow(id) {
                if (!confirm('Hapus data toolbox meeting ini? Tindakan ini tidak dapat dibatalkan.')) return;

                try {
                    const res = await fetch(`${STORE_ENDPOINT}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                    });
                    const json = await res.json();
                    if (!res.ok) throw new Error(json.message || 'Gagal menghapus data.');
                    loadData();
                } catch (err) {
                    alert(err.message);
                }
            }

            document.addEventListener('DOMContentLoaded', loadData);
        </script>


</body>

</html>
