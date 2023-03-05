<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 't_proyek';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_proyek',
        'nib',
        'npwp_perusahaan',
        'nama_perusahaan',
        'uraian_status_penanaman_modal',
        'uraian_jenis_perusahaan',
        'uraian_risiko_proyek',
        'uraian_skala_usaha',
        'alamat_usaha',
        'kecamatan_usaha',
        'kelurahan_usaha',
        'longitude',
        'latitude',
        'kbli',
        'judul_kbli',
        'kl_sektor_pembina',
        'nama_user',
        'nomor_identitas_user',
        'email',
        'nomor_telp',
        'jumlah_investasi_1',
        'jumlah_investasi_2',
        'mesin_peralatan',
        'mesin_peralatan_impor',
        'pembelian_pematangan_tanah',
        'bangunan_gedung',
        'modal_kerja',
        'lain_lain',
        'jumlah_investasi_3',
        'tki',
        'nama_file_upload',
    ];
}
