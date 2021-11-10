<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Kizi\Core\Contracts\Repositories\RoleRepository;
use Kizi\Core\Models\Roles;
use Kizi\Core\Models\Settings;

$router->get('/', function () use ($router) {

    return $router->app->version();
});
$router->group(['prefix' => '/'], function () use ($router) {
    try {
        $files = File::files(__DIR__.'/api');
        foreach ($files as $file) {
            $prefix = str_replace('.'.$file->getExtension(), '', $file->getBasename());
            $router->group([
                'prefix' => slugify($prefix),
            ], function () use ($file) {
                require $file->getPathname();
            });
        }
    }catch (Exception $e){

    }
});
