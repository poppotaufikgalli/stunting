<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 't_izin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_permohonan_izin',
        'nama_perusahaan',
        'nib',
        'day_of_tanggal_terbit_oss',
        'uraian_status_penanaman_modal',
        'propinsi',
        'kab_kota',
        'kd_resiko',
        'kbli',
        'day_of_tgl_izin',
        'uraian_jenis_perizinan',
        'nama_dokumen',
        'uraian_kewenangan',
        'uraian_status_respon',
        'kewenangan',
        'nama_file_upload',
    ];
}
