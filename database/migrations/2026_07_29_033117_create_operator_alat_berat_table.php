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
        Schema::create('operator_alat_berat', function (Blueprint $table) {
            $table->id();

            $table->string('badge', 50)->unique();
            $table->string('nama');
            $table->string('area_kerja');
            $table->string('kualifikasi');
            $table->string('jenis_unit_utama');
            $table->string('bagian')->nullable();
            $table->string('titik_absensi')->nullable();
            $table->string('pemasok')->nullable();       // AJG, FJM, dst
            $table->string('grup', 10)->nullable();       // A, B, C, D
            $table->string('kode_ok', 50)->nullable();
            $table->enum('status_operator', ['AKTIF', 'NONAKTIF'])->default('AKTIF');

            // KIB
            $table->string('nomor_kib')->nullable();
            $table->date('masa_berlaku_kib')->nullable();

            // SIO ke-1
            $table->string('nomor_sio_1')->nullable();
            $table->string('jenis_sio_1')->nullable();    // WHEEL LOADER, FORKLIFT, dst
            $table->date('masa_berlaku_sio_1')->nullable();

            // SIO ke-2
            $table->string('nomor_sio_2')->nullable();
            $table->string('jenis_sio_2')->nullable();
            $table->date('masa_berlaku_sio_2')->nullable();

            $table->date('tanggal_lahir')->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator_alat_berat');
    }
};
