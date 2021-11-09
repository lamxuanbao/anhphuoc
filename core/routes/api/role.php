<?php
Route::group(['middleware' => 'core-jwt'], function () {
    Route::get('/', 'RoleController@index');
    Route::get('/{id:[0-9]+}', 'RoleController@show');
    Route::get('/permissions', 'RoleController@permissions');
    Route::post('/create', 'RoleController@store');
    Route::put('/{id:[0-9]+}', 'RoleController@update');
    Route::delete('/{id:[0-9]+}', 'RoleController@destroy');
});
