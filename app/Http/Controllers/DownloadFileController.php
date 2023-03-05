<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use File;

class DownloadFileController extends Controller
{
    public function performDownload($filename){
        $pathtodownload = public_path('file').'/'.$filename;

        if(File::exists($pathtodownload)) {
            $headers = array('Content-Type: text/csv',);
            return (Response::download($pathtodownload, $filename, $headers));
        }else{
            return redirect()->back()->withErrors("Terjadi Kesalahan, File tidak ditemukan");
        }
    }

    public function performDownloadCth($filename){
        $pathtodownload = public_path('contoh').'/'.$filename;

        if(File::exists($pathtodownload)) {
            $headers = array('Content-Type: text/csv',);
            return (Response::download($pathtodownload, $filename, $headers));
        }else{
            return redirect()->back()->withErrors("Terjadi Kesalahan, File ".$filename." tidak ditemukan");
        }
    }
}
