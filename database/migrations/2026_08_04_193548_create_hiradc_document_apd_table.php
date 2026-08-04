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
        Schema::create('hiradc_document_apd', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hiradc_document_id')
                ->constrained('hiradc') // ← merujuk ke tabel hiradc, BUKAN hiradc_documents
                ->cascadeOnDelete();

            $table->foreignId('stok_apd_id')
                ->constrained('stok_apd')
                ->cascadeOnDelete();

            $table->timestamps();

            // Cegah duplikasi pasangan hiradc + apd yang sama
            $table->unique(['hiradc_document_id', 'stok_apd_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiradc_document_apd');
    }
};
