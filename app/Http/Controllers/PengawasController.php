<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\PengawasIntraUser;
use App\Models\PengawasPegawai;
use App\Models\PengawasPekerjaan;
use App\Models\UnitKerja;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PengawasController extends Controller
{
    public function index()
    {
        return view('pengawas.index');
    }

    // TAB 1 — Daftar Pengawas
    public function data(Request $request): JsonResponse
    {
        try {
            $query = Pegawai::with(['unitKerja', 'lokasiKerja', 'pengawasIntraAccount'])
                ->withCount('tenagaBinaanPengawas as jumlah_pegawai')
                ->where('is_active', true)
                ->where('is_pengawas', true);

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
                    Pegawai::where('is_active', true)->where('is_pengawas', true)
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
                    'kode_ok_pekerjaan' => $item->pengawasIntraAccount->kode_ok_pekerjaan ?? '-',
                    'nama_unit_kerja' => $item->unitKerja->nama_unit_kerja ?? '-',
                    'bagian' => $item->unitKerja->bagian ?? '-',
                    'nama_lokasi' => $item->lokasiKerja->nama_lokasi ?? '-',
                    'status' => $item->is_active ? 'Aktif' : 'Non-Aktif',
                    'jumlah_pegawai' => $item->jumlah_pegawai ?? 0,
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
            Log::error('Gagal memuat data pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data pengawas.'], 500);
        }
    }

    // TAB 1 — Daftar tenaga binaan seorang Pengawas (modal detail, read-only)
    public function tenagaBinaan(Request $request, string $badge): JsonResponse
    {
        try {
            $pengawas = Pegawai::where('badge', $badge)->where('is_pengawas', true)->firstOrFail();

            $pegawaiIds = PengawasPegawai::where('badge_pengawas', $pengawas->badge)->pluck('pegawai_id');

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
                'pengawas' => ['badge' => $pengawas->badge, 'nama' => $pengawas->nama],
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
            Log::error('Gagal memuat tenaga binaan pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data tenaga untuk pengawas ini.'], 500);
        }
    }

    // TAB 2 — Cari pegawai aktif untuk dijadikan Pengawas baru (yang belum jadi pengawas)
    public function cariPegawaiUntukPengawas(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));

        $query = Pegawai::where('is_active', true)->where('is_pengawas', false);

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

    // TAB 2 — Tetapkan pegawai sebagai Pengawas baru
    public function tetapkanPengawas(Request $request): JsonResponse
    {
        $validated = $request->validate(['pegawai_id' => 'required|string']);

        try {
            $pegawai = Pegawai::where('id_api', $validated['pegawai_id'])->firstOrFail();

            if ($pegawai->is_pengawas) {
                return response()->json(['message' => 'Pegawai ini sudah berstatus Pengawas.'], 422);
            }

            if (empty($pegawai->badge)) {
                return response()->json(['message' => 'Pegawai ini belum memiliki badge, tidak bisa dijadikan Pengawas.'], 422);
            }

            $pegawai->is_pengawas = true;
            $pegawai->pengawas_since = now();
            $pegawai->save();

            return response()->json([
                'status' => 'success',
                'message' => "{$pegawai->nama} berhasil ditetapkan sebagai Pengawas.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menetapkan pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menetapkan pengawas.'], 500);
        }
    }

    // TAB 2 — Lepas status Pengawas (sekaligus hapus semua assignment tenaga binaannya)
    public function lepasPengawas(string $badge): JsonResponse
    {
        try {
            $pegawai = Pegawai::where('badge', $badge)
                ->where('is_pengawas', true)
                ->firstOrFail();

            PengawasPegawai::where('badge_pengawas', $pegawai->badge)->delete();

            $pegawai->is_pengawas = false;
            $pegawai->pengawas_since = null;
            $pegawai->save();

            return response()->json([
                'status' => 'success',
                'message' => "{$pegawai->nama} dilepas dari status Pengawas, beserta seluruh penugasan tenaga binaannya.",
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Pengawas tidak ditemukan.'], 404);
        } catch (\Throwable $e) {
            Log::error('Gagal melepas pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal melepas status pengawas.'], 500);
        }
    }

    // TAB 2 — Cari tenaga untuk ditambahkan ke seorang Pengawas (yang belum jadi binaannya)
    public function cariTenaga(Request $request, string $badge): JsonResponse
    {
        $already = PengawasPegawai::where('badge_pengawas', $badge)->pluck('pegawai_id');
        $search = trim((string) $request->query('search', ''));

        $query = Pegawai::with('unitKerja')
            ->where('is_active', true)
            ->where('badge', '!=', $badge) // pengawas tidak boleh jadi binaan dirinya sendiri
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

    // TAB 2 — Assign satu tenaga ke Pengawas
    public function assignTenaga(Request $request, string $badge): JsonResponse
    {
        $validated = $request->validate(['pegawai_id' => 'required|string']);

        try {
            $pengawas = Pegawai::where('badge', $badge)->where('is_pengawas', true)->firstOrFail();
            $pegawai = Pegawai::where('id_api', $validated['pegawai_id'])->firstOrFail();

            $exists = PengawasPegawai::where('badge_pengawas', $pengawas->badge)
                ->where('pegawai_id', $pegawai->id_api)->exists();

            if ($exists) {
                return response()->json(['message' => 'Tenaga ini sudah ditugaskan ke Pengawas ini.'], 422);
            }

            PengawasPegawai::create([
                'badge_pengawas' => $pengawas->badge,
                'pegawai_id' => $pegawai->id_api,
                'assigned_by' => session('auth_user.username'),
                'assigned_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => "{$pegawai->nama} berhasil ditambahkan ke bawah Pengawas {$pengawas->nama}.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal assign tenaga ke pengawas: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menambahkan tenaga.'], 500);
        }
    }

    // TAB 2 — Lepas satu tenaga dari Pengawas
    public function unassignTenaga(string $badge, string $pegawaiId): JsonResponse
    {
        try {
            $deleted = PengawasPegawai::where('badge_pengawas', $badge)
                ->where('pegawai_id', $pegawaiId)->delete();

            if (!$deleted) {
                return response()->json(['message' => 'Data penugasan tidak ditemukan.'], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Tenaga berhasil dilepas dari Pengawas ini.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal unassign tenaga: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal melepas tenaga.'], 500);
        }
    }

    // TAB 2 — List ringkas semua Pengawas (untuk panel kiri manajemen)
    public function listPengawas(): JsonResponse
    {
        $data = Pegawai::where('is_active', true)->where('is_pengawas', true)
            ->withCount('tenagaBinaanPengawas as jumlah_pegawai')
            ->orderBy('nama')
            ->get()
            ->map(fn($p) => [
                'badge' => $p->badge,
                'nama' => $p->nama,
                'jumlah_pegawai' => $p->jumlah_pegawai ?? 0,
            ]);

        return response()->json(['data' => $data]);
    }
}
