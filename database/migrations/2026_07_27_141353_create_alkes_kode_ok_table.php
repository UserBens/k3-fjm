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
        Schema::create('alkes_kode_ok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_alkes_id')->constrained('stok_alkes')->cascadeOnDelete();
            $table->foreignId('kode_ok_id')->constrained('kode_oks')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['stok_alkes_id', 'kode_ok_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alkes_kode_ok');
    }
};
