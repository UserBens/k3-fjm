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
        Schema::create('stok_apd_kodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_apd_id')
                ->constrained('stok_apd')
                ->onDelete('cascade'); // kalau APD dihapus, daftar OK-nya ikut terhapus

            $table->string('kode_ok', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_apd_kodes');
    }
};
