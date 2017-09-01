<?php

if( !function_exists('asset') )
{
	function asset($resource)
	{
		return plugins_url('assets/' . $resource, app('path'));
	}
}

if( !function_exists('config') )
{
	function config($name)
	{
		$config = require __DIR__  . '/../config/config.php';
		return $config[$name];
	}
}