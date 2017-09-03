<?php

namespace App\Models;

use \WeDevs\ORM\Eloquent\Model;
use Vitaminate\Http\Request;
use App\Support\Slugger;

class Location extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hegspots_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'town', 'country'];

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


    public function members()
    {
        return $this->hasMany(Member::class, 'location_id');
    }


    public function places()
    {
        return $this->hasMany(Place::class, 'location_id');
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
        $location__town     = mb_strtolower($request->request->get('location__town'),    'UTF-8');
        $location__country  = mb_strtolower($request->request->get('location__country'), 'UTF-8');
        $location__slug     = $slugger->slugify($location__town . '-' . $location__country);

        return static::firstOrCreate(
            [
                'slug'    => $location__slug
            ],
            [
                'town'    => $location__town,
                'country' => $location__country,
            ]
        );
    }
}
