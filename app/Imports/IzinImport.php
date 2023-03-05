<?php

namespace App\Imports;

use App\Models\Izin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class IzinImport implements ToModel, WithStartRow, WithCustomCsvSettings
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
        return new Izin([
            "id_permohonan_izin"            => $row[1],
            "nama_perusahaan"               => $row[2],
            "nib"                           => $row[3],
            "day_of_tanggal_terbit_oss"     => $row[4],
            "uraian_status_penanaman_modal" => $row[5],
            "propinsi"                      => $row[6],
            "kab_kota"                      => $row[7],
            "kd_resiko"                     => $row[8],
            "kbli"                          => $row[9],
            "day_of_tgl_izin"               => $row[10],
            "uraian_jenis_perizinan"        => $row[11],
            "nama_dokumen"                  => $row[12],
            "uraian_kewenangan"             => $row[13],
            "uraian_status_respon"          => $row[14],
            "kewenangan"                    => $row[15],
            "nama_file_upload"              => $this->nama_file_upload,
        ]);
    }
}
