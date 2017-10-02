<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Wordpress\Admin\ListTable\PlaceListTable;
use Vitaminate\Http\Request;
use WeDevs\ORM\Eloquent\Facades\DB;
use App\Models\Place;
use App\Models\TypePlace;
use App\Models\Location;
use App\Models\Member;
use App\Models\MapPosition;
use App\Support\Slugger;
use Vitaminate\Routing\URL;
use Vitaminate\Routing\Redirect;

class PlaceController extends Controller
{

	public function index(Request $request)
	{
		$placeListTable = new PlaceListTable();
		return $this->render('place.index', [ 'placeListTable' => $placeListTable]);
	}


	public function create(Request $request)
	{
		$place = new Place;
		$this->createOrUpdate($place, $request);
	}


	public function edit(Request $request)
	{
		$placeID = intval($request->query->get('item'));
		$place = Place::find($placeID);

		if( !is_null($place) )
		{
			$this->createOrUpdate($place, $request);
		}
		else
		{
			Redirect::to(URL::to('place_index'));
		}
	}


	/**
	 * Manage the creation or updating of a place
	 */
	protected function createOrUpdate(Place $place, Request $request)
	{
		if( !empty($request->request->all()) )
		{
			$slugger = new Slugger;

			// Location
			$location = Location::createFromRequest($request);

			// Map position
			$mapPosition = MapPosition::createFromRequest($request);

			// Recommendators
			$recommendators = (array) $request->request->get('recommendators');


			// Place
			$place->name        = $request->request->get('name');
			$place->slug        = $slugger->slugify($place->name);
			$place->description = $request->request->get('description');
			$place->photo       = $request->request->get('photo');
			$place->instagram   = $request->request->get('instagram');


			// Link models (Relationship)
			$place->type()->associate(TypePlace::findOrFail(intval($request->request->get('type'))));
			$place->location()->associate($location);
			$place->mapPosition()->associate($mapPosition);


			// Save the place
			if( $place->ID > 0 )
			{
				// Updating
				$place->recommandators()->sync($recommendators);
				$place->update();
				Redirect::to(URL::to('place_index'));
			}
			else
			{
				// Saving
				if( $place->save() )
				{
					$place->recommandators()->sync($recommendators);
					Redirect::to(URL::to('place_index'));
				}
			}

		}

		$types   = TypePlace::all();
		$members = Member::orderBy('name', 'asc')->get();

		return $this->render('place.create',
			[
				'types'   => $types,
				'members' => $members,
				'place' => $place,
			]
		);
	}
}
