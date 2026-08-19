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
        Schema::create('parameter_apd', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun_anggaran')->unique();

            $table->decimal('buffer_cadangan', 5, 2)->default(5.00); // % cadangan rusak/hilang di luar siklus
            $table->boolean('hitung_tanda_o')->default(false);       // YA = tanda O ikut dihitung sbg wajib
            $table->boolean('wajib_dasar_di_hijau')->default(true);  // YA = APD Wajib Dasar berlaku juga di zona HIJAU
            $table->boolean('pembulatan_kemasan')->default(true);    // YA = qty dibulatkan ke atas ikut isi kemasan
            $table->unsignedSmallInteger('hari_kerja_baku')->default(250);  // pola NON-SHIFT
            $table->unsignedSmallInteger('hari_kerja_shift')->default(365); // pola SHIFT
            $table->boolean('pakai_kontrak_dulu')->default(true);    // YA = RAB pakai hak kontrak dulu, K3 fallback

            $table->timestamps();
        });

        // ══════ B · BASIS FREKUENSI PENGGANTIAN (cara angka frekuensi dibaca) ══════
        Schema::create('parameter_apd_basis_frekuensi', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 30)->unique();       // MASA_PAKAI_BULAN, PER_HARI_KERJA, PER_SHIFT, TETAP_PER_TAHUN
            $table->string('basis_frekuensi');           // label tampil, mis. "MASA PAKAI (BULAN)"
            $table->string('rumus_per_tahun');            // mis. "12 ÷ nilai"
            $table->string('arti_nilai_basis');
            $table->string('contoh')->nullable();
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');
            $table->timestamps();
        });

        // ══════ B2 · SUMBER FREKUENSI (dari mana angka frekuensi berasal) ══════
        Schema::create('parameter_apd_sumber_frekuensi', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 30)->unique();        // KONTRAK, PABRIKAN, REGULASI, UJI_LAPANGAN, ASUMSI
            $table->string('sumber_frekuensi');
            $table->boolean('bisa_dipertahankan')->default(true); // TIDAK khusus utk ASUMSI
            $table->string('keterangan');
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');
            $table->timestamps();
        });

        // ══════ C · KONVERSI SIMBOL MATRIKS ══════
        Schema::create('parameter_apd_konversi_simbol', function (Blueprint $table) {
            $table->id();
            $table->string('simbol', 5)->unique();  // ✔ / O / –
            $table->unsignedTinyInteger('nilai');   // 1 / 1 / 0
            $table->string('keterangan');           // WAJIB / KONDISIONAL / Tidak diperlukan
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->timestamps();
        });

        // ══════ D · DAFTAR NILAI SAH (sumber dropdown, per kategori) ══════
        Schema::create('parameter_apd_nilai_dropdown', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 40); // ZONA, STATUS_KARYAWAN, STATUS_OK, KLASIFIKASI_OK, JENIS_NONRUTIN,
            // KONDISI_LIMBAH, KLAS_LIMBAH, SIFAT_PAKAI, TIPE_NONRUTIN, YA_TIDAK,
            // STATUS_ITEM, ANGKA_KATA
            $table->string('nilai');        // isi opsi dropdown, mis. "HIJAU", "AKTIF", dst
            $table->string('keterangan')->nullable(); // catatan opsional, mis. warna zona
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');
            $table->timestamps();

            $table->unique(['kategori', 'nilai']);
        });

        // ══════ E · JENIS TRANSAKSI 60_LOG_APD → ARAH STOK & STATUS LIMBAH ══════
        Schema::create('parameter_apd_jenis_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_transaksi')->unique(); // SERAH TERIMA BARU, PENGGANTIAN - RUSAK, dst
            $table->enum('arah_stok', ['KELUAR', 'MASUK', 'NETRAL']);
            $table->boolean('menjadi_limbah')->default(false);
            $table->string('keterangan');
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_apd_jenis_transaksi');
        Schema::dropIfExists('parameter_apd_nilai_dropdown');
        Schema::dropIfExists('parameter_apd_konversi_simbol');
        Schema::dropIfExists('parameter_apd_sumber_frekuensi');
        Schema::dropIfExists('parameter_apd_basis_frekuensi');
        Schema::dropIfExists('parameter_apd');
    }
};
