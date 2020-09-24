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

Route::get('/logout',[Auth\StudentAuthController::class,'logout'])->name('logout');
Route::get('/login',[Auth\StudentAuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[Auth\StudentAuthController::class,'login'])->name('loginProcess');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login',[Auth\AdminAuthController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login',[Auth\AdminAuthController::class,'login'])->name('admin.loginProcess');
    Route::get('/logout',[Auth\AdminAuthController::class,'logout'])->name('admin.logout');

    Route::middleware('auth.admin')->group(function (){
        Route::get('/',[Backend\DashboardController::class,'indexUser'])->name('admin.dashboard');
    });

});

Route::group(['prefix' => 'employers'], function () {
    Route::get('/login',[Auth\EmployerAuthController::class,'showLoginForm'])->name('employers.login');
    Route::post('/login',[Auth\EmployerAuthController::class,'login'])->name('employers.loginProcess');
    Route::get('/logout',[Auth\EmployerAuthController::class,'logout'])->name('employers.logout');
    Route::get('/register',[Auth\EmployerRegisterController::class,'showRegistrationForm'])->name('employers.register');
    Route::post('/register',[Auth\EmployerRegisterController::class,'register'])->name('employers.registerProcess');

    Route::post('/companies/store',[Backend\CompanyController::class,'store'])->name('employers.company.store');

    Route::middleware('auth.employer')->group(function (){
        Route::get('/',[Backend\DashboardController::class,'indexEmployer'])->name('employers.dashboard');
    });
});


Route::get('/',[Frontend\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

