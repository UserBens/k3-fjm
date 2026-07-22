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
        Schema::create('permintaan_pembelian_items', function (Blueprint $table) {
           $table->id();
            $table->foreignId('permintaan_pembelian_id')
                ->constrained('permintaan_pembelians')
                ->cascadeOnDelete();
 
            $table->string('nama_apd');           // contoh: Helm Krisbow + Tali Dagu
            $table->unsignedInteger('qty_permintaan')->default(0);
            $table->unsignedInteger('qty_datang')->default(0);
            $table->date('tanggal_datang')->nullable();
            $table->text('keterangan')->nullable(); // contoh: "Tali Helm Kurang 17", "KURANG", "Belum Datang"
 
            $table->timestamps();
 
            $table->index('nama_apd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_pembelian_items');
    }
};
