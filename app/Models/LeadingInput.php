<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadingInput extends Model
{
    protected $fillable = [
        'tahun',
        'no_urut',
        'kategori',
        'nama_kegiatan',
        'satuan',
        'target',
        'bulan_01',
        'bulan_02',
        'bulan_03',
        'bulan_04',
        'bulan_05',
        'bulan_06',
        'bulan_07',
        'bulan_08',
        'bulan_09',
        'bulan_10',
        'bulan_11',
        'bulan_12',
        'tipe_capaian',
        'aktif',
        'bulan_mulai',
        'setiap_n_bulan',
    ];

    protected $casts = [
        'target' => 'float',
        'aktif' => 'boolean',
        'bulan_01' => 'float',
        'bulan_02' => 'float',
        'bulan_03' => 'float',
        'bulan_04' => 'float',
        'bulan_05' => 'float',
        'bulan_06' => 'float',
        'bulan_07' => 'float',
        'bulan_08' => 'float',
        'bulan_09' => 'float',
        'bulan_10' => 'float',
        'bulan_11' => 'float',
        'bulan_12' => 'float',
    ];

    protected $appends = [
        'key',
        'key2',
        'bulan_terkini',
        'realisasi_ytd',
        'target_ytd',
        'persen_capai',
        'persen_capai_pembanding',
        'status',
        'monthly',
    ];

    const BULAN_LABEL = [
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'Mei',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Ags',
        9 => 'Sep',
        10 => 'Okt',
        11 => 'Nov',
        12 => 'Des',
    ];

    // ─────────────────────────────────────────────────────────
    // AUTO: Tipe Capaian selalu diturunkan dari Satuan (persis
    // rumus sheet), jadi tidak perlu dipilih manual di form.
    //   =IF(E2="%";"Persentase";
    //       IF(SEARCH("Tahun";E2);"Kumulatif Tahunan";"Rata-rata Bulanan"))
    // ─────────────────────────────────────────────────────────
    protected static function booted(): void
    {
        static::saving(function (LeadingInput $model) {
            $model->tipe_capaian = self::deriveTipeCapaian($model->satuan);
        });
    }

    public static function deriveTipeCapaian(?string $satuan): string
    {
        $satuan = trim((string) $satuan);
        if ($satuan === '%') {
            return 'Persentase';
        }
        if (stripos($satuan, 'Tahun') !== false) {
            return 'Kumulatif Tahunan';
        }
        return 'Rata-rata Bulanan';
    }

    /**
     * "Helper!D5" di sheet = bulan berjalan (global, sama untuk semua baris
     * apa pun tahunnya — persis kelakuan sheet Anda dimana baris tahun 2025
     * yang datanya kosong tetap menghasilkan Target YTD proporsional
     * terhadap bulan berjalan sekarang).
     *
     * Kalau mau ikut setting PengaturanKpiK3, ganti isi method ini.
     */
    public function bulanBerjalan(): int
    {
        return max(1, min(12, (int) now()->month));
    }

    public function getMonthlyAttribute(): array
    {
        $out = [];
        foreach (range(1, 12) as $m) {
            $col = 'bulan_' . str_pad($m, 2, '0', STR_PAD_LEFT);
            $out[$m] = $this->{$col};
        }
        return $out;
    }

    public function getKeyAttribute(): string
    {
        return $this->tahun . '|' . $this->no_urut;
    }

    public function getKey2Attribute(): string
    {
        return $this->tahun . '|' . $this->nama_kegiatan;
    }

    public function getBulanTerkiniAttribute(): int
    {
        $last = 0;
        foreach ($this->monthly as $m => $val) {
            if ($val !== null) $last = $m;
        }
        return $last;
    }

    /** Nilai bulan yang TERISI (bukan null) dalam rentang 1..bulanBerjalan */
    private function filledValuesInRange(): array
    {
        $monthly = $this->monthly;
        $bulanJalan = $this->bulanBerjalan();
        $out = [];
        foreach (range(1, $bulanJalan) as $m) {
            if ($monthly[$m] !== null) {
                $out[$m] = (float) $monthly[$m];
            }
        }
        return $out;
    }

    /**
     * Jumlah "jatuh tempo" kegiatan berkala non-bulanan dalam setahun,
     * opsional dibatasi sampai bulan tertentu.
     *   month >= bulan_mulai DAN (month - bulan_mulai) % setiap_n_bulan == 0
     */
    private function occurrences(?int $sampaiBulan = null): int
    {
        if (!$this->bulan_mulai) {
            return 0;
        }
        $n = max(1, (int) ($this->setiap_n_bulan ?: 13));
        $total = 0;
        foreach (range(1, 12) as $m) {
            if ($m >= $this->bulan_mulai && ($m - $this->bulan_mulai) % $n === 0) {
                if ($sampaiBulan === null || $m <= $sampaiBulan) {
                    $total++;
                }
            }
        }
        return $total;
    }

    /**
     * Realisasi YTD:
     * - Persentase        -> AVERAGE nilai bulan yang terisi (s.d. bulan berjalan)
     * - Kumulatif/RataRata -> SUM nilai bulan yang terisi
     */
    public function getRealisasiYtdAttribute(): float
    {
        $vals = $this->filledValuesInRange();
        if (empty($vals)) return 0.0;

        if ($this->tipe_capaian === 'Persentase') {
            return round(array_sum($vals) / count($vals), 2);
        }
        return round(array_sum($vals), 2);
    }

    /**
     * Target YTD:
     * - Persentase        -> Target (tahunan, konstan)
     * - Kumulatif Tahunan -> proporsi berdasar jadwal berkala jika ada
     *                        (Bulan Mulai + Setiap N Bulan), kalau tidak ada
     *                        jadwal -> Target * bulanBerjalan/12
     * - Rata-rata Bulanan -> Target(per bulan) * jumlah bulan yang TERISI
     */
    public function getTargetYtdAttribute(): float
    {
        $target = (float) $this->target;
        $bulanJalan = $this->bulanBerjalan();

        if ($this->tipe_capaian === 'Persentase') {
            return $target;
        }

        if ($this->tipe_capaian === 'Kumulatif Tahunan') {
            $totalOcc = $this->occurrences();
            if ($totalOcc > 0) {
                $uptoOcc = $this->occurrences($bulanJalan);
                return round($target * $uptoOcc / $totalOcc, 2);
            }
            return round($target * $bulanJalan / 12, 2);
        }

        // Rata-rata Bulanan
        return round(count($this->filledValuesInRange()) * $target, 2);
    }

    /** rasio nilai/target per bulan terisi, dibatasi maksimal 1 (capped) */
    private function cappedRatios(): array
    {
        $target = (float) $this->target;
        $denom = $target != 0 ? $target : 1;
        $out = [];
        foreach ($this->filledValuesInRange() as $v) {
            $ratio = $v / $denom;
            $out[] = $ratio > 1 ? 1 : $ratio;
        }
        return $out;
    }

    /**
     * % Capai (utama):
     * - Kumulatif Tahunan -> MIN(Realisasi/Target,1); null jika belum jatuh
     *                        tempo atau belum ada data sama sekali
     * - Persentase/RataRata -> 1 - (jumlah_bulan_terisi - total_rasio_capped)/12
     */
    public function getPersenCapaiAttribute(): ?float
    {
        $filled = $this->filledValuesInRange();
        $bulanJalan = $this->bulanBerjalan();

        if ($this->tipe_capaian === 'Kumulatif Tahunan') {
            $totalOcc = $this->occurrences();
            $uptoOcc = $this->occurrences($bulanJalan);

            if ($totalOcc > 0 && $uptoOcc === 0) {
                return null; // belum jatuh tempo
            }
            if (empty($filled)) {
                return null; // belum ada data
            }

            $targetYtd = $this->target_ytd;
            $realisasi = $this->realisasi_ytd;

            if ($targetYtd == 0) {
                return $realisasi > 0 ? 100.0 : 0.0;
            }
            return round(min($realisasi / $targetYtd, 1) * 100);
        }

        if (empty($filled)) {
            return null;
        }

        $capped = $this->cappedRatios();
        $result = 1 - ((count($filled) - array_sum($capped)) / 12);
        $result = max(0, min(1, $result));

        return round($result * 100);
    }

    /**
     * % Capai (pembanding):
     * - Kumulatif Tahunan -> sama dengan % Capai utama
     * - Persentase/RataRata -> rata-rata rasio capped (bukan sekadar
     *                          realisasi/target polos)
     */
    public function getPersenCapaiPembandingAttribute(): ?float
    {
        if ($this->tipe_capaian === 'Kumulatif Tahunan') {
            return $this->persen_capai;
        }

        $filled = $this->filledValuesInRange();
        if (empty($filled)) {
            return null;
        }

        $capped = $this->cappedRatios();
        return round((array_sum($capped) / count($filled)) * 100);
    }

    /**
     * Status:
     *   >= 100%           -> ✓ TERCAPAI
     *   >= 80%  (bukan 70%!) -> ⚠ SEBAGIAN
     *   selebihnya        -> ✗ DI BAWAH
     *   null krn jatuh tempo -> ◷ belum jatuh tempo
     *   null krn tak ada data -> – belum ada data
     */
    public function getStatusAttribute(): array
    {
        if ($this->tipe_capaian === 'Kumulatif Tahunan') {
            $bulanJalan = $this->bulanBerjalan();
            $totalOcc = $this->occurrences();
            $uptoOcc = $this->occurrences($bulanJalan);

            if ($totalOcc > 0 && $uptoOcc === 0) {
                return ['label' => 'belum jatuh tempo', 'icon' => '◷', 'class' => 'sp-gray'];
            }
        }

        $persen = $this->persen_capai;

        if ($persen === null) {
            return ['label' => 'belum ada data', 'icon' => '–', 'class' => 'sp-gray'];
        }
        if ($persen >= 100) {
            return ['label' => 'TERCAPAI', 'icon' => '✓', 'class' => 'sp-green'];
        }
        if ($persen >= 80) {
            return ['label' => 'SEBAGIAN', 'icon' => '⚠', 'class' => 'sp-amber'];
        }
        return ['label' => 'DI BAWAH', 'icon' => '✗', 'class' => 'sp-red'];
    }
}
