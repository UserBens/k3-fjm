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

    /** Array 12 nilai bulan (index 1-12) untuk mempermudah loop di view/JS. */
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

    /**
     * "Bulan terkini" = bulan terakhir yang sudah ada nilai realisasinya.
     * Ini dipakai sebagai acuan proporsi Target YTD, meniru pola pada sheet
     * (mis. baris dengan data s.d. Jun dianggap posisi bulan berjalan = 6).
     */
    public function getBulanTerkiniAttribute(): int
    {
        $last = 0;
        foreach ($this->monthly as $m => $val) {
            if ($val !== null) {
                $last = $m;
            }
        }
        return $last;
    }

    /**
     * Realisasi YTD (Otomatis):
     * - Persentase       -> nilai bulan terakhir yang terisi (snapshot capaian terkini)
     * - Kumulatif        -> jumlah seluruh nilai bulan yang terisi (akumulasi kejadian)
     * - Rata-rata Bulanan -> jumlah seluruh nilai bulan yang terisi (dibandingkan
     *                        terhadap target per-bulan yang diakumulasi juga, lihat target_ytd)
     */
    public function getRealisasiYtdAttribute(): float
    {
        if ($this->tipe_capaian === 'Persentase') {
            $bulan = $this->bulan_terkini;
            return $bulan ? (float) $this->monthly[$bulan] : 0;
        }

        return array_sum(array_filter($this->monthly, fn($v) => $v !== null));
    }

    /**
     * Target YTD (Otomatis):
     * - Persentase        -> sama dengan Target (target akhir tahun)
     * - Kumulatif Tahunan -> Target diproporsikan terhadap bulan terkini (Target * bulan/12)
     * - Rata-rata Bulanan -> Target adalah target PER BULAN, jadi Target YTD =
     *                        Target * jumlah bulan yang sudah berjalan (Target * bulan_terkini)
     *
     * CATATAN: rumus "Rata-rata Bulanan" ini asumsi awal berdasarkan pola
     * Persentase & Kumulatif Tahunan pada contoh sheet — belum tervalidasi 1:1
     * terhadap angka "P2K3 Bulanan" / "General Safety Talk" dsb. di screenshot.
     * Kalau hasilnya belum pas dibanding sheet asli, kirim rumus persisnya biar
     * saya sesuaikan.
     */
    public function getTargetYtdAttribute(): float
    {
        if ($this->tipe_capaian === 'Persentase') {
            return (float) $this->target;
        }

        if ($this->tipe_capaian === 'Rata-rata Bulanan') {
            return round(((float) $this->target) * $this->bulan_terkini, 2);
        }

        return round(((float) $this->target) * ($this->bulan_terkini / 12), 2);
    }

    /**
     * % Capai (Otomatis) = Realisasi YTD / Target YTD, dibulatkan, dibatasi
     * maksimal informatif (tidak dipaksa cap 100% agar over-achievement tetap terlihat).
     *
     * CATATAN UNTUK BENI: pada contoh sheet, baris "Persentase" dengan Realisasi
     * YTD 50 & Target YTD 100 menghasilkan 83% (bukan 50%) di kolom "% Capai
     * (utama)" — sedangkan kolom "% Capai (pembanding)" menunjukkan 50% (cocok
     * dengan rumus sederhana Realisasi/Target). Formula pasti untuk "utama" pada
     * baris itu belum bisa saya pastikan dari data yang diberikan. Yang saya
     * pakai di bawah ini setara dengan kolom "pembanding" (Realisasi YTD /
     * Target YTD). Kalau ada formula khusus untuk "% Capai (utama)", kasih tahu
     * saya rumusnya biar saya sesuaikan accessor ini.
     */
    public function getPersenCapaiAttribute(): ?float
    {
        $targetYtd = $this->target_ytd;
        if ($targetYtd <= 0) {
            return $this->realisasi_ytd > 0 ? 100.0 : null;
        }
        return round(($this->realisasi_ytd / $targetYtd) * 100);
    }

    /**
     * Status (Otomatis), meniru label pada sheet:
     * ✓ TERCAPAI / ⚠ SEBAGIAN / ✗ DI BAWAH / ◷ belum jatuh tempo
     */
    public function getStatusAttribute(): array
    {
        // Kegiatan berkala (mis. training 1x/tahun) yang bulan mulainya belum
        // terlewati dan belum ada realisasi sama sekali -> belum jatuh tempo.
        if ($this->bulan_mulai && $this->bulan_terkini < $this->bulan_mulai && $this->realisasi_ytd == 0) {
            return ['label' => 'belum jatuh tempo', 'icon' => '◷', 'class' => 'sp-gray'];
        }

        $persen = $this->persen_capai;

        if ($persen === null) {
            return ['label' => 'belum ada data', 'icon' => '—', 'class' => 'sp-gray'];
        }
        if ($persen >= 100) {
            return ['label' => 'TERCAPAI', 'icon' => '✓', 'class' => 'sp-green'];
        }
        if ($persen >= 70) {
            return ['label' => 'SEBAGIAN', 'icon' => '⚠', 'class' => 'sp-amber'];
        }
        return ['label' => 'DI BAWAH', 'icon' => '✗', 'class' => 'sp-red'];
    }
}
