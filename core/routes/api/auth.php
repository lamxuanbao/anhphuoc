<?php

Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/', 'AuthController@profile');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});
