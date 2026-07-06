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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            // Kolom Sinkronisasi dari API ERP
            // Pastikan id_api juga sudah string
            $table->string('id_api')->unique()->nullable();
            $table->string('badge', 50)->unique()->nullable();
            $table->string('no_ktp', 50)->nullable();
            $table->string('nama', 255);
            $table->string('jenis_kelamin', 20)->nullable();

            // UBAH DUA BARIS INI MENJADI STRING
            $table->string('unit_kerjaid')->nullable();
            $table->string('lokasi_kerjaid')->nullable();

            $table->boolean('is_active')->default(true);
            $table->string('nomor_kib', 100)->nullable();
            $table->string('status_kib', 50)->nullable();
            $table->date('masa_berlaku_kib')->nullable();
            $table->timestamp('last_sync')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
