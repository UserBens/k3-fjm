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
            $table->string('no_hiradc')->nullable()->index(); // No. HIRADC, mis. "01-00"
            $table->string('judul_pekerjaan');
            $table->string('kategori_pekerjaan');
            $table->text('potensi_bahaya');
            $table->text('konsekuensi_dampak')->nullable();

            $table->unsignedTinyInteger('l_awal');
            $table->unsignedTinyInteger('s_awal');

            $table->text('apd_wajib')->nullable();
            $table->text('apd_khusus')->nullable();
            $table->text('pengendalian_utama')->nullable();

            $table->unsignedTinyInteger('l_sesudah')->nullable();
            $table->unsignedTinyInteger('s_sesudah')->nullable();

            $table->string('pic')->nullable();
            $table->enum('status', ['Open', 'Close'])->default('Open');

            // dokumen hasil upload admin (PDF), simpan path relatif di storage
            $table->string('dokumen')->nullable();
            $table->string('dokumen_hiradc')->nullable(); // nama file asli, buat ditampilkan

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
