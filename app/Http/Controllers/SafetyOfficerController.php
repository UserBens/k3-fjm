<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\SafetyOfficerPegawai;
use App\Models\UnitKerja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SafetyOfficerController extends Controller
{
    /**
     * Halaman utama (Blade view).
     */
    public function index()
    {
        return view('safety-officer.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = Pegawai::with(['unitKerja', 'lokasiKerja'])
                ->withCount('tenagaBinaanSafety as jumlah_tenaga')
                ->where('is_active', true)
                ->where('is_safety_officer', true);

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'like', "%{$search}%");
                });
            }

            if ($departemen = $request->query('departemen')) {
                $query->where('unit_kerjaid', $departemen);
            }

            $query->orderBy('nama');

            $filterOptions = [
                'departemen' => UnitKerja::whereIn(
                    'id_api',
                    Pegawai::where('is_active', true)->where('is_safety_officer', true)
                        ->whereNotNull('unit_kerjaid')->distinct()->pluck('unit_kerjaid')
                )->orderBy('nama_unit_kerja')->get(['id_api', 'nama_unit_kerja'])
                    ->map(fn($u) => ['value' => $u->id_api, 'label' => $u->nama_unit_kerja])
                    ->values(),
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $transformed = collect($paginator->items())->map(function (Pegawai $item) {
                $jk = '-';
                if ($item->jenis_kelamin === 'L') $jk = 'Laki-Laki';
                if ($item->jenis_kelamin === 'P') $jk = 'Perempuan';

                return [
                    'id' => $item->id,
                    'id_api' => $item->id_api,
                    'badge' => $item->badge ?? '-',
                    'nama' => $item->nama ?? '-',
                    'jenis_kelamin' => $jk,
                    'jabatan' => $item->jabatan ?? '-',
                    'nama_unit_kerja' => $item->unitKerja->nama_unit_kerja ?? '-',
                    'bagian' => $item->unitKerja->bagian ?? '-',
                    'nama_lokasi' => $item->lokasiKerja->nama_lokasi ?? '-',
                    'status' => $item->is_active ? 'Aktif' : 'Non-Aktif',
                    'jumlah_tenaga' => $item->jumlah_tenaga ?? 0,
                ];
            });

            return response()->json([
                'data' => $transformed,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => max($paginator->lastPage(), 1),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                ],
                'filter_options' => $filterOptions,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data safety officer: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data safety officer.'], 500);
        }
    }

    /**
     * TAB 1 — Daftar tenaga binaan seorang Safety Officer (untuk modal detail, read-only).
     */
    public function tenagaBinaan(Request $request, string $badge): JsonResponse
    {
        try {
            $so = Pegawai::where('badge', $badge)->where('is_safety_officer', true)->firstOrFail();

            $pegawaiIds = SafetyOfficerPegawai::where('badge_safety_officer', $so->badge)->pluck('pegawai_id');

            $query = Pegawai::with('unitKerja')->whereIn('id_api', $pegawaiIds);

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
                });
            }

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->orderBy('nama')->paginate($perPage);

            $transformed = collect($paginator->items())->map(fn($p) => [
                'id_api' => $p->id_api,
                'badge' => $p->badge ?? '-',
                'nama' => $p->nama ?? '-',
                'nama_unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
                'bagian' => $p->unitKerja->bagian ?? '-',
                'status' => $p->is_active ? 'Aktif' : 'Non-Aktif',
            ]);

            return response()->json([
                'safety_officer' => ['badge' => $so->badge, 'nama' => $so->nama],
                'data' => $transformed,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => max($paginator->lastPage(), 1),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat tenaga binaan safety officer: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data tenaga untuk safety officer ini.'], 500);
        }
    }

    /**
     * TAB 2 — Cari pegawai aktif untuk dijadikan Safety Officer baru (yang belum jadi SO).
     */
    public function cariPegawaiUntukSO(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));

        $query = Pegawai::where('is_active', true)->where('is_safety_officer', false);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(fn($p) => [
            'id_api' => $p->id_api,
            'badge' => $p->badge ?? '-',
            'nama' => $p->nama ?? '-',
        ]);

        return response()->json(['data' => $results]);
    }

    /**
     * TAB 2 — Tetapkan pegawai sebagai Safety Officer baru.
     */
    public function tetapkanSO(Request $request): JsonResponse
    {
        $validated = $request->validate(['pegawai_id' => 'required|string']);

        try {
            $pegawai = Pegawai::where('id_api', $validated['pegawai_id'])->firstOrFail();

            if ($pegawai->is_safety_officer) {
                return response()->json(['message' => 'Pegawai ini sudah berstatus Safety Officer.'], 422);
            }

            $pegawai->is_safety_officer = true;
            $pegawai->safety_officer_since = now();
            $pegawai->save();

            return response()->json([
                'status' => 'success',
                'message' => "{$pegawai->nama} berhasil ditetapkan sebagai Safety Officer.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menetapkan safety officer: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menetapkan safety officer.'], 500);
        }
    }

    /**
     * TAB 2 — Lepas status Safety Officer (sekaligus hapus semua assignment tenaga binaannya).
     */
    public function lepasSO(string $badge): JsonResponse
    {
        try {
            $pegawai = Pegawai::where('badge', $badge)
                ->where('is_safety_officer', true)
                ->firstOrFail();

            SafetyOfficerPegawai::where('badge_safety_officer', $pegawai->badge)->delete();

            $pegawai->is_safety_officer = false;
            $pegawai->safety_officer_since = null;
            $pegawai->save();

            return response()->json([
                'status' => 'success',
                'message' => "{$pegawai->nama} dilepas dari status Safety Officer, beserta seluruh penugasan tenaga binaannya.",
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Safety Officer tidak ditemukan.'], 404);
        } catch (\Throwable $e) {
            Log::error('Gagal melepas safety officer: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal melepas status safety officer.'], 500);
        }
    }

    /**
     * TAB 2 — Cari tenaga untuk ditambahkan ke seorang Safety Officer (yang belum jadi binaannya).
     */
    public function cariTenaga(Request $request, string $badge): JsonResponse
    {
        $already = SafetyOfficerPegawai::where('badge_safety_officer', $badge)->pluck('pegawai_id');
        $search = trim((string) $request->query('search', ''));

        $query = Pegawai::with('unitKerja')
            ->where('is_active', true)
            ->where('badge', '!=', $badge) // SO tidak boleh jadi binaan dirinya sendiri
            ->whereNotIn('id_api', $already);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(fn($p) => [
            'id_api' => $p->id_api,
            'badge' => $p->badge ?? '-',
            'nama' => $p->nama ?? '-',
            'nama_unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
        ]);

        return response()->json(['data' => $results]);
    }

    /**
     * TAB 2 — Assign satu tenaga ke Safety Officer.
     */
    public function assignTenaga(Request $request, string $badge): JsonResponse
    {
        $validated = $request->validate(['pegawai_id' => 'required|string']);

        try {
            $so = Pegawai::where('badge', $badge)->where('is_safety_officer', true)->firstOrFail();
            $pegawai = Pegawai::where('id_api', $validated['pegawai_id'])->firstOrFail();

            $exists = SafetyOfficerPegawai::where('badge_safety_officer', $so->badge)
                ->where('pegawai_id', $pegawai->id_api)->exists();

            if ($exists) {
                return response()->json(['message' => 'Tenaga ini sudah ditugaskan ke Safety Officer ini.'], 422);
            }

            SafetyOfficerPegawai::create([
                'badge_safety_officer' => $so->badge,
                'pegawai_id' => $pegawai->id_api,
                'assigned_by' => session('auth_user.username'),
                'assigned_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => "{$pegawai->nama} berhasil ditambahkan ke bawah Safety Officer {$so->nama}.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal assign tenaga ke safety officer: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menambahkan tenaga.'], 500);
        }
    }

    /**
     * TAB 2 — Lepas satu tenaga dari Safety Officer.
     */
    public function unassignTenaga(string $badge, string $pegawaiId): JsonResponse
    {
        try {
            $deleted = SafetyOfficerPegawai::where('badge_safety_officer', $badge)
                ->where('pegawai_id', $pegawaiId)->delete();

            if (!$deleted) {
                return response()->json(['message' => 'Data penugasan tidak ditemukan.'], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Tenaga berhasil dilepas dari Safety Officer ini.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal unassign tenaga: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal melepas tenaga.'], 500);
        }
    }

    /**
     * TAB 2 — List ringkas semua Safety Officer (untuk dropdown/pilih di panel manajemen).
     */
    public function listSO(): JsonResponse
    {
        $data = Pegawai::where('is_active', true)->where('is_safety_officer', true)
            ->withCount('tenagaBinaanSafety as jumlah_tenaga')
            ->orderBy('nama')
            ->get()
            ->map(fn($p) => [
                'badge' => $p->badge,
                'nama' => $p->nama,
                'jumlah_tenaga' => $p->jumlah_tenaga ?? 0,
            ]);

        return response()->json(['data' => $data]);
    }
}
