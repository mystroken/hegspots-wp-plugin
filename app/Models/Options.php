<?php

namespace App\Models;

use WeDevs\ORM\WP\Post;

class Options
{
	const PERPAGE = 12;

	/**
	 * @var string $pagesKeyName
	 */
	static $pagesKeyName = 'hegspots_pages';

	/**
	 * @var array $defaults
	 */
	static $pagesListKeys = [
		'home' 	  => '[hegspots_home]',
		'places'  => '[hegspots_places]',
		'members' => '[hegspots_members]',
	];

	public static function getPageID($key)
	{
		if( array_key_exists($key, static::$pagesListKeys) )
		{
			$pages = static::getPages();
			return (isset($pages[$key])) ? intval($pages[$key]) : null;
		}

		return null;
	}

	public static function getPages()
	{
		return (($options = get_option(static::$pagesKeyName)) != false) ? $options : [];
	}

	public static function setPages(array $options)
	{

		foreach(Options::$pagesListKeys as $pageKey => $pageValue)
		{
			$page = Post::findOrFail(intval($options[$pageKey]));

			if( $page )
			{
				$page->post_content = $pageValue;
				$page->save();
			}
		}

		update_option(static::$pagesKeyName, $options);
	}
}
