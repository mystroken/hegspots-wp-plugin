<?php

// Shortcodes

use WordPruss\Shortcode;

/** @var \Vitaminate\Http\Request $request */
$request = $app->make('request');

$homeShortcode = new Shortcode('test', []);

$homeShortcode->handle(function($atts, $content) use ($app, $request) {
	/**
	 * @var \App\Http\Controllers\Controller $dashboardController
	 */
	$dashboardController = $app->make('controller.dashboard');
	$dashboardController->respond($request, 'heg-spots-index.php');
});

$homeShortcode->hook();