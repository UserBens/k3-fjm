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
        Schema::create('log_apd', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_dokumen')->unique();          // APD-LOG-0001, auto generate

            // Data Karyawan — boleh kosong untuk transaksi MASUK (PP/PO) yang tidak terkait karyawan
            $table->string('id_karyawan')->nullable();
            $table->string('nama_karyawan')->nullable();
            $table->string('kode_ok')->nullable();            // Kode Order Kerja
            $table->string('unit_kerja')->nullable();
            $table->string('jabatan')->nullable();

            // Data APD — opsional terhubung ke master stok_apd untuk autofill
            $table->foreignId('stok_apd_id')->nullable()->constrained('stok_apd')->nullOnDelete();
            $table->string('kode_apd')->nullable();
            $table->string('jenis_apd');
            $table->string('merk_type')->nullable();
            $table->string('ukuran')->nullable();

            // Transaksi
            $table->integer('qty_keluar')->default(0);
            $table->integer('qty_masuk')->default(0);
            $table->string('jenis_transaksi');                // JATAH BARU, TUKAR LAMA, TUKAR RUSAK, MASUK (PP/PO), dst
            $table->string('no_po_pr')->nullable();
            $table->string('kondisi_apd_lama')->nullable();
            $table->boolean('pernah_tukar')->nullable();
            $table->text('alasan_penggantian')->nullable();
            $table->string('diterima_oleh')->nullable();
            $table->text('keterangan')->nullable();

            $table->index(['tanggal']);
            $table->index(['jenis_transaksi']);
            $table->string('keterangan_lainnya')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_apd');
    }
};
