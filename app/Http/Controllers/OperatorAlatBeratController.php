<?php

namespace App\Http\Controllers;

use App\Models\KodeOk;
use App\Models\OperatorAlatBerat;
use App\Models\LokasiKerja;
use App\Models\Kualifikasi;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OperatorAlatBeratController extends Controller
{
    public function index()
    {
        return view('operator-alat-berat.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = OperatorAlatBerat::query();

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")
                        ->orWhere('badge', 'ilike', "%{$search}%")
                        ->orWhere('kode_ok', 'ilike', "%{$search}%");
                });
            }

            if ($areaKerja = $request->query('area_kerja')) {
                $query->where('area_kerja', $areaKerja);
            }

            if ($status = $request->query('status_operator')) {
                $query->where('status_operator', $status);
            }

            $query->orderBy('nama');

            $filterOptions = [
                'area_kerja' => OperatorAlatBerat::select('area_kerja')
                    ->distinct()->pluck('area_kerja')->filter()->sort()->values(),
                'status_operator' => ['AKTIF', 'NONAKTIF'],
            ];

            $perPage = (int) $request->query('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->paginate($perPage);

            $transformedData = collect($paginator->items())->map(fn($item) => $this->transform($item));

            return response()->json([
                'data' => $transformedData,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page'    => max($paginator->lastPage(), 1),
                    'per_page'     => $paginator->perPage(),
                    'total'        => $paginator->total(),
                    'from'         => $paginator->firstItem(),
                    'to'           => $paginator->lastItem(),
                ],
                'filter_options' => $filterOptions,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data Operator Alat Berat: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data dari database lokal.'], 500);
        }
    }

    // Dropdown "Area Kerja" — dari master Lokasi Kerja.
    public function areaKerjaOptions(): JsonResponse
    {
        $items = LokasiKerja::query()
            ->select('nama_lokasi')->whereNotNull('nama_lokasi')->where('nama_lokasi', '!=', '')
            ->distinct()->orderBy('nama_lokasi')->pluck('nama_lokasi');

        return response()->json(['data' => $items]);
    }

    // Dropdown "Kualifikasi" — dari master Kualifikasi.
    public function kualifikasiOptions(): JsonResponse
    {
        $items = Kualifikasi::query()
            ->select('nama_kualifikasi')->whereNotNull('nama_kualifikasi')->where('nama_kualifikasi', '!=', '')
            ->where('is_active', true)->distinct()->orderBy('nama_kualifikasi')->pluck('nama_kualifikasi');

        return response()->json(['data' => $items]);
    }

    // Picker karyawan — dipakai untuk field "Badge / Nama" di form Operator Alat Berat.
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

    // Picker "Kode OK" — datanya dari master KodeOk yang sama dengan modul Stok APD.
    public function kodeOkOptions(): JsonResponse
    {
        $items = KodeOk::query()
            ->select('id', 'kode_ok', 'uraian_kerja')
            ->where('status', true)
            ->orderBy('kode_ok')
            ->get();

        return response()->json(['data' => $items]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data yang dimasukkan belum valid.', 'errors' => $validator->errors()], 422);
        }

        try {
            $operator = OperatorAlatBerat::create($validator->validated());

            return response()->json([
                'message' => 'Data operator alat berat berhasil disimpan.',
                'data'    => $this->transform($operator->fresh()),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data Operator Alat Berat: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan sistem saat menyimpan data.'], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $operator = OperatorAlatBerat::findOrFail($id);

        $validator = $this->validator($request, $id);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data yang dimasukkan belum valid.', 'errors' => $validator->errors()], 422);
        }

        try {
            $operator->update($validator->validated());

            return response()->json([
                'message' => 'Data operator alat berat berhasil diperbarui.',
                'data'    => $this->transform($operator->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Operator Alat Berat: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan sistem saat memperbarui data.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $operator = OperatorAlatBerat::findOrFail($id);
            $operator->delete();

            return response()->json(['message' => 'Data operator alat berat berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data Operator Alat Berat: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan sistem saat menghapus data.'], 500);
        }
    }

    private function validator(Request $request, $ignoreId = null)
    {
        return Validator::make($request->all(), [
            'badge' => ['required', 'string', 'max:50', 'unique:operator_alat_berat,badge' . ($ignoreId ? ",{$ignoreId}" : '')],
            'nama'  => ['required', 'string', 'max:255'],
            'area_kerja'       => ['required', 'string', 'max:255'],
            'kualifikasi'      => ['required', 'string', 'max:255'],
            'jenis_unit_utama' => ['required', 'string', 'max:255'],
            'bagian'           => ['nullable', 'string', 'max:255'],
            'titik_absensi'    => ['nullable', 'string', 'max:255'],
            'pemasok'          => ['nullable', 'string', 'max:255'],
            'grup'             => ['nullable', 'string', 'max:10'],
            'kode_ok'          => ['nullable', 'string', 'max:50'],
            'status_operator'  => ['required', 'in:AKTIF,NONAKTIF'],

            'nomor_kib'          => ['nullable', 'string', 'max:255'],
            'masa_berlaku_kib'   => ['nullable', 'date'],

            'nomor_sio_1'          => ['nullable', 'string', 'max:255'],
            'jenis_sio_1'          => ['nullable', 'string', 'max:255'],
            'masa_berlaku_sio_1'   => ['nullable', 'date'],

            'nomor_sio_2'          => ['nullable', 'string', 'max:255'],
            'jenis_sio_2'          => ['nullable', 'string', 'max:255'],
            'masa_berlaku_sio_2'   => ['nullable', 'date'],

            'tanggal_lahir' => ['nullable', 'date'],
            'keterangan'    => ['nullable', 'string'],
        ]);
    }

    // Menghitung status expired berdasarkan tanggal, dengan ambang "SEGERA EXPIRED" 60 hari.
    private function statusExpired(?Carbon $tanggal): string
    {
        if (!$tanggal) return '-';
        $now = Carbon::now();
        if ($tanggal->isPast()) return 'EXPIRED';
        if ($now->diffInDays($tanggal, false) <= 60) return 'SEGERA EXPIRED';
        return 'AKTIF';
    }

    private function transform(OperatorAlatBerat $item): array
    {
        $tglLahir = $item->tanggal_lahir;
        $umur = $tglLahir ? Carbon::now()->diffInYears($tglLahir) : null;
        $tglPensiun = $tglLahir ? $tglLahir->copy()->addYears(56) : null;

        $statusPensiun = '-';
        if ($tglPensiun) {
            if ($tglPensiun->isPast()) {
                $statusPensiun = 'PENSIUN';
            } elseif (Carbon::now()->diffInYears($tglPensiun, false) < 2) {
                $statusPensiun = 'PENSIUN <2 THN';
            } else {
                $statusPensiun = 'AKTIF';
            }
        }

        $statusKib  = $this->statusExpired($item->masa_berlaku_kib);
        $statusSio1 = $this->statusExpired($item->masa_berlaku_sio_1);
        $statusSio2 = $this->statusExpired($item->masa_berlaku_sio_2);

        $jumlahSio = collect([$item->nomor_sio_1, $item->nomor_sio_2])->filter()->count();

        // SIO terdekat expired, dari 2 SIO yang ada tanggalnya.
        $sioDates = collect([$item->masa_berlaku_sio_1, $item->masa_berlaku_sio_2])->filter();
        $sioTerdekat = $sioDates->sort()->first();

        $statusMonitoring = 'AMAN';
        if (in_array('EXPIRED', [$statusSio1, $statusSio2])) {
            $statusMonitoring = 'EXPIRED';
        } elseif (in_array('SEGERA EXPIRED', [$statusSio1, $statusSio2])) {
            $statusMonitoring = 'SEGERA EXPIRED';
        }

        return [
            'id'                => $item->id,
            'badge'             => $item->badge,
            'nama'              => $item->nama,
            'area_kerja'        => $item->area_kerja,
            'kualifikasi'       => $item->kualifikasi,
            'jenis_unit_utama'  => $item->jenis_unit_utama,
            'bagian'            => $item->bagian,
            'titik_absensi'     => $item->titik_absensi,
            'pemasok'           => $item->pemasok,
            'grup'              => $item->grup,
            'kode_ok'           => $item->kode_ok,
            'status_operator'   => $item->status_operator,

            'nomor_kib'         => $item->nomor_kib,
            'masa_berlaku_kib'  => optional($item->masa_berlaku_kib)->format('Y-m-d'),
            'status_kib'        => $statusKib,

            'nomor_sio_1'         => $item->nomor_sio_1,
            'jenis_sio_1'         => $item->jenis_sio_1,
            'masa_berlaku_sio_1'  => optional($item->masa_berlaku_sio_1)->format('Y-m-d'),
            'status_sio_1'        => $statusSio1,

            'nomor_sio_2'         => $item->nomor_sio_2,
            'jenis_sio_2'         => $item->jenis_sio_2,
            'masa_berlaku_sio_2'  => optional($item->masa_berlaku_sio_2)->format('Y-m-d'),
            'status_sio_2'        => $statusSio2,

            'jumlah_sio'              => $jumlahSio,
            'status_monitoring_multi' => $statusMonitoring,
            'sio_terdekat_expired'    => $sioTerdekat ? $sioTerdekat->format('Y-m-d') : null,

            'tanggal_lahir'       => optional($tglLahir)->format('Y-m-d'),
            'umur'                => $umur,
            'tanggal_pensiun'     => $tglPensiun ? $tglPensiun->format('Y-m-d') : null,
            'status_pensiun'      => $statusPensiun,

            'keterangan' => $item->keterangan,
        ];
    }
}
