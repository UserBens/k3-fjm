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
            $table->string('kode_ok')->unique();
            $table->string('uraian_kode_ok')->nullable();
            $table->boolean('is_active')->default(true);
            // true = dibuat/di-edit manual oleh user lewat halaman, false = murni hasil sync
            $table->boolean('is_manual')->default(false);
            $table->timestamp('last_sync')->nullable();
            $table->timestamps();
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
