<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Daftar 17 jenis APD -> tersimpan sbg enum WAJIB / KONDISIONAL / TIDAK
    public const APD_COLUMNS = [
        'helm_safety',
        'sepatu_safety',
        'rompi_hivis',
        'sarung_tangan_kulit',
        'kacamata_safety',
        'masker_n95',
        'masker_respirator',
        'earplug_earmuff',
        'full_body_harness',
        'wearpack',
        'scba',
        'pakaian_fr',
        'chemical_suit',
        'sarung_tangan_listrik',
        'face_shield',
        'kacamata_las',
        'knee_pad',
    ];

    public function up(): void
    {
        Schema::create('matriks_apd_jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ok')->index();
            $table->string('nama_pekerjaan');
            $table->string('jabatan_posisi');

            // WAJIB = ✅ | KONDISIONAL = ○ | TIDAK = -
            foreach (array_keys(\App\Models\MatriksApdJabatan::APD_COLUMNS) as $col) {
                $table->enum($col, ['WAJIB', 'KONDISIONAL', 'TIDAK'])->default('TIDAK');
            }

            $table->foreignId('hiradc_id')->nullable()->constrained('hiradcs')->nullOnDelete();
            $table->string('potensi_bahaya_aktivitas')->nullable();
            $table->string('jenis_bahaya')->nullable();
            $table->text('konsekuensi_dampak')->nullable();
            // $table->unsignedTinyInteger('l_awal')->nullable();
            // $table->unsignedTinyInteger('s_awal')->nullable();
            $table->text('pengendalian_eksisting')->nullable();
            $table->text('pengendalian_tambahan')->nullable();
            // $table->unsignedTinyInteger('l_res')->nullable();
            // $table->unsignedTinyInteger('s_res')->nullable();

            $table->string('pic')->nullable();
            // $table->enum('status', ['Open', 'Close'])->default('Open');
            $table->enum('tingkat_risiko_awal', ['RENDAH', 'SEDANG', 'TINGGI', 'EKSTRIM'])->nullable();
            $table->enum('tingkat_risiko_residual', ['RENDAH', 'SEDANG', 'TINGGI', 'EKSTRIM'])->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriks_apd_jabatans');
    }
};
