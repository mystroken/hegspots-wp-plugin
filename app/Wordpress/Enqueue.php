<?php

// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_plugin_front_scripts' );
add_action( 'admin_enqueue_scripts', 'register_plugin_admin_scripts' );

function register_plugin_front_scripts($hook)
{
	wp_enqueue_style( 'hegspots-front-style', asset('css/style.css'), [], '1.4');

	wp_enqueue_script(
	    'hegspots-front-script',
	    asset('js/src/front/app.js'),
	    array('jquery'),
	    '1.3',
	    true
	);
}

/**
 * Register style sheet.
 */
function register_plugin_admin_scripts($hook) {

	$usingGoogleMap = [
		'heg-spots_page_heg-spots-places',
	];

	// Register angular js
	//wp_register_script('angularjs', asset('js/vendors/angular/angular.min.js'), [], '1.4.2', true);


	// Register React
	//wp_register_script('react', asset('js/vendors/react/react.min.js'), [], '0.14.3', true);
	//wp_register_script('react-dom', asset('js/vendors/react/react-dom.min.js'), [], '0.14.3', true);


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

/*
	wp_enqueue_script(
	    'hegspots-script-react-app',
	    asset('js/src/admin/react-app.js'),
	    array('jquery', 'react', 'react-dom'),
	    false,
	    true
	);*/

	if( in_array($hook, $usingGoogleMap) )
	{

		wp_register_script('googlemaps', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyDp74TKG781ooxYyGpm5K6y8FRCdQNXofU', false, '3');
		wp_enqueue_script('googlemaps');

		wp_enqueue_script(
		    'hegspots-place-map',
		    asset('js/src/admin/places-map.js'),
		    array('googlemaps'),
		    false,
		    false
		);
	}
}

add_filter('clean_url', 'so_handle_038', 99, 3);
function so_handle_038($url, $original_url, $_context) {
    if (strstr($url, "googleapis.com") !== false) {
        $url = str_replace("&#038;", "&", $url); // or $url = $original_url
    }

    return $url;
}
