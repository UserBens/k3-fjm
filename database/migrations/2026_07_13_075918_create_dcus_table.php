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
        Schema::create('dcus', function (Blueprint $table) {
            $table->id();
            $table->string('badge');
            $table->string('grup')->nullable();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('departemen')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('usia')->nullable();

            $table->date('tanggal_periksa');

            // Tensi
            $table->integer('tensi_sistolik')->nullable();
            $table->integer('tensi_distolik')->nullable();
            $table->string('blood_pressure_judgement')->nullable();
            $table->string('blood_pressure_keterangan')->nullable();
            $table->string('blood_pressure_rujukan')->nullable();
            $table->string('blood_pressure_kelayakan')->nullable();

            // Gula darah
            $table->decimal('gda', 8, 2)->nullable();
            $table->string('blood_glucose_levels_judgement')->nullable();
            $table->string('blood_glucose_levels_keterangan')->nullable();
            $table->string('blood_glucose_levels_rujukan')->nullable();
            $table->string('blood_glucose_levels_kelayakan')->nullable();

            // Saturasi oksigen
            $table->decimal('spo2', 5, 2)->nullable();
            $table->string('saturasi_oxygen_judgement')->nullable();
            $table->string('saturasi_oxygen_keterangan')->nullable();
            $table->string('saturasi_oxygen_rujukan')->nullable();
            $table->string('saturasi_oxygen_kelayakan')->nullable();

            // Suhu
            $table->decimal('suhu', 5, 2)->nullable();
            $table->string('temperature_judgement')->nullable();
            $table->string('temperature_keterangan')->nullable();
            $table->string('temperature_rujukan')->nullable();
            $table->string('temperature_kelayakan')->nullable();

            // Nadi
            $table->integer('nadi')->nullable();
            $table->string('pulse_judgement')->nullable();
            $table->string('pulse_keterangan')->nullable();
            $table->string('pulse_rujukan')->nullable();
            $table->string('pulse_kelayakan')->nullable();

            // Kolesterol
            $table->decimal('cholesterol', 8, 2)->nullable();
            $table->string('cholesterol_judgement')->nullable();
            $table->string('cholesterol_keterangan')->nullable();
            $table->string('cholesterol_rujukan')->nullable();
            $table->string('cholesterol_kelayakan')->nullable();

            // Asam urat
            $table->decimal('asam_urat', 8, 2)->nullable();
            $table->string('uric_acid_judgement')->nullable();
            $table->string('uric_acid_keterangan')->nullable();
            $table->string('uric_acid_rujukan')->nullable();
            $table->string('uric_acid_kelayakan')->nullable();

            // Kolom generik tambahan (belum jelas indikator ke berapa, disiapkan fleksibel)
            $table->string('ket_17')->nullable();
            $table->string('rujukan_18')->nullable();
            $table->string('kelayakan_19')->nullable();
            $table->integer('na')->nullable();

            // Flag
            $table->boolean('self_check')->default(false);
            $table->boolean('consult_dr')->default(false);
            $table->boolean('danger')->default(false);

            // Kesimpulan
            $table->string('result')->nullable();
            $table->text('key_treatment')->nullable();
            $table->text('rekomendasi_medis')->nullable();

            $table->timestamps();

            $table->index('badge');
            $table->index('tanggal_periksa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcus');
    }
};
