<?php

namespace App\Http\Controllers;

use App\Models\MatriksApdJabatan;

use Illuminate\Http\Request;

class MatriksApdJabatanController extends Controller
{
    public function index()
    {
        return view('matriks-apd-jabatan.index');
    }

    public function data(Request $request)
    {
        $rows = MatriksApdJabatan::orderByDesc('id')->get()->map(function (MatriksApdJabatan $m) {
            $apd = [];
            foreach (array_keys(MatriksApdJabatan::APD_COLUMNS) as $col) {
                $apd[$col] = $m->{$col};
            }

            return [
                'id' => $m->id,
                'kode_ok' => $m->kode_ok,
                'nama_pekerjaan' => $m->nama_pekerjaan,
                'jabatan_posisi' => $m->jabatan_posisi,
                'apd' => $apd,
                'jumlah_apd_wajib' => $m->jumlah_apd_wajib,
                'potensi_bahaya_aktivitas' => $m->potensi_bahaya_aktivitas,
                'jenis_bahaya' => $m->jenis_bahaya,
                'konsekuensi_dampak' => $m->konsekuensi_dampak,
                'l_awal' => $m->l_awal,
                's_awal' => $m->s_awal,
                'risiko_awal' => $m->risiko_awal,
                'pengendalian_eksisting' => $m->pengendalian_eksisting,
                'pengendalian_tambahan' => $m->pengendalian_tambahan,
                'l_res' => $m->l_res,
                's_res' => $m->s_res,
                'risiko_residual' => $m->risiko_residual,
                'pic' => $m->pic,
                'status' => $m->status,
            ];
        });

        return response()->json(['data' => $rows]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $item = MatriksApdJabatan::create($validated);

        return response()->json(['message' => 'Matriks APD berhasil ditambahkan.', 'data' => $item], 201);
    }

    public function update(Request $request, MatriksApdJabatan $matriksApdJabatan)
    {
        $validated = $this->validated($request);
        $matriksApdJabatan->update($validated);

        return response()->json(['message' => 'Matriks APD berhasil diperbarui.', 'data' => $matriksApdJabatan]);
    }

    public function destroy(MatriksApdJabatan $matriksApdJabatan)
    {
        $matriksApdJabatan->delete();

        return response()->json(['message' => 'Matriks APD berhasil dihapus.']);
    }

    private function validated(Request $request): array
    {
        $apdRules = [];
        foreach (array_keys(MatriksApdJabatan::APD_COLUMNS) as $col) {
            $apdRules[$col] = 'required|in:WAJIB,KONDISIONAL,TIDAK';
        }

        return $request->validate(array_merge($apdRules, [
            'kode_ok' => 'required|string|max:50',
            'nama_pekerjaan' => 'required|string|max:150',
            'jabatan_posisi' => 'required|string|max:150',
            'hiradc_id' => 'nullable|exists:hiradcs,id',
            'potensi_bahaya_aktivitas' => 'nullable|string|max:150',
            'jenis_bahaya' => 'nullable|string|max:100',
            'konsekuensi_dampak' => 'nullable|string',
            'l_awal' => 'nullable|integer|min:1|max:5',
            's_awal' => 'nullable|integer|min:1|max:5',
            'pengendalian_eksisting' => 'nullable|string',
            'pengendalian_tambahan' => 'nullable|string',
            'l_res' => 'nullable|integer|min:1|max:5',
            's_res' => 'nullable|integer|min:1|max:5',
            'pic' => 'nullable|string|max:100',
            'status' => 'required|in:Open,Close',
        ]));
    }
}
