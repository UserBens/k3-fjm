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

            $table->date('tanggal_pelaksanaan');

            // Pengawas pelapor (badge & nama, dipilih lewat picker karyawan)
            $table->string('badge_pengawas', 50)->nullable();
            $table->string('nama_pengawas');

            // Area Kerja <- master Lokasi Kerja, Unit Kerja <- master Unit Kerja
            $table->string('area_kerja');
            $table->string('unit_kerja');

            // Jenis Aktifitas KPI <- master aktivitas_kpi_k3 (relasi FK)
            $table->foreignId('aktivitas_kpi_k3_id')
                ->constrained('aktivitas_kpi_k3')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Field khusus [D.1] Pelaporan Nearmiss
            $table->text('keterangan_bahaya')->nullable();
            $table->string('foto_temuan_bahaya')->nullable();

            // Field khusus [D.2] Pelaporan Safety Briefing
            $table->text('materi_safety_briefing')->nullable();
            $table->string('foto_kegiatan_safety_briefing')->nullable();
            $table->string('formulir_presensi_pdf')->nullable();

            // Kolom otomatis (server-generated)
            $table->string('id_laporan', 30)->unique();

            // --- PERUBAHAN DI SINI ---
            // Tipe data diubah dari enum ke string(20) & default diubah ke 'PENDING'
            $table->string('status', 20)->default('PENDING');

            $table->string('lokasi_berkas', 50)->default('ARSIP');
            $table->string('diperiksa_oleh')->nullable();

            $table->timestamps();

            $table->index(['tanggal_pelaksanaan']);
            $table->index(['unit_kerja']);
            $table->index(['status']);
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
