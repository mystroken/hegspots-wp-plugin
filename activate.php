<?php

global $wpdb;
$charset_collate = $wpdb->get_charset_collate();

$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_activities (
  ID int(10) UNSIGNED NOT NULL,
  slug varchar(255) NOT NULL,
  name varchar(100) NOT NULL
) ENGINE=InnoDB {$charset_collate};");


$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_locations (
  ID int(10) UNSIGNED NOT NULL,
  slug varchar(255) NOT NULL,
  town varchar(50) NOT NULL,
  country varchar(50) NOT NULL
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_map_positions (
  ID int(10) UNSIGNED NOT NULL,
  name varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  lat double(8,2) NOT NULL,
  lng double(8,2) NOT NULL
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_members (
  ID int(10) UNSIGNED NOT NULL,
  slug varchar(255) NOT NULL,
  name varchar(50) NOT NULL,
  profile_id int(10) UNSIGNED DEFAULT NULL,
  location_id int(10) UNSIGNED NOT NULL,
  instagram varchar(50) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_members_activities (
  ID int(10) UNSIGNED NOT NULL,
  activity_id int(10) UNSIGNED NOT NULL,
  member_id int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_members_recommandations (
  ID int(10) UNSIGNED NOT NULL,
  place_id int(10) UNSIGNED NOT NULL,
  member_id int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_places (
  ID int(10) UNSIGNED NOT NULL,
  slug varchar(255) NOT NULL,
  name varchar(100) NOT NULL,
  description text ,
  photo text, 
  type_place_id int(10) UNSIGNED NOT NULL,
  location_id int(10) UNSIGNED NOT NULL,
  map_position_id int(10) UNSIGNED DEFAULT NULL,
  instagram varchar(50) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_profiles (
  ID int(10) UNSIGNED NOT NULL,
  photo text, 
  watch varchar(100) DEFAULT NULL,
  bag varchar(100) DEFAULT NULL,
  book varchar(100) DEFAULT NULL,
  grooming varchar(100) DEFAULT NULL,
  style_icon varchar(100) DEFAULT NULL,
  brand varchar(100) DEFAULT NULL
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_types_place (
  ID int(10) UNSIGNED NOT NULL,
  slug varchar(255) NOT NULL,
  name varchar(100) NOT NULL,
  description text,
  photo text COLLATE utf8_unicode_ci
) ENGINE=InnoDB {$charset_collate};");



$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}hegspots_profiles (
  ID int(10) UNSIGNED NOT NULL,
  photo text,
  watch varchar(100) DEFAULT NULL,
  bag varchar(100) DEFAULT NULL,
  book varchar(100) DEFAULT NULL,
  grooming varchar(100) DEFAULT NULL,
  style_icon varchar(100) DEFAULT NULL,
  brand varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB {$charset_collate};");