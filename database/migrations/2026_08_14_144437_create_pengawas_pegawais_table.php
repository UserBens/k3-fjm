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
        Schema::create('pengawas_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('badge_pengawas')->index(); // → pegawais.badge (yang berstatus Pengawas)
            $table->string('pegawai_id')->index();      // → pegawais.id_api (tenaga binaan)
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
        Schema::dropIfExists('pengawas_pegawais');
    }
};
