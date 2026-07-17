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

          /* ══════ Grid ala spreadsheet ══════ */
          .grid-wrap {
              width: 100%;
              overflow: auto;
              border-radius: 10px;
              border: 1px solid rgba(0, 0, 0, 0.07);
              max-height: 72vh;
          }

          .grid-table {
              border-collapse: separate;
              border-spacing: 0;
              font-size: 11.5px;
              min-width: 2200px;
          }

          .grid-table thead th {
              position: sticky;
              top: 0;
              z-index: 5;
              background: #1A1D2E;
              color: #fff;
              font-size: 10px;
              font-weight: 800;
              letter-spacing: 0.04em;
              text-transform: uppercase;
              padding: 10px 8px;
              text-align: center;
              white-space: nowrap;
              border-right: 1px solid rgba(255, 255, 255, 0.08);
          }

          .grid-table td {
              padding: 7px 8px;
              text-align: center;
              white-space: nowrap;
              border-right: 1px solid rgba(0, 0, 0, 0.05);
              border-bottom: 1px solid rgba(0, 0, 0, 0.05);
              color: #1A1D2E;
          }

          .grid-table tbody tr:hover td {
              background: #F8F9FF;
          }

          .grid-table tbody tr.row-inactive td {
              opacity: 0.45;
          }

          /* kolom sticky kiri */
          .col-no {
              min-width: 34px;
          }

          .col-kategori {
              min-width: 110px;
              text-align: left !important;
          }

          .col-nama {
              min-width: 240px;
              text-align: left !important;
              position: sticky;
              left: 0;
              z-index: 3;
              background: #fff;
              box-shadow: 2px 0 4px rgba(0, 0, 0, 0.04);
              font-weight: 700;
          }

          .grid-table thead th.col-nama {
              left: 0;
              z-index: 6;
              background: #1A1D2E;
          }

          .grid-table tbody tr:hover td.col-nama {
              background: #F8F9FF;
          }

          .col-satuan {
              min-width: 70px;
              color: #64748B;
          }

          .col-target {
              min-width: 60px;
              background: #FBE4E4;
              color: #B3121F;
              font-weight: 800;
          }

          .col-month {
              min-width: 44px;
              color: #2D4B9E;
              font-weight: 600;
          }

          .col-month.empty {
              color: #CBD5E1;
          }

          .col-ytd {
              min-width: 70px;
              background: #ECEAFB;
              color: #4C3F91;
              font-weight: 700;
          }

          .col-capai {
              min-width: 66px;
              font-weight: 800;
          }

          .col-status {
              min-width: 130px;
              text-align: left !important;
          }

          .col-key {
              min-width: 60px;
              background: #E3ECFC;
              color: #2D4B9E;
              font-weight: 600;
          }

          .col-tipe {
              min-width: 120px;
              background: #EFE7FC;
              color: #6B3FA0;
              font-weight: 600;
          }

          .col-key2 {
              min-width: 220px;
              background: #E3ECFC;
              color: #2D4B9E;
              text-align: left !important;
              font-weight: 600;
          }

          .col-aktif {
              min-width: 56px;
              background: #FDECD2;
              color: #B36B00;
              font-weight: 700;
          }

          .col-pembanding {
              min-width: 76px;
              color: #64748B;
              font-weight: 700;
          }

          .col-bulan-n {
              min-width: 56px;
              background: #EFE7FC;
              color: #6B3FA0;
              font-weight: 600;
          }

          .col-aksi {
              min-width: 56px;
              position: sticky;
              right: 0;
              background: #fff;
          }

          .grid-table thead th.col-aksi {
              right: 0;
              background: #1A1D2E;
          }

          .capai-cell-100 {
              background: #DCF3E3;
              color: #157A3C;
          }

          .capai-cell-70 {
              background: #FCEED2;
              color: #B36B00;
          }

          .capai-cell-low {
              background: #FBE1E3;
              color: #B3121F;
          }

          .capai-cell-none {
              background: #F1F2F6;
              color: #94A3B8;
          }

          .status-inline {
              display: inline-flex;
              align-items: center;
              gap: 4px;
              font-weight: 700;
              font-size: 10.5px;
              white-space: nowrap;
          }

          .status-inline.st-green {
              color: #1A7A3C;
          }

          .status-inline.st-amber {
              color: #D97706;
          }

          .status-inline.st-red {
              color: #D0021B;
          }

          .status-inline.st-gray {
              color: #94A3B8;
          }

          .row-edit-btn {
              width: 24px;
              height: 24px;
              border-radius: 6px;
              border: 1px solid rgba(0, 0, 0, 0.08);
              background: #fff;
              color: #64748B;
              cursor: pointer;
              display: inline-flex;
              align-items: center;
              justify-content: center;
          }

          .row-edit-btn:hover {
              background: #F0F4FF;
              color: #2D4B9E;
          }

          .cat-pill {
              display: inline-flex;
              align-items: center;
              padding: 2px 8px;
              border-radius: 999px;
              font-size: 10px;
              font-weight: 700;
              background: rgba(45, 75, 158, 0.08);
              color: #2D4B9E;
              white-space: nowrap;
          }

          /* Modal */
          #modalOverlay {
              display: none;
              position: fixed;
              inset: 0;
              background: rgba(15, 17, 26, 0.5);
              z-index: 60;
              align-items: center;
              justify-content: center;
              padding: 16px;
          }

          #modalOverlay.open {
              display: flex;
          }

          .modal-box {
              background: #fff;
              border-radius: 14px;
              width: 100%;
              max-width: 640px;
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
              font-size: 22px;
              letter-spacing: 0.02em;
          }

          .modal-close {
              width: 28px;
              height: 28px;
              border-radius: 8px;
              background: #F0F2FA;
              color: #64748B;
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;
              border: none;
          }

          .form-grid {
              display: grid;
              grid-template-columns: 1fr 1fr;
              gap: 10px 12px;
              margin-bottom: 14px;
          }

          .form-grid.full {
              grid-template-columns: 1fr;
          }

          .form-field label {
              font-size: 10.5px;
              font-weight: 700;
              color: #64748B;
              text-transform: uppercase;
              letter-spacing: 0.05em;
              display: block;
              margin-bottom: 4px;
          }

          .form-field input,
          .form-field select {
              width: 100%;
              height: 36px;
              padding: 0 10px;
              border-radius: 8px;
              border: 1px solid rgba(0, 0, 0, 0.09);
              font-size: 12.5px;
              font-family: 'Plus Jakarta Sans', sans-serif;
              outline: none;
              color: #1A1D2E;
              background: #fff;
          }

          .form-field input:focus,
          .form-field select:focus {
              border-color: #2D4B9E;
          }

          .month-grid {
              display: grid;
              grid-template-columns: repeat(6, 1fr);
              gap: 8px;
              margin-bottom: 6px;
          }

          .month-field label {
              font-size: 9.5px;
              font-weight: 800;
              color: #94A3B8;
              text-transform: uppercase;
              display: block;
              margin-bottom: 3px;
          }

          .month-field input {
              width: 100%;
              height: 32px;
              padding: 0 6px;
              border-radius: 7px;
              border: 1px solid rgba(0, 0, 0, 0.09);
              font-size: 11.5px;
              text-align: center;
              outline: none;
          }

          .month-field input:focus {
              border-color: #2D4B9E;
          }

          .modal-footer {
              display: flex;
              justify-content: flex-end;
              gap: 8px;
              margin-top: 16px;
              padding-top: 14px;
              border-top: 1px solid rgba(0, 0, 0, 0.05);
          }

          .btn-danger-outline {
              padding: 6px 14px;
              border-radius: 8px;
              border: 1px solid rgba(208, 2, 27, 0.25);
              font-size: 11.5px;
              font-weight: 700;
              color: #D0021B;
              background: #fff;
              cursor: pointer;
          }

          .btn-danger-outline:hover {
              background: #FFF0F1;
          }

          @media (max-width: 640px) {
              .form-grid {
                  grid-template-columns: 1fr;
              }

              .month-grid {
                  grid-template-columns: repeat(3, 1fr);
              }
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
                              <span class="pg-eyebrow">Portal K3 · PT. Fokus Jasa Mitra</span>
                          </div>
                          <div class="pg-title">LEADING <span>INPUT K3</span></div>
                          <div class="pg-sub">Kelola target &amp; realisasi bulanan indikator leading K3 — tampilan grid
                              mengikuti format sheet.</div>
                      </div>
                      <div class="pg-actions">
                          <button class="btn-outline" onclick="loadData()">
                              <svg style="width:12px;height:12px;display:inline;margin-right:4px" fill="none"
                                  stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                              </svg>
                              Muat Ulang
                          </button>
                          <button class="btn-primary" onclick="openModal()">
                              <svg style="width:12px;height:12px" fill="none" stroke="currentColor"
                                  viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4.5v15m7.5-7.5h-15" />
                              </svg>
                              Tambah Kegiatan
                          </button>
                      </div>
                  </div>
              </div>


              <div class="section-card" style="margin-bottom:14px;">
                  <div class="filter-bar">
                      {{-- <div class="filter-search">
                          <svg class="search-icon" style="width:13px;height:13px" fill="none" stroke="currentColor"
                              viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>
                          <input type="text" id="searchInput" placeholder="Cari nama kegiatan..."
                              oninput="onSearchInput()" />
                      </div> --}}

                      <select id="filterTahun" class="filter-select" onchange="onFilterChange()">
                          <option value="">Semua Tahun</option>
                      </select>

                      <select id="filterKategori" class="filter-select" onchange="onFilterChange()">
                          <option value="">Semua Kategori</option>
                      </select>

                      <select id="filterStatus" class="filter-select" onchange="onFilterChange()">
                          <option value="">Semua Status</option>
                      </select>

                      <button class="btn-outline filter-reset" onclick="resetFilters()">Reset Filter</button>
                  </div>

                  <div class="data-summary" id="dataSummary">Memuat data leading input...</div>

                  <!-- GRID -->
                  <div class="grid-wrap">
                      <table class="grid-table">
                          <thead>
                              <tr>
                                  <th class="col-no">No</th>
                                  <th class="col-kategori">Kategori</th>
                                  <th class="col-nama">Nama Kegiatan</th>
                                  <th class="col-satuan">Satuan</th>
                                  <th class="col-target">Target</th>
                                  <th class="col-month">Jan</th>
                                  <th class="col-month">Feb</th>
                                  <th class="col-month">Mar</th>
                                  <th class="col-month">Apr</th>
                                  <th class="col-month">Mei</th>
                                  <th class="col-month">Jun</th>
                                  <th class="col-month">Jul</th>
                                  <th class="col-month">Ags</th>
                                  <th class="col-month">Sep</th>
                                  <th class="col-month">Okt</th>
                                  <th class="col-month">Nov</th>
                                  <th class="col-month">Des</th>
                                  <th class="col-ytd">Realisasi YTD</th>
                                  <th class="col-ytd">Target YTD</th>
                                  <th class="col-capai">% Capai (utama)</th>
                                  <th class="col-status">Status</th>
                                  <th class="col-key">Key</th>
                                  <th class="col-tipe">Tipe Capaian (Otomatis)</th>
                                  <th class="col-key2">Key2</th>
                                  <th class="col-aktif">Aktif?</th>
                                  <th class="col-pembanding">% Capai (pembanding)</th>
                                  <th class="col-bulan-n">Bulan Mulai</th>
                                  <th class="col-bulan-n">Setiap N Bulan</th>
                                  <th class="col-aksi"></th>
                              </tr>
                          </thead>
                          <tbody id="tableBody">
                              <tr>
                                  <td colspan="29" style="padding:24px;color:#94A3B8;">Memuat data...</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>

                  <!-- PAGINATION -->
                  <div class="pagination-bar">
                      <div class="pagination-info">
                          <span id="paginationText">—</span>
                          <select id="perPageSelect" class="per-page-select" onchange="onPerPageChange()">
                              <option value="25">25 / halaman</option>
                              <option value="50">50 / halaman</option>
                              <option value="100">100 / halaman</option>
                          </select>
                      </div>
                      <div class="pagination-pages" id="paginationPages"></div>
                  </div>
              </div>


              <!-- MODAL TAMBAH / EDIT -->
              <div id="modalOverlay" onclick="closeModalOnOverlay(event)">
                  <div class="modal-box" onclick="event.stopPropagation()">
                      <div class="modal-hdr">
                          <div class="modal-title" id="modalTitle">TAMBAH KEGIATAN</div>
                          <button class="modal-close" onclick="closeModal()">
                              <svg style="width:14px;height:14px" fill="none" stroke="currentColor"
                                  viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                              </svg>
                          </button>
                      </div>

                      <input type="hidden" id="f_id" />

                      <div class="form-grid">
                          <div class="form-field">
                              <label>Tahun</label>
                              <input type="number" id="f_tahun" value="{{ date('Y') }}" />
                          </div>
                          <div class="form-field">
                              <label>No Urut</label>
                              <input type="number" id="f_no_urut" min="1" />
                          </div>
                          <div class="form-field">
                              <label>Kategori</label>
                              <input type="text" id="f_kategori" placeholder="mis. Safety Training"
                                  list="kategoriList" />
                              <datalist id="kategoriList"></datalist>
                          </div>
                          <div class="form-field">
                              <label>Satuan</label>
                              <input type="text" id="f_satuan" placeholder="%, Kali/Tahun, Kali/Bulan, dsb." />
                          </div>
                      </div>

                      <div class="form-grid full">
                          <div class="form-field">
                              <label>Nama Kegiatan</label>
                              <input type="text" id="f_nama_kegiatan"
                                  placeholder="mis. Pemenuhan Matriks Pelatihan K3" />
                          </div>
                      </div>

                      <div class="form-grid">
                          <div class="form-field">
                              <label>Target (Setahun)</label>
                              <input type="number" step="0.01" id="f_target" />
                          </div>
                          <div class="form-field">
                              <label>Tipe Capaian</label>
                              <select id="f_tipe_capaian">
                                  <option value="Persentase">Persentase</option>
                                  <option value="Kumulatif Tahunan">Kumulatif Tahunan</option>
                                  <option value="Rata-rata Bulanan">Rata-rata Bulanan</option>
                              </select>
                          </div>
                          <div class="form-field">
                              <label>Bulan Mulai (opsional)</label>
                              <input type="number" id="f_bulan_mulai" min="1" max="12"
                                  placeholder="1-12" />
                          </div>
                          <div class="form-field">
                              <label>Setiap N Bulan (opsional)</label>
                              <input type="number" id="f_setiap_n_bulan" min="1" max="12"
                                  placeholder="mis. 12" />
                          </div>
                      </div>

                      <div class="form-field" style="margin-bottom:14px;">
                          <label style="display:flex;align-items:center;gap:6px;">
                              <input type="checkbox" id="f_aktif" style="width:auto;height:auto;" checked /> Aktif
                          </label>
                      </div>

                      <div class="form-field" style="margin-bottom:6px;">
                          <label>Realisasi per Bulan</label>
                      </div>
                      <div class="month-grid" id="monthGrid"></div>

                      <div class="modal-footer">
                          <button class="btn-danger-outline" id="btnDelete" style="display:none;"
                              onclick="deleteRecord()">Hapus</button>
                          <div style="flex:1"></div>
                          <button class="btn-outline" onclick="closeModal()">Batal</button>
                          <button class="btn-primary" onclick="saveRecord()">Simpan</button>
                      </div>
                  </div>
              </div>

          </div>
      </div>

      <div id="toastContainer" class="toast-container"></div>

      <script>
          const API_ENDPOINT = "{{ route('leading-input.api') }}";
          const STORE_ENDPOINT = "{{ route('leading-input.store') }}";
          const CSRF_TOKEN = "{{ csrf_token() }}";
          const MONTH_LABELS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

          const state = {
              search: '',
              tahun: '',
              kategori: '',
              status: '',
              page: 1,
              per_page: 25
          };
          let searchDebounce = null;
          let filterOptionsLoaded = false;
          let editingId = null;

          function escapeHtml(str) {
              const div = document.createElement('div');
              div.textContent = str ?? '';
              return div.innerHTML;
          }

          function fmt(v) {
              if (v === null || v === undefined || v === '') return '';
              const n = Number(v);
              return Number.isInteger(n) ? n : n.toFixed(2).replace(/\.?0+$/, '');
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
              state.tahun = document.getElementById('filterTahun').value;
              state.kategori = document.getElementById('filterKategori').value;
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
              document.getElementById('filterTahun').value = '';
              document.getElementById('filterKategori').value = '';
              document.getElementById('filterStatus').value = '';
              Object.assign(state, {
                  search: '',
                  tahun: '',
                  kategori: '',
                  status: '',
                  page: 1
              });
              loadData();
          }

          function goToPage(page) {
              state.page = page;
              loadData();
              document.getElementById('page-content')?.scrollTo({
                  top: 0,
                  behavior: 'smooth'
              });
          }

          function populateFilterOptions(options) {
              if (filterOptionsLoaded || !options) return;
              const build = (selectId, values) => {
                  const select = document.getElementById(selectId);
                  values.forEach(val => {
                      const opt = document.createElement('option');
                      opt.value = val;
                      opt.textContent = val;
                      select.appendChild(opt);
                  });
              };
              build('filterTahun', options.tahun || []);
              build('filterKategori', options.kategori || []);
              build('filterStatus', options.status || []);

              const dl = document.getElementById('kategoriList');
              (options.kategori || []).forEach(k => {
                  const opt = document.createElement('option');
                  opt.value = k;
                  dl.appendChild(opt);
              });
              filterOptionsLoaded = true;
          }

          function capaiClass(persen) {
              if (persen === null || persen === undefined) return 'capai-cell-none';
              if (persen >= 100) return 'capai-cell-100';
              if (persen >= 70) return 'capai-cell-70';
              return 'capai-cell-low';
          }

          function renderTable(rows) {
              const tbody = document.getElementById('tableBody');
              if (!rows || rows.length === 0) {
                  tbody.innerHTML = `<tr><td colspan="29">
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

              tbody.innerHTML = rows.map(row => {
                  const persen = row.persen_capai;
                  const months = MONTH_LABELS.map((_, i) => {
                      const v = row.monthly[i + 1];
                      return `<td class="col-month ${v === null ? 'empty' : ''}">${v === null ? '' : fmt(v)}</td>`;
                  }).join('');

                  return `
                <tr class="${row.aktif ? '' : 'row-inactive'}">
                    <td class="col-no">${row.no_urut}</td>
                    <td class="col-kategori"><span class="cat-pill">${escapeHtml(row.kategori)}</span></td>
                    <td class="col-nama">${escapeHtml(row.nama_kegiatan)}</td>
                    <td class="col-satuan">${escapeHtml(row.satuan || '-')}</td>
                    <td class="col-target">${fmt(row.target)}</td>
                    ${months}
                    <td class="col-ytd">${fmt(row.realisasi_ytd)}</td>
                    <td class="col-ytd">${fmt(row.target_ytd)}</td>
                    <td class="col-capai ${capaiClass(persen)}">${persen === null ? '-' : fmt(persen) + '%'}</td>
                    <td class="col-status">
                        <span class="status-inline st-${row.status.class.replace('sp-', '')}">${row.status.icon} ${escapeHtml(row.status.label)}</span>
                    </td>
                    <td class="col-key">${escapeHtml(row.key)}</td>
                    <td class="col-tipe">${escapeHtml(row.tipe_capaian)}</td>
                    <td class="col-key2">${escapeHtml(row.key2)}</td>
                    <td class="col-aktif">${row.aktif ? 'Ya' : 'Tidak'}</td>
                    <td class="col-pembanding">${persen === null ? '-' : fmt(Math.min(100, Math.round((row.realisasi_ytd / (row.target || 1)) * 100))) + '%'}</td>
                    <td class="col-bulan-n">${row.bulan_mulai ?? ''}</td>
                    <td class="col-bulan-n">${row.setiap_n_bulan ?? ''}</td>
                    <td class="col-aksi">
                        <button class="row-edit-btn" onclick='editRecord(${JSON.stringify(row).replace(/'/g, "&#39;")})' title="Edit">
                            <svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z" />
                            </svg>
                        </button>
                    </td>
                </tr>`;
              }).join('');
          }

          function renderError(message) {
              document.getElementById('tableBody').innerHTML = `<tr><td colspan="29">
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
              document.getElementById('dataSummary').textContent = 'Gagal memuat data leading input.';
          }

          function renderPagination(meta) {
              document.getElementById('paginationText').textContent =
                  meta.total > 0 ? `Menampilkan ${meta.from}–${meta.to} dari ${meta.total} kegiatan` : 'Tidak ada data';
              document.getElementById('dataSummary').innerHTML =
                  `<strong>${meta.total}</strong> kegiatan leading input ditemukan`;

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
              if (state.tahun) params.set('tahun', state.tahun);
              if (state.kategori) params.set('kategori', state.kategori);
              if (state.status) params.set('status', state.status);
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

          // ══════ MODAL / FORM ══════
          function buildMonthGrid(values = {}) {
              const grid = document.getElementById('monthGrid');
              grid.innerHTML = MONTH_LABELS.map((label, i) => {
                  const m = i + 1;
                  const key = 'bulan_' + String(m).padStart(2, '0');
                  const val = values[m] ?? values[key] ?? '';
                  return `
                <div class="month-field">
                    <label>${label}</label>
                    <input type="number" step="0.01" id="fm_${key}" value="${val === null ? '' : val}" />
                </div>`;
              }).join('');
          }

          function openModal() {
              editingId = null;
              document.getElementById('modalTitle').textContent = 'TAMBAH KEGIATAN';
              document.getElementById('btnDelete').style.display = 'none';
              document.getElementById('f_id').value = '';
              document.getElementById('f_tahun').value = new Date().getFullYear();
              document.getElementById('f_no_urut').value = '';
              document.getElementById('f_kategori').value = '';
              document.getElementById('f_satuan').value = '';
              document.getElementById('f_nama_kegiatan').value = '';
              document.getElementById('f_target').value = '';
              document.getElementById('f_tipe_capaian').value = 'Kumulatif Tahunan';
              document.getElementById('f_bulan_mulai').value = '';
              document.getElementById('f_setiap_n_bulan').value = '';
              document.getElementById('f_aktif').checked = true;
              buildMonthGrid();
              document.getElementById('modalOverlay').classList.add('open');
          }

          function editRecord(row) {
              editingId = row.id;
              document.getElementById('modalTitle').textContent = 'EDIT KEGIATAN';
              document.getElementById('btnDelete').style.display = 'inline-block';
              document.getElementById('f_id').value = row.id;
              document.getElementById('f_tahun').value = row.tahun;
              document.getElementById('f_no_urut').value = row.no_urut;
              document.getElementById('f_kategori').value = row.kategori;
              document.getElementById('f_satuan').value = row.satuan || '';
              document.getElementById('f_nama_kegiatan').value = row.nama_kegiatan;
              document.getElementById('f_target').value = row.target;
              document.getElementById('f_tipe_capaian').value = row.tipe_capaian;
              document.getElementById('f_bulan_mulai').value = row.bulan_mulai || '';
              document.getElementById('f_setiap_n_bulan').value = row.setiap_n_bulan || '';
              document.getElementById('f_aktif').checked = !!row.aktif;
              buildMonthGrid(row.monthly || {});
              document.getElementById('modalOverlay').classList.add('open');
          }

          function closeModal() {
              document.getElementById('modalOverlay').classList.remove('open');
          }

          function closeModalOnOverlay(e) {
              if (e.target.id === 'modalOverlay') closeModal();
          }

          function collectPayload() {
              const payload = {
                  tahun: parseInt(document.getElementById('f_tahun').value, 10),
                  no_urut: parseInt(document.getElementById('f_no_urut').value, 10),
                  kategori: document.getElementById('f_kategori').value.trim(),
                  satuan: document.getElementById('f_satuan').value.trim(),
                  nama_kegiatan: document.getElementById('f_nama_kegiatan').value.trim(),
                  target: parseFloat(document.getElementById('f_target').value || 0),
                  tipe_capaian: document.getElementById('f_tipe_capaian').value,
                  bulan_mulai: document.getElementById('f_bulan_mulai').value || null,
                  setiap_n_bulan: document.getElementById('f_setiap_n_bulan').value || null,
                  aktif: document.getElementById('f_aktif').checked,
              };
              for (let m = 1; m <= 12; m++) {
                  const key = 'bulan_' + String(m).padStart(2, '0');
                  const raw = document.getElementById('fm_' + key).value;
                  payload[key] = raw === '' ? null : parseFloat(raw);
              }
              return payload;
          }

          async function saveRecord() {
              const payload = collectPayload();
              if (!payload.kategori || !payload.nama_kegiatan || !payload.tahun || !payload.no_urut) {
                  alert('Tahun, No Urut, Kategori, dan Nama Kegiatan wajib diisi.');
                  return;
              }
              const url = editingId ? `${STORE_ENDPOINT}/${editingId}` : STORE_ENDPOINT;
              const method = editingId ? 'PUT' : 'POST';
              try {
                  const res = await fetch(url, {
                      method,
                      headers: {
                          'Content-Type': 'application/json',
                          'Accept': 'application/json',
                          'X-CSRF-TOKEN': CSRF_TOKEN,
                      },
                      body: JSON.stringify(payload),
                  });
                  if (!res.ok) {
                      const errJson = await res.json().catch(() => null);
                      throw new Error(errJson?.message || 'Gagal menyimpan data.');
                  }
                  closeModal();
                  loadData();
              } catch (e) {
                  alert(e.message);
              }
          }

          async function deleteRecord() {
              if (!editingId) return;
              if (!confirm('Hapus kegiatan ini? Tindakan tidak bisa dibatalkan.')) return;
              try {
                  const res = await fetch(`${STORE_ENDPOINT}/${editingId}`, {
                      method: 'DELETE',
                      headers: {
                          'Accept': 'application/json',
                          'X-CSRF-TOKEN': CSRF_TOKEN
                      },
                  });
                  if (!res.ok) throw new Error('Gagal menghapus data.');
                  closeModal();
                  loadData();
              } catch (e) {
                  alert(e.message);
              }
          }

          document.addEventListener('DOMContentLoaded', loadData);
      </script>


  </body>

  </html>
