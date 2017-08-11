<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use Vitaminate\Http\Request;

class PlaceController extends Controller
{
	public function index(Request $request)
	{
        var_dump($request);
		$this->render('place.index');
	}
}