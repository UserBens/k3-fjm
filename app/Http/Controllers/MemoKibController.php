<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\SafetyOfficerPegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Exports\MemoKibExport;

class MemoKibController extends Controller
{
    /**
     * Halaman manajemen Memo KIB (pilih SO, edit zonasi, pindah SO tenaga, lalu cetak).
     */
    public function index()
    {
        return view('memo-kib.index');
    }

    /**
     * Ringkasan per Safety Officer — untuk tabel atas pada memo & panel kiri halaman manajemen.
     */
    public function ringkasan(Request $request): JsonResponse
    {
        try {
            $query = Pegawai::where('is_active', true)->where('is_safety_officer', true);

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
                });
            }

            $safetyOfficers = $query->orderBy('nama')->get(['id', 'badge', 'nama']);

            $data = $safetyOfficers->map(fn(Pegawai $so) => $this->buildRingkasanSO($so))->values();

            return response()->json(['data' => $data]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat ringkasan memo KIB: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memuat ringkasan memo KIB.'], 500);
        }
    }

    /**
     * Detail tenaga binaan seorang SO (tabel bawah pada memo) beserta info KIB & zonasi.
     */
    public function detail(Request $request, string $badge): JsonResponse
    {
        try {
            $so = Pegawai::where('badge', $badge)->where('is_safety_officer', true)->firstOrFail();

            $pegawaiIds = SafetyOfficerPegawai::where('badge_safety_officer', $so->badge)->pluck('pegawai_id');

            $query = Pegawai::with('kualifikasi')->whereIn('id_api', $pegawaiIds);

            if ($search = trim((string) $request->query('search', ''))) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'ilike', "%{$search}%")->orWhere('badge', 'ilike', "%{$search}%");
                });
            }

            $rows = $query->orderBy('nama')->get();

            $transformed = $rows->values()->map(fn(Pegawai $p, int $idx) => $this->transformPegawaiRow($p, $so, $idx + 1));

            return response()->json([
                'safety_officer' => ['badge' => $so->badge, 'nama' => $so->nama],
                'data' => $transformed,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memuat detail memo KIB: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengambil detail memo KIB.'], 500);
        }
    }

    /**
     * Simpan zonasi manual untuk satu pegawai (Zona I, II, III, TUKS, dll — teks bebas).
     */
    public function updateZonasi(Request $request, string $idApi): JsonResponse
    {
        $validated = $request->validate(['zonasi' => 'nullable|string|max:100']);

        try {
            $pegawai = Pegawai::where('id_api', $idApi)->firstOrFail();
            $pegawai->zonasi = $validated['zonasi'] ?? null;
            $pegawai->save();

            return response()->json([
                'status' => 'success',
                'message' => "Zonasi {$pegawai->nama} berhasil disimpan.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan zonasi: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan zonasi.'], 500);
        }
    }

    /**
     * Menentukan / memindahkan tenaga ini dibina oleh Safety Officer siapa.
     * Satu tenaga hanya dibina satu SO — penugasan lama otomatis dihapus.
     */
    public function pindahSafetyOfficer(Request $request, string $idApi): JsonResponse
    {
        $validated = $request->validate(['badge_safety_officer' => 'required|string']);

        try {
            $pegawai = Pegawai::where('id_api', $idApi)->firstOrFail();
            $so = Pegawai::where('badge', $validated['badge_safety_officer'])
                ->where('is_safety_officer', true)->firstOrFail();

            SafetyOfficerPegawai::where('pegawai_id', $pegawai->id_api)->delete();

            SafetyOfficerPegawai::create([
                'badge_safety_officer' => $so->badge,
                'pegawai_id' => $pegawai->id_api,
                'assigned_by' => session('auth_user.username'),
                'assigned_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => "{$pegawai->nama} sekarang dibina oleh {$so->nama}.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal memindahkan safety officer tenaga: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memindahkan safety officer.'], 500);
        }
    }

    /**
     * List ringkas SO — dipakai dropdown "pindah SO" di halaman manajemen.
     */
    public function listSO(): JsonResponse
    {
        $data = Pegawai::where('is_active', true)->where('is_safety_officer', true)
            ->orderBy('nama')
            ->get(['badge', 'nama'])
            ->map(fn($p) => ['badge' => $p->badge, 'nama' => $p->nama]);

        return response()->json(['data' => $data]);
    }

    private function transformPegawaiRow(Pegawai $p, Pegawai $so, int $no): array
    {
        $statusKib = $p->status_kib_info;

        return [
            'no' => $no,
            'id_api' => $p->id_api,
            'nama' => $p->nama ?? '-',
            'ktp' => $p->no_ktp ?? '-',
            'jalan' => $p->alamat ?? '-',
            'rt_rw' => trim(($p->rt ?? '-') . '/' . ($p->rw ?? '-'), '/') ?: '-',
            'kelurahan' => $p->kelurahan ?? '-',
            'kecamatan' => $p->kecamatan ?? '-',
            // Catatan: belum ada relasi nama Kabupaten/Kota di skema — tampilkan nilai mentah
            // kotaid_kota. Sambungkan ke relasi Kota (mis. belongsTo) kalau tabelnya sudah ada.
            'kabupaten_kota' => $p->kotaid_kota ?? '-',
            'jabatan' => optional($p->kualifikasi)->nama_kualifikasi ?? '-',
            'zonasi' => $p->zonasi ?? '',
            'status_kib' => $statusKib['label'],
            'status_kib_key' => $statusKib['key'],
            'safety_officer' => $so->badge . '-' . $so->nama,
        ];
    }

    /**
     * Bangun baris ringkasan (tabel atas memo) untuk satu Safety Officer.
     */
    private function buildRingkasanSO(Pegawai $so): array
    {
        $pegawaiIds = SafetyOfficerPegawai::where('badge_safety_officer', $so->badge)->pluck('pegawai_id');

        $tenaga = Pegawai::whereIn('id_api', $pegawaiIds)
            ->get(['id_api', 'kode_ok', 'nomor_kib', 'masa_berlaku_kib']);

        $kodeOkList = $tenaga->pluck('kode_ok')->filter()->unique()
            ->sort(SORT_NATURAL)->values()->implode(', ');

        $counts = ['aktif' => 0, 'expired' => 0, 'hampir_habis' => 0, 'tidak_ditemukan' => 0];
        foreach ($tenaga as $p) {
            $counts[$p->status_kib_info['key']]++;
        }

        return [
            'badge' => $so->badge,
            'nama' => $so->nama,
            'safety_officer' => $so->badge . '-' . $so->nama,
            'kode_ok' => $kodeOkList ?: '-',
            'jumlah_tenaga' => $tenaga->count(),
            'kib_aktif' => $counts['aktif'],
            'kib_expired' => $counts['expired'],
            'kib_hampir_habis' => $counts['hampir_habis'],
            'kib_tidak_ditemukan' => $counts['tidak_ditemukan'],
        ];
    }

    public function cetak(Request $request, string $badge)
    {
        $so = Pegawai::where('badge', $badge)->where('is_safety_officer', true)->firstOrFail();
        $ringkasan = $this->buildRingkasanSO($so);

        $pegawaiIds = SafetyOfficerPegawai::where('badge_safety_officer', $so->badge)->pluck('pegawai_id');
        $tenaga = Pegawai::with('kualifikasi')->whereIn('id_api', $pegawaiIds)->orderBy('nama')->get();

        $rows = $tenaga->values()->map(fn(Pegawai $p, int $idx) => $this->transformPegawaiRow($p, $so, $idx + 1));

        $format = $request->query('format', 'pdf');

        if ($format === 'excel') {
            $spreadsheet = (new MemoKibExport())->build($so, $ringkasan, $rows);
            $filename = 'Memo-KIB-' . $so->badge . '-' . now()->format('Ymd-His') . '.xlsx';

            return response()->streamDownload(function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            }, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
        }

        // Default: PDF
        $pdf = Pdf::loadView('memo-kib.cetak', [
            'so' => $so,
            'ringkasan' => $ringkasan,
            'rows' => $rows,
        ])->setPaper('a4', 'landscape');

        $filename = 'Memo-KIB-' . $so->badge . '-' . now()->format('Ymd-His') . '.pdf';
        return $pdf->stream($filename);
    }
}
