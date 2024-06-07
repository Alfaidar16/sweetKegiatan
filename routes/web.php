<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GaleriKegiatanController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

 Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
 Route::post('/login/auth', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth.login');

 Route::prefix('panel')->middleware('auth')->group(function() {
  // Route::group(['middleware' => ['role:1|2']],function() {
          Route::prefix('dashboard')->group(function() {
            Route::get('', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        });
//  });

      Route::prefix('kegiatan')->group(function () {
        Route::get('', [\App\Http\Controllers\GaleriKegiatanController::class, 'Index'])->name('kegiatan');
        Route::get('/create', [\App\Http\Controllers\GaleriKegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('/store', [\App\Http\Controllers\GaleriKegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('/edit/{slug}', [\App\Http\Controllers\GaleriKegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('{id}/update', [\App\Http\Controllers\GaleriKegiatanController::class, 'update'])->name('kegiatan.update');
        Route::post('destroy', [\App\Http\Controllers\GaleriKegiatanController::class, 'destroy'])->name('kegiatan.destroy');
        // Route::get('/generate-pdf', [GaleriKegiatanController::class, 'downloadPdf'])->name('generate.pdf');
      });
   
      Route::prefix('users')->group(function() {
        Route::get('', [\App\Http\Controllers\UsersController::class, 'index'])->name('user.index');
        Route::get('/create', [\App\Http\Controllers\UsersController::class, 'create'])->name('user.create');
        Route::post('/store', [\App\Http\Controllers\UsersController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\UsersController::class, 'edit'])->name('user.edit');
        Route::put('{id}/update', [\App\Http\Controllers\UsersController::class, 'update'])->name('user.update');
        Route::post('destroy', [\App\Http\Controllers\UsersController::class, 'destroy'])->name('user.destroy');
        });

      
  
       Route::prefix('laporan')->group(function() { 
          Route::get('', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
          Route::get('/generate-pdf', [LaporanController::class, 'downloadPdf'])->name('generate.pdf');
        });

  
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
 });