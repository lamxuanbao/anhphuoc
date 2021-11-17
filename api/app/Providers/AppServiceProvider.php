<?php

namespace App\Providers;

use App\Libraries\Settings;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \Kizi\Core\Contracts\Services\UserService::class,
            UserService::class
        );
    }
}
