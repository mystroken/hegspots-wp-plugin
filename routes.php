<?php

/*
|--------------------------------------------------------------------------
| Routes of the application
|--------------------------------------------------------------------------
|
| A route is an object containing a path, parameters and the action to be called (controller).
|
*/

use Vitaminate\Routing\RouteCollection;
use Vitaminate\Routing\AdminRoute;
use Vitaminate\Routing\Route;
use App\Models\Options;

$routeCollection = new RouteCollection();

// Dashboard
$routeCollection->add('dashboard_index',
    new AdminRoute(
        'App\Http\Controllers\Admin\DashboardController@index',
        [ 'page' => 'heg-spots-index.php' ]
    )
);


// Places

$routeCollection->add('place_edit',
    new AdminRoute(
        'App\Http\Controllers\Admin\PlaceController@edit',
        [ 'page' => 'heg-spots-places.php', 'action' => 'edit' ]
    )
);

$routeCollection->add('place_create',
    new AdminRoute(
        'App\Http\Controllers\Admin\PlaceController@create',
        [ 'page' => 'heg-spots-places.php', 'action' => 'create' ]
    )
);

$routeCollection->add('place_index',
    new AdminRoute(
        'App\Http\Controllers\Admin\PlaceController@index',
        [ 'page' => 'heg-spots-places.php' ]
    )
);

// Type Of Places

$routeCollection->add('type_of_place_delete',
    new AdminRoute(
        'App\Http\Controllers\Admin\TypeOfPlaceController@delete',
        [ 'page' => 'heg-spots-types-of-place.php', 'action' => 'delete' ]
    )
);

$routeCollection->add('type_of_place_index',
    new AdminRoute(
        'App\Http\Controllers\Admin\TypeOfPlaceController@index',
        [ 'page' => 'heg-spots-types-of-place.php' ]
    )
);


// Members

$routeCollection->add('member_edit',
    new AdminRoute(
        'App\Http\Controllers\Admin\MemberController@editMember',
        [ 'page' => 'heg-spots-members.php', 'action' => 'edit-member' ]
    )
);

$routeCollection->add('member_create',
    new AdminRoute(
        'App\Http\Controllers\Admin\MemberController@createMember',
        [ 'page' => 'heg-spots-members.php', 'action' => 'create-member' ]
    )
);

$routeCollection->add('member_index',
    new AdminRoute(
        'App\Http\Controllers\Admin\MemberController@index',
        [ 'page' => 'heg-spots-members.php' ]
    )
);


// Activities
$routeCollection->add('activity_delete',
    new AdminRoute(
        'App\Http\Controllers\Admin\ActivityController@delete',
        [ 'page' => 'heg-spots-activities.php', 'action' => 'delete' ]
    )
);

$routeCollection->add('activity_index',
    new AdminRoute(
        'App\Http\Controllers\Admin\ActivityController@index',
        [ 'page' => 'heg-spots-activities.php' ]
    )
);


// Options
$routeCollection->add('options_page_settings',
    new AdminRoute(
        'App\Http\Controllers\Admin\OptionsController@pageSetting',
        [ 'page' => 'heg-spots-options.php', 'action' => 'page-settings' ]
    )
);

$routeCollection->add('options_index',
    new AdminRoute(
        'App\Http\Controllers\Admin\OptionsController@index',
        [ 'page' => 'heg-spots-options.php' ]
    )
);


/*
|-----------------------------------
| Route for front
|-----------------------------------
*/

$routeCollection->add('front_home',
    new Route(
    	'/',
        'App\Http\Controllers\Admin\PlaceController@front',
        [
        	'p' => Options::getPageID('home')
    	]
    )
);

$routeCollection->add('front_places',
    new Route(
    	'/',
        'App\Http\Controllers\Admin\PlaceController@front',
        [
        	'p' => Options::getPageID('places')
    	]
    )
);

$routeCollection->add('front_members',
    new Route(
    	'/',
        'App\Http\Controllers\Admin\PlaceController@front',
        [
        	'p' => Options::getPageID('members')
    	]
    )
);


return $routeCollection;
