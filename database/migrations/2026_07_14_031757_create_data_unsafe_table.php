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
        Schema::create('data_unsafe', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_submit')->nullable();
            $table->date('tanggal_temuan')->nullable();

            // Safety Officer (pelapor)
            $table->string('badge_so', 50)->nullable();
            $table->string('nama_so', 255)->nullable();

            $table->string('area_kerja', 150)->nullable();
            $table->string('unit_kerja', 150)->nullable();

            $table->text('item_temuan')->nullable();
            $table->string('jenis_penyebab', 50)->nullable(); // Unsafe Action / Unsafe Condition
            $table->text('deskripsi_temuan')->nullable();
            $table->text('rekomendasi_perbaikan')->nullable();
            $table->string('status_temuan', 20)->default('OPEN'); // OPEN / CLOSE

            $table->string('foto_temuan_path')->nullable();
            $table->string('dokumen_laporan_path')->nullable();

            $table->timestamps();

            $table->index('badge_so');
            $table->index('tanggal_temuan');
            $table->index('status_temuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_unsafe');
    }
};
