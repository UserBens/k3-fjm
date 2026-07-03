<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Masuk — Portal K3 PT. Fokus Jasa Mitra</title>
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
            min-height: 100vh;
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

        /* ══════ LAYOUT ══════ */
        #login-wrap {
            display: flex;
            min-height: 100vh;
        }

        /* ── LEFT / BRAND PANEL ── */
        #brand-panel {
            width: 46%;
            min-width: 420px;
            position: relative;
            background: var(--dark);
            color: #fff;
            padding: 40px 44px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #brand-panel::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(45, 75, 158, 0.55) 0%, rgba(45, 75, 158, 0) 70%);
            top: -140px;
            right: -140px;
        }

        #brand-panel::after {
            content: '';
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(26, 122, 60, 0.45) 0%, rgba(26, 122, 60, 0) 70%);
            bottom: -160px;
            left: -120px;
        }

        .brand-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .brand-logo-row {
            margin-bottom: 56px;
        }

        .brand-logo-plate {
            display: inline-flex;
            align-items: center;
            background: #ffffffe0;
            border-radius: 12px;
            padding: 12px 20px;
        }

        .brand-logo-plate img {
            height: 30px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .brand-eyebrow {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.55);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .brand-headline {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 44px;
            line-height: 1.05;
            letter-spacing: 0.01em;
            margin-bottom: 14px;
        }

        .brand-headline span {
            color: #6E8CF2;
        }

        .brand-desc {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
            max-width: 380px;
            margin-bottom: 36px;
        }

        .brand-feature-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: auto;
        }

        .brand-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .brand-feature-icon {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .brand-feature-text {
            font-size: 12.5px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.5;
        }

        .brand-stat-row {
            display: flex;
            gap: 10px;
            margin-top: 32px;
        }

        .brand-stat-chip {
            flex: 1;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 12px 14px;
        }

        .brand-stat-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            line-height: 1;
            margin-bottom: 3px;
        }

        .brand-stat-lbl {
            font-size: 9.5px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ── RIGHT / FORM PANEL ── */
        #form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            background: #F0F2FA;
        }

        .form-card {
            width: 100%;
            max-width: 380px;
        }

        .form-logo-mobile {
            display: none;
            margin-bottom: 28px;
        }

        .form-logo-mobile img {
            height: 32px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .form-eyebrow {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .form-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 34px;
            color: #1A1D2E;
            letter-spacing: 0.02em;
            line-height: 1;
            margin-bottom: 6px;
        }

        .form-title span {
            color: #2D4B9E;
        }

        .form-sub {
            font-size: 12.5px;
            color: #94A3B8;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .alert-banner {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.5;
            margin-bottom: 18px;
        }

        .alert-error {
            background: rgba(208, 2, 27, 0.08);
            color: #D0021B;
            border: 1px solid rgba(208, 2, 27, 0.15);
        }

        .alert-success {
            background: rgba(26, 122, 60, 0.08);
            color: #1A7A3C;
            border: 1px solid rgba(26, 122, 60, 0.15);
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            color: #1A1D2E;
            margin-bottom: 6px;
        }

        .field-input-wrap {
            position: relative;
        }

        .field-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            width: 15px;
            height: 15px;
            pointer-events: none;
        }

        .field-input {
            width: 100%;
            height: 42px;
            padding: 0 14px 0 36px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background: #fff;
            font-size: 13px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1A1D2E;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .field-input::placeholder {
            color: #B4BCCB;
        }

        .field-input:focus {
            border-color: #2D4B9E;
            box-shadow: 0 0 0 3px rgba(45, 75, 158, 0.1);
        }

        .field-input.has-error {
            border-color: #D0021B;
        }

        .field-input.has-error:focus {
            box-shadow: 0 0 0 3px rgba(208, 2, 27, 0.09);
        }

        .field-error {
            font-size: 10.5px;
            font-weight: 600;
            color: #D0021B;
            margin-top: 5px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            cursor: pointer;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px;
        }

        .password-toggle svg {
            width: 16px;
            height: 16px;
        }

        .field-row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }

        .remember-check input {
            width: 15px;
            height: 15px;
            accent-color: #2D4B9E;
            cursor: pointer;
        }

        .remember-check span {
            font-size: 11.5px;
            font-weight: 600;
            color: #64748B;
        }

        .forgot-link {
            font-size: 11.5px;
            font-weight: 700;
            color: #2D4B9E;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            height: 44px;
            border-radius: 10px;
            border: none;
            background: #2D4B9E;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: background 0.15s;
        }

        .btn-submit:hover {
            background: #1A3C8A;
        }

        .form-footer-note {
            text-align: center;
            font-size: 11px;
            color: #94A3B8;
            margin-top: 24px;
            line-height: 1.6;
        }

        .form-footer-note a {
            color: #2D4B9E;
            font-weight: 700;
            text-decoration: none;
        }

        .form-footer-note a:hover {
            text-decoration: underline;
        }

        .copyright-note {
            text-align: center;
            font-size: 10px;
            color: #B4BCCB;
            margin-top: 32px;
        }

        /* ══════ RESPONSIVE ══════ */
        @media (max-width: 1024px) {
            #brand-panel {
                display: none;
            }

            .form-logo-mobile {
                display: flex;
            }
        }

        @media (max-width: 480px) {
            #form-panel {
                padding: 28px 18px;
            }

            .form-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <div id="login-wrap">

        <!-- ══════ LEFT / BRAND PANEL ══════ -->
        <div id="brand-panel">
            <div class="brand-content">
                <div class="brand-logo-row">
                    <div class="brand-logo-plate">
                        <img src="{{ asset('storage/logo-h.webp') }}" alt="PT. Fokus Jasa Mitra" />
                    </div>
                </div>

                <div class="brand-eyebrow">
                    <span class="pulse-dot"></span>
                    Portal K3 (HSE) · PT. Fokus Jasa Mitra
                </div>
                <div class="brand-headline">KESELAMATAN<br />ADALAH <span>PRIORITAS</span><br />KAMI</div>
                <div class="brand-desc">
                    Satu portal terpadu untuk memantau kinerja keselamatan, kepatuhan APD, pelatihan K3, dan seluruh
                    dokumentasi HSE di lingkungan kerja PT. Fokus Jasa Mitra.
                </div>

                <div class="brand-feature-list">
                    <div class="brand-feature-item">
                        <div class="brand-feature-icon">
                            <svg style="width:13px;height:13px;color:#4ADE80" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="brand-feature-text">Monitoring insiden &amp; near-miss secara real-time</div>
                    </div>
                    <div class="brand-feature-item">
                        <div class="brand-feature-icon">
                            <svg style="width:13px;height:13px;color:#4ADE80" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="brand-feature-text">Manajemen inspeksi APD &amp; alat kesehatan</div>
                    </div>
                    <div class="brand-feature-item">
                        <div class="brand-feature-icon">
                            <svg style="width:13px;height:13px;color:#4ADE80" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="brand-feature-text">Pelacakan pelatihan &amp; sertifikasi K3 karyawan</div>
                    </div>
                    <div class="brand-feature-item">
                        <div class="brand-feature-icon">
                            <svg style="width:13px;height:13px;color:#4ADE80" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="brand-feature-text">Dokumentasi HSE terpusat &amp; aman</div>
                    </div>
                </div>

                <div class="brand-stat-row">
                    <div class="brand-stat-chip">
                        <div class="brand-stat-val">127</div>
                        <div class="brand-stat-lbl">Hari Tanpa Kecelakaan</div>
                    </div>
                    <div class="brand-stat-chip">
                        <div class="brand-stat-val">94%</div>
                        <div class="brand-stat-lbl">Kepatuhan APD</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════ RIGHT / FORM PANEL ══════ -->
        <div id="form-panel">
            <div class="form-card">

                <div class="form-logo-mobile">
                    <img src="{{ asset('storage/logo-h.webp') }}" alt="PT. Fokus Jasa Mitra" />
                </div>

                <div class="form-eyebrow">
                    <span class="pulse-dot"></span>
                    Portal K3 · PT. Fokus Jasa Mitra
                </div>
                <div class="form-title">MASUK <span>AKUN</span></div>
                <div class="form-sub">Silakan masuk menggunakan akun HSE Anda untuk mengakses dashboard K3.</div>

                @if (session('status'))
                    <div class="alert-banner alert-success">
                        <svg style="width:14px;height:14px;flex-shrink:0;margin-top:1px;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-banner alert-error">
                        <svg style="width:14px;height:14px;flex-shrink:0;margin-top:1px;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3.75m9.75-.75a9 9 0 11-18 0 9 9 0 0118 0zm-8.25 3.75h.008v.008h-.008v-.008z" />
                        </svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field-group">
                        <label class="field-label" for="username">NIK / Email</label>
                        <div class="field-input-wrap">
                            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <input type="text" id="username" name="username"
                                class="field-input {{ $errors->has('username') ? 'has-error' : '' }}"
                                placeholder="Masukkan NIK atau email" value="{{ old('username') }}" autofocus
                                required />
                        </div>
                        @error('username')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="password">Kata Sandi</label>
                        <div class="field-input-wrap">
                            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input type="password" id="password" name="password"
                                class="field-input {{ $errors->has('password') ? 'has-error' : '' }}"
                                placeholder="Masukkan kata sandi" style="padding-right:40px;" required />
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <svg id="eyeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-row-between">
                        <label class="remember-check">
                            <input type="checkbox" name="remember" />
                            <span>Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">
                        Masuk
                        <svg style="width:14px;height:14px" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>

                <div class="form-footer-note">
                    Mengalami kendala masuk? Hubungi <a href="mailto:it.support@fokusjasamitra.com">IT Support</a>
                </div>

                <div class="copyright-note">
                    &copy; {{ date('Y') }} PT. Fokus Jasa Mitra. Seluruh hak cipta dilindungi.
                </div>
            </div>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            eyeIcon.innerHTML = isHidden ?
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />' :
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
        }
    </script>

</body>

</html>
