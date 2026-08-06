<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaturan_kpi_k3', function (Blueprint $table) {
            $table->id();

            // 1 · PERIODE AKTIF
            $table->unsignedSmallInteger('tahun_aktif');
            $table->unsignedTinyInteger('bulan_aktif');
            $table->unique(['tahun_aktif', 'bulan_aktif'], 'pengaturan_kpi_k3_periode_unique');
            $table->unsignedTinyInteger('tanggal_cutoff_manajer');
            $table->date('periode_manajer_mulai');
            $table->date('periode_manajer_selesai');
            $table->date('periode_p2k3_mulai');
            $table->date('periode_p2k3_selesai');
            $table->unsignedTinyInteger('hari_kerja_efektif_manajer');
            $table->unsignedTinyInteger('hari_kerja_efektif_p2k3');
            $table->unsignedTinyInteger('jumlah_hari_kalender_manajer');
            $table->unsignedTinyInteger('jumlah_hari_kalender_p2k3');

            // 2 · KETEPATAN WAKTU
            $table->unsignedTinyInteger('batas_terlambat_lapor');
            $table->unsignedTinyInteger('batas_lapor_lebih_awal');

            // 3 · BOBOT PENILAIAN
            $table->decimal('porsi_capaian_aktivitas', 5, 2)->default(90);
            $table->decimal('porsi_ketepatan_waktu', 5, 2)->default(10);

            // 4 · TUNJANGAN (nominal terpisah per tim)
            $table->unsignedBigInteger('tunjangan_safety')->default(0);
            $table->unsignedBigInteger('tunjangan_pengawas')->default(0);
            $table->unsignedBigInteger('tunjangan_medis')->default(0);
            $table->decimal('skor_minimum_tunjangan', 5, 2)->default(0);
            $table->decimal('skor_maksimum_tunjangan', 5, 2)->default(100);
            $table->boolean('tim_safety_dapat_tunjangan')->default(true);
            $table->boolean('tim_pengawas_dapat_tunjangan')->default(false);
            $table->boolean('tim_medis_dapat_tunjangan')->default(false);

            // 6 · AMBANG WARNA
            $table->decimal('ambang_merah', 5, 2)->default(75);
            $table->decimal('ambang_kuning', 5, 2)->default(90);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_kpi_k3');
    }
};
