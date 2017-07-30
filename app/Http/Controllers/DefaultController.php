<?php

namespace App\Http\Controllers;

class DefaultController extends Controller
{
	public function index()
	{
		$view = new \Vitaminate\View\View(realpath(__DIR__ . '/../../../resources/views/'));
		echo $view->render('index.html');
	}
}