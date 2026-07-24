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
        Schema::create('lpi_korban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kejadian_id')->constrained('lpi_kejadian')->cascadeOnDelete();

            $table->string('klasifikasi_insiden', 50)->nullable();

            // Saksi
            $table->string('badge_saksi_karyawan_fjm', 50)->nullable();
            $table->string('nama_saksi_karyawan_fjm', 255)->nullable();
            $table->string('nama_saksi_karyawan_non_fjm', 255)->nullable();

            // Data korban
            $table->string('pt_asal_korban', 150)->nullable();
            $table->string('badge_korban', 50)->nullable();
            $table->string('nama_korban', 255)->nullable();
            $table->text('alamat')->nullable();
            $table->string('jenis_kelamin', 5)->nullable(); // L / P
            $table->unsignedTinyInteger('usia')->nullable();
            $table->string('masa_kerja', 50)->nullable();
            $table->string('shift', 20)->nullable();
            $table->string('departemen', 150)->nullable();
            $table->string('unit_kerja', 150)->nullable();
            $table->string('jabatan', 150)->nullable();
            $table->string('kode_ok', 50)->nullable();
            $table->text('uraian_pekerjaan')->nullable();

            // Jenis & alat
            $table->string('jenis_insiden', 100)->nullable();
            $table->text('penjelasan_jenis_insiden')->nullable();
            $table->string('keterlibatan_alat', 150)->nullable();
            $table->string('keterangan_alat_lain', 255)->nullable();
            $table->string('nomor_alat', 100)->nullable();
            $table->string('status_milik_alat_unit', 100)->nullable();

            // Analisis sebab — Unsafe Action
            $table->text('tindakan_tidak_aman')->nullable();
            $table->text('ua_sebab_1')->nullable();
            $table->text('ua_sebab_2')->nullable();
            $table->text('ua_sebab_3')->nullable();

            // Analisis sebab — Unsafe Condition
            $table->text('kondisi_tidak_aman')->nullable();
            $table->text('uc_sebab_1')->nullable();
            $table->text('uc_sebab_2')->nullable();
            $table->text('uc_sebab_3')->nullable();

            // Faktor Pribadi
            $table->text('faktor_pribadi')->nullable();
            $table->text('fp_sebab_1')->nullable();
            $table->text('fp_sebab_2')->nullable();
            $table->text('fp_sebab_3')->nullable();

            // Faktor Pekerjaan
            $table->text('faktor_pekerjaan')->nullable();
            $table->text('fk_sebab_1')->nullable();
            $table->text('fk_sebab_2')->nullable();
            $table->text('fk_sebab_3')->nullable();

            // Sistem manajemen
            $table->text('sistem_manajemen_terkait')->nullable();
            $table->text('deskripsi_kegagalan_sistem')->nullable();
            $table->text('penyebab_kegagalan_sistem')->nullable();
            $table->text('sebab_sebab_teridentifikasi')->nullable();

            // Pengendalian risiko
            $table->string('pengendalian_risiko', 150)->nullable();
            $table->text('penjelasan_pengendalian_risiko')->nullable();

            // Cidera & medis
            $table->string('rincian_cidera', 150)->nullable();
            $table->decimal('persentase_luka_bakar', 5, 2)->nullable();
            $table->text('keterangan_detail_cidera')->nullable();
            $table->string('kategori_penanganan_medis', 100)->nullable();
            $table->text('keterangan_penanganan_medis')->nullable();
            $table->string('nama_dokter', 150)->nullable();
            $table->unsignedInteger('total_hari_kerja_hilang')->nullable();
            $table->decimal('nominal_biaya_medis', 15, 2)->nullable();
            $table->string('penjamin_platform', 100)->nullable();

            $table->timestamps();

            $table->index('badge_korban');
            $table->index('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpi_korban');
    }
};
