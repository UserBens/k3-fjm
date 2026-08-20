<?php

namespace App\Http\Controllers;

use App\Models\HariLiburNasional;
use App\Services\HariLiburGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HariLiburController extends Controller
{
    public function __construct(private HariLiburGeneratorService $generator)
    {
    }

    public function index()
    {
        return view('hari-libur.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $tahun = (int) $request->query('tahun', now()->year);

            $query = HariLiburNasional::query()->tahun($tahun);

            if ($jenis = $request->query('jenis')) {
                $query->where('jenis', $jenis);
            }
            if ($kategori = $request->query('kategori')) {
                $query->where('kategori', $kategori);
            }
            if ($search = $request->query('search')) {
                $query->where('nama_libur', 'ilike', "%{$search}%");
            }

            $rows = $query->orderBy('tanggal')->get();

            $tahunTersedia = HariLiburNasional::query()
                ->distinct()
                ->orderByDesc('tahun')
                ->pluck('tahun');

            return response()->json([
                'data' => $rows,
                'kelengkapan' => $this->generator->cekKelengkapanTahun($tahun),
                'tahun_tersedia' => $tahunTersedia,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data hari libur: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data.'], 500);
        }
    }

    // Generate hari libur AUTO (Masehi tetap + Paskah) untuk satu tahun. Aman dipanggil berulang.
    public function generate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020|max:2100',
        ]);

        try {
            $dibuat = $this->generator->generateTahun($validated['tahun']);

            return response()->json([
                'status' => 'success',
                'message' => count($dibuat) > 0
                    ? count($dibuat) . ' hari libur otomatis berhasil dibuat untuk tahun ' . $validated['tahun'] . '.'
                    : 'Hari libur otomatis untuk tahun ' . $validated['tahun'] . ' sudah lengkap, tidak ada yang baru dibuat.',
                'data' => $dibuat,
                'kelengkapan' => $this->generator->cekKelengkapanTahun($validated['tahun']),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal generate hari libur: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal membuat hari libur otomatis.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $validated['tahun'] = date('Y', strtotime($validated['tanggal']));
            $validated['sumber'] = 'MANUAL';

            $data = HariLiburNasional::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Hari libur berhasil ditambahkan.',
                'data' => $data,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan hari libur: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data. Kemungkinan tanggal & nama sudah ada.'], 500);
        }
    }

    public function update(Request $request, HariLiburNasional $hariLibur): JsonResponse
    {
        $validated = $this->validateData($request);
        $validated['tahun'] = date('Y', strtotime($validated['tanggal']));

        try {
            $hariLibur->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Hari libur berhasil diperbarui.',
                'data' => $hariLibur->fresh(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui hari libur: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy(HariLiburNasional $hariLibur): JsonResponse
    {
        try {
            $hariLibur->delete();
            return response()->json(['status' => 'success', 'message' => 'Hari libur berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus hari libur: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'tanggal' => 'required|date',
            'nama_libur' => 'required|string|max:255',
            'jenis' => 'required|in:LIBUR_NASIONAL,CUTI_BERSAMA',
            'kategori' => 'required|in:MASEHI_TETAP,PASKAH,HIJRIAH,IMLEK,NYEPI,WAISAK,LAINNYA',
            'keterangan' => 'nullable|string',
        ]);
    }
}
