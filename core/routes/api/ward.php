<?php
Route::get('/', 'WardController@index');
Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/{id:[0-9]+}', 'WardController@show');
    Route::post('/create', 'WardController@store');
    Route::put('/{id:[0-9]+}', 'WardController@update');
    Route::delete('/{id:[0-9]+}', 'WardController@destroy');
});
