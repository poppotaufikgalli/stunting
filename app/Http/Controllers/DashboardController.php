<?php

namespace App\Http\Controllers;

use App\Models\DoUploadFile;
use App\Models\Izin;
use App\Models\Proyek;
use App\Models\NibKantor;
use App\Models\VProyek1;

use Illuminate\Http\Request;
use File;
use time;
use Illuminate\Support\Facades\Auth;
use Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IzinImport;
use App\Imports\ProyekImport;
use App\Imports\NibKantorImport;

class DashboardController extends Controller
{
    public function index()
    {
        $sum_investasi_status_pm =  VProyek1::groupBy("uraian_status_penanaman_modal")
                ->selectRaw('uraian_status_penanaman_modal, sum(jumlah_investasi) as sum_investasi_status_pm')
                ->get();

        $n_sum_investasi_status_pm = [];
        foreach ($sum_investasi_status_pm as $key => $value) {
            $idx = $value->uraian_status_penanaman_modal;
            $nval = $value->sum_investasi_status_pm;
            $n_sum_investasi_status_pm[$idx] = $nval;  
        }

        $sum_tki_status_pm = VProyek1::groupBy("uraian_status_penanaman_modal")
                ->selectRaw('uraian_status_penanaman_modal, sum(tki) as sum_tki_status_pm')
                ->get();

        //var_dump($sum_tki_status_pm); exit();

        $n_sum_tki_status_pm = [];
        foreach ($sum_tki_status_pm as $key => $value) {
            $idx = $value->uraian_status_penanaman_modal;
            $nval = $value->sum_tki_status_pm;
            $n_sum_tki_status_pm[$idx] = $nval;  
        }
        $data= [
            "page" => "Dashboard",
            "sum_investasi" => VProyek1::sum('jumlah_investasi'),
            "sum_tki" => VProyek1::sum('tki'),
            "sum_investasi_status_pm" => $n_sum_investasi_status_pm,
            "sum_tki_status_pm" => $n_sum_tki_status_pm,
        ];
        
        //echo "<pre>";print_r($data); exit();
        return view('Dashboard', $data);
    }

    public function upload()
    {
        $data= [
            "page" => "Upload",
            "dtupload" => DoUploadFile::get(),
        ];

        return view('Upload', $data);
    }

    public function performUpload(Request $request)
    {
        $validatedData = $request->validate([
            'nama_target_table' => 'required',
            'filetoupload' => 'required|mimes:csv,txt|max:2048',
        ],[
            'nama_target_table.required' => 'Nama Target File tidak boleh kosong',
            'filetoupload.required' => 'Upload File tidak boleh kosong',
            'filetoupload.mimes' => 'Upload File harus berupa txt atau csv',
            'filetoupload.max' => 'Ukuran Upload File maksimal 2 Mb',
        ]);

        $nama_target_table = $request->nama_target_table;
        $filetoupload = $request->filetoupload;

        $nama_file = $nama_target_table . '.'. time() . '.'. $filetoupload->getClientOriginalExtension();  

        //$type = $request->file->getClientMimeType();
        //$size = $request->file->getSize();

        $filetoupload->move(public_path('file'), $nama_file);

        $user = auth::user();

        $jumlah_row = 0;

        switch ($nama_target_table) {
            case 'izin':
                $filepath = public_path('file').'/'.$nama_file;
                Excel::import(new IzinImport($nama_file), $filepath);

                $jumlah_row = Izin::where(['nama_file_upload' => $nama_file])->count();
                break;

            case 'proyek':
                $filepath = public_path('file').'/'.$nama_file;
                Excel::import(new ProyekImport($nama_file), $filepath);

                $jumlah_row = Proyek::where(['nama_file_upload' => $nama_file])->count();
                break;

            case 'nib_kantor':
                $filepath = public_path('file').'/'.$nama_file;
                Excel::import(new NibKantorImport($nama_file), $filepath);

                $jumlah_row = NibKantor::where(['nama_file_upload' => $nama_file])->count();
                break;
        }



        DoUploadFile::create([
            'id_user'           => $user['id'],
            'nama_user'         => $user['nama'],
            'nama_file'         => $nama_file,
            'nama_target_table' => $nama_target_table,
            'jumlah_row'        => $jumlah_row,
        ]);
        
 
        return redirect('upload')->with('success', 'File sukses diupload');
    }

    public function hapusUpload(Request $request)
    {
        $id = $request->id;
        $hapusFile = $request->hapusFile == 'on' ? true : false;
        $hapusData = $request->hapusData == 'on' ? true : false;

        //var_dump($hapusFile);
        //var_dump($hapusData); exit();

        $filetodelete = DoUploadFile::find($id);
        $nama_file = $filetodelete->nama_file;
        $nama_target_table = $filetodelete->nama_target_table;
        $pathtodelete = public_path('file').'/'.$nama_file;

        //var_dump($todelete); exit();

        if(($hapusFile) && (File::exists($pathtodelete))) {
            File::delete($pathtodelete);
        }
        //Storage::disk('public')->delete($filetodelete->nama_file);
        $filetodelete = DoUploadFile::find($id)->delete();

        if($hapusData){
            switch ($nama_target_table) {
                case 'izin':
                    //var_dump(['nama_file_upload' => $nama_file]);
                    $datatodelete = Izin::where(['nama_file_upload' => $nama_file])->get();
                    //var_dump($datatodelete); exit();
                    $fin = $datatodelete->each->delete();
                    break;

                case 'proyek':
                    $datatodelete = Proyek::where(['nama_file_upload' => $nama_file])->get();
                    $fin = $datatodelete->each->delete();
                    break;

                case 'nib_kantor':
                    $datatodelete = NibKantor::where(['nama_file_upload' => $nama_file])->get();
                    $fin = $datatodelete->each->delete();
                    break;
            }
        }

        return redirect('upload')->with('success', 'File sukses dihapus');
    }
}
