<?php

namespace App\Wordpress\Admin\ListTable;

use App\Models\Location;
use App\Models\TypePlace;
use WeDevs\ORM\Eloquent\Database;
use Vitaminate\Routing\URL;

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

        static::$redirectTo = URL::to('place_index');

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

            // Excerpt the description
            $items[$key]['description'] = excerpt($items[$key]['description']);
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

    function column_name( $item )
    {
        // create a nonce
        $delete_nonce = wp_create_nonce( 'hegspots_delete_item' );

        $title = '<a href="'.URL::to('place_edit')->with('item', absint($item['ID'])).'"><strong>'.$item['name'].'</strong></a>';

        $actions = [
            'delete' => sprintf( '<a href="?page=%s&action=%s&item=%s&_wpnonce=%s&noheader=1">'.__('Delete', 'hegspots').'</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ID'] ), $delete_nonce )
        ];

        return $title . $this->row_actions( $actions );
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
