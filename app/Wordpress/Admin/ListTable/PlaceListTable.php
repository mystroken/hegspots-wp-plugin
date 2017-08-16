<?php

namespace App\Wordpress\Admin\ListTable;

use App\Models\Location;
use App\Models\TypePlace;
use WeDevs\ORM\Eloquent\Database;

class PlaceListTable extends AbstractListTable
{
    protected static $tableName = 'hegspots_places';

    /**
     * Class constructor
     */
    public function __construct() {

        parent::__construct( [
            'singular' => __( 'Place', 'hegspots' ),
            'plural'   => __( 'Places', 'hegspots' ),
            'ajax'     => false
        ]);

    }

    public static function getRecords($perPage = 5, $pageNumber = 1)
    {
        $db = Database::instance();
        $items = $db->table(static::$tableName)
            ->offset( (($pageNumber - 1) * $perPage) )
            ->limit($perPage)
            ->get()
        ;
        $items = json_decode(json_encode($items), true);

        foreach($items as $key => $item)
        {
            /** @var Location $location */
            $location = Location::find($item['location_id']);
            /** @var TypePlace $typePlace */
            $typePlace = TypePlace::find($item['type_place_id']);
            $items[$key]['location_town'] = $location->town;
            $items[$key]['type_place_name'] = $typePlace->name;
        }

        return $items;
    }

    /**
     *  Associative array of columns
     *
     * @return array
     */
    function get_columns() {
        $columns = [
            'cb'      => '<input type="checkbox" />',
            'name'    => __( 'Name', 'hegspots' ),
            'type_place_name'    => __( 'Type place', 'hegspots' ),
            'description'    => __( 'Description', 'hegspots' ),
            'location_town' => __( 'Location', 'hegspots' ),
            'updated_at'    => __( 'Updated At', 'hegspots' ),
        ];

        return $columns;
    }

    /**
     * Columns to make sortable.
     *
     * @return array
     */
    public function get_sortable_columns() {
        $sortable_columns = array(
            'name' => array('name', true),
            'type_place_name' => array('type_place_name', true),
        );

        return $sortable_columns;
    }
}