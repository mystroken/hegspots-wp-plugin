<?php

namespace App\Wordpress\Admin\ListTable;

use App\Models\Location;
use WeDevs\ORM\Eloquent\Database;

class MemberListTable extends AbstractListTable
{
    protected static $tableName = 'hegspots_members';

    /**
     * Class constructor
     */
    public function __construct() {

        parent::__construct( [
            'singular' => __( 'Member', 'hegspots' ),
            'plural'   => __( 'Members', 'hegspots' ),
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
            $items[$key]['location_town'] = $location->town;
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
            'location_town' => __( 'Location', 'hegspots' ),
            'updated_at'    => __( 'Updated At', 'hegspots' ),
            'created_at'    => __( 'Created At', 'hegspots' ),
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
            'name' => array( 'name', true ),
        );

        return $sortable_columns;
    }
}