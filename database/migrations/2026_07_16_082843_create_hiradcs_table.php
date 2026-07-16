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
        Schema::create('hiradcs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ok')->nullable()->index(); // opsional, link ke pekerjaan/OK terkait
            $table->string('area_lokasi');
            $table->string('aktivitas_pekerjaan');
            $table->string('potensi_bahaya');
            $table->string('jenis_bahaya'); // Bahaya Fisik / Kimia / Listrik / Ergonomi / dll
            $table->text('konsekuensi_dampak')->nullable();

            // Penilaian awal
            $table->unsignedTinyInteger('l_awal'); // 1-5
            $table->unsignedTinyInteger('s_awal'); // 1-5
            // nilai & tingkat risiko awal dihitung di Model (accessor), tidak disimpan

            $table->text('pengendalian_ada')->nullable();
            $table->text('apd_wajib')->nullable(); // free text ringkas, detail APD ada di matriks_apd_jabatans
            $table->text('pengendalian_tambahan')->nullable();

            // Penilaian sesudah pengendalian tambahan
            $table->unsignedTinyInteger('l_sesudah')->nullable();
            $table->unsignedTinyInteger('s_sesudah')->nullable();

            $table->string('pic')->nullable();
            $table->enum('status', ['Open', 'Close'])->default('Open');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiradcs');
    }
};
