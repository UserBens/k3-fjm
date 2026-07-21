<?php

namespace App\Http\Controllers;

use App\Models\RencanaPelatihanK3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RencanaPelatihanK3Controller extends Controller
{
    public function index()
    {
        return view('rencana-pelatihan-k3.index');
    }

    public function data(Request $request)
    {
        $query = RencanaPelatihanK3::query();

        if ($search = $request->get('search')) {
            $query->where('topik_pelatihan', 'ilike', "%{$search}%");
        }

        if ($prioritas = $request->get('prioritas')) {
            $query->where('prioritas', $prioritas);
        }

        if ($tahun = $request->get('tahun')) {
            $query->where('tahun', $tahun);
        }

        // Filter: tampilkan hanya rencana yang punya jadwal (status apapun) di periode tsb
        if ($periode = $request->get('periode')) {
            if (in_array($periode, RencanaPelatihanK3::PERIODE, true)) {
                $query->whereNotNull("jadwal->{$periode}");
            }
        }

        $perPage = (int) $request->get('per_page', 10);
        $perPage = $perPage > 0 ? $perPage : 10;

        $paginator = $query->orderBy('id')->paginate($perPage)->appends($request->query());

        // Total anggaran mengikuti filter yang aktif (bukan cuma halaman berjalan)
        $totalAnggaran = (clone $query)->sum('anggaran_estimasi');

        return response()->json([
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
                'total_anggaran' => (float) $totalAnggaran,
            ],
            'filter_options' => [
                'tahun' => RencanaPelatihanK3::query()
                    ->select('tahun')
                    ->distinct()
                    ->orderByDesc('tahun')
                    ->pluck('tahun'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $item = RencanaPelatihanK3::create($validated);

        return response()->json([
            'message' => 'Rencana pelatihan berhasil disimpan.',
            'data' => $item,
        ]);
    }

    public function update(Request $request, RencanaPelatihanK3 $rencanaPelatihanK3)
    {
        $validated = $this->validateData($request);
        $rencanaPelatihanK3->update($validated);

        return response()->json([
            'message' => 'Rencana pelatihan berhasil diperbarui.',
            'data' => $rencanaPelatihanK3,
        ]);
    }

    public function destroy(RencanaPelatihanK3 $rencanaPelatihanK3)
    {
        $rencanaPelatihanK3->delete();

        return response()->json([
            'message' => 'Rencana pelatihan berhasil dihapus.',
        ]);
    }

    private function validateData(Request $request): array
    {
        $validated = Validator::make($request->all(), [
            'tahun' => 'required|integer|min:2000|max:2100',
            'topik_pelatihan' => 'required|string|max:255',
            'prioritas' => 'required|in:Tinggi,Sedang,Rendah',
            'peserta_estimasi' => 'nullable|string|max:100',
            'durasi_jam' => 'nullable|integer|min:0',
            'anggaran_estimasi' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ])->validate();

        // Normalisasi jadwal: hanya terima 9 key periode yang valid, sisanya null
        $jadwal = [];
        foreach (RencanaPelatihanK3::PERIODE as $p) {
            $val = $request->input("jadwal.$p");
            $jadwal[$p] = in_array($val, array_keys(RencanaPelatihanK3::STATUS_LABEL), true) ? $val : null;
        }
        $validated['jadwal'] = $jadwal;

        return $validated;
    }
}
