<?php

namespace App\Http\Controllers;

use App\Models\Hiradc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class HiradcController extends Controller
{
    public function index()
    {
        return view('hiradc.index');
    }

    /**
     * Endpoint JSON — dipanggil vanilla JS di view untuk search/filter/pagination.
     * Sengaja kirim semua data (bukan paginate DB) supaya filter+pagination
     * bisa jalan di client, konsisten dgn pola modul lain (Data Tenaga Kerja, dsb).
     */
    public function data(Request $request)
    {
        try {
            $rows = Hiradc::orderByDesc('id')->get()->map(function (Hiradc $h) {
                return [
                    'id' => $h->id,
                    'kode_ok' => $h->kode_ok,
                    'area_lokasi' => $h->area_lokasi,
                    'aktivitas_pekerjaan' => $h->aktivitas_pekerjaan,
                    'potensi_bahaya' => $h->potensi_bahaya,
                    'jenis_bahaya' => $h->jenis_bahaya,
                    'konsekuensi_dampak' => $h->konsekuensi_dampak,
                    'l_awal' => $h->l_awal,
                    's_awal' => $h->s_awal,
                    'risiko_awal' => $h->risiko_awal,
                    'pengendalian_ada' => $h->pengendalian_ada,
                    'apd_wajib' => $h->apd_wajib,
                    'pengendalian_tambahan' => $h->pengendalian_tambahan,
                    'l_sesudah' => $h->l_sesudah,
                    's_sesudah' => $h->s_sesudah,
                    'risiko_sesudah' => $h->risiko_sesudah,
                    'pic' => $h->pic,
                    'status' => $h->status,
                ];
            });

            return response()->json(['data' => $rows]);
        } catch (Throwable $e) {
            Log::error('Hiradc@data gagal', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Gagal memuat data HIRADC.',
                'debug' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validated($request);
            $hiradc = Hiradc::create($validated);

            return response()->json(['message' => 'Data HIRADC berhasil ditambahkan.', 'data' => $hiradc], 201);
        } catch (ValidationException $e) {
            Log::error('Hiradc@store gagal validasi', [
                'errors' => $e->errors(),
                'input' => $request->except(['_token']),
            ]);

            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            Log::error('Hiradc@store gagal', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'input' => $request->except(['_token']),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'debug' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function update(Request $request, Hiradc $hiradc)
    {
        try {
            $validated = $this->validated($request);
            $hiradc->update($validated);

            return response()->json(['message' => 'Data HIRADC berhasil diperbarui.', 'data' => $hiradc]);
        } catch (ValidationException $e) {
            Log::error('Hiradc@update gagal validasi', [
                'id' => $hiradc->id,
                'errors' => $e->errors(),
                'input' => $request->except(['_token']),
            ]);

            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            Log::error('Hiradc@update gagal', [
                'id' => $hiradc->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'input' => $request->except(['_token']),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data.',
                'debug' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function destroy(Hiradc $hiradc)
    {
        try {
            $hiradc->delete();

            return response()->json(['message' => 'Data HIRADC berhasil dihapus.']);
        } catch (Throwable $e) {
            Log::error('Hiradc@destroy gagal', [
                'id' => $hiradc->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'debug' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'kode_ok' => 'nullable|string|max:50',
            'area_lokasi' => 'required|string|max:150',
            'aktivitas_pekerjaan' => 'required|string|max:150',
            'potensi_bahaya' => 'required|string|max:150',
            'jenis_bahaya' => 'required|string|max:100',
            'konsekuensi_dampak' => 'nullable|string',
            'l_awal' => 'required|integer|min:1|max:5',
            's_awal' => 'required|integer|min:1|max:5',
            'pengendalian_ada' => 'nullable|string',
            'apd_wajib' => 'nullable|string',
            'pengendalian_tambahan' => 'nullable|string',
            'l_sesudah' => 'nullable|integer|min:1|max:5',
            's_sesudah' => 'nullable|integer|min:1|max:5',
            'pic' => 'nullable|string|max:100',
            'status' => 'required|in:Open,Close',
        ]);
    }
}
