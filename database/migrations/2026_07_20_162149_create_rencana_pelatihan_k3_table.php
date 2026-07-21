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
        Schema::create('rencana_pelatihan_k3', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tahun')->default(date('Y'));
            $table->string('topik_pelatihan');
            $table->enum('prioritas', ['Tinggi', 'Sedang', 'Rendah'])->default('Sedang');
            $table->string('peserta_estimasi')->nullable(); // free text: "50 org", "Semua Baru", "Semua"
            $table->unsignedInteger('durasi_jam')->nullable();
            $table->decimal('anggaran_estimasi', 15, 2)->default(0);

            // Jadwal per periode: jan, feb, mar, apr, mei, jun, jul, ags, sep_des
            // Tiap key bernilai null | 'terlaksana' | 'dijadwalkan' | 'tertunda'
            $table->json('jadwal')->nullable();

            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index(['tahun', 'prioritas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_pelatihan_k3');
    }
};
