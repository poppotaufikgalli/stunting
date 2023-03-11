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
        Schema::create('t_eppgbm', function (Blueprint $table) {
            $table->id();
            $table->string('nik',20)->nullable();
            $table->string('puskesmas', 100)->nullable();
            $table->string('posyandu', 100)->nullable();
            $table->string('usia_saat_ukur', 100)->nullable();
            $table->string('tgl_pengukuran', 15)->nullable();
            $table->string('berat', 15)->nullable();
            $table->string('tinggi', 15)->nullable();
            $table->string('lila', 15)->nullable();
            $table->string('bb_u',20)->nullable();
            $table->string('zz_bb_u',20)->nullable();
            $table->string('tb_u',20)->nullable();
            $table->string('zz_tb_u',20)->nullable();
            $table->string('bb_tb',20)->nullable();
            $table->string('zz_bb_tb',20)->nullable();
            $table->string('naik_berat_badan',3)->nullable();
            $table->string('pmt_diterima_kg')->default('-')->nullable();
            $table->string('jml_vit_a', 5)->nullable();
            $table->string('kpsp')->default('-')->nullable();
            $table->string('kia')->default('-')->nullable();
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
        Schema::dropIfExists('t_eppgbm');
    }
};
