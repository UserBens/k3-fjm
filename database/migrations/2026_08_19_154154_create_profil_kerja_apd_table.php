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
        Schema::create('profil_kerja_apd', function (Blueprint $table) {
            $table->id();

            // KUNCI
            $table->string('kode_profil', 10)->unique();

            // ISI (input manual)
            $table->string('nama_profil');

            // ISI — matriks bahaya B1..B8, skala 0-4 (0=tidak ada, 4=tertinggi)
            $table->unsignedTinyInteger('b1')->default(0);
            $table->unsignedTinyInteger('b2')->default(0);
            $table->unsignedTinyInteger('b3')->default(0);
            $table->unsignedTinyInteger('b4')->default(0);
            $table->unsignedTinyInteger('b5')->default(0);
            $table->unsignedTinyInteger('b6')->default(0);
            $table->unsignedTinyInteger('b7')->default(0);
            $table->unsignedTinyInteger('b8')->default(0);

            // RUMUS -> dihitung otomatis di Model ProfilKerjaK3::booted(), disimpan utk performa query
            $table->unsignedTinyInteger('skor_tertinggi')->default(0);   // MAX(b1..b8)
            $table->unsignedInteger('skor_total')->default(0);           // SUM(b1..b8)
            $table->unsignedTinyInteger('jml_bahaya_sedang')->default(0); // COUNT(b_i >= 2)
            $table->unsignedTinyInteger('tier_risiko')->default(0);      // = skor_tertinggi (0-4)
            $table->string('bahaya_pengendali')->nullable();             // label B_x dengan nilai tertinggi

            // ISI (input manual)
            $table->text('deskripsi_paparan')->nullable();
            $table->text('contoh_jabatan')->nullable();
            $table->text('dasar_penilaian')->nullable();
            $table->string('sumber_skor')->nullable();

            // RUMUS/ISI — jumlah karyawan pemegang profil ini
            $table->unsignedInteger('jml_karyawan')->default(0);

            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kerja_apd');
    }
};
