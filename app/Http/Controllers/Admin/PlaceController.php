<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Wordpress\Admin\ListTable\PlaceListTable;
use Vitaminate\Http\Request;

class PlaceController extends Controller
{
	public function index(Request $request)
	{
        $placeListTable = new PlaceListTable();
        return $this->render('place.index', [ 'placeListTable' => $placeListTable]);
	}

    public function create(Request $request)
    {
        return $this->render('place.create');
    }
}