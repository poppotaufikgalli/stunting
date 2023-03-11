<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eppgbm;

class EppgbmController extends Controller
{
    function list()
    {
        $data = [
            'page' => "EPPGBM",
            'method' => "Daftar",
            'data' => Eppgbm::orderByDesc('posyandu')->get(),
        ];
        //dd($data);
        return view('eppgbm', $data);
    }
}
