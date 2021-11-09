<?php
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'RoleController@index');
    Route::post('/create', 'RoleController@store');
//Route::get('/{id}', 'UserController@show')
//    ->where('id', '[0-9]+');
//Route::post('/{id}', 'UserController@update')
//    ->where('id', '[0-9]+');
//Route::delete('/{id}', 'UserController@destroy')
//    ->where('id', '[0-9]+');
//Route::group(['middleware' => 'jwt.auth'], function () {
//    Route::get('/', 'UserController@index');
//});
    Route::get('/permission', 'RoleController@permission');
});
