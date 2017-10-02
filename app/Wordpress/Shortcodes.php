<?php

use WordPruss\Shortcode;
use App\Models\Activity;
use App\Models\Place;
use App\Models\TypePlace;
use App\Models\Member;
use App\Models\Location;
use App\Models\Options;


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
	$perPage = Options::PERPAGE;
	$itemID = $request->query->get('item');


	/*
	|----------------------------------------
	| HOMEPAGE
	|----------------------------------------
	*/
	if( is_null($itemID) )
	{
		$places = Place::fromFilter($currentTypeFilter, $currentLocationFilter)->forPage($page, $perPage)->orderBy('ID', 'desc')->get();

		$total = Place::fromFilter($currentTypeFilter, $currentLocationFilter)->count();
		$totalQuery = $places->count();
		$locations = Location::orderBy('slug', 'asc')->get();
		$types = TypePlace::orderBy('name', 'asc')->get();


		$view->load(
			'front.places',
			[
				'places'    => $places,
				'locations' => $locations,
				'types'     => $types,
				'currentTypeFilter'     => $currentTypeFilter,
				'currentLocationFilter' => $currentLocationFilter,
				'total'     => $total,
				'totalQuery'=> $totalQuery,
				'perPage'   => $perPage,
				'page'      => $page,
				'isThereNext' => $total - ( (($page - 1) * $perPage) + $totalQuery) > 0,
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

	$currentActivityFilter = $request->query->get('activity');
	$currentLocationFilter = $request->query->get('location');
	$page = (get_query_var('page')) ? get_query_var('page') : 1;
	$perPage = Options::PERPAGE;
	$itemID = $request->query->get('item');


	/*
	|----------------------------------------
	| HOMEPAGE
	|----------------------------------------
	*/
	if( is_null($itemID) )
	{
		$members = Member::fromFilter($currentActivityFilter, $currentLocationFilter)->forPage($page, $perPage)->orderBy('ID', 'desc')->get();

		$total = Member::fromFilter($currentActivityFilter, $currentLocationFilter)->count();
		$totalQuery = $members->count();
		$locations = Location::orderBy('slug', 'asc')->get();
		$activities = Activity::orderBy('name', 'asc')->get();


		$view->load(
			'front.members',
			[
				'members'   => $members,
				'locations' => $locations,
				'activities'=> $activities,
				'currentActivityFilter' => $currentActivityFilter,
				'currentLocationFilter' => $currentLocationFilter,
				'total'     => $total,
				'totalQuery'=> $totalQuery,
				'perPage'   => $perPage,
				'page'      => $page,
				'isThereNext' => $total - ( (($page - 1) * $perPage) + $totalQuery) > 0,
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
		$member = Member::find($itemID);

		if( $member )
		{
			$otherMembers = Member::orderByRaw("RAND()")->where('ID', '!=', $member->ID)->orderBy('name', 'desc')->limit(3)->get();

			$view->load(
				'front.members_single',
				[
					'member' => $member,
					'otherMembers' => $otherMembers,
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


// hooking
$homeShortcode->hook();
$placesShortcode->hook();
$membersShortcode->hook();
