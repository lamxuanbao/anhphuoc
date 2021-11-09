<?php

namespace Kizi\Core\Providers;

use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Session\SessionManager;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Kizi\Core\Console\Commands\CoreInstallCommand;
use Kizi\Core\Console\Commands\Create\ProvinceCreateCommand;
use Kizi\Core\Console\Commands\Create\UserCreateCommand;
use Kizi\Core\Console\Commands\Make\ConsoleMakeCommand;
use Kizi\Core\Console\Commands\Make\ControllerMakeCommand;
use Kizi\Core\Console\Commands\Make\ModelMakeCommand;
use Kizi\Core\Console\Commands\Make\RepositoryMakeCommand;
use Kizi\Core\Console\Commands\Make\RequestMakeCommand;
use Kizi\Core\Console\Commands\RouteListCommand;
use Kizi\Core\Console\Commands\StorageLinkCommand;
use Kizi\Core\Contracts\Repositories\DistrictRepository;
use Kizi\Core\Contracts\Repositories\ProvinceRepository;
use Kizi\Core\Contracts\Repositories\RoleRepository;
use Kizi\Core\Contracts\Repositories\UserRepository;
use Kizi\Core\Contracts\Repositories\WardRepository;
use Kizi\Core\Http\Middleware\Cors;
use Kizi\Core\Http\Middleware\SetLocale;
use Kizi\Core\Middleware\VerifyDocumentToken;
use Kizi\Core\Middleware\VerifyJWTToken;
use Kizi\Core\Models\Settings;
use Kizi\Core\Payment\PaymentManager;
use Kizi\Core\Repositories\Eloquent\DistrictRepositoryEloquent;
use Kizi\Core\Repositories\Eloquent\ProvinceRepositoryEloquent;
use Kizi\Core\Repositories\Eloquent\RoleRepositoryEloquent;
use Kizi\Core\Repositories\Eloquent\UserRepositoryEloquent;
use Kizi\Core\Repositories\Eloquent\WardRepositoryEloquent;
use Kizi\Core\Services\ResponseService;
use Laravelista\LumenVendorPublish\VendorPublishCommand;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

class CoreProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        CoreInstallCommand::class,
        ConsoleMakeCommand::class,
        RouteListCommand::class,
        VendorPublishCommand::class,
        RepositoryMakeCommand::class,
        RequestMakeCommand::class,
        UserCreateCommand::class,
        StorageLinkCommand::class,
        ProvinceCreateCommand::class,
        ControllerMakeCommand::class,
        ModelMakeCommand::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerRepository();
        $this->registerRouteMiddleware();
        $this->commands($this->commands);
        $this->app->singleton('responseApi', function () {
            return new ResponseService();
        });
        $this->registerProvider();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('setting', function () {
            return new \Kizi\Core\Libraries\Settings(Settings::allCached());
        });

        $session = $this->app->loadComponent('session', SessionServiceProvider::class, 'session');
        $this->app->singleton(SessionManager::class, function () use ($session) {
            return $session;
        });

        $sessionStore = $this->app->loadComponent('session', SessionServiceProvider::class,
            'session.store');
        $this->app->singleton('session.store', function () use ($sessionStore) {
            return $sessionStore;
        });

        $this->app->routeMiddleware([
            'core-jwt' => VerifyJWTToken::class,
            'core-document' => VerifyDocumentToken::class,
        ]);
        $this->registerPublishing();
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../../routes/document.php');
        $this->setupConfig();

        $viewPath = __DIR__.'/../../views';
        $this->loadViewsFrom($viewPath, 'core');

        $path = __DIR__.'/../../../storage/framework/sessions';
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, false);
        }

    }

    private function registerConfig()
    {
        $this->app->configure('app');
        $this->app->configure('auth');
        $this->app->configure('database');
        $this->app->configure('mail');
        $this->app->configure('swagger');
        $path = realpath(__DIR__.'/../../resources/app');
        $this->mergeConfigFrom($path.'/config/app.php', 'app');
        $this->mergeConfigFrom($path.'/config/auth.php', 'auth');
        $this->mergeConfigFrom($path.'/config/database.php', 'database');
        $this->mergeConfigFrom($path.'/config/mail.php', 'mail');
        $this->mergeConfigFrom($path.'/config/swagger.php', 'swagger');

        $this->app->configure('permissions');
        $path = realpath(__DIR__.'/../../resources/permissions/config/config.php');
        $this->mergeConfigFrom($path, 'permissions');

        $this->app->configure('jwt');
        $this->app->register(LumenServiceProvider::class);
        $path = realpath(__DIR__.'/../../resources/jwt/config/config.php');
        $this->mergeConfigFrom($path, 'jwt');

        $this->app->configure('filesystems');
        $this->app->register(FilesystemServiceProvider::class);
        $path = realpath(__DIR__.'/../../resources/filesystems/config/config.php');
        $this->mergeConfigFrom($path, 'filesystems');

        $this->app->configure('settings');
        $path = realpath(__DIR__.'/../../resources/settings/config/config.php');
        $this->mergeConfigFrom($path, 'settings');

        $this->app->configure('repository');
        $path = realpath(__DIR__.'/../../resources/repository');
        $this->mergeConfigFrom($path.'/config/config.php', 'repository');

        $this->app->configure('session');
        $path = realpath(__DIR__.'/../../resources/app/config/session.php');
        config(['session' => require $path]);
    }

    private function registerProvider()
    {
        $this->app->register(\Illuminate\Mail\MailServiceProvider::class);
        $this->app->singleton('payment', function ($app) {
            return new PaymentManager($app);
        });
    }

    protected function registerRepository()
    {
        $this->app->singleton(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->singleton(RoleRepository::class, RoleRepositoryEloquent::class);
        $this->app->singleton(ProvinceRepository::class, ProvinceRepositoryEloquent::class);
        $this->app->singleton(DistrictRepository::class, DistrictRepositoryEloquent::class);
        $this->app->singleton(WardRepository::class, WardRepositoryEloquent::class);

        $repository = config('repository');
        $basePath = $repository['generator']['basePath'];
        $rootNamespace = $repository['generator']['rootNamespace'];
        $rootRepositories = $repository['generator']['paths']['repositories'];
        $rootInterfaces = $repository['generator']['paths']['interfaces'];
        $repositories = str_replace("\\", "/", $rootRepositories);
        $interfaces = str_replace("\\", "/", $rootInterfaces);
        try {
            $files = File::files($basePath.'/'.$interfaces);
            foreach ($files as $file) {
                $baseName = $file->getFilenameWithoutExtension().'Eloquent';
                if (File::exists($basePath.'/'.$repositories.'/'.$baseName.'.php')) {
                    $abstract = $rootNamespace.$rootInterfaces.'\\'.$file->getFilenameWithoutExtension();
                    $concrete = $rootNamespace.$rootRepositories.'\\'.$baseName;
                    $this->app->singleton($abstract, $concrete);
                }
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../../resources/app/config/app.php' => config_path('app.php')]);
            $this->publishes([__DIR__.'/../../resources/app/config/auth.php' => config_path('auth.php')]);
            $this->publishes([__DIR__.'/../../resources/app/config/database.php' => config_path('database.php')]);
            $this->publishes([__DIR__.'/../../resources/app/config/mail.php' => config_path('mail.php')]);
            $this->publishes([__DIR__.'/../../resources/app/config/swagger.php' => config_path('swagger.php')]);
            $this->publishes([__DIR__.'/../../resources/filesystems/config/config.php' => config_path('filesystems.php')]);
            $this->publishes([__DIR__.'/../../resources/settings/config/config.php' => config_path('settings.php')]);
            $this->publishes([__DIR__.'/../../resources/jwt/config/config.php' => config_path('jwt.php')]);
            $this->publishes([__DIR__.'/../../resources/permissions/config/config.php' => config_path('permissions.php')]);
            $this->publishes([__DIR__.'/../../resources/repository/config/config.php' => config_path('repository.php')]);
        }
    }

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
//        'thirdparty.redirect' => ThirdPartyMiddleware::class,
//        'social.auth' => SocialAuthenticate::class,
    ];

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        $this->app->middleware(Cors::class);
        $this->app->middleware(SetLocale::class);
        $this->app->middleware(StartSession::class);
    }

    /**
     * Setup application timezone.
     *
     * @return void
     */
    private function setupConfig()
    {
        config([
            'filesystems.default' => setting('filesystems_default', config('filesystems.default')),
            'mail.driver' => setting('mail_driver', config('mail.driver')),
            'mail.host' => setting('mail_host', config('mail.host')),
            'mail.port' => setting('mail_port', config('mail.port')),
            'mail.from.address' => setting('mail_from_address', config('mail.from.address')),
            'mail.from.name' => setting('mail_from_name', config('mail.from.name')),
            'mail.encryption' => setting('mail_encryption', config('mail.encryption')),
            'mail.username' => setting('mail_username', config('mail.username')),
            'mail.password' => setting('mail_password', config('mail.password')),
        ]);
    }
}
