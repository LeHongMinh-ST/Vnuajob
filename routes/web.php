<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Auth;
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

Route::get('/logout',[Auth\LoginController::class,'logout'])->name('logout');
Route::get('/login',[Auth\LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[Auth\LoginController::class,'Login'])->name('loginProcess');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login',[Auth\LoginController::class,'showAdminLoginForm'])->name('admin.login');
    Route::post('/login',[Auth\LoginController::class,'adminLogin'])->name('admin.loginProcess');

    Route::middleware('auth.admin')->group(function (){
        Route::get('/',Backend\DashboardController::class)->name('admin.dashboard');
    });

});

Route::get('/',[Frontend\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

