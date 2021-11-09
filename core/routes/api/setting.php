<?php
Route::get('/', 'SettingController@index');
Route::put('/', 'SettingController@store');
//Route::get('/{id}', 'UserController@show')
//    ->where('id', '[0-9]+');
//Route::post('/{id}', 'UserController@update')
//    ->where('id', '[0-9]+');
//Route::delete('/{id}', 'UserController@destroy')
//    ->where('id', '[0-9]+');
//Route::group(['middleware' => 'jwt.auth'], function () {
//    Route::get('/', 'UserController@index');
//});
