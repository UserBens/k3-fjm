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
        Schema::create('lpi_kejadian', function (Blueprint $table) {
            $table->id();
            $table->string('id_lpi', 100)->unique();
            $table->string('owner_user', 255)->nullable();
            $table->date('tanggal_insiden')->nullable();
            $table->string('hari_insiden', 20)->nullable();
            $table->time('jam_insiden')->nullable();
            $table->string('jam_insiden_shift', 20)->nullable();

            $table->string('zona_lokasi_insiden', 150)->nullable();
            $table->string('sub_lokasi_insiden', 150)->nullable();
            $table->string('detail_lokasi_insiden', 255)->nullable();
            $table->text('uraian_kejadian')->nullable();

            $table->string('evidence_1_path')->nullable();
            $table->string('evidence_2_path')->nullable();
            $table->string('evidence_3_path')->nullable();
            $table->string('evidence_4_path')->nullable();
            $table->string('evidence_5_path')->nullable();
            $table->string('lampiran_dokumen_path')->nullable();

            $table->decimal('nominal_kerugian_material', 15, 2)->nullable();
            $table->decimal('total_cost_lost', 15, 2)->nullable();

            $table->text('pica_tindakan_perbaikan')->nullable();
            $table->string('pica_pic_bertanggung_jawab', 255)->nullable();
            $table->date('pica_due_date')->nullable();

            $table->string('tingkat_risiko', 20)->nullable(); // LOW / MEDIUM / HIGH
            $table->text('hasil_investigasi_root_cause')->nullable();

            $table->string('status_penyelesaian_lpi', 20)->default('OPEN'); // OPEN / CLOSE
            $table->string('status_pelaporan_lpi', 30)->nullable(); // USER/OWNER, dsb

            $table->timestamps();

            $table->index('tanggal_insiden');
            $table->index('status_penyelesaian_lpi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpi_kejadian');
    }
};
