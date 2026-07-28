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
        Schema::create('registrasi_k3', function (Blueprint $table) {
            $table->id();

            // --- BAGIAN 1: INFORMASI DASAR ---
            $table->date('tanggal_induction');
            $table->string('nomor_ktp', 20);
            $table->string('badge', 50);
            $table->string('nama_lengkap');
            $table->string('nomor_hp', 20);

            // --- BAGIAN 2: DATA PEKERJAAN ---
            $table->string('pt_asal');
            $table->string('departemen');
            $table->string('jabatan');
            $table->string('unit_kerja');
            $table->string('area_kerja');

            // --- BAGIAN 3: LISENSI & KEAHLIAN ---
            $table->string('sim_ac', 50)->nullable();
            $table->string('sio_aktif')->nullable();

            // --- BAGIAN 4: KONTAK DARURAT ---
            $table->string('nama_kontak_darurat');
            $table->string('hubungan_kontak_darurat');
            $table->text('alamat_kontak_darurat');

            // --- BAGIAN 5: PATH DOKUMEN UPLOAD ---
            $table->string('foto_diri');
            $table->string('file_ktp');
            $table->string('file_kk');
            $table->string('file_bpjs');
            $table->string('file_sks'); // Surat Keterangan Sehat
            $table->string('file_skck');
            $table->string('file_safety_induction');
            $table->string('file_pakta_integritas');
            $table->json('checklist_apd')->nullable(); // Disimpan dalam format JSON array
            $table->string('ukuran_sepatu', 50)->nullable();
            $table->string('ukuran_seragam_atas', 50)->nullable();
            $table->string('ukuran_seragam_bawah', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi_k3');
    }
};
