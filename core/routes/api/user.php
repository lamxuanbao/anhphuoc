<?php
Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/', 'UserController@index');
    Route::get('/{id:[0-9]+}', 'UserController@show');
    Route::post('/create', 'UserController@store');
    Route::put('/{id:[0-9]+}', 'UserController@update');
    Route::delete('/{id:[0-9]+}', 'UserController@destroy');
});

//Route::get('/', 'UserController@index');
