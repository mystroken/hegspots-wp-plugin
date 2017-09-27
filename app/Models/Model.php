<?php

namespace App\Models;

use WeDevs\ORM\Eloquent\Database;
use \WeDevs\ORM\Eloquent\Model as ORMModel;

class Model extends ORMModel
{

	public static function getRecords($perPage = 5, $pageNumber = 1)
	{
	    $db = Database::instance();
	    $items = $db->table(static::$tableName)
	        ->orderBy('name', 'asc')
	        ->offset( (($pageNumber - 1) * $perPage) )
	        ->limit($perPage)
	        ->get()
	    ;
	}


	/**
	 * Overide parent method to make sure prefixing is correct.
	 *
	 * @return string
	 */
	public function getTable()
	{
	    //In this example, it's set, but this is better in an abstract class
	    if( isset( $this->table ) ){
	        $prefix =  $this->getConnection()->db->prefix;
	        return $prefix . $this->table;

	    }

	    return parent::getTable();
	}
}
