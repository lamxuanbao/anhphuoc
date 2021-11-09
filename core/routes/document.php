<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Kizi\Core\Http\Document';
Route::group([
    'namespace' => $namespace,
    'prefix' => 'document',
    'middleware' => 'core-document'
], function () {
    Route::group([
        'prefix' => 'swagger',
    ], function () {
        Route::get('/', 'SwaggerController@index');
        Route::get('/manage', 'SwaggerController@manage');
        Route::get('/manage/{asset}', [
            'as' => 'manage.detail',
            'uses' => 'SwaggerController@detail',
        ]);
        Route::get('/data', [
            'as' => 'swagger.data',
            'uses' => 'SwaggerController@data',
        ]);
        Route::get('{asset}', [
            'as' => 'swagger.asset',
            'uses' => 'AssetController@index',
        ]);
    });
    Route::group([
        'prefix' => 'log',
    ], function () {
        Route::get('/', 'LogController@index');
    });
});
