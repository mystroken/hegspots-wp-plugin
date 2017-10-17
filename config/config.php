<?php

return [

	/*
	|---------------------------------------------------------
	|
	|---------------------------------------------------------
	|
	*/
	'url'  => plugins_url('', realpath(__DIR__)),
	'path' => realpath(plugin_dir_path( __FILE__ ) . '../') . DIRECTORY_SEPARATOR,

	'place_default_photo' 	=> asset('img/default-hegspot.png'),
	'type_default_photo' 	=> asset('img/default-icon.png'),
	'member_default_avatar' => asset('img/default-avatar.png'),
	'member_default_cover' 	=> asset('img/default-avatar.png'),
];
