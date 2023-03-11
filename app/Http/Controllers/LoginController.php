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
        return view('login');
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

        $SIAP = $this->SIAPLogin($credentials);
        if(!$SIAP->loginStatus):
            return redirect()->to('login')
                ->withErrors($SIAP->message)
                ->onlyInput('nip');
        endif;

        $datauser = $SIAP->datauser;

        $akses = Akses::where('nip', $credentials['nip'])->first();

        //dd($akses);

        return $this->authenticated($request, $datauser, $akses->groups->lsakses);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
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
