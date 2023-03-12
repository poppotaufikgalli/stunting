<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Akses;

class LogoutController extends Controller
{
    public function perform()
    {
        $nip = Session::get('nip');
        $akses = Akses::where('nip', $nip)->first();
        if($akses->remember_token != null){
            $akses->remember_token = null;
            $akses->save();
        }

        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }
}
