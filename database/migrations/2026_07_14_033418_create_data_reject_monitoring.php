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
        Schema::create('data_reject_monitoring', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_reject')->nullable();
            $table->timestamp('waktu_submit_form')->nullable(); // TIMESTAMP FORM (form asal)
            $table->date('tanggal_pelaksanaan')->nullable();

            // Pelapor
            $table->string('badge_pelapor', 50)->nullable();
            $table->string('nama_pelapor', 255)->nullable();

            $table->string('area_kerja', 150)->nullable();
            $table->string('unit_kerja', 150)->nullable();
            $table->string('jenis_aktifitas_kpi', 150)->nullable();

            $table->text('keterangan_bahaya_materi')->nullable();

            $table->string('asal_data', 50)->nullable(); // Data Medis / Data Safety / Data HSE / Data Pengawas

            $table->text('link_file_reject')->nullable();   // multi-link, satu link per baris
            $table->text('link_arsip_lama')->nullable();     // multi-link, satu link per baris

            $table->text('catatan_reject')->nullable();

            $table->timestamps();

            $table->index('badge_pelapor');
            $table->index('tanggal_reject');
            $table->index('asal_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_reject_monitoring');
    }
};
