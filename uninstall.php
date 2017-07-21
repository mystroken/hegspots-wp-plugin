<?php

global $wpdb;


$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_members_activities;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_members_recommandations;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_members;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_places;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_profiles;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_types_place;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_activities;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_locations;");
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}hegspots_map_positions;");