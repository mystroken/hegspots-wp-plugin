<?php

namespace App\Models;

use WeDevs\ORM\WP\Post;

class Options
{
	/**
	 * @var string $pagesKeyName
	 */
    static $pagesKeyName = 'hegspots_pages';

    /**
     * @var array $defaults
     */
    static $pagesListKeys = [
    	'places'  => '[test]',
    	'members' => '[hegspots_members]',
    ]; 

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