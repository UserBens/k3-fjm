<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akses_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('nama_lengkap')->nullable();
            $table->boolean('is_active')->default(false);   // boleh login atau tidak
            $table->boolean('is_admin')->default(false);    // boleh kelola halaman aktivasi atau tidak
            $table->string('activated_by')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
        });

        // Seed 4 username awal sebagai admin sekaligus sudah aktif
        DB::table('akses_users')->insert([
            ['username' => 'T.24029',  'is_active' => true, 'is_admin' => true, 'activated_by' => 'system', 'activated_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'K.26301',  'is_active' => true, 'is_admin' => true, 'activated_by' => 'system', 'activated_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'T.23020',  'is_active' => true, 'is_admin' => true, 'activated_by' => 'system', 'activated_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'K.230140', 'is_active' => true, 'is_admin' => true, 'activated_by' => 'system', 'activated_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_users');
    }
};
