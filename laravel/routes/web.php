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

//Route::get(
//    '/',
//    function () {
//        return view('welcome');
//    }
//);

//Auth::routes();

Route::get('/', [App\Http\Controllers\Storefront\PagesController::class, 'index'])->name('home');
Route::get('/khu-vuc', [App\Http\Controllers\Storefront\PagesController::class, 'area'])->name('area');

Route::group(
    ['prefix' => 'admin'],
    function () {
        Route::get('/', [App\Http\Controllers\Admin\PagesController::class, 'index'])->name('admin-home');
        Route::get('/login', [App\Http\Controllers\Admin\PagesController::class, 'login'])->name('admin-login');
    }
);
