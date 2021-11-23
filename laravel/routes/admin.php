<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::put('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
//    Route::get('/login', 'LoginController@showLoginForm');
//    Route::post('/login', 'LoginController@login')->name('user.login');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', 'PagesController@index')->name('admin.home');
        Route::get('/setting', 'CustomerController@index')->name('admin.setting');
        Route::get('/customer', 'CustomerController@index')->name('admin.customer.index');
        Route::get('/property', 'PropertyController@index')->name('admin.property');
        Route::get('/property/create', 'PropertyController@create')->name('admin.property.create');
        Route::post('/property/create', 'PropertyController@store');
    });
});
