<?php

namespace App\Http\Controllers;

use App\Models\Hiradc;
use App\Models\HiradcDocument;
use App\Models\HiradcGroup;
use App\Models\HiradcItem;
use App\Models\KodeOk;
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
            $documents = HiradcDocument::with([
                'kodeOk.unitKerjaRelasi',
                'kodeOk.kualifikasiRelasi',
                'groups.children.children.items.hazards',
                'groups.items.hazards',
                'groups.children.items.hazards',
            ])->orderByDesc('id')->get();

            return response()->json(['data' => $documents->map(fn($d) => $this->transformDocument($d))]);
        } catch (Throwable $e) {
            $this->logError('data', $e);

            return response()->json(['message' => 'Gagal memuat data HIRADC.'], 500);
        }
    }

    public function show(HiradcDocument $hiradc)
    {
        try {
            $documents = HiradcDocument::with([
                'kodeOk.unitKerjaRelasi',
                'kodeOk.kualifikasiRelasi',
                'groups.children.children.items.hazards',
                'groups.items.hazards',
                'groups.children.items.hazards',
            ])->orderByDesc('id')->get();

            return response()->json(['data' => $this->transformDocument($hiradc)]);
        } catch (Throwable $e) {
            $this->logError('show', $e, null, $hiradc->id);

            return response()->json(['message' => 'Gagal memuat detail HIRADC.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validatedDocument($request);
            $validated = $this->handleUploads($request, $validated);

            $document = DB::transaction(function () use ($validated, $request) {
                $document = HiradcDocument::create($validated);
                $this->syncGroups($document, $request->input('groups', []));

                return $document;
            });

            $document->load(['groups.children.children.items.hazards', 'groups.items.hazards', 'groups.children.items.hazards']);

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

    public function update(Request $request, HiradcDocument $hiradc)
    {
        try {
            $validated = $this->validatedDocument($request);
            $validated = $this->handleUploads($request, $validated, $hiradc);

            DB::transaction(function () use ($hiradc, $validated, $request) {
                $hiradc->update($validated);

                // Cara paling aman untuk struktur bersarang: hapus & buat ulang groups/items/hazards.
                $hiradc->allGroups()->delete(); // cascade ke items & hazards via FK cascadeOnDelete
                $this->syncGroups($hiradc, $request->input('groups', []));
            });

            $hiradc->load(['groups.children.children.items.hazards', 'groups.items.hazards', 'groups.children.items.hazards']);

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

    public function destroy(HiradcDocument $hiradc)
    {
        try {
            foreach (['dokumen', 'disiapkan_ttd', 'diperiksa_ttd', 'disahkan_ttd'] as $field) {
                if ($hiradc->{$field}) {
                    Storage::disk('public')->delete($hiradc->{$field});
                }
            }
            $hiradc->delete(); // cascade ke groups/items/hazards

            return response()->json(['message' => 'Data HIRADC berhasil dihapus.']);
        } catch (Throwable $e) {
            $this->logError('destroy', $e, null, $hiradc->id);

            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data.'], 500);
        }
    }

    /**
     * Simpan groups secara rekursif (mendukung sub-group berjenjang seperti
     * "Cleaning GBB A" > "Cleaning Koridor Gudang A").
     */
    private function syncGroups(HiradcDocument $document, array $groups, ?int $parentId = null): void
    {
        foreach ($groups as $gIndex => $groupData) {
            $group = HiradcGroup::create([
                'hiradc_document_id' => $document->id,
                'parent_id' => $parentId,
                'nama' => $groupData['nama'] ?? '',
                'urutan' => $gIndex,
            ]);

            foreach (($groupData['items'] ?? []) as $iIndex => $itemData) {
                $item = HiradcItem::create([
                    'hiradc_group_id' => $group->id,
                    'no' => $itemData['no'] ?? null,
                    'aktivitas' => $itemData['aktivitas'] ?? '',
                    'kesimpulan_apd' => $itemData['kesimpulan_apd'] ?? null,
                    'urutan' => $iIndex,
                ]);

                foreach (($itemData['hazards'] ?? []) as $hIndex => $hazardData) {
                    $item->hazards()->create([
                        'hazard_register' => $hazardData['hazard_register'] ?? null,
                        'sub_hazard_register' => $hazardData['sub_hazard_register'] ?? null,
                        'na_e' => $hazardData['na_e'] ?? null,
                        'deskripsi' => $hazardData['deskripsi'] ?? null,
                        'dampak_kategori' => $hazardData['dampak_kategori'] ?? null,
                        'detail' => $hazardData['detail'] ?? null,
                        'l_awal' => $hazardData['l_awal'] ?? null,
                        'c_awal' => $hazardData['c_awal'] ?? null,
                        'pengendalian_existing' => $hazardData['pengendalian_existing'] ?? null,
                        'l_sisa' => $hazardData['l_sisa'] ?? null,
                        'c_sisa' => $hazardData['c_sisa'] ?? null,
                        'r_o' => $hazardData['r_o'] ?? null,
                        'additional_control' => $hazardData['additional_control'] ?? null,
                        'pic' => $hazardData['pic'] ?? null,
                        'due_date' => $hazardData['due_date'] ?? null,
                        'urutan' => $hIndex,
                    ]);
                }
            }

            if (!empty($groupData['children'])) {
                $this->syncGroups($document, $groupData['children'], $group->id);
            }
        }
    }

    public function periksa(Request $request, $id)
    {
        // Ambil data user dari session yang Anda buat di LoginController
        $authUser = session('auth_user');

        if (!$authUser) {
            return response()->json(['message' => 'Anda harus login terlebih dahulu.'], 401);
        }

        $hiradc = HiradcDocument::find($id);

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

        $hiradc = HiradcDocument::find($id);

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
    private function transformDocument(HiradcDocument $d): array
    {
        return [
            'id' => $d->id,
            'departemen' => $d->departemen,
            'bagian' => $d->bagian,
            'pekerjaan' => $d->pekerjaan,
            'kode_ok_id' => $d->kode_ok_id, // ← baru
            'kode_ok' => $d->kodeOk ? [
                'id' => $d->kodeOk->id,
                'kode_ok' => $d->kodeOk->kode_ok,
                'uraian_kerja' => $d->kodeOk->uraian_kerja,
                'pengawas' => $d->kodeOk->pengawas,
                'unit_kerja' => $d->kodeOk->unitKerjaRelasi->pluck('nama')->values(),
                'kualifikasi' => $d->kodeOk->kualifikasiRelasi->pluck('nama')->values(),
            ] : null, // ← baru

            'no_hiradc' => $d->no_hiradc,
            'revisi' => $d->revisi,
            'tanggal' => optional($d->tanggal)->format('Y-m-d'),

            'disiapkan_nama' => $d->disiapkan_nama,
            'disiapkan_tanggal' => optional($d->disiapkan_tanggal)->format('Y-m-d'),
            'disiapkan_ttd_url' => $d->disiapkan_ttd_url,

            'diperiksa_nama' => $d->diperiksa_nama,
            'diperiksa_tanggal' => optional($d->diperiksa_tanggal)->format('Y-m-d'),
            'diperiksa_ttd_url' => $d->diperiksa_ttd_url,

            'disahkan_nama' => $d->disahkan_nama,
            'disahkan_tanggal' => optional($d->disahkan_tanggal)->format('Y-m-d'),
            'disahkan_ttd_url' => $d->disahkan_ttd_url,

            'status' => $d->status,
            'diperiksa_badge' => $d->diperiksa_badge,
            'disahkan_badge' => $d->disahkan_badge,

            'dokumen_url' => $d->dokumen_url,
            'dokumen_hiradc' => $d->dokumen_hiradc,
            'groups' => $d->groups->map(fn($g) => $this->transformGroup($g)),
        ];
    }

    private function transformGroup(HiradcGroup $g): array
    {
        return [
            'id' => $g->id,
            'nama' => $g->nama,
            'items' => $g->items->map(fn($item) => [
                'id' => $item->id,
                'no' => $item->no,
                'aktivitas' => $item->aktivitas,
                'kesimpulan_apd' => $item->kesimpulan_apd,
                'hazards' => $item->hazards->map(fn($h) => [
                    'id' => $h->id,
                    'hazard_register' => $h->hazard_register,
                    'sub_hazard_register' => $h->sub_hazard_register,
                    'na_e' => $h->na_e,
                    'deskripsi' => $h->deskripsi,
                    'dampak_kategori' => $h->dampak_kategori,
                    'detail' => $h->detail,
                    'l_awal' => $h->l_awal,
                    'c_awal' => $h->c_awal,
                    'risiko_awal' => $h->risiko_awal,
                    'pengendalian_existing' => $h->pengendalian_existing,
                    'l_sisa' => $h->l_sisa,
                    'c_sisa' => $h->c_sisa,
                    'risiko_sisa' => $h->risiko_sisa,
                    'r_o' => $h->r_o,
                    'additional_control' => $h->additional_control,
                    'pic' => $h->pic,
                    'due_date' => optional($h->due_date)->format('Y-m-d'),
                ]),
            ]),
            'children' => $g->children->map(fn($child) => $this->transformGroup($child)),
        ];
    }

    private function validatedDocument(Request $request): array
    {
        return $request->validate([
            'departemen' => 'required|string|max:200',
            'bagian' => 'required|string|max:200',
            'pekerjaan' => 'required|string|max:200',
            'kode_ok_id' => 'nullable|exists:kode_oks,id',
            'no_hiradc' => 'nullable|string|max:50',
            'revisi' => 'nullable|string|max:50',
            'tanggal' => 'nullable|date',

            'disiapkan_nama' => 'nullable|string|max:100',
            'disiapkan_tanggal' => 'nullable|date',
            'disiapkan_ttd' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'diperiksa_nama' => 'nullable|string|max:100',
            'diperiksa_tanggal' => 'nullable|date',
            'diperiksa_ttd' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'disahkan_nama' => 'nullable|string|max:100',
            'disahkan_tanggal' => 'nullable|date',
            'disahkan_ttd' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'dokumen' => 'nullable|file|mimes:pdf|max:10240',

            // struktur bersarang groups[]
            'groups' => 'nullable|array',
            'groups.*.nama' => 'required_with:groups|string|max:200',
            'groups.*.items' => 'nullable|array',
            'groups.*.items.*.aktivitas' => 'required_with:groups.*.items|string',
            'groups.*.items.*.no' => 'nullable|integer',
            'groups.*.items.*.kesimpulan_apd' => 'nullable|string',
            'groups.*.items.*.hazards' => 'nullable|array',
            'groups.*.items.*.hazards.*.l_awal' => 'nullable|integer|min:1|max:5',
            'groups.*.items.*.hazards.*.c_awal' => 'nullable|integer|min:1|max:5',
            'groups.*.items.*.hazards.*.l_sisa' => 'nullable|integer|min:1|max:5',
            'groups.*.items.*.hazards.*.c_sisa' => 'nullable|integer|min:1|max:5',
            'groups.*.items.*.hazards.*.na_e' => 'nullable|in:N,A,E',
            'groups.*.items.*.hazards.*.dampak_kategori' => 'nullable|in:Manusia,Aset,Lingkungan',
            'groups.*.items.*.hazards.*.r_o' => 'nullable|in:R,O',
            'groups.*.items.*.hazards.*.due_date' => 'nullable|date',
            'groups.*.children' => 'nullable|array', // sub-group berjenjang, divalidasi longgar
        ]);
    }

    /**
     * Tangani upload dokumen PDF (opsional) + 3 gambar tanda tangan
     * (disiapkan_ttd, diperiksa_ttd, disahkan_ttd), masing-masing independen.
     */
    private function handleUploads(Request $request, array $validated, ?HiradcDocument $hiradc = null): array
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

        foreach (['disiapkan_ttd', 'diperiksa_ttd', 'disahkan_ttd'] as $field) {
            if ($request->hasFile($field)) {
                if ($hiradc && $hiradc->{$field}) {
                    Storage::disk('public')->delete($hiradc->{$field});
                }
                $validated[$field] = $request->file($field)->store('hiradc-ttd', 'public');
            } else {
                unset($validated[$field]);
            }
        }

        // groups bukan kolom di tabel hiradc_documents, jangan ikut mass-assign
        unset($validated['groups']);

        return $validated;
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
            $kodeOks = KodeOk::with(['unitKerjaRelasi', 'kualifikasiRelasi'])
                ->where('status', true)
                ->orderBy('kode_ok')
                ->get()
                ->map(fn($k) => [
                    'id' => $k->id,
                    'kode_ok' => $k->kode_ok,
                    'uraian_kerja' => $k->uraian_kerja,
                    'pengawas' => $k->pengawas,
                    'unit_kerja' => $k->unitKerjaRelasi->pluck('nama'),
                    'kualifikasi' => $k->kualifikasiRelasi->pluck('nama'),
                ]);

            return response()->json(['data' => $kodeOks]);
        } catch (Throwable $e) {
            $this->logError('kodeOkOptions', $e);

            return response()->json(['message' => 'Gagal memuat data Kode OK.'], 500);
        }
    }
}
