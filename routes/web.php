<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

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

 Route::get('/panel/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
 Route::post('/login/auth', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth.login');

 Route::prefix('panel')->middleware('auth')->group(function() {
    Route::prefix('dashboard')->group(function() {
        Route::get('', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    });
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
 });