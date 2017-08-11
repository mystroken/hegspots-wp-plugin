<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use Vitaminate\Http\Request;
use \Vitaminate\View\View;

class DashboardController extends Controller
{
	public function index(Request $request)
	{
	    var_dump($request);
		$this->render('dashboard.index');
	}
}