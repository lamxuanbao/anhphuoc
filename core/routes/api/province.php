<?php
Route::get('/', 'ProvinceController@index');
Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/{id:[0-9]+}', 'ProvinceController@show');
    Route::post('/create', 'ProvinceController@store');
    Route::put('/{id:[0-9]+}', 'ProvinceController@update');
    Route::delete('/{id:[0-9]+}', 'ProvinceController@destroy');
});
