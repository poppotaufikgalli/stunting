<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentPath = explode('.', Route::currentRouteName());
        //var_dump($currentPath[0]);

        $akses = $request->session()->get('akses');
        if(!isset($akses)){
            return redirect('/login');
        }

        $nakses = json_decode($akses, true);
        $keys = array_keys(json_decode($akses, true));
        
        if (in_array($currentPath[0], $keys) ) {
            if(isset($currentPath[1])){
                $subAction = $nakses[$currentPath[0]];
                if (in_array($currentPath[1], $subAction) ) {
                    return $next($request);
                }else{
                    return redirect('/unauthorized')->withErrors(json_encode($currentPath));        
                }
            }
            
        }else{
            if($currentPath[0] == 'vdashboard'){
                return $next($request);
            }
            return redirect('/unauthorized')->withErrors(json_encode($currentPath));
        }

        return $next($request);
    }
}
