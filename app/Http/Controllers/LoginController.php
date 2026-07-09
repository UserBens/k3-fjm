<?php

namespace App\Http\Controllers;

use App\Models\AksesUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function indexLogin()
    {
        // Kalau sudah login, langsung lempar ke dashboard
        if (session()->has('auth_user')) {
            return redirect()->route('dashboard');
        }

        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $apiUrl = config('services.user_login.url');
        $apiKey = config('services.user_login.key');

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
            ])->timeout(30)->get($apiUrl);

            if (!$response->successful()) {
                Log::error('Gagal mengambil data user login. Status: ' . $response->status());
                throw ValidationException::withMessages([
                    'username' => 'Tidak dapat terhubung ke server autentikasi. Silakan coba lagi.',
                ]);
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                throw ValidationException::withMessages([
                    'username' => 'Format data dari server autentikasi tidak dikenali.',
                ]);
            }

            // Cari user berdasarkan username (case-insensitive, jaga-jaga variasi input)
            $matched = collect($items)->first(function ($item) use ($credentials) {
                return isset($item['username']) &&
                    strcasecmp(trim($item['username']), trim($credentials['username'])) === 0;
            });

            if (!$matched) {
                throw ValidationException::withMessages([
                    'username' => 'NIK/Username atau kata sandi salah.',
                ]);
            }

            // Cek status blokir
            if (($matched['blokir'] ?? null) === 'Y') {
                throw ValidationException::withMessages([
                    'username' => 'Akun Anda diblokir. Silakan hubungi IT Support.',
                ]);
            }

            // Verifikasi password — field 'password' di API berformat MD5
            $inputHash = md5($credentials['password']);
            if (!hash_equals((string) $matched['password'], $inputHash)) {
                throw ValidationException::withMessages([
                    'username' => 'NIK/Username atau kata sandi salah.',
                ]);
            }

            // BARU — cek apakah username ini diizinkan login (whitelist lokal)
            $akses = AksesUser::where('username', $matched['username'])->first();

            if (!$akses || !$akses->is_active) {
                throw ValidationException::withMessages([
                    'username' => 'Akun Anda belum diaktifkan untuk mengakses sistem ini. Silakan hubungi admin.',
                ]);
            }

            // Login berhasil — simpan data user ke session
            $request->session()->regenerate(); // cegah session fixation

            session([
                'auth_user' => [
                    'id_pass' => $matched['id_pass'] ?? null,
                    'username' => $matched['username'] ?? null,
                    'nama_lengkap' => $matched['nama_lengkap'] ?? null,
                    'person_id' => $matched['PERSON_ID'] ?? null,
                    'level' => $matched['level'] ?? null,
                    'scope' => $matched['scope'] ?? null,
                    'status_peg' => $matched['status_peg'] ?? null,
                    'email' => $matched['email'] ?? null,
                    'phone' => $matched['phone'] ?? null,
                    'image' => $matched['image'] ?? null,
                    'is_admin' => $akses->is_admin, // BARU

                ],
                'auth_login_at' => now(),
            ]);

            // "Ingat saya" — perpanjang umur session cookie
            if ($request->boolean('remember')) {
                config(['session.lifetime' => 60 * 24 * 14]); // 14 hari
            }

            return redirect()->intended(route('dashboard'))
                ->with('status', 'Selamat datang, ' . ($matched['nama_lengkap'] ?? $matched['username']) . '!');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Terjadi kesalahan saat proses login: ' . $e->getMessage());
            throw ValidationException::withMessages([
                'username' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('auth_user');
        $request->session()->forget('auth_login_at');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah keluar dari sistem.');
    }
}
