<?php

// Shortcodes

use WordPruss\Shortcode;

/** @var \Vitaminate\Http\Request $request */
$request = $app->make('request');

$homeShortcode = new Shortcode('test', []);

$homeShortcode->handle(function($atts, $content) use ($app, $request) {
	
	$view = new \Vitaminate\View\View(realpath( app('path.base') . '/resources/views/'), [ 'subRouter' => app('SubRouter') ]);
	$view->load('place.create');
	
});

$homeShortcode->hook();