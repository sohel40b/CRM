<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [App\Http\Controllers\AdminAuthController::class, 'index'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminAuthController::class, 'store'])->name('admin.post.login');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/home', [App\Http\Controllers\AdminAuthController::class, 'show'])->name('admin.home');
        Route::post('/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
