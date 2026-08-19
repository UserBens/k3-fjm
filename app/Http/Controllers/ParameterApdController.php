<?php

namespace App\Http\Controllers;

use App\Models\ParameterApd;
use App\Models\ParameterApdBasisFrekuensi;
use App\Models\ParameterApdJenisTransaksi;
use App\Models\ParameterApdKonversiSimbol;
use App\Models\ParameterApdNilaiDropdown;
use App\Models\ParameterApdSetelanGlobal;
use App\Models\ParameterApdSumberFrekuensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParameterApdController extends Controller
{
    /** Halaman utama (shell). Semua data diambil lewat endpoint-endpoint di bawah. */
    public function index()
    {
        return view('parameter-apd.index');
    }

    // ══════════════════════════════════════════════════════════
    // A · SETELAN GLOBAL (per Tahun Anggaran)
    // ══════════════════════════════════════════════════════════

    public function globalShow(Request $request)
    {
        $tahun = (int) $request->query('tahun', now()->year);
        $pengaturan = ParameterApd::forTahun($tahun);

        return response()->json([
            'data'   => $pengaturan,
            'exists' => $pengaturan->exists,
        ]);
    }

    public function globalPeriodeList()
    {
        return response()->json(ParameterApd::daftarTahunTersimpan());
    }

    public function globalUpdate(Request $request)
    {
        $validated = $request->validate([
            'tahun_anggaran'       => 'required|integer|min:2000|max:2100',
            'buffer_cadangan'      => 'required|numeric|min:0|max:100',
            'hitung_tanda_o'       => 'required|boolean',
            'wajib_dasar_di_hijau' => 'required|boolean',
            'pembulatan_kemasan'   => 'required|boolean',
            'hari_kerja_baku'      => 'required|integer|min:1|max:366',
            'hari_kerja_shift'     => 'required|integer|min:1|max:366',
            'pakai_kontrak_dulu'   => 'required|boolean',
        ]);

        $pengaturan = ParameterApd::updateOrCreate(
            ['tahun_anggaran' => $validated['tahun_anggaran']],
            $validated
        );

        return response()->json([
            'message' => "Setelan Global APD tahun anggaran {$validated['tahun_anggaran']} berhasil disimpan.",
            'data'    => $pengaturan->fresh(),
        ]);
    }

    // ══════════════════════════════════════════════════════════
    // B · BASIS FREKUENSI PENGGANTIAN
    // ══════════════════════════════════════════════════════════

    public function basisFrekuensiIndex()
    {
        return response()->json(ParameterApdBasisFrekuensi::orderBy('urutan')->get());
    }

    public function basisFrekuensiStore(Request $request)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_basis_frekuensi', [
            'kode'             => 'required|string|max:30',
            'basis_frekuensi'  => 'required|string|max:255',
            'rumus_per_tahun'  => 'required|string|max:255',
            'arti_nilai_basis' => 'required|string|max:255',
            'contoh'           => 'nullable|string|max:255',
            'urutan'           => 'required|integer|min:0',
            'status'           => 'required|in:AKTIF,NONAKTIF',
        ]);
        $row = ParameterApdBasisFrekuensi::create($data);

        return response()->json(['message' => 'Basis Frekuensi berhasil ditambahkan.', 'data' => $row]);
    }

    public function basisFrekuensiUpdate(Request $request, ParameterApdBasisFrekuensi $basisFrekuensi)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_basis_frekuensi', [
            'kode'             => 'required|string|max:30',
            'basis_frekuensi'  => 'required|string|max:255',
            'rumus_per_tahun'  => 'required|string|max:255',
            'arti_nilai_basis' => 'required|string|max:255',
            'contoh'           => 'nullable|string|max:255',
            'urutan'           => 'required|integer|min:0',
            'status'           => 'required|in:AKTIF,NONAKTIF',
        ], $basisFrekuensi->id);
        $basisFrekuensi->update($data);

        return response()->json(['message' => 'Basis Frekuensi berhasil diperbarui.', 'data' => $basisFrekuensi]);
    }

    public function basisFrekuensiDestroy(ParameterApdBasisFrekuensi $basisFrekuensi)
    {
        $basisFrekuensi->delete();

        return response()->json(['message' => 'Basis Frekuensi berhasil dihapus.']);
    }

    // ══════════════════════════════════════════════════════════
    // B2 · SUMBER FREKUENSI
    // ══════════════════════════════════════════════════════════

    public function sumberFrekuensiIndex()
    {
        return response()->json(ParameterApdSumberFrekuensi::orderBy('urutan')->get());
    }

    public function sumberFrekuensiStore(Request $request)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_sumber_frekuensi', [
            'kode'                => 'required|string|max:30',
            'sumber_frekuensi'    => 'required|string|max:255',
            'bisa_dipertahankan'  => 'required|boolean',
            'keterangan'          => 'required|string|max:255',
            'urutan'              => 'required|integer|min:0',
            'status'              => 'required|in:AKTIF,NONAKTIF',
        ]);
        $row = ParameterApdSumberFrekuensi::create($data);

        return response()->json(['message' => 'Sumber Frekuensi berhasil ditambahkan.', 'data' => $row]);
    }

    public function sumberFrekuensiUpdate(Request $request, ParameterApdSumberFrekuensi $sumberFrekuensi)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_sumber_frekuensi', [
            'kode'                => 'required|string|max:30',
            'sumber_frekuensi'    => 'required|string|max:255',
            'bisa_dipertahankan'  => 'required|boolean',
            'keterangan'          => 'required|string|max:255',
            'urutan'              => 'required|integer|min:0',
            'status'              => 'required|in:AKTIF,NONAKTIF',
        ], $sumberFrekuensi->id);
        $sumberFrekuensi->update($data);

        return response()->json(['message' => 'Sumber Frekuensi berhasil diperbarui.', 'data' => $sumberFrekuensi]);
    }

    public function sumberFrekuensiDestroy(ParameterApdSumberFrekuensi $sumberFrekuensi)
    {
        $sumberFrekuensi->delete();

        return response()->json(['message' => 'Sumber Frekuensi berhasil dihapus.']);
    }

    // ══════════════════════════════════════════════════════════
    // C · KONVERSI SIMBOL MATRIKS
    // ══════════════════════════════════════════════════════════

    public function konversiSimbolIndex()
    {
        return response()->json(ParameterApdKonversiSimbol::orderBy('urutan')->get());
    }

    public function konversiSimbolStore(Request $request)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_konversi_simbol', [
            'simbol'     => 'required|string|max:5',
            'nilai'      => 'required|integer|in:0,1',
            'keterangan' => 'required|string|max:255',
            'urutan'     => 'required|integer|min:0',
        ]);
        $row = ParameterApdKonversiSimbol::create($data);

        return response()->json(['message' => 'Simbol berhasil ditambahkan.', 'data' => $row]);
    }

    public function konversiSimbolUpdate(Request $request, ParameterApdKonversiSimbol $konversiSimbol)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_konversi_simbol', [
            'simbol'     => 'required|string|max:5',
            'nilai'      => 'required|integer|in:0,1',
            'keterangan' => 'required|string|max:255',
            'urutan'     => 'required|integer|min:0',
        ], $konversiSimbol->id);
        $konversiSimbol->update($data);

        return response()->json(['message' => 'Simbol berhasil diperbarui.', 'data' => $konversiSimbol]);
    }

    public function konversiSimbolDestroy(ParameterApdKonversiSimbol $konversiSimbol)
    {
        $konversiSimbol->delete();

        return response()->json(['message' => 'Simbol berhasil dihapus.']);
    }

    // ══════════════════════════════════════════════════════════
    // D · DAFTAR NILAI SAH (sumber dropdown, per kategori)
    // ══════════════════════════════════════════════════════════

    /** Semua kategori + isinya sekaligus, sudah dikelompokkan — dipakai render tab di halaman. */
    public function nilaiDropdownIndex()
    {
        $rows = ParameterApdNilaiDropdown::orderBy('kategori')->orderBy('urutan')->get();

        $grouped = collect(ParameterApdNilaiDropdown::KATEGORI)->mapWithKeys(function ($kategori) use ($rows) {
            return [$kategori => $rows->where('kategori', $kategori)->values()];
        });

        return response()->json([
            'kategori' => ParameterApdNilaiDropdown::KATEGORI,
            'data'     => $grouped,
        ]);
    }

    public function nilaiDropdownStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori'   => 'required|string|in:' . implode(',', ParameterApdNilaiDropdown::KATEGORI),
            'nilai'      => 'required|string|max:255|unique:parameter_apd_nilai_dropdown,nilai,NULL,id,kategori,' . $request->input('kategori'),
            'keterangan' => 'nullable|string|max:255',
            'urutan'     => 'required|integer|min:0',
            'status'     => 'required|in:AKTIF,NONAKTIF',
        ]);
        $data = $validator->validate();
        $row = ParameterApdNilaiDropdown::create($data);

        return response()->json(['message' => "Nilai '{$row->nilai}' berhasil ditambahkan ke kategori {$row->kategori}.", 'data' => $row]);
    }

    public function nilaiDropdownUpdate(Request $request, ParameterApdNilaiDropdown $nilaiDropdown)
    {
        $validator = Validator::make($request->all(), [
            'nilai'      => 'required|string|max:255|unique:parameter_apd_nilai_dropdown,nilai,' . $nilaiDropdown->id . ',id,kategori,' . $nilaiDropdown->kategori,
            'keterangan' => 'nullable|string|max:255',
            'urutan'     => 'required|integer|min:0',
            'status'     => 'required|in:AKTIF,NONAKTIF',
        ]);
        $nilaiDropdown->update($validator->validate());

        return response()->json(['message' => 'Nilai berhasil diperbarui.', 'data' => $nilaiDropdown]);
    }

    public function nilaiDropdownDestroy(ParameterApdNilaiDropdown $nilaiDropdown)
    {
        $nilaiDropdown->delete();

        return response()->json(['message' => 'Nilai berhasil dihapus.']);
    }

    // ══════════════════════════════════════════════════════════
    // E · JENIS TRANSAKSI 60_LOG_APD
    // ══════════════════════════════════════════════════════════

    public function jenisTransaksiIndex()
    {
        return response()->json(ParameterApdJenisTransaksi::orderBy('urutan')->get());
    }

    public function jenisTransaksiStore(Request $request)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_jenis_transaksi', [
            'jenis_transaksi' => 'required|string|max:255',
            'arah_stok'       => 'required|in:KELUAR,MASUK,NETRAL',
            'menjadi_limbah'  => 'required|boolean',
            'keterangan'      => 'required|string|max:255',
            'urutan'          => 'required|integer|min:0',
            'status'          => 'required|in:AKTIF,NONAKTIF',
        ]);
        $row = ParameterApdJenisTransaksi::create($data);

        return response()->json(['message' => 'Jenis Transaksi berhasil ditambahkan.', 'data' => $row]);
    }

    public function jenisTransaksiUpdate(Request $request, ParameterApdJenisTransaksi $jenisTransaksi)
    {
        $data = $this->validateReferensi($request, 'parameter_apd_jenis_transaksi', [
            'jenis_transaksi' => 'required|string|max:255',
            'arah_stok'       => 'required|in:KELUAR,MASUK,NETRAL',
            'menjadi_limbah'  => 'required|boolean',
            'keterangan'      => 'required|string|max:255',
            'urutan'          => 'required|integer|min:0',
            'status'          => 'required|in:AKTIF,NONAKTIF',
        ], $jenisTransaksi->id);
        $jenisTransaksi->update($data);

        return response()->json(['message' => 'Jenis Transaksi berhasil diperbarui.', 'data' => $jenisTransaksi]);
    }

    public function jenisTransaksiDestroy(ParameterApdJenisTransaksi $jenisTransaksi)
    {
        $jenisTransaksi->delete();

        return response()->json(['message' => 'Jenis Transaksi berhasil dihapus.']);
    }

    // ══════════════════════════════════════════════════════════
    // Helper
    // ══════════════════════════════════════════════════════════

    /**
     * Validasi generik utk tabel referensi (B, B2, C, E) yang punya kolom kode/label unik.
     * $ignoreId dipakai supaya rule unique tidak bentrok dengan baris yang sedang diedit.
     */
    private function validateReferensi(Request $request, string $table, array $rules, ?int $ignoreId = null): array
    {
        // Tambahkan rule unique otomatis utk kolom kunci pertama (kode/simbol/jenis_transaksi) bila ada di rules.
        $kunciUnik = array_intersect(['kode', 'simbol', 'jenis_transaksi'], array_keys($rules));
        foreach ($kunciUnik as $kolom) {
            $rules[$kolom] .= '|unique:' . $table . ',' . $kolom . ($ignoreId ? ",{$ignoreId}" : '');
        }

        return Validator::make($request->all(), $rules)->validate();
    }
}
