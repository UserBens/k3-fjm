<?php

namespace App\Http\Controllers;

use App\Models\Dcu;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class DcuController extends Controller
{
    public function index()
    {
        return view('dcu.index');
    }

    public function data(Request $request): JsonResponse
    {
        try {
            $query = Dcu::search($request->input('search'));

            if ($departemen = $request->input('departemen')) {
                $query->where('departemen', $departemen);
            }

            if ($result = $request->input('result')) {
                $query->where('result', $result);
            }

            if ($tglDari = $request->input('tanggal_dari')) {
                $query->whereDate('tanggal_periksa', '>=', $tglDari);
            }

            if ($tglSampai = $request->input('tanggal_sampai')) {
                $query->whereDate('tanggal_periksa', '<=', $tglSampai);
            }

            $perPage = (int) $request->input('per_page', 10);
            $perPage = ($perPage > 0 && $perPage <= 100) ? $perPage : 10;

            $paginator = $query->orderByDesc('tanggal_periksa')->paginate($perPage);

            return response()->json([
                'data' => collect($paginator->items())->map(fn(Dcu $d) => $this->transform($d)),
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => max($paginator->lastPage(), 1),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                ],
                'filter_options' => [
                    'departemen' => Dcu::whereNotNull('departemen')->distinct()->orderBy('departemen')->pluck('departemen'),
                    'result' => Dcu::whereNotNull('result')->distinct()->orderBy('result')->pluck('result'),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat data DCU: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil data DCU.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $dcu = Dcu::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => "Data DCU untuk {$dcu->nama} berhasil ditambahkan.",
                'data' => $this->transform($dcu),
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data DCU: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan data DCU.'], 500);
        }
    }

    public function update(Request $request, Dcu $dcu): JsonResponse
    {
        $validated = $this->validateData($request);

        try {
            $dcu->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => "Data DCU untuk {$dcu->nama} berhasil diperbarui.",
                'data' => $this->transform($dcu->fresh()),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data DCU: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memperbarui data DCU.'], 500);
        }
    }

    public function destroy(Dcu $dcu): JsonResponse
    {
        $nama = $dcu->nama;
        $dcu->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Data DCU untuk {$nama} berhasil dihapus.",
        ]);
    }

    // Cari pegawai untuk auto-fill form (badge, nama, departemen, dst)
    public function cariPegawai(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));
        $query = Pegawai::with('unitKerja')->where('is_active', true);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ilike', "%{$search}%")
                    ->orWhere('badge', 'ilike', "%{$search}%")
                    ->orWhere('no_ktp', 'ilike', "%{$search}%");
            });
        }

        $results = $query->orderBy('nama')->limit(20)->get()->map(function (Pegawai $p) {
            // Carbon::parse() aman dipanggil baik $p->tanggal_lahir itu sudah
            // Carbon instance (kalau modelnya sudah di-cast) MAUPUN masih string
            // mentah dari database — tidak akan error di kedua kasus.
            $tanggalLahir = $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir) : null;
            $usia = $tanggalLahir?->age;

            return [
                'badge' => $p->badge ?? '-',
                'nik' => $p->no_ktp ?? '-',
                'nama' => $p->nama ?? '-',
                'departemen' => $p->unitKerja->nama_unit_kerja ?? '-',
                'unit_kerja' => $p->unitKerja->bagian ?? '-',
                'jabatan' => $p->jabatan ?? '-',
                'tanggal_lahir' => $tanggalLahir?->format('Y-m-d'),
                'usia' => $usia,
            ];
        });

        return response()->json(['data' => $results]);
    }

    private function transform(Dcu $d): array
    {
        $tanggalLahir = $d->tanggal_lahir ? \Carbon\Carbon::parse($d->tanggal_lahir) : null;
        $tanggalPeriksa = $d->tanggal_periksa ? \Carbon\Carbon::parse($d->tanggal_periksa) : null;

        return [
            'id' => $d->id,
            'badge' => $d->badge,
            'grup' => $d->grup,
            'nik' => $d->nik,
            'nama' => $d->nama,
            'departemen' => $d->departemen,
            'unit_kerja' => $d->unit_kerja,
            'jabatan' => $d->jabatan,
            'tanggal_lahir' => $tanggalLahir?->format('Y-m-d'),
            'usia' => $d->usia,
            'tanggal_periksa' => $tanggalPeriksa?->format('Y-m-d'),

            'tensi_sistolik' => $d->tensi_sistolik,
            'tensi_distolik' => $d->tensi_distolik,
            'blood_pressure_judgement' => $d->blood_pressure_judgement,
            'blood_pressure_keterangan' => $d->blood_pressure_keterangan,
            'blood_pressure_rujukan' => $d->blood_pressure_rujukan,
            'blood_pressure_kelayakan' => $d->blood_pressure_kelayakan,

            'gda' => $d->gda,
            'blood_glucose_levels_judgement' => $d->blood_glucose_levels_judgement,
            'blood_glucose_levels_keterangan' => $d->blood_glucose_levels_keterangan,
            'blood_glucose_levels_rujukan' => $d->blood_glucose_levels_rujukan,
            'blood_glucose_levels_kelayakan' => $d->blood_glucose_levels_kelayakan,

            'spo2' => $d->spo2,
            'saturasi_oxygen_judgement' => $d->saturasi_oxygen_judgement,
            'saturasi_oxygen_keterangan' => $d->saturasi_oxygen_keterangan,
            'saturasi_oxygen_rujukan' => $d->saturasi_oxygen_rujukan,
            'saturasi_oxygen_kelayakan' => $d->saturasi_oxygen_kelayakan,

            'suhu' => $d->suhu,
            'temperature_judgement' => $d->temperature_judgement,
            'temperature_keterangan' => $d->temperature_keterangan,
            'temperature_rujukan' => $d->temperature_rujukan,
            'temperature_kelayakan' => $d->temperature_kelayakan,

            'nadi' => $d->nadi,
            'pulse_judgement' => $d->pulse_judgement,
            'pulse_keterangan' => $d->pulse_keterangan,
            'pulse_rujukan' => $d->pulse_rujukan,
            'pulse_kelayakan' => $d->pulse_kelayakan,

            'cholesterol' => $d->cholesterol,
            'cholesterol_judgement' => $d->cholesterol_judgement,
            'cholesterol_keterangan' => $d->cholesterol_keterangan,
            'cholesterol_rujukan' => $d->cholesterol_rujukan,
            'cholesterol_kelayakan' => $d->cholesterol_kelayakan,

            'asam_urat' => $d->asam_urat,
            'uric_acid_judgement' => $d->uric_acid_judgement,
            'uric_acid_keterangan' => $d->uric_acid_keterangan,
            'uric_acid_rujukan' => $d->uric_acid_rujukan,
            'uric_acid_kelayakan' => $d->uric_acid_kelayakan,

            'ket_17' => $d->ket_17,
            'rujukan_18' => $d->rujukan_18,
            'kelayakan_19' => $d->kelayakan_19,
            'na' => $d->na,

            'self_check' => $d->self_check,
            'consult_dr' => $d->consult_dr,
            'danger' => $d->danger,

            'result' => $d->result,
            'key_treatment' => $d->key_treatment,
            'rekomendasi_medis' => $d->rekomendasi_medis,
        ];
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'badge' => ['required', 'string', 'max:50'],
            'grup' => ['nullable', 'string', 'max:20'],
            'nik' => ['nullable', 'string', 'max:50'],
            'nama' => ['required', 'string', 'max:255'],
            'departemen' => ['nullable', 'string', 'max:255'],
            'unit_kerja' => ['nullable', 'string', 'max:255'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'usia' => ['nullable', 'integer', 'min:0', 'max:120'],
            'tanggal_periksa' => ['required', 'date'],

            'tensi_sistolik' => ['nullable', 'integer'],
            'tensi_distolik' => ['nullable', 'integer'],
            'blood_pressure_judgement' => ['nullable', 'string', 'max:100'],
            'blood_pressure_keterangan' => ['nullable', 'string', 'max:255'],
            'blood_pressure_rujukan' => ['nullable', 'string', 'max:255'],
            'blood_pressure_kelayakan' => ['nullable', 'string', 'max:100'],

            'gda' => ['nullable', 'numeric'],
            'blood_glucose_levels_judgement' => ['nullable', 'string', 'max:100'],
            'blood_glucose_levels_keterangan' => ['nullable', 'string', 'max:255'],
            'blood_glucose_levels_rujukan' => ['nullable', 'string', 'max:255'],
            'blood_glucose_levels_kelayakan' => ['nullable', 'string', 'max:100'],

            'spo2' => ['nullable', 'numeric'],
            'saturasi_oxygen_judgement' => ['nullable', 'string', 'max:100'],
            'saturasi_oxygen_keterangan' => ['nullable', 'string', 'max:255'],
            'saturasi_oxygen_rujukan' => ['nullable', 'string', 'max:255'],
            'saturasi_oxygen_kelayakan' => ['nullable', 'string', 'max:100'],

            'suhu' => ['nullable', 'numeric'],
            'temperature_judgement' => ['nullable', 'string', 'max:100'],
            'temperature_keterangan' => ['nullable', 'string', 'max:255'],
            'temperature_rujukan' => ['nullable', 'string', 'max:255'],
            'temperature_kelayakan' => ['nullable', 'string', 'max:100'],

            'nadi' => ['nullable', 'integer'],
            'pulse_judgement' => ['nullable', 'string', 'max:100'],
            'pulse_keterangan' => ['nullable', 'string', 'max:255'],
            'pulse_rujukan' => ['nullable', 'string', 'max:255'],
            'pulse_kelayakan' => ['nullable', 'string', 'max:100'],

            'cholesterol' => ['nullable', 'numeric'],
            'cholesterol_judgement' => ['nullable', 'string', 'max:100'],
            'cholesterol_keterangan' => ['nullable', 'string', 'max:255'],
            'cholesterol_rujukan' => ['nullable', 'string', 'max:255'],
            'cholesterol_kelayakan' => ['nullable', 'string', 'max:100'],

            'asam_urat' => ['nullable', 'numeric'],
            'uric_acid_judgement' => ['nullable', 'string', 'max:100'],
            'uric_acid_keterangan' => ['nullable', 'string', 'max:255'],
            'uric_acid_rujukan' => ['nullable', 'string', 'max:255'],
            'uric_acid_kelayakan' => ['nullable', 'string', 'max:100'],

            'ket_17' => ['nullable', 'string', 'max:255'],
            'rujukan_18' => ['nullable', 'string', 'max:255'],
            'kelayakan_19' => ['nullable', 'string', 'max:100'],
            'na' => ['nullable', 'integer'],

            'self_check' => ['nullable', 'boolean'],
            'consult_dr' => ['nullable', 'boolean'],
            'danger' => ['nullable', 'boolean'],

            'result' => ['nullable', 'string', 'max:100'],
            'key_treatment' => ['nullable', 'string'],
            'rekomendasi_medis' => ['nullable', 'string'],
        ]);
    }
}
