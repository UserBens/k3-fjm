<?php

namespace App\Http\Controllers;

use App\Models\ProfilKerjaApd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProfilKerjaApdController extends Controller
{
    /** Halaman utama (shell). Data tabel diambil lewat endpoint api(). */
    public function index()
    {
        return view('profil-kerja-apd.index');
    }

    /** Endpoint JSON: daftar profil kerja + rekap ringkasan. */
    public function api(Request $request)
    {
        $query = ProfilKerjaApd::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_profil', 'like', "%{$search}%")
                    ->orWhere('nama_profil', 'like', "%{$search}%")
                    ->orWhere('contoh_jabatan', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($request->filled('tier')) {
            $query->where('tier_risiko', (int) $request->get('tier'));
        }

        $rows = $query->orderBy('kode_profil')->get();

        $data = $rows->map(function (ProfilKerjaApd $row) {
            return [
                'id'                => $row->id,
                'kode_profil'       => $row->kode_profil,
                'nama_profil'       => $row->nama_profil,
                'b1' => $row->b1,
                'b2' => $row->b2,
                'b3' => $row->b3,
                'b4' => $row->b4,
                'b5' => $row->b5,
                'b6' => $row->b6,
                'b7' => $row->b7,
                'b8' => $row->b8,
                'skor_tertinggi'    => $row->skor_tertinggi,
                'skor_total'        => $row->skor_total,
                'jml_bahaya_sedang' => $row->jml_bahaya_sedang,
                'tier_risiko'       => $row->tier_risiko,
                'label_tier'        => $row->label_tier,
                'warna_tier'        => $row->warna_tier,
                'bahaya_pengendali' => $row->bahaya_pengendali,
                'deskripsi_paparan' => $row->deskripsi_paparan,
                'contoh_jabatan'    => $row->contoh_jabatan,
                'dasar_penilaian'   => $row->dasar_penilaian,
                'sumber_skor'       => $row->sumber_skor,
                'jml_karyawan'      => $row->jml_karyawan,
                'status'            => $row->status,
            ];
        });

        return response()->json([
            'data' => $data,
            'summary' => [
                'total_profil'    => $rows->count(),
                'total_karyawan'  => $rows->sum('jml_karyawan'),
                'jml_per_tier'    => $rows->groupBy('tier_risiko')->map->count(),
                'karyawan_per_tier' => $rows->groupBy('tier_risiko')->map(fn($g) => $g->sum('jml_karyawan')),
            ],
            'label_bahaya' => ProfilKerjaApd::LABEL_BAHAYA,
            'label_tier'   => ProfilKerjaApd::LABEL_TIER,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProfil($request);
        $row = ProfilKerjaApd::create($validated);

        return response()->json([
            'message' => "Profil {$row->kode_profil} berhasil ditambahkan.",
            'data' => $row->fresh(),
        ]);
    }

    public function update(Request $request, ProfilKerjaApd $profilKerjaK3)
    {
        $validated = $this->validateProfil($request, $profilKerjaK3->id);
        $profilKerjaK3->update($validated);

        return response()->json([
            'message' => "Profil {$profilKerjaK3->kode_profil} berhasil diperbarui.",
            'data' => $profilKerjaK3->fresh(),
        ]);
    }

    public function destroy(ProfilKerjaApd $profilKerjaK3)
    {
        $kode = $profilKerjaK3->kode_profil;
        $profilKerjaK3->delete();

        return response()->json(['message' => "Profil {$kode} berhasil dihapus."]);
    }

    private function validateProfil(Request $request, ?int $ignoreId = null): array
    {
        $validator = Validator::make($request->all(), [
            'kode_profil' => 'required|string|max:10|unique:profil_kerja_k3,kode_profil' . ($ignoreId ? ",{$ignoreId}" : ''),
            'nama_profil' => 'required|string|max:255',
            'b1' => 'required|integer|min:0|max:4',
            'b2' => 'required|integer|min:0|max:4',
            'b3' => 'required|integer|min:0|max:4',
            'b4' => 'required|integer|min:0|max:4',
            'b5' => 'required|integer|min:0|max:4',
            'b6' => 'required|integer|min:0|max:4',
            'b7' => 'required|integer|min:0|max:4',
            'b8' => 'required|integer|min:0|max:4',
            'deskripsi_paparan' => 'nullable|string',
            'contoh_jabatan'    => 'nullable|string',
            'dasar_penilaian'   => 'nullable|string',
            'sumber_skor'       => 'nullable|string|max:255',
            'jml_karyawan'      => 'required|integer|min:0',
            'status'            => 'required|in:AKTIF,NONAKTIF',
        ]);

        return $validator->validate();
    }
}
