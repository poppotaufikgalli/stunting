<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//use App\Http\Requests\PenggunaRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    function show()
    {
        $data = [
            'page' => "Pengguna",
            'method' => "Daftar",
            'user' => User::get()
        ];
        return view('pengguna', $data);
    }

    function tambah()
    {
        $data = [
            'page' => "Pengguna",
            'method' => "Tambah",
        ];
        return view('pengguna', $data);
    }

    function edit($id)
    {
        $data = [
            'page' => "Pengguna",
            'method' => "Edit",
            'user' => User::find($id)
        ];
        return view('pengguna', $data);
    }

    function resetpassword($id)
    {
        $data = [
            'page' => "Pengguna",
            'method' => "Reset Password",
            'user' => User::find($id)
        ];
        return view('pengguna', $data);
    }

    function hapus($id)
    {
        $data = [
            'page' => "Pengguna",
            'method' => 'Hapus',
            'user' => User::find($id)
        ];
        return view('pengguna', $data);
    }

    function postPengguna(Request $request, $method) 
    {   
        switch ($method) {
            case 'Tambah':
                $reqData = $request->all();
                $validator = Validator::make($reqData, [
                    'nip' => 'required|unique:users,nip',
                    'email' => 'required|email|unique:users,email',
                    'nama' => 'required',
                    'jabatan' => 'required',
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|same:password'
                ],[
                    'email.required' => 'Email tidak boleh kosong',
                    'email.email' => 'Format email tidak sesuai',
                    'email.unique' => 'Email telah terdaftar',

                    'nama.required' => 'Nama tidak boleh kosong',

                    'nip.required' => 'NIP tidak boleh kosong',
                    'nip.unique' => 'NIP telah terdaftar',

                    'jabatan.required' => 'Jabatan tidak boleh kosong',

                    'password.required' => 'Password tidak boleh kosong',
                    'password.min' => 'Password tidak boleh kurang dari 8',

                    'password_confirmation.required' => 'Konfirmasi Password tidak boleh kosong',
                    'password_confirmation.same' => 'Konfirmasi Password tidak sama dengan Password',
                ]);

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $user = User::create($reqData);
                return redirect('/pengguna')->with('success', "Pengguna berhasil ditambahkan.");
                break;

            case 'Edit':
                $reqData = $request->only('nip', 'nama', 'jabatan');
                $id = $request->id;
                $validator = Validator::make($reqData, [
                    'nama' => ['required', Rule::unique('users')->ignore($id)],
                    'nip' => ['required', Rule::unique('users')->ignore($id)],
                    'jabatan' => 'required',
                ],[
                    'nama.required' => 'Nama tidak boleh kosong',
                    'nama.unique' => 'Nama telah terdaftar',

                    'nip.required' => 'NIP tidak boleh kosong',
                    'nip.unique' => 'NIP telah terdaftar',

                    'jabatan.required' => 'Jabatan tidak boleh kosong',
                ]);

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                //$data->validated();
                $user = User::find($id)->update($reqData);
                return redirect('/pengguna')->with('success', "Pengguna berhasil diubah.");
                break;

            case 'resetpassword':
                $id = $request->id;
                $reqData = $request->only('password', 'password_confirmation');

                $validator = Validator::make($reqData, [
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|same:password'
                ],[
                    'password.required' => 'Password tidak boleh kosong',
                    'password.min' => 'Password tidak boleh kurang dari 8',

                    'password_confirmation.required' => 'Konfirmasi Password tidak boleh kosong',
                    'password_confirmation.same' => 'Konfirmasi Password tidak sama dengan Password',
                ]);

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $user = User::find($id)->update($reqData);
                return redirect('/pengguna')->with('success', "Password pengguna berhasil diubah.");
                break;

            case 'Hapus':
                $id = $request->id;
                $name = $request->nama;
                $user = User::find($id)->delete();
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
