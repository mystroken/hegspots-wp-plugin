<?php

namespace App\Http\Controllers;

use Vitaminate\Http\Controller as BaseController;
use Vitaminate\Foundation\Application;
use \Vitaminate\View\View;

abstract class Controller extends BaseController
{
	/**
	 * @var Application $app
	 */
	protected $app;

	/**
	 * @var View $view
	 */
	protected $view;


	public function __construct()
	{
		$this->app = app();
		$this->view = new View(realpath( $this->app->make('path.base') . '/resources/views/'));
	}

	/**
	 * Load a template and returns the result as a string or echo it
	 *
	 * @param $template string the filename without the extension
	 * @param array $data
	 * @param boolean $echo
	 *
	 * @return mixed
	 *
	 * @throws \InvalidArgumentException
	 * @throws \RuntimeException
	 * @throws \Exception
	 */
	protected function render($template, array $data = [], $echo = true)
	{
		$this->view->load($template, $data, $echo);
	}
}