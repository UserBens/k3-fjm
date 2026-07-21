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
        Schema::create('master_jadwal_shifts', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('regu', ['A', 'B', 'C', 'D']);
            $table->string('kode_shift', 5); // 'P' (Pagi), 'S' (Sore), 'M' (Malam), 'O' (Off)
            $table->unsignedTinyInteger('jam_kerja')->default(0); // 8 atau 0
            $table->unsignedTinyInteger('jam_nd')->default(0);    // 8 atau 0 (Non-Duty / Night Diff)
            $table->timestamps();

            // Mencegah duplikasi jadwal regu di tanggal yang sama
            $table->unique(['tanggal', 'regu'], 'uq_tanggal_regu');

            // Indexing untuk mempercepat pencarian query
            $table->index('tanggal');
            $table->index('regu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jadwal_shifts');
    }
};
