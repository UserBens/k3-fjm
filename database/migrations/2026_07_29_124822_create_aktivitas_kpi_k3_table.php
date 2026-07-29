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
        Schema::create('aktivitas_kpi_k3', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama_aktivitas');

            // K x F -> skor dihitung otomatis (lihat Model AktivitasKpiK3::boot)
            $table->tinyInteger('kompleksitas'); // 1-3
            $table->tinyInteger('frekuensi');    // 1-3
            $table->integer('skor');             // kompleksitas * frekuensi (disimpan utk performa query)

            $table->integer('target_per_bulan')->default(0);
            $table->boolean('ikut_hari_kerja')->default(true); // Y/N
            $table->integer('maks_per_hari')->default(1);

            $table->unsignedSmallInteger('mulai_berlaku');
            $table->unsignedSmallInteger('akhir_berlaku')->nullable();

            // Tim yang terlibat -> menentukan ke total skor tim mana aktivitas ini masuk
            $table->boolean('safety')->default(false);
            $table->boolean('pengawas')->default(false);
            $table->boolean('medis')->default(false);

            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');

            // NB: bobot_safety / bobot_pengawas / bobot_medis TIDAK disimpan di DB.
            // Selalu dihitung on-the-fly di Controller = skor baris / total skor tim (aktif) x 100
            // supaya otomatis ter-update saat baris lain berubah (sesuai catatan panduan Excel).

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_kpi_k3');
    }
};
