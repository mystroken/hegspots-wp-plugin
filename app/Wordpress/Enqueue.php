<?php

if( !function_exists('asset') )
{
	function asset($resource)
	{
		$config = app('config');
		return $config['url'] .'/assets/'. $resource;
	}
}

// Register style sheet.
add_action( 'admin_enqueue_scripts', 'register_plugin_styles' );

/**
 * Register style sheet.
 */
function register_plugin_styles() {
	wp_register_style( 'hegspots-style', asset('css/admin.css'));
	wp_register_script( 'hegspots-script', asset('js/src/admin-application.js'), ['jquery'], false, true);

	wp_enqueue_style( 'hegspots-style' );
	wp_enqueue_script( 'hegspots-script' );
}