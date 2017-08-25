<?php

namespace App\Models;

class Options
{
    protected static $pagesOptionName = 'hegspots_pages';

    public static function getPages()
    {
        return (($options = get_option(static::$pagesOptionName)) != false) ? $options : [];
    }

    public static function setPages(array $options)
    {
        update_option(static::$pagesOptionName, $options);
    }
}