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
        Schema::create('pelaporan_pengawas', function (Blueprint $table) {
            $table->id();

            // Informasi Utama
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->string('nama_pengawas')->nullable();
            $table->string('kode_laporan')->nullable();
            $table->string('area_kerja')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('jenis_aktifitas')->nullable(); // cth: Safety Patrol, Safety Briefing, dll.

            // Rincian Aktifitas / Temuan
            $table->text('keterangan_bahaya')->nullable(); // Untuk laporan nearmiss/temuan
            $table->text('materi_briefing')->nullable();   // Untuk laporan safety briefing

            // Status & Verifikasi
            $table->string('status')->default('PROSES'); // cth: PROSES, SELESAI, REVISI
            $table->string('diperiksa_oleh')->nullable();

            // Lampiran (Menyimpan path file lokal atau URL eksternal/Drive)
            $table->text('foto_temuan')->nullable();
            $table->text('foto_briefing')->nullable();
            $table->text('presensi_briefing')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan_pengawas');
    }
};
