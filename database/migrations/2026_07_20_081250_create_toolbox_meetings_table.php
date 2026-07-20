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
        Schema::create('toolbox_meetings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');

            // Snapshot Safety Officer (SO) yang mengisi TBM.
            // badge_so dipakai untuk relasi ringan ke pegawais.badge,
            // nama_so disimpan sebagai snapshot agar histori tetap tampil
            // walau data pegawai berubah / SO dilepas dari jabatannya.
            $table->string('badge_so')->nullable();
            $table->string('nama_so')->nullable();

            $table->string('area_kerja');
            $table->string('unit_kerja');

            // Link Google Drive / path file upload
            $table->text('foto_tbm')->nullable();
            $table->text('foto_daftar_hadir')->nullable();
            $table->text('dokumen_laporan_kegiatan')->nullable();

            $table->string('created_by')->nullable();
            $table->timestamps();

            $table->index('tanggal');
            $table->index('area_kerja');
            $table->index('unit_kerja');
            $table->index('badge_so');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toolbox_meetings');
    }
};
