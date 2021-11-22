<?php
Route::get('/', 'PropertyController@index');
Route::get('/slug/{slug}', 'PropertyController@slug');
Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/{id:[0-9]+}', 'PropertyController@show');
    Route::post('/create', 'PropertyController@store');
    Route::put('/{id:[0-9]+}', 'PropertyController@update');
    Route::delete('/{id:[0-9]+}', 'PropertyController@destroy');
});
