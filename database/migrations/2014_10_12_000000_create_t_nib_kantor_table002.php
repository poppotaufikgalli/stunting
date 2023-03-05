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
        Schema::create('t_nib_kantor', function (Blueprint $table) {
            $table->id();
            $table->string('nib')->unique();
            $table->string('day_of_tanggal_terbit_oss')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('status_penanaman_modal')->nullable();
            $table->string('uraian_jenis_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('email')->nullable();
            $table->string('nomor_telp')->nullable();
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
        Schema::dropIfExists('t_nib_kantor');
    }
};
