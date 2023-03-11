<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $table = 't_balita';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nama',
        'jk',
        'tgl_lahir',
        'bb_lahir',
        'tb_lahir',
        'nama_ortu',
        'prov',
        'kab_kota',
        'kec',
        'desa_kel',
        'rt',
        'rw',
        'alamat',
        'nama_file_upload',
    ];
}
