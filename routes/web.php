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
Route::get('/tarikData', [\App\Http\Controllers\TarikDataController::class, 'index']);

Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('/login/auth', [\App\Http\Controllers\Auth\LoginController::class, 'Postlogin'])->name('auth.login');

Route::prefix('panel')->middleware('auth')->group(function () {
  // Route::group(['middleware' => ['role:1|2']],function() {

  Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
  Route::prefix('kegiatan')->group(function () {
    Route::get('', [\App\Http\Controllers\GaleriKegiatanController::class, 'Index'])->name('kegiatan');
    Route::get('/create', [\App\Http\Controllers\GaleriKegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/store', [\App\Http\Controllers\GaleriKegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/edit/{slug}', [\App\Http\Controllers\GaleriKegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('{id}/update', [\App\Http\Controllers\GaleriKegiatanController::class, 'update'])->name('kegiatan.update');
    Route::post('destroy', [\App\Http\Controllers\GaleriKegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    // Route::get('/generate-pdf', [GaleriKegiatanController::class, 'downloadPdf'])->name('generate.pdf');
  });

  
  Route::middleware(['auth', 'roles:1'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
      Route::get('/', [\App\Http\Controllers\UsersController::class, 'index'])->name('akun.index');
      Route::get('/create/user', [\App\Http\Controllers\UsersController::class, 'create'])->name('akun.create');
      Route::get('edit/{id}', [\App\Http\Controllers\UsersController::class, 'edit'])->name('akun.edit');
      Route::post('/create/store', [\App\Http\Controllers\UsersController::class, 'store'])->name('akun.store');
      Route::put('/update/{id}', [\App\Http\Controllers\UsersController::class, 'update'])->name('akun.update');
      Route::get('/filter/{kode_bidang}', [\App\Http\Controllers\UsersController::class, 'filter'])->name('filter.users');
    });


    // Route Sub Menu Bidang
    Route::group(['prefix' => 'bidang'], function () {
      Route::get('/', [\App\Http\Controllers\BidangController::class, 'index'])->name('bidang.index');
      // Route::get('/create', [\App\Http\Controllers\BidangController::class, 'create'])->name('bidang.create');
      // Route::get('/edit/{id}', [\App\Http\Controllers\BidangController::class, 'edit'])->name('bidang.edit');
      // Route::post('/store', [\App\Http\Controllers\BidangController::class, 'store'])->name('bidang.store');
      // Route::put('/update/{id}', [\App\Http\Controllers\BidangController::class, 'update'])->name('bidang.update');
      // Route::post('/bidang/destroy', [\App\Http\Controllers\BidangController::class, 'destroy'])->name('bidang.destroy');
    });
    // End Sub menu Bidang

  });

  //  Route Menu Bidang 
  Route::get('daftar/pegawai/{kode_bidang}', [\App\Http\Controllers\DaftarPegawaiController::class, 'index'])->name('daftar.bidang');
 
  Route::get('bidang/detail/pekan/{users_id}/{pekan_id}', [\App\Http\Controllers\DaftarPegawaiController::class, 'detailPekan'])->name('bidang.pekan');
  // End Route Menu Bidang

  Route::prefix('laporan')->group(function () {
    Route::get('', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/filter/pekan/{id}', [LaporanController::class, 'filterByPekan'])->name('filter.pekan');



    // Route
    // cetak Dokumen
    Route::get('/generate-pdf', [LaporanController::class, 'downloadPdf'])->name('generate.pdf');
    Route::get('/month', [\App\Http\Controllers\LaporanController::class, 'dataBulan'])->name('generate.month');
    Route::get('/pekan', [\App\Http\Controllers\LaporanController::class, 'dataPerpekan'])->name('generate.pekan');
  });


  Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
