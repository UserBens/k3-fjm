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
        if ($tahun = $request->get('tahun')) {
            $query->where('tahun', $tahun);
        }
        if ($kategori = $request->get('kategori')) {
            $query->where('kategori', $kategori);
        }
        if ($status = $request->get('status')) {
            // status dihitung di accessor, jadi difilter setelah query dasar
        }
        if ($request->filled('aktif')) {
            $query->where('aktif', $request->get('aktif') === '1');
        }

        $perPage = (int) $request->get('per_page', 10);
        $page = (int) $request->get('page', 1);

        $all = $query->orderBy('tahun', 'desc')->orderBy('no_urut')->get();

        // Filter by computed status (kalau diminta)
        if ($status) {
            $all = $all->filter(fn($row) => $row->status['label'] === $status)->values();
        }

        $total = $all->count();
        $items = $all->slice(($page - 1) * $perPage, $perPage)->values();

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
                'tahun' => LeadingInput::query()->distinct()->orderByDesc('tahun')->pluck('tahun'),
                'kategori' => LeadingInput::query()->distinct()->orderBy('kategori')->pluck('kategori'),
                'status' => ['TERCAPAI', 'SEBAGIAN', 'DI BAWAH', 'belum jatuh tempo'],
            ],
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
            'tipe_capaian' => ['required', Rule::in(['Persentase', 'Kumulatif Tahunan', 'Rata-rata Bulanan'])],
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
