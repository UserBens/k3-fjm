<?php

namespace App\Http\Controllers;

use App\Models\KodeOk;
use App\Models\Kualifikasi;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class KodeOkController extends Controller
{
    public function index()
    {
        return view('kode-ok.index');
    }

    public function apiIndex(Request $request)
    {
        $query = KodeOk::query()->with([
            'pegawaiRelasi.unitKerja',
            'pegawaiRelasi.kualifikasi',
            'unitKerjaRelasi',
            'kualifikasiRelasi',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_ok', 'like', "%{$search}%")
                    ->orWhere('uraian_kerja', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', (bool) $request->status);
        }

        $perPage = (int) $request->get('per_page', 10);
        $paginated = $query
            ->orderByRaw('LENGTH(kode_ok) asc')
            ->orderBy('kode_ok', 'asc')
            ->paginate($perPage);

        $data = $paginated->getCollection()->map(fn(KodeOk $kodeOk) => $this->transform($kodeOk));

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'total' => $paginated->total(),
                'from' => $paginated->firstItem(),
                'to' => $paginated->lastItem(),
            ],
        ]);
    }

    // Endpoint baru: data pilihan untuk dropdown/picker di form
    public function options()
    {
        return response()->json([
            'unit_kerja' => UnitKerja::where('is_active', true)
                ->orderBy('nama_unit_kerja')
                ->get(['id', 'nama_unit_kerja']),

            'kualifikasi' => Kualifikasi::where('is_active', true)
                ->orderBy('nama_kualifikasi')
                ->get(['id', 'nama_kualifikasi']),

            'pegawai' => Pegawai::where('is_active', true)
                ->orderBy('nama')
                ->get(['id', 'badge', 'nama']),
        ]);
    }

    protected function transform(KodeOk $kodeOk): array
    {
        return [
            'id' => $kodeOk->id,
            'kode_ok' => $kodeOk->kode_ok,
            'uraian_kerja' => $kodeOk->uraian_kerja,
            'status' => $kodeOk->status,
            'is_manual' => $kodeOk->is_manual,
            'jumlah_pegawai' => $kodeOk->pegawaiRelasi->count(),

            'unit_kerja_list' => $kodeOk->unitKerjaRelasi->pluck('nama_unit_kerja')->values(),
            'unit_kerja_ids' => $kodeOk->unitKerjaRelasi->pluck('id')->values(),

            'kualifikasi_list' => $kodeOk->kualifikasiRelasi->pluck('nama_kualifikasi')->values(),
            'kualifikasi_ids' => $kodeOk->kualifikasiRelasi->pluck('id')->values(),

            'pegawai_list' => $kodeOk->pegawaiRelasi->map(fn($p) => [
                'id' => $p->id,
                'badge' => $p->badge,
                'nama' => $p->nama,
                'unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
                'kualifikasi' => $p->kualifikasi->nama_kualifikasi ?? '-',
            ])->values(),
            'pegawai_ids' => $kodeOk->pegawaiRelasi->pluck('id')->values(),
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ok' => 'nullable|string|max:20|unique:kode_oks,kode_ok',
            'uraian_kerja' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
            'pegawai_ids' => 'nullable|array',
            'pegawai_ids.*' => 'exists:pegawais,id',
            'unit_kerja_ids' => 'nullable|array',
            'unit_kerja_ids.*' => 'exists:unit_kerjas,id',
            'kualifikasi_ids' => 'nullable|array',
            'kualifikasi_ids.*' => 'exists:kualifikasis,id',
        ]);

        $kodeOkValue = $validated['kode_ok'] ?? (string) ((int) (KodeOk::max('kode_ok') ?? 0) + 1);
        $kodeOk = KodeOk::create([
            'kode_ok' => $kodeOkValue,
            'uraian_kerja' => $validated['uraian_kerja'] ?? null,
            'status' => $validated['status'],
            'is_manual' => true,
        ]);

        $kodeOk->pegawaiRelasi()->sync($validated['pegawai_ids'] ?? []);
        $kodeOk->unitKerjaRelasi()->sync($validated['unit_kerja_ids'] ?? []);
        $kodeOk->kualifikasiRelasi()->sync($validated['kualifikasi_ids'] ?? []);

        $kodeOk->load(['pegawaiRelasi.unitKerja', 'pegawaiRelasi.kualifikasi', 'unitKerjaRelasi', 'kualifikasiRelasi']);

        return response()->json([
            'message' => "Kode OK #{$kodeOk->kode_ok} berhasil ditambahkan.",
            'data' => $this->transform($kodeOk),
        ]);
    }

    public function update(Request $request, KodeOk $kodeOk)
    {
        $validated = $request->validate([
            'uraian_kerja' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
            'pegawai_ids' => 'nullable|array',
            'pegawai_ids.*' => 'exists:pegawais,id',
            'unit_kerja_ids' => 'nullable|array',
            'unit_kerja_ids.*' => 'exists:unit_kerjas,id',
            'kualifikasi_ids' => 'nullable|array',
            'kualifikasi_ids.*' => 'exists:kualifikasis,id',
        ]);

        $kodeOk->update([
            'uraian_kerja' => $validated['uraian_kerja'] ?? null,
            'status' => $validated['status'],
            'is_manual' => true,
        ]);

        $kodeOk->pegawaiRelasi()->sync($validated['pegawai_ids'] ?? []);
        $kodeOk->unitKerjaRelasi()->sync($validated['unit_kerja_ids'] ?? []);
        $kodeOk->kualifikasiRelasi()->sync($validated['kualifikasi_ids'] ?? []);

        $kodeOk->load(['pegawaiRelasi.unitKerja', 'pegawaiRelasi.kualifikasi', 'unitKerjaRelasi', 'kualifikasiRelasi']);

        return response()->json([
            'message' => "Kode OK #{$kodeOk->kode_ok} berhasil diperbarui.",
            'data' => $this->transform($kodeOk),
        ]);
    }

    public function destroy(KodeOk $kodeOk)
    {
        if (Pegawai::where('kode_ok', $kodeOk->kode_ok)->exists()) {
            return response()->json([
                'message' => 'Kode OK ini masih dipakai oleh pegawai aktif, tidak bisa dihapus.',
            ], 422);
        }

        $kodeOk->delete();

        return response()->json(['message' => 'Kode OK berhasil dihapus.']);
    }

    public function sync()
    {
        Artisan::call('sync:pegawai');
        $output = Artisan::output();

        return response()->json([
            'message' => 'Data Kode OK berhasil disinkronkan dari API pegawai.',
            'log' => $output,
        ]);
    }
}
