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
        Schema::create('do_upload_file', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nama_user');
            $table->string('nama_file');
            $table->string('nama_target_table');
            $table->integer('jumlah_row')->nullable();
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
        Schema::dropIfExists('do_upload_file');
    }
};
