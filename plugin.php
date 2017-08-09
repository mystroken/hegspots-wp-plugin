<?php
/*
Plugin Name: Heg Spot
Description:
Author: Mystro Ken
Author URI: http://mystroken.cm/
Version: 1.0.0
License:

  Copyright 2017 Mystro Ken ( njume48@gmail.com )

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/bootstrap/autoload.php';

/*
|------------------------------------------------------------------------
| Load Translation Domain
|------------------------------------------------------------------------
|
| Adds i18 Language Support
*/

load_plugin_textdomain('hegspots', false, __DIR__ . '/resources/languages/');

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to 'vitaminate' the WordPress PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/bootstrap/app.php';

use \WordPruss\Admin\Page\Menu;
use \WordPruss\Admin\Page\SubMenu;
use \WordPruss\Admin\Page\Page;

// Creates a new admin menu
$adminMenu = new Menu([
    'title' => __('HEG Spots', 'hegspots'),
    'slug' => 'heg-spots-index.php',
    'icon' => 'dashicons-location-alt',
    'order' => 26.1993,
]);

// Creating a new submenu
$adminSubMenu = new SubMenu([
    'title' => __('Places', 'hegspots'),
    'slug' => 'heg-spots-places.php',
    'parent_slug' => $adminMenu->getArgument('slug')//'plugins.php'
]);

// Create a panel for the menu
$adminPanel = new Page([
    'title' => 'Plugin Name - Welcome to the settings page',
    'role' => 'manage_options',
    'callback' => function() use ($app) {
        /**
         * @vat \App\Http\Controllers\DefaultController
         */
      $defaultController = new \App\Http\Controllers\DefaultController(); 
      return $defaultController->index();
    }
]);

$adminMenu->setPage($adminPanel)->hook();
$adminSubMenu->setPage($adminPanel)->hook();


/**
 * Attaches Plugin LifeCycle Hooks
 *
 * Do not remove any of these following lines
 */
$activation_file   = dirname(__FILE__) . '/app/activate.php';
$deactivation_file = dirname(__FILE__) . '/app/deactivate.php';
$uninstall_file    = dirname(__FILE__) . '/app/uninstall.php';

if(
	   !file_exists( $activation_file )
	OR !file_exists( $deactivation_file )
	OR !file_exists( $uninstall_file )
){
	throw new Exception("Please check that activate.php, deactivate.php and uninstall.php files are present and well written under the app directory of your plugin {$config['plugin_path']}");
} else{
	register_activation_hook(  __FILE__, function() { include_once dirname(__FILE__) . '/app/activate.php'; });
	register_deactivation_hook(__FILE__, function() { include_once dirname(__FILE__) . '/app/deactivate.php'; });
    //register_uninstall_hook(__FILE__, function() { include_once dirname(__FILE__) . '/app/uninstall.php'; });
}
