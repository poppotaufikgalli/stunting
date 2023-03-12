<?php

namespace App\Http\Controllers;

use App\Models\DoUploadFile;
use App\Models\Izin;
use App\Models\Proyek;
use App\Models\NibKantor;
use App\Models\VProyek1;

use App\Models\Balita;
use App\Models\Eppgbm;
use App\Models\VEppgbmKecKel;
use App\Models\VEppgbmGrUmurTbU;

use Illuminate\Http\Request;
use File;
use time;
use Illuminate\Support\Facades\Auth;
use Storage;
use DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EppgbmImport;
use App\Imports\BalitaImport;

class DashboardController extends Controller
{
    public function index(){
        return redirect()->to('/');
    }

    public function unauthorized(){
        return view('unauthorized');
    }

    public function dashboardData()
    {
        $sebarankeckel = VEppgbmKecKel::orderByDesc('jml')->get();
        $nsebarankec = [];
        $nsebarankeckel = [];
        $nsebarankeckelP = [];
        $nsebarankeckelSP = [];
        foreach($sebarankeckel as $key=>$value){
            $nsebarankec[$value->kec] = ($nsebarankec[$value->kec] ?? 0) + $value->jml;
            $nsebarankeckel[$value->desa_kel] = $value->jml;
            $nsebarankeckelP[$value->desa_kel] = $value->Pendek;
            $nsebarankeckelSP[$value->desa_kel] = $value->Sangat_Pendek;
        }
        $petakelurahantpi = json_decode(file_get_contents(public_path() . "/geo/petakelurahantpi.geojson"), true);
        //dd($petakelurahantpi);
        foreach ($petakelurahantpi['features'] as $key => $value) {
            $kel = $value['properties']['KELURAHAN'];
            $petakelurahantpi['features'][$key]['properties']['sebaran'] = $nsebarankeckel[$kel] ?? 0; 
            $petakelurahantpi['features'][$key]['properties']['pendek'] = $nsebarankeckelP[$kel] ?? 0; 
            $petakelurahantpi['features'][$key]['properties']['sangat_pendek'] = $nsebarankeckelSP[$kel] ?? 0; 
            if($kel == 'SEI JANG' || $kel == 'SUNGAI JANG'){
                $petakelurahantpi['features'][$key]['properties']['sebaran'] = $nsebarankeckel['SEI JANG'] ?? 0; 
                $petakelurahantpi['features'][$key]['properties']['pendek'] = $nsebarankeckelP['SEI JANG'] ?? 0; 
                $petakelurahantpi['features'][$key]['properties']['sangat_pendek'] = $nsebarankeckelSP['SEI JANG'] ?? 0; 
            }
        }
        
        $umurtbu = VEppgbmGrUmurTbU::get();
        $dtUmurTbu = [];
        foreach ($umurtbu as $key => $value) {
            $dtUmurTbu['labels'][] = $value->umur . " Tahun"; 
            $dtUmurTbu['Pendek'][] = $value->Pendek; 
            $dtUmurTbu['Sangat_Pendek'][] = $value->Sangat_Pendek; 
            $dtUmurTbu['jml'][] = $value->jml; 
        }

        $data= [
            "page" => "Dashboard",
            "sebarankeckel" => $sebarankeckel,
            "nsebarankec" => $nsebarankec,
            "petakelurahantpi" => $petakelurahantpi,
            "dtUmurTbu" => $dtUmurTbu,
        ];

        //dd($data);

        return $data;
    }

    public function vdashboard(){
        $data = $this->dashboardData();
        //$data['side'] = true;
        return view('dashboard', $data);
    }

    public function show(){
        $data = $this->dashboardData();
        $data['side'] = 1;
        return view('dashboard', $data);
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

        $vfailure = [];

        switch ($nama_target_table) {

            case 'eppgbm':
                $filepath = public_path('file').'/'.$nama_file;
                Excel::import(new BalitaImport($nama_file), $filepath);

                Excel::import(new EppgbmImport($nama_file), $filepath);

                $jumlah_row = Eppgbm::where(['nama_file_upload' => $nama_file])->count();
                break;
        }



        DoUploadFile::create([
            //'id_user'           => $user['id'],
            'nip'           => $request->session()->get('nip'),
            'nama_user'         => $request->session()->get('nama'),
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
                case 'eppgbm':
                    $datatodelete = Eppgbm::where(['nama_file_upload' => $nama_file])->get();
                    $fin = $datatodelete->each->delete();
                    break;
            }
        }

        return redirect('upload')->with('success', 'File sukses dihapus');
    }
}
