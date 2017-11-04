<?php
namespace App\Support;

use MetzWeb\Instagram\Instagram as InstagramLibrary;


class Instagram extends InstagramLibrary
{
	public function __construct()
	{
		parent::__construct(array(
	      'apiKey'      => '4003e04ac2034f27a58ed9d75b4cf894',
	      'apiSecret'   => '73f237edc82a4059987a3498705d3dfe ',
	      'apiCallback' => 'https://mrafropolitan.com'
	    ));
	}
}
