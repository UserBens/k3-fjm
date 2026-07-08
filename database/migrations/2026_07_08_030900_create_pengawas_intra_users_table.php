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
        Schema::create('pengawas_intra_users', function (Blueprint $table) {
            $table->id();
            $table->string('id_api')->unique(); // id_intra_user dari ERP
            $table->string('username')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('role_user')->nullable();
            $table->text('kode_ok_tagihan')->nullable();
            $table->text('kode_ok_pekerjaan')->nullable();
            $table->text('unit_kerja_pekerjaan')->nullable();
            $table->text('unit_kerja_tagihan')->nullable();
            $table->timestamp('last_sync')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengawas_intra_users');
    }
};
