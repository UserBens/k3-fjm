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
        Schema::create('safety_officers', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->unique(); // → pegawais.badge
            $table->timestamp('assigned_at')->nullable();
            $table->string('assigned_by')->nullable(); // 'system:sync' atau nama admin jika manual
            $table->boolean('is_active')->default(true); // biar bisa nonaktifkan SO tanpa hapus histori
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_officers');
    }
};
