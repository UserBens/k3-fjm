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
        Schema::create('kode_ok_referensi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ok')->unique();
            $table->text('uraian_pekerjaan');
            $table->string('kategori_pekerjaan')->nullable();
            $table->timestamps();

            $table->text('dept_unit_kerja_pic')->nullable();
            $table->index(['kategori_pekerjaan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_ok_referensi');
    }
};
