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
        Schema::create('t_izin', function (Blueprint $table) {
            $table->id();
            $table->string('id_permohonan_izin')->unique();
            $table->string('nama_perusahaan');
            $table->string('nib');
            $table->string('day_of_tanggal_terbit_oss')->nullable();
            $table->string('uraian_status_penanaman_modal')->nullable();
            $table->string('propinsi')->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('kd_resiko')->nullable();
            $table->string('kbli')->nullable();
            $table->string('day_of_tgl_izin')->nullable();
            $table->string('uraian_jenis_perizinan')->nullable();
            $table->string('nama_dokumen')->nullable();
            $table->string('uraian_kewenangan')->nullable();
            $table->string('uraian_status_respon')->nullable();
            $table->string('kewenangan')->nullable();
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
        Schema::dropIfExists('t_izin');
    }
};
