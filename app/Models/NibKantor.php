<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NibKantor extends Model
{
    use HasFactory;

    protected $table = 't_nib_kantor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nib',
        'day_of_tanggal_terbit_oss',
        'nama_perusahaan',
        'status_penanaman_modal',
        'uraian_jenis_perusahaan',
        'alamat_perusahaan',
        'kab_kota',
        'email',
        'nomor_telp',
        'nama_file_upload',
    ];
}
