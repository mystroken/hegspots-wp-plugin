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

require __DIR__ . '/bootstrap/autoload.php';

/*
|------------------------------------------------------------------------
| Load Translation Domain
|------------------------------------------------------------------------
|
| Adds i18 Language Support
*/

load_plugin_textdomain('hegspots', false, basename( dirname( __FILE__ ) ) . '/resources/languages/');

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
use Vitaminate\Foundation\Application;
use Vitaminate\Http\Request;
use WordPruss\Notices\Notify;

/**
 * @var Application $app
 */
$app = require_once __DIR__ . '/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Require Custom WordPress 'Hookable' Components.
|--------------------------------------------------------------------------
|
*/

$app->singleton('SubRouter', function (){
    return new \App\Http\Routing\SubRouter();
});

// Create a request from server variables, and bind it to the container
$request = Request::createFromGlobals();
$app->instance('Vitaminate\Http\Request', $request);
$app->instance('request', $request);

// Create the router instance
$router = new \Vitaminate\Routing\Router( require_once __DIR__ . '/routes.php', $app );
$app->instance('router', $router);


require_once __DIR__ . '/app/Wordpress/Enqueue.php';
require_once __DIR__ . '/app/Wordpress/Shortcodes.php';
require_once __DIR__ . '/app/Wordpress/Admin/Panels.php';


/**
|--------------------------------------------------------------------------
| Attaches Plugin LifeCycle Hooks.
|--------------------------------------------------------------------------
|
*/

$activation_file   = dirname(__FILE__) . '/activate.php';
$deactivation_file = dirname(__FILE__) . '/deactivate.php';
$uninstall_file    = dirname(__FILE__) . '/uninstall.php';

if(
  !file_exists( $activation_file )
	OR !file_exists( $deactivation_file )
	OR !file_exists( $uninstall_file )
){
	throw new Exception("Please check that activate.php, deactivate.php and uninstall.php files are present and well written on the root of your plugin {$config['plugin_path']}");
} else{
	register_activation_hook(  __FILE__, function() use ($activation_file) { include_once $activation_file; });
	register_deactivation_hook(__FILE__, function() use ($deactivation_file) { include_once $deactivation_file; });
}
