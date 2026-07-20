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

        $query->search($request->search);

        if ($request->filled('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        $perPage = $request->per_page ?? 10;

        $rows = $query
            ->orderBy('bulan')
            ->paginate($perPage);

        return response()->json([
            'data' => $rows->getCollection()->map(fn($x) => $this->transform($x)),
            'meta' => [
                'current_page' => $rows->currentPage(),
                'last_page' => $rows->lastPage(),
                'total' => $rows->total(),
                'from' => $rows->firstItem(),
                'to' => $rows->lastItem()
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data belum valid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $item = RencanaPelatihanK3::create(
            $validator->validated()
        );

        return response()->json([
            'message' => 'Data berhasil ditambahkan.',
            'data' => $this->transform($item)
        ]);
    }

    public function update(Request $request, RencanaPelatihanK3 $rencana)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $rencana->update(
            $validator->validated()
        );

        return response()->json([
            'message' => 'Berhasil diupdate',
            'data' => $this->transform($rencana)
        ]);
    }

    public function destroy(RencanaPelatihanK3 $rencana)
    {
        $rencana->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'topik' => 'required|string|max:200',
            'prioritas' => 'required|in:Tinggi,Sedang,Rendah',
            'peserta' => 'required|integer|min:1',
            'durasi' => 'required|integer|min:1',
            'anggaran' => 'required|numeric|min:0',
            'bulan' => 'required|integer|min:1|max:12',
            'status' => 'required|in:Dijadwalkan,Terlaksana,Tertunda',
            'keterangan' => 'nullable|string'
        ]);
    }

    private function transform(RencanaPelatihanK3 $item)
    {
        return [

            'id' => $item->id,

            'topik' => $item->topik,

            'prioritas' => $item->prioritas,

            'peserta' => $item->peserta,

            'durasi' => $item->durasi,

            'anggaran' => $item->anggaran,

            'bulan' => $item->bulan,

            'status' => $item->status,

            'keterangan' => $item->keterangan

        ];
    }
}
