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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();

            // --- Identitas & sinkronisasi ERP ---
            $table->string('id_api')->unique()->nullable();
            $table->string('badge', 50)->unique()->nullable();
            $table->string('no_ktp', 50)->nullable();
            $table->string('nama', 255);
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('unit_kerjaid')->nullable();
            $table->string('lokasi_kerjaid')->nullable();
            $table->string('kualifikasiid')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_safety_officer')->default(false);
            $table->timestamp('safety_officer_since')->nullable();
            $table->boolean('is_pengawas')->default(false);
            $table->timestamp('pengawas_since')->nullable();

            // --- Data pribadi ---
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_bpjs_kesehatan', 50)->nullable();
            $table->string('no_bpjs_ketenagakerjaan', 50)->nullable();
            $table->string('kode_ok', 50)->nullable();
            $table->string('nomor_ok', 100)->nullable();

            // --- KIB ---
            $table->string('nomor_kib', 100)->nullable();
            $table->string('status_kib', 50)->nullable();
            $table->date('masa_berlaku_kib')->nullable();
            $table->string('gambar_kib')->nullable();
            $table->string('zonasi', 100)->nullable();

            // --- Audit trail ---
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            // --- Kepegawaian / status ---
            $table->string('golongan', 50)->nullable();
            $table->string('pangkat', 50)->nullable();
            $table->string('status_pegawai', 50)->nullable();
            $table->string('jenis_pegawai', 50)->nullable();
            $table->string('kelompok_tenagaid')->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->string('hp', 30)->nullable();
            $table->string('status_nikah', 30)->nullable();

            // --- Penggajian ---
            $table->boolean('is_100_persen')->default(false);
            $table->string('no_rekening', 50)->nullable();
            $table->string('bank', 100)->nullable();
            $table->string('bankid_bank')->nullable();
            $table->string('no_gaji', 50)->nullable();
            $table->string('nama_di_rekening', 255)->nullable();
            $table->string('tarif_upahid')->nullable();
            $table->string('npwp', 50)->nullable();
            $table->unsignedTinyInteger('tanggal_pembayaran')->nullable();

            // --- Alamat tambahan ---
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kotaid_kota')->nullable();

            // --- Kode OK / uraian ---
            $table->string('uraian_kode_ok', 255)->nullable();
            $table->text('uraian_nomor_ok')->nullable();

            // --- Masa kerja / kontrak ---
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_kontrak_awal')->nullable();
            $table->date('tanggal_kontrak_akhir')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('jenis_keluar', 100)->nullable();
            $table->string('jenis_keluar_lainnya', 255)->nullable();
            $table->date('tanggal_exit_clearence')->nullable();
            $table->text('keterangan_pegawai')->nullable();

            // --- Shift ---
            $table->boolean('is_shift')->default(false);
            $table->string('shift_grup', 100)->nullable();
            $table->string('shift_lokasi', 100)->nullable();
            $table->boolean('is_shift_dibayar')->default(false);
            $table->time('jam_masuk_standar')->nullable();
            $table->time('jam_pulang_standar')->nullable();

            // --- Lain-lain ---
            $table->string('perusahaan_subkonid')->nullable();
            $table->string('tali_asihid')->nullable();
            $table->boolean('is_pph21')->default(false);
            $table->string('coa', 100)->nullable();
            $table->string('no_parklaring', 100)->nullable();

            // --- Sinkronisasi & timestamps ---
            $table->timestamp('last_sync')->nullable();
            $table->timestamps();
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
