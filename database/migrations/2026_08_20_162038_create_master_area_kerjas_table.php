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
        Schema::create('master_area_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('kompleks', 150);
            $table->string('nama_area', 200);
            $table->enum('zona', ['HIJAU', 'PUTIH', 'KUNING', 'MERAH'])->default('HIJAU');
            $table->unsignedTinyInteger('urutan_risiko')->default(1); // ← auto-diisi dari zona, lihat Model::booted()
            $table->text('keterangan')->nullable();       // aturan APD untuk zona tsb
            $table->text('potensi_bahaya')->nullable();    // dipisah ";" — mengikuti format kolom POTENSI_BAHAYA_KOMPLEKS_PG
            $table->boolean('aktif')->default(true);
            $table->timestamps();

            $table->unique(['kompleks', 'nama_area']);
            $table->index('zona');
            $table->index('kompleks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_area_kerjas');
    }
};
