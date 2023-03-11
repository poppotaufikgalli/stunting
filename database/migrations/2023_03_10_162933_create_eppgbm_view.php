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
        \DB::statement("
            CREATE VIEW v_eppgbm_kec_kel 
            AS
            SELECT
                t_balita.kec,
                t_balita.desa_kel,
                count(*) as jml,
                SUM(case when t_balita.jk = 'L' then 1 else 0 end) as L,
                SUM(case when t_balita.jk = 'P' then 1 else 0 end) as P
            FROM
                t_balita
                JOIN t_eppgbm ON t_balita.nik = t_eppgbm.nik
            GROUP BY
                t_balita.kec,
                t_balita.desa_kel
            ORDER BY
                t_balita.kec,
                t_balita.desa_kel
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('eppgbm_view');
    }
};
