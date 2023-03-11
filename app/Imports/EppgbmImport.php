<?php

namespace App\Imports;

use App\Models\Eppgbm;
use App\Models\Balita;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class EppgbmImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    protected $nama_file_upload;

    public function __construct($nama_file_upload)
    {
        $this->nama_file_upload = $nama_file_upload;
    }

    public function startRow(): int
    {
        return 3;
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

    public function cvsTrim($value='')
    {
        return trim($value, "\xA0\xC2");
    }

    public function model(array $row)
    {
        return new Eppgbm([
            "nik"               => $this->cvsTrim($row[1]),
            "puskesmas"         => $this->cvsTrim($row[11]),
            "posyandu"          => $this->cvsTrim($row[13]),
            "usia_saat_ukur"    => $this->cvsTrim($row[17]),
            "tgl_pengukuran"    => $this->cvsTrim($row[18]),
            "berat"             => $this->cvsTrim($row[19]),
            "tinggi"            => $this->cvsTrim($row[20]),
            "lila"              => $this->cvsTrim($row[21]),
            "bb_u"              => $this->cvsTrim($row[22]),
            "zz_bb_u"           => $this->cvsTrim($row[23]),
            "tb_u"              => $this->cvsTrim($row[24]),
            "zz_tb_u"           => $this->cvsTrim($row[25]),
            "bb_tb"             => $this->cvsTrim($row[26]),
            "zz_bb_tb"          => $this->cvsTrim($row[27]),
            "naik_berat_badan"  => $this->cvsTrim($row[28]),
            "pmt_diterima_kg"   => $this->cvsTrim($row[29]),
            "jml_vit_a"         => $this->cvsTrim($row[30]),
            "kpsp"              => $this->cvsTrim($row[31]),
            "kia"               => $this->cvsTrim($row[32]),
            "nama_file_upload"  => $this->nama_file_upload,
        ]);
    }
}
