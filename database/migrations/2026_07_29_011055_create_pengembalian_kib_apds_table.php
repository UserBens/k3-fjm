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
        Schema::create('pengembalian_kib_apds', function (Blueprint $table) {
            $table->id();
            $table->string('no_dokumen', 50)->unique();
            $table->date('tanggal');

            // Data Karyawan
            $table->string('nomor_badge', 50);
            $table->string('nama_lengkap', 150);
            $table->string('jabatan', 150)->nullable();
            $table->string('unit_kerja', 150)->nullable();

            // Pengembalian KIB
            $table->string('status_fisik_kib', 50); // OK/BAIK, RUSAK/BURAM/TIDAK LAYAK
            $table->string('nomor_kib_dikembalikan', 100)->nullable();
            $table->string('foto_kib')->nullable();

            // Pengembalian APD (checklist multi APD)
            $table->json('apd_dikembalikan')->nullable(); // [{id, kode_apd, jenis_apd, ukuran}]
            $table->string('foto_apd')->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->index('nomor_badge');
            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_kib_apds');
    }
};
