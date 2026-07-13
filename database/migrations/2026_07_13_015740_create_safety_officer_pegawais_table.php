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
        Schema::create('safety_officer_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('badge_safety_officer')->index(); // → pegawais.badge (yang berstatus SO)
            $table->string('pegawai_id')->index();            // → pegawais.id_api (tenaga binaan)
            $table->string('assigned_by')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_officer_pegawais');
    }
};
