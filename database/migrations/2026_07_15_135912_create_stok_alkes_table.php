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
        Schema::create('stok_alkes', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alkes')->nullable()->unique();
            $table->string('jenis_alat');
            $table->string('fungsi_pemeriksaan')->nullable();

            $table->string('merk')->nullable();
            $table->string('type')->nullable();

            $table->text('spesifikasi_teknis')->nullable();

            $table->integer('stok_awal')->default(0);
            $table->integer('digunakan')->default(0);
            $table->integer('rusak')->default(0);
            $table->integer('stok_tersedia')->default(0);

            $table->integer('reorder_point')->default(0);

            $table->string('nomor_seri')->nullable()->unique();

            $table->enum('kategori', [
                'Diagnostik',
                'Monitoring',
                'Laboratorium',
                'Terapi',
                'Emergency',
                'Lainnya'
            ])->default('Lainnya');

            $table->enum('tipe_alat', ['Consumable', 'Non-Consumable'])
                ->default('Non-Consumable');

            $table->date('tanggal_kalibrasi')->nullable();
            $table->string('interval_kalibrasi', 20)->nullable();

            $table->date('jadwal_kalibrasi_berikut')->nullable();
            $table->date('tanggal_exp')->nullable();

            $table->string('supplier')->nullable();

            $table->decimal('harga_satuan', 15, 2)->nullable();

            $table->date('masa_garansi')->nullable();

            $table->enum('kondisi', [
                'Baik',
                'Rusak Ringan',
                'Rusak Berat',
                'Perlu Kalibrasi'
            ])->default('Baik');

            $table->text('keterangan')->nullable();

            $table->enum('status', [
                'Aktif',
                'Tidak Aktif'
            ])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_alkes');
    }
};
