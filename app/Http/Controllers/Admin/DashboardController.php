<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use \Vitaminate\View\View;

class DashboardController extends Controller
{
	public function index()
	{
		$this->render('dashboard.index');
	}
}