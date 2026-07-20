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
        Schema::create('rab_anggaran', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rab')->unique();           // RAB-HSE-2026-001
            $table->string('nama_perusahaan')->default('PT. Fokus Jasa Mitra');
            $table->string('departemen')->nullable();
            $table->string('tahun_anggaran', 4);
            $table->string('dibuat_oleh')->nullable();
            $table->string('disetujui_oleh')->nullable();
            $table->date('tanggal_pengajuan')->nullable();
            $table->enum('status', ['DRAFT', 'DIAJUKAN', 'DISETUJUI'])->default('DRAFT');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index(['tahun_anggaran']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rab_anggaran');
    }
};
