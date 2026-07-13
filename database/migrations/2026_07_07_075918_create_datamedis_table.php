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
        Schema::create('datamedis', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_submit')->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->string('badge_tenaga', 50)->nullable();
            $table->string('nama_tenaga', 255);
            $table->string('area_kerja', 100)->nullable();
            $table->string('unit_kerja', 150)->nullable();
            $table->string('jenis_aktifitas_kpi', 150)->nullable();
            $table->text('foto_evidence_path')->nullable();
            $table->text('formulir_kegiatan_path')->nullable();
            $table->string('status_pindah', 30)->default('PENDING'); // SUKSES / GAGAL / PENDING
            $table->text('arsip_path')->nullable();
            $table->string('keputusan', 30)->default('PENDING'); // APPROVE / REJECT / PENDING
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datamedis');
    }
};
