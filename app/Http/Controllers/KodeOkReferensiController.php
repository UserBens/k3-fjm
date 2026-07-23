<?php

namespace App\Http\Controllers;

use App\Models\Hiradc;
use App\Models\KodeOk;
use App\Models\KodeOkReferensi;
use App\Models\StokAPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KodeOkReferensiController extends Controller
{
    public function index()
    {
        return view('kode-ok-referensi.index');
    }

    public function data(Request $request)
    {
        $query = KodeOkReferensi::query()->with(['apdWajib:id,kode_apd,jenis_apd', 'apdKhusus:id,kode_apd,jenis_apd']);

        $query->search($request->input('search'));

        if ($request->filled('dept_unit_kerja_pic')) {
            $query->where('dept_unit_kerja_pic', $request->input('dept_unit_kerja_pic'));
        }

        if ($request->filled('kategori_pekerjaan')) {
            $query->where('kategori_pekerjaan', $request->input('kategori_pekerjaan'));
        }

        $perPage = (int) $request->input('per_page', 10);

        $paginated = $query->orderBy('kode_ok')->paginate($perPage)->withQueryString();

        // Hitung jumlah HIRADC per kode_ok dalam SATU query (hindari N+1)
        $hiradcCounts = Hiradc::query()
            ->whereNotNull('kode_ok')->where('kode_ok', '!=', '')
            ->selectRaw('kode_ok, count(*) as total')
            ->groupBy('kode_ok')
            ->pluck('total', 'kode_ok');

        $rows = $paginated->getCollection()->values()
            ->map(fn(KodeOkReferensi $k) => $this->transform($k, $hiradcCounts));

        if ($request->filled('status_pemetaan')) {
            $rows = $rows->filter(fn($r) => $r['status_pemetaan_apd']['key'] === $request->input('status_pemetaan'))->values();
        }

        return response()->json([
            'data' => $rows,
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page'    => $paginated->lastPage(),
                'total'        => $paginated->total(),
                'from'         => $paginated->firstItem() ?? 0,
                'to'           => $paginated->lastItem() ?? 0,
            ],
            'filter_options' => [
                'dept_unit_kerja_pic' => KodeOkReferensi::query()->whereNotNull('dept_unit_kerja_pic')
                    ->distinct()->orderBy('dept_unit_kerja_pic')->pluck('dept_unit_kerja_pic'),
                'kategori_pekerjaan' => KodeOkReferensi::query()->whereNotNull('kategori_pekerjaan')
                    ->distinct()->orderBy('kategori_pekerjaan')->pluck('kategori_pekerjaan'),
            ],
            'kpi' => [
                'total'            => KodeOkReferensi::count(),
                'didukung_hiradc'  => KodeOkReferensi::query()->whereIn('kode_ok', $hiradcCounts->keys())->count(),
                'belum_ada_hiradc' => KodeOkReferensi::query()->whereNotIn('kode_ok', $hiradcCounts->keys())->count(),
            ],
        ]);
    }

    public function kodeOkOptions()
    {
        $items = KodeOk::query()
            ->select('id', 'kode_ok', 'uraian_kerja', 'pengawas', 'status')
            ->with('unitKerjaRelasi:id,nama_unit_kerja') // sebelumnya 'unitKerjas'
            ->where('status', true)
            ->orderBy('kode_ok')
            ->get()
            ->map(fn($k) => [
                'id'           => $k->id,
                'kode_ok'      => $k->kode_ok,
                'unit_kerja'   => $k->unitKerjaRelasi->pluck('nama_unit_kerja')->join(', '), // sebelumnya $k->unitKerjas
                'uraian_kerja' => $k->uraian_kerja,
            ]);

        return response()->json(['data' => $items]);
    }

    // Dipakai checklist dropdown "APD Wajib" & "APD Khusus" di modal form
    public function apdOptions()
    {
        $items = StokAPD::query()->select('id', 'kode_apd', 'jenis_apd', 'kategori')->orderBy('jenis_apd')->get();
        return response()->json(['data' => $items]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $apdWajibIds = $data['apd_wajib_ids'] ?? [];
        $apdKhususIds = $data['apd_khusus_ids'] ?? [];
        unset($data['apd_wajib_ids'], $data['apd_khusus_ids']);

        $ref = KodeOkReferensi::create($data);
        $ref->apdWajib()->sync($apdWajibIds);
        $ref->apdKhusus()->sync($apdKhususIds);

        return response()->json([
            'message' => "Referensi Kode OK {$ref->kode_ok} berhasil disimpan.",
            'data'    => $this->transform($ref->fresh(['apdWajib', 'apdKhusus'])),
        ], 201);
    }

    public function update(Request $request, KodeOkReferensi $kodeOkReferensi)
    {
        $validator = $this->validator($request, $kodeOkReferensi->id);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $apdWajibIds = $data['apd_wajib_ids'] ?? [];
        $apdKhususIds = $data['apd_khusus_ids'] ?? [];
        unset($data['apd_wajib_ids'], $data['apd_khusus_ids']);

        $kodeOkReferensi->update($data);
        $kodeOkReferensi->apdWajib()->sync($apdWajibIds);
        $kodeOkReferensi->apdKhusus()->sync($apdKhususIds);

        return response()->json([
            'message' => "Referensi Kode OK {$kodeOkReferensi->kode_ok} berhasil diperbarui.",
            'data'    => $this->transform($kodeOkReferensi->fresh(['apdWajib', 'apdKhusus'])),
        ]);
    }

    public function destroy(KodeOkReferensi $kodeOkReferensi)
    {
        $kode = $kodeOkReferensi->kode_ok;
        $kodeOkReferensi->delete(); // pivot APD ikut terhapus (cascadeOnDelete)

        return response()->json([
            'message' => "Referensi Kode OK {$kode} berhasil dihapus.",
        ]);
    }

    private function validator(Request $request, ?int $ignoreId = null)
    {
        return Validator::make($request->all(), [
            'kode_ok' => [
                'required',
                'string',
                'max:50',
                Rule::unique('kode_ok_referensi', 'kode_ok')->ignore($ignoreId),
            ],
            'uraian_pekerjaan'     => ['required', 'string'],
            'dept_unit_kerja_pic'  => ['nullable', 'string', 'max:150'],
            'kategori_pekerjaan'   => ['nullable', 'string', 'max:150'],
            'apd_wajib_ids'        => ['nullable', 'array'],
            'apd_wajib_ids.*'      => ['integer', 'exists:stok_apd,id'],
            'apd_khusus_ids'       => ['nullable', 'array'],
            'apd_khusus_ids.*'     => ['integer', 'exists:stok_apd,id'],
        ]);
    }

    // $hiradcCounts opsional — kalau tidak dikirim (mis. dipakai di luar data()), hitung 1x query per baris.
    private function transform(KodeOkReferensi $ref, $hiradcCounts = null): array
    {
        $jumlahHiradc = $hiradcCounts !== null
            ? (int) ($hiradcCounts[$ref->kode_ok] ?? 0)
            : Hiradc::where('kode_ok', $ref->kode_ok)->count();

        $didukung = $jumlahHiradc > 0;

        return [
            'id'                   => $ref->id,
            'kode_ok'              => $ref->kode_ok,
            'uraian_pekerjaan'     => $ref->uraian_pekerjaan,
            'dept_unit_kerja_pic'  => $ref->dept_unit_kerja_pic,
            'kategori_pekerjaan'   => $ref->kategori_pekerjaan,
            'apd_wajib'            => $ref->apdWajib->map(fn($a) => [
                'id' => $a->id,
                'kode_apd' => $a->kode_apd,
                'jenis_apd' => $a->jenis_apd,
            ]),
            'apd_khusus'           => $ref->apdKhusus->map(fn($a) => [
                'id' => $a->id,
                'kode_apd' => $a->kode_apd,
                'jenis_apd' => $a->jenis_apd,
            ]),
            'hiradc_terkait'       => $jumlahHiradc,
            'status_pemetaan_apd'  => $didukung
                ? ['key' => 'DIDUKUNG', 'label' => 'Didukung HIRADC', 'icon' => '✅']
                : ['key' => 'BELUM', 'label' => 'APD Standar K3 (belum ada HIRADC)', 'icon' => '⚠️'],
        ];
    }
}
