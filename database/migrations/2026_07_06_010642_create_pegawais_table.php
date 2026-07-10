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
            $table->string('id_api')->unique()->nullable();
            $table->string('badge', 50)->unique()->nullable();
            $table->string('no_ktp', 50)->nullable();
            $table->string('nama', 255);
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('unit_kerjaid')->nullable();
            $table->string('lokasi_kerjaid')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_safety_officer')->default(false);
            $table->timestamp('safety_officer_since')->nullable();
            // --- TAMBAHAN KOLOM BARU SESUAI API ---
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_bpjs_kesehatan', 50)->nullable();
            $table->string('no_bpjs_ketenagakerjaan', 50)->nullable();
            $table->string('kode_ok', 50)->nullable();
            $table->string('nomor_ok', 100)->nullable();
            // --------------------------------------

            $table->string('nomor_kib', 100)->nullable();
            $table->string('status_kib', 50)->nullable();
            $table->date('masa_berlaku_kib')->nullable(); // Pastikan ini juga ada
            $table->string('gambar_kib')->nullable(); // <-- TAMBAHAN KOLOM INI
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
