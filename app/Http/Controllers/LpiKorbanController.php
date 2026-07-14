<?php

namespace App\Http\Controllers;

use App\Models\LpiKejadian;
use App\Models\LpiKorban;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LpiKorbanController extends Controller
{
    public function data(LpiKejadian $lpiKejadian): JsonResponse
    {
        try {
            $korban = $lpiKejadian->korban()->orderByDesc('id')->get();
            return response()->json(['data' => $korban]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data korban LPI: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data korban.'], 500);
        }
    }

    public function store(Request $request, LpiKejadian $lpiKejadian): JsonResponse
    {
        $validated = $this->validateData($request);
        $validated['kejadian_id'] = $lpiKejadian->id;

        try {
            $korban = LpiKorban::create($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Data korban berhasil ditambahkan.',
                'data' => $korban,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data korban LPI: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data korban.'], 500);
        }
    }

    public function update(Request $request, LpiKorban $lpiKorban): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $lpiKorban->update($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Data korban berhasil diperbarui.',
                'data' => $lpiKorban->fresh(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data korban LPI: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data korban.'], 500);
        }
    }

    public function destroy(LpiKorban $lpiKorban): JsonResponse
    {
        try {
            $lpiKorban->delete();
            return response()->json(['status' => 'success', 'message' => 'Data korban berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data korban LPI: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data korban.'], 500);
        }
    }

    /**
     * Picker karyawan FJM — dipakai untuk ID_KORBAN maupun ID_SAKSI_KARYAWAN_FJM.
     */
    public function cariKaryawan(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with('unitKerja')->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(fn(Pegawai $p) => [
            'badge' => $p->badge ?? '-',
            'nama' => $p->nama ?? '-',
            'unit_kerja' => $p->unitKerja->nama_unit_kerja ?? '-',
            'departemen' => $p->unitKerja->nama_unit_kerja ?? '-',
            'jabatan' => $p->jabatan ?? '-',
        ]);

        return response()->json(['data' => $results]);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'klasifikasi_insiden' => 'nullable|string|max:50',
            'badge_saksi_karyawan_fjm' => 'nullable|string|max:50',
            'nama_saksi_karyawan_fjm' => 'nullable|string|max:255',
            'nama_saksi_karyawan_non_fjm' => 'nullable|string|max:255',
            'pt_asal_korban' => 'nullable|string|max:150',
            'badge_korban' => 'nullable|string|max:50',
            'nama_korban' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            'usia' => 'nullable|integer|min:0|max:100',
            'masa_kerja' => 'nullable|string|max:50',
            'shift' => 'nullable|string|max:20',
            'departemen' => 'nullable|string|max:150',
            'unit_kerja' => 'nullable|string|max:150',
            'jabatan' => 'nullable|string|max:150',
            'kode_ok' => 'nullable|string|max:50',
            'uraian_pekerjaan' => 'nullable|string',
            'jenis_insiden' => 'nullable|string|max:100',
            'penjelasan_jenis_insiden' => 'nullable|string',
            'keterlibatan_alat' => 'nullable|string|max:150',
            'keterangan_alat_lain' => 'nullable|string|max:255',
            'nomor_alat' => 'nullable|string|max:100',
            'status_milik_alat_unit' => 'nullable|string|max:100',
            'tindakan_tidak_aman' => 'nullable|string',
            'ua_sebab_1' => 'nullable|string',
            'ua_sebab_2' => 'nullable|string',
            'ua_sebab_3' => 'nullable|string',
            'kondisi_tidak_aman' => 'nullable|string',
            'uc_sebab_1' => 'nullable|string',
            'uc_sebab_2' => 'nullable|string',
            'uc_sebab_3' => 'nullable|string',
            'faktor_pribadi' => 'nullable|string',
            'fp_sebab_1' => 'nullable|string',
            'fp_sebab_2' => 'nullable|string',
            'fp_sebab_3' => 'nullable|string',
            'faktor_pekerjaan' => 'nullable|string',
            'fk_sebab_1' => 'nullable|string',
            'fk_sebab_2' => 'nullable|string',
            'fk_sebab_3' => 'nullable|string',
            'sistem_manajemen_terkait' => 'nullable|string',
            'deskripsi_kegagalan_sistem' => 'nullable|string',
            'penyebab_kegagalan_sistem' => 'nullable|string',
            'sebab_sebab_teridentifikasi' => 'nullable|string',
            'pengendalian_risiko' => 'nullable|string|max:150',
            'penjelasan_pengendalian_risiko' => 'nullable|string',
            'rincian_cidera' => 'nullable|string|max:150',
            'persentase_luka_bakar' => 'nullable|numeric|min:0|max:100',
            'keterangan_detail_cidera' => 'nullable|string',
            'kategori_penanganan_medis' => 'nullable|string|max:100',
            'keterangan_penanganan_medis' => 'nullable|string',
            'nama_dokter' => 'nullable|string|max:150',
            'total_hari_kerja_hilang' => 'nullable|integer|min:0',
            'nominal_biaya_medis' => 'nullable|numeric|min:0',
            'penjamin_platform' => 'nullable|string|max:100',
        ]);
    }
}
