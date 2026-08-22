<?php

namespace App\Http\Controllers;

use App\Models\LeadingInput;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadingInputController extends Controller
{
    /** Halaman manajemen (view) */
    public function index()
    {
        return view('leading-input.index');
    }

    /** GET /leading-input/api — list dengan search, filter, pagination */
    public function api(Request $request)
    {
        $query = LeadingInput::query();

        if ($search = $request->get('search')) {
            $query->where('nama_kegiatan', 'like', "%{$search}%");
        }

        // Default = tahun berjalan. User bisa pilih "Semua Tahun" (kirim tahun=semua atau kosong eksplisit)
        $tahunParam = $request->query('tahun', (string) now()->year);
        if ($tahunParam !== '' && strtolower($tahunParam) !== 'semua') {
            $query->where('tahun', $tahunParam);
        }

        if ($kategori = $request->get('kategori')) {
            $query->where('kategori', $kategori);
        }

        $status = $request->get('status');
        if ($request->filled('aktif')) {
            $query->where('aktif', $request->get('aktif') === '1');
        }

        $perPage = (int) $request->get('per_page', 25);
        $page = (int) $request->get('page', 1);

        $all = $query->orderBy('tahun', 'desc')->orderBy('no_urut')->get();

        if ($status) {
            $all = $all->filter(fn($row) => $row->status['label'] === $status)->values();
        }

        $total = $all->count();
        $items = $all->slice(($page - 1) * $perPage, $perPage)->values();

        $tahunOptions = LeadingInput::query()->distinct()->orderByDesc('tahun')->pluck('tahun');
        if (!$tahunOptions->contains(now()->year)) {
            $tahunOptions = $tahunOptions->push(now()->year)->sortDesc()->values();
        }

        return response()->json([
            'data' => $items,
            'meta' => [
                'current_page' => $page,
                'last_page' => max(1, (int) ceil($total / $perPage)),
                'total' => $total,
                'from' => $total ? (($page - 1) * $perPage) + 1 : 0,
                'to' => min($page * $perPage, $total),
            ],
            'filter_options' => [
                'tahun' => $tahunOptions,
                'kategori' => LeadingInput::query()->distinct()->orderBy('kategori')->pluck('kategori'),
                'status' => ['TERCAPAI', 'SEBAGIAN', 'DI BAWAH', 'belum jatuh tempo', 'belum ada data'],
            ],
            'tahun_berjalan' => now()->year,
        ]);
    }

    private function rules(): array
    {
        return [
            'tahun' => 'required|integer|min:2000|max:2100',
            'no_urut' => 'required|integer|min:1',
            'kategori' => 'required|string|max:100',
            'nama_kegiatan' => 'required|string|max:255',
            'satuan' => 'nullable|string|max:30',
            'target' => 'required|numeric|min:0',
            // tipe_capaian TIDAK divalidasi/diinput manual lagi — otomatis
            // diturunkan dari satuan lewat model event (booted()->saving).
            'aktif' => 'boolean',
            'bulan_mulai' => 'nullable|integer|min:1|max:12',
            'setiap_n_bulan' => 'nullable|integer|min:1|max:12',
            'bulan_01' => 'nullable|numeric',
            'bulan_02' => 'nullable|numeric',
            'bulan_03' => 'nullable|numeric',
            'bulan_04' => 'nullable|numeric',
            'bulan_05' => 'nullable|numeric',
            'bulan_06' => 'nullable|numeric',
            'bulan_07' => 'nullable|numeric',
            'bulan_08' => 'nullable|numeric',
            'bulan_09' => 'nullable|numeric',
            'bulan_10' => 'nullable|numeric',
            'bulan_11' => 'nullable|numeric',
            'bulan_12' => 'nullable|numeric',
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $item = LeadingInput::create($data);
        return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $item], 201);
    }

    public function update(Request $request, LeadingInput $leadingInput)
    {
        $data = $request->validate($this->rules());
        $leadingInput->update($data);
        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $leadingInput->fresh()]);
    }

    public function destroy(LeadingInput $leadingInput)
    {
        $leadingInput->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
