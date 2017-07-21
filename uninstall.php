<?php

global $wpdb;

$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_members;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_profiles;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_places;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_types_places;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_map_positions;");