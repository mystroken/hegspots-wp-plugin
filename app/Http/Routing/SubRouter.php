<?php

namespace App\Http\Routing;

use App\Http\Controllers\Controller;
use Vitaminate\Http\Request;

class SubRouter
{

	/**
	 * The list of registered (sub)routes
	 */
	protected $routes = [];


    /**
     * @param $name
     * @param $queries
     * @param $controller
     * @param $action
     * @param array $args
     * @param bool $isAdmin
     */
	public function addRoute($name, $queries, $controller, $action, $args = [], $isAdmin = true)
	{
        $route = new SubRoute(
            add_query_arg( $queries, admin_url( 'admin.php' ) ) ,
            $name,
            [$controller, 'callAction'],
            [$action, $args]
        );
        $route->setQueries($queries);

        $this->routes[] = $route;
	}

    /**
     * Returns null or a SubRoute instance from matched queries
     *
     * @param Request $request
     * @return SubRoute|null
     */
	public function match(Request $request)
    {
        $subRoute = null;
        $routes = $this->routes;
        $routesNum = count($routes);
        $requestQueries = $request->query->all();

        for($i = 0; $i < $routesNum; $i++)
        {
            /** @var SubRoute $route */
            $route = $routes[$i];
            $routeQueries = $route->getQueries();
            $matchedQueries = array_intersect($routeQueries, $requestQueries);

            if( $routeQueries == $matchedQueries )
            {
                $subRoute = $route;
                break;
            }
        }

        return $subRoute;
    }

    /**
     * @param $routeName
     * @return string
     */
    public function generateUrl($routeName)
    {
        $routes = $this->routes;
        $routesNum = count($routes);
        $returnedUrl = '';

        for($i = 0; $i < $routesNum; $i++)
        {
            /** @var SubRoute $route */
            $route = $routes[$i];

            if( $routeName == $route->getName() )
            {
                $returnedUrl = $route->getUrl();
                break;
            }
        }

        return $returnedUrl;
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param mixed $routes
     * @return self
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
        return $this;
    }
}