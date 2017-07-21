<?php

namespace Plugino;


class Application 
{

	/**
	 * @var array
	 */
	protected $config = [];

	/**
	 * Application constructor.
	 *
	 * @param $config
	 */
	public function __construct($config){
		$this->config = $config;
	}

  	public function run() {
  	}

}