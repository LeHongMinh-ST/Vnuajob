<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\CategoryController;
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

Route::get('/admin', function () {
    return view('backend.dashboard');
});

Route::get('/',[Frontend\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'prefix' => 'admin',
], function () {

    Route::group([
        'prefix' => 'category',
        'as' => 'category.'
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/getData',  [CategoryController::class, 'getData'])->name('getData');
        Route::get('show/{id}',  [CategoryController::class, 'show'])->name('show');
        Route::get('create',  [CategoryController::class, 'create'])->name('create');
        Route::post('/store',  [CategoryController::class, 'store'])->name('store');
        Route::put('update/{id}',  [CategoryController::class, 'update'])->name('update');
        Route::delete('destroy/{id}',  [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('{id}/edit',  [CategoryController::class, 'edit'])->name('edit');
        Route::post('/check-subject-id-unique',  [CategoryController::class, 'checkSubjectIdUnique']);
        Route::post('/check-subject-id-unique-update',  [CategoryController::class, 'checkSubjectIdUniqueUpdate']);
        Route::put('/toggleActive/{id}',  [CategoryController::class, 'toggleActive'])->name('toggleActive');
    });
});
