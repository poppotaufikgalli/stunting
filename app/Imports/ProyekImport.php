<?php

namespace App\Imports;

use App\Models\Proyek;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProyekImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    protected $nama_file_upload;

    public function __construct($nama_file_upload)
    {
        $this->nama_file_upload = $nama_file_upload;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Proyek([
            "id_proyek"                     =>$row[1],
            "nib"                           =>$row[2],
            "npwp_perusahaan"               =>$row[3],
            "nama_perusahaan"               =>$row[4],
            "uraian_status_penanaman_modal" =>$row[5],
            "uraian_jenis_perusahaan"       =>$row[6],
            "uraian_risiko_proyek"          =>$row[7],
            "uraian_skala_usaha"            =>$row[8],
            "alamat_usaha"                  =>$row[9],
            "kecamatan_usaha"               =>$row[10],
            "kelurahan_usaha"               =>$row[11],
            "longitude"                     =>$row[12],
            "latitude"                      =>$row[13],
            "kbli"                          =>$row[14],
            "judul_kbli"                    =>$row[15],
            "kl_sektor_pembina"             =>$row[16],
            "nama_user"                     =>$row[17],
            "nomor_identitas_user"          =>$row[18],
            "email"                         =>$row[19],
            "nomor_telp"                    =>$row[20],
            "jumlah_investasi_1"            =>$row[21],
            "jumlah_investasi_2"            =>$row[22],
            "mesin_peralatan"               =>$row[23],
            "mesin_peralatan_impor"         =>$row[24],
            "pembelian_pematangan_tanah"    =>$row[25],
            "bangunan_gedung"               =>$row[26],
            "modal_kerja"                   =>$row[27],
            "lain_lain"                     =>$row[28],
            "jumlah_investasi_3"            =>$row[29],
            "tki"                           =>$row[30],
            "nama_file_upload"              => $this->nama_file_upload,
        ]);
    }
}
