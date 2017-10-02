<?php

namespace App\Wordpress\Admin\ListTable;

use WeDevs\ORM\Eloquent\Database;

abstract class AbstractListTable extends \WP_List_Table
{
    protected static $tableName = '';
    protected static $redirectTo = '';

    /**
     * Class constructor
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
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
        return $items;
    }

    public static function deleteRecord($id)
    {
        $db = Database::instance();
        $db->table(static::$tableName)->where('ID', '=', intval($id))->delete();
    }

    public static function countRecords()
    {
        $db = Database::instance();
        return $db->table(static::$tableName)->count();
    }

    /**
     * Set the message to display when there is no data to display
     */
    public function no_items()
    {
        _e( 'No data available.', 'hegspots' );
    }

    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_name( $item )
    {
        // create a nonce
        $delete_nonce = wp_create_nonce( 'hegspots_delete_item' );

        $title = '<strong>' . $item['name'] . '</strong>';

        $actions = [
            'delete' => sprintf( '<a href="?page=%s&action=%s&item=%s&_wpnonce=%s&noheader=1">'.__('Delete', 'hegspots').'</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ID'] ), $delete_nonce )
        ];

        return $title . $this->row_actions( $actions );
    }

    /**
     * Render a column when no column specific method exists.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default( $item, $column_name ) {
        return $item[ $column_name ];
    }

    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    public function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
        );
    }

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions() {
        $actions = [
            'bulk-delete' => __('Delete', 'hegspots')
        ];

        return $actions;
    }

    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items() {

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        //$this->_column_headers = $this->get_column_info();

        /** Process bulk action */
        $this->process_bulk_action();

        $per_page     = $this->get_items_per_page( 'hegspots_per_page', 12 );
        $current_page = $this->get_pagenum();
        $total_items  = static::countRecords();

        $this->set_pagination_args( [
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page'    => $per_page //WE have to determine how many items to show on a page
        ] );


        $this->items = static::getRecords( $per_page, $current_page );
    }

    public function process_bulk_action() {

        //Detect when a bulk action is being triggered...
        if ( 'delete' === $this->current_action() ) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, 'hegspots_delete_item' ) ) {
                die( 'Go get a life script kiddies' );
            }
            else {
                static::deleteRecord( absint( $_GET['item'] ) );

                if( !empty(static::$redirectTo) )
                {
                	wp_redirect( static::$redirectTo ); exit;
                }
            }

        }

        // If the delete bulk action is triggered
        if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
            || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
        ) {

            $delete_ids = esc_sql( $_POST['bulk-delete'] );

            // loop over the array of record IDs and delete them
            foreach ( $delete_ids as $id ) {
                static::deleteRecord( $id );

            }

            wp_redirect( esc_url( add_query_arg() ) );
            exit;
        }
    }
}
