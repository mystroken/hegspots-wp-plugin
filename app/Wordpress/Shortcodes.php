<?php

use WordPruss\Shortcode;
use App\Models\Place;
use App\Models\TypePlace;
use App\Models\Member;
use App\Models\Location;

// Shortcodes
/** @var \Vitaminate\Http\Request $request */
$request = $app->make('request');
$view = new \Vitaminate\View\View(realpath( $app->make('path.base') . '/resources/views/'));

// Home
$homeShortcode = new Shortcode('hegspots_home', []);
$homeShortcode->handle(function($atts, $content) use ($app, $request, $view) {

	$randomPlace = Place::orderByRaw("RAND()")->first();
	$latestPlaces = Place::orderBy('ID', 'desc')->limit(3)->get();
	$latestMembers = Member::orderBy('ID', 'desc')->limit(6)->get();
	$placeTypes = TypePlace::all();
	$membersNum = Member::all()->count();

	$view->load(
		'front.home',
		[
			'randomPlace' => $randomPlace,
			'latestPlaces' => $latestPlaces,
			'latestMembers' => $latestMembers,
			'placeTypes' => $placeTypes,
			'membersNum' => $membersNum,
		]
	);
});


// Places
$placesShortcode = new Shortcode('hegspots_places', []);
$placesShortcode->handle(function($atts, $content) use ($app, $request, $view) {

	$currentTypeFilter = $request->query->get('type');
	$currentLocationFilter = $request->query->get('location');
	$page = (get_query_var('page')) ? get_query_var('page') : 1;
	$perPage = 12;
	$itemID = $request->query->get('item');


	/*
	|----------------------------------------
	| HOMEPAGE
	|----------------------------------------
	*/
	if( is_null($itemID) )
	{
		if( !is_null($currentTypeFilter) && !is_null($currentLocationFilter) ){
			$places = Place::where('type_place_id', $currentTypeFilter)->where('location_id', $currentLocationFilter)->forPage($page, $perPage)->orderBy('ID', 'desc')->get();
		}
		elseif ( !is_null($currentTypeFilter) ){
			$places = Place::where('type_place_id', $currentTypeFilter)->forPage($page, $perPage)->orderBy('ID', 'desc')->get();
		}
		elseif ( !is_null($currentLocationFilter) ){
			$places = Place::where('location_id', $currentLocationFilter)->forPage($page, $perPage)->orderBy('ID', 'desc')->get();
		}
		else {
			$places = Place::forPage($page, $perPage)->orderBy('ID', 'desc')->get();
		}

		$locations = Location::orderBy('slug', 'asc')->get();
		$types = TypePlace::orderBy('name', 'asc')->get();


		//$randomPlace = Place::orderByRaw("RAND()")->first();


		$view->load(
			'front.places',
			[
				'places' => $places,
				'locations' => $locations,
				'types' => $types,
				'currentTypeFilter' => $currentTypeFilter,
				'currentLocationFilter' => $currentLocationFilter,
			]
		);
	}
	/*
	|----------------------------------------
	| SINGLE
	|----------------------------------------
	*/
	else
	{
		$itemID = intval($itemID);
		$place = Place::find($itemID);

		if( $place )
		{
			$nearbyPlaces = Place::where('location_id', $place->location->ID)->where('ID', '!=', $place->ID)->orderBy('name', 'desc')->limit(3)->get();

			$view->load(
				'front.places_single',
				[
					'place' => $place,
					'nearbyPlaces' => $nearbyPlaces,
				]
			);
		}
		else
		{
			$view->load(
				'front.404'
			);
		}
	}



});


//Members
$membersShortcode = new Shortcode('hegspots_members', []);
$membersShortcode->handle(function($atts, $content) use ($app, $request, $view) {
	$view->load('front.members');
});


// hooking
$homeShortcode->hook();
$placesShortcode->hook();
$membersShortcode->hook();
