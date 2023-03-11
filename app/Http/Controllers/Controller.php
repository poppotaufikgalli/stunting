<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function SIAPLogin($credentials)
    {
        $body = [
            'username' => $credentials['nip'],
            'password' => $credentials['password'],
        ];
        $response = Http::withHeaders(['token' => env('SIAP_REST_API_TOKEN')])->asForm()->post(env('SIAP_AUTH_API').'/loginUser', $body);
        return $response->object();
    }

    protected function SIAPUser($credentials)
    {
        $body = [
            'nip' => $credentials['nip'],
        ];
        $response = Http::withHeaders(['token' => env('SIAP_REST_API_TOKEN')])->asForm()->post(env('SIAP_AUTH_API').'/getPegawai', $body);
        return $response->object();
    }
}
