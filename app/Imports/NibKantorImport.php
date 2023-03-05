<?php

namespace App\Imports;

use App\Models\NibKantor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class NibKantorImport implements ToModel, WithStartRow, WithCustomCsvSettings
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
        return new NibKantor([
            "nib"                       =>$row[1],
            "day_of_tanggal_terbit_oss" =>$row[2],
            "nama_perusahaan"           =>$row[3],
            "status_penanaman_modal"    =>$row[4],
            "uraian_jenis_perusahaan"   =>$row[5],
            "alamat_perusahaan"         =>$row[6],
            "kab_kota"                  =>$row[7],
            "email"                     =>$row[8],
            "nomor_telp"                =>$row[9],
            "nama_file_upload"          => $this->nama_file_upload,
        ]);
    }
}
