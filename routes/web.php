<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\DataSheetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Route::get('/', function () {
    $data= [
        "page" => "Dashboard",
    ];
    return view('dashboard', $data);
});

Route::get('/menu/{page}', function ($page) {
    $page = ucwords(preg_replace('/[^a-zA-Z0-9-]/', ' ', $page));

    $data= [
        "page" => $page,
    ];
    return view('welcome', $data);
});*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/', 'DashboardController@index')->name('home.index');
        
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        Route::get('/dashboard',[DashboardController::class, 'index']);

        Route::prefix('data')->group(function () {
            Route::get('/',[DataSheetController::class, 'show'])->name('data.show');
            Route::get('/izin',[DataSheetController::class, 'izin'])->name('data.izin');
            Route::get('/proyek',[DataSheetController::class, 'proyek'])->name('data.proyek');
            Route::get('/nibkantor',[DataSheetController::class, 'nibkantor'])->name('data.nibkantor');
        });

        Route::prefix('upload')->group(function () {
            Route::get('/',[DashboardController::class, 'upload'])->name('dashboard.upload');
            Route::post('/performUpload',[DashboardController::class, 'performUpload'])->name('upload.performUpload');
            Route::post('/hapusUpload',[DashboardController::class, 'hapusUpload'])->name('upload.hapusUpload');
        });
        
        Route::get('/performDownload/{filename}',[DownloadFileController::class, 'performDownload'])->name('dashboard.performDownload');
        Route::get('/performDownloadCth/{filename}',[DownloadFileController::class, 'performDownloadCth'])->name('dashboard.performDownloadCth');

        //Route::get('/pengguna', [PenggunaController::class, 'show'])->name('pengguna.show');
        Route::prefix('pengguna')->group(function () {
            Route::get('/', [PenggunaController::class, 'show'])->name('pengguna.show');
            Route::get('/tambah', [PenggunaController::class, 'tambah'])->name('pengguna.tambah');
            Route::get('/edit/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
            Route::get('/resetpassword/{id}', [PenggunaController::class, 'resetpassword'])->name('pengguna.resetpassword');
            Route::post('/postPengguna/{method}', [PenggunaController::class, 'postPengguna'])->name('pengguna.perform');
            Route::get('/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');
        });

        Route::get('/daftar',[PenggunaController::class, 'daftar'])->name('daftar');
    });
});


//Route::get('/',[DashboardController::class, 'index']);
