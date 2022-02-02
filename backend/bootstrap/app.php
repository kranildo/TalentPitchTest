<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app = new \Dusterio\LumenPassport\Lumen7Application(
    dirname(__DIR__)
);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('app');
// config mpociot/laravel-apidoc-generator | https://github.com/mpociot/laravel-apidoc-generator
$app->configure('apidoc');
// config dusterio/lumen-passport | https://github.com/dusterio/lumen-passport
$app->configure('auth');
// config spatie/laravel-permission | https://github.com/spatie/laravel-permission
$app->configure('permission');
// config spatie/laravel-activitylog | https://github.com/spatie/laravel-activitylog
$app->configure('activitylog');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

$app->routeMiddleware([
    'auth' => App\Http\Middleware\AuthenticateJson::class,
    //Middleware do spatie/laravel-permission | https://github.com/spatie/laravel-permission
    'permission' => Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role'       => Spatie\Permission\Middlewares\RoleMiddleware::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

// registra lumen-generator | https://packagist.org/packages/flipbox/lumen-generator
$app->register(\Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
// registra mpociot/laravel-apidoc-generator | https://github.com/mpociot/laravel-apidoc-generator
$app->register(\Mpociot\ApiDoc\ApiDocGeneratorServiceProvider::class);
// Registrar pearl/lumen-request-validate | https://github.com/pearlkrishn/lumen-request-validate
$app->register(\Pearl\RequestValidate\RequestServiceProvider::class);
// Registrar dusterio/lumen-passport | https://github.com/dusterio/lumen-passport
$app->register(Laravel\Passport\PassportServiceProvider::class);
$app->register(Dusterio\LumenPassport\PassportServiceProvider::class);
// service provide spatie/laravel-permission | https://github.com/spatie/laravel-permission
$app->register(Spatie\Permission\PermissionServiceProvider::class);

// cache alias spatie/laravel-permission | https://github.com/spatie/laravel-permission
$app->alias('cache', \Illuminate\Cache\CacheManager::class);
/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

// Rotas dusterio/lumen-passport | https://github.com/dusterio/lumen-passport
\Dusterio\LumenPassport\LumenPassport::routes($app, ['prefix' => 'api/v1/oauth']);

// Definir expiração do token em 1 hora
\Dusterio\LumenPassport\LumenPassport::tokensExpireIn(\Carbon\Carbon::now()->addHour(1)); 

return $app;
