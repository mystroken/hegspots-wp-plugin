<?php

namespace App\Http\Routing;

class UrlGenerator
{
    /**
     * @var SubRouter $subRouter
     */
    protected $subRouter;


    public function __construct(SubRouter $subRouter)
    {
        $this->subRouter = $subRouter;
    }
}