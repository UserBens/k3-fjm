<?php

namespace App\Http\Controllers;

use App\Models\AktivitasKpiK3;
use App\Models\PengaturanKpiK3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KpiK3MatriksController extends Controller
{
    /** Halaman utama (shell). Data tabel + pengaturan diambil lewat endpoint api(). */
    public function index()
    {
        return view('matriks-kpi.index');
    }

    /**
     * Endpoint JSON: daftar aktivitas (dengan skor & bobot % otomatis)
     * + rekap total skor per tim + data pengaturan aktif.
     */
    public function api(Request $request)
    {
        $query = AktivitasKpiK3::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                    ->orWhere('nama_aktivitas', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($tim = $request->get('tim')) {
            // tim = safety | pengawas | medis
            if (in_array($tim, ['safety', 'pengawas', 'medis'])) {
                $query->where($tim, true);
            }
        }

        $rows = $query->orderBy('kode')->get();

        // Total skor per tim, HANYA aktivitas berstatus AKTIF (dasar pembagian bobot %)
        $totalSkorSafety   = AktivitasKpiK3::aktif()->where('safety', true)->sum('skor');
        $totalSkorPengawas = AktivitasKpiK3::aktif()->where('pengawas', true)->sum('skor');
        $totalSkorMedis    = AktivitasKpiK3::aktif()->where('medis', true)->sum('skor');

        $data = $rows->map(function (AktivitasKpiK3 $row) use ($totalSkorSafety, $totalSkorPengawas, $totalSkorMedis) {
            $aktif = $row->status === 'AKTIF';

            return [
                'id'                => $row->id,
                'kode'              => $row->kode,
                'nama_aktivitas'    => $row->nama_aktivitas,
                'kompleksitas'      => $row->kompleksitas,
                'label_kompleksitas' => $row->label_kompleksitas,
                'frekuensi'         => $row->frekuensi,
                'label_frekuensi'   => $row->label_frekuensi,
                'skor'              => $row->skor,
                'target_per_bulan'  => $row->target_per_bulan,
                'ikut_hari_kerja'   => $row->ikut_hari_kerja,
                'maks_per_hari'     => $row->maks_per_hari,
                'mulai_berlaku'     => $row->mulai_berlaku,
                'akhir_berlaku'     => $row->akhir_berlaku,
                'safety'            => $row->safety,
                'pengawas'          => $row->pengawas,
                'medis'             => $row->medis,
                'status'            => $row->status,
                // Bobot % dihitung on-the-fly = skor baris / total skor tim (aktif) x 100
                'bobot_safety'      => ($aktif && $row->safety && $totalSkorSafety > 0)
                    ? round($row->skor / $totalSkorSafety * 100, 1) : 0,
                'bobot_pengawas'    => ($aktif && $row->pengawas && $totalSkorPengawas > 0)
                    ? round($row->skor / $totalSkorPengawas * 100, 1) : 0,
                'bobot_medis'       => ($aktif && $row->medis && $totalSkorMedis > 0)
                    ? round($row->skor / $totalSkorMedis * 100, 1) : 0,
            ];
        });

        return response()->json([
            'data' => $data,
            'summary' => [
                'total_skor'          => $rows->sum('skor'),
                'total_target'        => $rows->sum('target_per_bulan'),
                'total_skor_safety'   => $totalSkorSafety,
                'total_skor_pengawas' => $totalSkorPengawas,
                'total_skor_medis'    => $totalSkorMedis,
            ],
            'pengaturan' => PengaturanKpiK3::current(),
        ]);
    }

    /** Simpan aktivitas baru (dari modal Tambah). */
    public function store(Request $request)
    {
        $validated = $this->validateAktivitas($request);
        $row = AktivitasKpiK3::create($validated);

        return response()->json([
            'message' => "Aktivitas {$row->kode} berhasil ditambahkan.",
            'data' => $row,
        ]);
    }

    /** Update aktivitas (dari modal Edit). */
    public function update(Request $request, AktivitasKpiK3 $aktivitasKpiK3)
    {
        $validated = $this->validateAktivitas($request, $aktivitasKpiK3->id);
        $aktivitasKpiK3->update($validated);

        return response()->json([
            'message' => "Aktivitas {$aktivitasKpiK3->kode} berhasil diperbarui.",
            'data' => $aktivitasKpiK3,
        ]);
    }

    /** Hapus aktivitas. */
    public function destroy(AktivitasKpiK3 $aktivitasKpiK3)
    {
        $kode = $aktivitasKpiK3->kode;
        $aktivitasKpiK3->delete();

        return response()->json(['message' => "Aktivitas {$kode} berhasil dihapus."]);
    }

    /** Update panel Pengaturan (bagian 1-6). */
    public function updatePengaturan(Request $request)
    {
        $validated = $request->validate([
            'tahun_aktif' => 'required|integer|min:2000|max:2100',
            'bulan_aktif' => 'required|integer|min:1|max:12',
            'tanggal_cutoff_manajer' => 'required|integer|min:1|max:31',
            'periode_manajer_mulai' => 'required|date',
            'periode_manajer_selesai' => 'required|date|after_or_equal:periode_manajer_mulai',
            'periode_p2k3_mulai' => 'required|date',
            'periode_p2k3_selesai' => 'required|date|after_or_equal:periode_p2k3_mulai',
            'hari_kerja_efektif_manajer' => 'required|integer|min:0|max:31',
            'hari_kerja_efektif_p2k3' => 'required|integer|min:0|max:31',
            'jumlah_hari_kalender_manajer' => 'required|integer|min:0|max:31',
            'jumlah_hari_kalender_p2k3' => 'required|integer|min:0|max:31',
            'batas_terlambat_lapor' => 'required|integer|min:0',
            'batas_lapor_lebih_awal' => 'required|integer|min:0',
            'porsi_capaian_aktivitas' => 'required|numeric|min:0|max:100',
            'porsi_ketepatan_waktu' => 'required|numeric|min:0|max:100',
            'tunjangan_penuh' => 'required|integer|min:0',
            'skor_minimum_tunjangan' => 'required|numeric|min:0|max:100',
            'skor_maksimum_tunjangan' => 'required|numeric|min:0|max:100',
            'tim_safety_dapat_tunjangan' => 'required|boolean',
            'tim_pengawas_dapat_tunjangan' => 'required|boolean',
            'tim_medis_dapat_tunjangan' => 'required|boolean',
            'ambang_merah' => 'required|numeric|min:0|max:100',
            'ambang_kuning' => 'required|numeric|min:0|max:100',
        ]);

        $pengaturan = PengaturanKpiK3::current();
        $pengaturan->update($validated);

        return response()->json([
            'message' => 'Pengaturan KPI K3 berhasil disimpan.',
            'data' => $pengaturan->fresh(),
        ]);
    }

    private function validateAktivitas(Request $request, ?int $ignoreId = null): array
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:aktivitas_kpi_k3,kode' . ($ignoreId ? ",{$ignoreId}" : ''),
            'nama_aktivitas' => 'required|string|max:255',
            'kompleksitas' => 'required|integer|in:1,2,3',
            'frekuensi' => 'required|integer|in:1,2,3',
            'target_per_bulan' => 'required|integer|min:0',
            'ikut_hari_kerja' => 'required|boolean',
            'maks_per_hari' => 'required|integer|min:0',
            'mulai_berlaku' => 'required|integer|min:2000|max:2100',
            'akhir_berlaku' => 'nullable|integer|min:2000|max:2100',
            'safety' => 'required|boolean',
            'pengawas' => 'required|boolean',
            'medis' => 'required|boolean',
            'status' => 'required|in:AKTIF,NONAKTIF',
        ]);

        return $validator->validate();
    }
}
