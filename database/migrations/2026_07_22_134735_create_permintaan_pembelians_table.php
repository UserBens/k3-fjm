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
        Schema::create('permintaan_pembelians', function (Blueprint $table) {
              $table->id();
            $table->string('no_pp')->unique(); // contoh: 17/I/PP/2026
            $table->date('tanggal_pp');
            $table->string('unit_kerja')->nullable();
            $table->string('diminta_oleh')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
 
            $table->index('tanggal_pp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_pembelians');
    }
};
