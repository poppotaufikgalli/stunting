<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Akses;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        if(Session::get('nip')){
            return redirect()->intended('/vdashboard');
        }else{
            return view('login');    
        }
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        //dd($credentials);

        $SIAP = $this->SIAPLogin($credentials);
        if(!$SIAP->loginStatus):
            return redirect()->to('login')
                ->withErrors($SIAP->message)
                ->onlyInput('nip');
        endif;

        $datauser = $SIAP->datauser;

        $akses = Akses::where('nip', $credentials['nip'])->first();

        if(!isset($akses)){
            return redirect()->to('login')
                ->withErrors("User tidak memiliki akses pada Aplikasi");
        }

        if(isset($credentials['remember_me'])){
            $akses->remember_token = $request->cookie('laravel_session');
            $akses->save();
        }else{
            if($akses->remember_token != null){
                $akses->remember_token = null;
                $akses->save();  
            }
        }

        //dd($akses);

        return $this->authenticated($request, $datauser, $akses->groups->lsakses);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user, $akses) 
    {
        $request->session()->put('authenticated', time());
        $request->session()->put('nama', $user->nama);
        $request->session()->put('nip', $user->nip);
        //$request->session()->put('gid', $akses->gid);
        $request->session()->put('akses', $akses);

        return redirect()->intended('/vdashboard');
    }
}
