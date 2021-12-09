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


        Route::group(
            ['prefix' => 'me'],
            function () {
                Route::get('/', 'AuthController@index')->name('admin.profile');
                Route::put('/', 'AuthController@update');
            }
        );

        Route::group(
            ['prefix' => 'setting'],
            function () {
                Route::get('/', 'SettingController@edit')->name('admin.setting');
                Route::put('/', 'SettingController@update');
            }
        );
        Route::get('/setting', 'SettingController@edit')->name('admin.setting');
        Route::put('/setting', 'SettingController@update');

        Route::group(
            ['prefix' => 'customer'],
            function () {
                Route::get('/', 'CustomerController@index')->name('admin.customer');
                Route::get('/delete/{id}', 'CustomerController@destroy')->name('admin.customer.delete');
            }
        );

        Route::group(
            ['prefix' => 'province'],
            function () {
                Route::get('/', 'ProvinceController@index')->name('admin.province');
                Route::get('/create', 'ProvinceController@create')->name('admin.province.create');
                Route::put('/create', 'ProvinceController@store');
                Route::get('/update/{id}', 'ProvinceController@edit')->name('admin.province.update');
                Route::put('/update/{id}', 'ProvinceController@update');
                Route::get('/delete/{id}', 'ProvinceController@destroy')->name('admin.province.delete');
            }
        );
        Route::group(
            ['prefix' => 'property'],
            function () {
                Route::get('/', 'PropertyController@index')->name('admin.property');
                Route::get('/create', 'PropertyController@create')->name('admin.property.create');
                Route::put('/create', 'PropertyController@store');
                Route::get('/update/{id}', 'PropertyController@edit')->name('admin.property.update');
                Route::put('/update/{id}', 'PropertyController@update');
                Route::get('/delete/{id}', 'PropertyController@destroy')->name('admin.property.delete');

                Route::get('/active/{id}', 'PropertyController@active')->name('admin.property.active');
            }
        );
        Route::group(
            ['prefix' => 'deposit'],
            function () {
                Route::get('/', 'DepositController@index')->name('admin.deposit');
                Route::get('/view/{id}', 'DepositController@view')->name('admin.deposit.view');
                Route::get('/delete/{id}', 'DepositController@destroy')->name('admin.deposit.delete');
            }
        );
    });
});
