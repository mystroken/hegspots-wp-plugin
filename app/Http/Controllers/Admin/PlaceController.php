<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Wordpress\Admin\ListTable\PlaceListTable;
use Vitaminate\Http\Request;
use App\Models\TypePlace;
use App\Support\Slugger;
use Vitaminate\Routing\URL;
use App\Models\Location;

class PlaceController extends Controller
{

	public function index(Request $request)
	{

		if( !empty($request->request->all()) )
        {
            $slugger = new Slugger;

            var_dump($request->request->all());
        }

        $placeListTable = new PlaceListTable();
        return $this->render('place.index', [ 'placeListTable' => $placeListTable]);
	}


    public function create(Request $request)
    {
    	$types = TypePlace::all();

        return $this->render('place.create', 
        	[
        		'types' => $types,
        	]
        );
    }
}