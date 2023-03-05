<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //return view('auth.register');
        $data['user'] = User::get();
        return view('pengguna', $data);
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $user = User::create($request->validated());

        //auth()->login($user);

        //return redirect('/pengguna')->with('success', "Pengguna berhasil ditambahkan.");
        return redirect()->back()->with('success', "Pengguna berhasil ditambahkan.");
    }
}
