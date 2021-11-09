<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$namespace = 'Kizi\Core\Http\Controllers';
Route::group([
    'namespace' => $namespace
], function () {
    $files = File::files(__DIR__.'/api');
    foreach ($files as $file) {
        $prefix = str_replace('.'.$file->getExtension(), '', $file->getBasename());
        Route::group([
            'prefix' => slugify($prefix),
        ], function () use ($file) {
            require $file->getPathname();
        });
    }
//    Route::get('swagger', 'AppController@swagger');
//    Route::get(config('swagger-lume.routes.assets').'/{asset}', [
//        'as' => 'core.asset',
//        'middleware' => config('swagger-lume.routes.middleware.asset', []),
//        'uses' => 'Http\Controllers\SwaggerLumeAssetController@index',
//    ]);
});

Route::get('timezones', function (){
    return response_api(timezone_identifiers_list());
});
