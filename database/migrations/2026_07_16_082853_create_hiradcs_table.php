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
        Schema::create('hiradc_documents', function (Blueprint $table) {
            $table->id();
            $table->string('departemen');
            $table->string('area_kerja')->nullable();
            $table->string('sub_area')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kualifikasi')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->foreignId('kode_ok_id')->nullable()
                ->constrained('kode_oks')->nullOnDelete(); // ← baru
            $table->string('no_hiradc')->nullable()->index();
            $table->string('revisi')->nullable();
            $table->date('tanggal')->nullable();

            // Disiapkan / Diperiksa / Disahkan oleh (nama, paraf, tanggal)
            $table->string('disiapkan_nama')->nullable();
            $table->string('disiapkan_paraf')->nullable();
            $table->date('disiapkan_tanggal')->nullable();
            $table->string('disiapkan_ttd')->nullable();

            $table->string('diperiksa_nama')->nullable();
            $table->string('diperiksa_paraf')->nullable();
            $table->date('diperiksa_tanggal')->nullable();
            $table->string('diperiksa_ttd')->nullable();

            $table->string('disahkan_nama')->nullable();
            $table->string('disahkan_paraf')->nullable();
            $table->date('disahkan_tanggal')->nullable();
            $table->string('disahkan_ttd')->nullable();

            // Tambahkan di dalam Schema::create/table('hiradc_documents', ...)
            $table->string('status')->default('draft'); // draft, diperiksa, disahkan
            $table->string('diperiksa_badge')->nullable();
            $table->string('disahkan_badge')->nullable();

            $table->string('dokumen')->nullable();        // path PDF pendukung (opsional)
            $table->string('dokumen_hiradc')->nullable(); // nama file asli

            $table->timestamps();
        });

        // ── Grup/section aktivitas, berjenjang (self-reference) ─
        Schema::create('hiradc_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hiradc_document_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()
                ->constrained('hiradc_groups')->cascadeOnDelete();
            $table->string('nama'); // "Persiapan Pekerjaan", "Cleaning GBB A", "Cleaning Koridor Gudang A"
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // ── Item = satu baris "NO" (satu aktivitas) ─────────────
        Schema::create('hiradc_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hiradc_group_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('no')->nullable(); // nomor urut tampilan
            $table->text('aktivitas'); // kolom "AKTIVITAS (ACTIVITY)"
            $table->text('kesimpulan_apd')->nullable(); // KESIMPULAN KEBUTUHAN APD
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        // ── Hazard = detail baris di bawah satu item ────────────
        Schema::create('hiradc_hazards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hiradc_item_id')->constrained()->cascadeOnDelete();

            $table->string('hazard_register')->nullable();     // Mechanical, Enviromental, Physical, dst
            $table->string('sub_hazard_register')->nullable(); // Benda tajam, Lainnya, Terpeleset, dst
            $table->enum('na_e', ['N', 'A', 'E'])->nullable();

            $table->text('deskripsi')->nullable();  // IDENTIFIKASI RISIKO - deskripsi
            $table->string('dampak_kategori')->nullable();
            $table->string('detail')->nullable();

            // Risiko Awal (Inherent)
            $table->unsignedTinyInteger('l_awal')->nullable();
            $table->unsignedTinyInteger('c_awal')->nullable();

            $table->text('pengendalian_existing')->nullable();

            // Risiko Sisa (Residual)
            $table->unsignedTinyInteger('l_sisa')->nullable();
            $table->unsignedTinyInteger('c_sisa')->nullable();

            $table->enum('r_o', ['R', 'O'])->nullable(); // Risk / Opportunity
            $table->text('additional_control')->nullable();

            $table->string('pic')->nullable();
            $table->date('due_date')->nullable();

            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('hiradc_document_apd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hiradc_document_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stok_apd_id')->constrained('stok_apd')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['hiradc_document_id', 'stok_apd_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiradc_hazards');
        Schema::dropIfExists('hiradc_items');
        Schema::dropIfExists('hiradc_groups');
        Schema::dropIfExists('hiradc_documents');
        Schema::dropIfExists('hiradc_document_apd');
    }
};
