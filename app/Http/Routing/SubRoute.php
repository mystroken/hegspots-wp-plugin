<?php

namespace App\Http\Routing;

class SubRoute
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $queries = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * SubRoute constructor.
     *
     * @param $url
     * @param $name
     * @param $callback
     * @param $arguments
     */
	public function __construct($url, $name, $callback, $arguments = [])
    {
        $this->url = $url;
        $this->name = $name;
        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    public function respond()
    {
        return call_user_func_array($this->callback, $this->arguments);
    }

    /**
     * @return array
     */
    public function getQueries()
    {
        return $this->queries;
    }

    /**
     * @param array $queries
     */
    public function setQueries($queries)
    {
        $this->queries = $queries;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param callable $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }
}