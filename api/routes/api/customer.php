<?php

Route::post('login', 'CustomerController@login');
Route::post('register', 'CustomerController@store');

Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/', 'CustomerController@profile');
    Route::post('logout', 'CustomerController@logout');
    Route::post('refresh', 'CustomerController@refresh');
});
