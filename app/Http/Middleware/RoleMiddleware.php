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
        $akses = $request->session()->get('akses');
        $nakses = json_decode($akses, true);
        //dd($akses);
        $keys = array_keys(json_decode($akses, true));
        $currentPath = explode('.', Route::currentRouteName());
        //var_dump($currentPath);
        //var_dump($keys);
        //var_dump(json_decode($akses));
        //dd($currentPath);

        if (in_array($currentPath[0], $keys) ) {
            if(isset($currentPath[1])){
                $subAction = $nakses[$currentPath[0]];
                //var_dump($subAction);
                //var_dump($currentPath[1]);
                if (in_array($currentPath[1], $subAction) ) {
                    return $next($request);
                }else{
                    return redirect('/unauthorized')->withErrors(json_encode($currentPath));        
                }
            }
            
        }else{
            return redirect('/unauthorized')->withErrors(json_encode($currentPath));
        }

        return $next($request);
    }
}
