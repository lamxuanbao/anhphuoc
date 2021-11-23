<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Admin')->group(function () {

    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::put('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function (){
            return redirect()->route('admin.property');

        })->name('admin.home');

        Route::get('/setting', 'SettingController@edit')->name('admin.setting');
        Route::put('/setting', 'SettingController@update');

        Route::get('/customer', 'CustomerController@index')->name('admin.customer.index');

        Route::get('/property', 'PropertyController@index')->name('admin.property');
        Route::get('/property/create', 'PropertyController@create')->name('admin.property.create');
        Route::post('/property/create', 'PropertyController@store');
    });
});
