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
        Schema::create('pengawas_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('id_api')->unique();     // id dari ERP
            $table->string('pengguna_id')->nullable()->index(); // → intra_users.id_api
            $table->string('pegawai_id')->nullable()->index();  // → pegawais.id_api
            $table->timestamp('last_sync')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengawas_pekerjaans');
    }
};
