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
            $table->string('topik');

            $table->enum('prioritas', [
                'Tinggi',
                'Sedang',
                'Rendah'
            ]);

            $table->integer('peserta');

            $table->integer('durasi');

            $table->decimal('anggaran', 15, 2);

            $table->tinyInteger('bulan');

            $table->enum('status', [
                'Dijadwalkan',
                'Terlaksana',
                'Tertunda'
            ])->default('Dijadwalkan');

            $table->text('keterangan')->nullable();
            $table->timestamps();
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
