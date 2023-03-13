<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\DataSheetController;

use App\Http\Controllers\EppgbmController;

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

    Route::get('/', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::get('/unauthorized',[DashboardController::class, 'unauthorized'])->name('unauthorized');

    Route::group(['middleware' => ['role_check']], function() {
        /**
         * Logout Routes
         */
        //Route::get('/', 'DashboardController@index')->name('home.index');

        //Route::get('/dashboard',[DashboardController::class, 'index']);
        Route::get('/vdashboard', [DashboardController::class, 'vdashboard'])->name('vdashboard');
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
            Route::get('/', [PenggunaController::class, 'list'])->name('pengguna');
            //Route::get('/', [PenggunaController::class, 'show'])->name('pengguna.show');
            Route::get('/tambah', [PenggunaController::class, 'tambah'])->name('pengguna.tambah');
            Route::get('/edit/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
            Route::get('/resetpassword/{id}', [PenggunaController::class, 'resetpassword'])->name('pengguna.resetpassword');
            Route::post('/postPengguna/{method}', [PenggunaController::class, 'postPengguna'])->name('pengguna.perform');
            Route::get('/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');
        });

        Route::prefix('group')->group(function () {
            Route::get('/', [GroupController::class, 'list'])->name('group');
            //Route::get('/', [GroupController::class, 'show'])->name('group.show');
            Route::get('/tambah', [GroupController::class, 'tambah'])->name('group.tambah');
            Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
            Route::post('/postGroup/{method}', [GroupController::class, 'postGroup'])->name('group.perform');
            Route::get('/hapus/{id}', [GroupController::class, 'hapus'])->name('group.hapus');
        });

        Route::prefix('eppgbm')->group(function () {
            Route::get('/', [EppgbmController::class, 'list'])->name('eppgbm');
            Route::get('/tambah', [EppgbmController::class, 'tambah'])->name('eppgbm.tambah');
            Route::get('/edit/{id}', [EppgbmController::class, 'edit'])->name('eppgbm.edit');
            Route::post('/postGroup/{method}', [EppgbmController::class, 'postGroup'])->name('eppgbm.perform');
            Route::get('/hapus/{id}', [EppgbmController::class, 'hapus'])->name('eppgbm.hapus');
        });

        Route::prefix('ilsimil')->group(function () {
            Route::get('/', [GroupController::class, 'list'])->name('ilsimil');
        });

        Route::prefix('ekohot')->group(function () {
            Route::get('/', [GroupController::class, 'list'])->name('ekohot');
        });



        Route::get('/daftar',[PenggunaController::class, 'daftar'])->name('daftar');
    });
});


//Route::get('/',[DashboardController::class, 'index']);
