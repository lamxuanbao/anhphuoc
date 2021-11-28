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

Route::namespace('App\Http\Controllers\Storefront')->group(function () {
    Route::get('/', 'PagesController@index')->name('home');
    Route::get('/khu-vuc', 'PagesController@area')->name('area');
    Route::get('/dang-nhap', 'LoginController@showLoginForm')->name('login');
    Route::put('/dang-nhap', 'LoginController@login');
    Route::get('/dang-ky', 'RegisterController@showRegistrationForm')->name('register');
    Route::put('/dang-ky', 'RegisterController@register');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::group(
        ['prefix' => 'auth'],
        function () {
            Route::get('/', 'AuthController@index')->name('auth.me');
            Route::put('/', 'AuthController@update');
            Route::get('/property', 'PropertyController@index')->name('auth.property');
        }
    );
    Route::get('/khu-vuc/{slug}', 'PagesController@detail')->name('detail');
});
