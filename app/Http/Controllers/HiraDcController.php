<?php

namespace App\Http\Controllers;

use App\Models\Hiradc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class HiradcController extends Controller
{
    public function index()
    {
        return view('hiradc.index');
    }

    public function data(Request $request)
    {
        try {
            $rows = Hiradc::orderByDesc('id')->get()->map(function (Hiradc $h) {
                return [
                    'id' => $h->id,
                    'no_hiradc' => $h->no_hiradc,
                    'judul_pekerjaan' => $h->judul_pekerjaan,
                    'kategori_pekerjaan' => $h->kategori_pekerjaan,
                    'potensi_bahaya' => $h->potensi_bahaya,
                    'konsekuensi_dampak' => $h->konsekuensi_dampak,
                    'l_awal' => $h->l_awal,
                    's_awal' => $h->s_awal,
                    'risiko_awal' => $h->risiko_awal,
                    'apd_wajib' => $h->apd_wajib,
                    'apd_khusus' => $h->apd_khusus,
                    'pengendalian_utama' => $h->pengendalian_utama,
                    'l_sesudah' => $h->l_sesudah,
                    's_sesudah' => $h->s_sesudah,
                    'risiko_sesudah' => $h->risiko_sesudah,
                    'pic' => $h->pic,
                    'status' => $h->status,
                    'dokumen_url' => $h->dokumen_url,
                    'dokumen_hiradc' => $h->dokumen_hiradc,
                ];
            });

            return response()->json(['data' => $rows]);
        } catch (Throwable $e) {
            $this->logError('data', $e);

            return response()->json([
                'message' => 'Gagal memuat data HIRADC.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validated($request);
            $validated = $this->handleUpload($request, $validated);

            $hiradc = Hiradc::create($validated);

            return response()->json(['message' => 'Data HIRADC berhasil ditambahkan.', 'data' => $hiradc], 201);
        } catch (ValidationException $e) {
            $this->logValidationError('store', $e, $request);

            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            $this->logError('store', $e, $request);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ], 500);
        }
    }

    public function update(Request $request, Hiradc $hiradc)
    {
        try {
            $validated = $this->validated($request);
            $validated = $this->handleUpload($request, $validated, $hiradc);

            $hiradc->update($validated);

            return response()->json(['message' => 'Data HIRADC berhasil diperbarui.', 'data' => $hiradc]);
        } catch (ValidationException $e) {
            $this->logValidationError('update', $e, $request, $hiradc->id);

            return response()->json([
                'message' => 'Data yang dikirim tidak valid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            $this->logError('update', $e, $request, $hiradc->id);

            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data.',
            ], 500);
        }
    }

    public function destroy(Hiradc $hiradc)
    {
        try {
            if ($hiradc->dokumen) {
                Storage::disk('public')->delete($hiradc->dokumen);
            }

            $hiradc->delete();

            return response()->json(['message' => 'Data HIRADC berhasil dihapus.']);
        } catch (Throwable $e) {
            $this->logError('destroy', $e, null, $hiradc->id);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
            ], 500);
        }
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'no_hiradc' => 'nullable|string|max:50',
            'judul_pekerjaan' => 'required|string|max:200',
            'kategori_pekerjaan' => 'required|string|max:150',
            'potensi_bahaya' => 'required|string',
            'konsekuensi_dampak' => 'nullable|string',
            'l_awal' => 'required|integer|min:1|max:5',
            's_awal' => 'required|integer|min:1|max:5',
            'apd_wajib' => 'nullable|string',
            'apd_khusus' => 'nullable|string',
            'pengendalian_utama' => 'nullable|string',
            'l_sesudah' => 'nullable|integer|min:1|max:5',
            's_sesudah' => 'nullable|integer|min:1|max:5',
            'pic' => 'nullable|string|max:100',
            'status' => 'required|in:Open,Close',
            'dokumen' => 'nullable|file|mimes:pdf|max:10240', // maks 10MB, khusus PDF
        ]);
    }

    /**
     * Handle file upload dokumen HIRADC. Kalau ada file baru & sedang edit,
     * file lama dihapus dari storage supaya tidak menumpuk sampah.
     */
    private function handleUpload(Request $request, array $validated, ?Hiradc $hiradc = null): array
    {
        if ($request->hasFile('dokumen')) {
            if ($hiradc && $hiradc->dokumen) {
                Storage::disk('public')->delete($hiradc->dokumen);
            }

            $file = $request->file('dokumen');
            $validated['dokumen'] = $file->store('hiradc-dokumen', 'public');
            $validated['dokumen_hiradc'] = $file->getClientOriginalName();
        } else {
            unset($validated['dokumen']);
        }

        return $validated;
    }

    /**
     * Log error umum (Throwable) lengkap dengan detail teknis.
     * Detail ini HANYA masuk ke log, tidak pernah dikirim ke response JSON.
     */
    private function logError(string $context, Throwable $e, ?Request $request = null, ?int $id = null): void
    {
        Log::error("Hiradc@{$context} gagal", array_filter([
            'id' => $id,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'input' => $request?->except(['_token', 'dokumen']),
            'trace' => $e->getTraceAsString(),
        ], fn($v) => $v !== null));
    }

    /**
     * Log error validasi lengkap dengan detail input yang dikirim.
     */
    private function logValidationError(string $context, ValidationException $e, Request $request, ?int $id = null): void
    {
        Log::error("Hiradc@{$context} gagal validasi", array_filter([
            'id' => $id,
            'errors' => $e->errors(),
            'input' => $request->except(['_token', 'dokumen']),
        ], fn($v) => $v !== null));
    }
}
