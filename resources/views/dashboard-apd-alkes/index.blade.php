<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Dashboard K3 — PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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

        .search-box {
            flex: 1;
            max-width: 320px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            height: 32px;
            padding: 0 32px 0 30px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: 8px;
            background: #F8F9FF;
            font-size: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            outline: none;
            transition: border 0.2s;
        }

        .search-box input::placeholder {
            color: #94A3B8;
        }

        .search-box input:focus {
            border-color: #2D4B9E;
            background: #fff;
        }

        .search-icon {
            position: absolute;
            left: 9px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 14px;
        }

        .search-kbd {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 9px;
            font-weight: 700;
            color: #94A3B8;
            background: #F0F2FA;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 4px;
            padding: 1px 5px;
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

        /* CONTENT */
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

        /* STAT CARDS */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 14px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px 16px 10px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 6px 24px rgba(45, 75, 158, 0.1);
            transform: translateY(-2px);
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .stat-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .stat-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #1A1D2E;
            line-height: 1;
            margin-bottom: 3px;
        }

        .stat-sub {
            font-size: 10px;
            color: #94A3B8;
            font-weight: 600;
        }

        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 10px;
            font-weight: 700;
            margin-top: 4px;
            padding: 2px 6px;
            border-radius: 999px;
        }

        .trend-up {
            color: #1A7A3C;
            background: rgba(26, 122, 60, 0.08);
        }

        .trend-down {
            color: #D0021B;
            background: rgba(208, 2, 27, 0.07);
        }

        .sparkline-wrap {
            height: 36px;
            margin-top: 6px;
        }

        /* PAGE HEADER */
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

        .dashboard-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .dashboard-tab {
            border: 1px solid rgba(45, 75, 158, 0.25);
            background: #fff;
            color: #2D4B9E;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            white-space: nowrap;
        }

        .dashboard-tab:hover {
            background: #F0F4FF;
        }

        .dashboard-tab.active {
            background: #2D4B9E;
            color: #fff;
            border-color: #2D4B9E;
        }

        .dashboard-panel {
            display: none;
        }

        .dashboard-panel.active {
            display: block;
        }

        .health-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 14px;
        }

        .health-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 14px 16px 10px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .health-card:hover {
            box-shadow: 0 6px 24px rgba(45, 75, 158, 0.10);
            transform: translateY(-2px);
        }

        .health-card .label {
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 8px;
        }

        .health-card .value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #1A1D2E;
            line-height: 1;
            margin-bottom: 3px;
        }

        .health-card .sub {
            font-size: 11px;
            color: #64748B;
            margin-top: 6px;
        }

        .health-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            margin-top: 8px;
            background: rgba(26, 122, 60, 0.08);
            color: #1A7A3C;
        }

        .health-list {
            display: grid;
            gap: 10px;
        }

        .health-list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            background: #F8F9FF;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 12px;
            color: #1A1D2E;
        }

        .health-list-item span {
            font-weight: 600;
            color: #1A1D2E;
        }

        .health-list-item strong {
            color: #64748B;
            font-weight: 600;
        }

        .left-panel {
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-width: 0;
        }

        .health-chart-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 12px;
            margin-bottom: 12px;
        }

        .health-chart-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
            border: 1px solid rgba(45, 75, 158, 0.10);
            border-radius: 14px;
            padding: 14px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
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

        /* BOTTOM ROW */
        .bottom-row {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 12px;
        }

        .section-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 16px;
            min-width: 0;
        }

        .sc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .sc-title {
            font-size: 13px;
            font-weight: 700;
            color: #1A1D2E;
        }

        .sc-sub {
            font-size: 10.5px;
            color: #94A3B8;
            margin-top: 1px;
        }

        .view-all {
            font-size: 11px;
            font-weight: 700;
            color: #2D4B9E;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .chart-tabs {
            display: flex;
            gap: 4px;
        }

        .chart-tab {
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            font-size: 10.5px;
            font-weight: 700;
            color: #94A3B8;
            cursor: pointer;
            background: #F8F9FF;
            transition: all 0.15s;
        }

        .chart-tab.active {
            background: #2D4B9E;
            color: #fff;
            border-color: #2D4B9E;
        }

        /* RIGHT PANEL */
        .right-panel {
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-width: 0;
        }

        /* DONUT SECTION */
        .donut-wrap {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .donut-canvas-wrap {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
            position: relative;
        }

        .donut-center {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .donut-center-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            color: #1A1D2E;
            line-height: 1;
        }

        .donut-center-lbl {
            font-size: 9px;
            color: #94A3B8;
            font-weight: 600;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-label {
            font-size: 11px;
            color: #64748B;
            font-weight: 500;
        }

        .legend-pct {
            margin-left: auto;
            font-size: 11px;
            font-weight: 700;
            color: #1A1D2E;
        }

        /* GOALS */
        .goal-item {
            margin-bottom: 12px;
        }

        .goal-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .goal-name {
            font-size: 11.5px;
            font-weight: 600;
            color: #1A1D2E;
        }

        .goal-nums {
            font-size: 11px;
            color: #94A3B8;
        }

        .goal-bar-track {
            height: 5px;
            background: #F0F2FA;
            border-radius: 999px;
            overflow: hidden;
        }

        .goal-bar-fill {
            height: 100%;
            border-radius: 999px;
            transition: width 1s ease;
        }

        /* RECENT TABLE */
        .rtable-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .rtable {
            width: 100%;
            min-width: 620px;
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
            padding: 9px 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            vertical-align: middle;
            white-space: nowrap;
        }

        .rtable tr:last-child td {
            border-bottom: none;
        }

        .rtable tr:hover td {
            background: #F8F9FF;
        }

        .td-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #E0E7FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            color: #2D4B9E;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
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

        .amount-pos {
            color: #1A7A3C;
            font-weight: 700;
        }

        .amount-neg {
            color: #D0021B;
            font-weight: 700;
        }

        /* MIDDLE ROW */
        .middle-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px;
        }

        /* ACTIVITY FEED */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .act-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
        }

        .act-text {
            font-size: 11.5px;
            color: #1A1D2E;
            font-weight: 500;
            line-height: 1.4;
        }

        .act-time {
            font-size: 10px;
            color: #94A3B8;
            margin-top: 1px;
        }

        /* ══════ RESPONSIVE ══════ */

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

        .sb-close-btn {
            display: none;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            background: #F0F2FA;
            color: #64748B;
            cursor: pointer;
            margin-left: auto;
            flex-shrink: 0;
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

            .sb-close-btn {
                display: flex;
            }

            .bottom-row {
                grid-template-columns: 1fr;
            }

            .search-box {
                max-width: none;
            }
        }

        @media (max-width: 900px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            #topbar {
                padding: 0 12px;
                gap: 8px;
            }

            .search-kbd {
                display: none;
            }

            .tb-name {
                display: none;
            }

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

            .pg-actions {
                width: 100%;
            }

            .pg-actions .btn-outline,
            .pg-actions .btn-primary {
                flex: 1;
                justify-content: center;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .donut-wrap {
                justify-content: center;
                text-align: left;
            }
        }

        .apd-page {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
        }

        .apd-hdr {
            margin-bottom: 18px;
        }

        .apd-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .apd-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #1A1D2E;
            line-height: 1;
        }

        .apd-title span {
            color: var(--blue);
        }

        .apd-sub {
            font-size: 12px;
            color: #94A3B8;
            margin-top: 2px;
        }

        .apd-section {
            margin-bottom: 22px;
        }

        .apd-section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            font-weight: 800;
            color: var(--blue);
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .apd-section-title::before {
            content: "►";
            font-size: 10px;
        }

        .apd-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .apd-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .06);
            padding: 14px 16px;
            cursor: default;
            transition: box-shadow .2s, transform .2s;
        }

        .apd-card.is-link {
            cursor: pointer;
        }

        .apd-card.is-link:hover {
            box-shadow: 0 6px 24px rgba(45, 75, 158, .10);
            transform: translateY(-2px);
        }

        .apd-card-label {
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 8px;
            min-height: 26px;
        }

        .apd-card-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            line-height: 1;
            color: #1A1D2E;
        }

        .apd-card-val.skeleton {
            background: #EEF1FA;
            color: transparent;
            border-radius: 6px;
            display: inline-block;
            width: 50%;
        }

        .apd-card-sub {
            font-size: 10.5px;
            color: #94A3B8;
            margin-top: 4px;
            font-weight: 600;
        }

        .apd-card.state-ok .apd-card-val {
            color: var(--green);
        }

        .apd-card.state-warn .apd-card-val {
            color: var(--amber);
        }

        .apd-card.state-crit .apd-card-val {
            color: var(--red);
        }

        .apd-note {
            margin-top: 4px;
            font-size: 11px;
            color: #94A3B8;
            background: #F8F9FF;
            border: 1px solid rgba(0, 0, 0, .05);
            border-radius: 10px;
            padding: 10px 14px;
        }

        @media (max-width: 1100px) {
            .apd-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 640px) {
            .apd-grid {
                grid-template-columns: repeat(2, 1fr);
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

            <div class="apd-page">

                <div class="apd-hdr">
                    <div class="apd-eyebrow">K3 &amp; Operasional • Tahun {{ now()->year }}</div>
                    <div class="apd-title">Dashboard Manajemen <span>APD &amp; Alat Kesehatan</span></div>
                    <div class="apd-sub">PT. Fokus Jasa Mitra — semua angka diperbarui otomatis dari data Master &amp;
                        Log</div>
                </div>

                {{-- ══════ RINGKASAN STOK & NILAI PERSEDIAAN ══════ --}}
                <div class="apd-section">
                    <div class="apd-section-title">Ringkasan Stok &amp; Nilai Persediaan</div>
                    <div class="apd-grid" id="grid-ringkasan">
                        <div class="apd-card">
                            <div class="apd-card-label">Total Jenis APD</div>
                            <div class="apd-card-val skeleton" data-field="total_jenis_apd">—</div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Total Stok APD (unit)</div>
                            <div class="apd-card-val skeleton" data-field="total_stok_apd">—</div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Nilai Persediaan APD</div>
                            <div class="apd-card-val skeleton" data-field="nilai_persediaan_apd" data-format="rupiah">—
                            </div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Total Jenis Alkes</div>
                            <div class="apd-card-val skeleton" data-field="total_jenis_alkes">—</div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Total Stok Alkes</div>
                            <div class="apd-card-val skeleton" data-field="total_stok_alkes">—</div>
                        </div>
                    </div>
                </div>

                {{-- ══════ PERINGATAN (PERLU TINDAKAN) ══════ --}}
                <div class="apd-section">
                    <div class="apd-section-title">Peringatan — Perlu Tindakan</div>
                    <div class="apd-grid" id="grid-peringatan">
                        <a href="{{ route('pusat-reminder.index') }}" class="apd-card is-link" data-warn>
                            <div class="apd-card-label">APD Perlu Pengadaan</div>
                            <div class="apd-card-val skeleton" data-field="apd_perlu_pengadaan">—</div>
                        </a>
                        <a href="{{ route('pusat-reminder.index') }}" class="apd-card is-link" data-warn>
                            <div class="apd-card-label">APD Lifetime ≤30 Hari</div>
                            <div class="apd-card-val skeleton" data-field="apd_lifetime_30">—</div>
                        </a>
                        <a href="{{ route('pusat-reminder.index') }}" class="apd-card is-link" data-warn>
                            <div class="apd-card-label">Alkes Stok Kritis</div>
                            <div class="apd-card-val skeleton" data-field="alkes_stok_kritis">—</div>
                        </a>
                        <a href="{{ route('pusat-reminder.index') }}" class="apd-card is-link" data-warn>
                            <div class="apd-card-label">Kalibrasi Jatuh Tempo</div>
                            <div class="apd-card-val skeleton" data-field="kalibrasi_jatuh_tempo">—</div>
                        </a>
                        <a href="{{ route('pusat-reminder.index') }}" class="apd-card is-link" data-warn>
                            <div class="apd-card-label">Kadaluarsa ≤30 Hari</div>
                            <div class="apd-card-val skeleton" data-field="kadaluarsa_30">—</div>
                        </a>
                    </div>
                </div>

                {{-- ══════ TRANSAKSI & ANGGARAN ══════ --}}
                <div class="apd-section">
                    <div class="apd-section-title">Transaksi &amp; Anggaran</div>
                    <div class="apd-grid">
                        <div class="apd-card">
                            <div class="apd-card-label">Transaksi APD Bulan Ini</div>
                            <div class="apd-card-val skeleton" data-field="transaksi_apd_bulan_ini">—</div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Total Nilai Persediaan</div>
                            <div class="apd-card-val skeleton" data-field="total_nilai_persediaan" data-format="rupiah">
                                —</div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Grand Total RAB {{ now()->year }}</div>
                            <div class="apd-card-val skeleton" data-field="grand_total_rab" data-format="rupiah">—</div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Total Item Kritis (all)</div>
                            <div class="apd-card-val skeleton" data-field="total_item_kritis">—</div>
                        </div>
                        <div class="apd-card">
                            <div class="apd-card-label">Kategori Pekerjaan</div>
                            <div class="apd-card-val skeleton" data-field="kategori_pekerjaan">—</div>
                        </div>
                    </div>
                    {{-- <div class="apd-note">
                        Catatan: buka <strong>Pusat Reminder</strong> untuk rincian item yang perlu tindakan •
                        input transaksi di <strong>Log APD</strong> / <strong>Log Alkes</strong> •
                        ajukan anggaran di <strong>RAB</strong>.
                    </div> --}}
                </div>

            </div>


        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch("{{ route('dashboard-apd-alkes.data') }}", {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(function(res) {
                    if (!res.ok) throw new Error('Gagal memuat data dashboard');
                    return res.json();
                })
                .then(function(json) {
                    const data = Object.assign({}, json.ringkasan, json.peringatan, json.transaksi_anggaran);
                    renderValues(data);
                    markWarningStates(json.peringatan);
                })
                .catch(function(err) {
                    console.error(err);
                    document.querySelectorAll('.apd-card-val').forEach(function(el) {
                        el.classList.remove('skeleton');
                        el.textContent = '—';
                    });
                });

            function renderValues(data) {
                document.querySelectorAll('[data-field]').forEach(function(el) {
                    const key = el.dataset.field;
                    if (!(key in data)) return;

                    el.classList.remove('skeleton');
                    el.textContent = el.dataset.format === 'rupiah' ?
                        formatRupiah(data[key]) :
                        formatNumber(data[key]);
                });
            }

            // Kartu peringatan diberi warna sesuai tingkat urgensi: hijau (0), amber (1-4), merah (>4)
            function markWarningStates(peringatan) {
                document.querySelectorAll('#grid-peringatan .apd-card').forEach(function(card) {
                    const field = card.querySelector('[data-field]').dataset.field;
                    const value = peringatan[field] ?? 0;

                    card.classList.remove('state-ok', 'state-warn', 'state-crit');
                    if (value === 0) {
                        card.classList.add('state-ok');
                    } else if (value <= 4) {
                        card.classList.add('state-warn');
                    } else {
                        card.classList.add('state-crit');
                    }
                });
            }

            function formatNumber(n) {
                return new Intl.NumberFormat('id-ID').format(n ?? 0);
            }

            function formatRupiah(n) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0,
                }).format(n ?? 0);
            }
        });
    </script>

</body>

</html>
