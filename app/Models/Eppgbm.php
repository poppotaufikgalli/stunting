<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eppgbm extends Model
{
    use HasFactory;

    protected $table = 't_eppgbm';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function balitas()
    {
        return $this->belongsTo(Balita::class, 'nik', 'nik');
    }

    protected $fillable = [
        'nik',
        'puskesmas',
        'posyandu',
        'usia_saat_ukur',
        'tgl_pengukuran',
        'berat',
        'tinggi',
        'lila',
        'bb_u',
        'zz_bb_u',
        'tb_u',
        'zz_tb_u',
        'bb_tb',
        'zz_bb_tb',
        'naik_berat_badan',
        'pmt_diterima_kg',
        'jml_vit_a',
        'kpsp',
        'kia',
        'nama_file_upload',
    ];
}
