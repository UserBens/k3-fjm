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
        Schema::create('stok_apd', function (Blueprint $table) {
            $table->id();
            $table->string('kode_apd')->unique();          // FJM-KJ-UB-01
            $table->string('jenis_apd');                    // Helm Safety
            $table->enum('kategori', ['WAJIB', 'KHUSUS'])->default('WAJIB');

            $table->text('fungsi_sasaran')->nullable();     // Fungsi / Sasaran Dilindungi
            $table->string('merk_rekomendasi')->nullable();
            $table->text('spesifikasi_teknis')->nullable();
            $table->string('ukuran_tersedia')->nullable();  // S/M/L/XL, 36-45, Universal, dst
            $table->string('standar_regulasi')->nullable(); // SNI / EN / ANSI

            // Stok
            $table->integer('stok_awal')->default(0);
            $table->integer('digunakan')->default(0);
            $table->integer('rusak')->default(0);
            $table->integer('reorder_point')->default(0);
            // stok_tersedia TIDAK disimpan sebagai kolom, dihitung otomatis
            // (stok_awal - digunakan - rusak) supaya selalu konsisten.

            $table->decimal('harga_satuan', 14, 2)->default(0);
            $table->string('supplier')->nullable();
            $table->string('masa_pakai')->nullable();       // "5 tahun", "Sekali pakai"
            $table->date('terakhir_pengadaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_apd');
    }
};
