<?php

namespace Vitaminate\Routing;

use Vitaminate\Foundation\Application;
use Vitaminate\Routing\Contracts\MatcherInterface;
use Vitaminate\Routing\Contracts\RouteCollectionInterface;
use Vitaminate\Routing\Exceptions\RouteNotFoundException;

/**
 * Class Router
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing
 */
class Router
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var MatcherInterface $routeMatcher
     */
    protected $routeMatcher;

    /**
     * @var RouteCollectionInterface
     */
    protected $routeCollection;


    /**
     * Router constructor.
     * @param Application $app
     * @param RouteCollectionInterface $collection
     */
    public function __construct(RouteCollectionInterface $collection, Application $app)
    {
        $this->app = $app;
        $this->routeMatcher = new RouteMatcher();
        $this->routeCollection = $collection;
    }

    public function renderController()
    {
        $route = $this->routeMatcher->getRoute($this->app->make('request'), $this->routeCollection);

        if(null === $route)
        {
            throw new RouteNotFoundException("Route not Found!");
        }

        $route->addActionArgument($this->app->make('request'));
        $route->runAction();
    }
}