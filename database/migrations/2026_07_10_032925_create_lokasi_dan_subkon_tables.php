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
        Schema::create('lokasi_dan_subkon_tables', function (Blueprint $table) {
            $table->id();
            // 1. Tabel Master Lokasi Kerja
            Schema::create('lokasi_kerjas', function (Blueprint $table) {
                $table->id();
                $table->string('id_api')->unique(); // Menyimpan 'id' dari API
                $table->string('nama_lokasi');
                $table->string('kode_lokasi')->nullable();
                $table->timestamps();
            });

            // 2. Tabel Master Subkon
            Schema::create('subkons', function (Blueprint $table) {
                $table->id();
                $table->string('id_api')->unique(); // Menyimpan 'id' dari API
                $table->string('nama_subkon');
                $table->string('kode_subkon')->nullable();
                $table->timestamps();
            });

            // 3. Tambahkan kolom perusahaan_subkonid ke tabel pegawais jika belum ada
            Schema::table('pegawais', function (Blueprint $table) {
                if (!Schema::hasColumn('pegawais', 'perusahaan_subkonid')) {
                    $table->string('perusahaan_subkonid')->nullable()->after('lokasi_kerjaid');
                }
            });
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn('perusahaan_subkonid');
        });
        Schema::dropIfExists('subkons');
        Schema::dropIfExists('lokasi_kerjas');
    }
};
