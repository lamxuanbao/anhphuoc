<?php
Route::get('/', 'DistrictController@index');
Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/{id:[0-9]+}', 'DistrictController@show');
    Route::post('/create', 'DistrictController@store');
    Route::put('/{id:[0-9]+}', 'DistrictController@update');
    Route::delete('/{id:[0-9]+}', 'DistrictController@destroy');
});
