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
        Schema::create('kode_ok_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kode_ok_id')->constrained('kode_oks')->cascadeOnDelete();
            $table->foreignId('pegawai_id')->constrained('pegawais')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['kode_ok_id', 'pegawai_id']);
        });

        Schema::create('kode_ok_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kode_ok_id')->constrained('kode_oks')->cascadeOnDelete();
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['kode_ok_id', 'unit_kerja_id']);
        });

        Schema::create('kode_ok_kualifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kode_ok_id')->constrained('kode_oks')->cascadeOnDelete();
            $table->foreignId('kualifikasi_id')->constrained('kualifikasis')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['kode_ok_id', 'kualifikasi_id']);
        });
    }

    public function down(): void
    {
        // urutan drop dibalik supaya aman dari constraint FK
        Schema::dropIfExists('kode_ok_kualifikasi');
        Schema::dropIfExists('kode_ok_unit_kerja');
        Schema::dropIfExists('kode_ok_pegawai');
    }
};
