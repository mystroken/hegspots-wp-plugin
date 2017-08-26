<?php

/*
|--------------------------------------------------------------------------
| Routes of the application
|--------------------------------------------------------------------------
|
| A route is an object containing a path, parameters and the action to be called (controller).
|
*/

use Vitaminate\Routing\RouteCollection;
use Vitaminate\Routing\Route;

$routeCollection = new RouteCollection();

// Register your routes here
$routeCollection->add('dashboard_index',
    new Route('/wp-admin/admin.php', [
            'page' => 'heg-spots-index.php'
        ],
        'App\Http\Controllers\Admin\DashboardController@index'
    )
);

return $routeCollection;