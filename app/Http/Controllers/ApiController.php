<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eppgbm;

class ApiController extends Controller
{
    public function getPegawai($nip)
    {
        $retval = $this->SIAPUser(['nip' => $nip]);
        return response()->json($retval, 200);
    }

    public function getPetaKelurahan()
    {
        //$retval = $this->SIAPUser(['nip' => $nip]);
        return response()->json($retval, 200);
    }

    public function getDataEppgbm($kec, $kel)
    {
        if($kel == 'SUNGAI JANG'){
            $kel = 'SEI JANG';
        }
        $retval['data'] = Eppgbm::join('t_balita', 't_eppgbm.nik', '=', 't_balita.nik')->where(['kec' => $kec, 'desa_kel' => $kel])->get();
        return response()->json($retval, 200);   
    }
}
