<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use Vitaminate\Http\Request;
use \Vitaminate\View\View;

class DashboardController extends Controller
{
	public function index(Request $request)
	{
		$this->render('dashboard.index');
	}

	public function options(Request $request)
    {
        $this->render('dashboard.options');
    }

    /**
     * @param Request $request
     */
    public function initSubRouting(Request $request, $page)
    {
        // Options action
        $this->subRouter->addRoute(
            'dashboard_index',
            [
                'page' => $page,
                'action' => 'options',
            ],
            $this,
            'options',
            ['request' => $request]
        );

        // Default action
        $this->subRouter->addRoute(
            'dashboard_index',
            [
                'page' => $page,
            ],
            $this,
            'index',
            ['request' => $request]
        );
    }
}