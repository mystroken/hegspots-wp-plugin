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
use App\Support\Slugger;
use Vitaminate\Routing\URL;

class PlaceController extends Controller
{

	public function index(Request $request)
	{

		if( !empty($request->request->all()) )
        {

        	DB::transaction(function() use($request) {

        		$place = new Place;
        		$slugger = new Slugger;

                
                // Location
                $location = Location::createFromRequest($request);

                
                // Place
                $place->name 		= $request->request->get('name');
                $place->slug 		= $slugger->slugify($place->name);
                $place->description = $request->request->get('description');
                $place->photo 		= $request->request->get('photo');
                $place->instagram 	= $request->request->get('instagram');


                // Link models (Relationship)
                $place->type()->associate(TypePlace::findOrFail(intval($request->request->get('type'))));
                $place->location()->associate($location);


                // Save the place
                $place->save();
        		//var_dump($request->request->all());

        	});
   
        }

        $placeListTable = new PlaceListTable();
        return $this->render('place.index', [ 'placeListTable' => $placeListTable]);
	}


    public function create(Request $request)
    {
    	$types   = TypePlace::all();
    	$members = Member::all();

        return $this->render('place.create', 
        	[
        		'types'   => $types,
        		'members' => $members,
        	]
        );
    }
}