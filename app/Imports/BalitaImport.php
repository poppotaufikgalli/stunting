<?php

namespace App\Imports;

use App\Models\Balita;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class BalitaImport implements ToModel, WithStartRow, WithCustomCsvSettings, WithValidation, SkipsOnError
{
    use Importable, SkipsErrors;

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

    public function rules(): array
    {
        return [
            '*.1' => Rule::unique('t_balita', 'nik'),
        ];

    }

    public function model(array $row)
    {
        return new Balita([
            "nik"               => $this->cvsTrim($row[1]),
            "nama"              => $this->cvsTrim($row[2]),
            "jk"                => $this->cvsTrim($row[3]),
            "tgl_lahir"         => $this->cvsTrim($row[4]),
            "bb_lahir"          => $this->cvsTrim($row[5]),
            "tb_lahir"          => $this->cvsTrim($row[6]),
            "nama_ortu"         => $this->cvsTrim($row[7]),
            "prov"              => $this->cvsTrim($row[8]),
            "kab_kota"          => $this->cvsTrim($row[9]),
            "kec"               => $this->cvsTrim($row[10]),
            "desa_kel"          => $this->cvsTrim($row[12]),
            "rt"                => $this->cvsTrim($row[14]),
            "rw"                => $this->cvsTrim($row[15]),
            "alamat"            => $this->cvsTrim($row[16]),
            "nama_file_upload"  => $this->nama_file_upload,
        ]);
    }
}
