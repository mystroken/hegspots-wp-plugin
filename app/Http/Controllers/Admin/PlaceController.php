<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;

class PlaceController extends Controller
{
	public function index()
	{
		$this->render('place.index');
	}
}