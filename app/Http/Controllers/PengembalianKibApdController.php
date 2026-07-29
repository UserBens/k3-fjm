<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PengembalianKibApd;
use App\Models\StokAPD;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PengembalianKibApdController extends Controller
{
    public function index()
    {
        return view('pengembalian-kib-apd.index');
    }

    public function data(Request $request)
    {
        $query = PengembalianKibApd::query();

        $query->search($request->input('search'));

        if ($request->filled('status_fisik_kib')) {
            $query->where('status_fisik_kib', $request->input('status_fisik_kib'));
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->input('tanggal_dari'));
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->input('tanggal_sampai'));
        }

        $perPage = (int) $request->input('per_page', 10);

        $query->orderByDesc('tanggal')->orderByDesc('id');

        $paginated = $query->paginate($perPage)->withQueryString();

        $rows = $paginated->getCollection()->values()->map(function (PengembalianKibApd $row, $index) use ($paginated) {
            return $this->transform($row, $paginated->firstItem() + $index);
        });

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
                'status_fisik_kib' => PengembalianKibApd::STATUS_FISIK_KIB,
            ],
        ]);
    }

    // Picker karyawan — dipakai untuk field "Nomor Badge / Nama Lengkap".
    // Sama seperti cariPegawai() milik LogApdController.
    public function cariPegawai(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with(['unitKerja', 'subkon'])->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(function (Pegawai $p) {
            $unitLabel = trim(collect([
                $p->unitKerja->nama_unit_kerja ?? null,
                $p->unitKerja->bagian ?? null,
                $p->subkon->nama_subkon ?? null,
            ])->filter()->implode(' — '));

            return [
                'badge'      => $p->badge ?? '-',
                'nama'       => $p->nama ?? '-',
                'jabatan'    => $p->jabatan ?? '-',
                'unit_kerja' => $unitLabel ?: '-',
            ];
        });

        return response()->json(['data' => $results]);
    }

    // Dipakai untuk checklist "APD Dikembalikan" — list APD yang bisa dicari & discroll.
    public function apdOptions(): JsonResponse
    {
        $items = StokAPD::query()
            ->select('id', 'kode_apd', 'jenis_apd', 'merk_rekomendasi', 'ukuran_tersedia')
            ->orderBy('jenis_apd')
            ->get()
            ->map(fn(StokAPD $s) => [
                'id'                => $s->id,
                'kode_apd'          => $s->kode_apd,
                'jenis_apd'         => $s->jenis_apd,
                'merk_rekomendasi'  => $s->merk_rekomendasi,
                'ukuran_tersedia'   => $s->ukuran_tersedia,
            ]);

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
        $data['apd_dikembalikan'] = $this->decodeApdDikembalikan($request);
        $data['no_dokumen'] = PengembalianKibApd::generateNoDokumen();

        if ($request->hasFile('foto_kib')) {
            $data['foto_kib'] = $request->file('foto_kib')->store('pengembalian-kib', 'public');
        }

        if ($request->hasFile('foto_apd')) {
            $data['foto_apd'] = $request->file('foto_apd')->store('pengembalian-apd', 'public');
        }

        $row = PengembalianKibApd::create($data);

        return response()->json([
            'message' => "Pengembalian {$row->no_dokumen} berhasil disimpan.",
            'data'    => $this->transform($row, 1),
        ], 201);
    }

    public function update(Request $request, PengembalianKibApd $pengembalianKibApd)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data yang dimasukkan belum valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['apd_dikembalikan'] = $this->decodeApdDikembalikan($request);

        if ($request->hasFile('foto_kib')) {
            if ($pengembalianKibApd->foto_kib) {
                Storage::disk('public')->delete($pengembalianKibApd->foto_kib);
            }
            $data['foto_kib'] = $request->file('foto_kib')->store('pengembalian-kib', 'public');
        } else {
            unset($data['foto_kib']);
        }

        if ($request->hasFile('foto_apd')) {
            if ($pengembalianKibApd->foto_apd) {
                Storage::disk('public')->delete($pengembalianKibApd->foto_apd);
            }
            $data['foto_apd'] = $request->file('foto_apd')->store('pengembalian-apd', 'public');
        } else {
            unset($data['foto_apd']);
        }

        $pengembalianKibApd->update($data);

        return response()->json([
            'message' => "Pengembalian {$pengembalianKibApd->no_dokumen} berhasil diperbarui.",
            'data'    => $this->transform($pengembalianKibApd->fresh(), 1),
        ]);
    }

    public function destroy(PengembalianKibApd $pengembalianKibApd)
    {
        $noDokumen = $pengembalianKibApd->no_dokumen;

        if ($pengembalianKibApd->foto_kib) {
            Storage::disk('public')->delete($pengembalianKibApd->foto_kib);
        }
        if ($pengembalianKibApd->foto_apd) {
            Storage::disk('public')->delete($pengembalianKibApd->foto_apd);
        }

        $pengembalianKibApd->delete();

        return response()->json([
            'message' => "Pengembalian {$noDokumen} berhasil dihapus.",
        ]);
    }

    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'tanggal'                 => ['required', 'date'],
            'nomor_badge'             => ['required', 'string', 'max:50'],
            'nama_lengkap'            => ['required', 'string', 'max:150'],
            'jabatan'                 => ['nullable', 'string', 'max:150'],
            'unit_kerja'              => ['nullable', 'string', 'max:150'],
            'status_fisik_kib'        => ['required', 'string', Rule::in(PengembalianKibApd::STATUS_FISIK_KIB)],
            'nomor_kib_dikembalikan'  => ['nullable', 'string', 'max:100'],
            'foto_kib'                => ['nullable', 'image', 'max:5120'], // max 5MB
            'apd_dikembalikan'        => ['nullable', 'string'], // JSON string, didekode terpisah
            'foto_apd'                => ['nullable', 'image', 'max:5120'], // max 5MB
            'keterangan'              => ['nullable', 'string'],
        ]);
    }

    // Field "apd_dikembalikan" dikirim FE sebagai JSON string (lewat FormData) karena
    // isinya array multi-pilih [{id, kode_apd, jenis_apd, ukuran}]. Didekode & disaring
    // manual di sini supaya tidak lolos payload sembarangan.
    private function decodeApdDikembalikan(Request $request): array
    {
        $raw = $request->input('apd_dikembalikan');

        if (!$raw) {
            return [];
        }

        $decoded = json_decode($raw, true);

        if (!is_array($decoded)) {
            return [];
        }

        return collect($decoded)
            ->filter(fn($item) => is_array($item) && !empty($item['jenis_apd']))
            ->map(fn($item) => [
                'id'         => $item['id'] ?? null,
                'kode_apd'   => $item['kode_apd'] ?? null,
                'jenis_apd'  => $item['jenis_apd'],
                'ukuran'     => $item['ukuran'] ?? null,
            ])
            ->values()
            ->all();
    }

    private function transform(PengembalianKibApd $row, int $no): array
    {
        return [
            'id'                       => $row->id,
            'no'                       => $no,
            'no_dokumen'               => $row->no_dokumen,
            'tanggal'                  => optional($row->tanggal)->format('Y-m-d'),
            'nomor_badge'              => $row->nomor_badge,
            'nama_lengkap'             => $row->nama_lengkap,
            'jabatan'                  => $row->jabatan,
            'unit_kerja'               => $row->unit_kerja,
            'status_fisik_kib'         => $row->status_fisik_kib,
            'nomor_kib_dikembalikan'   => $row->nomor_kib_dikembalikan,
            'foto_kib'                 => $row->foto_kib,
            'foto_kib_url'             => $row->foto_kib ? Storage::disk('public')->url($row->foto_kib) : null,
            'apd_dikembalikan'         => $row->apd_dikembalikan ?? [],
            'foto_apd'                 => $row->foto_apd,
            'foto_apd_url'             => $row->foto_apd ? Storage::disk('public')->url($row->foto_apd) : null,
            'keterangan'               => $row->keterangan,
        ];
    }
}
