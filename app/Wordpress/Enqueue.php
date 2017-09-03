<?php

// Register style sheet.
add_action( 'admin_enqueue_scripts', 'register_plugin_scripts' );

/**
 * Register style sheet.
 */
function register_plugin_scripts() {
	
	// Register angular js
	//wp_register_script('angularjs', asset('js/vendors/angular/angular.min.js'), [], '1.4.2', true);

	// Enqueue WP Media JavaScript
	wp_enqueue_media();


	wp_register_style( 'hegspots-style', asset('css/admin.css'));
	wp_enqueue_style( 'hegspots-style' );

	wp_enqueue_script(
	    'hegspots-script-app',
	    asset('js/src/admin/app.js'),
	    array('jquery'),
	    false,
	    true
	);
}