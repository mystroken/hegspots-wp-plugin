<?php

namespace App\Http\Controllers;

class DefaultController extends Controller
{
	public function index()
	{
		$test = 'Here is a test message!';
		$view = new \Vitaminate\View\View(realpath(__DIR__ . '/../../../resources/views/'));
		$view->load('index', array('test' => $test));
	}
}