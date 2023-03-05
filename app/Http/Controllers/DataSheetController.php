<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Proyek;
use App\Models\NibKantor;
use Illuminate\Http\Request;

use Schema;

class DataSheetController extends Controller
{
    public function show()
    {
        $hData = Schema::getColumnListing('t_izin');

        $data= [
            "page" => "Data",
            "subpage" => "Izin",
            "headerData" => $hData,
            "cHeader" => count($hData),
            "lsData" => Izin::orderByDesc("id")->get(),
        ];

        return view('Data', $data);
    }

    public function izin()
    {
        $hData = Schema::getColumnListing('t_izin');

        $data= [
            "page" => "Data",
            "subpage" => "Izin",
            "headerData" => $hData,
            "cHeader" => count($hData),
            "lsData" => Izin::orderByDesc("id")->get(),
        ];

        return view('Data', $data);
    }

    public function proyek()
    {
        $hData = Schema::getColumnListing('t_proyek');

        $data= [
            "page" => "Data",
            "subpage" => "Proyek",
            "headerData" => $hData,
            "cHeader" => count($hData),
            "lsData" => Proyek::orderByDesc("id")->get(),
        ];

        return view('Data', $data);
    }

    public function nibkantor()
    {
        $hData = Schema::getColumnListing('t_nib_kantor');

        $data= [
            "page" => "Data",
            "subpage" => "NIB Kantor",
            "headerData" => $hData,
            "cHeader" => count($hData),
            "lsData" => NibKantor::get(),
        ];

        return view('Data', $data);
    }
}
