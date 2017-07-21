<?php

namespace App;

use \WeDevs\ORM\Eloquent\Model;

class Place extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hegspots_places';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'name', 'description', 'photo', 'instagram'];

    /**
     * Disable created_at and update_at columns, unless you have those.
     */
    public $timestamps = true;

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


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function mapPosition()
    {
        return $this->belongsTo(MapPosition::class);
    }

    public function type()
    {
        return $this->belongsTo(TypePlace::class, 'type_place_id');
    }

    public function recommandators()
    {
        return $this->belongsToMany(Member::class, $wpdb->prefix.'hegspots_members_recommandations', 'place_id', 'member_id');
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
