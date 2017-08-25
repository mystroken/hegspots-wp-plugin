<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Vitamin application instance
| which serves as the IoC container for the system binding all of the various parts.
|
*/

$app = new Vitaminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

$config = require_once __DIR__ . '/../config/config.php';
$appConfig = require_once __DIR__ . '/../config/app.php';

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/
$app->instance('config', $config);

// Binds gloabl controllers
foreach ($appConfig['controllers'] as $key => $value) $app->singleton('controller.'.$key, $value);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;