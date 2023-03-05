<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TBalita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_balita', function (Blueprint $table) {
            $table->id();
            $table->integer('nik')->nullable();
            $table->text('nama');
            $table->string('jk',3);
            $table->date('tgl_lahir')->nullable();
            $table->decimal('bb_lahir')->nullable();
            $table->decimal('tb_lahir')->nullable();
            $table->text('nama_ortu')->nullable();
            $table->string('prov', 100)->nullable();
            $table->string('kab_kota', 100)->nullable();
            $table->string('kec', 100)->nullable();
            $table->string('puskesmas', 100)->nullable();
            $table->string('desa_kel', 100)->nullable();
            $table->string('posyandu', 100)->nullable();
            $table->integer('rt')->default(0);
            $table->integer('rw')->default(0);
            $table->text('alamat')->nullable();
            $table->string('usia_saat_ukur', 100)->nullable();
            $table->date('tgl_pengukuran')->nullable();
            $table->decimal('berat')->nullable();
            $table->decimal('tinggi')->nullable();
            $table->decimal('lila');
            $table->string('bb_u',20)->nullable();
            $table->string('zz_bb_u',20)->nullable();
            $table->string('tb_u',20)->nullable();
            $table->string('zz_tb_u',20)->nullable();
            $table->string('bb_tb',20)->nullable();
            $table->string('zz_bb_tb',20)->nullable();
            $table->string('naik_berat_badan',3)->nullable();
            $table->string('pmt_diterima_kg')->default('-');
            $table->integer('jml_vit_a')->default(0);
            $table->string('kpsp')->default('-');
            $table->string('kia')->default('-');
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
        Schema::dropIfExists('t_balita');
    }
}
