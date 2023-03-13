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

    function tambah()
    {
        $data = [
            'page' => "EPPGBM",
            'method' => "Tambah",
        ];
        return view('eppgbm', $data);
    }

    function edit($id)
    {
        $data = [
            'page' => "EPPGBM",
            'method' => "Edit",
            'data' => Eppgbm::find($id)->first(),
        ];
        return view('eppgbm', $data);
    }

    function hapus($id)
    {
        $data = [
            'page' => "EPPGBM",
            'method' => 'Hapus',
            'data' => Eppgbm::get(),
        ];
        return view('eppgbm', $data);
    }
}
