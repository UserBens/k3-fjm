 <!-- TOPBAR -->
 <div id="topbar">
     <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
         <svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
         </svg>
     </button>
     <div class="search-box" style="visibility:hidden;">
         <input type="text" tabindex="-1" />
     </div>
     <div style="flex:1"></div>
     <div style="display:flex;align-items:center;gap:6px;">
         <div class="tb-badge" style="position:relative;">
             <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
             </svg>
             <span class="notif-dot"></span>
         </div>
         <div class="tb-divider"></div>
         <div class="tb-user">
             <div class="tb-avatar">{{ strtoupper(substr(session('auth_user.nama_lengkap', 'U'), 0, 2)) }}</div>
             <span class="tb-name">{{ session('auth_user.nama_lengkap', 'User') }}</span>
             <svg class="tb-caret" style="width:12px;height:12px" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
             </svg>
         </div>
     </div>
 </div>
