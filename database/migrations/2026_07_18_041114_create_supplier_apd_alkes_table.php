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
        Schema::create('supplier_apd_alkes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier');
            $table->string('kategori_produk');
            $table->string('merk_utama')->nullable();
            $table->string('jenis_supplier')->nullable(); // Distributor Resmi / Pabrikan / Agen / Lainnya

            $table->string('kontak_person')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('wilayah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('website')->nullable();

            $table->string('nomor_izin_edar')->nullable(); // opsional, khusus alkes (izin edar Kemenkes)
            $table->text('catatan')->nullable();

            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_apd_alkes');
    }
};
