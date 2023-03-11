<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Group;
use Illuminate\Support\Facades\Route;

class GroupController extends Controller
{
    function lsGroup($searchText='list'){
        $routelist = Route::getRoutes();
        $ret = [];
        foreach ($routelist as $key => $value) {
            if($value->getActionMethod() == $searchText){
                $ret[] = $value->getName();
            }
        }

        return $ret;
    }

    function list()
    {
        $data = [
            'page' => "Group",
            'method' => "Daftar",
            'group' => Group::get()
        ];
        //dd($data);
        return view('group', $data);
    }

    function tambah()
    {
        $data = [
            'page' => "Group",
            'method' => "Tambah",
        ];
        return view('group', $data);
    }

    function edit($id)
    {
        $data = [
            'page' => "Group",
            'method' => "Edit",
            'group' => Group::find($id)
        ];
        return view('group', $data);
    }

    function hapus($id)
    {
        $data = [
            'page' => "Group",
            'method' => 'Hapus',
            'group' => Group::find($id)
        ];
        return view('group', $data);
    }

    function postGroup(Request $request, $method) 
    {   
        
        //dd($reqData);

        switch ($method) {
            case 'Tambah':
                $reqData = $request->all();        
                $validator = Validator::make($reqData, [
                    'nama' => 'required|unique:group,nama',
                ],[
                    'nama.required' => 'Nama tidak boleh kosong',
                    'nama.unique' => 'Nama telah terdaftar',
                ]);

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $reqData['crid'] = $request->session()->get('nip');
                $reqData['lsakses'] = json_encode($reqData['lsakses']);
                $user = Group::create($reqData);
                return redirect('/group')->with('success', "Group berhasil ditambahkan.");
                break;

            case 'Edit':
                $reqData = $request->only('nama', 'lsakses');
                $id = $request->id;
                $validator = Validator::make($reqData, [
                    'nama' => ['required', Rule::unique('group')->ignore($id)],
                ],[
                    'nama.required' => 'Nama tidak boleh kosong',
                    'nama.unique' => 'Nama telah terdaftar',
                ]);

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                //$data->validated();
                $reqData['upid'] = $request->session()->get('nip');
                $reqData['lsakses'] = json_encode($reqData['lsakses']);
                $user = Group::find($id)->update($reqData);
                return redirect('/group')->with('success', "Group berhasil diubah.");
                break;

            case 'Hapus':
                $id = $request->id;
                $user = Group::find($id)->delete();
                return redirect('/group')->with('success', "Group berhasil dihapus.");
                break;
            
            default:
                // code...
                break;
        }
    }
}
