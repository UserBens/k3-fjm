<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hari_libur_nasionals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_libur', 255);
            // jenis: LIBUR_NASIONAL (hari merah resmi) atau CUTI_BERSAMA
            $table->enum('jenis', ['LIBUR_NASIONAL', 'CUTI_BERSAMA'])->default('LIBUR_NASIONAL');
            // kategori dipakai generator untuk tahu cara menghitung ulang tahun berikutnya
            $table->enum('kategori', [
                'MASEHI_TETAP',     // tanggal tetap tiap tahun (1 Jan, 1 Mei, dst)
                'PASKAH',           // dihitung dari Easter Sunday (Wafat Yesus, Paskah, Kenaikan Isa Almasih)
                'HIJRIAH',          // Idul Fitri, Idul Adha, Isra Mikraj, Maulid, Tahun Baru Islam — perlu SKB
                'IMLEK',            // Tahun Baru Imlek — perlu konfirmasi tahun berjalan
                'NYEPI',            // Hari Suci Nyepi (Saka) — perlu konfirmasi tahun berjalan
                'WAISAK',           // Hari Raya Waisak — perlu konfirmasi tahun berjalan
                'LAINNYA',
            ])->default('LAINNYA');
            $table->unsignedSmallInteger('tahun'); // tahun kalender Masehi acuan (mempermudah query per tahun)
            // sumber: AUTO = digenerate sistem, MANUAL = diinput admin (biasanya utk kategori berbasis SKB)
            $table->enum('sumber', ['AUTO', 'MANUAL'])->default('MANUAL');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['tanggal', 'nama_libur']);
            $table->index(['tahun', 'kategori']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hari_libur_nasionals');
    }
};
