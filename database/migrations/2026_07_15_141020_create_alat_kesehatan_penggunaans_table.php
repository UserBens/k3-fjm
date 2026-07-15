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
        Schema::create('alat_kesehatan_penggunaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_alkes_id')
                ->constrained('stok_alkes')
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->string('id_karyawan', 50);

            $table->string('nama_pengguna');

            $table->string('jabatan')->nullable();

            $table->string('unit_kerja')->nullable();

            $table->unsignedInteger('jumlah_digunakan')->default(1);

            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_kesehatan_penggunaans');
    }
};
