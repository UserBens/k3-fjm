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
        Schema::create('kode_ok_referensi_apd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kode_ok_referensi_id')->constrained('kode_ok_referensi')->cascadeOnDelete();
            $table->foreignId('stok_apd_id')->constrained('stok_apd')->cascadeOnDelete();
            $table->enum('jenis', ['WAJIB', 'KHUSUS']); // satu tabel pivot dipakai untuk 2 checklist (Wajib & Khusus)
            $table->timestamps();

            $table->unique(['kode_ok_referensi_id', 'stok_apd_id', 'jenis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_ok_referensi_apd');
    }
};
