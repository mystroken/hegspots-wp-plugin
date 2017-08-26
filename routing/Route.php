<?php

namespace Vitaminate\Routing;
use Vitaminate\Routing\Exceptions\InvalidCallableException;

/**
 * Class Route
 *
 * @author Mystro Ken <mystroken@gmail.com>
 * @package Vitaminate\Routing
 */
class Route
{
    /**
     * @var string $path
     */
    protected $path;

    /**
     * @var array $parameters
     */
    protected $parameters = [];

    /**
     * @var string $controller
     */
    protected $controller;

    /**
     * @var array
     */
    protected $actionArguments = [];


    /**
     * Instantiate a new route.
     *
     * @param string $path
     * @param array $parameters
     * @param string $controller
     */
    public function __construct($path, $parameters, $controller)
    {
        $this->path = $path;
        $this->parameters = (array) $parameters;
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return self
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     * @return self
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return array
     */
    public function getActionArguments()
    {
        return $this->actionArguments;
    }

    /**
     * @param $argument
     * @return $this
     */
    public function addActionArgument($argument)
    {
        $this->actionArguments[] = $argument;
        return $this;
    }

    /**
     * @param array $actionArguments
     * @return $this
     */
    public function setActionArguments($actionArguments)
    {
        $this->actionArguments = $actionArguments;
        return $this;
    }

    public function runAction()
    {
        if( is_callable($this->controller) )
        {
            return call_user_func_array($this->controller, $this->actionArguments);
        }
        else if( is_string($this->controller) )
        {
            $decomposition = explode('@', $this->controller);

            if(sizeof($decomposition) === 2)
            {
                $controller = $decomposition[0];
                $action = $decomposition[1];

                $controllerInstance = new $controller();
                return call_user_func([$controllerInstance, 'callAction'], $action, $this->actionArguments);
            }
        }

        throw new InvalidCallableException("The action of the route can't be called!");
    }
}