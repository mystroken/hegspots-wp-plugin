<?php

// Register style sheet.
add_action( 'admin_enqueue_scripts', 'register_plugin_scripts' );

/**
 * Register style sheet.
 */
function register_plugin_scripts() {
	
	// Register angular js
	wp_register_script('angularjs', asset('js/vendors/angular/angular.min.js'), [], '1.4.2', true);


	wp_register_style( 'hegspots-style', asset('css/admin.css'));
	wp_register_script( 'hegspots-script', asset('js/src/admin-application.js'), ['jquery'], false, true);

	wp_enqueue_style( 'hegspots-style' );
	wp_enqueue_script( 'hegspots-script' );

	wp_enqueue_script(
	    'hegspots-angular-app',
	    asset('js/src/admin/app.js'),
	    array('angularjs'),
	    false,
	    true
	);

	wp_enqueue_script(
	    'hegspots-angular-controllers',
	    asset('js/src/admin/controllers.js'),
	    array('angularjs'),
	    false,
	    true
	);
}