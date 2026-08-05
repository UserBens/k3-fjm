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
        // ── Header dokumen HIRADC ──────────────────────────────
        Schema::create('hiradc', function (Blueprint $table) {
            $table->id(); // INI YANG KURANG: Menambahkan Primary Key 'id'

            $table->string('departemen');
            $table->string('area_kerja')->nullable();
            $table->string('sub_area')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kualifikasi')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->foreignId('kode_ok_id')->nullable()
                ->constrained('kode_oks')->nullOnDelete();
            $table->string('no_hiradc')->nullable()->index();
            $table->date('tanggal')->nullable();

            // ── Dokumen HIRADC (upload file) ──────────────────
            $table->string('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiradc');
    }
};
