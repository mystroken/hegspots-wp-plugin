<?php

namespace App\Models;

class Member extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hegspots_members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'name', 'instagram'];

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

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function activities()
    {
        $prefix =  $this->getConnection()->db->prefix;
        return $this->belongsToMany(Activity::class, $prefix.'hegspots_members_activities', 'member_id', 'activity_id');
    }

    public function recommandedPlaces()
    {
        $prefix =  $this->getConnection()->db->prefix;
        return $this->belongsToMany(Place::class, $prefix.'hegspots_members_recommandations', 'member_id', 'place_id');
    }


    public function scopeFromFilter($query, $activityID = null, $locationID = null)
    {
    	if( !is_null($activityID) && !is_null($locationID) )
    	{
    		$activity = Activity::find($activityID);
    		return $activity->members()->where('location_id',$locationID);
    	}
    	elseif ( !is_null($activityID) )
    	{
    		$activity = Activity::find($activityID);
    		return $activity->members();
    	}
    	elseif ( !is_null($locationID) )
    	{
    		return $query->where('location_id', $locationID);
    	}

    	return $query;
    }

}
