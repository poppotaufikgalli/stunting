<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('id_proyek')->unique();
            $table->string('nib');
            $table->string('npwp_perusahaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('uraian_status_penanaman_modal')->nullable();
            $table->string('uraian_jenis_perusahaan')->nullable();
            $table->string('uraian_risiko_proyek')->nullable();
            $table->string('uraian_skala_usaha')->nullable();
            $table->string('alamat_usaha')->nullable();
            $table->string('kecamatan_usaha')->nullable();
            $table->string('kelurahan_usaha')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('kbli')->nullable();
            $table->string('judul_kbli')->nullable();
            $table->string('kl_sektor_pembina')->nullable();
            $table->string('nama_user')->nullable();
            $table->string('nomor_identitas_user')->nullable();
            $table->string('email')->nullable();
            $table->string('nomor_telp')->nullable();
            $table->string('jumlah_investasi_1')->nullable();
            $table->string('jumlah_investasi_2')->nullable();
            $table->string('mesin_peralatan')->nullable();
            $table->string('mesin_peralatan_impor')->nullable();
            $table->string('pembelian_pematangan_tanah')->nullable();
            $table->string('bangunan_gedung')->nullable();
            $table->string('modal_kerja')->nullable();
            $table->string('lain_lain')->nullable();
            $table->string('jumlah_investasi_3')->nullable();
            $table->string('tki')->nullable();
            $table->string('nama_file_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_proyek');
    }
};
