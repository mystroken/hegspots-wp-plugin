<?php

use \WordPruss\Admin\Page\Menu;
use \WordPruss\Admin\Page\SubMenu;
use \WordPruss\Admin\Page\Page;


/*
|-------------------------------------------------------------------------
| Creates differents pages.
|-------------------------------------------------------------------------
|
*/

$dashboardPanel = new Page([
    'title' => 'Heg Spots - Dashboard',
    'role' => 'manage_options',
    'callback' => function() use ($app) {
        /**
         * @var \App\Http\Controllers\Admin\DashboardController $dashboardController
         */
      $dashboardController = $app->make('controller.dashboard');
      return $dashboardController->callAction('index', ['request' => $app->make('request')]);
    }
]);

$placesPanel = new Page([
    'title' => 'Places - Heg Spots',
    'role' => 'manage_options',
    'callback' => function() use ($app) {
        /**
         * @var \App\Http\Controllers\DefaultController
         */
      $placeController = new \App\Http\Controllers\Admin\PlaceController();
      return $placeController->callAction('index', ['request' => $app->make('request')]);
    }
]);

/*
|-------------------------------------------------------------------------
| Creates differents menus or submenu for each pages.
|-------------------------------------------------------------------------
|
*/

$pluginMenu = new Menu([
    'title' => __('HEG Spots', 'hegspots'),
    'slug' => 'heg-spots-index.php',
    'icon' => 'dashicons-location-alt',
    'order' => 26.1993,
]);

// Creating a new submenu
$placesSubMenu = new SubMenu([
    'title' => __('Places', 'hegspots'),
    'slug' => 'heg-spots-places.php',
    'parent_slug' => $pluginMenu->getArgument('slug')//'plugins.php'
]);

$pluginMenu->setPage($dashboardPanel)->hook();
$placesSubMenu->setPage($placesPanel)->hook();
