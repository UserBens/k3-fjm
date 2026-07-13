<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Data Safety Officer — PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bebas+Neue&display=swap"
        rel="stylesheet" />
    <style>
        /* ══════ TABS ══════ */
        .tab-bar {
            display: flex;
            gap: 4px;
            margin-bottom: 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .tab-btn {
            padding: 10px 16px;
            font-size: 12.5px;
            font-weight: 700;
            color: #94A3B8;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.15s;
        }

        .tab-btn:hover {
            color: #2D4B9E;
        }

        .tab-btn.active {
            color: #2D4B9E;
            border-bottom-color: #2D4B9E;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        /* ══════ PANEL MANAJEMEN (Tab 2) ══════ */
        .mgmt-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 16px;
        }

        @media (max-width: 900px) {
            .mgmt-grid {
                grid-template-columns: 1fr;
            }
        }

        .mgmt-so-list {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 10px;
            max-height: 520px;
            overflow-y: auto;
        }

        .mgmt-so-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            cursor: pointer;
            transition: background 0.15s;
        }

        .mgmt-so-item:hover {
            background: #F8F9FF;
        }

        .mgmt-so-item.active-so {
            background: #EEF2FF;
            border-left: 3px solid #2D4B9E;
        }

        .mgmt-so-item:last-child {
            border-bottom: none;
        }

        .mgmt-so-name {
            font-size: 12.5px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .mgmt-so-sub {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
            margin-top: 1px;
        }

        .btn-lepas-so {
            background: none;
            border: none;
            color: #D0021B;
            cursor: pointer;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 6px;
            flex-shrink: 0;
        }

        .btn-lepas-so:hover {
            text-decoration: underline;
        }

        .mgmt-panel-detail {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 10px;
            padding: 16px;
            min-height: 200px;
        }

        .mgmt-empty-hint {
            text-align: center;
            color: #94A3B8;
            font-size: 12.5px;
            padding: 60px 12px;
        }

        /* Picker list item (reuse style seperti binaan-item) */
        .picker-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .picker-item:last-child {
            border-bottom: none;
        }

        .picker-item-name {
            font-size: 12.5px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .picker-item-sub {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
        }

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
            min-width: 700px;
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

        .rtable tr.clickable-row {
            cursor: pointer;
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

            .search-box {
                max-width: none;
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

            .pagination-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .pagination-pages {
                justify-content: center;
            }
        }

        /* ══════ MODAL ══════ */
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
        }

        .modal-overlay.open {
            display: flex;
            opacity: 1;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 0.02em;
            color: #1A1D2E;
            margin-bottom: 8px;
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

        /* ══════ MODAL DETAIL PENGAWAS + PEGAWAI BINAAN ══════ */
        .binaan-modal-box {
            background: #fff;
            border-radius: 16px;
            width: 640px;
            max-width: calc(100vw - 32px);
            max-height: 85vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.94) translateY(8px);
            transition: transform 0.2s ease;
            overflow: hidden;
        }

        .modal-overlay.open .binaan-modal-box {
            transform: scale(1) translateY(0);
        }

        .binaan-modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .binaan-avatar {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2D4B9E, #1A1D2E);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .binaan-subtitle {
            font-size: 12px;
            color: #94A3B8;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            cursor: pointer;
            color: #94A3B8;
            font-size: 16px;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            background: #F0F2FA;
            color: #1A1D2E;
        }

        .binaan-modal-body {
            padding: 16px 24px 20px;
            overflow-y: auto;
            flex: 1;
        }

        .binaan-search {
            width: 100%;
            height: 34px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            font-size: 12px;
            margin-bottom: 12px;
            outline: none;
            font-family: inherit;
        }

        .binaan-search:focus {
            border-color: #2D4B9E;
        }

        .binaan-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .binaan-item:last-child {
            border-bottom: none;
        }

        .binaan-item-name {
            font-size: 12.5px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .binaan-item-sub {
            font-size: 10.5px;
            color: #94A3B8;
            font-weight: 600;
            margin-top: 1px;
        }

        .binaan-loading,
        .binaan-empty {
            text-align: center;
            padding: 32px 12px;
            color: #94A3B8;
            font-size: 12.5px;
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

        .filter-select {
            height: 36px;
            min-width: 220px;
            padding: 0 38px 0 12px;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            background-color: #FFFFFF;
            color: #374151;
            font-size: 12px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            outline: none;

            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;

            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            transition: all .2s ease;
        }

        .filter-select:hover {
            border-color: #CBD5E1;
        }

        .filter-select:focus {
            border-color: #2D4B9E;
            box-shadow: 0 0 0 3px rgba(45, 75, 158, .12);
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

        <div id="page-content">

            <div class="page-hdr">
                <div class="page-hdr-top">
                    <div>
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                            <span class="pulse-dot"></span>
                            <span class="pg-eyebrow">Database Safety Officer · PT. Fokus Jasa Mitra</span>
                        </div>
                        <div class="pg-title">DATA SAFETY <span>OFFICER</span></div>
                        <div class="pg-sub">Kelola Safety Officer beserta tenaga kerja yang menjadi tanggung jawabnya.
                        </div>
                    </div>
                    <div class="pg-actions">
                        <button class="btn-outline" onclick="refreshActiveTab()">
                            <svg style="width:12px;height:12px;display:inline;margin-right:4px" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Muat Ulang
                        </button>
                    </div>
                </div>
            </div>

            <!-- TAB BAR -->
            <div class="tab-bar">
                <button class="tab-btn active" id="tabBtnList" onclick="switchTab('list')">Daftar Safety
                    Officer</button>
                <button class="tab-btn" id="tabBtnManage" onclick="switchTab('manage')">Manajemen Safety
                    Officer</button>
            </div>

            <!-- ══════ TAB 1: DAFTAR ══════ -->
            <div class="tab-panel active" id="panelList">
                <div class="section-card" style="margin-bottom:14px;">
                    <div class="filter-bar">
                        <div class="filter-search">
                            <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" id="searchInput" placeholder="Cari nama atau badge Safety Officer..."
                                oninput="onSearchInput()" />
                        </div>
                        <select id="filterDepartemen" class="filter-select" onchange="onFilterChange()">
                            <option value="">Semua Departemen</option>
                        </select>
                        {{-- <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button> --}}
                    </div>

                    <div class="data-summary" id="dataSummary">Memuat data Safety Officer...</div>

                    <div class="rtable-wrap">
                        <table class="rtable">
                            <thead>
                                <tr>
                                    <th>Safety Officer</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Lokasi</th>
                                    <th>Jumlah Tenaga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <tr>
                                    <td colspan="6">
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

            <!-- ══════ TAB 2: MANAJEMEN ══════ -->
            <div class="tab-panel" id="panelManage">
                <div class="section-card">
                    <div class="mgmt-grid">
                        <!-- KIRI: daftar SO + tambah SO baru -->
                        <div>
                            <div
                                style="display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
                                <div class="pg-sub" style="margin:0; font-weight:700; color:#1A1D2E;">Daftar Safety
                                    Officer</div>
                                <button class="btn-primary" style="padding:5px 10px; font-size:10.5px;"
                                    onclick="openTambahSOModal()">
                                    <svg style="width:11px;height:11px;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah
                                </button>
                            </div>
                            <div class="mgmt-so-list" id="mgmtSoList">
                                <div class="binaan-loading">Memuat...</div>
                            </div>
                        </div>

                        <!-- KANAN: detail tenaga binaan SO yang dipilih -->
                        <div>
                            <div
                                style="display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
                                <div class="pg-sub" style="margin:0; font-weight:700; color:#1A1D2E;"
                                    id="mgmtDetailTitle">
                                    Pilih Safety Officer di sebelah kiri
                                </div>
                                <button class="btn-primary" style="padding:5px 10px; font-size:10.5px; display:none;"
                                    id="btnTambahTenaga" onclick="openTambahTenagaModal()">
                                    <svg style="width:11px;height:11px;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Tenaga
                                </button>
                            </div>
                            <div class="mgmt-panel-detail" id="mgmtDetailBody">
                                <div class="mgmt-empty-hint">Klik salah satu Safety Officer di daftar sebelah kiri
                                    untuk mengelola tenaga.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- ══════ MODAL KONFIRMASI LEPAS SO ══════ -->
    {{-- <div id="removeConfirmOverlay" class="modal-overlay" onclick="closeRemoveModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div class="modal-title">Lepas dari Safety Officer?</div>
            <div class="modal-desc" id="removeModalDesc">
                Pegawai ini akan dilepas dari daftar Safety Officer. Catatan: jika badge-nya masih ada di daftar
                whitelist kode, status ini akan otomatis kembali aktif saat Sync Pegawai berikutnya dijalankan.
            </div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeRemoveModal()">Batal</button>
                <button class="btn-modal-danger" onclick="confirmRemove()">Ya, Lepas</button>
            </div>
        </div>
    </div> --}}

    <!-- ══════ MODAL DETAIL TENAGA (TAB 1, read-only) ══════ -->
    <div class="modal-overlay" id="detailBinaanOverlay" onclick="closeDetailBinaanOutside(event)">
        <div class="binaan-modal-box" onclick="event.stopPropagation()">
            <div class="binaan-modal-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="binaan-avatar" id="detailBinaanAvatar">--</div>
                    <div>
                        <div class="modal-title" id="detailBinaanTitle" style="margin-bottom:2px;">-</div>
                        <div class="binaan-subtitle">Daftar Tenaga</div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeDetailBinaan()">✕</button>
            </div>
            <div class="binaan-modal-body">
                <input type="text" id="detailBinaanSearch" class="binaan-search"
                    placeholder="Cari nama atau badge tenaga..." oninput="onDetailBinaanSearch()" />
                <div id="detailBinaanList">
                    <div class="binaan-loading">Memuat...</div>
                </div>
                <div class="pagination-bar" id="detailBinaanPagBar" style="display:none;">
                    <div class="pagination-info"><span id="detailBinaanPagText">—</span></div>
                    <div class="pagination-pages" id="detailBinaanPagPages"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL TAMBAH SAFETY OFFICER BARU ══════ -->
    <div class="modal-overlay" id="tambahSOOverlay" onclick="closeTambahSOModalOutside(event)">
        <div class="binaan-modal-box" style="width:460px;" onclick="event.stopPropagation()">
            <div class="binaan-modal-header">
                <div class="modal-title">Tambah Safety Officer</div>
                <button class="modal-close" onclick="closeTambahSOModal()">✕</button>
            </div>
            <div class="binaan-modal-body">
                <input type="text" id="tambahSOSearch" class="binaan-search"
                    placeholder="Cari nama atau badge pegawai..." oninput="onTambahSOSearch()" />
                <div id="tambahSOList">
                    <div class="binaan-loading">Ketik untuk mencari pegawai...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════ MODAL TAMBAH TENAGA BINAAN (Tab 2) ══════ -->
    <div class="modal-overlay" id="tambahTenagaOverlay" onclick="closeTambahTenagaModalOutside(event)">
        <div class="binaan-modal-box" style="width:460px;" onclick="event.stopPropagation()">
            <div class="binaan-modal-header">
                <div class="modal-title">Tambah Tenaga</div>
                <button class="modal-close" onclick="closeTambahTenagaModal()">✕</button>
            </div>
            <div class="binaan-modal-body">
                <input type="text" id="tambahTenagaSearch" class="binaan-search"
                    placeholder="Cari nama atau badge tenaga..." oninput="onTambahTenagaSearch()" />
                <div id="tambahTenagaList">
                    <div class="binaan-loading">Ketik untuk mencari tenaga...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════ TOAST ══════ -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- ══════ MODAL KONFIRMASI LEPAS SO ══════ -->
    <div class="modal-overlay" id="lepasSOOverlay" onclick="closeLepasSOModalOutside(event)">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-icon-wrap">
                <svg style="width:22px;height:22px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div class="modal-title">Lepas dari Safety Officer?</div>
            <div class="modal-desc" id="lepasSODesc">
                Pegawai ini akan dilepas dari status Safety Officer.
            </div>
            <div class="modal-actions">
                <button class="btn-modal-cancel" onclick="closeLepasSOModal()">Batal</button>
                <button class="btn-modal-confirm" style="background:#D0021B;" onclick="confirmLepasSO()">Ya,
                    Lepas</button>
            </div>
        </div>
    </div>

    <script>
        const DATA_ENDPOINT = "{{ route('safety-officer.data') }}";
        const BASE_ENDPOINT = "{{ url('/safety-officer') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        const state = {
            search: '',
            departemen: '',
            page: 1,
            per_page: 10
        };
        let searchDebounce = null;
        let filterOptionsLoaded = false;

        // Tab 1 detail modal state
        const detailState = {
            badge: null,
            search: '',
            page: 1
        };
        let detailSearchDebounce = null;

        // Tab 2 state
        let currentMgmtSO = null; // badge SO yang lagi dipilih di panel kiri
        let tambahSODebounce = null;
        let tambahTenagaDebounce = null;

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

        function renderPaginationGeneric(meta, textEl, pagesEl, onPageFn) {
            textEl.textContent = meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} data` :
                'Tidak ada data';
            const current = meta.current_page,
                last = meta.last_page;
            let pages = [];
            pages.push(1);
            if (current > 3) pages.push('...');
            for (let p = Math.max(2, current - 1); p <= Math.min(last - 1, current + 1); p++) pages.push(p);
            if (current < last - 2) pages.push('...');
            if (last > 1) pages.push(last);
            pages = [...new Set(pages)];

            let html =
                `<button class="page-btn" ${current <= 1 ? 'disabled' : ''} onclick="(${onPageFn.name})(${current - 1})">‹</button>`;
            pages.forEach(p => {
                html += p === '...' ? `<span class="page-ellipsis">…</span>` :
                    `<button class="page-btn ${p === current ? 'active' : ''}" onclick="(${onPageFn.name})(${p})">${p}</button>`;
            });
            html +=
                `<button class="page-btn" ${current >= last ? 'disabled' : ''} onclick="(${onPageFn.name})(${current + 1})">›</button>`;
            pagesEl.innerHTML = html;
        }

        // ══════ TAB SWITCHING ══════
        function switchTab(tab) {
            document.getElementById('panelList').classList.toggle('active', tab === 'list');
            document.getElementById('panelManage').classList.toggle('active', tab === 'manage');
            document.getElementById('tabBtnList').classList.toggle('active', tab === 'list');
            document.getElementById('tabBtnManage').classList.toggle('active', tab === 'manage');

            if (tab === 'list') loadData();
            if (tab === 'manage') loadMgmtSoList();
        }

        function refreshActiveTab() {
            const isListActive = document.getElementById('panelList').classList.contains('active');
            if (isListActive) loadData();
            else loadMgmtSoList();
        }

        // ══════ TAB 1: DAFTAR ══════
        function onSearchInput() {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                state.search = document.getElementById('searchInput').value.trim();
                state.page = 1;
                loadData();
            }, 350);
        }

        function onFilterChange() {
            state.departemen = document.getElementById('filterDepartemen').value;
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
            document.getElementById('filterDepartemen').value = '';
            state.search = '';
            state.departemen = '';
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
            const select = document.getElementById('filterDepartemen');
            const current = select.value;
            (options.departemen || []).forEach(opt => {
                const el = document.createElement('option');
                el.value = opt.value;
                el.textContent = opt.label;
                select.appendChild(el);
            });
            select.value = current;
            filterOptionsLoaded = true;
        }

        function renderTable(rows) {
            const tbody = document.getElementById('tableBody');
            if (!rows || rows.length === 0) {
                tbody.innerHTML = `
        <tr><td colspan="6">
            <div class="empty-state">
                <div class="empty-state-title">Belum ada Safety Officer</div>
                <div class="empty-state-sub">Tambahkan lewat tab "Manajemen Safety Officer".</div>
            </div>
        </td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr class="clickable-row" onclick='openDetailBinaan("${row.badge}", ${JSON.stringify(row.nama)})'>
                    <td>
                        <div class="td-name-cell">
                            <div class="td-avatar">${escapeHtml(initials(row.nama))}</div>
                            <div>
                                <div class="td-name-main">${escapeHtml(row.nama)}</div>
                                <div class="td-name-sub">${escapeHtml(row.badge)} · ${escapeHtml(row.jenis_kelamin)}</div>
                            </div>
                        </div>
                    </td>
                    <td>${escapeHtml(row.jabatan)}</td>
                    <td>
                        <div style="font-weight:600; color:#334155; font-size:13px;">${escapeHtml(row.nama_unit_kerja)}</div>
                        <div class="td-name-sub">${escapeHtml(row.bagian)}</div>
                    </td>
                    <td>${escapeHtml(row.nama_lokasi)}</td>
                    <td><span class="status-pill sp-blue">${row.jumlah_tenaga} tenaga</span></td>
                    <td><span class="status-pill ${row.status === 'Aktif' ? 'sp-green' : 'sp-red'}">${escapeHtml(row.status)}</span></td>
                </tr>
            `).join('');
        }

        function renderError(message) {
            document.getElementById('tableBody').innerHTML = `
            <tr><td colspan="6"><div class="error-state">${escapeHtml(message)}</div></td></tr>`;
            document.getElementById('paginationText').textContent = '—';
            document.getElementById('paginationPages').innerHTML = '';
            document.getElementById('dataSummary').textContent = 'Gagal memuat data.';
        }

        function renderPagination(meta) {
            document.getElementById('dataSummary').innerHTML = `<strong>${meta.total}</strong> Safety Officer ditemukan`;
            renderPaginationGeneric(meta, document.getElementById('paginationText'), document.getElementById(
                'paginationPages'), goToPage);
        }

        async function loadData() {
            const params = new URLSearchParams();
            if (state.search) params.set('search', state.search);
            if (state.departemen) params.set('departemen', state.departemen);
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
            } catch (e) {
                renderError(e.message || 'Terjadi kesalahan.');
            }
        }

        // ══════ TAB 1: MODAL DETAIL (read-only) ══════
        function openDetailBinaan(badge, nama) {
            detailState.badge = badge;
            detailState.search = '';
            detailState.page = 1;
            document.getElementById('detailBinaanAvatar').textContent = initials(nama);
            document.getElementById('detailBinaanTitle').textContent = nama;
            document.getElementById('detailBinaanSearch').value = '';
            document.getElementById('detailBinaanPagBar').style.display = 'none';
            document.getElementById('detailBinaanOverlay').classList.add('open');
            loadDetailBinaan();
        }

        function closeDetailBinaan() {
            document.getElementById('detailBinaanOverlay').classList.remove('open');
            detailState.badge = null;
        }

        function closeDetailBinaanOutside(e) {
            if (e.target.id === 'detailBinaanOverlay') closeDetailBinaan();
        }

        function onDetailBinaanSearch() {
            clearTimeout(detailSearchDebounce);
            detailSearchDebounce = setTimeout(() => {
                detailState.search = document.getElementById('detailBinaanSearch').value.trim();
                detailState.page = 1;
                loadDetailBinaan();
            }, 350);
        }

        function goToDetailBinaanPage(page) {
            detailState.page = page;
            loadDetailBinaan();
        }

        async function loadDetailBinaan() {
            if (!detailState.badge) return;
            const listEl = document.getElementById('detailBinaanList');
            listEl.innerHTML = '<div class="binaan-loading">Memuat...</div>';

            const params = new URLSearchParams();
            if (detailState.search) params.set('search', detailState.search);
            params.set('page', detailState.page);
            params.set('per_page', 10);

            try {
                const res = await fetch(`${BASE_ENDPOINT}/${detailState.badge}/tenaga?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);

                if (!json.data || json.data.length === 0) {
                    listEl.innerHTML = '<div class="binaan-empty">Belum ada tenaga.</div>';
                } else {
                    listEl.innerHTML = json.data.map(p => `
                        <div class="binaan-item">
                            <div class="td-avatar">${escapeHtml(initials(p.nama))}</div>
                            <div style="flex:1; min-width:0;">
                                <div class="binaan-item-name">${escapeHtml(p.nama)}</div>
                                <div class="binaan-item-sub">${escapeHtml(p.badge)} • ${escapeHtml(p.nama_unit_kerja)} — ${escapeHtml(p.bagian)}</div>
                            </div>
                            <span class="status-pill ${p.status === 'Aktif' ? 'sp-green' : 'sp-red'}">${escapeHtml(p.status)}</span>
                        </div>
                    `).join('');
                }

                const barEl = document.getElementById('detailBinaanPagBar');
                if (json.meta.total > 0) {
                    barEl.style.display = 'flex';
                    renderPaginationGeneric(json.meta, document.getElementById('detailBinaanPagText'), document
                        .getElementById('detailBinaanPagPages'), goToDetailBinaanPage);
                } else barEl.style.display = 'none';
            } catch (e) {
                listEl.innerHTML = `<div class="binaan-empty" style="color:#D0021B;">${escapeHtml(e.message)}</div>`;
            }
        }

        // ══════ TAB 2: LIST SO DI PANEL KIRI ══════
        async function loadMgmtSoList() {
            const listEl = document.getElementById('mgmtSoList');
            listEl.innerHTML = '<div class="binaan-loading">Memuat...</div>';

            try {
                const res = await fetch(`${BASE_ENDPOINT}/list-so`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();

                if (!json.data || json.data.length === 0) {
                    listEl.innerHTML =
                        '<div class="binaan-empty">Belum ada Safety Officer. Klik "Tambah" untuk menambahkan.</div>';
                    return;
                }

                listEl.innerHTML = json.data.map(so => `
                    <div class="mgmt-so-item ${so.badge === currentMgmtSO ? 'active-so' : ''}" onclick='selectMgmtSO("${so.badge}", ${JSON.stringify(so.nama)})'>
                        <div>
                            <div class="mgmt-so-name">${escapeHtml(so.nama)}</div>
                            <div class="mgmt-so-sub">${escapeHtml(so.badge)} • ${so.jumlah_tenaga} tenaga</div>
                        </div>
                        <button class="btn-lepas-so" onclick='event.stopPropagation(); openLepasSOModal("${so.badge}", ${JSON.stringify(so.nama)})'>Lepas</button>                    </div>
                `).join('');
            } catch (e) {
                listEl.innerHTML = '<div class="binaan-empty" style="color:#D0021B;">Gagal memuat data.</div>';
            }
        }

        function selectMgmtSO(badge, nama) {
            currentMgmtSO = badge;
            document.getElementById('mgmtDetailTitle').textContent = `Tenaga — ${nama}`;
            document.getElementById('btnTambahTenaga').style.display = 'inline-flex';
            loadMgmtSoList(); // re-render supaya highlight active-so update
            loadMgmtDetail();
        }

        async function loadMgmtDetail() {
            if (!currentMgmtSO) return;
            const bodyEl = document.getElementById('mgmtDetailBody');
            bodyEl.innerHTML = '<div class="binaan-loading">Memuat...</div>';

            try {
                const res = await fetch(`${BASE_ENDPOINT}/${currentMgmtSO}/tenaga?per_page=50`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);

                if (!json.data || json.data.length === 0) {
                    bodyEl.innerHTML =
                        '<div class="mgmt-empty-hint">Belum ada tenaga. Klik "Tambah Tenaga" di atas.</div>';
                    return;
                }

                bodyEl.innerHTML = json.data.map(p => `
                    <div class="binaan-item">
                        <div class="td-avatar">${escapeHtml(initials(p.nama))}</div>
                        <div style="flex:1; min-width:0;">
                            <div class="binaan-item-name">${escapeHtml(p.nama)}</div>
                            <div class="binaan-item-sub">${escapeHtml(p.badge)} • ${escapeHtml(p.nama_unit_kerja)} — ${escapeHtml(p.bagian)}</div>
                        </div>
                        <button class="btn-lepas-so" onclick="hapusTenagaBinaan('${p.id_api}', ${JSON.stringify(p.nama)})">Hapus</button>
                    </div>
                `).join('');
            } catch (e) {
                bodyEl.innerHTML = `<div class="mgmt-empty-hint" style="color:#D0021B;">${escapeHtml(e.message)}</div>`;
            }
        }

        async function hapusTenagaBinaan(pegawaiId, nama) {
            if (!confirm(`Hapus ${nama} dari tenaga?`)) return;
            try {
                const res = await fetch(`${BASE_ENDPOINT}/${currentMgmtSO}/unassign-tenaga/${pegawaiId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);
                await loadMgmtDetail();
                await loadMgmtSoList();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menghapus.', 'error');
            }
        }

        // state untuk modal konfirmasi lepas SO
        let pendingLepasSO = null; // { badge, nama }

        function openLepasSOModal(badge, nama) {
            pendingLepasSO = {
                badge,
                nama
            };
            document.getElementById('lepasSODesc').textContent =
                `"${nama}" akan dilepas dari status Safety Officer. Semua penugasan tenaga binaannya juga akan dihapus.`;
            document.getElementById('lepasSOOverlay').classList.add('open');
        }

        function closeLepasSOModal() {
            document.getElementById('lepasSOOverlay').classList.remove('open');
            pendingLepasSO = null;
        }

        function closeLepasSOModalOutside(event) {
            if (event.target.id === 'lepasSOOverlay') closeLepasSOModal();
        }

        async function confirmLepasSO() {
            if (!pendingLepasSO) return;
            const {
                badge,
                nama
            } = pendingLepasSO;

            try {
                const res = await fetch(`${BASE_ENDPOINT}/${badge}/lepas`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    }
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);

                if (currentMgmtSO === badge) {
                    currentMgmtSO = null;
                    document.getElementById('mgmtDetailTitle').textContent = 'Pilih Safety Officer di sebelah kiri';
                    document.getElementById('btnTambahTenaga').style.display = 'none';
                    document.getElementById('mgmtDetailBody').innerHTML =
                        '<div class="mgmt-empty-hint">Klik salah satu Safety Officer di daftar sebelah kiri untuk mengelola tenaga.</div>';
                }

                closeLepasSOModal();
                await loadMgmtSoList();
                showToast(json.message, 'success');
            } catch (e) {
                closeLepasSOModal();
                showToast(e.message || 'Gagal melepas.', 'error');
            }
        }

        // ══════ MODAL TAMBAH SO BARU ══════
        function openTambahSOModal() {
            document.getElementById('tambahSOSearch').value = '';
            document.getElementById('tambahSOList').innerHTML =
                '<div class="binaan-loading">Ketik untuk mencari pegawai...</div>';
            document.getElementById('tambahSOOverlay').classList.add('open');
        }

        function closeTambahSOModal() {
            document.getElementById('tambahSOOverlay').classList.remove('open');
        }

        function closeTambahSOModalOutside(e) {
            if (e.target.id === 'tambahSOOverlay') closeTambahSOModal();
        }

        function onTambahSOSearch() {
            clearTimeout(tambahSODebounce);
            tambahSODebounce = setTimeout(searchPegawaiUntukSO, 350);
        }

        async function searchPegawaiUntukSO() {
            const search = document.getElementById('tambahSOSearch').value.trim();
            const listEl = document.getElementById('tambahSOList');
            listEl.innerHTML = '<div class="binaan-loading">Mencari...</div>';

            try {
                const res = await fetch(`${BASE_ENDPOINT}/cari-pegawai-so?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const json = await res.json();

                if (!json.data || json.data.length === 0) {
                    listEl.innerHTML = '<div class="binaan-empty">Tidak ada pegawai ditemukan.</div>';
                    return;
                }

                listEl.innerHTML = json.data.map(p => `
            <div class="picker-item">
                <div class="td-avatar">${escapeHtml(initials(p.nama))}</div>
                <div style="flex:1; min-width:0;">
                    <div class="picker-item-name">${escapeHtml(p.nama)}</div>
                    <div class="picker-item-sub">${escapeHtml(p.badge)}</div>
                </div>
                <button class="btn-primary" style="padding:5px 10px; font-size:11px;" onclick="tetapkanSOBaru('${p.id_api}')">Pilih</button>
            </div>
        `).join('');
            } catch (e) {
                listEl.innerHTML = '<div class="binaan-empty" style="color:#D0021B;">Gagal memuat data.</div>';
            }
        }

        async function tetapkanSOBaru(pegawaiId) {
            try {
                const res = await fetch(`${BASE_ENDPOINT}/tetapkan`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        pegawai_id: pegawaiId
                    })
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);

                closeTambahSOModal();
                await loadMgmtSoList();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menetapkan.', 'error');
            }
        }

        // ══════ MODAL TAMBAH TENAGA (Tab 2) ══════
        function openTambahTenagaModal() {
            if (!currentMgmtSO) return;
            document.getElementById('tambahTenagaSearch').value = '';
            document.getElementById('tambahTenagaList').innerHTML =
                '<div class="binaan-loading">Ketik untuk mencari tenaga...</div>';
            document.getElementById('tambahTenagaOverlay').classList.add('open');
        }

        function closeTambahTenagaModal() {
            document.getElementById('tambahTenagaOverlay').classList.remove('open');
        }

        function closeTambahTenagaModalOutside(e) {
            if (e.target.id === 'tambahTenagaOverlay') closeTambahTenagaModal();
        }

        function onTambahTenagaSearch() {
            clearTimeout(tambahTenagaDebounce);
            tambahTenagaDebounce = setTimeout(searchTenagaUntukSO, 350);
        }

        async function searchTenagaUntukSO() {
            const search = document.getElementById('tambahTenagaSearch').value.trim();
            const listEl = document.getElementById('tambahTenagaList');
            listEl.innerHTML = '<div class="binaan-loading">Mencari...</div>';

            try {
                const res = await fetch(
                    `${BASE_ENDPOINT}/${currentMgmtSO}/cari-tenaga?search=${encodeURIComponent(search)}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                const json = await res.json();

                if (!json.data || json.data.length === 0) {
                    listEl.innerHTML = '<div class="binaan-empty">Tidak ada tenaga ditemukan.</div>';
                    return;
                }

                listEl.innerHTML = json.data.map(t => `
            <div class="picker-item">
                <div class="td-avatar">${escapeHtml(initials(t.nama))}</div>
                <div style="flex:1; min-width:0;">
                    <div class="picker-item-name">${escapeHtml(t.nama)}</div>
                    <div class="picker-item-sub">${escapeHtml(t.badge)} • ${escapeHtml(t.nama_unit_kerja)}</div>
                </div>
                <button class="btn-primary" style="padding:5px 10px; font-size:11px;" onclick="pilihTenagaUntukSO('${t.id_api}')">Pilih</button>
            </div>
        `).join('');
            } catch (e) {
                listEl.innerHTML = '<div class="binaan-empty" style="color:#D0021B;">Gagal memuat data.</div>';
            }
        }

        async function pilihTenagaUntukSO(pegawaiId) {
            try {
                const res = await fetch(`${BASE_ENDPOINT}/${currentMgmtSO}/assign-tenaga`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        pegawai_id: pegawaiId
                    })
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.message);

                closeTambahTenagaModal();
                await loadMgmtDetail();
                await loadMgmtSoList();
                showToast(json.message, 'success');
            } catch (e) {
                showToast(e.message || 'Gagal menambahkan.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>

</html>
