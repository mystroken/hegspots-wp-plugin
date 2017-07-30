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



$config = @require_once dirname(__FILE__) . '/config/config.php';
require __DIR__ . '/vendor/autoload.php';


use \WordPruss\Admin\Page\Menu;
use \WordPruss\Admin\Page\SubMenu;
use \WordPruss\Admin\Page\Page;

//$shortcode = new \WordPruss\Shortcode('test');
//$shortcode->handle(function($content, $attributes){
//	return '<strong>Here is a test!</strong>';
//});
//$shortcode->hook();

Class TestShortcode {

  protected $shortcode;

  public function __construct(){
    $this->shortcode = new \WordPruss\Shortcode('test', [
      'defaultAttribute1' => 'value'
    ]);
  }

  public function handleShortcode($attributes, $content){
    
    var_dump($attributes);

    return 
       '<input type="text" placeholder="First Name">'
      .'<input type="text" placeholder="Last Name">'
      .'<input type="text" placeholder="Email">'
      .'<button>Register</button>'
    ;
  }

  public function boot(){
    $this->shortcode->handle([$this, 'handleShortcode']);
    $this->shortcode->hook();
  }

}

$testShortcode = new TestShortcode();
//$testShortcode->boot();



// Creates a new admin menu
$adminMenu = new Menu([
    'title' => 'My Plugin Name',
    'slug' => 'my_plugin_name_menu'
]);

// Creating a new submenu
$adminSubMenu = new SubMenu([
    'title' => 'My Plugin Name',
    'slug' => 'my_plugin_name_submenu',
    'parent_slug' => $adminMenu->getArgument('slug')//'plugins.php'
]);

// Create a panel for the menu
$adminPanel = new Page([
    'title' => 'Plugin Name - Welcome to the settings page',
    'role' => 'manage_options',
    'callback' => function() {
        $ken = \App\Models\Member::first();
        $location = $ken->location;
        var_dump($location); 
     }
]);

$adminMenu->setPage($adminPanel)->hook();
$adminSubMenu->setPage($adminPanel)->hook();

$app = new \Plugino\Application($config);
$app->run();


/**
 * Load Translation Domain 
 * Adds i18 Language Support
 */
load_plugin_textdomain('plugino', false, __DIR__ . '/resources/languages/');


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
}
