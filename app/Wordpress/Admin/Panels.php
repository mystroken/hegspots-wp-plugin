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
    'title' => __('Heg Spots - Dashboard', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($router) {
        $router->run();
    }
]);

$placesPanel = new Page([
    'title' => __('Places - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($router) {
        $router->run();
    }
]);

$typesOfPlacePanel = new Page([
    'title' => __('Types of Place - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($router) {
        $router->run();
    }
]);

$membersPanel = new Page([
    'title' => __('Members - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($router) {
        $router->run();
    }
]);

$activitiesPanel = new Page([
    'title' => __('Activities - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($router) {
        $router->run();
    }
]);

$optionsPanel = new Page([
    'title' => __('Settings - Heg Spots', 'hegspots'),
    'role' => 'manage_options',
    'callback' => function() use ($router) {
        $router->run();
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

$optionsSubMenu = new SubMenu([
    'title' => __('HEG Spots Settings', 'hegspots'),
    'slug' => 'heg-spots-options.php',
    'parent_slug' => $pluginMenu->getArgument('slug')
]);

$pluginMenu->setPage($dashboardPanel)->hook();
$placesSubMenu->setPage($placesPanel)->hook();
$typesOfPlaceSubMenu->setPage($typesOfPlacePanel)->hook();
$membersSubMenu->setPage($membersPanel)->hook();
$activitiesSubMenu->setPage($activitiesPanel)->hook();
$optionsSubMenu->setPage($optionsPanel)->hook();

