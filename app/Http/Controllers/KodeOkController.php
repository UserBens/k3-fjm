<?php

namespace App\Http\Controllers;

use App\Models\KodeOk;
use App\Models\Pegawai;
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
                    ->orWhere('uraian_kode_ok', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', (bool) $request->status);
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

    protected function transform(KodeOk $kodeOk): array
    {
        return [
            'id' => $kodeOk->id,
            'kode_ok' => $kodeOk->kode_ok,
            'uraian_kode_ok' => $kodeOk->uraian_kode_ok,
            'status' => $kodeOk->is_active,
            'is_manual' => $kodeOk->is_manual,
            'jumlah_pegawai' => $kodeOk->pegawaiRelasi->count(),
            'unit_kerja_list' => $kodeOk->unitKerjaRelasi->pluck('nama_unit_kerja')->values(),
            'kualifikasi_list' => $kodeOk->kualifikasiRelasi->pluck('nama_kualifikasi')->values(),
            'pegawai_list' => $kodeOk->pegawaiRelasi->map(fn($p) => [
                'badge' => $p->badge,
                'nama' => $p->nama,
                'unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
                'kualifikasi' => $p->kualifikasi->nama_kualifikasi ?? '-',
            ])->values(),
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ok' => 'nullable|string|max:20|unique:kode_oks,kode_ok',
            'uraian_kode_ok' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $kodeOkValue = $validated['kode_ok'] ?? (string) ((int) (KodeOk::max('kode_ok') ?? 0) + 1);

        $kodeOk = KodeOk::create([
            'kode_ok' => $kodeOkValue,
            'uraian_kode_ok' => $validated['uraian_kode_ok'],
            'is_active' => $validated['status'],
            'is_manual' => true,
        ]);

        return response()->json([
            'message' => "Kode OK #{$kodeOk->kode_ok} berhasil ditambahkan.",
            'data' => $this->transform($kodeOk),
        ]);
    }

    public function update(Request $request, KodeOk $kodeOk)
    {
        $validated = $request->validate([
            'uraian_kode_ok' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $kodeOk->update([
            'uraian_kode_ok' => $validated['uraian_kode_ok'],
            'is_active' => $validated['status'],
            'is_manual' => true, // sekali diedit manual, sync tidak akan menimpa lagi
        ]);

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
