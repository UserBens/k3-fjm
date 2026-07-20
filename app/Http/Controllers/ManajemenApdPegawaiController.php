<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use App\Models\LokasiKerja;
use App\Models\Subkon;
use App\Models\MatriksApdJabatan;
use App\Models\Hiradc;
use App\Models\SafetyOfficerPegawai;
use Illuminate\Http\Request;

class ManajemenApdPegawaiController extends Controller
{
    /**
     * Halaman utama.
     */
    public function index()
    {
        return view('pemetaan-apd.index');
    }
    /**
     * Endpoint data (JSON) dengan filter, search, dan pagination.
     */
    public function data(Request $request)
    {
        $search        = trim((string) $request->get('search', ''));
        $unitKerja     = $request->get('unit_kerja', '');
        $statusHiradc  = $request->get('status_hiradc', '');
        $statusSo      = $request->get('status_so', '');   // 'so' | 'binaan'
        $statusKib     = $request->get('status_kib', '');
        $perPage       = (int) $request->get('per_page', 10);
        $page          = (int) $request->get('page', 1);
        // ── Query dasar pegawai aktif ──
        $query = Pegawai::query()->where('is_active', true);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('badge', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('kode_ok', 'like', "%{$search}%");
            });
        }
        if ($unitKerja !== '') {
            $query->where('unit_kerjaid', $unitKerja);
        }
        // Filter Safety Officer
        if ($statusSo === 'so') {
            $query->where('is_safety_officer', true);
        } elseif ($statusSo === 'binaan') {
            $query->where('is_safety_officer', false);
        }
        if ($statusKib !== '') {
            $query->where('status_kib', $statusKib);
        }
        // ── Pre-load lookup maps (hindari N+1) ──
        $unitMap    = UnitKerja::pluck('nama_unit_kerja', 'id_api');
        $lokasiMap  = LokasiKerja::pluck('nama_lokasi', 'id_api');
        $subkonMap  = Subkon::pluck('nama_subkon', 'id_api');
        // Map matriks APD per kode_ok (uraian pekerjaan + APD wajib/khusus)
        $matriksMap = MatriksApdJabatan::get()->keyBy('kode_ok');
        // Set kode_ok yang punya HIRADC
        $hiradcKodeOk = Hiradc::whereNotNull('kode_ok')->pluck('kode_ok')->unique()->flip();
        // Map Safety Officer → nama pembina (badge SO → nama)
        // Relasi: safety_officer_pegawais.pegawai_id (id_api binaan) → badge_safety_officer
        $soRelasi = SafetyOfficerPegawai::get()->keyBy('pegawai_id'); // key = id_api binaan
        $soBadgeToNama = Pegawai::where('is_safety_officer', true)
            ->pluck('nama', 'badge');
        // ── Ambil hasil sebelum filter HIRADC (karena HIRADC dihitung dari matriks) ──
        $allRows = $query->orderBy('nama')->get()->map(function (Pegawai $p) use (
            $unitMap,
            $lokasiMap,
            $subkonMap,
            $matriksMap,
            $hiradcKodeOk,
            $soRelasi,
            $soBadgeToNama
        ) {
            $matriks = $matriksMap->get($p->kode_ok);
            // APD Wajib & Khusus dari matriks
            [$apdWajib, $apdKhusus] = $this->extractApdFromMatriks($matriks);
            // Status HIRADC
            $statusHiradc = ($p->kode_ok && $hiradcKodeOk->has($p->kode_ok))
                ? 'Didukung HIRADC'
                : 'Belum Ada HIRADC';
            // Safety Officer (otomatis dari relasi)
            $safetyOfficer = null;
            if ($p->is_safety_officer) {
                $safetyOfficer = 'DIRINYA SENDIRI (SO)';
            } else {
                $rel = $soRelasi->get($p->id_api);
                if ($rel) {
                    $namaSo = $soBadgeToNama->get($rel->badge_safety_officer);
                    $safetyOfficer = $namaSo
                        ? "{$rel->badge_safety_officer} - {$namaSo}"
                        : $rel->badge_safety_officer;
                }
            }
            // Sisa KIB (hari)
            $sisaKib = null;
            if ($p->masa_berlaku_kib) {
                $sisaKib = now()->startOfDay()->diffInDays(
                    \Carbon\Carbon::parse($p->masa_berlaku_kib)->startOfDay(),
                    false
                );
            }
            return [
                'id'              => $p->id,
                'id_api'          => $p->id_api,
                'id_karyawan'     => $p->badge,
                'nama'            => $p->nama,
                'jabatan'         => $p->jabatan ?? '-',
                'departemen'      => $subkonMap->get($p->perusahaan_subkonid)
                    ?? 'PT. FOKUS JASA MITRA',
                'unit_kerja'      => $unitMap->get($p->unit_kerjaid) ?? '-',
                'area_kerja'      => $lokasiMap->get($p->lokasi_kerjaid) ?? '-',
                'kode_ok'         => $p->kode_ok ?? '-',
                'uraian_pekerjaan' => $matriks->nama_pekerjaan ?? '-',
                'kategori_pekerjaan' => $matriks->jabatan_posisi ?? '-',
                'status'          => $p->is_active ? 'AKTIF' : 'NON-AKTIF',
                'sisa_kib'        => $sisaKib,
                'status_kib'      => $p->status_kib ?? 'TIDAK DITEMUKAN',
                'is_safety_officer' => (bool) $p->is_safety_officer,
                'safety_officer'  => $safetyOfficer ?? 'BELUM DIBINA',
                'apd_wajib'       => $apdWajib,
                'apd_khusus'      => $apdKhusus,
                'status_hiradc'   => $statusHiradc,
                'has_matriks'     => (bool) $matriks,
                'matriks_id'      => $matriks->id ?? null,
            ];
        });
        // ── Filter status HIRADC (post-processing) ──
        if ($statusHiradc !== '') {
            $allRows = $allRows->filter(fn($r) => $r['status_hiradc'] === $statusHiradc)->values();
        }
        // ── Pagination manual ──
        $total   = $allRows->count();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page    = min($page, $lastPage);
        $offset  = ($page - 1) * $perPage;
        $items   = $allRows->slice($offset, $perPage)->values();
        return response()->json([
            'data' => $items,
            'meta' => [
                'current_page' => $page,
                'last_page'    => $lastPage,
                'per_page'     => $perPage,
                'total'        => $total,
                'from'         => $total > 0 ? $offset + 1 : 0,
                'to'           => min($offset + $perPage, $total),
            ],
            'filter_options' => [
                'unit_kerja'    => UnitKerja::orderBy('nama_unit_kerja')
                    ->get(['id_api', 'nama_unit_kerja'])
                    ->map(fn($u) => [
                        'value' => $u->id_api,
                        'label' => $u->nama_unit_kerja,
                    ]),
                'status_hiradc' => ['Didukung HIRADC', 'Belum Ada HIRADC'],
                'status_kib'    => ['AKTIF', 'TIDAK DITEMUKAN', 'KADALUARSA'],
            ],
        ]);
    }
    /**
     * Detail satu tenaga (termasuk breakdown 17 APD dari matriks).
     */
    public function show($id)
    {
        $p = Pegawai::findOrFail($id);
        $unitMap    = UnitKerja::pluck('nama_unit_kerja', 'id_api');
        $lokasiMap  = LokasiKerja::pluck('nama_lokasi', 'id_api');
        $subkonMap  = Subkon::pluck('nama_subkon', 'id_api');
        $matriks = $p->kode_ok
            ? MatriksApdJabatan::where('kode_ok', $p->kode_ok)->first()
            : null;
        // Breakdown 17 APD
        $apdBreakdown = [];
        if ($matriks) {
            foreach (MatriksApdJabatan::APD_COLUMNS as $col) {
                $apdBreakdown[] = [
                    'nama'   => $this->labelApd($col),
                    'status' => $matriks->{$col}, // WAJIB | KONDISIONAL | TIDAK
                ];
            }
        }
        // HIRADC terkait
        $hiradcList = $p->kode_ok
            ? Hiradc::where('kode_ok', $p->kode_ok)->get([
                'area_lokasi',
                'aktivitas_pekerjaan',
                'potensi_bahaya',
                'jenis_bahaya',
                'status',
            ])
            : collect();
        [$apdWajib, $apdKhusus] = $this->extractApdFromMatriks($matriks);
        return response()->json([
            'data' => [
                'id_karyawan'      => $p->badge,
                'nama'             => $p->nama,
                'jabatan'          => $p->jabatan ?? '-',
                'jenis_kelamin'    => $p->jenis_kelamin ?? '-',
                'tempat_lahir'     => $p->tempat_lahir ?? '-',
                'tanggal_lahir'    => $p->tanggal_lahir,
                'alamat'           => $p->alamat ?? '-',
                'departemen'       => $subkonMap->get($p->perusahaan_subkonid)
                    ?? 'PT. FOKUS JASA MITRA',
                'unit_kerja'       => $unitMap->get($p->unit_kerjaid) ?? '-',
                'area_kerja'       => $lokasiMap->get($p->lokasi_kerjaid) ?? '-',
                'kode_ok'          => $p->kode_ok ?? '-',
                'nomor_ok'         => $p->nomor_ok ?? '-',
                'uraian_pekerjaan' => $matriks->nama_pekerjaan ?? '-',
                'nomor_kib'        => $p->nomor_kib ?? '-',
                'status_kib'       => $p->status_kib ?? 'TIDAK DITEMUKAN',
                'masa_berlaku_kib' => $p->masa_berlaku_kib,
                'is_safety_officer' => (bool) $p->is_safety_officer,
                'apd_wajib'        => $apdWajib,
                'apd_khusus'       => $apdKhusus,
                'apd_breakdown'    => $apdBreakdown,
                'hiradc_list'      => $hiradcList,
                'status_hiradc'    => $hiradcList->isNotEmpty()
                    ? 'Didukung HIRADC'
                    : 'Belum Ada HIRADC',
            ],
        ]);
    }
    // ─────────── HELPERS ───────────
    /**
     * Ambil daftar APD Wajib & Khusus dari matriks.
     * WAJIB → apd_wajib | KONDISIONAL → apd_khusus.
     *
     * @return array{0: string[], 1: string[]}
     */
    private function extractApdFromMatriks(?MatriksApdJabatan $matriks): array
    {
        $wajib = [];
        $khusus = [];
        if (!$matriks) {
            return [$wajib, $khusus];
        }
        foreach (MatriksApdJabatan::APD_COLUMNS as $col) {
            $val = $matriks->{$col};
            $label = $this->labelApd($col);
            if ($val === 'WAJIB') {
                $wajib[] = $label;
            } elseif ($val === 'KONDISIONAL') {
                $khusus[] = $label;
            }
        }
        return [$wajib, $khusus];
    }
    /**
     * Ubah nama kolom snake_case jadi label rapi.
     */
    private function labelApd(string $col): string
    {
        $map = [
            'helm_safety'           => 'Helm Safety',
            'sepatu_safety'         => 'Sepatu Safety',
            'rompi_hivis'           => 'Rompi Hi-Vis',
            'sarung_tangan_kulit'   => 'Sarung Tangan Kulit',
            'kacamata_safety'       => 'Kacamata Safety',
            'masker_n95'            => 'Masker N95',
            'masker_respirator'     => 'Masker Respirator',
            'earplug_earmuff'       => 'Earplug / Earmuff',
            'full_body_harness'     => 'Full Body Harness',
            'wearpack'              => 'Wearpack',
            'scba'                  => 'SCBA',
            'pakaian_fr'            => 'Pakaian FR',
            'chemical_suit'         => 'Chemical Suit',
            'sarung_tangan_listrik' => 'Sarung Tangan Listrik',
            'face_shield'           => 'Face Shield',
            'kacamata_las'          => 'Kacamata Las',
            'knee_pad'              => 'Knee Pad',
        ];
        return $map[$col] ?? ucwords(str_replace('_', ' ', $col));
    }
}
