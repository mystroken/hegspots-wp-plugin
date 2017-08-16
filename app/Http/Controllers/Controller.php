<?php

namespace App\Http\Controllers;

use App\Http\Routing\SubRoute;
use App\Http\Routing\SubRouter;
use Vitaminate\Http\Controller as BaseController;
use Vitaminate\Foundation\Application;
use Vitaminate\Http\Request;
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

    /**
     * @var SubRouter $subRouter
     */
	protected $subRouter;


	public function __construct()
	{
		$this->app = app();
        $this->subRouter = $this->app->make('SubRouter');
        $this->view = new View(realpath( $this->app->make('path.base') . '/resources/views/'), [
            'subRouter' => $this->subRouter
        ]);
    }

	/**
	 * Load a template and returns the result as a string or echo it
	 *
	 * @param $template string the filename without the extension
	 * @param array $data
	 * @param boolean $echo
	 *
	 * @throws \InvalidArgumentException
	 * @throws \RuntimeException
	 * @throws \Exception
	 */
	protected function render($template, array $data = [], $echo = true)
	{
		$this->view->load($template, $data, $echo);
	}

    /**
     * @param Request $request
     */
    public abstract function initSubRouting(Request $request, $page);

    /**
     * @param Request $request
     */
    public function respond(Request $request, $page)
    {
        // First register sub routing system
        $this->initSubRouting($request, $page);

        /**
         * From Request pick the correct SubRoute
         * @var SubRoute $subRoute
         */
        $subRoute = $this->subRouter->match($request);
        if(null !== $subRoute) $subRoute->respond();
    }
}