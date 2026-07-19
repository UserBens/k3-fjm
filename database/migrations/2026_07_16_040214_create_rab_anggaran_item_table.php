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
        Schema::create('rab_anggaran_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rab_anggaran_id')->constrained('rab_anggaran')->cascadeOnDelete();

            $table->enum('jenis', ['APD', 'ALKES']);          // menentukan item masuk Tabel A atau Tabel B
            $table->string('kode_item')->nullable();

            // Referensi opsional ke master — dipakai untuk autofill lewat picker
            $table->foreignId('stok_apd_id')->nullable()->constrained('stok_apd')->nullOnDelete();
            $table->foreignId('stok_alkes_id')->nullable()->constrained('stok_alkes')->nullOnDelete();

            $table->string('kode_ok')->nullable();
            $table->string('jabatan_posisi')->nullable();
            $table->string('nama_barang');                    // Jenis APD / Jenis Alat Kesehatan
            $table->string('kategori')->nullable();            // WAJIB/KHUSUS (APD) atau ALKES/CONSUMABLE (Alkes)
            $table->string('merk_type')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->string('ukuran')->nullable();

            $table->integer('qty_ada')->default(0);
            $table->integer('qty_butuh')->default(0);
            $table->integer('qty_pengadaan')->default(0);
            $table->string('satuan')->nullable();

            $table->decimal('harga_satuan', 14, 2)->default(0);
            // total_harga TIDAK disimpan — dihitung otomatis (qty_pengadaan * harga_satuan)

            $table->text('keterangan')->nullable();
            $table->enum('prioritas', ['TINGGI', 'SEDANG', 'RENDAH'])->default('SEDANG');
            // Periode Pengajuan — dasar perhitungan rekap otomatis (BULANAN/TRIWULAN/TAHUNAN)
            $table->enum('periode_pengajuan', ['BULANAN', 'TRIWULAN', 'TAHUNAN'])
                ->default('TAHUNAN');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rab_anggaran_item');
    }
};
