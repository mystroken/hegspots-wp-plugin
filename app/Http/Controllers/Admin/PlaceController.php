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

    /**
     * @param Request $request
     */
    public function initSubRouting(Request $request, $page)
    {
        // Default action
        $this->subRouter->addRoute(
            'place_index',
            [
                'page' => $page,
            ],
            $this,
            'index',
            ['request' => $request]
        );
    }
}