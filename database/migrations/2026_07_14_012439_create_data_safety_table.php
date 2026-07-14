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
        Schema::create('data_safety', function (Blueprint $table) {
            $table->id();
            // ── Data Umum ──
            $table->timestamp('waktu_submit')->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->string('badge_tenaga', 50)->nullable();
            $table->string('nama_tenaga', 255)->nullable();
            $table->string('area_kerja', 150)->nullable();
            $table->string('unit_kerja', 150)->nullable();
            $table->string('jenis_aktifitas_kpi', 150)->nullable();

            // ── [C.1] Inspeksi Peralatan ──
            $table->string('kategori_peralatan', 100)->nullable();
            $table->string('nama_alat', 150)->nullable();
            $table->string('nomor_seri_alat', 150)->nullable();
            $table->string('status_alat', 50)->nullable();
            $table->text('keterangan_tambahan_alat')->nullable();
            $table->text('rekomendasi_tindakan_alat')->nullable();
            $table->string('foto_alat_path')->nullable();
            $table->string('formulir_inspeksi_peralatan_path')->nullable();
            $table->string('formulir_kegiatan_inspeksi_peralatan_path')->nullable();

            // ── Item Temuan / Inspeksi Area Kerja ──
            $table->text('item_temuan')->nullable();
            $table->string('jenis_penyebab', 150)->nullable();
            $table->text('deskripsi_temuan')->nullable();
            $table->text('rekomendasi_tindakan_temuan')->nullable();
            $table->string('status_temuan', 50)->nullable();
            $table->string('foto_temuan_uauc_path')->nullable();
            $table->string('formulir_kegiatan_inspeksi_area_kerja_path')->nullable();

            // ── OBSERI ──
            $table->string('nama_subject_observasi', 255)->nullable();
            $table->text('proses_kerja')->nullable();
            $table->string('formulir_observi_path')->nullable();
            $table->string('formulir_kegiatan_observi_path')->nullable();

            // ── Safety Permit ──
            $table->text('pekerjaan_dikerjakan')->nullable();
            $table->string('safety_permit_path')->nullable();
            $table->string('formulir_kegiatan_verifikasi_safety_permit_path')->nullable();

            // ── Nearmiss ──
            $table->text('keterangan_bahaya_nearmiss')->nullable();
            $table->string('foto_temuan_bahaya_nearmiss_path')->nullable();

            // ── Safety Briefing ──
            $table->string('foto_pelaksanaan_safety_briefing_path')->nullable();
            $table->string('foto_daftar_hadir_briefing_path')->nullable();
            $table->string('formulir_kegiatan_safety_briefing_path')->nullable();

            // ── Reward / Punishment ──
            $table->string('nama_penerima', 255)->nullable();
            $table->string('jenis_tindakan', 100)->nullable();
            $table->text('alasan_pemberian')->nullable();
            $table->string('foto_evidence_reward_path')->nullable();
            $table->string('formulir_kegiatan_reward_path')->nullable();

            // ── Sosialisasi Keselamatan Kerja ──
            $table->text('materi_sosialisasi_keselamatan')->nullable();
            $table->string('foto_kegiatan_sosialisasi_keselamatan_path')->nullable();
            $table->string('formulir_presensi_sosialisasi_keselamatan_path')->nullable();
            $table->string('formulir_kegiatan_sosialisasi_keselamatan_path')->nullable();

            // ── DCU (kegiatan, bukan modul data-dcu) ──
            $table->string('foto_kegiatan_dcu_path')->nullable();
            $table->string('formulir_hasil_pemeriksaan_dcu_path')->nullable();
            $table->string('formulir_kegiatan_pemeriksaan_dcu_path')->nullable();

            // ── Bugar Sehat ──
            $table->string('foto_kegiatan_bugar_sehat_path')->nullable();
            $table->string('formulir_presensi_bugar_sehat_path')->nullable();
            $table->string('formulir_kegiatan_bugar_sehat_path')->nullable();

            // ── Romberg Test (Tes Keseimbangan) ──
            $table->string('nama_pekerja_romberg', 255)->nullable();
            $table->string('foto_kegiatan_tes_keseimbangan_path')->nullable();
            $table->string('formulir_hasil_pemeriksaan_romberg_path')->nullable();
            $table->string('formulir_kegiatan_tes_keseimbangan_path')->nullable();

            // ── Sosialisasi Kesehatan Kerja ──
            $table->text('materi_sosialisasi_kesehatan')->nullable();
            $table->string('foto_kegiatan_sosialisasi_kesehatan_path')->nullable();
            $table->string('formulir_presensi_sosialisasi_kesehatan_path')->nullable();
            $table->string('formulir_kegiatan_sosialisasi_kesehatan_path')->nullable();

            // ── P3K ──
            $table->string('kelas_kotak_p3k', 50)->nullable();
            $table->string('kesesuaian_isi_p3k_path')->nullable();
            $table->string('formulir_kegiatan_inspeksi_p3k_path')->nullable();

            // ── Status & Arsip ──
            $table->string('status_pindah', 30)->default('PENDING');
            $table->string('arsip_path')->nullable();
            $table->string('keputusan', 30)->default('PENDING');
            $table->string('indikasi_duplikat', 20)->nullable();

            $table->timestamps();

            $table->index('badge_tenaga');
            $table->index('tanggal_pelaksanaan');
            $table->index('jenis_aktifitas_kpi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_safety');
    }
};
