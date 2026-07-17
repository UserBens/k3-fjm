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
        Schema::create('leading_inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun');
            $table->unsignedInteger('no_urut');
            $table->string('kategori');
            $table->string('nama_kegiatan');
            $table->string('satuan')->nullable();
            $table->decimal('target', 12, 2)->default(0);

            // Realisasi per bulan (Jan - Des). Disimpan mentah, semua kolom
            // turunan (Realisasi YTD, Target YTD, % Capai, Status) DIHITUNG
            // otomatis lewat accessor di model LeadingInput, tidak disimpan.
            $table->decimal('bulan_01', 12, 2)->nullable();
            $table->decimal('bulan_02', 12, 2)->nullable();
            $table->decimal('bulan_03', 12, 2)->nullable();
            $table->decimal('bulan_04', 12, 2)->nullable();
            $table->decimal('bulan_05', 12, 2)->nullable();
            $table->decimal('bulan_06', 12, 2)->nullable();
            $table->decimal('bulan_07', 12, 2)->nullable();
            $table->decimal('bulan_08', 12, 2)->nullable();
            $table->decimal('bulan_09', 12, 2)->nullable();
            $table->decimal('bulan_10', 12, 2)->nullable();
            $table->decimal('bulan_11', 12, 2)->nullable();
            $table->decimal('bulan_12', 12, 2)->nullable();

            // Persentase = target berupa % pencapaian (mis. 100% matriks selesai)
            // Kumulatif Tahunan = target berupa jumlah kegiatan/tahun (mis. 3x walkthrough)
            // Rata-rata Bulanan = target berupa jumlah kegiatan PER BULAN (mis. 1x/bulan)
            $table->enum('tipe_capaian', ['Persentase', 'Kumulatif Tahunan', 'Rata-rata Bulanan'])->default('Kumulatif Tahunan');

            $table->boolean('aktif')->default(true);

            // Hanya dipakai untuk kegiatan berkala non-bulanan (mis. training 1x/tahun
            // yang baru "jatuh tempo" di bulan tertentu)
            $table->unsignedTinyInteger('bulan_mulai')->nullable();
            $table->unsignedTinyInteger('setiap_n_bulan')->nullable();

            $table->timestamps();

            $table->unique(['tahun', 'no_urut']);
            $table->index(['tahun', 'kategori', 'aktif']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leading_inputs');
    }
};
