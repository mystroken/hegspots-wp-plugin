<?php

namespace App\Models;

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
		$prefix =  $this->getConnection()->db->prefix;
		return $this->belongsToMany(Member::class, $prefix.'hegspots_members_recommandations', 'place_id', 'member_id');
	}

	/**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromFilter($query, $type = null, $locationID = null)
    {
    	if( !is_null($type) && !is_null($locationID) )
    	{
    		return $query->where('type_place_id',$type)->where('location_id',$locationID);
    	}
    	elseif ( !is_null($type) )
    	{
    		return $query->where('type_place_id', $type);
    	}
    	elseif ( !is_null($locationID) )
    	{
    		return $query->where('location_id', $locationID);
    	}

    	return $query;
    }


    public function getPhotoAttribute($value)
    {
        return (!empty($value))?$value:config('place_default_photo');
    }

}
