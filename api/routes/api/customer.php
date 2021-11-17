<?php

Route::post('login', 'CustomerController@login');

Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/', 'CustomerController@profile');
    Route::post('logout', 'CustomerController@logout');
    Route::post('refresh', 'CustomerController@refresh');
});
