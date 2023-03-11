<?php

namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\Group;
use Illuminate\Http\Request;
//use App\Http\Requests\PenggunaRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    function list()
    {
        $data = [
            'page' => "Pengguna",
            'method' => "Daftar",
            'user' => Akses::get()
        ];
        //dd($data);
        return view('pengguna', $data);
    }

    function tambah()
    {
        $data = [
            'page' => "Pengguna",
            'method' => "Tambah",
            'group' => Group::get(),
        ];
        return view('pengguna', $data);
    }

    function edit($id)
    {
        $data = [
            'page' => "Pengguna",
            'method' => "Edit",
            'user' => Akses::find($id),
            'group' => Group::get(),
        ];
        return view('pengguna', $data);
    }

    function hapus($id)
    {
        $data = [
            'page' => "Pengguna",
            'method' => 'Hapus',
            'user' => Akses::find($id),
            'group' => Group::get(),
        ];
        return view('pengguna', $data);
    }

    function postPengguna(Request $request, $method) 
    {   
        switch ($method) {
            case 'Tambah':
                $reqData = $request->all();
                $validator = Validator::make($reqData, [
                    'nip' => 'required|unique:akses,nip',
                    'no_hp' => 'required|unique:akses,no_hp',
                    'gid' => 'required',
                ],[
                    'nip.required' => 'NIP tidak boleh kosong',
                    'nip.unique' => 'NIP telah terdaftar',

                    'no_hp.required' => 'Nomor HP tidak boleh kosong',
                    'no_hp.unique' => 'Nomor HP telah terdaftar',

                    'gid.required' => 'Group tidak boleh kosong',
                ]);

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $reqData['crid'] = $request->session()->get('nip');
                $user = Akses::create($reqData);
                return redirect('/pengguna')->with('success', "Pengguna berhasil ditambahkan.");
                break;

            case 'Edit':
                $reqData = $request->only('nip', 'nama', 'no_hp', 'gid');
                $id = $request->id;
                $validator = Validator::make($reqData, [
                    'nip' => ['required', Rule::unique('akses')->ignore($id)],
                    'no_hp' => ['required', Rule::unique('akses')->ignore($id)],
                    'gid' => 'required',
                ],[
                    'nip.required' => 'NIP tidak boleh kosong',
                    'nip.unique' => 'NIP telah terdaftar',

                    'no_hp.required' => 'Nomor HP tidak boleh kosong',
                    'no_hp.unique' => 'Nomor HP telah terdaftar',

                    'gid.required' => 'Group tidak boleh kosong',
                ]);

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $reqData['upid'] = $request->session()->get('nip');
                $user = Akses::find($id)->update($reqData);
                return redirect('/pengguna')->with('success', "Pengguna berhasil diubah.");
                break;

            case 'Hapus':
                $id = $request->id;
                $name = $request->nama;
                $user = Akses::find($id)->delete();
                return redirect('/pengguna')->with('success', "Pengguna berhasil dihapus.");
                break;
            
            default:
                // code...
                break;
        }

        
        
        //auth()->login($user);

        //return redirect()->back()->with('success', "Pengguna berhasil ditambahkan.");*/
        //echo $method;
    }
}
