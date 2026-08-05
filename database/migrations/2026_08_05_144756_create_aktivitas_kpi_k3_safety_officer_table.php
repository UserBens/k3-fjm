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
        Schema::create('aktivitas_kpi_k3_safety_officer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aktivitas_kpi_k3_id')
                ->constrained('aktivitas_kpi_k3')
                ->onDelete('cascade');
            $table->string('badge_safety_officer'); // → safety_officers.badge
            $table->timestamps();

            $table->unique(['aktivitas_kpi_k3_id', 'badge_safety_officer'], 'aktivitas_so_unique');
            $table->foreign('badge_safety_officer')
                ->references('badge')
                ->on('safety_officers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_kpi_k3_safety_officer');
    }
};
