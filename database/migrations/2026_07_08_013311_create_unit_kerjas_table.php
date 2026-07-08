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
        Schema::create('unit_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('id_api')->unique(); // simpan UUID dari SIFO (kolom "id" di sana)
            $table->string('nama_unit_kerja')->nullable();
            $table->string('bagian')->nullable();
            $table->string('kode_unit_kerja')->nullable();
            $table->boolean('is_active')->default(true);
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerjas');
    }
};
