<?php

namespace App\Models;

use Vitaminate\Http\Request;
use App\Support\Slugger;

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


	public static function firstOrCreate(array $attributes, $value = [])
	{
		if ( ! is_null($instance = static::where($attributes)->first()))
		{
			return $instance;
		}

		return static::create(array_merge($attributes, $value));
	}


	public static function createFromRequest(Request $request)
	{
		$slugger = new Slugger;
		$lng     = floatval( $request->request->get('map__lng') );
		$lat     = floatval( $request->request->get('map__lat') );

		if( !is_null($lat) && !is_null($lng) )
		{
			return static::firstOrCreate(
				[
					'lat' => $lat,
					'lng' => $lng,
				]
			);
		}

		return null;
	}
}
