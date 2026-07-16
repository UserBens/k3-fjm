<?php

namespace App\Http\Controllers;

use App\Models\AlatKesehatanPenggunaan;
use App\Models\Pegawai;
use App\Models\StokAlkes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AlatKesehatanPenggunaController extends Controller
{
    public function index()
    {
        return view('log-alkes.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = AlatKesehatanPenggunaan::with('alatKesehatan')->search($request->query('search'));

            if ($alatId = $request->query('stok_alkes_id')) {
                $query->where('stok_alkes_id', $alatId);
            }

            if ($unitKerja = $request->query('unit_kerja')) {
                $query->where('unit_kerja', $unitKerja);
            }

            if ($tglDari = $request->query('tanggal_dari')) {
                $query->whereDate('tanggal', '>=', $tglDari);
            }

            if ($tglSampai = $request->query('tanggal_sampai')) {
                $query->whereDate('tanggal', '<=', $tglSampai);
            }

            $query->orderByDesc('tanggal')->orderByDesc('id');

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;
            $paginator = $query->paginate($perPage);

            $data = collect($paginator->items())->values()->map(function (AlatKesehatanPenggunaan $item, $index) use ($paginator) {
                return [
                    'no' => ($paginator->currentPage() - 1) * $paginator->perPage() + $index + 1,
                    'id' => $item->id,
                    'tanggal' => optional($item->tanggal)->format('Y-m-d'),
                    'id_karyawan' => $item->id_karyawan,
                    'nama_pengguna' => $item->nama_pengguna,
                    'jabatan' => $item->jabatan ?? '-',
                    'unit_kerja' => $item->unit_kerja ?? '-',
                    'stok_alkes_id' => $item->stok_alkes_id,
                    'jenis_alat' => $item->alatKesehatan->jenis_alat ?? '-',
                    'jumlah_digunakan' => $item->jumlah_digunakan,
                    'keterangan' => $item->keterangan ?? '-',
                ];
            });

            return response()->json([
                'data' => $data,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => max($paginator->lastPage(), 1),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                ],
                'filter_options' => [
                    'unit_kerja' => AlatKesehatanPenggunaan::whereNotNull('unit_kerja')->distinct()->orderBy('unit_kerja')->pluck('unit_kerja'),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data penggunaan alkes: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data penggunaan alat kesehatan.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            DB::transaction(function () use ($validated, &$penggunaan) {
                $penggunaan = AlatKesehatanPenggunaan::create($validated);

                // Tambahkan angka "digunakan" pada stok alkes terkait
                StokAlkes::where('id', $validated['stok_alkes_id'])
                    ->increment('digunakan', $validated['jumlah_digunakan']);
            });

            return response()->json([
                'status' => 'success',
                'message' => "Penggunaan alat oleh {$penggunaan->nama_pengguna} berhasil dicatat.",
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan penggunaan alkes: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function update(Request $request, AlatKesehatanPenggunaan $alatKesehatanPenggunaan): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            DB::transaction(function () use ($validated, $alatKesehatanPenggunaan) {
                // Kembalikan dulu jumlah lama ke stok sebelumnya (bisa jadi alatnya beda dari sebelumnya)
                StokAlkes::where('id', $alatKesehatanPenggunaan->stok_alkes_id)
                    ->decrement('digunakan', $alatKesehatanPenggunaan->jumlah_digunakan);

                $alatKesehatanPenggunaan->update($validated);

                // Terapkan jumlah baru ke stok yang (mungkin) baru dipilih
                StokAlkes::where('id', $validated['stok_alkes_id'])
                    ->increment('digunakan', $validated['jumlah_digunakan']);
            });

            return response()->json([
                'status' => 'success',
                'message' => "Data penggunaan oleh {$alatKesehatanPenggunaan->nama_pengguna} berhasil diperbarui.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui penggunaan alkes: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy(AlatKesehatanPenggunaan $alatKesehatanPenggunaan): JsonResponse
    {
        try {
            DB::transaction(function () use ($alatKesehatanPenggunaan) {
                StokAlkes::where('id', $alatKesehatanPenggunaan->stok_alkes_id)
                    ->decrement('digunakan', $alatKesehatanPenggunaan->jumlah_digunakan);

                $alatKesehatanPenggunaan->delete();
            });

            return response()->json(['status' => 'success', 'message' => 'Data penggunaan berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus penggunaan alkes: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    // Picker pegawai — snapshot: badge, nama, jabatan, unit kerja + bagian/subkon
    public function cariPegawai(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with(['unitKerja', 'subkon'])->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(function (Pegawai $p) {
            $unitLabel = trim(collect([
                $p->unitKerja->nama_unit_kerja ?? null,
                $p->unitKerja->bagian ?? null,
                $p->subkon->nama_subkon ?? null,
            ])->filter()->implode(' — '));

            return [
                'badge' => $p->badge ?? '-',
                'nama' => $p->nama ?? '-',
                'jabatan' => $p->jabatan ?? '-',
                'unit_kerja' => $unitLabel ?: '-',
            ];
        });

        return response()->json(['data' => $results]);
    }

    // Picker alat kesehatan — hanya yang aktif & masih ada stok tersedia
    public function cariAlat(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = StokAlkes::where('status', 'Aktif');

        if ($search !== '') {
            $query->search($search);
        }

        $results = $query->orderBy('jenis_alat')->limit(20)->get()->map(fn(StokAlkes $a) => [
            'id' => $a->id,
            'jenis_alat' => $a->jenis_alat,
            'merk' => $a->merk ?? '-',
            'type' => $a->type ?? '-',
            'stok_tersedia' => $a->stok_tersedia,
        ]);

        return response()->json(['data' => $results]);
    }

    // Dropdown lengkap alat kesehatan (untuk filter di tabel utama)
    public function daftarAlat(): JsonResponse
    {
        $data = StokAlkes::where('status', 'Aktif')->orderBy('jenis_alat')->get(['id', 'jenis_alat']);
        return response()->json(['data' => $data]);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tanggal' => 'required|date',
            'stok_alkes_id' => 'required|exists:stok_alkes,id',
            'id_karyawan' => 'required|string|max:50',
            'nama_pengguna' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
            'jumlah_digunakan' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);
    }
}
