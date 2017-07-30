<?php

namespace App\Models;

use \WeDevs\ORM\Eloquent\Model;

class MapPosition extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hegspots_map_positions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'lat', 'lng'];

    /**
     * Disable created_at and update_at columns, unless you have those.
     */
    public $timestamps = false;

    /** Everything below this is best done in an abstract class that custom tables extend */

    /**
     * Set primary key as ID, because WordPress
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Make ID guarded -- without this ID doesn't save.
     *
     * @var string
     */
    protected $guarded = [ 'ID' ];


    public function place()
    {
        return $this->hasOne(Place::class, 'map_position_id');
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
