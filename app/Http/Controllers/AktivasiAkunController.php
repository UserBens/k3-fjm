<?php

namespace App\Http\Controllers;

use App\Models\AksesUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AktivasiAkunController extends Controller
{
    public function index()
    {
        return view('aktivasi.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $apiUrl = config('services.user_login.url');
            $apiKey = config('services.user_login.key');

            $response = Http::withHeaders(['X-API-KEY' => $apiKey])->timeout(30)->get($apiUrl);

            if (!$response->successful()) {
                return response()->json(['message' => 'Gagal mengambil data user dari server ERP.'], 500);
            }

            $json = $response->json();
            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                return response()->json(['message' => 'Format data user tidak dikenali.'], 500);
            }

            $aksesList = AksesUser::all()->keyBy('username');

            $search = trim((string) $request->query('search', ''));

            $collection = collect($items)
                ->filter(fn($item) => !empty($item['username']))
                ->when($search !== '', function ($col) use ($search) {
                    return $col->filter(function ($item) use ($search) {
                        return stripos($item['username'] ?? '', $search) !== false
                            || stripos($item['nama_lengkap'] ?? '', $search) !== false;
                    });
                })
                ->map(function ($item) use ($aksesList) {
                    $username = $item['username'];
                    $akses = $aksesList->get($username);

                    return [
                        'username' => $username,
                        'nama_lengkap' => $item['nama_lengkap'] ?? '-',
                        'person_id' => $item['PERSON_ID'] ?? '-',
                        'level' => $item['level'] ?? '-',
                        'blokir_erp' => ($item['blokir'] ?? 'N') === 'Y',
                        'is_active' => $akses->is_active ?? false,
                        'is_admin' => $akses->is_admin ?? false,
                        'activated_by' => $akses->activated_by ?? null,
                        'activated_at' => $akses->activated_at ?? null,
                    ];
                })
                ->sortBy('nama_lengkap')
                ->values();

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;
            $page = max((int) $request->query('page', 1), 1);

            $total = $collection->count();
            $lastPage = max((int) ceil($total / $perPage), 1);
            $page = min($page, $lastPage);

            $paged = $collection->slice(($page - 1) * $perPage, $perPage)->values();

            return response()->json([
                'data' => $paged,
                'meta' => [
                    'current_page' => $page,
                    'last_page' => $lastPage,
                    'per_page' => $perPage,
                    'total' => $total,
                    'from' => $total > 0 ? ($page - 1) * $perPage + 1 : null,
                    'to' => $total > 0 ? min($page * $perPage, $total) : null,
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data aktivasi akun: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan sistem.'], 500);
        }
    }

    public function toggle(Request $request, string $username): JsonResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => 'nullable|string',
            'aktifkan' => 'required|boolean',
        ]);

        try {
            // Cegah admin menonaktifkan dirinya sendiri secara tidak sengaja
            if (!$validated['aktifkan'] && $username === session('auth_user.username')) {
                return response()->json([
                    'message' => 'Anda tidak dapat menonaktifkan akun Anda sendiri.',
                ], 422);
            }

            $akses = AksesUser::firstOrNew(['username' => $username]);
            $akses->nama_lengkap = $validated['nama_lengkap'] ?? $akses->nama_lengkap;
            $akses->is_active = $validated['aktifkan'];

            if ($validated['aktifkan']) {
                $akses->activated_by = session('auth_user.username');
                $akses->activated_at = now();
            }

            $akses->save();

            return response()->json([
                'status' => 'success',
                'message' => $validated['aktifkan']
                    ? "Akses login untuk {$username} berhasil diaktifkan."
                    : "Akses login untuk {$username} berhasil dinonaktifkan.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengubah status akses: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan perubahan akses.'], 500);
        }
    }
}
