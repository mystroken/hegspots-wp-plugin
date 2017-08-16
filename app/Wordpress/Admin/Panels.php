<?php

use \WordPruss\Admin\Page\Menu;
use \WordPruss\Admin\Page\SubMenu;
use \WordPruss\Admin\Page\Page;


/** @var \Vitaminate\Http\Request $request */
$request = $app->make('request');
/*
|-------------------------------------------------------------------------
| Creates differents pages.
|-------------------------------------------------------------------------
|
*/


$dashboardPanel = new Page([
    'title' => __('Heg Spots - Dashboard', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($app, $request) {
        /**
         * @var \App\Http\Controllers\Controller $dashboardController
         */
      $dashboardController = $app->make('controller.dashboard');
      $dashboardController->respond($request, 'heg-spots-index.php');
    }
]);

$placesPanel = new Page([
    'title' => __('Places - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($app, $request) {
        /**
         * @var \App\Http\Controllers\Controller $placeController
         */
      $placeController = new \App\Http\Controllers\Admin\PlaceController();
      $placeController->respond($request, 'heg-spots-places.php');
    }
]);

$typesOfPlacePanel = new Page([
    'title' => __('Types of Place - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($app, $request) {
        /**
         * @var \App\Http\Controllers\Controller $typesOfPlaceController
         */
      $typesOfPlaceController = new \App\Http\Controllers\Admin\TypeOfPlaceController();
      $typesOfPlaceController->respond($request, 'heg-spots-types-of-place.php');
    }
]);

$membersPanel = new Page([
    'title' => __('Members - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($app, $request) {
        /**
         * @var \App\Http\Controllers\Controller $memberController
         */
        $memberController = new \App\Http\Controllers\Admin\MemberController();
        $memberController->respond($request, 'heg-spots-members.php');
    }
]);

$activitiesPanel = new Page([
    'title' => __('Activities - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($app, $request) {
        /**
         * @var \App\Http\Controllers\Controller $activityController
         */
        $activityController = new \App\Http\Controllers\Admin\ActivityController();
        $activityController->respond($request, 'heg-spots-activities.php');
    }
]);

/*
|-------------------------------------------------------------------------
| Creates different menus or submenu for each pages.
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
    'parent_slug' => $pluginMenu->getArgument('slug')
]);

$typesOfPlaceSubMenu = new SubMenu([
    'title' => __('Types of place', 'hegspots'),
    'slug' => 'heg-spots-types-of-place.php',
    'parent_slug' => $pluginMenu->getArgument('slug')
]);

$membersSubMenu = new SubMenu([
    'title' => __('Members', 'hegspots'),
    'slug' => 'heg-spots-members.php',
    'parent_slug' => $pluginMenu->getArgument('slug')
]);

$activitiesSubMenu = new SubMenu([
    'title' => __('Activities', 'hegspots'),
    'slug' => 'heg-spots-activities.php',
    'parent_slug' => $pluginMenu->getArgument('slug')
]);

$pluginMenu->setPage($dashboardPanel)->hook();
$placesSubMenu->setPage($placesPanel)->hook();
$typesOfPlaceSubMenu->setPage($typesOfPlacePanel)->hook();
$membersSubMenu->setPage($membersPanel)->hook();
$activitiesSubMenu->setPage($activitiesPanel)->hook();

