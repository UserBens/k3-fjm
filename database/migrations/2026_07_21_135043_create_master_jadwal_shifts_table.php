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
        Schema::create('master_jadwal_shifts', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();

            $table->char('shift_a', 1)->nullable()->comment('P/S/M/O');
            $table->unsignedTinyInteger('jam_a')->default(0);

            $table->char('shift_b', 1)->nullable()->comment('P/S/M/O');
            $table->unsignedTinyInteger('jam_b')->default(0);

            $table->char('shift_c', 1)->nullable()->comment('P/S/M/O');
            $table->unsignedTinyInteger('jam_c')->default(0);

            $table->char('shift_d', 1)->nullable()->comment('P/S/M/O');
            $table->unsignedTinyInteger('jam_d')->default(0);

            $table->unsignedTinyInteger('jam_nd')->default(0);
            $table->string('keterangan', 255)->nullable();

            $table->timestamps();

            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jadwal_shifts');
    }
};
