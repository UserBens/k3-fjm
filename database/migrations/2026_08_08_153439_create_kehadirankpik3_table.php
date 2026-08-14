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
            Schema::create('kehadirankpik3', function (Blueprint $table) {
                $table->id();
                $table->string('badge'); // → safety_officers.badge
                $table->unsignedSmallInteger('tahun_aktif');
                $table->unsignedTinyInteger('bulan_aktif');

                $table->unsignedTinyInteger('hari_cuti_izin_sakit_alfa')->default(0);
                $table->unsignedTinyInteger('hari_standby')->default(0); // standby = gantikan personil lain

                $table->string('catatan')->nullable();
                $table->timestamps();

                $table->unique(['badge', 'tahun_aktif', 'bulan_aktif'], 'kehadiran_periode_unique');
                $table->foreign('badge')->references('badge')->on('safety_officers')->onDelete('cascade');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirankpik3');
    }
};
