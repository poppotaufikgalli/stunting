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
        Schema::create('t_balita', function (Blueprint $table) {
            $table->id();
            $table->string('nik',20)->nullable();
            $table->text('nama');
            $table->string('jk',3);
            $table->string('tgl_lahir',15)->nullable();
            $table->string('bb_lahir', 15)->nullable();
            $table->string('tb_lahir', 15)->nullable();
            $table->text('nama_ortu')->nullable();
            $table->string('prov', 100)->nullable();
            $table->string('kab_kota', 100)->nullable();
            $table->string('kec', 100)->nullable();
            $table->string('desa_kel', 100)->nullable();
            $table->string('rt', 5)->default(0)->nullable();
            $table->string('rw', 5)->default(0)->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('t_balita');
    }
};
