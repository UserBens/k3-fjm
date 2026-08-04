<?php

namespace App\Http\Controllers;

use App\Models\Hiradc;
use App\Models\HiradcGroup;
use App\Models\HiradcItem;
use App\Models\KodeOk;
use App\Models\StokAPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $documents = Hiradc::with([
                'kodeOk.unitKerjaRelasi',
                'kodeOk.kualifikasiRelasi',
                'apdList',
            ])->orderByDesc('id')->get();

            return response()->json(['data' => $documents->map(fn($d) => $this->transformDocument($d))]);
        } catch (Throwable $e) {
            $this->logError('data', $e);

            return response()->json(['message' => 'Gagal memuat data HIRADC.'], 500);
        }
    }

    public function show(Hiradc $hiradc)
    {
        try {
            $documents = Hiradc::with([
                'kodeOk.unitKerjaRelasi',
                'kodeOk.kualifikasiRelasi',
                'apdList',
            ])->orderByDesc('id')->get();

            return response()->json(['data' => $this->transformDocument($hiradc)]);
        } catch (Throwable $e) {
            $this->logError('show', $e, null, $hiradc->id);

            return response()->json(['message' => 'Gagal memuat detail HIRADC.'], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info('Cek Request Header Content-Type:', [$request->header('Content-Type')]);
        Log::info('Cek File Dokumen:', ['ada_file' => $request->hasFile('dokumen')]);
        try {
            $validated = $this->validatedDocument($request);
            $apdIds = $validated['apd_ids'] ?? [];
            unset($validated['apd_ids']);

            if ($request->hasFile('dokumen')) {
                $validated['dokumen'] = $request->file('dokumen')->store('hiradc/dokumen', 'public');
            } else {
                unset($validated['dokumen']);
            }

            $document = DB::transaction(function () use ($validated, $apdIds) {
                $document = Hiradc::create($validated);
                $document->apdList()->sync($apdIds);
                return $document;
            });

            $document->load(['kodeOk.unitKerjaRelasi', 'kodeOk.kualifikasiRelasi', 'apdList']);

            return response()->json([
                'message' => 'Data HIRADC berhasil ditambahkan.',
                'data' => $this->transformDocument($document),
            ], 201);
        } catch (ValidationException $e) {
            $this->logValidationError('store', $e, $request);
            return response()->json(['message' => 'Data yang dikirim tidak valid.', 'errors' => $e->errors()], 422);
        } catch (Throwable $e) {
            $this->logError('store', $e, $request);
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
        }
    }

    public function update(Request $request, Hiradc $hiradc)
    {
        try {
            $validated = $this->validatedDocument($request);
            $apdIds = $validated['apd_ids'] ?? [];
            unset($validated['apd_ids']);

            if ($request->hasFile('dokumen')) {
                if ($hiradc->dokumen) {
                    Storage::disk('public')->delete($hiradc->dokumen);
                }
                $validated['dokumen'] = $request->file('dokumen')->store('hiradc/dokumen', 'public');
            } else {
                unset($validated['dokumen']); // jangan timpa dokumen lama kalau tidak upload baru
            }

            DB::transaction(function () use ($hiradc, $validated, $apdIds) {
                $hiradc->update($validated);
                $hiradc->apdList()->sync($apdIds);
            });

            $hiradc->load(['kodeOk.unitKerjaRelasi', 'kodeOk.kualifikasiRelasi', 'apdList']);

            return response()->json([
                'message' => 'Data HIRADC berhasil diperbarui.',
                'data' => $this->transformDocument($hiradc),
            ]);
        } catch (ValidationException $e) {
            $this->logValidationError('update', $e, $request, $hiradc->id);
            return response()->json(['message' => 'Data yang dikirim tidak valid.', 'errors' => $e->errors()], 422);
        } catch (Throwable $e) {
            $this->logError('update', $e, $request, $hiradc->id);
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui data.'], 500);
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
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data.'], 500);
        }
    }

    public function periksa(Request $request, $id)
    {
        // Ambil data user dari session yang Anda buat di LoginController
        $authUser = session('auth_user');

        if (!$authUser) {
            return response()->json(['message' => 'Anda harus login terlebih dahulu.'], 401);
        }

        $hiradc = Hiradc::find($id);

        $hiradc->diperiksa_nama = $authUser['nama_lengkap'];
        $hiradc->diperiksa_tanggal = now();

        // TAMBAHKAN BARIS INI: Ubah status dokumen menjadi diperiksa
        $hiradc->status = 'diperiksa';

        $hiradc->save();

        return response()->json(['message' => 'Dokumen berhasil diperiksa.']);
    }

    public function sahkan(Request $request, $id)
    {
        $authUser = session('auth_user');

        if (!$authUser) {
            return response()->json(['message' => 'Anda harus login terlebih dahulu.'], 401);
        }

        $hiradc = Hiradc::find($id);

        $hiradc->disahkan_nama = $authUser['nama_lengkap'];
        $hiradc->disahkan_tanggal = now();

        // TAMBAHKAN BARIS INI: Ubah status dokumen menjadi disahkan
        $hiradc->status = 'disahkan';

        $hiradc->save();

        return response()->json(['message' => 'Dokumen berhasil disahkan.']);
    }

    /**
     * Ubah struktur Eloquent jadi bentuk datar+bersarang yang gampang dipakai frontend.
     */
    private function transformDocument(Hiradc $d): array
    {
        return [
            'id' => $d->id,
            'departemen' => $d->departemen,
            'area_kerja' => $d->area_kerja,
            'sub_area' => $d->sub_area,
            'kualifikasi' => $d->kualifikasi,
            'pekerjaan' => $d->pekerjaan,
            'kode_ok_id' => $d->kode_ok_id,
            'kode_ok' => $d->kodeOk ? [
                'id' => $d->kodeOk->id,
                'kode_ok' => $d->kodeOk->kode_ok,
                'uraian_kerja' => $d->kodeOk->uraian_kerja,
            ] : null,

            'no_hiradc' => $d->no_hiradc,
            'tanggal' => optional($d->tanggal)->format('Y-m-d'),
            'kesimpulan' => $d->kesimpulan,

            // ← BARU: info dokumen untuk preview
            'dokumen' => $d->dokumen,
            'dokumen_url' => $d->dokumen_url,
            'dokumen_nama' => $d->dokumen ? basename($d->dokumen) : null,
            'dokumen_ext' => $d->dokumen ? strtolower(pathinfo($d->dokumen, PATHINFO_EXTENSION)) : null,

            'apd_list' => $d->apdList->map(fn($a) => [
                'id' => $a->id,
                'kode_apd' => $a->kode_apd,
                'jenis_apd' => $a->jenis_apd,
            ])->values(),
            'apd_ids' => $d->apdList->pluck('id')->values(),

            'status' => $d->status,
            'diperiksa_nama' => $d->diperiksa_nama,
            'diperiksa_tanggal' => optional($d->diperiksa_tanggal)->format('Y-m-d'),
            'disahkan_nama' => $d->disahkan_nama,
            'disahkan_tanggal' => optional($d->disahkan_tanggal)->format('Y-m-d'),
        ];
    }

    private function validatedDocument(Request $request): array
    {
        return $request->validate([
            'kode_ok_id'  => 'required|exists:kode_oks,id',
            'departemen'  => 'nullable|string|max:200',
            'area_kerja'  => 'nullable|string|max:200',
            'sub_area'    => 'nullable|string|max:200',
            'kualifikasi' => 'nullable|string|max:200',
            'pekerjaan'   => 'nullable|string',
            'no_hiradc'   => 'nullable|string|max:50',
            'tanggal'     => 'nullable|date',
            'kesimpulan'  => 'nullable|string',
            'apd_ids'     => 'nullable|array',
            'apd_ids.*'   => 'exists:stok_apd,id',
            'dokumen'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // maks 10MB
        ]);
    }

    public function apdOptions()
    {
        try {
            $apd = StokAPD::orderBy('jenis_apd')->get(['id', 'kode_apd', 'jenis_apd']);
            return response()->json(['data' => $apd]);
        } catch (Throwable $e) {
            $this->logError('apdOptions', $e);
            return response()->json(['message' => 'Gagal memuat data APD.'], 500);
        }
    }

    private function logError(string $context, Throwable $e, ?Request $request = null, ?int $id = null): void
    {
        Log::error("Hiradc@{$context} gagal", array_filter([
            'id' => $id,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'input' => $request?->except(['_token', 'dokumen', 'disiapkan_ttd', 'diperiksa_ttd', 'disahkan_ttd']),
            'trace' => $e->getTraceAsString(),
        ], fn($v) => $v !== null));
    }

    private function logValidationError(string $context, ValidationException $e, Request $request, ?int $id = null): void
    {
        Log::error("Hiradc@{$context} gagal validasi", array_filter([
            'id' => $id,
            'errors' => $e->errors(),
            'input' => $request->except(['_token', 'dokumen', 'disiapkan_ttd', 'diperiksa_ttd', 'disahkan_ttd']),
        ], fn($v) => $v !== null));
    }

    public function kodeOkOptions()
    {
        try {
            $kodeOks = KodeOk::query()
                ->with(['unitKerjaRelasi', 'kualifikasiRelasi'])
                ->where('status', true)
                ->orderBy('kode_ok')
                ->get()
                ->map(fn(KodeOk $k) => $this->transformKodeOkOption($k))
                ->values();

            return response()->json(['data' => $kodeOks]);
        } catch (Throwable $e) {
            $this->logError('kodeOkOptions', $e);

            return response()->json(['message' => 'Gagal memuat data Kode OK.'], 500);
        }
    }

    private function transformKodeOkOption(KodeOk $k): array
    {
        return [
            'id' => $k->id,
            'kode_ok' => $k->kode_ok,
            'uraian_kerja' => $k->uraian_kerja,
            'pengawas' => $k->pengawas,

            // konsisten dengan pola KodeOkController: *_list buat tampilan, *_ids kalau perlu id-nya
            'unit_kerja_list' => $k->unitKerjaRelasi->pluck('nama')->values(),
            'unit_kerja_ids' => $k->unitKerjaRelasi->pluck('id')->values(),

            'kualifikasi_list' => $k->kualifikasiRelasi->pluck('nama')->values(),
            'kualifikasi_ids' => $k->kualifikasiRelasi->pluck('id')->values(),
        ];
    }
}
