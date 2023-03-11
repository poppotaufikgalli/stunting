<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getPegawai/{nip}', [ApiController::class, 'getPegawai'])->name('api.getPegawai');
Route::get('/getPetaKelurahan', [ApiController::class, 'getPetaKelurahan'])->name('api.getPetaKelurahan');
Route::get('/getDataEppgbm/{kec}/{kel}', [ApiController::class, 'getDataEppgbm'])->name('api.getDataEppgbm');
