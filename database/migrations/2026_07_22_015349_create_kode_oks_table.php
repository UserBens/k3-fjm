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
        Schema::create('kode_oks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kode_ok')->unique()->comment('Nomor/kode OK dari sumber SIFO');
            $table->string('pengawas')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->text('uraian_pekerjaan')->nullable();
            $table->boolean('status')->default(true)->comment('1 = aktif, 0 = nonaktif');
            $table->timestamp('synced_at')->nullable()->comment('Waktu terakhir data ini ditarik dari sumber sync');
            $table->timestamps();

            $table->index('unit_kerja');
            $table->index('pengawas');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_oks');
    }
};
